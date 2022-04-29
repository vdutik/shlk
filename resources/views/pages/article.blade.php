@extends('layouts.article_page', ['title' => 'News', 'article' => $post->title])

@section('content')
<!-- Article -->
<section class="section article">
  <article>
    <div class="news-meta">
      <h1 class="title">
        {{ $post->title }}
      </h1>
      <div class="meta">
        <span class="publish-date">
          Створено {{ $post->created_at->format('g:iA M d, Y') }}
          | Оновлено {{ $post->created_at->format('g:iA M d, Y') }}
        </span>
      </div>
    </div>
    <img src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
    <div class="article-content">
      {!! $post->body !!}
    </div>
  </article>
  <div class="button">
    <a href="javascript:history.back()" class="link">Назад</a>
  </div>
</section>
<!-- end Article -->
@endsection
