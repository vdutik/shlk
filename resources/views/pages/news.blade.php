@extends('layouts.pages', ['title' => $title??'Новини'])

@section('content')
<!-- Page Cover Section -->
<section class="section page-cover">
  <div class="page-title">
    <h1>{{$title??'Новини'}}</h1>
  </div>

  <canvas class="particles-background"></canvas>
</section>
<!-- end Page Cover Section -->

@if(count($latest_post) == 1)
<!-- Featured News -->
<section class="section featured-news">
  <article>
    <div class="cover-image">
      @if($latest_post[0]->cover_image)
        <img src="{{ asset('/storage/cover_images/' . $latest_post[0]->cover_image) }}">
      @else
        <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}"/>
      @endif
    </div>
    <div class="content">
      <div class="news-meta">
        <h2>
          <a href="/articles/{{ $latest_post[0]->post_id }}" class="title">
            {{ $latest_post[0]->title }}
          </a>
        </h2>
        <div class="meta">
          <span class="publish-date">{{ $latest_post[0]->created_at->format('d m Y') }}</span>
        </div>
      </div>
      <p class="article-content">
        {!! Str::limit(strip_tags($latest_post[0]->body), 135) !!}
      </p>
      <a href="/articles/{{ $latest_post[0]->post_id }}" class="link">Докладніше</a>
    </div>
  </article>

  <div class="bg">
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-bottom" />
  </div>
</section>
<!-- end Featured News -->
@endif

<!-- News -->
@if(count($posts) > 1)
<section class="section news">

  @foreach ($posts as $post)
    @if($post->post_id != $latest_post[0]->post_id)
    <article>
      @
      @if($post->cover_image)
        <img src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
      @else
{{--        <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}"/>--}}
      @endif
      <div class="news-meta">
        <h2>
          <a href="/articles/{{ $post->post_id }}" class="title">
            {{ $post->title }}
          </a>
        </h2>
        <div class="meta">
          <span class="publish-date">{{ $post->created_at->format('d m Y') }}</span>
        </div>
      </div>
      <p class="article-content">
          {!! Str::limit(strip_tags($post->body), 135) !!}
      </p>
      <a href="/articles/{{ $post->post_id }}" class="link">Докладніше</a>
    </article>
    @endif
  @endforeach

  <div class="pagination">
    {{ $posts->links() }}
  </div>
</section>
@endif
<!-- end News -->

@endsection
