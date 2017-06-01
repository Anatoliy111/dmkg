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


//jQuery(document).on('ready', function() {
//    (function ($) {
//
//        Modalprogress();
//
//
//    })(jQuery);
//
//});

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

function ValidateForm () {


}

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