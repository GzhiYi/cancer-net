/**
 * Created by GzhiYi on 2017/5/27.
 */
 //login handler
$(function(){
    $('#form_login').validate({
        rules:{
            username: {
                required: true,
                minlength: 2,
                maxlength: 10
            },
            pwd: {
                required: true,
                minlength: 8,
                maxlength: 16
            }
        },
        messages: {
            username: {
                required: "在本站注册的用户名或邮箱",
                minlength: "要大于两个字符",
                maxlength: "超过字符范围啦"    
            },
            pwd: {
                required: "请输入密码进行登录",
                minlength: "密码长度应该大于 8 位",
                maxlength: "密码长度应该小于 16 位"
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
    })
});
//rigister handler
$(function(){
    $('#form_reg').validate({
        rules: {
            reg_name: {
                required: true,
                minlength: 2,
                maxlength: 10
            },
            reg_pwd: {
                required: true,
                minlength: 8,
                maxlength: 16
            },
            reg_repwd: {
                required: true,
                equalTo: '#password'
            },
            reg_email: {
                required: true,
                email: true
            }
        },
        messages: {
            reg_name: {
                required: "填上你喜欢的用户名，长度为2到10个字符",
                minlength: "要大于两个字符",
                maxlength: "超过字符范围啦!"
            },
            reg_pwd: {
                required: "密码为注册必填项",
                minlength: "密码长度应该大于 8 位",
                maxlength: "密码长度应该小于 16 位"
            },
            reg_email: {
                required: "邮箱可以用作密码找回"
            },
            reg_repwd: {
                equalTo: "两次密码不一致啊！"
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