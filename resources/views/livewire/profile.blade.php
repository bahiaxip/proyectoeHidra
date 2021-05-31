<div>
    <!-- modals -->
    @include('livewire.create')
    @include('livewire.show')
    @include('livewire.update')
    @include('livewire.confirm')
    @include('livewire.send')
    <div class="container  overflow-auto">
        <div class="row  justify-content-center">
            <div class="col text-center" x-data="toggle2()" x-init="start()" x-cloak>
                <button class="btn btn-sm c_grad_green text-white" 
                x-text="title2" 
                x-show.transition.duration.1500ms.scale.0="show3" 
                x-on:click="toggle3()" >
                    Mostrar
                </button>

                <div  class="container mt-3 " x-show.transition.duration.1500ms.scale.0="show2" >
                @if(session()->has('message'))
                    <div class="alert alert-success ">{{session('message')}}</div>
                @endif

                <!--<div class="card">-->
                    <div class="">  
                    <!--<div class="card-header ">-->
                            <div class="row  ">
                                <div class="col-3 col-sm-4 ">
                                    <div  class="form-group">
                                        <span class="d-none d-sm-flex fas fa-search form-control-icon"></span>              
                                        <input type="text" id="searchData" class="form-control form-control-sm" name="$searchData" wire:model="searchData" placeholder="Buscar..."/>

                                        <span class="d-none d-md-flex far fa-times-circle form-control-icon2" wire:click="clearSearch"></span>
                                        
                                    </div>
                                </div>
                                <div class=" col-6 col-sm-4">
                                    <button type="button" class="btn btn-sm c_grad_green text-white mx-1" data-toggle="modal" data-target="#send">
                                        Exportar
                                    </button>                                    
                                    <button type="button" class="btn btn-sm c_grad_green mx-1" data-toggle="modal" data-target="#addUser">
                                        Crear
                                    </button>
                                </div>
                                <div class="col-3 col-sm-4 ">
                                    <div class="dropdown float-right">
                                        <!--<button type="button" class="btn btn-sm c_grad_green mx-1" data-toggle="modal" >
                                            Ocultar
                                        </button>-->
                                      <button class="btn btn-sm c_grad_green dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Columnas
                                      </button>

                                      <div class="dropdown-menu swActive" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item " 
                                        x-on:click="nameCol=true"
                                        title="Mostrar columna Nombre"
                                        data-toggle="tooltip" data-placement="left"

                                        >Nombre</a>

                                        <a class="dropdown-item " 
                                        x-on:click="surnamesCol=true"
                                        title="Mostrar columna Apellidos"
                                        data-toggle="tooltip" data-placement="left"

                                        >Apellidos</a> 

                                        <a class="dropdown-item " 
                                        x-on:click="emailCol=true"
                                        title="Mostrar columna Email"
                                        data-toggle="tooltip" data-placement="left"

                                        >Email</a>

                                        <a class="dropdown-item " 
                                        x-on:click="phoneCol=true"
                                        title="Mostrar columna Teléfono"
                                        data-toggle="tooltip" data-placement="left"

                                        >Teléfono</a>

                                        <a class="dropdown-item" 
                                        x-on:click="countryCol=true"
                                        title="Mostrar columna País"
                                        data-toggle="tooltip" data-placement="left"

                                        >País</a>

                                        <a class="dropdown-item" 
                                        x-on:click="imageCol=true"
                                        title="Mostrar columna Imagen"
                                        data-toggle="tooltip" data-placement="left"

                                        >Imagen</a>

                                        <a class="dropdown-item " 
                                        x-on:click="hideSwitch=!hideSwitch" x-bind:class="{'switchActive':hideSwitch}"
                                        data-toggle="tooltip" data-placement="bottom" 
                                        title="Mantener activado para ocultar 
                                        (solo dispositivos táctiles)"
                                        wire:click="toggleSwitch()"
                                        >Ocultar</a>

                                      </div>

                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    <div class="overflow-x-scroll">
                    <!--<div class="card-body">-->
                        <table class="table  table-bordered table-hover">
                            <thead class="back_livewire2">
                                <th
                                x-on:dblclick="hideColumn('nameCol')"
                                x-on:touchstart="hideTouchColumn('nameCol')"
                                x-show="nameCol"
                                x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                x-transition:enter-end="opacity-100 transform -translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform -translate-x-2"
                                wire:click.prevent="selectQuery('name')"
                                >Nombre</th>
                                <th 
                                x-on:dblclick="hideColumn('surnamesCol')" 
                                x-on:touchstart="hideTouchColumn('surnamesCol')"
                                x-show="surnamesCol"
                                x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                x-transition:enter-end="opacity-100 transform -translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform -translate-x-2"
                                wire:click.prevent="selectQuery('surnames')"
                                >Apellidos</th>
                                <th 
                                x-on:dblclick="hideColumn('emailCol')" 
                                x-on:touchstart="hideTouchColumn('emailCol')" 
                                x-show="emailCol"
                                x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                x-transition:enter-end="opacity-100 transform -translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform -translate-x-2"                                
                                wire:click.prevent="selectQuery('email')"
                                >Email</th>
                                <th 
                                x-on:dblclick="hideColumn('phoneCol')" 
                                x-on:touchstart="hideTouchColumn('phoneCol')" 
                                x-show="phoneCol"
                                x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                x-transition:enter-end="opacity-100 transform -translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform -translate-x-2"
                                wire:click.prevent="selectQuery('phone')"
                                >Teléfono</th>
                                <th 
                                x-on:dblclick="hideColumn('countryCol')" 
                                x-on:touchstart="hideTouchColumn('countryCol')" 
                                x-show="countryCol"
                                x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                x-transition:enter-end="opacity-100 transform -translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform -translate-x-2"
                                wire:click.prevent="selectQuery('country')"
                                >País</th>
                                <th 
                                x-on:dblclick="hideColumn('imageCol')" 
                                x-on:touchstart="hideTouchColumn('imageCol')" 
                                x-show="imageCol"
                                x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                x-transition:enter-end="opacity-100 transform -translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform -translate-x-2"
                                >Imagen
                                </th>
                                <th>Detalle</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </thead>
                            <tbody>
                                @foreach($profiles as $pro)
                                <tr>
                                    <td 
                                    x-show="nameCol"
                                    x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                    x-transition:enter-end="opacity-100 transform -translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-end="opacity-0 transform -translate-x-2"
                                    >{{$pro->user->name}}</td>
                                    <td 
                                    x-show="surnamesCol"
                                    x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                    x-transition:enter-end="opacity-100 transform -translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-end="opacity-0 transform -translate-x-2"
                                    >{{$pro->surnames}}</td>
                                    <td 
                                    x-show="emailCol"
                                    x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                    x-transition:enter-end="opacity-100 transform -translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-end="opacity-0 transform -translate-x-2"
                                    >{{$pro->user->email}}</td>
                                    <td 
                                    x-show="phoneCol"
                                    x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                    x-transition:enter-end="opacity-100 transform -translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-end="opacity-0 transform -translate-x-2"
                                    >{{$pro->phone}}</td>   
                                    <td 
                                    x-show="countryCol"
                                    x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                    x-transition:enter-end="opacity-100 transform -translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-end="opacity-0 transform -translate-x-2"
                                    >{{$pro->country}}</td>   
                                    <td 
                                    x-show="imageCol"
                                    x-transition:enter="transition-transform  transition-opacity ease-in duration-300"
                                    x-transition:enter-start="opacity-0 transform -translate-x-1/2"
                                    x-transition:enter-end="opacity-100 transform -translate-x-0"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-end="opacity-0 transform -translate-x-2"
                                    ><img class="m-auto" width="32" src="{{$pro->file}}" /></td>
                                    <td><button class="btn btn-sm back_livewire2" title="Ver detalle de usuario" data-toggle="modal" data-target="#showUser" wire:click="edit({{$pro->user_id}})">
                                        <i class="fas fa-search"></i>
                                    </button></td>
                                    <td><button class="btn btn-sm back_livewire2" title="Editar usuario" data-toggle="modal" data-target="#editUser" wire:click="edit({{$pro->user_id}})">
                                        <i class="fas fa-edit"></i>
                                    </button></td>
                                    <!--<td><button class="btn btn-sm back_livewire2" title="Eliminar usuario" wire:click="delete({{$pro->user_id}})"><img src="img/delete.png" width="20" /></button></td>-->
                                    <td>
                                        <button class="btn btn-sm back_livewire2" title="Eliminar usuario" data-toggle="modal" data-target="#confirmDel" wire:click="saveUserId({{$pro->user_id}})">                                            <i class="fas fa-trash fa-lg"></i>
                                        </button>
                                    </td>
                                    
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        {{$profiles->links()}}
                    </div>
                <!--</div>-->
                </div>

            </div>
        </div>
    </div>
{{--<div class="container" >
        <div class="row justify-content-center text-center"> 
            <div x-data="toggle()" x-cloak>
                <button class="btn c_grad_green text-white text-center" x-on:click="open" x-text="title">Mostrar</button>
               
                <div  class="container" x-show="isOpen()" x-on:click.away="close">
                            
                    <livewire:datatable model="App\Models\User" hideable="select"   exportable/>
                            
                </div>
            </div>
        </div>
    </div>--}}
    {{-- Stop trying to control. --}}
</div>
<style>
    [x-cloak] { 
      display: none !important;
   }
    </style>
</div>
