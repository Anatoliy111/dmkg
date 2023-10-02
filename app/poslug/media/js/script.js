
(function ($) {
    $(window).on('load', function () {
        // $('body').addClass('loaded_hiding');
        window.setTimeout(function () {
            $('body').addClass('loaded');
            // $('body').removeClass('loaded_hiding'); -------
        }, 500);
    });
})(jQuery);

(function ($) {
$(document).on('pjax:send', function() {
    // alert('1');
    $('body').removeClass('loaded');
    // $('body').addClass('loaded_hiding'); -----

});
})(jQuery);

(function ($) {
$(document).on('pjax:complete', function() {
    // alert('2');
    $('body').addClass('loaded');
    // $('body').removeClass('loaded_hiding');  ------
});
})(jQuery);