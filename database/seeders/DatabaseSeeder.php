<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Post::factory(20)
        // ->hasComments(rand(12,20))
        // ->create([
        //     'type'=> 'post',
        // ]);

        // Post::factory(10)
        // ->hasComments(rand(12,20))
        // ->create([
        //     'type'=> 'reel',
        // ]);

        // Comment::limit(1)->each(function($comment) {
        //     $comment::factory(rand(1,5))->isReply($comment->commentable)->create(['parent_id' => $comment->id]);
        // });

        // Post::factory()->hasComments(1)->create(['type' => 'post']);
        // $post = Post::factory()->hasComments(1)->create(['type' => 'post']);
        $post = Post::find(3);
        $parentComment =$post->comments->first();
        for ($i=0; $i < 2; $i++) {
           $nestedComment = Comment::factory()->isReply($parentComment->commentable)->create(['parent_id' => $parentComment->id]);
           $parentComment = $nestedComment;
        }
    }
}
