<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Password OTP - Dinas Sosial Kabupaten Majalengka</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">Verifikasi Kode OTP</h2>
            <p class="text-sm text-gray-600 mt-1">Masukkan kode yang dikirim ke email Anda</p>
        </div>

        <form method="POST" action="{{ route('password.otp.verify') }}" id="otpForm" class="space-y-4">
            @csrf
            <div class="flex justify-center space-x-2">
                @for ($i = 1; $i <= 6; $i++)
                    <input type="text" id="otp{{ $i }}" name="otp[]" maxlength="1"
                    class="w-12 h-12 text-center text-xl font-bold border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    autocomplete="one-time-code" inputmode="numeric" pattern="[0-9]*" required>
                    @endfor
            </div>
            <input type="hidden" name="otp_code" id="otp_code" required>

            <button type="submit"
                class="w-full py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                Verifikasi
            </button>
        </form>

        <div class="text-center text-sm text-gray-600">
            Tidak menerima kode?
            <span id="countdown" class="font-medium text-gray-800"></span>
            <form method="POST" action="{{ route('password.otp.resend') }}" class="inline" onsubmit="this.querySelector('button').disabled = true;">
                @csrf
                <button type="submit" id="resendBtn"
                    class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors hidden">
                    Kirim Ulang Kode OTP
                </button>
            </form>
        </div>

        <noscript>
            <div class="text-center text-red-600 font-semibold bg-red-100 border border-red-200 p-4 rounded">
                JavaScript diperlukan untuk verifikasi OTP ini.
            </div>
        </noscript>
    </div>

    <script>
        // Auto move focus
        const inputs = document.querySelectorAll('input[name="otp[]"]');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                updateHiddenOtp();
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        function updateHiddenOtp() {
            const otpCode = Array.from(inputs).map(input => input.value).join('');
            document.getElementById('otp_code').value = otpCode;
        }

        // Countdown
        let timeLeft = 60;
        const countdownEl = document.getElementById('countdown');
        const resendBtn = document.getElementById('resendBtn');

        function updateCountdown() {
            if (timeLeft > 0) {
                countdownEl.textContent = `Kirim ulang dalam ${timeLeft}s`;
                resendBtn.classList.add('hidden');
                timeLeft--;
                setTimeout(updateCountdown, 1000);
            } else {
                countdownEl.textContent = '';
                resendBtn.classList.remove('hidden');
            }
        }

        updateCountdown();
    </script>
</body>

</html>