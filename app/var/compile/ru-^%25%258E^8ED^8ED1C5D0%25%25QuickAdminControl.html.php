<?php /* Smarty version 2.6.13, created on 2020-01-14 03:49:20
         compiled from /home/c484884/gastreet.com/www/app/Templates/QuickAdminControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/QuickAdminControl.html', 44, false),array('modifier', 'strip_tags', '/home/c484884/gastreet.com/www/app/Templates/QuickAdminControl.html', 44, false),array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/QuickAdminControl.html', 46, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['QuickAdminControl']); ?>

<div class="container quick-admin">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <p class="mt-5 text-center" style="font-weight:500;color:#10093b;">Введите телефон участника</p>
            <form class="mt-3" method="post">
                <div class="row">
                    <div class="offset-md-2 col-md-4 form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Телефон" value="<?php echo $this->_tpl_vars['this']['phone']; ?>
">
                    </div>
                    <div class="col-md-4 form-group form-check">
                        <button type="submit" class="btn btn-red" style="width:100%;">Искать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <?php if ($this->_tpl_vars['this']['result']): ?>
                <h3 class="mb-1"><?php echo $this->_tpl_vars['this']['result']['lastname']; ?>
 <?php echo $this->_tpl_vars['this']['result']['name']; ?>
</h3>
                <p>
                    <?php if ($this->_tpl_vars['this']['tickets']['status'] == 'STATUS_PAID'): ?>
                        <span class="badge badge-success">ОПЛАЧЕН</span>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['this']['tickets']['status'] == 'STATUS_NEW'): ?>
                        <span class="badge badge-danger">НЕ ОПЛАЧЕН</span>
                    <?php endif; ?>
                    Билет: <?php echo $this->_tpl_vars['this']['tickets']['baseTicketName']; ?>
 
                </p>
                <?php if ($this->_tpl_vars['this']['tickets']['discountId'] > 0): ?><p>Скидка: <?php echo $this->_tpl_vars['this']['tickets']['discountPercent']; ?>
</p><?php endif; ?>
                <?php if ($this->_tpl_vars['this']['products']): ?>
                    <h5 class="mt-4 mb-1">Дополнительные продукты</h5>
                    <?php $_from = $this->_tpl_vars['this']['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
                    <p class="product-item">
                        <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_PAID'): ?>
                            <span class="badge badge-success">ОПЛАЧЕН</span>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['product']['status'] == 'STATUS_NEW'): ?>
                            <span class="badge badge-danger">НЕ ОПЛАЧЕН</span>
                        <?php endif; ?>
                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['productName'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>

                        <br>
                        <?php if ($this->_tpl_vars['product']['eventTsStart'] || $this->_tpl_vars['product']['eventTsFinish']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['eventTsStart'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd.m.Y, H:i') : smarty_modifier_dateformat($_tmp, 'd.m.Y, H:i')); ?>
<?php if ($this->_tpl_vars['product']['eventTsFinish']): ?> - <?php echo ((is_array($_tmp=$this->_tpl_vars['product']['eventTsFinish'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'H:i') : smarty_modifier_dateformat($_tmp, 'H:i')); ?>
<?php endif; ?><?php endif; ?>
                    </p>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
                
                <img class="img-fluid" src="/qr/code.php?code=<?php echo $this->_tpl_vars['this']['qrmObj']->code; ?>
" />
                
            <?php endif; ?>
        </div>
    </div>

    <?php if (! $this->_tpl_vars['this']['result']): ?>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <p class="text-center mt-4">Мы ничего не нашли...</p>
            </div>
        </div>
    <?php endif; ?>
</div>