<x-app-layout>
    <!-- button to create user  -->
    <div class="w-4/5 m-5">
        <div class="flex justify-between">
            <span class="text-blue-800 uppercase text-3xl font-black">{{__('Users')}}</span>
            <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('users.create')}}">{{__('Create User')}}</a>
        </div>
        <!-- filters -->
        <div class="flex justify-between my-5">
            <div>
                <form action="" method="get">
                    <input class="w-80 rounded" name="search" type="text" value="{{ request('search') }}" placeholder="Search by Name or Email">
                </form>
            </div>
            <div class="flex">
                <div x-data="{ show:false}" @click.away="show = false">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-40">
                        @if(request('user_type') == '2')
                        Sub Admins
                        @elseif(request('user_type') == '3')
                        Trainers
                        @elseif(request('user_type') == '4')
                        Employees
                        @else
                        All User Type
                        @endif
                    </button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-40">
                        <form action="{{ route('users.index') }}" method="get">
                            @if(request('date_filter'))
                            <input type="hidden" name="date_filter" value="{{ request('date_filter') }}">
                            @endif
                            <a href="{{ route('users.index') }}" class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2 inline-block">All</a>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2 {{ request('user_type') == '2' ? 'bg-blue-500 text-white' : ''}}" type="submit" name="user_type" value="2">Sub-admins</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="user_type" value="3">Trainers</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="user_type" value="4">Users</button>
                        </form>
                    </div>
                </div>

                <div x-data="{ show:false}" @click.away="show = false" class="ml-5">
                    <button @click="show = !show" class="border-2 px-5 py-2 w-52">
                        @if(request('date_filter') == 'DESC')
                        Oldest Created Date
                        @elseif(request('date_filter') == 'A-Z')
                        Name A TO Z
                        @elseif(request('date_filter') == 'Z-A')
                        Name Z TO A
                        @else
                        Latest Created Date
                        @endif
                    </button>
                    <div x-show="show" class="absolute border-2 border-black-600 w-52">
                        <form action="{{ route('users.index') }}" method="get">
                            @if(request('user_type'))
                            <input type="hidden" name="user_type" value="{{ request('user_type') }}">
                            @endif
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="date_filter" value="ASC">Latest Created Date</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="date_filter" value="DESC"> Oldest Created Date</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="date_filter" value="A-Z">Name A to Z</button>
                            <button class="bg-gray-100 w-full hover:bg-gray-400 text-left px-3 py-2" type="submit" name="date_filter" value="Z-A">Name Z to A</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table to list users -->
        <table class="text-center w-full shadow-md">
            <thead class="uppercase">
                <tr class="bg-blue-100 p-10">
                    <th class="py-5">{{__('User Name')}}</th>
                    <th>{{__('User type')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border border-b-2 border-black-700">
                    <td class="py-5">
                        <div>{{ $user->full_name }}</div>
                        <div class="text-xs text-gray-700">{{ $user->email }}</div>
                    </td>
                    <td>{{ $user->status == 1 ? 'Active' : 'Inactive'}}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <div x-data="{ show:false}" @click.away="show = false">
                            <button @click="show = !show">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M144,192a16,16,0,1,1-16-16A16,16,0,0,1,144,192ZM128,80a16,16,0,1,0-16-16A16,16,0,0,0,128,80Zm0,32a16,16,0,1,0,16,16A16,16,0,0,0,128,112Z"></path>
                                </svg></button>
                            <div x-show="show" class="absolute border-2 border-black-600 w-50">
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href=" {{ route('users.delete', $user) }}">{{ __('Delete') }}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('users.edit', $user) }}">{{__('Edit')}}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href=" {{ route('users.status.update', $user) }}">{{ $user->status == 1 ? 'Inactive' : 'Active'}}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('users.resetpassword', $user) }}">{{__('Reset Password')}}</a>
                            </div>
                        </div>
                </tr>
                </td>
                @endforeach
            </tbody>
        </table>
        <div class="fixed right-10 bottom-5"> {{ $users->links() }}</div>
    </div>

</x-app-layout>