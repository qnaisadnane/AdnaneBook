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

        $categories = Category::withCount('books')->get();

        return view('welcome', compact('featuredBooks', 'categories'));
    }
}
