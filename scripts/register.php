<?php
  session_start();

  if($_SERVER['REQUEST_METHOD']!='POST'){
    $_SESSION["error"]="Brak dostępu";
    header("location: ../index.php");
    exit;
  }else{
    $flag=true;
    $login=$_POST['login'];
    $pass1=$_POST['pass1'];
    $pass2=$_POST['pass2'];
    $email=$_POST['email'];
  }
  try{
    $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
    $pdo->query("SET NAMES utf8");
    $prep=$pdo->prepare("SELECT COUNT(*) FROM users WHERE email=:email");
    $prep->execute([':email'=>$email]);
    if($prep->fetchColumn()>0)
    {
      $flag=false;
      $_SESSION['error']="Email istnieje w naszej bazie danych";
    }else{
      $prep=$pdo->prepare("SELECT COUNT(*) FROM users WHERE login=:login");
      $prep->execute([':login'=>$login]);
      if($prep->fetchColumn()>0)
      {
        $flag=false;
        $_SESSION['error']="Taki nick jest już używany";
      }else{
        $prep=$pdo->prepare("INSERT INTO `users` (`login`,`password`,`email`) VALUES (:login,:password,:email);");

            $hashPassword = password_hash($pass1, PASSWORD_BCRYPT, [
                              'cost' => 11,
                              'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                            ]);
        $count = $prep->execute([':login'=>$login,':password'=>$hashPassword,'email'=>$email]);
        if($count>0)
        {
          $flag=true;
        }else{
          $_SESSION['error']="Błąd podczas tworzenia konta przepraszamy za kłopot1";
          $flag=false;
        }
      }
    }
    if($flag)
    {
      $_SESSION['info']="Konto zostało utworzone";
      $_SESSION['logged']=true;
      $_SESSION['nickname']=$login;
      $_SESSION['miniatura']='anon.png';
      $pdo=null;
    }
  }catch(PDOException $e)
  {
    $_SESSION['error']="Błąd podczas tworzenia konta przepraszamy za kłopot2";
  }
    header("location: ../index.php");
?>
