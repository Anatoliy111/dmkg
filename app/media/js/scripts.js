$(function(){
    console.log('Hello Anatoliy!');
});
/* Stick up menus
 ========================================================*/
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {
        include('js/tmstickup.js');

        $(document).ready(function () {
            $('#stuck_container').TMStickUp({})
        });
    }
})(jQuery);

/* ToTop
 ========================================================*/
;
(function ($) {
    var o = $('html');
    if (o.hasClass('desktop')) {
        include('js/jquery.ui.totop.js');

        $(document).ready(function () {
            $().UItoTop({
                easingType: 'easeOutQuart',
                containerClass: 'toTop fa fa-angle-up'
            });
        });
    }
})(jQuery);

/* Modal Pass
 ========================================================*/
(function ($) {
    $('#modal-btn').on('click', function() {
        $('#passmodal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    });
})(jQuery);


/* not Enter for input form
 ========================================================*/
(function ($) {
    $("pay-form").on("submit", function(){
        return false;
    })
})(jQuery);

jQuery(function($){
    $("#pay-form").on("submit", function (event) {
        alert("1");
        event.preventDefault();
        var $this = $(this);
        var frmValues = $this.serialize();
        $.ajax({
                type: $this.attr('method'),
                url: $this.attr('action'),
                data: frmValues
            })
            .done(function () {
                $("#para").text("Done!" + frmValues);
            })
            .fail(function () {
                $("#para").text("An error occured!");
            });
    });
});


(function ($) {
    $(document).on('click', '#modalpay', function (e) {
            e.modalWindow = true;
        })
        .on('click', function (e) {
            if (!e.modalWindow) {
                console.log('Это — не моя клетка!');
            }
        });
})(jQuery);




/* Modal Pay
 ========================================================*/
//(function ($) {
//    $('#btn-mod-pay').on('click', function() {
//        var textBlock = $(this).prev('.block').text();
//        alert(textBlock);
//        //$('#modalpay').find('#modal-content')
//        //    .load($(this).attr('action'));
//    });
//})(jQuery);
//;
jQuery(document).on('click', '#pay-form', function() {
    var rows = document.getElementsByTagName("input");
//     var innp =rows.getElementsById("utobor-234838-sendopl");
    var totalSum = 0;
    //$( "#pay-form" )
    ////    .submit(function( event ) {
    ////    event.preventDefault();
    ////})
    //.keypress(function (event) {
    //        if (event.which == '13') {
    //            event.preventDefault();
    //        }})
    //    .click(function (event) {
    //        if (event.which == '13') {
    //            event.preventDefault();
    //        }});

    $('input').keypress(function (event) {
        if (event.which == '13') {
            event.preventDefault();
        }});










    //$(document).on('submit', function (e) {
    //
    //
    //    alert('nosubmit');
    //    e.preventDefault();
    //
    //})
});



    //(function ($) {
    //
    //    $(document).on('submit', '#pay-form', function (e) {
    //                alert('nosubmit');
    //            //alert('submit');
    //            e.preventDefault();
    //            //e.modalWindow = true;
    //        })
    //        //.on('click', function (e) {
    //        //    if (!e.modalWindow) {
    //        //        alert(321);
    //        //        console.log('Это — не моя клетка!');
    //        //    }
    //        //}
    //        //)
    //    ;
    //
    //    $("#btn-mod-pay").click(function(){
    //        // нужный блок выбирается относительно this как предыдущий (prev)
    //        var textBlock = $(this).prev('.block').text();
    //        alert(textBlock);
    //    });
    //
    //
    //    //$('.btn-mod-pay').on('click', function() {
    //    //    var textBlock = $(this).prev('.block').text();
    //    //    alert(textBlock);
    //    //    //$('#modalpay').modal('show').find('.modal-content')
    //    //    //    .load($(this).attr('href'));
    //    //});
    //
    //
    //
    //})(jQuery);



//$(document).ready(function(){
//    $(".btn-mod-pay").click(function(){
//        // нужный блок выбирается относительно this как предыдущий (prev)
//        var textBlock = $(this).prev('.block').text();
//        alert(textBlock);
//    });
//
//});/*end  ready*/

