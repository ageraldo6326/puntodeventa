<?php

namespace App\Livewire;

use Stringable;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Provider;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Products extends Component
{
    public $id, $title, $code, $description, $category_id, $category_name, $price, $stock = 0, $image, $provider_id, $provider_name, 
    $unit, $search;
    
    use WithPagination, WithFileUploads;
    

    public function render()
    {
        $products = Product::where('title', 'like', '%'.$this->search.'%')
        ->OrWhere('code', 'like', '%'.$this->search.'%')->orderby('id', 'desc')
        ->paginate(3);
        $categories = Category::all();
        return view('livewire.products', compact('products', 'categories'));
    }

    public function updating(){
        $this->resetPage();
    }

    #[On('resetForm')]
    public function resetForm(){
        $this->reset();
    }
    
    #[On('deleteProduct')]
    public function deleteProduct($id){
        $product = Product::find($id);

        $filePath = public_path('storage/'.$product->image);;

        if (file_exists($filePath)) {
            unlink($filePath);
        } else {
            Log::info('File does not exist: ' . $filePath);
        }
        
        $product->delete();
        session()->flash('delete', 'Producto ha sido eliminado correctamente!');
        
    }

    public function store(){
        $this->validate([
            'title' => 'required|unique:products,title',
            'code' => 'required|unique:products,code,'. $this->code,
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $product = new Product();
        $product->title = $this->title;
        $product->code = $this->code;
        $product->description = $this->description;
        $product->category_id = $this->category_id;
        $product->price = $this->price;
        $product->stock = $this->stock;
        $product->unit = $this->unit;

        if($this->image){
            $product->image = $this->image->store('products');
        }
        $product->save();

        $this->dispatch('close-modalnewProduct');

        $this->reset();
        $this->dispatch('newProductSweetalert');
        session()->flash('new', 'Producto ha sido agregado correctamente!');
    }

    public function edit($id){
        $this->reset();
        $product = Product::find($id);
        $this->id = $product->id;
        $this->code = $product->code;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->image = $product->image;
        $this->unit = $product->unit;


    }

    public function update(){
        $this->validate([
            'title' => 'required|unique:products,title,'.$this->id,
            // 'code' => 'required|unique:products,code,'. $this->code,
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $product = Product::find($this->id);
        $product->title = $this->title;
        $product->code = $this->code;
        $product->description = $this->description;
        $product->category_id = $this->category_id;
        $product->price = $this->price;
        $product->stock = $this->stock;
        $product->unit = $this->unit;

        if($this->image && $this->image != $product->image){
            $product->image = $this->image->store('products');
        }
        $product->save();

        $this->dispatch('close-modaleditProduct');

        $this->reset(); 
        $this->dispatch('updateProductSweetalert');

        session()->flash('update', 'Producto ha sido actualizado correctamente!');
    }

    public function delete_image(){
        $this->image = null;
    }

    public function view($id){
        $product = Product::find($id);
        $this->id = $product->id;
        $this->code = $product->code;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->category_name = $product->category->name;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->image = $product->image;
        $this->unit = $product->unit;
    }

    public function borrar_foto() {
        $this->image = '';
    }
}
