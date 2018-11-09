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
        <div class="darker">
            <form class="form-horizontal" action="login.php" method="post">
              <div class="form-group">
                <label class="control-label col-sm-2">Login:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="login" placeholder="Login" minlength="6" maxlength="35" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Password:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="pass" placeholder="********" minlength="8" maxlength="25" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button class="btn btn-default" type="submit">
                    Logowanie
                  </button>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div>
</body>
</html>
