<?php

use App\Models\Apartment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for ($i = 0; $i < 10; $i++) {
            $apart = new Apartment();
            $apart->address = $faker->address();
            $apart->description = $faker->realText($maxNbChars = 800, $indexSize = 2);
            $apart->title = $faker->realTextBetween($minNbChars = 100, $maxNbChars = 250, $indexSize = 2);
            $apart->slug = Str::slug($apart->address);
            $apart->image = 'faker/' . $faker->image('storage/app/public/faker', 600, 400, 'Apartments', false, true, $apart->name);
            $apart->n_rooms = $faker->numberBetween(1, 10);
            $apart->n_bathroom = $faker->numberBetween(1, 5);
            $apart->n_bed = $faker->numberBetween(1, 15);
            $apart->square_meters = $faker->numberBetween(80, 300);
            $apart->latitude = $faker->latitude($min = -90, $max = 90);
            $apart->longitude = $faker->longitude($min = -180, $max = 180);
            $apart->visibility = true;
            $apart->save();
        }
    }
}
