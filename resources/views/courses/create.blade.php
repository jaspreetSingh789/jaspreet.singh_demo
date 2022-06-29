<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index') }}">Courses</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Create Course</span>
        </div>

        <!-- form to create users -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.store') }}" enctype="multipart/form-data" class="mt-5">
                @csrf
                <div class="inputs-container mb-6">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="title">What Will Be The Course Name?<font class="text-red-500 pl-2">*</font></label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="title" value="{{ old('title')}}" placeholder="title">
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="description">Provide A Brief Description For What The Coursse Is About.<font class="text-red-500 pl-2">*</font></label>
                    <textarea name="description" id="" cols="55" rows="5" placeholder="description"></textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="category_id">What Category Should The Course Be In?<font class="text-red-500 pl-2">*</font></label>
                    <select class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" name="category_id" id="lang">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="level_id">What Is The Level Of The Course?
                        <font class="text-red-500 pl-2">*</font>
                    </label>
                    <select class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md block" name="level_id" id="lang">
                        @foreach($levels as $level)
                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                    @error('level')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <input type="checkbox" name="certificate" id="" value="1">
                    <label class="mb-2 text-xs uppercase font-bold text-gray-700" for="certificate">Certificate
                        <font class="text-red-500 pl-2">*</font>
                    </label>
                    @error('certificate')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="mb-2 text-xs uppercase font-bold text-gray-700 absolute right-2 top-1/2" for="image">Upload course cover Image
                        <font class="text-red-500 pl-2">*</font>
                    </label>
                    <input class="absolute right-2 top-1/2" type="file" name="image">
                    @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>
                <div class="mb-6">
                    <button name="action" value="create" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        Create Course
                    </button>
                    <a class=" bg-blue-100 rounded ml-5 px-4 py-2 hover:bg-blue-300 hover:text-white border-blue-300 " href="{{ route('courses.index') }}">Cancel</a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>