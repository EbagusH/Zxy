<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Dinas Sosial Kota Majalengka</title>
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
        <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-8 text-center relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-grid-white/[0.2] bg-[size:20px_20px]"></div>
            </div>

            <div class="relative z-10">
                <div class="text-4xl mb-4 animate-bounce-slow">🔑</div>
                <h1 class="text-2xl font-bold mb-2">Reset Password</h1>
                <p class="text-green-100">Buat password baru untuk akun Anda</p>
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
                <p class="text-gray-600 mb-2">Masukkan password baru untuk akun:</p>
                <p class="font-semibold text-gray-800">{{ session('password_reset_email') ?? 'email Anda' }}</p>
            </div>

            <!-- Password Reset Form -->
            <form method="POST" action="{{ route('password.reset.post') }}" class="space-y-6" id="resetForm">
                @csrf

                <!-- New Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('password') border-red-500 @enderror pr-12"
                            placeholder="Masukkan password baru"
                            minlength="8">
                        <button
                            type="button"
                            onclick="togglePassword('password', 'eyeIcon1')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eyeIcon1" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Password minimal 8 karakter</p>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors @error('password_confirmation') border-red-500 @enderror pr-12"
                            placeholder="Ulangi password baru"
                            minlength="8">
                        <button
                            type="button"
                            onclick="togglePassword('password_confirmation', 'eyeIcon2')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eyeIcon2" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Password Strength Indicator -->
                <div id="passwordStrength" class="hidden">
                    <div class="flex items-center mb-2">
                        <span class="text-sm text-gray-600 mr-2">Kekuatan Password:</span>
                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                            <div id="strengthBar" class="h-2 rounded-full transition-all duration-300"></div>
                        </div>
                    </div>
                    <div id="strengthText" class="text-xs"></div>
                </div>

                <!-- Password Match Indicator -->
                <div id="passwordMatch" class="hidden">
                    <div class="flex items-center text-sm">
                        <svg id="matchIcon" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        </svg>
                        <span id="matchText"></span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-green-600 to-teal-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-green-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                    id="submitBtn">
                    Simpan Password
                </button>
            </form>

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
        // Toggle password visibility
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.add('text-green-600');
            } else {
                field.type = 'password';
                icon.classList.remove('text-green-600');
            }
        }

        // Password strength checker
        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = [];

            if (password.length >= 8) strength += 1;
            else feedback.push('minimal 8 karakter');

            if (/[a-z]/.test(password)) strength += 1;
            else feedback.push('huruf kecil');

            if (/[A-Z]/.test(password)) strength += 1;
            else feedback.push('huruf besar');

            if (/[0-9]/.test(password)) strength += 1;
            else feedback.push('angka');

            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            else feedback.push('karakter khusus');

            return {
                strength,
                feedback
            };
        }

        // Update password strength indicator
        function updatePasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthDiv = document.getElementById('passwordStrength');
            const strengthBar = document.getElementById('strengthBar');
            const strengthText = document.getElementById('strengthText');

            if (password.length === 0) {
                strengthDiv.classList.add('hidden');
                return;
            }

            strengthDiv.classList.remove('hidden');
            const {
                strength,
                feedback
            } = checkPasswordStrength(password);

            // Update bar
            const percentage = (strength / 5) * 100;
            strengthBar.style.width = percentage + '%';

            // Update colors and text
            if (strength <= 2) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-red-500';
                strengthText.className = 'text-xs text-red-600';
                strengthText.textContent = 'Lemah - Perlu: ' + feedback.join(', ');
            } else if (strength <= 3) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-yellow-500';
                strengthText.className = 'text-xs text-yellow-600';
                strengthText.textContent = 'Sedang - Perlu: ' + feedback.join(', ');
            } else if (strength <= 4) {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-blue-500';
                strengthText.className = 'text-xs text-blue-600';
                strengthText.textContent = 'Baik - Perlu: ' + feedback.join(', ');
            } else {
                strengthBar.className = 'h-2 rounded-full transition-all duration-300 bg-green-500';
                strengthText.className = 'text-xs text-green-600';
                strengthText.textContent = 'Sangat Kuat';
            }
        }

        // Check password match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('passwordMatch');
            const matchIcon = document.getElementById('matchIcon');
            const matchText = document.getElementById('matchText');

            if (confirmation.length === 0) {
                matchDiv.classList.add('hidden');
                return;
            }

            matchDiv.classList.remove('hidden');

            if (password === confirmation) {
                matchDiv.className = 'flex items-center text-sm text-green-600';
                matchIcon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>';
                matchText.textContent = 'Password cocok';
            } else {
                matchDiv.className = 'flex items-center text-sm text-red-600';
                matchIcon.innerHTML = '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>';
                matchText.textContent = 'Password tidak cocok';
            }
        }

        // Event listeners
        document.getElementById('password').addEventListener('input', function() {
            updatePasswordStrength();
            checkPasswordMatch();
        });

        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);

        // Form submission
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmation = document.getElementById('password_confirmation').value;
            const submitBtn = document.getElementById('submitBtn');

            if (password.length < 8) {
                e.preventDefault();
                alert('Password minimal 8 karakter');
                return false;
            }

            if (password !== confirmation) {
                e.preventDefault();
                alert('Konfirmasi password tidak cocok');
                return false;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Menyimpan...
            `;
        });

        // Focus on first input when page loads
        window.addEventListener('load', function() {
            document.getElementById('password').focus();
        });
    </script>
</body>

</html>