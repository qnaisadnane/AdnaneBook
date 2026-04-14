@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Total Orders</p>
        <p class="text-3xl font-black text-slate-900">{{ $totalCommands }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Total Clients</p>
        <p class="text-3xl font-black text-slate-900">{{ $totalClients }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1">Total Revenue</p>
        <p class="text-3xl font-black text-primary">${{ number_format($totalRevenues, 2) }}</p>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400 mb-2">Orders by Status</p>
        @foreach($commandesParStatut as $stat)
        @php $colors=['pending'=>'amber','paid'=>'blue','shipped'=>'purple','delivered'=>'green']; $c=$colors[$stat->status]??'slate'; @endphp
        <div class="flex items-center justify-between text-sm">
            <span class="capitalize text-slate-600">{{ $stat->status }}</span>
            <span class="font-bold px-2 py-0.5 rounded-full bg-{{ $c }}-100 text-{{ $c }}-700 text-xs">{{ $stat->total }}</span>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100">
        <h2 class="font-bold text-base">Top 5 Best Selling Books</h2>
    </div>
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Book</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Category</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Units Sold</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($meilleursLivres as $item)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-medium">{{ $item->book?->title ?? '—' }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $item->book?->category?->name ?? '—' }}</td>
                <td class="px-6 py-4 font-bold text-primary">{{ $item->total_vendu }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="px-6 py-8 text-center text-slate-400">No sales data yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
