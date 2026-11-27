<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('books')->insert([
            'title' => 'O Hobbit',
            'author' => 'J. R. R. Tolkien',
            'description' => 'Uma aventura pela Terra Média.',
            'img' => '/img/books/hobbit.jpg',
            'price' => 14.99,
            'stock' => 20,
            'isbn' => '9780547928227',
            'publication_year' => 1937,
            'owner_id' => 1,
            'category_id' => 1
        ]);

        DB::table('books')->insert([
            'title' => 'O Senhor dos Anéis',
            'author' => 'J. R. R. Tolkien',
            'description' => 'Uma missão para destruir um anel poderoso.',
            'img' => '/img/books/senhor_aneis.jpg',
            'price' => 24.99,
            'stock' => 15,
            'isbn' => '9780544003415',
            'publication_year' => 1954,
            'owner_id' => 1,
            'category_id' => 1
        ]);

        DB::table('books')->insert([
            'title' => 'Orgulho e Preconceito',
            'author' => 'Jane Austen',
            'description' => 'Uma história sobre amor e sociedade.',
            'img' => '/img/books/orgulho.jpg',
            'price' => 12.99,
            'stock' => 12,
            'isbn' => '9780141439518',
            'publication_year' => 1813,
            'owner_id' => 1,
            'category_id' => 2
        ]);

        DB::table('books')->insert([
            'title' => 'Jane Eyre',
            'author' => 'Charlotte Bronte',
            'description' => 'Uma história de independência e amor.',
            'img' => '/img/books/jane_eyre.jpg',
            'price' => 13.99,
            'stock' => 10,
            'isbn' => '9780141441146',
            'publication_year' => 1847,
            'owner_id' => 1,
            'category_id' => 2
        ]);

        DB::table('books')->insert([
            'title' => '1984',
            'author' => 'George Orwell',
            'description' => 'Uma sociedade controlada por um regime totalitário.',
            'img' => '/img/books/1984.jpg',
            'price' => 11.99,
            'stock' => 25,
            'isbn' => '9780451524935',
            'publication_year' => 1949,
            'owner_id' => 1,
            'category_id' => 3
        ]);

        DB::table('books')->insert([
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'description' => 'Uma aventura num planeta desértico.',
            'img' => '/img/books/dune.jpg',
            'price' => 19.99,
            'stock' => 18,
            'isbn' => '9780441172719',
            'publication_year' => 1965,
            'owner_id' => 1,
            'category_id' => 3
        ]);

        DB::table('books')->insert([
            'title' => 'Crime no Expresso do Oriente',
            'author' => 'Agatha Christie',
            'description' => 'Um mistério investigado por Hercule Poirot.',
            'img' => '/img/books/expresso.jpg',
            'price' => 15.99,
            'stock' => 14,
            'isbn' => '9780062693662',
            'publication_year' => 1934,
            'owner_id' => 1,
            'category_id' => 4
        ]);

        DB::table('books')->insert([
            'title' => 'O Cão dos Baskervilles',
            'author' => 'Arthur Conan Doyle',
            'description' => 'Uma investigação de Sherlock Holmes.',
            'img' => '/img/books/baskervilles.jpg',
            'price' => 10.99,
            'stock' => 16,
            'isbn' => '9780140437867',
            'publication_year' => 1902,
            'owner_id' => 1,
            'category_id' => 4
        ]);
    }
}
