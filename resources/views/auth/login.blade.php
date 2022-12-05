@extends('layouts.app')

@section('title')
    Login on OpenStagram
@endsection

@section('content')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        {{-- User Login image --}}
        <div class="md:w-6/12 p-5">
            <img
                src="{{ asset('img/login.jpg') }}"
                alt="User Login image"
            />
        </div>

        {{-- Login form --}}
        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form
                action="{{ route('login') }}"
                method="POST"
                novalidate
            >
                @csrf

                {{-- Failed Login message --}}
                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('message') }}
                    </p>
                @endif

                {{-- Email field --}}
                <div class="mb-5">
                    <label
                        for="email"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Your email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}"
                    />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password field --}}
                <div class="mb-5">
                    <label
                        for="password"
                        class="mb-2 block uppercase text-gray-500 font-bold"
                    >
                        Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Your password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me checkbox --}}
                <div class="mb-5">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                    />

                    <label
                        for="remember"
                        class="text-gray-500 text-sm"
                    >
                        Remember Me
                    </label>
                </div>

                {{-- Submit button --}}
                <input
                    type="submit"
                    value="Login"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection
