@extends('adminlte::page')

@section('title', 'Cotizaciones')

@section('content_header')
    <h1>Cotizaciones</h1>
@stop

@section('content')
    @livewire('quotes-list')
@stop

@section('css')

@stop

@section('js')

<script>

document.addEventListener('newQuoteSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Proveedor Agregado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updateQuoteSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Proveedor Actualizado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deleteQuoteSweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar esta Cotizacion ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Cotizacion Eliminado Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deleteQuote',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop