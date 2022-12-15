@extends('layouts.app', ['title' => 'View Post'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">

                    @switch($post->status)
                        @case('Published')
                          <span class="badge badge-success badge-float">Опубліковані</span>
                          @break

                        @default
                          <span class="badge badge-warning badge-float">Очікують підтвердження</span>
                          @break
                    @endswitch
                    @if($post->cover_image)
                        <img class="card-img-top" src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title mb-2">{{ $post->title }}</h1>
                        <h5 class="mb-4">Написаий автором {{ $post->user->getName() }}</h5>
                        <h5 class="mb-4">Сортувальне число  {{ $post->sort }}</h5>
                        <div class="card-text">
                            {!! html_entity_decode($post->body) !!}
                        </div>
                        <hr>
                        <p>
                            Створено о {{ $post->created_at->format('g:iA d m Y') }}
                            | оновлено о {{ $post->created_at->format('g:iA d m Y') }}
                        </p>
                        <div class="button-group row mt-5">
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-primary" onclick="javascript:history.back()">Return</button>
                            </div>
                            @if(Auth::user()->id == $post->user_id || Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                                <div class="col-8 text-right">
                                    <a href="/posts/{{$post->post_id}}/edit" class="btn btn-outline-info">Edit</a>
                                    <form method="POST" action="{{ action('PostsController@destroy', $post->post_id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
