<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Stronka Memka</a>
    </div>
    <ul class="nav navbar-nav">
      <?php
       if($_SERVER['PHP_SELF']=="/stronkaMemka/index.php"){
        echo '<li class="active"><a href="index.php">Gorące</a></li>';
      }else{
        echo '<li><a href="index.php">Gorące</a></li>';
      }
      if($_SERVER['PHP_SELF']=="/stronkaMemka/wszystkie.php"){
        echo '<li class="active"><a href="wszystkie.php">Wszystkie</a></li>';
      }else{
        echo '<li><a href="wszystkie.php">Wszystkie</a></li>';
      }
      if($_SESSION["logged"]!=false)
        if($_SERVER['PHP_SELF']=="/stronkaMemka/ulubione.php"){
          echo '<li class="active"><a href="ulubione.php">Ulubione</a></li>';
        }else{
          echo '<li><a href="ulubione.php">Ulubione</a></li>';
        }
      if($_SESSION["logged"]!=false)
        if($_SERVER['PHP_SELF']=="/stronkaMemka/sledzone.php"){
          echo '<li class="active"><a href="sledzone.php">Śledzone tagi</a></li>';
        }else{
          echo '<li><a href="sledzone.php">Śledzone tagi</a></li>';
        }
      if($_SERVER['PHP_SELF']=="/stronkaMemka/szukaj.php"){
        echo '<li class="active"><a id="wyszukajButton" href="#">Szukaj</a></li>';
      } else {
        echo '<li><a id="wyszukajButton" href="#">Szukaj</a></li>';
      }
      ?>
      <li>
        <form id="wyszukaj" class="navbar-form navbar-left" action="szukaj.php" style="display: none;">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </form>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <?php
      if($_SESSION["logged"]==true)
      {
        echo '<li><a href="logout.php"><span class="glyphicon glyphicon-lock"></span> Wyloguj</a></li>';
        if($_SERVER['PHP_SELF']=="/stronkaMemka/profil.php")
        {
          echo '<li class="active"><a href="profil.php" style="padding:1px;"><img href="profil.php" class="img-circle" height="48" src="'.$_SESSION["miniatura"].'" alt="miniaturka"></a></li>';
        }else {
          echo '<li><a href="profil.php" style="padding:0;"><img href="profil.php" class="img-circle" height="48" src="'.$_SESSION["miniatura"].'" alt="miniaturka"></a></li>';
        }
      }else{
        if($_SERVER['PHP_SELF']=="/stronkaMemka/rejestracja.php")
        {
          echo '<li class="active"><a href="rejestracja.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a></li>';
        }else{
          echo '<li><a href="rejestracja.php"><span class="glyphicon glyphicon-user"></span> Rejestracja</a></li>';
        }
        if($_SERVER['PHP_SELF']=="/stronkaMemka/logowanie.php")
        {
          echo '<li class="active"><a href="logowanie.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie</a></li>';
        }else{
          echo '<li><a href="logowanie.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie</a></li>';
        }
      }
      ?>
    </ul>
  </div>
</nav>
<?php
  if($_SESSION["logged"]==true)
  {
    echo '<div id="loggedShift"></div>';
  }
?>
<div id="shift" style="display: none;"></div>
<script>
$(document).ready(function(){
  $("#wyszukajButton").click(function(){
    $("#wyszukaj").toggle(400);
    $("#wyszukajButton").blur();
    $("#shift").toggle(400);
    //$("body").css("padding-top",$("#nawigacja").outerHeight(true)+"px");
  })
});
</script>
