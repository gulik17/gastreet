/**
 * Created by tim on 15.02.17.
 */

$().ready(function () {
    hideFormControl = function (val) {
        if (val == 'EMAIL') {
            $('#smsEl').hide();
            $('#messageEl').show();
            $('#subjectEl').show();
        }
        if (val == 'SMS') {
            $('#smsEl').show();
            $('#messageEl').hide();
            $('#subjectEl').hide();
        }
    };
    $('#message').fck({path: '/fckeditor/'});
    $('#type').change();
});