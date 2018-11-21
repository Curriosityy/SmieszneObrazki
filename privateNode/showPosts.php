<?php
    function printText($userRow,$textRow,$color,$commentsCount)
    {
      $commentsCount=$commentsCount==-1?"":"<span class='badge'>$commentsCount</span>";
      $userLogin=$textRow["anon"]==1?'Anonim':$userRow["login"];
      $userImage=$userRow["image"];
      $obrazek=$textRow['image']==''?'':"<img class='img-rounded img-responsive' src='".$textRow['image']."' alt='obrazekPostu'>";
      $profile=$textRow['anon']==1?"<img class='img-circle' height='55' src='anon.png' alt='miniaturka'>":"<a href='profil.php?profile=".$userLogin."' style='padding:1px;'><img class='img-circle' height='55' src='".$userImage."' alt='miniaturka'></a>";
      $butoniki=$_SESSION["logged"]==true?"
      <div class='row'>
        <a class='col-sm-3 przycisk'>Lubie To <span class='glyphicon glyphicon-thumbs-up'></span></a>
        <a class='col-sm-3 przycisk'>Komentuj <span class='glyphicon glyphicon-comment'></span> ".$commentsCount."</a>
        <a class='col-sm-3 przycisk'>Dodaj do ulubionych <span class='glyphicon glyphicon-heart-empty'></span></a>
        <a class='col-sm-3 przycisk'>Zgłoś <span class='glyphicon glyphicon-warning-sign'></span></a>
        <input type='hidden' name='anonPosting' value='postId".$textRow['id']."'>
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
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }else
    {
        $page=1;
    }
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
        $pdo->query("SET NAMES utf8");
        if($_GET['sort']=='all'){
          $prep = $pdo->prepare("SELECT id, tekst, image, up_vote, user_id, post_id, create_date, anon FROM posts WHERE post_id IS NULL AND accepted=1 ORDER BY create_date DESC");
          $prep->execute();
        }
        if($_GET['sort']=='hot'){
          $prep = $pdo->prepare("SELECT id, tekst, image, up_vote, user_id, post_id, create_date, anon FROM posts WHERE post_id IS NULL AND accepted=1 AND create_date >= TIMESTAMP(DATE_SUB(SYSDATE(), INTERVAL :maxTime HOUR)) ORDER BY up_vote DESC;");
          $prep->execute([':maxTime'=>$_GET['time']]);
        }
        $i=0;
        while($row = $prep->fetch()){
            $prep2=$pdo->prepare("SELECT login, image FROM users WHERE id=:id");
            $prep2->execute([':id'=>$row['user_id']]);
            $row2=$prep2->fetch();
            $color=$i%2==0?'lighter row':'darker row';
            $prep3=$pdo->prepare("SELECT id,tekst, image, up_vote, user_id, post_id, create_date, anon FROM posts WHERE post_id=:post_id AND accepted=1");
            $prep3->execute([":post_id"=>$row['id']]);
            printText($row2,$row,$color,$prep3->rowCount());
            while($row3=$prep3->fetch()){
              $prep4=$pdo->prepare("SELECT login, image FROM users WHERE id=:id");
              $prep4->execute([':id'=>$row3['user_id']]);
              $row4=$prep4->fetch();
              printText($row4,$row3,"",-1);
              echo "</div></div>";
            }
            echo"
                </div>
            </div>";
            $i=1+$i;
          }
        $prep->closeCursor();
    }catch(PDOException $e)
    {

    }

?>
