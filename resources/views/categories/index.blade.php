<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex h-screen">

        @include('layouts.sidebar')
        <div class="w-3/4">
            <div class="flex justify-between p-5">
                <span class="text-blue-800 uppercase text-3xl font-black">Categories</span>
                <a class="px-3 py-3 bg-blue-500 rounded-xl text-white shadow-md" href="{{ route('categories.create') }}">Create New Category</a>
            </div>
            <table class="mt-5 text-center uppercase ml-20 w-full shadow-md">
                <thead>
                    <tr class="bg-blue-300 p-10">
                        <?php $number = 1 ?>
                        <th class="p-5">S.no</th>
                        <th>NAME</th>
                        <th>CREATED BY</th>
                        <th>COURSES</th>
                        <th>CREATED DATE</th>
                        <th>STATUS</th>
                        <th colspan="3">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-blue-50 border border-b-1 border-black-700">
                        <td class="p-5">{{ $number++ }}</td>
                        <td>name </td>
                        <td> admin</td>
                        <td> 0 </td>
                        <td> 20-06-2022 </td>
                        <td> Active </td>
                        <td><a class="bg-red-700 p-1 rounded-xl" href="">Delete</a></td>
                        <td><a class="bg-green-600 p-1 rounded-xl" href="">active</a></td>
                        <td><a class="bg-blue-700 p-1 rounded-xl" href="">Edit</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    @if(session()->has('success'))
    <div x-data="{ show:true }" x-init="setTimeout(()=>show = false,4000)" x-show="show" class="fixed bg-blue-500 text-white py-2 px-4  rounded-xl bottom-3 right-3 text-sm">
        <p>
            {{ session('success') }}
        </p>
    </div>
    @endif
</x-app-layout>