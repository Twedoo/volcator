$(document).on('click', '.installmodules', function (e) {//best method to be called the condition down multipal gain
    var LaravelUrl = $(this).attr('link');//get value id from div//class

    function boxconfirm() {
        $("body").css("overflow", "hidden");
        var backbox = $("<div class='boxarrie'/> ");
        var contbox = $("<div class='boxcont'/>");
        var heigthpage = $(document).height();//get the size height of page
        backbox.css("height", heigthpage);//change size height of this class 'backbox' to page height

        $(".clearfix").append(backbox);
        $(".clearfix").append(contbox);


        $.ajax({
            url: LaravelUrl,
            dataType: "json",
            type: "get",
            beforeSend: function () {
                var loading = $("<div class='loadingajax'><i class='fa fa-spinner colod fa-pulse fa-3x fa-fw'></i><div class='lodtxt'>Loading...</div></div>");
                $(".boxarrie").show();
                $(".boxcont").show();
                $(".boxcont").prepend(loading);

            }
            , success: function (data) {
                var boxdialog = data;

                $(".boxcont").html(boxdialog);

                $(".closea").click(function (e) {
                    canceldet();
                });

            }

        });

    }

    boxconfirm();

    function canceldet() {
        $("body").css("overflow", "auto");
        $(".boxarrie").remove();
        $(".boxcont").remove();
    }

});


$(document).on('click', '.installnow', function (e) {
    e.preventDefault();
    var LaravelUrlup = $(this).attr('link');

    function boxconfirm() {
        $("body").css("overflow", "hidden");
        var backbox = $("<div class='boxarrie'/> ");
        var contbox = $("<div class='boxcont'/>");
        var heigthpage = $(document).height();//get the size height of page
        backbox.css("height", heigthpage);//change size height of this class 'backbox' to page height

        $(".clearfix").append(backbox);
        $(".clearfix").append(contbox);
        $(".boxarrie").show();
        $(".boxcont").show();

        $.ajax({
            url: LaravelUrlup,
            type: "get",
            dataType: "json",
            beforeSend: function () {
                var loading = $("<div class='loadingajax'><i class='fa fa-spinner colod fa-pulse fa-3x fa-fw'></i><div class='lodtxt'>Loading...</div></div>");

                $(".boxcont").html(loading);

            }, success: function (data, MsgText, MsgTitle) {
                //console.log( (data[1], data[2], ["positionClass" => "toast-top-left"]));
                //  $('.toastrmsg').html(data[1]);

                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "positionClass": data[3],
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                if (data[0] === 0) {
                    toastr.success(data[1], data[2]);
                    $(".panel-body").html(data[4]);
                }

                if (data[0] === 1) {
                    toastr.error(data[1], data[2]);
                }


                $(".boxcont").html(data);

                function canceldet() {
                    $("body").css("overflow", "auto");
                    $(".boxarrie").remove();
                    $(".boxcont").remove();
                }

                canceldet();
            }

        });
    }

    boxconfirm();

    function canceldet() {
        $("body").css("overflow", "auto");
        $(".boxarrie").remove();
        $(".boxcont").remove();
    }

});


$(document).on('change', '.check_maint', function (e) {//best method to be called the condition down multipal gain
    var maintenance = $('.check_maint').is(':checked');
    if (maintenance == false) {
        $('.maintenance').hide();
    } else {
        $('.maintenance').show();
    }

});

$(document).ready(function () {
    var maintenance = $('.check_maint').is(':checked');
    if (maintenance == false) {
        $('.maintenance').hide();
    } else {
        $('.maintenance').show();
    }

});

$(document).on('click', '#switch-language li a', function (e) {//best method to be called the condition down multipal gain
    e.preventDefault();
    $(this).tab('show');

});
//$('#mySelect').on('change', function(e) {
$(document).on('change', '#stone-cl', function (e) {//best method to be called the condition down multipal gain
alert(okkkkk)
    var maintenance = $('.check_maint').is(':checked');
    if (maintenance == false) {
        $('.maintenance').hide();
    } else {
        $('.maintenance').show();
    }
    $('#switch-language li a').eq($(this).val()).tab('show');
});


