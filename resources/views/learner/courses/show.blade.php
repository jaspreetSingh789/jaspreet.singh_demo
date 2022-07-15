<x-app-layout>
    <section class="flex-auto m-5 w-5/6">
        <!-- Breadcrumbs -->
        <div class="flex justify-between mb-5">
            <div>
                <a class="text-blue-800 font-bold text-xl" href="{{ route('my-courses.index') }}">
                    {{ __('Courses') }}
                </a>
                <strong class="px-2 font-bold text-xl ">></strong>
                <span class="font-bold text-xl">
                    {{ $course->title }}
                </span>
            </div>
        </div>

        <!-- course -->
        <div class="bg-white flex p-4 border-b-2 relative">
            <div class="w-1/4 h-40 bg-gray-300">
                <img class="w-full h-full" src="{{ asset('/storage/'.$course->image->image_path) }}" alt="img">
            </div>
            <div class="w-3/4 pl-10">
                <div class="text-3xl text-black text-gray-500">
                    {{ $course->title }}
                </div>
                <div class="text-gray-400 mb-3">
                    {{ $course->description }}
                </div>
                <a class="px-7 py-2 bg-blue-500 text-white text-sm rounded" href="#">{{ __('continue') }}</a>
            </div>
        </div>
        <div class="w-full bg-white flex h-32 p-4">
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-7.59V4h2v5.59l3.95 3.95-1.41 1.41L9 10.41z"></path>
                    </svg>
                </div>
                <div class="p-1">
                    {{ __('Course Duration') }}
                </div>
                <div class="p-1">
                    {{ $course->units->sum('duration') }}
                </div>
            </div>
            <div class="w-1/5">
                <div class="p-1">
                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-width="2" d="M5 14V5h14v15h-8m8-4h4V1H9v4M5 16v8m4-4H1"></path>
                    </svg>
                </div>
                <div class="p-1">
                    {{ __('Total Unit') }}
                </div>
                <div class="p-1">
                    {{ count($course->units) }}
                </div>
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
                <div class="p-1">
                    {{ __('Course Level') }}
                </div>
                <div class="p-1">
                    {{ $course->level->name }}
                </div>
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
                <div class="p-1">
                    {{ __('Last Update') }}
                </div>
                <div class="p-1">
                    {{ $course->updated_at }}
                </div>
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

        <div class="m-5 text-2xl text-black">
            {{ __('Course Content') }}
        </div>

        <!-- units -->
        @foreach($units as $unit)
        <div class="bg-white my-5 p-5 relative">
            <div class="">{{ $unit->title }}</div>
            <div class="text-sm">
                Duration:40s
            </div>
            <!-- Lessons -->
            <div>
                <div class="my-3 border-b text-sm">
                    <span>{{ $unit->description }}</span>
                </div>
                <div class="mx-3">
                    <div class="flex justify-between m-2">
                        <div class="bg-gray-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="23 7 16 12 23 17 23 7"></polygon>
                                <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                            </svg>
                        </div>
                        <span class="inline-block w-full mx-1">
                            <p class="text-xm">safasdf</p>
                        </span>
                        <span>13s</span>
                    </div>
                    <div class="flex justify-between m-2">
                        <div class="bg-gray-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                <path d="M252,128a83.4,83.4,0,0,1-24.6,59.4,12.1,12.1,0,0,1-17,0,12,12,0,0,1,0-17,59.9,59.9,0,0,0,0-84.8,12,12,0,0,1,17-17A83.4,83.4,0,0,1,252,128ZM164,32V224a12,12,0,0,1-6.7,10.8A12.4,12.4,0,0,1,152,236a12.7,12.7,0,0,1-7.4-2.5L75.9,180H32a20.1,20.1,0,0,1-20-20V96A20.1,20.1,0,0,1,32,76H75.9l68.7-53.5a12.2,12.2,0,0,1,12.7-1.3A12,12,0,0,1,164,32ZM36,156H68V100H36ZM140,56.5,92,93.9v68.2l48,37.4Zm59.1,40.4a12,12,0,0,0-17,17,19.8,19.8,0,0,1,0,28.2,12,12,0,0,0,0,17,11.8,11.8,0,0,0,8.5,3.5,11.6,11.6,0,0,0,8.5-3.5,43.9,43.9,0,0,0,0-62.2Z"></path>
                            </svg>
                        </div>
                        <span>27s</span>
                    </div>
                    <div class="flex justify-between m-2">
                        <div class="bg-gray-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" fill="none">
                                <path d="M2.5 6.5V6H2v.5h.5zm4 0V6H6v.5h.5zm0 4H6v.5h.5v-.5zm7-7h.5v-.207l-.146-.147-.354.354zm-3-3l.354-.354L10.707 0H10.5v.5zM2.5 7h1V6h-1v1zm.5 4V8.5H2V11h1zm0-2.5v-2H2v2h1zm.5-.5h-1v1h1V8zm.5-.5a.5.5 0 01-.5.5v1A1.5 1.5 0 005 7.5H4zM3.5 7a.5.5 0 01.5.5h1A1.5 1.5 0 003.5 6v1zM6 6.5v4h1v-4H6zm.5 4.5h1v-1h-1v1zM9 9.5v-2H8v2h1zM7.5 6h-1v1h1V6zM9 7.5A1.5 1.5 0 007.5 6v1a.5.5 0 01.5.5h1zM7.5 11A1.5 1.5 0 009 9.5H8a.5.5 0 01-.5.5v1zM10 6v5h1V6h-1zm.5 1H13V6h-2.5v1zm0 2H12V8h-1.5v1zM2 5V1.5H1V5h1zm11-1.5V5h1V3.5h-1zM2.5 1h8V0h-8v1zm7.646-.146l3 3 .708-.708-3-3-.708.708zM2 1.5a.5.5 0 01.5-.5V0A1.5 1.5 0 001 1.5h1zM1 12v1.5h1V12H1zm1.5 3h10v-1h-10v1zM14 13.5V12h-1v1.5h1zM12.5 15a1.5 1.5 0 001.5-1.5h-1a.5.5 0 01-.5.5v1zM1 13.5A1.5 1.5 0 002.5 15v-1a.5.5 0 01-.5-.5H1z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <span></span>
                    </div>
                    <div class="flex justify-between m-2">
                        <div class="bg-gray-100 p-2 rounded-full">
                            <svg class="w-4 h-4 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                <path d="M7 12.25C7 11.8358 7.33579 11.5 7.75 11.5C8.16421 11.5 8.5 11.8358 8.5 12.25C8.5 12.6642 8.16421 13 7.75 13C7.33579 13 7 12.6642 7 12.25ZM7.75 14.5C7.33579 14.5 7 14.8358 7 15.25C7 15.6642 7.33579 16 7.75 16C8.16421 16 8.5 15.6642 8.5 15.25C8.5 14.8358 8.16421 14.5 7.75 14.5ZM7 18.25C7 17.8358 7.33579 17.5 7.75 17.5C8.16421 17.5 8.5 17.8358 8.5 18.25C8.5 18.6642 8.16421 19 7.75 19C7.33579 19 7 18.6642 7 18.25ZM10.75 11.5C10.3358 11.5 10 11.8358 10 12.25C10 12.6642 10.3358 13 10.75 13H16.25C16.6642 13 17 12.6642 17 12.25C17 11.8358 16.6642 11.5 16.25 11.5H10.75ZM10 15.25C10 14.8358 10.3358 14.5 10.75 14.5H16.25C16.6642 14.5 17 14.8358 17 15.25C17 15.6642 16.6642 16 16.25 16H10.75C10.3358 16 10 15.6642 10 15.25ZM10.75 17.5C10.3358 17.5 10 17.8358 10 18.25C10 18.6642 10.3358 19 10.75 19H16.25C16.6642 19 17 18.6642 17 18.25C17 17.8358 16.6642 17.5 16.25 17.5H10.75ZM19.414 8.414L13.585 2.586C13.57 2.57105 13.5531 2.55808 13.5363 2.54519C13.5238 2.53567 13.5115 2.5262 13.5 2.516C13.429 2.452 13.359 2.389 13.281 2.336C13.2557 2.31894 13.2281 2.30548 13.2005 2.29207C13.1845 2.28426 13.1685 2.27647 13.153 2.268C13.1363 2.25859 13.1197 2.24897 13.103 2.23933C13.0488 2.20797 12.9944 2.17648 12.937 2.152C12.74 2.07 12.528 2.029 12.313 2.014C12.2933 2.01274 12.2738 2.01008 12.2542 2.00741C12.2271 2.00371 12.1999 2 12.172 2H6C4.896 2 4 2.896 4 4V20C4 21.104 4.896 22 6 22H18C19.104 22 20 21.104 20 20V9.828C20 9.298 19.789 8.789 19.414 8.414ZM18.5 20C18.5 20.275 18.276 20.5 18 20.5H6C5.724 20.5 5.5 20.275 5.5 20V4C5.5 3.725 5.724 3.5 6 3.5H12V8C12 9.104 12.896 10 14 10H18.5V20ZM13.5 4.621L17.378 8.5H14C13.724 8.5 13.5 8.275 13.5 8V4.621Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <span>0 questions</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </section>
</x-app-layout>