var index_load;
// è¡¨å•æäº¤
var $form = $('#login-form');
$form.submit(function () {
    var $btn_submit = $('#login-submit');
    //$btn_submit.attr("disabled", true);
    index_load = layer.load(3);
    $form.ajaxSubmit({
        type: "post",
        dataType: "json",
        url: $btn_submit.attr('action'),
        success: function (result) {
            $btn_submit.attr('disabled', false);
            layer.close(index_load)
            result = JSON.parse(result)
            if (result.code === 1) {
                if(result.url != ''){
                    layer.msg(result.msg, {time: 2500, anim: 2}, function () {
                        window.location = result.url;
                    });
                }else{
                    layer.msg(result.msg, {time: 2500, anim: 2}, function () {
                        location.reload()
                    });
                }
                
                return false;
            }
            layer.msg(result.msg, {time: 2500, anim: 6});
        }
    });
    return false;
});