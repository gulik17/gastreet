$().ready(function()
{
    $('input').placeholder();

    var checkReports = function () {
        $('.gss-big-report').each(function(){
            var reportId = $(this).attr("id").split("bgrp-").join("");
            if (reportId) {
                // ajax запрос
                var gotdata = "id="+reportId;

                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "/adminka/index.php?do=admincheckreport",
                    data: gotdata,
                    success: function(data)
                    {
                        if (data == 'noid') {
                            $('#bgrp-' + reportId).removeClass('gss-big-report');
                        }
                        else if (data == 'noreport') {
                            $('#bgrp-' + reportId).removeClass('gss-big-report');
                        }
                        else if (data == 'generated') {
                            $('#bgrp-' + reportId).html('Сформирован');
                            $('#bgrp-' + reportId + '-link').show();
                            $('#bgrp-' + reportId).removeClass('gss-big-report');
                        }
                        else {
                            var percent = parseInt(data);
                            $('#bgrp-' + reportId).html('Формируется ... ' + percent + '%');
                        }

                        return false;

                    }

                });

            }

        });

        setTimeout(function() {
            checkReports();
        }, 3000);

    };

    setTimeout(function() {
        checkReports();
    }, 3000);

});
