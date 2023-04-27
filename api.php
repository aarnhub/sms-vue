<?php
$to = htmlspecialchars($_REQUEST['to']);
$message = htmlspecialchars($_REQUEST['message']);

// Set your Proovl API key and from Proovl number
$user = 'Nnf3n92'; // Proovl User ID
$token = 'Fsdf2j92'; // Proovl Token
$from = '444444444'; // Proovl Number

$url = "https://www.proovl.com/api/send.php";

$data = array(
    'user' => $user,
    'token' => $token,
    'from' => $from,
    'to' => $to,
    'text' => $message
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);

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
