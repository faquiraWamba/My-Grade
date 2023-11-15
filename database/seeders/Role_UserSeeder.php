<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::where('id', '>', 538)->get();

        foreach ($users as $user) {
            DB::table('role__users')->insert([
                'user_id' => $user->id,
                'role_id' => 2
            ]);
        }
    }
}
