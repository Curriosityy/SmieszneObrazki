<?php
session_start();
$post_ID = $_POST['postId'];
$user_ID = $_POST['userId'];
echo $post_ID;
echo $user_ID;
try{
  $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
  $pdo->query("SET NAMES utf8");
  $prep = $pdo->prepare("DELETE FROM report WHERE post_id=:pid AND user_id=:uid ");
  $prep->execute([':pid'=>$post_ID,':uid'=>$user_ID]);
}catch(PDOException $e)
{

}
 ?>
