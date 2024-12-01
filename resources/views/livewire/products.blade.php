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
                <button type="button" class="btn btn-md btn-success ml-auto " data-toggle="modal" data-target="#newProduct" >
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
                            <th scope="col">Codigo</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Categoría</th>
                            <th scope="col" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->code }}</td>
                                <td>{{ $product->title }}</td>
                                <td >{{ $product->description }}</td>
                                <td>${{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if ($product->image)
                                    <img src="{{ '/storage/' . $product->image }}" alt="{{ $product->title }}" width="200" height="150" class="img-fluid">
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                                <td class="text-right w-25">
                                    <!-- Iconos de ver, actualizar y borrar -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProduct"
                                        wire:click="view({{ $product->id }})">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProduct"
                                        wire:click="edit({{ $product->id }})">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" 
                                        wire:click="$dispatch('deleteProductSweetalert',{{ $product->id }})" data-element-id="{{ $product->id }}"
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
                @if($products->isEmpty())
                    <p class="text-center">No hay productos disponibles.</p>
                @endif
            </div>
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        </div>
    </div>   
    @include('modal.modalProducts') 
</div>
