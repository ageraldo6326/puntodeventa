<!-- Modal Nuevo -->
<div class="modal fade" id="newProduct" tabindex="-1" wire:ignore.self data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i Nuevo producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
              <div class="col-md-10">
                  <div class="form-group">
                  <label for="title">Titulo</label>
                  <input type="text" class="form-control" wire:model="title" required>
                  @error('title')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                <label for="code">Codigo</label>
                <input type="text" class="form-control" wire:model="code" required>
                @error('code')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" wire:model="description" rows="3" required></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
                </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-6">

                <div class="form-group">
                    <label for="price">Categoría</label>
                    <select class="custom-select custom-select mb-3" wire:model="category_id" required>
                        <option selected>Selecionar categoría</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>                      
                    @enderror
                </div>  

            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="price">Unidad</label>
                <input type="text" class="form-control" wire:model="unit">
                @error('brand_id')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
                </div>    
            </div>

 

          </div> 
          
          <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                <label for="price">Precio</label>
                <input type="text" class="form-control" wire:model="price">
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>    
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                <label for="price">Stock</label>
                <input type="text" class="form-control" wire:model="stock">
                @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>  
            </div> 

          </div>
            
          <div class="row">


            <div class="col-md-6">

              <div
              x-data="{ isUploading: false, progress: 0 }"
              x-on:livewire-upload-start="isUploading = true"
              x-on:livewire-upload-finish="isUploading = false"
              x-on:livewire-upload-error="isUploading = false"
              x-on:livewire-upload-progress="progress = $event.detail.progress"
              >

              <div class="form-group custom-file">
                  <input type="file" class="custom-file-input" wire:model.lazy='image'>
                  <label class="custom-file-label" for="customFile">Seleccione foto</label>
                  @error('foto') <span class="error">{{ $message }}</span> @enderror
              </div>
              
                  <!-- Progress Bar -->
                  <div x-show="isUploading" class="m-2" >
                      <div x-text="progress + '%'"></div>
                      <progress min="1" max="100" x-bind:value="progress" style="height: 25px"></progress>
                  </div>
              </div>              
                 
            </div>

            <div class="row">

            <div class="form-group">

              @if($image && !(is_string($image)))
              <img class="img-fluid img-thumbnail mt-4" width="300px" wire:model.lazy='image' src="{{ $image->temporaryUrl() }}">
              <p class="text-left">
                  <button type="button" class="btn btn-xs btn-danger m-1 " width="10px" wire:click='borrar_foto' >
                      <i class="fa fa-trash"></i>
                  </button>
              </p>
              @else
                  @if ($image)
                  <img class="img-fluid img-thumbnail mt-4" width="300px" wire:model.lazy='image' src="{{ asset('storage/'.$image) }}">
                  <p class="text-left">
                      <button type="button" class="btn btn-xs btn-danger m-1 " width="10px" wire:click='borrar_foto' >
                          <i class="fa fa-trash"></i>
                      </button>
                  </p>        
                  @endif
              @endif

            </div> 

            </div>
          </div>
            
        </div> 

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetForm()">Cerrar</button>
          <button type="button" class="btn btn-primary" wire:click="store">Grabar</button>
        </div>

      </div>
    </div>
</div>

<!-- Modal Editar -->

<div class="modal fade" id="editProduct" tabindex="-1" wire:ignore.self data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> Editar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h2>ID: {{ $id}}</h2>
          </div>
        </div>
        <div class="row">
              <div class="col-md-10">
                  <div class="form-group">
                  <label for="title">Titulo</label>
                  <input type="text" class="form-control" wire:model.live="title" required>
                  @error('title')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
                  </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                <label for="code">Codigo</label>
                <input type="text" class="form-control" wire:model="code" required>
                @error('code')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

        </div>

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
              <label for="description">Descripción</label>
              <textarea class="form-control" wire:model="description" rows="3" required></textarea>
              @error('description')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
              </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-4">

              <div class="form-group">
                  <label for="price">Categoría</label>
                  <select class="custom-select custom-select mb-3" wire:model="category_id" required>
                      <option selected>Selecionar categoría</option>
                      @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                  </select>
                  @error('category_id')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
              </div>  
            

          </div>  
          
          <div class="col-md-2">
            <div class="form-group">
            <label for="price">Unidad</label>
            <input type="text" class="form-control" wire:model="unit">
            @error('brand_id')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>    
          </div>          

          <div class="col-md-3">
              <div class="form-group">
              <label for="price">Precio</label>
              <input type="text" class="form-control" wire:model="price">
              @error('price')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>    
          </div>
          
          <div class="col-md-3">
              <div class="form-group">
              <label for="price">Stock</label>
              <input type="text" class="form-control" wire:model="stock">
              @error('stock')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>  
          </div> 
        
        
        
        
        </div>
          
        <div class="row">


          <div class="col-md-6">

            <div
            x-data="{ isUploading: false, progress: 0 }"
            x-on:livewire-upload-start="isUploading = true"
            x-on:livewire-upload-finish="isUploading = false"
            x-on:livewire-upload-error="isUploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress"
            >

            <div class="form-group custom-file">
                <input type="file" class="custom-file-input" wire:model.lazy='image'>
                <label class="custom-file-label" for="customFile">Seleccione foto</label>
                @error('foto') <span class="error">{{ $message }}</span> @enderror
            </div>
            
                <!-- Progress Bar -->
                <div x-show="isUploading" class="m-2" >
                    <div x-text="progress + '%'"></div>
                    <progress min="1" max="100" x-bind:value="progress" style="height: 25px"></progress>
                </div>
            </div>
               

          </div>

          <div class="col-md-6">

              @if($image && !(is_string($image)))
              <img class="img-fluid img-thumbnail mt-4" width="300px" wire:model.lazy='image' src="{{ $image->temporaryUrl() }}">
              <p class="text-left">
                  <button type="button" class="btn btn-xs btn-danger m-1 " width="10px" wire:click='delete_image' >
                      <i class="fa fa-trash"></i>
                  </button>
              </p>
              @else
                  @if ($image)
                  <img class="img-fluid img-thumbnail mt-4" width="300px" wire:model.lazy='image' src="{{ asset('storage/'.$image) }}">
                  <p class="text-left">
                      <button type="button" class="btn btn-xs btn-danger m-1 " width="10px" wire:click='delete_image' >
                          <i class="fa fa-trash"></i>
                      </button>
                  </p>        
                  @endif
              @endif

          </div>

        </div>
          
      </div> 

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetForm()">Cerrar</button>
        <button type="button" class="btn btn-primary" wire:click="update()">Grabar</button>
      </div>

    </div>
  </div>
</div>



<!-- Modal View -->
<div class="modal fade" id="viewProduct" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="viewProduct" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-eye"></i> Ver producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h2>ID: {{ $id}}</h2>
          </div>
        </div>
        <div class="row">
              <div class="col-md-10">
                  <div class="form-group">
                  <label for="title">Titulo</label>
                  {{ $title }}
                  @error('title')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
                </div>
              </div>

              <div class="col-md-10">
                <div class="form-group">
                <label for="title">Codigo</label>
                {{ $code }}
                @error('title')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>              
        </div>

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
              <label for="description">Descripción</label>
              {{ $description }}
              @error('description')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
              </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-4">

              <div class="form-group">
                  <label for="price">Categoría</label>
                  {{ $category_name }}
              </div>  

          </div>

          <div class="col-md-2">

            <div class="form-group">
                <label for="price">Unidad</label>
                {{ $unit }}
            </div>  

        </div>          
        

          <div class="col-md-3">
              <div class="form-group">
              <label for="price">Precio</label>
              {{ $price }}
              </div>    
          </div>
          
          <div class="col-md-3">
              <div class="form-group">
              <label for="price">Stock</label>
              {{ $stock }}
              </div>  
          </div> 
        </div>
          
        <div class="row">

          <div class="col-md-6 text-center">

              @if($image && !(is_string($image)))
              <img class="img-fluid text-center mt-4" width="300px" wire:model.lazy='image' src="{{ $image->temporaryUrl() }}">
              @else
                  @if ($image)
                  <img class="img-fluid text-center mt-4" width="300px" wire:model.lazy='image' src="{{ asset('storage/'.$image) }}">        
                  @endif
              @endif

          </div>

        </div>
          
      </div> 

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetForm()">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<script>   
    document.addEventListener('close-modalnewProduct', event => {
        $('#newProduct').modal('hide');
    });  

</script> 

<script>   
  document.addEventListener('close-modaleditProduct', event => {
      $('#editProduct').modal('hide');
  });  

</script> 

<script>   
  document.addEventListener('close-modalviewProduct', event => {
      $('#viewProduct').modal('hide');
  });  

</script> 