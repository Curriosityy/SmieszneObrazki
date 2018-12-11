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
    $count = $prep->fetch()[0];
    echo $count;
    $prep = $pdo->prepare("UPDATE posts SET up_vote=:cou WHERE id=:post_id");
    $prep->execute([':cou'=>$count,':post_id'=>$post_ID]);
  }catch(PDOException $e)
  {

  }
?>
