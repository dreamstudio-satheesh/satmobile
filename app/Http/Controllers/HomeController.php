<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    

    public function selectcustomer() {
        if (Auth::user()->hasRole('user') && Auth::user()->user_line_id) {
            $customers = Customer::select('id', 'name', 'address')
                ->where('line_id', Auth::user()->user_line_id)
                ->get();
            return ($customers);
        } elseif (Auth::user()->hasRole('user') && Auth::user()->line_id) {
            $lines = Line::where('line', Auth::user()->line_id)
                ->select('id')
                ->get()
                ->toArray();
            $customers = Customer::select('id', 'name', 'address')->whereIn('line_id', $lines)->get();
        } else {
            $customers = Customer::select('id', 'name', 'address')->get();
        }

        // Return a JSON response instead of a redirect
        return response()->json(['customers' => $customers], Response::HTTP_OK);
    }

    public function invoice($id)
    {
        $invoice = Invoice::withTrashed()
            ->with(['invoice_items', 'customer'])
            ->where('id', $id)
            ->first();
        if ($invoice) {
            // return $invoice->invoice_items;
            $fivetotal = 0;
            $twelvetotal = 0;
            $fivegst = 0;
            $twelvegst = 0;

            foreach ($invoice->invoice_items as $item) {
                // return $item;
                if ($item->gst == 5) {
                    $fivetotal += $item->total;
                } elseif ($item->gst == 12) {
                    $twelvetotal += $item->total;
                    // $twelvegst =$twelvegst+ ($item->gstamount  * $item->quantity );
                }
            }
            if ($fivetotal > 0) {
                $fivegst = $fivetotal - $fivetotal * (100 / (100 + 5));
            }

            if ($twelvetotal > 0) {
                $twelvegst = $twelvetotal - $twelvetotal * (100 / (100 + 12));
            }

            $subtotal = $invoice->total - ($fivegst + $twelvegst);
            return view('invoice', compact('invoice', 'fivegst', 'twelvegst', 'subtotal'));
        }
    }

    public function selectline(Request $request)
    {
        $user = Auth::user();
        $user->user_line_id = $request['line_id'];
        $user->save();

        // Return a JSON response instead of a redirect
        return response()->json(['message' => 'Updated successfully'], Response::HTTP_OK);
    }

    public function settings()
    {
        $line = Auth::user()->line_id;
        $lines = Line::where('line', $line)->get();
        return view('settings', compact('lines'));
    }

    public function cart()
    {
        return view('cart');
    }
}
