<header class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 sm:px-6 py-4">

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
            <div class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-lg">
                <img alt="ADNANE BOOKS Logo" class="h-full w-full object-cover" src="{{ asset('images/logo.png') }}"/>
            </div>
            <h2 class="text-lg font-extrabold tracking-tight uppercase">ADNANE BOOKS</h2>
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden md:flex items-center gap-6">
            <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('home') ? 'text-primary' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('catalog') ? 'text-primary' : '' }}" href="{{ route('catalog') }}">Books</a>
            <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('about') ? 'text-primary' : '' }}" href="{{ route('about') }}">About Us</a>
            <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('contact') ? 'text-primary' : '' }}" href="{{ route('contact') }}">Contact Us</a>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a class="text-sm font-bold text-primary hover:underline transition-colors {{ request()->routeIs('admin.*') ? 'underline' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                @else
                    <a class="text-sm font-semibold hover:text-primary transition-colors {{ request()->routeIs('orders.my') ? 'text-primary' : '' }}" href="{{ route('orders.my') }}">My Orders</a>
                @endif
            @endauth
        </nav>

        {{-- Desktop Right --}}
        <div class="hidden md:flex items-center gap-3">
            <form method="GET" action="{{ route('catalog') }}" class="hidden lg:block relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </span>
                <input name="search" value="{{ request('search') }}" class="h-10 w-56 rounded-xl border-none bg-slate-100 dark:bg-slate-800 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/50" placeholder="Search books..." type="text"/>
            </form>

            <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800 hover:bg-primary/20 transition-colors">
                <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">shopping_cart</span>
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{{ $cartCount }}</span>
                @endif
            </a>

            @auth
                @if(Auth::user()->role === 'admin')
                @else
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
            @else
                <a href="{{ route('go.login', ['intended' => url()->current()]) }}" class="flex h-10 items-center justify-center rounded-xl bg-primary px-5 text-sm font-bold text-white shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">
                    Sign In
                </a>
            @endauth
        </div>

        {{-- Mobile Right (cart + burger) --}}
        <div class="flex md:hidden items-center gap-2">
            <a href="{{ route('cart.index') }}" class="relative flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800">
                <span class="material-symbols-outlined text-slate-700 dark:text-slate-300">shopping_cart</span>
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-primary text-[10px] font-bold text-white">{{ $cartCount }}</span>
                @endif
            </a>
            <button id="mobile-menu-btn" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-200/50 dark:bg-slate-800 hover:bg-primary/20 transition-colors" aria-label="Toggle menu">
                <span class="material-symbols-outlined text-slate-700 dark:text-slate-300" id="menu-icon">menu</span>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden border-t border-slate-200 dark:border-slate-800 bg-background-light dark:bg-background-dark">
        {{-- Search --}}
        <div class="px-4 pt-4 pb-2">
            <form method="GET" action="{{ route('catalog') }}" class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 pointer-events-none">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </span>
                <input name="search" value="{{ request('search') }}" class="w-full h-10 rounded-xl border-none bg-slate-100 dark:bg-slate-800 pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/50" placeholder="Search books..." type="text"/>
            </form>
        </div>

        {{-- Nav Links --}}
        <nav class="px-4 py-2 space-y-1">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-primary/10 text-primary' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-xl">home</span> Home
            </a>
            <a href="{{ route('catalog') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('catalog') ? 'bg-primary/10 text-primary' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-xl">menu_book</span> Books
            </a>
            <a href="{{ route('about') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('about') ? 'bg-primary/10 text-primary' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-xl">info</span> About Us
            </a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('contact') ? 'bg-primary/10 text-primary' : 'hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-xl">mail</span> Contact Us
            </a>
        </nav>

        {{-- Auth --}}
        <div class="px-4 pb-4 pt-2 border-t border-slate-100 dark:border-slate-800 mt-2">
            @auth
                <div class="flex items-center gap-3 px-3 py-2 mb-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary/10 text-primary font-bold text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-400">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-primary hover:bg-primary/10 transition-colors">
                        <span class="material-symbols-outlined text-xl">dashboard</span> Dashboard
                    </a>
                @else
                    <a href="{{ route('orders.my') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <span class="material-symbols-outlined text-xl">receipt_long</span> My Orders
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <span class="material-symbols-outlined text-xl">person</span> Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <span class="material-symbols-outlined text-xl">logout</span> Sign Out
                    </button>
                </form>
            @else
                <a href="{{ route('go.login', ['intended' => url()->current()]) }}" class="flex items-center justify-center gap-2 w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary/90 transition-all">
                    <span class="material-symbols-outlined">login</span> Sign In
                </a>
            @endauth
        </div>
    </div>
</header>

<script>
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('menu-icon');
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        icon.textContent = menu.classList.contains('hidden') ? 'menu' : 'close';
    });
</script>
