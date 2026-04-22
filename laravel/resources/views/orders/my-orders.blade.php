@extends('layouts.customer')

@section('title', 'My Orders — ADNANE BOOKS')

@section('content')
<main class="mx-auto max-w-4xl px-4 py-8">
    <h1 class="text-2xl font-black mb-6">My Orders</h1>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
    <div class="bg-white dark:bg-slate-900/50 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm mb-4 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 dark:border-slate-800">
            <div class="flex items-center gap-4">
                <span class="font-mono text-sm text-slate-400">#{{ $order->id }}</span>
                <span class="text-sm text-slate-500">{{ $order->created_at->format('d M Y') }}</span>
            </div>
            <div class="flex items-center gap-4">
                @php 
                    $colors = [
                        'pending' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                        'paid' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                        'shipped' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                        'delivered' => ['bg' => 'bg-emerald-100', 'text' => 'text-emerald-700'],
                    ];
                    $c = $colors[$order->status] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-700'];
                @endphp
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $c['bg'] }} {{ $c['text'] }} capitalize">{{ $order->status }}</span>
                <span class="font-black text-primary">${{ number_format($order->total_price, 2) }}</span>
                @if($order->status === 'pending')
                <form method="POST" action="{{ route('orders.pay', $order->id) }}">
                    @csrf
                    <button class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-primary/90">Pay Now</button>
                </form>
                @endif
            </div>
        </div>
        <div class="px-6 py-4 space-y-3">
            @foreach($order->items as $item)
            <div class="flex items-center gap-4">
                <div class="h-14 w-10 rounded bg-slate-100 dark:bg-slate-800 overflow-hidden shrink-0">
                    @if($item->book?->image)
                        <img src="{{ Storage::url($item->book->image) }}" class="h-full w-full object-cover"/>
                    @else
                        <div class="h-full w-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-300 text-lg">menu_book</span>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm">{{ $item->book?->title ?? 'Deleted book' }}</p>
                    <p class="text-xs text-slate-400">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                </div>
                <p class="font-bold text-sm text-slate-900 dark:text-slate-100">${{ number_format($item->quantity * $item->price, 2) }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center py-24 text-slate-400">
        <span class="material-symbols-outlined text-6xl mb-4 block">receipt_long</span>
        <p class="font-semibold">No orders yet.</p>
        <a href="{{ route('catalog') }}" class="mt-3 inline-block text-sm text-primary hover:underline">Browse books</a>
    </div>
    @endforelse
</main>
@endsection

