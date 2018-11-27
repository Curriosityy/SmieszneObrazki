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
    function printText($userRow,$textRow,$color,$commentsCount,$upVoteCount,$isUpVoted,$isLiked,$isReported)
    {
      $upVoteClass=$isUpVoted==true?"class='col-sm-3 przycisk2'":"class='col-sm-3 przycisk'";
      $upLikeClass=$isLiked==true?"class='col-sm-3 przycisk2'":"class='col-sm-3 przycisk'";
      $repClass = $isReported==true?"class='col-sm-3 przycisk2'":"class='col-sm-3 przycisk'";
      $commentsCount=$commentsCount==-1?"":"<span class='badge'>$commentsCount</span>";
      $userLogin=$textRow["anon"]==1?'Anonim':$userRow["login"];
      $userImage=$userRow["image"];
      $obrazek=$textRow['image']==''?'':"<img class='img-rounded img-responsive' src='".$textRow['image']."' alt='obrazekPostu'>";
      $profile=$textRow['anon']==1?"<img class='img-circle' height='55' src='anon.png' alt='miniaturka'>":"<a href='profil.php?profile=".$userLogin."' style='padding:1px;'><img class='img-circle' height='55' src='".$userImage."' alt='miniaturka'></a>";
      $butoniki=$_SESSION["logged"]==true?"
      <div class='row'>
        <a href='#!' onClick='voteUpPost(this);' ".$upVoteClass.">Lubie To <span class='glyphicon glyphicon-thumbs-up'></span> <span class='badge'>".$upVoteCount."</span></a>
        <a href='#!' onClick='commentPost(this);' class='col-sm-3 przycisk'>Komentuj <span class='glyphicon glyphicon-comment'></span> ".$commentsCount."</a>
        <a href='#!' onClick='likePost(this);' ".$upLikeClass.">Dodaj do ulubionych <span class='glyphicon glyphicon-heart-empty'></span></a>
        <a href='#!' onClick='reportPost(this)' ".$repClass.">Zgłoś <span class='glyphicon glyphicon-warning-sign'></span></a>
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
?>
