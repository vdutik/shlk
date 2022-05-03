@extends('layouts.pages', ['title' => 'Головна'])

@section('content')
<!-- Hero Section -->
<section class="section hero">
  <div class="content">
    <h1 class="headline">ШЛФК ім. В.В.Сулька</h1>
    <p class="description">Прагнення до досконалості</p>
    <a href="/admission" class="btn">стати спеціалістом</a>
  </div>
  <div class="image">
    <img src="{{ asset('spccweb/img/hero.jpg') }}" alt="SPCC Caloocan School Building" />
  </div>
  <canvas class="particles-background"></canvas>
</section>
<!-- end Hero Section -->

<!-- Upcoming Events Section -->
@if(count($events) > 0)
<section class="section upcoming-events">
  <div class="title">
    <h2 class="headline">Наступні події</h2>
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
    <h2 class="headline">Оголошення</h2>
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
    <h2 class="headline">Корисні посилання</h2>
      <div class="container " id="hanging-icons">
          <div class="items">
              <div class=" half">
                      <div class="image">
                          <a href="https://shlks.lcloud.in.ua/" target="_blank" rel="nofollow">
                              <img  width="250" height="200"  src="{{ asset('spccweb/img/button_lcloud_3.png') }}" alt="Хмара" />
                          </a>
                      </div>
              </div>
              <div class="half">
                  <div class="image">
                      <a href="https://mon.gov.ua/ua" target="_blank" rel="nofollow">
                          <img  width="200" height="100"  src="{{ asset('spccweb/img/gov.png') }}" alt="Хмара" />
                      </a>
                  </div>
              </div>
              <div class="half">
                  <div class="image">
                      <a href="https://voladm.gov.ua/category/upravlinnya-osviti-nauki-ta-molodi/1/" target="_blank" rel="nofollow">
                          <img  width="200" height="200"  src="{{ asset('spccweb/img/volyn.png') }}" alt="Хмара" />
                      </a>
                  </div>
              </div>
              <div class="half">
                  <div class="image">
                      <a href="https://open.ukrforest.com/" target="_blank" rel="nofollow">
                          <img  width="150" height="150"  src="{{ asset('spccweb/img/dalru.png') }}" alt="Хмара" />
                      </a>
                  </div>
              </div>
              <div class="half">
                  <div class="image">
                      <a href="http://lisvolyn.gov.ua/" target="_blank" rel="nofollow">
                          <img  width="150" height="150"  src="{{ asset('spccweb/img/volynforest.jpeg') }}" alt="Хмара" />
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
    <img src="{{ asset('spccweb/img/spcnian.jpg') }}" alt="SPCC Caloocan Gymnasium" />
  </div>
  <div class="content">
    <h2 class="headline">Шацький лісовий технікум ім. В.В.Сулька</h2>
    <h3 class="sub-headline">
        <a href="https://www.google.com/maps/place/%D0%A8%D0%B0%D1%86%D0%BA%D0%B8%D0%B9+%D0%BB%D0%B5%D1%81%D0%BD%D0%BE%D0%B9+%D0%BA%D0%BE%D0%BB%D0%BB%D0%B5%D0%B4%D0%B6/@51.4896705,23.9212732,17.85z/data=!4m5!3m4!1s0x4723fb672a2a9699:0xf71f674c8538ff31!8m2!3d51.4894695!4d23.9228032?hl=ru-RU">
            смт. Шацьк
        </a>
    </h3>
    <p class="description">
        Коледж створений на базі Шацького лісного технікуму ім. В.В.Сулька Наказом №484 від 16.11.2005 Державного комітету лісового господарства України.

        Шацький лісний технікум заснований в 1963 році на основі наказу начальника Головного управління лісового господарства і лісозаготівель при Раді Міністрів УРСР від 20.06.1963року №134К і переданий в безпосереднє підпорядкування Міністерства лісового господарства УРСР. В 1997 році технікуму присвоєне ім’я першого директора, заслуженого лісівника України Сулька Валентина Васильовича.
    </p>
    <a href="/about" class="link">Learn More</a>
  </div>

  <div class="bg">
    <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-big" />
  </div>
</section>
<!-- end About Section -->

<!-- Programs Section -->
<section class="section programs">
  <div class="content">
    <h2 class="headline">Програми навчання</h2>
      <div class="items">
          <div class="half">
          <ul>
              <li class="level-1">
                  <span>Бухгалтерський облік</span>
                  терміни навчання
                  <ul>
                      <li>на базі 9 класів – 3 роки</li>
                      <li>на базі 11 класів –
                          2 роки</li>
                  </ul>
              </li>
              <li class="level-1">
                  <span>Лісове господарство</span>
                  терміни навчання
                  <ul>
                      <li>на базі 9 класів – 4 роки</li>
                      <li>на базі 11 класів – 3
                          роки</li>
                  </ul>
              </li>
          </ul>
          </div>
          <div class="half">
          <ul>
              <li class="level-1">
                  <span>Лісозаготівля та первинна обробка деревини</span>
                  терміни навчання
                  <ul>
                      <li>на базі 9 класів – 4 роки,</li>
                      <li>на базі 11 класів – 3 роки</li>
                  </ul>
              </li>

              <li class="level-1">
            <span>
                Окрім основної спеціальності студенти мають можливість здобути робітничу професію</span>
                  <ul>
                      <li>лісоруб ІV розряду (для хлопців);</li>
                      <li>робітник зеленого господарства ІІІ розряду (для дівчат);</li>
                      <li>таксидерміст</li>
                      <li>оператор комп’ютерного набору.</li>
                  </ul>
              </li>
          </ul>
          </div>
      </div>

  </div>

  <div class="bg">
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-small" />
    <img src="{{ asset('spccweb/img/circle-pattern-white.svg') }}" class="circle-pattern-big" />
  </div>
</section>
<!-- end Programs Section -->

<!-- Latest News Section -->
@if(count($posts) > 2)
<section class="section latest-news">
  <h2 class="headline">Останні новини</h2>

  @foreach ($posts as $post)
  <article>
    <img src="{{ asset('/storage/cover_images/' . $post->cover_image) }}" />
    <h3>
      <a href="/articles/{{ $post->post_id }}" class="title">
        {{ $post->title }}
      </a>
    </h3>
    <div class="meta">
      <span class="publish-date">{{ $post->getDateCreated() }}</span>
    </div>
    <p class="article-content">
      {!! str_limit(strip_tags($post->body), 135) !!}
    </p>
    <a href="/articles/{{ $post->post_id }}" class="link">Докладніше </a>
  </article>
  @endforeach

  <div class="bg">
    <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-small-top" />
    <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-big-top" />
    <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-small" />
    <img src="{{ asset('spccweb/img/circle-pattern.svg') }}" class="circle-pattern-big" />
  </div>
</section>
@endif
<!-- end Latest News Section-->
@endsection
