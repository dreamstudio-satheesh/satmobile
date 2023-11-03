<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Retrieve the customer ID and cart items from the request
        $customerId = $request->input('customerId');
        $invoice_date = $request->input('invoiceDate');
        $cartItems = $request->input('cartItems');
        $tax_amount = 0;
        $cartlist = [];
        $totalAmount = 0; // Initialize total amount
        $invoiceId = null; // Initialize invoice ID

        foreach ($cartItems as $item) {
            $product = Product::where('id', $item['id'])->first();

            $gst_amount = number_format($product->price - $product->price * (100 / (100 + $product->gst)), 2);
            $itemTotal = (int) ($product->price * $item['quantity']); // Calculate item total

            $cartlist[$item['id']] = [
                'id' => $product->id,
                'code' => $product->code,
                'name' => $product->name,
                'price' => (int) $product->price,
                'gstamount' => $gst_amount,
                'gst' => $product->gst,
                'hsncode' => $product->hsncode,
                'quantity' => $item['quantity'],
                'total' => $itemTotal,
            ];

            $tax_amount += (int) ($gst_amount * $item['quantity']);
            $totalAmount += $itemTotal; // Accumulate the total amount
        }

        if (!empty($cartlist) && !empty($customerId) && !empty($invoice_date)) {
            $invoiceId = $this->create_invoice([
                'items' => $cartlist,
                'customer_id' => $customerId,
                'invoice_date' => $invoice_date,
                'total' => $totalAmount,
                'sub_total' => $totalAmount - $tax_amount,
                'taxamount' => $tax_amount,
            ]);
        }

        if (!$invoiceId) {
            return response()->json(['message' => 'Failed to create invoice.']);
        }

        $response = [
            'message' => 'Invoice created successful',
        ];

        return response()->json($response);
    }

    public function create_invoice($data)
    {
        try {
            // Start a new database transaction
            DB::beginTransaction();

            $invoice_num = Invoice::withTrashed()->max('invoice_number') + 1;

            $invoice = Invoice::create([
                'invoice_number' => $invoice_num,
                'date' => $data['invoice_date'],
                'customer_id' => $data['customer_id'],
                'taxamount' => $data['taxamount'],
                'sub_total' => $data['sub_total'],
                'total' => $data['total'],
                'created_by' => Auth::user()->id,
            ]);

            foreach ($data['items'] as $key => $item) {
                Invoice_item::create([
                    'invoice_id' => $invoice->id,
                    'product_code' => $item['code'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'gst' => $item['gst'],
                    'hsncode' => $item['hsncode'],
                    'gstamount' => $item['gstamount'],
                    'quantity' => $item['quantity'],
                    'total' => $item['total'],
                ]);
            }

            // Commit the transaction
            DB::commit();
            return $invoice->id;
        } catch (\Exception $e) {
            // Rollback the transaction in case of errors
            DB::rollback();

            // Log the error for debugging
            \Log::error('Error creating invoice: ' . $e->getMessage());

            return false;
        }
    }
}
