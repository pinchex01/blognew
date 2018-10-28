@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

        </div>

        <div class="col-sm-4">
            <div class="card">
                <ul class="list-group">
                    @if(count($categories) > 0)
                    @foreach($categories->all() as $category)
                    <li class="list-group-item">
                        <a href='{{ url("category/{$category->id}") }}'>
                            {{$category -> category}}</a>
                    </li>
                    @endforeach
                    @else
                    <p>No category found</p>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-sm-8">


                @forelse($posts->all() as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>{{ $post-> post_title }}</h4>
                            <img src="{{ $post->post_image }}" alt="">
                            <p>{{ $post->post_body }}</p>

                        </div>
                    </div>
                    @empty
                    <p>No post Available</p>
                @endforelse



        </div>
    </div>
</div>

@endsection
