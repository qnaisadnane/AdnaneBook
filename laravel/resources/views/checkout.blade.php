@extends('layouts.customer')

@section('title', 'Checkout — ADNANE BOOKS')

@push('styles')
<style>
.step-hidden{display:none;}
#card-element {
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    background: white;
    min-height: 44px;
}
.StripeElement {
    width: 100%;
    display: block;
}
.StripeElement--focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
}
</style>
@endpush

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
@endpush

@section('content')
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
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary" placeholder="Enter your name"/>
                            @error('first_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary" placeholder="Enter your last name"/>
                            @error('last_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="06XXXXXXXX or 07XXXXXXXX"
                                pattern="^0[67][0-9]{8}$"
                                title="Must start with 06 or 07 and contain exactly 10 digits"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Region</label>
                            <input type="text" name="region" value="{{ old('region') }}" required placeholder="Enter your region"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('region')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" required placeholder="Enter your city"
                                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
                            @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" required placeholder="enter you address"
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
                            <input type="radio" name="payment_method" value="card" class="text-primary focus:ring-primary" id="payment-card-radio"/>
                            <span class="material-symbols-outlined text-slate-500">credit_card</span>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Credit / Debit Card</p>
                                <p class="text-xs text-slate-500">Secure payment via Stripe</p>
                            </div>
                        </label>

                        <!-- Stripe Card Element Container -->
                        <div id="stripe-card-section" class="hidden mt-4 p-4 rounded-xl border border-slate-200 bg-slate-50 dark:bg-slate-800 dark:border-slate-700">
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-400 mb-3">Card Details</label>
                            <div id="card-element" class="w-full"></div>
                            <div id="card-errors" class="text-red-500 text-xs mt-2" role="alert"></div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right — Order Summary -->
            <div class="lg:col-span-5 order-first lg:order-last">
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
                                    <img src="{{ asset($item['book']->image) }}" class="h-full w-full object-cover"/>
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
@endsection

@push('scripts')
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

    // Validate phone
    const phoneEl = document.querySelector('[name="phone"]');
    const phoneValid = /^0[67][0-9]{8}$/.test(phoneEl.value.trim());
    if (!phoneValid) {
        phoneEl.classList.add('border-red-400');
        let err = document.getElementById('phone-error');
        if (!err) {
            err = document.createElement('p');
            err.id = 'phone-error';
            err.className = 'text-red-500 text-xs mt-1';
            phoneEl.parentNode.appendChild(err);
        }
        err.textContent = 'Phone must start with 06 or 07 and contain exactly 10 digits.';
        valid = false;
    } else {
        phoneEl.classList.remove('border-red-400');
        const err = document.getElementById('phone-error');
        if (err) err.remove();
    }

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

// --- Stripe Integration ---
const stripe = Stripe('{{ env('STRIPE_KEY') }}');
const elements = stripe.elements();
const card = elements.create('card', {
    hidePostalCode: true,
    style: {
        base: {
            fontSize: '16px',
            color: '#32325d',
            fontFamily: '"Inter", sans-serif',
            fontSmoothing: 'antialiased',
            '::placeholder': { color: '#aab7c4' },
            iconColor: '#2563eb',
        },
        invalid: { color: '#fa755a', iconColor: '#fa755a' }
    }
});
card.mount('#card-element');

// Listen for radio changes
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const stripeSection = document.getElementById('stripe-card-section');
        if (this.value === 'card') {
            stripeSection.classList.remove('hidden');
            document.getElementById('label-card').classList.add('border-primary', 'bg-primary/5');
            document.getElementById('label-card').classList.remove('border-slate-200');
            document.getElementById('label-cash').classList.remove('border-primary', 'bg-primary/5');
            document.getElementById('label-cash').classList.add('border-slate-200');
        } else {
            stripeSection.classList.add('hidden');
            document.getElementById('label-cash').classList.add('border-primary', 'bg-primary/5');
            document.getElementById('label-cash').classList.remove('border-slate-200');
            document.getElementById('label-card').classList.remove('border-primary', 'bg-primary/5');
            document.getElementById('label-card').classList.add('border-slate-200');
        }
    });
});

// Handle form submission
const form = document.getElementById('checkout-form');
form.addEventListener('submit', async (event) => {
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
    
    if (paymentMethod === 'card') {
        event.preventDefault();
        
        // Disable button to prevent double-click
        document.getElementById('place-order-btn').disabled = true;
        document.getElementById('place-order-btn').innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Processing...';

        const {token, error} = await stripe.createToken(card);

        if (error) {
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            document.getElementById('place-order-btn').disabled = false;
            document.getElementById('place-order-btn').innerHTML = '<span class="material-symbols-outlined">check_circle</span> Place Order';
        } else {
            // Append token to form and submit
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    }
});

// If validation failed (server-side), show all steps
@if($errors->any())
    document.getElementById('step-delivery').classList.remove('step-hidden');
    document.getElementById('step-payment').classList.remove('step-hidden');
    document.getElementById('place-order-btn').disabled = false;
    document.getElementById('place-order-hint').classList.add('hidden');
    
    // Maintain stripe section if card was selected
    if (document.querySelector('input[name="payment_method"]:checked').value === 'card') {
        document.getElementById('stripe-card-section').classList.remove('hidden');
    }
@endif
</script>
@endpush

