<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'content' => 'This is a comment on the first article.',
            'user_id' => 1, // Associate with a user by user ID
            'article_id' => 1, // Associate with an article by article ID
        ]);
    }
}
