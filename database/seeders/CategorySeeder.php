<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'novel',
            'biografi',
            'sejarah',
            'ilmiah',
            'komputer',
            'pendidikan'
        ];

        collect($categories)->each(function($category){
            Category::query()->updateOrCreate(['name' => $category]);
        });
    }
}
