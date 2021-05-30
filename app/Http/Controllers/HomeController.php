<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function verification(){        

        return view('verification');
    }

    /*
    public function exportPDF(){
        //$pdf=app('dompdf.wrapper');
        $profiles=Profile::all();

        //$pdf->loadHTML('<h1>Styde.net</h1>');
        $view="livewire.profile";
        $pdf=\PDF::loadView($view,['profiles'=>$profiles]);
        return $pdf->stream('mi-archivo.pdf');
    }
    */
}
