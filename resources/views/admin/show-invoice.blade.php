@extends('adminlte::page')

@section('title', 'Ver Factura')

@section('content_header')
    <h1>Ver Factura</h1>
@stop

@section('content')
<div class="text-right mt-3">
    <a href="{{ route('admin.invoices-list') }}" class="btn btn-success"><i class="fas fa-arrow-left"></i> Regresar</a>
    <a href="{{ route('admin.generateinvoice', $invoice->id) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</a>
</div>

<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="5">
                <table>
                    <tr>
                        <td class="">
                            @php
                                $path = public_path('/storage/' . $company->logo);
                                $imageData = base64_encode(file_get_contents($path)); // Convierte la imagen a Base64
                                $src = 'data:image/png;base64,' . $imageData; // Agrega el prefijo para el tipo de imagen
                            @endphp

                            <img src="{{ $src }}" style="width: 100%; max-width: 300px" alt="Logo en Base64"/>
                            <h1>Factura</h1>
                        </td>
                        <td>
                            Factura #: {{ $invoice->id }}<br />
                            NCF: {{ $invoice->nif }}<br />
                            Fecha de pago: {{ $invoice->paid_date }}<br />
                            Vencimiento: {{ $invoice->due_date }}<br />
                            Status: {{ $invoice->status }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="5">
                <table>
                    <tr>
                        <td>
                            <strong>{{ $company->name }}</strong><br />
                            @if ($invoice->customer->address)
                            {{ $company->address }}<br />
                            @endif
                            RNC:{{ $company->rfc }}<br />
                            FECHA: {{ $invoice->date }}<br />
                            {{ $company->email }}
                        </td>
                        <td>
                            {{ $company->name }}<br />
                            {{ $invoice->user->name }}<br />
                            {{ $invoice->user->email }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>RNC CLIENTE:</strong> {{ $invoice->customer->rfc }}<br />
                            <strong>NOMBRE O RAZON SOCIAL:</strong> {{ $invoice->customer->company }}<br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Forma de pago</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Trans #</td>
        </tr>

        <tr class="details">
            <td>{{ $invoice->payment_method }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $invoice->transaction_id }}</td>
        </tr>

        <tr class="heading">
            <td>Item</td>

            <td style="text-align: left">Descripción</td>

            <td>Precio</td>

            <td>Cant</td>

            <td style="text-align: right">Total</td>
        </tr>

        @foreach ( $invoice_details as $item )

        <tr class="item">
            <td> {{ $item->product->title }}</td>

            <td style="text-align: left"> {{ $item->product->description }}</td>

            <td>{{ number_format($item->price, 2) }}</td>

            <td>{{ number_format($item->quantity, 0) }}</td>

            <td style="text-align: right">{{ number_format($item->total_price, 2) }}</td>
        </tr>
            
        @endforeach
            
        <tr class="total">
            <td></td>
            <td colspan="4">Sub Total: ${{ number_format($invoice->subtotal, 2) }}</td>
        </tr>

        <tr class="total">
            <td></td>
            <td colspan="4">ITBS: ${{ number_format($invoice->tax_itbs, 2) }}</td>
        </tr>

        <tr class="total">
            <td></td>
            <td colspan="4">Total: ${{ number_format($invoice->total, 2) }}</td>
        </tr>
    </table>
</div>



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
@stop

@section('js')

<script>

document.addEventListener('newProductSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Producto Agregado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('updateProductSweetalert', () => {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Producto Actualizado Exitosamente",
        showConfirmButton: false,
        timer: 1500
    });
})

document.addEventListener('livewire:init', () => {
       Livewire.on('deleteProductSweetalert', (id) => {
            
            Swal.fire({
            title: 'Realmente desea borrar este Producto ' + id + '?',
            showCancelButton: true,
            cancelButtonText: `Cancelar`,
            confirmButtonText: 'Borrar',
            cancelButtonColor: "#3085d6",
            confirmButtonColor: "#d33",
            }).then((result) => {
                if (result.value==true) {
                    Swal.fire({
                    position: "top-end",
                    title: "Producto Eliminado Exitosamente",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                    });                
                    Livewire.dispatch('deleteProduct',{id:id});
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            }) 
           
       });
});    

</script>
    
@stop