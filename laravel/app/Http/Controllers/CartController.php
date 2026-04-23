<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        $books = Book::whereIn('id', array_keys($cart))->with('authors')->get()->keyBy('id');

        $items = collect($cart)->map(fn($qty, $id) => [
            'book'     => $books[$id] ?? null,
            'quantity' => $qty,
            'subtotal' => ($books[$id]->price ?? 0) * $qty,
        ])->filter(fn($i) => $i['book']);

        $total = $items->sum('subtotal');

        return view('cart', compact('items', 'total'));
    }

    public function add(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $cart = session('cart', []);
        $qty  = (int) $request->get('quantity', 1);

        $cart[$bookId] = ($cart[$bookId] ?? 0) + $qty;
        session(['cart' => $cart]);

        return redirect()->back()->with('success', "Le livre '{$book->title}' a été ajouté au panier.");
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
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Votre panier a été vidé.');
    }
}
