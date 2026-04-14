@extends('admin.layout')
@section('title', 'Categories')
@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-slate-500 text-sm">{{ $categories->count() }} categories</p>
    <a href="{{ route('categories.create') }}" class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary/90">
        <span class="material-symbols-outlined text-base">add</span> Add Category
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Color</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Books</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($categories as $cat)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-medium">{{ $cat->name }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <span class="h-5 w-5 rounded-full border border-slate-200" style="background:{{ $cat->color }}"></span>
                        <span class="text-sm text-slate-500">{{ $cat->color }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-slate-500">{{ $cat->books_count ?? 0 }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('categories.edit', $cat->id) }}" class="text-primary hover:underline text-sm font-medium">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', $cat->id) }}" onsubmit="return confirm('Delete this category?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline text-sm font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-12 text-center text-slate-400">No categories yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
