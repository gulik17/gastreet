/**
 * Created by tim on 15.02.17.
 */

var avatar_img_original = '';
var avatar_img_final = '';

$(document).ready(function () {
    var deviceAgent = navigator.userAgent.toLowerCase();

    var isTouchDevice = Modernizr.touch ||
        (deviceAgent.match(/(iphone|ipod|ipad)/) ||
        deviceAgent.match(/(android)/) ||
        deviceAgent.match(/(iemobile)/) ||
        deviceAgent.match(/iphone/i) ||
        deviceAgent.match(/ipad/i) ||
        deviceAgent.match(/ipod/i) ||
        deviceAgent.match(/blackberry/i) ||
        deviceAgent.match(/bada/i));

    if (isTouchDevice) {
        if (window.location.href == 'https://gastreet.com/register?step=3') {
            window.location.href = 'https://gastreet.com/register?step=3&touch=1';
        } else {
            window.location.href = '/avatar?touch=1';
        }
    }

    $('.get-photo').on('click', function () {
        $('#photoimg').click();
    });

    // загрузка фото
    $('#photoimg').on('change', function () {
        $('.get-photo').removeClass('get-photo');
        var A = $("#imageloadstatus");
        var B = $("#imageloadbutton");

        $("#imageform").ajaxForm({
            beforeSubmit: function () {
                A.show();
                B.hide();
            },
            success: function (answer) {
                A.hide();
                B.show();

                var obj = $.parseJSON(answer);

                if (obj.result == "success") {
                    // загрузка основной фотографии
                    $(".sc-answer").html(obj.message);
                    if (obj.message == '') {

                        $('#tmpBlock').html('');
                        $('#blockScreen').show();

                        avatar_img_original = obj.img_original;
                        avatar_img_final = obj.img_final;

                        cropper.prepareImgToCrop(200, 200, 'app/avatar/' + avatar_img_final, obj.img_width, obj.img_height, {
                            id: 'tmpBlock', // ID блока куда будут помещены все блоки кроппинга
                            resize: 'saveProportions',
                            tools: false,
                            // preview: true,
                        });
                        avatar_img_final = avatar_img_final.split('/pre_').join('/use_pre_');
                    }
                }
                else if (answer.result == "error") {
                    $(".sc-answer").html(obj.message);
                }
            },
            error: function () {
                A.hide();
                B.show();
            }
        }).submit();
    });

    // отресайзили
    $('#owner_photo_done_edit').click(function () {
        $('#blockScreen').hide();
        var info = cropper.info;

        var sdata = 'img_original=' + avatar_img_original + '&img_final=' + avatar_img_final + '&offset_x=' + info.x + '&offset_y=' + info.y + '&info_w=' + info.w + '&info_h=' + info.h;
        // загрузить фото avatar_img_original заново с обрезкой в preview
        $.ajax({
            type: 'POST',
            url: "app/avatar/secondfiximg.php",
            cache: false,
            dataType: 'json',
            data: sdata,
            success: function (answer) {
                if (answer.result == "success") {
                    $("#preview").html("<img src=\"app/avatar/" + answer.img_final + "?" + $.now() + "\" class=\"imgList\">");
                    $(".img_original").val(answer.img_original);
                    $(".img_final").val(answer.img_final);
                    $(".sc-answer").html(answer.message);
                    $(".download").attr({href: "https://gastreet.com/app/avatar/download.php?file=" + answer.img_final});
                    $(".share .vk").attr({onclick: "Share.vkontakte('https://gastreet.com/','GASTREET - International Restaurant Show','https://gastreet.com/app/avatar/" + answer.img_final + "','Тут собираются лючшие рестораторы мира!')"});
                    $(".share .fb").attr({onclick: "Share.facebook('https://gastreet.com/','GASTREET - International Restaurant Show','https://gastreet.com/app/avatar/" + answer.img_final + "','Тут собираются лючшие рестораторы мира!')"});
                    $("#og_image").attr('content', "https://gastreet.com/app/avatar/" + answer.img_final);
                }
                else if (answer.result == "error") {
                    $(".sc-answer").html(answer.message);
                }
            }
        });
    });

    $('.gss-avatar-choose-ul').owlCarousel({
        margin:10,
        nav:true,
        dots:true,
        loop:true,
        responsive:{
            0:{items:1},
            600:{items:3}
        }
    });

    $('.prev .box a').click(function () {
        // клик на маску
        $('.prev .box a').removeClass("active");
        $(this).addClass("active");
        $("#imageform .img_layer").val($(this).children("img").attr("src"));

        if ($("#imageform .img_original").val() != "") {
            $("#preview").html("");
            var A = $("#imageloadstatus");
            var B = $("#imageloadbutton");
            var sdata = $("#imageform").serialize();
            $.ajax({
                type: 'POST',
                url: "app/avatar/fiximg.php",
                cache: false,
                dataType: 'json',
                data: sdata,
                beforeSend: function () {
                    A.show();
                    B.hide();
                },
                success: function (answer) {
                    A.hide();
                    B.show();
                    if (answer.result == "success") {
                        $("#preview").html("<img src=\"app/avatar/" + answer.img_final + "?" + $.now() + "\" class=\"imgList\">");
                        $(".img_original").val(answer.img_original);
                        $(".sc-answer").html(answer.message);
                        $(".download").attr({href: "https://gastreet.com/app/avatar/download.php?file=" + answer.img_final});
                        $(".share .vk").attr({onclick: "Share.vkontakte('https://gastreet.com/','GASTREET - International Restaurant Show','https://gastreet.com/app/avatar/" + answer.img_final + "','Тут собираются лючшие рестораторы мира!')"});
                        $(".share .fb").attr({onclick: "Share.facebook('https://gastreet.com/','GASTREET - International Restaurant Show','https://gastreet.com/app/avatar/" + answer.img_final + "','Тут собираются лючшие рестораторы мира!')"});
                        $("#og_image").attr('content', "https://gastreet.com/app/avatar/" + answer.img_final);
                    }
                    else if (answer.result == "error") {
                        $(".sc-answer").html(answer.message);
                    }
                }
            });
        }
    });
});
