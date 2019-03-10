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
;
/* Modal Pass
 ========================================================*/
(function ($) {
    $('#modal-btn').on('click', function() {
        $('#passmodal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    });
})(jQuery);
;

