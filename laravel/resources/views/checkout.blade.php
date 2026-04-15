<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Checkout — ADNANE BOOKS</title>
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>tailwind.config={theme:{extend:{colors:{primary:"#2463eb","background-light":"#f6f6f8"},fontFamily:{display:["Inter"]}}}}</script>
<style>body{font-family:'Inter',sans-serif;}.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}</style>
</head>
<body class="bg-background-light text-slate-900 font-display antialiased">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-extrabold text-lg tracking-tight">ADNANE BOOKS</a>
    <!-- Steps -->
    <div class="hidden md:flex items-center gap-2 text-sm">
        <span class="flex items-center gap-1 text-slate-400"><span class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold">1</span> Cart</span>
        <span class="text-slate-300">›</span>
        <span class="flex items-center gap-1 text-primary font-semibold"><span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">2</span> Checkout</span>
        <span class="text-slate-300">›</span>
        <span class="flex items-center gap-1 text-slate-400"><span class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold">3</span> Confirmation</span>
    </div>
    <a href="{{ route('cart.index') }}" class="text-sm text-slate-500 hover:text-primary flex items-center gap-1">
        <span class="material-symbols-outlined text-base">arrow_back</span> Back to Cart
    </a>
</header>

<main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left — Forms -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Delivery Address -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">1</div>
                            <h2 class="font-bold text-base">Delivery Address</h2>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="bg-primary text-white text-xs font-bold px-4 py-1.5 rounded-lg hover:bg-primary/90 transition-colors">
                                Save
                            </button>
                            <a href="{{ route('cart.index') }}" class="border border-slate-200 text-slate-600 text-xs font-bold px-4 py-1.5 rounded-lg hover:bg-slate-50 transition-colors">
                                Cancel
                            </a>
                        </div>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Full Name</label>
                            <input type="text" name="full_name" value="{{ old('full_name', Auth::user()->name) }}" required
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+212 6XX XXX XXX"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" required placeholder="Casablanca"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Full Address</label>
                            <textarea name="address" rows="2" required placeholder="Street, neighborhood, building..."
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary">{{ old('address') }}</textarea>
                            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Delivery Mode -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">2</div>
                        <h2 class="font-bold text-base">Delivery Mode</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-colors {{ old('delivery_mode', 'standard') === 'standard' ? 'border-primary bg-primary/5' : 'border-slate-200 hover:border-slate-300' }}">
                            <input type="radio" name="delivery_mode" value="standard" {{ old('delivery_mode', 'standard') === 'standard' ? 'checked' : '' }}
                                class="text-primary focus:ring-primary" onchange="updateDelivery(this)"/>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Standard Delivery</p>
                                <p class="text-xs text-slate-500">3–5 business days</p>
                            </div>
                            <span class="font-bold text-emerald-600 text-sm">Free</span>
                        </label>
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-colors {{ old('delivery_mode') === 'express' ? 'border-primary bg-primary/5' : 'border-slate-200 hover:border-slate-300' }}">
                            <input type="radio" name="delivery_mode" value="express" {{ old('delivery_mode') === 'express' ? 'checked' : '' }}
                                class="text-primary focus:ring-primary" onchange="updateDelivery(this)"/>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Express Delivery</p>
                                <p class="text-xs text-slate-500">Next business day</p>
                            </div>
                            <span class="font-bold text-slate-700 text-sm">$9.99</span>
                        </label>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">3</div>
                        <h2 class="font-bold text-base">Payment Method</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-colors {{ old('payment_method', 'cash') === 'cash' ? 'border-primary bg-primary/5' : 'border-slate-200 hover:border-slate-300' }}">
                            <input type="radio" name="payment_method" value="cash" {{ old('payment_method', 'cash') === 'cash' ? 'checked' : '' }}
                                class="text-primary focus:ring-primary"/>
                            <span class="material-symbols-outlined text-slate-500">payments</span>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Cash on Delivery</p>
                                <p class="text-xs text-slate-500">Pay when you receive your order</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-colors {{ old('payment_method') === 'card' ? 'border-primary bg-primary/5' : 'border-slate-200 hover:border-slate-300' }}">
                            <input type="radio" name="payment_method" value="card" {{ old('payment_method') === 'card' ? 'checked' : '' }}
                                class="text-primary focus:ring-primary"/>
                            <span class="material-symbols-outlined text-slate-500">credit_card</span>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Credit / Debit Card</p>
                                <p class="text-xs text-slate-500">Simulated — instant payment</p>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- Right — Order Summary -->
            <div class="lg:col-span-5">
                <div class="sticky top-24 bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100">
                        <h2 class="font-bold text-base">Order Summary</h2>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $items->count() }} item(s)</p>
                    </div>
                    <div class="px-6 py-4 space-y-4 max-h-64 overflow-y-auto">
                        @foreach($items as $item)
                        <div class="flex items-center gap-3">
                            <div class="h-14 w-10 rounded bg-slate-100 overflow-hidden shrink-0">
                                @if($item['book']->image)
                                    <img src="{{ Storage::url($item['book']->image) }}" class="h-full w-full object-cover"/>
                                @else
                                    <div class="h-full w-full flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-300 text-sm">menu_book</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-sm truncate">{{ $item['book']->title }}</p>
                                <p class="text-xs text-slate-400">Qty: {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-bold text-sm shrink-0">${{ number_format($item['subtotal'], 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="px-6 py-4 border-t border-slate-100 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Subtotal</span>
                            <span class="font-medium">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm" id="delivery_fee_row">
                            <span class="text-slate-500">Delivery</span>
                            <span class="font-medium text-emerald-600" id="delivery_fee_text">Free</span>
                        </div>
                        <div class="flex justify-between font-black text-base border-t border-slate-100 pt-3">
                            <span>Total</span>
                            <span class="text-primary" id="total_display">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <div class="px-6 pb-6">
                        <button type="submit"
                            class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            Place Order
                        </button>
                        <div class="flex items-center justify-center gap-2 mt-3 text-xs text-slate-400">
                            <span class="material-symbols-outlined text-sm">lock</span>
                            Secure & encrypted
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</main>

<script>
    const baseTotal = {{ $total }};
    function updateDelivery(radio) {
        const fee = radio.value === 'express' ? 9.99 : 0;
        document.getElementById('delivery_fee_text').textContent = fee > 0 ? '$' + fee.toFixed(2) : 'Free';
        document.getElementById('delivery_fee_text').className = fee > 0 ? 'font-medium text-slate-700' : 'font-medium text-emerald-600';
        document.getElementById('total_display').textContent = '$' + (baseTotal + fee).toFixed(2);
    }
</script>
</body>
</html>
