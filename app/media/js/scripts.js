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

(function ($) {
    $("#btn-addpokazn1").on("click", function() {
        alert("lkjhzlktyutyutryutyujhslf");
    });
})(jQuery);

// (function ($) {
// $('#btn-addpokaz').on('click', function() {
//     $('#modaladdpokaz').modal('show')
//         .find('#modal-content')
//         .load($(this).attr('data-target'));
// });
// })(jQuery);


/* delete file import
 ========================================================*/


/* import file
 ========================================================*/

(function ($) {
    $('#btn-imp').on("click", function() {
        $('#passmodal').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    });
})(jQuery);


/* not Enter for input form
 ========================================================*/


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
(function () {

    //при открытии модального окна
    $('#modalpay').on('shown.bs.modal', function () {
        var sum = 0;
        // will only come inside after the modal is shown
        $("form#pay-form :input").each(function () {
            if (this.id != "" && this.id != "utpay-summ" && this.id != "utpay-id_abonent" && this.id != "utpay-id_kart" && this.id != "utpay-tippay")
                sum += Number($(this).val());
        });

        document.getElementById('paysumm').innerHTML = sum.toFixed(2);
        document.getElementById('utpay-summ').value = sum.toFixed(2);
    });

    //при клик или кнопка в форме модального окна
    $(document).
    on('keypress click', '#pay-form', function() {
        var sum = 0;

        $("form#pay-form :input").each(function () {
            if (this.id != "" && this.id != "utpay-summ" && this.id != "utpay-id_abonent" && this.id != "utpay-id_kart" && this.id != "utpay-tippay")
                sum += Number($(this).val());
        });

        //alert(sum.toFixed(2));

        //нажатие кнопки в поле ввода - если ентер ничего не делать
        $('input').keypress(function (event) {
            if (event.which == '13') {
                event.preventDefault();
            }});

        document.getElementById('paysumm').innerHTML = sum.toFixed(2);
        document.getElementById('utpay-summ').value = sum.toFixed(2);
    })
    // .on('submit', function (e) {
    //
    //    $.ajax({
    //        url: "/ut-kart/pay",
    //        type: 'post',
    //        data: {},
    //        success: function(s) {
    //
    //        }
    //
    //    });
    //
    //
    //
    //    //alert('nosubmit');
    //    //e.preventDefault();
    //
    //})
    //после субмита
        .on('beforeSubmit','#pay-form', function(){
            //загружает модели формы и передает пост
            if (document.getElementById('utpay-summ').value <= 0){
                alert('Введіть корректну суму платежу!!!');
                return false;
            }
            var data = $(this).serialize();

            $.ajax({
                url: '/ut-kart/pay',
                type: 'POST',
                data: data,
                success: function(res){
                    //console.log(res);
                $('#modal-content').html(res);
                $('#modal-header ').html('<h2>zvzvxzcvzxcbvzxc</h2>');
                },
                error: function(){
                    alert('Error!');
                }
            });
            return false;
        });








})(jQuery);







