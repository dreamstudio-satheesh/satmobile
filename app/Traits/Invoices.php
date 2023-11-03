<?php

namespace App\Traits;

use App\Models\Invoice;
use App\Models\Invoice_item;
use Illuminate\Support\Facades\Auth;

trait Invoices {


    public function create_invoice($data)
    {
        $invoice_num=Invoice::withTrashed()->max('invoice_number')+1;        

        $invoice=Invoice::create([
            'invoice_number' => $invoice_num,
            'date' => $data['invoice_date'],
            'customer_id' => $data['customer_id'],
            'taxamount' => $data['taxamount'],
            'sub_total' => $data['sub_total'],
            'total' => $data['total'],
            'created_by' => Auth::user()->id
        ]);
        //dd($invoice);

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
         
    }



}