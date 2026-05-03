@extends('admin.layout')
@section('title', 'Contact Messages')

@section('content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center">
        <h3 class="font-bold text-lg">Inbox</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Sender</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Subject</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                @forelse($messages as $message)
                <tr class="hover:bg-slate-50 transition-colors {{ !$message->is_read ? 'bg-primary/5' : '' }}">
                    <td class="px-6 py-4">
                        @if(!$message->is_read)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-primary/10 text-primary uppercase">
                                <span class="size-1.5 rounded-full bg-primary"></span>
                                New
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 uppercase">
                                Read
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-semibold text-slate-900">{{ $message->name }}</p>
                        <p class="text-xs text-slate-500">{{ $message->email }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-slate-700 font-medium {{ !$message->is_read ? 'font-bold' : '' }} line-clamp-1">
                            {{ $message->subject }}
                        </p>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-500">
                        {{ $message->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="p-2 text-slate-400 hover:text-primary transition-colors rounded-lg hover:bg-primary/10" title="View Message">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </a>
                            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50" title="Delete Message">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-4xl mb-3">mark_email_read</span>
                            <p class="text-sm font-medium text-slate-500">No messages found.</p>
                            <p class="text-xs">Your inbox is empty.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div class="p-4 border-t border-slate-200">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
