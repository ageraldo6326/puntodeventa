<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comprobantes;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Ncf extends Component
{
    public $id, $serie, $iniciosecuencia, $finsecuencia, $fechaemision, $fechaexpiracion, $ultsecuencia, $fechaultsecuencia,
    $tipo, $estado;

    use WithPagination, WithFileUploads;
    public function render()
    {
        $ncfs = Comprobantes::Paginate(10);
        return view('livewire.ncf', compact('ncfs'));
    }

    public function edit($id) {
        $comprobante = Comprobantes::where('id',$id)->first();
        $this->id = $comprobante->id;
        $this->serie = $comprobante->serie;
        $this->iniciosecuencia = $comprobante->iniciosecuencia;
        $this->finsecuencia = $comprobante->finsecuencia;
        $this->fechaemision = $comprobante->fechaemision;
        $this->fechaexpiracion = $comprobante->fechaexpiracion;
        $this->ultsecuencia = $comprobante->ultsecuencia;
        $this->fechaultsecuencia = $comprobante->fechaultsecuencia;
        $this->tipo = $comprobante->tipo;
        $this->estado = $comprobante->estado;
        
    }

    public function updating(){
        $this->resetPage();
    }

    #[On('resetForm')]
    public function resetForm(){
        $this->reset();
    }
      
    #[On('store')]
    public function store(){

        $this->validate([
            'serie' => 'required',
            'iniciosecuencia' => 'required',
            'finsecuencia' => 'required',
            'fechaemision' => 'required',
            'fechaexpiracion' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
        ]);

        $comprobante = new Comprobantes();
        $comprobante->serie = $this->serie;
        $comprobante->iniciosecuencia = $this->iniciosecuencia;
        $comprobante->finsecuencia = $this->finsecuencia;
        $comprobante->fechaemision = $this->fechaemision;
        $comprobante->fechaexpiracion = $this->fechaexpiracion;
        $comprobante->ultsecuencia = $this->ultsecuencia;
        $comprobante->fechaultsecuencia = $this->fechaultsecuencia;
        $comprobante->tipo = $this->tipo;
        $comprobante->estado = $this->estado;

        $comprobante->save();

        $this->reset();
        $this->dispatch('close-modalnewNCF');
        $this->dispatch('newNCFSweetalert');
    }

    public function update(){
        $this->validate([
            'serie' => 'required',
            'iniciosecuencia' => 'required',
            'finsecuencia' => 'required',
            'fechaemision' => 'required',
            'fechaexpiracion' => 'required',
            'tipo' => 'required',
            'estado' => 'required',
        ]);

        $comprobante = Comprobantes::find($this->id);
        $comprobante->serie = $this->serie;
        $comprobante->iniciosecuencia = $this->iniciosecuencia;
        $comprobante->finsecuencia = $this->finsecuencia;
        $comprobante->fechaemision = $this->fechaemision;
        $comprobante->fechaexpiracion = $this->fechaexpiracion;
        $comprobante->ultsecuencia = $this->ultsecuencia;
        $comprobante->fechaultsecuencia = $this->fechaultsecuencia;
        $comprobante->tipo = $this->tipo;
        $comprobante->estado = $this->estado;

        $comprobante->save();

        $this->dispatch('close-modaleditNCF');

        $this->reset(); 
        $this->dispatch('updateNCFSweetalert');
    }


    public function view($id){
        $comprobante = Comprobantes::find($id);
        $this->id = $comprobante->id;
        $this->serie = $comprobante->serie;
        $this->iniciosecuencia = $comprobante->iniciosecuencia;
        $this->finsecuencia = $comprobante->finsecuencia;
        $this->fechaemision = $comprobante->fechaemision;
        $this->fechaexpiracion = $comprobante->fechaexpiracion;
        $this->ultsecuencia = $comprobante->ultsecuencia;
        $this->fechaultsecuencia = $comprobante->fechaultsecuencia;
        $this->tipo = $comprobante->tipo;
        $this->estado = $comprobante->estado;
    }

    #[On('deleteNCF')]
    function deleteNcf($id){
        $comprobante = Comprobantes::find($id);
        
        $comprobante->delete();

        session()->flash('delete', 'Secuencia de NCF ha sido eliminado correctamente!');    
    }

    
}
