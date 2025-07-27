@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 mt-24 mb-16">
    <h1 class="text-3xl font-bold mb-6 text-center sm:text-left">About Us</h1>
    <p class="text-base sm:text-lg text-gray-700 text-justify mb-6 leading-relaxed">
        Welcome to <strong>MindCare Hub</strong>, your trusted partner in emotional wellness and personalized mental health support.
        Our platform is designed to help individuals navigate their emotions through a unique combination of <strong>AI-powered mood detection</strong>,
        <strong>music therapy</strong>, and <strong>counseling services</strong>.
    </p>
    <p class="text-base sm:text-lg text-gray-700 text-justify mb-6 leading-relaxed">
        We leverage advanced machine learning algorithms to analyze user input—whether it's a sentence, paragraph, or daily journal—and accurately detect their emotional state.
        Based on the identified mood, we recommend songs, genres, and playlists that resonate with their current feelings, offering a scientifically-backed way to elevate or
        balance emotional well-being.
    </p>
    <p class="text-base sm:text-lg text-gray-700 text-justify mb-6 leading-relaxed">
        Beyond music, we provide access to certified mental health professionals through our counselor booking system, enabling users to seek guidance and talk about their challenges
        in a supportive environment. We also offer mood tracking, progress insights, and personalized wellness packages to help users take control of their mental health journey.
    </p>
    <p class="text-base sm:text-lg text-gray-700 text-justify leading-relaxed">
        At MindCare Hub, we believe that emotional well-being is a continuous journey—and we're here to support you every step of the way.
    </p>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 mb-12">
    <h1 class="text-3xl font-bold mb-6 text-center sm:text-left">Contact Us</h1>
    <p class="text-base sm:text-lg text-gray-700 text-justify mb-6 leading-relaxed">
        We value your feedback and are always here to assist. Whether you have a question about our services, want to report an issue, or simply wish to connect, feel free to reach out:
    </p>
    <ul class="list-disc list-inside text-base sm:text-lg text-gray-700 mb-6 space-y-2">
        <li>Email: <a href="mailto:mindcare@example.com" class="text-indigo-600 underline">mindcare@example.com</a></li>
        <li>Phone: +94 77 123 4567 (Mon–Fri, 9 AM – 6 PM)</li>
        <li>Location: Colombo, Sri Lanka</li>
    </ul>
    <p class="text-base sm:text-lg text-gray-700 text-justify leading-relaxed">
        You can also follow us on our social media channels for updates and mental wellness tips.
    </p>
</div>

<!-- Social Media Icons -->
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
    <h2 class="text-2xl font-semibold mb-6 text-center sm:text-left">Follow Us</h2>
    <div class="flex justify-center sm:justify-start space-x-6 sm:space-x-8">

        <a href="https://www.facebook.com/mindcarehub" target="_blank" aria-label="Facebook" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" >
                <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.326v21.348C0 23.4.6 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.466.099 2.797.143v3.24h-1.918c-1.504 0-1.796.715-1.796 1.763v2.31h3.59l-.467 3.622h-3.123V24h6.116C23.4 24 24 23.4 24 22.674V1.326C24 .6 23.4 0 22.675 0z"/>
            </svg>
        </a>

        <a href="https://www.instagram.com/mindcarehub" target="_blank" aria-label="Instagram" class="text-pink-500 hover:text-pink-700 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" >
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                <path d="M16 11.37a4 4 0 1 1-4.73-4.73 4 4 0 0 1 4.73 4.73z"/>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
            </svg>
        </a>

        <a href="https://www.linkedin.com/company/mindcarehub" target="_blank" aria-label="LinkedIn" class="text-blue-700 hover:text-blue-900 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" >
                <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM2 8h6v14H2zM8.5 8h3.5v1.75h.05a3.85 3.85 0 0 1 3.5-1.75c3.75 0 4.45 2.46 4.45 5.66V22H16v-6.75c0-1.6-.03-3.66-2.23-3.66-2.23 0-2.57 1.75-2.57 3.56V22H8.5z"/>
            </svg>
        </a>

        <a href="https://www.twitter.com/mindcarehub" target="_blank" aria-label="Twitter / X" class="text-gray-700 hover:text-black transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" >
                <path d="M23 3a10.9 10.9 0 0 1-3.14.86 4.48 4.48 0 0 0 1.98-2.48 9.1 9.1 0 0 1-2.88 1.1 4.52 4.52 0 0 0-7.7 4.13A12.81 12.81 0 0 1 1.67 2.15a4.51 4.51 0 0 0 1.4 6.04 4.45 4.45 0 0 1-2.05-.57v.06a4.52 4.52 0 0 0 3.62 4.42 4.52 4.52 0 0 1-2.04.08 4.52 4.52 0 0 0 4.21 3.14A9 9 0 0 1 0 19.54 12.74 12.74 0 0 0 6.92 21c8.28 0 12.8-6.86 12.8-12.8 0-.2 0-.42-.02-.63A9.18 9.18 0 0 0 23 3z"/>
            </svg>
        </a>
    </div>
</div>
@endsection
