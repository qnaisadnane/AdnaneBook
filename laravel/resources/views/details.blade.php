<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>{{ $book->title }} - ADNANE BOOKS</title>
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
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
<div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">

<!-- Header -->
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-4 md:px-10 lg:px-40 py-3 bg-white dark:bg-slate-900">
<div class="flex items-center gap-8">
<a href="{{ route('home') }}" class="flex items-center gap-4 text-primary">
    <img alt="ADNANE BOOKS" class="h-10 w-auto" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHaSfcSQzACpzRaM85jtiSCRc2YZlQQ9OyjG88BCQ5ZRkXGmMJ6p5sgW7qOfOSbNxOXlaN02z5vQUaNsva1DLs7kg8MgMhovhkKJQJcQRpKttceHtfdVsCU2spvQq58vpCHc4yf1rpvDePLbftu4871vWwSCUPgH38ziV8x27TpG0c3Cb_alPk9XYlJ0qI-qKLfmL-DyXCKCGXTDyr9snZhwNdFVPOIrXKkeppV89fFzJptxN652VAAHik8EXINBDVxoJIpWYlQ7_G"/>
    <span class="font-extrabold text-slate-900 dark:text-white">ADNANE BOOKS</span>
</a>
<nav class="hidden md:flex items-center gap-9">
    <a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
    <a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors" href="{{ route('catalog') }}">Catalog</a>
    @if($book->category)
    <a class="text-slate-600 dark:text-slate-400 text-sm font-medium hover:text-primary transition-colors"
       href="{{ route('catalog', ['category_id' => $book->category_id]) }}">{{ $book->category->name }}</a>
    @endif
</nav>
</div>
<div class="flex flex-1 justify-end gap-4 md:gap-8">
<label class="hidden sm:flex flex-col min-w-40 !h-10 max-w-64">
<form method="GET" action="{{ route('catalog') }}">
<div class="flex w-full flex-1 items-stretch rounded-lg h-full">
<div class="text-slate-400 flex border-none bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg">
<span class="material-symbols-outlined text-[20px]">search</span>
</div>
<input class="form-input flex w-full min-w-0 flex-1 border-none bg-slate-100 dark:bg-slate-800 focus:ring-0 text-slate-900 dark:text-slate-100 placeholder:text-slate-400 px-4 rounded-r-lg text-sm font-normal" name="search" placeholder="Search books..."/>
</div>
</form>
</label>
<div class="flex gap-2 items-center">
@auth
    <a href="{{ url('/dashboard') }}" class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
        Dashboard
    </a>
@else
    <a href="{{ route('go.login', ['intended' => url()->current()]) }}" class="flex items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-colors">
        Sign In
    </a>
@endauth
</div>
</div>
</header>

<main class="px-4 md:px-10 lg:px-40 py-8">

    <!-- Alerts -->
    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700 flex items-center gap-2">
            <span class="material-symbols-outlined text-green-500">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error') || $errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700 flex items-center gap-2">
            <span class="material-symbols-outlined text-red-500">error</span>
            {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav class="flex flex-wrap gap-2 mb-8 text-sm">
        <a class="text-slate-500 dark:text-slate-400 font-medium hover:text-primary" href="{{ route('home') }}">Home</a>
        <span class="text-slate-400">/</span>
        <a class="text-slate-500 dark:text-slate-400 font-medium hover:text-primary" href="{{ route('catalog') }}">Books</a>
        @if($book->category)
        <span class="text-slate-400">/</span>
        <a class="text-slate-500 dark:text-slate-400 font-medium hover:text-primary"
           href="{{ route('catalog', ['category_id' => $book->category_id]) }}">{{ $book->category->name }}</a>
        @endif
        <span class="text-slate-400">/</span>
        <span class="text-slate-900 dark:text-slate-100 font-semibold line-clamp-1">{{ $book->title }}</span>
    </nav>

    <!-- Book Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

        <!-- Cover -->
        <div class="lg:col-span-5 flex flex-col gap-4">
            <div class="w-full aspect-[3/4] bg-slate-200 dark:bg-slate-800 rounded-xl overflow-hidden shadow-xl">
                @if($book->image)
                    <img alt="{{ $book->title }}" class="w-full h-full object-cover" src="{{ Storage::url($book->image) }}"/>
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-primary/15 to-slate-300 dark:from-primary/25 dark:to-slate-700 gap-4">
                        <span class="material-symbols-outlined text-8xl text-primary/40">menu_book</span>
                        <p class="text-slate-500 text-lg font-semibold px-6 text-center">{{ $book->title }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Info -->
        <div class="lg:col-span-7 flex flex-col gap-6">
            <div>
                <div class="flex items-center gap-3 mb-3 flex-wrap">
                    @if($book->quantity > 0)
                        <span class="bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider">
                            In Stock ({{ $book->quantity }})
                        </span>
                    @else
                        <span class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider">
                            Out of Stock
                        </span>
                    @endif
                    @if($book->category)
                        <span class="bg-primary/10 text-primary px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider">
                            {{ $book->category->name }}
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl font-bold text-slate-900 dark:text-slate-100 mb-2">{{ $book->title }}</h1>
                <p class="text-xl text-primary font-medium mb-6">
                    by {{ $book->authors->pluck('name')->join(', ') ?: 'Unknown Author' }}
                </p>
                <div class="text-4xl font-black text-slate-900 dark:text-slate-100 mb-6">
                    ${{ number_format($book->price, 2) }}
                </div>

                <!-- Book metadata -->
                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">ISBN</p>
                        <p class="text-slate-900 dark:text-slate-100 font-semibold text-sm font-mono">{{ $book->isbn }}</p>
                    </div>
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Category</p>
                        <p class="text-slate-900 dark:text-slate-100 font-semibold">{{ $book->category?->name ?? 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Author(s)</p>
                        <p class="text-slate-900 dark:text-slate-100 font-semibold text-sm">{{ $book->authors->pluck('name')->join(', ') ?: 'N/A' }}</p>
                    </div>
                    <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase mb-1">Stock</p>
                        <p class="font-semibold {{ $book->quantity > 0 ? 'text-green-600' : 'text-red-500' }}">
                            {{ $book->quantity > 0 ? $book->quantity . ' available' : 'Unavailable' }}
                        </p>
                    </div>
                </div>

                <!-- Order form -->
                @if($book->quantity > 0)
                    @auth
                    <form method="POST" action="{{ route('orders.store') }}" class="flex flex-col gap-4 mb-6">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <div class="flex items-center gap-3">
                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Quantity:</label>
                            <input type="number" id="qty_input" name="quantity" value="1" min="1" max="{{ $book->quantity }}"
                                   class="w-20 rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-sm focus:ring-primary text-center font-bold"/>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit"
                                    class="flex-1 bg-primary text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined">bolt</span>
                                Buy Now
                            </button>
                        </div>
                    </form>
                    <form method="GET" action="{{ route('cart.index') }}" class="mb-6">
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="quantity" id="cart_qty" value="1">
                        <button type="submit"
                                class="w-full bg-white dark:bg-slate-800 border-2 border-primary text-primary font-bold py-4 px-8 rounded-lg hover:bg-primary/5 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">shopping_bag</span>
                            Add to Cart
                        </button>
                    </form>
                    <script>
                        document.getElementById('qty_input').addEventListener('input', function() {
                            document.getElementById('cart_qty').value = this.value;
                        });
                    </script>
                    @else
                    <div class="flex flex-col sm:flex-row gap-4 mb-6">
                        <a href="{{ route('go.login', ['intended' => route('cart.index', ['book_id' => $book->id, 'quantity' => 1])]) }}"
                           class="flex-1 bg-primary text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">login</span>
                            Sign in to Buy
                        </a>
                    </div>
                    @endauth
                @else
                    <div class="flex items-center gap-3 py-4 px-6 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 mb-6">
                        <span class="material-symbols-outlined text-red-500">inventory_2</span>
                        <p class="text-red-600 dark:text-red-400 font-semibold">This book is currently out of stock.</p>
                    </div>
                @endif

                <div class="flex items-center gap-6 text-slate-500 dark:text-slate-400 text-sm">
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">local_shipping</span>
                        Free delivery
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">verified_user</span>
                        Secure payment
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-base">refresh</span>
                        Easy returns
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if($relatedBooks->isNotEmpty())
    <div class="mt-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Related Books</h2>
            <a class="text-primary font-semibold hover:underline flex items-center gap-1"
               href="{{ route('catalog', ['category_id' => $book->category_id]) }}">
                View All <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($relatedBooks as $rel)
            <a href="{{ route('books.show', $rel->id) }}" class="group cursor-pointer block">
                <div class="aspect-[3/4] bg-slate-200 dark:bg-slate-800 rounded-lg mb-3 overflow-hidden shadow-sm group-hover:shadow-md transition-all">
                    @if($rel->image)
                        <img alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                             src="{{ Storage::url($rel->image) }}"/>
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-slate-300 dark:from-primary/20 dark:to-slate-700">
                            <span class="material-symbols-outlined text-4xl text-primary/40">menu_book</span>
                        </div>
                    @endif
                </div>
                <h3 class="font-bold text-slate-900 dark:text-slate-100 line-clamp-1 group-hover:text-primary transition-colors text-sm">{{ $rel->title }}</h3>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5">{{ $rel->authors->pluck('name')->first() ?? 'Unknown' }}</p>
                <p class="text-slate-900 dark:text-slate-100 font-bold mt-1 text-sm">${{ number_format($rel->price, 2) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

</main>

<!-- Footer -->
<footer class="mt-20 py-10 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 md:px-10 lg:px-40">
<div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-500">
    <span class="font-extrabold text-slate-900 dark:text-white text-base">ADNANE BOOKS</span>
    <p>© 2026 ADNANE BOOKS. All rights reserved.</p>
    <div class="flex gap-6">
        <a class="hover:text-primary" href="#">Shipping Policy</a>
        <a class="hover:text-primary" href="#">Returns</a>
        <a class="hover:text-primary" href="#">Contact Us</a>
    </div>
</div>
</footer>

</div>
</div>
</body>
</html>
