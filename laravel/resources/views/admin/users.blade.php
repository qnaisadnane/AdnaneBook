@extends('admin.layout')
@section('title', 'Users')
@section('content')
<div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Name</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Role</th>
                <th class="px-6 py-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Joined</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($users as $user)
            <tr class="hover:bg-slate-50">
                <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                <td class="px-6 py-4">
                    @php $rc=['admin'=>'red','manager'=>'orange','agent'=>'yellow','client'=>'green']; $rc2=$rc[$user->role]??'slate'; @endphp
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-{{ $rc2 }}-100 text-{{ $rc2 }}-700 capitalize">{{ $user->role }}</span>
                </td>
                <td class="px-6 py-4 text-sm text-slate-500">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-right">
                    @if($user->id !== Auth::id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Delete this user?')">
                        @csrf @method('DELETE')
                        <button class="p-1.5 rounded-lg text-slate-400 hover:text-red-500 hover:bg-red-50 transition-colors" title="Delete">
                            <span class="material-symbols-outlined" style="font-size:18px">delete</span>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $users->links() }}</div>
@endsection
