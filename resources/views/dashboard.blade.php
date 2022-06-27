<x-app-layout>

    <div class="w-3/4">
        <div class="h-20 mx-auto bg-blue-300 mt-10 rounded-xl p-5 w-4/5">
            <h1 class="uppercase inline-block font-black text-5xl">Welcome To {{ Auth::user()->role->name }} page</h1>
        </div>

        <div class="h-15 bg-blue-300 mt-20 rounded p-2 w-2/5 inline-block ml-20">
            <h1 class="uppercase inline-block font-black text-3xl">{{ $users }}- USERS</h1>
        </div>

        <div class="h-15 bg-blue-300 mt-20 rounded p-2 w-2/5 inline-block ml-20">
            <h1 class="uppercase inline-block font-black text-3xl">{{ $categories }}- CATEGORIES </h1>
        </div>
    </div>
    @can('trainer')
    @endcan
</x-app-layout>