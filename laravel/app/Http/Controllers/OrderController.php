<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Télécharger la facture PDF
    public function downloadInvoice($id)
    {
        $order = Order::with(['user', 'items.book', 'items.book.authors'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $pdf = Pdf::loadView('pdf.invoice', compact('order'));

        return $pdf->download("invoice-order-{$order->id}.pdf");
    }

    // Admin  — toutes les commandes
    public function index()
    {
        $orders = Order::with(['user', 'items.book'])->latest()->paginate(15);
        return view('orders.index', compact('orders'));
    }

    // Client — ses commandes
    public function myOrders()
    {
        $orders = Order::with(['items.book'])
            ->where('user_id', Auth::id())
            ->latest()->get();
        return view('orders.my-orders', compact('orders'));
    }

    // Créer une commande depuis le panier (multi-items)
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        $lines = [];

        foreach ($cart as $bookId => $qty) {
            $book = Book::find($bookId);
            if (!$book || $book->quantity < $qty) {
                return redirect()->route('cart.index')
                    ->with('error', "Insufficient stock for: {$book?->title}");
            }
            $lines[] = ['book' => $book, 'qty' => $qty];
            $total += $book->price * $qty;
        }

        $order = Order::create([
            'user_id'     => Auth::id(),
            'total_price' => $total,
            'status'      => 'pending',
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

        return redirect()->route('orders.my')->with('success', 'Order placed successfully!');
    }

    // Paiement simulé
    public function pay($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== 'pending') {
            return back()->with('error', 'This order cannot be paid.');
        }

        $order->update(['status' => 'paid']);
        return back()->with('success', 'Payment successful!');
    }

    // Admin — changer le statut
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate(['status' => 'required|in:pending,paid,shipped,delivered']);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status updated.');
    }
}
