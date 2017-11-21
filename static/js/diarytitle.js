var page=1;

function writeToday()
{
    var context=$('#summernote').summernote('code');
    $.ajax({
        url:'/diary/write',
        type:'post',
        dataType:'json',
        data:{context:context},
        success:function(result)
        {
            if(result['status']==true)
            {
                alert('오늘 하루가 등록되었습니다.');
                location.reload();
            }
            else alert('문제가 발생했습니다. '+result['message']);
        }
    });
}
function getPosts()
{
    $.ajax({
        url:'/diary/get',
        type:'get',
        dataType:'json',
        data:{page:page},
        success:function(result)
        {
            if(result['status']==true)
            {
                console.log(result);
                for(var i=0;i<result['posts'].lenght;i++)
                {
                    $('#postContainer').append("<div class=\"panel panel-default\"><div class=\"panel-body\"><p>"+result['posts'][i]['context']+"</p></div><div class=\"panel-footer\"><p>"+result['posts'][i]['name']+"</p><p class=\"writendatetime\">"+result['posts'][i]['created_at']+"</p><p class=\"likecount\">"+result['posts'][i]['like_count']+"<button type=\"button\" onclick=\"like("+result['posts'][i]['id']+")\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-heart\" aria-hidden=\"true\"></span> 공감</button></p></div></div>");
                }
                page++;
            }
            else alert('문제가 발생했습니다. '+result['message']);
        }
    });
}
function like(post_id)
{
    $.ajax({
        url:'/diary/like',
        type:'post',
        dataType:'json',
        data:{post_id:post_id},
        success:function(result)
        {
            if(result['status']==true)
            {
                alert(result['message']);
            }
            else alert('문제가 발생했습니다. '+result['message']);
        }
    });
}
function deletePost(post_id)
{
    $.ajax({
        url:'/diary/delete',
        type:'post',
        dataType:'json',
        data:{post_id:post_id},
        success:function(result)
        {
            if(result['status']==true)
            {
                alert('삭제되었습니다.');
                location.reload();
            }
            else alert('문제가 발생했습니다. '+result['message']);
        }
    });
}