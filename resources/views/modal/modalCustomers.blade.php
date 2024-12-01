<!-- Modal Nuevo -->
<div class="modal fade" id="newCustomer" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="newCustomer" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-file"></i> Nuevo cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="title">Nombre</label>
                    <input type="text" class="form-control" wire:model="name">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>                      
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Apellido</label>
                <input type="text" class="form-control" wire:model="lastname">
                @error('last_name')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>
          </div>          

          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="title">Compañia</label>
                <input type="text" class="form-control" wire:model="company">
                @error('company')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label for="title">RNC</label>
                <input type="text" class="form-control" wire:model="rfc">
                @error('rfc')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>
          </div>          

          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Email</label>
                <input type="email" class="form-control" wire:model="email">
                @error('email')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Password</label>
                <input type="text" class="form-control" wire:model="password">
                @error('password')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>
          </div>          
          
          
          <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Telefono</label>
                <input type="text" class="form-control" wire:model="phone">
                @error('phone')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Whatsapp</label>
                <input type="email" class="form-control" wire:model="whatsapp">
                @error('whatsapp')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>
          </div>          

          <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                    <label for="title">Dirección</label>
                    <input type="text" class="form-control" wire:model="address">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>                      
                    @enderror
                  </div>
                </div>

          </div>

          <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                <label for="price">Ciudad</label>
                <input type="text" class="form-control" wire:model="city">
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>    
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                <label for="price">Estado / Provincia </label>
                <input type="text" class="form-control" wire:model="state">
                @error('state')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>  
            </div> 

            <div class="col-md-4">
              <div class="form-group">
              <label for="title">Codigo Postal</label>
              <input type="text" class="form-control" wire:model="zip">
                @error('zip')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

          </div>

          <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                <label for="price">Pais</label>
                <input type="text" class="form-control" wire:model="country">
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>    
            </div>

          </div>

          <div class="row">
            
            <div class="col-md-6">
                <div class="form-group">
                <label for="price">Estatus</label>
                <select class="form-control" wire:model="status">
                    <option value="">-- Seleccione --</option>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>  
            </div> 

            <div class="col-md-6">
              <div class="form-group">
                <label for="price">Tipo</label>
                <select class="form-control" wire:model="type">
                    <option value="">-- Seleccione --</option>
                    <option value="1">Empresa</option>
                    <option value="2">Persona Física</option>
                </select>
                @error('type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
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

<div class="modal fade" id="editCustomer" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="editCustomer" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> Editar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                  <label for="title">Nombre</label>
                  <input type="text" class="form-control" wire:model="name">
                  @error('name')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Apellido</label>
              <input type="text" class="form-control" wire:model="lastname">
              @error('last_name')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>
        </div>          

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
              <label for="title">Compañia</label>
              <input type="text" class="form-control" wire:model="company">
              @error('company')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
              <label for="title">RNC</label>
              <input type="text" class="form-control" wire:model="rfc">
              @error('rfc')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>
        </div>        

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Email</label>
              {{ $email }}
              @error('email')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Password</label>
              <input type="text" class="form-control" wire:model="password">
              @error('password')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>
        </div>          
        
        
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Telefono</label>
              <input type="text" class="form-control" wire:model="phone">
              @error('phone')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Whatsapp</label>
              <input type="email" class="form-control" wire:model="whatsapp">
              @error('whatsapp')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>
        </div>          

        <div class="row">

              <div class="col-md-12">
                  <div class="form-group">
                  <label for="title">Dirección</label>
                  <input type="text" class="form-control" wire:model="address">
                  @error('address')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
                </div>
              </div>

        </div>

        <div class="row">

          <div class="col-md-4">
              <div class="form-group">
              <label for="price">Ciudad</label>
              <input type="text" class="form-control" wire:model="city">
              @error('city')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>    
          </div>
          
          <div class="col-md-4">
              <div class="form-group">
              <label for="price">Estado / Provincia </label>
              <input type="text" class="form-control" wire:model="state">
              @error('state')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>  
          </div> 

          <div class="col-md-4">
            <div class="form-group">
            <label for="title">Codigo Postal</label>
            <input type="text" class="form-control" wire:model="zip">
              @error('zip')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-md-12">
              <div class="form-group">
              <label for="price">Pais</label>
              <input type="text" class="form-control" wire:model="country">
              @error('country')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>    
          </div>

        </div>

        <div class="row">
          
          <div class="col-md-6">
              <div class="form-group">
              <label for="price">Estatus</label>
              <select class="form-control" wire:model="status">
                  <option value="">-- Seleccione --</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
              </select>
              @error('status')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div>  
          </div> 

          <div class="col-md-6">
            <div class="form-group">
              <label for="price">Tipo</label>
              <select class="form-control" wire:model="type">
                  <option value="">-- Seleccione --</option>
                  <option value="1">Empresa</option>
                  <option value="2">Persona Física</option>
              </select>
              @error('type')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
              </div> 
          </div>
        </div>
          
      </div> 

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetForm()">Cerrar</button>
        <button type="button" class="btn btn-primary" wire:click="update">Grabar</button>
      </div>

    </div>
  </div>
</div>



<!-- Modal View -->

<div class="modal fade" id="viewCustomer" tabindex="-1" wire:ignore.self data-backdrop="static" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-eye"></i> Editar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                  <label for="title">Nombre</label>
                  {{ $name }}
              </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Apellido</label>
              {{ $lastname }}
            </div>
          </div>
        </div>          

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
              <label for="title">Compañia</label>
              {{ $company }}
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
              <label for="title">RNC</label>
              {{ $rfc }}
            </div>
          </div>
        </div>        

        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Email</label>
              {{ $email }}
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Password</label>
              {{ $password }}
            </div>
          </div>
        </div>          
        
        
        <div class="row">
          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Telefono</label>
              {{ $phone }}
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Whatsapp</label>
              {{ $whatsapp }}
            </div>
          </div>
        </div>          

        <div class="row">

              <div class="col-md-12">
                  <div class="form-group">
                  <label for="title">Dirección</label>
                  {{ $address }}
                </div>
              </div>

        </div>

        <div class="row">

          <div class="col-md-4">
              <div class="form-group">
              <label for="price">Ciudad</label>
              {{ $city }}
              </div>    
          </div>
          
          <div class="col-md-4">
              <div class="form-group">
              <label for="price">Estado / Provnicia </label>
              {{ $state }}
              </div>  
          </div> 

          <div class="col-md-4">
            <div class="form-group">
            <label for="title">Codigo Postal</label>
            {{ $zip }}
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-md-12">
              <div class="form-group">
              <label for="price">Pais</label>
              {{ $country }}
              </div>    
          </div>

        </div>

        <div class="row">
          
          <div class="col-md-6">
              <div class="form-group">
              <label for="price">Estatus</label>
              @switch($status)
                @case(1)
                  {{ 'Activo' }}
                @break
                @case(0)
                  {{ 'Inactivo' }}
                @break
                  
              
                @default
                  
              @endswitch

              </div>  
          </div> 

          <div class="col-md-6">
            <div class="form-group">
              <label for="price">Tipo</label>
              @switch($type)
                @case(1)
                  {{ 'Empresa' }}
                  
                @break
                @case(2)
                  {{ 'Persona Física' }}
                @break
              
                @default
                  
              @endswitch

              </div> 
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
    document.addEventListener('close-modalnewCustomer', event => {
        $('#newCustomer').modal('hide');
    });  

</script> 

<script>   
  document.addEventListener('close-modaleditCustomer', event => {
      $('#editCustomer').modal('hide');
  });  

</script> 

<script>   
  document.addEventListener('close-modalviewCustomer', event => {
      $('#viewCustomer').modal('hide');
  });  

</script> 