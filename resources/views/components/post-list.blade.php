<div>
    @if ($posts->count())
        {{-- Posts section --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                {{-- Post image --}}
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img
                            src="{{ asset('uploads') . '/' . $post->image }}"
                            alt="{{ $post->title }} - post image"
                        />
                    </a>
                </div>
            @endforeach
        </div>

        {{-- Posts pagination --}}
        <div class="my-10">
            {{ $posts->links() }}
        </div>
    @else
        {{-- No Posts message --}}
        <p class="text-center">
            No posts available
        </p>
    @endif
</div>
