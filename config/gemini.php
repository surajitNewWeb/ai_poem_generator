<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// 🔑 Put your API key here
define('GEMINI_API_KEY', 'AIzaSyBIY1gS9gC3YTI2eaV5tfn6RIAHrJHTms0');

/**
 * Call Gemini API with a prompt
 *
 * @param string $prompt The user prompt
 * @return string Raw AI response
 * @throws Exception if API fails
 */
function gemini_generate(string $prompt): string {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . GEMINI_API_KEY;

    $postData = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $prompt]
                ]
            ]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $result = curl_exec($ch);
    if ($result === false) {
        throw new Exception("cURL Error: " . curl_error($ch));
    }
    curl_close($ch);

    $response = json_decode($result, true);

    if (!isset($response['candidates'][0]['content']['parts'][0]['text'])) {
        throw new Exception("Invalid API response: " . $result);
    }

    return $response['candidates'][0]['content']['parts'][0]['text'];
}
