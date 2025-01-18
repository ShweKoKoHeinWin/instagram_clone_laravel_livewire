<x-profile-layout :user="$user">
    <ul class="grid grid-cols-3 gap-3">
        @foreach($reels as $reel)

        @php
            $cover = $reel->media()->first();
        @endphp
        <li
        onclick="Livewire.dispatch(
                    'openModal',{component: 'post.view.modal', arguments: {'post': {{ $reel->id }}}}
                    )"
        class="h-32 md:h-72 w-full cursor-pointer border rounded">
            @switch($cover?->mime)
                @case('video')
                    <x-video source="{{ $cover->url }}" />
                    @break

                @case('image')
                    <img src="{{ $cover->url }}" class="w-full h-full object-cover" alt="">
                    @break

                @default

            @endswitch
        </li>
        @endforeach
    </ul>
</x-profile-layout>
