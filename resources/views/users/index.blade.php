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
                <span class="text-blue-800 uppercase text-3xl font-black">Users</span>
                <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('users.create')}}">Create User</a>
            </div>
            <table class="text-center ml-20 w-full shadow-md">
                <thead class="uppercase">
                    <tr class="bg-blue-100 p-10">
                        <?php $number = 1 ?>
                        <th class="p-5">S.no</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Email Status</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th colspan="4">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $number++ }}</td>
                        <td>{{ $user->first_name ." ". $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email_status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $user->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $user->role->name }}</td>
                        <td><a class="bg-red-700 p-1 rounded-xl" href=" {{ route('users.delete', $user) }}">Delete</a></td>
                        <td><a class="bg-green-600 p-1 rounded-xl" href=" {{ route('users.status.update', $user) }}">{{ $user->status == 1 ? 'Inactive' : 'Active'}}</a></td>
                        <td><a class="bg-blue-700 p-1 rounded-xl" href="{{ route('users.edit', $user) }}">Edit</a></td>
                        <td><a class="bg-yellow-400 p-1 rounded-xl" href="{{ route('users.resetpassword', $user) }}">Reset Password</a></td>
                    </tr>
                    @endforeach
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