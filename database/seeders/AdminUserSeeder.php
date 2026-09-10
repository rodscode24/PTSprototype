<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the local admin user.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('dev_admin.email')],
            [
                'name' => 'PTS Admin',
                'password' => Hash::make(config('dev_admin.password')),
                'is_admin' => true,
            ]
        );
    }
}
