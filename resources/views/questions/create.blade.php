<x-app-layout>
    <section class="flex-auto m-5">
        <!-- Breadcrumbs -->

        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.show', $course) }}">
                {{ __('Courses') }}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <a href="{{ route('courses.tests.edit', [$course, $unit, $test]) }}" class="font-bold text-xl">
                {{ $test->name }}
            </a>
            <strong class="px-2 font-bold text-xl ">></strong>
            <span class="font-bold text-xl">
                {{ __('Add Question') }}
            </span>
        </div>

        <!-- form to create questions -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.tests.questions.store', [$course, $test]) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6 relative">

                    <!-- Question -->
                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="name">
                        {{ __('Type Your Question') }}
                    </label>
                    <textarea class="border border-grey-400 p-2 w-full mb-2 rounded-md" type="text" name="name" value="{{ old('name')}}" placeholder="Enter Your Question"></textarea>
                    <x-error field='name' />

                    <!-- Attachment -->
                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="attachment">
                        {{ __('Attachment') }}
                    </label>
                    <input class="border border-grey-400 p-2 w-full mb-2 rounded-md" type="file" name="attachment" value="{{ old('attachment')}}" placeholder="attachment">
                    <x-error field='attachment' />

                    <!-- Answer -->
                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="title">
                        {{ __('Answer') }}
                    </label>
                    <div class="flex">
                        <div>
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                <path d="M104,60A12,12,0,1,1,92,48,12,12,0,0,1,104,60Zm60,12a12,12,0,1,0-12-12A12,12,0,0,0,164,72ZM92,116a12,12,0,1,0,12,12A12,12,0,0,0,92,116Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,116ZM92,184a12,12,0,1,0,12,12A12,12,0,0,0,92,184Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,184Z"></path>
                            </svg>
                        </div>
                        <textarea class="border border-grey-400 p-2 w-11/12 mb-2 rounded-md" type="text" name="answer[]" value="{{ old('answer')}}" placeholder="Enter Answer Here"></textarea>
                        <input type="radio" name="is_answer" value="answer1" id="">
                    </div>

                    <div class="flex">
                        <div>
                            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                <path d="M104,60A12,12,0,1,1,92,48,12,12,0,0,1,104,60Zm60,12a12,12,0,1,0-12-12A12,12,0,0,0,164,72ZM92,116a12,12,0,1,0,12,12A12,12,0,0,0,92,116Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,116ZM92,184a12,12,0,1,0,12,12A12,12,0,0,0,92,184Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,184Z"></path>
                            </svg>
                        </div>
                        <textarea class="border border-grey-400 p-2 w-11/12 mb-2 rounded-md" type="text" name="answer[]" value="{{ old('answer')}}" placeholder="Enter Answer Here"></textarea>
                        <input type="radio" name="is_answer" value="answer2" id="">
                    </div>
                    <x-error field='answer' />

                </div>
                <div class="mb-6">
                    <button name="action" value="save" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400">
                        {{ __('Save') }}
                    </button>
                    <button name="action" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        {{ __('Save & Add Another') }}
                    </button>
                    <a class="bg-blue-300 text-white rounded ml-5 px-4 py-2 hover:bg-blue-200 hover:text-white border-blue-300 " href="{{ route('courses.tests.edit', [$course, $unit, $test]) }}">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>