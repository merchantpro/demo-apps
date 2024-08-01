<?php

function update_payment_status($payment_code, $status) {

	$shop_domain = "www.your-shop-domain.com";
	$api_username = "YOUR_API_USERNAME";
	$api_password = "YOUR_API_PASSWORD";
	$api_endpoint = "https://{$shop_domain}/api/v2/payment_request";

	// Define the URL with the payment code
	$url = "{$api_endpoint}/{$payment_code}";

	// Prepare the data to be sent in the PATCH request
	$data = json_encode([
		"status" => $status,
	]);

	// Initialize cURL
	$ch = curl_init($url);

	// Set cURL options
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		"Content-Type: application/json",
		"Content-Length: " . strlen($data),
		"Authorization: Bearer " . base64_encode("{$api_username}:{$api_password}"),
	]);

	// Execute the request
	$result = curl_exec($ch);

	// Check for errors
	if ($result === false) {
		exit("cURL Error: " . curl_error($ch));
	}

	// Close cURL
	curl_close($ch);

	// Return the response as array
	return json_decode($result, true);;
}

if ($_POST) {

	$result = update_payment_status($_GET['code'], $_POST['status']);

	print "<pre>" . print_r($result, true) . "</pre>";

	exit;
}
?>

<html>
	<body style="display: flex; flex-direction: column; align-items: center; gap: 1rem; font-size: 1rem;">
		<form method="POST">
			<select name="status">
				<option value="SUCCESS">With SUCCESS</option>
				<option value="PENDING">With PENDING</option>
				<option value="FAILED">With FAILED</option>
			</select>
			<input type="submit" value="Pay Now">
		</form>
	</body>
</html>