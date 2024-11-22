<x-guest-layout>
    <!-- Add Background Style -->
    <style>
		.login-background {
			background-image: url('{{ asset('images/bg-bpjs.jpg') }}');
		}
	</style>
	
	<div class="login-background bg-cover bg-center min-h-screen flex justify-center items-center">
		<div class="hero-static w-full max-w-lg">
			<div class="bg-white rounded-lg shadow-lg p-6">
				<!-- Header -->
				<div class="text-center mb-6">
					<a class="font-bold" href="{{ route('login') }}">
						<img src="{{ asset('images/logo-bpjs-sm.png') }}" width="100" class="mx-auto mb-5" />
					</a>
					<img src="{{ asset('images/vsmart.png') }}" width="200" class="mx-auto mb-5" />
					{{-- <h1 class="text-3xl font-bold mb-2 text-gray-800">V-SMART</h1> --}}
					<h2 class="text-lg font-medium text-gray-600">Silahkan Login Terlebih Dahulu!</h2>
				</div>
				<!-- END Header -->
	
				<!-- Sign In Form -->
				<form method="POST" action="{{ route('login.process') }}">
					@csrf
					<div class="mb-4">
						<label class="block text-sm font-medium text-gray-700" for="email">
							Email
							<span class="text-red-500">*</span>
						</label>
						<input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 {{ $errors->has('email') ? 'border-red-500' : '' }}" id="email" name="email" placeholder="Masukan Email">
						<x-input-error :messages="$errors->get('email')" class="mt-2" />
					</div>
					<div class="mb-4">
						<label class="block text-sm font-medium text-gray-700" for="val-password">
							Password
							<span class="text-red-500">*</span>
						</label>
						<input type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 {{ $errors->has('password') ? 'border-red-500' : '' }}" id="val-password" name="password" placeholder="Masukan password">
						<x-input-error :messages="$errors->get('password')" class="mt-2" />
					</div>
					<div class="flex justify-center">
						<button type="submit" class="mt-4 px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg">
							Login
						</button>
					</div>
				</form>
				<!-- END Sign In Form -->
			</div>
		</div>
	</div>
	
	

</x-guest-layout>
