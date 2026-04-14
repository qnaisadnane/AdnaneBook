@extends('admin.layout')
@section('title', 'Add Author')
@section('content')
<div class="max-w-lg">
    <form method="POST" action="{{ route('authors.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Nationality <span class="text-slate-400 font-normal">(optional)</span></label>
            <input type="text" name="nationality" value="{{ old('nationality') }}"
                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-primary/90">Save</button>
            <a href="{{ route('authors.index') }}" class="px-6 py-2 rounded-lg text-sm font-bold border border-slate-200 hover:bg-slate-50">Cancel</a>
        </div>
    </form>
</div>
@endsection
