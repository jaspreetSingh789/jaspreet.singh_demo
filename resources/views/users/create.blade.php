<x-app-layout>
    <div class="flex">
        @include('layouts.sidebar')
        <section class="flex-auto">
            <div class="pt-10 pl-10 ml-16">
                <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index') }}">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Create User</span>
            </div>

            <main class="main w-3/5 ml-20 mt-10 border border-gray-200 p-6 bg-gray-50 rounded-xl">
                <form method="post" action="{{ route('users.store') }}" class="mt-5">
                    @csrf
                    <div class="inputs-container mb-6">

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="first_name">First Name<font class="text-red-500 pl-2">*</font></label>
                        <input class="border border-grey-400 p-2 w-3/4 mb-2 rounded-md" type="text" name="first_name" value="{{ old('first_name')}}" placeholder="first name">
                        @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="last_name">Last Name<font class="text-red-500 pl-2">*</font></label>
                        <input class="border border-grey-400 p-2 w-3/4 mb-2 rounded-md" type="text" name="last_name" value="{{ old('last_name')}}" placeholder="last name">
                        @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="email">Email<font class="text-red-500 pl-2">*</font></label>
                        <input class="border border-grey-400 p-2 w-3/4 mb-2 rounded-md" type="email" name="email" value="{{ old('email')}}" placeholder="email">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="role_id">Role<font class="text-red-500 pl-2">*</font></label>
                        <select class="border border-grey-400 p-2 w-3/4 mb-2 rounded-md" name="role_id" id="lang">
                            @foreach($roles as $role)
                            @if(auth()->user()->role_id < $role->id)
                                <option value="{{ $role->id}}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <button name="action" value="create" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                            Invite User
                        </button>
                        <button name="action" value="create_another" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">Invite User & Invite Another</button>
                        <a class=" bg-blue-100 rounded px-4 py-2 hover:bg-blue-300 hover:text-white border-blue-300 " href="{{ route('users.index') }}">Cancel</a>
                    </div>
                </form>
            </main>
        </section>
    </div>
</x-app-layout>