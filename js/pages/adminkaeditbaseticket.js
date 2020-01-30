$().ready(function()
{
    function rebuildProductIds() {
        var productIds = '';
        $('#products-left-select option').each(function(){
            productIds = '' + productIds + '' + this.value + ',';
        });
        $('#productIds').val(productIds);
    }

    $('#product-add-to-ticket').click(function (evt) {
        evt.preventDefault();
        var getProductValue = $('#products-right-select').val();
        var getProductText = $('#products-right-select option:selected').text();
        if (getProductValue) {
            $('#products-left-select').append($('<option>',
                {
                    value: getProductValue,
                    text: getProductText
                }));
            $("#products-right-select option[value='" + getProductValue + "']").remove();
            // rebuild productIds input (hidden)
            rebuildProductIds();
        }
    });

    $('#product-remove-from-ticket').click(function (evt) {
        evt.preventDefault();
        var getProductValue = $('#products-left-select').val();
        var getProductText = $('#products-left-select option:selected').text();
        if (getProductValue) {
            $('#products-right-select').append($('<option>',
                {
                    value: getProductValue,
                    text: getProductText
                }));
            $("#products-left-select option[value='" + getProductValue + "']").remove();
            // rebuild productIds input (hidden)
            rebuildProductIds();
        }
    });

    $('#annotation').fck({path: '/fckeditor/'});
    $('#description').fck({path: '/fckeditor/'});

    $('input').placeholder();

});
