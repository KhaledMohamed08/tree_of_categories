<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategory = new Category();
        $subcategory->name = 'Sub A1';
        $subcategory->parent_id = 1;
        $subcategory->save();

        $subcategory = new Category();
        $subcategory->name = 'Sub A2';
        $subcategory->parent_id = 1;
        $subcategory->save();
        
        $subcategory = new Category();
        $subcategory->name = 'Sub B1';
        $subcategory->parent_id = 2;
        $subcategory->save();

        $subcategory = new Category();
        $subcategory->name = 'Sub B2';
        $subcategory->parent_id = 2;
        $subcategory->save();
        
        $subcategory = new Category();
        $subcategory->name = 'SUB SUB B2-1';
        $subcategory->parent_id = 6;
        $subcategory->save();

        $subcategory = new Category();
        $subcategory->name = 'SUB SUB B2-2';
        $subcategory->parent_id = 6;
        $subcategory->save();
    }
}
