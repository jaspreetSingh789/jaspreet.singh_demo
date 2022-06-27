<x-app-layout>
    <div class="w-3/4">

        <!-- button to create category -->
        <div class="flex justify-between p-5">
            <span class="text-blue-800 uppercase text-3xl font-black">{{__('Categories')}}</span>
            <a class="px-3 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('categories.create')}}">{{__('Create Category')}}</a>
        </div>

        <!-- table to list categories -->
        <table class="text-center ml-20 w-full shadow-md">
            <thead class="uppercase">
                <tr class="bg-blue-100 p-10">
                    <?php $number = 1 ?>
                    <?php $courses = 0 ?>
                    <th class="p-5">{{__('S.no')}}</th>
                    <th>{{__('NAME')}}</th>
                    <th>{{__('CREATED BY')}}</th>
                    <th>{{__('COURSES')}}</th>
                    <th>{{__('CREATED DATE')}}</th>
                    <th>{{__('STATUS')}}</th>
                    <th colspan="4">{{__('action')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr class="border border-b-1 border-black-700">
                    <td class="py-5">{{ $number++ }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->user_id }}</td>
                    <td>{{ $courses }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->status == 1 ? 'Active' : 'Inactive'}}</td>
                    <td>
                        <div x-data="{ show:false}" @click.away="show = false">
                            <button @click="show = !show">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M144,192a16,16,0,1,1-16-16A16,16,0,0,1,144,192ZM128,80a16,16,0,1,0-16-16A16,16,0,0,0,128,80Zm0,32a16,16,0,1,0,16,16A16,16,0,0,0,128,112Z"></path>
                                </svg></button>
                            <div x-show="show" class="absolute border-2 border-black-600 w-50">
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href=" {{ route('categories.delete', $category) }}">{{__('Delete')}}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('categories.status.update',$category) }}">{{ $category->status == 1 ? 'Deactivate' : 'Activate' }}</a>
                                <a class="bg-gray-100 hover:bg-gray-400 block text-left px-3 leading-7" href="{{ route('categories.edit', $category) }}">{{__('Edit')}}</a>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="fixed right-10 bottom-5"> {{ $categories->links() }}</div>
    </div>


</x-app-layout>