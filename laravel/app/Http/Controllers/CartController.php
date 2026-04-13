<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);

        // Si on arrive avec book_id (depuis details page), on ajoute/met à jour
        if ($request->filled('book_id')) {
            $bookId  = $request->book_id;
            $qty     = max(1, (int) $request->get('quantity', 1));
            $cart[$bookId] = ($cart[$bookId] ?? 0) + $qty;
            session(['cart' => $cart]);
        }

        $books = Book::whereIn('id', array_keys($cart))->with('authors')->get()
            ->keyBy('id');

        $items = collect($cart)->map(fn($qty, $id) => [
            'book'     => $books[$id] ?? null,
            'quantity' => $qty,
            'subtotal' => ($books[$id]->price ?? 0) * $qty,
        ])->filter(fn($i) => $i['book']);

        $total = $items->sum('subtotal');

        return view('cart', compact('items', 'total'));
    }

    public function update(Request $request, $bookId)
    {
        $cart = session('cart', []);
        $qty  = max(1, (int) $request->quantity);
        $cart[$bookId] = $qty;
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

    public function remove($bookId)
    {
        $cart = session('cart', []);
        unset($cart[$bookId]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index');
    }
}
