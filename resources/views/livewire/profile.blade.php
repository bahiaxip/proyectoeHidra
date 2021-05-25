<div>
    @include('livewire.create')
    <div class="container">
        <div class="row">
            <div class="col text-center" x-data="toggle2()" x-init="start()" x-cloak>
                <button class="btn c_grad_green text-white" 
                x-text="title2" 
                x-show.transition.duration.2000ms.scale.0="show3" 
                x-on:click="toggle3()" >Mostrar</button>
                
                <div  class="container mt-3" x-show.transition.duration.2000ms.scale.0="show2" >
                @if(session()->has('message'))
                    <div class="alert alert-success">{{session('message')}}</div>
                    @endif

                    <div class="card">
                        <div class="card-header justify-content-between">
                            <button class="text-start h2">Perfil</button>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addUser">
                                Crear
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th>Provincia</th>
                                    <th>País</th>
                                    <th>Imagen</th>
                                </thead>
                                <tbody>
                                    @foreach($profiles as $pro)
                                    <tr>
                                        <td>{{$pro->user->name}}</td>
                                        <td>{{$pro->surnames}}</td>
                                        <td>{{$pro->phone}}</td>
                                        <td>{{$pro->province}}</td>
                                        <td>{{$pro->country}}</td>
                                        <td><img width="32" src="{{$pro->file}}" /></td>
                                        <td>Ver</td>
                                        <td>Editar</td>
                                        <td>Eliminar</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            {{$profiles->links()}}
                        </div>
                    </div>
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
