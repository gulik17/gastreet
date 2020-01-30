<?php /* Smarty version 2.6.13, created on 2019-12-27 00:49:53
         compiled from /home/c484884/gastreet.com/www/app/Templates/UserDetailsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/UserDetailsControl.html', 2, false),array('function', 'link', '/home/c484884/gastreet.com/www/app/Templates/UserDetailsControl.html', 5, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['UserDetailsControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "user-details"), $this);?>


<div class="gss-userdetails">
    <form action="<?php echo smarty_function_link(array('do' => 'usereditdetails'), $this);?>
" id="user-details" method="post">
        <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['actor']->id; ?>
"/>
        <input type="hidden" name="detailsId" value="<?php echo $this->_tpl_vars['this']['udmObj']->id; ?>
"/>
        <input type="hidden" name="total" value="<?php echo $this->_tpl_vars['this']['total']; ?>
"/>

        <h2 class="title"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Editing Details:<?php else: ?>Редактирование реквизитов:<?php endif; ?></h2>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="company_type"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Legal status:<?php else: ?>Юридический статус:<?php endif; ?></label>
                    <select class="form-control" id="company_type" name="company_type">
                        <option value="2"<?php if ($this->_tpl_vars['this']['udmObj']->company_type == 2): ?> selected="selected"<?php endif; ?>><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Legal entity<?php else: ?>Юридическое лицо<?php endif; ?></option>
                        <option value="3"<?php if ($this->_tpl_vars['this']['udmObj']->company_type == 3): ?> selected="selected"<?php endif; ?>><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Individual entrepreneur<?php else: ?>Индивидуальный предприниматель<?php endif; ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="company"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>The company's legal name:<?php else: ?>Юридическое наименование организации:<?php endif; ?></label>
                    <input class="form-control" type="text" id="company" name="company" value="<?php echo $this->_tpl_vars['this']['udmObj']->company; ?>
" maxlength="100" data-validate="validate(required, maxlength(100))"/>
                </div>
                <div class="form-group" style="display:none">
                    <label for="countryName">Страна:</label>
                    <input class="form-control" type="text" id="countryName" name="countryName" value="<?php if ($this->_tpl_vars['this']['udmObj']->countryName): ?><?php echo $this->_tpl_vars['this']['udmObj']->countryName; ?>
<?php else: ?><?php echo $this->_tpl_vars['actor']->countryName; ?>
<?php endif; ?>" maxlength="100"/>
                </div>
                <div class="form-group" style="display:none">
                    <label for="cityName">Город:</label>
                    <input class="form-control" type="text" id="cityName" name="cityName" value="<?php if ($this->_tpl_vars['this']['udmObj']->cityName): ?><?php echo $this->_tpl_vars['this']['udmObj']->cityName; ?>
<?php else: ?><?php echo $this->_tpl_vars['actor']->cityName; ?>
<?php endif; ?>" maxlength="100"/>
                </div>
                <div class="form-group">
                    <label for="inn">ИНН:</label>
                    <input class="form-control" type="text" id="inn" name="inn" value="<?php echo $this->_tpl_vars['this']['udmObj']->inn; ?>
" maxlength="12"/>
                </div>
                <div class="form-group"<?php if ($this->_tpl_vars['this']['udmObj']->company_type == 3): ?> style="display:none"<?php endif; ?>>
                    <label for="kpp">КПП:</label>
                    <input class="form-control" type="text" id="kpp" name="kpp" value="<?php echo $this->_tpl_vars['this']['udmObj']->kpp; ?>
" maxlength="9"/>
                </div>
                <div class="form-group">
                    <label for="address"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Postal address:<?php else: ?>Почтовый адрес:<?php endif; ?></label>
                    <input class="form-control" type="text" id="address" name="address" value="<?php echo $this->_tpl_vars['this']['udmObj']->address; ?>
" maxlength="250"/>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="rs"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Account:<?php else: ?>Расчетный счет:<?php endif; ?></label>
                    <input class="form-control" type="text" id="rs" name="rs" value="<?php echo $this->_tpl_vars['this']['udmObj']->rs; ?>
" maxlength="20"/>
                </div>
                <div class="form-group">
                    <label for="bank"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Bank:<?php else: ?>Банк:<?php endif; ?></label>
                    <input class="form-control" type="text" id="bank" name="bank" value="<?php echo $this->_tpl_vars['this']['udmObj']->bank; ?>
" maxlength="255" />
                </div>
                <div class="form-group">
                    <label for="corr"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Corr. account:<?php else: ?>Корреспондентский счёт:<?php endif; ?></label>
                    <input class="form-control" type="text" id="corr" name="corr" value="<?php echo $this->_tpl_vars['this']['udmObj']->corr; ?>
" maxlength="20" />
                </div>
                
                <div class="form-group">
                    <label for="bik"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>BIK:<?php else: ?>БИК:<?php endif; ?></label>
                    <input class="form-control" type="text" id="bik" name="bik" value="<?php echo $this->_tpl_vars['this']['udmObj']->bik; ?>
" maxlength="9" />
                </div>

                <!--div class="form-group">
                    <label for="director"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Director of the company:<?php else: ?>Директор компании:<?php endif; ?></label>
                    <input class="form-control" type="text" id="director" name="director" value="<?php echo $this->_tpl_vars['this']['udmObj']->director; ?>
" maxlength="100" />
                </div-->
                <!--div class="form-group">
                    <label for="buh"><?php if ($this->_tpl_vars['lang'] == 'en'): ?>Chief Accountant:<?php else: ?>Главный бухгалтер:<?php endif; ?></label>
                    <input class="form-control" type="text" id="buh" name="buh" value="<?php echo $this->_tpl_vars['this']['udmObj']->buh; ?>
" maxlength="100" />
                </div-->
            </div>
        </div>
        <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
        <button type="submit" class="btn btn-black"><?php if ($this->_tpl_vars['this']['total'] > 0): ?>Bill<?php else: ?>Save<?php endif; ?></button>
        <?php else: ?>
        <button type="submit" class="btn btn-black"><?php if ($this->_tpl_vars['this']['total'] > 0): ?>Выставить счёт<?php else: ?>Сохранить данные<?php endif; ?></button>
        <?php endif; ?>
    </form>
    <?php if ($this->_tpl_vars['lang'] == 'en'): ?>
    <a class="editdetail" href="<?php echo smarty_function_link(array('show' => 'usereditprofile'), $this);?>
">Editing Profile</a>
    <?php else: ?>
    <a class="editdetail" href="<?php echo smarty_function_link(array('show' => 'usereditprofile'), $this);?>
">Редактировать профайл</a>
    <?php endif; ?>
</div>