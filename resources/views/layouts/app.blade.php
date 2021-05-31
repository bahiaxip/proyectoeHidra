<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name')}}</title>

    <!-- Scripts -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">-->

    <!-- Styles -->
    <link href="{{ asset('css/livewire.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css" integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />
    @livewireStyles
    
</head>
<body>
    <div id="app"  >
        <nav class=" navbar navbar-expand navbar-light bg-white shadow-sm nav_livewire2  ">
            <div class="container d-inline">
                <div class="row justify-content-between">
                    <div class="col-3" x-data="transLogo()" >
                        <a class="navbar-brand text-white font-weight-bold f_nav trans_logo nav_livewireA" href="{{ url('/') }}"
                        x-on:mouseover="onLogo(event)"
                        x-on:mouseleave="offLogo(event)"
                        >
                            Proyecto eHidra
                        </a>
                    </div>
                    <div class="col-5  text-center col_center">
                        
                        @auth
                        
                            <a class="navbar-brand text-white font-weight-bold  pr-2 f_nav nav_livewireA" href="{{ route('users')}}">Tabla1</a>
                        
                        
                            <a class="navbar-brand text-white font-weight-bold  pl-2 f_nav nav_livewireA" href="{{ route('profile')}}">Tabla2</a>

                            <a class="navbar-brand text-white font-weight-bold  pl-2 f_nav nav_livewireA" href="{{ route('verification')}}">Verificar</a>
                        
                        @endauth
                            
                        
                    </div>

                    <div class="col-3">
                        <div class=" navbar-collapse" id="navbarSupportedContent">
                            
                            <ul class="navbar-nav ml-auto ">
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link text-white font-weight-bold" href="{{ route('login') }}">Sesión</a>
                                        </li>
                                        
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link text-white font-weight-bold" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <!--<a class="navbar-link text-white font-weight-bold f_14" href="{{ route('users')}}">Usuarios</a>-->

                                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right back_livewire2" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item back_livewire2" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Salir') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>   
                                        
                                @endguest                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <main class="py-2">
        @yield('content')
    </main>
    {{$slot ?? ''}}
    @livewireScripts

    <script>        
    //al crear usuario ocultamos modal

        window.livewire.on('userCreated',()=>{
            $('#addUser').modal('hide');
        })
        window.livewire.on('userUpdated',()=>{
            $('#editUser').modal('hide');
        })        
        window.livewire.on('closeModalExport',(e)=>{
            $('#send').modal('hide');
        })
        //input file custom
        bsCustomFileInput.init();
        //tooltips bootstrap
        Livewire.onLoad(() => {
            $('[data-toggle="tooltip"]').tooltip()
        })
        

    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        function transLogo(){
            return{
                switchLogo:true,
                onLogo(e){
                    e.target.style.transform="scale(1.1,1) rotate(2deg)";
                },
                offLogo(e){
                    e.target.style.transform="scale(1) rotate(0deg)";
                }
            }
        }
        function toggle2(){            
            return {
                show2:false,
                show3:false,
                title2:"Ocultar",
                errorFile:"",
                userIdTmp:"",
                //columnas
                nameCol:true,
                surnamesCol:true,
                emailCol:true,
                phoneCol:true,
                countryCol:true,
                imageCol:true,
                hideSwitch:'',
                open2(){
                    //this.show2=false;
                    this.show2=true;this.title2="Ocultar"
                },
                close2(){
                  this.show2=false;this.title2="Mostrar"  
                },
                toggle3(){
                    if(this.show2)
                        this.close2();
                    else
                        this.open2();
                },            
                start:function(){
                    setTimeout(()=>  {
                        this.open2();
                        this.show3=true;                        
                    },100)
                },                
                //método subida archivo en formulario
                testFile(event){                    

                    if(event.target.files[0]){
                        let file=event.target.files[0];
                        let input=event.target;
                        if(file.type!=="image/jpg" &&
                            file.type!=="image/jpeg" &&
                            file.type!=="image/png"){       
                            this.errorFile="No es una imagen válida";
                            setTimeout(()=> {
                                this.errorFile="";
                            },5000)
                            //reseteamos valor
                            input.value="";
                            return false;
                        } 
                        if( file.size>2000000){
                            this.errorFile="La imagen es demasiado grande";
                            setTimeout(()=> {
                                this.errorFile="";
                            },5000)
                            //reseteamos valor
                            input.value="";
                            return false;
                        }
                    }
                },
                switches(){
                    
                    console.log('switch');
                },
                
                hideColumn(data){
                    this[data]=false;                    
                },
                //para dispositivos (necesario tener opción ocultar activada)
                hideTouchColumn(data){
                    if(this.hideSwitch)
                        this[data]=false;                    
                }
            }
        }
    </script>
    
</body>
</html>
