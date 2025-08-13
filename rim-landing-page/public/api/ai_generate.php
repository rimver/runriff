<?php
// Set the content type of the response to JSON
header('Content-Type: application/json');

// Simulate a network delay
sleep(1);

// Get the raw POST data
$json_data = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($json_data, true);

// Get the persona and prompt from the data, with fallbacks
$persona = $data['persona'] ?? 'unknown';
$prompt = $data['prompt'] ?? 'No prompt provided.';

// Prepare the response array
$response = [
    'success' => true,
    'persona' => $persona,
    'prompt' => $prompt,
    'response' => ''
];

// Generate a simulated AI response based on the persona
switch ($persona) {
    case 'business_solution':
        $response['response'] = "Based on your query about \"{$prompt}\", our AI suggests a three-pronged approach:\n\n1. **Operational Streamlining:** Implement a lightweight ERP to consolidate your processes.\n2. **Customer Engagement:** Utilize a CRM to track client interactions and improve retention.\n3. **Data-Driven Decisions:** Develop a real-time analytics dashboard to monitor key performance indicators (KPIs).\n\nThis strategy is projected to increase efficiency by 25% within the first six months.";
        break;

    case 'marketing':
        $response['response'] = "For marketing \"{$prompt}\", our AI recommends a hyper-targeted digital campaign:\n\n- **Content:** Create a series of short-form videos showcasing customer success stories.\n- **Channels:** Focus on LinkedIn for B2B outreach and Instagram Reels for broader brand awareness.\n- **Action:** Launch a limited-time free consultation offer promoted via targeted ads to capture high-quality leads.";
        break;

    case 'product_description':
        $response['response'] = "Here is a compelling product description for \"{$prompt}\":\n\n**Unleash Unrivaled Performance.**\n\nEngineered for excellence, our product combines cutting-edge technology with a sleek, user-centric design. Experience a seamless workflow and unparalleled efficiency that empowers you to achieve more. Durable, reliable, and powerful—it's not just a tool, it's your next competitive advantage.";
        break;

    case 'it_architect':
        $response['response'] = "IT Architecture & Cost Estimate for \"{$prompt}\":\n\n**Recommended Architecture:**\n- **Frontend:** Single Page Application (SPA) using Vue.js for a reactive user experience.\n- **Backend:** A robust PHP API to handle business logic.\n- **Database:** MySQL for reliable, structured data storage.\n- **Hosting:** A scalable cloud VPS solution.\n\n**Estimated Cost:**\n- **Phase 1 (MVP Development):** Rp 75,000,000 - Rp 120,000,000\n- **Monthly Operational Cost:** Rp 2,500,000\n\nThis estimate covers development, testing, and initial deployment.";
        break;

    default:
        $response['success'] = false;
        $response['response'] = "Sorry, the requested AI persona '{$persona}' is not recognized. Please try a different category.";
        break;
}

// Encode the response array to JSON and output it
echo json_encode($response);

exit();
?>
