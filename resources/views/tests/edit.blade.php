<x-app-layout>
    <section class="flex-auto m-5">

        <!-- Breadcrumbs -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.index') }}">
                {{ __('Courses') }}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <a href="{{ route('courses.units.edit', [$course, $lesson->unit]) }}" class="font-bold text-xl">
                {{ $lesson->unit->title }}
            </a>
            </a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">
                {{ __('Edit Test') }}
            </span>
        </div>

        <!-- form to edit test -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.tests.update', [$course, $test]) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6 relative">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="name">
                        {{ __('Test Name') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="name" value="{{ $test->name }}" placeholder="name">
                    <x-error field='name' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="pass_percentage">
                        {{ __('Pass Score') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="number" name="pass_percentage" value="{{ $test->pass_percentage }}" placeholder="pass_percentage">
                    <x-error field='pass_percentage' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="title">
                        {{ __('Duration') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="number" name="duration" value="{{ $test->duration }}" placeholder="duration">
                    <x-error field='duration' />

                    <!-- add questions -->
                    <div class="absolute right-20 top-10 w-52">
                        <span>
                            {{ __('Add Questions Type') }}
                        </span>
                        <span class="border-2 inline-block rounded-xl w-40 h-28 p-3 m-3 text-center">
                            <a href="{{ route('courses.tests.questions.create',[$course, $test]) }}">
                                <svg class="w-16 h-16 ml-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                                    <path d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"></path>
                                    <path d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"></path>
                                </svg>{{ __('+ Add Questions') }}</a>
                        </span>
                    </div>

                </div>
                <div class="mb-6">
                    <button type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400">
                        {{ __('Update') }}
                    </button>
                    <a class="bg-blue-300 text-white rounded ml-5 px-4 py-2 hover:bg-blue-200 hover:text-white border-blue-300" href="{{ route('courses.units.edit', [$course, $lesson->unit]) }}">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </main>

        <span>{{ __('Questions') }}</span>
        <div class="w-full h-16 bg-white relative">
            @foreach($questions as $question)
            {{ $question->name }}
            <div class="absolute top-0 right-0">
                <a href="{{ route('courses.tests.questions.edit', [$course, $test, $question]) }}">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('courses.tests.questions.destroy', [$course, $test, $question]) }}">
                    {{ __('Delete') }}
                </a>
            </div>
            @endforeach
        </div>
    </section>
</x-app-layout>