<header id="page-header" class="bg-navbar shadow text-txtd">
    <div class="content-header flex justify-between items-center py-4 px-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/vsmart.png') }}" width="140" class="mx-auto" />
            </a>
        </div>

        <div class="hidden lg:block">
            <ul class="flex space-x-6">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center font-semibold hover:text-txtl hover:border-txtd hover:bg-txtd p-3 rounded-3xl 
                        {{ Request::routeIs('dashboard') ? 'bg-txtd text-txtl border-txtl' : '' }}">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        <span>Beranda</span>
                    </a>
                </li>

                <li class="relative">
                    <a href="{{ $isDisabled ? '#' : route('patients.index') }}" 
                        class="flex items-center font-semibold p-3 rounded-3xl transition 
                        {{ request()->is('patients*') ? 'bg-txtd text-txtl border-txtl' : 'hover:text-txtl hover:border-txtd hover:bg-txtd' }} 
                        {{ $isDisabled ? 'cursor-not-allowed opacity-50 border-2 border-red-500 text-red-500 hover:text-red-500 hover:border-red-500' : '' }}"
                        @if($isDisabled) 
                            data-tooltip-target="tooltip-patient" 
                            data-tooltip-placement="bottom" 
                        @endif>
                        <i class="fas fa-clipboard mr-2"></i>
                        <span>Tambah Pasien</span>
                    </a>
                
                    @if($isDisabled)
                    <div id="tooltip-patient" role="tooltip" 
                        class="absolute left-1/2 -translate-x-1/2 mt-2 z-10 invisible px-3 py-2 text-sm font-medium text-white bg-red-500 rounded-lg shadow-xs opacity-0 tooltip">
                        Anda sudah mencapai batas pasien.
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif
                </li>

                @if (Auth::User()->role === 'super admin')
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex items-center font-semibold hover:text-txtl hover:border-txtd hover:bg-txtd p-3 rounded-3xl 
                            {{ Request::routeIs('admin.users*') ? 'bg-txtd text-txtl border-txtl' : '' }}">
                            <i class="fas fa-user-friends mr-2"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                @endif
                
            </ul>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <div class="relative hidden lg:block">
                <button type="button" class="flex items-center space-x-2 text-txtd hover:text-txtl hover:border-txtd hover:bg-txtd p-2 rounded-3xl" id="page-header-user-dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden" id="dropdown" aria-labelledby="page-header-user-dropdown">
                    <div class="px-4 py-3 text-center border-b border-gray-100">
                        <h5 class="text-sm font-semibold text-txtl">
                            {{ Auth::user()->name }}
                        </h5>
                    </div>
                    @if (Auth::User()->role === 'super admin')
                    <div class="py-2">
                        <ul>
                            <li>
                                <a href="{{ route('logs.index') }}" class="flex items-center font-semibold text-txtl hover:text-txtl hover:border-txtd hover:bg-txtd p-3 
                                    {{ Request::routeIs('logs*') ? 'bg-txtd text-txtl border-txtl' : '' }}">View Log</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <div class="py-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="block w-full text-left px-4 py-2 text-txtl hover:text-txtl hover:border-txtd hover:bg-txtd" onclick="event.preventDefault(); this.closest('form').submit();">
                                <span>Keluar</span>
                                <i class="fa fa-sign-out-alt text-gray-400 ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Right Section -->

        <!-- Mobile Hamburger Menu Button -->
        <button class="lg:hidden flex items-center text-gray-600 hover:text-gray-900" id="hamburger-btn">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <!-- END Header Content -->

    <!-- Mobile Menu (Hidden by Default) -->
    <div class="lg:hidden hidden" id="mobile-menu">
        <ul class="space-y-4 py-4 px-6">
            <li>
                <a href="{{ route('dashboard') }}" class="block text-gray-600 hover:text-gray-900 {{ request()->is('dashboard') ? 'font-semibold text-blue-600' : '' }}">
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="block text-gray-600 hover:text-gray-900 {{ request()->is('user') ? 'font-semibold text-blue-600' : '' }}">
                    Pengguna
                </a>
            </li>
            <li>
                <a href="{{ route('patients.index') }}" class="block text-gray-600 hover:text-gray-900 {{ request()->is('user') ? 'font-semibold text-blue-600' : '' }}">
                    Observasi
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">
                        Keluar
                        <i class="fa fa-sign-out-alt text-gray-400 ml-2"></i>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</header>

<!-- Tambahkan script untuk toggle dropdown dan hamburger menu -->
<script>
    // Toggle dropdown menu
    document.getElementById('page-header-user-dropdown').addEventListener('click', function() {
        document.getElementById('dropdown').classList.toggle('hidden');
    });

    // Menambahkan script untuk menutup dropdown ketika klik di luar dropdown
    window.addEventListener('click', function(e) {
        const dropdownButton = document.getElementById('page-header-user-dropdown');
        const dropdownMenu = document.getElementById('dropdown');
        
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Toggle hamburger menu
    document.getElementById('hamburger-btn').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
