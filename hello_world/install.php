<?php

// Received information
$code = $_GET['code'];
$return_url = $_GET['return_url'];

// Your app credentials
$client_id = "YOUR_APP_CLIENT_ID";
$client_secret = "YOUR_APP_SECRET";

// The URL to request api credentials for the app
$url = "https://flex.merchantpro.com/oauth/install";

// Request payload
$payload = [
	"client_id" => $client_id,
	"client_secret" => $client_secret,
	"code" => $code,
];

// Initialize a cURL session
$curl = curl_init();

// Set the cURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($curl, CURLOPT_HTTPHEADER, [
	"Content-Type: application/json",
]);

// Execute the cURL session and store the response
$response = curl_exec($curl);

// Check for curl errors
if ($curl_error = curl_errno($curl)) {

	header("Content-Type: text/plain");

	// It is up to you to decide what to do with the error
	print "Curl error: {$curl_error}\n";
}
// Check if response code is 200
elseif ( !($http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE)) || ($http_code < 200) || ($http_code >= 300)) {

	header("Content-Type: text/plain");

	// It is up to you to decide what to do with the error
	print "Curl HTTP error: {$http_code}\n" . print_r($response, true);
}
// The response is not a valid JSON
elseif (!is_valid_json($response)) {

	header("Content-Type: text/plain");

	print "Invalid response:\n" . print_r($response, true);
}
// Everything should be ok
else {

	// The response should have the api_credentials and other relevant information
	[
		"api_credentials" => $api_credentials,
		"app" => $app,
		"client_id" => $response_client_id,
		"shop_key" => $shop_key,
	] = json_decode($response, true);

	// It is up to you to decide what to do with the api_credentials
		// For this example we will display them in the browser
		// And also add a button to return to the return_url

	$formatResponse = fn($data) => "<pre style=\"margin: 0.25rem 0 1.5rem;\">" . array_reduce(array_keys($data), fn($carry, $key) => $carry . "\t<u>{$key}</u>: {$data[$key]}\n", "") . "</pre>";

		header("Content-Type: text/html");

		print "<html>
		<head>
		<title>App Install</title>
		</head>
			<body style=\"display: flex; flex-direction: column; align-items: center; gap: 1rem; font-size: 1rem;\">
				<h3>Install response</h3>
				<div>
					<b>api_credentials</b>: " . $formatResponse($api_credentials) . "
					<b>app</b>: " . $formatResponse($app) . "
					<b>client_id</b>: " . $client_id . "
					<b>shop_key</b>: " . $shop_key . "
				</div>
				<a href=\"{$return_url}\">Return to the app</a>
			</body>
		</html>";
}

// Close the cURL session
curl_close($curl);

/**
 * Check Json string
 */
function is_valid_json($string): bool {
	@json_decode($string);
	return (json_last_error() === JSON_ERROR_NONE);
}