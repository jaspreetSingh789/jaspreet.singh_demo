<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex items-stretch h-screen">
        @include('layouts.sidebar')
        <div class="w-3/4">
            <div class="h-20 mx-auto bg-blue-300 mt-10 rounded-xl p-5 w-4/5">
                <h1 class="uppercase inline-block font-black text-5xl">Welcome To {{ Auth::user()->role->name }} page</h1>
            </div>

            <div class="h-15 bg-blue-300 mt-20 rounded p-2 w-2/5 inline-block ml-20">
                <h1 class="uppercase inline-block font-black text-3xl">{{ $users }}- USERS</h1>
            </div>

            <div class="h-15 bg-blue-300 mt-20 rounded p-2 w-2/5 inline-block ml-20">
                <h1 class="uppercase inline-block font-black text-3xl">{{ $categories }}- CATEGORIES </h1>
            </div>
        </div>
    </div>
    @can('trainer')
    @endcan
</x-app-layout>