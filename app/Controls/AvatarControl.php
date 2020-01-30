<?php

/**
 * Контрол страницы создания аватаров
 * layout = index.html
 */
class AvatarControl extends IndexControl {
    public $pageTitle = "Создай Аватар, поделить им в FaceBook и Вконтакте — GASTREET 2020";

    public function render() {
        $this->controlName = "Аватар";
        $touch = Request::getInt('touch');
        $this->addData("touch", $touch);

        //Enviropment::redirect("/");
        
        $this->includedJS .= Enviropment::loadScript('/js/jquery.form.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/js/cropper.js', 'js');
        $this->includedJS .= Enviropment::loadScript('/app/avatar/js/share.js', 'js');

        if ($touch) {
            $this->template = "AvatarMobileControl.html";
            $this->includedJS .= Enviropment::loadScript('/app/avatar/js/mainmobile.js', 'js');
        } else {
            $this->includedJS .= Enviropment::loadScript('/app/avatar/js/main.js', 'js');
        }
    }
}