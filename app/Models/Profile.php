<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable=[
        "surnames","province","country","phone","file","thumb","file_name","user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
