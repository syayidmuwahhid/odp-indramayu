@extends('layouts.app')
@section('title', 'tambah data article')
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
                        <h6>form tambah article</h6>
                    </div>
                    <div class="p-6 space-y-6">
                        <form action="#" class="h-full flex flex-col">
                            <div class="grid grid-cols-6 gap-6 h-full">

                                {{-- title --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="product-name"
                                        class="text-sm font-medium text-gray-900 block mb-2">Title</label>
                                    <input type="text" name="title" id="product-name" class="inputan"
                                        placeholder="tambahkan judul artikel" required>
                                </div>
                                {{-- kategory --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category"
                                        class="text-sm font-medium text-gray-900 block mb-2">Kategori</label>
                                    <select name="category_id" id="select_category" class="inputan" required>
                                    </select>
                                </div>
                                {{-- foto --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="foto" class="text-sm font-medium text-gray-900 block mb-2">Foto</label>
                                    <input type="file" name="foto" id="foto" class="inputan" accept="image/*">
                                </div>
                                {{-- vidio --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="video" class="text-sm font-medium text-gray-900 block mb-2">Vidio</label>
                                    <input type="file" name="video" id="video" class="inputan" accept="video/*">
                                </div>
                                {{-- tanggal --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="date"
                                        class="text-sm font-medium text-gray-900 block mb-2">Tanggal</label>
                                    <input type="date" name="date" id="date" class="inputan" required="">
                                </div>
                                {{-- tag --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="price" class="text-sm font-medium text-gray-900 block mb-2">Tag</label>
                                    <input name='tags' id="tag-input" value='' placeholder='Add tags' class="inputan">
                                </div>
                                {{-- content --}}
                                <div class="col-span-full">
                                    <label for="content"
                                        class="text-sm font-medium text-gray-900 block mb-2">Content</label>
                                    <div class="">
                                        <div id="editor" class="h-96"></div>
                                    </div>

                                </div>
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
    <script src="{{ asset('assets/js/pages/article-form.js') }}"></script>
    {{-- tagify --}}
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.getElementById('tag-input');
        var tagify = new Tagify(input);
        var tagify = new Tagify(input, {
            whitelist: ["tag1", "tag2", "tag3"], // Daftar tag yang diizinkan
            maxTags: 5, // Maksimum jumlah tag yang bisa ditambahkan
            backspace: "edit", // Aksi saat menekan tombol backspace
            placeholder: "Type to add a tag"
        });
        tagify.on('add', function(e) {
            console.log("Tag added:", e.detail.data);
        });
    </script>
@endpush
