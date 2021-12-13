<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->realText(rand(10, 15)),
            'user_id' => $this->faker->numberBetween(1, 3),
            'user_name' => $this->faker->name(),
            'post_id' => $this->faker->numberBetween(6, 10),
        ];
    }
}
