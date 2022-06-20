<x-app-layout>
    <div class="flex">
        @include('layouts.sidebar')
        <section class="px-6 py-8 flex-auto h-screen">
            <main class="main w-3/5 mx-auto mt-10 border border-gray-200 p-6 bg-gray-200 rounded-xl">
                <h1 class="font-bold text-xl text-center">Reset Password</h1>
                <form method="post" action="{{ route('users.saveresetpassword',$user) }}" class="mt-10">
                    @csrf
                    <div class="inputs-container mb-6">

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="password">Password</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="password" name="password" id="password" value="">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="confirm_password">Confirm Password</label>
                        <input class="border border-grey-400 p-2 w-full mb-2" type="password" name="confirm_password" id="confirm_password">
                        @error('confirm_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>
                    <div class="mb-6">
                        <button type="submit" class=" bg-blue-400 text-white rounded px-4 py-2 hover:bg-blue-500 ">
                            Submit
                        </button>
                        <a class=" bg-blue-400 text-white rounded px-4 py-2 hover:bg-blue-500 " href="{{ route('dashboard') }}">Cancel</a>

                    </div>
                </form>
            </main>
        </section>
    </div>
</x-app-layout>