@extends('master')
@section('content')
    <div class="parent">
        <div class="celebrity flex-center">
            <a href="#">Celebrity</a>
        </div>
        <div class="parent-celebrity flex-center">
            <h1>{{ $categoriesName->name }}</h1>
        </div>
        <div class="flex-center titile">Get the latest parents news and features from PEOPLE.com, including advice from
            celebrity parents and breaking news about who's expecting, who just gave birth and more adventures in parenting.
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($latestPosts as $post)
                <div class="col-4 mt-5">
                    <div class="detail-post">
                        <a href="{{ route('post-view', ['slugParent' => $categoriesName->slug, 'slug' => $post->slug]) }}">
                            <div class="img-detail">
                                <img src="{{ Storage::url('images/' . $post->image) }}" alt=""
                                    style="max-height: 233px;">
                            </div>
                            <div class="title-post">
                                <div class="card__content" data-tag="Parents">
                                    <div class="card__header"></div>
                                    <span class="card__title"><span
                                            class="card__title-text ">{{ $post->title }}</span></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
