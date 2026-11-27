<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Listagem pública das categorias
    public function publicIndex()
    {
        $categories = Category::all();

        return view('categories.public', [
            'categories' => $categories
        ]);
    }

    // Detalhes públicos de uma categoria
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $books = $category->books;

        return view('categories.show', [
            'category' => $category,
            'books' => $books
        ]);
    }

    // Listagem administrativa das categorias
    public function index()
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    // Formulario de criacao
    public function create()
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        return view('categories.create');
    }


    // Guardar categoria
public function store(StoreCategoryRequest $request)
{
    $category = new Category();

    $category->name = $request->name;
    $category->description = $request->description;
    $category->img = $request->img;

    $category->save();

    return redirect('/catalogo/categorias');
}

    // Eliminar categoria

public function destroy($id)
{
    if (!Auth::user()?->isAdmin) {
        abort(403);
    }

    $category = Category::findOrFail($id);

    if ($category->books()->exists()) {

        return redirect('/catalogo/categorias')
            ->with('error',
                'Não podes eliminar uma categoria com livros associados.');
    }

    $category->delete();

    return redirect('/catalogo/categorias')
        ->with('success', 'Categoria eliminada com sucesso.');
}

    // Formulario de edicao
    public function edit($id)
    {
        if (!Auth::check() || !Auth::user()->isAdmin) {
            abort(403);
        }

        $category = Category::findOrFail($id);

        return view('categories.create', [
            'category' => $category
        ]);
    }

    // Atualizar categoria
public function update(UpdateCategoryRequest $request, $id)
{
    $category = Category::findOrFail($id);

    $category->name = $request->name;
    $category->description = $request->description;
    $category->img = $request->img;

    $category->save();

    return redirect('/catalogo/categorias');
}
}
