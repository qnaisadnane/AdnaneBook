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
<div class="flex items-center justify-between mb-8">
<h2 class="text-3xl font-bold tracking-tight">Latest Arrivals</h2>
<a class="text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">View All</a>
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
    <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $book->category->name }}</span>
    <a href="{{ route('details', $book->id) }}" class="block">
        <h3 class="mt-2 text-sm font-bold text-slate-900 dark:text-white line-clamp-1 group-hover:text-primary transition-colors">{{ $book->title }}</h3>
    </a>
    <p class="text-xs text-slate-500 mt-1">by {{ $book->authors->pluck('name')->join(', ') }}</p>
    <div class="mt-3 flex items-center">
        <span class="font-black text-slate-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">${{ number_format($book->price, 2) }}</span>
    </div>
</div>
@endforeach
</div>
</div>
</section>

<!-- Best Sellers Section -->
<section class="py-24 relative overflow-hidden bg-slate-950 dark:bg-slate-950/80 my-16">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[500px] bg-primary/20 rounded-full blur-[120px] opacity-50 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-amber-500/10 rounded-full blur-[100px] opacity-30 pointer-events-none"></div>

    <div class="mx-auto max-w-7xl px-6 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-2xl">
                <span class="inline-block text-primary font-black tracking-widest uppercase text-sm mb-3">Top Rated</span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tight text-white mb-4">Best Sellers</h2>
                <p class="text-lg text-slate-400">Discover the books that everyone is talking about. Handpicked favorites loved by our community.</p>
            </div>
            <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-white/5 hover:bg-white/10 text-white font-bold transition-all backdrop-blur-sm border border-white/10 shrink-0">
                View All Best Sellers <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($bestSellers as $index => $book)
            <div class="group relative rounded-3xl bg-slate-900/50 backdrop-blur-xl border border-white/5 p-5 hover:-translate-y-2 transition-all duration-500 hover:shadow-[0_20px_40px_-15px_rgba(var(--primary),0.3)] hover:border-primary/50 flex flex-col h-full">
                <!-- Rank Badge -->
                <div class="absolute -top-5 -left-5 w-14 h-14 rounded-full bg-gradient-to-br from-amber-400 to-orange-600 text-white flex items-center justify-center font-black text-2xl shadow-lg shadow-orange-500/30 z-20 border-[6px] border-slate-950">
                    #{{ $index + 1 }}
                </div>
                
                <a href="{{ route('details', $book->id) }}" class="block relative aspect-[2/3] w-full rounded-2xl overflow-hidden mb-6">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent z-10 opacity-60 group-hover:opacity-40 transition-opacity duration-500"></div>
                    @if($book->image)
                        <img class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out" src="{{ asset($book->image) }}" alt="{{ $book->title }}"/>
                    @else
                        <div class="h-full w-full flex items-center justify-center bg-slate-800">
                            <span class="material-symbols-outlined text-6xl text-slate-600">menu_book</span>
                        </div>
                    @endif
                    <!-- Quick action -->
                    <div class="absolute bottom-4 left-0 w-full px-4 z-20 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <span class="block w-full py-3 rounded-xl bg-white/95 text-slate-900 text-center font-bold text-sm shadow-xl backdrop-blur-sm">View Details</span>
                    </div>
                </a>
                
                <div class="flex-1 flex flex-col">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2.5 py-1 rounded-md border border-primary/20">{{ $book->category->name ?? 'Uncategorized' }}</span>
                        <div class="flex items-center text-amber-400 text-xs">
                            <span class="material-symbols-outlined text-[14px] fill-current">star</span>
                            <span class="material-symbols-outlined text-[14px] fill-current">star</span>
                            <span class="material-symbols-outlined text-[14px] fill-current">star</span>
                            <span class="material-symbols-outlined text-[14px] fill-current">star</span>
                            <span class="material-symbols-outlined text-[14px] fill-current">star_half</span>
                        </div>
                    </div>
                    
                    <a href="{{ route('details', $book->id) }}" class="block group/title mb-2">
                        <h3 class="text-xl font-bold text-white line-clamp-2 group-hover/title:text-primary transition-colors leading-tight">{{ $book->title }}</h3>
                    </a>
                    
                    <p class="text-sm text-slate-400 mb-6 line-clamp-1 font-medium">by {{ $book->authors->pluck('name')->join(', ') }}</p>
                    
                    <div class="mt-auto flex items-center justify-between pt-5 border-t border-white/5">
                        <span class="text-2xl font-black text-white">${{ number_format($book->price, 2) }}</span>
                        @if(Auth::check())
                            <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary hover:text-white transition-all hover:scale-110">
                                    <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('go.login') }}" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary hover:text-white transition-all hover:scale-110">
                                <span class="material-symbols-outlined text-lg">shopping_cart</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Promo Banners -->
<section class="py-12">
    <div class="mx-auto max-w-7xl px-6 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Banner 1 -->
        <div class="group relative h-64 w-full rounded-[2rem] bg-amber-50 dark:bg-amber-900/10 border border-amber-100 dark:border-amber-800 overflow-hidden p-10 flex flex-col justify-center">
            <div class="relative z-10 max-w-[60%]">
                <span class="inline-block bg-amber-500 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-4">Summer Sale</span>
                <h3 class="text-5xl font-black text-slate-900 leading-none mb-2">Up to<br><span class="text-amber-500">75% Off</span></h3>
                <p class="text-slate-500 text-sm mt-3">Selected items only. limited stock available.</p>
            </div>
            <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center gap-1 text-sm font-bold text-amber-600 hover:text-amber-700 transition-colors">
                Shop Now <span class="material-symbols-outlined text-base">arrow_forward</span>
            </a>
            <div class="absolute -right-12 -bottom-12 h-48 w-48 rounded-full bg-amber-200/50"></div>
            <div class="absolute -right-4 -bottom-16 h-32 w-32 rounded-full bg-amber-300/30"></div>
        </div>

        <!-- Banner 2 -->
        <div class="group relative h-64 w-full rounded-[2rem] bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-800 overflow-hidden p-10 flex flex-col justify-center">
            <div class="relative z-10 max-w-[60%]">
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
</section>

<!-- Best Sellers -->
<section id="best-sellers" class="py-16 bg-white/50 dark:bg-slate-900/50">
<div class="mx-auto max-w-7xl px-6">
<div class="flex items-center justify-between mb-8">
<h2 class="text-3xl font-bold tracking-tight">Best Sellers</h2>
<a class="text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">View All</a>
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
    <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-full">{{ $book->category->name }}</span>
    <a href="{{ route('details', $book->id) }}" class="block">
        <h3 class="mt-2 text-sm font-bold text-slate-900 dark:text-white line-clamp-1 group-hover:text-primary transition-colors">{{ $book->title }}</h3>
    </a>
    <p class="text-xs text-slate-500 mt-1">by {{ $book->authors->pluck('name')->join(', ') }}</p>
    <div class="mt-3">
        <span class="font-black text-slate-900 dark:text-white">${{ number_format($book->price, 2) }}</span>
    </div>
</div>
@endforeach
</div>
</div>
</section>

<!-- Testimonials -->
<section class="py-20 bg-white/50 dark:bg-slate-900/50">
<div class="mx-auto max-w-7xl px-6">
    <div class="text-center mb-12">
        <span class="inline-block bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Testimonials</span>
        <h2 class="text-3xl font-bold tracking-tight">What Our Readers Say</h2>
        <p class="mt-2 text-slate-500">Thousands of happy readers trust ADNANE BOOKS</p>
    </div>
    @php
    $testimonials = [
        ['name' => 'Sarah M.',     'role' => 'Literature Student', 'avatar' => 'S', 'color' => 'bg-violet-500',  'rating' => 5, 'text' => 'ADNANE BOOKS has the best selection I\'ve ever seen. I found rare titles I couldn\'t find anywhere else. Fast delivery and great packaging!'],
        ['name' => 'James K.',     'role' => 'History Teacher',    'avatar' => 'J', 'color' => 'bg-emerald-500', 'rating' => 5, 'text' => 'The catalog is incredibly well organized. I love the category filters — found exactly what I needed for my class in minutes.'],
        ['name' => 'Amina R.',     'role' => 'Avid Reader',        'avatar' => 'A', 'color' => 'bg-amber-500',   'rating' => 5, 'text' => 'Ordering was super easy and the checkout process is smooth. My books arrived in perfect condition. Will definitely order again!'],
        ['name' => 'Carlos D.',    'role' => 'Software Engineer',  'avatar' => 'C', 'color' => 'bg-blue-500',    'rating' => 4, 'text' => 'Great platform with a clean interface. The search feature is powerful and the prices are very competitive. Highly recommended.'],
        ['name' => 'Fatima Z.',    'role' => 'Book Club Member',   'avatar' => 'F', 'color' => 'bg-rose-500',    'rating' => 5, 'text' => 'Our book club orders from here every month. The variety is amazing and customer support is always helpful and responsive.'],
        ['name' => 'Thomas B.',    'role' => 'Journalist',         'avatar' => 'T', 'color' => 'bg-cyan-500',    'rating' => 5, 'text' => 'I\'ve been using ADNANE BOOKS for over a year now. The experience keeps getting better. Love the new features and the fast shipping!'],
    ];
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($testimonials as $t)
        <div class="flex flex-col gap-4 bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 p-6 shadow-sm hover:shadow-md transition-all">
            {{-- Stars --}}
            <div class="flex gap-0.5">
                @for($i = 0; $i < 5; $i++)
                <svg class="h-4 w-4 {{ $i < $t['rating'] ? 'text-amber-400' : 'text-slate-200' }} fill-current" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                @endfor
            </div>
            {{-- Text --}}
            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed flex-1">"{{ $t['text'] }}"</p>
            {{-- Author --}}
            <div class="flex items-center gap-3 pt-2 border-t border-slate-100 dark:border-slate-700">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full {{ $t['color'] }} text-white text-sm font-bold">
                    {{ $t['avatar'] }}
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-900 dark:text-slate-100">{{ $t['name'] }}</p>
                    <p class="text-xs text-slate-400">{{ $t['role'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
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
