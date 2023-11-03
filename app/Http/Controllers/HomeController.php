<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Customer;
use Illuminate\Http\Request;

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

    function invoice($id) 
    {
        
        return view('invoice', compact('id'));
        
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
