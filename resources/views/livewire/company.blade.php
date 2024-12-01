<div class="container">


    <div class="row">

        <button type="button" class="btn btn-md btn-success ml-auto " wire:click="update" >
            <i class="far fa-save"></i> Grabar
        </button>

        <div class="col-md-12">
            <div class="form-group">
            <label for="title">Nombre</label>
            <input type="text" class="form-control" wire:model="name" required>
            @error('name')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

    </div>

    <div class="row">
        
        <div class="col-md-9">
            <div class="form-group">
            <label for="title">Email</label>
            <input type="text" class="form-control" wire:model="email" required>
            @error('email')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label for="title">RNC</label>
            <input type="text" class="form-control" wire:model="rfc" required>
            @error('rfc')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

    </div>

    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" wire:model="website">
            @error('website') 
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-12">
            <div class="form-group">
            <label for="title">Direccion</label>
            <textarea class="form-control" wire:model="address" rows="3" required></textarea>
            @error('address')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
            <label for="city">Ciudad</label>
            <input type="text" class="form-control" wire:model="city">
            @error('city')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <label for="state">Estado</label>
            <input type="text" class="form-control" wire:model="state">
            @error('state')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
            <label for="zip">Codigo Postal</label>
            <input type="text" class="form-control" wire:model="zip">
            @error('zip')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>

    </div>

    <div class="row">
        
        <div class="col-md-6">
            <div class="form-group">
            <label for="title">Pais</label>
            <input type="text" class="form-control" wire:model="country" required>
            @error('country')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
            <label for="title">Telefono</label>
            <input type="text" class="form-control" wire:model="phone" required>
            @error('phone')
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