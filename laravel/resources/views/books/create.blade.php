@extends('admin.layout')
@section('title', 'Add Book')
@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data"
          class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-5">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">ISBN</label>
                <input type="text" name="isbn" value="{{ old('isbn') }}" required
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                @error('isbn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Price ($)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0.01" required
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Stock</label>
                <input type="number" name="quantity" value="{{ old('quantity', 0) }}" min="0" required
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                @error('quantity')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Category</label>
                <select name="category_id" required class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary">
                    <option value="">Select category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Authors</label>
                <div class="grid grid-cols-3 gap-2 p-3 border border-slate-200 rounded-lg max-h-40 overflow-y-auto">
                    @foreach($authors as $author)
                    <label class="flex items-center gap-2 text-sm cursor-pointer">
                        <input type="checkbox" name="authors[]" value="{{ $author->id }}"
                            {{ in_array($author->id, old('authors', [])) ? 'checked' : '' }}
                            class="rounded border-slate-300 text-primary focus:ring-primary"/>
                        {{ $author->name }}
                    </label>
                    @endforeach
                </div>
                @error('authors')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Description <span class="text-slate-400 font-normal">(optional)</span></label>
                <textarea name="description" rows="3"
                    class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-semibold mb-1">Cover Image <span class="text-slate-400 font-normal">(optional)</span></label>
                <input type="file" name="image" accept="image/*"
                    class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary/10 file:text-primary file:font-semibold hover:file:bg-primary/20"/>
            </div>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-primary/90">Save Book</button>
            <a href="{{ route('catalog') }}" class="px-6 py-2 rounded-lg text-sm font-bold border border-slate-200 hover:bg-slate-50">Cancel</a>
        </div>
    </form>
</div>
@endsection
