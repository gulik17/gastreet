$().ready(function() {
    // функция для отправки AJAX запроса
    function catalogSendAjaxRequest(gotParams, eltId, hideTicket) {
        if (hideTicket) {
            $('.ticket .btn').hide();
        }
        gotdata = gotParams + "&isAjax=1";

        $.ajax({
            type: 'POST',
            dataType: 'JSON',
            url: '/index.php?do=add',
            data: gotdata,
            success: function (data) {
                if (data.error) {
                    alert(data.error);
                    return false;
                } else {
                    if (data == 'go_basket_ok') {
                        // покупка доп. участником
                        $(eltId).remove();
                        $.alert("Товар добавлен в корзину", {title: false, type: 'success',
                            onClose: function () {
                                window.location.href = "/basket";
                            }
                        });
                    } else if (data[0] == 'go_back_ok') {
                        // покупка ок
                        $(eltId).remove();
                        // danger, success, warning, info
                        $.alert("Товар добавлен в корзину", {title: false, type: 'success'});
                        $("a.basket span.badge").html(data[1]);
                        //window.location.href = "/basket"; 
                    } else if (data[0] == 'product_ok') {
                        // покупка ок
                        //$(eltId).remove();
                        // danger, success, warning, info
                        $.alert("Товар добавлен в корзину", {title: false, type: 'success'});
                        $("a.basket span.badge").html(data[1]);
                        //window.location.href = "/basket";
                        $(eltId).find('i').removeClass('fa-shopping-cart').addClass('fa-check');
                    } else if (data[0] == 'ticket_deleted') {
                        // покупка ок
                        //$(eltId).remove();
                        // danger, success, warning, info
                        $.alert("Товар удален из корзины", {title: false, type: 'info'});
                        $("a.basket span.badge").html(data[1]);
                        //window.location.href = "/basket";
                        $(eltId).find('i').removeClass('fa-check').addClass('fa-shopping-cart');
                    } else if (data[0] == 'ticket_donot_deleted') {
                        // покупка ок
                        //$(eltId).remove();
                        // danger, success, warning, info
                        $.alert("Товар нельзя удалить", {title: false, type: 'info'});
                        $("a.basket span.badge").html(data[1]);
                        //window.location.href = "/basket";
                        $(eltId).find('i').removeClass('fa-shopping-cart').addClass('fa-check');
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
                    } else if (data[0] == 'cannot_buy_product') {
                        $.alert("Вы не можете купить данный билет", {title: false, type: 'danger'});
                        $("a.basket span.badge").html(data[1]);
                        //window.location.href = "/basket";
                        $(eltId).find('i').addClass('fa-shopping-cart').removeClass('fa-check');
                    } else {
                        $.alert("Непредвиденная ошибка, обратитесь к администратору", {title: false, type: 'danger'});
                    }
                }
            }
        });
        return false;
    }
    
    if ( ($('.container').outerWidth() > '600') && ($('.ticket-row').length > 0) ) {
        $('.ticket-row').owlCarousel({
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                600:{items:3},
                1000:{items:5}
            }
        });
    }

    $('.buy-ticket-click').click(function (evt) {
        evt.preventDefault();
        var id = $(this).data('id');
        var gotParams = "ticket=" + id;
        catalogSendAjaxRequest(gotParams, $(this), true);
    });

    $('.buy-product-click-pc').click(function (evt) {
        evt.preventDefault();
        var id = $(this).data('id');
        var extuser   = $(this).data('extuser');
        var gotParams = '';
        if (extuser) {
            gotParams = "product=" + id + "&extuser="+extuser+"&mode=existuser";
        } else {
            gotParams = "product=" + id;
        }
        catalogSendAjaxRequest(gotParams, $(this));
    });

    $('.buy-product-click-pc-popup').click(function (evt) {
        evt.preventDefault();
        var id = $(this).attr('id').split('buy-product-pc-popup-').join('');
        var gotParams = "product=" + id;
        catalogSendAjaxRequest(gotParams, $(this));
    });

    $('.tab-dates a').click(function (evt) {
        evt.preventDefault();
        //tab-dates
        var tagname = 'all';
        var tagname = $('.tags-list-speakers .gss-tag-li.active a').data('tag');
        var date = $(this).data('date');
        $('.tab-dates a').removeClass('active');
        $(this).addClass('active');
        $('.row.block-body, .schedule-body .schedule-item').addClass('d-none');
        if (tagname == 'all') {
            if (date == 'all') {
                $('.block-body').removeClass('d-none');
            } else {
                var show = '.row-date-'+date;
                $(show).removeClass('d-none');
            }
        } else {
            if (date == 'all') {
                $('.block-body.'+tagname).removeClass('d-none');
            } else {
                var show = '.row-date-'+date+'.'+tagname;
                $(show).removeClass('d-none');
            }
        }
        return false;
    });

    //$('.block-body.tag_partnerstreet').addClass('d-none');
    //$('.block-body.tag_winedome').addClass('d-none');
    //$('.block-body.tag_baristastreet').addClass('d-none');

    $('.gss-tag-link').click(function (evt) {
        evt.preventDefault();
        var date = $('.tab-dates .active').data('date');
        $('.gss-tag-li').removeClass('active');
        var tagname = $(this).data('tag');
        $(this).parent().addClass('active');
        if (date == 'all') {
            if (tagname == 'all') {
                $('.block-body').removeClass('d-none');
                //$('.block-body.tag_partnerstreet').addClass('d-none');
                //$('.block-body.tag_winedome').addClass('d-none');
                //$('.block-body.tag_baristastreet').addClass('d-none');
            } else {
                $('.block-body').addClass('d-none');
                $('.block-body.'+tagname).removeClass('d-none');
            }
        } else {
            if (tagname == 'all') {
                $('.block-body'+'.row-date-'+date).removeClass('d-none');
            } else {
                $('.block-body').addClass('d-none');
                var show = '.block-body.'+tagname+'.row-date-'+date;
                $(show).removeClass('d-none');
            }
        }

        if ($(this).parent().hasClass('active') && $(this).hasClass('gss-show-chef')) {
            $('.gss-chef-moder').show();
        } else {
            $('.gss-chef-moder').hide();
        }
        return false;
    });
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
    $('[data-toggle="popover"]').popover({
        trigger: 'focus'
    });
});

$('a.ticket_desc').on('click', function () {
    var ticket = $(this).parents('.ticket');
    var ri = $(ticket).data('ri'); 
    var tw = $(ticket).parent().innerWidth();
    var w = $('.container').width();
    var html = '';
    var irc = 0;
    var idx = 0;
    $('.irc_bg').removeClass('show');
    if (w > 767) {
        irc = (tw / 2) + ((ri[1]-1) * tw);
        $('.irc-pc').css('left', irc);
        $('.irc_bg.'+ri).addClass('show');
    } else {
        irc = tw / 2;
        $('.irc-pc').css('left', irc);
        $('.irc_bg.'+ri).clone().insertAfter(ticket.parent('div')).addClass('show').addClass('mobile');
    }
    $('.irc_bg.mobile .close').on('click', function () {
        $('.irc_bg.mobile').remove();
        return false;
    });
    return false;
});

$('.irc_bg .close').on('click', function () {
    $('.irc_bg').removeClass('show');
    return false;
});

$(document).on('mouseup', function (e){
    var div = $(".schedule-table .schedule-item");
    if (!div.is(e.target) && div.has(e.target).length === 0) {
        div.removeClass('active');
    }
});

$('.schedule-filter a').on('click', function () {
    var target = $(this).data('target');
    $('.tags-list-speakers').hide();
    $('.schedule-filter a').removeClass('active');
    $(this).addClass('active');
    $(target).show();
    return false;
});