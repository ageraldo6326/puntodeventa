@extends('adminlte::page')

@section('title', 'Editar Factura')

@section('content_header')
    <h1>Editar Factura</h1>
@stop

@section('content')
    @livewire('edit-invoice', ['invoice' => $invoice])
@stop

@section('css')
<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .invoice-box.rtl table {
        text-align: right;
    }

    .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
    }
</style>

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

document.addEventListener('newPurchaseSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Producto Agregado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updatePurchaseSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Producto Actualizado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deletePurchaseSweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar esta Factura de compra ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Factura de compra Eliminada Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deletePurchase',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop