@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="container mx-auto max-w-lg p-8 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-center mb-6">Tambah Pengguna</h1>

    <form id="userForm" action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name') }}" >
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('email') }}" >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
            
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div>
            <label for="hospital" class="block text-sm font-medium text-gray-700">Rumah Sakit</label>
            <input type="text" name="hospital" id="hospital" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('hospital') }}" >
            <x-input-error :messages="$errors->get('hospital')" class="mt-2" />
        </div>

        <div>
            <label for="venti" class="block text-sm font-medium text-gray-700">Jumlah Ventilator</label>
            <input type="number" name="venti" id="venti" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name') }}" >
            <x-input-error :messages="$errors->get('venti')" class="mt-2" />
        </div>

        <div>
            <label for="bed" class="block text-sm font-medium text-gray-700">Jumlah Bed</label>
            <input type="number" name="bed" id="bed" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('bed') }}" >
            <x-input-error :messages="$errors->get('bed')" class="mt-2" />
        </div>

        <div class="text-center">
            <button type="button" id="openModalButton" class="w-full bg-[#3085d6] text-white py-2 px-4 rounded-md hover:bg-[#276baa] transition duration-300 font-bold">Simpan Data Pengguna</button>
        </div>
    </form>

    <!-- Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
            <p>Apakah Anda Yakin Ingin Menyimpan Data Pengguna?</p>
            <div class="flex justify-end mt-4">
                <button id="cancelButton" class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">Batal</button>
                <button id="confirmButton" class="px-4 py-2 bg-blue-600 text-white rounded-md">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.remove('hidden');
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        document.getElementById('confirmButton').addEventListener('click', function() {
            document.getElementById('userForm').submit(); 
        });
    </script>
@endpush
@endsection
