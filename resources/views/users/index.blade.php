<?php

use App\Models\User;

$users1 = User::UsersList()->get(); ?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('layouts.sidebar')
    <div class="ml-80">
        <a class="create-button" href="{{ route('users.create')}}">Create New User</a>
    </div>
    <?php $number = 1 ?>

    <div class="m-auto table-container">

        <table class="mt-10 mx-auto text-center uppercase w- w-4/5">
            <thead>
                <tr class="bg-blue-500 p-10">
                    <th class="pl-5">S.no</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Role</th>
                    <th>Created By</th>
                    <th colspan="2">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users1 as $user)
                <tr class="">
                    <td class="m-10">{{ $number++ }}</td>
                    <td>{{ $user->first_name ." ". $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_no}}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>{{ $user->created_by }}</td>
                    <td><a class="bg-green-400" href=" {{ route('users.delete', $user) }}">Delete</a></td>
                    <td><a class="bg-red-400" href="{{ route('users.edit', $user) }}">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if(session()->has('sucess'))
    <p class="fixed bg-blue-500 text-white py-2 px-4  rounded-xl bottom-3 right-3 text-sm">
        {{ session('success') }}
    </p>
    @endif
</x-app-layout>