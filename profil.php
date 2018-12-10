<!DOCTYPE html>
<?php include_once("privateNode/session.php")?>
<html lang="en">
<head>
  <?php include_once("privateNode/head.php")?>
</head>
<body>
  <?php include_once("privateNode/navbar.php")?>
    <div class="container" >
      <div class="row">
        <?php if($_SESSION["admin"]==true) echo '<a href="/stronkaMemka/moderate.php" class="">Nadaj uprawnienia moderatorskie</a> </br>'; ?>

        <?php if($_SESSION["admin"]==true || $_SESSION["moderator"]==true)
        {
          echo '<a href="/stronkaMemka/zgloszenia.php" class="">Przegląd zgłoszonych postów</a></br>';
          echo '<a href="/stronkaMemka/anonimy.php" class="">Przegląd anonimowych postów</a></br>';
          echo '<a href="/stronkaMemka/banuj.php" class="">Banuj urzytkowników</a>';
        }
        ?>
      </div>
    </div>
</body>
</html>
