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
<style>
body{font-family:'Inter',sans-serif;}
.material-symbols-outlined{font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24;}
.step-hidden{display:none;}
</style>
</head>
<body class="bg-background-light text-slate-900 font-display antialiased">

<!-- Header -->
<header class="sticky top-0 z-50 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-extrabold text-lg tracking-tight">ADNANE BOOKS</a>
    <div class="hidden md:flex items-center gap-2 text-sm">
        <span class="flex items-center gap-1.5 text-slate-400">
            <span class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold">1</span> Cart
        </span>
        <span class="text-slate-300">›</span>
        <span class="flex items-center gap-1.5 text-primary font-semibold">
            <span class="w-5 h-5 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">2</span> Checkout
        </span>
        <span class="text-slate-300">›</span>
        <span class="flex items-center gap-1.5 text-slate-400">
            <span class="w-5 h-5 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold">3</span> Confirmation
        </span>
    </div>
    <a href="{{ route('cart.index') }}" class="text-sm text-slate-500 hover:text-primary flex items-center gap-1">
        <span class="material-symbols-outlined text-base">arrow_back</span> Back to Cart
    </a>
</header>

<main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
    @if($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('checkout.store') }}" id="checkout-form">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left — Steps -->
            <div class="lg:col-span-7 space-y-6">

                <!-- STEP 1 — Delivery Address -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden" id="step-address">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold" id="step1-badge">1</div>
                            <h2 class="font-bold text-base">Delivery Address</h2>
                        </div>
                        <!-- Edit button shown after save -->
                        <button type="button" id="edit-address-btn" onclick="editAddress()"
                            class="hidden text-xs font-bold text-primary hover:underline flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">edit</span> Edit
                        </button>
                    </div>

                    <!-- Form fields -->
                    <div id="address-form" class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary" placeholder="Adnane"/>
                            @error('first_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary" placeholder="Khamlichi"/>
                            @error('last_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+212 6XX XXX XXX"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Region</label>
                            <input type="text" name="region" value="{{ old('region') }}" required placeholder="Casablanca-Settat"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('region')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" required placeholder="Casablanca"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" required placeholder="Street, building, apartment..."
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Additional Information <span class="text-slate-400 font-normal">(optional)</span></label>
                            <textarea name="additional_info" rows="2" placeholder="Landmark, delivery instructions..."
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary">{{ old('additional_info') }}</textarea>
                        </div>
                        <!-- Save / Cancel buttons -->
                        <div class="sm:col-span-2 flex gap-3 pt-2">
                            <button type="button" onclick="saveAddress()"
                                class="bg-primary text-white text-sm font-bold px-6 py-2.5 rounded-lg hover:bg-primary/90 transition-colors">
                                Save
                            </button>
                            <a href="{{ route('cart.index') }}"
                                class="border border-slate-200 text-slate-600 text-sm font-bold px-6 py-2.5 rounded-lg hover:bg-slate-50 transition-colors">
                                Cancel
                            </a>
                        </div>
                    </div>

                    <!-- Summary shown after save -->
                    <div id="address-summary" class="hidden px-6 py-4 text-sm text-slate-700 space-y-1">
                        <p id="summary-name" class="font-semibold"></p>
                        <p id="summary-phone" class="text-slate-500"></p>
                        <p id="summary-address" class="text-slate-500"></p>
                        <p id="summary-city" class="text-slate-500"></p>
                        <p id="summary-info" class="text-slate-400 italic text-xs"></p>
                    </div>
                </div>

                <!-- STEP 2 — Delivery Mode (hidden until address saved) -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden step-hidden" id="step-delivery">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">2</div>
                        <h2 class="font-bold text-base">Delivery Mode</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-primary bg-primary/5 cursor-pointer transition-colors" id="label-standard">
                            <input type="radio" name="delivery_mode" value="standard" checked
                                class="text-primary focus:ring-primary" onchange="updateTotal(this)"/>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Standard Delivery</p>
                                <p class="text-xs text-slate-500">3–5 business days</p>
                            </div>
                            <span class="font-bold text-emerald-600 text-sm">Free</span>
                        </label>
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-slate-200 hover:border-slate-300 cursor-pointer transition-colors" id="label-express">
                            <input type="radio" name="delivery_mode" value="express"
                                class="text-primary focus:ring-primary" onchange="updateTotal(this)"/>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Express Delivery</p>
                                <p class="text-xs text-slate-500">Next business day</p>
                            </div>
                            <span class="font-bold text-slate-700 text-sm">$9.99</span>
                        </label>
                    </div>
                </div>

                <!-- STEP 3 — Payment Method (hidden until address saved) -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden step-hidden" id="step-payment">
                    <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
                        <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold">3</div>
                        <h2 class="font-bold text-base">Payment Method</h2>
                    </div>
                    <div class="p-6 space-y-3">
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-primary bg-primary/5 cursor-pointer" id="label-cash">
                            <input type="radio" name="payment_method" value="cash" checked class="text-primary focus:ring-primary"/>
                            <span class="material-symbols-outlined text-slate-500">payments</span>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Cash on Delivery</p>
                                <p class="text-xs text-slate-500">Pay when you receive your order</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-4 p-4 rounded-xl border-2 border-slate-200 hover:border-slate-300 cursor-pointer" id="label-card">
                            <input type="radio" name="payment_method" value="card" class="text-primary focus:ring-primary"/>
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
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Delivery</span>
                            <span class="font-medium text-emerald-600" id="delivery-fee-text">Free</span>
                        </div>
                        <div class="flex justify-between font-black text-base border-t border-slate-100 pt-3">
                            <span>Total</span>
                            <span class="text-primary" id="total-display">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                    <div class="px-6 pb-6">
                        <button type="submit" id="place-order-btn"
                            class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed"
                            disabled>
                            <span class="material-symbols-outlined">check_circle</span>
                            Place Order
                        </button>
                        <p id="place-order-hint" class="text-center text-xs text-slate-400 mt-2">Fill in your address to continue</p>
                        <div class="flex items-center justify-center gap-2 mt-2 text-xs text-slate-400">
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

function saveAddress() {
    const fields = ['first_name','last_name','phone','region','city','address'];
    let valid = true;
    fields.forEach(name => {
        const el = document.querySelector(`[name="${name}"]`);
        if (!el.value.trim()) { el.classList.add('border-red-400'); valid = false; }
        else el.classList.remove('border-red-400');
    });
    if (!valid) return;

    // Build summary
    const fn = document.querySelector('[name=first_name]').value;
    const ln = document.querySelector('[name=last_name]').value;
    const phone = document.querySelector('[name=phone]').value;
    const addr = document.querySelector('[name=address]').value;
    const city = document.querySelector('[name=city]').value;
    const region = document.querySelector('[name=region]').value;
    const info = document.querySelector('[name=additional_info]').value;

    document.getElementById('summary-name').textContent = fn + ' ' + ln;
    document.getElementById('summary-phone').textContent = phone;
    document.getElementById('summary-address').textContent = addr;
    document.getElementById('summary-city').textContent = city + ', ' + region;
    document.getElementById('summary-info').textContent = info || '';

    // Hide form, show summary
    document.getElementById('address-form').classList.add('hidden');
    document.getElementById('address-summary').classList.remove('hidden');
    document.getElementById('edit-address-btn').classList.remove('hidden');
    document.getElementById('step1-badge').innerHTML = '✓';
    document.getElementById('step1-badge').classList.replace('bg-primary','bg-emerald-500');

    // Show next steps
    document.getElementById('step-delivery').classList.remove('step-hidden');
    document.getElementById('step-payment').classList.remove('step-hidden');

    // Enable place order
    document.getElementById('place-order-btn').disabled = false;
    document.getElementById('place-order-hint').classList.add('hidden');
}

function editAddress() {
    document.getElementById('address-form').classList.remove('hidden');
    document.getElementById('address-summary').classList.add('hidden');
    document.getElementById('edit-address-btn').classList.add('hidden');
    document.getElementById('step-delivery').classList.add('step-hidden');
    document.getElementById('step-payment').classList.add('step-hidden');
    document.getElementById('place-order-btn').disabled = true;
    document.getElementById('place-order-hint').classList.remove('hidden');
    document.getElementById('step1-badge').innerHTML = '1';
    document.getElementById('step1-badge').classList.replace('bg-emerald-500','bg-primary');
}

function updateTotal(radio) {
    const fee = radio.value === 'express' ? 9.99 : 0;
    document.getElementById('delivery-fee-text').textContent = fee > 0 ? '$9.99' : 'Free';
    document.getElementById('delivery-fee-text').className = fee > 0
        ? 'font-medium text-slate-700' : 'font-medium text-emerald-600';
    document.getElementById('total-display').textContent = '$' + (baseTotal + fee).toFixed(2);

    // Update border styles
    document.getElementById('label-standard').className = radio.value === 'standard'
        ? 'flex items-center gap-4 p-4 rounded-xl border-2 border-primary bg-primary/5 cursor-pointer transition-colors'
        : 'flex items-center gap-4 p-4 rounded-xl border-2 border-slate-200 hover:border-slate-300 cursor-pointer transition-colors';
    document.getElementById('label-express').className = radio.value === 'express'
        ? 'flex items-center gap-4 p-4 rounded-xl border-2 border-primary bg-primary/5 cursor-pointer transition-colors'
        : 'flex items-center gap-4 p-4 rounded-xl border-2 border-slate-200 hover:border-slate-300 cursor-pointer transition-colors';
}

// If validation failed (server-side), show all steps
@if($errors->any())
    document.getElementById('step-delivery').classList.remove('step-hidden');
    document.getElementById('step-payment').classList.remove('step-hidden');
    document.getElementById('place-order-btn').disabled = false;
    document.getElementById('place-order-hint').classList.add('hidden');
@endif
</script>
</body>
</html>
