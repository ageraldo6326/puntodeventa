<?php

namespace App\Livewire;

use App\Models\Provider;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class Providers extends Component
{

    public $id, $name, $lastname, $company, $email, $password, $phone, $whatsapp, $address, $city, $state, $zip, $country, $status =1, $type, $image, $rfc, $search;

    
    use WithPagination, WithFileUploads;
    

    public function render()
    {
        $providers = Provider::where('name', 'like', '%'.$this->search.'%')->OrWhere('company', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%')->orWhere('phone', 'like', '%'.$this->search.'%')->orderby('id', 'desc')->paginate(3);
        return view('livewire.providers', compact('providers'));
    }

    public function updating(){
        $this->resetPage();
    }

    #[On('resetForm')]
    public function resetForm(){
        $this->reset();
    }
    
    #[On('deleteProvider')]
    public function deleteProvider($id){
        $provider = Provider::find($id);
        
        $provider->delete();
        session()->flash('delete', 'Proveedor ha sido eliminado correctamente!');
        
    }

    public function store(){
        $this->validate([
            'email' => 'required|unique:providers,email',
            
        ]);

        $provider = new Provider();
        $provider->name = $this->name;
        $provider->lastname = $this->lastname;
        $provider->company = $this->company;
        $provider->rfc = $this->rfc;
        $provider->email = $this->email;
        $provider->password = $this->password;
        $provider->phone = $this->phone;
        $provider->whatsapp = $this->whatsapp;
        $provider->address = $this->address;
        $provider->city = $this->city;
        $provider->state = $this->state;
        $provider->zip = $this->zip;
        $provider->country = $this->country;
        $provider->status = $this->status;
        $provider->type = $this->type;


        $provider->save();

        $this->dispatch('close-modalnewProvider');

        $this->reset();
        $this->dispatch('newProviderSweetalert');
        session()->flash('new', 'Proveedor ha sido agregado correctamente!');
    }

    public function edit($id){
        $this->reset();
        $provider = Provider::find($id);

        $this->id = $provider->id;
        $this->name = $provider->name;
        $this->lastname = $provider->lastname;
        $this->company = $provider->company;
        $this->email = $provider->email;
        $this->password = $provider->password;
        $this->phone = $provider->phone;
        $this->whatsapp = $provider->whatsapp;
        $this->address = $provider->address;
        $this->city = $provider->city;
        $this->state = $provider->state;
        $this->zip = $provider->zip;
        $this->country = $provider->country;
        $this->status = $provider->status;
        $this->type = $provider->type;
        $this->rfc = $provider->rfc;

    }

    public function update(){

        $provider = Provider::find($this->id);

        $provider->name = $this->name;
        $provider->lastname = $this->lastname;
        $provider->company = $this->company;
        $provider->password = $this->password;
        $provider->phone = $this->phone;
        $provider->whatsapp = $this->whatsapp;
        $provider->address = $this->address;
        $provider->city = $this->city;
        $provider->state = $this->state;
        $provider->zip = $this->zip;
        $provider->country = $this->country;
        $provider->status = $this->status;
        $provider->type = $this->type;
        $provider->rfc = $this->rfc;


        $provider->save();

        $this->dispatch('close-modaleditProvider');

        $this->reset(); 
        $this->dispatch('updateProviderSweetalert');

        session()->flash('update', 'Proveedor ha sido actualizado correctamente!');
    }

    public function delete_image(){
        $this->image = null;
    }

    public function view($id){

        $provider = Provider::find($id);

        $this->id = $provider->id;
        $this->name = $provider->name;
        $this->lastname = $provider->lastname;
        $this->company = $provider->company;
        $this->email = $provider->email;
        $this->password = $provider->password;
        $this->phone = $provider->phone;
        $this->whatsapp = $provider->whatsapp;
        $this->address = $provider->address;
        $this->city = $provider->city;
        $this->state = $provider->state;
        $this->zip = $provider->zip;
        $this->country = $provider->country;
        $this->status = $provider->status;
        $this->type = $provider->type;
        $this->rfc = $provider->rfc;

    }

}
