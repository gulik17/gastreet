$(document).ready(function () {

    function GetPad(ev)
    {
        var x1=0, x2=0, x3=0, y1=0, y2=0, y3=0;

        if (document.all)
        {
            x = (document.documentElement && document.documentElement.scrollLeft) ? document.documentElement.scrollLeft : document.body.scrollLeft;
            y = (document.documentElement && document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
            x += window.event.clientX;
            y += window.event.clientY;
        }
        else
        {
            x = ev.pageX;
            y = ev.pageY;
        }

        x1=x2; x2=x3; x3=x;
        y1=y2; y2=y3; y3=y;

        var IsPad = false;
        if (x1>0 && x2>0 && x3>0 && y1>0 && y2>0 && y3>0) {
            IsPad = true;
        }

        return IsPad;
    }


    alert('ready');

    if (GetPad(null)) {
        alert('pad');
    }
    else {
        alert('mouse');
    }


});
