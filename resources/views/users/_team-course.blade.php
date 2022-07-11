<x-app-layout>
    <section class="flex-auto h-screen m-5">
        <div class="flex justify-between mb-5">

            <!-- links -->
            <div>
                <a class=" text-blue-800 font-bold text-xl" href="">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $trainer->full_name }}</span><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Add Courses</span>
            </div>

            <!-- dropdown to add employees -->
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded w-40">Add Course</button>
                <div x-show=" show" class="absolute border-2 border-black-600 bg-gray-200 w-40">
                    <form action="{{ route('teams.courses.store',$trainer) }}" method="post">
                        @csrf
                        @foreach($unassignedCourses as $unassignedCourse)
                        <input type="checkbox" name="courseIds[]" value="{{ $unassignedCourse->id }}" id="courses">
                        <label class="w-10/12 inline-block hover:bg-gray-400 text-left px-3 py-1" for="courses">{{$unassignedCourse->title }}</label><br>
                        @endforeach
                        <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-1" type="submit">Add</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="">

            <!-- tabs -->
            <x-tabs :trainer=$trainer />

            <!-- table to list assigned employees-->
            <table class="text-center w-full shadow-md">
                <thead class="uppercase">
                    <tr class="bg-blue-100 p-10">
                        <th class="py-5">{{__('Title')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Unassign')}}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($assignedCourses as $assignedCourse)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $assignedCourse->title }}</td>
                        <td><span class="px-2 bg-green-200 rounded-xl"></span></td>
                        <td>
                            <form action="{{ route('teams.courses.destroy',$trainer) }}" method="post">
                                @csrf
                                <button class="px-2 bg-gray-900 text-white rounded-xl" type="submit" name="courseId" value="{{ $assignedCourse->id }}">{{ __('unassigned') }}</button>
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