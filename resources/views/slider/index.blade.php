@extends('layouts.app')
@section('title', 'Slider')

@section('content')
<div class="w-full px-6 py-6 mx-auto">
    <!-- table 1 -->

    <div class="flex flex-wrap -mx-3">
      <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="p-6 pb-0 mb-7 flex justify-between bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <h6>Slider</h6>

            {{-- button modal --}}
            <button id="btnAddModal" type="button" class="inline-block px-8 py-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs border-green-500 text-green-500 hover:text-green-900 hover:opacity-75 hover:shadow-none active:scale-100 active:border-green-900 active:bg-green-900 active:text-white hover:active:border-green-900 hover:active:bg-transparent hover:active:text-green-900 hover:active:opacity-75">
              Tambah
            </button>

          </div>
          <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
              <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                <thead class="align-bottom">
                  <tr>
                    <th class="text-center px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      No
                    </th>
                    <th class="px-6 py-3 pl-5 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                      Gambar
                    </th>
                    <th class="px-13 py-3 font-bold uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 text-left">
                      Judul
                    </th>
                    <th class="px-13 py-3 font-bold uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 text-left">
                      Deskripsi
                    </th>
                    <th class="px-6 py-3 font-bold uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">
                      Aksi
                    </th>
                    {{-- <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th> --}}
                  </tr>
                </thead>
                <tbody id="tbody_data">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@push('js')
<script src="{{ asset('assets/js/pages/slider-index.js') }}"></script>
@endpush
