<!DOCTYPE html>
<?php
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);
  if($_SESSION['admin']!=true)
  {
    if($_SESSION['moderator']!=true)
    {
      header("location: index.php");
    }
  }
?>
<?php include_once("privateNode/session.php")?>
<html lang="en">
<head>
  <?php include_once("privateNode/head.php")?>
</head>
<body>
  <?php include_once("privateNode/navbar.php")?>
    <div class="container" >
      <?php
      include_once("privateNode/phpFunction.php");
      try{
          $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
          $pdo->query("SET NAMES utf8");
          $prep = $pdo->prepare("SELECT * FROM posts WHERE accepted=0 AND postStatus=0");
          $prep->execute();
          $i=0;
          while($postRow = $prep->fetch())
          {
            $prep2 = $pdo->prepare("SELECT * FROM users WHERE id=:uid");
            $prep2->execute([':uid'=>$postRow['user_id']]);
            $userRow=$prep2->fetch();
            printTextBezButt($userRow,$postRow,i%2==0?'lighter row':'darker row');
            //wyświetlanie buttonu do akceptacji i odrzucenia
            echo '<div class="btn-group" style="margin:5px 0 10px 0;">
              <button type="button" class="btn btn-primary" onclick="ref('.$postRow['id'].')">Odrzuć</button>
              <button type="button" class="btn btn-primary" onclick="accept('.$postRow['id'].')">Akceptuj</button>
            </div>';
            echo "</div></div>";
            $i=$i+1;
          }
        }catch(PDOException $e)
        {

        }
      ?>
    </div>
    <script>
      function accept(post_id,user_id)
      {
        $.ajax({
          type: "POST",
          url: "scripts/acceptAnon.php",
          data:{'postId':post_id},
          success: function(html)
          {
            console.log(html);
            confirm('poprawnie zaakceptowano post');
            location.reload(true);
          }
        });
      }
      function ref(post_id,user_id)
      {
        $.ajax({
          type: "POST",
          url: "scripts/refAnon.php",
          data:{'postId':post_id},
          success: function(html)
          {
            console.log(html);
            confirm('odrzucono zgłoszenie');
            location.reload(true);
          }
        });
      }
    </script>
</body>
</html>
