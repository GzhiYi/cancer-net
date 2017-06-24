/**
 * Created by GzhiYi on 2017/6/1.
 */
$(function() {
    $('#forget_pwd').click(function() {
        $('#resForm').load("help/login/forget_pwd.html #forget_pwd");
        $('#form-outer *').attr("disabled",true);
        $("#login_title").html("找回密码");
        $("#a_reg").css("pointer-events","none");
    });
    //找回密码输入邮箱处的validate验证
    $('#form_forget_pwd').validate({
        rules: {
            forget_pwd_email: {
                required: true,
                email: true
            }
        }
    })
});
$(function() {//这个模态框隐藏后触发，关闭resForm内容，起到重置的作用
    $('.modal').on('hidden.bs.modal', function(e)
    {
        $("#resForm").html("");
        $('#form-outer *').attr("disabled",false);
        $("#login h4").html("用户登录");
    }) ;
})