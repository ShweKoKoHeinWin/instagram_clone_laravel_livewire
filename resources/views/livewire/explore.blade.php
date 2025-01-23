<div class="my-5 lg-8">
    <ul class="grid grid-cols-3 sm:gap-3">
        @foreach($posts as $post)
        @php
            $cover = $post->media()->first();
        @endphp
        <li onclick="Livewire.dispatch(
            'openModal',{component: 'post.view.modal', arguments: {'post': {{ $post->id }}}}
            )"
        class="h-28 sm:h-80 w-full cursor-pointer border rounded bg-black relative items-center flex justify-center group">
            {{-- hover show likes and comments --}}
            <div class="hidden group-hover:flex transition-all absolute inset-x-0 m-auto z-10 max-w-fit items-center gap-2">
                {{-- like counts --}}
                <div class="flex items-center gap-2 text-white font-bold">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                          </svg>
                    </span>

                    {{ $post->likers->count() }}
                </div>

                 {{-- comment counts --}}
                 <div class="flex items-center gap-2 text-white font-bold">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                          </svg>
                    </span>
                    {{ $post->comments->count() }}
                </div>
            </div>

            {{-- icon --}}
            @if($post->type == 'post' && $post->media->count() > 1)
            <div class="absolute top-4 right-4 z-10 text-white">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="24" viewBox="0 0 24 24" width="24"><g fill="#292d32"><path d="m16 12.9v4.2c0 3.5-1.4 4.9-4.9 4.9h-4.2c-3.5 0-4.9-1.4-4.9-4.9v-4.2c0-3.5 1.4-4.9 4.9-4.9h4.2c3.5 0 4.9 1.4 4.9 4.9z"/><path d="m17.0998 2h-4.2c-3.08312 0-4.52906 1.09409-4.83029 3.73901-.06302.55334.39525 1.01099.95216 1.01099h2.07813c4.2 0 6.15 1.95 6.15 6.15v2.0781c0 .5569.4576 1.0152 1.011.9522 2.6449-.3013 3.739-1.7472 3.739-4.8303v-4.2c0-3.5-1.4-4.9-4.9-4.9z"/></g></svg>
                </span>
            </div>
            @endif

            @if($post->type == 'reel')
            <div class="absolute top-4 right-4 z-10 text-white">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625Zm1.5 0v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5A.375.375 0 0 0 3 5.625Zm16.125-.375a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5A.375.375 0 0 0 21 7.125v-1.5a.375.375 0 0 0-.375-.375h-1.5ZM21 9.375A.375.375 0 0 0 20.625 9h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5ZM4.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5ZM3.375 15h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h1.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 4.875 9h-1.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Zm4.125 0a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z" clip-rule="evenodd" />
                      </svg>

                </span>
            </div>
            @endif

            @switch($cover?->mime)
                @case('video')
                    <x-video :controls="false" :cover="true" source="{{ $cover->url }}" />
                    @break
                @case('image')
                    <img src="{{ $cover->url }}" alt="" class="h-full w-full object-cover">
                    @break
                @default

            @endswitch
        </li>
        @endforeach
    </ul>
</div>
