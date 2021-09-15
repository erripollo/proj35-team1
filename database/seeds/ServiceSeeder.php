<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $services = [
            [
                'name' => 'WIFI',
                'icon' => 'fas fa-wifi',
            ],
            [
                'name' => 'Cucina',
                'icon' => 'fas fa-utensils',
            ],
            [
                'name' => 'Piscina',
                'icon' => 'fas fa-swimmer',
            ],
            [
                'name' => 'Sauna',
                'icon' => 'fas fa-hot-tub',
            ],
            [
                'name' => 'Aria condizionata',
                'icon' => 'fas fa-snowflake',
            ],
            [
                'name' => 'Riscaldamento',
                'icon' => 'fas fa-temperature-high',
            ],
            [
                'name' => 'Lavatrice',
                'icon' => 'fas fa-tshirt',
            ],
            [
                'name' => 'TV',
                'icon' => 'fas fa-tv',
            ],
            [
                'name' => 'Parchegio',
                'icon' => 'fas fa-parking',
            ],
            [
                'name' => 'Animali domestici ammessi',
                'icon' => 'fas fa-paw',
            ],
            [
                'name' => 'Area fumatori',
                'icon' => 'fas fa-smoking',
            ],
            [
                'name' => 'Giardino',
                'icon' => 'fas fa-seedling',
            ],
            [
                'name' => 'Colazione inclusa',
                'icon' => 'fas fa-mug-hot',
            ],
            [
                'name' => 'Camino',
                'icon' => 'fas fa-fire',
            ],
            [
                'name' => 'Vicino alle piste da sci',
                'icon' => 'fas fa-skiing',
            ],
            [
                'name' => 'Vista mare',
                'icon' => 'fas fa-water',
            ],
                
        ];


        foreach($services as $service){
            $serv = new Service();
            $serv->name = $service['name'];
            $serv->icon = $service['icon'];
            $serv->save();
        }
    }
}
