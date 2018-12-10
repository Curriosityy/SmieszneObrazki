<?php
  session_start();
  $post_ID = $_POST['postId'];
  $repType= $_POST['repType'];
  $addInfo=$_POST['addInf']==''?NULL:$_POST['addInf'];
  $reporterId=$_SESSION["ID"];
  try{
    $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
    $pdo->query("SET NAMES utf8");
    $prepInsert = $pdo->prepare("INSERT INTO `report` (`post_id`, `destription`, `violation_id`, `user_id`) VALUES (:pid, :desci, :vid, :uid);");
    $prepInsert->execute([':pid'=>$post_ID,':desci'=>$addInfo, ':vid'=>$repType, ':uid'=>$reporterId]);
  }catch(PDOException $e)
  {
    echo $e;
  }
?>
