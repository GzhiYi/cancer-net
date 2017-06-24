$(function(){
    $("#form_posts").validate({
        rules: {
            posts_title: {
                required: true,
                minlength: 3,
                maxlenght: 30
            },
            posts_content: {
                required: true
            }
        },
        messages: {
            posts_title: {
                required: "帖子标题还是要的...",
                minlength: "标题字数太少啦，不可以少于3个字符",
                maxlenght: "字数超出限定范围的30个字符"
            },
            posts_content: {
                required: "你帖子怎么没写内容啊!"
            }

        }
    });
});