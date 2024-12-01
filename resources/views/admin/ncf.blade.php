@extends('adminlte::page')

@section('title', 'Secuencia NCF')

@section('content_header')
    <h1>Número de Comprobante Fiscal</h1>
@stop

@section('content')
    @livewire('ncf')
@stop

@section('css')

@stop

@section('js')

<script>

document.addEventListener('newNCFSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Secuencia de NCF Agregado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updateNCFSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Secuencia de NCF Actualizado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deleteSecuenciaSweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar esta Secuencia ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Secuencia de NCF Eliminado Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deleteNCF',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop