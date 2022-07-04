<x-app-layout>

    <!-- button to create course  -->
    <div class="w-4/5 bg-gray-100 m-5">
        <div class="flex justify-between">
            <span class="text-blue-800 uppercase text-3xl font-black">{{__('Courses')}}</span>
            <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('courses.create') }}">{{__('Create Course')}}</a>
        </div>
        <!-- filters -->
        <div class="flex justify-between my-5">
            <div class="flex">
                <!-- search -->
                <div>
                    <form action="" method="get">
                        <input name="search" class="w-80" type="text" placeholder="Search by Name or Description" value="{{ request('search') }}">
                    </form>
                </div>
                <!-- category filter -->
                <div x-data="{ show:false}" @click.away="show = false" class="ml-5">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-40 bg-white">
                        @if(request('category'))
                        {{ request('category') }}
                        @else
                        All Categories
                        @endif
                    </button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-40 z-10">
                        <form action="" method="get">
                            @if(request('date_filter'))
                            <input type="hidden" name="date_filter" value="">
                            @endif
                            <a href="{{ route('courses.index') }}" class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2 block">All Categories</a>
                            @foreach($categories as $category)
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="category" value="{{ $category->id }}">{{ $category->name }}</button>
                            @endforeach
                        </form>
                    </div>
                </div>

                <!-- level filter -->
                <div x-data="{ show:false}" @click.away="show = false" class="ml-5">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-40 bg-white">
                        Level</button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-40 z-10 overflow-y-scroll h-64">
                        <form action="" method="get">
                            @if(request('date_filter'))
                            <input type="hidden" name="date_filter" value="">
                            @endif
                            <a href="{{ route('courses.index') }}" class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2 block">All Levels</a>
                            @foreach($levels as $level)
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="level" value="{{ $level->id }}">{{ $level->name }}</button>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>

            <!-- sort by  -->
            <div x-data="{ show:false}" @click.away="show = false" class="ml-5">
                <button @click="show = !show" class="border-2 px-5 py-2 w-52 bg-white">
                    @if(request('sort_by') == 'ASC')
                    Oldest Created Date
                    @elseif(request('sort_by') == 'A-Z')
                    Name A TO Z
                    @elseif(request('sort_byx') == 'Z-A')
                    Name Z TO A
                    @else
                    Latest Created Date
                    @endif
                </button>
                <div x-show="show" class="absolute border-2 border-black-600 w-52 z-10">
                    <form action="" method="get">
                        @if(request('user_type'))
                        <input type="hidden" name="user_type" value="{{ request('user_type') }}">
                        @endif
                        <a href="{{ route('courses.index') }}" class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2 block">Latest Created Date</a>
                        <!-- <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="ASC">Latest Created Date</button> -->
                        <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="ASC"> Oldest Created Date</button>
                        <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="A-Z">Name A to Z</button>
                        <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="Z-A">Name Z to A</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- courses list -->
        @foreach($courses as $course)

        <div class="w-full flex mb-2 h-52 bg-white p-2">
            <div class="w-3/12 bg-gray-100 m-2 rounded">
                <img src="{{ url('storage/app/'.$course->image->image_path )}}" alt="img">
            </div>
            <div class="relative w-full">
                <span class="px-2 bg-gray-100 rounded">{{ $course->category->name }}</span>
                <div class="text-3xl"><a href="{{ route('courses.show',$course) }}">{{ $course->title }}</a></div>
                <div class="font-thin text-gray-500">Created by:<span class="font-black text-black mr-2 ml-1">{{ $course->users }}</span> Created on:<span class="font-black text-black ml-1">{{ $course->created_at }}</span></div>
                <div class="font-thin text-gray-500">{{ $course->description }}</div>
                <div class=" absolute bottom-0"><span class="mr-2">{{ $course->level->name }}</span><span>0 Enrolled</span></div>
                <span class="absolute top-2 right-12 px-2 bg-green-100 border-2 border-green-700 text-green-700 text-sm rounded">Published</span>

                <!-- dropdown for actions -->
                <div x-data="{ show:false}" @click.away="show = false" class="absolute top-2 right-2">
                    <button @click="show = !show">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.625 7.5C3.625 8.12132 3.12132 8.625 2.5 8.625C1.87868 8.625 1.375 8.12132 1.375 7.5C1.375 6.87868 1.87868 6.375 2.5 6.375C3.12132 6.375 3.625 6.87868 3.625 7.5ZM8.625 7.5C8.625 8.12132 8.12132 8.625 7.5 8.625C6.87868 8.625 6.375 8.12132 6.375 7.5C6.375 6.87868 6.87868 6.375 7.5 6.375C8.12132 6.375 8.625 6.87868 8.625 7.5ZM12.5 8.625C13.1213 8.625 13.625 8.12132 13.625 7.5C13.625 6.87868 13.1213 6.375 12.5 6.375C11.8787 6.375 11.375 6.87868 11.375 7.5C11.375 8.12132 11.8787 8.625 12.5 8.625Z" fill="currentColor"></path>
                        </svg></button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-50 right-0">
                        <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('courses.destroy',$course) }}">{{ __('Delete') }}</a>
                        <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('courses.edit',$course)}}">{{__('Edit')}}</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>