<?php /* Smarty version 2.6.13, created on 2019-11-28 14:59:47
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/ManageSpeakersControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'formrestore', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageSpeakersControl.html', 2, false),array('function', 'alink', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageSpeakersControl.html', 28, false),array('function', 'pager', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageSpeakersControl.html', 55, false),array('modifier', 'lower', '/home/c484884/gastreet.com/www/app/Templates/adminka/ManageSpeakersControl.html', 44, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['ManageSpeakersControl']); ?>
<?php echo smarty_function_formrestore(array('id' => "speaker-filter"), $this);?>


<h2>Спикеры</h2>

<a role="button" data-toggle="collapse" href="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
    <h4>Фильтр для поиска <span class="caret"></span></h4>
</a>
<div class="collapse in" id="collapseFilter">
    <div class="well" style="max-width: 400px;">
        <form id="speaker-filter" method="post" action="">
            <input type="hidden" name="show" value="managespeakers"/>
            <input type="hidden" name="isalive" value="1"/>
            <div class="filter-speaker">
                <div class="form-group">
                    <label>Тег:</label>
                    <input type="text" name="tags" id="tags" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" value="Показать список отбора" class="btn btn-info"/>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="create">
    <a class="btn btn-primary" href="<?php echo smarty_function_alink(array('show' => 'editspeaker'), $this);?>
">Создать спикера</a>
</div>

<?php if ($this->_tpl_vars['this']['speakersList']): ?>
    <br/>
    <table class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Город</th>
            <th>Тег</th>
            <th>Статус</th>
            <th>&nbsp;</th>
        </tr>
        <?php $_from = $this->_tpl_vars['this']['speakersList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['speaker']):
?>
        <?php $this->assign('status', $this->_tpl_vars['speaker']->status); ?>
        <tr class="<?php echo ((is_array($_tmp=$this->_tpl_vars['status'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
">
            <td><?php echo $this->_tpl_vars['speaker']->id; ?>
</td>
            <td><a href="<?php echo smarty_function_alink(array('show' => 'editspeaker','id' => $this->_tpl_vars['speaker']->id), $this);?>
" title="Редактировать"><?php echo $this->_tpl_vars['speaker']->name; ?>
 <?php echo $this->_tpl_vars['speaker']->secondName; ?>
</a><?php if ($this->_tpl_vars['speaker']->name_en): ?><br>( <?php echo $this->_tpl_vars['speaker']->name_en; ?>
 <?php echo $this->_tpl_vars['speaker']->secondName_en; ?>
 )<?php endif; ?></td>
            <td><?php echo $this->_tpl_vars['speaker']->company; ?>
<?php if ($this->_tpl_vars['speaker']->cityName): ?>, <?php echo $this->_tpl_vars['speaker']->cityName; ?>
<?php endif; ?> <?php if ($this->_tpl_vars['speaker']->company_en): ?><br>( <?php echo $this->_tpl_vars['speaker']->company_en; ?>
<?php if ($this->_tpl_vars['speaker']->cityName_en): ?>, <?php echo $this->_tpl_vars['speaker']->cityName_en; ?>
<?php endif; ?> )<?php endif; ?></td>
            <td><?php echo $this->_tpl_vars['speaker']->tags; ?>
</td>
            <td><?php echo $this->_tpl_vars['this']['statusDesc'][$this->_tpl_vars['status']]; ?>
</td>
            <td class="text-center"><a href="<?php echo smarty_function_alink(array('do' => 'delspeaker','id' => $this->_tpl_vars['speaker']->id), $this);?>
" onclick="return confirm('Вы уверены что хотите удалить?');"><i class="fa fa-trash-o" title="Удалить" aria-hidden="true"></i></a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <?php if ($this->_tpl_vars['this']['total']): ?>
        <?php echo smarty_function_pager(array('total' => $this->_tpl_vars['this']['total'],'per' => $this->_tpl_vars['this']['perPage']), $this);?>

    <?php endif; ?>
<?php endif; ?>