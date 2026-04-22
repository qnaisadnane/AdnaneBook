@extends('layouts.customer')

@section('title', 'ADNANE BOOKS - Discover Your Next Adventure')

@section('content')
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
<form method="GET" action="{{ route('catalog') }}" class="flex w-full max-w-lg mx-auto lg:mx-0 items-stretch rounded-2xl bg-white dark:bg-slate-800 p-2 shadow-xl shadow-slate-200/50 dark:shadow-none ring-1 ring-slate-200 dark:ring-slate-700">
<div class="flex items-center pl-4 text-slate-400">
<span class="material-symbols-outlined">search</span>
</div>
<input name="search" class="flex-1 border-none bg-transparent px-4 text-sm focus:ring-0" placeholder="Search by title, author, or ISBN"/>
<button type="submit" class="rounded-xl bg-primary px-8 py-3 text-sm font-bold text-white hover:bg-primary/90 transition-colors">Search</button>
</form>

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

<!-- Promo Section -->
<section class="py-20 bg-white">
<div class="mx-auto max-w-7xl px-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="relative overflow-hidden rounded-2xl bg-amber-50 border border-amber-100 p-8 flex flex-col justify-between min-h-[220px]">
            <div>
                <span class="inline-block bg-amber-400 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">Limited Time</span>
                <h3 class="text-5xl font-black text-slate-900 leading-none mb-2">Up to<br><span class="text-amber-500">75% Off</span></h3>
                <p class="text-slate-500 text-sm mt-3">On selected bestsellers and classic titles.</p>
            </div>
            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-bold text-amber-600 hover:text-amber-700 transition-colors">
                Shop Now <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
            <div class="absolute -right-6 -bottom-6 h-32 w-32 rounded-full bg-amber-200/50"></div>
            <div class="absolute -right-2 -bottom-10 h-20 w-20 rounded-full bg-amber-300/30"></div>
        </div>

        <!-- Card 2 -->
        <div class="relative overflow-hidden rounded-2xl bg-blue-50 border border-blue-100 p-8 flex flex-col justify-between min-h-[220px]">
            <div>
                <span class="inline-block bg-primary text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">New Arrivals</span>
                <h3 class="text-5xl font-black text-slate-900 leading-none mb-2">Fresh<br><span class="text-primary">Picks</span></h3>
                <p class="text-slate-500 text-sm mt-3">Discover the latest titles added to our catalog this week.</p>
            </div>
            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-bold text-primary hover:text-primary/80 transition-colors">
                Explore <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
            <div class="absolute -right-6 -bottom-6 h-32 w-32 rounded-full bg-blue-200/50"></div>
            <div class="absolute -right-2 -bottom-10 h-20 w-20 rounded-full bg-blue-300/30"></div>
        </div>

        <!-- Card 3 -->
        <div class="relative overflow-hidden rounded-2xl bg-emerald-50 border border-emerald-100 p-8 flex flex-col justify-between min-h-[220px]">
            <div>
                <span class="inline-block bg-emerald-500 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">Free Delivery</span>
                <h3 class="text-5xl font-black text-slate-900 leading-none mb-2">Order<br><span class="text-emerald-500">Today</span></h3>
                <p class="text-slate-500 text-sm mt-3">Free shipping on all orders. No minimum required.</p>
            </div>
            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
                Order Now <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
            <div class="absolute -right-6 -bottom-6 h-32 w-32 rounded-full bg-emerald-200/50"></div>
            <div class="absolute -right-2 -bottom-10 h-20 w-20 rounded-full bg-emerald-300/30"></div>
        </div>

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
@endsection
l>
