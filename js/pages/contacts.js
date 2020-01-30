$('.contacts-tabs a').on('click', function (e) {
    var target = $(this).data('target');
    $('.contacts-tabs-item, .contacts-tabs a').removeClass('active');
    $(this).addClass('active');
    $(target).addClass('active');
    return false;
});