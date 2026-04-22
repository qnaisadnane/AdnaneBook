@extends('layouts.customer')

@section('title', 'Profile — ADNANE BOOKS')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-2xl font-black mb-6 px-4 sm:px-0">Profile Settings</h1>

        <div class="p-4 sm:p-8 bg-white dark:bg-slate-900/50 shadow sm:rounded-lg border border-slate-200 dark:border-slate-800">
            <div class="max-w-xl text-slate-900 dark:text-slate-100">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-slate-900/50 shadow sm:rounded-lg border border-slate-200 dark:border-slate-800">
            <div class="max-w-xl text-slate-900 dark:text-slate-100">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-slate-900/50 shadow sm:rounded-lg border border-slate-200 dark:border-slate-800">
            <div class="max-w-xl text-slate-900 dark:text-slate-100">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection

