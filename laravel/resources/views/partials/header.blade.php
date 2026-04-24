<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
        <div class="flex items-center gap-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-lg">
                    <img alt="ADNANE BOOKS Logo" class="h-full w-full object-cover" src="{{ asset('images/logo.png') }}"/>
                </div>
                <h2 class="text-xl font-extrabold tracking-tight uppercase">ADNANE BOOKS</h2>
            </a>
            <nav class="hidden md:flex items-center gap-6">
                <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('home') ? 'text-primary' : '' }}" href="{{ route('home') }}">Home</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('catalog') ? 'text-primary' : '' }}" href="{{ route('catalog') }}">Books</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('about') ? 'text-primary' : '' }}" href="{{ route('about') }}">About Us</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('contact') ? 'text-primary' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                <a class="text-sm font-semibold hover:text-primary transition-colors" href="#">New Release</a>
            </nav>
        </div>

        <div class="flex items-center gap-4">
            <form method="GET" action="{{ route('catalog') }}" class="hidden lg:block relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input name="search" value="{{ request('search') }}" class="h-10 w-64 rounded-xl border-none bg-slate-100 dark:bg-slate-800 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/50" placeholder="Search books..." type="text"/>
            </form>

            <div class="flex items-center gap-2">
                <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800 hover:bg-primary/20 transition-colors">
                    <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">shopping_cart</span>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{{ $cartCount }}</span>
                    @endif
                </a>

                @auth
                    <div class="flex items-center gap-3 ml-2">
                        <a href="{{ route('orders.my') }}" class="hidden sm:block text-sm font-medium text-slate-600 hover:text-primary">My Orders</a>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:block text-sm font-bold text-primary">Dashboard</a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800 hover:bg-primary/20 transition-colors">
                            <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">person</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="flex h-10 w-10 items-center justify-center rounded-full bg-red-100/50 dark:bg-red-900/20 text-red-600 hover:bg-red-100 transition-colors">
                                <span class="material-symbols-outlined">logout</span>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('go.login', ['intended' => url()->current()]) }}" class="flex h-10 items-center justify-center rounded-xl bg-primary px-6 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all ml-2">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
