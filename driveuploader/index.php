<?php

require_once("upload.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" />
</head>

<body>


  <?php


  if ($client->getAccessToken()) {

    $_SESSION['token'] = $client->getAccessToken();

    if (isset($_SESSION['token'])) {

      $token = $_SESSION['token'];

      echo "Access Token: " . $token['access_token'];

      $saveToken = file_put_contents("token.txt", $token['refresh_token']);

      if ($saveToken) {
        echo "<br>";
        echo "Refresh token successfully saved";
        echo "<br>";
      }

      echo '<a class="btn btn-danger" href="?logout">Logout</a>';
    }
  } else {
    $authUrl = $client->createAuthUrl();

    echo  '<a href="' . $authUrl . '">Connect me</a>';
  }

  ?>


  <div class="row">
    <div class="col-md-6">

      <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upload_file" class="form-control mb-3 mt-3">

        <button class="btn btn-primary" type="submit">File Upload</button>

      </form>

    </div>
  </div>

</body>

</html>