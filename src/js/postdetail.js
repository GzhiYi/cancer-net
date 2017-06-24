$(function(){
     $('#comment_btn').click(function(){
        if($('#post_comment').val() === ""){
            alert("请输入评论内容");
         }
         else{
            $('#comment_btn').attr("type","submit");
            $("#form_comment").ajaxForm(function(){//处理发布评论后刷新页面
                location.reload();//刷新本页
          });
         }
     });
     
});