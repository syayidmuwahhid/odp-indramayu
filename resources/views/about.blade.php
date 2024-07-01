@extends('layouts.app')

@section('title', 'Tentang | ')

@push('css')

<link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">

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
    #history p, #misi p {
        text-indent: 2rem;
        text-align: justify;
        margin-bottom: 1rem;
    }

@media (max-width: 768px) {
        #history p, #misi p, #demografi p {
        text-indent: 0;
        text-align: center;
        margin-bottom: 1rem;
        width: 100%;
    }
}

@media (max-width: 640px) {
    #history p, #misi p, #demografi p{
        text-indent: 0;
        text-align: center;
        margin-bottom: 1rem;
        width: 100%;
    }
}
</style>

@endpush

@section('content')

<div class="jumbotronAbout">
    <div class="jumbotron-about-description" data-aos="fade-up" data-aos-duration="2500">
        <h1 id="title"> </h1>
        <h5 id="description"> </h5>
    </div>
</div>

<!-- Common hero -->
{{-- <section class="page-hero pb-16 mt-40" data-aos="fade-up" data-aos-duration="1500">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
      <h1 class="mb-5 mt-8" id="title"> </h1>
      <p id="description">

      </p>
    </div>
  </div>
</section> --}}
<!-- end Common hero -->

{{-- History --}}
<section class="section banner relative" data-aos="fade-up" data-aos-duration="1500">
    <div class="flex flex-col justify-center items-center">
        <h4 class="text-center text-4xl mb-8 banner-title text-orange-600">
            Sejarah
        </h4>
        <div class=" w-4/5 shadow-lg px-16 py-12" id="history">

        </div>
    </div>
</section>
<!-- ./end History -->


{{-- Visi --}}
<section class="section banner relative" data-aos="fade-up" data-aos-duration="1500">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title text-orange-600">
            Visi
        </h4>
        <div class="w-4/5">
            <p class="text-center" id="visi">
            </p>
        </div>
    </div>
</section>
<!-- ./end Visi -->


{{-- Misi --}}
<section class="section banner relative" data-aos="fade-up" data-aos-duration="1500">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title text-orange-600">
            Misi
        </h4>
        <div class="w-4/5 shadow-lg px-16 py-12" id="misi">

        </div>
    </div>
</section>
<!-- ./end Misi -->

{{-- Geografi --}}
<section class="section banner relative" data-aos="fade-up" data-aos-duration="1500">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title text-orange-600">
            Geografi
        </h4>
        <div class="w-4/5">
            <p class="text-center" id="geografi">
            </p>
        </div>
    </div>
</section>
<!-- ./end Geografi -->

{{-- Demografi --}}
<section class="section banner relative" data-aos="fade-up" data-aos-duration="1500">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title text-orange-600">
            Demografi
        </h4>
        <div class="w-4/5 shadow-lg px-16 py-12" id="demografi">

        </div>
    </div>
</section>
<!-- ./end Demografi -->

@endsection

@push('js')
    <script src="{{ asset('assets/js/pages/about.js') }}"></script>
@endpush
