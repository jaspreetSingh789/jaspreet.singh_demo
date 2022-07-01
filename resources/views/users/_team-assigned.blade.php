<x-app-layout>

    <section class="flex-auto h-screen m-5">

        <div class="flex justify-between mb-5">
            <!-- links -->
            <div>
                <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index',$user) }}">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">user->first_name</span>
            </div>

            <!-- dropdown to add trainer -->
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded w-40">Add Trainer</button>
                <div x-show=" show" class="absolute bg-gray-200 w-40">
                    <form action="{{ route('users.teams.store', $user) }}" method="post">
                        @csrf
                        @foreach($trainers as $trainer)
                        <input type="checkbox" name="trainerIds[]" value="{{ $trainer->id }}">
                        <label class="bg-gray-100 w-10/12 inline-block hover:bg-gray-400 text-left px-3 py-1" for="trainerIds"> {{ $trainer->id.' '.$trainer->first_name }}</label><br>
                        @endforeach
                        <button class="w-full hover:bg-gray-400 text-left px-3 py-1" type="submit">Assign</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="">

            <!-- tabs -->
            <x-tabs :trainer=$user />

            <!-- table to list assigned trainers -->
            <table class="text-center w-full shadow-md">
                <thead class="uppercase">
                    <tr class="bg-blue-100 p-10">
                        <th class="py-5">{{__('User Name')}}</th>
                        <th>{{__('id')}}</th>
                        <th>{{__('E-mail')}}</th>
                        <th>{{__('User Type')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignedtrainers as $assignedtrainer)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $assignedtrainer->first_name }}</td>
                        <td>{{ $assignedtrainer->id }}</td>
                        <td>{{ $assignedtrainer->email }}</td>
                        <td>{{ $assignedtrainer->role->name }}</td>
                        <td><span class="px-2 bg-green-200 rounded-xl">{{ $user->status == 1 ? 'Active' : 'Inactive'}}</span></td>
                        <td>
                            <form action="{{ route('users.teams.destroy',$user) }}" method="post">
                                @csrf
                                <button class="px-2 bg-gray-900 text-white rounded-xl" type="submit" name="trainerId" value="{{ $assignedtrainer->id }}">{{ __('unassign') }}</button>
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