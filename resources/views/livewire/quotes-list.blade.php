<div>
    <div class="container-fluid mt-4">

        <div class="card shadow-lg">            
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> <input type="text" class="form-control" placeholder="Buscar..." wire:model.live.debounce.250ms="search"></h5>
                <!-- Botón para crear un nuevo producto -->
            
                <a href="{{ route('admin.quote-new') }}" class="btn btn-md btn-success ml-auto ">
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
                        @foreach($quotes as $quote)
                            <tr>
                                <th scope="row">{{ $quote->id }}</th>
                                <td>{{ $quote->date }}</td>
                                <td> 
                                    @if ($quote->customer->company!='')

                                        {{  $quote->customer->company}}

                                    @else   
                                    
                                        {{  $quote->customer->name . " " . $quote->customer->lastname}}

                                    @endif

                                </td>
                                <td>{{ $quote->user->name }}</td>
                                <td class="text-left">{{ number_format($quote->total, 2) }}</td>
                                <td>{{ $quote->status }}</td>
                                <td class="text-right w-25">
                                    <!-- Iconos de ver, actualizar y borrar -->
   
                                    <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="generateQuote({{ $quote->id }})">
                                        <i class="far fa-file-pdf"></i>
                                    </button>
                                    <form action="{{ route('admin.showquote', $quote->id) }}" method="GET" style="display:inline-block;">
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="far fa-eye"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.editQuote', $quote->id) }}" class="btn btn-warning btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteQuoteSweetalert',{{ $quote->id }})" data-element-id="{{ $quote->id }}"
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
                @if($quotes->isEmpty())
                    <p class="text-center">No hay facturas disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $quotes->links() }}
            </div>
        </div>
    </div>   
</div>
