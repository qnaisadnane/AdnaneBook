<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredBooks = Book::with(['category', 'authors'])
            ->latest()
            ->take(4)
            ->get();

        $bestSellers = Book::with(['category', 'authors'])
            ->withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->take(4)
            ->get();

        // Fallback if no order items exist yet
        if ($bestSellers->isEmpty() || $bestSellers->first()->order_items_count == 0) {
            $bestSellers = Book::with(['category', 'authors'])
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        $categories = Category::withCount('books')->get();

        return view('welcome', compact('featuredBooks', 'bestSellers', 'categories'));
    }
}
