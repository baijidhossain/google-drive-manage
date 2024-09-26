<?php



if (isset($_GET['code'])) {

  $_SESSION['token'] = $_GET['code'];


  echo '<pre>';
  print_r($_SESSION['token']);
  echo '</pre>';



  // $redirect = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

  // header("Location" . filter_var($redirect), FILTER_SANITIZE_URL);

  // return;
}



if (isset($_SESSION['token'])) {

  $token = $_SESSION['token'];
}

?>



<h1> <a href="<?= $authUrl ?>">Connect me</a> </h1>