<x-app-layout>
    <div class="flex">
        @include('layouts.sidebar')
        <section class="flex-auto">
            <main class="max-w-lg mx-auto mt-10 border border-gray-200 p-6 bg-gray-100 rounded-xl">
                <h1 class="font-bold text-xl text-center">Update</h1>
                <form method="post" action="{{ route('users.update', $user) }}" class="mt-10">
                    @csrf
                    <div class="inputs-container mb-6">

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="name">Name</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="text" name="name" value="{{ $user->name }}" id="name" required>
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="email">Email</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="email" name="email" value="{{ $user->email }}" id="email" required>
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="password">Password</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="password" name="password" id="password" value="" required>

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="role_id">Role</label>
                        <select name="role_id" id="">
                            @foreach($roles as $role)
                            @if(auth()->user()->role_id < $role->id)
                                <option value="{{ $role->id}}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="bg-blue-400 text-white rounded px-4 py-2 hover:bg-blue-500">
                            Submit
                        </button>
                    </div>
                </form>
                @foreach($errors->all() as $error)
                <li class="text-red-500 text-xs mt-1"> {{ $error }}</li>
                @endforeach
            </main>
        </section>
    </div>
</x-app-layout>