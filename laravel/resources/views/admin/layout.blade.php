<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>@yield('title', 'Admin') — ADNANE BOOKS</title>
<script src="https://cdn.tailwindcss.com?plugins=forms"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script>
tailwind.config = {
    theme: { extend: { colors: { primary: "#2463eb" }, fontFamily: { display: ["Inter"] } } }
}
</script>
<style>
body { font-family: 'Inter', sans-serif; }
.material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
</style>
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 shrink-0 bg-slate-900 text-white flex flex-col">
        <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-700">
            <span class="material-symbols-outlined text-primary">menu_book</span>
            <span class="font-extrabold tracking-tight">ADNANE BOOKS</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1">
            @php $role = Auth::user()->role; @endphp

            @if($role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-lg">dashboard</span> Dashboard
            </a>
            @endif

            @if(in_array($role, ['admin','manager']))
            <a href="{{ route('books.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('books.*') ? 'bg-primary text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-lg">menu_book</span> Books
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('categories.*') ? 'bg-primary text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-lg">category</span> Categories
            </a>
            <a href="{{ route('authors.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('authors.*') ? 'bg-primary text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-lg">person</span> Authors
            </a>
            @endif

            @if(in_array($role, ['admin','agent']))
            <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('orders.*') ? 'bg-primary text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-lg">receipt_long</span> Orders
            </a>
            @endif

            @if($role === 'admin')
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('admin.users') ? 'bg-primary text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                <span class="material-symbols-outlined text-lg">group</span> Users
            </a>
            @endif
        </nav>
        <div class="px-4 py-4 border-t border-slate-700">
            <div class="flex items-center gap-3 mb-3 px-3">
                <div class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-xs font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="text-xs">
                    <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                    <p class="text-slate-400 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-slate-300 hover:bg-slate-800">
                    <span class="material-symbols-outlined text-lg">logout</span> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
            <h1 class="text-xl font-bold">@yield('title')</h1>
            <a href="{{ route('home') }}" class="text-sm text-primary hover:underline flex items-center gap-1">
                <span class="material-symbols-outlined text-base">open_in_new</span> View Site
            </a>
        </header>
        <main class="flex-1 px-8 py-6">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
