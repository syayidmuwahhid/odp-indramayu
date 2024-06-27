@extends('layouts.app')

@section('title', 'Landing Page')

@push('css')

<link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">

@endpush

@section('content')

{{-- <section class="section relative"> --}}
  {{-- <div class="container"> --}}

    <!-- carousel -->
    <div class="carousel">
      <!-- list item -->
      <div class="list" id="list_slider">

      </div>
      <!-- list thumnail -->
      <div class="thumbnail" id="thumbnail_slider">

      </div>
      <!-- next prev -->

      <div class="arrows">
          <button id="prev"><</button>
          <button id="next">></button>
      </div>
      <!-- time running -->
      <div class="time"></div>
    </div>
    {{-- </div>
</section> --}}

{{-- banner --}}
<section class="section banner relative">
    <div class="container mx-auto px-4 py-16 flex flex-col-reverse lg:flex-row items-center justify-between">
      <div class="row items-center" data-aos="fade-up"data-aos-duration="1500">
        <div class="lg:col-6">
          <h2 class="banner-title text-orange-600">

          </h2>
          <p class="mt-6 text-black text-lg" id="banner-description">

          </p>
          <a class="btn bg-orange-600 hover:bg-red-400 text-white font-bold rounded-full mt-8" href="{{ route('about') }}">Selengkapnya</a>
        </div>
        <div class="lg:col-6 lg:w-1/2 flex justify-center object-cover">
          <div class="col col-md-3 p-8 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
            <img src="{{ asset('assets/img/sawah.jpg') }}" alt="" class="w-[60vh] mt-90 mb-30 ">
          </div>
          <div class=" col col-md-3 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
              <img src="{{ asset('assets/img/sawah1.jpg') }}" alt="" class="w-[60vh] mt-90 mb-30">
          </div>
          {{-- <img
            class="w-full object-cover"
            src="https://indramayukab.go.id/wp-content/uploads/2023/01/indra1.jpeg"
            width="603"
            height="396"
            alt=""
          /> --}}
        </div>
      </div>
    </div>
    {{-- <img
      class="banner-shape absolute -top-28 right-0 -z-[1] w-full max-w-[30%]"
      src="{{ asset('assets/img/banner-shape.svg') }}"
      alt=""
    /> --}}
  </section>
  <!-- ./end Banner -->

  <!-- Reviews -->
  <section class="reviews mt-8">
    <div class="container">
      <div class="row justify-between">
        <div class="lg:col-6 mb-6">
          <h2 class="text-orange-600" data-aos="fade-up" data-aos-duration="1200">Artikel Terbaru</h2>
        </div>
        {{-- <div class="lg:col-4">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi egestas
            Werat viverra id et aliquet. vulputate egestas sollicitudin .
          </p>
        </div> --}}
      </div>
      <div class="row">
        <div class="col-12">
          <div class="reviews-carousel" data-aos="fade-left" data-aos-duration="1200">
            <div class="swiper-wrapper" id="artikel_container">


<!-- Reviews -->
    <section class="reviews mt-8">
        <div class="container">
            <div class="row justify-between">
                <div class="lg:col-6 mb-6">
                <h2 class="text-orange-600">Artikel Terbaru</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <div class="reviews-carousel">
                    <div class="row" id="artikel_container">
                    </div>
                    <!-- If we need pagination -->
                    {{-- <div class="swiper-pagination reviews-carousel-pagination !bottom-0"></div> --}}
                </div>
                </div>

            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination reviews-carousel-pagination !bottom-0"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Reviews -->

  <!-- Key features -->
  {{-- <section class="section key-feature relative">
    <img
      class="absolute left-0 top-0 -z-[1] -translate-y-1/2"
      src="{{ asset('assets/img/icons/feature-shape.svg') }}"
      alt=""
    />
    <div class="container">
      <div class="row justify-between text-center lg:text-start" data-aos="fade-up"data-aos-duration="1500">
        <div class="lg:col-5">
          <h2 class="text-orange-600">The Highlighting Part Of Our Solution</h2>
        </div>
        <div class="mt-6 lg:col-5 lg:mt-0">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi egestas
            Werat viverra id et aliquet. vulputate egestas sollicitudin .
          </p>
        </div>
      </div>
      <div
        class="key-feature-grid mt-10 grid grid-cols-2 gap-7 md:grid-cols-3 xl:grid-cols-4"
      >
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Live Caption</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-1.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Smart Reply</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-2.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Sound Amplifier</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-3.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Gesture Navigation</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-4.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Dark Theme</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-5.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Privacy Controls</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-6.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Location Controls</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-7.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Security Updates</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-8.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Focus Mode</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-9.svg') }}"
              alt=""
            />
          </span>
        </div>
        <div
          class="flex flex-col justify-between rounded-lg bg-white p-5 shadow-lg"
          data-aos="flip-up" data-aos-duration="1500"
        >
          <div>
            <h3 class="h4 text-xl lg:text-2xl">Family Link</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
          </div>
          <span class="icon mt-4">
            <img
              class="objec-contain"
              src="{{ asset('assets/img/icons/feature-icon-10.svg') }}"
              alt=""
            />
          </span>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- ./end Key features -->

  <!-- Services -->
  {{-- <section class="section services">
    <div class="container">
      <div class="tab row gx-5 items-center" data-tab-group="integration-tab">
        <div class="lg:col-7 lg:order-2">
          <div class="tab-content" data-tab-content data-aos="flip-up" data-aos-duration="1500">
            <div class="tab-content-panel active" data-tab-panel="0">
              <img
                class="w-full object-contain"
                src="{{ asset('assets/img/sells-by-country.png') }}"
              />
            </div>
            <div class="tab-content-panel" data-tab-panel="1">
              <img class="w-full object-contain" src="{{ asset('assets/img/collaboration.png') }}" />
            </div>
            <div class="tab-content-panel" data-tab-panel="2">
              <img
                class="w-full object-contain"
                src="{{ asset('assets/img/sells-by-country.png') }}"
              />
            </div>
          </div>
        </div>
        <div class="mt-6 lg:col-5 lg:order-1 lg:mt-0" data-aos="fade-right" data-aos-duration="1500">
          <div class="text-container">
            <h2 class="lg:text-4xl text-orange-600">
              Prevent failure from to impacting your reputation
            </h2>
            <p class="mt-4">
              Our platform helps you build secure onboarding authentication
              experiences that retain and engage your users. We build the
              infrastructure, you can.
            </p>
            <ul class="tab-nav -ml-4 mt-8 border-b-0" data-tab-nav data-aos="flip-up" data-aos-duration="1500">
              <li class="tab-nav-item active" data-tab="0">
                <img class="mr-3" src="{{ asset('assets/img/icons/drop.svg') }}" alt="" />
                Habit building essential choose habit
              </li>
              <li class="tab-nav-item" data-tab="1">
                <img class="mr-3" src="{{ asset('assets/img/icons/brain.svg') }}" alt="" />
                Get an overview of Habit Calendars.
              </li>
              <li class="tab-nav-item" data-tab="2">
                <img class="mr-3" src="{{ asset('assets/img/icons/timer.svg') }}" alt="" />
                Start building with Habitify platform
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row gx-5 mt-12 items-center lg:mt-0">
        <div class="lg:col-7">
          <div class="relative" data-aos="flip-up" data-aos-duration="1500">
            <img class="w-full object-contain" src="{{ asset('assets/img/collaboration.png') }}" />
            <img
              class="absolute bottom-6 left-1/2 -z-[1] -translate-x-1/2"
              src="{{ asset('assets/img/shape.svg') }}"
              alt=""
            />
          </div>
        </div>
        <div class="mt-6 lg:col-5 lg:mt-0">
          <div class="text-container" data-aos="fade-left" data-aos-duration="1500">
            <h2 class="lg:text-4xl text-orange-600">
              Accept payments any country in this whole universe
            </h2>
            <p class="mt-4">
              Donec sollicitudin molestie malesda. Donec sollitudin molestie
              malesuada. Mauris pellentesque nec, egestas non nisi. Cras ultricies
              ligula sed
            </p>
            <ul class="mt-6 text-dark lg:-ml-4">
              <li class="mb-2 flex items-center rounded px-4">
                <img
                  class="mr-3"
                  src="{{ asset('assets/img/icons/checkmark-circle.svg') }}"
                  alt=""
                />
                Supporting more than 119 country world
              </li>
              <li class="mb-2 flex items-center rounded px-4">
                <img
                  class="mr-3"
                  src="{{ asset('assets/img/icons/checkmark-circle.svg') }}"
                  alt=""
                />
                Open transaction with more than currencies
              </li>
              <li class="flex items-center rounded px-4">
                <img
                  class="mr-3"
                  src="{{ asset('assets/img/icons/checkmark-circle.svg') }}"
                  alt=""
                />
                Customer Service with 79 languages
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row gx-5 mt-12 items-center lg:mt-0">
        <div class="lg:col-7 lg:order-2">
          <div class="video pb-5 pr-9" data-aos="fade-left" data-aos-duration="1500">
            <div class="video-thumbnail overflow-hidden rounded-2xl">
              <img
                class="w-full object-contain"
                src="{{ asset('assets/img/intro-thumbnail.png') }}"
                alt=""
              />
              <button class="video-play-btn">
                <img src="{{ asset('assets/img/icons/play-icon.svg') }}" alt="" />
              </button>
            </div>
            <div
              class="video-player absolute left-0 top-0 z-10 hidden h-full w-full"
            >
              <iframe
                class="h-full w-full"
                allowfullscreen=""
                src="https://www.youtube.com/embed/g3-VxLQO7do?autoplay=1"
              ></iframe>
            </div>
            <img
              class="intro-shape absolute bottom-0 right-0 -z-[1]"
              src="{{ asset('assets/img/shape.svg') }}"
              alt=""
            />
          </div>
        </div>
        <div class="mt-6 lg:col-5 lg:order-1 lg:mt-0">
          <div class="text-container" data-aos="fade-right" data-aos-duration="1500">
            <h2 class="lg:text-4xl text-orange-600">Accountability that works for you</h2>
            <p class="mt-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
              egestas Werat viverra id et aliquet. vulputate egestas sollicitudin
              .
            </p>
            <button class="btn btn-white mt-6">know about us</button>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
  <!-- ./end Services -->



  <!-- Call To action -->
  {{-- <section class="px-5 py-20 xl:py-[120px]">
    <div class="container">
      <div
        class="bg-gradient row justify-center rounded-b-[80px] rounded-t-[20px] px-[30px] pb-[75px] pt-16"
        data-aos="fade-up" data-aos-duration="1500"
      >
        <div class="lg:col-11">
          <div class="row">
            <div class="lg:col-7">
              <h2 class="h1 text-white">Helping teams in the world with focus</h2>
              <a class="btn btn-white mt-8" href="#">Download The Theme</a>
            </div>
            <div class="mt-8 lg:col-5 lg:mt-0">
              <p class="text-white">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi
                egestas Werat viverra id et aliquet. vulputate egestas
                sollicitudin .
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> --}}
@endsection

@push('js')

<script src="{{ asset('assets/js/pages/landing-page.js') }}"></script>
@endpush
