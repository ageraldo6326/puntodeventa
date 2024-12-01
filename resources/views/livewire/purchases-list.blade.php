<div>
    <div class="container-fluid mt-4">

        <div class="card shadow-lg">            
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> <input type="text" class="form-control" placeholder="Buscar..." wire:model.live.debounce.250ms="search"></h5>
                <!-- Botón para crear un nuevo producto -->
            
                <a href="{{ route('admin.purchase-new') }}" class="btn btn-md btn-success ml-auto ">
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
                            <th scope="col">Proveedor</th>
                            <th scope="col">Usuario</th>
                            <th scope="col" class="text-left">Total</th>
                            <th scope="col">Estatus</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <th scope="row">{{ $purchase->id }}</th>
                                <td>{{ $purchase->purchase_date }}</td>
                                <td> 
                                    @if ($purchase->provider->company!='')

                                        {{  $purchase->provider->company}}

                                    @else   
                                    
                                        {{  $purchase->provider->company }}

                                    @endif

                                </td>
                                <td>{{ $purchase->user->name }}</td>
                                <td class="text-left">{{ number_format($purchase->total, 2) }}</td>
                                <td>{{ $purchase->status }}</td>
                                <td class="text-right w-25">
                                    <!-- Iconos de ver, actualizar y borrar -->

                                    
                                    <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="generatePurchase({{ $purchase->id }})">
                                        <i class="far fa-file-pdf"></i>
                                    </button>
                                    <form action="{{ route('admin.showpurchase', $purchase->id) }}" method="GET" style="display:inline-block;">
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.editPurchase', $purchase->id) }}" class="btn btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deletePurchaseSweetalert',{{ $purchase->id }})" data-element-id="{{ $purchase->id }}"
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
                @if($purchases->isEmpty())
                    <p class="text-center">No hay facturas disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>   
</div>
