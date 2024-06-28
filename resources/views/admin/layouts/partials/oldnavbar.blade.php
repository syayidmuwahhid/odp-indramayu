<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
      <nav>
        <!-- breadcrumb -->
        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
          <li class="text-sm leading-normal">
            <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
          </li>
          <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">@yield('title')</li>
        </ol>
        <h6 class="mb-0 font-bold capitalize">@yield('title')</h6>
      </nav>
            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <div class="flex items-center md:ml-auto md:pr-4">
                </div>
                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                    <!-- Options button with dropdown -->
                    <li class="relative flex items-center" x-data="{ open: false }">
                        {{-- <button class="bg-red-500">kiwiw</button> --}}
                        <button @click='open = !open' type="button" class="flex items-center gap-1" id="menu-button"
                            aria-expanded="true" aria-haspopup="true">
                            <div class="flex flex-col items-end">
                                <span class="text-xs">{{ Auth::user()->name }}</span>
                                <span class="text-[10px]">{{ Auth::user()->email }}</span>
                            </div>
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 top-8 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1"
                            x-transition:enter="dropdown-enter" x-transition:enter-start="dropdown-enter-active"
                            x-transition:leave="dropdown-leave" x-transition:leave-start="dropdown-leave-active">
                            <div class="py-1" role="none">
                                <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                <a href="#" id="pengaturan_menu" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="menu-item-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="scale-125" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                      </svg><span class="pl-2 hidden sm:inline">Akun</span></a>

                            </div>
                            <div class="py-1" role="none">
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="scale-y-150 scale-x-125" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                      </svg>
                                    <span class="pl-2 hidden sm:inline">Keluar</span>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
