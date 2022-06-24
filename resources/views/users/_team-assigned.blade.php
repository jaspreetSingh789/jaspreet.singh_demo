<x-app-layout>
    <div class="flex">
        @include('layouts.sidebar')
        <section class="flex-auto h-screen">

            <div class="mt-20 flex justify-between mx-20 my-5">
                <div>
                    <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index',$user) }}">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">user->first_name</span>
                </div>

                <div x-data="{ show:false}" @click.away="show = false">
                    <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded">Add Trainer</button>
                    <div x-show=" show" class="absolute border-2 border-black-600 bg-gray-200">
                        <form action="{{ route('users.teams.store', $user) }}" method="post">
                            @csrf
                            @foreach($trainers as $trainer)
                            <input type="checkbox" name="trainerIds[]" value="{{ $trainer->id }}">
                            <label for="trainerIds"> {{ $trainer->id.' '.$trainer->first_name }}</label><br>
                            @endforeach
                            <button type="submit">Assign</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-11/12 ml-10">
                <x-tabs :trainer=$user />
                <table class="text-center w-full shadow-md">
                    <thead class="uppercase">
                        <tr class="bg-blue-100 p-10">
                            <th>{{__('User Name')}}</th>
                            <th>{{__('id')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('User Type')}}</th>
                            <th>{{__('action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedtrainers as $assignedtrainer)
                        <tr class="border border-b-2 border-black-700">
                            <td class="p-5">{{ $assignedtrainer->first_name }}</td>
                            <td>{{ $assignedtrainer->id }}</td>
                            <td>{{ $assignedtrainer->email }}</td>
                            <td>{{ $assignedtrainer->role->name }}</td>
                            <td>
                                <form action="{{ route('users.teams.destroy',$user) }}" method="post">
                                    @csrf
                                    <button type="submit" name="userId" value="{{ $assignedtrainer->id }}">{{ __('unassigned') }}</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>

    @if(session()->has('success'))
    <div x-data="{ show:true }" x-init="setTimeout(()=>show = false,4000)" x-show="show" class="fixed bg-blue-500 text-white py-2 px-4  rounded-xl bottom-3 right-3 text-sm">
        <p>
            {{ session('success') }}
        </p>
    </div>
    @endif

    </section>
    </div>
</x-app-layout>