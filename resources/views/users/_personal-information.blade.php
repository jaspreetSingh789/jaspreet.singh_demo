<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="mt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index') }}">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $user->first_name}}</span><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Update</span>
        </div>

        <!-- tab -->
        <x-tabs :trainer=$user />

        <!-- form create user-->
        <main class="border border-gray-200 p-6 bg-gray-50">
            <form method="post" action="{{ route('users.update', $user) }}" class="mt-10">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="first_name">First Name</label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="first_name" value="{{ $user->first_name }}" id="first_name">
                    <x-error field='first_name' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="last_name">Last Name</label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2  rounded-md" type="text" name="last_name" value="{{ $user->last_name }}" id="last_name">
                    <x-error field='last_name' />

                    <div class="py-5">Email: {{ $user->email }}</div>

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="role_id">User Type</label>
                    <select class="border border-grey-400 p-2 w-1/2 mb-2  rounded-md" name="role_id" id="">
                        @foreach($roles as $role)
                        @if(auth()->user()->role_id < $role->id)
                            <option value="{{ $role->id}}">{{ $role->name }}</option>
                            @endif
                            @endforeach
                    </select>
                    <x-error field='role_id' />

                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400">
                        Update Profile
                    </button>
                    <a class="bg-blue-300 rounded px-4 py-2 text-white hover:bg-blue-200" href="{{ route('users.index') }}">Cancel</a>
                </div>
            </form>
        </main>

    </section>
</x-app-layout>