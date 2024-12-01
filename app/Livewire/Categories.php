<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Categories extends Component
{
    public $id, $name, $image, $search;
    
    use WithPagination, WithFileUploads;
    

    public function render()
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')->orderby('id', 'desc')->paginate(3);
        return view('livewire.categories', compact('categories'));
    }

    public function updating(){
        $this->resetPage();
    }

    #[On('resetForm')]
    public function resetForm(){
        $this->reset();
    }
    
    #[On('deleteCategory')]
    public function deleteCategory($id){
        $category = Category::find($id);
        
        $category->delete();
        session()->flash('delete', 'Categoria ha sido eliminado correctamente!');
        
    }

    public function store(){
        $this->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->dispatch('close-modalnewCategory');

        $this->reset();
        $this->dispatch('newCategorySweetalert');
        session()->flash('new', 'Categoria ha sido agregado correctamente!');
    }

    public function edit($id){
        $this->reset();
        $categoria = Category::find($id);
        $this->id = $categoria->id;
        $this->name = $categoria->name;

    }

    public function update(){
        $this->validate([
            'name' => 'required|unique:categories,name,'.$this->id,
        ]);
        $categoria = Category::find($this->id);
        $categoria->name = $this->name;

        $categoria->save();

        $this->dispatch('close-modaleditCategory');

        $this->reset(); 
        $this->dispatch('updateCategorySweetalert');

        session()->flash('update', 'Categoria ha sido actualizado correctamente!');
    }

    public function delete_image(){
        $this->image = null;
    }

    public function view($id){
        $categoria = Category::find($id);
        $this->id = $categoria->id;
        $this->name = $categoria->name;
    }
}
