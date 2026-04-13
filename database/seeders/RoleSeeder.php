<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $user = User::find(1);
        if ($user) {
            $user->is_admin = true;
            $user->save();
        }
    }
}