<?php /* Smarty version 2.6.13, created on 2019-12-18 10:52:14
         compiled from /home/c484884/gastreet.com/www/app/Templates/RegisterControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/RegisterControl.html', 8, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/RegisterControl.html', 107, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['RegisterControl']); ?>

<?php echo '
<script> gtag(\'event\', \'conversion\', {\'send_to\': \'AW-869423439/G4tVCLCX3G4Qz7LJngM\'}); </script>
'; ?>


<?php if ($this->_tpl_vars['this']['isItOldUser']): ?>
    <?php echo smarty_function_loadscript(array('file' => '/js/confetti.js','type' => 'js'), $this);?>

    <div id="is-old-user" class="container text-center">
        <h4>Привет <?php echo $this->_tpl_vars['this']['oldUser']['name']; ?>
!<br>
            Как круто, что ты снова с&nbsp;нами!<br>
            Этот салют в&nbsp;твою честь!</h4>
    </div>
    <br/><br/>
    <canvas width="1400" height="800" id="confetti" style="background:#fff;position:fixed;width:100%;height:100%;"></canvas>
    <?php echo '
    <script>
        window.onload = function () {
            var firework = JS_FIREWORKS.Fireworks({
                id : \'confetti\',
                hue : 120,
                particleCount : 120,
                delay : 0,
                minDelay : 20,
                maxDelay : 40,
                boundaries : {
                        top: 50,
                        bottom: 240,
                        left: 50,
                        right: 1400
                },
                fireworkSpeed : 2,
                fireworkAcceleration : 1.05,
                particleFriction : .95,
                particleGravity : 1.1
            });
            firework.start();
        };
    </script>
    '; ?>

<?php endif; ?>

<div class="register-page">
    <div class="row">
        <div class="col-md-12">
            <h1 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Registration<?php else: ?>Регистрация<?php endif; ?></h1>
            <ul class="breadcrumbs-register">
                <li><a href="/register" class="active"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 1<?php else: ?>Шаг 1<?php endif; ?></a></li>
                <li><a href="/register?step=2" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 2<?php else: ?>Шаг 2<?php endif; ?></a></li>
                <li><a href="/register?step=3" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 3<?php else: ?>Шаг 3<?php endif; ?></a></li>
                <li><a href="/register?step=4" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 4<?php else: ?>Шаг 4<?php endif; ?></a></li>
                <li><a href="/register?step=5" class="disabled"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Step 5<?php else: ?>Шаг 5<?php endif; ?></a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h3 class="header-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Data input<?php else: ?>Ввод данных<?php endif; ?></h3>
            <h4 class="form-title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>User Registration:<?php else: ?>Основной участник:<?php endif; ?></h4>
            <div class="row main-user-input-block<?php if ($this->_tpl_vars['this']['user']->email): ?> show<?php endif; ?>">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Name Surname<?php else: ?>Имя Фамилия<?php endif; ?></label>
                        <div class="form-control"><span><?php echo $this->_tpl_vars['this']['user']->name; ?>
 <?php echo $this->_tpl_vars['this']['user']->lastname; ?>
</span><a href="#" class="btn btn-link" data-toggle="modal" data-target=".user-modal-edit"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Edit data<?php else: ?>Редактировать<?php endif; ?></a></div>
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
" />
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
                <div class="col-md-6">
                    <a href="/register?step=2" class="btn btn-link"><i class="fa fa-arrow-right" aria-hidden="true"></i> <span><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Next step<?php else: ?>Продолжить<?php endif; ?></span></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="information">
                <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
                <?php else: ?>
                    <p class="title">ИНФОРМАЦИЯ</p>
                    <p>Внимательно заполни все поля анкеты. Если ты едешь не один – заполни поля остальных участников. Важно – укажи свои корректные данные номера телефона и почты, а&nbsp;также остальных участников. Благодаря этому, ты будешь получать эксклюзивную и&nbsp;важную информацию о&nbsp;событиях GASTREET'20 в&nbsp;режиме реального времени.</p>
                    <p>Как только ты все закончишь, проверь еще раз и&nbsp;нажми кнопку «ПРОДОЛЖИТЬ».</p>
                <?php endif; ?>
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
                                    <label for="reg_born"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Date of Birth<?php else: ?>Дата рождения<?php endif; ?></label>
                                    <input class="form-control" autocomplete="off" id="reg_born" name="tsBorn" type="text" value="<?php echo $this->_tpl_vars['this']['user']->tsBorn; ?>
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
                                    <input type="hidden" id="countryName" name="countryName" value="<?php echo $this->_tpl_vars['this']['user']->countryName; ?>
">
                                    <input type="hidden" id="cityName" name="cityName" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
">
                                    <label for="tmpaddress">Город</label>
                                    <input class="form-control" type="text" id="tmpaddress" name="tmpaddress" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
" autocomplete="off" maxlength="100">
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