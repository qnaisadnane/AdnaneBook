<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
<title>ADNANE BOOKS - Your Cart</title>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="relative flex min-h-screen flex-col overflow-x-hidden">

<!-- Header -->
<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
        <div class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-lg">
            <img alt="ADNANE BOOKS Logo" class="h-full w-full object-contain" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHaSfcSQzACpzRaM85jtiSCRc2YZlQQ9OyjG88BCQ5ZRkXGmMJ6p5sgW7qOfOSbNxOXlaN02z5vQUaNsva1DLs7kg8MgMhovhkKJQJcQRpKttceHtfdVsCU2spvQq58vpCHc4yf1rpvDePLbftu4871vWwSCUPgH38ziV8x27TpG0c3Cb_alPk9XYlJ0qI-qKLfmL-DyXCKCGXTDyr9snZhwNdFVPOIrXKkeppV89fFzJptxN652VAAHik8EXINBDVxoJIpWYlQ7_G"/>
        </div>
        <h2 class="text-xl font-extrabold tracking-tight uppercase">ADNANE BOOKS</h2>
    </a>
    <div class="flex items-center gap-4">
        <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800 hover:bg-primary/20 transition-colors">
            <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">shopping_cart</span>
            @if($items->count())
            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{{ $items->count() }}</span>
            @endif
        </a>
        <a href="{{ route('orders.my') }}" class="text-sm font-medium text-slate-600 hover:text-primary">My Orders</a>
        <a href="{{ route('profile.edit') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800 hover:bg-primary/20 transition-colors">
            <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">person</span>
        </a>
    </div>
</div>
</header>

<main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-black tracking-tight sm:text-4xl">Your Cart</h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400">Review your selection before proceeding to checkout.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    @if($items->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center text-slate-400">
            <span class="material-symbols-outlined text-6xl mb-4">shopping_cart</span>
            <p class="text-lg font-semibold">Your cart is empty</p>
            <a href="{{ route('catalog') }}" class="mt-4 text-sm text-primary hover:underline">Browse books</a>
        </div>
    @else
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-12">

        <!-- Cart Items -->
        <div class="lg:col-span-8">
            <div class="overflow-hidden rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Book</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Quantity</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Price</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Subtotal</th>
                                <th class="px-6 py-4"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                            @foreach($items as $item)
                            <tr class="group transition-colors hover:bg-slate-50/30 dark:hover:bg-slate-800/30">
                                <td class="px-6 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="h-20 w-14 flex-shrink-0 overflow-hidden rounded-md bg-slate-100 dark:bg-slate-800 shadow-sm">
                                            @if($item['book']->image)
                                                <img class="h-full w-full object-cover" src="{{ Storage::url($item['book']->image) }}" alt="{{ $item['book']->title }}"/>
                                            @else
                                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-slate-200">
                                                    <span class="material-symbols-outlined text-2xl text-primary/40">menu_book</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 dark:text-slate-100">{{ $item['book']->title }}</p>
                                            <p class="text-xs text-slate-500">{{ $item['book']->authors->pluck('name')->join(', ') ?: 'Unknown' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-6">
                                    <form method="POST" action="{{ route('cart.update', $item['book']->id) }}">
                                        @csrf @method('PATCH')
                                        <div class="flex h-9 w-24 items-center justify-between rounded-lg border border-slate-200 dark:border-slate-800 px-2">
                                            <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="flex items-center justify-center text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-lg">remove</span>
                                            </button>
                                            <span class="text-sm font-bold">{{ $item['quantity'] }}</span>
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="flex items-center justify-center text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-lg">add</span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="px-6 py-6 font-medium text-slate-600 dark:text-slate-400">${{ number_format($item['book']->price, 2) }}</td>
                                <td class="px-6 py-6 font-bold text-slate-900 dark:text-slate-100">${{ number_format($item['subtotal'], 2) }}</td>
                                <td class="px-6 py-6 text-right">
                                    <form method="POST" action="{{ route('cart.remove', $item['book']->id) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-6">
                <a class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Continue Shopping
                </a>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-4">
            <div class="sticky top-24 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 p-6 shadow-sm">
                <h2 class="text-lg font-bold">Order Summary</h2>
                <div class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 dark:text-slate-400">Subtotal</span>
                        <span class="font-medium">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 dark:text-slate-400">Shipping</span>
                        <span class="font-medium text-emerald-600">Free</span>
                    </div>
                    <div class="border-t border-slate-200 dark:border-slate-800 pt-4">
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-lg font-black text-primary">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-8 space-y-3">
                    @auth
                        <a href="{{ route('checkout.index') }}"
                           class="w-full rounded-lg bg-primary py-4 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                            Commander
                        </a>
                    @else
                        <a href="{{ route('go.login', ['intended' => route('checkout.index')]) }}"
                           class="w-full rounded-lg bg-primary py-4 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                            Commander
                        </a>
                    @endauth
                    <div class="flex items-center justify-center gap-2 text-xs text-slate-400">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        Secure encrypted payment
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif
</main>

<footer class="mt-auto border-t border-slate-200 dark:border-slate-800 py-8 text-center text-sm text-slate-500">
    <p>© 2026 ADNANE BOOKS. All rights reserved.</p>
</footer>

</div>
</body>
</html>
