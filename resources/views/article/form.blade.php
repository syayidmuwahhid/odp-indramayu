@extends('layouts.app')
@section('title', 'tambah data article')


@section('content')

    <div class="w-full px-6 py-6 mx-auto ">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3 ">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div
                        class="capitalize p-6 pb-0 mb-0 flex justify-between bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>form tambah article</h6>
                    </div>
                    <div class="p-6 space-y-6">
                        <form action="#" class="h-full">
                            <div class="grid grid-cols-6 gap-6 h-full">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="product-name"
                                        class="text-sm font-medium text-gray-900 block mb-2">title</label>
                                    <input type="text" name="product-name" id="product-name"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="Apple Imac 27”" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category"
                                        class="text-sm font-medium text-gray-900 block mb-2">kategori</label>
                                    <input type="text" name="product-name" id="product-name"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="Apple Imac 27" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">foto</label>
                                    <input type="file" name="brand" id="brand"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="Apple" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="brand" class="text-sm font-medium text-gray-900 block mb-2">vidio</label>
                                    <input type="file" name="brand" id="brand"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="Apple" required="">
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="price"
                                        class="text-sm font-medium text-gray-900 block mb-2">tanggal</label>
                                    <input type="date" name="price" id="price"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"
                                        placeholder="$2300" required="">
                                </div>
                                <div class="col-span-full">
                                    <label for="product-details"
                                        class="text-sm font-medium text-gray-900 block mb-2">content</label>
                                    <div class="h-full bg-gray-100">
                                        <div id="editor" class="bg-red-200"></div>
                                    </div>

                                </div>

                            </div>
                            <button
                                class="mt-8 inline-flex items-center justify-center rounded-xl bg-red-600 py-3 px-6 font-dm text-base font-medium shadow-xl shadow-green-400 transition-transform duration-200 ease-in-out hover:scale-[1.02]">kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="{{ asset('assets/js/pages/article-form.js') }}"></script>
@endpush
