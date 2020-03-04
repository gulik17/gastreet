$().ready(function () {

    /* удаление всех "&" из строки */
    function delAmp(s) {
        if (typeof(s) === "string") {
            s = s.trim();
            if (s) {
                s = s.replace(/&/g, "");
            }
        }
        return s;
    }

    $('#reg_get_phone').click(function (evt) {
        evt.preventDefault();
        var phone = $('#reg_phone').val();
        var youAboutUs = $('#reg_you_about_us');
        var code = $('#reg_code').val();
        var thisBtn = $(this);
        var thisBtnText = $(this).html();
        var reg_phone = $('#reg_phone');
        var button = $('#reg_get_phone').attr('class');

        if (!youAboutUs.val()) {
            alert('Поле "Как Вы узнали о Gastreet" необходимо заполнить!');
            youAboutUs.focus();
            return undefined;
        }

        button = button.split(' btn btn-white').join('');
        button = button.split('btn btn-white ').join('');

        thisBtn.prop("disabled", true);
        thisBtn.html("Отправка кода...");
        reg_phone.prop("disabled", true);

        // ajax запрос
        var gotdata = 'job=usergetcode'
            + '&phone=' + phone
            + '&youAboutUs=' + delAmp(youAboutUs.val())
            + '&code=' + code
            + '&button=' + button;
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                thisBtn.prop("disabled", false);
                reg_phone.prop("disabled", false);
                thisBtn.html(thisBtnText);
                if (data.error) {
                    $.alert(data.error, {title: false, type: 'danger'});
                    return false;
                } else {
                    if (data == 'donephone') {
                        $('#reg_get_phone').removeClass('reg_get_phone');
                        $('#reg_get_phone').addClass('reg_get_code');
                        $('#reg_hide_code').show();
                        $('#reg_get_phone').html('Подтвердить');
                        //yaCounter28771811.reachGoal('_ya_getsms');
                    }
                    else if (data == 'donephone_new') {
                        $('#reg_get_phone').removeClass('reg_get_phone');
                        $('#reg_get_phone').addClass('reg_get_code');
                        $('#reg_hide_code').show();
                        $('#reg_get_phone').html('Подтвердить');
                        yaCounter28771811.reachGoal('_ya_newuser');
                    }
                    else if (data == '90') {
                        $.alert('Некорректный номер телефона', {title: false, type: 'danger'});
                        return false;
                    }
                    // если в номере телефона присутствует ошибка
                    else if (data == '41') {
                        $.alert('Номер содержит недопустимые символы!', {title: false, type: 'danger'});
                        return false;
                    }
                    else if (data == '42') {
                        $.alert('Номер не указан!', {title: false, type: 'danger'});
                        return false;
                    }
                    else if (data == '43') {
                        $.alert('Неверное количество цифр в номере!', {title: false, type: 'danger'});
                        return false;
                    }
                    else if (data == 'nosmsphone') {
                        $.alert('Не удалось отправить СМС с кодом, обратитесь к администратору!', {title: false, type: 'danger'});
                    }
                    else if (data == 'nocode') {
                        $.alert('Нужно ввести код подтверждения!', {title: false, type: 'danger'});
                    }
                    else if (data == 'wrongcode') {
                        $.alert('Не верный код подтверждения!', {title: false, type: 'danger'});
                    }
                    else if (data == 'toooften') {
                        $.alert('Нельзя получать новый код так часто, попробуйте позднее!', {title: false, type: 'danger'});
                    }
                    else if (data == 'ischild') {
                        $.alert('Нельзя войти в учетную запись, т.к. она принадлежит родителю. Войдите через основной аккаунт!', {title: false, type: 'danger'});
                    }
                    else if (data == 'donecode') {
                        //yaCounter28771811.reachGoal('_ya_newuser');
                        window.location.href = "/register";
                    }
                    else if (data == 'redirectToRegister') {
                        //yaCounter28771811.reachGoal('_ya_newuser');
                        window.location.href = "/register";
                    }
                    else if (data == 'redirectToBasket') {
                        //yaCounter28771811.reachGoal('_ya_newuser');
                        window.location.href = "/basket";
                    }
                    return false;
                }
            }
        });
    });
});