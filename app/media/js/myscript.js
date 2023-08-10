//function Modalprogress () {
//    var Modalprogress = $('#Modalprogress');
//
//    showModalprogress = function() {
//        Modalprogress.modal('show');
//    };
//
//    hideModalprogress = function () {
//        Modalprogress.modal('hide');
//    };
//
//    if (Modalprogress.onshow){
//        hideModalprogress();
//    }
//    else
//    {
//        showModalprogress();
//    }
//}


//$('#modal-btn').on('click', function() {
//    $('#passmodal').modal('show')
//        .find('#modal-content')
//        .load($(this).attr('data-target'));
//});

jQuery(document).on('ready', function() {
    (function ($) {

        $('#modalpay').on('click', function() {
            alert("1");
        });


        $('#modal-btn').on('click', function() {
            $('#passmodal').modal('show')
                .find('.modal-content')
                .load($(this).attr('href'));
        });



    })(jQuery);

});

(function ($) {
    $('#btn-delimp').on('click', function() {

        var keys = $('#gridfile').yiiGridView('getSelectedRows');
        if (keys.length != 0){
            var hi= confirm("Ви впевненні що хочете видалити ці файли?");
            if (hi== true){
                $.ajax({
                    url: "/poslug/default/delfile",
                    type: 'post',
                    data: {keys},
                    success: function(s) {
                        //				alert(s);
                    }

                });

            }
        }
    });
})(jQuery);

// (function ($) {
//     $('#addpokazn').on('click', function() {
//
//         alert('lkjhzlkjhslf');
//     });
// })(jQuery);

(function ($) {
    $('#btn-imp').on('click', function() {

        var keys = $('#gridfile').yiiGridView('getSelectedRows');

        $.ajax({
            url: "/poslug/default/impfile",
            type: 'post',
            data: {keys},
            success: function () {
                $(function () {
                    $('#Modalprogress7').show();
                    $('#Modalprogress7').modal({backdrop: false});
                    percent = 0;
                    formclose = 0;
                    $.ajax({
                        url: "importprogress",
                        success: function (data, succ, hhh) {
                            //$('.results').html(data);
                            str = data;
                            if (str.indexOf("Error!!!") < 0) {
                                refreshProgress(percent = 1, formclose);
                            }
                            else
                                closeImport(str);
                        }
                    });

                });

                function refreshProgress(percent, formclose) {
                    $.ajax({
                        url: "importdbf",
                        success: function (data, succ, hhh) {
                            $('.results').html(percent);
                            str = data;
                            if (str.indexOf("Error!!!") >= 0)
                                formclose = closeImport(str);
                            if (str.indexOf("End import!!!") >= 0)
                                formclose = 1;
                            percent = percent + 1;
                            $("#upprogress").html('<div class="progress-bar-success progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="1000" style="width:' + percent + '%"><span class="sr-only">' + percent + '% Complete</span></div>');
                            //$("#message").html(data.message);
                            $("#mess").html("<p>" + percent + "</p>");
                            // If the process is completed, we should stop the checking process.

                            if ($('#Modalprogress7').is(':visible')) {
                                if (formclose == 1) {
                                    $("#mess").html("<p>" + percent + "</p>");


                                    $("#Modalprogress7").modal('hide');


                                    alert("Импорт завершен");
                                    window.location.href = url

                                }
                                else {
                                    refreshProgress(percent, formclose);
                                }

                            }
                            else {
                                alert("Импорт прерван");
                                window.clearInterval(timer);
                            }


                        }
                    });
                }

                function completed() {
                    $("#message").html("Completed");
                    window.clearInterval(timer);
                }

                function closeImport(str) {

                    $("#Modalprogress7").modal('hide');

                    alert("Импорт прерван ");
                    window.clearInterval(timer);
                    return 1;


                }


            }
        });
    });
})(jQuery);




//function showModalprogress () {
//    var Modalprogress = $('#Modalprogress');
//
//        //Modalprogress.modal('show');
//         Modalprogress.modal();
//
//}

//function CloseModalprogress () {
//    var Modalprogress = $('#Modalprogress');
//
//
//        //Modalprogress.modal('hide');
//        //Modalprogress.modal('close');
//    //Modalprogress.modal('backdrop','false');
//    Modalprogress.modal('hide');
//
//}

//jQuery(document).on('ready', function() {
//
//    //$("#Modalprogress").on('hide.bs.modal', function(){
//    //    alert("Модальное окно было успешно закрыто.");
//    //});
//    (function ($) {
//
//
//        ValidateForm();
//
//
//    })(jQuery);
//
//
//
//});

//function Import () {
//
//    $(function ($){
//        //var win = $('#Modalprogress7');
//        //var url = "'.Url::toRoute('default/upload').'";
//        //$('#Modalprogress7').modal({backdrop: false});
//        //$.ajax({url: "importprogress"});
//        $('.Modalprogress7').show();
//        $('.Modalprogress7').modal({backdrop: false});
//        percent = 0;
//        formclose = 0;
//        $.ajax({
//            url: "importprogress",
//            success:function(data,succ,hhh){
//                //$('.results').html(data);
//                str = data;
//                if (str.indexOf("Error!!!")<0)
//                {
//                    refreshProgress(percent=1,formclose);
//                }
//                else
//                    closeImport(str);
//            }
//        });
//
//
//        //timer = window.setInterval(refreshProgress, 1000);
//        //refreshProgress(percent);
//    });







    //$("#upprogress").append("I");






//$(document).ready(function() {
//    setInterval(function(){
//        $('#Modalprogress').modal();
//    }, 3000);
//});

//
//$(document).on('beforeValidate', 'form', function (event, messages, deferreds) {
//    console.log('beforeValidate');
//    $(this).find('[type=submit]').attr('disabled','disabled');
//}).on('afterValidate', 'form', function (event, messages, errorAttributes) {
//    console.log('afterValidate');
//
//    if (!errorAttributes.length) {
//        //alert('Check form errors!');
//        $(this).find('[type=submit]').removeAttr('disabled');
//    //}
//    //else
//    //{
//        showModalprogress();
//    }
//}).on('beforeSubmit', 'form', function (event) {
//    console.log('beforeSubmit');
//    $(this).find('[type=submit]').attr('disabled','disabled');
//});

//
//$(document).on('afterValidate', 'form', function (event, messages, errorAttributes) {
//    if (!errorAttributes.length) {
//        showModalprogress();
//    }
//});