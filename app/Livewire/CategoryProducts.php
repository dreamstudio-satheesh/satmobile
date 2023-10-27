<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Session;


class CategoryProducts extends Component
{
    public $selectedCategory = null;
    public $quantities = [];  // New associative array for product quantities

    public function mount()
    {
        // Set the selectedCategory to the ID of the first category
        $this->selectedCategory = Category::first()->id ?? null;
    }

    public function render()
    {
        $categories = Category::all();
        $products = [];

        if ($this->selectedCategory) {
            $products = Product::where('category_id', $this->selectedCategory)->get();
        }

        foreach ($products as $product) {
            if (!isset($this->quantities[$product->id])) {
                $this->quantities[$product->id] = 1;
            }
        }

        return view('livewire.category-products', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function showProducts($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function addToCart($productId)
    {
        $quantity = isset($this->quantities[$productId]) ? $this->quantities[$productId] : 1;

        // Fetch the product details from the database
        $product = Product::find($productId);

        // Initialize the cart session if it doesn't exist
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }

         // Get the current cart from the session
         $cart = Session::get('cart');

          // Get the quantity for this product from the quantities array
         $quantity = isset($this->quantities[$productId]) ? $this->quantities[$productId] : 1;

         // Check if this product is already in the cart
         if (isset($cart[$productId])) {
             // Increment the quantity by the specified amount
             $cart[$productId]['quantity'] += $quantity;
         } else {
             // Add the new product to the cart
             $cart[$productId] = [
                 'name' => $product->name,
                 'price' => $product->price,
                 'quantity' => $quantity,
             ];
         }
 
         // Update the cart session
         Session::put('cart', $cart);


        // Optionally, you can show a message or perform a redirect
        $this->emit('productAddedToCart');  // Emitting an event to show a message on the frontend




    }
}
