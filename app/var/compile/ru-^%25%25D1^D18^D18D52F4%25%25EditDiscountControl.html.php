<?php /* Smarty version 2.6.13, created on 2019-12-05 11:55:01
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditDiscountControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditDiscountControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditDiscountControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditDiscountControl.html', 16, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditDiscountControl.html', 44, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditDiscountControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/css/ketchup/jquery.ketchup.css','type' => 'css'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/ketchup/jquery.ketchup.all.min.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/jquery.placeholder.min.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/editdiscount.js','type' => 'js'), $this);?>



<h2><?php if ($this->_tpl_vars['this']['discount']): ?>Редактирование промо-кода на скидку<?php else: ?>Создание промо-кода на скидку<?php endif; ?></h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savediscount'), $this);?>
" method="post" onsubmit="ignoreSnapshot();">
    <input type="hidden" id="baseTicketIds" name="baseTicketIds" value="<?php echo $this->_tpl_vars['this']['discountBaseTicketsListString']; ?>
" />
    <input type="hidden" id="areaIds" name="areaIds" value="<?php echo $this->_tpl_vars['this']['discountAreasListString']; ?>
" />
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['discount']->id; ?>
" />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Код (буквы, цифры) (Не более 100 символов):</label>
                <input class="form-control" type="text" id="code" name="code" maxlength="100" value="<?php echo $this->_tpl_vars['this']['discount']->code; ?>
" data-validate="validate(required, maxlength(100))"/>
            </div>
        </div>
        <?php if (! $this->_tpl_vars['this']['discount']->id): ?>
        <div class="col-md-6">
            <div class="form-group">
                 <label>повторов:</label> <input class="form-control" type="text" id="repeate" name="repeate" maxlength="20" value="" data-validate="validate(maxlength(20))"/>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-6">
            <div class="form-group">
                <label>Процент скидки (от 1 до 100%):</label>
                <input class="form-control" type="text" id="percent" name="percent" maxlength="5" value="<?php echo $this->_tpl_vars['this']['discount']->percent; ?>
" data-validate="validate(required, range(1, 100)))"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Тип:</label>
                <select class="form-control" name="type">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['types'],'selected' => $this->_tpl_vars['this']['discount']->type), $this);?>

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Статус:</label>
                <select class="form-control" name="status">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statuses'],'selected' => $this->_tpl_vars['this']['discount']->status), $this);?>

                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Установить тип пользователя при применении промо-кода:</label>
                <select class="form-control" name="userTypeId">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['userTypes'],'selected' => $this->_tpl_vars['this']['discount']->userTypeId), $this);?>

                </select>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label style="display:block;padding-left:15px;">Купон сработает на следующих основных билетах:</label>
        <div class="col-md-6" id="basetickets-left-panel">
            <select class="form-control" id="basetickets-left-select" name="choosenBaseTickets" size="8">
                <?php if ($this->_tpl_vars['this']['baseTicketArray']): ?>
                    <?php $_from = $this->_tpl_vars['this']['baseTicketArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['baseTicket']):
?>
                        <option value="<?php echo $this->_tpl_vars['baseTicket']->id; ?>
"><?php echo $this->_tpl_vars['baseTicket']->name; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </select>
            <button style="width:100%" class="btn btn-default" id="baseticket-remove-from-discount">>></button>
        </div>
        <div class="col-md-6" id="basetickets-right-panel">
            <select class="form-control" id="basetickets-right-select" name="allBaseTickets" size="8">
                <?php if ($this->_tpl_vars['this']['allBaseTickets']): ?>
                    <?php $_from = $this->_tpl_vars['this']['allBaseTickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['baseTicket']):
?>
                        <option value="<?php echo $this->_tpl_vars['baseTicket']->id; ?>
"><?php echo $this->_tpl_vars['baseTicket']->name; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </select>
            <button style="width:100%" class="btn btn-default" id="baseticket-add-to-discount"><<</button>
        </div>
    </div>
    <div class="form-group row">
        <label style="display:block;padding-left:15px;">Купон сработает на мастер-классы следующих программ:</label>
        <div class="col-md-6" id="areas-left-panel">
            <select id="areas-left-select" name="choosenAreas" size="8">
                <?php if ($this->_tpl_vars['this']['areaArray']): ?>
                    <?php $_from = $this->_tpl_vars['this']['areaArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['area']):
?>
                        <option value="<?php echo $this->_tpl_vars['area']->id; ?>
"><?php echo $this->_tpl_vars['area']->name; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </select>
            <button style="width: 100%" class="btn btn-default" id="area-remove-from-discount">>></button>
        </div>
        <div class="col-md-6" id="areas-right-panel">
            <select id="areas-right-select" name="allAreas" size="8">
                <?php if ($this->_tpl_vars['this']['allAreas']): ?>
                    <?php $_from = $this->_tpl_vars['this']['allAreas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['area']):
?>
                        <option value="<?php echo $this->_tpl_vars['area']->id; ?>
"><?php echo $this->_tpl_vars['area']->name; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </select>
            <button style="width: 100%" class="btn btn-default" id="area-add-to-discount"><<</button>
	</div>
    </div>
    <div class="form-group">
        <input class="btn btn-success" id="submit" type="submit" value="Сохранить"/>
    </div>
</form>