<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class userUptdSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $uptdUser = User::where('email', 'yudi@example.com')->first();
        $uptdUser2 = User::where('email', 'sutrisno@example.com')->first();

        DB::table('users_uptd')->insert([
            ['user_id' => $uptdUser->id, 'id_uptd' => 2],
            ['user_id' => $uptdUser2->id, 'id_uptd' => 1],
        ]);
    }
}
