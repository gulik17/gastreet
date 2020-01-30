// Получение полной высоты объекта (вместе с вертикальными паддингами)
var getFullHeight = function ($el) {
    return parseInt($el.height()) + parseInt($el.css('padding-top')) + parseInt($el.css('padding-bottom'));
};

jQuery(document).ready(function ($) {
    var FIX_SITE_HEADER_MIN_WIDTH = 1200; // Минимальная ширина вьюпорта для фиксирования шапки
    var CORRECTION_WIDTH = 30;

    /* dsu: из-за youtube (их iframe) центрирование перестало работать корректно - поэтому отключили
     // Выравнивание Bootstrap Modal по центру
     var modalVerticalCenterClass = ".modal";
     var centerBootstrapModals = function($element) {
     var $modals;
     if ($element.length) {
     $modals = $element;
     } else {
     $modals = $(modalVerticalCenterClass + ':visible');
     }
     $modals.each( function(i) {
     var $clone = $(this).clone().css('display', 'block').appendTo('body');
     var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
     top = top > 0 ? top : 0;
     $clone.remove();
     $(this).find('.modal-content').css("margin-top", top);
     });
     };
     $(modalVerticalCenterClass).on('show.bs.modal', function (e) {
     centerBootstrapModals($(this));
     });
     $(window).on('resize', centerBootstrapModals);
     */
    
    // Фиксирование изображения страницы
    var fixPageContainerImage = function () {
        var $pc = $('#page-container');
        $pc.removeClass('has-pos-fix');
    };

    if (!$.cookie("notice")) {
        $("#old18").show(400);
        $("#bg-root").fadeIn(400);
    }
    /*
    if (!$.cookie("cashback")) {
        $("#cashback_modal").show(400);
        $("#bg-root2").fadeIn(400);
    }
    
    $("#cashback_modal .buttons a.accept").click(function () {
        $.cookie("cashback", "Y");
        $("#cashback_modal").hide(400);
        $("#bg-root2").fadeOut(400);
        window.location.href = "/cashback";
        return false;
    });

    $("#cashback_modal .buttons a.disaccept").click(function () {
        $.cookie("cashback", "Y");
        $("#cashback_modal").hide(400);
        $("#bg-root2").fadeOut(400);
        return false;
    });*/

    // jQuery(document).mouseleave(function(e) {
    //     if (e.clientY < 50) {
    //         if (!$.cookie("close_pres")) {
    //             $("#close_modal").show(400);
    //             $("#bg-root").fadeIn(400);
    //         }
    //     }
    // });

    // $("#close_modal .buttons a.accept").click(function () {
    //     $.cookie("close_pres", "Y");
    //     $("#close_modal").hide(400);
    //     $("#bg-root").fadeOut(400);
    //     window.location.href = "/speakersprev?utm_source=modal_popup&utm_medium=speaker_pres";
    //     return false;
    // });

    // $("#close_modal .buttons a.disaccept").click(function () {
    //     $.cookie("close_pres", "Y");
    //     $("#close_modal").hide(400);
    //     $("#bg-root").fadeOut(400);
    //     return false;
    // });

    // function func() {
    //     if (!$.cookie("ig")) {
    //         $("#ig_modal").show(400);
    //         $("#bg-root").fadeIn(400);
    //     }
    // }

    //setTimeout(func, 90000);
    
    // $("#ig_modal .buttons a.accept").click(function () {
    //     $.cookie("ig", "Y");
    //     $("#ig_modal").hide(400);
    //     $("#bg-root").fadeOut(400);
    //     return false;
    // });

    $("#old18 .buttons a.accept").click(function () {
        $.cookie("notice", "Y", { expires: 365, path: '/' });
        $("#old18").hide(400);
        $("#bg-root").fadeOut(400);
        return false;
    });

    $('.indicator-toggle').click(function (e) {
        e.stopPropagation(e);
        $('.indicator-martini').toggle();
    });

    $(document).click(function (e) {
        if (e.target.id != 'martini-div') {
            $('#martini-div').hide();
        }
    });

    // Создание мобильной навигации
    (function () {
        var $menu = $('#nav-menu').clone(true);
        var $reg = $('#header-col-right .js-reg').clone(true);
        var $up = $('#header-col-right .js-user-panel').clone(true);

        var $navMobile = $('#nav-mobile');

        $menu
                .removeClass('nav')
                .removeClass('nav-menu')
                .addClass('nav-menu-mobile')
                .attr('id', 'nav-menu-mobile');

        $navMobile.append($menu);
        $navMobile.append($reg);
        $navMobile.append($up);
    })(); // function() - Создание основного выпадающего меню

    // Разворачивание подменю
    $('.nav-menu-mobile .menu > li.has-sub-menu>span').on('click', function (e) {
        //e.preventDefault();
        $(this).parent('.has-sub-menu').toggleClass('expanded').find('ul').slideToggle();
        return false;
    });
    
    // Переключение отображения меню
    $('#nav-mobile-toggle').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active');
        $('.nav-mobile').slideToggle(150);
    });

    // выключение кнопки submit
    $('#gss-paycard-form').submit(function () {
        $('#gss-paycard').prop('disabled', true);
    });

    // Главный слайдер
    $('.js-jumbotron-slider').each(function () {
        var $slider = $(this);
        $slider.find('.js-slider').owlCarousel({
            items: 1,
            center: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 8000,
            animateOut: 'fadeOut',
            loop: true,
            dots: true,
            nav: true,
            dotsContainer: $slider.parent().find('.js-dots'),
            navContainer: $slider.parent().find('.js-nav'),
            responsive:{
                2300:{items:2}
            }
        });
    });

    // Установка размеров главного слайдера
    $(window).bind('resize.jumbotron-slider', function () {
        $('.js-jumbotron-slider').each(function () {
            var pad = parseInt(($(window).height() - getFullHeight($('#site-header')) - $(this).find('.js-maininfo').height() - 10) / 2);
            var h = $(this).height();
            $(this).find('.js-slide').height(h);
        });
    })
    $(window).trigger('resize.jumbotron-slider');

    // Карусель спикеров
    $('.js-speakers-carousel').each(function () {
        var $carousel = $(this);
        $carousel.find('.js-carousel').owlCarousel({
            loop: false,
            margin: 5,
            nav: true,
            dotsContainer: $carousel.find('.js-dots-speakers'),
            responsive: {
                0: {items: 2},
                480: {items: 3},
                768: {items: 4}
            }
        });
    });

    // Карусель спикеров
    $('.js-videos-gallery').each(function () {
        var $carousel = $(this);
        $carousel.find('.js-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dotsContainer: $carousel.find('.js-dots-videos'),
            responsive: {
                0: {items: 2},
                480: {items: 3},
                768: {items: 4}
            }
        });
    });

    // Карусель бонусных заданий
    $('.js-prizes-carousel').each(function () {
        var $carousel = $(this);
        $carousel.find('.js-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            dotsContainer: $carousel.find('.js-dots-prizes'),
            responsive: {
                0: {items: 2},
                480: {items: 3},
                768: {items: 4}
            }
        });
    });

    // Открытие/закрытие спойлеров
    $('.js-spoiler').each(function () {
        var $sp = $(this);
        var $spHead = $sp.children('.js-spoiler-head');
        var $spBody = $sp.children('.js-spoiler-body');
        $spHead.on('click', function (e) {
            $sp.toggleClass('active');
            $spBody.slideToggle('normal', function () {
            });
            $(window).trigger('resize.site-layout');
        });
    });

    // отображение модального окна
    if ($.isFunction($.fn.modal)) {
        $('.js-popover').on('click', function (e) {
            e.preventDefault();

            var elementId = $(this).data('popover'),
                    idYoutubeVideo = $(this).data('idyoutubevideo'),
                    timerToggle = $(this).data('timer');

            // изменение содержимого (src) ifram'а
            if (idYoutubeVideo) {
                // событие: показ модального окна
                $(elementId).on('show.bs.modal', function () {
                    var $iframe = $(this).find('iframe');
                    if ($iframe.length) {
                        $iframe.attr("src", "https://www.youtube.com/embed/" + idYoutubeVideo + "?rel=0");
                    }
                });
                // событие: сокрытие модального окна
                $(elementId).on('hide.bs.modal', function () {
                    var $iframe = $(this).find('iframe');

                    if ($iframe.length) {
                        $iframe.attr("src", "about:blank");
                    }
                });
            }
            $(elementId).modal('show');
            // включение режима смены картинок
            if (timerToggle === "on") {
                startTimer(elementId);
            }
        });
    }

    $('.gss-mainpage-statistics-close').click(function (evt) {
        $('.gss-mainpage-statistics').hide();
        return false;
    });

    $('.more .more-link').click(function (evt) {
        let partners = $(this).parents('.partners-list').find('ul');
        $(partners).find('li').css('display', 'inline-block');
        $(this).hide();
        return false;
    });

    $('#show-all-parthners-button-one').click(function (evt) {
        $('.hidden-parthner-one').show();
        $('.gss-parthner-show-one').removeClass('gss-parthner-one-li-3');
        $('.gss-parthner-show-one').removeClass('gss-parthner-one-li-4');
        $('.gss-parthner-show-one').removeClass('gss-parthner-one-li-5');
        $('.gss-parthner-show-one').removeClass('gss-parthner-one-li-6');
        $('.gss-parthner-show-one').show();
        $('#show-all-parthners-one').hide();
        return false;
    });

    $('#show-all-parthners-button-two').click(function (evt) {
        $('.hidden-parthner-two').show();
        $('.gss-parthner-show-two').removeClass('gss-parthner-two-li-3');
        $('.gss-parthner-show-two').removeClass('gss-parthner-two-li-4');
        $('.gss-parthner-show-two').removeClass('gss-parthner-two-li-5');
        $('.gss-parthner-show-two').removeClass('gss-parthner-two-li-6');
        $('.gss-parthner-show-two').show();
        $('#show-all-parthners-two').hide();
        return false;
    });

    $('#show-all-parthners-button-three').click(function (evt) {
        $('.hidden-parthner-three').show();
        $('.gss-parthner-show-three').removeClass('gss-parthner-three-li-3');
        $('.gss-parthner-show-three').removeClass('gss-parthner-three-li-4');
        $('.gss-parthner-show-three').removeClass('gss-parthner-three-li-5');
        $('.gss-parthner-show-three').removeClass('gss-parthner-three-li-6');
        $('.gss-parthner-show-three').show();
        $('#show-all-parthners-three').hide();
        return false;
    });

    $('#show-all-parthners-button').click(function (evt) {
        $('.hidden-parthner').show();
        $('.gss-parthner-show').removeClass('gss-parthner-li-3');
        $('.gss-parthner-show').removeClass('gss-parthner-li-4');
        $('.gss-parthner-show').removeClass('gss-parthner-li-5');
        $('.gss-parthner-show').removeClass('gss-parthner-li-6');
        $('.gss-parthner-show').show();
        $('#show-all-parthners').hide();
        return false;
    });

    var listenScroll = function () {

    };
    
    var listenResize = function () {
        fixPageContainerImage();
    };

    jQuery(window).load(function () {
        fixPageContainerImage();
        $(window).bind('resize', listenResize);
    });
    $(window).bind('scroll', listenScroll);
});

$(window).on('load', function () {
    $(window).trigger('resize.jumbotron-slider');
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.12';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    var fh = $('#site-footer').outerHeight();
    var hh = $('#site-header').outerHeight();
    //$('#site-footer').css('bottom', (-1*fh));
    //$('section.header, body .l-site').css('margin-bottom', (fh-20)).css('padding-top', hh);
    
});

/**
 * функция обеспечивающая режим смены картинок
 * @param id {string} - ID элемента (например, #popover-win-4)
 * @returns {undefined}
 */
function changeImage(id) {
    console.log("changeImage");
    // завершение выполнения, если модальное окно было скрыто
    var isShowModalWindow = $(id).hasClass('in');
    if (!isShowModalWindow) {
        stopTimer();
        return undefined;
    }
    // завершение выполнения, если элементов "img" недостаточно
    var imgCount = $(id + " figure.thumb.fg-container > img").length;
    if (imgCount < 2) {
        stopTimer();
        return undefined;
    }
    var $firstImgHide = $(id + " figure.thumb.fg-container > img.foreground.fg-hide:first"),
        $imgHideNot = $(id + " figure.thumb.fg-container > img.foreground.fg-hide.fg-not"),
        $nextImgHide = null;
    if ($imgHideNot.length) {
        $imgHideNot.removeClass("fg-not");
        $nextImgHide = $imgHideNot.next();
        if ($nextImgHide.length) {
            $nextImgHide.addClass("fg-not");
        }
    } else {
        $firstImgHide.addClass("fg-not");
    }
}

var timerId = null,
    timerDelay = 5000;  // 1000 - 1 сек

function startTimer(id) {
    console.log("startTimer");
    clearTimeout(timerId);  // в одно и тоже время может быть запущен только один таймер
    timerId = setInterval(
            function () {changeImage(id);},
        timerDelay);
}

function stopTimer() {
    console.log("stopTimer");
    clearTimeout(timerId);
}

if ( ($('.speaker a').length) && (!$('#speaker-modal').length) ) {
    var html = '<div class="modal fade" id="speaker-modal" tabindex="-1" role="dialog">'+
        '<div class="modal-dialog modal-md" role="document">'+
            '<div class="modal-content popover-win">'+
                '<div class="modal-header">'+
                    '<button type="button" class="close" data-dismiss="modal" aria-label="##close##"><span aria-hidden="true">&times;</span></button>'+
                '</div>'+
                '<div class="modal-body"></div>'+
            '</div>'+
        '</div>'+
    '</div>';
    $('body').append(html);
}
if ( ($('a[data-target="#video-modal"]').length) && (!$('#video-modal').length) ) {
    var html = '<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">'+
            '<div class="modal-dialog modal-lg" role="document">'+
                '<div class="modal-content">'+
                    '<div class="modal-header">'+
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        '<h4 class="modal-title" id="videoModalLabel"></h4>'+
                    '</div>'+
                    '<div class="modal-body">'+
                        '<iframe allowfullscreen="" height="400" src="" style="width:100%"></iframe>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';
    $('body').append(html);
}

var ViaPush = window.ViaPush || [];
ViaPush.push(["init", { appId: "b58fa8ab-cf0e-8196-4952-9be21bc2b1f6" }]);

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

$('.modal:not(.user-modal-edit)').on('hidden.bs.modal', function (e) {
    var player = $(this).find('iframe');
    //alert(player);
    var videoURL = player.prop('src');
    if (videoURL) {
        videoURL = videoURL.replace("&autoplay=1", "");
    }
    player.prop('src','');
    player.prop('src',videoURL);
});

$('a[data-speaker-id]').on('click', function (e) {
    var speakerHtml = '';
    var linkHtml = '';
    var speakerId = $(this).data('speaker-id');

    if (!speakerId) 
        return false;

    // ajax запрос
    var gotdata = 'job=get_speaker'
        + '&id='  + speakerId;

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        url: '/ajax',
        data: gotdata,
        success: function (data) {
            if (data.error) {
                if (data.msg == 'noSpeaker') {
                    $.alert('Спикер не найден', {title: false, type: 'danger'});
                } else {
                    $.alert('Неизвестная ошибка', {title: false, type: 'danger'});
                }
            } else {
                if (data.facebook) {
                    linkHtml += '<a href="'+data.facebook+'" class="fa fa-facebook" target="_blank"></a>';
                }
                if (data.vk) {
                    linkHtml += '<a href="'+data.vk+'" class="fa fa-vk" target="_blank"></a>';
                }
                if (data.instagram) {
                    linkHtml += '<a href="'+data.instagram+'" class="fa fa-instagram" target="_blank"></a>';
                }
                if (data.twitter) {
                    linkHtml += '<a href="'+data.twitter+'" class="fa fa-twitter" target="_blank"></a>';
                }
                if (data.site) {
                    linkHtml += '<a href="'+data.site+'" class="fa fa-globe" target="_blank"></a>';
                }
                
                if (data.pic2) {
                    data.pic2 = '<img class="foreground" src="/images/parthners/resized/'+data.pic2+'?v='+data.tsUpdated+'" data-ratio="1">';
                } else {
                    data.pic2 = '';
                }

                speakerHtml = '<figure class="thumb fg-container">'+
                        '<div class="img-tags">'+
                            data.tags+
                            data.pic2+
                        '</div>'+
                        '<div class="icon-country '+data.country+'"></div>'+
                        '<img src="/images/speackers/resized/'+data.pic1+'?v='+data.tsUpdated+'" data-ratio="1">'+
                    '</figure>'+
                    '<p class="title">'+data.name+'<br>'+data.secondName+'</p>'+
                    '<div class="desc">'+
                        '<p>'+data.company+'<br>'+data.cityName+'<br><br>'+data.position+'</p>'+
                        data.description+
                        '<div class="speaker-icon">'+
                            linkHtml+
                        '</div>'+
                    '</div>';
                $('#speaker-modal .modal-body').html(speakerHtml);
                $('#speaker-modal .modal-body').removeAttr('class').addClass('modal-body').addClass(data.tagscss);
                $('#speaker-modal').modal('show');
            }
        }
    });
    return false;
});

$('#speaker-modal').on('hidden.bs.modal', function (e) {
    var modal = $(this);
    modal.find('.modal-body').html('');
});

$('.modal .nav-btn.prev').on('click', function() {
    $(this).parents('.modal.show').modal('hide');
    $(this).parents('.modal').prev('.modal').modal('show');
    //$('body').addClass('modal-open').css("padding-right", "17px");
    return false;
});
$('.modal .nav-btn.next').on('click', function() {
    $(this).parents('.modal.show').modal('hide');
    $(this).parents('.modal').next('.modal').modal('show');
    return false;
});

$('[id^="popover-win-"]').on('shown.bs.modal', function () {
    $('body').addClass('modal-open').css("padding-right", "17px");
});

$('#mk-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var type = button.data('type');
    var link = button.data('link');
    //var flag = button.data('flag');
    var format = button.data('format');
    var tags = button.data('tags');
    var title = button.data('title');
    //var partner = button.data('partner');
    //var name = button.data('name');
    //var secondName = button.data('second-name');
    var company = button.data('company');
    if (company != '') {
        company = company + ', ';
    }
    //var cityName = button.data('city-name');
    var desc = button.data('desc');
    var modal = $(this);

    if (type == 'video') {
        modal.find('.mk-teaser').html('<iframe style="width:100%" height="400" src="https://www.youtube.com/embed/'+link+'?rel=0&amp;amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>');
    }

    modal.find('.mk-format span').html(format);
    modal.find('p.title').html(title);
    modal.find('div.desc').html(desc);
    var src = modal.find('div.desc').find('iframe').data('src');
    modal.find('div.desc').find('iframe').attr('src', src);
    $('#mk-modal>div').removeAttr('class');
    $('#mk-modal>div').addClass('modal-dialog');
    $('#mk-modal>div').addClass('modal-md');
    modal.find('.modal-dialog').addClass(tags);
});

$('[data-toggle="tooltip"]').tooltip();

$('.socials-share>a').on('click', function() {
    $(this).parent().toggleClass('active');
    return false;
});

var mydiv1 = document.getElementById("popover_content");

$('.cashback-title').on('mousemove', function (e) {
    let x = e.pageX;
    let y = e.pageY;
    mydiv1.style.top = y + 'px';
    mydiv1.style.left = x + 'px';
});

$(function () {
    $('[data-toggle="popover"]').popover({
        //container: 'body',
        trigger: 'focus'
    });
    // Scroll Plugin
    $(window).scroll(function() {
        let scroll = $(window).scrollTop();
        if (scroll >= 20) {
            $(".main-page header").css({'background':'#000'});
        } else {
            $(".main-page header").css({'background':'transparent'});
        }
    });
});