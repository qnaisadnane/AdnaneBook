@extends('admin.layout')
@section('title', 'Add Category')
@section('content')
<div class="max-w-lg">
    <form method="POST" action="{{ route('categories.store') }}" class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary"/>
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Color</label>
            <div class="flex items-center gap-3">
                <input type="color" name="color" value="{{ old('color', '#2463eb') }}"
                    class="h-10 w-16 rounded-lg border-slate-200 cursor-pointer"/>
                <input type="text" id="colorText" value="{{ old('color', '#2463eb') }}"
                    class="flex-1 rounded-lg border-slate-200 text-sm focus:ring-primary focus:border-primary" readonly/>
            </div>
            @error('color')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-primary/90">Save</button>
            <a href="{{ route('categories.index') }}" class="px-6 py-2 rounded-lg text-sm font-bold border border-slate-200 hover:bg-slate-50">Cancel</a>
        </div>
    </form>
</div>
<script>
    document.querySelector('input[type=color]').addEventListener('input', function() {
        document.getElementById('colorText').value = this.value;
    });
</script>
@endsection
