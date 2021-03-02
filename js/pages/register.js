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

    function getDiscountCodes() {
        var userCodesPairs = '';
        $('.discount-code').each(function () {
            var getUserId = $(this).attr('id').split('discount-code-').join('');
            var getCode = $('#discount-code-' + getUserId).val();
            userCodesPairs = userCodesPairs + getUserId + ":" + getCode + "|";
        });
        userCodesPairs = userCodesPairs.split('&').join('').split('=').join('');
        return userCodesPairs;
    }

    // функция для отправки AJAX запроса
    function catalogSendAjaxRequest(gotParams, eltId) {
        var btnText = $(eltId).html();
        var id      = $(eltId).data('id');
        var gotdata = gotParams + "&isAjax=1";
        var ticketName = $(eltId).parents('.ticket').find('.ticket_header span').html();
        $(eltId).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        $(eltId).addClass('disabled');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/index.php?do=add',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    $.alert(data.error);
                    $(eltId).removeClass('disabled');
                    $(eltId).html(btnText);
                    $(eltId).parents('.modal').modal('hide');
                    return false;
                } else {
                    if ( (data[0] == 'go_back_ok') || (data == 'go_basket_ok') ) {
                        // покупка ок
                        // danger, success, warning, info
                        $('.main-ticket-select').removeClass('show');
                        $('.child-ticket-select').removeClass('show');
                        $(eltId).parents('.main-ticket-select').prev().find('.main-set-ticket').data('id', data[2]).html(data[3]);
                        $(eltId).parents('.child-ticket-select').prev().find('.child-set-ticket').data('id', data[2]).html(data[3]);
                        $(eltId).parents('.main-ticket-select').prev().find('.form-control').addClass('ticket_'+id);
                        $(eltId).parents('.child-ticket-select').prev().find('.form-control').addClass('ticket_'+id);
                        $("#header-col-right li span.badge.badge-info").html(data[1]);

                        $('.modal-defiant').find('.form-control').addClass('ticket_'+id);
                        $('.modal-defiant').find('a').data('id', data[2]).html(data[3]);
                        $('.modal-defiant').removeClass('modal-defiant');

                        $(eltId).removeClass('disabled');
                        $(eltId).html(btnText);
                        $(eltId).parents('.modal').modal('hide');
                        $('.g-emoji-content-show').show();
                        //window.location.href = "/basket";
                    } else if (data == 'no_ticketorproduct') {
                        $.alert("Не выбран товар", {title: false, type: 'danger'});
                    } else if (data == 'no_productorproductstatus') {
                        $.alert("Не найден товар", {title: false, type: 'danger'});
                    } else if (data == 'no_ticketorticketstatus') {
                        $.alert("Не найден билет", {title: false, type: 'danger'});
                    } else if (data == 'no_extuser') {
                        $.alert("Не выбран пользователь", {title: false, type: 'danger'});
                    } else if (data == 'no_curuser') {
                        $.alert("Не выбран пользователь", {title: false, type: 'danger'});
                    } else if (data == 'err_rebuild') {
                        $.alert("Ошибка транзакции, обратитесь к администратору", {title: false, type: 'danger'});
                    } else if (data == 'same_product') {
                        $(eltId).remove();
                        $.alert("В корзине уже есть данный товар", {title: false, type: 'danger'});
                    } else if (data == 'need_baseticket') {
                        $.alert("Сначала нужно купить основной билет", {title: false, type: 'danger'});
                    } else if (data == 'product_is_included_to_ticket') {
                        $(eltId).remove();
                        $.alert("Выбранный товар уже входит в основной билет", {title: false, type: 'danger'});
                    } else if (data == 'same_time_used_child') {
                        $.alert("У данного участника уже есть запланированное событие на то же самое время.", {title: false, type: 'danger'});
                    } else if (data.indexOf('_basket_child_') > 1) {
                        $(eltId).remove();
                        $.alert("У Вас уже есть билет...", {title: false, type: 'danger'});
                    } else if (data.indexOf('_ticketdecision_') > 1) {
                        var gotId = eltId.split('#').join('').split('go_ticketdecision_').join('');
                        $(eltId).remove();
                        $.alert("У Вас уже есть билет...", {title: false, type: 'danger',
                            onClose: function () {
                                window.location.href = "/ticketdecision?ticket=" + gotId;
                            }
                        });
                    } else if (data.indexOf('_time_used_productdecision_') > 1) {
                        var gotId = $(eltId).data("id");
                        $(eltId).remove();
                        $.alert("У Вас уже есть запланированное событие на то же самое время", {title: false, type: 'danger',
                            onClose: function () {
                                window.location.href = "/productdecision?product=" + gotId;
                            }
                        });
                    } else if (data == 'go_userlogin') {
                        $.alert("Для выполнения данного действия необходимо авторизоваться", {title: false, type: 'danger',
                            onClose: function () {
                                window.location.href = "/userlogin";
                            }
                        });
                    } else if (data == 'go_usereditprofile') {
                        $.alert("Перед покупками заполните Ваш профиль", {title: false, type: 'danger',
                            onClose: function () {
                                window.location.href = "/usereditprofile";
                            }
                        });
                    } else {
                        $.alert("Непредвиденная ошибка, обратитесь к администратору", {title: false, type: 'danger'});
                    }
                }
            }
        });
        return false;
    }

    $(document).on('click', '.buy-ticket-click', function() {
        var id        = $(this).data('id');
        var extuser   = $(this).data('extuser');
        var gotParams = '';
        if (extuser) {
            gotParams = "ticket="+id+"&extuser="+extuser+"&mode=existuser";
        } else {
            gotParams = "ticket=" + id;
        }
        catalogSendAjaxRequest(gotParams, $(this));
        return false;
    });

    $(document).on('click', '#check1', function() {
        $('.ul-detail').slideUp();
        $('.bron-btn').slideUp();
        $('.installment-btn').slideUp();
        $('.balance-btn').slideUp();
        $('.pay-card-btn').slideDown();
    });

    $(document).on('click', '#check2', function() {
        $('.bron-btn').slideUp();
        $('.installment-btn').slideUp();
        $('.pay-card-btn').slideUp();
        $('.balance-btn').slideUp();
        $('.ul-detail').slideDown();
    });

    $(document).on('click', '#check3', function() {
        $('.ul-detail').slideUp();
        $('.pay-card-btn').slideUp();
        $('.installment-btn').slideUp();
        $('.balance-btn').slideUp();
        $('.bron-btn').slideDown();
    });

    $(document).on('click', '#check6', function() {
        $('.ul-detail').slideUp();
        $('.bron-btn').slideUp();
        $('.pay-card-btn').slideUp();
        $('.balance-btn').slideUp();
        $('.installment-btn').slideDown();
    });

    $(document).on('click', '#check7', function() {
        $('.ul-detail').slideUp();
        $('.bron-btn').slideUp();
        $('.pay-card-btn').slideUp();
        $('.installment-btn').slideUp();
        $('.balance-btn').slideDown();
    });

    $(document).on('click', '.main-set-product', function() {
        $('.main-product-select').addClass('show');
        return false;
    });
    
    $(document).on('click', '.child-set-product', function() {
        let child_item = $(this).parents('.child-item');
        $(child_item).next().addClass('show');
        return false;
    });

    $(document).on('click', '.product-close', function() {
        $(this).parents('.main-product-select').removeClass('show');
        $(this).parents('.child-product-select').removeClass('show');
        return false;
    });

    $(document).on('click', '#check4', function() {
        $('.ul-detail [name=company_type]').val(3);
        $('#kpp').attr('disabled','disabled');
        $('#inn').attr('maxlength', '12');
    });

    $(document).on('click', '#check5', function() {
        $('.ul-detail [name=company_type]').val(2);
        $('#kpp').removeAttr('disabled');
        $('#inn').attr('maxlength', '10');
    });

    $('#basket-balance-pay').click(function (evt) {
        evt.preventDefault();
        var goUrl = "/index.php?do=paybalance";
        var code = $('#code').val();
        if (code) {
            goUrl = goUrl + '&code=' + code;
        }
        var codes = getDiscountCodes();
        if (codes) {
            goUrl = goUrl + '&codes=' + codes;
        }
        window.location.href = goUrl;
        return false;
    });

    $(document).on('click', '.main-set-ticket', function() {
        let id          = $(this).data('id');
        let btn         = $(this);
        let btnText     = $(this).html();
        let modal       = $(btn).data('target');
        $('.modal .buy-ticket-click').data('extuser', '');
        $('.modal .ticket-rebro a').attr('href', '/index.php?do=add&ticket=rebro');
        $('.ticket-tourist').hide();
        if ( id > 0 ) {
            if (confirm('Удалить текущий билет, чтобы выбрать новый?')) {
                $(btn).addClass('disabled');
                $(btn).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                $('.g-emoji-content-show').hide();
                let gotdata = 'id='+delAmp(id)+'&isAjax=1';

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '/index.php?do=delticket',
                    data: gotdata,
                    success: function (data) {
                        if ( (data.error) && (data.error == 1) ) {
                            $.alert(data.msg, {title: false, type: 'danger'});
                            $(btn).html(btnText);
                        } else {
                            $(modal).modal('show');
                            $(btn).parents('.form-group').addClass('modal-defiant');
                            //$('.main-ticket-select').addClass('show');
                            $(btn).data('id', '');
                            $(btn).html('Выбрать билет');
                            $(btn).parents('.form-control').removeAttr('class').addClass('form-control');
                        }
                        $(btn).removeClass('disabled');
                    }
                });
            }
        } else {
            $(modal).modal('show');
            $(btn).parents('.form-group').addClass('modal-defiant');
            //$('.main-ticket-select').addClass('show');
            $(btn).parents('.form-control').removeAttr('class').addClass('form-control');
        }
        return false;
    });

    $(document).on('click', '.child-set-ticket', function() {
        let id          = $(this).data('id');
        let user_id     = $(this).data('extuser');
        let btn         = $(this);
        let btnText     = $(this).html();
        let modal       = $(btn).data('target');
        $('.modal .buy-ticket-click').data('extuser', user_id);
        $('.modal .ticket-rebro a').attr('href', '/index.php?do=add&ticket=rebro&extuser='+user_id);
        $('.ticket-tourist').show();
        if ( id > 0 ) {
            if (confirm('Удалить текущий билет, чтобы выбрать новый?')) {
                $(this).addClass('disabled');
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                //$(this).parents('.form-control').removeAttr('class').addClass('form-control');

                let gotdata = 'id='+delAmp(id)+'&isAjax=1';

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    url: '/index.php?do=delticket',
                    data: gotdata,
                    success: function (data) {
                        if ( (data.error) && (data.error == 1) ) {
                            $.alert(data.msg, {title: false, type: 'danger'});
                            $(btn).html(btnText);
                        } else {
                            $(modal).modal('show');
                            $(btn).parents('.form-group').addClass('modal-defiant');
                            //$('#child-ticket-select-'+user_id).addClass('show');
                            $(btn).data('id', '');
                            $(btn).html('Выбрать билет');
                            $(btn).parents('.form-control').removeAttr('class').addClass('form-control');
                        }
                        $(btn).removeClass('disabled');
                    }
                });
            }
        } else {
            $(modal).modal('show');
            $(btn).parents('.form-group').addClass('modal-defiant');
            //$('#child-ticket-select-'+user_id).addClass('show');
            $(btn).parents('.form-control').removeAttr('class').addClass('form-control');
        }
        return false;
    });

    // Сохранение реквизитов и переход на выставление счета
    $(document).on('click', '#invoice-pay', function() {
        let company_type  = $('.ul-detail [name=company_type]');
        let company   = $('.ul-detail [name=company]');
        let inn       = $('.ul-detail [name=inn]');
        let btn         = $(this);
        let btnText     = $(this).html();
        $(this).addClass('disabled');
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        if ( (!company_type.val()) || (!company.val()) || (!inn.val()) ) {
            $.alert('Все поля обязательны к заполнению!', {title: false, type: 'danger'});
            if (!company_type.val())
                company_type.addClass('error');
            if (!company.val())
               company.addClass('error');
            if (!inn.val())
               inn.addClass('error');
            $(btn).removeClass('disabled');
            $(btn).html(btnText);
            return false;
        }

        // ajax запрос
        let gotdata = 'job=save_details'
            + '&company_type='  + delAmp(company_type.val())
            + '&company='   + delAmp(company.val())
            + '&inn='       + delAmp(inn.val());
        
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    $.alert(data.msg, {title: false, type: 'danger'});
                } else {
                    window.location.href = '/invoice';
                }
            }
        });
        $(btn).removeClass('disabled');
        $(btn).html(btnText);
        return false;
    });

    $(document).on('change', '.error', function() {
        $(this).removeClass('error');
    });

    $("select[name=country], select[name=countryName]").change(function () {
        let cityField = $(this).parent().parent().next();
        if ($(this).val() === "ru") {
            $(cityField).find('input[name=city]').removeClass('show');
            $(cityField).find('input[name=cityName]').removeClass('show');
            $(cityField).find('select.chosen-select').addClass('show').chosen();
            $(cityField).find('.chosen-container').addClass('show').css('width', '100%');
        } else {
            $(cityField).find('input[name=city]').addClass('show');
            $(cityField).find('input[name=cityName]').addClass('show');
            $(cityField).find('select.chosen-select').removeClass('show')
            $(cityField).find('.chosen-container').removeClass('show');
        }
    });

    $(".city-select").change(function () {
        $(this).parents('.form-group').find('input').val($(this).val());
    });

    $('#add_new').click(function (evt) {
        evt.preventDefault();
        $('.participant_add').addClass('show');
        $(".participant_add select.chosen-select:not(.hidden)").chosen();
        return false;
    });

    // Добавление доп участника
    $('#reg_add_user').click(function (evt) {
        evt.preventDefault();
        let phone       = $('.participant_add [name=phone]');
        let name        = $('.participant_add [name=name]');
        let lastname    = $('.participant_add [name=lastname]');
        let email       = $('.participant_add [name=email]');
        let company     = $('.participant_add [name=company]');
        let country     = $('.participant_add [name=country]');
        let city        = $('.participant_add [name=city]');
        let position    = $('.participant_add [name=position]');
        let usersize    = $('.participant_add [name=usersize]');

        if ( (!phone.val()) || (!name.val()) || (!lastname.val()) || (!email.val()) || (!company.val()) || (!country.val()) || (!city.val()) || (!position.val()) || (!usersize.val()) ) {
            $.alert('Все поля обязательны к заполнению!', {title: false, type: 'danger'});
            if (!phone.val())
               phone.addClass('error');
            if (!name.val())
               name.addClass('error');
            if (!lastname.val())
               lastname.addClass('error');
            if (!email.val())
               email.addClass('error');
            if (!company.val())
               company.addClass('error');
            if (!country.val())
               alert("Выберите город из выпадающего списка");
            if (!city.val())
               city.addClass('error');
            if (!position.val())
               position.addClass('error');
            if (!usersize.val())
                usersize.addClass('error');
            return;
        }

        // ajax запрос
        let gotdata = 'job=add_user'
            + '&phone='     + delAmp(phone.val())
            + '&name='      + delAmp(name.val())
            + '&lastname='  + delAmp(lastname.val())
            + '&email='     + delAmp(email.val())
            + '&company='   + delAmp(company.val())
            + '&country='   + delAmp(country.val())
            + '&city='      + delAmp(city.val())
            + '&position='  + delAmp(position.val())
            + '&usersize='  + delAmp(usersize.val());
        
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    $.alert(data.msg, {title: false, type: 'danger'});
                } else {
                    window.location.reload();
                }
            }
        });
        return false;
    });

    $('.edit-user').click(function (evt) {
        evt.preventDefault();
        let id = $(this).data('id');
        $('#participant_'+id).addClass('show');
        $('#participant_edit_'+id).removeClass('show');
        $('#participant_'+id+' select.chosen-select:not(.hidden)').chosen();
    });

    $('.reg_edit_user').click(function (evt) {
        evt.preventDefault();
        let id = $(this).data('id');
        let form = $('#participant_'+id);
        let name        = $(form).find('[name=name]');
        let lastname    = $(form).find('[name=lastname]');
        let email       = $(form).find('[name=email]');
        let company     = $(form).find('[name=company]');
        let country     = $(form).find('[name=country]');
        let city        = $(form).find('[name=city]');
        let position    = $(form).find('[name=position]');
        let usersize    = $(form).find('[name=usersize]');
        let btn         = $(this);
        let btnText     = $(this).html();
        $(this).addClass('disabled');
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        if ( (!name.val()) || (!lastname.val()) || (!email.val()) || (!company.val()) || (!country.val()) || (!city.val()) || (!position.val()) || (!usersize.val()) ) {
            $.alert('Все поля обязательны к заполнению!', {title: false, type: 'danger'});
            if (!name.val())
               name.addClass('error');
            if (!lastname.val())
               lastname.addClass('error');
            if (!email.val())
               email.addClass('error');
            if (!company.val())
               company.addClass('error');
            if (!country.val())
               country.addClass('error');
            if (!city.val())
               city.addClass('error');
            if (!position.val())
               position.addClass('error');
            if (!usersize.val())
                usersize.addClass('error');
            return undefined;
        }
        // ajax запрос
        let gotdata = 'job=edit_user'
            + '&id='        + delAmp(id)
            + '&name='      + delAmp(name.val())
            + '&lastname='  + delAmp(lastname.val())
            + '&email='     + delAmp(email.val())
            + '&company='   + delAmp(company.val())
            + '&country='   + delAmp(country.val())
            + '&city='      + delAmp(city.val())
            + '&position='  + delAmp(position.val())
            + '&usersize='  + delAmp(usersize.val());

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    $.alert(data.msg, {title: false, type: 'danger'});
                } else {
                    $('#participant_'+id).removeClass('show');
                    $('#participant_edit_'+id).addClass('show');
                    //window.location.reload();
                    $('#participant_edit_'+id+' .form-control>span').html(delAmp(name.val()) + ' ' + delAmp(lastname.val()));
                }
                $(btn).removeClass('disabled');
                $(btn).html(btnText);
            }
        });
        
        return false;
    });

    $('.btn-tmpinn-save').click(function (evt) {
        let btn         = $(this);
        let btnText     = $(this).html();
        let container   = $(this).parents("div");
        let modal       = $("#dadataOrganizationModal");
        let company     = container.find("input[name=tmp_company]").val();
        let inn         = container.find("input[name=tmp_inn]").val();
        let kpp         = container.find("input[name=tmp_kpp]").val();
        let address     = container.find("input[name=tmp_address]").val();
        let company_type = container.find("input[name=tmp_company_type]").val();
        let gotdata = 'job=save_details'
            + '&company='      + delAmp(company)
            + '&inn='          + delAmp(inn)
            + '&kpp='          + delAmp(kpp)
            + '&address='      + delAmp(address)
            + '&company_type=' + delAmp(company_type);

        $(btn).addClass('disabled');
        $(btn).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    $.alert(data.msg, {title: false, type: 'danger'});
                } else {
                    $(".company_info").html("<p>"+company+"</p>\n" +
                        "<p>ИНН: "+inn+", КПП: "+kpp+"</p>\n" +
                        "<p>"+address+"</p>");
                    $(modal).modal('hide');
                }
                $(btn).removeClass('disabled');
                $(btn).html(btnText);
            }
        });
    });

    $('#reg_save').click(function (evt) {
        evt.preventDefault();
        let modal     = $(this).parents('.modal');
        let name      = $('#reg_name').val();
        let born      = $('#reg_born').val();
        let lastname  = $('#reg_lastname').val();
        let email     = $('#reg_email').val();
        let company   = $('#reg_company').val();
        let country   = $('#countryName').val();
        let city      = $('#cityName').val();
        let position  = $('#reg_position').val();
        let usersize  = $('#reg_usersize').val();
        let btn       = $(this);
        let btnText   = $(this).html();

        if ( ($("#check_policy").length) && (!$("#check_policy").prop('checked')) ) {
            alert("Отметьте согласие с политикой конфиденциальности");
            return;
        }

        if ( (!name) || (!lastname) || (!email) || (!country) || (!city) || (!position) || (!usersize) ) {
            $.alert('Все поля обязательны к заполнению!', {title: false, type: 'danger'});
            if (!name)
               $('#reg_name').addClass('error');
            if (!lastname)
               $('#reg_lastname').addClass('error');
            if (!email)
               $('#reg_email').addClass('error');
            if (!country)
               $('#countryName').addClass('error');
            if (!city) {
                $('#cityName').addClass('error');
                alert("Выберите город из выпадающего списка");
            }
            if (!position)
               $('#reg_position').addClass('error');
            if (!usersize)
                $('#reg_usersize').addClass('error');
            return;
        }
        
        $(btn).addClass('disabled');
        $(btn).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');

        // ajax запрос
        let gotdata = 'job=register'
            + '&name='      + delAmp(name)
            + '&lastname='  + delAmp(lastname)
            + '&tsBorn='    + delAmp(born)
            + '&email='     + delAmp(email)
            + '&company='   + delAmp(company)
            + '&country='   + delAmp(country)
            + '&city='      + delAmp(city)
            + '&position='  + delAmp(position)
            + '&usersize='  + delAmp(usersize);
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    $.alert(data.msg, {title: false, type: 'danger'});
                } else {
                    if (data === 'donecode') {
                        //yaCounter28771811.reachGoal('_ya_newuser');
                        window.location.href = "/userarea";
                    } else if (data === 'redirectToTicket') {
                        //yaCounter28771811.reachGoal('_ya_newuser');
                        window.location.href = "/catalog";
                    } else {
                        $('.register-page .buttons').addClass('show');
                        $('.main-user-input-block').addClass('show');
                        $('.main-user-edit-block').removeClass('show');
                        $('.main-user-input-block .form-control>span').html(delAmp(name) + ' ' + delAmp(lastname));
                        $(modal).modal('hide');
                        $.alert("Данные сохранены!", {title: false, type: 'success'});
                    }
                }
                $(btn).removeClass('disabled');
                $(btn).html(btnText);
            }
        });
        return false;
    });
});

$(window).load(function() {
    if ( $('.ul-detail [name=company_type]').val() == 2 ) {
        $('#check5').click();
    }

    setTimeout(function() {
        loadOldUserData();
    },5000);
});

$('.user-modal-edit').on('show.bs.modal', function (event) {
    event.relatedTarget;
    $(".user-modal-edit select.chosen-select").chosen();
    if ( $("#secondCityName").hasClass('show') ) {
        $("#secondCityName").next().addClass('show');
    }
    $(".user-modal-edit .chosen-container").css('width', '100%');
});

$('.user-modal-edit').on('hidden.bs.modal', function (event) {
    if ( !$('#reg_email').val() ) {
        $(".user-modal-edit").modal('show');
    }
});
$(function() {
    $("#reg_born").datepicker({
        dateFormat: "dd.mm.yy"
    }, $.datepicker.regional["ru"]);
});
function loadOldUserData() {
   if ( !$('.main-user-input-block').hasClass('show') && !$('#reg_email').val() ) {
        // ajax запрос
        let gotdata = 'job=loadOldUserData';
        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/ajax',
            data: gotdata,
            success: function (data) {
                if (data.error === 1) { // какая то ошибка
                    $.alert(data.msg, {title: false, type: 'danger'});
                } else if (data.error === 0) { // пользователь найден в старой базе
                    $("#reg_name").val(data.user.name);
                    $("#reg_lastname").val(data.user.lastname);
                    $("#reg_email").val(data.user.email);
                }
                $(".user-modal-edit").find('.btn-link').hide();
                //$(".user-modal-edit").find('#cityName').removeClass('show');
                $(".user-modal-edit").modal('show');
            }
        });
    }
}