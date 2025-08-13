<?php
// Include the configuration file to get the API key
require_once '../../config.php';

// Set the content type of the response to JSON
header('Content-Type: application/json');

// Get the raw POST data
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);

$persona = $data['persona'] ?? 'unknown';
$prompt = $data['prompt'] ?? 'No prompt provided.';

// --- Google Gemini API Integration ---

$api_key = defined('GOOGLE_AI_API_KEY') ? GOOGLE_AI_API_KEY : '';

if (empty($api_key)) {
    echo json_encode(['success' => false, 'response' => 'API Key is not configured.']);
    exit();
}

// Construct a more detailed prompt based on the persona
$full_prompt = "";
switch ($persona) {
    case 'business_solution':
        $full_prompt = "As a business solutions strategist, provide actionable advice for the following problem: " . $prompt;
        break;
    case 'marketing':
        $full_prompt = "As a marketing strategist, create an innovative marketing campaign idea for the following product/service: " . $prompt;
        break;
    case 'product_description':
        $full_prompt = "As a marketing copywriter, write a compelling and concise product description for the following product: " . $prompt;
        break;
    case 'it_architect':
        $full_prompt = "As an IT architect, provide a high-level system architecture and a rough cost estimate for the following project: " . $prompt;
        break;
    default:
        echo json_encode(['success' => false, 'response' => "Invalid persona provided."]);
        exit();
}

$api_url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $api_key;

$request_body = json_encode([
    "contents" => [
        [
            "parts" => [
                ["text" => $full_prompt]
            ]
        ]
    ]
]);

// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);

// Execute cURL session
$api_response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Check for cURL errors
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    curl_close($ch);
    echo json_encode(['success' => false, 'response' => 'Failed to connect to AI service: ' . $error_msg]);
    exit();
}

curl_close($ch);

// Decode the API response
$response_data = json_decode($api_response, true);

// Prepare the final JSON response for the frontend
$final_response = ['success' => false, 'response' => 'An unexpected error occurred with the AI service.'];

if ($http_code == 200 && isset($response_data['candidates'][0]['content']['parts'][0]['text'])) {
    $final_response['success'] = true;
    $final_response['response'] = $response_data['candidates'][0]['content']['parts'][0]['text'];
} elseif (isset($response_data['error']['message'])) {
    $final_response['response'] = 'AI API Error: ' . $response_data['error']['message'];
}

echo json_encode($final_response);

?>
