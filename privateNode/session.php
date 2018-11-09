<?php
  session_start();
  if(!isset($_SESSION['logged']))
  {
    echo"
    <script>
      confirm('CBŚ chcę znać twoją lokalizację');
    </script>
    ";
    $_SESSION['logged']=false;
    $_SESSION['nickname']='';
    $_SESSION['admin']=false;
    $_SESSION['moderator']=false;
  }
  if(isset($_SESSION['info'])){
    $info=$_SESSION['info'];
    echo "
    <script>
      alert('$info');
    </script>";
    unset($_SESSION['info']);
  }
  if(isset($_SESSION['error'])){
    $error=$_SESSION['error'];
    echo "
    <script>
      alert('$error');
    </script>";
  unset($_SESSION['error']); }
?>
