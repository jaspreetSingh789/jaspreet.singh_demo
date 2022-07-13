<x-app-layout>
    <section class="flex-auto m-5">

        <!-- Breadcrumbs -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.show', $course) }}">
                {{ __('Courses')}}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <a href="{{ route('courses.units.edit', [$course, $unit]) }}" class="font-bold text-xl">
                {{ $unit->title }}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <span class="font-bold text-xl">
                {{ __('Add Test') }}
            </span>
        </div>

        <!-- Form to create Test -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.units.tests.store', [$course, $unit]) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6 relative">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="name">
                        {{ __('Test Name') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="name" value="{{ old('name')}}" placeholder="name">
                    <x-error field='name' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="pass_percentage">
                        {{ __('Pass Score') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="number" name="pass_percentage" value="{{ old('pass_percentage')}}" placeholder="pass_percentage">
                    <x-error field='pass_percentage' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="title">
                        {{ __('Duration') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="number" name="duration" value="{{ old('duration')}}" placeholder="duration">
                    <x-error field='duration' />

                </div>

                <div class="mb-6">
                    <button name="action" value="save" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400">
                        {{ __('Save') }}
                    </button>
                    <button name="action" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        {{ __('Save & Add Another') }}
                    </button>
                    <a class="bg-blue-300 text-white rounded ml-5 px-4 py-2 hover:bg-blue-200 hover:text-white border-blue-300 " href="{{ route('courses.units.edit', [$course, $unit]) }}">
                        {{ __('Cancel') }}
                    </a>
                </div>

            </form>
        </main>

    </section>
</x-app-layout>