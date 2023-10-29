<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ViewCart extends Component
{
    public $cart;

    public function mount()
    {
        
    }

    public function render()
    {
       
        return view('livewire.view-cart');
    }

   
}
