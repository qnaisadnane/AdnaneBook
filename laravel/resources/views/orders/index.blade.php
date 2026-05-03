@extends('admin.layout')
@section('title', 'Orders')
@section('content')
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">#</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Client</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Total</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($orders as $order)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-mono text-sm">#{{ $order->id }}</td>
                <td class="px-6 py-4">
                    <p class="font-medium">{{ $order->user?->name ?? 'Deleted user' }}</p>
                    <p class="text-xs text-slate-400">{{ $order->user?->email ?? '—' }}</p>
                </td>
                <td class="px-6 py-4 font-bold">${{ number_format($order->total_price, 2) }}</td>
                <td class="px-6 py-4">
                    @php
                        $colors = ['pending'=>'amber','paid'=>'blue'];
                        $c = $colors[$order->status] ?? 'slate';
                    @endphp
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold bg-{{ $c }}-100 text-{{ $c }}-700 capitalize">
                        {{ $order->status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $order->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-right">
                    <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                        @csrf @method('PATCH')
                        <select name="status" onchange="this.form.submit()"
                            class="text-xs rounded-lg border-slate-200 focus:ring-primary focus:border-primary">
                            @foreach(['pending','paid'] as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-12 text-center text-slate-400">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $orders->links() }}</div>
@endsection
