@extends('layouts.app')

@section('title', 'Tambah Pasien')

@section('content')

    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
            <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-grey-900 dark:text-gray-400 dark:hover:text-slate-900">
                <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Home
            </a>
            </li>
            <li aria-current="page">
            <div class="flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-grey-900">Tambah Data Pasien</span>
            </div>
            </li>
        </ol>
    </nav>

    <div class="container mx-auto max-w-lg p-8 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl text-center font-bold">Data Pasien</h1>
        <div class="relative w-full">
            <form id="patientForm" action="{{ route('patients.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div>
                    <label for="name" class="block text-md font-medium">Nama Pasien</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Masukan Nama Pasien" 
                        required>
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>
                    <label for="no_jkn" class="mt-4 block text-md font-medium">No Kartu JKN</label>
                    <input 
                        type="text" 
                        name="no_jkn" 
                        id="no_jkn" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Masukan No Kartu JKN" 
                        required>
                    <x-input-error :messages="$errors->get('no_jkn')" />
                </div>

                <div>
                    <label for="no_rm" class="mt-4 block text-md font-medium">No Kartu Rekam Medis</label>
                    <input 
                        type="text" 
                        name="no_rm" 
                        id="no_rm" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Masukan No Kartu Rekam Medis" 
                        required>
                    <x-input-error :messages="$errors->get('no_rm')" />
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 ">
                    <!-- Tombol Back -->
                    <a href="{{ url()->previous() }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-300 hover:bg-gray-200 text-gray-700 font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Kembali
                    </a>

                    <!-- Tombol Simpan Data -->
                    <button 
                        type="button" 
                        id="openModalButton" 
                        class="inline-flex items-center px-4 py-2 bg-btn text-white font-semibold rounded-md shadow-sm hover:bg-btnh focus:outline-none focus:ring-2 focus:ring-btn focus:ring-offset-2">
                        Simpan Data
                    </button>
                </div>
            </form>

            <!-- Modal -->
            <div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
                    <h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
                    <p>Apakah Anda Yakin Ingin Menyimpan Data Pasien?</p>
                    <div class="flex justify-end mt-4 gap-2">
                        <button 
                            id="cancelButton" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md">
                            Batal
                        </button>
                        <button 
                            id="confirmButton" 
                            class="px-4 py-2 bg-btn hover:to-btnh text-white rounded-md">
                            Ya, Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Script for Slide Navigation -->
@push('scripts')
<script>
	document.getElementById('openModalButton').addEventListener('click', function() {
		document.getElementById('confirmationModal').classList.remove('hidden');
	});

	document.getElementById('cancelButton').addEventListener('click', function() {
		document.getElementById('confirmationModal').classList.add('hidden');
	});

	document.getElementById('confirmButton').addEventListener('click', function() {
		document.getElementById('patientForm').submit(); 
	});
</script>
@endpush


@endsection

