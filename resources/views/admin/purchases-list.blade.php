@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>Compras</h1>
@stop

@section('content')
    @livewire('purchases-list')
@stop

@section('css')

@stop

@section('js')

<script>

document.addEventListener('newProviderSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Proveedor Agregado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updateProviderSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Proveedor Actualizado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deleteInvoiceSweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar esta Factura ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Factura Eliminada Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deleteInvoice',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop