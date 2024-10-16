<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // berikan nama indonesia
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name' => $faker->name,
                'email'    => $faker->email,
                'password' => $faker->password,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
            ];

            // Using Query Builder
            $this->db->table('customer')->insert($data);
        }
    }
}
