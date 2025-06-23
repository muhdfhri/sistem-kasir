@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white dark:bg-[#161615] rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-8">
            <h2 class="text-2xl font-bold text-center text-[#1b1b18] dark:text-[#EDEDEC] mb-6">{{ __('Login') }}</h2>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] mb-2">{{ __('Email') }}</label>
                    <input id="email" type="email" class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC'] @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-[#706f6c] dark:text-[#A1A09A] mb-2">{{ __('Password') }}</label>
                    <div class="relative">
                        <input id="password" type="password" class="w-full px-3 py-2 border border-[#e3e3e0] dark:border-[#3E3E3A] rounded-md bg-white dark:bg-[#161615] text-[#1b1b18] dark:text-[#EDEDEC'] @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" id="eyeIcon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-end mt-1">
                        @if (\Route::has('password.request'))
                            <a class="text-xs text-[#0E73B9] dark:text-[#55B7E3] hover:underline" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>
                    @error('password')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember Me checkbox removed --}}

                <div class="mb-4">
                    <button type="submit" id="loginBtn" class="w-full px-4 py-2 bg-gradient-to-r from-[#0E73B9] to-[#55B7E3] text-white rounded-md hover:shadow-lg transition duration-300">
                        {{ __('Masuk') }}
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                        {{ __('Belum punya akun? Klik') }}
                        @if (\Route::has('register'))
                            <a href="{{ route('register') }}" class="text-[#0E73B9] dark:text-[#55B7E3]">
                                <span class="hover:underline">{{ __('di sini') }}</span>
                            </a>
                        @endif
                        {{ __('untuk daftar.') }}
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Password Visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle the eye icon
            if (type === 'text') {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                `;
            }
        });

        // Handle form submission
        const loginForm = document.getElementById('loginForm');
        const loginBtn = document.getElementById('loginBtn'); // Use the ID here
        const originalBtnText = loginBtn.innerHTML;

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Debug: Log form data before submission
            const formData = new FormData(loginForm);
            console.log('Form data before submission:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ': ' + value);
            }

            // Disable button and show loading state
            loginBtn.disabled = true;
            loginBtn.innerHTML = `
                <div class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Processing...
                </div>
            `;

            // Submit the form
            fetch(loginForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                // Always attempt to parse JSON, even on errors
                return response.json().then(data => ({
                    status: response.status,
                    ok: response.ok,
                    data: data
                }));
            })
            .then(response => {
                console.log('Response data:', response.data);

                if (response.ok) {
                    // Successful login
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil',
                        text: response.data.message || 'Anda berhasil login.',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#0E73B9'
                    }).then(() => {
                         window.location.href = response.data.redirect || '/'; // Redirect to the provided URL or root
                    });
                } else {
                    // Handle errors
                    if (response.status === 422 && response.data && response.data.errors) {
                        // Validation errors
                        let errorMessage = '';
                        Object.keys(response.data.errors).forEach(key => {
                            errorMessage += response.data.errors[key][0] + '<br>';

                            // Also update form UI with error indicators
                            const input = document.querySelector(`[name="${key}"]`);
                            if (input) {
                                input.classList.add('border-red-500');
                            }
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            html: errorMessage,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#0E73B9'
                        });
                    } else {
                        // Other errors
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: response.data.message || 'Terjadi kesalahan saat login',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#0E73B9'
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                 // Handle network errors or issues not caught by the above
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#0E73B9'
                });
            })
            .finally(() => {
                // Reset button state
                loginBtn.disabled = false;
                loginBtn.innerHTML = originalBtnText;
                // Remove error indicators after a short delay or on input change
                setTimeout(() => {
                    document.querySelectorAll('.border-red-500').forEach(input => {
                        input.classList.remove('border-red-500');
                    });
                }, 5000); // Adjust delay as needed
            });
        });
         // Optional: Remove error borders when user starts typing
        loginForm.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
                const errorSpan = this.nextElementSibling;
                if (errorSpan && errorSpan.tagName === 'SPAN' && errorSpan.classList.contains('text-red-500')) {
                    errorSpan.textContent = ''; // Clear the error message
                }
            });
        });
    });
</script>

<!-- Add Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection 