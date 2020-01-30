<?php /* Smarty version 2.6.13, created on 2019-12-18 11:01:07
         compiled from /home/c484884/gastreet.com/www/app/Templates/Basket2Control.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/Basket2Control.html', 92, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['BasketControl']); ?>
<?php $this->assign('total', 0); ?>

<?php $this->assign('showBronButton', 0); ?>
<?php $this->assign('showBronProductButton', 0); ?>

<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
    <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/869423439/?label=G4tVCLCX3G4Qz7LJngM&amp;guid=ON&amp;script=0"/>
    </div>
</noscript>

<div class="alert alert-info hidden" role="alert"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Hotel booking will be available January 15, 2018<?php else: ?>Бронирование отелей будет доступно 15 января 2018 года<?php endif; ?></div>

<div class="gss-basket register-page">
    <div class="row">
        <div class="col-md-12">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Members<?php else: ?>Участники<?php endif; ?></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2">
            <div class="list-group tab-menu">
                <a href="/basket?q=2" class="list-group-item list-group-item-action active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Members<?php else: ?>Участники<?php endif; ?></a>
                <a href="/basket?q=3" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose a main ticket<?php else: ?>Выбрать основной билет<?php endif; ?></a>
                <a href="/basket?q=4" class="list-group-item list-group-item-action d-none"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Choose additional options<?php else: ?>Выбрать доп. услуги<?php endif; ?></a>
                <a href="/basket" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pay<?php else: ?>Оплатить участие<?php endif; ?></a>
                <a href="/basket?q=5" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Print the ticket<?php else: ?>Распечатать билет<?php endif; ?></a>
                <a href="/basket?q=6" class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add promo-code<?php else: ?>Ввести промо-код<?php endif; ?></a>
                <a href="/presentation" class="list-group-item list-group-item-action">Презентации</a>
                <?php if (1 == 2): ?>
                    <?php if ($this->_tpl_vars['this']['comItem'] == 'STATUS_ENABLED'): ?>
                        <span class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><i class="fa fa-check" aria-hidden="true"></i> You passed test<?php else: ?><i class="fa fa-check" aria-hidden="true"></i> Вы прошли тест<?php endif; ?></span>
                    <?php elseif ($this->_tpl_vars['this']['comItem'] == 'STATUS_DISABLED'): ?>
                        <span class="list-group-item list-group-item-action"><?php if ($this->_tpl_vars['lang'] == 'en'): ?><i class="fa fa-times" aria-hidden="true"></i> You did`t pass test<?php else: ?><i class="fa fa-times" aria-hidden="true"></i> Вы не прошли тест<?php endif; ?></span>
                    <?php else: ?>
                        <a href="#" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#testModal"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Pizza Championship<?php else: ?>Чемпионат по пицце<?php endif; ?></a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>User Registration:<?php else: ?>Основной участник:<?php endif; ?></h4>
            <div class="row main-user-input-block<?php if ($this->_tpl_vars['this']['user']->email): ?> show<?php endif; ?>">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Name Surname<?php else: ?>Имя Фамилия<?php endif; ?></label>
                        <div class="form-control"><span><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
</span><a href="#" data-toggle="modal" data-target=".user-modal-edit" class="btn btn-link"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Edit data<?php else: ?>Редактировать<?php endif; ?></a></div>
                    </div>
                </div>
            </div>

            <div class="row participant_additional<?php if ($this->_tpl_vars['this']['children']): ?> show<?php endif; ?>">
                <div class="col-md-12">
                    <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Additional members<?php else: ?>Дополнительные участники<?php endif; ?>:</h4>
                </div>
                <?php if ($this->_tpl_vars['this']['children']): ?>
                    <?php $_from = $this->_tpl_vars['this']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['childid'] => $this->_tpl_vars['child']):
?>
                        <div class="col-md-12" id="participant_edit_<?php echo $this->_tpl_vars['child']->id; ?>
">
                            <div class="form-group">
                                <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Name Surname<?php else: ?>Имя Фамилия<?php endif; ?></label>
                                <div class="form-control"><span><?php echo $this->_tpl_vars['child']->name; ?>
 <?php echo $this->_tpl_vars['child']->lastname; ?>
</span><a href="#" data-id="<?php echo $this->_tpl_vars['child']->id; ?>
" class="btn btn-link edit-user"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Edit data<?php else: ?>Редактировать<?php endif; ?></a></div>
                            </div>
                        </div>
                        <div id="participant_<?php echo $this->_tpl_vars['child']->id; ?>
" class="col-md-12 participant_edit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Name<?php else: ?>Имя<?php endif; ?></label>
                                        <input class="form-control" autocomplete="off" name="name" type="text" value="<?php echo $this->_tpl_vars['child']->name; ?>
" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Surname<?php else: ?>Фамилия<?php endif; ?></label>
                                        <input class="form-control" autocomplete="off" name="lastname" type="text" value="<?php echo $this->_tpl_vars['child']->lastname; ?>
" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input class="form-control" autocomplete="off" name="email" type="text" value="<?php echo $this->_tpl_vars['child']->email; ?>
" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing size<?php else: ?>Размер одежды<?php endif; ?></label>
                                        <select class="form-control chosen-select" name="usersize">
                                            <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing size<?php else: ?>Размер одежды<?php endif; ?> --</option>
                                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['userSize'],'output' => $this->_tpl_vars['this']['userSize'],'selected' => $this->_tpl_vars['child']->userSize), $this);?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Company<?php else: ?>Компания<?php endif; ?></label>
                                        <input class="form-control" autocomplete="off" name="company" type="text" value="<?php echo $this->_tpl_vars['child']->company; ?>
">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?></label>
                                        <select class="form-control chosen-select" name="position">
                                            <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?> --</option>
                                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['position'],'output' => $this->_tpl_vars['this']['position'],'selected' => $this->_tpl_vars['child']->position), $this);?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="country" value="<?php echo $this->_tpl_vars['child']->countryName; ?>
">
                                        <input type="hidden" name="city" value="<?php echo $this->_tpl_vars['child']->cityName; ?>
">
                                        <label>Город</label>
                                        <input class="form-control" type="text" id="tmp_edit_city" name="tmp_edit_city" value="<?php echo $this->_tpl_vars['child']->cityName; ?>
" autocomplete="off" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-submit">
                                        <button data-id="<?php echo $this->_tpl_vars['child']->id; ?>
" class="btn btn-white reg_edit_user" type="submit"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Save<?php else: ?>Сохранить<?php endif; ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </div>

            <div class="row participant_add">
                <div class="col-md-12">
                    <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Additional member<?php else: ?>Дополнительный участник<?php endif; ?>:</h4>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Name<?php else: ?>Имя<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" name="name" type="text" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Surname<?php else: ?>Фамилия<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" name="lastname" type="text" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Phone<?php else: ?>Телефон<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" name="phone" type="text" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" autocomplete="off" name="email" type="text" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing size<?php else: ?>Размер одежды<?php endif; ?></label>
                        <select class="form-control chosen-select" name="usersize">
                            <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing size<?php else: ?>Размер одежды<?php endif; ?> --</option>
                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['userSize'],'output' => $this->_tpl_vars['this']['userSize']), $this);?>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Company<?php else: ?>Компания<?php endif; ?></label>
                        <input class="form-control" autocomplete="off" name="company" type="text" value="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?></label>
                        <select class="form-control chosen-select" name="position">
                            <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?> --</option>
                            <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['position'],'output' => $this->_tpl_vars['this']['position']), $this);?>

                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="country" value="">
                        <input type="hidden" name="city" value="">
                        <label>Город</label>
                        <input class="form-control" type="text" id="tmp_add_city" name="tmp_add_city" value="" autocomplete="off" maxlength="100">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-submit">
                        <button id="reg_add_user" class="btn btn-white" type="submit"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add User<?php else: ?>Добавить<?php endif; ?></button>
                    </div>
                </div>
            </div>
            <div class="row buttons<?php if ($this->_tpl_vars['this']['user']->email): ?> show<?php endif; ?>">
                <div class="col-md-6">
                    <a href="#" class="btn btn-link" id="add_new"><i class="fa fa-plus" aria-hidden="true"></i> <span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Add a member<?php else: ?>Добавить участника<?php endif; ?></span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade user-modal-edit" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reg_name"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Name<?php else: ?>Имя<?php endif; ?></label>
                                    <input class="form-control" autocomplete="off" id="reg_name" name="name" type="text" value="<?php echo $this->_tpl_vars['this']['user']->name; ?>
" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reg_lastname"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Surname<?php else: ?>Фамилия<?php endif; ?></label>
                                    <input class="form-control" autocomplete="off" id="reg_lastname" name="lastname" type="text" value="<?php echo $this->_tpl_vars['this']['user']->lastname; ?>
" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reg_email">E-mail</label>
                                    <input class="form-control" autocomplete="off" id="reg_email" name="email" type="text" value="<?php echo $this->_tpl_vars['this']['user']->email; ?>
" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reg_usersize"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing size<?php else: ?>Размер одежды<?php endif; ?></label>
                                    <select class="form-control chosen-select" id="reg_usersize" name="usersize">
                                        <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Clothing size<?php else: ?>Размер одежды<?php endif; ?> --</option>
                                        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['userSize'],'output' => $this->_tpl_vars['this']['userSize'],'selected' => $this->_tpl_vars['this']['user']->userSize), $this);?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reg_company"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Company<?php else: ?>Компания<?php endif; ?></label>
                                    <input class="form-control" autocomplete="off" id="reg_company" name="company" type="text" value="<?php echo $this->_tpl_vars['this']['user']->company; ?>
" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reg_position"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?></label>
                                    <select class="form-control chosen-select" id="reg_position" name="position">
                                        <option value="">-- <?php if ($this->_tpl_vars['lang'] == 'en'): ?>Position<?php else: ?>Должность<?php endif; ?> --</option>
                                        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['position'],'output' => $this->_tpl_vars['this']['position'],'selected' => $this->_tpl_vars['this']['user']->position), $this);?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" id="countryName" name="countryName" value="<?php echo $this->_tpl_vars['this']['user']->countryName; ?>
">
                                    <input type="hidden" id="cityName" name="cityName" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
">
                                    <label for="tmpaddress">Город</label>
                                    <input class="form-control" type="text" id="tmpaddress" name="tmpaddress" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
" autocomplete="off" maxlength="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Cancel<?php else: ?>Отмена<?php endif; ?></button>
                    <button type="submit" id="reg_save" class="btn btn-white"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Save<?php else: ?>Сохранить<?php endif; ?></button>
                </div>
            </div>
        </div>
    </div>
</div>