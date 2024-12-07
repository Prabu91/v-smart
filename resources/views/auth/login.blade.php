<x-guest-layout>
    <!-- Add Background Style -->
    <style>
		.login-background {
        /* background-image: url('{{ asset('images/bg-bpjs1.jpg') }}'); */
        background-image: url('{{ asset('images/bg-bpjss.png') }}');
        background-size: cover;
        background-position: center;
        position: relative;
        min-height: 100vh;
        /* min-height: 140vh; */
		/* background: rgb(90,129,250);
		background: linear-gradient(0deg, rgba(90,129,250,1) -100%, rgba(255,255,255,1) 100%); */
		/* background: rgb(90,129,250);
		background: radial-gradient(circle, rgba(90,129,250,1) 0%, rgba(255,255,255,1) 100%); */
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
	
	<div class="login-background">
		<div class="login-overlay"></div>
			<div class="flex justify-center items-center min-h-screen relative z-10">
				<div class="hero-static w-full max-w-lg login-card">
					<div class="bg-bgcl bg-opacity-90 rounded-lg shadow-lg p-6">
						<!-- Header -->
							<div class="text-center my-10">
								<a class="font-bold" href="{{ route('login') }}">
									{{-- <img src="{{ asset('images/logo-bpjs-sm.png') }}" width="100" class="mx-auto mb-5" /> --}}
									<img src="{{ asset('images/vsmart.png') }}" width="200" class="mx-auto mb-5" />
								</a>
							</div>
							<form method="POST" action="{{ route('login.process') }}">
								@csrf
								<div class="mb-4">
									<label class="block text-sm font-medium text-slate-800" for="email">
										Email
										<span class="text-red-500">*</span>
									</label>
									<input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 {{ $errors->has('email') ? 'border-red-500' : '' }}" id="email" name="email" placeholder="Masukan Email">
									<x-input-error :messages="$errors->get('email')" class="mt-2" />
								</div>
								<div class="mb-4">
									<label class="block text-sm font-medium text-slate-800" for="val-password">
										Password
										<span class="text-red-500">*</span>
									</label>
									<input type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 {{ $errors->has('password') ? 'border-red-500' : '' }}" id="val-password" name="password" placeholder="Masukan password">
									<x-input-error :messages="$errors->get('password')" class="mt-2" />
								</div>
								<div class="flex justify-center mt-8">
									{{-- <button type="submit" class="mt-4 px-6 py-2  hover:bg-blue-600 text-white font-medium rounded-lg"> --}}
									<button type="submit" class="text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">
										LOGIN
									</button>
								</div>
							</form>
						<!-- END Sign In Form -->
						</div>
					</div>
				</div>
			</div>
		</div>
	
	

</x-guest-layout>
