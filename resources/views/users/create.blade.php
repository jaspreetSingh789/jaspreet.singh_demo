<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="">
            <a class="text-blue-800 font-bold text-xl" href="{{ route('users.index') }}">{{ __('Users') }}</a><strong class="px-2 font-bold text-xl">></strong><span class="font-bold text-xl">{{ __('Create User') }}</span>
        </div>

        <!-- form to create users -->
        <main class="main w-3/5 mt-5 border border-gray-200 p-6 bg-gray-50 rounded-xl">
            <form method="post" action="{{ route('users.store') }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="first_name">First Name</label>
                    <input class="border border-grey-400 p-2 w-3/4 mb-5 rounded-md" type="text" name="first_name" value="{{ old('first_name')}}" placeholder="Enter First Name">
                    <x-error field='first_name' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="last_name">Last Name</label>
                    <input class="border border-grey-400 p-2 w-3/4 mb-5 rounded-md" type="text" name="last_name" value="{{ old('last_name')}}" placeholder="Enter Last Name">
                    <x-error field='last_name' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="email">Email</label>
                    <input class="border border-grey-400 p-2 w-3/4 mb-5 rounded-md" type="email" name="email" value="{{ old('email')}}" placeholder="Enter Email Address">
                    <x-error field='email' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="role_id">Role</label>
                    <select class="border border-grey-400 p-2 w-3/4 mb-2 rounded-md" name="role_id" id="lang">
                        @foreach($roles as $role)
                        @if(auth()->user()->role_id < $role->id)
                            <option value="{{ $role->id}}">{{ $role->name }}</option>
                            @endif
                            @endforeach
                    </select>
                    <x-error field='role_id' />
                </div>
                <div class="mb-6">
                    <button name="action" value="save" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        {{ __('Invite User') }}
                    </button>
                    <button type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">{{ __('Invite User & Invite Another') }}</button>
                    <a class=" bg-blue-300 rounded px-4 py-2 text-white hover:bg-blue-200 hover:text-white border-blue-300 " href="{{ route('users.index') }}">{{ __('Cancel') }}</a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>