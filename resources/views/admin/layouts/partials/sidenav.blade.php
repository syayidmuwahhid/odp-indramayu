<aside
    class="max-w-62.5 ease-nav-brand fixed inset-y-0 my-4 ml-4 block w-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 small-left-minus lg:left-0 lg:translate-x-0 lg:bg-transparent">
    <div class="h-19.5">
        <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ url('') }}">
            <img src="{{ asset($appData->icon) }}"
                class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
            {{-- <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand ">{{ $appData->app_name }}</span> --}}
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            @php($a_active = 'shadow-soft-xl rounded-lg bg-white font-semibold text-slate-700 ')
            @php($i_active = 'bg-gradient-to-tl from-green-500 to-cyan-300 ')

            {{-- DASHBOARD --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.dashboard') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="{{ route('admin.dashboard') }}">
                    <div class="{{ url()->current() == route('admin.dashboard') ? $i_active : '' }}shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                </a>
            </li>

            {{-- USER --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.user.index') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.user.index') }}">
                    <div
                        class="{{ url()->current() == route('admin.user.index') ? $i_active : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Pengguna</span>
                </a>
            </li>

            {{-- SLIDER --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.slider.index') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.slider.index') }}">
                    <div
                        class="{{ url()->current() == route('admin.slider.index') ? $i_active : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>

                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Slider</span>
                </a>
            </li>

            {{-- CATEGORY --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.category.index') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.category.index') }}">

                    <div
                        class="{{ url()->current() == route('admin.category.index') ? $i_active : '' }}shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-list-ul" aria-hidden="true"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Kategori</span>
                </a>
            </li>



            {{-- ARTICLE --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.article.index') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.article.index') }}">
                    <div

                        class="{{ url()->current() == route('admin.article.index') ? $i_active : '' }}shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                            <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5z"/>
                            <path d="M2 3h10v2H2zm0 3h4v3H2zm0 4h4v1H2zm0 2h4v1H2zm5-6h2v1H7zm3 0h2v1h-2zM7 8h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2zm-3 2h2v1H7zm3 0h2v1h-2z"/>
                          </svg>

                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Artikel</span>
                </a>
            </li>

            {{-- DOCUMENT --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.document.index') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.document.index') }}">
                    <div class="{{ url()->current() == route('admin.document.index') ? $i_active : '' }}shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M6.354 9.854a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 8.707V12.5a.5.5 0 0 1-1 0V8.707z"/>
                        </svg>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dokumen</span>
                </a>
            </li>

            {{-- SETTING --}}
            <li class="mt-0.5 w-full">
                <a class="{{ url()->current() == route('admin.setting.index') ? $a_active : '' }} py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.setting.index') }}">
                    <div
                        class="{{ url()->current() == route('admin.setting.index') ? $i_active : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Pengaturan</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
