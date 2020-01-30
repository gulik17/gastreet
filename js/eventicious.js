!function (e) {
    "use strict";
    var eventId = Native.getEventId();
    var profile = Native.getProfile(eventId);
    var jsonData = jQuery.parseJSON(JSON.stringify(profile));

    document.location.href='/index.php?do=userlogin&phone='+jsonData.phone+'&email='+jsonData.email+'&code=appEventicious';
}(jQuery);
