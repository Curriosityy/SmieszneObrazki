function voteUpPost(element)
{
  var postId=$(element).parent().children('input').val()
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
  var postId=$(element).parent().children('input').val()
}
function likePost(element)
{
  var postId=$(element).parent().children('input').val()
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
  var postId=$(element).parent().children('input').val()
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
