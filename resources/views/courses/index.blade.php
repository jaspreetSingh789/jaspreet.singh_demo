<x-app-layout>

    <!-- button to create user  -->
    <div class="w-4/5">
        <div class="flex justify-between p-5 ml-16">
            <span class="text-blue-800 uppercase text-3xl font-black">{{__('Courses')}}</span>
            <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('courses.create') }}">{{__('Create Course')}}</a>
        </div>
        <!-- filters -->
        <div class="flex justify-between mx-10 my-5">
            <div>
                <form action="" method="get">
                    <input class="px-10 py-3" type="text">
                </form>
            </div>
            <div class="flex">
                <div x-data="{ show:false}" @click.away="show = false">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-40">
                        User type</button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-40">
                        <form action="" method="get">
                            @if(request('date_filter'))
                            <input type="hidden" name="date_filter" value="">
                            @endif
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="user_type" value="2">Sub-admins</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="user_type" value="3">Trainers</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="user_type" value="4">Users</button>
                        </form>
                    </div>
                </div>

                <div x-data="{ show:false}" @click.away="show = false" class="ml-5">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-40">
                        Date filter</button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-40">
                        <form action="" method="get">
                            @if(request('user_type'))
                            <input type="hidden" name="user_type" value="">
                            @endif
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="date_filter" value="ASC">latest</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="date_filter" value="DESC">oldest</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- courses list -->
        @foreach($courses as $course)
        <div class="bg-gray-300 w-full flex mb-2 h-40">
            <div class="w-3/12 bg-red-100">picture</div>
            <div>
                <div>{{ $course->category->name }}</div>
                <div>{{ $course->title }}</div>
                <div>Created by:{{ $course->user->first_name }} Created on:{{ $course->created_at }} </div>
                <div>{{ $course->description }}</div>
                <div>{{ $course->level->name }}</div>
            </div>
        </div>
        @endforeach
        <!-- Table to list users -->
        <table class="text-center ml-20 w-11/12 shadow-md">
            <thead class="uppercase">
                <tr class="bg-blue-100 p-10">
                    <?php $number = 1 ?>
                    <th class="py-5">{{__('S.no')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('Description')}}</th>
                    <th>{{__('Duration')}}</th>
                    <th>{{__('certificate')}}</th>
                    <th>{{__('action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="border border-b-2 border-black-700">
                    <td class="p-5">{{ $number++ }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>{{ $course->certificate }}</td>
                    <td>
                        <div x-data="{ show:false}" @click.away="show = false">
                            <button @click="show = !show">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M144,192a16,16,0,1,1-16-16A16,16,0,0,1,144,192ZM128,80a16,16,0,1,0-16-16A16,16,0,0,0,128,80Zm0,32a16,16,0,1,0,16,16A16,16,0,0,0,128,112Z"></path>
                                </svg></button>
                            <div x-show="show" class="absolute border-2 border-black-600 w-50">
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('courses.destroy',$course) }}">{{ __('Delete') }}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('courses.edit',$course)}}">{{__('Edit')}}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="">{{__('Reset Password')}}</a>
                            </div>
                        </div>
                </tr>
                </td>
                @endforeach
            </tbody>
        </table>

    </div>

</x-app-layout>