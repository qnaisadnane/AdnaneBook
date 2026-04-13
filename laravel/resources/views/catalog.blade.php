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
                    fontFamily: {
                        "display": ["Inter"]
                    },
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
        <!-- Top Navigation Bar -->
        <header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-8">
                    <a class="flex items-center gap-2" href="{{ url('/') }}">
                        <img alt="AB Monogram Logo" class="h-10 w-auto object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHaSfcSQzACpzRaM85jtiSCRc2YZlQQ9OyjG88BCQ5ZRkXGmMJ6p5sgW7qOfOSbNxOXlaN02z5vQUaNsva1DLs7kg8MgMhovhkKJQJcQRpKttceHtfdVsCU2spvQq58vpCHc4yf1rpvDePLbftu4871vWwSCUPgH38ziV8x27TpG0c3Cb_alPk9XYlJ0qI-qKLfmL-DyXCKCGXTDyr9snZhwNdFVPOIrXKkeppV89fFzJptxN652VAAHik8EXINBDVxoJIpWYlQ7_G"/>
                        <span class="font-extrabold text-lg">ADNANE BOOKS</span>
                    </a>
                    <nav class="hidden md:flex items-center gap-6">
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="{{ url('/') }}">Home</a>
                        <a class="text-sm font-semibold text-primary" href="{{ route('catalog') }}">Catalog</a>
                        <a class="text-sm font-medium hover:text-primary transition-colors" href="#">Best Sellers</a>
                    </nav>
                </div>
                <div class="flex flex-1 justify-end items-center gap-4">
                    <div class="relative hidden sm:block w-full max-w-xs">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <span class="material-symbols-outlined text-xl">search</span>
                        </span>
                        <input class="w-full rounded-lg border-none bg-slate-100 dark:bg-slate-800 py-2 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary focus:outline-none" placeholder="Search titles, authors..." type="text"/>
                    </div>
                    
                    @auth
                        <button class="flex items-center justify-center rounded-lg p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 relative">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">0</span>
                        </button>
                        <a href="{{ url('/dashboard') }}" class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700 overflow-hidden border border-slate-300 dark:border-slate-600 block">
                            <img class="h-full w-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDg0U6C49BXlowWbNkXpHWjjXw5v3rDD6ldd8wVrrPqGIgbYH1Y3ynbDI2hhoTYojJ8Rrk2D6fwNJhRf0dTjaeHO7iGMnnSGh6mBFqFb9fwPBaXYmYBntprMUX2dUfugGhhbMO32iltKjkQOPaQc9x0LvgXmYBEcxrjnR0pRJpOMnkCdvHNAhr-SOpD9SizGBoSmVWJaIRyK3yhUTvZdcbfvTwtHLvpR027ykQqZsqYL4xVVlO1ZNweY30erCWwnia8947Hid29OUm"/>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-primary hover:text-primary/80">Sign In</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-64 shrink-0 space-y-8">
                    <div>
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-4">Categories</h3>
                        <div class="space-y-1">
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary font-medium" href="#">
                                <span class="material-symbols-outlined text-xl">grid_view</span>
                                <span class="text-sm">All Books</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined text-xl">history_edu</span>
                                <span class="text-sm">Fiction</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined text-xl">psychology</span>
                                <span class="text-sm">Non-Fiction</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined text-xl">school</span>
                                <span class="text-sm">Academic</span>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="#">
                                <span class="material-symbols-outlined text-xl">child_care</span>
                                <span class="text-sm">Children</span>
                            </a>
                        </div>
                    </div>
                </aside>

                <!-- Content Area -->
                <div class="flex-1">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight">Books Catalog</h1>
                            <p class="text-slate-500 text-sm mt-1">Discover your next read</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm">
                                <span>Sort: Most Popular</span>
                                <span class="material-symbols-outlined text-lg">expand_more</span>
                            </button>
                        </div>
                    </div>

                    <!-- Book Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Book Card 1 -->
                        <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                            <div class="aspect-[3/4] overflow-hidden relative">
                                <a href="{{ route('book.details') }}" class="block w-full h-full">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBpnyFlyH8fc12Gf4ATCFW4VEWV5EXgdGoc9ns6HroRChtvkIsBQ4DAkoDcT_2bmZ3YhUUGOFj8dLOpkyEB9LjMMjuiPKQkAaEuqIyvGOeZ-1kCS2V1wNyNcUlMelaf7PzSJ9csFV58xhOjOVFJl7ys_nBQudd0Sw9T3VhdXm4oMHhV8i6GH6va9rNyzzzDIDf_srEq1xdVqNrEZX43PcerWWM1nfZi1If6f-9OSpQZCqtavigGWM7eGSFfi9nKOIbXUmukB9wkQMqs"/>
                                </a>
                                <button class="absolute top-3 right-3 p-2 rounded-full bg-white/90 dark:bg-slate-800/90 shadow-md hover:text-red-500 transition-colors">
                                    <span class="material-symbols-outlined text-xl">favorite</span>
                                </button>
                            </div>
                            <div class="p-5">
                                <div class="mb-2">
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-700 rounded-md">Bestseller</span>
                                </div>
                                <a href="{{ route('book.details') }}" class="block"><h3 class="font-bold text-lg leading-tight mb-1 group-hover:text-primary transition-colors">The Art of Focus</h3></a>
                                <p class="text-slate-500 text-sm mb-4">by Julianne Sterling</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-slate-900 dark:text-slate-100">$24.99</span>
                                    <button class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                                        <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Book Card 2 -->
                        <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                            <div class="aspect-[3/4] overflow-hidden relative">
                                <a href="{{ route('book.details') }}" class="block w-full h-full">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6-LfKocrJjF42ZonMiGvZnUsgRbzgbTU-mqKbA_pxwigkF3gMkuONYi-twXeUmWHsFxsHHT2XZFlEN1tVZ8Te1-DHp6GB0_lkRZDxsjRjE8bTZiW-NdcXz_uBKv5epEhJ4UNVNVtCusYq6gtRDBNclSTGNY3MCyChEmU5MAeNfKXyDZsEqzA-l0CMX1Aj4p6cG2dZW_OVO7AoyrCOVKCPadX-MRIivdZ37yzGkM4E47_MlCm6jFziUaQMUh2SvM_Y_4E6blcUvRIl"/>
                                </a>
                            </div>
                            <div class="p-5">
                                <div class="mb-2">
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider bg-primary/10 text-primary rounded-md">New Arrival</span>
                                </div>
                                <a href="{{ route('book.details') }}" class="block"><h3 class="font-bold text-lg leading-tight mb-1 group-hover:text-primary transition-colors">Modern Aesthetics</h3></a>
                                <p class="text-slate-500 text-sm mb-4">by Marcus Aurelius II</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-slate-900 dark:text-slate-100">$32.50</span>
                                    <button class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                                        <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Book Card 3 -->
                        <div class="bg-white dark:bg-slate-800 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition-all group">
                            <div class="aspect-[3/4] overflow-hidden relative">
                                <a href="{{ route('book.details') }}" class="block w-full h-full">
                                    <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCre-VHH8Luk4rcBXpXhQ8xrVp5dYhtEcmZcoDRW2GdTwq-CBwx-9S2SFOhjJdOVL4wZ77FQxoSfYgXIIiYFjqZQUJv41qiHPznJHu5yMbHNcGsloyezWwDtigVpBxT_doVJWxyCcBFJAqiRxuQq6W04tmd80Qrbb_qBfuUDBtcW5tc2VStGJkecxTcg9ccomqTi65i7ZhzcFtEPZja58XgjiVj74iNHAWadq6HpGI5RDcK3eW795TPoNOLKHIJ1OXZC8HwmQw7w0m6"/>
                                </a>
                            </div>
                            <div class="p-5">
                                <div class="mb-2">
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-700 rounded-md">Classic</span>
                                </div>
                                <a href="{{ route('book.details') }}" class="block"><h3 class="font-bold text-lg leading-tight mb-1 group-hover:text-primary transition-colors">Echoes of Silence</h3></a>
                                <p class="text-slate-500 text-sm mb-4">by Clara Vane</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-slate-900 dark:text-slate-100">$18.99</span>
                                    <button class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                                        <span class="material-symbols-outlined text-lg">shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-auto border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
                <p>&copy; 2026 ADNANE BOOKS. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
