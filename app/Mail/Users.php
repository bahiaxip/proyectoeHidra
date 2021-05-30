<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Users extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //array datos adjuntos (pdf y/o excel)
    public $attach;
    //datos usuarios (eloquent)
    public $user;
    public function __construct($attach,$user)
    {
        $this->attach=$attach;
        $this->user=$user;
    }
    
    public function build()
    {
        $mail=$this->from("proyectoeHidra@gmail.com")
                ->view('livewire.viewemail')
                ->with("user",$this->user);        
                if(isset($this->attach["pdf"]) && $this->attach["pdf"]=="1"){
                    $mail->attach(public_path('proyectoeHidra.pdf'),[
                        'as'=>'proyectoeHidra.pdf',
                        'mime'=>'application/pdf'
                    ]);
                }
                if(isset($this->attach["excel"]) && $this->attach["excel"]=="1"){
                    $mail->attach(public_path('proyectoeHidra.xlsx'));    
                }
                
        return $mail;
    }
}
