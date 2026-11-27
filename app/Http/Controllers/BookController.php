<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Listagem de todos os livros
    public function index(Request $request)
    {
        return $this->indexByCategory($request, 0);
    }

    // Filtragem, pesquisa e ordenação
    public function indexByCategory(Request $request, $id)
    {
        $categories = Category::all();

        $search = $request->input('search', '');
        $order = $request->input('order', 'title_asc');

        if ($id == 0) {

            $query = Book::query();

        } else {

            $category = Category::findOrFail($id);

            $query = $category->books();
        }

        // Pesquisa por título ou autor
        if ($search != '') {

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%');

            });
        }

        // Ordenação
        if ($order == 'title_desc') {

            $query->orderBy('title', 'desc');

        } elseif ($order == 'price_asc') {

            $query->orderBy('price', 'asc');

        } elseif ($order == 'price_desc') {

            $query->orderBy('price', 'desc');

        } else {

            $query->orderBy('title', 'asc');
        }

        // Paginação
        $books = $query->orderBy('id')
            ->paginate(8)
            ->withQueryString();

        return view('books.index', [
            'books' => $books,
            'categories' => $categories,
            'activeCategory' => $id,
            'search' => $search,
            'order' => $order
        ]);
    }

    // Detalhes de um livro
    public function show($id)
    {
        $book = Book::findOrFail($id);

        $category = $book->category;

        return view('books.show', [
            'book' => $book,
            'category' => $category
        ]);
    }

    // Formulário de criação
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $categories = Category::all();

        return view('books.create', [
            'categories' => $categories
        ]);
    }

    // Guardar novo livro
    public function store(StoreBookRequest $request)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $book = new Book();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->img = $request->img;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->isbn = $request->isbn;
        $book->publication_year = $request->publication_year;
        $book->category_id = $request->category_id;
        $book->owner_id = Auth::user()->id;

        $book->save();

        return redirect()->route('books.show', $book->id);
    }

    // Eliminar livro
    public function destroy($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $book = Book::findOrFail($id);

        if ($book->sales()->exists()) {

            return redirect()->route('books.show', $id)
                ->with('error', 'Este livro tem compras associadas.');
        }

        $book->delete();

        return redirect()->route('books.index');
    }

    // Formulário de edição
    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $book = Book::findOrFail($id);

        $categories = Category::all();

        return view('books.edit', [
            'book' => $book,
            'categories' => $categories
        ]);
    }

    // Atualizar livro
    public function update(UpdateBookRequest $request, $id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $book = Book::findOrFail($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->img = $request->img;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->isbn = $request->isbn;
        $book->publication_year = $request->publication_year;
        $book->category_id = $request->category_id;

        $book->save();

        return redirect()->route('books.show', $book->id);
    }
}
