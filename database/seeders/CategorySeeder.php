<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([

            [
                'title' => 'Electronic device',
                'slug' => 'electronic-device',
                'is_parent' => true,
                'parent_id'=> null,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],
            [
                'title' => 'Health and beauty',
                'slug' => 'health-and-beauty',
                'is_parent' => true,
                'parent_id'=> null,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],
            [
                'title' => 'Women Fashiom',
                'slug' => 'women-fashion',
                'is_parent' => true,
                'parent_id'=> null,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],
            [
                'title' => 'Men Fashiom',
                'slug' => 'men-fashion',
                'is_parent' => true,
                'parent_id'=> null,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],

        ]);
        DB::table('categories')->insert([
            [
                'title' => 'Mobile',
                'slug' => 'mobile',
                'is_parent' => false,
                'parent_id'=> Category::where('slug','electronic-device')->first()->id,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],
            [
                'title' => 'laptop',
                'slug' => 'laptop',
                'is_parent' => false,
                'parent_id'=> Category::where('slug','electronic-device')->first()->id,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],
            [
                'title' => 'Hair Care',
                'slug' => 'hair-care',
                'is_parent' => false,
                'parent_id'=> Category::where('slug','health-and-beauty')->first()->id,
                'summary' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat reprehenderit consequuntur itaque modi sapiente minus, nam molestias esse necessitatibus laborum ducimus distinctio, sint vitae quos, suscipit error mollitia vero similique!',
                'status' => 'active'
            ],

        ]);
    }
}
