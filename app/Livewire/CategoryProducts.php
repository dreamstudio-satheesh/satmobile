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
     

        return view('livewire.category-products', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function showProducts($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

   
}
