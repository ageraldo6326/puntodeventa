<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Customers extends Component
{

        public $id, $name, $lastname, $company, $email, $password, $phone, $whatsapp, $address, $city, $state, $zip, $country, $status = 1, $rfc, $type, $image,$search;

        
        use WithPagination, WithFileUploads;
        
    
        public function render()
        {
            $customers = Customer::where('name', 'like', '%'.$this->search.'%')->OrWhere('company', 'like', '%'.$this->search.'%')->orWhere('email', 'like', '%'.$this->search.'%')->orWhere('phone', 'like', '%'.$this->search.'%')->orderby('id', 'desc')->paginate(3);
            return view('livewire.customers', compact('customers'));
        }
    
        public function updating(){
            $this->resetPage();
        }
    
        #[On('resetForm')]
        public function resetForm(){
            $this->reset();
        }
        
        #[On('deleteCustomer')]
        public function deleteCustomer($id){
            $customers = Customer::find($id);
            
            $customers->delete();
            session()->flash('delete', 'Cliente ha sido eliminado correctamente!');
            
        }
    
        public function store(){
            $this->validate([
                'email' => 'required|unique:customers,email',
            ]);

            $customer = new Customer();
            $customer->name = $this->name;
            $customer->lastname = $this->lastname;
            $customer->company = $this->company;
            $customer->email = $this->email;
            $customer->password = $this->password;
            $customer->phone = $this->phone;
            $customer->whatsapp = $this->whatsapp;
            $customer->address = $this->address;
            $customer->city = $this->city;
            $customer->state = $this->state;
            $customer->zip = $this->zip;
            $customer->country = $this->country;
            $customer->status = $this->status;
            $customer->type = $this->type;
            $customer->rfc = $this->rfc;


            $customer->save();

            $this->dispatch('close-modalnewCustomer');
    
            $this->reset();
            $this->dispatch('newCustomerSweetalert');
            session()->flash('new', 'Cliente ha sido agregado correctamente!');
        }
    
        public function edit($id){
            $this->reset();
            $customer = Customer::find($id);

            $this->id = $customer->id;
            $this->name = $customer->name;
            $this->lastname = $customer->lastname;
            $this->company = $customer->company;
            $this->email = $customer->email;
            $this->password = $customer->password;
            $this->phone = $customer->phone;
            $this->whatsapp = $customer->whatsapp;
            $this->address = $customer->address;
            $this->city = $customer->city;
            $this->state = $customer->state;
            $this->zip = $customer->zip;
            $this->country = $customer->country;
            $this->status = $customer->status;
            $this->type = $customer->type;
            $this->rfc = $customer->rfc;
    
        }
    
        public function update(){

            $customer = Customer::find($this->id);

            $customer->name = $this->name;
            $customer->lastname = $this->lastname;
            $customer->company = $this->company;
            $customer->password = $this->password;
            $customer->phone = $this->phone;
            $customer->whatsapp = $this->whatsapp;
            $customer->address = $this->address;
            $customer->city = $this->city;
            $customer->state = $this->state;
            $customer->zip = $this->zip;
            $customer->country = $this->country;
            $customer->status = $this->status;
            $customer->type = $this->type;
            $customer->rfc = $this->rfc;


            $customer->save();
    
            $this->dispatch('close-modaleditCustomer');
    
            $this->reset(); 
            $this->dispatch('updateCustomerSweetalert');
    
            session()->flash('update', 'Cliente ha sido actualizado correctamente!');
        }
    
        public function delete_image(){
            $this->image = null;
        }
    
        public function view($id){

            $customer = Customer::find($id);

            $this->id = $customer->id;
            $this->name = $customer->name;
            $this->lastname = $customer->lastname;
            $this->company = $customer->company;
            $this->email = $customer->email;
            $this->password = $customer->password;
            $this->phone = $customer->phone;
            $this->whatsapp = $customer->whatsapp;
            $this->address = $customer->address;
            $this->city = $customer->city;
            $this->state = $customer->state;
            $this->zip = $customer->zip;
            $this->country = $customer->country;
            $this->status = $customer->status;
            $this->type = $customer->type;
            $this->rfc = $customer->rfc;

        }

}
