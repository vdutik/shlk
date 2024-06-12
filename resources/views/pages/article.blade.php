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
          <section class="slider-container">
            <div class="container">
              <div class="swiper image-slider">
              @foreach($post->media as $media)
                <div class="swiper-wrapper">
                  <div  data-hash="slide-{{$media->id}}" class="swiper-slide">
                    <div class="img_box swiper-zoom-container">
                      <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}">
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"> </div>
            <div class="swiper-pagination"></div>
            </div>

          </section>
      <!-- <div class="wrapper">
        <div class="image-slider swiper-container">
            <div class="image-slider__wrapper swiper-wrapper">
                @foreach($post->media as $media)
                <div data-hash="slide-{{$media->id}}" class="image-slider__slide swiper-slide">
                    <div class="image-slider__image swiper-zoom-container">
                        <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}">
                    </div>
                </div>
                  @endforeach

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>
   </div>
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
              </div> -->
          </div>
      </div>
  </article>
  <div class="button">
    <a href="javascript:history.back()" class="link">Назад</a>
  </div>

</section>

<!-- end Article -->
@endsection
