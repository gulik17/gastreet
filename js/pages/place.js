$('#video-modal').on('hidden.bs.modal', function (e) {
    var modal = $(this);
    modal.find('iframe').attr('src', '');
    modal.find('#videoModalLabel').html('');
});

$('#video-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var link = button.data('link');
    var title = button.data('title');
    var modal = $(this);
    modal.find('iframe').attr('src', 'https://www.youtube.com/embed/' + link + '?rel=0&amp;showinfo=0');
    modal.find('#videoModalLabel').text(title);
});

$(function () {
    if ($('body').width() < 767) {
        $('[data-toggle="tooltip"]').attr("data-placement", "top");
    }
    $('[data-toggle="tooltip"]').tooltip();
});