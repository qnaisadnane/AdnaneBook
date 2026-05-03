@extends('layouts.customer')

@section('title', 'Créer un compte - Adnane Books')

@push('styles')
<style>
    .glass-panel {
        background: rgba(251, 248, 255, 0.7);
        backdrop-filter: blur(20px);
    }
    .ghost-border {
        border: 1px solid rgba(197, 197, 212, 0.15);
    }
    .air-shadow {
        box-shadow: 0 8px 64px rgba(26, 27, 34, 0.06);
    }
    .auth-gradient {
        background: linear-gradient(135deg, #2b3896 0%, #4551af 100%);
    }
</style>
@endpush

@section('content')
<main class="min-h-[80vh] flex items-center justify-center p-6 bg-cover bg-center rounded-xl my-8 mx-4 sm:mx-6 lg:mx-auto max-w-7xl relative overflow-hidden" style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=2070');">
    <div class="absolute inset-0 bg-slate-100/60 dark:bg-slate-900/60 backdrop-blur-sm"></div>
    <div class="w-full max-w-md mx-auto relative z-10">
        <div class="bg-white dark:bg-slate-900 p-8 md:p-12 rounded-xl air-shadow border border-slate-200 dark:border-slate-800">
            
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white mb-2">SIGN UP</h2>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Full Name -->
                <div class="space-y-2">
                    <label class="block text-xs font-semibold tracking-wide uppercase text-slate-500 ml-1" for="name">Full Name</label>
                    <input class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all outline-none text-slate-900 dark:text-slate-100 text-sm" id="name" name="name" :value="old('name')" required autofocus placeholder="Enter your name" type="text"/>
                    @error('name')<p class="mt-1 text-red-500 text-xs ml-1">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-xs font-semibold tracking-wide uppercase text-slate-500 ml-1" for="email">E-mail</label>
                    <input class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all outline-none text-slate-900 dark:text-slate-100 text-sm" id="email" name="email" :value="old('email')" required placeholder="Enter your email" type="email"/>
                    @error('email')<p class="mt-1 text-red-500 text-xs ml-1">{{ $message }}</p>@enderror
                </div>

                <!-- Password Fields Group -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold tracking-wide uppercase text-slate-500 ml-1" for="password">Password</label>
                        <input class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all outline-none text-slate-900 dark:text-slate-100 text-sm" id="password" name="password" required autocomplete="new-password" type="password"/>
                        @error('password')<p class="mt-1 text-red-500 text-xs ml-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold tracking-wide uppercase text-slate-500 ml-1" for="password_confirmation">Confirm</label>
                        <input class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all outline-none text-slate-900 dark:text-slate-100 text-sm" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" type="password"/>
                    </div>
                </div>

                <!-- Submit Button -->
                <button class="w-full py-4 rounded-xl auth-gradient text-white font-bold text-sm tracking-wide shadow-lg hover:shadow-primary/20 hover:scale-[1.01] active:scale-[0.98] transition-all duration-200" type="submit">
                    Sign Up
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-8">
                <div aria-hidden="true" class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200 dark:border-slate-800"></div>
                </div>
            </div>

            <!-- Login Link -->
            <div class="mt-10 text-center">
                <p class="text-sm text-slate-500">
                    Have an account ? 
                    <a class="text-primary font-bold hover:underline decoration-primary/30 transition-all" href="{{ route('login') }}">Login</a>
                </p>
            </div>
            
        </div>
    </div>
</main>
@endsection

