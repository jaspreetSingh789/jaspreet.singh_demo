<x-app-layout>
    <div class="flex">
        @include('layouts.sidebar')
        <section class="px-6 py-8 flex-auto">
            <main class="main w-3/5 mx-auto mt-10 border border-gray-200 p-6 bg-gray-200 rounded-xl">
                <h1 class="font-bold text-xl text-center">Register</h1>
                <form method="post" action="{{ route('users.store') }}" class="mt-10">
                    @csrf
                    <div class="inputs-container mb-6">

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="first_name">First Name</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="text" name="first_name" value="{{ old('first_name')}}" id="first_name">
                        @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="last_name">Last Name</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="text" name="last_name" value="{{ old('last_name')}}" id="last_name">
                        @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="email">Email</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="email" name="email" value="{{ old('email')}}" id="email">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="role_id">Role</label>
                        <select class="border border-grey-400 p-2 w-full mb-2" name="role_id" id="lang">
                            @foreach($roles as $role)
                            @if(auth()->user()->role_id < $role->id)
                                <option value="{{ $role->id}}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                        </select>

                    </div>
                    <div class="mb-6">
                        <button type="submit" class=" bg-blue-400 text-white rounded px-4 py-2 hover:bg-blue-500 ">
                            Submit
                        </button>
                        <a class=" bg-blue-400 text-white rounded px-4 py-2 hover:bg-blue-500 " href="{{ route('users.index') }}">Cancel</a>

                    </div>
                </form>
            </main>
        </section>
    </div>
</x-app-layout>