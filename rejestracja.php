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
          <form class="form-horizontal" action="privateNode/register.php">
            <div class="form-group">
              <label class="control-label col-sm-2">Login:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="login" placeholder="Login">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Hasło:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="pass1" placeholder="*********">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Powtórz hasło:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="pass2" placeholder="*********">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Email:</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" id="email" placeholder="JanuszNosacz@gmail.com">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button class="btn btn-default" type="submit">
                  Rejestruj
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>
</html>
