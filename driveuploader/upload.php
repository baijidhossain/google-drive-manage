<?php
$clientId = "933447737924-73k15t491r968nlkc3joat8qlve8kdbl.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = "http://localhost/driveuploader";

require_once('vendor/autoload.php');

session_start();

$client = new Google_Client();

$client->setApplicationName("Drive API Project");
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);

$client->setScopes(array("https://www.googleapis.com/auth/drive.file"));

$client->setAccessType("offline");
$client->setApprovalPrompt("force");


if (isset($_GET['code'])) {

  $client->fetchAccessTokenWithAuthCode($_GET['code']);

  $_SESSION['token'] = $client->getAccessToken();

  $redirect = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

  header("Location:" . filter_var($redirect), FILTER_SANITIZE_URL);

  return;
}


if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}



if (isset($_REQUEST['logout'])) {

  unset($_SESSION['token']);

  $client->revokeToken();

  session_destroy();

  $redirect = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

  header("Location:" . filter_var($redirect), FILTER_SANITIZE_URL);

  return;
}



// Handle request

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_FILES['uploadPfile'])) {
  $file = $_FILES['upload_file'];

  if ($file['error'] === UPLOAD_ERR_OK) {

    $uploadDirectory = 'uploads/';

    $uploadPath  = $uploadPath . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
    }
  }
}
