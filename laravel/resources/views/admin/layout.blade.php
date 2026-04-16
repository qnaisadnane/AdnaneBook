<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title', 'Admin') — ADNANE BOOKS</title>
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
                },
                fontFamily: { "display": ["Inter"] },
                borderRadius: {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"},
            },
        },
    }
</script>
<style>
    body { font-family: 'Inter', sans-serif; }
    .material-symbols-outlined { font-size: 24px; font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="bg-background-light text-slate-900 font-display">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-full z-50">
        <div class="p-6 flex items-center gap-3">
            <img alt="ADNANE BOOKS Logo" class="size-10 rounded-lg object-contain"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuCHaSfcSQzACpzRaM85jtiSCRc2YZlQQ9OyjG88BCQ5ZRkXGmMJ6p5sgW7qOfOSbNxOXlaN02z5vQUaNsva1DLs7kg8MgMhovhkKJQJcQRpKttceHtfdVsCU2spvQq58vpCHc4yf1rpvDePLbftu4871vWwSCUPgH38ziV8x27TpG0c3Cb_alPk9XYlJ0qI-qKLfmL-DyXCKCGXTDyr9snZhwNdFVPOIrXKkeppV89fFzJptxN652VAAHik8EXINBDVxoJIpWYlQ7_G"/>
            <div>
                <h1 class="text-sm font-bold tracking-tight">ADNANE BOOKS</h1>
                <p class="text-xs text-slate-500">Admin Console</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1">
            @php $role = Auth::user()->role; @endphp

            @if($role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>
            @endif

            @if(in_array($role, ['admin']))
            <a href="{{ route('books.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('books.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <span>Books</span>
            </a>
            <a href="{{ route('categories.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('categories.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }}">
                <span class="material-symbols-outlined">category</span>
                <span>Categories</span>
            </a>
            <a href="{{ route('authors.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('authors.*') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }}">
                <span class="material-symbols-outlined">person</span>
                <span>Authors</span>
            </a>
            @endif

            @if(in_array($role, ['admin']))
            <a href="{{ route('orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('orders.index') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <span>Orders</span>
            </a>
            @endif

            @if($role === 'admin')
            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.users') ? 'bg-primary/10 text-primary' : 'text-slate-600 hover:bg-slate-100' }}">
                <span class="material-symbols-outlined">group</span>
                <span>Customers</span>
            </a>
            @endif
        </nav>

        <div class="p-4 border-t border-slate-200">
            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors text-sm">
                <span class="material-symbols-outlined">open_in_new</span>
                <span>View Site</span>
            </a>
            <div class="mt-3 flex items-center gap-3 px-3 py-2">
                <div class="size-8 rounded-full bg-primary flex items-center justify-center text-white text-xs font-bold shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-xs font-semibold truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 capitalize truncate">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 ml-64 min-h-screen flex flex-col">

        <!-- Header -->
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="w-96">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm">search</span>
                    <input class="w-full pl-10 pr-4 py-2 bg-slate-100 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/20 placeholder:text-slate-500"
                           placeholder="Search orders, books, or customers..." type="text"/>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="h-6 w-px bg-slate-200 mx-2"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined" style="font-size:18px">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <div class="p-8 space-y-6 flex-1">
            @if(session('success'))
                <div class="rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
            @endif

            <div>
                <h2 class="text-2xl font-black tracking-tight">@yield('title')</h2>
                @yield('subtitle')
            </div>

            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
