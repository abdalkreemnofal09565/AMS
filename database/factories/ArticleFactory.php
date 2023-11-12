<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'brief_content' => $this->faker->paragraph,
            // Other attributes...
        ];
    }

    // Define the custom 'approved' factory method
    public function approved()
    {
        return $this->state([
            'is_approved' => true,
        ]);
    }
}
