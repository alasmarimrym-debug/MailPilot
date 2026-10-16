
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/generate', function (Request $request) {

    $data = $request->validate([
        'purpose' => 'required|string|max:2000',
        'language' => 'required|in:English,Arabic',
        'tone' => 'required|in:Formal,Friendly,Professional',
        'length' => 'required|in:short,medium,long',
    ]);

    $prompt = "Write an email based on these requirements:
    Purpose: {$data['purpose']}
    Language: {$data['language']}
    Tone: {$data['tone']}
    Length: {$data['length']}

    Include a subject line.
    Return only the email text.";

    try {
        $response = Http::timeout(30)
            ->withHeaders([
                'x-goog-api-key' => env('GEMINI_API_KEY'),
            ])
            ->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash-lite:generateContent',
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]
            );

            if ($response->failed()) {
            \Log::error('Gemini API failed', [
                'status' => $response->status(),
                'response' => $response->json(),
            ]);

            return back()->with(
                'error',
                'AI request failed. HTTP status: ' . $response->status()
            );
        }

        $email = $response->json(
            'candidates.0.content.parts.0.text'
        );

        if (!$email) {
            return back()->with(
                'error',
                'No email was generated.'
            );
        }

        return redirect('/')->with([
            'generatedEmail' => $email,
            'formData' => $data,
        ]);
    

    } catch (\Exception $e) {
        return back()->with(
            'error',
            'Could not connect to the AI service.'
        );
    }
});



