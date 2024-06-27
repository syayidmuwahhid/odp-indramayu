<nav class="navbar">
  <div class="container mx-auto flex items-center justify-between px-4">

    <!-- logo -->
    <div class="order-0">
      <a href="{{ url('') }}" class="flex gap-3 items-center">
        <img src="" height="50" width="50" alt="logo" class="appLogo"/>
        <span class="text-bold text-2xl appName text-orange-600 font-bold"></span>
      </a>
    </div>

    <!-- navbar toggler -->
    <input placeholder="input" id="nav-toggle" type="checkbox" class="hidden" />
    <label
      id="show-button"
      for="nav-toggle"
      class="order-1 flex cursor-pointer items-center lg:order-1 lg:hidden"
    >
      <svg class="h-6 fill-current" viewBox="0 0 20 20">
        <title>Menu Open</title>
        <path d="M0 3h20v2H0V3z m0 6h20v2H0V9z m0 6h20v2H0V0z"></path>
      </svg>
    </label>
    <label
      id="hide-button"
      for="nav-toggle"
      class="order-2 hidden cursor-pointer items-center lg:order-1"
    >
      <svg class="h-6 fill-current" viewBox="0 0 20 20">
        <title>Menu Close</title>
        <polygon
          points="11 9 22 9 22 11 11 11 11 22 9 22 9 11 -2 11 -2 9 9 9 9 -2 11 -2"
          transform="rotate(45 10 10)"
        ></polygon>
      </svg>
    </label>

    <!-- /navbar toggler -->
    <ul
      id="nav-menu"
      class="navbar-nav order-1 justify-between hidden w-full flex-[0_0_100%] lg:order-1 lg:flex lg:w-auto lg:flex-auto lg:justify-center lg:space-x-5"
    >

      <!-- navbar toggler -->
      <input id="nav-toggle" type="checkbox" class="hidden" />
      <label
        id="show-button"
        for="nav-toggle"
        class="order-1 flex cursor-pointer items-center lg:order-1 lg:hidden"
      >
        <svg class="h-6 fill-current" viewBox="0 0 20 20">
          <title>Menu Open</title>
          <path d="M0 3h20v2H0V3z m0 6h20v2H0V9z m0 6h20v2H0V0z"></path>
        </svg>
      </label>
      <label
        id="hide-button"
        for="nav-toggle"
        class="order-2 hidden cursor-pointer items-center lg:order-1"
      >
        <svg class="h-6 fill-current" viewBox="0 0 20 20">
          <title>Menu Close</title>
          <polygon
            points="11 9 22 9 22 11 11 11 11 22 9 22 9 11 -2 11 -2 9 9 9 9 -2 11 -2"
            transform="rotate(45 10 10)"
          ></polygon>
        </svg>
      </label>
      <li class="nav-item">
        <a href="{{ route('landing-page') }}" class="nav-link {{ url()->current() == route('landing-page') ? 'active' : '' }}">Beranda</a>
      </li>
      <li class="nav-item">
          <a href="{{ route('article') }}" class="nav-link {{ url()->current() == route('article') ? 'active' : '' }}">Artikel</a>
        </li>

        <li class="nav-item">
          <a href="{{ route('dokumen') }}" class="nav-link {{ url()->current() == route('dokumen') ? 'active' : '' }}">Dokumen</a>
        </li>

    <li class="nav-item">
        <a href="{{ route('about') }}" class="nav-link {{ url()->current() == route('about') ? 'active' : '' }}">Tentang</a>
    </li>

      <li class="nav-item">
        <a href="{{ route('contact') }}" class="nav-link {{ url()->current() == route('contact') ? 'active' : '' }}">Kontak</a>
      </li>

      {{-- <li class="nav-item mt-3.5 lg:hidden">
        <a class="btn btn-white btn-sm border-border" href="signin.html"
          >Sing Up Now</a
        >
      </li> --}}
    </ul>

    <div class="order-1 ml-auto hidden items-center md:order-2 md:ml-0 lg:flex nav-button">
      <a class="btn btn-white btn-sm" href="{{ route('login') }}">{{ Auth::check() ? Auth::user()->name : 'Masuk' }}</a>
    </div>

  </div>
</nav>

<script>
  window.addEventListener('scroll', function() {
    const header = document.querySelector('.navbar');
    if (window.scrollY > 0) {
        header.classList.add('sticky');
    } else {
        header.classList.remove('sticky');
    }
  });
</script>
