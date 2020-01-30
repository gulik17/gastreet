var cropper = new MobileCropper("/app/avatar/tmp_img/1.jpg", 604, 376, {id: 'zhurchick'});
//var cropper = new MobileCropper("/app/avatar/tmp_img/2.jpg", 479, 604, {id: 'zhurchick'});

var mobileCropper_getResult = document.getElementById("mobileCropper_getResult");

mobileCropper_getResult.addEventListener('touchstart', function()
{
	var info = cropper.getInfo();

	this.innerHTML = 'originalWidth: '+ info.originalWidth +'<br>\
	originalHeight: '+ info.originalHeight +'<br>\
	workWidth: '+ info.workWidth +'<br>\
	workHeight: '+ info.workHeight +'<br>\
	thumbnailWidth: '+ info.thumbnailWidth +'<br>\
	thumbnailHeight: '+ info.thumbnailHeight +'<br>\
	x: '+ info.x +'<br>\
	y: '+ info.y;

}, false);

document.getElementById("mobileCropper_cancel").addEventListener('touchstart', function()
{
	cropper.cancel();

	mobileCropper_getResult.parentNode.removeChild(mobileCropper_getResult);
	this.parentNode.removeChild(this);

}, false);
