@extends('admin.layouts.app')
@section('title', 'Pengaturan Sistem')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- tagify --}}
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <style>
        .tags-look .tagify__dropdown__item{
            display: inline-block;
            vertical-align: middle;
            border-radius: 3px;
            padding: .3em .5em;
            border: 1px solid #CCC;
            background: #F3F3F3;
            margin: .2em;
            font-size: .85em;
            color: black;
            transition: 0s;
        }

        .tags-look .tagify__dropdown__item--active{
            border-color: black;
        }

        .tags-look .tagify__dropdown__item:hover{
            background: lightyellow;
            border-color: gold;
        }

        .tags-look .tagify__dropdown__item--hidden {
            max-width: 0;
            max-height: initial;
            padding: .3em 0;
            margin: .2em 0;
            white-space: nowrap;
            text-indent: -20px;
            border: 0;
        }
    </style>
@endpush

@section('content')

<div class="w-full px-6 py-6 mx-auto">
    <form action="/api/profile/1" class="h-full flex flex-col" method="post" id="form_submit" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT" />

        <div class="grid grid-cols-2 gap-6">
            <div class="p-6 min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <h5>Data Aplikasi</h5>
                <div class="grid grid-cols-3 mb-6 mt-5">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Nama Aplikasi <span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle">
                        <input type="text" name="app_name" id="app_name" class="inputan" placeholder="Nama Aplikasi" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 mb-6">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Judul <span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle">
                        <input type="text" name="title" id="title" class="inputan" placeholder="Judul Aplikasi" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 mb-6">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Deskripsi <span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle">
                        <textarea rows="5" name="description" id="description" class="inputan" placeholder="Deskripsi Aplikasi" required></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-3 mb-6">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Logo <span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle flex flex-col justify-center items-center">
                        <img src="" alt="Logo" id="img_icon" style="width: 100%" class="mb-3"/>
                        <input type="file" name="icon" id="icon" class="inputan" accept="image/*">
                    </div>
                </div>

            </div>

            <div>
                <div class="grid grid-row mb-6 min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6">
                        <h5>Sosial Media</h5>

                        <div class="grid grid-cols-3 mb-6 mt-5">
                            <div></div><div></div><div></div>
                            <label class="flex items-center h-full">Facebook <span class="text-sm text-red-500">*</span></label>
                            <div class="col-span-2 align-middle">
                                <input type="text" name="facebook" id="facebook" class="inputan" placeholder="Link Facebook" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 mb-6 mt-5">
                            <div></div><div></div><div></div>
                            <label class="flex items-center h-full">Youtube <span class="text-sm text-red-500">*</span></label>
                            <div class="col-span-2 align-middle">
                                <input type="text" name="youtube" id="youtube" class="inputan" placeholder="Link Youtube" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 mb-6 mt-5">
                            <div></div><div></div><div></div>
                            <label class="flex items-center h-full">Instagram <span class="text-sm text-red-500">*</span></label>
                            <div class="col-span-2 align-middle">
                                <input type="text" name="instagram" id="instagram" class="inputan" placeholder="Link Instagram" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 mb-6 mt-5">
                            <div></div><div></div><div></div>
                            <label class="flex items-center h-full">X (Twitter) <span class="text-sm text-red-500">*</span></label>
                            <div class="col-span-2 align-middle">
                                <input type="text" name="x" id="x" class="inputan" placeholder="Link X (Twitter)" required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="grid grid-row mb-6 min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6">
                        <h5>Search Engine Optimization (SEO)</h5>

                        <div class="grid grid-cols-3 mb-6 mt-5">
                            <div></div><div></div><div></div>
                            <label class="flex items-center h-full">Keyword <span class="text-sm text-red-500">*</span></label>
                            <div class="col-span-2 align-middle">
                                <input type="text" name="keywords" id="keywords" class="inputan tagify--custom-dropdown" placeholder="Kata Kunci Pencarian" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 mb-6 mt-5">
                            <div></div><div></div><div></div>
                            <label class="flex items-center h-full">Tags <span class="text-sm text-red-500">*</span></label>
                            <div class="col-span-2 align-middle">
                                <input type="text" name="tags" id="tags" class="inputan tagify--custom-dropdown" placeholder="Tags Terkait Aplikasi" required>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>


        <div class="p-6 min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <h5>Data Kabupaten Indramayu</h5>
            <div class="grid grid-cols-4 mb-6 mt-5">
                <div></div><div></div><div></div><div></div>
                <label class="flex items-center h-full">Visi <span class="text-sm text-red-500">*</span></label>
                <div class="col-span-3 align-middle">
                    <input type="text" name="visi" id="visi" class="inputan" placeholder="Visi" required>
                </div>
            </div>

            <div class="grid grid-cols-4 mb-6">
                <div></div><div></div><div></div><div></div>
                <label class="flex items-center h-full">Misi <span class="text-sm text-red-500">*</span></label>
                <div class="col-span-3 align-middle">
                    <div id="misi"></div>
                </div>
            </div>

            <div class="grid grid-cols-4 mb-6">
                <div></div><div></div><div></div><div></div>
                <label class="flex items-center h-full">Sejarah <span class="text-sm text-red-500">*</span></label>
                <div class="col-span-3 align-middle">
                    <div id="history"></div>
                </div>
            </div>

            <div class="grid grid-cols-4 mb-6">
                <div></div><div></div><div></div><div></div>
                <label class="flex items-center h-full">Demografi <span class="text-sm text-red-500">*</span></label>
                <div class="col-span-3 align-middle">
                    <div id="demografi"></div>
                </div>
            </div>

            <div class="grid grid-cols-4 mb-6">
                <div></div><div></div><div></div><div></div>
                <label class="flex items-center h-full">Geografi <span class="text-sm text-red-500">*</span></label>
                <div class="col-span-3 align-middle">
                    <div id="geografi"></div>
                </div>
            </div>


            <div class="mt-5 flex justify-end">
                <button
                    class="text-white inline-flex items-center justify-center rounded-xl bg-green-500 py-3 px-6 font-dm text-base font-bold shadow-xl shadow-green-400 transition-transform duration-200 ease-in-out hover:scale-[1.02]">Simpan</button>
            </div>

        </div>

    </form>
</div>

@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script src="{{ asset('assets/js/pages/setting-index.js') }}"></script>
@endpush
