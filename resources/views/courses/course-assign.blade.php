<x-app-layout>

    <section class="flex-auto h-screen m-5">

        <div class="flex justify-between mb-5">
            <!-- links -->
            <div>
                <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.index',$course) }}">{{ __('Courses') }}</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $course->title }}</span><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ __('Assign Course') }}</span>
            </div>

            <!-- dropdown to add trainer -->
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded w-40">{{ __('Add Trainer') }}</button>
                <div x-show=" show" class="absolute bg-gray-200 w-40">
                    <form action="{{ route('courses.assign.store',$course) }}" method="post">
                        @csrf
                        @foreach($unassignedTrainers as $unassignedTrainer)
                        <input type="checkbox" name="userIds[]" value="{{ $unassignedTrainer->id }}">
                        <label class="w-10/12 inline-block hover:bg-gray-400 text-left px-3 py-1" for="unassignedTrainerIds">{{ $unassignedTrainer->full_name }}</label><br>
                        @endforeach
                        <button class="bg-gray w-full hover:bg-gray-400 text-left px-3 py-1" type="submit">{{ __('Assign')}}</button>
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
                        <th class="py-5">{{ __('User Name') }}</th>
                        <th>{{__('E-mail')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($assignedTrainers->count())

                    @foreach($assignedTrainers as $assignedTrainer)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $assignedTrainer->full_name }}</td>
                        <td> {{ $assignedTrainer->email }} </td>
                        <td> {{ $assignedTrainer->status == 1 ? 'Active' : 'Inactive' }} </td>
                        <td>
                            <form action="{{ route('courses.assign.destroy',$course) }}" method="post">
                                @csrf
                                <button class="px-2 bg-gray-900 text-white rounded" type="submit" name="userId" value="{{ $assignedTrainer->id }}">{{ __('Unassign') }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="p-5" colspan="6">
                            <div>{{ __('No data found') }}</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        </div>

    </section>

</x-app-layout>