<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Profile;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExports implements FromView
{
    //datos users(eloquent)
    protected $data;
    public function __construct($data=null){
        $this->data=$data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function collection()
    {
        return $this->data;
    }

    public function view():View{
        return view('livewire.excel',['profiles'=>$this->data]);
    }
}
