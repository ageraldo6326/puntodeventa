<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use App\Models\Company as CompanyTable;

class Company extends Component
{
    public $id,$image, $name, $rfc, $email, $website, $phone, $address,$city, $state, $zip, $country;

    
    use WithFileUploads;

    public function mount(){
        $company = CompanyTable::find(1);
        $this->id = $company->id;
        $this->image = $company->logo;
        $this->name = $company->name;
        $this->rfc = $company->rfc;
        $this->email = $company->email;
        $this->website = $company->website;
        $this->phone = $company->phone;
        $this->address = $company->address;
        $this->city = $company->city;
        $this->state = $company->state;
        $this->zip = $company->zip;
        $this->country = $company->country;
    }

    public function render()
    {
        return view('livewire.company');
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'rfc' => 'required',
            'address' => 'required',           
        ]);

        $company = CompanyTable::find($this->id);
        $company->name = $this->name;
        $company->rfc = $this->rfc;
        $company->email = $this->email;
        $company->website = $this->website;
        $company->phone = $this->phone;
        $company->address = $this->address;
        $company->city = $this->city;
        $company->state = $this->state;
        $company->zip = $this->zip;
        $company->country = $this->country;
        if($this->image && $this->image != $company->logo){
            $company->logo = $this->image->store('company');
        }
        $company->save();

        $this->dispatch('updateCompanySweetalert');

        Log::info('Empresa actualizada');

    }

    public function borrar_foto() {
        $this->image = '';
    }
}

