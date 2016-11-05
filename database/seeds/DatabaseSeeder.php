<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker::create();
        foreach(range(1,100) as $index) {
          // store in the Database
          $post = new Post;

          $post->title = $faker->word." ".$faker->word." ".$faker->word;
          $post->body = $faker->paragraph;

          $post->save();
          /*
          DB::table("posts")->insert(
            [
              "title" => $faker->word." ".$faker->word." ".$faker->word,
              "body" => $faker->paragraph
            ]
          );
          */
        }
    }
}
