<!DOCTYPE html>
<?php
  session_start();
  error_reporting(E_ALL ^ E_NOTICE);
  if($_SESSION['admin']!=true)
  {
    header("location: index.php");
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
      <div class="row">
        <form action="scripts/nadaj.php" method="post" role="form">
          <div class="form-group">
            <label for="sel1">Select list:</label>
            <select class="form-control" name="sel1">
              <?php
              try{
                  $pdo = new PDO('mysql:host=localhost;dbname=stronkamemka;charset=utf8', 'root', '');
                  $pdo->query("SET NAMES utf8");
                  $prep = $pdo->prepare("SELECT * FROM users");
                  $prep->execute();
                  while($row = $prep->fetch())
                  {
                    if($row['status']==0)
                      echo "<option value='".$row['id']."'>".$row['login']."</option>";
                  }
                }catch(PDOException $e)
                {

                }
                ?>
            </select>
            <button type="submit" class='btn-primary'>Nadaj uprawnienia</button>
          </div>
        </form>
      </div>
    </div>
</body>
</html>
