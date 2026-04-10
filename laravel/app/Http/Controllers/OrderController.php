<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
        public function store(Request $request){
        $request->validate([
            'book_id'=>'required|exists:books,id',
            'quantity'=>'required|integer|min:1',
        ]);

        $book = Book::findOrFail($request->book_id); 

        if($book->quantity < $request->quantity){
            return response()->json(['erreur' => 'stock insuffisant'], 400); 
        }

        $prix_total = $book->price * $request->quantity; 

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $prix_total,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $book->id,
            'quantity' => $request->quantity,
            'price' => $book->price,
        ]);
        $book->quantity = $book->quantity - $request->quantity;
        $book->save();

        return response()->json(['message' => 'Commande passée !']);
    }
    public function pay($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status === 'paid') {
            return response()->json(['erreur' => 'Attention, cette commande a déjà été payée !'], 400);
        }
        
        $order->status = 'paid';
        $order->save();
        return response()->json([
            'message' => 'Paiement simulé avec succès !',
            'order_id' => $order->id,
            'nouveau_statut' => $order->status
        ]);
    }

}
