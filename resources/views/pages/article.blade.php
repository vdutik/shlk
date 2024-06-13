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
          {{__('general.created_at')}} {{ $post->created_at->format('Y-m-d H:i') }}
          | {{__('general.updated_at')}} {{ $post->updated_at->format('Y-m-d H:i') }}
        </span>
      </div>
    </div>
      @if($post->cover_image)
        <img class="cover_image" src="{{ asset('/storage/cover_images/' . $post->cover_image) }}">
      @endif
    <div class="article-content">
      {!! html_entity_decode($post->body) !!}
    </div>
      <div class="row">
          <div class="photo-slider-container">
              <div class="photo-slider">
                  <!-- Слайди з фотографіями -->
                  @foreach($post->media as $media)
                      <div  data-hash="slide-{{$media->id}}">

                          {{$media}}

                      </div>
                  @endforeach

                  <!-- Додайте більше слайдів за потреби -->
              </div>
              <div class="photo-slider-nav">
                  <!-- Превьюшки -->
                  @foreach($post->media as $media)
                      <div  data-hash="slide-{{$media->id}}">

                          <img src="{{ $media->getUrl() }}" alt="{{ $media->name }}">

                      </div>
                  @endforeach
{{--                  <div><img src="path/to/photo1.jpg" alt="Photo 1"></div>--}}
{{--                  <div><img src="path/to/photo2.jpg" alt="Photo 2"></div>--}}
{{--                  <div><img src="path/to/photo3.jpg" alt="Photo 3"></div>--}}
                  <!-- Додайте більше превью за потреби -->
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
