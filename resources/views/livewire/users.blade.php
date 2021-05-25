<div>
    <div class="container" >
        <div class="row justify-content-center text-center"> 
            <div x-data="toggle()" x-cloak>
                <button class="btn c_grad_green text-white text-center" x-on:click="open" x-text="title">Mostrar</button>
               
                <div  class="container" x-show.transition.duration.1000ms.scale.0="isOpen()" x-on:click.away="close">
                            
                    <livewire:datatable model="App\Models\User" hideable="select"   exportable/>
                            
                </div>
            </div>



        </div>
    </div>
    {{-- Stop trying to control. --}}
</div>
<style>
    [x-cloak] { 
      display: none !important;
   }
    </style>