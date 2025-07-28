@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-8 mt-36 mb-16 bg-white rounded shadow">
    <h1 class="text-4xl font-extrabold mb-6 text-gray-900">Privacy Policy</h1>

    <p class="text-lg text-gray-700 mb-6 leading-relaxed text-justify">
        At <span class="font-semibold">MindCare Hub</span>, we respect your privacy and are committed to protecting your personal data. This Privacy Policy explains how we collect, use, and safeguard your information when you use our services.
    </p>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-3 text-gray-900">Information We Collect</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-2">
            <li>Personal identification information (Name, email address, phone number, etc.)</li>
            <li>Usage data and cookies</li>
            <li>Any other information you provide voluntarily</li>
        </ul>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-3 text-gray-900">How We Use Your Information</h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            We use the collected data to provide and improve our services, personalize your experience, communicate updates, and comply with legal obligations.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-3 text-gray-900">User Privacy</h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            No personal details beyond name, email, and appointment needs will be stored. All sensitive data, such as emotional inputs, will be anonymized during storage and processing to protect your identity.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-3 text-gray-900">Data Protection and Security</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-2">
            <li>The system uses encrypted communication protocols (such as HTTPS if hosted) to secure data transmission.</li>
            <li>Secure API tokens and password hashing are implemented to protect access and authentication.</li>
        </ul>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-3 text-gray-900">Data Retention</h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            Data will only be retained for research and system improvement purposes. Users will be clearly informed of data usage policies through a privacy notice.
        </p>
    </section>

    <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-3 text-gray-900">Your Rights</h2>
        <p class="text-gray-700 leading-relaxed text-justify">
            You have the right to access, update, or delete your personal information. You can also opt out of marketing communications at any time.
        </p>
    </section>

    <p class="text-gray-700 leading-relaxed text-justify">
        For any questions regarding this policy, please contact us at
        <a href="mailto:privacy@mindcarehub.com" class="text-indigo-600 underline hover:text-indigo-800 transition-colors">
            privacy@mindcarehub.com
        </a>.
    </p>
</div>
@endsection
