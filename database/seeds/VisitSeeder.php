<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Visit;
class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) { 
            $visit = new Visit();
            $visit-> ip_address = $faker->ipv4();
            $visit-> date = $faker->dateTimeBetween('-1 week', '+1 week');
            $visit->save();
        }
    }
}
