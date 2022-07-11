<x-app-layout>
    <section class="flex-auto h-screen m-5">

        <!-- links -->
        <div class="">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('categories.index') }}">Categories</a><strong class="px-2 font-bold text-xl">></strong><span class="font-bold text-xl">{{ $category->name }}</span><strong class="px-2 font-bold text-xl">></strong><span class="font-bold text-xl">Update Category</span>
        </div>

        <!-- form to create category -->
        <main class="mt-10 border border-gray-200 p-6 bg-gray-50 rounded-xl">
            <form method="post" action="{{ route('categories.update',$category) }}" class="mt-10">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="name">Name</label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2" type="text" name="name" value="{{ $category->name }}" id="name">
                    <x-error field='name' />

                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        Update Category
                    </button>
                    <a class=" bg-slate-400 text-white rounded px-4 py-2 hover:bg-slate-300 " href="{{ route('categories.index') }}">Cancel</a>

                </div>
            </form>
        </main>
    </section>
</x-app-layout>