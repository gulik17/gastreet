<?php /* Smarty version 2.6.13, created on 2019-11-28 20:07:42
         compiled from /home/c484884/gastreet.com/www/app/Templates/AvatarControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/AvatarControl.html', 2, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['AvatarControl']); ?>
<?php echo smarty_function_loadscript(array('file' => 'app/avatar/css/style.css','type' => 'css'), $this);?>


<div id="blockScreen" style="text-align:center; display: none;">
    <div class="popup_box_container" style="min-width: 600px;display: inline-block; height: auto; margin-top: 10px;">
        <div class="box_layout">
            <div class="box_title_wrap box_grey">
                <div class="box_title">Вы можете выбрать область</div>
            </div>
            <div class="box_body box_no_buttons" style="display: block; padding: 0px; position: relative;">
                <div class="owner_photo_box ">
                    <div id="owner_photo_edit">
                        <div class="owner_photo_content">
                            <div class="owner_photo_thumb no_rotate" id="owner_photo_thumb">
                                <div id="tmpBlock"></div>
                            </div>
                            <div class="owner_photo_controls">
                                <button class="flat_button" id="owner_photo_done_edit">Загрузить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="page-container" id="page-container">
        <div class="gss-avatar row">
            <div class="col-md-5">
                <div class="block_left">
                    <div id="preview">
                        <img class="get-photo" src="app/avatar/layer/no-img-2.png">
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="hidden">
                    <div class="gss-avatar-upl-text h2">Загрузите фотографию</div>
                    <form id="imageform" method="post" action="app/avatar/ajaxImageUpload.php" style="clear:both">
                        <div id="imageloadstatus" style="display:none;"><img src="app/avatar/loader.gif" style="width: 100%;" alt="Uploading...."/></div>
                        <div id="imageloadbutton">
                            <div class="file_upload">
                                <button type="button">Выбрать фото<br><p style="font-size: 5pt;margin-top:3px;">(не более 10 Мбайт)</p></button>
                                <input type="file" name="photos[]" id="photoimg" />
                            </div>
                            <input type="hidden" name="img_original" class="img_original" /> <!-- Путь к оригиналу -->
                            <input type="hidden" name="img_final" class="img_final" /> <!-- Путь к обработанному изображению -->
                            <input type="hidden" name="img_layer" class="img_layer" value="app/avatar/layer/01.png" /> <!-- Путь к слою -->
                        </div>
                        <div class="sc-answer"></div>
                    </form>
                </div>
                <div class="block_right">
                    <div class="prev">
                        <div class="gss-avatar-choose-text h2 pt-3">Выберите фильтр</div>
                        <div class="box">
                            <ul class="gss-avatar-choose-ul owl-carousel owl-theme">
                                <li><a href="#" class="active"><img src="app/avatar/layer/01.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/02.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/03.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/04.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/05.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/06.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/07.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/08.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/09.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/10.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/11.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/12.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/13.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/14.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/15.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/16.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/17.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/18.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/19.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/20.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/21.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/22.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/23.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/24.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/25.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/26.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/27.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/28.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/29.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/30.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/31.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/32.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/33.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/34.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/35.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/36.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/37.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/38.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/39.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/40.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/41.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/42.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/43.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/44.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/45.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/46.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/47.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/48.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/49.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/50.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/51.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/52.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/53.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/54.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/55.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/56.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/57.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/58.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/59.png"></a></li>
                                <li><a href="#" class=""><img src="app/avatar/layer/60.png"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <div class="gss-avatar-share-text h2">Скачайте фотографию</div>
                        <div class="share">
                            <a class="download" href="app/avatar/download.php?file=">Скачать фото</a>
                            <a class="vk" href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
                            <a class="fb" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>