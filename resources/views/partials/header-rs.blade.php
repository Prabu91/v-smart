<header id="page-header" class="bg-bghdcl shadow">
    <!-- Header Content -->
    <div class="content-header flex justify-between items-center py-4 px-6">
        <!-- Left Section -->
        <div class="flex items-center space-x-4">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}">
                {{-- <img src="/images/logo-bpjs-sm.png"  width="50" class="mx-auto" alt="Logo"/> --}}
                <img src="{{ asset('images/vsmart.png') }}" width="140" class="mx-auto" />
            </a>
            <!-- END Logo -->
        </div>
        <!-- END Left Section -->

        <!-- Middle Section -->
        <div class="hidden lg:block">
            <!-- Header Navigation -->
            <ul class="flex space-x-6">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center text-gray-600 hover:text-gray-900 {{ request()->is('dashboard') ? 'font-semibold text-blue-600' : '' }}">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                        <span>Beranda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('patients.index') }}" class="flex items-center text-gray-600 hover:text-gray-900 {{ request()->is('user') ? 'font-semibold text-blue-600' : '' }}">
                        <i class="fas fa-clipboard mr-2"></i>
                        
                        <span>Observasi</span>
                    </a>
                </li>
            </ul>
            <!-- END Header Navigation -->
        </div>
        <!-- END Middle Section -->

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <div class="relative">
                <button type="button" class="flex items-center space-x-2 text-gray-600 hover:text-gray-900" id="page-header-user-dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user block lg:hidden"></i>
                    <span class="hidden lg:inline-block font-semibold">{{ Auth::user()->name }}</span>
                    <i class="fa fa-angle-down"></i>
                </button>
                <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden z-100" id="dropdown" aria-labelledby="page-header-user-dropdown">
                    <div class="px-4 py-3 text-center border-b border-gray-100">
                        <h5 class="text-sm font-semibold">
                            {{ Auth::user()->name }}
                        </h5>
                    </div>
                    <div class="py-2">
						<a class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
							href="">
							<span>Profil</span>
							<i class="fa fa-fw fa-user opacity-25 ml-2"></i>
						</a>
						<a class="block px-4 py-2 text-gray-600 hover:bg-gray-100"
							href="">
							<span>Ubah Password</span>
							<i class="fa fa-fw fa-envelope-open opacity-25 ml-2"></i>
						</a>
						<div class="border-t border-gray-100 my-2"></div>
						<form method="POST" action="{{ route('logout') }}">
							@csrf
							<button class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100" onclick="event.preventDefault(); this.closest('form').submit();">
								<span>Keluar</span>
								<i class="fa fa-sign-out-alt text-gray-400 ml-2"></i>
							</button>
						</form>
					</div>
					
                </div>
            </div>
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->
</header>

<!-- Tambahkan script untuk toggle dropdown -->
<script>
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
</script>
