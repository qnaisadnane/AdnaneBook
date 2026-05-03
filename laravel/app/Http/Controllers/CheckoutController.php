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
            'first_name'      => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]{3,}$/u'],
            'last_name'       => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]{3,}$/u'],
            'phone'           => ['required', 'regex:/^0[67][0-9]{8}$/'],
            'address'         => 'required|string|max:500',
            'region'          => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]{3,}$/u'],
            'city'            => ['required', 'string', 'max:100', 'regex:/^[\pL\s\-]{3,}$/u'],
            'additional_info' => 'nullable|string|max:500',
            'delivery_mode'   => 'required|in:standard,express',
            'payment_method'  => 'required|in:cash,card',
            'stripeToken'     => 'required_if:payment_method,card',
        ], [
            'first_name.regex' => 'First name must contain at least 3 letters and no numbers.',
            'last_name.regex'  => 'Last name must contain at least 3 letters and no numbers.',
            'region.regex'     => 'Region must contain at least 3 letters and no numbers.',
            'city.regex'       => 'City must contain at least 3 letters and no numbers.',
            'phone.regex'      => 'Phone number must start with 06 or 07 and contain exactly 10 digits.',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart.index');

        $totalValue = 0;
        $lines = [];

        foreach ($cart as $bookId => $qty) {
            $book = Book::find($bookId);
            if (!$book || $book->quantity < $qty) {
                return redirect()->route('cart.index')
                    ->with('error', "Stock insuffisant pour : {$book?->title}");
            }
            $lines[] = ['book' => $book, 'qty' => $qty];
            $totalValue += $book->price * $qty;
        }

        // Frais de livraison
        $deliveryFee = $request->delivery_mode === 'express' ? 9.99 : 0;
        $totalValue += $deliveryFee;

        // --- Logic de Payement Stripe ---
        if ($request->payment_method === 'card') {
            try {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
                \Stripe\Charge::create([
                    "amount" => $totalValue * 100, // En cents
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Payment for Order on Adnane Books"
                ]);

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Payment failed: ' . $e->getMessage()]);
            }
        }

        $order = Order::create([
            'user_id'     => Auth::id(),
            'total_price' => $totalValue,
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
            ->with('success', 'Commande passee avec succes ! ' . ($request->payment_method === 'card' ? ' (Payee par Carte)' : ''));
    }
}
