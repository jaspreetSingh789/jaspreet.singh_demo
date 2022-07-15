<x-app-layout>
    <section class="flex-auto h-screen m-5">
        <div class="flex justify-between mb-5">

            <!-- links -->
            <div>
                <a class=" text-blue-800 font-bold text-xl" href="">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $user->full_name }}</span><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Add Course</span>
            </div>

            <!-- dropdown to add employees -->
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded w-40">Add Course</button>
                <div x-show=" show" class="absolute border-2 border-black-600 bg-gray-200 w-40">
                    <form action="{{ route('users.courses.store',$user) }}" method="post">
                        @csrf
                        @foreach($unenrolledCourses as $unenrolledCourse)
                        @if($unenrolledCourse->status->name == 'published')
                        <input type="checkbox" name="courseIds[]" value="{{ $unenrolledCourse->id }}" id="course">
                        <label class="w-10/12 inline-block hover:bg-gray-400 text-left px-3 py-1" for="course">{{ $unenrolledCourse->title }}</label><br>
                        @endif
                        @endforeach

                        <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-1" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="">

            <!-- tabs -->
            <x-tabs :trainer=$user />

            <!-- table to list assigned employees-->
            <table class="text-center w-full shadow-md">
                <thead class="uppercase">
                    <tr class="bg-blue-100 p-10">
                        <th class="py-5">{{__('User Name')}}</th>
                        <th>{{__('id')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('User Type')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrolledCourses as $enrolledCourse)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $enrolledCourse->title }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><span class="px-2 bg-green-200 rounded-xl"></span></td>
                        <td>
                            <form action="{{ route('users.courses.destroy',$user) }}" method="post">
                                @csrf
                                <button class="px-2 bg-gray-900 text-white rounded-xl" type="submit" name="courseId" value="{{ $enrolledCourse->id }}">{{ __('unenroll') }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>

    </section>
</x-app-layout>