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
//jQuery(document).on('click', function() {
//    (function ($) {
//
//        $("#btn-mod-pay").click(function(){
//            // нужный блок выбирается относительно this как предыдущий (prev)
//            var textBlock = $(this).prev('.block').text();
//            alert(textBlock);
//        });
//
//
//        //$('.btn-mod-pay').on('click', function() {
//        //    var textBlock = $(this).prev('.block').text();
//        //    alert(textBlock);
//        //    //$('#modalpay').modal('show').find('.modal-content')
//        //    //    .load($(this).attr('href'));
//        //});
//
//
//
//    })(jQuery);
//});


//$(document).ready(function(){
//    $(".btn-mod-pay").click(function(){
//        // нужный блок выбирается относительно this как предыдущий (prev)
//        var textBlock = $(this).prev('.block').text();
//        alert(textBlock);
//    });
//
//});/*end  ready*/

