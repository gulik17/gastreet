<?php /* Smarty version 2.6.13, created on 2019-12-03 11:25:28
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 2, false),array('function', 'html_options', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 21, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 46, false),array('function', 'cycle', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 73, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 91, false),array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 76, false),array('modifier', 'strip_tags', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 76, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageProductsControl.html', 84, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageProductsControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "products-filter"), $this);?>


<h2>Мастер-классы, ужины</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><h4>Фильтр для поиска <span class="caret"></span></h4></a>
<div class="collapse" id="collapseFilter">
    <form id="products-filter" method="post" action="" style="max-width: 400px;">
        <div class="well">
        <input type="hidden" name="show" value="manageproducts"/>
        <input type="hidden" name="isalive" value="1"/>
        <div class="products-users">
            <div class="form-group">
                <label>ID:</label>
                <input class="form-control" type="text" name="id" id="id" />
            </div>
            <div class="form-group">
                <label>Программа:</label>
                <select class="form-control" name="prog" id="prog">
                    <option value="0">-- ВСЕ --</option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['amArray'],'selected' => $this->_tpl_vars['this']['prog']), $this);?>

                </select>
            </div>
            <div class="form-group">
                <label>Локация:</label>
                <select class="form-control" name="place" id="place">
                    <option value="0">-- ВСЕ --</option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['placeArray'],'selected' => $this->_tpl_vars['this']['place']), $this);?>

                </select>
            </div>
            <div class="form-group">
                <label>Статус:</label>
                <select class="form-control" name="status" id="status">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['this']['statusDesc']), $this);?>

                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-info" type="submit" id="submit" value="Показать список отбора"/>
            </div>
        </div>
        </div>
    </form>
</div>

<div class="create">
    <a class="btn btn-primary" href="<?php echo smarty_function_alink(array('show' => 'editproduct'), $this);?>
">Создать продукт</a>
</div>

<?php if ($this->_tpl_vars['this']['productsList']): ?>
    <br/>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Программа</th>
            <th>Статус</th>
            <th>Цена</th>
            <th>Кол-во</th>
            <th>Осталось</th>
            <th>Время</th>
            <th>Актуализировано</th>
            <th>&nbsp;</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['productsList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
        <?php $this->assign('status', $this->_tpl_vars['product']->status); ?>
        <?php $this->assign('areaid', $this->_tpl_vars['product']->areaId); ?>
        <?php $this->assign('speakerid', $this->_tpl_vars['product']->speakerId); ?>
        <?php $this->assign('speaker2id', $this->_tpl_vars['product']->speaker2Id); ?>
        <?php $this->assign('speaker3id', $this->_tpl_vars['product']->speaker3Id); ?>
        <?php $this->assign('speaker4id', $this->_tpl_vars['product']->speaker4Id); ?>
        <?php $this->assign('speaker5id', $this->_tpl_vars['product']->speaker5Id); ?>
        <?php $this->assign('speaker6id', $this->_tpl_vars['product']->speaker6Id); ?>
        <tr class="<?php echo smarty_function_cycle(array('values' => 'color,'), $this);?>
">
            <td><a href="<?php echo smarty_function_alink(array('show' => 'editproduct','id' => $this->_tpl_vars['product']->id), $this);?>
"><?php echo $this->_tpl_vars['product']->id; ?>
</a></td>
            <td>
                <a href="<?php echo smarty_function_alink(array('show' => 'editproduct','id' => $this->_tpl_vars['product']->id), $this);?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</a>
                <p><?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speakerid']]; ?>
<?php if ($this->_tpl_vars['speaker2id']): ?>, <?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speaker2id']]; ?>
<?php endif; ?><?php if ($this->_tpl_vars['speaker3id']): ?>, <?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speaker3id']]; ?>
<?php endif; ?><?php if ($this->_tpl_vars['speaker4id']): ?>, <?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speaker4id']]; ?>
<?php endif; ?><?php if ($this->_tpl_vars['speaker5id']): ?>, <?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speaker5id']]; ?>
<?php endif; ?><?php if ($this->_tpl_vars['speaker6id']): ?>, <?php echo $this->_tpl_vars['this']['smArray'][$this->_tpl_vars['speaker6id']]; ?>
<?php endif; ?></p>
            </td>
            <td><?php echo $this->_tpl_vars['this']['amArray'][$this->_tpl_vars['areaid']]; ?>
</td>
            <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
            <td><?php echo $this->_tpl_vars['product']->price; ?>
</td>
            <td><?php if ($this->_tpl_vars['product']->maxCount): ?><?php echo $this->_tpl_vars['product']->maxCount; ?>
<?php else: ?>-<?php endif; ?></td>
            <td><?php if ($this->_tpl_vars['product']->leftCount): ?><?php echo $this->_tpl_vars['product']->leftCount; ?>
<?php else: ?>-<?php endif; ?></td>
            <td><?php if ($this->_tpl_vars['product']->eventTsStart || $this->_tpl_vars['product']->eventTsFinish): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsStart)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
<?php if ($this->_tpl_vars['product']->eventTsFinish): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->eventTsFinish)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
<?php endif; ?><?php endif; ?></td>
            <td><?php if ($this->_tpl_vars['product']->leftCountTs): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->leftCountTs)) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, в H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, в H:i')); ?>
<?php else: ?>-<?php endif; ?></td>
            <td class="text-center"><a href="<?php echo smarty_function_alink(array('do' => 'admindelproduct','id' => $this->_tpl_vars['product']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить данный продукт?');"><i class="fa fa-trash-o" title="Удалить" aria-hidden="true"></i></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php if ($this->_tpl_vars['this']['total']): ?>
        <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

    <?php endif; ?>
<?php endif; ?>