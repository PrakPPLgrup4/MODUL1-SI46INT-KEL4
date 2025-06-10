<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AppointmentCategorySeeder::class,
            AppointmentSlotSeeder::class,
            VoucherSeeder::class,
            PsychiatristSeeder::class,

        ]);
        // Seed the admin user
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }
}
