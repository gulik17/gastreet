$().ready(function () {
    $('#edit-content').ketchup();
    $('#content, #content_en').fck({path: '/fckeditor/'});
});