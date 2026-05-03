<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s\-]+$/u', 'unique:categories,name'],
            'color' => 'required|string|max:50',
        ], [
            'name.regex' => 'The category name must contain only letters, spaces, and hyphens (no numbers).',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        
        $validated = $request->validate([
            'name'  => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s\-]+$/u', 'unique:categories,name,' . $category->id],
            'color' => 'required|string|max:50',
        ], [
            'name.regex' => 'The category name must contain only letters, spaces, and hyphens (no numbers).',
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('Success', 'category has been updated with success');    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('Success', 'category has been deleted with success');    
    }
}
