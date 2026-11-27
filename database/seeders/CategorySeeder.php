<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Fantasia',
            'description' => 'Livros de mundos imaginários e aventuras.',
            'img' => '/img/categories/fantasia.jpg'
        ]);

        DB::table('categories')->insert([
            'name' => 'Romance',
            'description' => 'Histórias de amor e relações humanas.',
            'img' => '/img/categories/romance.jpg'
        ]);

        DB::table('categories')->insert([
            'name' => 'Ficção Científica',
            'description' => 'Histórias sobre ciência e tecnologia.',
            'img' => '/img/categories/ficcao.jpg'
        ]);

        DB::table('categories')->insert([
            'name' => 'Mistério',
            'description' => 'Histórias de investigação e suspense.',
            'img' => '/img/categories/misterio.jpg'
        ]);
    }
}
