<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factory;
use App\Models\Profile;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"xip",
            "email"=>"bahiaxip@hotmail.com",
            "password"=>bcrypt("laravel8")
        ]);
        Profile::create([
            "surnames"=>"bahiaxip",
            "phone"=>"+34627646625",
            "province"=>"Córdoba",
            "country"=>"España",
            "user_id"=>1,
            "file"=>"img/person.png",
            "thumb"=>"img/person.png",
            "file_name"=>"imagen usuario"
        ]);

        User::factory()->count(100)->create()
        //Estableciendo el user_id del perfil relacionado con cada usuario            
            ->each(function ($u){
                Profile::factory()->count(1)->create([
                    "user_id"=>$u->id
                ]);
        });
        
    }
}
