<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services_arrey = [
            [
                'name' => 'TV',
                'icon' => 'tv',
            ],
            [
                'name' => 'Wifi',
                'icon' => 'wifi',
            ],
            [
                'name' => 'Posto Macchina',
                'icon' => 'car',
            ],
            [
                'name' => 'Ascensore',
                'icon' => 'ascensore',
            ],
            [
                'name' => 'Cucina',
                'icon' => 'cucina',
            ],
            [
                'name' => 'Aria condizionata',
                'icon' => 'aria_condizionata',
            ],
            [
                'name' => 'Giardino',
                'icon' => 'giardino',
            ],
            [
                'name' => 'Vista mare',
                'icon' => 'mare',
            ],
            [
                'name' => 'Sauna',
                'icon' => 'sauna',
            ],
            [
                'name' => 'Portineria',
                'icon' => 'portineria',
            ],
            [
                'name' => 'Piscina',
                'icon' => 'pool',
            ],
        ];

        foreach ($services_arrey as $i){
            $_item = new Service();
            $_item->name = $i['name'];
            $_item->icon = $i['icon'];
            $_item-> save();
        }
    }
}



