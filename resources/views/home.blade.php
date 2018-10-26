@extends('layouts.app')

@section('content')
<style type="text/css">
    .avatar {
        border-radius: 100%;
        max-width: 100px;
    }

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{$error}}</div>
            @endforeach
            @endif
            @if(session('response'))
            <div class="alert alert-success"> {{session('response')}} </div>
            @endif

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
        </div>

        <div class="col-sm-4">
            <div class="card">

                <div class="col-sm-8">
                    @if(!empty($profile))
                    <img class ="profilepic" src="{{ $profile -> profile_pic }} " class="avatar" alt="">
                    @else
                    <img src="{{ url('images/avatar.jpg') }} " class="avatar" alt="">

                    @endif

                    @if(!empty($profile))
                    <p class="lead"> {{ $profile -> name }} </p>

                    @else
                    <p></p>
                    @endif

                    @if(!empty($profile))

                    <p class="lead"> {{ $profile -> designation }} </p>

                    @else
                    <p></p>
                    @endif
                </div>
            </div>



        </div>
        <div class="col-sm-8">

            @forelse($posts->all() as $post)
            <div class="card mb-3">
               <div class="card-body">
                <h4>{{ $post-> post_title }}</h4>
                <img src="{{ $post->post_image }}" alt="">
                <p>{{ substr($post->post_body , 0 , 150 ) }}</p>
                <ul class="nav nav-pills">
                    <li role="presentation">
                     <a href='{{ url("/view/{$post->id }") }}'>
                        <span class="fa fa-eye mr-4" > VIEW</span>
                     </a>
                    </li>
                    <li role="presentation">
                        <a href='{{ url("/edit/{$post->id}") }}'>
                           <span class="fa fa-pencil-square-o mr-4"> EDIT</span>
                        </a>
                       </li>
                       <li role="presentation">
                        <a href='{{ url("/delete/{$post->id }") }}'>
                           <span class="fa fa-trash mr-4">DELETE</span>
                        </a>
                       </li>
                </ul>
                <cite style="float:left;">Posted on: {{ date('M j Y H:i' , strtotime($post->updated_at)) }}  </cite>
               </div>
            </div>
            @empty
            <p>No post Available</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
