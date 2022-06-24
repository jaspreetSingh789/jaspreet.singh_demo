<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="flex h-screen">

        @include('layouts.sidebar')
        <div class="w-3/4">
            <div class="flex justify-between p-5 ml-16">
                <span class="text-blue-800 uppercase text-3xl font-black">{{__('Users')}}</span>
                <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('users.create')}}">{{__('Create User')}}</a>
            </div>
            <table class="text-center ml-20 w-full shadow-md">
                <thead class="uppercase">
                    <tr class="bg-blue-100 p-10">
                        <?php $number = 1 ?>
                        <th class="py-5">{{__('S.no')}}</th>
                        <th>{{__('User Name')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('Email Status')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Role')}}</th>
                        <th>{{__('action')}}</th>
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
                        <td>
                            <div x-data="{ show:false}" @click.away="show = false">
                                <button @click="show = !show">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                        <path d="M144,192a16,16,0,1,1-16-16A16,16,0,0,1,144,192ZM128,80a16,16,0,1,0-16-16A16,16,0,0,0,128,80Zm0,32a16,16,0,1,0,16,16A16,16,0,0,0,128,112Z"></path>
                                    </svg></button>
                                <div x-show="show" class="absolute border-2 border-black-600 w-50">
                                    <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href=" {{ route('users.delete', $user) }}">{{ __('Delete') }}</a>
                                    <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('users.edit', $user) }}">{{__('Edit')}}</a>
                                    <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href=" {{ route('users.status.update', $user) }}">{{ $user->status == 1 ? 'Inactive' : 'Active'}}</a>
                                    <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('users.resetpassword', $user) }}">{{__('Reset Password')}}</a>
                                </div>
                            </div>
                    </tr>
                    </td>
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