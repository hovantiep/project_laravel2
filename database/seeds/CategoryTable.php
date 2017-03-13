<?php

use Illuminate\Database\Seeder;
use project2\Category;

class CategoryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production') {
            exit('I just stopped you getting fired. Love, Amo.');
        }
//
//        DB::table('categories')->truncate();
        for ($i = 1; $i <= 10; $i++) {
            Category::create([
                'name' => "Danh mục $i",
                'slug' => "danh-muc-$i",
                'parent_id' => "0",
            ]);
        }
    }
}
