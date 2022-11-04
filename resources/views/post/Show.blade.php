<x-app-layout>
    <div class="py-4 mx-8">

        <div class="card lg:card-side bg-base-100 shadow-xl mb-[100px] max-h-[500px]">
            <figure class="w-[60%]"><img src={{ asset('images/' . $post->image) }} alt="Album" /></figure>
            <div class="card-body w-[40%] p-4">
                <div class="flex flex-row justify-between h-[40px] mb-2 items-center">
                    <div class="flex flex-row">
                        <div class="avatar mr-2">
                            <div class="w-8 h-fit rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="{{ asset('avatar.jpg') }}" />
                            </div>
                        </div>
                        <h2 class="card-title ml-2">{{ $post->user->name }}</h2>
                    </div>
                    <i class="fi fi-rr-menu-dots-vertical text-[20px]"></i>
                </div>
                <div class="h-[350px] px-2 py-2 overflow-y-scroll">
                    <p id="caption" class="line-clamp-3">{{ $post->caption }}</p>
                    <a onclick="readMore()" id="rMore" class="text-gray-400">read more</a>

                    <div class="mt-8">
                        @foreach ($post->comments as $comment)
                            <div class="flex gap-x-4 items-center justify-between mb-4">
                                <div id="comment" class="flex flex-row items-start gap-x-2">
                                    <img class="w-[30px] h-[30px] rounded-full"
                                        src="{{ asset('avatar.jpg') }}" alt="Rounded avatar">
                                    <div class="text-[13px]">
                                        <h4 class="font-bold">{{ $comment->user->name }}</h4>
                                        <p class="text-justify">{{ $comment->body }}</p>
                                    </div>
                                </div>

                                <div class="dropdown dropdown-left  dropdown-end">
                                    <label tabindex="0"><i
                                            class="fi fi-rr-menu-dots-vertical text-[13px]"></i></label>
                                    <ul tabindex="0"
                                        class="dropdown-content menu shadow bg-base-100 rounded-box w-fit text-[13px]">
                                        @if ($comment->user_id == auth()->id() || $comment->post->user_id == auth()->id())
                                        <li><a onclick="event.preventDefault();
                                            document.getElementById('delete-form{{ $comment->id }}').submit();"
                                                class="text-red-600">Delete</a></li>
                                        @endif
                                        <li><a>Item 2</a></li>
                                        <form id="delete-form{{ $comment->id }}" action={{ route('comment.destroy', [$comment->post, $comment]) }} method="post" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <form action={{ route('comment.store', $post) }} method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="chat" class="sr-only">Your comment</label>
                    <div class="flex items-center py-2 rounded-lg">
                        <textarea id="chat" rows="1" name="body"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Your message..."></textarea>
                        <button type="submit"
                            class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                            <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                </path>
                            </svg>
                            <span class="sr-only">Send message</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>

    {{-- bottom bar --}}
    <section id="bottom-navigation"
        class="block fixed inset-x-0 bottom-0 z-10 bg-white max-w-[900px] mx-auto rounded-lg shadow-2xl mb-4">
        <div id="tabs" class="flex justify-between">
            <a href="#"
                class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
                <i class="fi fi-rr-home text-[25px]"></i>
                <span class="tab tab-home block text-xs">Home</span>
            </a>
            <a href="#"
                class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
                <i class="fi fi-rr-apps text-[25px]"></i>
                <span class="tab tab-kategori block text-xs">Category</span>
            </a>
            <a href="#"
                class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
                <i class="fi fi-rr-search text-[25px]"></i>
                <span class="tab tab-explore block text-xs">Explore</span>
            </a>
            <a href="#"
                class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
                <i class="fi fi-rr-bookmark text-[25px]"></i>
                <span class="tab tab-whishlist block text-xs">Whishlist</span>
            </a>
            <a href=#
                class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
                <i class="fi fi-rr-user text-[25px]"></i>
                <span class="tab tab-account block text-xs">Account</span>
            </a>
        </div>
    </section>

    <script>
        function readMore() {
            var element = document.getElementById("caption");
            var rMore = document.getElementById("rMore");
            element.classList.remove("line-clamp-3");
            rMore.classList.add("hidden");
        }
    </script>

</x-app-layout>
