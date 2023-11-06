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
        foreach (Role::cases() as $role) {
            $newRole = ModelsRole::create(['code' => $role->value]);
            $newUser = User::create([
                'username' => Role::from($newRole->code)->name,
                'password' => Hash::make(Role::from($newRole->code)->name),
            ]);

            $newUser->roles()->attach($newRole->id);
        }

        Request::create([
            'subject' => 'سلام',
            'description' => 'سلام سلام',
            'user_id' => 1
        ]);
        Request::create([
            'subject' => 'سلام',
            'description' => 'سلام سلام',
            'user_id' => 2
        ]);
        Request::create([
            'subject' => 'سلام',
            'description' => 'سلام سلام',
            'user_id' => 3
        ]);
    }
}
