/**
 * Управление раскладкой страницы
 */

jQuery(document).ready(function ($) {
    var FIX_SITE_HEADER_MIN_WIDTH = 1200; // Минимальная ширина вьюпорта для фиксирования шапки
    var CORRECTION_WIDTH = 30;

    var rebuildAvararSize = function () {
        var avatarWidth = $('.block_left').width();
        $('.block_left').height(avatarWidth);
    };

    var rebuildCapSlides = function () {
        if ( $(".capslide_img_cont3").length > 0 ) {
            $(".capslide_img_cont3").capslide({
                caption_color: '#fff',
                caption_bgcolor: 'rgba(10, 10, 10, 0.9)',
                overlay_bgcolor: '#111',
                border: '',
                showcaption: true
            });
        }
    };

    var listenResize = function () {
        rebuildAvararSize();
    };

    jQuery(window).load(function () {
        rebuildCapSlides();
        rebuildAvararSize();
        $(window).bind('resize', listenResize);
    });
    
    $('div[id^="popover-win-"]').on('show.bs.modal', function () {
        var modal = $(this);
        var src = modal.find('iframe').data('src');

        modal.find('iframe').attr('src', src);
    });
    
    
    $('.dropdown-year a.dropdown-item').on('click', function (e) {
        e.preventDefault();
        $('.volunteer-filter input[name=year]').val($(this).text());
        $('.volunteer-filter').submit();
    });
    
    $('.dropdown-city a.dropdown-item').on('click', function (e) {
        e.preventDefault();
        $('.volunteer-filter input[name=city]').val($(this).text());
        $('.volunteer-filter').submit();
    });
    
    $('.dropdown-position a.dropdown-item').on('click', function (e) {
        e.preventDefault();
        $('.volunteer-filter input[name=position]').val($(this).text());
        $('.volunteer-filter').submit();
    });
    
    //volunteer-filter

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

