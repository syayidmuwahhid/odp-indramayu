@extends('layouts.app')

@section('title', 'Landing Page')

@push('css')

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

/* carousel */
.carousel{
    height: 100vh;
    width: 100%;
    overflow: hidden;
    position: relative;
    top: 0;
}
.carousel .list .item{
    width: 100%;
    height: 100%;
    position: absolute;
    inset: 0 0 0 0;
}
.carousel .list .item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.carousel .list .item .content{
    position: absolute;
    top: 20%;
    width: 1140px;
    max-width: 80%;
    left: 50%;
    transform: translateX(-50%);
    padding-right: 30%;
    box-sizing: border-box;
    color: #fff;
    text-shadow: 0 5px 10px #0004;
}

.carousel .list .item .title,
.carousel .list .item .topic{
    font-size: 5em;
    font-weight: bold;
    line-height: 1.3em;
}

.carousel .list .item .title{
  color: #f1683a;
  top: -10%;
  position: absolute;
}
.carousel .list .item .topic{
    color: #f1683a;
}

.carousel .list .item .des{
    font-size: 1em;
    font-weight: 300;
    top: 100px;
    z-index: 30;
    position: absolute;
    width: 50%;
}
.carousel .list .item .buttons{
    display: grid;
    grid-template-columns: repeat(2, 130px);
    grid-template-rows: 40px;
    gap: 5px;
    margin-top: 20px;
}
.carousel .list .item .buttons button{
    border: none;
    background-color: #eee;
    letter-spacing: 3px;
    font-family: Poppins;
    font-weight: 500;
}
.carousel .list .item .buttons button:nth-child(2){
    background-color: transparent;
    border: 1px solid #fff;
    color: #eee;
}
/* thumbail */
.thumbnail{
    position: absolute;
    bottom: 20px;
    left: 50%;
    width: max-content;
    z-index: 20;
    display: flex;
    gap: 20px;
}
.thumbnail .item{
    width: 150px;
    height: 220px;
    flex-shrink: 0;
    position: relative;
}
.thumbnail .item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
}
.thumbnail .item .content{
    color: #fff;
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
}
.thumbnail .item .content .title{
    font-weight: 500;
}
.thumbnail .item .content .description{
    font-weight: 300;
}
/* arrows */
.arrows{
    position: absolute;
    top: 90%;
    right: 52%;
    z-index: 20;
    width: 300px;
    max-width: 30%;
    display: flex;
    gap: 10px;
    align-items: center;
}
.arrows button{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #eee4;
    border: none;
    color: #fff;
    font-family: monospace;
    font-weight: bold;
    transition: .5s;
}
.arrows button:hover{
    background-color: #fff;
    color: #000;
}

/* animation */
.carousel .list .item:nth-child(1){
    z-index: 1;
}

/* animation text in first item */

.carousel .list .item:nth-child(1) .content .author,
.carousel .list .item:nth-child(1) .content .title,
.carousel .list .item:nth-child(1) .content .topic,
.carousel .list .item:nth-child(1) .content .des,
.carousel .list .item:nth-child(1) .content .buttons
{
    transform: translateY(50px);
    filter: blur(20px);
    opacity: 0;
    animation: showContent .5s 1s linear 1 forwards;
}
@keyframes showContent{
    to{
        transform: translateY(0px);
        filter: blur(0px);
        opacity: 1;
    }
}
.carousel .list .item:nth-child(1) .content .title{
    animation-delay: 1.2s!important;
}
.carousel .list .item:nth-child(1) .content .topic{
    animation-delay: 1.4s!important;
}
.carousel .list .item:nth-child(1) .content .des{
    animation-delay: 1.6s!important;
}
.carousel .list .item:nth-child(1) .content .buttons{
    animation-delay: 1.8s!important;
}
/* create animation when next click */
.carousel.next .list .item:nth-child(1) img{
    width: 150px;
    height: 220px;
    position: absolute;
    bottom: 50px;
    left: 50%;
    border-radius: 30px;
    animation: showImage .5s linear 1 forwards;
}
@keyframes showImage{
    to{
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 0;
    }
}

.carousel.next .thumbnail .item:nth-last-child(1){
    overflow: hidden;
    animation: showThumbnail .5s linear 1 forwards;
}
.carousel.prev .list .item img{
    z-index: 50;
}
@keyframes showThumbnail{
    from{
        width: 0;
        opacity: 0;
    }
}
.carousel.next .thumbnail{
    animation: effectNext .5s linear 1 forwards;
}

@keyframes effectNext{
    from{
        transform: translateX(150px);
    }
}

/* running time */

.carousel .time{
    position: absolute;
    z-index: 20;
    width: 0%;
    height: 3px;
    background-color: #f1683a;
    left: 0;
    top: 0;
}

.carousel.next .time,
.carousel.prev .time{
    animation: runningTime 3s linear 1 forwards;
}
@keyframes runningTime{
    from{ width: 100%}
    to{width: 0}
}


/* prev click */

.carousel.prev .list .item:nth-child(2){
    z-index: 2;
}

.carousel.prev .list .item:nth-child(2) img{
    animation: outFrame 0.5s linear 1 forwards;
    position: absolute;
    bottom: 0;
    left: 0;
}
@keyframes outFrame{
    to{
        width: 150px;
        height: 220px;
        bottom: 50px;
        left: 50%;
        border-radius: 20px;
    }
}

.carousel.prev .thumbnail .item:nth-child(1){
    overflow: hidden;
    opacity: 0;
    animation: showThumbnail .5s linear 1 forwards;
}
.carousel.next .arrows button,
.carousel.prev .arrows button{
    pointer-events: none;
}
.carousel.prev .list .item:nth-child(2) .content .author,
.carousel.prev .list .item:nth-child(2) .content .title,
.carousel.prev .list .item:nth-child(2) .content .topic,
.carousel.prev .list .item:nth-child(2) .content .des,
.carousel.prev .list .item:nth-child(2) .content .buttons
{
    animation: contentOut 1.5s linear 1 forwards!important;
}

@keyframes contentOut{
    to{
        transform: translateY(-150px);
        filter: blur(20px);
        opacity: 0;
    }
}
@media screen and (max-width: 678px) {
    .carousel .list .item .content{
        padding-right: 0;
    }
    .carousel .list .item .content .title{
        font-size: 30px;
    }

    .thumbnail .item{
        width: 120px;
        height: 150px;
    }
}

</style>

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
    <div class="container px-4 py-16 flex flex-col-reverse lg:flex-row items-center justify-between">
      <div class="row items-center">
        <div class="lg:col-6">
          <h3 class="banner-title">

          </h3>
          <p class="mt-6" id="banner-description">

          </p>
          <a class="btn btn-primary mt-8" href="{{ route('about') }}">Selengkapnya</a>
        </div>
        <div class="lg:col-6 lg:w-1/2 flex justify-center">
          <div class="col col-md-3 p-8 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
            <img decoding="async" src="https://anugrahhotel.com/wp-content/uploads/2023/07/Anugrah-Hotel-1.jpg" alt="" class="w-[60vh] mt-90 mb-30">
          </div>
          <div class=" col col-md-3 animate-box fadeInUp animated" data-animate-effect="fadeInUp">
              <img decoding="async" src="https://anugrahhotel.com/wp-content/uploads/2023/07/Anugrah-Hotel-3.jpg" alt="" class="w-[60vh] mt-90 mb-30">
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
          <h2>Artikel Terbaru</h2>
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
          <div class="reviews-carousel">
            <div class="swiper-wrapper" id="artikel_container">

            </div>
            <!-- If we need pagination -->
            {{-- <div class="swiper-pagination reviews-carousel-pagination !bottom-0"></div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Reviews -->

  <!-- Key features -->
  <section class="section key-feature relative">
    <img
      class="absolute left-0 top-0 -z-[1] -translate-y-1/2"
      src="{{ asset('assets/img/icons/feature-shape.svg') }}"
      alt=""
    />
    <div class="container">
      <div class="row justify-between text-center lg:text-start">
        <div class="lg:col-5">
          <h2>The Highlighting Part Of Our Solution</h2>
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
  </section>
  <!-- ./end Key features -->

  <!-- Services -->
  <section class="section services">
    <div class="container">
      <div class="tab row gx-5 items-center" data-tab-group="integration-tab">
        <div class="lg:col-7 lg:order-2">
          <div class="tab-content" data-tab-content>
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
        <div class="mt-6 lg:col-5 lg:order-1 lg:mt-0">
          <div class="text-container">
            <h2 class="lg:text-4xl">
              Prevent failure from to impacting your reputation
            </h2>
            <p class="mt-4">
              Our platform helps you build secure onboarding authentication
              experiences that retain and engage your users. We build the
              infrastructure, you can.
            </p>
            <ul class="tab-nav -ml-4 mt-8 border-b-0" data-tab-nav>
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
          <div class="relative">
            <img class="w-full object-contain" src="{{ asset('assets/img/collaboration.png') }}" />
            <img
              class="absolute bottom-6 left-1/2 -z-[1] -translate-x-1/2"
              src="{{ asset('assets/img/shape.svg') }}"
              alt=""
            />
          </div>
        </div>
        <div class="mt-6 lg:col-5 lg:mt-0">
          <div class="text-container">
            <h2 class="lg:text-4xl">
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
          <div class="video pb-5 pr-9">
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
          <div class="text-container">
            <h2 class="lg:text-4xl">Accountability that works for you</h2>
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
  </section>
  <!-- ./end Services -->



  <!-- Call To action -->
  <section class="px-5 py-20 xl:py-[120px]">
    <div class="container">
      <div
        class="bg-gradient row justify-center rounded-b-[80px] rounded-t-[20px] px-[30px] pb-[75px] pt-16"
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
  </section>
@endsection

@push('js')

<script src="{{ asset('assets/js/pages/landing-page.js') }}"></script>
@endpush
