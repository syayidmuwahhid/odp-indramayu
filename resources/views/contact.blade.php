@extends('layouts.app')

@section('title', 'Kontak');

@section('content')
<section class="page-hero pt-16 pb-6">
    <div class="container">
      <div class="page-hero-content mx-auto max-w-[768px] text-center">
        <h1 class="mb-5 mt-8">
          Hubungi Kami
        </h1>
      </div>
    </div>
  </section>
  <!-- end Common hero -->

  <section class="section pt-0">
    <div class="container">
      <div class="row">
        <div class="mb-10 text-center md:col-6 md:order-2 md:mb-0 md:pt-9">
          <div class="contact-img relative inline-flex pl-5 pb-5">
            <img src="{{ asset('assets/img/contact-img.png') }}" alt="" />
            <img
              class="absolute bottom-0 left-0 -z-[1] h-14 w-14"
              src="{{ asset('assets/img/shape-2.svg') }}"
              alt=""
            />
          </div>
        </div>
        <div class="md:col-6 md:order-1">
          <form class="lg:max-w-[484px]" action="/api/send-email" method="POST" id="contact-form">
            <div class="form-group mb-5">
              <label class="form-label" for="name">Nama Lengkap</label>
              <input
                class="form-control"
                type="text"
                name="name"
                placeholder="Nama Lengkap"
                required
              />
            </div>
            <div class="form-group mb-5">
              <label class="form-label" for="eamil">Email</label>
              <input
                class="form-control"
                type="text"
                name="email"
                placeholder="Email"
                required
              />
            </div>
            <div class="form-group mb-5">
              <label class="form-label" for="message">Pesan</label>
              <textarea
                class="form-control h-[150px]"
                name="message"
                cols="30"
                rows="10"
                placeholder="Pesan Anda"
                required
              ></textarea>
            </div>
            <input
              class="btn btn-primary block w-full"
              type="submit"
              value="Kirim"
            />
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('js')
<script src="{{ asset('assets/js/pages/contact.js') }}"></script>
@endpush
