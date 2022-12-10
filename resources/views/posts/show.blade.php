@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            {{-- Post image --}}
            <img
                src="{{ asset('uploads') . '/' . $post->image }}"
                alt="{{ $post->title }} - post image"
            />

            <div class="p-3 flex items-center gap-4">
                @auth
                    {{-- Likes section --}}
                    <livewire:like-post :post="$post" />
                @endauth
            </div>

            <div>
                {{-- Post's User --}}
                <p class="font-bold">
                    {{ $post->user->username }}
                </p>

                {{-- Post date --}}
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>

                {{-- Post description --}}
                <p class="mt-5">
                    {{ $post->description }}
                </p>

                @auth
                    {{-- Delete Post button --}}
                    @if ($post->user_id === auth()->user()->id)
                        <form
                            action="{{ route('posts.destroy', $post) }}"
                            method="POST"
                        >
                            @method('DELETE')
                            @csrf

                            <input
                                type="submit"
                                value="Delete Post"
                                class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                            />
                        </form>
                    @endif
                @endauth
            </div>
        </div>

        {{-- Comments section --}}
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">
                        Add a Comment
                    </p>

                    {{-- Successful Comment message --}}
                    @if (session('message'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('message') }}
                        </div>
                    @endif

                    {{-- Comment form --}}
                    <form
                        action="{{ route('comments.store', ['post' => $post, 'user' => $user]) }}"
                        method="POST"
                    >
                        @csrf

                        {{-- Comment textarea --}}
                        <div class="mb-5">
                            <label
                                for="comment"
                                class="mb-2 block uppercase text-gray-500 font-bold"
                            >
                                Comment
                            </label>

                            <textarea
                                id="comment"
                                name="comment"
                                placeholder="Add a comment"
                                class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror"
                            ></textarea>

                            @error('comment')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Submit button --}}
                        <input
                            type="submit"
                            value="Comment"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                        />
                    </form>
                @endauth

                {{-- All Post Comments --}}
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b">
                                {{-- Comment's User --}}
                                <a
                                    href="{{ route('posts.index', $comment->user) }}"
                                    class="font-bold"
                                >
                                    {{ $comment->user->username }}
                                </a>

                                {{-- Comment text --}}
                                <p>
                                    {{ $comment->comment }}
                                </p>

                                {{-- Comment date --}}
                                <p class="text-sm text-gray-500">
                                    {{ $comment->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">
                            This post doesn't have comments yet
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
