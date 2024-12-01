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
                <button type="button" class="btn btn-md btn-success ml-auto " data-toggle="modal" data-target="#newProvider" >
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
                        @foreach($providers as $provider)
                            <tr>
                                <th scope="row">{{ $provider->id }}</th>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->lastname }}</td>
                                <td>{{ $provider->company }}</td>
                                <td>{{ $provider->phone }}</td>
                                <td>{{ $provider->whatsapp }}</td>
                                <td>{{ $provider->email }}</td>
                                <td>@switch($provider->status)
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
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProvider"
                                        wire:click="view({{ $provider->id }})">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProvider"
                                        wire:click="edit({{ $provider->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteProviderSweetalert',{{ $provider->id }})" data-element-id="{{ $provider->id }}"
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
                @if($providers->isEmpty())
                    <p class="text-center">No hay proveedores disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $providers->links() }}
            </div>
        </div>
    </div>   
    @include('modal.modalProviders') 
</div>
