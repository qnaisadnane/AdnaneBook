@extends('layouts.customer')

@section('title', 'Welcome — ADNANE BOOKS')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-[85vh] flex items-center overflow-hidden bg-background-light dark:bg-background-dark">
    <!-- Abstract background decorations -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-primary/5 -skew-x-12 translate-x-1/4"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-6 py-24 lg:flex lg:items-center lg:gap-12">
        <div class="lg:w-1/2 space-y-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold tracking-wider uppercase">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                </span>
                New Arrivals Available Now
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tight">
                Your Next Great <span class="text-primary">Adventure</span> Starts Here.
            </h1>
            
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed">
                Discover a curated collection of literature, from timeless classics to modern masterpieces. Adnane Books is where stories come to life.
            </p>

            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 bg-primary text-white px-8 py-4 rounded-2xl font-bold text-lg shadow-xl shadow-primary/25 hover:bg-primary/90 hover:-translate-y-1 transition-all">
                    Explore Catalog
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
                <a href="#featured" class="inline-flex items-center gap-2 bg-white dark:bg-slate-800 text-slate-900 dark:text-white px-8 py-4 rounded-2xl font-bold text-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                    Featured Books
                </a>
            </div>

            <div class="flex items-center gap-8 pt-4">
                <div>
                    <p class="text-2xl font-black text-slate-900 dark:text-white">10k+</p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Books</p>
                </div>
                <div class="w-px h-10 bg-slate-200 dark:bg-slate-800"></div>
                <div>
                    <p class="text-2xl font-black text-slate-900 dark:text-white">5k+</p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Authors</p>
                </div>
                <div class="w-px h-10 bg-slate-200 dark:bg-slate-800"></div>
                <div>
                    <p class="text-2xl font-black text-slate-900 dark:text-white">2k+</p>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Readers</p>
                </div>
            </div>
        </div>

        <!-- Visual element/Book mockup -->
        <div class="hidden lg:block lg:w-1/2 relative">
            <div class="relative z-10 w-full aspect-square bg-gradient-to-br from-primary/20 to-transparent rounded-3xl overflow-hidden border border-white/20 backdrop-blur-sm shadow-2xl">
                <div class="absolute inset-0 flex items-center justify-center p-12">
                    <!-- Placeholder for a featured book image -->
                    <div class="w-2/3 aspect-[2/3] bg-white dark:bg-slate-800 rounded-lg shadow-2xl rotate-3 transform transition-transform hover:rotate-0 duration-500 overflow-hidden border-4 border-white">
                        <div class="w-full h-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-slate-300">import_contacts</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative circles -->
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-12 -left-12 w-64 h-64 bg-primary/10 rounded-full blur-2xl"></div>
        </div>
    </div>
</section>

<!-- Stats/Features -->
<section class="py-12 bg-white dark:bg-slate-900 border-y border-slate-100 dark:border-slate-800">
    <div class="mx-auto max-w-7xl px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-orange-100 dark:bg-orange-900/30 text-orange-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">local_shipping</span>
                </div>
                <div>
                    <p class="font-bold text-sm">Free Delivery</p>
                    <p class="text-xs text-slate-500">Orders over $50</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">verified_user</span>
                </div>
                <div>
                    <p class="font-bold text-sm">Secure Payment</p>
                    <p class="text-xs text-slate-500">100% encryption</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">auto_stories</span>
                </div>
                <div>
                    <p class="font-bold text-sm">Quality Books</p>
                    <p class="text-xs text-slate-500">Original editions</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 text-purple-600 flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined">support_agent</span>
                </div>
                <div>
                    <p class="font-bold text-sm">Expert Support</p>
                    <p class="text-xs text-slate-500">24/7 assistance</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Books Section -->
<section id="featured" class="py-24 bg-background-light dark:bg-background-dark">
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-4">
                <h2 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white">Featured Selections</h2>
                <p class="text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed">
                    Hand-picked by our experts, these are the stories you shouldn't miss this month.
                </p>
            </div>
            <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                View all books
                <span class="material-symbols-outlined sm-filled">arrow_right_alt</span>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach($featuredBooks as $book)
            <div class="group bg-white dark:bg-slate-800 rounded-3xl p-4 border border-slate-100 dark:border-slate-700/50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                <div class="relative aspect-[3/4] rounded-2xl overflow-hidden bg-slate-100 dark:bg-slate-700 mb-6 shadow-md">
                    @if($book->image)
                        <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"/>
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-slate-300">menu_book</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                        <a href="{{ route('details', $book->id) }}" class="w-full bg-white text-slate-900 py-3 rounded-xl font-bold text-center text-sm">
                            View Details
                        </a>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-primary bg-primary/10 px-2 py-0.5 rounded-full">
                            {{ $book->category->name }}
                        </span>
                        <div class="flex items-center text-amber-400">
                            <span class="material-symbols-outlined text-xs material-symbols-filled">star</span>
                            <span class="text-[10px] font-bold ml-1 text-slate-600 dark:text-slate-400">4.9</span>
                        </div>
                    </div>
                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors line-clamp-1">
                        {{ $book->title }}
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-1">
                        By {{ $book->authors->pluck('name')->join(', ') }}
                    </p>
                    <div class="flex items-center justify-between pt-2">
                        <p class="text-lg font-black text-primary">${{ number_format($book->price, 2) }}</p>
                        <form method="POST" action="{{ route('cart.add', $book->id) }}">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="h-10 w-10 bg-slate-100 dark:bg-slate-700 rounded-xl flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                                <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-24 overflow-hidden relative">
    <div class="absolute inset-0 bg-primary/5"></div>
    <div class="mx-auto max-w-5xl px-6 relative">
        <div class="bg-primary rounded-[3rem] p-12 lg:p-20 shadow-2xl shadow-primary/20 overflow-hidden relative">
            <!-- Decorative circle -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            
            <div class="relative max-w-2xl mx-auto text-center space-y-8">
                <h2 class="text-4xl lg:text-5xl font-black text-white leading-tight">
                    Join Our Community of Book Lovers
                </h2>
                <p class="text-primary-fixed-dim text-lg opacity-90">
                    Get weekly recommendations, exclusive interview, and early access to new releases directly in your inbox.
                </p>
                
                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Your email address" class="flex-1 px-8 py-5 rounded-2xl border-none text-slate-900 font-medium focus:ring-4 focus:ring-white/20 outline-none" required/>
                    <button type="submit" class="bg-slate-900 text-white px-10 py-5 rounded-2xl font-bold hover:bg-slate-800 transition-all shadow-xl">
                        Subscribe
                    </button>
                </form>
                
                <p class="text-xs text-primary-fixed-dim opacity-75">
                    We respect your privacy. Unsubscribe at any time.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
