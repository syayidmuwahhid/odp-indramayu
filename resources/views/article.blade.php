@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')

    <section class="section pt-0">
        <div class="container">

            <h2 class="h4 mb-4">Artikel Terbaru</h2>
            <div class="row" id="article-container">

            </div>
        </div>
    </section>
    <div
        class="fixed left-0 top-0 z-50 flex w-[30px] items-center justify-center bg-gray-200 py-[2.5px] text-[12px] uppercase text-black sm:bg-red-200 md:bg-yellow-200 lg:bg-green-200 xl:bg-blue-200 2xl:bg-pink-200">
        <span class="block sm:hidden">all</span>
        <span class="hidden sm:block md:hidden">sm</span>
        <span class="hidden md:block lg:hidden">md</span>
        <span class="hidden lg:block xl:hidden">lg</span>
        <span class="hidden xl:block 2xl:hidden">xl</span>
        <span class="hidden 2xl:block">2xl</span>
    </div>


@endsection

@push("js")
    <script src="{{ asset('assets/js/pages/article-list.js') }}"></script>
@endpush
