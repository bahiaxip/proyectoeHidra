<!-- Button trigger modal -->


<!-- Modal -->
<div wire:ignore.self class="modal fade " id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title h5" id="exampleModalLabel">Crear Usuario</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form >
        	<div class="form-group">
        		<label for="name">Nombre</label>
        		<input type="text" name="name" class="form-control" wire:model="name"/>
            @error('name')
            <p class="text-danger">{{$message}}</p>
            @enderror
        	</div>
        	<div class="form-group">
        		<label for="surname">Apellidos</label>
        		<input type="text" name="surname" class="form-control" wire:model="surname"/>
        	</div>
        	<div class="form-group">
        		<label for="pass">Contraseña</label>
        		<input type="password" name="pass" class="form-control" wire:model="pass"/>
            @error('pass')
            <p class="text-danger">{{$message}}</p>
            @enderror
        	</div>
        	<div class="form-group">
        		<label for="email">Email</label>
        		<input type="text" name="email" class="form-control" wire:model="email"/>
            @error('email')
            <p class="text-danger">{{$message}}</p>
            @enderror
        	</div>        	
        	<div class="form-group">
        		<label for="country">País</label>
        		<select name="country" class="form-control" wire:model="country">
        			<option value="0">Seleccione...</option>
              @foreach($countries as $key=>$countri)
        			<option value="{{$countri}}">{{$countri}}</option>
              @endforeach
        		</select>        		
        	</div>
        		<!-- aparece si es España -->
          @if($country=="España")
        	<div class="form-group">
        		<label for="province">Provincia</label>
        		<select name="province" class="form-control" wire:model="province">
        			<option value="0">Seleccione...</option>
              @foreach($provincias as $provincia)
        			<option value="{{$provincia}}">{{$provincia}}</option>
              @endforeach
        		</select>
        	</div>
          @endif
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="button" class="btn btn-primary" wire:click.prevent="store()">Save changes</button>
      </div>
    </div>
  </div>
</div>