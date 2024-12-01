<div>
    <div class="container-fluid mt-4">

        <div class="card shadow-lg">            
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> <input type="text" class="form-control" placeholder="Buscar..." wire:model.live.debounce.250ms="search"></h5>
                <!-- Botón para crear un nuevo producto -->
            
                <a href="{{ route('admin.invoice-new') }}" class="btn btn-md btn-success ml-auto ">
                    <i class="far fa-file"></i> Nuevo
                </a>
            </div>
            <div class="card-body">
                <!-- Tabla de productos -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Vendedor</th>
                            <th scope="col" class="text-left">Total</th>
                            <th scope="col">Estatus</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                            <tr>
                                <th scope="row">{{ $invoice->id }}</th>
                                <td>{{ $invoice->date }}</td>
                                <td> 
                                    @if ($invoice->customer->company!='')

                                        {{  $invoice->customer->company}}

                                    @else   
                                    
                                        {{  $invoice->customer->name . " " . $invoice->customer->lastname}}

                                    @endif

                                </td>
                                <td>{{ $invoice->user->name }}</td>
                                <td class="text-left">{{ number_format($invoice->total, 2) }}</td>
                                <td>{{ $invoice->status }}</td>
                                <td class="text-right w-25">
                                    <!-- Iconos de ver, actualizar y borrar -->

                                    
                                    <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="generateInvoice({{ $invoice->id }})">
                                        <i class="far fa-file-pdf"></i>
                                    </button>
                                    <form action="{{ route('admin.showinvoice', $invoice->id) }}" method="GET" style="display:inline-block;">
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.editInvoice', $invoice->id) }}" class="btn btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteInvoiceSweetalert',{{ $invoice->id }})" data-element-id="{{ $invoice->id }}"
                                        >
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                
                <!-- Mensaje si no hay productos -->
                @if($invoices->isEmpty())
                    <p class="text-center">No hay facturas disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>   
</div>
