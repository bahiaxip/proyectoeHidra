<div wire:ignore.self class="modal fade " id="showUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">

  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <div class="modal-title h5 ">Detalle de usuario</div>        
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-header">
            <div class="row align-middle">
              <div class="col-8 h5">
                <p class="p-2">{{$this->name}}</p>
                <p class="p-2">{{$this->surnames}}</p>
              </div>
              <div class="col-4" >
                  <img class="rounded-circle img-thumbnail float-right mr-2 mt-2" src="{{$this->file}}" width="50">
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row justify-content-around">
              <div class="col ">          
                <p class="p-2">E-Mail</p>
                <p class="p-2">Teléfono</p>
                <p class="p-2">País</p>
                @if($this->country=="España")
                <p class="p-2">Provincia</p>
                @endif
              </div>
              <div class="col ">          
                <p class="p-2">{{$this->email}}</p>
                <p class="p-2">{{$this->phone}}</p>
                <p class="p-2">{{$this->country}}</p>
                @if($this->country=="España")
                <p class="p-2">{{$this->province}}</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" wire:click.prevent="clear2()">Cerrar</button>
        <button type="button" class="btn btn-sm back_livewire2 text-white" wire:click.prevent="update()">Actualizar</button>
      </div>
    </div>
  </div>

</div>