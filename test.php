<?php
  try {
    $con = mysqli_connect("45.32.107.34", "root","root");
    mysqli_set_charset(self::$con, 'UTF8');
    if (mysqli_connect_errno()) {
      echo "Failed" . mysqli_connect_error();
      exit();
    }
  } catch (\Exception $th) {
    throw $th;
    exit();
  }
?>