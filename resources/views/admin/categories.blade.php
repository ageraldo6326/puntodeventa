@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <h1>Categorias</h1>
@stop

@section('content')
    @livewire('categories')
@stop

@section('css')

@stop

@section('js')

<script>

document.addEventListener('newCategorySweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Categoría Agregado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updateCategorySweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Categoría Actualizado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deleteCategorySweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar esta Categoría ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Categoría Eliminado Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deleteCategory',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop