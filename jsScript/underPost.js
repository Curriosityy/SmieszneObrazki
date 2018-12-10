function voteUpPost(element)
{
  var postId=$(element).parent().children('input').val();
  $.ajax({
    type: "POST",
    url: "scripts/upVote.php",
    data:{'postId':postId},
    success: function(html)
    {
      $(element).children('.badge').html(html);
      changePrzyciskClassInElement(element);
    }
  });
}
function commentPost(element)
{
  var postId=$(element).parent().children('input').val();
}
function editPost(element)
{
  var postId=$(element).parent().children('input').val();
}
function deletePost(element)
{
  var postId=$(element).parent().children('input').val();
  $.ajax({
    type: "POST",
    url: "scripts/deletePost.php",
    data:{'postId':postId},
    success: function(html)
    {
      location.reload(true);
    }
  });
}
function likePost(element)
{
  var postId=$(element).parent().children('input').val();
  $.ajax({
    type: "POST",
    url: "scripts/likePost.php",
    data:{'postId':postId},
    success: function(html)
    {
      $(element).children('.badge').html(html);
      changePrzyciskClassInElement(element);
    }
  });
}
function reportPost(element)
{
  var postId=$(element).parent().children('input').val();
  $('#hiddenPostID').val(postId);
}

function changePrzyciskClassInElement(element)
{
  if($(element).hasClass("przycisk"))
  {
    $(element).removeClass("przycisk");
    $(element).addClass("przycisk2");
  }else {
    $(element).removeClass("przycisk2");
    $(element).addClass("przycisk");
  }
}

function reportAjax(element)
{
  postId=$('#hiddenPostID').val();
  reportType=0;
  if($('#obrUczuc').is(':checked'))
  {
    reportType=1;
  }else if($('#inne').is(':checked')) {
    reportType=2;
  }
  repText=$('#addicInfo').val();
  $.ajax({
    type: "POST",
    url: "scripts/reportPost.php",
    data:{'postId':postId,'repType':reportType,'addInf':repText},
    success: function(html)
    {
       console.log(html);
        confirm('Dziękuję za zgłoszenie');
    }
  });
}
