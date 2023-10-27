<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ViewCart extends Component
{
    public $cart;

    public function mount()
    {
        $this->cart = Session::get('cart', []);
    }

    public function render()
    {
        return view('livewire.view-cart');
    }

    public function updateQuantity($productId, $newQuantity)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['quantity'] = $newQuantity;
            Session::put('cart', $this->cart);
        }
    }

    public function removeFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            Session::put('cart', $this->cart);
        }
    }
}
