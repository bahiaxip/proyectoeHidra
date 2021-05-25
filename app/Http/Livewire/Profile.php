<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profile as Profiles;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Classes\Paises;

class Profile extends Component
{
    //public $profiles;
    use WithPagination;
    public $name;
    public $surname;
    public $pass;
    public $email;
    public $phone;
    public $country;
    public $province;
    protected $paisesObj;
    public $countries;
    public $provincias;

    public function mount(){
        $this->paisesObj=new Paises();
        $this->countries=$this->paisesObj->all;
        $this->provincias=$this->paisesObj->provincias;
    }
    public function clear(){
        $this->name='';
        $this->surname='';
        $this->pass='';
        $this->email='';
        $this->phone='';
        $this->country='';
        $this->province='';
    }

    public function updated($fields){
        $this->validateOnly($fields,[
            'name'=>'required',
            'surname'=>'nullable',
            'pass'=>'required|min:8',
            'email'=>'required|email',
            'phone'=>'nullable',
            'country'=>'nullable',
            'province'=>'nullable'
        ]);
    }

    public function store(){
        $validated = $this->validate([
            'name'=>'required',
            'surname'=>'nullable',
            'pass'=>'required|min:8',
            'email'=>'required|email',
            'phone'=>'nullable',
            'country'=>'nullable',
            'province'=>'nullable'
        ]);
        $user=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['pass'])
        ]);
        Profiles::create([
            "surnames"=>$validated["surname"],
            "phone"=>$validated['phone'],            
            "country"=>$validated['country'],
            "province"=>$validated['province'],
            "user_id"=>$user->id,
            "file"=>"img/person.png"
        ]);
        session()->flash('message',"Usuario creado correctamente");
        $this->clear();
        $this->emit('userCreated');
    }


    public function render()
    {

        //$this->profiles=Profiles::all();
        $profiles=Profiles::paginate(10);
        return view('livewire.profile',['profiles'=>$profiles,'countries'=>$this->countries,'provincias'=>$this->provincias]);
    }
}
