<x-guest-layout>
    <!-- Add Background Style -->
    <style>
		.login-background {
			background-image: url('{{ asset('images/bg-bpjss.png') }}');
			background-size: cover;
			background-position: center;
			position: relative;
			min-height: 100vh;
		}
		.login-overlay {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.2);
			z-index: 1;
		}
		.login-card {
			position: relative;
			z-index: 2;
		}
	</style>

	
	<div class="login-background min-h-screen bg-gray-100 flex items-center justify-center">
		<div class="login-overlay absolute inset-0 bg-black bg-opacity-50"></div>
		<div class="relative z-10 flex justify-center items-center w-full px-4">
			<div class="hero-static w-full max-w-md bg-white bg-opacity-90 rounded-lg shadow-lg p-6">
				<!-- Header -->
				<div class="text-center my-6">
					<a href="{{ route('login') }}">
						<img src="{{ asset('images/vsmart.png') }}" alt="Logo" class="mx-auto mb-4 w-32">
					</a>
				</div>
				<!-- Form -->
				<form method="POST" action="{{ route('login.process') }}" class="space-y-4">
					@csrf
					<div>
						<label for="email" class="block text-sm font-medium text-gray-700">
							Email <span class="text-red-500">*</span>
						</label>
						<input type="text" id="email" name="email" placeholder="Masukan Email"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500 focus:ring-blue-500 {{ $errors->has('email') ? 'border-red-500' : '' }}">
						<x-input-error :messages="$errors->get('email')" class="mt-1 text-red-500 text-sm" />
					</div>
					<div>
						<label for="val-password" class="block text-sm font-medium text-gray-700">
							Password <span class="text-red-500">*</span>
						</label>
						<input type="password" id="val-password" name="password" placeholder="Masukan password"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:border-blue-500 focus:ring-blue-500 {{ $errors->has('password') ? 'border-red-500' : '' }}" oncopy="return false" oncut="return false">
						<x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
					</div>
					<!-- reCAPTCHA -->
					<div class="mt-4">
						<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
						<x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-1 text-red-500 text-sm" />
					</div>
					<div class="flex justify-center">
						<button type="submit"
							class="w-full text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
							LOGIN
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	

</x-guest-layout>
