<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="{{ route('courses.index',) }}">Courses</a><strong class="px-2 font-bold text-xl ">></strong><a href="{{ route('courses.show',$course) }}" class="font-bold text-xl">{{ $course->title }}</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Edit Unit</span>
        </div>

        <!-- form to create units -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('courses.units.update',$unit) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6 relative">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="title">Name of the Unit</label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="title" value="{{ $unit->title }}" placeholder="title">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700 required" for="description">Add description to the unit</label>
                    <textarea name="description" id="" cols="55" rows="5" placeholder="description">{{ $unit->description }}
                    </textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Add Lessions -->
                    <div class="absolute right-0 top-0 h-72 w-96">
                        <span class="border-2 inline-block rounded-xl w-40 h-28 p-3 m-3 text-center">
                            <label for="video">
                                <svg class="w-16 h-16 ml-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M214,88a6,6,0,0,0-1.8-4.3l-56-55.9A5.6,5.6,0,0,0,152,26H56A14,14,0,0,0,42,40v88a6,6,0,0,0,12,0V40a2,2,0,0,1,2-2h90V88a6,6,0,0,0,6,6h50V216a2,2,0,0,1-2,2H176a6,6,0,0,0,0,12h24a14,14,0,0,0,14-14V88ZM158,46.5,193.5,82H158ZM147.2,158.9a6.2,6.2,0,0,0-5.9-.3L118,170.3V168a14,14,0,0,0-14-14H48a14,14,0,0,0-14,14v40a14,14,0,0,0,14,14h56a14,14,0,0,0,14-14v-2l23.2,12.5a6.4,6.4,0,0,0,2.8.7,5.9,5.9,0,0,0,3.1-.9,6,6,0,0,0,2.9-5.1V164A6.1,6.1,0,0,0,147.2,158.9ZM104,210H48a2,2,0,0,1-2-2V168a2,2,0,0,1,2-2h56a2,2,0,0,1,2,2v28h0v12A2,2,0,0,1,104,210Zm34-6.9-20-10.7v-8.7l20-10Z"></path>
                                </svg>+add video
                            </label>
                            <input type="file" name="video" id="video" hidden>
                        </span>

                        <span class="border-2 inline-block rounded-xl w-40 h-28 p-3 m-3 text-center">
                            <label for="audio">
                                <svg class="w-16 h-16 ml-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M213.7,82.3l-56-56A8.1,8.1,0,0,0,152,24H56A16,16,0,0,0,40,40v88a8,8,0,0,0,16,0V40h88V88a8,8,0,0,0,8,8h48V216H168a8,8,0,0,0,0,16h32a16,16,0,0,0,16-16V88A8.1,8.1,0,0,0,213.7,82.3ZM160,80V51.3L188.7,80Zm-56,72v72a7.9,7.9,0,0,1-4.6,7.2,6.8,6.8,0,0,1-3.4.8,7.5,7.5,0,0,1-5.1-1.9L69.1,212H48a8,8,0,0,1-8-8V172a8,8,0,0,1,8-8H69.1l21.8-18.1a7.8,7.8,0,0,1,8.5-1.1A7.9,7.9,0,0,1,104,152Zm44,36a39.8,39.8,0,0,1-15,31.2,7.9,7.9,0,0,1-5,1.8,7.8,7.8,0,0,1-6.2-3,8.1,8.1,0,0,1,1.2-11.3,23.9,23.9,0,0,0,0-37.4,8,8,0,0,1,10-12.5A39.8,39.8,0,0,1,148,188Z"></path>
                                </svg>+add audio
                            </label>
                            <input type="file" name="audio" id="audio" hidden>
                        </span>

                        <span class="border-2 inline-block rounded-xl w-40 h-28 p-3 m-3 text-center">
                            <label for="document"><svg class="w-16 h-16 ml-8 text-blue-400" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-width="2" d="M14 1v7h7m0 15H3V1h12l3 3l3 3v16h0z"></path>
                                </svg>+add document</label>
                            <input type="file" name="document" id="document" hidden>
                        </span>

                        <span class="border-2 inline-block rounded-xl w-40 h-28 p-3 m-3 text-center">
                            <a href="{{ route('courses.units.tests.create',[$course,$unit]) }}">
                                <svg class="w-16 h-16 ml-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
                                    <path d="M19.903 8.586a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.952.952 0 0 0-.051-.259c-.01-.032-.019-.063-.033-.093zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"></path>
                                    <path d="M8 12h8v2H8zm0 4h8v2H8zm0-8h2v2H8z"></path>
                                </svg>+add test</a>
                        </span>
                    </div>
                </div>
                <div class="mb-6">
                    <button name="action" value="create" type="submit" class=" bg-gray-500 text-white rounded px-4 py-2 hover:bg-gray-400 ">
                        Update Unit
                    </button>
                    <a class=" bg-blue-300 rounded ml-5 px-4 py-2 hover:bg-blue-200 hover:text-white border-blue-300 text-white" href="{{ route('courses.show',$course) }}">Cancel</a>
                </div>
            </form>
        </main>

        <div class="mt-5">
            <span>Lessons</span>

            <!-- video -->
            <div class="relative bg-white shadow-md h-16 mb-3 p-3">
                <div class="inline-block w-10">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M104,60A12,12,0,1,1,92,48,12,12,0,0,1,104,60Zm60,12a12,12,0,1,0-12-12A12,12,0,0,0,164,72ZM92,116a12,12,0,1,0,12,12A12,12,0,0,0,92,116Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,116ZM92,184a12,12,0,1,0,12,12A12,12,0,0,0,92,184Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,184Z"></path>
                    </svg>
                </div>
                <div class="inline-block bg-gray-100 rounded p-2 mr-3">
                    <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="23 7 16 12 23 17 23 7"></polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                </div>
                <div class="inline-block">
                    <p class="text-sm">sdgdgsd</p>
                    <p class="text-xs">duration 03</p>
                </div>

                <!-- delete and edit lessons -->
                <span class="absolute top-4 right-3">
                    <a href="" class="text-green-400">
                        <svg class=" w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <a href="" class="text-red-400">
                        <svg class=" w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="currentColor"></path>
                        </svg>
                    </a>
                </span>
            </div>

            <!-- audio -->
            <div class="relative bg-white shadow-md h-16 mb-3 p-3">
                <div class="inline-block w-10">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M104,60A12,12,0,1,1,92,48,12,12,0,0,1,104,60Zm60,12a12,12,0,1,0-12-12A12,12,0,0,0,164,72ZM92,116a12,12,0,1,0,12,12A12,12,0,0,0,92,116Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,116ZM92,184a12,12,0,1,0,12,12A12,12,0,0,0,92,184Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,184Z"></path>
                    </svg>
                </div>
                <div class="inline-block bg-gray-100 rounded p-2 mr-3">
                    <svg class="w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M252,128a83.4,83.4,0,0,1-24.6,59.4,12.1,12.1,0,0,1-17,0,12,12,0,0,1,0-17,59.9,59.9,0,0,0,0-84.8,12,12,0,0,1,17-17A83.4,83.4,0,0,1,252,128ZM164,32V224a12,12,0,0,1-6.7,10.8A12.4,12.4,0,0,1,152,236a12.7,12.7,0,0,1-7.4-2.5L75.9,180H32a20.1,20.1,0,0,1-20-20V96A20.1,20.1,0,0,1,32,76H75.9l68.7-53.5a12.2,12.2,0,0,1,12.7-1.3A12,12,0,0,1,164,32ZM36,156H68V100H36ZM140,56.5,92,93.9v68.2l48,37.4Zm59.1,40.4a12,12,0,0,0-17,17,19.8,19.8,0,0,1,0,28.2,12,12,0,0,0,0,17,11.8,11.8,0,0,0,8.5,3.5,11.6,11.6,0,0,0,8.5-3.5,43.9,43.9,0,0,0,0-62.2Z"></path>
                    </svg>
                </div>
                <div class="inline-block">
                    <p class="text-sm">sdgdgsd</p>
                    <p class="text-xs">duration 03</p>
                </div>

                <!-- delete and edit lessons -->
                <span class="absolute top-4 right-3">
                    <a href="" class="text-green-400">
                        <svg class=" w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <a href="" class="text-red-400">
                        <svg class=" w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="currentColor"></path>
                        </svg>
                    </a>
                </span>
            </div>

            <!-- document -->
            @foreach($lessons as $lesson)
            <div class="relative bg-white shadow-md h-16 mb-3 p-3">
                <div class="inline-block w-10">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M104,60A12,12,0,1,1,92,48,12,12,0,0,1,104,60Zm60,12a12,12,0,1,0-12-12A12,12,0,0,0,164,72ZM92,116a12,12,0,1,0,12,12A12,12,0,0,0,92,116Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,116ZM92,184a12,12,0,1,0,12,12A12,12,0,0,0,92,184Zm72,0a12,12,0,1,0,12,12A12,12,0,0,0,164,184Z"></path>
                    </svg>
                </div>
                <div class="inline-block bg-gray-100 rounded p-2 mr-3">
                    <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15" fill="none">
                        <path d="M2.5 6.5V6H2v.5h.5zm4 0V6H6v.5h.5zm0 4H6v.5h.5v-.5zm7-7h.5v-.207l-.146-.147-.354.354zm-3-3l.354-.354L10.707 0H10.5v.5zM2.5 7h1V6h-1v1zm.5 4V8.5H2V11h1zm0-2.5v-2H2v2h1zm.5-.5h-1v1h1V8zm.5-.5a.5.5 0 01-.5.5v1A1.5 1.5 0 005 7.5H4zM3.5 7a.5.5 0 01.5.5h1A1.5 1.5 0 003.5 6v1zM6 6.5v4h1v-4H6zm.5 4.5h1v-1h-1v1zM9 9.5v-2H8v2h1zM7.5 6h-1v1h1V6zM9 7.5A1.5 1.5 0 007.5 6v1a.5.5 0 01.5.5h1zM7.5 11A1.5 1.5 0 009 9.5H8a.5.5 0 01-.5.5v1zM10 6v5h1V6h-1zm.5 1H13V6h-2.5v1zm0 2H12V8h-1.5v1zM2 5V1.5H1V5h1zm11-1.5V5h1V3.5h-1zM2.5 1h8V0h-8v1zm7.646-.146l3 3 .708-.708-3-3-.708.708zM2 1.5a.5.5 0 01.5-.5V0A1.5 1.5 0 001 1.5h1zM1 12v1.5h1V12H1zm1.5 3h10v-1h-10v1zM14 13.5V12h-1v1.5h1zM12.5 15a1.5 1.5 0 001.5-1.5h-1a.5.5 0 01-.5.5v1zM1 13.5A1.5 1.5 0 002.5 15v-1a.5.5 0 01-.5-.5H1z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="inline-block">
                    <p class="text-sm">{{ $lesson->name }}</p>
                    <p class="text-xs">{{ $lesson->duration }}</p>
                </div>

                <!-- delete and edit lessons -->
                <span class="absolute top-4 right-3">
                    <a href="{{ route('courses.units.tests.edit',[$course,$unit,$lesson,$lesson->lessonable]) }}" class="text-green-400">
                        <svg class=" w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('courses.units.tests.destroy',[$course,$unit,$lesson,$lesson->lessonable]) }}" class="text-red-400">
                        <svg class=" w-6 h-6 inline ml-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z" fill="currentColor"></path>
                        </svg>
                    </a>
                </span>
            </div>
            @endforeach

        </div>
    </section>
</x-app-layout>