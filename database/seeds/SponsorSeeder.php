<?php

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'name' => 'Bronze',
                'price' => 2.99,
                'duration' => 24
            ],
            [
                'name' => 'Silver',
                'price' => 5.99,
                'duration' => 72
            ],
            [
                'name' => 'Gold',
                'price' => 9.99,
                'duration' => 144
            ]
        ];

        foreach ($sponsors as $sponsor) {
            $_sponsor = new Sponsor();
            $_sponsor->name = $sponsor['name'];
            $_sponsor->price = $sponsor['price'];
            $_sponsor->duration = $sponsor['duration'];
            $_sponsor->save();
        }
    }
}
