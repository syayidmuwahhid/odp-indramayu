@extends('admin.layouts.app')
@section('title', 'Tambah Dokumen')

@section('content')

<div class="w-full px-6 py-6 mx-auto">
    <form action="/api/document" class="h-full flex flex-col" method="post" id="form_submit" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-6">
            <div class="p-6 min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <h5>Info Dokumen</h5>
                <div class="grid grid-cols-3 mb-6 mt-5">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Judul <span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle">
                        <input type="text" name="title" id="title" class="inputan" placeholder="Judul Dokumen" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 mb-6">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Tanggal Dokumen<span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle">
                        <input type="date" name="date" id="date" class="inputan" placeholder="Judul Aplikasi" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 mb-6">
                    <div></div><div></div><div></div>
                    <label class="flex items-center h-full">Pembuat <span class="text-sm text-red-500">*</span></label>
                    <div class="col-span-2 align-middle">
                        <input type="author" name="author" id="author" class="inputan" placeholder="Pembuat Dokumen" required>
                    </div>
                </div>
            </div>

            <div class="grid grid-row mb-6 min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6">
                    <h5>Upload Dokumen</h5>

                    <div class="grid grid-cols-3 mb-6 mt-5">
                        <div></div><div></div><div></div>
                        <label class="flex items-center h-full">Tipe Dokumen <span class="text-sm text-red-500">*</span></label>
                        <div class="col-span-2 align-middle">
                            <select class="inputan" name="type" id="type">
                                <option>Upload</option>
                                <option>Link</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 mb-6 mt-5" id="upload-container">
                        <div></div><div></div><div></div>
                        <label class="flex items-center h-full">Upload File <span class="text-sm text-red-500">*</span></label>
                        <div class="col-span-2 align-middle">
                            <input type="file" name="file" id="file" class="inputan" placeholder="Upload File" accept=".pdf" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 mb-6 mt-5" id="link-container" style="display: none">
                        <div></div><div></div><div></div>
                        <label class="flex items-center h-full">Link File <span class="text-sm text-red-500">*</span></label>
                        <div class="col-span-2 align-middle">
                            <input type="text" name="link" id="link" class="inputan" placeholder="Link Dokumen">
                        </div>
                    </div>

                    <div class="mt-5 flex justify-end">
                        <button class="text-white inline-flex items-center justify-center rounded-xl bg-green-500 py-3 px-6 font-dm text-base font-bold shadow-xl shadow-green-400 transition-transform duration-200 ease-in-out hover:scale-[1.02]">Simpan</button>
                    </div>

                </div>

            </div>
        </div>

    </form>
</div>

@endsection
@push('js')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script> --}}
    <script src="{{ asset('assets/js/pages/document-form.js') }}"></script>
@endpush
