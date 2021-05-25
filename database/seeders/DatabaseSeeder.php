<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Creamos un UserSeeder y añadimos un usuario antes del factory.
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class
        ]);
    }   
}
