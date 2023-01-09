<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductComponentAdmin extends Component
{
    
    use WithPagination;

    public $view = 'create';
    public $product_id, $name, $description, $quantity, $price;

    public function render()
    {
        $products = Product::orderBy('id', 'asc')->paginate(10);
        return view('livewire.product-component-admin', compact('products'));
    }

    public function save(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);
 
        Product::create([
            'name'        => $this->name,
            'description' => $this->description,
            'quantity'    => $this->quantity,
            'price'       => $this->price
        ]);
        $this->reset();
    }

    public function edit($id){
        $product = Product::find($id);

        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->price = $product->price;

        $this->view = 'edit';
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required'
        ]);
        $product = Product::find($this->product_id);
        $product->update([
            'name'        => $this->name,
            'description' => $this->description,
            'quantity'    => $this->quantity,
            'price'       => $this->price
        ]);

        $this->reset();
    }

    public function destroy($id){         
        Product::destroy($id);     
      }
}
