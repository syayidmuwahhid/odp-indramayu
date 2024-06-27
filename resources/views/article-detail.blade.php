@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
    <section class="section blog-single">
        <div class="container" id="container" data-id="{{ $id }}" >
            <div class="row justify-center" class="">
                <div class="lg:col-10">
                    <img src="" alt="" id="article-image" class="mx-auto shadow-lg"/>
                </div>
                <div class="mt-10 max-w-[810px] lg:col-9">
                    <h1 class="h2" id="title">
                    </h1>

                        <div class="">
                            <p class="text-dark" id="username"></p>
                            <span class="text-sm flex" id="date"></span>
                        </div>

                    <div class="content" id="content">
                </div>
                <div class="flex gap-3" id="tags">
                    Tag :
                </div>
                <div class="mt-10 flex justify-center items-center">
                    <video class="media w-full" id="video" controls>
                        <source type="video/mp4">
                    </video>
                </div>
            </div>`
        </div>
    </section>

@endsection

@push('js')
    <script src="{{ asset('assets/js/pages/article-detail.js') }}"></script>
@endpush