<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('layouts.sidebar')
    <div class="ml-80">
        <a class="create-button" href="/users/create">Create New User</a>
    </div>
    <?php $number = 1 ?>

    <div class="m-auto table-container">

        <table class="uppercase table mt-40">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>city</th>
                    <th colspan="2">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $number++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_no}}</td>
                    <td>{{ $user->city }}</td>
                    <td><a href="{{ route('users.delete',$user) }}">Delete</a></td>
                    <td><a href="{{ route('users.edit',$user) }}">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</x-app-layout>