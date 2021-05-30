<?php

namespace App\Http\Livewire;

use Livewire\Component;
use  Livewire\WithFileUploads;
use App\Models\Profile as Profiles;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Classes\Paises;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\UsersExports;
use PDF;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Users;
use Auth;
class Profile extends Component
{    
    use WithPagination;
    public $user_id;
    public $name;
    public $surnames;
    public $pass;
    public $email;
    public $phone;
    public $country;
    public $province;
    protected $paisesObj;
    public $countries;
    public $provincias;
    public $file;
    public $thumb;
    public $file_name;
    //búsqueda
    public $searchData;
    //nombre de columna
    public $selectedColumn;
    //orden de columna (asc/desc)
    public $orderType='asc';

    public $userIdTmp;    
    public $checkpdf;
    public $checkexcel;
    public $emailParaExportar;
    public $authUser;
    //identificador de opción ocultar activada(true)/desactivada(false)
    public $switchColumn=false;
    protected $pdf;

    use WithFileUploads;

    //método mount() (cyclehook de livewire)
    public function mount(){
        $this->paisesObj=new Paises();
        $this->countries=$this->paisesObj->all;
        $this->provincias=$this->paisesObj->provincias;
        $this->userIdTmp='';        
        $this->checkpdf='1';
        $this->checkexcel='';
        $this->authUser=Auth::user()->name;

        
        
    }

    //botón X de buscador para eliminar datos de búsqueda
    public function clearSearch(){
        $this->searchData='';
    }
    //limpiar datos de formulario
    public function clear(){
        //si existen mensaje de error limpiar, si existe input file resetear

        if($this->user_id){
            $this->user_id='';
        }
        $this->name='';
        $this->surnames='';
        $this->pass='';
        $this->email='';
        $this->phone='';
        $this->country='';
        $this->province='';
        $this->file='';
        $this->thumb='';
        $this->file_name='';

    }
    //limpiar datos de exportación
    public function clearExport(){
        $this->checkpdf='1';
        $this->checkexcel='';
        $this->emailParaExportar='';

    }
    //interruptor que restringe el cambio de orden de columnas y permite que 
    //dispositivos táctiles puedan realizar tanto la ocultación de columnas,
    //como el cambio de orden de columnas (dispositivos táctiles no detectan
    //el doble click utilizado para la ocultación)
    public function toggleSwitch(){
        if($this->switchColumn)
            $this->switchColumn=false;
        else
            $this->switchColumn=true;
    }

    //actualizar datos de consulta de orden por columna (si se clica en las columnas)
    public function selectQuery($nameColumn){
        if($this->switchColumn==false){
            if($this->selectedColumn != $nameColumn){            
                $this->orderType='asc';
            }else{
                if($this->orderType=='' || $this->orderType=='desc'){
                    $this->orderType='asc';
                }else{
                    $this->orderType='desc';    
                }
            }
            $this->selectedColumn=$nameColumn;
            $this->setQuery();
        }
        
    }

    public function setQuery($export=null){
        $sql='';
        if($this->selectedColumn && !$export){
            $col=$this->selectedColumn;
            $order=$this->orderType;
            switch($col){
                case 'name':
                    //name asc/desc
                    $sql=Profiles::with('user')
                    ->join('users','profiles.user_id','=','users.id')
                    ->orderBy('users.name',$order)
                    ->paginate(10);
                    break;
                case 'email':
                    //email
                    $sql=Profiles::with('user')
                    ->join('users','profiles.user_id','=','users.id')
                    ->orderBy('users.email',$order)
                    ->paginate(10);
                    break;
                case 'surnames':
                case 'country':
                case 'phone':
                    //surnames
                    $sql=Profiles::orderBy($col,$order)->paginate(10);
                    break;
            }
        }else{
            $col=$this->selectedColumn;
            $order=$this->orderType;
            switch($col){
                case 'name':
                    //name asc/desc
                    $sql=Profiles::with('user')
                    ->join('users','profiles.user_id','=','users.id')
                    ->orderBy('users.name',$order)
                    ->get();
                    break;
                case 'email':
                    //email
                    $sql=Profiles::with('user')
                    ->join('users','profiles.user_id','=','users.id')
                    ->orderBy('users.email',$order)
                    ->get();
                    break;
                case 'surnames':
                case 'country':
                case 'phone':
                    //surnames
                    $sql=Profiles::orderBy($col,$order)->get();
                    break;
            }
        }
        return $sql;
    }
    //limpiamos los datos de orden de columna
    public function clearQuery(){
        $this->selectedCol='';
        $this->orderType='asc';
    }


    //para no repetir la misma condición creamos método de comprobación 
    //de search y de orden de columnas, si no, se realiza consulta total
    public function updateQuery($export=null){
        $profiles;
        //si existe parámetro true es que es para exportar (la misma consulta
        //pero con get())
        if($this->searchData && $export){
            $searchData='%'.$this->searchData.'%';
            //Búsqueda a 2 tablas relacionadas
            $profiles=Profiles::where('surnames','LIKE',$searchData)
                ->orWhere('country','LIKE',$searchData)            
                ->orWhereHas('user',function($query) {
                    $query->where('name', 'LIKE', '%'.$this->searchData.'%')
                    ->orWhere('email','LIKE','%'.$this->searchData.'%');
                })->get();
            
        }
        //si existe búsqueda priorizamos la búsqueda
        elseif($this->searchData){
            $searchData='%'.$this->searchData.'%';
            //Búsqueda a 2 tablas relacionadas
            $profiles=Profiles::where('surnames','LIKE',$searchData)
                ->orWhere('country','LIKE',$searchData)            
                ->orWhereHas('user',function($query) {
                    $query->where('name', 'LIKE', '%'.$this->searchData.'%')
                    ->orWhere('email','LIKE','%'.$this->searchData.'%');
                })->paginate(10);
            
        }else{
            if($this->setQuery() && $export){
                $profiles=$this->setQuery($export);
            }elseif($this->setQuery()){
                $profiles=$this->setQuery();
            }elseif($export){
                //limpiamos datos de orden de columna aunque no sería necesaria //pk si accede aquí es pk no tiene datos o ya se han limpiado
                $this->clearQuery();
                $profiles=Profiles::orderBy('id','asc')->get();
            }else{
                //limpiamos datos de orden de columna aunque no sería necesaria //pk si accede aquí es pk no tiene datos o ya se han limpiado
                $this->clearQuery();
                $profiles=Profiles::orderBy('id','asc')->paginate(10);
            }

            
        }
        return $profiles;
        //$profiles=Profiles::orderBy('surnames','asc')->paginate(10);
        //$profiles=Profiles::orderBy('phone','asc')->paginate(10);
        //$profiles=Profiles::orderBy('country','asc')->paginate(10);
    }

    



    //limpiar datos incluyendo el input files
    public function clear2(){
        $this->clear();
        //resetea todos los campos necesario para input file
        $this->resetValidation();
    }    
    //actualización (cyclehook de livewire)
    public function updated($fields){

        if($this->searchData){
            
                
            //si se encuentra en otra página resetea, si no, el buscador
            //no realiza correctamente la búsqueda
            $this->resetPage();            
        }else{
            $this->clearQuery();
        }

        $this->validateOnly($fields,[
            'name'=>'required',
            'surnames'=>'nullable',
            'pass'=>'required|min:8',
            'email'=>'required|email',
            'phone'=>'nullable',
            'country'=>'nullable',
            'province'=>'nullable',
            'file'=>'nullable',
        //no necesario
        //    'thumb'=>'nullable',
        //    'file_name'=>'nullable'
        ]);
    }
    
    //crear usuario
    public function store(){        
        $validated = $this->validate([
            'name'=>'required',
            'surnames'=>'nullable',
            'pass'=>'required|min:8',
            'email'=>'required|email|unique:users,email',
            'phone'=>'nullable',
            'country'=>'nullable',
            'province'=>'nullable',
            'file'=>'nullable'            
        ]);
        //tabla users
        $user=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['pass'])
        ]);

        //si no se sube imagen se asigna una por defecto
        $file;
        $thumb;
        $file_name;
        if($validated['file']==""){
            $file="img/person.png";
            $thumb="img/person.png";
            $file_name="imagen usuario";    
        }else{
            
            $file_name=$this->file->getClientOriginalName();
            $file=$this->file->store('files','');
            $thumb=$file;            
        }

        //tabla profiles
        Profiles::create([
            "surnames"=>$validated["surnames"],
            "phone"=>$validated['phone'],            
            "country"=>$validated['country'],
            "province"=>$validated['province'],
            "user_id"=>$user->id,
            //asignar imagen   
            "file"=>$file,    
            "thumb"=>$thumb,
            "file_name"=>$file_name
        ]);
        //mostramos mensaje y limpiamos 
        session()->flash('message',"Usuario creado correctamente");
        $this->clear2();
        $this->emit('userCreated');
    }
    
    //editar usuario
    //por seguridad no se incluye la edición de la contraseña
    //el parámetro $id es el id de la tabla users relacionado con el user_id de la tabla profile
    
    public function edit($id){
        //registro de la tabla profiles con el usuario seleccionado
        $profile=Profiles::where('user_id',$id)->first();
        //registro de la tabla users con el usuario seleccionado
        $user=User::where('id',$id)->first();
        $this->user_id=$profile->user_id;
        //(se podría evitar la consulta $user y llamar al método user del modelo 
        //Profile belongsTo...)
        //asignación de datos mediante consulta a tabla users 
        $this->name=$user->name;
        $this->email=$user->email;
        //asignación de datos mediante consulta con tabla profiles
        $this->surnames=$profile->surnames;
        $this->phone=$profile->phone;
        $this->country=$profile->country;
        $this->province=$profile->province;
        $this->file=$profile->file;
        $this->thumb=$profile->thumb;
        $this->file_title=$profile->file_name;
    }
    //actualizar usuario
    public function update(){
        $this->validate([
            'name'=>'required',
            'surnames'=>'nullable',            
            'email'=>'required|email',
            'phone'=>'nullable',
            'country'=>'nullable',
            'province'=>'nullable',    
            'file'=>'nullable',
        ]);
        if($this->user_id){
            $user=User::where('id',$this->user_id)->first();
            $profile=Profiles::where('user_id',$this->user_id)->first();
            $user->update([
                'name'=>$this->name,
                'email'=>$this->email
            ]);
        //si se sube imagen actualizar, si no, mantener la imagen anterior,
        //para la comprobación usamos el campo (repetido de la imagen) thumb
        $file;
        $thumb;
        $file_name;
        //comprobar imagen subida
        if($this->file===$this->thumb){
            $file=$this->file;
            $thumb=$this->thumb;
            $file_name=$this->file_name;    
        }else{            
            $file_name=$this->file->getClientOriginalName();
            $file=$this->file->store('files','');
            $thumb=$file;
        }
        //actualización
        $profile->update([
            'surnames'=>$this->surnames,
            'phone'=>$this->phone,
            'country'=>$this->country,
            'province'=>$this->province,
            'file'=>$file,
            'thumb'=>$thumb,
            'title_file'=>$file_name
        ]);
        //enviamos mensaje y limpiamos
        session()->flash('message','Usuario actualizado correctamente');
        $this->clear2();
        $this->emit('userUpdated');
        }
    }
    //Los 2 métodos siguientes (saveUserId, clearUserId) son necesarios para 
    //la confirmación (mediante modal de bootstrap) de eliminación de usuario, 
    //guardar y limpiar id de usuario seleccionado de forma temporal    
    public function saveUserId($userId){
        $this->userIdTmp=$userId;
    }
    //si se recarga la página tb ser resetea el userIdTmp, en el método mount()
    public function clearUserId(){
        $this->userIdTmp='';
    }
    
    //eliminación de usuario
    public function delete(){
        if($this->userIdTmp){
            $profile=Profiles::where('user_id',$this->userIdTmp)->first();
            //comprobamos si existe imagen y si existe y
            //es distinta a la asignada por defecto se elimina del server
            $exists=Storage::disk('public')->exists($profile->file);
            if($exists && $profile->file != 'img/person.png'){
                Storage::disk('public')->delete($profile->file);
                session()->flash('message',$profile->file);    
            }            
            $user=User::where('id',$this->userIdTmp)->first();
            $profile->delete();
            $user->delete();
            session()->flash('message',"Usuario eliminado correctamente");
        }
    }
    
    //exportar archivo PDF al navegador del usuario
    public function exportPDF(){
    //opción actual         
        $profiles=$this->updateQuery(true);
        $view="livewire.export";
        $pdf=PDF::loadView($view,['profiles'=>$profiles]);
        //método output() de pdf
        //$pdf= PDF::loadView($view,['profiles'=>$profiles])->output();
        $this->pdf=$pdf;
        return response()->streamDownload(function(){
            //con print o con echo
            print $this->pdf->stream();            
            //echo $this->pdf->stream();
        },'test.pdf');
        
        
            //para más info sobre configuración de la librería dompdf en Laravel:
                //https://github.com/barryvdh/laravel-dompdf
                //opciones de configuración  de laravel con download() de laravel,
                    //$sheet = $pdf->setPaper('a4', 'landscape');
                    //$this->pdf=$sheet;
                    //descarga
                    //return $sheet->download('download.pdf');
                    //cabeceras para pdf
                    //$headers = ['Content-Type' => 'application/pdf'];
                //descarga de archivo en disco con cabeceras
                //return response()->download('proyectoeHidra2.pdf',$headers);
        
                //opción añadiendo todos los datos dentro del método
                    //return response()->streamDownload(function(){
                        //$profiles=$this->updateQuery();
                        //$view="livewire.export";
                        //$pdf=PDF::loadView($view,['profiles'=>$profiles]);
                        //echo $pdf->stream();
                    //},'test.pdf');

                //opción grabando en disco y descargando el archivo creado
                    //$profiles=$this->updateQuery();
                    //$view="livewire.export";
                    //$pdf= PDF::loadView($view,['profiles'=>$profiles]);
                    //$pdf->save('proyectoeHidra.pdf');
                    //return response()->download(public_path().'/proyectoeHidra.pdf');
                
        
                //opción similar a la inicial pero falla en algunas versiones de //PHP, por error de sintaxis, ej: versión de PHP7.3.27

                    //$profiles=$this->updateQuery(true);
                    //$profiles=Profiles::get();
                    //$view="livewire.export";
                    //$pdf= PDF::loadView($view,['profiles'=>$profiles])->output();

                    //return response()->streamDownload(
                        //fn()=> print($pdf),"proyectoeHidra.pdf"
                    //);
    }

    //guardar el archivo PDF en el server para después poder enviar por correo 
    //como archivo adjunto
    public function savePDF(){
        $profiles=$this->updateQuery(true);
        //$profiles=Profiles::paginate(10);
        $view="livewire.export";
        $pdf= PDF::loadView($view,['profiles'=>$profiles]);
        $pdf->save('proyectoeHidra.pdf');
    }

    //exportar archivo Excel al navegador del usuario
    public function exportExcel(){
        $profiles=$this->updateQuery(true);        
        //exportar
        return Excel::download(new UsersExports($profiles),'proyectoeHidra.xlsx');
    }

    //guardar archivo Excel en el server para después poder enviar por correo //como archivo adjunto
    public function saveExcel(){
        $profiles=$this->updateQuery(true);
        //grabar en disco
        return  Excel::store(new UsersExports($profiles),'proyectoeHidra.xlsx');
    }

    //Enviar email con opción de enviar documento PDF y/o Excel como archivos adjuntos
    public function sendEmail(){
        $attach=["pdf"=>0,"excel"=>0];
        $validated = $this->validate([
            'emailParaExportar'=>'required|email'
        ]);
        //mensaje de validación de checkbox
        if($this->checkpdf == '' && $this->checkexcel==''){
            session()->flash('check','Es necesario marcar al menos uno');
        }else{
            if($this->checkpdf){
                $this->savePDF();                
                $attach["pdf"]="1";
            }
            if($this->checkexcel){
                $this->saveExcel();                
                $attach["excel"]="1";
            }
        //falta condicional por si falla el servidor de correo
            Mail::to($validated["emailParaExportar"], "eHidra")
            ->send(new Users($attach,$this->authUser));
            //limpiar datos de selección para el envio (correo y archivos adjuntos)
            $this->clearExport();
            $this->emit("closeModalExport");            
            session()->flash('message',"Correo enviado correctamente");    
        }
    }

    //consultas para evento al clicar los th de las columnas que ordenan en asc o 
    //desc respectivamente
    /*
    public function testQuery(){
        //name asc/desc
        $profiles=Profiles::with('user')
        ->join('users','profiles.user_id','=','users.id')
        ->orderBy('users.name',$order)
        ->paginate(10);
        //email
        $profiles=Profiles::with('user')
        ->join('users','profiles.user_id','=','users.id')
        ->orderBy('users.email',$order)
        ->paginate(10);
        //surnames
        $profiles=Profiles::orderBy('surnames',$order)->paginate(10);
        //country
        $profiles=Profiles::orderBy('country',$order)->paginate(10);
        //phone
        $profiles=Profiles::orderBy('phone',$order)->paginate(10);
    }
    */

    //renderizado (livewire)
    public function render()
    {
        $profiles=$this->updateQuery();        

        return view('livewire.profile',['profiles'=>$profiles,'countries'=>$this->countries,'provincias'=>$this->provincias]);
    }
}
