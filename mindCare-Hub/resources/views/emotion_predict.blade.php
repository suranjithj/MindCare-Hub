<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Emotion Prediction</title>
    @vite('resources/css/app.css')

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <style>
        .custom-shadow {
            box-shadow: 8px 8px 15px rgba(0, 0, 0, 0.373);
        }
    </style>

</head>
<body class="">
    @include('layouts.navigation')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-xl md:max-w-2xl lg:max-w-4xl bg-gray-100 mt-32 mb-16 p-6 rounded-lg shadow-md border border-gray-300 custom-shadow mx-auto">
            <h2 class="text-center text-gray-900 pb-5">Mood Predict</h2>

            <form method="POST" action="{{ url('/predict-emotion') }}">
                @csrf
                <textarea
                name="text"
                rows="8"
                placeholder="Enter your thoughts"
                class="w-full p-3 border bg-gray-300 text-gray-900 border-gray-300 rounded-md resize-none focus:outline-none focus:ring-1 focus:ring-blue-300">{{ old('text') }}</textarea>

                <button
                type="submit"
                class="mt-4 w-full bg-blue-700 hover:bg-blue-600 text-white font-bold py-3 rounded-md transition">
                Predict
                </button>
            </form>

            @if(isset($emotion))
                <div class="mt-6 p-4 bg-gray-900 rounded-md">
                    <p class="text-gray-100"><strong>Predicted Emotion:</strong> {{ $emotion }}</p>
                    <p class="text-gray-100"><strong>Genre:</strong> {{ $genre }}</p>

                    <h4 class="mt-2 mb-3 font-semibold text-gray-100">Recommended Songs:</h4>
                    <ul class="list-disc list-inside">

                        @foreach ($songs as $songData)
                        <li class="mb-6 p-4 bg-trasparent shadow-md rounded-lg border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                            <p class="text-lg font-semibold text-gray-200">{{ $songData['song'] }}</p>
                            @if($songData['spotify_url'])
                                <iframe
                                    src="{{ $songData['spotify_url'] }}"
                                    width="100%"
                                    height="80"
                                    frameborder="0"
                                    allowtransparency="true"
                                    allow="encrypted-media"
                                    class="rounded-md mt-3 shadow-lg"
                                ></iframe>
                            @else
                                <p class="text-red-500 font-medium mt-2">Spotify track not found</p>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="mt-4 text-red-600 font-semibold">{{ session('error') }}</div>
            @endif
        </div>
    </div>

    @include('layouts.footer')

    <script>
        async function predictEmotion() {
            const text = document.getElementById('textInput').value;

            const response = await fetch('/predict-emotion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ text }),
            });

            if (response.ok) {
                const data = await response.json();
                document.getElementById('emotionResult').innerText = data.emotion;
            } else {
                document.getElementById('emotionResult').innerText = 'Error predicting emotion';
            }
        }
    </script>
</body>
</html>
