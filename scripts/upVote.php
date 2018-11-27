<?php
  session_start();
  $post_ID = $_POST['postId'];
  try{
    $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
    $pdo->query("SET NAMES utf8");
    $prep = $pdo->prepare("SELECT COUNT(*) FROM upvoted_posts WHERE post_id=:post_id AND user_id=:user_id");
    $prep->execute([':post_id'=>$post_ID,':user_id'=>$_SESSION['ID']]);
    if($prep->fetch()[0]==0)
    {
      //upVote
      $prep = $pdo->prepare("INSERT INTO upvoted_posts (post_id, user_id) VALUES (:post_id,:user_id)");
      $prep->execute([':post_id'=>$post_ID,':user_id'=>$_SESSION['ID']]);
    }else {
      //downVote
      $prep = $pdo->prepare("DELETE FROM upvoted_posts WHERE post_id=:post_id AND user_id=:user_id");
      $prep->execute([':post_id'=>$post_ID,':user_id'=>$_SESSION['ID']]);
    }
    $prep = $pdo->prepare("SELECT COUNT(*) FROM upvoted_posts WHERE post_id=:post_id");
    $prep->execute([':post_id'=>$post_ID]);
    echo $prep->fetch()[0];
  }catch(PDOException $e)
  {

  }
?>
