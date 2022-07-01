<x-app-layout>
    <section class="flex-auto m-5">

        <!-- links -->
        <div class="pt-5">
            <a class=" text-blue-800 font-bold text-xl" href="">Units</a><strong class="px-2 font-bold text-xl ">></strong><span class="font-bold text-xl">Update Unit</span>
        </div>

        <!-- form to create users -->
        <main class="w-full mt-5 border border-gray-50 p-6 bg-white relative">
            <form method="post" action="{{ route('units.update',$unit) }}" class="mt-5">
                @csrf
                <div class="inputs-container mb-6 relative">

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="title">Name of the Unit<font class="text-red-500 pl-2">*</font></label>
                    <input class="border border-grey-400 p-2 w-1/2 mb-2 rounded-md" type="text" name="title" value="{{ old('title')}}" placeholder="title">
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="mb-2 text-xs uppercase block font-bold text-gray-700" for="description">Add description to the unit<font class="text-red-500 pl-2">*</font></label>
                    <textarea name="description" id="" cols="55" rows="5" placeholder="description"></textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div class="absolute right-0 top-0 w-80 border-2 h-80">
                        <span class="border-2 inline-block w-36 h-32">
                            <label for="video">
                                <svg class="w-16 h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M214,88a6,6,0,0,0-1.8-4.3l-56-55.9A5.6,5.6,0,0,0,152,26H56A14,14,0,0,0,42,40v88a6,6,0,0,0,12,0V40a2,2,0,0,1,2-2h90V88a6,6,0,0,0,6,6h50V216a2,2,0,0,1-2,2H176a6,6,0,0,0,0,12h24a14,14,0,0,0,14-14V88ZM158,46.5,193.5,82H158ZM147.2,158.9a6.2,6.2,0,0,0-5.9-.3L118,170.3V168a14,14,0,0,0-14-14H48a14,14,0,0,0-14,14v40a14,14,0,0,0,14,14h56a14,14,0,0,0,14-14v-2l23.2,12.5a6.4,6.4,0,0,0,2.8.7,5.9,5.9,0,0,0,3.1-.9,6,6,0,0,0,2.9-5.1V164A6.1,6.1,0,0,0,147.2,158.9ZM104,210H48a2,2,0,0,1-2-2V168a2,2,0,0,1,2-2h56a2,2,0,0,1,2,2v28h0v12A2,2,0,0,1,104,210Zm34-6.9-20-10.7v-8.7l20-10Z"></path>
                                </svg>+add video
                            </label>
                            <input type="file" name="video" id="video" hidden>
                        </span>

                        <span class="border-2 inline-block w-36 h-32">
                            <label for="audio">
                                <svg class="w-16 h-16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor">
                                    <path d="M213.7,82.3l-56-56A8.1,8.1,0,0,0,152,24H56A16,16,0,0,0,40,40v88a8,8,0,0,0,16,0V40h88V88a8,8,0,0,0,8,8h48V216H168a8,8,0,0,0,0,16h32a16,16,0,0,0,16-16V88A8.1,8.1,0,0,0,213.7,82.3ZM160,80V51.3L188.7,80Zm-56,72v72a7.9,7.9,0,0,1-4.6,7.2,6.8,6.8,0,0,1-3.4.8,7.5,7.5,0,0,1-5.1-1.9L69.1,212H48a8,8,0,0,1-8-8V172a8,8,0,0,1,8-8H69.1l21.8-18.1a7.8,7.8,0,0,1,8.5-1.1A7.9,7.9,0,0,1,104,152Zm44,36a39.8,39.8,0,0,1-15,31.2,7.9,7.9,0,0,1-5,1.8,7.8,7.8,0,0,1-6.2-3,8.1,8.1,0,0,1,1.2-11.3,23.9,23.9,0,0,0,0-37.4,8,8,0,0,1,10-12.5A39.8,39.8,0,0,1,148,188Z"></path>
                                </svg>+add audio
                            </label>
                            <input type="file" name="audio" id="audio" hidden>
                        </span>

                        <span class="border-2 inline-block w-36 h-32">
                            <label for="document"><svg class="w-16 h-16" viewBox="0 0 24 24">
                                    <path fill="none" stroke="currentColor" stroke-width="2" d="M14 1v7h7m0 15H3V1h12l3 3l3 3v16h0z"></path>
                                </svg>+add document</label>
                            <input type="file" name="document" id="document" hidden>
                        </span>

                        <span class="border-2 inline-block w-36 h-32">
                            <a href="">
                                <svg class="w-16 h-16" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="none" viewBox="0 0 24 24">
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
                    <a class=" bg-blue-100 rounded ml-5 px-4 py-2 hover:bg-blue-300 hover:text-white border-blue-300 " href="">Cancel</a>
                </div>
            </form>
        </main>
    </section>
</x-app-layout>