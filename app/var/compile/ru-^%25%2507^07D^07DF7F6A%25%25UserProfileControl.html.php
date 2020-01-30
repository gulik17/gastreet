<?php /* Smarty version 2.6.13, created on 2019-12-19 10:57:15
         compiled from /home/c484884/gastreet.com/www/app/Templates/UserProfileControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/UserProfileControl.html', 25, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/UserProfileControl.html', 102, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserProfileControl']); ?>

<div class="row">
    <div class="col-md-9">
        <form action="" id="user_profile" method="post">
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['actor']->id; ?>
">
            <input type="hidden" id="reg_company" name="company" value="<?php echo $this->_tpl_vars['actor']->company; ?>
">
            <h3 class="title mb-4">Заполните учетную запись</h3>
            <div class="row">
                <div class="col-md-6">
                    <h6 class="mb-3">Откуда вы</h6>
                    <div class="form-group">
                        <input type="hidden" id="countryName" name="countryName" value="<?php echo $this->_tpl_vars['actor']->countryName; ?>
">
                        <input type="hidden" id="cityName" name="cityName" value="<?php echo $this->_tpl_vars['actor']->cityName; ?>
">
                        <label for="tmpaddress">Город</label>
                        <input class="form-control" type="text" id="tmpaddress" name="tmpaddress" value="<?php echo $this->_tpl_vars['actor']->cityName; ?>
" autocomplete="off" maxlength="100">
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="mb-3">Чем занимаетесь</h6>
                    <div class="form-group">
                        <label for="reg_position">Роль в бизнесе</label>
                        <select class="form-control chosen-select" id="reg_position" name="position">
                            <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?> --</option>
                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['position'],'output' => $this->_tpl_vars['this']['position'],'selected' => $this->_tpl_vars['actor']->position), $this);?>

                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h6 class="mb-3">Информация о компании</h6>
                    <div class="alert alert-info d-flex" style="align-items:center;justify-content:space-between;">
                        <div class="pr-5 text-left company_info">
                            <p><?php echo $this->_tpl_vars['this']['detail']->company; ?>
</p>
                            <p>ИНН: <?php echo $this->_tpl_vars['this']['detail']->inn; ?>
, КПП: <?php echo $this->_tpl_vars['this']['detail']->kpp; ?>
</p>
                            <p><?php echo $this->_tpl_vars['this']['detail']->address; ?>
</p>
                        </div>
                        <div>
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#dadataOrganizationModal">Изменить</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-12">
                    <h6 class="mb-3">Ваши данные</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reg_lastname">Фамилия</label>
                                <input class="form-control" type="text" id="reg_lastname" name="lastname" value="<?php echo $this->_tpl_vars['actor']->lastname; ?>
" autocomplete="off" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reg_name">Имя</label>
                                <input class="form-control" type="text" id="reg_name" name="name" value="<?php echo $this->_tpl_vars['actor']->name; ?>
" autocomplete="off" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reg_name">Дата рождения</label>
                                <input class="form-control" type="text" id="reg_born" name="tsBorn" value="<?php echo $this->_tpl_vars['actor']->tsBorn; ?>
" autocomplete="off" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reg_usersize">Размер одежды</label>
                                <select class="form-control chosen-select" id="reg_usersize" name="usersize">
                                    <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing Size<?php else: ?>Размер одежды<?php endif; ?> --</option>
                                    <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['userSize'],'output' => $this->_tpl_vars['this']['userSize'],'selected' => $this->_tpl_vars['actor']->userSize), $this);?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-12">
                    <h6 class="mb-3">Как связаться</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Мобильный телефон</label>
                                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo $this->_tpl_vars['actor']->phone; ?>
" autocomplete="off" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="reg_email">E-mail</label>
                                <input class="form-control" type="text" id="reg_email" name="email" value="<?php echo $this->_tpl_vars['actor']->email; ?>
" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12">
                    <hr>
                </div>
                <div class="col-md-9">
                    <label for="check_policy" class="mb-3">
                        <input id="check_policy" class="" value="1" type="checkbox">
                        Согласие с <a href="<?php echo smarty_function_link(array('show' => 'policy'), $this);?>
" target="_blank">Политикой конфиденциальности</a>
                    </label>
                </div>
                <div class="col-md-3">
                <button type="submit" class="btn btn-black" id="reg_save">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <div class="alert">
            <div id="applepay_btn"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="fulllogconsole"></div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="dadataOrganizationModal" tabindex="-1" role="dialog" aria-labelledby="dadataOrganizationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dadataOrganizationModalLabel">Выбрать огранизацию</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tmpinn">ИНН или название организации</label>
                                <input class="form-control" type="text" id="tmpinn" name="tmpinn" value="<?php echo $this->_tpl_vars['this']['detail']->inn; ?>
" autocomplete="off" maxlength="100">
                                <input type="hidden" name="tmp_company" value="<?php echo $this->_tpl_vars['this']['detail']->company; ?>
">
                                <input type="hidden" name="tmp_inn" value="<?php echo $this->_tpl_vars['this']['detail']->inn; ?>
">
                                <input type="hidden" name="tmp_kpp" value="<?php echo $this->_tpl_vars['this']['detail']->kpp; ?>
">
                                <input type="hidden" name="tmp_address" value="<?php echo $this->_tpl_vars['this']['detail']->address; ?>
">
                                <input type="hidden" name="tmp_company_type" value="<?php echo $this->_tpl_vars['this']['detail']->company_type; ?>
">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-white btn-tmpinn-save">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<?php echo '
<script>
    if (window.ApplePaySession) {
        let merchantIdentifier = "merchant.com.gastreet";
        let promise = ApplePaySession.canMakePaymentsWithActiveCard(merchantIdentifier);
        console.log(promise);
        promise.then(function (canMakePayments) {
      //      if (canMakePayments) {
                let btn = document.getElementById("applepay_btn");
                btn.innerHTML = "<button lang=\\"ru\\" onclick=\\"javascript:startApplePaySession()\\" style=\\"-webkit-appearance: -apple-pay-button; -apple-pay-button-type: buy;\\" class=\\"apple-pay-button apple-pay-button-white\\"></button>";
       //     }
        });
    }
</script>
'; ?>




