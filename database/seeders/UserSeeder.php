<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@themesbrand.com',
            'dob' => Carbon::createFromDate('1989','12','14'),
            'password' => Hash::make('12345678'),
            'user_type' => UserTypeEnum::ADMIN(),
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
