$().ready(function() {
    $('#company_type').change();
    
});

$(document).on('change', '#company_type', function() {
    if ( $(this).val() === '2' ) { // юр.лицо
        $('#kpp').closest('.form-group').show();
        if ($('#countryName').val() == 'kz') {
            $('#inn').attr('maxlength', '12');
        } else {
            $('#inn').attr('maxlength', '10');
        }
    } else if ( $(this).val() === '3' ) { // ИП
        $('#kpp').closest('.form-group').hide();
        $('#inn').attr('maxlength', '12');
    }
});