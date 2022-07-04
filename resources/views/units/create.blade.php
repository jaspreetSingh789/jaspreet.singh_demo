<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.index',) }}">Courses</a><strong class="px-2 font-bold text-xl ">></strong><a href="{{ route('courses.show',$course) }}" class="font-bold text-xl">{{ $course->title }}</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Create Unit</span>
        </div>

        <!-- form to create users -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('units.store',$course) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="title">Name of the Unit<font class="text-red-500 pl-2">*</font></label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="title" value="{{ old('title')}}" placeholder="title">
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="description">Add description to the unit<font class="text-red-500 pl-2">*</font></label>
                    <textarea name="description" id="" cols="55" rows="5" placeholder="description"></textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-6">
                    <button name="action" value="create" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        Add Unit
                    </button>
                    <a class=" bg-blue-100 rounded ml-5 px-4 py-2 hover:bg-blue-300 hover:text-white border-blue-300 " href="{{ route('courses.show',$course) }}">Cancel</a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>