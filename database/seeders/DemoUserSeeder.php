<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('username', 'demo')->exists()) {
            User::create([
                'name' => 'Demo User',
                'username' => 'demo',
                'password' => Hash::make('password'),
                'level' => 'admineaudit',
            ]);
            $this->command->info('User "demo" created successfully.');
        } else {
            $this->command->info('User "demo" already exists.');
        }
    }
}
