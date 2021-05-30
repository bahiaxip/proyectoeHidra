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
                                    <tr>
                                        <th 
                                        style="border:black 2px solid">
                                            Nombre
                                        </th>
                                        <th 
                                        style="border:black 2px solid">
                                            Apellidos
                                        </th>
                                        <th 
                                        style="border:black 2px solid">
                                            Correo
                                        </th>
                                        <th 
                                        style="border:black 2px solid">
                                            Teléfono
                                        </th>
                                        <th 
                                        style="border:black 2px solid">
                                            Provincia
                                        </th>
                                        <th 
                                        style="border:black 2px solid">
                                            País
                                        </th>
                                        <th 
                                        style="border:black 2px solid">
                                            Imagen
                                        </th>
                                    </tr>                                
                                <tbody  class="">

                                    @foreach($profiles as $pro)
                                    <tr>
                                        <td style="margin-top: 14px;padding-top:12px;border:black 1px solid;text-align:center">
                                            {{$pro->user->name}}
                                        </td>
                                        <td style="margin-top: 14px;padding-top:12px;border:black 1px solid;text-align:center">
                                            {{$pro->surnames}}
                                        </td>
                                        <td style="margin-top: 14px;padding-top:12px;border:black 1px solid;text-align:center">
                                            {{$pro->user->email}}
                                        </td>
                                        <td style="margin-top: 14px;padding-top:12px;border:black 1px solid;text-align:center">
                                            {{$pro->phone}}
                                        </td>

                                        <td style="margin-top: 14px;padding-top:12px;border:black 1px solid;text-align:center">
                                            {{$pro->province}}
                                        </td>
                                        <td style="margin-top: 14px;padding-top:12px;border:black 1px solid;text-align:center">
                                            {{$pro->country}}
                                        </td>
                                        <td style="margin-top: 10px;padding-top:20px;border:black 1px solid;text-align:center">
                                            <img width="32" src="{{$pro->file}}"/>
                                        </td>   
                                    </tr>                                
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>