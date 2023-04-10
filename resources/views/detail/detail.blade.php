@extends('master')
@section('content')
    <div class="container">
        <h1
            style=" font-size: 3rem; line-height: 3.25rem; text-underline-offset: 0.75rem; margin-top: 50px; margin-bottom: 50px; ">
            {{ $post->title }}</h1>
        <div class="image-detail"style=" max-width: 32rem; ">
            <img src="{{ Storage::url('images/' . $post->image) }}" alt="" class="img-detail">
        </div>
        <div class="body-detail" style="margin-top: 50px;max-width: 32rem;">
            <p>{{ $post->body }}</p>
        </div>
    </div>
@endsection
