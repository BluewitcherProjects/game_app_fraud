var popupSize = {
    width: 780,
    height: 550
};

$(document).on('click', '.social-button', function (e) {
    var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
        horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

    var popup = window.open($(this).prop('href'), 'social',
        'width=' + popupSize.width + ',height=' + popupSize.height +
        ',left=' + verticalPos + ',top=' + horisontalPos +
        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');


    if (popup) {
        popup.focus();
        e.preventDefault();
        //console.log(e);


        /*popup.onload = function() {
            //$(newWindow.document.body).addClass('new-window-body-class');
            console.log("Hi");
        };*/

        //console.log();

        //console.log(popup.onload);

        let id = $(this).prop('id');
        setTimeout(function () {


            $.ajax({
                url: './submit-task',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                error: function (er) {
                    console.log(er);
                    notify("error", "Unable to share post");
                },
                success: function (f) {
                    let ok = f.ok;
                    if(ok == true){
                        notify("success", f.msg);
                    }else{
                        notify("error", f.msg);
                    }
                    //console.log(f);
                }
            })
        }, 10000)
    }






});