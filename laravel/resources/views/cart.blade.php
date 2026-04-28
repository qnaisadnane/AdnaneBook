@extends('layouts.customer')

@section('title', 'ADNANE BOOKS - Your Cart')

@section('content')
<main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-4xl font-black tracking-tight">Your Cart</h1>
        <p class="mt-1 text-slate-500 dark:text-slate-400 text-sm">Review your selection before proceeding to checkout.</p>
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
    <div class="flex flex-col lg:grid lg:grid-cols-12 gap-6">

        {{-- Cart Items --}}
        <div class="lg:col-span-8 space-y-4">

            {{-- Mobile: cards --}}
            <div class="lg:hidden space-y-3">
                @foreach($items as $item)
                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 p-4">
                    <div class="flex gap-3">
                        <div class="h-20 w-14 shrink-0 overflow-hidden rounded-lg bg-slate-100 dark:bg-slate-800">
                            @if($item['book']->image)
                                <img class="h-full w-full object-cover" src="{{ asset($item['book']->image) }}" alt="{{ $item['book']->title }}"/>
                            @else
                                <div class="h-full w-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-2xl text-primary/40">menu_book</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-sm text-slate-900 dark:text-slate-100 line-clamp-2">{{ $item['book']->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $item['book']->authors->pluck('name')->join(', ') ?: 'Unknown' }}</p>
                            <p class="text-sm font-bold text-primary mt-1">${{ number_format($item['book']->price, 2) }}</p>
                        </div>
                        <form method="POST" action="{{ route('cart.remove', $item['book']->id) }}" class="shrink-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors">
                                <span class="material-symbols-outlined text-xl">close</span>
                            </button>
                        </form>
                    </div>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                        <form method="POST" action="{{ route('cart.update', $item['book']->id) }}">
                            @csrf @method('PATCH')
                            <div class="flex h-9 w-28 items-center justify-between rounded-lg border border-slate-200 dark:border-slate-700 px-2">
                                <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="text-slate-400 hover:text-primary">
                                    <span class="material-symbols-outlined text-lg">remove</span>
                                </button>
                                <span class="text-sm font-bold">{{ $item['quantity'] }}</span>
                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="text-slate-400 hover:text-primary">
                                    <span class="material-symbols-outlined text-lg">add</span>
                                </button>
                            </div>
                        </form>
                        <p class="font-black text-slate-900 dark:text-slate-100">${{ number_format($item['subtotal'], 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Desktop: table --}}
            <div class="hidden lg:block overflow-hidden rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 shadow-sm">
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
                            <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="h-20 w-14 shrink-0 overflow-hidden rounded-md bg-slate-100 dark:bg-slate-800 shadow-sm">
                                            @if($item['book']->image)
                                                <img class="h-full w-full object-cover" src="{{ asset($item['book']->image) }}" alt="{{ $item['book']->title }}"/>
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
                                <td class="px-6 py-5">
                                    <form method="POST" action="{{ route('cart.update', $item['book']->id) }}">
                                        @csrf @method('PATCH')
                                        <div class="flex h-9 w-24 items-center justify-between rounded-lg border border-slate-200 dark:border-slate-800 px-2">
                                            <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}" class="text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-lg">remove</span>
                                            </button>
                                            <span class="text-sm font-bold">{{ $item['quantity'] }}</span>
                                            <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-lg">add</span>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="px-6 py-5 font-medium text-slate-600 dark:text-slate-400">${{ number_format($item['book']->price, 2) }}</td>
                                <td class="px-6 py-5 font-bold text-slate-900 dark:text-slate-100">${{ number_format($item['subtotal'], 2) }}</td>
                                <td class="px-6 py-5 text-right">
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

            <div class="flex items-center justify-between">
                <a class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:underline" href="{{ route('catalog') }}">
                    <span class="material-symbols-outlined text-base">arrow_back</span>
                    Continue Shopping
                </a>
                <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Vider votre panier ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 text-sm font-bold text-red-500 hover:underline">
                        <span class="material-symbols-outlined text-base">delete_sweep</span>
                        Clear Cart
                    </button>
                </form>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="lg:col-span-4">
            <div class="sticky top-24 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 p-6 shadow-sm">
                <h2 class="text-lg font-bold mb-6">Order Summary</h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Subtotal</span>
                        <span class="font-medium">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Shipping</span>
                        <span class="font-medium text-emerald-600">Free</span>
                    </div>
                    <div class="border-t border-slate-200 dark:border-slate-800 pt-3">
                        <div class="flex items-center justify-between">
                            <span class="text-base font-bold">Total</span>
                            <span class="text-lg font-black text-primary">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    @auth
                        <a href="{{ route('checkout.index') }}" class="w-full rounded-lg bg-primary py-4 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                            Checkout
                        </a>
                    @else
                        <a href="{{ route('go.login', ['intended' => route('checkout.index')]) }}" class="w-full rounded-lg bg-primary py-4 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">shopping_bag</span>
                            Checkout
                        </a>
                    @endauth
                    <div class="flex items-center justify-center gap-2 mt-3 text-xs text-slate-400">
                        <span class="material-symbols-outlined text-sm">lock</span>
                        Secure encrypted payment
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif
</main>
@endsection
