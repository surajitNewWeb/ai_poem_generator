<?php
define("GEMINI_API_KEY", "AIzaSyBIY1gS9gC3YTI2eaV5tfn6RIAHrJHTms0"); // replace with your real key

function gemini_generate($prompt) {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . GEMINI_API_KEY;

    $postData = [
        "contents" => [[
            "parts" => [["text" => $prompt]]
        ]],
        "generationConfig" => [
            "temperature" => 0.9,
            "topP" => 0.95,
            "maxOutputTokens" => 400
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            "poem" => "",
            "caption" => "⚠️ Error contacting Gemini API: $error"
        ];
    }
    curl_close($ch);

    $data = json_decode($response, true);
    $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? "";

    if (!$rawText) {
        return [
            "poem" => "⚠️ Gemini returned no content.",
            "caption" => "⚠️ Caption not available."
        ];
    }

    // Try parsing JSON if Gemini followed format
    if (preg_match('/\{.*\}/s', $rawText, $matches)) {
        $json = json_decode($matches[0], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return [
                "poem" => $json['poem'] ?? $rawText,
                "caption" => $json['caption'] ?? (explode("\n", trim($rawText))[0] ?? "✨ A poem")
            ];
        }
    }

    // Fallback: use raw text as poem, first line as caption
    $lines = explode("\n", trim($rawText));
    return [
        "poem" => $rawText,
        "caption" => $lines[0] ?: "✨ A beautiful poem"
    ];
}
