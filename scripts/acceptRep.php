<?php
session_start();
$post_ID = $_POST['postId'];
$user_ID = $_POST['userId'];
try{
  $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
  $pdo->query("SET NAMES utf8");
  $prep = $pdo->prepare("DELETE FROM report WHERE post_id=:pid AND user_id=:uid ");
  $prep->execute([':pid'=>$post_ID,':uid'=>$user_ID]);
  $prep = $pdo->prepare("UPDATE posts SET postStatus=1 WHERE id=:post_id");
  $prep->execute([':post_id'=>$post_ID]);
}catch(PDOException $e)
{

}
 ?>
