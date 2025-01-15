<div class="bg-white lg:h-[600px] flex flex-col border gap-y-4 px-5">
    @if ($errors->any()) <div class="alert alert-danger"> <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> </div> @endif
    <header class="w-full py-2 border-b">
        <div class="flex justify-between">
            <button wire:click="$dispatch('closeModal')" class="font-bold">X</button>

            <div class="text-lg font-bold">
                Create New Post
            </div>

            <button @disabled(count($media) == 0) wire:loading.attr='disabled' wire:click="submit" class="text-blue-500 font-bold">
                Share
            </button>
        </div>
    </header>

    <main class="grid grid-cols-12 gap-3 w-full h-full overflow-hidden">
        <aside class="lg:col-span-7 m-auto items-center w-full overflow-hidden overflow-y-scroll">

        @if(count($media) == 0)
            <label for="customFile" class="m-auto flex flex-col max-w-fit gap-3 cursor-pointer">
                <input wire:model.live="media" id="customFile" type="file" class="sr-only" multiple accept=".jpg,.jpeg,.png,.mp4" >
                <span class="m-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                      </svg>

                </span>
                <span class="bg-blue-500 text-white text-sm rounded-lg p-2 px-4">
                    Upload files from Computer
                </span>
            </label>
        @else
            {{-- SHow WHen file count > 0 --}}
            <div class="flex overflow-x-scroll w-[500px] h-96 snap-x snap-mandatory gap-2 px-2">
                @foreach($media as $key => $file)
                <div class="w-full h-full shrink-0 snap-always snap-center">
                    @if(strpos($file->getMimeType(), 'image') !== false)
                        <img src="{{ $file->temporaryUrl() }}" alt="" class="w-full h-full object-contain">
                    @elseif(strpos($file->getMimeType(), 'video') !== false)
                        <x-video :source="$file->temporaryUrl()" />
                    @else

                    @endif
                </div>
                @endforeach
            </div>
        @endif
        </aside>

        <aside class="lg:col-span-5 h-full border-l p-3 flex gap-4 flex-col overflow-hidden overflow-y-scroll">
            <div class="flex items-center gap-2">
                <x-avatar class="w-9 h-9"></x-avatar>
                <h5 class="font-bold">{{ fake()->name }}</h5>
            </div>

            <div>
                <textarea wire:model="description" name="" id="" cols="30" rows="10"
                    placeholder="Add a caption"
                    class="border-0  focus:border-0 px-0 w-full rounded-lg bg-white h-32 focus:outline-none focus:ring-0"
                ></textarea>
            </div>

            <div class="w-full items-center">
                <input wire:model="location" type="text" placeholder="Add a location" class="border-0 focus:border-0 px-0 w-full rounded-lg bg-white focus:outline-none focus:ring-0">
            </div>

            <div>
                <h6 class="text-gray-500 font-medium text-base">Advance settings</h6>

                <ul>
                    <li>
                        <div class="flex items-center gap-3 justify-between">
                            <span>Hide like and view counts on the post</span>


                            <label class="inline-flex items-center cursor-pointer">
                                <input wire:model="hide_like_view" type="checkbox" value="" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>

                        </div>
                    </li>

                    <li>
                        <div class="flex items-center gap-3 justify-between">
                            <span>Turn off commenting</span>

                            <label class="inline-flex items-center cursor-pointer">
                                <input wire:model="allow_commenting" type="checkbox" value="" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            </label>

                        </div>
                    </li>
                </ul>
            </div>
        </aside>
    </main>
</div>
