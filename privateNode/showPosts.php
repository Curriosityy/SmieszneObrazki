<?php
    require_once('phpFunction.php');
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
          $prep = $pdo->prepare("SELECT id, tekst, image, up_vote, user_id, post_id, create_date, anon, postStatus FROM posts WHERE post_id IS NULL AND accepted=1 ORDER BY create_date DESC");
          $prep->execute();
        }
        if($_GET['sort']=='hot'){
          $prep = $pdo->prepare("SELECT id, tekst, image, up_vote, user_id, post_id, create_date, anon, postStatus FROM posts WHERE post_id IS NULL AND accepted=1 AND create_date >= TIMESTAMP(DATE_SUB(SYSDATE(), INTERVAL :maxTime HOUR)) ORDER BY up_vote DESC;");
          $prep->execute([':maxTime'=>$_GET['time']]);
        }
        $i=0;

        while($row = $prep->fetch()){
            if($row['postStatus']!=1)
            {
            $prep2=$pdo->prepare("SELECT id, login, image, status FROM users WHERE id=:id");
            $prep2->execute([':id'=>$row['user_id']]);
            $row2=$prep2->fetch();
            $color=$i%2==0?'lighter row':'darker row';
            $prep3=$pdo->prepare("SELECT id, tekst, image, up_vote, user_id, post_id, create_date, anon, postStatus FROM posts WHERE post_id=:post_id AND accepted=1");
            $prep3->execute([":post_id"=>$row['id']]);

            $upVoteCountForPost=getUpVoteCount($row[0],$pdo);
            $isVotedByUser=isUpvotedByUser($row[0],$_SESSION['ID'],$pdo);
            $isFav = isLikedByUser($row[0],$_SESSION['ID'],$pdo);
            $isRep = isReportedByUser($row[0],$_SESSION['ID'],$pdo);

            printText($row2,$row,$color,$prep3->rowCount(),$upVoteCountForPost,$isVotedByUser,$isFav,$isRep);
            if($row['postStatus']!=1)
            {
              while($row3=$prep3->fetch()){

                $upVoteCountForPost1=getUpVoteCount($row3[0],$pdo);
                $isVotedByUser1=isUpvotedByUser($row3[0],$_SESSION['ID'],$pdo);
                $isFav1 = isLikedByUser($row3[0],$_SESSION['ID'],$pdo);
                $isRep1 = isReportedByUser($row3[0],$_SESSION['ID'],$pdo);

                $prep4=$pdo->prepare("SELECT id ,login, image, status FROM users WHERE id=:id");
                $prep4->execute([':id'=>$row3['user_id']]);
                $row4=$prep4->fetch();
                printText($row4,$row3,"",-1,$upVoteCountForPost1,$isVotedByUser1,$isFav1,$isRep1);
                echo "</div></div>";
              }
            }
            echo"
                </div>
            </div>";
            $i=1+$i;
          }
        }
        $prep->closeCursor();
    }catch(PDOException $e)
    {

    }

?>
