<?php
session_start();
if($_SERVER['REQUEST_METHOD']!='POST'){
  $_SESSION["error"]="Brak dostępu";
  header("location: ../index.php");
  exit;
}
echo print_r($_POST);
try{
  $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
  $pdo->query("SET NAMES utf8");
  $prep = $pdo->prepare("UPDATE users SET status=1 WHERE id=:ide");
  $prep->execute([":ide"=>$_POST['sel1']]);
}catch(PDOException $e)
{
  $_SESSION['error']="Błąd podczas tworzenia konta przepraszamy za kłopot2";
}
  $_SESSION['info']="Poprawnie zbanowano urzytkownika";
  header("location: ../moderate.php");
?>
