<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            // 'body' => '<p>' . implode('</p><p>' ,$this->faker->paragraphs(mt_rand(5,10))) . '</p>',
            'body' => collect($this->faker->paragraphs(mt_rand(5,10))) //membuat 5 sampai 10 paragraphs
                        ->map(fn($p) => "<p>$p</p>") // setiap paragraphs bungkus dengan tag <p>
                        ->implode(''),
            'user_id' => mt_rand(1,5),
            'category_id' => mt_rand(1,4)
        ];
    }
}
