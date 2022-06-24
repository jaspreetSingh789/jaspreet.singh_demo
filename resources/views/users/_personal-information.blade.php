<x-app-layout>
    <div class="flex">
        @include('layouts.sidebar')

        <section class="flex-auto h-screen">
            <div class="mt-20 ml-20">
                <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index') }}">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $user->first_name}}</span>
            </div>

            <div class="w-200 h-10 bg-gray-400">
                <a class="pl-20" href="">Personal information</a>
                @if($user->role_id == 3)
                <a class="pl-20" href="{{ route('teams.users.index',$user) }}">Employees</a>
                @endif

                @if($user->role_id == 4)
                <a class="pl-20" href="{{ route('users.teams.index',$user) }}">Trainers</a>
                @endif
            </div>

            <main class="w-3/5 ml-20 mt-5 border border-gray-200 p-6 bg-gray-50 rounded-xl">
                <form method="post" action="{{ route('users.update', $user) }}" class="mt-10">
                    @csrf
                    <div class="inputs-container mb-6">

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="first_name">First Name<sup class="text-red-500 text-sm">*</sup></label>
                        <input class="border border-grey-400 p-2 w-3/4 mb-2 rounded-md" type="text" name="first_name" value="{{ $user->first_name }}" id="first_name">
                        @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="last_name">Last Name<sup class="text-red-500 text-sm">*</sup></label>
                        <input class="border border-grey-400 p-2 w-3/4 mb-2  rounded-md" type="text" name="last_name" value="{{ $user->last_name }}" id="last_name">
                        @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="py-5">Email: {{ $user->email }}</div>

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="role_id">Role<sup class="text-red-500 text-sm">*</sup></label>
                        <select class="border border-grey-400 p-2 w-3/4 mb-2  rounded-md" name="role_id" id="">
                            @foreach($roles as $role)
                            @if(auth()->user()->role_id < $role->id)
                                <option value="{{ $role->id}}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="bg-gray-400 text-white rounded px-4 py-2 hover:bg-gray-500">
                            Update User
                        </button>
                        <a class=" bg-blue-100 rounded px-4 py-2 hover:bg-blue-300" href="{{ route('users.index') }}">Cancel</a>
                    </div>
                </form>
            </main>
        </section>
    </div>
</x-app-layout>