<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @include('layouts.sidebar')

    @if (Auth::user()->role_id === 1)
    <h1 class="">Welcome To admin page --------------------------------- hello Admin</h1>
    @endif

    <!-- @can('admin') -->

    <!-- @endcan -->

    @if (Auth::user()->role_id === 2)
    <h1>Welcome To admin page --------------------------------- hello subAdmin</h1>
    @endif

    @if (Auth::user()->role_id === 3)
    <h1>Welcome To admin page --------------------------------- hello Trainer</h1>
    @endif

    @if (Auth::user()->role_id === 4)
    <h1>Welcome To admin page --------------------------------- hello user</h1>
    @endif

</x-app-layout>