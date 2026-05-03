<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Catalogue public — avec filtre catégorie et recherche
     */
    public function index(Request $request)
    {
        // Admin — liste admin
        if (auth()->check() && in_array(auth()->user()->role, ['admin'])) {
            $books = Book::with(['category', 'authors'])->latest()->paginate(15);
            return view('books.index', compact('books'));
        }

        // Public — catalogue
        $categories = Category::withCount('books')->get();
        $query = Book::with(['category', 'authors']);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%")
                  ->orWhereHas('authors', fn($a) => $a->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $books = $query->latest()->paginate(9)->withQueryString();

        return view('catalog', compact('books', 'categories'));
    }

    /**
     * Détails d'un livre avec livres similaires
     */
    public function show(string $id)
    {
        $book = Book::with(['category', 'authors'])->findOrFail($id);

        $relatedBooks = Book::with(['authors'])
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(5)
            ->get();

        return view('details', compact('book', 'relatedBooks'));
    }

    /* ─── Admin CRUD ─────────────────────────────────────────── */

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'isbn'        => ['required', 'string', 'regex:/^(978|979)-\d{10}$/', 'unique:books,isbn'],
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'authors'     => 'required|array',
            'authors.*'   => 'exists:authors,id',
            'image'       => 'required|image|max:2048',
        ], [
            'isbn.regex' => 'The ISBN must be in the format 978-XXXXXXXXXX (e.g., 978-0451524935).',
        ]);

        $data = $request->except(['authors', 'image']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'images/' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), basename($filename));
            $data['image'] = $filename;
        }

        $book = Book::create($data);
        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Livre ajouté au catalogue !');
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|min:3|max:255',
            'isbn'        => ['required', 'string', 'regex:/^(978|979)-\d{10}$/', 'unique:books,isbn,' . $book->id],
            'price'       => 'required|numeric|min:0',
            'quantity'    => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'authors'     => 'required|array',
            'image'       => 'nullable|image|max:2048',
        ], [
            'isbn.regex' => 'The ISBN must be in the format 978-XXXXXXXXXX (e.g., 978-0451524935).',
        ]);

        $data = $request->except(['authors', 'image']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'images/' . uniqid() . '.' . $file->getClientOriginalExtension();
            if ($book->image) @unlink(public_path($book->image));
            $file->move(public_path('images'), basename($filename));
            $data['image'] = $filename;
        }

        $book->update($data);
        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Livre mis à jour !');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        if ($book->image) Storage::disk('public')->delete($book->image);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livre supprimé !');
    }
}
