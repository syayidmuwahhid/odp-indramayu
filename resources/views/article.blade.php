@extends('layouts.app')

@section('title', 'Artikel')

@push('css')

<link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">

@endpush

@section('content')

    <div class="jumbotronArticle">
        <div class="jumbotron-article-description" data-aos="fade-up" data-aos-duration="1200">
            <h5></h5>
            <h1>Artikel</h1>
        </div>
    </div>

    <section class="page-hero pt-16 pb-6 mt-10" data-aos="fade-up" data-aos-duration="1500">
        <div class="container">
        <div class="page-hero-content mx-auto max-w-[768px] text-center">
            <h1 class="mb-5 mt-8">
            Daftar Artikel
            </h1>
        </div>
        <div class="row justify-center">
            <div class="lg:col-10">
              <ul class="integration-tab filter-list justify-center" id="list-category"></ul>
            </div>
        </div>
        </div>
    </section>

    <section class="section pt-0" data-aos="fade-up" data-aos-duration="1500">
        <input type="hidden" id="category" value="{{ request()->get('category') }}">
        <input type="hidden" id="tag" value="{{ request()->get('tag') }}">
        <div class="container">
            <div class="row" id="article-container">

            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/js/pages/article-list.js') }}"></script>
@endpush
