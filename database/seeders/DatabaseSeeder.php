<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name'    => 'Sofia',
            'email'   => 'Sofia@gmail.com',
            'password'=> bcrypt('123456'),
        ]);
        Post::factory()->count(24)->create();
    }
}
