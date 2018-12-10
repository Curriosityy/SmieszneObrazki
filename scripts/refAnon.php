<?php
session_start();
$post_ID = $_POST['postId'];
 echo $post_ID;
try{
  $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
  $pdo->query("SET NAMES utf8");
  $prep = $pdo->prepare("UPDATE posts SET postStatus=1 WHERE id=:post_id");
  $prep->execute([':post_id'=>$post_ID]);
}catch(PDOException $e)
{
 echo $e;
}
 ?>
