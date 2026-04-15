@extends('admin.layout')
@section('title', 'Books')
@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-slate-500 text-sm">{{ $books->total() }} books</p>
    <a href="{{ route('books.create') }}" class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary/90">
        <span class="material-symbols-outlined text-base">add</span> Add Book
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Book</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">ISBN</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Category</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Price</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Stock</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($books as $book)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-9 rounded overflow-hidden bg-slate-100 shrink-0">
                            @if($book->image)
                                <img src="{{ Storage::url($book->image) }}" class="h-full w-full object-cover"/>
                            @else
                                <div class="h-full w-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-slate-300 text-sm">menu_book</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-sm">{{ $book->title }}</p>
                            <p class="text-xs text-slate-400">{{ $book->authors->pluck('name')->join(', ') ?: '—' }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-mono text-slate-500">{{ $book->isbn }}</td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $book->category?->name ?? '—' }}</td>
                <td class="px-6 py-4 font-bold text-sm">${{ number_format($book->price, 2) }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $book->quantity > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                        {{ $book->quantity }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('books.edit', $book->id) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors" title="Edit">
                            <span class="material-symbols-outlined" style="font-size:18px">edit</span>
                        </a>
                        <form method="POST" action="{{ route('books.destroy', $book->id) }}" onsubmit="return confirm('Delete this book?')">
                            @csrf @method('DELETE')
                            <button class="p-1.5 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Delete">
                                <span class="material-symbols-outlined" style="font-size:18px">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-12 text-center text-slate-400">No books yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $books->links() }}</div>
@endsection
