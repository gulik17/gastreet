<?php /* Smarty version 2.6.13, created on 2019-12-03 16:41:08
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/EditBaseTicketControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBaseTicketControl.html', 2, false),array('function', 'loadscript', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBaseTicketControl.html', 4, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBaseTicketControl.html', 13, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBaseTicketControl.html', 20, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/EditBaseTicketControl.html', 71, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['EditBaseTicketControl']); ?>
<?php echo smarty_function_formrestore(array('id' => 'form'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.FCKEditor.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/fckeditor/jquery.form.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/md5.js','type' => 'js'), $this);?>

<?php echo smarty_function_loadscript(array('file' => '/js/caretaker.js','type' => 'js'), $this);?>


<?php echo smarty_function_loadscript(array('file' => '/js/pages/adminkaeditbaseticket.js','type' => 'js'), $this);?>


<h2><?php if ($this->_tpl_vars['this']['ticket']): ?>Редактирование <?php else: ?>Создание <?php endif; ?> билета</h2>
<form id="form" action="<?php echo smarty_function_alink(array('do' => 'savebaseticket'), $this);?>
" method="post" onsubmit="ignoreSnapshot();">
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['this']['ticket']->id; ?>
" />
    <input type="hidden" id="productIds" name="productIds" value="<?php echo $this->_tpl_vars['this']['ticketProductsListString']; ?>
" />
    <div class="row">
        <div class="col-md-6 form-group">
            <label>Статус:</label>
            <select class="form-control" name="status" id="status">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusList'],'selected' => $this->_tpl_vars['this']['ticket']->status), $this);?>

            </select>
        </div>
        <div class="col-md-6 form-group">
            <label>План:</label>
            <input class="form-control" type="text" name="plan" id="plan" value="<?php echo $this->_tpl_vars['this']['ticket']->plan; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Название:</label>
            <input class="form-control" type="text" name="name" id="name" value="<?php echo $this->_tpl_vars['this']['ticket']->name; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Название (Англ):</label>
            <input class="form-control" type="text" name="name_en" id="name" value="<?php echo $this->_tpl_vars['this']['ticket']->name_en; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Цена:</label>
            <input class="form-control" type="text" name="price" id="price" value="<?php echo $this->_tpl_vars['this']['ticket']->price; ?>
"/>
        </div>
        <div class="col-md-6 form-group">
            <label>Кол-во билетов:</label>
            <input class="form-control" type="text" name="maxCount" id="maxCount" value="<?php echo $this->_tpl_vars['this']['ticket']->maxCount; ?>
"/>
        </div>
    </div>
    <div class="form-inline">
      <div class="form-group">
        <label style="display:block">Дата и время начала мероприятия:</label>
        <input class="form-control" type="text" name="startDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['startDay'] != null): ?><?php echo $this->_tpl_vars['this']['startDay']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
        <input class="form-control" type="text" name="startMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['startMonth'] != null): ?><?php echo $this->_tpl_vars['this']['startMonth']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
        <input class="form-control" type="text" name="startYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['startYear'] != null): ?><?php echo $this->_tpl_vars['this']['startYear']; ?>
<?php endif; ?>" style="width: 60px;" /> в 
        <input class="form-control" type="text" name="startHours" value="<?php if ($this->_tpl_vars['this']['startHours'] != null): ?><?php echo $this->_tpl_vars['this']['startHours']; ?>
<?php else: ?>00<?php endif; ?>" style="width: 44px;" /> : 
        <input class="form-control" type="text" name="startMinutes" value="<?php if ($this->_tpl_vars['this']['startMinutes'] != null): ?><?php echo $this->_tpl_vars['this']['startMinutes']; ?>
<?php else: ?>00<?php endif; ?>" style="width: 44px;" />
       </div>
    </div>
    <div class="form-inline">
      <div class="form-group">
        <label style="display:block">Дата и время завершения мероприятия:</label>
        <input class="form-control" type="text" name="finishDay" placeholder="дд" value="<?php if ($this->_tpl_vars['this']['finishDay'] != null): ?><?php echo $this->_tpl_vars['this']['finishDay']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
        <input class="form-control" type="text" name="finishMonth" placeholder="мм" value="<?php if ($this->_tpl_vars['this']['finishMonth'] != null): ?><?php echo $this->_tpl_vars['this']['finishMonth']; ?>
<?php endif; ?>" style="width: 44px;" /> . 
        <input class="form-control" type="text" name="finishYear" placeholder="гггг" value="<?php if ($this->_tpl_vars['this']['finishYear'] != null): ?><?php echo $this->_tpl_vars['this']['finishYear']; ?>
<?php endif; ?>" style="width: 60px;" /> в 
        <input class="form-control" type="text" name="finishHours" value="<?php if ($this->_tpl_vars['this']['finishHours'] != null): ?><?php echo $this->_tpl_vars['this']['finishHours']; ?>
<?php else: ?>23<?php endif; ?>" style="width: 44px;" /> : 
        <input class="form-control" type="text" name="finishMinutes" value="<?php if ($this->_tpl_vars['this']['finishMinutes'] != null): ?><?php echo $this->_tpl_vars['this']['finishMinutes']; ?>
<?php else: ?>59<?php endif; ?>" style="width: 44px;" />
      </div>
    </div>
    <div class="row">
        <label style="display:block;margin-top:10px;padding-left: 15px;">В билет включены мастер-классы:</label>
        <div class="form-group col-md-6">
            <select class="form-control" id="products-left-select" name="choosenProducts" size="14">
                <?php if ($this->_tpl_vars['this']['ticketProductsList']): ?>
                    <?php $_from = $this->_tpl_vars['this']['ticketProductsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                        <?php $this->assign('speakerid', $this->_tpl_vars['product']->speakerId); ?>
                        <option value="<?php echo $this->_tpl_vars['product']->id; ?>
"><?php echo $this->_tpl_vars['product']->name; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd M в H:i') : smarty_modifier_dateformat($_tmp, 'd M в H:i')); ?>
 (<?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speakerid']]; ?>
)</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </select>
            <button class="btn btn-default" style="width: 100%;" id="product-remove-from-ticket">>></button>
        </div>
        <div class="form-group col-md-6">
            <select class="form-control" id="products-right-select" name="allProducts" size="14">
                <?php if ($this->_tpl_vars['this']['leftProductsList']): ?>
                    <?php $_from = $this->_tpl_vars['this']['leftProductsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                        <?php $this->assign('speakerid', $this->_tpl_vars['product']->speakerId); ?>
                        <option value="<?php echo $this->_tpl_vars['product']->id; ?>
"><?php echo $this->_tpl_vars['product']->name; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd M в H:i') : smarty_modifier_dateformat($_tmp, 'd M в H:i')); ?>
 (<?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speakerid']]; ?>
)</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            </select>
            <button class="btn btn-default" style="width: 100%;" id="product-add-to-ticket"><<</button>
        </div>
        <div class="form-group col-md-12" id="anno-dl">
            <label id="anno-dt">Аннотация:</label>
            <div id="anno-dd"><textarea class="form-control" name="annotation" id="annotation"><?php echo $this->_tpl_vars['this']['ticket']->annotation; ?>
</textarea></div>
        </div>
        <div class="form-group col-md-12">
            <input class="btn btn-success" id="submitTicket" type="submit" value="Сохранить"/>
        </div>
    </div>
</form>