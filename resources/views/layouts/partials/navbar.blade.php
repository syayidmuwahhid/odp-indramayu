    <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
        navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
            <nav>
                <!-- breadcrumb -->
                <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                    <li class="text-sm leading-normal">
                        <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
                    </li>
                    <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']"
                        aria-current="page">Dashboard</li>
                </ol>
                <h6 class="mb-0 font-bold capitalize">Dashboard</h6>
            </nav>

            <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                <div class="flex items-center md:ml-auto md:pr-4">
                </div>
                <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                    <!-- Options button with dropdown -->
                    <li class="relative flex items-center" x-data="{ open: false }">
                        <button @click='open = !open' type="button"
                            class=""
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            {{ Auth::user()->name }}
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
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                    tabindex="-1" id="menu-item-0">Profile</a>

                            </div>
                            <div class="py-1" role="none">
                                <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700">
                                <i class="fa fa-user sm:mr-1"></i>
                                <span class="hidden sm:inline">Keluar</span>
                            </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

