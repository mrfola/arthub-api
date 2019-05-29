<?php

use Illuminate\Database\Seeder;

class ArtworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $artwork = factory(App\Artwork::class, 50)->create([
            'user_id' => $this->getRandomUserId()
        ]);
    }

    private function getRandomUserId() {
        $user = \App\User::inRandomOrder()->first();
        return $user->id;
    }


 
}
