<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');

        $books = Book::whereIn('id', array_keys($cart))->with('authors')->get()->keyBy('id');
        $items = collect($cart)->map(fn($qty, $id) => [
            'book'     => $books[$id] ?? null,
            'quantity' => $qty,
            'subtotal' => ($books[$id]->price ?? 0) * $qty,
        ])->filter(fn($i) => $i['book']);

        $total = $items->sum('subtotal');

        return view('checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:500',
            'city'           => 'required|string|max:100',
            'delivery_mode'  => 'required|in:standard,express',
            'payment_method' => 'required|in:cash,card',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');

        $total = 0;
        $lines = [];

        foreach ($cart as $bookId => $qty) {
            $book = Book::find($bookId);
            if (!$book || $book->quantity < $qty) {
                return redirect()->route('cart.index')
                    ->with('error', "Stock insuffisant pour : {$book?->title}");
            }
            $lines[] = ['book' => $book, 'qty' => $qty];
            $total += $book->price * $qty;
        }

        // Frais de livraison
        $deliveryFee = $request->delivery_mode === 'express' ? 9.99 : 0;
        $total += $deliveryFee;

        $order = Order::create([
            'user_id'     => Auth::id(),
            'total_price' => $total,
            'status'      => $request->payment_method === 'card' ? 'paid' : 'pending',
        ]);

        foreach ($lines as $line) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id'  => $line['book']->id,
                'quantity' => $line['qty'],
                'price'    => $line['book']->price,
            ]);
            $line['book']->decrement('quantity', $line['qty']);
        }

        session()->forget('cart');

        return redirect()->route('orders.my')
            ->with('success', 'Commande passée avec succès ! 🎉');
    }
}
