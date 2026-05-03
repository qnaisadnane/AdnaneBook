<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->get();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'nationality' => 'nullable|string|max:100',
        ], [
            'name.regex' => 'The author name must contain only letters, spaces, and hyphens (no numbers).',
        ]);

        Author::create($validated);

        return redirect()->route('authors.index')->with('success', 'Auteur ajouté avec succès !');
    }

    public function show(string $id)
    {
        $author = Author::with('books')->findOrFail($id);
        return view('authors.show', compact('author'));
    }

    public function edit(string $id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, string $id)
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'name'        => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
            'nationality' => 'nullable|string|max:100',
        ], [
            'name.regex' => 'The author name must contain only letters, spaces, and hyphens (no numbers).',
        ]);

        $author->update($validated);

        return redirect()->route('authors.index')->with('success', 'Auteur mis à jour avec succès !');
    }

    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Auteur supprimé avec succès !');
    }
}
