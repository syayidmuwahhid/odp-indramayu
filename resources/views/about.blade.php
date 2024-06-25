@extends('layouts.app')

@section('title', 'Landing Page')

<style>
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .left-column,
    .right-column {
        background-color: #f9f9f9;
        padding: 20px;
    }
    #history p {
        text-indent: 1rem;
        text-align: justify;
        margin-bottom: 1rem;
    }
</style>

@section('content')
<!-- Common hero -->
<section class="page-hero pb-16">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
      <h1 class="mb-5 mt-8" id="title">Empowering Entrepreneurs</h1>
      <p id="description">Our mission is to provide the tools and support needed for entrepreneurs to succeed in their ventures.</p>
    </div>
  </div>
</section>
<!-- end Common hero -->

{{-- banner --}}
<section class="section banner relative bg-gray-300">
    <div class="container bg-red-500 items-center">
        <h4 class="text-center mb-8 banner-title">
            History
        </h4>
        <div class="bg-green-300 items-center p-5 w-2/4" id="history">

        </div>
    </div>
</section>
  <!-- ./end Banner -->

<!-- Gallery -->
<section class="section">
  <div class="container">
    <div class="row justify-center text-center">
      <div class="col-8">
        <h2>We started with one single goal: Empower entrepreneurs</h2>
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
            src="{{ asset('assets/img/about/gallery-img-2.png') }}"
            alt=""
          />
          <img
            class="absolute -bottom-5 -left-5 -z-[1]"
            src="{{ asset('assets/img/shape-2.svg') }}"
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
            src="{{ asset('assets/img/about/gallery-img-3.png') }}"
            alt=""
          />
          <img
            class="absolute -bottom-4 -right-5 -z-[1] h-16 w-16"
            src="{{ asset('assets/img/shape.svg') }}"
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
          The six core work principles <br />
          drive everything we do
        </h2>
      </div>
      <div class="mt-6 text-center md:col-3 md:mt-0 md:text-right">
        <a class="btn btn-primary" href="#">Download The Theme</a>
      </div>
    </div>
    <div class="row mt-14">
      @foreach(['Accessibility', 'Empowerment', 'Innovation', 'Excellence', 'Team work', 'Responsibility'] as $index => $principle)
      <div class="mb-8 sm:col-6 lg:col-4">
        <div class="rounded-xl bg-white p-6 shadow-lg lg:p-8">
          <div class="gradient-number relative inline-block">
            <span
              class="bg-gradient absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
              >0{{ $index + 1 }}</span
            >
            <img src="{{ asset('assets/img/gradient-number-bg.svg') }}" alt="" />
          </div>
          <h4 class="my-6">{{ $principle }}</h4>
          <p>
            Nulla porttitor acmsan tinci dunt. Posuere cubilia Cudfrae Donec
            velit neque, auctor sit amet aliquam vel
          </p>
        </div>
      </div>
      @endforeach
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
          Donec sollicitudin molestie malesuada. Donec sollicitudin molestie ultricies ligula sed magna dictum
        </p>
      </div>
    </div>
    <div class="row mt-12 justify-center">
      <div class="lg:col-10">
        <div class="row">
          @foreach([['Eleanor Pena', 'Co-founder & COO', 'user-1.png'], ['Savannah Nguyen', 'Head of Infrastructure', 'user-2.png'], ['Courtney Henry', 'Head of Brand Marketing', 'user-3.png'], ['Floyd Miles', 'Head of Infrastructure', 'user-4.png'], ['Robert Fox', 'Head of Product Design', 'user-5.png'], ['Darrell Steward', 'Head of People & HR', 'user-6.png']] as $member)
          <div class="mb-6 flex flex-col px-6 text-center sm:col-6 lg:col-4 sm:items-center">
            <div class="member-avatar inline-flex justify-center">
              <img
                class="rounded-full h-28 w-28"
                src="{{ asset('assets/img/users/' . $member[2]) }}"
                alt="{{ $member[0] }}"
              />
            </div>
            <div class="mt-6 w-full flex-1 rounded-xl bg-white py-8 px-4 shadow-lg">
              <h5 class="font-primary">{{ $member[0] }}</h5>
              <p class="mt-1.5">{{ $member[1] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('js')
    <script src="{{ asset('assets/js/pages/about.js') }}"></script>
@endpush
