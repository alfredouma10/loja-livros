<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {

    $categories = Category::all();

    return view('welcome', [
        'categories' => $categories
    ]);

})->name('home');


// Categorias públicas
Route::get('/catalogo/categorias',
    [CategoryController::class, 'publicIndex'])
    ->name('categories.public');

// Detalhes públicos de uma categoria
Route::get('/catalogo/categorias/{id}',
    [CategoryController::class, 'show'])
    ->name('categories.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Página de contactos
Route::get('/contacts',
    [ContactController::class, 'index'])
    ->name('contacts');

// Enviar mensagem de contacto
Route::post('/contacts',
    [ContactController::class, 'send'])
    ->middleware('throttle:5,1')
    ->name('contacts.send');


// Listagem dos livros
Route::get('/books', [BookController::class, 'index'])
    ->name('books.index');

// Criar livro
Route::get('/books/create', [BookController::class, 'create'])
    ->middleware('auth')->name('books.create');

// Guardar livro
Route::post('/books', [BookController::class, 'store'])
    ->middleware('auth')->name('books.store');

// Detalhes do livro
Route::get('/books/{id}', [BookController::class, 'show'])
    ->name('books.show');

// Eliminar livro
Route::delete('/books/{id}', [BookController::class, 'destroy'])
    ->middleware('auth')->name('books.destroy');

// Editar livro
Route::get('/books/{id}/edit', [BookController::class, 'edit'])
    ->middleware('auth')->name('books.edit');

// Atualizar livro
Route::put('/books/{id}', [BookController::class, 'update'])
    ->middleware('auth')->name('books.update');


// Listagem das categorias
Route::get('/categories', [CategoryController::class, 'index'])
    ->middleware('auth')->name('categories.index');

// Criar categoria
Route::get('/categories/create', [CategoryController::class, 'create'])
    ->middleware('auth')->name('categories.create');

// Guardar categoria
Route::post('/categories', [CategoryController::class, 'store'])
    ->middleware('auth')->name('categories.store');

// Eliminar categoria
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
    ->middleware('auth')->name('categories.destroy');

// Editar categoria
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
    ->middleware('auth')->name('categories.edit');

// Atualizar categoria
Route::put('/categories/{id}', [CategoryController::class, 'update'])
    ->middleware('auth')->name('categories.update');

// Filtrar livros por categoria
Route::get('/categories/{id}/books', [BookController::class, 'indexByCategory'])
    ->name('categories.books');



    // Consultar as minhas compras
Route::get('/sales', [SaleController::class, 'index'])
    ->middleware('auth')->name('sales.index');

// Comprar um livro
Route::post('/sales/{id}', [SaleController::class, 'store'])
    ->middleware('auth')->name('sales.store');


require __DIR__.'/auth.php';
