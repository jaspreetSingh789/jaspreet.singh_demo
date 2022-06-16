<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex">

        @include('layouts.sidebar')
        <div class="w-3/4">
            <div class="flex justify-between p-5">
                <span class="text-blue-800 uppercase text-3xl font-black">Users</span>
                <a class="px-3 py-3 bg-blue-500 rounded-xl text-white shadow-md" href="{{ route('users.create')}}">Create New User</a>
            </div>
            <table class="mt-5 text-center uppercase ml-20 w-full shadow-md">
                <thead>
                    <tr class="bg-blue-300 p-10">
                        <?php $number = 1 ?>
                        <th class="p-5">S.no</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Email Status</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Created By</th>
                        <th colspan="2">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-blue-50 border border-b-1 border-black-700">
                        <td class="p-5">{{ $number++ }}</td>
                        <td>{{ $user->first_name ." ". $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_status}}</td>
                        <td>{{ $user->status }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->created_by }}</td>
                        <td><a class="bg-green-400" href=" {{ route('users.delete', $user) }}">Delete</a></td>
                        <td><a class="bg-red-400" href="{{ route('users.edit', $user) }}">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    @if(session()->has('sucess'))
    <p class="fixed bg-blue-500 text-white py-2 px-4  rounded-xl bottom-3 right-3 text-sm">
        {{ session('success') }}
    </p>
    @endif
</x-app-layout>