@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="container mx-auto max-w-lg p-8 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">EDIT PENGGUNA</h1>

    <form id="userForm" action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT') 
        <div>
            <label for="name" class="block text-sm font-medium">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('name', $user->name) }}">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
    
        <div>
            <label for="username" class="block text-sm font-medium">username</label>
            <input type="text" name="username" id="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('username', $user->username) }}">
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>
    
        <div>
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
    
        <div>
            <label for="role" class="block text-sm font-medium">Role</label>
            <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>
    
        <div>
            <label for="hospital" class="block text-sm font-medium">Rumah Sakit</label>
            <input type="text" name="hospital" id="hospital" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('hospital', $user->userDetails->hospital ?? '') }}">
            <x-input-error :messages="$errors->get('hospital')" class="mt-2" />
        </div>
    
        <div>
            <label for="venti" class="block text-sm font-medium">Jumlah Ventilator</label>
            <input type="number" name="venti" id="venti" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('venti', $user->userDetails->venti ?? '') }}">
            <x-input-error :messages="$errors->get('venti')" class="mt-2" />
        </div>
    
        <div>
            <label for="bed" class="block text-sm font-medium">Jumlah Bed</label>
            <input type="number" name="bed" id="bed" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('bed', $user->userDetails->bed ?? '') }}">
            <x-input-error :messages="$errors->get('bed')" class="mt-2" />
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
                Update Data
            </button>
        </div>
    </form>

    <!-- Modal -->
     <div id="confirmationModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Konfirmasi</h3>
            <p>Apakah Anda yakin ingin menyimpan data?</p>
            <div class="flex justify-end mt-4">
                <button id="cancelButton" class="mr-2 px-4 py-2 bg-gray-300 hover:bg-gray-200 text-gray-700 rounded-md">Batal</button>
                <button id="confirmButton" class="px-4 py-2 bg-btn hover:bg-btnh text-white rounded-md">Ya, Simpan</button>
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
