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
          <form class="form-horizontal" action="scripts/register.php" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2">Login:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="login" placeholder="Login" minlength="6" maxlength="35" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Hasło:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="pass1" placeholder="*********" minlength="8" maxlength="25" required onchange="form.pass2.pattern = RegExp.escape(this.value);">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Powtórz hasło:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" name="pass2" id="confirm_password" placeholder="*********" minlength="8" maxlength="25" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2">Email:</label>
              <div class="col-sm-8">
                <input type="email" class="form-control" name="email" placeholder="JanuszNosacz@gmail.com" required>
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
    <script>
      var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
      function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
          confirm_password.setCustomValidity('');
        }
      }
      password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
    </script>
</body>
</html>
