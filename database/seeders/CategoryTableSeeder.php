<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $html = new Category();
        $html->name = 'HTML';
        $html->slug = 'html';
        $html->save();

        $css = new Category();
        $css->name = 'CSS';
        $css->slug = 'css';
        $css->save();

        $php = new Category();
        $php->name = 'PHP';
        $php->slug = 'php';
        $php->save();
    }
}