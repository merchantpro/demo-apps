<?php

$body = file_get_contents("php://input");
$webhook = json_decode($body, true);

$webhook_secret = "YOUR_WEBHOOK_SECRET";
$hmac_calculated = base64_encode(hash_hmac("sha256", $body, $webhook_secret, true));
$hmac_received = $_SERVER['HTTP_X_WEBHOOK_SIGNATURE'] ?? null;

// Validate that the HMAC is correct - printing here is just for demonstration, but the output is not used in the endpoint

header("Content-Type: application/json");
print json_encode([
	"hmac_match" => hash_equals($hmac_calculated, $hmac_received),
	"hmac_calculated" => $hmac_calculated,
	"hmac_received" => $hmac_received,
	"webhook_data" => $webhook,
], JSON_PRETTY_PRINT);