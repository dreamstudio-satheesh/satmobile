<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
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

    public function invoice($id) 
    {
        $invoice = Invoice::withTrashed()->with(['invoice_items','customer'])->where('id',$id)->first();
        if ($invoice) {
            // return $invoice->invoice_items;
             $fivetotal=0; $twelvetotal=0; 
             $fivegst=0; $twelvegst=0; 
             
             foreach ($invoice->invoice_items as $item) {
                // return $item;
                 if ($item->gst == 5) {
                    $fivetotal += $item->total;
                 }elseif ($item->gst == 12) {
                     $twelvetotal += $item->total;
                   // $twelvegst =$twelvegst+ ($item->gstamount  * $item->quantity );
                 }
 
             }
             if ($fivetotal > 0) {
                 $fivegst=$fivetotal-($fivetotal*(100/(100+5))) ;
             }
 
             if ($twelvetotal > 0) {
                 $twelvegst=$twelvetotal-($twelvetotal*(100/(100+12))) ;
             } 
             
             $subtotal=$invoice->total - ($fivegst + $twelvegst) ;
        return view('invoice', compact('invoice','fivegst','twelvegst','subtotal'));
        }
        
    }

    public function selectline(Request $request) {
        $user =Auth::user();
        $user->user_line_id = $request['line_id'];
        $user->save();

        dd($user);

        return redirect('cart.html')->withSuccess('Updated');
        
    }

    public function settings() 
    {
        $line=auth()->user()->line_id;
        $lines = Line::where('line', $line)->get();
        return view('settings',compact('lines'));
    }


    public function cart()
    {
       
       
        if(auth()->user()->hasRole('user') && auth()->user()->user_line_id){
            $customers = Customer::where('line_id', auth()->user()->user_line_id)->get();
            
        }elseif(auth()->user()->hasRole('user') && auth()->user()->line_id){

            $lines=Line::where('line', auth()->user()->line_id )->select('id')->get()->toArray();            
            $customers = Customer::whereIn('line_id',$lines)->get();
            
        }else{
            $customers = Customer::all();
        }    
        
        return view('cart', compact('customers'));
    }
}
