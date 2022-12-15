<x-app-layout>
    <div class="py-4 flex">

        <div class="mx-auto sm:px-6 lg:px-8 w-full flex flex-row justify-between mb-[100px]">
            <div class="columns-3">
                @foreach ($posts as $post)
                    <a href={{ route('post.show', $post) }}>
                        <div class="card bg-base-100 shadow-xl mb-4">
                            <div class="card-body py-4 flex flex-row justify-between px-4">
                                <div class="flex flex-row">
                                    <div class="avatar mr-2">
                                        <div class="w-8 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                            <img src="https://source.unsplash.com/ie6quq8VdYI" />
                                        </div>
                                    </div>
                                    <h2 class="card-title ml-2">{{ $post->user->name }}</h2>
                                </div>
                                <span class="text-gray-500 text-[12px] my-auto">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <figure><img src={{ asset('images/'.$post->image) }} alt="Shoes" /></figure>
                            <div class="card-body py-2 px-4">
                                <div class="flex justify-between">
                                    <div class="flex justify-between gap-x-4">
                                        <i class="fa-regular fa-heart text-[25px]"></i>
                                        <i class="fa-regular fa-comment text-[25px]"></i>
                                    </div>
                                    <div class="">
                                        <i class="fa-regular fa-bookmark text-[25px]"></i>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="font-bold line-clamp-2 mb-2">{{ $post->user->name }} <span class="font-normal">{{ $post->caption }}</span></p>
                                    @if ($post->comments_count > 1)
                                        <span class="text-gray-500 text-[12px] my-auto">View all {{ $post->comments_count }} comments</span>
                                    @endif

                                    @if ($post->comments_count == 1)
                                        <span class="text-gray-500 text-[12px] my-auto">View {{ $post->comments_count }} comment</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="min-w-[280px] bg-white rounded-xl shadow-xl min-h-[290px] h-fit ml-4 p-4">
                <h1 class="font-semibold mb-4">Who is to follow you</h1>
                <div class="flex flex-col gap-y-4 mb-4">
                    <div class="flex flex-row gap-4 items-center justify-between">
                        <div class="flex flex-row gap-x-2">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                <img src="https://placeimg.com/192/192/people" />
                                </div>
                            </div>
                            <div>
                                <h1 class="font-semibold">Steff Jack</h1>
                                <p class="text-gray-600 text-[12px]">@steffjack20</p>
                            </div>
                        </div>
                        <button type="button" class="text-white bg-[#1873ea] hover:bg-[#1877f3] focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2 text-center mb-2 dark:bg-[#1877f3] dark:hover:bg-[#1873ea] dark:focus:ring-purple-900">Follow</button>
                    </div>
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-row gap-x-2">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                <img src="https://placeimg.com/192/192/people" />
                                </div>
                            </div>
                            <div>
                                <h1 class="font-semibold">Justin Tim</h1>
                                <p class="text-gray-600 text-[12px]">@justintim90</p>
                            </div>
                        </div>
                        <button type="button" class="text-white bg-[#1873ea] hover:bg-[#1877f3] focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2 text-center mb-2 dark:bg-[#1877f3] dark:hover:bg-[#1873ea] dark:focus:ring-purple-900">Follow</button>
                    </div>
                    <div class="flex flex-row gap-4 items-center justify-between">
                        <div class="flex flex-row gap-x-2">
                            <div class="avatar">
                                <div class="w-12 rounded-full">
                                <img src="https://placeimg.com/192/192/people" />
                                </div>
                            </div>
                            <div>
                                <h1 class="font-semibold line-clamp-1">Anggel Austin</h1>
                                <p class="text-gray-600 text-[12px]">@angell23</p>
                            </div>
                        </div>
                        <button type="button" class="text-white bg-[#1873ea] hover:bg-[#1877f3] focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2 text-center mb-2 dark:bg-[#1877f3] dark:hover:bg-[#1873ea] dark:focus:ring-purple-900">Follow</button>
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="" class="text-[#1873ea] font-semibold">Show more</a>
                </div>
            </div>
        </div>
        @foreach ($notifs as $notif)
            <p>{{ $notif->data['comment']['body'] }}</p>
        @endforeach


        {{-- btn add --}}
        <label title="Contact Sale" for="add-post"
            class="fixed z-90 bottom-10 right-8 bg-[#1873ea] w-20 h-20 rounded-full drop-shadow-lg flex justify-center items-center text-white text-4xl hover:bg-blue-700 hover:drop-shadow-2xl hover:scale-110 duration-300">
            <i class="fa-solid fa-plus text-white"></i>
        </label>

        {{-- modal add post --}}
        <input type="checkbox" id="add-post" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box relative">
                <h3 class="font-bold text-lg">Add New Post</h3>
                <label for="add-post" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <form action={{ route('post.store') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-control">
                            <textarea name="caption" placeholder="Post something ..." rows="5" class="textarea textarea-bordered"></textarea>
                        </div>
                        <div class="form-control">
                            <input type="file" name="image" class="file-input w-full max-w-xs" />
                        </div>
                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- bottom bar --}}
    <section id="bottom-navigation" class="block fixed inset-x-0 bottom-0 z-10 bg-white max-w-[900px] mx-auto rounded-lg shadow-2xl mb-4">
		<div id="tabs" class="flex justify-between">
			<a href="#" class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
				<i class="fi fi-rr-home text-[25px]"></i>
				<span class="tab tab-home block text-xs">Home</span>
			</a>
			<a href="#" class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
				<i class="fi fi-rr-apps text-[25px]"></i>
				<span class="tab tab-kategori block text-xs">Category</span>
			</a>
			<a href="#" class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
				<i class="fi fi-rr-search text-[25px]"></i>
				<span class="tab tab-explore block text-xs">Explore</span>
			</a>
			<a href="#" class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
				<i class="fi fi-rr-bookmark text-[25px]"></i>
				<span class="tab tab-whishlist block text-xs">Whishlist</span>
			</a>
			<a href=# class="w-full focus:text-[#1873ea] hover:text-[#1873ea] justify-center inline-block text-center pt-4">
				<i class="fi fi-rr-user text-[25px]"></i>
				<span class="tab tab-account block text-xs">Account</span>
			</a>
		</div>
	</section>

</x-app-layout>
