<?php

namespace Database\Seeders;

use App\Models\Seller\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seller = Seller::create([
            'name' => 'Super Admin',
            'phone_number' => '01631059183',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        $seller->assignRole(1);
    }
}
