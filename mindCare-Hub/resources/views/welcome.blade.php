@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section
    class="relative min-h-screen flex flex-col justify-center items-center text-center px-4 sm:px-6 md:px-16 lg:px-32 py-12 md:py-16 overflow-hidden"
>
    <div
        class="absolute inset-0 bg-[url('/images/background.jpeg')] bg-cover bg-center bg-no-repeat opacity-50 z-0"
    ></div>

    <div class="relative z-10 max-w-4xl w-full px-4">
        <h1
            class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight"
        >
            Welcome to MindCare Hub
        </h1>
        <p class="text-base sm:text-lg md:text-xl mb-8 max-w-3xl mx-auto text-gray-900 leading-relaxed">
            Your AI-powered wellness portal for mood tracking, counseling, and personalized song recommendations.
        </p>

        <!-- Daily Dose of Wellness -->
        <div
            style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);"
            class="wellness-feature-container bg-white rounded-2xl shadow-lg p-5 sm:p-6 md:p-8 w-full max-w-xl mx-auto mt-12 text-center"
        >
            <h2
                class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 mb-4"
            >
                🌿 Daily Dose of Wellness
            </h2>

            <button
                id="getWellnessTipButton"
                class="wellness-button bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-semibold py-2 px-6 rounded-full shadow-md transition duration-300 ease-in-out sm:py-2 sm:px-6 sm:text-base md:py-3 md:px-8 md:text-lg"
            >
                ✨ Get Daily Wellness Tip
            </button>

            <div
                id="wellnessTipResult"
                class="mt-4 text-base sm:text-lg md:text-xl text-gray-700 min-h-[50px]"
            >
                <p>Click the button to get your wellness tip!</p>
            </div>
        </div>
    </div>
</section>

<!-- Daily Dose of Wellness script -->
<script>
    const getWellnessTipButton = document.getElementById('getWellnessTipButton');
    const wellnessTipResultDiv = document.getElementById('wellnessTipResult');

    getWellnessTipButton.addEventListener('click', async () => {
        wellnessTipResultDiv.innerHTML = '<p class="loading-message">Finding a great tip for you...</p>';
        getWellnessTipButton.disabled = true;

        try {
            const prompt = "Share a brief, uplifting wellness tip to brighten someone’s day—keep it simple and easy to apply.";
            let chatHistory = [{ role: "user", parts: [{ text: prompt }] }];
            const payload = { contents: chatHistory };
            const apiKey = "AIzaSyD1ZHlupBDJG0R2NnljfA1QYz3YYPjT0cI";
            const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                const errorData = await response.json();
                console.error('API Error:', errorData);
                throw new Error(`API request failed with status ${response.status}: ${errorData.error?.message || 'Unknown error'}`);
            }

            const result = await response.json();

            if (result.candidates && result.candidates.length > 0 &&
                result.candidates[0].content && result.candidates[0].content.parts &&
                result.candidates[0].content.parts.length > 0) {
                const tipText = result.candidates[0].content.parts[0].text;
                wellnessTipResultDiv.innerHTML = `<p>${tipText.replace(/\n/g, '<br>')}</p>`;
            } else {
                console.error('Unexpected API response structure:', result);
                wellnessTipResultDiv.innerHTML = '<p class="error-message">Could not retrieve a tip at this time. Please try again later.</p>';
            }

        } catch (error) {
            console.error('Error fetching wellness tip:', error);
            wellnessTipResultDiv.innerHTML = `<p class="error-message">Sorry, something went wrong. Please try again. (${error.message})</p>`;
        } finally {
            getWellnessTipButton.disabled = false;
        }
    });
</script>

<section class="px-4 sm:px-6 md:px-16 lg:px-32 pb-16 bg-gray-400 py-16">
    <h2 class="text-2xl sm:text-3xl font-bold text-center mb-12 text-white">
        Our Features
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @foreach ([
            [
                'title' => 'Mood Prediction',
                'desc' => 'Analyze your current emotional state using our advanced AI-powered mood detection system. Simply enter a short text or message, and receive accurate insights into your mood along with personalized music or wellness suggestions tailored just for you.',
            ],
            [
                'title' => 'Song Recommendations',
                'desc' => 'Discover songs that perfectly match your mood and emotional state. Our smart AI recommends music tailored to uplift, relax, or resonate with how you feel making every listening experience more personal and meaningful.',
            ],
            [
                'title' => 'Counselor Booking',
                'desc' => 'Easily schedule one-on-one sessions with certified counselors through our platform. Whether you are seeking emotional support, mental wellness guidance, or professional advice, connect with the right expert at your convenience.',
            ]
        ] as $feature)
            <div
                class="bg-gray-700 p-5 rounded-2xl shadow-md hover:shadow-lg transition duration-300"
                style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);"
            >
                <h3 class="text-lg sm:text-xl text-gray-200 font-bold mb-2">
                    {{ $feature['title'] }}
                </h3>
                <p class="text-white text-sm sm:text-base">{{ $feature['desc'] }}</p>
            </div>
        @endforeach
    </div>

    <h2 class="text-2xl sm:text-3xl font-bold text-center mt-16 mb-12 text-white">
        What Our Users Say
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
        @foreach ([
            ['text' => 'MindCare Hub helped me find peace through music and counseling.', 'author' => 'Jane Doe'],
            ['text' => 'The AI chatbot is a game-changer for quick support.', 'author' => 'John Smith'],
            ['text' => 'Booking a counselor was so easy and effective.', 'author' => 'Emily Brown'],
        ] as $testimonial)
            <div
                class="bg-gray-700 p-5 rounded-2xl shadow-md"
                style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);"
            >
                <p class="text-gray-200 mb-4 text-sm sm:text-base">
                    "{{ $testimonial['text'] }}"
                </p>
                <p class="font-semibold text-white text-sm sm:text-base">
                    {{ $testimonial['author'] }}
                </p>
            </div>
        @endforeach
    </div>
</section>

<section
    class="text-center px-4 sm:px-6 md:px-16 lg:px-32 pb-24 py-16 bg-gray-200"
>
    <div
    class="bg-blue-500 text-white rounded-2xl py-10 px-6 sm:py-12 sm:px-10 md:py-12 md:px-12 w-full"
    style="box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);"
    >
        <h2 class="text-2xl sm:text-3xl font-bold mb-4 leading-tight">
            Start Your Wellness Journey Today
        </h2>
        <p class="text-base sm:text-lg mb-6 leading-relaxed">
            Join MindCare Hub and take control of your mental well-being.
        </p>
        <a
            href="{{ route('register') }}"
            class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-xl hover:bg-gray-100 transition text-base sm:text-lg inline-block"
            >Get Started</a
        >
    </div>
</section>

<script>
    window.addEventListener('load', () => {
        const target = document.getElementById('features');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>

@endsection
