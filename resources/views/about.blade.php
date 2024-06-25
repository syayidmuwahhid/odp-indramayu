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
    #history p, #misi p {
        text-indent: 2rem;
        text-align: justify;
        margin-bottom: 1rem;
    }
</style>

@section('content')
<!-- Common hero -->
<section class="page-hero pb-16">
  <div class="container">
    <div class="page-hero-content mx-auto max-w-[768px] text-center">
      <h1 class="mb-5 mt-8" id="title"> </h1>
      <p id="description">

      </p>
    </div>
  </div>
</section>
<!-- end Common hero -->

{{-- History --}}
<section class="section banner relative">
    <div class="flex flex-col justify-center items-center">
        <h4 class="text-center text-4xl mb-8 banner-title">
            History
        </h4>
        <div class=" w-4/5 shadow-lg px-16 py-12" id="history">

        </div>
    </div>
</section>
<!-- ./end History -->


{{-- Visi --}}
<section class="section banner relative">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title">
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
<section class="section banner relative">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title">
            Misi
        </h4>
        <div class="w-4/5 shadow-lg px-16 py-12" id="misi">

        </div>
    </div>
</section>
<!-- ./end Misi -->

{{-- Geografi --}}
<section class="section banner relative">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title">
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
<section class="section banner relative">
    <div class="flex flex-col items-center">
        <h4 class="text-center text-4xl mb-8 banner-title">
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
