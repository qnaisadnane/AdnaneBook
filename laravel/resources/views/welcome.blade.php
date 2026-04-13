<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>ADNANE BOOKS - Discover Your Next Adventure</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2563eb",
                        "background-light": "#f6f6f8",
                        "background-dark": "#111621",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .material-symbols-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
<div class="relative flex min-h-screen flex-col overflow-x-hidden">
<!-- Navigation -->
<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
<div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
    <div class="flex items-center gap-8">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-lg">
                <img alt="ADNANE BOOKS Logo" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjoHBDtvQbhZZYBnJp5T-QCPGx2NwzDgisgnQfKvkfxLNzS7-PFqR28px8MxWFyFXTsM7nBQryX5Wq5X-eNPlImUWfSpP014oEUdJGAzXN3ppCprSiRJTyQQFjq5_kWsWopkbbAalATtbXkhpNLhGVx4BJpTQc_OZk2Kr8fsxvYmKzGz8FNPy58gSRyDV_JrF80pVih8STE9krBnpJR1oa3WVYV7Qbo-zaAc8Mu6gnqPEwr4YWDE-ESZ--zicZ3qgOEIgiig97iG7J"/>
            </div>
            <h2 class="text-xl font-extrabold tracking-tight">ADNANE BOOKS</h2>
        </div>
        <nav class="hidden md:flex items-center gap-6">
            <a class="text-sm font-semibold hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
            <a class="text-sm font-semibold hover:text-primary transition-colors" href="{{ route('catalog') }}">Categories</a>
            <a class="text-sm font-semibold hover:text-primary transition-colors" href="{{ route('catalog') }}">Bestsellers</a>
            <a class="text-sm font-semibold hover:text-primary transition-colors" href="#">New Arrivals</a>
        </nav>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden lg:block relative group">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                <span class="material-symbols-outlined text-[20px]">search</span>
            </div>
            <input class="h-10 w-64 rounded-xl border-none bg-slate-100 dark:bg-slate-800 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/50" placeholder="Search books..." type="text"/>
        </div>
        
        <!-- INTEGRATION AUTH LARAVEL -->
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="flex h-10 items-center justify-center rounded-xl bg-primary px-6 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                    Dashboard
                </a>
                <div class="h-10 w-10 ml-2 rounded-full bg-slate-200 dark:bg-slate-700 bg-cover bg-center border-2 border-white dark:border-slate-800" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCiN1ycVDhyKL01OlLtKAfv7Ve4X-AwHKS5PU0-Ij7vow_x_mBOQ0kd-TUc7WR2_IIjJUxfoPwZ3MIhb519-bQGKUAZoXgdLJImzO8hmOQUDk4JlE1cIstQ2Tv3XLU2ldFo2yWOzOEehEOF6KCbRQ4m9RqpMP0cFi5NlhisBRnY9Mper2EP1gWOP5Vgiw42YS9eyaEt4e2wT2-7USRG1Sy_ks6Q38mxavTP8cj74sCbVB1ZowcEW03eZUq5RqPNPMB84T8OoVyeOue4")'></div>
            @else
                <a href="{{ route('login') }}" class="flex h-10 items-center justify-center rounded-xl bg-primary px-6 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                    Sign In
                </a>
            @endauth
        @endif
        
    </div>
</div>
</header>

<main class="flex-1">
<!-- Hero Section -->
<section class="mx-auto max-w-7xl px-6 py-12 @container">
<div class="flex flex-col gap-10 lg:flex-row lg:items-center">
<div class="flex flex-col gap-8 lg:w-1/2">
<div class="space-y-4 text-center lg:text-left">
<h1 class="text-5xl font-black leading-tight tracking-tight lg:text-6xl">Welcome to <span class="text-primary">Adnane Books</span> Online Book Store</h1>
<p class="text-lg text-slate-600 dark:text-slate-400">
                                Explore thousands of books across all genres at ADNANE BOOKS. From timeless classics to the latest bestsellers, find your perfect read today.
                            </p>
</div>
<div class="flex w-full max-w-lg mx-auto lg:mx-0 items-stretch rounded-2xl bg-white dark:bg-slate-800 p-2 shadow-xl shadow-slate-200/50 dark:shadow-none ring-1 ring-slate-200 dark:ring-slate-700">
<div class="flex items-center pl-4 text-slate-400">
<span class="material-symbols-outlined">search</span>
</div>
<input class="flex-1 border-none bg-transparent px-4 text-sm focus:ring-0" placeholder="Search by title, author, or ISBN"/>
<button class="rounded-xl bg-primary px-8 py-3 text-sm font-bold text-white hover:bg-primary/90 transition-colors">
                                Search
                            </button>
</div>

</div>
<div class="lg:w-1/2">
<div class="relative h-[500px] w-full rounded-3xl bg-slate-200 dark:bg-slate-800 overflow-hidden shadow-2xl">
<div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent"></div>
<img alt="Collection of beautiful books on a shelf" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAWuEglqnYu_VGJsncKCQ7ysb2Q3uNEXloJcDnc3_fabsYzB_s3JyCjfgQweCyQBInCcJe19OwHR3kvkaVY6vNMA1z0iNELTpKX8lMlDPCFyFYEIiJRECIuU2ilY6ssIsTtrYg6AYCUFJuwzvT3aHhXitw1Rtvr_wV_UQN_XDxOdxRFKrDfBQTpSFndBG-42Rt_Yl5lbz8yveXyjMDboMZtHBSzTm9Houkpu6TrcZ0wi20YtNxHn_a857rDNIZ4gqE8nkvGqRaCcROe"/>
</div>
</div>
</div>
</section>
<!-- Categories Section -->
<section class="bg-white/50 dark:bg-slate-900/50 py-16">
<div class="mx-auto max-w-7xl px-6">
<div class="flex flex-col items-center text-center mb-8">
<h2 class="text-3xl font-bold tracking-tight">Browse by Category</h2>
<p class="mt-2 text-slate-500">Find exactly what you're looking for</p>
<a class="mt-4 text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">View All Categories</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
@php
    $icons = ['Fiction'=>'auto_stories','Sci-Fi'=>'rocket_launch','Biography'=>'person','History'=>'history_edu','Self-Help'=>'psychology','Business'=>'trending_up'];
@endphp
@forelse($categories as $cat)
<a href="{{ route('catalog', ['category_id' => $cat->id]) }}" class="group flex cursor-pointer flex-col items-center justify-center gap-4 rounded-2xl bg-white dark:bg-slate-800 p-6 shadow-sm border border-slate-100 dark:border-slate-700 hover:border-primary/50 transition-all no-underline">
    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white transition-colors">
        <span class="material-symbols-outlined">{{ $icons[$cat->name] ?? 'menu_book' }}</span>
    </div>
    <p class="text-sm font-bold text-slate-800 dark:text-slate-100">{{ $cat->name }}</p>
</a>
@empty
<p class="col-span-6 text-center text-slate-400">Aucune catégorie disponible.</p>
@endforelse
</div>
</div>
</section>
<!-- Featured Books Grid -->
<section class="mx-auto max-w-7xl px-6 py-16">
<div class="flex items-end justify-between mb-8">
<div class="text-center w-full">
<h2 class="text-3xl font-bold tracking-tight">Featured Books</h2>
<p class="mt-2 text-slate-500">Curated picks from our editors</p>
</div>
</div>
<div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
@forelse($featuredBooks as $book)
<div class="group relative flex flex-col gap-4">
    <div class="aspect-[3/4] overflow-hidden rounded-2xl bg-slate-200 dark:bg-slate-800 shadow-md transition-all group-hover:shadow-xl group-hover:-translate-y-1">
        <a href="{{ route('books.show', $book->id) }}" class="block w-full h-full">
            @if($book->image)
                <img alt="{{ $book->title }}" class="h-full w-full object-cover" src="{{ Storage::url($book->image) }}"/>
            @else
                <div class="h-full w-full flex flex-col items-center justify-center bg-gradient-to-br from-primary/20 to-slate-300 dark:from-primary/30 dark:to-slate-700 gap-3">
                    <span class="material-symbols-outlined text-6xl text-primary/60">menu_book</span>
                    <p class="text-xs text-slate-500 px-3 text-center font-medium">{{ $book->title }}</p>
                </div>
            @endif
        </a>
        <div class="absolute right-4 top-4">
            <button class="flex h-10 w-10 items-center justify-center rounded-full bg-white/90 dark:bg-slate-800/90 text-slate-900 dark:text-white shadow-sm hover:text-red-500 transition-colors">
                <span class="material-symbols-outlined text-[20px]">favorite</span>
            </button>
        </div>
    </div>
    <div class="flex flex-col gap-1">
        <a href="{{ route('books.show', $book->id) }}" class="hover:text-primary transition-colors">
            <h3 class="text-lg font-bold">{{ $book->title }}</h3>
        </a>
        <p class="text-sm text-slate-500">{{ $book->authors->pluck('name')->join(', ') ?: 'Auteur inconnu' }}</p>
        <p class="mt-2 text-lg font-black text-primary">${{ number_format($book->price, 2) }}</p>
    </div>
</div>
@empty
<p class="col-span-4 text-center text-slate-400 py-12">Aucun livre disponible pour le moment.</p>
@endforelse
</div>
</section>

<!-- Featured Authors Section -->
<section class="bg-slate-50 dark:bg-slate-800/30 py-20">
<div class="mx-auto max-w-7xl px-6">
<div class="mb-12 text-center">
<h2 class="text-3xl font-bold tracking-tight">Meet the Authors</h2>
<p class="mt-2 text-slate-500">Discover the brilliant minds behind our favorite books</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
<div class="flex flex-col items-center text-center group">
<div class="mb-4 h-32 w-32 overflow-hidden rounded-full border-4 border-white dark:border-slate-800 shadow-lg transition-transform group-hover:scale-105">
<img alt="Author" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCTu0ivVbSD7JXj3qCmE9JApGb7trkIbvsEXPYYCQlCOpIfAIvjut2iPosg9gkOUpyJlSNotHC2XtS0xH8x7dBK2Y4uXpGklERiBqzYIg594gEu2-QNiEPMWoIwHCaJuYW-J0d_f7yHMgTqWcnavyFPQSOQb4QrmRw0XTIiVCxcPP4wnuGbi_CbavGTwtNPvzNRiM7ZLi0eNCT2-QFGNzWH54a3uWkV6KlWcjGa8Q6P4LcBxMTw5SHrP2StHhHE7pBucHFQPGrM-4m2"/>
</div>
<h3 class="text-lg font-bold">Elena Rodriguez</h3>
<p class="text-xs text-primary font-bold uppercase mb-2">Mystery Fiction</p>
<p class="text-sm text-slate-500">Award-winning author known for intricate plots and psychological depth.</p>
</div>
<div class="flex flex-col items-center text-center group">
<div class="mb-4 h-32 w-32 overflow-hidden rounded-full border-4 border-white dark:border-slate-800 shadow-lg transition-transform group-hover:scale-105">
<img alt="Author" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCiN1ycVDhyKL01OlLtKAfv7Ve4X-AwHKS5PU0-Ij7vow_x_mBOQ0kd-TUc7WR2_IIjJUxfoPwZ3MIhb519-bQGKUAZoXgdLJImzO8hmOQUDk4JlE1cIstQ2Tv3XLU2ldFo2yWOzOEehEOF6KCbRQ4m9RqpMP0cFi5NlhisBRnY9Mper2EP1gWOP5Vgiw42YS9eyaEt4e2wT2-7USRG1Sy_ks6Q38mxavTP8cj74sCbVB1ZowcEW03eZUq5RqPNPMB84T8OoVyeOue4"/>
</div>
<h3 class="text-lg font-bold">Samuel Chen</h3>
<p class="text-xs text-primary font-bold uppercase mb-2">Science &amp; Tech</p>
<p class="text-sm text-slate-500">Futurist and researcher exploring the intersection of AI and human creativity.</p>
</div>
<div class="flex flex-col items-center text-center group">
<div class="mb-4 h-32 w-32 overflow-hidden rounded-full border-4 border-white dark:border-slate-800 shadow-lg transition-transform group-hover:scale-105">
<img alt="Author" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBV4WFS9X5gEa0HgmhRUCNwx6gWtkluiYm-IVuk1P1g5HGXNktnAPRo7drJxdYPPR5WadbRj7RIZKgJTQ-HPTvdCASHnwCh7A6k-pKRa7aPaEG6Sn0vWTt30oouEPutH2mvV9cQKkjawyXENkh5Vca_edKhz8DrktvPDYGC_jsvrSfEARUEgX3IsY5xB17c-dVZNQrwJ49osIknfzRuXrgmA3JlcXgnph8StSm4QDMBzQaVpUsBaSTF__8Lh2MoQf6Ahh7fINSzGNFT"/>
</div>
<h3 class="text-lg font-bold">Dr. Maya Patel</h3>
<p class="text-xs text-primary font-bold uppercase mb-2">History</p>
<p class="text-sm text-slate-500">Renowned historian uncovering hidden narratives of global civilizations.</p>
</div>
<div class="flex flex-col items-center text-center group">
<div class="mb-4 h-32 w-32 overflow-hidden rounded-full border-4 border-white dark:border-slate-800 shadow-lg transition-transform group-hover:scale-105">
<img alt="Author" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvo8am4dP2FPrSztGwhYPVeHFXed7cWK_wdMDG_o_g-tSkJgFtB1ijgHGhuQya__UzM2w-9u12UkV8ayZdV4YKjb0t2osbx1F-KvwZ7iJSUE-934fiOiwX8z_qjH_dfRPgoc85UNaeseb2MvTY6BSMy_9MUdJu2oL5D2QWvSkLQwxUQuqVJdWJv_EdCGZGNLj14-kTQ-sJlxAFj5zMh66KnpYXu8L89W-oVhr5kSbJ-KRXvBN4IcB2ZTTxwgUjb7pGqIH0tvlE9SWf"/>
</div>
<h3 class="text-lg font-bold">Liam O'Connor</h3>
<p class="text-xs text-primary font-bold uppercase mb-2">Poetry &amp; Essays</p>
<p class="text-sm text-slate-500">Modern poet whose lyrical prose captures the essence of the human experience.</p>
</div>
</div>
</div>
</section>
<!-- Testimonials Section -->
<section class="mx-auto max-w-7xl px-6 py-20">
<div class="mb-12 text-center">
<h2 class="text-3xl font-bold tracking-tight">Testimonials</h2>
<p class="mt-2 text-slate-500">Join a community of book lovers from around the world</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="rounded-2xl bg-white dark:bg-slate-800 p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col gap-4">
<div class="flex text-primary">
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star_half</span>
</div>
<p class="text-slate-600 dark:text-slate-400 italic">"The curation at ADNANE BOOKS is exceptional. I've found so many hidden gems that I wouldn't have discovered elsewhere. The delivery is always prompt!"</p>
<div class="mt-4 flex items-center gap-3">
<div class="h-10 w-10 rounded-full bg-slate-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCTu0ivVbSD7JXj3qCmE9JApGb7trkIbvsEXPYYCQlCOpIfAIvjut2iPosg9gkOUpyJlSNotHC2XtS0xH8x7dBK2Y4uXpGklERiBqzYIg594gEu2-QNiEPMWoIwHCaJuYW-J0d_f7yHMgTqWcnavyFPQSOQb4QrmRw0XTIiVCxcPP4wnuGbi_CbavGTwtNPvzNRiM7ZLi0eNCT2-QFGNzWH54a3uWkV6KlWcjGa8Q6P4LcBxMTw5SHrP2StHhHE7pBucHFQPGrM-4m2')"></div>
<div>
<p class="text-sm font-bold">Sarah Jenkins</p>
<p class="text-xs text-slate-500">Avid Reader</p>
</div>
</div>
</div>
<div class="rounded-2xl bg-white dark:bg-slate-800 p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col gap-4">
<div class="flex text-primary">
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
</div>
<p class="text-slate-600 dark:text-slate-400 italic">"I love the membership benefits. Getting early access to my favorite authors' new releases has been a game-changer for my weekend reading."</p>
<div class="mt-4 flex items-center gap-3">
<div class="h-10 w-10 rounded-full bg-slate-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDvo8am4dP2FPrSztGwhYPVeHFXed7cWK_wdMDG_o_g-tSkJgFtB1ijgHGhuQya__UzM2w-9u12UkV8ayZdV4YKjb0t2osbx1F-KvwZ7iJSUE-934fiOiwX8z_qjH_dfRPgoc85UNaeseb2MvTY6BSMy_9MUdJu2oL5D2QWvSkLQwxUQuqVJdWJv_EdCGZGNLj14-kTQ-sJlxAFj5zMh66KnpYXu8L89W-oVhr5kSbJ-KRXvBN4IcB2ZTTxwgUjb7pGqIH0tvlE9SWf')"></div>
<div>
<p class="text-sm font-bold">David Thompson</p>
<p class="text-xs text-slate-500">Premium Member</p>
</div>
</div>
</div>
<div class="rounded-2xl bg-white dark:bg-slate-800 p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col gap-4">
<div class="flex text-primary">
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star</span>
<span class="material-symbols-outlined material-symbols-filled fill-current">star_half</span>
</div>
<p class="text-slate-600 dark:text-slate-400 italic">"The user interface is so clean and easy to use. Searching for specific ISBNs works flawlessly every time. Highly recommended for students."</p>
<div class="mt-4 flex items-center gap-3">
<div class="h-10 w-10 rounded-full bg-slate-200 bg-cover bg-center" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBV4WFS9X5gEa0HgmhRUCNwx6gWtkluiYm-IVuk1P1g5HGXNktnAPRo7drJxdYPPR5WadbRj7RIZKgJTQ-HPTvdCASHnwCh7A6k-pKRa7aPaEG6Sn0vWTt30oouEPutH2mvV9cQKkjawyXENkh5Vca_edKhz8DrktvPDYGC_jsvrSfEARUEgX3IsY5xB17c-dVZNQrwJ49osIknfzRuXrgmA3JlcXgnph8StSm4QDMBzQaVpUsBaSTF__8Lh2MoQf6Ahh7fINSzGNFT')"></div>
<div>
<p class="text-sm font-bold">Michael Chen</p>
<p class="text-xs text-slate-500">University Student</p>
</div>
</div>
</div>
</div>
</section>
<!-- Newsletter Section -->
<section class="bg-primary py-20 text-white">
<div class="mx-auto max-w-7xl px-6 flex flex-col lg:flex-row items-center justify-between gap-12">
<div class="lg:w-1/2">
<h2 class="text-4xl font-black tracking-tight mb-4">Never Miss a Story</h2>
<p class="text-primary-100 text-lg opacity-90">Subscribe to our newsletter for weekly curated lists, author exclusive content, and early notification of seasonal sales.</p>
</div>
<div class="w-full lg:w-5/12">
<form class="flex flex-col sm:flex-row gap-3">
<input class="flex-1 rounded-xl border-none bg-white/10 px-6 py-4 text-white placeholder-white/60 backdrop-blur-md focus:ring-2 focus:ring-white/50" placeholder="Your best email address" required="" type="email"/>
<button class="rounded-xl bg-white px-8 py-4 text-base font-bold text-primary hover:bg-slate-100 transition-colors shadow-lg" type="submit">
                                Subscribe Now
                            </button>
</form>
<p class="mt-4 text-xs text-white/60">We value your privacy. Unsubscribe at any time.</p>
</div>
</div>
</section>
<!-- Best Sellers CTA -->
<section class="mx-auto max-w-7xl px-6 py-16">
<div class="relative overflow-hidden rounded-[2rem] bg-slate-900 px-8 py-16 md:px-20 lg:py-24">
<div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-primary/20 blur-3xl"></div>
<div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-primary/30 blur-3xl"></div>
<div class="relative z-10 flex flex-col items-center gap-8 text-center">
<h2 class="max-w-2xl text-4xl font-black tracking-tight text-white lg:text-5xl">
                            Unlock a World of Stories with Our Membership
                        </h2>
<p class="max-w-lg text-lg text-slate-400">
                            Get early access to bestsellers, exclusive author interviews, and monthly credits for any book in our collection.
                        </p>
<div class="flex flex-col sm:flex-row gap-4">
<button class="rounded-xl bg-primary px-10 py-4 text-base font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                                Get Started Now
                            </button>
<button class="rounded-xl bg-white/10 px-10 py-4 text-base font-bold text-white backdrop-blur-md hover:bg-white/20 transition-all">
                                Learn More
                            </button>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 pt-16 pb-8">
<div class="mx-auto max-w-7xl px-6">
<div class="grid grid-cols-2 gap-12 lg:grid-cols-4 lg:gap-8">
<div class="col-span-2 lg:col-span-1">
<div class="flex items-center gap-3 mb-6">
<div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-lg">
<img alt="ADNANE BOOKS Logo" class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjoHBDtvQbhZZYBnJp5T-QCPGx2NwzDgisgnQfKvkfxLNzS7-PFqR28px8MxWFyFXTsM7nBQryX5Wq5X-eNPlImUWfSpP014oEUdJGAzXN3ppCprSiRJTyQQFjq5_kWsWopkbbAalATtbXkhpNLhGVx4BJpTQc_OZk2Kr8fsxvYmKzGz8FNPy58gSRyDV_JrF80pVih8STE9krBnpJR1oa3WVYV7Qbo-zaAc8Mu6gnqPEwr4YWDE-ESZ--zicZ3qgOEIgiig97iG7J"/>
</div>
<h2 class="text-xl font-extrabold tracking-tight">ADNANE BOOKS</h2>
</div>
<p class="text-sm text-slate-500 leading-relaxed">
                            Your premier destination for physical and digital books. We believe every page is a new beginning.
                        </p>
<div class="mt-6 flex gap-4">
<a aria-label="Facebook" class="text-slate-400 hover:text-primary transition-colors" href="#">
<svg class="h-5 w-5 fill-current" viewbox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
</a>
<a aria-label="Instagram" class="text-slate-400 hover:text-primary transition-colors" href="#">
<svg class="h-5 w-5 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c.796 0 1.441.645 1.441 1.44s-.645 1.44-1.441 1.44c-.795 0-1.439-.645-1.439-1.44s.644-1.44 1.439-1.44z"></path></svg>
</a>
<a aria-label="LinkedIn" class="text-slate-400 hover:text-primary transition-colors" href="#">
<svg class="h-5 w-5 fill-current" viewbox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path></svg>
</a>
<a aria-label="YouTube" class="text-slate-400 hover:text-primary transition-colors" href="#">
<svg class="h-5 w-5 fill-current" viewbox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"></path></svg>
</a>
</div>
</div>
<div>
<h4 class="mb-6 text-sm font-bold uppercase tracking-wider">Company</h4>
<ul class="space-y-4 text-sm text-slate-500">
<li><a class="hover:text-primary transition-colors" href="#">About Us</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Careers</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Affiliates</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Store Locator</a></li>
</ul>
</div>
<div>
<h4 class="mb-6 text-sm font-bold uppercase tracking-wider">Support</h4>
<ul class="space-y-4 text-sm text-slate-500">
<li><a class="hover:text-primary transition-colors" href="#">Help Center</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Track Order</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Shipping Info</a></li>
<li><a class="hover:text-primary transition-colors" href="#">Returns</a></li>
</ul>
</div>
<div>
<h4 class="mb-6 text-sm font-bold uppercase tracking-wider">Newsletter</h4>
<p class="mb-4 text-sm text-slate-500">Subscribe to get the latest book news and exclusive offers.</p>
<form class="flex flex-col gap-2">
<input class="rounded-lg border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-sm focus:ring-primary" placeholder="Enter your email" type="email"/>
<button class="w-full rounded-lg bg-primary py-2.5 text-sm font-bold text-white hover:bg-primary/90 transition-all">Subscribe</button>
</form>
</div>
</div>
<div class="mt-16 border-t border-slate-100 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
<p class="text-xs text-slate-400">© 2026 ADNANE BOOKS. All rights reserved.</p>
<div class="flex gap-6 text-xs text-slate-400">
<a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="hover:text-primary transition-colors" href="#">Cookie Policy</a>
</div>
</div>
</div>
</footer>
</div>
</body></html>
