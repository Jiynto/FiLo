<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //instance of the Faker class named $faker
      $faker = Faker::create();

      //getting existing user ids into $users $array
      $users = User::all()->pluck('id')->toArray();

      //generate 10 records for the items table
      foreach (range(1,10) as $index)
      {
        DB::table('items')->insert
        ([
          'userid' => $faker->randomElement($users),
          'found_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
          'found_time' => $faker->time($format = 'H:i:s', $max = 'now'),
          'category' => $faker->randomElement(config('enums.itemCategory')),
          'found_place' => $faker->address(),
          'color' =>  $faker->randomElement(config('enums.itemColor')),
        ]);
      }



    }
}
