<div class="container">
        <div class="row">
            <div class="col text-center">
                <div  class="container mt-3" >

                    <div class="card">
                        <div class="card-header text-center">
                            <p style="font-size:20px;text-align:center;font-weight:bold">Perfil de usuarios</p>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" >
                                <thead style="border:black 2px solid">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>   
                                        <th>País</th>   
                                        <th>Provincia</th>   
                                    </tr>
                                </thead>
                                <tbody  class="">
                                    @foreach($profiles as $pro)
                                    <thead  style="border:black 1px solid !important;margin-top: 10px;">
                                    <tr >
                                        <td style="margin-top: 14px;padding-top:12px">{{$pro->user->name}}</td>
                                        <td style="margin-top: 14px;padding-top:12px">{{$pro->surnames}}</td>
                                        <td style="margin-top: 14px;padding-top:12px">{{$pro->user->email}}</td>
                                        <td style="margin-top: 14px;padding-top:12px">{{$pro->phone}}</td>
                                        <td style="margin-top: 14px;padding-top:12px">{{$pro->country}}</td>
                                        @if($pro->country == "España")
                                        <td style="margin-top: 14px;padding-top:12px">{{$pro->province}}</td>    
                                        @endif
                                        
                                    </tr>
                                </thead>
                                    @endforeach
                                </tbody>
                            </table>                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>