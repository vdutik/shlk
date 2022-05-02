<!-- Site Header -->
<header class="site-header">
  <div class="logo">
    <a href="/">
      <img src="{{ asset('spccweb/img/logo.png') }}" alt="SPCC Logo" />
    </a>
  </div>

  <div class="mobile-nav">
    <a href="javascript:void(0);" class="icon" onclick="toggleNavResponsive()">
      <i id="navIcon" class="fa fa-2x fa-bars"></i>
    </a>
  </div>

  <div id="siteNav" class="site-nav">
    <nav class="nav-portal">
      <ul>
        @auth()
          <li>
            <a href="/profile">
              ви, {{ auth()->user()->getName() }}!
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard') }}">
             Повернутись до порталу
            </a>
          </li>
        @endauth
        @guest()
          <li><a href="{{ route('login') }}">Авторизуватись</a></li>
        @endguest
      </ul>
    </nav>
    <nav class="nav-main">
        {!! $MyNavBar->asUl() !!}
{{--      <ul>--}}
{{--        <li class="{{ $title == 'Home' ? 'active' : '' }}">--}}
{{--          <a href="/">головна</a>--}}
{{--        </li>--}}
{{--        <li class="{{ $title == 'About' ? 'active' : '' }}">--}}
{{--          <a href="/about">про нас</a>--}}
{{--        </li>--}}
{{--        @if($tot_posts > 0)--}}
{{--        <li class="{{ $title == 'News' ? 'active' : '' }}">--}}
{{--          <a href="/news">новини</a>--}}
{{--        </li>--}}
{{--        @endif--}}
{{--        <li class="{{ $title == 'Contact' ? 'active' : '' }}">--}}
{{--          <a href="/contact">Контакти</a>--}}
{{--        </li>--}}
{{--        <li class="cat nav-item dropdown{{ $title == 'Admissions' ? 'active' : '' }}" aria-haspopup="true">--}}
{{--              <a href="/admission">Вступ</a>--}}
{{--              <ul class="dropdown" aria-label="submenu">--}}
{{--                  <li><a class="dropdown-item" href="https://vstup.edbo.gov.ua/">Онлайн вступ</a></li>--}}
{{--                  <li><a class="dropdown-item" href="/admission">Звичайний вступ</a></li>--}}
{{--              </ul>--}}
{{--        </li>--}}
{{--      </ul>--}}
    </nav>


  </div>
</header>
<!-- end Site Header -->
<div>
{{--    @dd($MyNavBar)--}}


</div>
