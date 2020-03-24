window.isset = function (v) {
    if (typeof(v) == 'object' && v == 'undefined') {
        return false;
    } else  if (arguments.length === 0) {
        return false;
    } else {
        var buff = arguments[0];
        for (var i = 0; i < arguments.length; i++){
            if (typeof(buff) === 'undefined' || buff === null) return false;
            buff = buff[arguments[i+1]];
        }
    }
    return true;
};

function checkInput(form){
    $(form).find('input[required]').each(function(){
        if($(this).val() != ''){
            $(this).removeClass('error');
        } else {
            $(this).addClass('error');
        }
    });
}

/**
 * Отправка форм.
 */
function feedback(vars) {
    let bt = $(vars.form).find('.ajax-mess-submit');
    let bvc = bt.text();
    $.ajax({
        type: 'POST',
        url: "/ajax?job=sendKidsAction",
        cache: false,
        dataType: 'json',
        data: vars.data,
        beforeSend: function() {
            $(bt).prop("disabled", true);
            $(bt).text('Отправка...');
        },
        success: function(answer) {
            //console.log(answer);
            if( isset(answer.result) && (answer.result === "success") ) {
                alert("Сообщение отправлено! Мы обязательно ответим на Ваше сообщение в ближайшее время!");
                //yaCounter30942391.reachGoal('registr');
                $(vars.form).trigger('reset');
            } else if( isset(answer.result) && (answer.result === "error") ) {
                alert(answer.message);
            }
        },
        error: function() {},
        complete: function() {
            $(bt).prop("disabled", false);
            $(bt).text(bvc);
        }
    });
}

/**
 * Обработчик кнопки форм.
 * Кнопка должна быть внутри тегов <form> c классом .ajax-mess-submit
 * будет отправлено любое кол-во полей, кроме файлов
 */
$(document).on('click', '.ajax-mess-submit', function() {
    let form = $(this).closest('form'), name = form.attr('user_name'), obj = {};
    obj.form = form;
    obj.data = $(form).serialize();
    checkInput(form);
    if ($(form).find("input.error").length === 0) {
        feedback(obj);
    } else {
        alert('Заполните обязательные поля');
    }
    return false;
});