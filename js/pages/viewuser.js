	$().ready(function()
	{
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

	});

