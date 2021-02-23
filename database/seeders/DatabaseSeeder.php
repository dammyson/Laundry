<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $services = [
            array(
                "name" => "Gown",
                "washing_price" =>1000,
                "ironing_price" =>  1000,
                "cleaning_price" =>2000,
                "exp_washing_price" =>  1200,
                "exp_ironing_price" =>1200,
                "exp_cleaning_price" =>  2400,
            ),
            array(
                "name" => "Shirt",
                "washing_price" =>1000,
                "ironing_price" =>  1000,
                "cleaning_price" =>2000,
                "exp_washing_price" =>  1200,
                "exp_ironing_price" =>1200,
                "exp_cleaning_price" =>  2400,
            ),
        ];
        return \DB::transaction(function () use ($services)  {
        foreach ($services as $service) {
            Service::create([
                'name' => $service['name'],
                'washing_price' => $service['washing_price'],
                'ironing_price' => $service['ironing_price'],
                'cleaning_price' => $service['cleaning_price'],
                'exp_washing_price' => $service['exp_washing_price'],
                'exp_ironing_price' => $service['exp_ironing_price'],
                'exp_cleaning_price' => $service['exp_cleaning_price'],
            ]);
        }
    });

}
}
