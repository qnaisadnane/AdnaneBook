<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>My Orders — ADNANE BOOKS</title>
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>tailwind.config={theme:{extend:{colors:{primary:"#2463eb"},fontFamily:{display:["Inter"]}}}}</script>
<style>body{font-family:'Inter',sans-serif;}.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}</style>
</head>
<body class="bg-slate-100 font-display text-slate-900 antialiased">

<header class="sticky top-0 z-50 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-extrabold text-lg tracking-tight">ADNANE BOOKS</a>
    <div class="flex items-center gap-4">
        <a href="{{ route('catalog') }}" class="text-sm text-slate-500 hover:text-primary">Catalog</a>
        <a href="{{ route('cart.index') }}" class="text-sm text-slate-500 hover:text-primary">Cart</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm text-slate-500 hover:text-primary">Log Out</button>
        </form>
    </div>
</header>

<main class="mx-auto max-w-4xl px-4 py-8">
    <h1 class="text-2xl font-black mb-6">My Orders</h1>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
    @endif

    @forelse($orders as $order)
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-4 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <div class="flex items-center gap-4">
                <span class="font-mono text-sm text-slate-400">#{{ $order->id }}</span>
                <span class="text-sm text-slate-500">{{ $order->created_at->format('d M Y') }}</span>
            </div>
            <div class="flex items-center gap-4">
                @php $colors=['pending'=>'amber','paid'=>'blue','shipped'=>'purple','delivered'=>'green']; $c=$colors[$order->status]??'slate'; @endphp
                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-{{ $c }}-100 text-{{ $c }}-700 capitalize">{{ $order->status }}</span>
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
                <div class="h-14 w-10 rounded bg-slate-100 overflow-hidden shrink-0">
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
                <p class="font-bold text-sm">${{ number_format($item->quantity * $item->price, 2) }}</p>
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
</body>
</html>
