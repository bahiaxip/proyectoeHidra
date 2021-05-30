<div>
    <div class="container overflow-auto" >
        <div class="row justify-content-center text-center"> 
            <div x-data="toggle2()" x-init="start()" x-cloak>
                <button class="btn btn-sm c_grad_green text-white text-center" 
                x-on:click="toggle3()"
                x-show.transition.duration.1500ms.scale.0="show3" 
                x-text="title2">Mostrar</button>
               
                <div  class="container" 
                x-show.transition.duration.1500ms.scale.0="show2" >
                            
                    <livewire:datatable model="App\Models\Profile" hide="select,user_id,file,thumb,file_name" searchable="surnames,country" with="user,user.name" include="id,user.name,surnames,user.email,country,phone,province,created_at" hideable="select"  dates="dob,created_at"   exportable/>
                            
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