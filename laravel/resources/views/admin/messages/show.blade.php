@extends('admin.layout')
@section('title', 'Read Message')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        Back to Inbox
    </a>
    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-100 transition-colors">
            <span class="material-symbols-outlined text-[18px]">delete</span>
            Delete Message
        </button>
    </form>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <!-- Header -->
    <div class="p-8 border-b border-slate-100 bg-slate-50/50">
        <div class="flex justify-between items-start gap-6">
            <div class="flex items-center gap-4">
                <div class="size-12 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xl shrink-0">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="font-bold text-lg text-slate-900">{{ $message->name }}</h3>
                    <p class="text-sm text-slate-500">{{ $message->email }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-slate-900">{{ $message->created_at->format('M d, Y') }}</p>
                <p class="text-xs text-slate-500">{{ $message->created_at->format('h:i A') }}</p>
            </div>
        </div>
    </div>
    
    <!-- Subject -->
    <div class="px-8 py-5 border-b border-slate-100">
        <h4 class="text-sm font-bold tracking-widest text-slate-400 uppercase mb-1">Subject</h4>
        <p class="text-lg font-semibold text-slate-900">{{ $message->subject }}</p>
    </div>

    <!-- Message Body -->
    <div class="p-8 bg-white min-h-[300px]">
        <div class="prose prose-slate max-w-none text-slate-700 leading-relaxed whitespace-pre-wrap">
            {{ $message->message }}
        </div>
    </div>
    
</div>
@endsection
