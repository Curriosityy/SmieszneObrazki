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
          $prep = $pdo->prepare("SELECT * FROM report");
          $prep->execute();
          $i=0;
          while($row = $prep->fetch())
          {
            $prep2 = $pdo->prepare("SELECT * FROM posts WHERE id=:pid");
            $prep2->execute([':pid'=>$row['post_id']]);
            $postRow=$prep2->fetch();
            $prep2 = $pdo->prepare("SELECT * FROM users WHERE id=:uid");
            $prep2->execute([':uid'=>$postRow['user_id']]);
            $userRow=$prep2->fetch();
            printTextBezButt($userRow,$postRow,i%2==0?'lighter row':'darker row');
            $prep2 = $pdo->prepare("SELECT * FROM violationtypes WHERE id=:vid");
            $prep2->execute([':vid'=>$row['violation_id']]);
            $violRow=$prep2->fetch();
            echo '<p>Typ zgłoszenia: '.$violRow['description'].'</p>';
            echo '<p>Dodatkowy opis(opcionalnie): '.$row['destription'].'</p>';
            //wyświetlanie buttonu do akceptacji i odrzucenia
            echo '<div class="btn-group" style="margin:5px 0 10px 0;">
              <button type="button" class="btn btn-primary" onclick="ref('.$row['post_id'].','.$row['user_id'].')">Odrzuć</button>
              <button type="button" class="btn btn-primary" onclick="accept('.$row['post_id'].','.$row['user_id'].')">Akceptuj</button>
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
          url: "scripts/acceptRep.php",
          data:{'postId':post_id,'userId':user_id},
          success: function(html)
          {
            console.log(html);
            confirm('poprawnie usunięto post i zgłoszenie');
            location.reload(true);
          }
        });
      }
      function ref(post_id,user_id)
      {
        $.ajax({
          type: "POST",
          url: "scripts/refRep.php",
          data:{'postId':post_id,'userId':user_id},
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
