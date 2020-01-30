    var isScrolled = false;

	$().ready(function()
	{
		var getLeftContent = $('#leftCol').html();
		var getDlgList = $('#inoutmsgdiv').html()
		if (getDlgList.indexOf("id") != -1)
            $('#leftCol').html(getDlgList);
        else
            $('#leftCol').html(getLeftContent);

        menuResize();

		var wbbOpt = {
				buttons: 'bold,italic,underline,fontsize,fontcolor,smilebox,|,bullist,numlist,|,img,video,link',
				allButtons: {
					quote: {
						transform: {
							'<div class="quote">{SELTEXT}</div>':'[quote]{SELTEXT}[/quote]',
							'<div class="quote"><cite>{AUTHOR} wrote:</cite>{SELTEXT}</div>':'[quote={AUTHOR}]{SELTEXT}[/quote]'
						}
					}
				},
				smilefind: "#smiley-box",
				smileList: [
					{title:CURLANG.sm1, img: '<img src="/images/smiles/sm1.png" class="sm">', bbcode:":)"},
					{title:CURLANG.sm1, img: '<img src="/images/smiles/sm2.png" class="sm">', bbcode:":D"},
					{title:CURLANG.sm3, img: '<img src="/images/smiles/sm3.png" class="sm">', bbcode:";)"},
					{title:CURLANG.sm4, img: '<img src="/images/smiles/sm4.png" class="sm">', bbcode:":up:"},
					{title:CURLANG.sm5, img: '<img src="/images/smiles/sm5.png" class="sm">', bbcode:":down:"},
					{title:CURLANG.sm6, img: '<img src="/images/smiles/sm6.png" class="sm">', bbcode:":shock:"},
					{title:CURLANG.sm7 ,img: '<img src="/images/smiles/sm7.png" class="sm">', bbcode:":angry:"},
					{title:CURLANG.sm8, img: '<img src="/images/smiles/sm8.png" class="sm">', bbcode:":("},
					{title:CURLANG.sm9, img: '<img src="/images/smiles/sm9.png" class="sm">', bbcode:":sick:"}
				]
		};

		$("#message").wysibb(wbbOpt);

        var pvtmessid = $(".unread-pvtmsg").last().attr("id");
        if (pvtmessid != undefined)
        {
            $('html, body').animate({
                scrollTop: $('#'+pvtmessid).offset().top
            }, 1000);
        }

	});

    // clickshprevmsg
    function getsomemessages(gotZlId)
    {
        // чистый id
        var pureZlArray = gotZlId.split("_");

        if (pureZlArray.length < 3)
            return false;

        var mindate = pureZlArray[1];
        var userid = pureZlArray[2];
        var dlgid = pureZlArray[3];
        var iteration = pureZlArray[4];

        // ajax запрос
        var gotdata = "mindate="+mindate+"&userid="+userid+"&dlgid="+dlgid+"&iteration="+iteration;

        // аяксом шлём запрос на получение лички в лэйауте blank
        $.ajax({
            type: "POST",
            dataType: "html",
            url: "/index.php?show=getsomemessages",
            data: gotdata,
            success: function(data)
            {
                if (data.length > 10)
                    $('.showprevmessgs').html(data);
                else
                    $('.showprevmessgs button').hide();

                return false;

            }

        });

    };

