@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg p-8 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-center mb-6">Tambah Pengguna</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>
        
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label for="hospital" class="block text-sm font-medium text-gray-700">Rumah Sakit</label>
            <input type="hospital" name="hospital" id="hospital" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="text-center">
            <button type="submit" class="w-full bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 transition duration-300">Create</button>
        </div>
    </form>
</div>
@endsection
