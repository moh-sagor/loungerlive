<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    public function run(): void
    {
        Blog::factory()->times(0)->create();
    }
}