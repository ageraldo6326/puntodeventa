<html>
	<head>
		<meta charset="UTF-8">
		<title>Factura: {{ $purchase->id }}</title>

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
	</head>
<body>

    
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="5">
                    <table>
                        <tr>
                            <td class="">
                                <h1>Factura de compra</h1>
                            </td>
                            <td>
                                Factura #: {{ $purchase->id }}<br />
                                NCF: {{ $purchase->nif }}<br />
                                Fecha de pago: {{ $purchase->paid_date }}<br />
                                Vencimiento: {{ $purchase->due_date }}<br />
                                Status: {{ $purchase->status }}
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
                                @if ($purchase->provider->address)
                                {{ $company->address }}<br />
                                @endif
                                RNC:{{ $company->rfc }}<br />
                                FECHA: {{ $purchase->purchase_date }}<br />
                                {{ $company->email }}
                            </td>
                            <td>
                                {{ $company->name }}<br />
                                {{ $purchase->user->name }}<br />
                                {{ $purchase->user->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>RNC PROVEEDOR:</strong> {{ $purchase->provider->rfc }}<br />
                                <strong>NOMBRE O RAZON SOCIAL PROVEEDOR:</strong> {{ $purchase->provider->company }}<br />
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
                <td>{{ $purchase->payment_method }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $purchase->transaction_id }}</td>
            </tr>
    
            <tr class="heading">
                <td>Item</td>
    
                <td style="text-align: left">Descripción</td>
    
                <td>Precio</td>
    
                <td>Cant</td>
    
                <td style="text-align: right">Total</td>
            </tr>
    
            @foreach ( $purchase_details as $item )
    
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
                <td colspan="4">Sub Total: ${{ number_format($purchase->subtotal, 2) }}</td>
            </tr>
    
            <tr class="total">
                <td></td>
                <td colspan="4">ITBS: ${{ number_format($purchase->tax_itbs, 2) }}</td>
            </tr>
    
            <tr class="total">
                <td></td>
                <td colspan="4">Total: ${{ number_format($purchase->total, 2) }}</td>
            </tr>
        </table>
    </div>
</body>