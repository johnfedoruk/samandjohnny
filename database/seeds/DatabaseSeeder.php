<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;
    protected function seedUsers() {
      $registerController = new RegisterController();
      $registerController->register(
        Request::create(
          "",
          "",
          [
            "name" => "johnny",
            "email" => "johnny@johnfedoruk.ca",
            "password" => "password",
            "password_confirmation" => "password"
          ]
        )
      );
      foreach(range(1,10) as $index) {
        $registerController = new RegisterController();
        $registerController->register(
          Request::create(
            "",
            "",
            [
              "name" => $this->faker->name,
              "email" => $this->faker->email,
              "password" => "password",
              "password_confirmation" => "password"
            ]
          )
        );
      }
    }
    protected function seedCategories() {
      $categories = [
        "Hacking","Software Engineering","Servers","Microcontrollers","Science"
      ];
      foreach($categories as $category) {
        $categoryController = new CategoryController();
        $categoryController->store(
          Request::create(
            "",
            "",
            [
              "name"=>$category
            ]
          )
        );
      }
    }
    protected function seedPosts() {
      foreach(range(1,100) as $index) {
        $postController = new PostController();
        // store in the Database
        $postController->store(
          Request::create(
            "",
            "",
            [
              "title" => $this->faker->word." ".$this->faker->word." ".$this->faker->word,
              "body" => $this->faker->paragraph.$this->faker->paragraph,
              "category_id" => rand(1,5)
            ]
          )
        );
      }
    }
    protected function seedTags() {

    }
    protected function seedPostTag() {
      
    }
    public function run()
    {
      // $this->call(UsersTableSeeder::class);
      $this->faker = Faker::create("en_US");
      $this->seedUsers();
      $this->seedCategories();
      $this->seedPosts();
      $this->seedTags();
    }
}
