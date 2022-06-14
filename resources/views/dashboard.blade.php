<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('layouts.sidebar')

    @if (Auth::user()->role = 'admin')
    <h1 class="ml-500">Welcome To admin page</h1>
    @endif

    @if (Auth::user()->role == 'subadmin')
    <h1 class="ml-500">Welcome to subadmin page</h1>
    @endif

    @if (Auth::user()->role == 'trainer')
    <h1 class="ml-500">Welcome to trainer page</h1>
    @endif

    @if (Auth::user()->role == 'user')
    <h1 class="ml-500">Welcome to user page</h1>
    @endif

</x-app-layout>