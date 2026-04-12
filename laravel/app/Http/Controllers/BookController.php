<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'authors'])->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        
        return view('books.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['authors', 'image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book = Book::create($data);

        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Livre ajouté au catalogue !');
    }

    public function show(string $id)
    {
        $book = Book::with(['category', 'authors'])->findOrFail($id);
        return view('books.show', compact('book'));
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
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id, 
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'image' => 'nullable|image|max:2048', 
        ]);

        $data = $request->except(['authors', 'image']);

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);
        
        $book->authors()->sync($request->authors);

        return redirect()->route('books.index')->with('success', 'Informations du livre mises à jour !');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete(); 

        return redirect()->route('books.index')->with('success', 'Livre retiré des rayons !');
    }
}
