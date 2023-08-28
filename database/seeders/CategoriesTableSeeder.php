<?php

namespace Database\Seeders;

use App\Domains\Category\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootCategory = Category::create([
            'name' => 'Root Category',
            'creator_id' => 1,
            'description' => 'This is the root category.',
        ]);

        // Create child categories under the root category
        Category::create([
            'name' => 'Child Category 1',
            'creator_id' => 1,
            'description' => 'This is a child category.',
            'parent_id' => $rootCategory->id,
        ]);

        Category::create([
            'name' => 'Child Category 2',
            'creator_id' => 1,
            'description' => 'This is another child category.',
            'parent_id' => $rootCategory->id,
        ]);
    }
}