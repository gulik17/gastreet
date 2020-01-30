$().ready(function () {
    $('input').placeholder();
    /*
     var obj = jQuery.parseJSON( '{ "name": "John" }' );
     alert( obj.name === "John" );
     http://api.jquery.com/jquery.parsejson/
     */
    var dataString = $('#reportdatasummaryusers').html();
    if (dataString) {
        var dataArray = JSON.parse(dataString);
        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: dataArray,
            // The name of the data record attribute that contains x-values.
            xkey: 'day',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['a', 'b'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['New users', 'Registered users']
        });
    }
});
