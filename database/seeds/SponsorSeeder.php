<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            $sponsor = new Sponsor();
            $sponsor->name = $faker->name();
            $sponsor->price = $faker->randomFloat(2, 1, 10);
            $sponsor->period = $faker->numberBetween(24, 144);
            $sponsor->save();
        }
    }
}
