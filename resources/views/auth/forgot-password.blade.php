<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Lupa Password - Dinas Sosial Kabupaten Majalengka</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'bounce-slow': 'bounce 2s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen flex items-center justify-center p-4 font-sans">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white p-8 text-center relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-grid-white/[0.2] bg-[size:20px_20px]"></div>
            </div>

            <div class="relative z-10">
                <div class="text-4xl mb-4 animate-bounce-slow">🔑</div>
                <h1 class="text-2xl font-bold mb-2">Lupa Password</h1>
                <p class="text-orange-100">Masukkan email untuk reset password</p>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            <!-- Success Message -->
            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            <!-- Error Messages -->
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            <!-- Instruction -->
            <div class="text-center mb-8">
                <p class="text-gray-600 mb-4">Masukkan alamat email yang terdaftar dalam sistem untuk menerima kode OTP reset password.</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('password.send.otp') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Anda
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email admin"
                        autocomplete="email">
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold py-3 px-4 rounded-lg hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl"
                    id="submitBtn">
                    Kirim Kode OTP
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">atau</span>
                </div>
            </div>

            <!-- Back to Login -->
            <div class="text-center">
                <a
                    href="{{ route('login') }}"
                    class="text-gray-600 hover:text-gray-800 text-sm transition-colors inline-flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>

    <script>
        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const emailInput = document.getElementById('email');

            if (!emailInput.value.trim()) {
                e.preventDefault();
                alert('Email wajib diisi');
                return false;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Mengirim...
            `;
        });

        // Focus on email input when page loads
        window.addEventListener('load', function() {
            document.getElementById('email').focus();
        });
    </script>
</body>

</html>