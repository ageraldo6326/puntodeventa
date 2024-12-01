<!-- Modal Nuevo -->
<div class="modal fade" id="newCategory" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="newCategory" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-file"></i> Nueva Categoría</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="title">Categoría</label>
                    <input type="text" class="form-control" wire:model="name" required>
                    @error('name')
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

<div class="modal fade" id="editCategory" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="editCategory" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> Editar Categoría</h5>
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
              <div class="col-md-12">
                  <div class="form-group">
                  <label for="title">Categoría</label>
                  <input type="text" class="form-control" wire:model.live="name" required>
                  @error('name')
                      <span class="text-danger">{{ $message }}</span>                      
                  @enderror
              </div>
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



<!-- Modal -->
<div class="modal fade" id="viewCategory" tabindex="-1" wire:ignore.self data-backdrop="static" aria-labelledby="viewCategory" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-eye"></i> Ver Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <h4>ID: {{ $id}}</h4>
          </div>
        </div>
        <div class="row">
              <div class="col-md-12">
                <h4>Categoría: {{ $name}}</h4>
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
    document.addEventListener('close-modalnewCategory', event => {
        $('#newCategory').modal('hide');
    });  

</script> 

<script>   
  document.addEventListener('close-modaleditCategory', event => {
      $('#editCategory').modal('hide');
  });  

</script> 

<script>   
  document.addEventListener('close-modalviewCategory', event => {
      $('#viewCategory').modal('hide');
  });  

</script> 