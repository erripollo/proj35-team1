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
        $services = ['WIFI', 'Cucina','Piscina', 'Sauna', 'Aria Condizionata', 'Asciugatrice', 'Riscaldamento', 'Lavatrice', 'TV', 'Asciugacapelli', 'Parcheggio', 'Animali domestici ammessi', 'È vietato fumare', 'Giardino', 'Terrazza', 'Colazione', 'Camino','Accesso diretto alle piste da sci', 'Vista mare'];
        foreach($services as $service){
            $serv = new Service();
            $serv->name = $service;
            $serv->save();
        }
    }
}
