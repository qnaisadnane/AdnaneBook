@extends('layouts.customer')

@section('title', 'ADNANE BOOKS - Catalog')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <!-- Alerts -->
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full lg:w-56 shrink-0 space-y-6">
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Categories</h3>
                <div class="space-y-1">
                    <a href="{{ route('catalog', request()->except('category_id')) }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ !request('category_id') ? 'bg-primary/10 text-primary font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        <span class="material-symbols-outlined text-xl">grid_view</span>
                        <span class="text-sm">All Books</span>
                        <span class="ml-auto text-xs text-slate-400">{{ $books->total() }}</span>
                    </a>
                    @php
                        $icons = ['Fiction'=>'auto_stories','Sci-Fi'=>'rocket_launch','Biography'=>'person','History'=>'history_edu','Self-Help'=>'psychology','Business'=>'trending_up'];
                    @endphp
                    @foreach($categories as $cat)
                    <a href="{{ route('catalog', array_merge(request()->except('category_id', 'page'), ['category_id' => $cat->id])) }}"
                       class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors {{ request('category_id') == $cat->id ? 'bg-primary/10 text-primary font-semibold' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        <span class="material-symbols-outlined text-xl">{{ $icons[$cat->name] ?? 'menu_book' }}</span>
                        <span class="text-sm">{{ $cat->name }}</span>
                        <span class="ml-auto text-xs text-slate-400">{{ $cat->books_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Price Filter -->
            <div>
                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Price Range</h3>
                <form method="GET" action="{{ route('catalog') }}" class="space-y-3">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <div class="flex items-center gap-2">
                        <div class="flex-1">
                            <label class="text-xs text-slate-500 mb-1 block">Min ($)</label>
                            <input type="number" name="min_price" value="{{ request('min_price') }}" min="0" step="0.01"
                                placeholder="0"
                                class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm py-1.5 focus:ring-primary focus:border-primary"/>
                        </div>
                        <div class="flex-1">
                            <label class="text-xs text-slate-500 mb-1 block">Max ($)</label>
                            <input type="number" name="max_price" value="{{ request('max_price') }}" min="0" step="0.01"
                                placeholder="∞"
                                class="w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm py-1.5 focus:ring-primary focus:border-primary"/>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-primary text-white text-xs font-bold py-2 rounded-lg hover:bg-primary/90 transition-colors">
                        Apply
                    </button>
                    @if(request('min_price') || request('max_price'))
                    <a href="{{ route('catalog', request()->except('min_price', 'max_price', 'page')) }}" class="block text-center text-xs text-slate-400 hover:text-red-500 transition-colors">
                        Clear price filter
                    </a>
                    @endif
                </form>
            </div>
        </aside>

        <!-- Content -->
        <div class="flex-1">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">Books Catalog</h1>
                    <p class="text-slate-500 text-sm mt-1">
                        {{ $books->total() }} book{{ $books->total() != 1 ? 's' : '' }} found
                        @if(request('search')) for "<span class="font-semibold">{{ request('search') }}</span>"@endif
                        @if(request('category_id')) in <span class="font-semibold">{{ $categories->firstWhere('id', request('category_id'))?->name }}</span>@endif
                        @if(request('min_price') || request('max_price'))
                            — price
                            @if(request('min_price')) from <span class="font-semibold">${{ request('min_price') }}</span>@endif
                            @if(request('max_price')) to <span class="font-semibold">${{ request('max_price') }}</span>@endif
                        @endif
                    </p>
                </div>
            </div>

            <!-- Book Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($books as $book)
                <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group flex flex-col">
                    <div class="aspect-[3/4] overflow-hidden relative">
                        <a href="{{ route('books.show', $book->id) }}" class="block w-full h-full">
                            @if($book->image)
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     src="{{ asset($book->image) }}" alt="{{ $book->title }}"/>
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-primary/10 to-slate-200 dark:from-primary/20 dark:to-slate-700 gap-3">
                                    <span class="material-symbols-outlined text-7xl text-primary/40">menu_book</span>
                                    <p class="text-xs text-slate-500 px-4 text-center font-medium">{{ $book->title }}</p>
                                </div>
                            @endif
                        </a>
                        @if($book->quantity > 0)
                            <span class="absolute top-3 left-3 bg-green-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">In Stock</span>
                        @else
                            <span class="absolute top-3 left-3 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Out of Stock</span>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col flex-1">
                        @if($book->category)
                            <span class="mb-2 inline-block px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider bg-primary/10 text-primary rounded-full w-fit">{{ $book->category->name }}</span>
                        @endif
                        <a href="{{ route('books.show', $book->id) }}" class="block flex-1">
                            <h3 class="font-bold text-base leading-tight mb-1 group-hover:text-primary transition-colors line-clamp-2">{{ $book->title }}</h3>
                        </a>
                        <p class="text-slate-500 text-sm mb-3">by {{ $book->authors->pluck('name')->join(', ') ?: 'Unknown' }}</p>
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xl font-bold text-slate-900 dark:text-slate-100">${{ number_format($book->price, 2) }}</span>
                            <div class="flex gap-2">
                                <a href="{{ route('books.show', $book->id) }}"
                                   class="flex items-center gap-1 bg-white dark:bg-slate-700 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-600 px-3 py-2 rounded-lg text-sm font-bold hover:bg-slate-50 transition-colors">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                    Details
                                </a>
                                @if($book->quantity > 0)
                                @auth
                                <form method="POST" action="{{ route('cart.add', $book->id) }}">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="flex items-center gap-1 bg-primary hover:bg-primary/90 text-white px-3 py-2 rounded-lg text-sm font-bold transition-colors">
                                        <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                        Add
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('go.login', ['intended' => url()->current()]) }}" class="flex items-center gap-1 bg-primary hover:bg-primary/90 text-white px-3 py-2 rounded-lg text-sm font-bold transition-colors">
                                    <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                    Add
                                </a>
                                @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 py-24 flex flex-col items-center text-center text-slate-400">
                    <span class="material-symbols-outlined text-6xl mb-4">search_off</span>
                    <p class="text-lg font-semibold">No books found</p>
                    <a href="{{ route('catalog') }}" class="mt-4 text-sm text-primary hover:underline">Clear filters</a>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($books->hasPages())
            <div class="mt-10 flex justify-center">
                {{ $books->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

