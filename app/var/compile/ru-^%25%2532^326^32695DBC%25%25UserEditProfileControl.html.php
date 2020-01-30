<?php /* Smarty version 2.6.13, created on 2019-11-29 03:47:57
         compiled from /home/c484884/gastreet.com/www/app/Templates/UserEditProfileControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/UserEditProfileControl.html', 2, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/UserEditProfileControl.html', 5, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/UserEditProfileControl.html', 39, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserEditProfileControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "user-register"), $this);?>


<div class="gss-userdetails">
    <form action="<?php echo smarty_function_link(array('do' => 'usereditprofile'), $this);?>
" id="user-register" method="post">
        <input type="hidden" name="usertype" value="<?php echo $this->_tpl_vars['this']['user']->typeId; ?>
" />
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['user']->id; ?>
" />
        <h2 class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Editing Profile<?php else: ?>Редактирование профиля<?php endif; ?>:</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lastname">Фамилия:</label>
                    <input class="form-control" type="text" id="lastname" name="lastname" value="<?php echo $this->_tpl_vars['this']['user']->lastname; ?>
" maxlength="255" />
                </div>
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input class="form-control" type="text" id="name" name="name" value="<?php echo $this->_tpl_vars['this']['user']->name; ?>
" maxlength="255" />
                </div>
                <div class="form-group">
                    <label for="email">E-MAIL:</label>
                    <input class="form-control" type="text" id="email" name="email" value="<?php echo $this->_tpl_vars['this']['user']->email; ?>
" maxlength="100" />
                </div>
                <div class="form-group">
                    <label for="usertype"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Account type<?php else: ?>Тип учётной записи<?php endif; ?>:</label>
                    <select id="usertype" name="usertype" class="form-control">
                        <option disabled selected style='display:none' value="">Тип учётной записи</option>
                        <option value="8"<?php if ($this->_tpl_vars['this']['user']->typeId == 8): ?> selected<?php endif; ?>>Я из бара</option>
                        <option value="9"<?php if ($this->_tpl_vars['this']['user']->typeId == 9): ?> selected<?php endif; ?>>Я из ресторана</option>
                        <option value="10"<?php if ($this->_tpl_vars['this']['user']->typeId == 10): ?> selected<?php endif; ?>>Я с кухни</option>
                        <option value="11"<?php if ($this->_tpl_vars['this']['user']->typeId == 11): ?> selected<?php endif; ?>>Я даю деньги</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="countryName">Страна:</label>
                    <select class="form-control" id="countryName" name="countryName">
                        <option value="">-- Страна --</option>
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['country'],'selected' => $this->_tpl_vars['this']['user']->countryName), $this);?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="cityName">Город:</label>
                    <?php if ($this->_tpl_vars['this']['user']->countryName == 'ru'): ?>
                    <select class="form-control" id="secondCityName">
                        <option value="">-- Город --</option>
                        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['city'],'output' => $this->_tpl_vars['this']['city'],'selected' => $this->_tpl_vars['this']['user']->cityName), $this);?>

                    </select>
                    <input class="form-control" type="text" style="display:none" id="cityName" name="cityName" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
" maxlength="100" />
                    <?php else: ?>
                    <select class="form-control" style="display:none" id="secondCityName">
                        <option value="">-- Город --</option>
                        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['this']['city'],'output' => $this->_tpl_vars['this']['city'],'selected' => $this->_tpl_vars['this']['user']->cityName), $this);?>

                    </select>
                    <input class="form-control" <?php if (! $this->_tpl_vars['this']['user']->countryName): ?>disabled<?php endif; ?> type="text" id="cityName" name="cityName" value="<?php echo $this->_tpl_vars['this']['user']->cityName; ?>
" maxlength="100" />
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="company">Компания:</label>
                    <input class="form-control" type="text" id="company" name="company" value="<?php echo $this->_tpl_vars['this']['user']->company; ?>
" maxlength="100" />
                </div>
                <div class="form-group">
                    <label for="position">Должность:</label>
                    <input class="form-control" type="text" id="position" name="position" value="<?php echo $this->_tpl_vars['this']['user']->position; ?>
" maxlength="100" />
                </div>
            </div>
        </div>
        <a href="#" onclick="document.getElementById('user-register').submit(); return false;" class="btn btn-black"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Save<?php else: ?>Сохранить данные<?php endif; ?></a>
    </form>
    <a class="editdetail" href="<?php echo smarty_function_link(array('show' => 'userdetails'), $this);?>
"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Editing details<?php else: ?>Редактировать реквизиты<?php endif; ?></a>
</div>