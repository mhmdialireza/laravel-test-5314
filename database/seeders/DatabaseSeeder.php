<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role as ModelsRole;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->run([

        // ]);
        $newUser = User::create([
            'username' => 'کاربر',
            'password' => Hash::make(1234),
            'role' => 0
        ]);
        $newUser = User::create([
            'username' => 'سرپرست',
            'password' => Hash::make(1234),
            'role' => 1
        ]);
        $newUser = User::create([
            'username' => 'مدیر',
            'password' => Hash::make(1234),
            'role' => 2
        ]);


        Request::create([
            'subject' => 'سلام',
            'description' => 'سلام سلام',
            'user_id' => 1,
            'importance' => 0
        ]);
        Request::create([
            'subject' => '2سلام',
            'description' => 'سلام سلام',
            'user_id' => 2,
            'importance' => 2
        ]);
        Request::create([
            'subject' => '3سلام',
            'description' => 'سلام سلام',
            'user_id' => 3,
            'importance' => 1
        ]);
        Request::create([
            'subject' => '4سلام',
            'description' => 'سلام سلام',
            'user_id' => 3,
            'importance' => 0
        ]);
    }
}
