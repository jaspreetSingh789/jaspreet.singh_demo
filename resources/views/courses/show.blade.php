<x-app-layout>
    <section class="flex-auto m-5 w-5/6">
        <!-- links -->
        <div class="flex justify-between mb-5">
            <div>
                <a class="text-blue-800 font-bold text-xl" href="{{ route('courses.index') }}">Courses</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $course->title }}</span>
            </div>
            <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('units.create') }}">{{__('Add Unit')}}</a>
        </div>

        <!-- course -->
        <div class="bg-white flex p-4 border-b-2 relative">
            <div class="w-1/4 h-40 bg-gray-300">picture</div>
            <div class="w-3/4 pl-2">
                <div class="text-3xl text-black text-gray-500">{{ $course->title }}</div>
                <div class="text-gray-400">{{ $course->description }}</div>
            </div>
            <a href="" class="absolute top-2 right-2 px-4 py-1 bg-gray-300 text-blue-500 text-sm">Edit basic info</a>
        </div>
        <div class="w-full bg-white flex h-32 p-4">
            <div class="w-1/5">
                <div class="p-1">icon</div>
                <div class="p-1"> Course Duration</div>
                <div class="p-1">00.00</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">icon</div>
                <div class="p-1"> Total Unit</div>
                <div class="p-1">0</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">icon</div>
                <div class="p-1">Course Level</div>
                <div class="p-1">{{ $course->level->name }}</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">icon</div>
                <div class="p-1">Last Update</div>
                <div class="p-1">0</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">icon</div>
                <div class="p-1">Certification of Completion</div>
                <div class="p-1">{{ $course->certificate == 0 ? 'No' : 'Yes' }}</div>
            </div>
        </div>

        <div class="m-5 text-3xl text-black">Course Content</div>

        @foreach($units as $unit)
        <div class="bg-white my-5 p-5 relative">
            <div class="border-b-2">{{ $unit->title }}</div>
            <div class=" ">
                {{ $unit->description }}
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste facere voluptates a optio excepturi dolorem consequuntur eos? Quos tempora dolorum ut, ex ipsum ipsam. Vero cumque unde eum harum vitae voluptates tempore asperiores praesentium sit sed facere, fugit neque et laborum. Impedit repellat deserunt doloremque nesciunt nemo temporibus accusantium facilis.
            </div>
            <div class="absolute top-2 right-4">
                <a href="{{ route('units.edit',$unit) }}">Edit</a>
                <a href="{{ route('units.destroy',$unit) }}">Delete</a>
            </div>
        </div>
        @endforeach
    </section>
</x-app-layout>