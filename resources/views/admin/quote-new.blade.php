@extends('adminlte::page')

@section('title', 'Cotización')

@section('content_header')
    <h1>Cotización</h1>
@stop

@section('content')
    @livewire('quote-new')
@stop

@section('css')

<style>
    /* Cambiar el alto del campo de selección */
    .select2-container .select2-selection--single {
        height: 40px; /* Cambiar altura */
        display: flex;
        align-items: center;
    }
    
    /* Cambiar el texto dentro del campo */
    .select2-container .select2-selection__rendered {
        line-height: 200px; /* Igualar al alto */
    }
    
    /* Ajustar ícono del botón desplegable */
    .select2-container .select2-selection__arrow {
        height: 200px;
    }
    
    /* Cambiar opciones del menú desplegable */
    .select2-container .select2-results__option {
        padding: 5px;
        height: auto;
    }
</style>
    

@stop
@section('js')


<script>

document.addEventListener('livewire:init', function () {
    $('#product-select').select2({
        templateResult: function (data) {
            // Ignorar el primer elemento: si el ID es vacío, mostrar solo el texto
            if (data.id == "-- Producto --" || data.id == null) {
                return $('<span>-- Producto --</span>'); // Solo el texto "-- Producto --"
            } else {

            // Para otros elementos, mostrar imagen y texto
            const image = $(data.element).data('image');
            return $(`<span><img src="${image}" style="width: 50px; margin-right: 10px;"><br> ${data.text}</span>`);
            }
        },
        templateSelection: function (data) {
            // console.log(data);
            // Ignorar el primer elemento: si el ID es vacío, mostrar solo el texto
            if (data.id=="-- Producto --" || data.id==null) {
                return `${data.text}`; // Solo el texto "-- Producto --"
            } else {
                
            // Para otros elementos, mostrar imagen y texto
                const image = $(data.element).data('image');
                return $(`<span><img src="${image}" style="width: 20px; height: 20px; margin-right: 10px;"> ${data.text}</span>`);                
                
            }


        }
    }).on('change', function () {
        Livewire.dispatch('setProduct2',{id: $(this).val()});
    });
});


window.addEventListener('update-select2', event => {

        const productId = event.detail.id;

        // Cambiar la selección en el select2
        $('#product-select').val(productId).trigger('change');
});



document.addEventListener('newQuoteSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Cotización Agregada Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updateQuoteSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Cotización Actualizada Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deleteItemSweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar este Item ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Proveedor Eliminado Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deleteProvider',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop