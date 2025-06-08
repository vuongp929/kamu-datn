<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    \App\Models\User::create([
        'name' => 'Admin',
        'address' => 'tbtb',
        'email' => 'admin@example.com',
        'password' => bcrypt('123456'),
        // Các field khác nếu có như: gioi_tinh, dia_chi, ngay_sinh, chuc_vu_id...
    ]);
}

}
