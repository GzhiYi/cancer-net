/**
 * Created by GzhiYi on 2017/6/1.
 */
$(function() {
    $(".help_about").click(function() {
        alert("前端设计：龚志毅1405553135======后台管理：郭玉明1405553136")
    });
    $(".help_contact").click(function() {
        alert("联系我就好了===qq:745285458  ^ _ ^");
    });
    $("a").css("text-decoration","none");//为所有a标题添加去掉下划线
});
$(function(){
    $("#search-input").focus(function(){
        if(!$(this).is(":animated")){
            $(this).animate({"width":"300px"}, 750,function(){
                $(this).attr("placeholder","搜索您需要的信息");
            });
        }
    }).blur(function(){
        if(!$(this).is(":animated")){
            if($(this).val()===""){//输入内容为空，则搜索框不会变短
                $(this).animate({"width":"80px"}, 750,function(){
                $(this).attr("placeholder","搜索...")
            });
            }
        }
    });
    $("#search-btn").click(function(){
        var $serachIpt = $("#search-input");
        if($serachIpt.val() !== ""){
            $(".body-content").remove();
            $serachIpt.parent().removeClass("has-error");
            $serachIpt.parent().addClass("has-success");
        }else{
            $serachIpt.parent().addClass("has-error");
            return false;
        }
    });
});

$(function(){/*help_each.php 处理发帖逻辑*/  
        $("#form_posts").ajaxForm(function(){//延迟1.5秒关闭模态框
            $("#send_post_btn").popover();//发布按钮提示成功后泡泡提醒

            if($("#posts_title").val()!=="" && $("#posts_content").val()!==""){
                setTimeout(function(){
                    $("#send_modal").modal('hide');
                },1000);
            }
        });

        $(".modal").on("hidden.bs.modal", function(){//模态框关闭后执行
            $("#send_modal .modal-title").html("发布新帖子");
            $("#posts_title").val("");
            $("#posts_content").val("");
        });

        
        $("#refresh").click(function(){//按刷新按钮然后将最新的帖子append到已有的ul中
            $.get("help_each/forum/posts.php #posts_content",function(data,textStatus){
                $("#post_ul").html("").prepend(data);
                /*加入.html("")为了将原来的删掉不至于出现bug*/
            });

        });
        $("#send_post_btn").click(function(){
            if($("#posts_content").val() =="" || $("#posts_title").val() ==""){
                alert("请输入帖子标题和正文!!");
            }
            else{
                $("#send_post_btn").attr("type","submit");
            }
        });
});
