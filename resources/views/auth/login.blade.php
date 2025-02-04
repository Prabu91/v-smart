@extends('layouts.guest')

@section('title', 'Login')

@section('content')

    {{-- <style>
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
	</style> --}}

	
	<div class="login-background min-h-screen bg-white flex items-center justify-center">
		<div class="login-overlay absolute inset-0 bg-navbar bg-opacity-20"></div>
		<div class="relative z-10 flex justify-center items-center w-full px-4">
			<div class="hero-static w-full max-w-md bg-white bg-opacity-90 rounded-lg shadow-lg p-6">
				<!-- Header -->
				<div class="text-center my-6">
					<a href="{{ route('login') }}">
						<img src="{{ asset('images/vsmart.png') }}" alt="Logo" class="mx-auto mb-4 w-52">
					</a>
				</div>
				<!-- Form -->
				<form method="POST" action="{{ route('login.process') }}" class="space-y-4">
					@csrf
					<div>
						<label for="username" class="block text-sm font-medium text-txtl">
							Username <span class="text-red-500">*</span>
						</label>
						<input type="text" id="username" name="username" placeholder="Masukan username"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:border-btnh focus:ring-btnh {{ $errors->has('username') ? 'border-red-500' : '' }}">
						<x-input-error :messages="$errors->get('username')" class="mt-1 text-red-500 text-sm" />
					</div>
					<div>
						<label for="val-password" class="block text-sm font-medium text-txtl">
							Password <span class="text-red-500">*</span>
						</label>
						<input type="password" id="val-password" name="password" placeholder="Masukan password"
							class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:border-btnh focus:ring-btnh {{ $errors->has('password') ? 'border-red-500' : '' }}" oncopy="return false" oncut="return false">
						<x-input-error :messages="$errors->get('password')" class="mt-1 text-red-500 text-sm" />
					</div>
					<!-- reCAPTCHA -->
					<div class="mt-4 flex justify-center">
						<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
					</div>
					<x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-1 text-red-500 text-sm" />

					<div class="flex justify-center">
						<button type="submit"
							class="w-full text-txtd bg-btn hover:bg-btnh focus:ring-4 focus:ring-bth1 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
							LOGIN
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
@endsection
