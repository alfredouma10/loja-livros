<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    // Mostrar as compras do cliente
    public function index()
    {
        if (Auth::user()->isAdmin) {
            abort(403);
        }

        $user = Auth::user();

        $sales = $user->sales;

        return view('sales.index', [
            'sales' => $sales
        ]);
    }

    // Comprar um livro
    public function store($id)
    {
        if (Auth::user()->isAdmin) {
            abort(403);
        }

        $client = Auth::user();

        $book = Book::findOrFail($id);

        if ($book->stock <= 0) {

            return back()->with(
                'error',
                'Este livro encontra-se esgotado.'
            );
        }

        $sale = new Sale();

        $sale->client_id = $client->id;
        $sale->book_id = $book->id;
        $sale->date = now();

        $sale->save();

        $book->stock = $book->stock - 1;

        $book->save();

        return redirect()->route('sales.index')
            ->with('success', 'Compra realizada com sucesso!');
    }
}
