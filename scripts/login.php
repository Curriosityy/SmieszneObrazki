<?php
session_start();
if($_SERVER['REQUEST_METHOD']!='POST'){
  $_SESSION["error"]="Brak dostępu";
  header("location: ../index.php");
  exit;
}else{
  $login=$_POST['login'];
  $password=$_POST['pass'];
}
try{
  $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
  $pdo->query("SET NAMES utf8");
  $prep = $pdo->prepare("SELECT password, status, image FROM users WHERE login=:login");
  $prep->execute([':login'=>$login]);
  if($prep->rowCount()==1)
  {
    $row = $prep->fetch();
    $hashedPassword = $row['password'];
    $salt = substr($hashedPassword,7,22);
    if(hash_equals($hashedPassword,password_hash($password,PASSWORD_BCRYPT,['cost' => 11, 'salt' => $salt,])))
    {
      $_SESSION['logged']=true;
      $_SESSION['login']=$login;
      $_SESSION['miniatura']=$row['image'];
      if($row['status']==1)
      {
        $_SESSION['banned']=true;
      }
      if($row['status']==2)
      {
        $_SESSION['moderator']=true;
      }
      if($row['status']==3)
      {
        $_SESSION['admin']=true;
      }
      }else {
      $_SESSION["error"]="Błędne hasło";
      header("location: ../logowanie.php");
      exit;
    }
  }else
  {
      $_SESSION["error"]="Takie konto nie isnieje";
      header("location: ../logowanie.php");
      exit;
  }
}catch(PDOException $e)
{
  $_SESSION['error']="Błąd podczas tworzenia konta przepraszamy za kłopot2";
}
header("location: ../index.php");
?>
