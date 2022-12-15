@extends('layouts.app', ['title' => 'All Published Posts'])

@section('content')
    @include('layouts.headers.plain')

    <div class="container-fluid mt--7">
        @if(count($posts) > 0)
          <div class="row">
              @foreach ($posts as $post)
              <div class="col-xl-4 mt-5 mb-5 mb-xl-0">
                  <div class="card shadow">
                      @if($post->cover_image)
                          <img class="card-img-top card-img-top-post" src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
                      @endif
                      <div class="card-body card-body-post">
                        <h3 class="card-title">{{ $post->title }}</h3>
                        <span class="card-text card-text-post">
                         Сортувальне число:  {{$post->sort}}
                        </span>
                          <p class="card-text card-text-post">
                          {!! str_limit(strip_tags($post->body), 80) !!}
                        </p>

                        <p><small>Створено {{ $post->user->getName() }} | {{ $post->getDateCreated() }}</small></p>
                        <div class="button-group row">
                          <div class="col-8">
                            <a href="/posts/{{ $post->post_id }}" class="btn btn-outline-primary btn-sm">View</a>
                            @if(Auth::user()->id == $post->user_id || Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                            <a href="/posts/{{$post->post_id}}/edit" class="btn btn-outline-info btn-sm">Edit</a>
                            @endif
                          </div>
                          <div class="col-4 text-right">
                              <form action="{{ action('PostsController@destroy', $post->post_id) }}" method="post" style="display: inline;">
                                  @csrf
                                  @method('delete')

                                  <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirm('Are you sure you want to delete this post?') ? this.parentElement.submit() : ''">
                                      Delete
                                  </button>
                              </form>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>

          <div class="row mt-5">
            {{ $posts->links() }}
          </div>
        @else
          <div class="row mt-9 mb-9">
            <div class="col text-center">
                <p class="lead">No posts found</p>
                <br>
                <a href="/posts/create" class="btn btn-primary btn-lg">Create Post</a>
            </div>
          </div>
        @endif

        @include('layouts.footers.auth')
    </div>
@endsection
