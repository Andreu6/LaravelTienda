<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductComponent extends Component
{
    
    use WithPagination;

    public $view = 'create';
    public $product_id, $name, $description, $quantity, $price;

    public function render()
    {
        $products = Product::orderBy('id', 'asc')->paginate(10);
        return view('livewire.product-component', compact('products'));
    }
}
