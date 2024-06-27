@extends('layouts.app')

@section('title', 'Dokumen')

@push('css')

<link rel="stylesheet" href="{{ asset('assets/css/landing-page.css') }}">

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
            <div class="min-w-screen bg-white flex items-center justify-center font-sans overflow-hidden">
                <div class="w-full lg:w-5/6">
                    <div class="bg-white shadow-md rounded my-6">
                        <div class="flex items-center justify-between py-3 px-6">
                            <div>
                                <label for="perPage" class="mr-2">Display</label>
                                <select id="perPage" class="border border-gray-300 rounded px-6">
                                    <option>25</option>
                                    <option>50</option>
                                    <option>100</option>
                                </select>
                            </div>
                            <div>
                                <input type="text" placeholder="Search..." class="border border-gray-300 rounded p-2"/>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">Nama Dokumen</th>
                                        <th class="py-3 px-6 text-left">Kategori</th>
                                        <th class="py-3 px-6 text-left">Tanggal Upload</th>
                                        <th class="py-3 px-6 text-center">Download</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 18H5V4h7v16zm7-4h-5V4h5v12zm-6-6H5V4h8v6z"/>
                                            </svg>
                                            <span class="ml-2">LAKIP BPBD TAHUN 2023</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <a href="#" class="text-blue-500">Dokumen</a>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            14 Mei 2024
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded">Download</button>
                                        </td>
                                    </tr>
                                    <!-- Repeat the above <tr> block for each row in the table -->
                                    <!-- Example rows -->
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 18H5V4h7v16zm7-4h-5V4h5v12zm-6-6H5V4h8v6z"/>
                                            </svg>
                                            <span class="ml-2">LAKIP DISPORA TAHUN 2023</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <a href="#" class="text-blue-500">Dokumen</a>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            14 Mei 2024
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded">Download</button>
                                        </td>
                                    </tr>
                                    <!-- More rows here -->
                                </tbody>
                            </table>
                        </div>
                        <div class="py-3 px-6 border-t border-gray-200 bg-white">
                            <div class="flex flex-col sm:flex-row items-center justify-between">
                                <span>Showing 1 to 10 of 50 entries</span>
                                <div class="inline-flex mt-2 sm:mt-0">
                                    <button class="mr-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                        Prev
                                    </button>
                                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')

@endpush