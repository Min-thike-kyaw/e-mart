<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CategorySeeder::class);
        \App\Models\User::factory(50)->create();
        \App\Models\Banner::factory(20)->create();
        \App\Models\Brand::factory(20)->create();
        \App\Models\Product::factory(40)->create();
    }
}
