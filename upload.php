<?php
include('vendor/rmccue/requests/library/Requests.php');
Requests::register_autoloader();

$headers = array(
	'Content-type' => 'application/json',
	'Authorization' => 'Bearer YOUR-LOGIN-TOKEN'
);


$data = '{
  "base64": "SGVsbG8gd29ybGQh",
  "filename": "file.txt",
  "properties": {
    "webhooks": {
      "status": "https://yoursite.com/webhook/{STATUS}/my-custom-id"
    }
  }
}';

$response = Requests::put('https://api.copyleaks.com/v3/education/submit/file/my-custom-id', $headers, $data);