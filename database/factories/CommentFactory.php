<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Pest\Laravel\put;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'commentable_id' => Post::factory(),
            'commentable_type' => Post::class,
            'body' => $this->faker->paragraph(),
            'user_id' => rand(1, 4),
        ];
    }

    public function isReply(Post $post) {
        return $this->state(function($attributes) use($post) {
            return [
                'commentable_id' => $post->id,
                'commentable_type' => Post::class,
            ];
        });
    }
}
