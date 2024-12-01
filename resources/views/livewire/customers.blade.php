<div>
    <div class="container-fluid mt-4">

        {{-- @if (session('new'))
            <div class="alert alert-success">{{ session('new') }}</div>                
        @endif

        @if (session('update'))
            <div class="alert alert-info">{{ session('update') }}</div>                
        @endif

        @if (session('delete'))
            <div class="alert alert-danger">{{ session('delete') }}</div>                
        @endif  --}}

        <!-- Card para los productos -->
        <div class="card shadow-lg">            
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> <input type="text" class="form-control" placeholder="Buscar..." wire:model.live.debounce.250ms="search"></h5>
                <!-- Botón para crear un nuevo producto -->
                <button type="button" class="btn btn-md btn-success ml-auto " data-toggle="modal" data-target="#newCustomer" >
                    <i class="far fa-file"></i> Nuevo
                </button>
                <button type="button" class="btn btn-md btn-danger m-1" wire:click="pdf()">
                    <i class="far fa-file-pdf"></i> PDF
                </button>
            </div>
            <div class="card-body">
                <!-- Tabla de productos -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Compañia</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Whatsapp</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <th scope="row">{{ $customer->id }}</th>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->lastname }}</td>
                                <td>{{ $customer->company }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->whatsapp }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>@switch($customer->status)
                                    @case(0)
                                    {{ 'Inactivo' }}    
                                    @break

                                    @case(1)
                                    {{ 'Activo' }}    
                                    @break
                                
                                    @default
                                        
                                @endswitch</td>
                                <td class="text-right w-25">
                                    <!-- Iconos de ver, actualizar y borrar -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewCustomer"
                                        wire:click="view({{ $customer->id }})">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCustomer"
                                        wire:click="edit({{ $customer->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteCustomerSweetalert',{{ $customer->id }})" data-element-id="{{ $customer->id }}"
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
                @if($customers->isEmpty())
                    <p class="text-center">No hay productos disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $customers->links() }}
            </div>
        </div>
    </div>   
    @include('modal.modalCustomers') 
</div>
