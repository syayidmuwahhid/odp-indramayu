@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
    <section class="section pt-0">
        <input type="hidden" id="category" value="{{ request()->get('category') }}">
        <div class="container">
            <div class="row" id="article-container">

            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="{{ asset('assets/js/pages/article-list.js') }}"></script>
@endpush
