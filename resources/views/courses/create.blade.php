<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.index') }}">{{ __('Courses') }}</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ __('Create Course') }}</span>
        </div>

        @php
        $categories = App\Models\Category::get();
        $levels = App\Models\Level::get();
        @endphp

        <!-- form to create users -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data" class="mt-5">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="title">What Will Be The Course Name?</label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="title" value="{{ old('title')}}" placeholder="title">
                    <x-error field='title' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="description">Provide A Brief Description For What The Coursse Is About.</label>
                    <textarea name="description" id="" cols="55" rows="5" placeholder="description">{{ old('description') }}</textarea>
                    <x-error field='description' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="category_id">What Category Should The Course Be In?</label>
                    <select class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" name="category_id" id="lang">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-error field='category_id' />

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="level_id">What Is The Level Of The Course?
                    </label>
                    <select class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md block" name="level_id" id="lang">
                        @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                    <x-error field='level_id' />

                    <input type="checkbox" name="certificate" id="" value="1">
                    <label class="mb-2 text-xs uppercase font-bold text-gray-700 required" for="certificate">Certificate
                    </label>
                    <x-error field='certificate' />

                    <label class="mb-2 text-xs uppercase font-bold text-gray-700 absolute right-2 top-1/2 required" for="image">{{ __('Upload course cover Image') }}
                    </label>
                    <input class="absolute right-2 top-1/2" type="file" name="image">
                    <x-error field='image' />

                </div>
                <div class="mb-6">
                    <button name="action" value="save" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        {{ __('Create Course') }}
                    </button>
                    <button type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">{{ __('Create Course & Create Another') }}</button>
                    <a class=" bg-blue-300 rounded ml-5 px-4 py-2 hover:bg-blue-200 text-white hover:text-white border-blue-300 " href="{{ route('courses.index') }}">{{ __('Cancel') }}</a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>