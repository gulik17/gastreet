!function () {
    "use strict";

    window.isset = function (v) {
        if (typeof (v) === 'object' && v === 'undefined') {
            return false;
        } else if (arguments.length === 0) {
            return false;
        } else {
            var buff = arguments[0];
            for (var i = 0; i < arguments.length; i++) {
                if (typeof (buff) === 'undefined' || buff === null)
                    return false;
                buff = buff[arguments[i + 1]];
            }
        }
        return true;
    };

    $(document).ready(function () {
        (function () {
            var fb = $('.ajax-submit');
            if (fb.length > 0) {
                fb.each(function () {
                    var form = $(this).closest('form'), name = form.attr('name');
                });
            }
        })();
    });

    /**
     * Отправка форм.
     */
    function feedback(vars) {
        var bt = $(vars.form).find('.ajax-submit');
        $.ajax({
            type: 'POST',
            url: "/send.php",
            cache: false,
            dataType: 'json',
            data: vars.data,
            beforeSend: function () {
                $(bt).prop("disabled", true);
                $(bt).addClass('loading');
            },
            success: function (answer) {
                $(bt).prop("disabled", false);
                $(bt).removeClass('loading');
                console.log(answer);
                if (isset(answer.result) && answer.result === "success") {
                    $.alert(answer.message, {title: false, type: 'success'});
                    //yaCounter29115105.reachGoal('LP_MSG');
                    $(vars.form).trigger('reset');
                } else if (isset(answer.result) && answer.result === "error") {
                    $.alert(answer.message, {title: false, type: 'danger'});
                }
            }
        });
    };

    /**
     * Обработчик кнопки форм.
     * Кнопка должна быть внутри тегов <form> c классом .ajax-submit
     * будет отправлено любое кол-во полей, кроме файлов
     */
    $(document).on('click', '.ajax-submit', function () {
        var form = $(this).closest('form'), obj = {};
        obj.form = form;
        obj.data = $(form).serialize();
        //feedback(obj);
        return false;
    });

    $('.show-form').on('click', function () {
        //$('.row-text').hide();
        //$('.row-form').show();
        alert('Приём заявок окончен!');
        return false;
    });

    $('.close-form').on('click', function () {
        $('.row-form').hide();
        $('.row-text').show();
        return false;
    });

    $('input[type=file]').on('change', function () {
        var files = this.files;
        for(var a=0;a<files.length;a++) {
            $(this).prev().addClass('active').html(files[a].name);
        }
    });
    $(document).ready(function(){
        $("input[name=phone]").inputmask({mask: '+7 (999) 999-99-99'});
        $("input[name=email]").inputmask("email");
    });
    
    
    $('.corner-carousel').owlCarousel({
        loop:true,
        margin:5,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
        }
    });
}(jQuery);
