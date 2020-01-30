<?php /* Smarty version 2.6.13, created on 2019-11-28 14:59:41
         compiled from /home/c484884/gastreet.com/www/app/Templates/adminka/MainpageControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dateformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/MainpageControl.html', 84, false),array('modifier', 'round0', '/home/c484884/gastreet.com/www/app/Templates/adminka/MainpageControl.html', 93, false),array('modifier', 'numberformat', '/home/c484884/gastreet.com/www/app/Templates/adminka/MainpageControl.html', 93, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['MainpageControl']); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Статистика</h2>
            <table class="table table-condensed">
                <tr><td>Всего регистраций</td><td><?php echo $this->_tpl_vars['this']['registeredUsers']; ?>
 (шт)</td></tr>
                <tr><td>Регистраций за день</td><td><?php echo $this->_tpl_vars['this']['registeredToday']; ?>
 (шт)</td></tr>
                <tr><td>Регистраций за текущую неделю</td><td><?php echo $this->_tpl_vars['this']['registeredWeek']; ?>
 (шт)</td></tr>
                <tr><td>Подано заявок на «ReBro»</td><td><?php echo $this->_tpl_vars['this']['requestRebro']; ?>
 (шт)</td></tr>
            </table>
            <h4>Корзина участников:</h4>
            <table class="table table-condensed" style="margin-bottom: .5rem">
                <tr>
                    <td>Наименование</td>
                    <td>План</td>
                    <td>Факт</td>
                    <td>[&nbsp;%&nbsp;]</td>
                    <td>В корзине</td>
                    <td>Оплачено</td>
                    <td>Cкидка 1-99</td>
                    <td>Cкидка 100%</td>
                </tr>
                <tr>
                    <td><b>Всего</b></td>
                    <td><b style="color: #0FC700;"><?php echo $this->_tpl_vars['this']['planTotal']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['basketPayCount']+$this->_tpl_vars['this']['basketPayWDiscountCount']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['baseTicketPlan']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['basketCount']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['basketPayCount']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['basketPayWDiscountCount']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['basketWDiscountCount']; ?>
</b></td>
                </tr>
                <?php $_from = $this->_tpl_vars['this']['ticketTotal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['ticket']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['ticket']['name']; ?>
</td>
                        <td style="color: #0FC700;"><?php echo $this->_tpl_vars['ticket']['plan']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['ticket']['pay']+$this->_tpl_vars['ticket']['payDiscount']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['ticket']['percent']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['ticket']['all']; ?>
 <span style="color: #f00;">(<?php echo $this->_tpl_vars['ticket']['all']-$this->_tpl_vars['ticket']['pay']-$this->_tpl_vars['ticket']['payDiscount']-$this->_tpl_vars['ticket']['discount']; ?>
)*</span></td>
                        <td><?php echo $this->_tpl_vars['ticket']['pay']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['ticket']['payDiscount']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['ticket']['discount']; ?>
</td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
            <p style="color: #f00;font-size: 12px;margin-bottom: 2rem;">* Неоплаченные билеты в корзине</p>
            <h4>Список продуктов:</h4>
            <table class="table table-condensed">
                <tr>
                    <td>Наименование</td>
                    <td>План</td>
                    <td>Факт</td>
                    <td>[&nbsp;%&nbsp;]</td>
                    <td>В&nbsp;корзине</td>
                </tr>
                <tr>
                    <td><b>Всего</b></td>
                    <td><b style="color: #0FC700;"><?php echo $this->_tpl_vars['this']['planProductTotal']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['productPayCount']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['productPlan']; ?>
</b></td>
                    <td><b><?php echo $this->_tpl_vars['this']['productCount']; ?>
</b></td>
                </tr>
                <?php $this->assign('prod_id', 0); ?>
                <?php $_from = $this->_tpl_vars['this']['productTotal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['product']):
?>
                    <?php if ($this->_tpl_vars['prod_id'] != $this->_tpl_vars['product']['areaId']): ?>
                        <tr>
                            <td>
                                <b>
                                <?php if ($this->_tpl_vars['product']['areaId'] == 4): ?>POP-UP SHOW<?php endif; ?>
                                <?php if ($this->_tpl_vars['product']['areaId'] == 6): ?>БИЗНЕС-ШКОЛА<?php endif; ?>
                                <?php if ($this->_tpl_vars['product']['areaId'] == 14): ?>FUCKUP STORIES<?php endif; ?>
                                </b>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php $this->assign('prod_id', $this->_tpl_vars['product']['areaId']); ?>
                    <?php endif; ?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['product']['name']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['eventTsStart'])) ? $this->_run_mod_handler('dateformat', true, $_tmp, 'd F') : smarty_modifier_dateformat($_tmp, 'd F')); ?>
)</td>
                        <td style="color: #0FC700;"><?php echo $this->_tpl_vars['product']['plan']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['product']['pay']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['product']['percent']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['product']['all']; ?>
</td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
            </table>
            <table class="table table-condensed">
                <tr><td>Общий приход по билетам</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['basketPayAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</td></tr>
                <tr><td>Общий приход по бронированию билетов</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['basketBronAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</td></tr>
                <tr><td>Общий приход по продуктам</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['productPayAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</td></tr>
                <tr><td>Деньги на балансе участников</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['balanceAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</td></tr>
                <tr><td><b>Общее поступление денег</b></td><td><b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['payAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</b></td></tr>
                <tr><td>Поступление денег (предыдущая неделя)</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['prevWeekPayAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</td></tr>
                <tr><td>Поступление денег (текущая неделя)</td><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['this']['weekPayAmount'])) ? $this->_run_mod_handler('round0', true, $_tmp) : smarty_modifier_round0($_tmp)))) ? $this->_run_mod_handler('numberformat', true, $_tmp) : smarty_modifier_numberformat($_tmp)); ?>
 ₽</td></tr>
            </table>
        </div>
    </div>
</div>