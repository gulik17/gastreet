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
        var bt = $(vars.form).find('.memory-submit');
        $.ajax({
            type: 'POST',
            url: "/ajax?job=add_memory",
            cache: false,
            dataType: 'json',
            data: vars.data,
            beforeSend: function () {
                //$(bt).prop("disabled", true);
                $(bt).addClass('loading');
            },
            success: function (answer) {
                //$(bt).prop("disabled", false);
                $(bt).removeClass('loading');
                console.log(answer);
                if (isset(answer.error) && answer.error === 0) {
                    $.alert(answer.msg, {title: false, type: 'success'});
                    //yaCounter29115105.reachGoal('LP_MSG');
                    $(vars.form).trigger('reset');
                } else if (isset(answer.error) && answer.error === 1) {
                    $.alert(answer.msg, {title: false, type: 'danger'});
                }
            }
        });
    };

    /**
     * Обработчик кнопки форм.
     * Кнопка должна быть внутри тегов <form> c классом .memory-submit
     * будет отправлено любое кол-во полей, кроме файлов
     */
    $(document).on('click', '.memory-submit', function () {
        var form = $(this).closest('form'), obj = {};
        obj.form = form;
        obj.data = $(form).serialize();
        feedback(obj);
        return false;
    });
}(jQuery);
