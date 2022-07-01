<x-app-layout>
    <section class="flex-auto m-5 w-5/6">
        <!-- links -->
        <div class="flex justify-between mb-5">
            <div>
                <a class="text-blue-800 font-bold text-xl" href="{{ route('courses.index') }}">Courses</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">{{ $course->title }}</span>
            </div>
            <a class="px-4 py-2 bg-blue-500 rounded text-white shadow-md" href="{{ route('units.create',$course) }}">{{__('Add Unit')}}</a>
        </div>

        <!-- course -->
        <div class="bg-white flex p-4 border-b-2 relative">
            <div class="w-1/4 h-40 bg-gray-300">picture</div>
            <div class="w-3/4 pl-2">
                <div class="text-3xl text-black text-gray-500">{{ $course->title }}</div>
                <div class="text-gray-400">{{ $course->description }}</div>
            </div>
            <a href="{{ route('courses.edit',$course) }}" class="absolute top-2 right-2 px-4 py-1 bg-gray-300 text-blue-500 text-sm">Edit basic info</a>
        </div>
        <div class="w-full bg-white flex h-32 p-4">
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-7.59V4h2v5.59l3.95 3.95-1.41 1.41L9 10.41z"></path>
                    </svg>
                </div>
                <div class="p-1"> Course Duration</div>
                <div class="p-1">00.00</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2" d="M5 14V5h14v15h-8m8-4h4V1H9v4M5 16v8m4-4H1"></path>
                    </svg>
                </div>
                <div class="p-1"> Total Unit</div>
                <div class="p-1">0</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="currentColor">
                        <defs></defs>
                        <title>skill-level--basic</title>
                        <path d="M30,30H22V4h8Zm-6-2h4V6H24Z"></path>
                        <path d="M20,30H12V12h8Zm-6-2h4V14H14Z"></path>
                        <path d="M10,30H2V18h8Z"></path>
                        <rect id="_Transparent_Rectangle_" data-name="<Transparent Rectangle>" class="cls-1" width="32" height="32" style="fill: none"></rect>
                    </svg>
                </div>
                <div class="p-1">Course Level</div>
                <div class="p-1">{{ $course->level->name }}</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="currentColor">
                        <g>
                            <rect fill="none" height="24" width="24"></rect>
                        </g>
                        <g>
                            <g>
                                <path d="M11,8.75v3.68c0,0.35,0.19,0.68,0.49,0.86l3.12,1.85c0.36,0.21,0.82,0.09,1.03-0.26c0.21-0.36,0.1-0.82-0.26-1.03 l-2.87-1.71v-3.4C12.5,8.34,12.16,8,11.75,8S11,8.34,11,8.75z M21,9.5V4.21c0-0.45-0.54-0.67-0.85-0.35l-1.78,1.78 c-1.81-1.81-4.39-2.85-7.21-2.6c-4.19,0.38-7.64,3.75-8.1,7.94C2.46,16.4,6.69,21,12,21c4.59,0,8.38-3.44,8.93-7.88 c0.07-0.6-0.4-1.12-1-1.12c-0.5,0-0.92,0.37-0.98,0.86c-0.43,3.49-3.44,6.19-7.05,6.14c-3.71-0.05-6.84-3.18-6.9-6.9 C4.94,8.2,8.11,5,12,5c1.93,0,3.68,0.79,4.95,2.05l-2.09,2.09C14.54,9.46,14.76,10,15.21,10h5.29C20.78,10,21,9.78,21,9.5z"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="p-1">Last Update</div>
                <div class="p-1">0</div>
            </div>
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                        <g fill="none">
                            <path stroke="currentColor" stroke-width="2" d="M15 19H2V1h16v4m0 0a5 5 0 1 1 0 10a5 5 0 0 1 0-10zm-3 9v8l3-2l3 2v-8M5 8h6m-6 3h5m-5 3h2M5 5h2"></path>
                        </g>
                    </svg>
                </div>
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
            <div class="absolute top-2 right-6">
                <a href="{{ route('units.edit',$unit) }}">
                    <svg class="w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </a>
                <a href="{{ route('units.destroy',$unit) }}">
                    <svg class="w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="currentColor"></path>
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </section>
</x-app-layout>