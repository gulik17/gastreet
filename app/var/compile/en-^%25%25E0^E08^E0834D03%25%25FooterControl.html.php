<?php /* Smarty version 2.6.13, created on 2020-01-10 17:07:24
         compiled from /home/c484884/gastreet.com/www/app/Templates/FooterControl.html */ ?>
<?php if (! $this->_tpl_vars['app']): ?>
<footer class="site-footer mt-auto" id="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <p class="phone"><a href="tel:88007009320">8 800 700 93 20</a> (Горячая линия)</p>
                <div class="entry">
                    <p>Gastreet — International Restaurant Show</p>
                    <p style="margin-bottom: 15px;"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The services are provided by «SIROKKO», LLC<br> INN 2320238493, OGRN 1162366052705<?php else: ?>Услуги оказывает ООО «СИРОККО»<br> ИНН 2320238493, ОГРН 1162366052705<?php endif; ?></p>
                    <div id="fb-root"></div>
                    <div class="fb-share-button" style="height:20px;" data-href="https://gastreet.com/" data-layout="button_count" data-size="small" data-mobile-iframe="true">
                        <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
                        <script src="//yastatic.net/share2/share.js"></script>
                        <div class="ya-share2" data-services="vkontakte,facebook" data-counter=""></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <ul class="app_icons">
                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <li class="badge appstore">
                        <a href="https://itunes.apple.com/ru/app/gastreet-int-restaurant-show/id1227431330?l=en" target="_blank">
                            <img src="/images/appstore_badge_en.svg">
                        </a>
                    </li>
                    <li class="badge googleplay">
                        <a href="https://play.google.com/store/apps/details?id=com.mercdev.gastreet.mercury.develios.custom" target="_blank">
                            <img src="/images/googleplay_badge_en.svg">
                        </a>
                    </li>
                    <?php else: ?>
                    <li class="badge appstore">
                        <a href="https://itunes.apple.com/ru/app/gastreet-int-restaurant-show/id1227431330?l=ru" target="_blank">
                            <img src="/images/appstore_badge_ru.svg">
                        </a>
                    </li>
                    <li class="badge googleplay">
                        <a href="https://play.google.com/store/apps/details?id=com.mercdev.gastreet.mercury.develios.custom" target="_blank">
                            <img src="/images/googleplay_badge_ru.svg">
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <p class="app_desc">Download our app <br>and become part of GASTREET Family</p>
                <?php else: ?>
                    <p class="app_desc">Скачай наше приложение <br>и&nbsp;стань частью GASTREET Family</p>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <ul>
                    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                    <li><a href="/payment" target="_blank">Payment Methods</a></li>
                    <li><a href="/oferta" target="_blank">Contract offer</a></li>
                    <li><a href="/policy" target="_blank">Privacy policy</a></li>
                    <li style="margin-top:1rem;"><a class="lang" href="?lang=ru">Русский</a></li>
                    <?php else: ?>
                    <li><a href="/payment" target="_blank">Способы оплаты</a></li>
                    <li><a href="/oferta" target="_blank">Договор оферта</a></li>
                    <li><a href="/policy" target="_blank">Политика конфиденциальности</a></li>
                    <li style="margin-top:1rem;"><a class="lang" href="?lang=en">English</a></li>
                    <?php endif; ?>
                </ul>
            </div>
<!--            <div class="col-md-12 text-center">-->
<!--                <img src="/images/logo3h.png" class="img-fluid" alt="Платежные системы">-->
<!--            </div>-->
        </div>
    </div>
</footer>
<?php endif; ?>