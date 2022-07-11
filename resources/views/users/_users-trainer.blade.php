<x-app-layout>
    <section class="flex-auto h-screen m-5">
        <div class="flex justify-between mb-5">

            <!-- links -->
            <div>
                <a class=" text-blue-800 font-bold text-xl" href="{{ route('users.index',$trainer) }}">Users</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">user->first_name</span>
            </div>

            <!-- dropdown to add employees -->
            <div x-data="{ show:false}" @click.away="show = false">
                <button @click="show = !show" class="px-5 py-2 bg-gray-500 text-white rounded w-40">Add employees</button>
                <div x-show=" show" class="absolute border-2 border-black-600 bg-gray-200 w-40">
                    <form action="{{ route('teams.users.store', $trainer) }}" method="post">
                        @csrf
                        @foreach($employees as $employee)
                        <input type="checkbox" name="employees[]" value="{{ $employee->id }}">
                        <label class="w-10/12 inline-block hover:bg-gray-400 text-left px-3 py-1" for="employee"> {{ $employee->id.' '.$employee->first_name .' '. $employee->last_name }}</label><br>
                        @endforeach
                        <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-1" type="submit">Assign</button>
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
                        <th class="py-5">{{__('User Name')}}</th>
                        <th>{{__('id')}}</th>
                        <th>{{__('Email')}}</th>
                        <th>{{__('User Type')}}</th>
                        <th>{{__('Status')}}</th>
                        <th>{{__('action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($assingedUsers->count())

                    @foreach($assingedUsers as $user)
                    <tr class="border border-b-2 border-black-700">
                        <td class="p-5">{{ $user->first_name }}</td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td><span class="px-2 bg-green-200 rounded-xl">{{ $user->status == 1 ? 'Active' : 'Inactive'}}</span></td>
                        <td>
                            <form action="{{ route('teams.users.destroy',$trainer) }}" method="post">
                                @csrf
                                <button class="px-2 bg-gray-900 text-white rounded-xl" type="submit" name="userId" value="{{ $user->id }}">{{ __('unassigned') }}</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="p-5" colspan="6">
                            <div>No data found</div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        </div>

    </section>
</x-app-layout>