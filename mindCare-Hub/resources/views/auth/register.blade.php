@vite('resources/css/app.css')

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

@include('layouts.navigation')

<div class="bg-gray-500 min-h-screen flex items-center justify-center p-4">

    <div class="w-full bg-gray-700 max-w-md p-6 rounded-lg shadow-md border border-gray-600  mt-36 mb-16" style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);">

        <h2 class="text-center mb-8 mt-8 text-white text-2xl font-semibold">Register</h2>

        <form action="{{ route('register.post') }}" onsubmit="return validatePasswords()" method="POST" >
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Full Name')" class="text-white" />
                <x-text-input id="name" class="block mt-3 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-white" />
                <x-text-input id="email" class="block mt-3 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Role -->
            <div class="mb-4">
                <x-input-label for="role" :value="__('Role')" class="text-white" />
                <select id="role" name="role" class="block mt-3 w-full text-gray-900 border border-gray-500 rounded-md" onchange="toggleCounselorFields()">
                    <option value="user">{{ __('User') }}</option>
                    <option value="counselor">{{ __('Counselor') }}</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Counselor Fields (Initially Hidden) -->
            <div id="counselorFields" style="display: none;">
                <div class="mb-4">
                    <x-input-label for="specialization" :value="__('Specialization')" class="text-white" />
                    <x-text-input id="specialization" class="block mt-3 w-full" type="text" name="specialization" :value="old('specialization')" />
                    <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="experience" :value="__('Years of Experience')" class="text-white" />
                    <x-text-input id="experience" class="block mt-3 w-full" type="number" name="experience" :value="old('experience')" />
                    <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="qualifications" :value="__('Educational Qualifications')" class="text-white" />
                    <x-text-input id="qualifications" class="block mt-3 w-full" type="text" name="qualifications" :value="old('qualifications')" />
                    <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="consultation_fee" :value="__('Consultation Fee')" class="text-white" />
                    <x-text-input id="consultation_fee" class="block mt-3 w-full" type="number" name="consultation_fee" :value="old('consultation_fee')" />
                    <x-input-error :messages="$errors->get('consultation_fee')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="bio" :value="__('Bio /Brief Introduction')" class="text-white" />
                    <textarea id="bio" class="block mt-3 w-full" name="bio">{{ old('bio') }}</textarea>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="location" :value="__('Location')" class="text-white" />
                    <x-text-input id="location" class="block mt-3 w-full" type="text" name="location" :value="old('location')" />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <x-input-label for="languages" :value="__('Languages Spoken')" class="text-white" />
                    <x-text-input id="languages" class="block mt-3 w-full" type="text" name="languages" :value="old('languages')" />
                    <x-input-error :messages="$errors->get('languages')" class="mt-2" />
                </div>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-white" />
                <x-text-input id="password" class="block mt-3 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
                <x-text-input id="password_confirmation" class="block mt-3 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                <div id="passwordError" class="text-red-500 mt-2" style="display: none;">Passwords do not match.</div>
            </div>

            <div class="flex items-center justify-between">
                <a class="underline text-sm text-white hover:text-blue-500" href="{{ route('login') }}">
                    {{ __('Already registered? Login') }}
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold w-[150px] p-2 rounded-md transition">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

    </div>
</div>

@include('layouts.footer')

<script>
    function toggleCounselorFields() {
        const role = document.getElementById('role').value;
        const counselorFields = document.getElementById('counselorFields');

        counselorFields.style.display = (role === 'counselor') ? 'block' : 'none';
        window.onload = toggleCounselorFields;
    }

    function validatePasswords() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const passwordError = document.getElementById('passwordError');

        if (password !== confirmPassword) {
            passwordError.style.display = 'block';
            return false;
        }

        passwordError.style.display = 'none';
        return true;
    }
</script>
