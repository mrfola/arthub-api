<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $comments= factory(App\Comment::class, 100)->create([
            'user_id' => $this->getRandomUserId(),
            'artwork_id' => $this->getRandomArtworkId()
        ]);
    }

    private function getRandomUserId() {
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }

       private function getRandomArtworkId() {
        $artwork = \App\Artwork::inRandomOrder()->first();
        return $artwork->id;
    }
}
