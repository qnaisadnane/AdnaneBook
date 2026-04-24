@extends('layouts.customer')

@section('title', 'About Us — ADNANE BOOKS')

@section('content')
<main class="mx-auto max-w-7xl px-6 py-16">

    {{-- Hero --}}
    <div class="text-center mb-20">
        <span class="inline-block bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Our Story</span>
        <h1 class="text-5xl font-black text-slate-900 dark:text-slate-100 mb-6">About <span class="text-primary">ADNANE BOOKS</span></h1>
        <p class="text-lg text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
            Your premier online destination for books — built with passion for readers everywhere.
        </p>
    </div>

    {{-- Mission --}}
    <div class="grid lg:grid-cols-2 gap-12 items-center mb-24">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-4">Our Mission</h2>
            <p class="text-slate-500 dark:text-slate-400 leading-relaxed mb-4">
                ADNANE BOOKS is an e-commerce platform dedicated to making books accessible to everyone. We offer a curated catalogue spanning all genres and categories, with a seamless shopping experience from browsing to delivery.
            </p>
            <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                We believe every page is a new beginning — and we're here to help you find yours.
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            @php
            $features = [
                ['icon' => 'menu_book',      'title' => 'Rich Catalogue', 'desc' => 'Thousands of books across all categories'],
                ['icon' => 'local_shipping', 'title' => 'Fast Delivery',  'desc' => 'Free shipping on every order'],
                ['icon' => 'verified_user',  'title' => 'Secure Payment', 'desc' => 'Simulated checkout, fully safe'],
                ['icon' => 'support_agent',  'title' => '24/7 Support',   'desc' => 'We\'re always here to help'],
            ];
            @endphp
            @foreach($features as $f)
            <div class="p-5 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800">
                <span class="material-symbols-outlined text-primary text-3xl mb-3 block">{{ $f['icon'] }}</span>
                <h3 class="font-bold text-slate-900 dark:text-slate-100 text-sm mb-1">{{ $f['title'] }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Stats --}}
    <div class="bg-primary rounded-2xl p-12 mb-24">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
            @php
            $stats = [
                ['num' => '10K+', 'label' => 'Books Available'],
                ['num' => '5K+',  'label' => 'Happy Customers'],
                ['num' => '200+', 'label' => 'Authors'],
                ['num' => '50+',  'label' => 'Categories'],
            ];
            @endphp
            @foreach($stats as $s)
            <div>
                <p class="text-4xl font-black mb-1">{{ $s['num'] }}</p>
                <p class="text-sm font-medium text-white/70">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- What we offer --}}
    <div class="mb-24">
        <h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100 text-center mb-12">What We Offer</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @php
            $offers = [
                ['icon' => 'auto_stories',  'title' => 'Book Catalogue',  'desc' => 'Browse and search books by title, category, price, or availability.'],
                ['icon' => 'shopping_cart', 'title' => 'Easy Ordering',   'desc' => 'Add to cart, checkout, and track your orders in a few clicks.'],
                ['icon' => 'bar_chart',     'title' => 'Admin Dashboard', 'desc' => 'Full management of books, authors, categories, orders and statistics.'],
            ];
            @endphp
            @foreach($offers as $o)
            <div class="p-8 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 text-center">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 mx-auto mb-4">
                    <span class="material-symbols-outlined text-primary text-2xl">{{ $o['icon'] }}</span>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-slate-100 mb-2">{{ $o['title'] }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">{{ $o['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Contact --}}
    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-12 text-center">
        <h2 class="text-3xl font-bold text-slate-900 dark:text-slate-100 mb-4">Get In Touch</h2>
        <p class="text-slate-500 dark:text-slate-400 mb-8">Have a question or feedback? We'd love to hear from you.</p>
        <div class="flex flex-wrap justify-center gap-8 text-sm text-slate-500 dark:text-slate-400">
            <a href="tel:+212713650472" class="flex items-center gap-2 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-primary">call</span> +212 713-650472
            </a>
            <a href="mailto:contact@adnanebook.com" class="flex items-center gap-2 hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-primary">mail</span> contact@adnanebook.com
            </a>
            <span class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">location_on</span> BLOC 46 Qu Saida II, SAFI, Morocco
            </span>
        </div>
        <div class="mt-8">
            <a href="{{ route('catalog') }}" class="inline-flex items-center gap-2 bg-primary text-white font-bold py-3 px-8 rounded-lg hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined">menu_book</span> Browse Books
            </a>
        </div>
    </div>

</main>
@endsection
