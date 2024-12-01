<!-- Modal Nuevo -->
<div class="modal fade" id="newSecuencia" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="newSecuencia" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-file"></i> Nueva Secuencia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
            
          @endif

          <div class="row">

            <div class="col-md-2">
                <div class="form-group">
                <label for="title">Serie</label>
                <input type="text" class="form-control" wire:model="serie" required>
                @error('serie')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                <label for="title">Inicio Secuencia</label>
                <input type="text" class="form-control" wire:model="iniciosecuencia" required>
                @error('iniciosecuencia')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                <label for="title">Fin Secuencia</label>
                <input type="text" class="form-control" wire:model="finsecuencia" required>
                @error('finsecuencia')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>        
            
            <div class="col-md-4">
                <div class="form-group">
                <label for="title">Tipo</label>
                <select class="form-control" wire:model="tipo" required>
                    <option value="">-- Seleccione --</option>
                    <option value="01">Factura de Crédito Fiscal - 01</option>
                    <option value="02">Factura de Consumo - 02</option>
                    <option value="03">Notas de Débito - 03</option>
                    <option value="04">Notas de Crédito - 04</option>
                </select>
                @error('tipo')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>            
            
            
          </div>


          <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Fecha Emision</label>
                <input type="date" class="form-control" wire:model="fechaemision" required>
                @error('fechaemision')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="title">Fecha Expiracion</label>
                <input type="date" class="form-control" wire:model="fechaexpiracion" required>
                @error('fechaexpiracion')
                    <span class="text-danger">{{ $message }}</span>                      
                @enderror
              </div>
            </div>            
            

          </div>

          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
              <label for="title">Estatus</label>
              <select class="form-control" wire:model="estado">
                  <option value="">-- Seleccione --</option>
                  <option value="ACTIVO">ACTIVO</option>
                  <option value="INACTIVO">INACTIVO</option>
              </select>
              @error('estatus')
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

<div class="modal fade" id="editSecuencia" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="editSecuencia" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> Editar Secuencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div><strong>ID :</strong> {{ $id}}</div>
        <div class="row">
          
          <div class="col-md-2">
              <div class="form-group">
              <label for="title">NCF</label>
              <input type="text" class="form-control" wire:model="serie" required>
              @error('serie')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>

          <div class="col-md-2">
              <div class="form-group">
              <label for="title">Inicio Secuencia</label>
              <input type="text" class="form-control" wire:model="iniciosecuencia" required>
              @error('iniciosecuencia')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>

          <div class="col-md-2">
              <div class="form-group">
              <label for="title">Fin Secuencia</label>
              <input type="text" class="form-control" wire:model="finsecuencia" required>
              @error('finsecuencia')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>        
          
          <div class="col-md-4">
            <div class="form-group">
            <label for="title">Tipo</label>
            <select class="form-control" wire:model="tipo" required>
                <option value="">-- Seleccione --</option>
                <option value="01">Factura de Crédito Fiscal - 01</option>
                <option value="02">Factura de Consumo - 02</option>
                <option value="03">Notas de Débito - 03</option>
                <option value="04">Notas de Crédito - 04</option>
            </select>
            @error('tipo')
                <span class="text-danger">{{ $message }}</span>                      
            @enderror
          </div>
        </div>             
          
          
        </div>


        <div class="row">

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Fecha Emision</label>
              <input type="date" class="form-control" wire:model="fechaemision" required>
              @error('fechaemision')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Fecha Expiracion</label>
              <input type="date" class="form-control" wire:model="fechaexpiracion" required>
              @error('fechaexpiracion')
                  <span class="text-danger">{{ $message }}</span>                      
              @enderror
            </div>
          </div>            
          

        </div>

        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
            <label for="title">Estatus</label>
            <select class="form-control" wire:model="estado">
                <option value="">-- Seleccione --</option>
                <option value="ACTIVO">ACTIVO</option>
                <option value="INACTIVO">INACTIVO</option>
            </select>
            @error('estado')
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



<!-- Modal -->
<div class="modal fade" id="viewSecuencia" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="viewSecuencia" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> Editar Secuencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div><strong>ID :</strong> {{ $id}}</div>
        
        <div class="row">
          
          <div class="col-md-2">
              <div class="form-group">
              <label for="title">Serie</label>
              {{ $serie }}
            </div>
          </div>

          <div class="col-md-2">
              <div class="form-group">
              <label for="title">Tipo</label>
              {{ $tipo }}
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
            <label for="title">Inicio Sec</label>
            {{ $iniciosecuencia }}
          </div>
        </div>           

          <div class="col-md-2">
              <div class="form-group">
              <label for="title">Fin Sec</label>
              {{ $finsecuencia }}
            </div>
          </div>        
                    
          
        </div>


        <div class="row">

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Fecha Emision</label>
              {{ $fechaemision }}
            </div>
          </div>

          <div class="col-md-6">
              <div class="form-group">
              <label for="title">Fecha Expiracion</label>
              {{ $fechaexpiracion }}
            </div>
          </div>            
          

        </div>

        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
            <label for="title">Estatus</label>
            {{ $estado }}
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
    document.addEventListener('close-modalnewNCF', event => {
        $('#newSecuencia').modal('hide');
    });  

</script> 

<script>   
  document.addEventListener('close-modaleditNCF', event => {
      $('#editSecuencia').modal('hide');
  });  

</script> 

<script>   
  document.addEventListener('close-modalviewNCF', event => {
      $('#viewSecuencia').modal('hide');
  });  

</script> 