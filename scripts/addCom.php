<?php
session_start();
if($_SERVER['REQUEST_METHOD']!='POST'){
  $_SESSION["error"]="Brak dostępu";
  header("location: ../index.php");
  exit;
}else{
  $postToAdd=$_POST['postText'];
  $akceptancja=$_SESSION['logged']==true?1:0;
  $postPhotoUrl=$_POST['postPhotoUrl'];
  try{
    $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
    $pdo->query("SET NAMES utf8");
    $prep=$pdo->prepare("SELECT id FROM users WHERE login=:login ");
    $prep->execute([':login'=>$_SESSION['login']]);
    $row = $prep->fetch();
    $id = $row['id'];
    $hashtagsArray=array();
    $prep=$pdo->prepare("SELECT id FROM tags WHERE tag=:tag; ");
    foreach (explode(" ",$postToAdd) as $value) {
      if(eregi("^#[a-z0-9A-Z]*",$value))
      {
        $prep->execute([':tag'=>$value]);
        if($prep->rowCount()==0)
        {
          $prep2=$pdo->prepare("INSERT INTO `tags` (`tag`) VALUES (:tag);");
          $prep2->execute([':tag'=>$value]);
          $hashtagsArray[$pdo->lastInsertId()]=$value;
        }else {
          $row2= $prep->fetch();
          $hashtagsArray[$row2['id']]=$value;
        }
      }
    }
    $prep=$pdo->prepare("SELECT id, post_id FROM posts WHERE id=:pid");
    echo $_POST['postToCommentId'];
    $prep->execute([":pid"=>$_POST['postToCommentId']]);
    $portRow=$prep->fetch();
    $mainPostID=$portRow[1]==null?$mainPostID=$portRow[0]:$mainPostID=$portRow[1];
    $prep=$pdo->prepare("INSERT INTO `posts` (`tekst`,`image`,`user_id`,`anon`,`accepted`,`post_id`) VALUES (:tekst, :image, :user_id, :anonim,:accepted,:mainPostId);");
    $prep->execute([':tekst'=>$postToAdd,':image'=>$postPhotoUrl,':user_id'=>$id,':anonim'=>0,':accepted'=>$akceptancja,':mainPostId'=>$mainPostID]);
    $postId=$pdo->lastInsertId();
    $prep=$pdo->prepare("INSERT INTO `post_tag` (`post_id`,`tag_id`) VALUES (:post_id, :tag_id);");
    foreach ($hashtagsArray as $key => $value) {
      $prep->execute([':post_id'=>$postId,':tag_id'=>$key]);
    }
    $pdo=null;
  }catch(PDOException $e)
  {
  $_SESSION['error']="Błąd podczas tworzenia konta przepraszamy za kłopot2";
  }
}
header("location: ../index.php");
?>
