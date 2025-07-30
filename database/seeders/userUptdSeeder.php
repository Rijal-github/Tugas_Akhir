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

        $uptdUser2 = User::where('email', 'ogog123@example.com')->first();
        $uptdUser3 = User::where('email', 'sudrajat@example.com')->first();

        DB::table('users_uptd')->insert([
            ['user_id' => $uptdUser2->id, 'id_uptd' => 1],
            ['user_id' => $uptdUser3->id, 'id_uptd' => 3],
        ]);
    }
}
