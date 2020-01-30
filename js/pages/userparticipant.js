$().ready(function () {
    //$('[name=phone]').inputmask("phone");
    //$('[name=email]').inputmask("email");
    $("#countryName").change(function () {
        $('#cityName').attr('disabled', false);
        if ($(this).val() === "ru") {
            $('#cityName').hide();
            $('#secondCityName').show();
        } else {
            $('#secondCityName').hide();
            $('#cityName').show();
        }
    });
    $("#secondCityName").change(function () {
        $('#cityName').val($(this).val());
    });
});