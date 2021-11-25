<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 100;
        $width = 640;
        $height = 480;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('recipes')->insert([
                'title' => $faker->name,
                'image' => $faker->imageUrl($width, $height, 'cats'),
                'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'user_id' => 1,
                'created_at' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}
