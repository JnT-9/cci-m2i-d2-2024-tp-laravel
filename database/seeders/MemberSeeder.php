<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->createOne();

        // Pokemon
        User::factory()
            ->count(100)
            ->create([
                'user_id' => $user->id,
            ]);
    }
}
