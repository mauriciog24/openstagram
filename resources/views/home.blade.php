@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <x-post-list :posts="$posts" />
@endsection
