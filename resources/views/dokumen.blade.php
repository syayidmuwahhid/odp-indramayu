@extends('layouts.app')

@section('title', 'Dokumen | ')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">
<link href="https://cdn.datatables.net/v/dt/dt-2.0.8/b-3.0.2/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/datatables.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="jumbotronDokumen">
    <div class="jumbotron-dokumen-description" data-aos="fade-up" data-aos-duration="1200">
        <h5></h5>
        <h1>Dokumen</h1>
    </div>
</div>

<section class="section document relative">
    <div class="container mx-auto my-6" data-aos="fade-up" data-aos-duration="1200">
        <div class="overflow-x-auto">
            <div class="min-w-screen bg-white flex items-center justify-center font-sans overflow-hidden p-4">
                <div class="w-full lg:w-5/6 dark:text-white">
                    <div class="bg-white  rounded my-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-max w-full table-auto" id="document_table">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Nama Dokumen</th>
                                        <th class="py-3 px-6 text-left">Pembuat</th>
                                        <th class="py-3 px-6 text-left">Tanggal Dokumen</th>
                                        <th class="py-3 px-6 text-center">Download</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light" id="tbody_document">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script src="https://cdn.datatables.net/v/dt/dt-2.0.8/b-3.0.2/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/sc-2.4.3/sb-1.7.1/sp-2.3.1/datatables.min.js"></script>
<script src="{{ asset('assets/js/pages/document.js') }}"></script>
@endpush
