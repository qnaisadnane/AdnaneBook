@extends('admin.layout')
@section('title', 'Dashboard Overview')
@section('subtitle')
<p class="text-slate-500 mt-1">Welcome back, <span class="font-semibold text-slate-700">{{ Auth::user()->name }}</span>!</p>
@endsection

@section('content')

{{-- Metrics --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                <span class="material-symbols-outlined">shopping_basket</span>
            </div>
        </div>
        <p class="text-sm font-medium text-slate-500">Total Orders</p>
        <p class="text-3xl font-bold mt-1">{{ $totalCommands }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                <span class="material-symbols-outlined">payments</span>
            </div>
        </div>
        <p class="text-sm font-medium text-slate-500">Total Revenue</p>
        <p class="text-3xl font-bold mt-1">${{ number_format($totalRevenues, 2) }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-primary/10 rounded-lg text-primary">
                <span class="material-symbols-outlined">person_add</span>
            </div>
        </div>
        <p class="text-sm font-medium text-slate-500">Total Clients</p>
        <p class="text-3xl font-bold mt-1">{{ $totalClients }}</p>
    </div>
</div>

{{-- Recent Orders --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center">
        <h3 class="font-bold text-lg">Recent Orders</h3>
        <a href="{{ route('orders.index') }}" class="text-primary text-sm font-bold hover:underline">View All Orders</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Books</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($recentOrders as $order)
                @php
                    $colors = ['pending'=>'amber','paid'=>'blue'];
                    $c = $colors[$order->status] ?? 'slate';
                @endphp
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-sm font-medium">#ORD-{{ $order->id }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">
                        {{ $order->items->take(1)->map(fn($i) => $i->book?->title ?? 'N/A')->join(', ') }}
                        @if($order->items->count() > 1)
                            <span class="text-slate-400">+{{ $order->items->count() - 1 }} more</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $order->user?->name ?? 'Deleted user' }}</td>
                    <td class="px-6 py-4 text-sm font-semibold">${{ number_format($order->total_price, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-{{ $c }}-100 text-{{ $c }}-700 capitalize">
                            {{ $order->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-400">No orders yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Top 5 Best Selling Books --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-200">
        <h3 class="font-bold text-lg">Top 5 Best Selling Books</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Book</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Units Sold</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($meilleursLivres as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-sm">{{ $item->book?->title ?? '—' }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $item->book?->category?->name ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-primary">{{ $item->total_vendu }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-slate-400">No sales data yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
