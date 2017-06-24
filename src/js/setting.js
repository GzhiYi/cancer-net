$(function(){
    $("#form-basic").validate({
        rules: {
            mgusername: {
                minlength: 2,
                maxlength: 10
            },
            mgemail: {
                email: true
            }
        },
        messages: {
            mgusername: {
                minlength: "最少两个字符",
                maxlength: "最多10个字符"
            },
            mgemail: {
                email: "填写正确的邮箱地址"
            },
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    $("#modify_submit").click(function(){
        if($("#a_username").val() =="" && $("#a_email").val() ==""){
            alert("未填入任何修改的信息");
        }
        else{
            $("#modify_submit").attr("type","submit");
        }
    });
});
$(function(){
    
    $("#security_submit").click(function(){
        if($("#mgoldpwd").val() ==""){
            alert("若要修改密码，请按上面顺序填写密码！三个输入框都必须填");
        }
        else{
            $("#security_submit").attr("type","submit");
        }
    });
    $(function(){
        $("#form-security").validate({
            rules: {
                mgoldpwd: {
                    minlength: 8,
                    maxlength: 16
                },
                mgnewpwd: {
                    minlength: 8,
                    maxlength: 16
                },
                mgnewpwd_again: {
                    minlength: 8,
                    maxlength: 16,
                    equalTo: '#mgnewpwd'
                }
            },
            messages: {
                mgoldpwd: {
                    minlength: "密码最少八位!!",
                    maxlength: "密码最多16位!!"
                },
                mgnewpwd: {
                    minlength: "密码最少八位!!",
                    maxlength: "密码最多16位!!"
                },
                mgnewpwd_again: {
                    minlength: "密码最少八位!!",
                    maxlength: "密码最多16位!!",
                    equalTo: "两次密码输入不一致！！！"
                }
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
});

$(function(){
    $(".delete-posts").click(function() {
        $(this).addClass('hide')
        $(".delete-posts-cancle").removeClass('hide')
        $(".delete-posts-yes").removeClass('hide')
    });
    $(".delete-posts-cancle").click(function(){
        $(this).addClass("hide");
        $(".delete-posts").removeClass('hide');
        $(".delete-posts-yes").addClass("hide");
        $(".delete-posts-cancle").addClass("hide");
    });

    $("td").attr("height","50px");
    $("th").attr("height","50px");

});
//admin管理员页面相关js tips：ajax没有实现，放弃
/*$(function(){
    $("#admin_post_search").click(function(){
        $('#admin_form1').ajaxForm(function(){
            $("#admin_post_content").load("del_search_result.php #admin_post_query_result");
        });

    });
});*/