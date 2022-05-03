@extends('layouts.article_page', ['title' => 'Новини', 'article' => $post->title])

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
          Створено {{ $post->created_at->format('d:m:Y H') }}
          | Оновлено {{ $post->created_at->format('d:m:Y H') }}
        </span>
      </div>
    </div>
    <img class="cover_image" src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
    <div class="article-content">
      {!! $post->body !!}
    </div>
      <div class="row">
          <div class="col-12 col-lg-5">
              <div class="form-control-label mb-2">
                  Прикріплені фотографії
              </div>
              <div class="post_images">
                  @foreach($post->media as $media)
                      <a href="{{ $media->getUrl() }}" target="_blank">
                          <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}" width="200" max-height="100">
                      </a>
                  @endforeach
              </div>
          </div>
      </div>
  </article>
  <div class="button">
    <a href="javascript:history.back()" class="link">Назад</a>
  </div>
</section>
<!-- end Article -->
@endsection
