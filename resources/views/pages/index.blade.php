@extends('layouts.pages', ['title' => __('general.main')])

@section('content')

    <!-- Hero Section -->
    <section class="section hero">
        <div class="content">
            <h1 class="headline">{{__('general.short_name')}}</h1>
            <p class="description">
                {{__('general.about_college_text_main')}}
            </p>
            <a href="/news/admission" class="btn">
                {{__('general.admission_to_college')}}
            </a>
        </div>
        <div class="image">
{{--            <img src="{{ asset('spccweb/img/hero.jpg') }}" alt="{{__('general.short_name')}}"/>--}}

            <div id="slider-main">
                <a href="javascript:void(0)" class="control_next">></a>
                <a href="javascript:void(0)" class="control_prev"><</a>
                <ul>
                    <li style="background-image: url('{{ asset('spccweb/img/hero.jpg') }}')  ;"></li>
                    <li style="background-image: url('{{ asset('spccweb/img/hero2.jpg') }}') ;"></li>
                    <li style="background-image: url('{{ asset('spccweb/img/hero3.jpg') }}') ;"></li>
                    <li style="background-image: url('{{ asset('spccweb/img/hero4.jpg') }}') ;"></li>
                    <li style="background-image: url('{{ asset('spccweb/img/hero5.jpg') }}') ;"></li>
                </ul>
            </div>

            <div class="slider_option">
                <input type="checkbox" checked style="display: none" id="checkbox">

            </div>
        </div>
        <canvas class="particles-background"></canvas>
    </section>
    <!-- end Hero Section -->

    <!-- Upcoming Events Section -->
    @if(count($events) > 0)
        <section class="section upcoming-events">
            <div class="title">
                <h2 class="headline">
                    {{__('general.upcoming_events')}}
                </h2>
                @if(count($events) > 4)
                    <div class="pagination">
                        <button class="btn btn-left">
                            <i class="fa fa-3x fa-angle-left"></i>
                        </button>
                        <button class="btn btn-right">
                            <i class="fa fa-3x fa-angle-right"></i>
                        </button>
                    </div>
                @endif
            </div>
            @foreach ($events as $event)
                <div class="card">
                    <h3 class="date">{{ $event->getEventDate() }}</h3>
                    <p class="event">{{ $event->title }}</p>
                </div>
            @endforeach
        </section>
    @endif
    <!-- end Upcoming Events Section -->

    <!-- Annoucement Section -->
    <section class="section annoucement">
        @if($annoucement != null)
            <div class="content">
                <h2 class="headline">{{__('general.announcement')}}</h2>
                <p>
                    {{ $annoucement }}
                </p>
            </div>
        @endif
    </section>
    <!-- end Annoucement Section -->

    <!-- Annoucement Section -->
    <section class="section programs usefull-links">
        <div class="content">
            <h2 class="headline">{{__('terms_and_conditions.useful_links')}}</h2>
            <div class="container " id="hanging-icons">
                <div class="items">
                    <div class=" half">
                        <div class="image">
                            <a href="https://shlks.lcloud.in.ua/" target="_blank" rel="nofollow">
                                <img width="250" height="200" src="{{ asset('spccweb/img/button_lcloud_3.png') }}"
                                     alt="Хмара"/>
                            </a>
                        </div>
                    </div>
                    <div class="half">
                        <div class="image">
                            <a href="https://mon.gov.ua/ua" target="_blank" rel="nofollow">
                                <img width="200" height="100" src="{{ asset('spccweb/img/gov.png') }}" alt="Хмара"/>
                            </a>
                        </div>
                    </div>
                    <div class="half">
                        <div class="image">
                            <a href="https://voladm.gov.ua/category/upravlinnya-osviti-nauki-ta-molodi/1/"
                               target="_blank" rel="nofollow">
                                <img width="200" height="200" src="{{ asset('spccweb/img/volyn.png') }}" alt="Хмара"/>
                            </a>
                        </div>
                    </div>
                    <div class="half">
                        <div class="image">
                            <a href="https://open.ukrforest.com/" target="_blank" rel="nofollow">
                                <img width="150" height="150" src="{{ asset('spccweb/img/dalru.png') }}" alt="Хмара"/>
                            </a>
                        </div>
                    </div>
                    <div class="half">
                        <div class="image">
                            <a href="http://lisvolyn.gov.ua/" target="_blank" rel="nofollow">
                                <img width="150" height="150" src="{{ asset('spccweb/img/volynforest.jpeg') }}"
                                     alt="Хмара"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end Annoucement Section -->

    <!-- About Section -->
    <section class="section about-brief">
        <div class="image">
            <img src="{{ asset('spccweb/img/spcnian.jpg') }}" alt="Shlk"/>
        </div>
        <div class="content">
            <h2 class="headline">{{__('general.full_name')}}</h2>
            <h3 class="sub-headline">
                <a href="https://www.google.com/maps/place/%D0%A8%D0%B0%D1%86%D0%BA%D0%B8%D0%B9+%D0%BB%D0%B5%D1%81%D0%BD%D0%BE%D0%B9+%D0%BA%D0%BE%D0%BB%D0%BB%D0%B5%D0%B4%D0%B6/@51.4896705,23.9212732,17.85z/data=!4m5!3m4!1s0x4723fb672a2a9699:0xf71f674c8538ff31!8m2!3d51.4894695!4d23.9228032?hl=ru-RU">
                    {{__('general.shatsk')}}
                </a>
            </h3>
            <p class="description">
                {!! nl2br(__('terms_and_conditions.about_college_text_main')) !!}

            </p>
            <a href="/about" class="link">{{__('general.read_more')}}</a>
        </div>

        <div class="bg">
            <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-big"/>
        </div>
    </section>
    <!-- end About Section -->

    <!-- Programs Section -->

    <section class="section programs">
        <div class="content">

            <div class="container">
                <div class="row animate-box">
                    <div class="col-md-offset-3 text-center fh5co-heading">
                        <h2 class="headline">{{__('terms_and_conditions.program_title')}}</h2>
                        {{--                <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 animate-box">
                        <div class="course">
                            <a href="#" class="course-img" style="background-image: url(spccweb/img/accountant.webp);">
                            </a>
                            <span></span>

                            <div class="desc">
                                <h3><a href="#">{{__('terms_and_conditions.accounting_program')}}</a></h3>
                                <p>
                                {{__('terms_and_conditions.accounting_duration')}}
                            </p>
                            {{--                        <span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 animate-box">
                        <div class="course">
                            <a href="#" class="course-img" style="background-image: url(images/project-2.jpg);">
                            </a>
                            <div class="desc">
                                <h3><a href="#">
                                        {{__('terms_and_conditions.forest_program')}}
                                    </a></h3>
                                <p>
                                    {{__('terms_and_conditions.forest_duration')}}
                                </p>
                                {{--                        <span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 animate-box">
                        <div class="course">
                            <a href="#" class="course-img" style="background-image: url(images/project-3.jpg);">
                            </a>
                            <div class="desc">
                                <h3><a href="#">
                                        {{__('terms_and_conditions.wood_processing_program')}}
                                    </a></h3>
                                <p>
                                    {{__('terms_and_conditions.wood_processing_duration')}}
                                </p>
                                {{--                        <span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 animate-box">
                        <div class="course">
                            <a href="#" class="course-img" style="background-image: url(images/project-4.jpg);">
                            </a>
                            <div class="desc">
                                <h3><a href="#">
                                        {{__('terms_and_conditions.additional_training_program')}}
                                    </a></h3>
                                <p>
                                    {{__('terms_and_conditions.additional_training_duration')}}
                                </p>
                                {{--                        <span><a href="#" class="btn btn-primary btn-sm btn-course">Take A Course</a></span>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg">
            <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-small"/>
            <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-big"/>
        </div>
    </section>
    <!-- end Programs Section -->

    <!-- Latest News Section -->
    @if(count($posts) > 2)
        <section class="section latest-news">
            <h2 class="headline">
                {{__('general.latest_news')}}
            </h2>

            @foreach ($posts as $post)
                <article>
                    @if($post->cover_image)
                        <img src="{{ asset('/storage/cover_images/' . $post->cover_image) }}"/>
                    @else
                        <img src="{{ asset('/spccweb/img/circle-pattern.svg') }}"/>
                    @endif
                    <h3>
                        <a href="<?=\LaravelLocalization::localizeUrl(route('articles',$post->post_id))?>" class="title">
                            {{ $post->title }}
                        </a>
                    </h3>
                    <div class="meta">
                        <span class="publish-date">{{ $post->getDateCreated() }}</span>
                    </div>
                    <p class="article-content">
                        {!! Str::limit(strip_tags(htmlspecialchars_decode($post->body)),30) !!}
                    </p>

                    <a href="<?=\LaravelLocalization::localizeUrl(route('articles',$post->post_id))?>" class="link">
                        {{__('general.read_more')}}
                    </a>
                </article>
            @endforeach

            <div class="bg">
                <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-small-top"/>
                <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-big-top"/>
                <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-small"/>
                <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-big"/>
            </div>
        </section>
    @endif
    <!-- end Latest News Section-->

@endsection
