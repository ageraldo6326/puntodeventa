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
                <button type="button" class="btn btn-md btn-success ml-auto " data-toggle="modal" data-target="#newCategory" >
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
                            <th scope="col">Categoría</th>
                            <th scope="col" class="text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td class="text-right w-25">
                                    <!-- Iconos de ver, actualizar y borrar -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewCategory"
                                        wire:click="view({{ $category->id }})">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCategory"
                                        wire:click="edit({{ $category->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteCategorySweetalert',{{ $category->id }})" data-element-id="{{ $category->id }}"
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
                @if($categories->isEmpty())
                    <p class="text-center">No hay categorias disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $categories->links() }}
            </div>
        </div>
    </div>   
    @include('modal.modalCategories') 
</div>

