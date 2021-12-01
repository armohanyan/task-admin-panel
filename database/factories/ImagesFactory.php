<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model  = Images::class; 

    public function definition()
    {
        return [
            'article_id' => $this->faker->numberBetween(1,5),
            'image' => 'default.png'
        ];
    }
}
