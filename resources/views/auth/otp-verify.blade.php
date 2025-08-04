<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Dinas Sosial Kota Majalengka</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8 text-center relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-grid-white/[0.2] bg-[size:20px_20px]"></div>
            </div>

            <div class="relative z-10">
                <div class="text-4xl mb-4 animate-bounce-slow">🔐</div>
                <h1 class="text-2xl font-bold mb-2">Verifikasi OTP</h1>
                <p class="text-blue-100">Masukkan kode yang dikirim ke email Anda</p>
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

            <!-- Session Error -->
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
                <p class="text-gray-600 mb-2">Kami telah mengirimkan kode OTP 6 digit ke:</p>
                <p class="font-semibold text-gray-800">{{ session('otp_email') ?? 'email Anda' }}</p>
            </div>

            <!-- OTP Form -->
            <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="otp_code" class="block text-sm font-medium text-gray-700 mb-2">
                        Kode OTP
                    </label>
                    <input
                        type="text"
                        id="otp_code"
                        name="otp_code"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        required
                        class="w-full px-4 py-3 text-center text-2xl font-mono tracking-widest border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('otp_code') border-red-500 @enderror"
                        placeholder="000000"
                        autocomplete="one-time-code"
                        inputmode="numeric"
                        autofocus>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Verifikasi OTP
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

            <!-- Resend OTP -->
            <div class="text-center space-y-4">
                <p class="text-sm text-gray-600">Tidak menerima kode?</p>

                <form method="POST" action="{{ route('otp.resend') }}" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="text-blue-600 hover:text-blue-800 font-medium text-sm underline hover:no-underline transition-colors"
                        id="resendBtn">
                        Kirim Ulang Kode OTP
                    </button>
                </form>
            </div>

            <!-- Timer Display -->
            <div class="text-center mt-4">
                <p class="text-xs text-gray-500" id="timer">
                    Kode akan kadaluarsa dalam <span id="countdown">5:00</span>
                </p>
            </div>

            <!-- Back to Login -->
            <div class="text-center mt-8 pt-6 border-t border-gray-100">
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
        // Auto-format OTP input
        document.getElementById('otp_code').addEventListener('input', function(e) {
            // Only allow numbers
            this.value = this.value.replace(/[^0-9]/g, '');

            // Enable/disable verify button based on input length
            const verifyBtn = document.getElementById('verifyBtn');
            if (this.value.length === 6) {
                verifyBtn.disabled = false;
                verifyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                verifyBtn.disabled = true;
                verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        });

        // Initially disable the verify button
        document.addEventListener('DOMContentLoaded', function() {
            const verifyBtn = document.getElementById('verifyBtn');
            verifyBtn.disabled = true;
            verifyBtn.classList.add('opacity-50', 'cursor-not-allowed');
        });

        // Countdown timer (5 minutes)
        let timeLeft = 5 * 60; // 5 minutes in seconds
        const countdownElement = document.getElementById('countdown');
        const timerElement = document.getElementById('timer');

        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft <= 0) {
                timerElement.innerHTML = '<span class="text-red-500">Kode OTP telah kadaluarsa</span>';
                clearInterval(countdownTimer);
                // Disable form when expired
                document.getElementById('otp_code').disabled = true;
                document.getElementById('verifyBtn').disabled = true;
            }
            timeLeft--;
        }

        const countdownTimer = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call

        // Disable resend button temporarily after click
        document.getElementById('resendBtn').addEventListener('click', function() {
            this.disabled = true;
            this.textContent = 'Mengirim...';
            setTimeout(() => {
                this.disabled = false;
                this.textContent = 'Kirim Ulang Kode OTP';
            }, 3000);
        });

        // Focus on input when page loads
        window.addEventListener('load', function() {
            document.getElementById('otp_code').focus();
        });

        // Handle form submission
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            const otpInput = document.getElementById('otp_code');
            const verifyBtn = document.getElementById('verifyBtn');

            if (otpInput.value.length !== 6) {
                e.preventDefault();
                alert('Masukkan kode OTP 6 digit lengkap');
                return false;
            }

            // Show loading state
            verifyBtn.disabled = true;
            verifyBtn.textContent = 'Memverifikasi...';
        });
    </script>
</body>

</html>