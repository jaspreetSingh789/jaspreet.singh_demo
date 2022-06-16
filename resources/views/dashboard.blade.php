<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="" flex>
        <div display="flex">
            @can('trainer')
            @include('layouts.sidebar')
            @endcan
            <div class="w-full h-20 bg-gray-200">
                <h1 class="uppercase inline-block w-200">Welcome To {{ Auth::user()->role->name }} page</h1>
            </div>
        </div>
    </div>
</x-app-layout>