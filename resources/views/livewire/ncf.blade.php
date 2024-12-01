<div>
    <div class="container-fluid mt-4">


        <div class="card shadow-lg">            
            <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                <h5 class="mb-0"> <input type="text" class="form-control" placeholder="Buscar..." wire:model.live.debounce.250ms="search"></h5>
                <!-- Botón para crear un nuevo producto -->
                <button type="button" class="btn btn-md btn-success ml-auto " data-toggle="modal" data-target="#newSecuencia" >
                    <i class="far fa-file"></i> Nuevo
                </button>
                <button type="button" class="btn btn-md btn-danger m-1" wire:click="pdf()">
                    <i class="far fa-file-pdf"></i> PDF
                </button>
            </div>
            <div class="card-body">
                <!-- Tabla de Categorias -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Serie</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Inicio</th>
                            <th scope="col">Fin</th>
                            <th scope="col">Fecha Emisión</th>
                            <th scope="col">Fecha Expiración</th>
                            <th scope="col">Estado</th>
                            <th scope="col" class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ncfs as $ncf)
                            <tr>
                                <th scope="row">{{ $ncf->id }}</th>
                                <td>{{ $ncf->serie }}</td>
                                <td>{{ $ncf->tipo }}</td>
                                <td>{{ $ncf->iniciosecuencia }}</td>
                                <td>{{ $ncf->finsecuencia }}</td>
                                <td>{{ $ncf->fechaemision }}</td>
                                <td>{{ $ncf->fechaexpiracion }}</td>
                                <td>{{ $ncf->estado }}</td>

                                <td class="text-right">
                                    <!-- Iconos de ver, actualizar y borrar -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewSecuencia"
                                        wire:click="view({{ $ncf->id }})">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSecuencia"
                                        wire:click="edit({{ $ncf->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteSecuenciaSweetalert',{{ $ncf->id }})" data-element-id="{{ $ncf->id }}"
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
                @if($ncfs->isEmpty())
                    <p class="text-center">No hay categorias disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $ncfs->links() }}
            </div>
        </div>
    </div>   
    @include('modal.modalNCF') 
</div>


