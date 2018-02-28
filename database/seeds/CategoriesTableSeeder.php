<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 4)->create();
        $faker = Faker::create();
        for ($i=0; $i<8; $i++) {
            DB::table('categories')->insert([
                [
                    'name' => $faker->name,
                    'parent_id' => $faker->randomElement($array = array(1, 2, 3, 4)),
                    'created_at' => new Datetime(),
                ]
            ]);
        }
    }
}
