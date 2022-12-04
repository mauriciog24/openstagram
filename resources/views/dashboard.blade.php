@extends('layouts.app')

@section('title')
    {{ $user->username }}'s Profile
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ asset('img/user.svg') }}" alt="User Image">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center py-10 md:items-start md:py-10">
                <p class="text-gray-700 text-2xl">
                    {{ $user->username }}
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">
                        Followers
                    </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Following
                    </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">
                        Posts
                    </span>
                </p>
            </div>
        </div>
    </div>
@endsection
