$().ready(function()
{
    function rebuildBaseTicketIds() {
        var baseTicketIds = '';
        $('#basetickets-left-select option').each(function(){
            baseTicketIds = '' + baseTicketIds + '' + this.value + ',';
        });
        $('#baseTicketIds').val(baseTicketIds);
    }

    function rebuildAreaIds() {
        var areaIds = '';
        $('#areas-left-select option').each(function(){
            areaIds = '' + areaIds + '' + this.value + ',';
        });
        $('#areaIds').val(areaIds);
    }

    $('#baseticket-add-to-discount').click(function (evt) {
        evt.preventDefault();
        var getBaseTicketValue = $('#basetickets-right-select').val();
        var getBaseTicketText = $('#basetickets-right-select option:selected').text();
        if (getBaseTicketValue) {
            $('#basetickets-left-select').append($('<option>',
                {
                    value: getBaseTicketValue,
                    text: getBaseTicketText
                }));
            $("#basetickets-right-select option[value='" + getBaseTicketValue + "']").remove();
            // rebuild baseTicketIds input (hidden)
            rebuildBaseTicketIds();
        }
    });

    $('#baseticket-remove-from-discount').click(function (evt) {
        evt.preventDefault();
        var getBaseTicketValue = $('#basetickets-left-select').val();
        var getBaseTicketText = $('#basetickets-left-select option:selected').text();
        if (getBaseTicketValue) {
            $('#basetickets-right-select').append($('<option>',
                {
                    value: getBaseTicketValue,
                    text: getBaseTicketText
                }));
            $("#basetickets-left-select option[value='" + getBaseTicketValue + "']").remove();
            // rebuild baseTicketIds input (hidden)
            rebuildBaseTicketIds();
        }
    });

    $('#area-add-to-discount').click(function (evt) {
        evt.preventDefault();
        var getAreaValue = $('#areas-right-select').val();
        var getAreaText = $('#areas-right-select option:selected').text();
        if (getAreaValue) {
            $('#areas-left-select').append($('<option>',
                {
                    value: getAreaValue,
                    text: getAreaText
                }));
            $("#areas-right-select option[value='" + getAreaValue + "']").remove();
            // rebuild areaIds input (hidden)
            rebuildAreaIds();
        }
    });

    $('#area-remove-from-discount').click(function (evt) {
        evt.preventDefault();
        var getAreaValue = $('#areas-left-select').val();
        var getAreaText = $('#areas-left-select option:selected').text();
        if (getAreaValue) {
            $('#areas-right-select').append($('<option>',
                {
                    value: getAreaValue,
                    text: getAreaText
                }));
            $("#areas-left-select option[value='" + getAreaValue + "']").remove();
            // rebuild areaIds input (hidden)
            rebuildAreaIds();
        }
    });

    $('input').placeholder();
    $('#form').ketchup();

});
