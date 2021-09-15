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
    public function run()
    {
        
        $sponsors=[

            [
                'name' => 'Basic',
                'price'	=> 2.99,
                'period'=> 24
            ],
            [
                'name' => 'Plus',
                'price'	=> 5.99,
                'period'=> 72
            ],
            [
                'name' => 'Premium',
                'price'	=> 9.99,
                'period'=> 144
            ],
        ];      
        
        foreach ($sponsors as $sponsor) {
            
            $spons = new Sponsor();
            $spons->name = $sponsor['name'];
            $spons->price = $sponsor['price'];
            $spons->period = $sponsor['period'];
            $spons->save();
        }
    }
}
