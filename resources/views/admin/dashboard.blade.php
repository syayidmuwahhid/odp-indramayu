@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- cards -->
<div class="w-full px-6 py-6 mx-auto">
    <!-- row 1 -->
    <div class="flex flex-wrap -mx-3">
        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Pengguna</p>
                        <h5 class="mb-0 font-bold" id="user_count">
                            0
                            {{-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+5%</span> --}}
                        </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-cyan-300">
                            <i class="leading-none fa fa-users text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans text-sm font-semibold leading-normal">Artikel</p>
                                <h5 class="mb-0 font-bold" id="article_count">
                                    0
                                    {{-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+55%</span> --}}
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-cyan-300">
                                <i class="leading-none fa fa-newspaper-o text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Kategori Artikel</p>
                        <h5 class="mb-0 font-bold" id="category_count">
                            0
                            {{-- <span class="text-sm leading-normal text-red-600 font-weight-bolder">-2%</span> --}}
                        </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-cyan-300">
                        <i class="leading-none fa fa-th-large text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Dokumen</p>
                        <h5 class="mb-0 font-bold" id="document_count">
                            0
                            {{-- <span class="text-sm leading-normal font-weight-bolder text-lime-500">+3%</span> --}}
                        </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-500 to-cyan-300">
                        <i class="fa fa-file-text-o leading-none text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- cards row 2 -->
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                            <div class="flex flex-col h-full">
                                <h5 class="font-bold">{{ \App\Helpers\AnyHelpers::AppInfo()->title }}</h5>
                                <p class="mb-6" id="dashboard_desc">{{ \App\Helpers\AnyHelpers::AppInfo()->description }}</p>
                                <a class="mt-auto mb-0 text-sm font-semibold leading-normal group text-slate-500" href="{{ route('about') }}">
                                    Selengkapnya
                                    <i class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200"></i>
                                </a>
                            </div>
                        </div>
                        <div class="max-w-full px-3 mt-6 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                            <div class="h-full rounded-xl">
                                <img src="{{ asset('assets/img/shapes/waves-white.svg') }}" class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves" />
                                <div class="relative flex items-center justify-center h-full">
                                    <img class="relative z-20 w-full pt-6" src="{{ \App\Helpers\AnyHelpers::AppInfo()->icon }}" alt="rocket" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                <div class="flex-auto p-4">
                    <h5 class="font-bold">Artikel dibuat</h5>
                    <div class="py-4 pr-1 bg-gradient-to-tl from-gray-900 to-slate-800 rounded-xl">
                        <div>
                            <canvas id="chart-bars" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cards row 3 -->
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
                <div class="relative h-full overflow-hidden bg-cover rounded-xl" style="background-image: url('./assets/img/ivancik.jpg')" id="article_image">
                    <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                    <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                        <h5 class="pt-2 mb-6 font-bold text-white" id="article_title"></h5>
                        <p class="text-white" id="article_content"></p>
                        <a class="mt-auto mb-0 text-sm font-semibold leading-normal text-white group" href="javascript:;" id="article_link">
                            Lihat Halaman
                            <i class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
            <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6>Artikel terbanyak dilihat</h6>
                <p class="text-sm leading-normal">
                tahun {{ now()->year }}
                </p>
            </div>
            <div class="flex-auto p-4">
                <div>
                <canvas id="chart-line" height="300"></canvas>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- cards row 4 -->

    <div class="flex flex-wrap my-6 -mx-3">
    <!-- card 1 -->

    <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none">
        <div class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
            <div class="flex flex-wrap mt-0 -mx-3">
            <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                <h6>Artikel Terbaru</h6>
            </div>
            </div>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="px-10 overflow-x-auto">
            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                <tr>
                    <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Judul Artikel</th>
                    <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Kategori</th>
                    <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Dibuat Oleh</th>
                </tr>
                </thead>
                <tbody id="tbody_article">

                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>

    <!-- card 2 -->

    <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none lg:w-1/3 lg:flex-none">
        <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
            <h6>Dokumen Terbaru</h6>
        </div>
        <div class="flex-auto p-4">
            <div id="doc_container" class="before:border-r-solid relative before:absolute before:top-0 before:left-4 before:h-full before:border-r-2 before:border-r-slate-100 before:content-[''] before:lg:-ml-px">

            </div>
        </div>
        </div>
    </div>
    </div>

</div>
@endsection

@push('js')
  <!-- plugin for charts  -->
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>

  <script src="{{ asset('assets/js/pages/dashboard.js') }}" async></script>
  {{-- <script src="{{ asset('assets/js/chart-1.js') }}" async></script> --}}
@endpush
