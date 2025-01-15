@props([
    'source' => 'https://cdn.devdojo.com/pines/videos/coast.mp4'
])

<div
    x-data="{
        playing: false,
        muted: false,
    }"
    class="relative h-full w-full m-auto"
    @click.outside="$refs.player.pause()"
    x-intersect:leave="$refs.player.pause()"
>
    <video @play="playing=true" @pause="playing=false" x-ref="player" class="h-full max-h-[500px] w-full">
        <source src="{{ $source }}" type="video/mp4">
            Your browser does not support the video tag.
    </video>

    {{-- play --}}
    <div x-cloak x-show="!playing" @click="$refs.player.play()" class="absolute z-10 inset-0 flex items-center justify-center w-full h-full cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill w-16 h-16 text-white" viewBox="0 0 16 16">
            <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
        </svg>
    </div>

    {{-- pause --}}
    <div x-show="playing" @click="$refs.player.pause()" class="absolute z-10 inset-0 flex items-center justify-center w-full h-full cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-circle-fill w-16 h-16 text-white invisible" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5m3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5"/>
        </svg>
    </div>

    <div class="absolute bottom-2 right-2 m-4 bg-gray-900 text-white rounded-lg p-1 cursor-pointer z-20">

        <svg x-cloak x-show="!muted" @click="$refs.player.muted = true; muted = true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-mute-fill w-4 h-4" viewBox="0 0 16 16">
            <path d="M6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06m7.137 2.096a.5.5 0 0 1 0 .708L12.207 8l1.647 1.646a.5.5 0 0 1-.708.708L11.5 8.707l-1.646 1.647a.5.5 0 0 1-.708-.708L10.793 8 9.146 6.354a.5.5 0 1 1 .708-.708L11.5 7.293l1.646-1.647a.5.5 0 0 1 .708 0"/>
          </svg>

        <svg x-cloak x-show="muted" @click="$refs.player.muted = false; muted = false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-volume-up-fill" viewBox="0 0 16 16">
            <path d="M11.536 14.01A8.47 8.47 0 0 0 14.026 8a8.47 8.47 0 0 0-2.49-6.01l-.708.707A7.48 7.48 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303z"/>
            <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.48 5.48 0 0 1 11.025 8a5.48 5.48 0 0 1-1.61 3.89z"/>
            <path d="M8.707 11.182A4.5 4.5 0 0 0 10.025 8a4.5 4.5 0 0 0-1.318-3.182L8 5.525A3.5 3.5 0 0 1 9.025 8 3.5 3.5 0 0 1 8 10.475zM6.717 3.55A.5.5 0 0 1 7 4v8a.5.5 0 0 1-.812.39L3.825 10.5H1.5A.5.5 0 0 1 1 10V6a.5.5 0 0 1 .5-.5h2.325l2.363-1.89a.5.5 0 0 1 .529-.06"/>
        </svg>
    </div>
</div>

{{-- <div

    x-data="{
        sources: {
            mp4: 'https://cdn.devdojo.com/pines/videos/coast.mp4',
            webm: 'https://cdn.devdojo.com/pines/videos/coast.webm',
            ogg: 'https://cdn.devdojo.com/pines/videos/coast.ogg'
        },
        playing: false,
        controls: true,
        muted: false,
        muteForced: false,
        fullscreen: false,
        ended: false,
        mouseleave: false,
        autoHideControlsDelay: 3000,
        controlsHideTimeout: null,
        poster: null,
        videoDuration: 0,
        timeDurationString: '00:00',
        timeElapsedString: '00:00',
        showTime: false,
        volume: 1,
        volumeBeforeMute: 1,
        videoPlayerReady: false,
        timelineSeek(e) {
            time = this.formatTime(Math.round(e.target.value));
            this.timeElapsedString = `${time.minutes}:${time.seconds}`;
        },
        metaDataLoaded(event) {
            this.videoDuration = event.target.duration;
            this.$refs.videoProgress.setAttribute('max', this.videoDuration);

            time = this.formatTime(Math.round(this.videoDuration));
            this.timeDurationString = `${time.minutes}:${time.seconds}`;
            this.showTime = true;
            this.videoPlayerReady = true;
        },
        togglePlay(e) {
            if (this.$refs.player.paused || this.$refs.player.ended) {
                this.playing = true;
                this.$refs.player.play();
            } else {
                this.$refs.player.pause();
                this.playing = false;
            }
        },
        toggleMute(){
            this.muted = !this.muted;
            this.$refs.player.muted = this.muted;
            if(this.muted){
                this.volumeBeforeMute = this.volume;
                this.volume = 0;
            } else {
                this.volume = this.volumeBeforeMute;
            }
        },
        timeUpdatedInterval() {
            if (!this.$refs.videoProgress.getAttribute('max'))
                this.$refs.videoProgress.setAttribute('max', $refs.player.duration);
                this.$refs.videoProgress.value = this.$refs.player.currentTime;
                time = this.formatTime(Math.round(this.$refs.player.currentTime));
                this.timeElapsedString = `${time.minutes}:${time.seconds}`;
        },
        updateVolume(e) {
            this.volume = e.target.value;
            this.$refs.player.volume = this.volume;
            if(this.volume == 0){
                this.muted = true;
            }

            if(this.muted && this.volume > 0){
                this.muted = false;
            }
        },
        timelineClicked(e) {
            rect = this.$refs.videoProgress.getBoundingClientRect();
            pos = (e.pageX - rect.left) / this.$refs.videoProgress.offsetWidth;
            this.$refs.player.currentTime = pos * this.$refs.player.duration;
        },
        handleFullscreen() {
            if (document.fullscreenElement !== null) {
                // The document is in fullscreen mode
                document.exitFullscreen();
            } else {
                // The document is not in fullscreen mode
                this.$refs.videoContainer.requestFullscreen();
            }
        },
        mousemoveVideo() {
            if(this.playing){
                this.resetControlsTimeout();
            } else {
                this.controls=true;
                clearTimeout(this.controlsHideTimeout);
            }
        },
        videoEnded() {
            this.ended = true;
            this.playing = false;
            this.$refs.player.currentTime = 0;
        },
        resetControlsTimeout() {
            this.controls = true;
            clearTimeout(this.controlsHideTimeout);
            let that = this;
            this.controlsHideTimeout = setTimeout(function(){
                that.controls=false
            }, this.autoHideControlsDelay);
        },
        formatTime(timeInSeconds) {
            result = new Date(timeInSeconds * 1000).toISOString().substring(11, 19);

            return {
                minutes: result.substring(3, 5),
                seconds: result.substring(6, 8),
            };
        }
    }"

    x-init="

        supportsVideo = document.createElement('video').canPlayType;
        if (!supportsVideo) {
            alert('This browser does not support the video element');
        }

        $refs.player.load();
        // Hide the default player controls
        $refs.player.controls = false;

        $watch('playing', (value) => {
            if (value) {
                ended = false;
                controlsHideTimeout = setTimeout(() => {
                    controls = false;
                }, autoHideControlsDelay);
            } else {
                clearTimeout(controlsHideTimeout);
                controls = true;
            }
        });

        if (!document?.fullscreenEnabled) {
            $refs.fullscreenButton.style.display = 'none';
        }

        document.addEventListener('fullscreenchange', (e) => {
            fullscreen = !!document.fullscreenElement;
        });

    "
    x-ref="videoContainer"
    @mouseleave="mouseleave=true"
    @mousemove="mousemoveVideo"
    class="relative h-[360px] min-w-[640px] overflow-hidden rounded-md aspect-video">
        <video
            x-ref="player"
            @loadedmetadata="metaDataLoaded"
            @timeupdate="timeUpdatedInterval"
            @ended="videoEnded"
            preload="metadata"
            :poster="poster"
            class="relative z-10 object-cover w-full h-full bg-black"
            crossorigin="anonymous"
            >
            <source :src="sources.mp4" type="video/mp4" />
            <source :src="sources.webm" type="video/webm" />
            <source :src="sources.ogg" type="video/ogg" />
        </video>
    <div x-show="videoPlayerReady" class="absolute inset-0 w-full h-full">
        <div x-ref="videoBackground" @click="togglePlay()" class="absolute inset-0 z-30 flex items-center justify-center w-full h-full bg-black bg-opacity-0 cursor-pointer group">
            <div
                x-show="playing"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="scale-50 opacity-100"
                x-transition:enter-end="scale-100 opacity-0"
                class="absolute z-20 flex items-center justify-center w-24 h-24 bg-blue-600 rounded-full opacity-0 bg-opacity-20"
                x-cloak>
                <svg class="w-10 h-10 translate-x-0.5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.42737 3.41611C6.46665 2.24586 4.00008 3.67188 4.00007 5.9427L4 18.0572C3.99999 20.329 6.46837 21.7549 8.42907 20.5828L18.5698 14.5207C20.4775 13.3802 20.4766 10.6076 18.568 9.46853L8.42737 3.41611Z" fill="currentColor"></path></svg>
            </div>
            <div
                x-show="!playing && !ended"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="scale-50 opacity-100"
                x-transition:enter-end="scale-100 opacity-0"
                class="absolute z-20 flex items-center justify-center w-24 h-24 bg-blue-600 rounded-full opacity-0 bg-opacity-20"
                x-cloak>
                <svg class="w-10 h-10 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8 3C8.55228 3 9 3.44772 9 4L9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20L7 4C7 3.44772 7.44772 3 8 3ZM16 3C16.5523 3 17 3.44772 17 4V20C17 20.5523 16.5523 21 16 21C15.4477 21 15 20.5523 15 20V4C15 3.44772 15.4477 3 16 3Z" fill="currentColor"></path></svg>
            </div>
            <div class="absolute z-10 duration-300 ease-out group-hover:scale-110">
                <button
                    x-show="!playing"
                    x-transition:enter="transition ease-in delay-200 duration-300"
                    x-transition:enter-start="opacity-0 scale-75"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-out duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="flex items-center justify-center w-12 h-12 text-white duration-150 ease-out bg-blue-600 rounded-full cursor-pointer bg-opacity-80" type="button">
                    <svg  class="w-5 h-5 translate-x-px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.42737 3.41611C6.46665 2.24586 4.00008 3.67188 4.00007 5.9427L4 18.0572C3.99999 20.329 6.46837 21.7549 8.42907 20.5828L18.5698 14.5207C20.4775 13.3802 20.4766 10.6076 18.568 9.46853L8.42737 3.41611Z" fill="currentColor" x-cloak></path></svg>
                </button>
            </div>
        </div>
        <div x-show="controls"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="-translate-y-full"
            class="absolute top-0 left-0 z-20 w-full h-1/4 opacity-20 bg-gradient-to-b from-black to-transparent" x-cloak>
        </div>
        <div x-show="controls"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full"
            class="absolute bottom-0 left-0 z-20 w-full h-1/4 opacity-20 bg-gradient-to-b from-transparent to-black" x-cloak>
        </div>
        <div x-show="controls"
            @click="resetControlsTimeout"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="-translate-y-full"
            class="absolute top-0 left-0 z-40 flex items-center w-full h-12 text-white" x-cloak>
            <div class="absolute right-0 top-0 mr-0.5 mt-0.5 flex items-center">
                <div class="flex items-center h-auto group">
                    <button @click="toggleMute()" type="button" class="flex items-center justify-center w-6 h-auto duration-150 ease-out opacity-80 hover:opacity-100">
                        <svg x-show="!muted" class="w-[18px] h-[18px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" x-cloak><path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM18.584 5.106a.75.75 0 011.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 11-1.06-1.06 8.25 8.25 0 000-11.668.75.75 0 010-1.06z" /><path d="M15.932 7.757a.75.75 0 011.061 0 6 6 0 010 8.486.75.75 0 01-1.06-1.061 4.5 4.5 0 000-6.364.75.75 0 010-1.06z" /></svg>
                        <svg x-show="muted" class="w-[18px] h-[18px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" x-cloak><path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 001.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06zM17.78 9.22a.75.75 0 10-1.06 1.06L18.44 12l-1.72 1.72a.75.75 0 001.06 1.06l1.72-1.72 1.72 1.72a.75.75 0 101.06-1.06L20.56 12l1.72-1.72a.75.75 0 00-1.06-1.06l-1.72 1.72-1.72-1.72z" /></svg>
                    </button>
                    <div class="relative h-1.5 w-0 mx-0 group-hover:mx-1 rounded-full group-hover:w-12 invisible group-hover:visible w-0 ease-out duration-300">
                        <input
                            x-ref="volume"
                            @input="updateVolume(event)"
                            type="range" min="0" max="1" :value="volume" step="0.01"
                            class="w-full h-full appearance-none flex items-center cursor-pointer bg-transparent z-30
                                [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-0 [&::-webkit-slider-thumb]:w-2 [&::-webkit-slider-thumb]:h-2 [&::-webkit-slider-thumb]:appearance-none
                                [&::-moz-range-thumb]:bg-white [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-0 [&::-moz-range-thumb]:w-2 [&::-moz-range-thumb]:h-2 [&::-moz-range-thumb]:appearance-none
                                [&::-ms-thumb]:bg-white [&::-ms-thumb]:rounded-full [&::-ms-thumb]:border-0 [&::-ms-thumb]:w-2 [&::-ms-thumb]:h-2 [&::-ms-thumb]:appearance-none
                                [&::-webkit-slider-runnable-track]:bg-white [&::-webkit-slider-runnable-track]:bg-opacity-30 [&::-webkit-slider-runnable-track]:rounded-full [&::-webkit-slider-runnable-track]:overflow-hidden [&::-moz-range-track]:bg-neutral-200 [&::-moz-range-track]:rounded-full [&::-ms-track]:bg-neutral-200 [&::-ms-track]:rounded-full
                                [&::-moz-range-progress]:bg-white [&::-moz-range-progress]:bg-opacity-80 [&::-moz-range-progress]:rounded-full [&::-ms-fill-lower]:bg-white [&::-ms-fill-lower]:bg-opacity-80 [&::-ms-fill-lower]:rounded-full [&::-webkit-slider-thumb]:shadow-[-995px_0px_0px_990px_rgba(255,_255,_255,_0.8)]
                        ">
                    </div>
                </div>
                <button x-ref="fullscreenButton" @click="handleFullscreen" class="flex items-center justify-center w-10 h-10 duration-150 ease-out scale-90 opacity-80 hover:opacity-100 hover:scale-100" type="button">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.72685 5C5.77328 5 5 5.77318 5 6.72727V9C5 9.55228 4.55228 10 4 10C3.44772 10 3 9.55228 3 9V6.72727C3 4.6689 4.66842 3 6.72685 3H9C9.55228 3 10 3.44772 10 4C10 4.55228 9.55228 5 9 5H6.72685ZM14 4C14 3.44772 14.4477 3 15 3H17.2727C19.3312 3 21 4.66876 21 6.72727V9C21 9.55228 20.5523 10 20 10C19.4477 10 19 9.55228 19 9V6.72727C19 5.77333 18.2267 5 17.2727 5H15C14.4477 5 14 4.55228 14 4ZM4 14C4.55228 14 5 14.4477 5 15V17.2727C5 18.2268 5.77328 19 6.72685 19H9C9.55228 19 10 19.4477 10 20C10 20.5523 9.55228 21 9 21H6.72685C4.66842 21 3 19.3311 3 17.2727V15C3 14.4477 3.44772 14 4 14ZM20 14C20.5523 14 21 14.4477 21 15V17.2727C21 19.3312 19.3312 21 17.2727 21H15C14.4477 21 14 20.5523 14 20C14 19.4477 14.4477 19 15 19H17.2727C18.2267 19 19 18.2267 19 17.2727V15C19 14.4477 19.4477 14 20 14Z" fill="currentColor"></path></svg>
                </button>
            </div>
        </div>
        <div x-show="controls"
            @click="resetControlsTimeout"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-y-0"
            x-transition:leave-end="translate-y-full"
            class="absolute bottom-0 left-0 z-40 w-full h-12" x-cloak>
            <div class="absolute bottom-0 z-30 w-full px-2.5 -translate-y-8">
                <div class="relative w-full h-1 rounded-full">
                    <input
                        x-ref="videoProgress"
                        @click="timelineClicked"
                        @input="timelineSeek(event)"
                        type="range" min="0" max="100" value="0" step="any"
                        class="w-full h-full appearance-none flex items-center cursor-pointer bg-transparent z-30
                            [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:border-0 [&::-webkit-slider-thumb]:w-1.5 [&::-webkit-slider-thumb]:h-1.5 [&::-webkit-slider-thumb]:appearance-none
                            [&::-moz-range-thumb]:bg-white [&::-moz-range-thumb]:rounded-full [&::-moz-range-thumb]:border-0 [&::-moz-range-thumb]:w-1.5 [&::-moz-range-thumb]:h-1.5 [&::-moz-range-thumb]:appearance-none
                            [&::-ms-thumb]:bg-white [&::-ms-thumb]:rounded-full [&::-ms-thumb]:border-0 [&::-ms-thumb]:w-1.5 [&::-ms-thumb]:h-1.5 [&::-ms-thumb]:appearance-none
                            [&::-webkit-slider-runnable-track]:bg-white [&::-webkit-slider-runnable-track]:bg-opacity-30 [&::-webkit-slider-runnable-track]:rounded-full [&::-webkit-slider-runnable-track]:overflow-hidden [&::-moz-range-track]:bg-neutral-200 [&::-moz-range-track]:rounded-full [&::-ms-track]:bg-neutral-200 [&::-ms-track]:rounded-full
                            [&::-moz-range-progress]:bg-blue-600 [&::-moz-range-progress]:rounded-full [&::-ms-fill-lower]:bg-blue-600 [&::-ms-fill-lower]:rounded-full [&::-webkit-slider-thumb]:shadow-[-995px_0px_0px_990px_#2463eb]
                    ">
                </div>
            </div>
            <div class="absolute bottom-0 left-0 z-10 flex items-center w-full h-8 text-white">

                <div x-show="showTime" class="flex items-center justify-between w-full mx-3 font-mono text-xs opacity-80 hover:opacity-100" x-cloak>
                    <time x-ref="timeElapsed" x-text="timeElapsedString">00:00</time>
                    <time x-ref="timeDuration" x-text="timeDurationString">00:00</time>
                </div>
            </div>
        </div>
    </div>
</div> --}}
