<x-app-layout>

    <section class="flex-auto h-screen m-5">

        <div class="flex justify-between mb-5">
            <!-- links -->
            <div>
                <a class=" text-blue-800 font-bold text-xl" href="">Courses</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">course name</span>
            </div>

            <!-- dropdown to add trainer -->
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded w-40">Enroll</button>
                <div x-show=" show" class="absolute bg-gray-200 w-40">
                    <form action="{{ route('courses.enroll.store',$course) }}" method="post">
                        @csrf
                        @foreach($unenrolledUsers as $unenrolledUser)
                        <input type="checkbox" name="unenrolledUsers[]" value="{{ $unenrolledUser->id }}">
                        <label class="w-10/12 inline-block hover:bg-gray-400 text-left px-3 py-1" for="trainerIds">{{ $unenrolledUser->full_name }}</label><br>
                        @endforeach
                        <button class="bg-gray w-full hover:bg-gray-400 text-left px-3 py-1" type="submit">Enroll</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="">
            <!-- tabs -->
            <x-courses-tabs :course=$course />

            <!-- table to list assigned trainers -->
            <table class="text-center w-full shadow-md">
                <thead class="uppercase">
                    <tr class="bg-blue-100 p-10">
                        <th class="py-5">{{__('User Name')}}</th>
                        <th>{{__('id')}}</th>
                        <th>{{__('action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrolledUsers as $enrolledUser)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $enrolledUser->full_name }}</td>
                        <td> {{ $enrolledUser->id }} </td>
                        <td>
                            <form action="{{ route('courses.user.destroy',$course) }}" method="post">
                                @csrf
                                <button class="px-2 bg-gray-900 text-white rounded" type="submit" name="enrolledUserId" value="{{ $enrolledUser->id }}">{{ __('Unenroll') }}</button>
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