<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $randomNum = random_int(1, 100);

        DB::table('posts')->insert([
            [
                'id' => '01JMVBDR3Y7KFH3Y34Y4RCCTRT',
                'title' => 'Judul Post Pertama',
                'category_name' => 'Kategori Pertama',
                'slug' => 'judul-post-pertama',
                'body' => 'Isi post pertama',
                'photo' => null,
                'views' => $randomNum,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => '01JMVBDR3YY9S8XQ3TXSC1EW2C',
                'title' => 'Judul Post Kedua',
                'category_name' => 'Kategori Kedua',
                'slug' => 'judul-post-kedua',
                'body' => 'Isi post kedua',
                'photo' => null,
                'views' => $randomNum,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
