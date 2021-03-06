<!DOCTYPE html>
<?php
  if(!isset($_GET['sort']))
  {
    header("location: index.php?sort=hot&time=12");
    exit();
  }
 include_once("privateNode/session.php")
 ?>
<html lang="en">
<head>
  <?php include_once("privateNode/head.php")?>
  <script type="text/javascript" src="jsScript/underPost.js"></script>
</head>
<body>
  <?php include_once("privateNode/navbar.php")?>
    <div class="container" >
        <div class="darker row">
          <form class="form-horizontal" action="scripts/addPost.php" method="post">
            <div class="form-group" style="margin-bottom:0px;">
             <label class="control-label col-sm-1">
              <?php if($_SESSION['logged']==true)
              {
                echo '<a href="profil.php" style="padding:1px;"><img class="img-circle" height="55" src="'.$_SESSION["miniatura"].'" alt="miniaturka"></a>';
              } else {
                echo '<img class="img-circle" height="55" src="'.$_SESSION["miniatura"].'" alt="miniaturka">';
              }
              ?>
             </label>
              <div class="col-sm-11 container">
                <div class="row">
                  <textarea class="form-control postarea" rows="3" name="postText" minlength="6" required></textarea>
                </div>
                  <div class="row myButtons" style="display: none;">
                    <ul class="list-inline showImageUnderText" style="display: none;">
                      <li>
                        <img class="img-rounded obrazekImg" src="anon.png" height="55" alt="miniaturka">
                      </li>
                      <li>
                        <p class="img-url"></p>
                      </li>
                      <li>
                        <label class="checkbox-inline com-button"><a class="deletePhoto"><span class='glyphicon glyphicon-trash'></span></a></label>
                      </li>
                    </ul>
                    <ul class="list-inline">
                      <li>
                        <label class="checkbox-inline com-button"><button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-send"></span> Wyślij</button></label>
                      </li>
                      <li>
                        <label class="checkbox-inline com-button"><a class="anuluj"><span class="glyphicon glyphicon-remove"></span> Anuluj</a></label>
                      </li>
                      <li>
                        <label class="checkbox-inline"><input type="checkbox" value='on' name="anonPosting" <?php if($_SESSION['logged']!=true) echo "checked disabled><input type='hidden' name='anonPosting' value='on'>"; else echo ">"; ?>Anonimomo</label>
                      </li>
                      <li>
                        <label class="checkbox-inline com-button"><a data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-camera"></span></a></label>
                      </li>
                    </ul>
                 </div>
              </div>
           </div>
           <input type="hidden" class="cpostPhotoUrl" name="postPhotoUrl" value="">
          </form>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade dark" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Dodaj zdjęcie</h4>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label>Link obrazka:</label>
                    <input type="url" class="form-control" id="obrazek" required>
                  </div>
                  <button type="button" class="btn btn-default test-img-url">Dodaj obrazek</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <!-- report Modal -->
        <div id="reportModal" class="modal fade dark" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Reportuj</h4>
              </div>
              <div class="modal-body">
                  <div class="radio">
                    <label><input type="radio" name="optradio" id="obrUczuc" checked>Obraza uczuć relijnych</label>
                  </div>
                  <div class="radio">
                    <label><input type="radio" name="optradio" id="inne">Inne</label>
                  </div>
                  <div class="form-group">
                    <br>
                    <label for="comment">W przypadku inne proszę o dokładne opisanie naruszenia:</label>
                    <textarea class="form-control" rows="5" id="addicInfo"></textarea>
                  </div>
                  <button class="btn btn-default" onclick="reportAjax(this);" data-dismiss="modal"><span class="glyphicon glyphicon-send"></span> Wyślij</button>
                  <input type="hidden" id="hiddenPostID" name="postID" value="">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default close-modal" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
          <?php
            if(!isset($_GET['sort']) || ($_GET['sort']!='hot' && $_GET['sort']!='all'))
            {
              confirm("nie właściwa metoda sortowania");
              exit();
            }
            if(!isset($_GET['page']))
            {
              $_GET['page']=1;
            }
            include_once('/privateNode/showPosts.php')
          ?>
      </div>
    <script>
    function isUrlValid(url) {
    return  /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
  }
      $(document).ready(function(){
        $(".postarea").click(function(){
          $(".myButtons").show(400);
        });
        $(".deletePhoto").click(function(){
          console.log($(this));
          $(".showImageUnderText").hide(200);
          $(".cpostPhotoUrl").val("");
        });
        $(".anuluj").click(function() {
          $(".postarea").val("");
          $(".cpostPhotoUrl").val("");
          $(".showImageUnderText").hide(200);
          $(".myButtons").hide(400);
        });
        $(".close-modal").click(function() {
          $("#obrazek").val("");
        });
        $(".test-img-url").click(function() {

          if(isUrlValid($("#obrazek").val()))
          {
            $.ajax({
              type: "POST",
              url: "scripts/test_url.php",
              data:{imgUrl:$("#obrazek").val()},
              success: function(html)
              {
                if(html=='isImage')
                {
                  $(".cpostPhotoUrl").val($("#obrazek").val());
                  $(".img-url").text($("#obrazek").val());
                  $(".obrazekImg").attr("src",$("#obrazek").val());
                  $(".showImageUnderText").show(200);
                  $("#myModal").modal("hide");
                  $("#obrazek").val("");
                }else {
                  confirm("To nie jest obrazek");
                }
              }
            });
          }else {
            confirm("To nie jest url");
          }

          // hide modal
        });
      });

    </script>
</body>
</html>
