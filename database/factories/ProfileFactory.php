<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Classes\Paises;
class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;
    

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {       
        $paises=new Paises();
        $pais=$paises->all;
        $rand_country=$pais[array_rand($pais)];
        $provincias=$paises->provincias;
        $rand_province=$provincias[array_rand($provincias)];
        return [
            'surnames' => $this->faker->name(),
            'phone'=>$this->faker->PhoneNumber(),
            'province' => $rand_province,
            'country' => $rand_country,            
            'file' => "img/person.png",
        ];
    }
}
