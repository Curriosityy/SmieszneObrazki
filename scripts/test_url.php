<?php
session_start();
if($_SERVER['REQUEST_METHOD']!='POST'){
  $_SESSION["error"]="Brak dostępu";
  header("location: ../index.php");
  exit;
}else{
  if(@getimagesize($_POST["imgUrl"]))
  {
    echo 'isImage';
  }else{
    echo 'notImage';
  }
}
?>
