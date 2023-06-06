<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // $cns = new ColorNamingService;
        
        DB::table('users')->insert([
            'name' => 'Briedis',
            'email' => 'briedis@gmail.com',
            'role' => 1,
            // briedis bus adminas
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Bebras',
            'email' => 'bebras@gmail.com',
            'role' => 10,
            // bebras-klientas
            'password' => Hash::make('123'),
        ]);

        // foreach([
        //     'Kreivas raktas',
        //     'Beratis',
        //     'Karma',
        //     'Demontas',
        //     'Profikai'
        // ] as $cats => $title) {
        //     DB::table('cats')->insert([
        //         'title' => $title,
        //         'address' => $address,
        //         'phoneNumber ' => $phoneNumber ,
               
        //     ]);
        // }

        // foreach(range(1, 20) as $_) {
        //     $catId = rand(1, 5);
        //     $id = DB::table('services')->insertGetId([
        //         'title' => $faker->cityPrefix. ' ' .$faker->streetSuffix,
        //         'price' => rand(100, 5000) / 100,
        //         'cat_id' => $catId
        //     ]);

            // foreach(range(1, $catId) as $_) {
            //     $hex = $faker->hexcolor;
            //     DB::table('colors')->insert([
            //         'hex' => $hex,
            //         'title' => $cns->nameIt(substr($hex, 1)),
            //         'product_id' => $id
            //     ]);
            // }

    //     }

    }
}