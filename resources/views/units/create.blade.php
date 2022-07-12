<x-app-layout>
    <!-- unit -->
    <section class="flex-auto m-5">

        <!-- Breadcrumb -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.index',) }}">
                {{ __(' Courses')}}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <a href="{{ route('courses.show',$course) }}" class="font-bold text-xl">
                {{ $course->title }}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <span class="font-bold text-xl">
                {{ __('Add Unit') }}
            </span>
        </div>

        <!-- form to create unit -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.units.store',$course) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="title">
                        {{ __('Name of the Unit')}}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="title" value="{{ old('title')}}" placeholder="title">
                    <x-error field='title' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="description">
                        {{ __('Add description to the unit')}}
                    </label>
                    <textarea name="description" id="" cols="55" rows="5" placeholder="description"></textarea>
                    <x-error field='description' />

                </div>
                <div class="mb-6">
                    <button name="action" value="save" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        {{ __('Save')}}
                    </button>
                    <button name="action" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        {{ __('Save & Add Another')}}
                    </button>
                    <a class="bg-blue-300 text-white rounded ml-5 px-4 py-2 hover:bg-blue-200 hover:text-white border-blue-300 " href="{{ route('courses.show',$course) }}">
                        {{ __('Cancel')}}
                    </a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>