<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Cotización: {{ $quote->id }}</title>

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
								@php
									$path = public_path('/storage/' . $company->logo);
									$imageData = base64_encode(file_get_contents($path)); // Convierte la imagen a Base64
									$src = 'data:image/png;base64,' . $imageData; // Agrega el prefijo para el tipo de imagen
								@endphp

									<img src="{{ $src }}" style="width: 100%; max-width: 300px" alt="Logo en Base64"/>
									<h1>Cotización</h1>
								</td>
								<td>
									Cotización #: {{ $quote->id }}<br />
									Creada: {{ $quote->date }}<br />
									Fecha de Vecimiento: {{ $quote->due_date }}
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
									{{ $quote->customer->company }}<br />
									{{ $quote->customer->address }}<br />
									{{ $quote->customer->email }}
								</td>
								<td>
									{{ $quote->user->company }}<br />
									{{ $quote->user->name }}<br />
									{{ $quote->user->email }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Método de Pago</td>
					<td></td>
					<td></td>
					<td></td>
					<td>Trans #</td>
				</tr>

				<tr class="details">
					<td>{{ $quote->payment_method }}</td>
					<td></td>
					<td></td>
					<td></td>
					<td>{{ "Pendiente" }}</td>
				</tr>

				<tr class="heading">
					<td>Item</td>

					<td style="text-align: left">Descripción</td>

					<td>Precio</td>

					<td>Cant</td>

					<td>Total</td>
				</tr>

				@foreach ( $quote_details as $item )

				<tr class="item">
					<td> {{ $item->product->title }}</td>

					<td style="text-align: left"> {{ $item->product->description }}</td>

					<td>{{ number_format($item->price, 2) }}</td>

					<td>{{ number_format($item->quantity, 0) }}</td>

					<td>{{ number_format($item->total_price, 2) }}</td>
				</tr>
					
				@endforeach
					
				<tr class="total">
					<td></td>
					<td colspan="4">Sub Total: ${{ number_format($quote->subtotal, 2) }}</td>
				</tr>

				<tr class="total">
					<td></td>
					<td colspan="4">ITBS: ${{ number_format($quote->tax_itbs, 2) }}</td>
				</tr>

				<tr class="total">
					<td></td>
					<td colspan="4">Total: ${{ number_format($quote->total, 2) }}</td>
				</tr>
			</table>
		</div>
	</body>
</html>