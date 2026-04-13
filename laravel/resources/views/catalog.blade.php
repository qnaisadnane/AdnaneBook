<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ADNANE BOOKS - Catalog</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2463eb",
                        "background-light": "#f6f6f8",
                        "background-dark": "#111621",
                    },
                    fontFamily: { "display": ["Inter"] },
                    borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased font-display">
    <div class="relative flex min-h-screen flex-col">
        <!-- Navigation -->
        <header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-8">
                    <a class="flex items-center gap-2" href="{{ route('home') }}">
                        <img alt="AB Logo" class="h-10 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHaSfcSQzACpzRaM85jtiSCRc2YZlQQ9OyjG88BCQ5ZRkXGmMJ6p5sgW7qOfOSbNxOXlaN02z5vQUaNsva1DLs7kg8MgMhovhkKJQJcQRpKttceHtfdVsCU2spvQq58vpCHc4yf1rpvDePLbftu4871vWwSCUPgH38ziV8x27TpG0c3Cb_alPk9XYlJ0qI-qKLfmL-DyXCKCGXTDyr9snZhwNdFVPOIrXKkeppV89fFzJptxN652VAAHik8EXINBDVxoJIpWYlQ7_G"/>
                        <span class="font-extrabold text-lg">ADNANE BOOKS</span>
                    </a>
                    <nav class="hidden md:flex items-center gap-6">
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                        <a class="text-sm font-semibold text-primary" href="{{ route('catalog') }}">Catalog</a>
                    </nav>
                </div>
                <!-- Search bar -->
                <form method="GET" action="{{ route('catalog') }}" class="flex flex-1 justify-center max-w-md mx-4">
                    @if(request('category_id'))
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    @endif
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </span>
                        <input class="w-full rounded-lg border-none bg-slate-100 dark:bg-slate-800 py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary focus:outline-none"
                               placeholder="Search titles, authors..."
                               type="text" name="search" value="{{ request('search') }}"/>
                    </div>
                </form>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-primary hover:text-primary/80">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="flex h-9 items-center justify-center rounded-lg bg-primary px-5 text-sm font-bold text-white hover:bg-primary/90 transition-all">Sign In</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
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
                                             src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}"/>
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
                                    @auth
                                    <form method="POST" action="{{ route('orders.store') }}">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                                {{ $book->quantity < 1 ? 'disabled' : '' }}
                                                class="flex items-center gap-1 bg-primary hover:bg-primary/90 disabled:bg-slate-300 disabled:cursor-not-allowed text-white px-3 py-2 rounded-lg text-sm font-bold transition-colors">
                                            <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                            Order
                                        </button>
                                    </form>
                                    @else
                                    <a href="{{ route('login') }}" class="flex items-center gap-1 bg-primary hover:bg-primary/90 text-white px-3 py-2 rounded-lg text-sm font-bold transition-colors">
                                        <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                        Order
                                    </a>
                                    @endauth
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
        </main>

        <footer class="mt-auto border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
                <p>&copy; 2026 ADNANE BOOKS. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
