<x-app-layout>
    <!-- button to create course  -->
    <div class="w-4/5 bg-gray-100 m-5">
        <div class="mb-8">
            <span class="text-blue-800 text-3xl font-black">{{__('My Courses')}}</span>
        </div>

        <!-- tabs -->
        <div class="py-2 flex space-x-14 border-b-2">
            <a class="ml-10 font-black text-sky-800 text-md" href="#">{{ __('All Courses') }}</a>
            <a class="font-black text-sky-800 text-md" href="#">{{ __('New') }}</a>
            <a class="font-black text-sky-800 text-md" href="#">{{ __('In-Progress') }}</a>
            <a class="font-black text-sky-800 text-md" href="#">{{ __('Completed') }}</a>
        </div>
        <!-- filters -->
        <div class="my-5">
            <div class="flex justify-between">
                <!-- search -->
                <div>
                    <form action="" method="get">
                        <input name="search" class="w-80" type="text" placeholder="Search by Name or Description" value="{{ request('search') }}">
                    </form>
                </div>

                <!-- sort by  -->
                <div x-data="{ show:false}" @click.away="show = false" class="ml-5">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-52 bg-white">
                        @if(request('sort_by') == 'ASC')
                        {{ __('Oldest Created Date') }}
                        @elseif(request('sort_by') == 'A-Z')
                        {{ __('Name A TO Z') }}
                        @elseif(request('sort_byx') == 'Z-A')
                        {{ __('Name Z TO A') }}
                        @else
                        {{ __('Latest Created Date') }}
                        @endif
                    </button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-52 z-10">
                        <form action="" method="get">
                            @if(request('user_type'))
                            <input type="hidden" name="user_type" value="{{ request('user_type') }}">
                            @endif
                            <a href="{{ route('courses.index') }}" class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2 block">{{ __('Latest Created Date') }}</a>
                            <!-- <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="ASC">Latest Created Date</button> -->
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="ASC">{{ __('Oldest Created Date') }}</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="A-Z">{{ __('Name A to Z') }}</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="sort_by" value="Z-A">{{ __('Name Z to A') }}</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- courses list -->
        @if($courses->count())
        @foreach($courses as $course)
        <div class="w-full flex mb-2 h-52 bg-white p-2">
            <div class="w-3/12 bg-gray-100 m-2 rounded">
                <img src="{{ url('storage/app/'.$course->image)}}" alt="img">
            </div>
            <div class="relative w-full">
                <span class="px-2 bg-gray-100 rounded">
                    {{ $course->category->name }}
                </span>
                <div class="text-3xl">
                    <a href="{{ route('courses.show',$course) }}">
                        {{ $course->title }}
                    </a>
                </div>
                <div class="font-thin text-gray-500">
                    Created by:
                    <span class="font-black text-black mr-2 ml-1">
                        {{ $course->users }}
                    </span>
                    Created on:
                    <span class="font-black text-black ml-1">
                        {{ $course->created_at }}
                    </span>
                </div>
                <div class="font-thin text-gray-500">
                    {{ $course->description }}
                </div>
                <div class=" absolute bottom-0">
                    <span class="mr-2">{{ $course->level->name }}</span>
                    <span>00m 0s</span>
                    <span>2 Lessons</span>
                </div>
                <span class="absolute top-2 right-2 px-2 text-sm rounded text-sm">
                    Certification
                </span>
                <a class="absolute bottom-2 right-2 px-2 text-sm rounded text-sm border-2 border-blue-400 text-blue-400" href="#">
                    {{ __('View') }}
                </a>

            </div>
        </div>
        @endforeach
        @else
        <div>{{ __('No data found') }}</div>
        @endif
    </div>


</x-app-layout>