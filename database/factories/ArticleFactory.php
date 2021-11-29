<?php

namespace Database\Factories;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model  = Article::class; 

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(30), 
            'text' => $this->faker->text()
        ];
    }
}
