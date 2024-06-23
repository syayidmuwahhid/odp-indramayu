@extends('admin.layouts.app')
@section('title', 'Update data article')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- tagify --}}
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

    <div class="w-full px-6 py-6 mx-auto ">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3 ">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div
                        class="capitalize p-6 pb-0 mb-0 flex justify-between bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>form edit article</h6>
                    </div>
                    <div class="p-6 space-y-6">
                        <form action="/api/article/{{ $id }}" class="h-full flex flex-col" method="post" id="form_submit" enctype="multipart/form-data">
                            <input type="hidden" id="article_id" value="{{ $id }}">
                            <div class="grid grid-cols-6 gap-6 h-full">

                                {{-- title --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="product-name"
                                        class="text-sm font-medium text-gray-900 block mb-2">Judul <span class="text-sm text-red-500">*</span></label>
                                    <input type="text" name="title" id="title" class="inputan"
                                        placeholder="tambahkan judul artikel" required>
                                </div>
                                {{-- kategory --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category"
                                        class="text-sm font-medium text-gray-900 block mb-2">Kategori <span class="text-sm text-red-500">*</span></label>
                                    <select name="category_id" id="select_category" class="inputan" required>
                                    </select>
                                </div>
                                {{-- date --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="date"
                                    class="text-sm font-medium text-gray-900 block mb-2">Tanggal Artikel <span class="text-sm text-red-500">*</span></label>
                                    <input type="date" name="date" id="date" class="inputan" required="" value="{{ date('Y-m-d') }}">
                                </div>
                                {{-- tag --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Tag Artikel <span class="text-sm text-red-500">*</span></label>
                                    <input id="tag-input" placeholder="Tag Artikel" class="inputan">
                                </div>
                                {{-- content --}}
                                <div class="col-span-full">
                                    <label for="content"
                                    class="text-sm font-medium text-gray-900 block mb-2">Isi Artikel <span class="text-sm text-red-500">*</span></label>
                                    <div id="editor"></div>
                                </div>
                                {{-- foto --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="foto" class="text-sm font-medium text-gray-900 block mb-2">Foto</label>
                                    <input type="file" name="image" id="foto" class="inputan" accept="image/*">
                                </div>
                                {{-- vidio --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="video" class="text-sm font-medium text-gray-900 block mb-2">Video</label>
                                    <input type="file" name="video" id="video" class="inputan" accept="video/*">
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                            </div>
                            <div class="mt-5 flex justify-end">
                                <button
                                    class="text-white inline-flex items-center justify-center rounded-xl bg-green-500 py-3 px-6 font-dm text-base font-bold shadow-xl shadow-green-400 transition-transform duration-200 ease-in-out hover:scale-[1.02]">Simpan</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/pages/article-edit.js') }}"></script>
    {{-- tagify --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
@endpush
