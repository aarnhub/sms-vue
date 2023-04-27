<?php
	$to = htmlspecialchars($_REQUEST['to']);
	$message = htmlspecialchars($_REQUEST['message']);
	
// Set your Proovl API key and from Proovl number
	
$api_key = '22v3v223'; # Proovl Token
$from = '444444444';   # Proovl Number

$url = "https://www.proovl.com/api/send.php";

$query_params = array(
    'api_key' => $api_key,
    'from' => "$from",
    'to' => "$to",
    'text' => "$message"
);

$url .= '?' . http_build_query($query_params);

$response = file_get_contents($url);

$result = explode(';', $response);

if ($result[0] == 'Error') {
	 http_response_code(400);
    echo json_encode(array('error' => $result[1]));
} else {
	 http_response_code(200);
    echo json_encode(array(
        'message_id' => $result[1],
        'status' => $result[0],
        'parts' => $result[2]
    ));
}
?>
