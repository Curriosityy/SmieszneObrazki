<?php
    function getUpVoteCount($postID,$pdo)
    {
      $prepareUpCount = $pdo->prepare("SELECT COUNT(*) FROM upvoted_posts WHERE post_id=:postid");
      $prepareUpCount->execute([':postid'=>$postID]);
      return $prepareUpCount->fetch()[0];
    }
    function isLikedByUser($postID,$userId,$pdo)
    {
      $prepareIsLikedByUser = $pdo->prepare("SELECT COUNT(*) FROM liked_posts WHERE post_id=:postid AND user_id=:userid");
      $prepareIsLikedByUser->execute([':postid'=>$postID, ':userid'=>$userId]);
      return $prepareIsLikedByUser->fetch()[0]==1?true:false;
    }
    function isReportedByUser($postID,$userId,$pdo)
    {
      $prepare = $pdo->prepare("SELECT COUNT(*) FROM report WHERE post_id=:postid AND user_id=:userid");
      $prepare->execute([':postid'=>$postID,':userid'=>$userId]);
      return $prepare->fetch()[0]==1?true:false;
    }
    function isUpvotedByUser($postID,$userId,$pdo)
    {
      $prepareIsUpByUser = $pdo->prepare("SELECT COUNT(*) FROM upvoted_posts WHERE post_id=:postid AND user_id=:userid");
      $prepareIsUpByUser->execute([':postid'=>$postID, ':userid'=>$userId]);
      return $prepareIsUpByUser->fetch()[0]==1?true:false;
    }

    function canDelete($textRow)
    {
      if($textRow['user_id']==$_SESSION['ID'])
      {
        return true;
      }
      if($_SESSION['admin']==true || $_SESSION['moderator']==true)
      {
        return true;
      }
      if($textRow['post_id']!=NULL)
      {
        try{
          $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
          $pdo->query("SET NAMES utf8");

          $prepare = $pdo->prepare("SELECT * FROM posts WHERE id=:pid");
          $prepare->execute([':pid'=>$textRow['post_id']]);

          return $prepare->fetch()['user_id']==$_SESSION['ID']?true:false;
        }catch(PDOException $e)
        {

        }
      }
      return false;
    }

    function printText($userRow,$textRow,$color,$commentsCount,$upVoteCount,$isUpVoted,$isLiked,$isReported)
    {
      $colsm=$textRow['user_id']==$_SESSION['ID']?2:3;
      $edit=$textRow['user_id']==$_SESSION['ID']?"<a href='/stronkaMemka/edit.php?postID=".$textRow['id']."'  class='col-sm-".$colsm." przycisk'>Edytuj <span class='glyphicon glyphicon-edit'></span></a>":'';
      $canDelete=canDelete($textRow);
      if($colsm==3)
      {
        $colsm=$canDelete==true?2:3;
      }
      $delete=$canDelete==true?"<a href='#!' onClick='deletePost(this);' class='col-sm-".$colsm." przycisk'>Usuń <span class='glyphicon glyphicon-trash'></span></a>":'';
      $upVoteClass=$isUpVoted==true?"class='col-sm-".$colsm." przycisk2'":"class='col-sm-".$colsm." przycisk'";
      $upLikeClass=$isLiked==true?"class='col-sm-".$colsm." przycisk2'":"class='col-sm-".$colsm." przycisk'";
      $repClass = $isReported==true?"class='col-sm-".$colsm." przycisk2'":"class='col-sm-".$colsm." przycisk'";
      $commentsCount=$commentsCount==-1?"":"<span class='badge'>$commentsCount</span>";
      $userLogin=$textRow["anon"]==1?'Anonim':$userRow["login"];
      $userImage=$userRow["image"];
      $obrazek=$textRow['image']==''?'':"<img class='img-rounded img-responsive' src='".$textRow['image']."' alt='obrazekPostu'>";
      $profile=$textRow['anon']==1?"<img class='img-circle' height='55' src='anon.png' alt='miniaturka'>":"<a href='profil.php?profile=".$userLogin."' style='padding:1px;'><img class='img-circle' height='55' src='".$userImage."' alt='miniaturka'></a>";
      $butoniki=$_SESSION["logged"]==true?"
      <div class='row'>
        <a href='#!' onClick='voteUpPost(this);' ".$upVoteClass.">Lubie To <span class='glyphicon glyphicon-thumbs-up'></span> <span class='badge'>".$upVoteCount."</span></a>
        <a href='/stronkaMemka/comment.php?postToCommentID=".$textRow['id']."' class='col-sm-".$colsm." przycisk'>Komentuj <span class='glyphicon glyphicon-comment'></span> ".$commentsCount."</a>
        <a href='#!' onClick='likePost(this);' ".$upLikeClass.">Ulubione <span class='glyphicon glyphicon-heart-empty'></span></a>
        <a href='#!' data-toggle='modal' data-target='#reportModal' onClick='reportPost(this)' ".$repClass.">Zgłoś <span class='glyphicon glyphicon-warning-sign'></span></a>
        ".$edit."
        ".$delete."
        <input type='hidden' value='".$textRow['id']."'>
      </div>
      <hr style='margin-top:5px;margin-bottom:5px'>":"";
      echo "
      <div class='".$color." media'>
        <div class='media-left'>
          ".$profile."
        </div>
        <div class='media-body'>
          <h4 class='media-heading'><a href='profil.php?profile=".$userLogin."' style='padding:1px;'></a>".$userLogin."<small> ".$textRow['create_date']."</small></h4>
          <p>".$textRow['tekst']."</p>
          ".$obrazek."\n
        <hr style='margin-top:5px;margin-bottom:5px'>".$butoniki."";
    }
    function printTextBezButt($userRow,$textRow,$color)
    {
      $userLogin=$textRow["anon"]==1?'Anonim':$userRow["login"];
      $userImage=$userRow["image"];
      $obrazek=$textRow['image']==''?'':"<img class='img-rounded img-responsive' src='".$textRow['image']."' alt='obrazekPostu'>";
      $profile=$textRow['anon']==1?"<img class='img-circle' height='55' src='anon.png' alt='miniaturka'>":"<a href='profil.php?profile=".$userLogin."' style='padding:1px;'><img class='img-circle' height='55' src='".$userImage."' alt='miniaturka'></a>";
      echo "
      <div class='".$color." media'>
        <div class='media-left'>
          ".$profile."
        </div>
        <div class='media-body'>
          <h4 class='media-heading'><a href='profil.php?profile=".$userLogin."' style='padding:1px;'></a>".$userLogin."<small> ".$textRow['create_date']."</small></h4>
          <p>".$textRow['tekst']."</p>
          ".$obrazek."\n
        <hr style='margin-top:5px;margin-bottom:5px'>";
    }
?>
