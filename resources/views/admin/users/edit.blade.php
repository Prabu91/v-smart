@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
		<div class="mb-4">
			<label for="role" class="block text-sm font-medium text-gray-700">Role</label>
			<select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
				@foreach ($role as $p)
					<option value="{{ $p->role }}"  {{ (old('role', $data->role) == $p->id) ? 'selected="selected"' : '' }}>{{ $p->role }}</option>
				@endforeach
			</select>
		</div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
