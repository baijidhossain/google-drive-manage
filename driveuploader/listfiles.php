<?php

session_start();



// if (isset($_SESSION['token'])) {

//   $url = 'https://www.googleapis.com/drive/v3/files';

//   $params = http_build_query(array(
//     'pageSize' => 10,
//     'fields' => 'files(id,name,mimeType,createdTime)',
//     'orderBy' => 'createdTime desc'
//   ));

//   $url .= $params;
//   $token = $_SESSION['token'];


//   echo '<pre>';
//   print_r($_SESSION['token']);
//   echo '</pre>';
// }


echo '<pre>';
print_r($_SESSION['token']['access_token']);
echo '</pre>';


$url = 'https://www.googleapis.com/drive/v3/files?';

// Build the query parameters
$params = http_build_query(array(
  'pageSize' => 10,
  'fields' => 'files(id,name,mimeType,createdTime)',
  'orderBy' => 'createdTime desc'
));

// Append parameters to the URL
$url .= $params;

// Get the token from the session
$token = $_SESSION['token']['access_token'];

// Set up the HTTP headers
$headers = [
  "Authorization: Bearer $token"
];

// Initialize a cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
} else {
  // Decode the JSON response
  $files = json_decode($response, true);

  // Display the files
  if (isset($files['files']) && !empty($files['files'])) {
    foreach ($files['files'] as $file) {
      echo "File ID: " . $file['id'] . "<br>";
      echo "Name: " . $file['name'] . "<br>";
      echo "MIME Type: " . $file['mimeType'] . "<br>";
      echo "Created Time: " . $file['createdTime'] . "<br><br>";
    }
  } else {
    echo "No files found.";
  }
}

// Close the cURL session
curl_close($ch);
