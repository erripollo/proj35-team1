<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) { 
            $apartment = new Apartment();
            $apartment-> title = $faker->words(5, true);
            $apartment-> address = $faker-> streetAddress();
            $apartment-> latitude = $faker-> latitude($min = -90, $max = 90);
            $apartment-> longitude = $faker-> longitude($min = -180, $max = 180);
            $apartment-> image = $faker->imageUrl(360, 200, 'Apartments', true, $apartment->title);
            $apartment-> description = $faker-> paragraphs(3, true);
            $apartment-> n_rooms = $faker-> randomDigitNotNull();
            $apartment-> n_baths = $faker-> randomDigitNotNull();
            $apartment-> n_beds = $faker-> randomDigitNotNull();
            $apartment-> square_meters = $faker-> numberBetween(30, 400);
            $apartment-> visible = $faker-> boolean();
            $apartment->save();
        }
    }
}
