<div class="w-full p-3"
    x-init="
        Echo.private('users.{{ auth()->user()->id }}')
        .notification((notification) => {
            @this.$refresh();
        });
    "

>
    <h3 class="font-bold text-4xl">Notifications</h3>
    <main class="my-7 w-full">
        <div class="space-y-5">
            @foreach($notifications as $noti)
                @php
                    $user = \App\Models\User::find($noti->data['user_id']);
                @endphp
                @switch($noti->type)
                    @case('App\Notifications\NewFollowerNotification')
                        {{-- New Follow --}}
                        <div class="grid grid-cols-12 gap-2 w-full">
                            <a href="{{ route('profile.home', $user->user_name) }}" class="col-span-2">
                                <x-avatar src="https://placehold.co/600x600" class="w-10 h-10" />
                            </a>
                            <div class="col-span-7 font-medium">
                                <a href="{{ route('profile.home', $user->user_name) }}"><strong>{{ $user->name }}</strong></a> Start following you
                                <span class="text-gray-400">{{ $noti->created_at->shortAbsoluteDiffForHumans() }}</span>
                            </div>
                            <div class="col-span-3">
                                @if(auth()->user()->isFollowing($user))
                                    <button wire:click="toggleFollow({{ $user->id }})" class="font-bold text-sm bg-gray-100 text-black/90 px-3 py-1 rounded-lg">Following</button>
                                @else
                                    <button wire:click="toggleFollow({{ $user->id }})" class="font-bold text-sm bg-blue-500 text-white px-3 py-1 rounded-lg">Follow</button>
                                @endif
                            </div>
                        </div>
                    @break

                    @case('App\Notifications\PostLikedNotification')
                        @php
                            $post = App\Models\Post::find($noti->data['post_id']);
                            $cover = $post->media->first();
                        @endphp
                        {{-- Post liked --}}
                        <div class="grid grid-cols-12 gap-2 w-full">
                            <a href="{{ route('profile.home', $user->user_name) }}" class="col-span-2">
                                <x-avatar src="https://placehold.co/600x600" class="w-10 h-10" />
                            </a>
                            <div class="col-span-7 font-medium">
                                <a href="{{ route('profile.home', $user->user_name) }}"><strong>{{ $user->name }}</strong></a>
                                <a href="{{ route('post.view', $post->id) }}">
                                    Liked your post
                                    <span class="text-gray-400">{{ $noti->created_at->shortAbsoluteDiffForHumans() }}</span>
                                </a>
                            </div>
                            <a class="col-span-3 ml-auto">
                                @switch($cover->mime)
                                    @case('video')
                                        <x-video source="{{ $cover->url }}" :controls="false" />
                                        @break
                                    @case('image')
                                        <img src="{{ $cover->url }}" alt="" class="w-10 h-11 object-cover">
                                        @break
                                    @default

                                @endswitch
                            </a>
                        </div>
                    @break

                    @case('App\Notifications\NewCommentNotification')
                        @php
                            $comment = App\Models\Comment::find($noti->data['comment_id']);
                            $cover = $comment->commentable->media->first();
                        @endphp
                        {{-- New Comment --}}
                        <div class="grid grid-cols-12 gap-2 w-full">
                            <a href="{{ route('profile.home', $user->user_name) }}" class="col-span-2">
                                <x-avatar src="https://placehold.co/600x600" class="w-10 h-10" />
                            </a>
                            <div class="col-span-7 font-medium">
                                <a href="{{ route('profile.home', $user->user_name) }}"><strong>{{ $user->name }}</strong></a>
                                <a href="{{ route('post.view', $comment->commentable->id) }}">
                                    Commented: {{ $comment->body }}
                                    <span class="text-gray-400">{{ $noti->created_at->shortAbsoluteDiffForHumans() }}</span>
                                </a>
                            </div>
                            <a class="col-span-3 ml-auto">
                                @switch($cover->mime)
                                    @case('video')
                                        <x-video source="{{ $cover->url }}" :controls="false" />
                                        @break
                                    @case('image')
                                        <img src="{{ $cover->url }}" alt="" class="w-10 h-11 object-cover">
                                        @break
                                    @default

                                @endswitch
                            </a>
                        </div>
                    @break

                    @endswitch
            @endforeach
        </div>
    </main>
</div>
