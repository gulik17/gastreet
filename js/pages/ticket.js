function inArray(needle, haystack) {
    var length = haystack.length;
    for (var i = 0; i < length; i++) {
        if (typeof haystack[i] == 'object') {
            if (arrayCompare(haystack[i], needle))
                return true;
        } else {
            if (haystack[i] == needle)
                return true;
        }
    }
    return false;
}

/* удаление всех "&" из строки */
function delAmp(s) {
    if (typeof (s) === "string") {
        s = s.trim();
        if (s) {
            s = s.replace(/&/g, "");
        }
    }
    return s;
}

window.isset = function (v) {
    if (typeof (v) == 'object' && v == 'undefined') {
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
}

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
            j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}

function checkInput(form) {
    $(form).find('input[required]').each(function () {
        if ($(this).val() != '') {
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
    var bt = $(vars.form).find('.ajax-submit');
    var bvc = bt.text();
    $.ajax({
        type: 'POST',
        url: "/app/landing/send.php",
        cache: false,
        dataType: 'json',
        data: vars.data,
        beforeSend: function () {
            $(bt).prop("disabled", true);
            $(bt).text('Отправка...');
        },
        success: function (answer) {
            if (isset(answer.result) && (answer.result == "success")) {
                $('.form_panel__msg').css('left', '0');
                $('.form_panel__send').css('left', '-1000px');
                $('.form_panel__msg a.btn').hide();
                $(vars.form).trigger('reset');
                $(".form_panel__inner .form_panel__msg>div").html("<h4>Заявка принята!</h4><p>Мы обязательно свяжимся Вам в&nbsp;ближайшее время!</p>");
            } else if (isset(answer.result) && (answer.result == "error")) {
                $('.form_panel__msg').css('left', '0');
                $('.form_panel__send').css('left', '-1000px');
                $('.form_panel__msg a.btn').show();
                $(".form_panel__inner .form_panel__msg>div").html("<h4>Ошибка!</h4><p>" + answer.message + "</p>");
            }
        },
        error: function () {},
        complete: function () {
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
$(document).on('click', '.ajax-submit', function () {
    var form = $(this).closest('form'), name = form.attr('name'), obj = {};
    obj.form = form;
    obj.data = $(form).serialize();
    checkInput(form);
    if ($(form).find("input.error").length === 0) {
        feedback(obj);
    }
    return false;
});

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

$('#submitForm').click(function (evt) {
    evt.preventDefault();
    var email = $('.form_panel__reg [name=email]').val(),
            lastname = $('.form_panel__reg [name=lastname]').val(),
            name = $('.form_panel__reg [name=name]').val(),
            countryName = $('.form_panel__reg [name=countryName]').val(),
            cityName = $('.form_panel__reg [name=cityName]').val(),
            company = $('.form_panel__reg [name=company]').val(),
            usertype = $('.form_panel__reg [name=usertype]').val(),
            position = $('.form_panel__reg [name=position]').val();

    // ajax запрос
    var adata = 'email=' + email
            + '&lastname=' + lastname
            + '&name=' + name
            + '&countryName=' + countryName
            + '&cityName=' + cityName
            + '&company=' + company
            + '&usertype=' + usertype
            + '&position=' + position
            + '&json=1';

    console.log(adata);

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/index.php?do=usereditprofile',
        data: adata,
        success: function (data) {
            console.log(data);
            if (data.error === 1) {
                alert(data.msg);
            } else {
                //yaCounter42663449.reachGoal('_ya_getsms');
                alert(data.msg);
                window.location.href = "/index.php?show=catalog";
            }
            return false;
        }
    });
});

$('.login a').click(function (evt) {
    evt.preventDefault();
    $('.form_panel__form').css('left', '-1000px');
    $('.form_panel__login').css('left', '0');
    $('.form_panel__reg').css('left', '-1000px');
});

$('.register a').click(function (evt) {
    evt.preventDefault();
    $('.form_panel__form').css('left', '0');
    $('.form_panel__login').css('left', '-1000px');
    $('.form_panel__reg').css('left', '-1000px');
});

$('#login_btn').click(function (evt) {
    evt.preventDefault();

    var form = $(this).closest('form');
    var phone = $(form).find('[name=phone]').val(),
            code = $(form).find('[name=code]').val();

    // ajax запрос
    var gotdata = 'phone=' + phone + '&code=' + code + '&json=1';

    console.log(gotdata);
    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/index.php?do=userlogin',
        data: gotdata,
        success: function (data) {
            console.log(data);
            if (data.error === 0) {
                if (data.msg == 'doneLogin') {
                    window.location.href = "/index.php?show=catalog";
                    //yaCounter42663449.reachGoal('_ya_getsms');
                }
            } else if (data.error === 1) {
                alert(data.msg);
            }
            return false;
        }
    });
});

$('#reg_get_phone').click(function (evt) {
    evt.preventDefault();

    var form = $(this).closest('form');
    var phone = $(form).find('[name=phone]').val(),
            youAboutUs = $(form).find('[name=youAboutUs]'),
            code = $(form).find('[name=code]').val(),
            button = '';

    if ($('#reg_get_phone').hasClass('reg_get_phone')) {
        button = 'reg_get_phone';
    } else if ($('#reg_get_phone').hasClass('reg_get_code')) {
        button = 'reg_get_code';
    }

    if (!youAboutUs.val()) {
        alert('Поле «Как Вы узнали о Gastreet» необходимо заполнить!');
        youAboutUs.focus();
        return undefined;
    }

    // ajax запрос
    var gotdata = 'job=usergetcode'
            + '&phone=' + phone
            + '&youAboutUs=' + delAmp(youAboutUs.val())
            + '&code=' + code
            + '&button=' + button;

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/index.php?show=ajax',
        data: gotdata,
        success: function (data) {
            console.log(data);
            switch (data) {
                case 'donephone':
                    $('#reg_get_phone').removeClass('reg_get_phone');
                    $('#reg_get_phone').addClass('reg_get_code');
                    $('#reg_hide_code').show();
                    $('#reg_get_phone').html('Подтвердить');
                    //yaCounter42663449.reachGoal('_ya_getsms');
                    break;
                case 'redirectToTicket':
                    window.location.href = "/index.php?show=catalog";
                    break;
                case '41':
                    alert('Номер содержит недопустимые символы!');
                    break;
                case '42':
                    alert('Номер не указан!');
                    break;
                case '43':
                    alert('Неверное количество цифр в номере!');
                    break;
                case 'nosmsphone':
                    alert('Не удалось отправить СМС с кодом, обратитесь к администратору!');
                    break;
                case 'nocode':
                    alert('Нужно ввести код подтверждения!');
                    break;
                case 'wrongcode':
                    alert('Не верный код подтверждения!');
                    break;
                case 'toooften':
                    alert('Нельзя получать новый код так часто, попробуйте позднее!');
                    break;
                case 'ischild':
                    alert('Нельзя войти в учетную запись, т.к. она принадлежит родителю. Войдите через родительский аккаунт!');
                    break;
                case 'donecode':
                    $('.form_panel__form').css('left', '-1000px');
                    $('.form_panel__reg').css('left', '0');
                    //window.location.href = "/index.php?show=catalog";
                    break;
                default:
                    alert('Неизвестная ошибка');
            }
            return false;
        }
    });
});

/***********************************************/

$(window).load(function () {
    $('[name=phone]').inputmask("phone");
    $('[name=email]').inputmask("email");
    $('body').addClass('load');
    if (!$.cookie("notice")) {
        $("#old18").show(400);
        $("#bg-root").fadeIn(400);
    }
    $("#old18 .buttons a.accept").click(function () {
        $.cookie("notice", "Y");
        $("#old18").hide(400);
        $("#bg-root").fadeOut(400);
        return false;
    });
});

$('#video-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var link = button.data('link');
    var title = button.data('title');
    var modal = $(this);
    modal.find('iframe').attr('src', 'https://www.youtube.com/embed/' + link);
    modal.find('.modal-title').text(title);
});

$('#video-modal').on('hidden.bs.modal', function (e) {
    var modal = $(this);
    modal.find('iframe').attr('src', '');
});

$("#countryName").change(function () {
    $('#cityName').attr('disabled', false);
    if ($(this).val() === "ru") {
        $('#cityName').hide();
        $('#secondCityName').show();
    } else {
        $('#secondCityName').hide();
        $('#cityName').show();
    }
});

$("#secondCityName").change(function () {
    $('#cityName').val($(this).val());
});

$("#send_countryName").change(function () {
    $('#send_cityName').attr('disabled', false);
    if ($(this).val() === "ru") {
        $('#send_cityName').hide();
        $('#send_secondCityName').show();
    } else {
        $('#send_secondCityName').hide();
        $('#send_cityName').show();
    }
});

$("#send_secondCityName").change(function () {
    $('#send_cityName').val($(this).val());
});

$('.forMember').on('click', function () {
    $('.form_panel__form').css('left', '0');
    $('.form_panel__login').css('left', '-1000px');
    $('.form_panel__reg').css('left', '-1000px');
    $('.form_panel__send').css('left', '-1000px');
    $('input[name=subject]').val('Регистрация участника - GASTREET 2018');
    $('#af__in_usertype').val('');
    $('#af__usertype').show();
    $('.form_panel, .bg').addClass('show');
    return false;
});

$('.forSmi').on('click', function () {
    $('.form_panel__form').css('left', '-1000px');
    $('.form_panel__login').css('left', '-1000px');
    $('.form_panel__reg').css('left', '-1000px');
    $('.form_panel__send').css('left', '0');
    $('input[name=subject]').val('Регистрация СМИ - GASTREET 2018');
    $('#send_usertype').val('СМИ');
    $('.form_panel, .bg').addClass('show');
    return false;
});

$('.forProvider').on('click', function () {
    $('.form_panel__form').css('left', '-1000px');
    $('.form_panel__login').css('left', '-1000px');
    $('.form_panel__reg').css('left', '-1000px');
    $('.form_panel__send').css('left', '0');
    $('input[name=subject]').val('Регистрация поставщика - GASTREET 2018');
    $('#send_usertype').val('ПОСТАВЩИК');
    $('.form_panel, .bg').addClass('show');
    return false;
});

$('.form_panel .close, .bg').on('click', function () {
    $('.form_panel, .bg').removeClass('show');
    $('.form_panel__msg').css('left', '-1000px');
    $('.form_panel__send').css('left', '0');
    $('.form_panel__msg a.btn').show();
    return false;
});

$('.back_form').on('click', function () {
    $('.form_panel__msg').css('left', '-1000px');
    $('.form_panel__send').css('left', '0');
    return false;
});

$(function () {
    if ($('body').width() < 767) {
        $('[data-toggle="tooltip"]').attr("data-placement", "top");
    }
    $('[data-toggle="tooltip"]').tooltip();
    if (message) {
        var html = '<div class="modal fade" id="messageModal" tabindex="-1" role="dialog">' +
                '<div class="modal-dialog modal-sm" role="document">' +
                message +
                '</div>' +
                '</div>';
        $('body').append(html);
        $('#messageModal').modal();
    }
});