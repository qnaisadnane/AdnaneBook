@extends('layouts.customer')

@section('title', 'Welcome to ADNANE BOOKS - Discover Your Next Adventure')

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
<div class="flex items-center pl-3 text-slate-400 shrink-0">
<span class="material-symbols-outlined text-xl">search</span>
</div>
<input name="search" class="flex-1 min-w-0 border-none bg-transparent px-3 text-sm focus:ring-0" placeholder="Search by title, author, or ISBN"/>
<button type="submit" class="shrink-0 rounded-xl bg-primary px-4 sm:px-8 py-3 text-sm font-bold text-white hover:bg-primary/90 transition-colors">
    <span class="hidden sm:inline">Search</span>
    <span class="sm:hidden material-symbols-outlined text-xl leading-none">arrow_forward</span>
</button>
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
@foreach($categories as $cat)
<a href="{{ route('catalog', ['category_id' => $cat->id]) }}" class="group flex flex-col items-center gap-3 rounded-2xl bg-white dark:bg-slate-800 p-6 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md hover:border-primary/30 transition-all">
<div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-50 dark:bg-slate-700 group-hover:bg-primary/10 transition-colors">
<span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">{{ $icons[$cat->name] ?? 'menu_book' }}</span>
</div>
<span class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ $cat->name }}</span>
</a>
@endforeach
</div>
</div>
</section>

<!-- Latest Arrivals -->
<section id="latest-arrivals" class="py-16">
<div class="mx-auto max-w-7xl px-6">
<div class="text-center mb-8">
<h2 class="text-3xl font-bold tracking-tight">Latest Arrivals</h2>
<a class="mt-2 inline-block text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">View All</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
@foreach($featuredBooks as $book)
<div class="group relative bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all">
    <a href="{{ route('details', $book->id) }}" class="block">
        <div class="aspect-[3/4] mb-4 overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-700 relative">
            @if($book->image)
                <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset($book->image) }}" alt="{{ $book->title }}"/>
            @else
                <div class="h-full w-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl text-slate-300">menu_book</span>
                </div>
            @endif
        </div>
    </a>
    <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $book->category?->name ?? 'Uncategorized' }}</span>
    <a href="{{ route('details', $book->id) }}" class="block">
        <h3 class="mt-2 text-sm font-bold text-slate-900 dark:text-white line-clamp-1 group-hover:text-primary transition-colors">{{ $book->title }}</h3>
    </a>
    <p class="text-xs text-slate-500 mt-1">by {{ $book->authors->pluck('name')->join(', ') ?: 'Unknown Author' }}</p>
    <div class="mt-3 flex items-center">
        <span class="font-black text-slate-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">${{ number_format($book->price, 2) }}</span>
    </div>
</div>
@endforeach
</div>
</div>
</section>

<!-- Meet the Visionaries -->
<section class="py-24">
<div class="mx-auto max-w-7xl px-6">
<h2 class="text-4xl font-bold text-center mb-16">Meet the Visionaries</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-12">
<div class="text-center group">
<div class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-6 border-4 border-white shadow-xl ring-0 group-hover:ring-4 ring-primary/20 transition-all">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJSY6_skboE-yLOtaxHXAdX-iNcl1H1TJv1qb6nTROqx7YXmYJCzoJgGn7yInlM_QugMU9YSGRbT_QsoQWrxncURS1fsf6soyj3y_XiXHAsGxkb-laBmOLB0P3EaBRFMEM5opktwP0d_96CwM-96F3cpZqsH97oP0fLAEDx9X7qouKk4kR-UV3l9ZTbA9E9wbAWlchmYmpWiLKdw1ohsk-DyA-lHhf_uTtSTcstXlh3_sEa9-7gQs-gG8mdry4PAwS1no9CPtMG7ss" alt="David McCloskey"/>
</div>
<h3 class="text-xl font-bold mb-2">David McCloskey</h3>
<p class="text-slate-500 text-sm px-8">Ex-CIA officer turned novelist, bringing unparalleled realism to modern espionage thrillers.</p>
</div>
<div class="text-center group">
<div class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-6 border-4 border-white shadow-xl ring-0 group-hover:ring-4 ring-primary/20 transition-all">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJj-S9eIR9S-xKxWN6lPM-BJqlG2PAKPRjTWAz-ylaeoUJq-LLyn-pzpibdBd_3teorpMfuEo8KGzyVysntcCzWCHlPfHt3qk1guiLxnMg5btH7nLCRtQ1MbIEntTlYgIkk-4PE75DJcrNlfH9hu8ezbjG9_KXNqnnfkDiSpCbG4gIzet43nnU02pKf280xnVtAf5X5FCyiqYH8qSCCmM44ntY813ySJqKP0Oj8hd6oaS12fH-ZYQS0MRndux8db2VI03sTpPTokpM" alt="Dr. Elena Vance"/>
</div>
<h3 class="text-xl font-bold mb-2">Dr. Elena Vance</h3>
<p class="text-slate-500 text-sm px-8">Leading expert in Artificial Intelligence ethics and behavioral framework implementation.</p>
</div>
<div class="text-center group">
<div class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-6 border-4 border-white shadow-xl ring-0 group-hover:ring-4 ring-primary/20 transition-all">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBvRPvNtKce7Ig1ADCNQ7VJo7BaW3QFN4d_QP4d7avxEIlhOpMCvB5tdCjDXvg_O7aXtsa9YjwFdGimKXguROlCo7VgjyJxRZF9wJb-CYDzdNBuvYLNfM57QEHu2UTfhsC6Y_iXTv8VNpFDnnHmogqHulwlGSi_ODBwvPTvrsy18Y8z6l-vh6uJdl8DeSMH8hWBHVAhlqgTiRkVNKRglu_YvmWZpY6eMfG1TW4JGUbiIsd1NzhMAkjpNqLCBFYOmMZ13Z8Jn07GvqOw" alt="Julian S. Hayes"/>
</div>
<h3 class="text-xl font-bold mb-2">Julian S. Hayes</h3>
<p class="text-slate-500 text-sm px-8">Social psychologist dedicated to bridging the gap in modern human connection and empathy.</p>
</div>
</div>
</div>
</section>

<!-- Best Sellers -->
<section id="best-sellers" class="py-16 bg-white/50 dark:bg-slate-900/50">
<div class="mx-auto max-w-7xl px-6">
<div class="text-center mb-8">
<h2 class="text-3xl font-bold tracking-tight">Best Sellers</h2>
<a class="mt-2 inline-block text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">View All</a>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
@foreach($bestSellers as $book)
<div class="group relative bg-white dark:bg-slate-800 rounded-2xl p-4 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl transition-all">
    <a href="{{ route('details', $book->id) }}" class="block">
        <div class="aspect-[3/4] mb-4 overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-700 relative">
            @if($book->image)
                <img class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset($book->image) }}" alt="{{ $book->title }}"/>
            @else
                <div class="h-full w-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl text-slate-300">menu_book</span>
                </div>
            @endif
            <span class="absolute top-2 left-2 bg-amber-400 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Best Seller</span>
        </div>
    </a>
    <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $book->category?->name ?? 'Uncategorized' }}</span>
    <a href="{{ route('details', $book->id) }}" class="block">
        <h3 class="mt-2 text-sm font-bold text-slate-900 dark:text-white line-clamp-1 group-hover:text-primary transition-colors">{{ $book->title }}</h3>
    </a>
    <p class="text-xs text-slate-500 mt-1">by {{ $book->authors->pluck('name')->join(', ') ?: 'Unknown Author' }}</p>
    <div class="mt-3">
        <span class="font-black text-slate-900 dark:text-white">${{ number_format($book->price, 2) }}</span>
    </div>
</div>
@endforeach
</div>
</div>
</section>

<!-- Testimonials -->
<section class="mx-auto max-w-7xl px-6 py-20">
<div class="mb-12 text-center">
<h2 class="text-3xl font-bold tracking-tight">Testimonials</h2>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="rounded-2xl bg-white dark:bg-slate-800 p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col gap-4">
<div class="flex text-primary">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
</div>
<p class="text-slate-600 dark:text-slate-400 italic">"The curation at ADNANE BOOKS is exceptional. I've found so many hidden gems that I wouldn't have discovered elsewhere. The delivery is always prompt!"</p>
<div class="mt-4 flex items-center gap-3">
<img src="{{ asset('images/sara.jpg') }}" class="h-10 w-10 rounded-full object-cover" alt="Sarah Jenkins"/>
<p class="text-sm font-bold">Sarah Jenkins</p>
</div>
</div>
<div class="rounded-2xl bg-white dark:bg-slate-800 p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col gap-4">
<div class="flex text-primary">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
</div>
<p class="text-slate-600 dark:text-slate-400 italic">"I love the membership benefits. Getting early access to my favorite authors' new releases has been a game-changer for my weekend reading."</p>
<div class="mt-4 flex items-center gap-3">
<img src="{{ asset('images/david.jpg') }}" class="h-10 w-10 rounded-full object-cover" alt="David Thompson"/>
<p class="text-sm font-bold">David Thompson</p>
</div>
</div>
<div class="rounded-2xl bg-white dark:bg-slate-800 p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col gap-4">
<div class="flex text-primary">
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
<span class="material-symbols-outlined" style="font-variation-settings:'FILL' 1">star</span>
</div>
<p class="text-slate-600 dark:text-slate-400 italic">"The user interface is so clean and easy to use. Searching for specific ISBNs works flawlessly every time. Highly recommended for students."</p>
<div class="mt-4 flex items-center gap-3">
<img src="{{ asset('images/micheal.jpg') }}" class="h-10 w-10 rounded-full object-cover" alt="Michael Chen"/>
<p class="text-sm font-bold">Michael Chen</p>
</div>
</div>
</div>
</section>

<!-- Membership CTA -->
<section class="mx-auto max-w-7xl px-6 py-16">
<div class="bg-slate-900 rounded-[3rem] p-16 md:p-24 flex flex-col md:flex-row items-center gap-16 overflow-hidden relative">
<div class="md:w-1/2 relative z-10">
<span class="text-primary font-bold tracking-widest uppercase text-sm mb-6 block">Exclusive Access</span>
<h2 class="text-5xl font-black text-white mb-8">Unlock a World of Stories</h2>
<p class="text-slate-300 text-lg mb-10 leading-relaxed">
    Join the ADNANE BOOKS Membership for early access to limited editions, member-only discussions with authors, and personalized curation sent to your door every month.
</p>
<a href="{{ route('about') }}" class="inline-block bg-primary text-white font-bold px-10 py-5 rounded-xl hover:bg-primary/90 transition-all">About Us</a>
</div>
<div class="md:w-1/2 grid grid-cols-2 gap-4 relative z-10">
<div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-2xl">
<span class="material-symbols-outlined text-primary text-3xl mb-4">diamond</span>
<h4 class="text-white font-bold mb-2">Early Access</h4>
<p class="text-slate-400 text-sm">Be the first to get signed copies.</p>
</div>
<div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-2xl translate-y-8">
<span class="material-symbols-outlined text-primary text-3xl mb-4">local_shipping</span>
<h4 class="text-white font-bold mb-2">Priority Shipping</h4>
<p class="text-slate-400 text-sm">Free worldwide express shipping.</p>
</div>
<div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-2xl">
<span class="material-symbols-outlined text-primary text-3xl mb-4">forum</span>
<h4 class="text-white font-bold mb-2">Inner Circle</h4>
<p class="text-slate-400 text-sm">Monthly private author Q&As.</p>
</div>
<div class="bg-white/5 backdrop-blur-lg border border-white/10 p-6 rounded-2xl translate-y-8">
<span class="material-symbols-outlined text-primary text-3xl mb-4">star_rate</span>
<h4 class="text-white font-bold mb-2">Member Gifts</h4>
<p class="text-slate-400 text-sm">Exclusive merch and collectibles.</p>
</div>
</div>
<div class="absolute -bottom-24 -right-24 w-[500px] h-[500px] bg-primary/20 rounded-full blur-[120px]"></div>
</div>
</section>
@endsection
