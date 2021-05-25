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


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/livewire.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.2/tailwind.min.css" integrity="sha512-l7qZAq1JcXdHei6h2z8h8sMe3NbMrmowhOl+QkP3UhifPpCW2MC4M0i26Y8wYpbz1xD9t61MLT9L1N773dzlOA==" crossorigin="anonymous" />
    @livewireStyles
    
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm nav_livewire2">
            <div class="container">
                <a class="navbar-brand text-white font-weight-bold" href="{{ url('/') }}">
                    Proyecto eHidra
                </a>
                <div class="container d-block">
                    <div class="row ">
                        <div class="col text-center ">
                            @auth
                                <a class="text-white font-weight-bold text-decoration-none pr-3" href="{{ route('users')}}">Usuarios</a>

                                <a class="text-white font-weight-bold text-decoration-none pl-3" href="{{ route('profile')}}">Perfil</a>
                            
                            @endauth
                        </div>                        
                    </div>
                </div>


                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
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
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    {{$slot ?? ''}}
    @livewireScripts
    <script>
    //al crear usuario ocultamos modal
        window.livewire.on('userCreated',()=>{
            $('#addUser').modal('hide');
        })
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
               
        function toggle(){
            
            return {
                show:false,
                title:"Mostrar",
                open(){
                    //this.show2=false;
                    this.show=true;this.title="Ocultar"
                },
                close(){
                  this.show=false;this.title="Mostrar"  
                },
                isOpen(){
                    //isOpen2();
                    return this.show === true
                }
            }
        }

        function toggle2(){

            return {
                show2:false,
                show3:false,
                title2:"Ocultar",
                
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
                        console.log("hola")
                    },100)
                    
                },
                
            }
        }
    </script>
</body>
</html>
