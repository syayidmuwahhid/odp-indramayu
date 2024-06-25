@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<img
  class="floating-bubble-1 absolute right-0 top-0 -z-[1]"
  src="{{ asset('assets/img//floating-bubble-1.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-2 absolute left-0 top-[387px] -z-[1]"
  src="{{ asset('assets/img//floating-bubble-2.svg') }}"
  alt=""
/>
<img
  class="floating-bubble-3 absolute right-0 top-[605px] -z-[1]"
  src="{{ asset('assets/img//floating-bubble-3.svg') }}"
  alt=""
/>
<!-- ./end floating assets -->

<!-- Common hero -->
<section class="page-hero py-16">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
      <h1 class="mb-5 mt-8" id="title"></h1>
      <p id="description"></p>
    </div>
  </div>
</section>
<!-- end Common hero -->

<!-- Gallery -->
<section class="section">
  <div class="container">
    <div class="row justify-center text-center">
      <div class="col-8">
        <h2>We started with one single goal Empower entrepreneurs</h2>
      </div>
    </div>
    <div class="row mt-2.5">
      <div class="md:col-6">
        <div class="relative mt-8">
          <img
            class="w-full object-cover"
            width="480"
            height="328"
            src="{{ asset('assets/img/about/gallery-img-1.png') }}"
            alt=""
          />
        </div>
        <div class="relative mt-8">
          <img
            class="w-full object-cover"
            width="480"
            height="274"
            src="images/about/gallery-img-2.png"
            alt=""
          />
          <img
            class="absolute -bottom-5 -left-5 -z-[1]"
            src="images/shape-2.svg"
            alt=""
          />
        </div>
      </div>
      <div class="md:col-6">
        <div class="relative mt-8">
          <img
            class="w-full object-cover"
            width="480"
            height="540"
            src="images/about/gallery-img-3.png"
            alt=""
          />
          <img
            class="absolute -bottom-4 -right-5 -z-[1] h-16 w-16"
            src="images/shape.svg"
            alt=""
          />
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Gallery -->

<!-- Works -->
<section class="section">
  <div class="container">
    <div class="row items-center justify-between">
      <div class="md:col-5">
        <h2 class="text-center md:text-left">
          The six core work <br />
          drive everything do
        </h2>
      </div>
      <div class="mt-6 text-center md:col-3 md:mt-0 md:text-right">
        <a class="btn btn-primary" href="#">Download The Theme</a>
      </div>
    </div>
    <div class="row mt-14">
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >01</span
            >
            <img src="images/gradient-number-bg.svg" alt="" />
          </div>
          <h4 class="my-6">Accessibility</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. posuere cubilia Cudfrae Donec
            velit neque, autor sit amet aliuam vel
          </p>
        </div>
      </div>
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >02</span
            >
            <img src="images/gradient-number-bg.svg" alt="" />
          </div>
          <h4 class="my-6">Empowerement</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. posuere cubilia Cudfrae Donec
            velit neque, autor sit amet aliuam vel
          </p>
        </div>
      </div>
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >03</span
            >
            <img src="images/gradient-number-bg.svg" alt="" />
          </div>
          <h4 class="my-6">Innovation</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. posuere cubilia Cudfrae Donec
            velit neque, autor sit amet aliuam vel
          </p>
        </div>
      </div>
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >04</span
            >
            <img src="images/gradient-number-bg.svg" alt="" />
          </div>
          <h4 class="my-6">Excellence</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. posuere cubilia Cudfrae Donec
            velit neque, autor sit amet aliuam vel
          </p>
        </div>
      </div>
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >05</span
            >
            <img src="images/gradient-number-bg.svg" alt="" />
          </div>
          <h4 class="my-6">Team work</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. posuere cubilia Cudfrae Donec
            velit neque, autor sit amet aliuam vel
          </p>
        </div>
      </div>
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >06</span
            >
            <img src="images/gradient-number-bg.svg" alt="" />
          </div>
          <h4 class="my-6">Responsibility</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. posuere cubilia Cudfrae Donec
            velit neque, autor sit amet aliuam vel
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ./end Works -->

<!-- Members -->
<section class="section">
  <div class="container">
    <div class="row">
      <div class="mx-auto text-center lg:col-6">
        <h2>This is who we are</h2>
        <p class="mt-4">
          Donec sollicitudin molestie malesda. Donec sollitudin mol estie
          ultricies ligula sed magna dictum
        </p>
      </div>
    </div>
    <div class="row mt-12 justify-center">
      <div class="lg:col-10">
        <div class="row">
          <div
            class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center"
          >
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rouded-full h-28 w-28"
                src="images/users/user-1.png"
                alt=""
              />
            </div>
            <div
              class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg"
            >
              <h5 class="font-primary">Eleanor Pena</h5>
              <p class="mt-1.5">Co-founder & COO</p>
            </div>
          </div>
          <div
            class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center"
          >
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rouded-full h-28 w-28"
                src="images/users/user-2.png"
                alt=""
              />
            </div>
            <div
              class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg"
            >
              <h5 class="font-primary">Savannah Nguyen</h5>
              <p class="mt-1.5">Head of Infrastructure</p>
            </div>
          </div>
          <div
            class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center"
          >
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rouded-full h-28 w-28"
                src="images/users/user-3.png"
                alt=""
              />
            </div>
            <div
              class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg"
            >
              <h5 class="font-primary">Courtney Henry</h5>
              <p class="mt-1.5">Head of Brand Marketing</p>
            </div>
          </div>
          <div
            class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center"
          >
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rouded-full h-28 w-28"
                src="images/users/user-4.png"
                alt=""
              />
            </div>
            <div
              class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg"
            >
              <h5 class="font-primary">Floyd Miles</h5>
              <p class="mt-1.5">Head of Infrastructure</p>
            </div>
          </div>
          <div
            class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center"
          >
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rouded-full h-28 w-28"
                src="images/users/user-5.png"
                alt=""
              />
            </div>
            <div
              class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg"
            >
              <h5 class="font-primary">Robert Fox</h5>
              <p class="mt-1.5">Head of Product Design</p>
            </div>
          </div>
          <div
            class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center"
          >
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rouded-full h-28 w-28"
                src="images/users/user-6.png"
                alt=""
              />
            </div>
            <div
              class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg"
            >
              <h5 class="font-primary">Darrell Steward</h5>
              <p class="mt-1.5">Head of People & HR</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div
  class="fixed left-0 top-0 z-50 flex w-[30px] items-center justify-center bg-gray-200 py-[2.5px] text-[12px] uppercase text-black sm:bg-red-200 md:bg-yellow-200 lg:bg-green-200 xl:bg-blue-200 2xl:bg-pink-200"
>
  <span class="block sm:hidden">all</span>
  <span class="hidden sm:block md:hidden">sm</span>
  <span class="hidden md:block lg:hidden">md</span>
  <span class="hidden lg:block xl:hidden">lg</span>
  <span class="hidden xl:block 2xl:hidden">xl</span>
  <span class="hidden 2xl:block">2xl</span>
</div>

@endsection

@push('js')
    <script src="{{ asset('assets/js/pages/about.js') }}"></script>
@endpush
