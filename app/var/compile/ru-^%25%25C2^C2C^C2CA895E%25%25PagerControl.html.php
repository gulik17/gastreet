<?php /* Smarty version 2.6.13, created on 2019-11-28 14:59:47
         compiled from /home/c484884/gastreet.com/www/app/Templates/PagerControl.html */ ?>
<div class="pagination-limit">Лимит:
    <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;limit=30" class="<?php if ($this->_tpl_vars['PagerControl']['per'] == 30): ?> active<?php endif; ?>">30</a>
    <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;limit=50" class="<?php if ($this->_tpl_vars['PagerControl']['per'] == 50): ?> active<?php endif; ?>">50</a>
    <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;limit=70" class="<?php if ($this->_tpl_vars['PagerControl']['per'] == 70): ?> active<?php endif; ?>">70</a>
    <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;limit=100" class="<?php if ($this->_tpl_vars['PagerControl']['per'] == 100): ?> active<?php endif; ?>">100</a>
    <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;limit=1000" class="<?php if ($this->_tpl_vars['PagerControl']['per'] == 1000): ?> active<?php endif; ?>">1000</a>
</div>

<?php if (( $this->_tpl_vars['PagerControl']['totalPages'] ) > 1): ?>
<ul class="pagination">
    <li class="prev">
        <?php if ($this->_tpl_vars['PagerControl']['prevPage'] != 0): ?>
            <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;<?php echo $this->_tpl_vars['PagerControl']['param']; ?>
=<?php echo $this->_tpl_vars['PagerControl']['prevPage']; ?>
" rel="prev">&larr;</a>
	<?php else: ?>
            <a href="#" onclick="return false">&larr;</a>
	<?php endif; ?>
    </li>
    <?php if (( $this->_tpl_vars['PagerControl']['currentPage'] >= 5 )): ?>
        <?php $this->assign('pageStart', $this->_tpl_vars['PagerControl']['currentPage']-5); ?>
        <?php if (( $this->_tpl_vars['PagerControl']['currentPage']+5 <= $this->_tpl_vars['PagerControl']['totalPages'] )): ?>
            <?php $this->assign('pageEnd', $this->_tpl_vars['PagerControl']['currentPage']+5); ?>
        <?php else: ?>
            <?php $this->assign('pageEnd', $this->_tpl_vars['PagerControl']['totalPages']+1); ?>
        <?php endif; ?>
    <?php else: ?>
        <?php $this->assign('pageStart', 1); ?>
        <?php $this->assign('pageEnd', $this->_tpl_vars['PagerControl']['currentPage']+10); ?>
    <?php endif; ?>
    <?php if (( $this->_tpl_vars['PagerControl']['totalPages'] < 10 )): ?>
        <?php $this->assign('pageEnd', $this->_tpl_vars['PagerControl']['totalPages']+1); ?>
    <?php endif; ?>
    <?php unset($this->_sections['page']);
$this->_sections['page']['name'] = 'page';
$this->_sections['page']['start'] = (int)$this->_tpl_vars['pageStart'];
$this->_sections['page']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['page']['loop'] = is_array($_loop=$this->_tpl_vars['pageEnd']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page']['show'] = true;
$this->_sections['page']['max'] = $this->_sections['page']['loop'];
if ($this->_sections['page']['start'] < 0)
    $this->_sections['page']['start'] = max($this->_sections['page']['step'] > 0 ? 0 : -1, $this->_sections['page']['loop'] + $this->_sections['page']['start']);
else
    $this->_sections['page']['start'] = min($this->_sections['page']['start'], $this->_sections['page']['step'] > 0 ? $this->_sections['page']['loop'] : $this->_sections['page']['loop']-1);
if ($this->_sections['page']['show']) {
    $this->_sections['page']['total'] = min(ceil(($this->_sections['page']['step'] > 0 ? $this->_sections['page']['loop'] - $this->_sections['page']['start'] : $this->_sections['page']['start']+1)/abs($this->_sections['page']['step'])), $this->_sections['page']['max']);
    if ($this->_sections['page']['total'] == 0)
        $this->_sections['page']['show'] = false;
} else
    $this->_sections['page']['total'] = 0;
if ($this->_sections['page']['show']):

            for ($this->_sections['page']['index'] = $this->_sections['page']['start'], $this->_sections['page']['iteration'] = 1;
                 $this->_sections['page']['iteration'] <= $this->_sections['page']['total'];
                 $this->_sections['page']['index'] += $this->_sections['page']['step'], $this->_sections['page']['iteration']++):
$this->_sections['page']['rownum'] = $this->_sections['page']['iteration'];
$this->_sections['page']['index_prev'] = $this->_sections['page']['index'] - $this->_sections['page']['step'];
$this->_sections['page']['index_next'] = $this->_sections['page']['index'] + $this->_sections['page']['step'];
$this->_sections['page']['first']      = ($this->_sections['page']['iteration'] == 1);
$this->_sections['page']['last']       = ($this->_sections['page']['iteration'] == $this->_sections['page']['total']);
?>         <?php $this->assign('page', $this->_sections['page']['index']); ?>
        <?php if (( $this->_tpl_vars['page'] == $this->_tpl_vars['PagerControl']['currentPage'] )): ?>
            <li class="current active"><a href="#" onclick="return false"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
        <?php else: ?>
            <li><a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;<?php echo $this->_tpl_vars['PagerControl']['param']; ?>
=<?php echo $this->_tpl_vars['page']; ?>
"><?php echo $this->_tpl_vars['page']; ?>
</a></li>
        <?php endif; ?>
    <?php endfor; endif; ?>
    <li class="next">
        <?php if ($this->_tpl_vars['PagerControl']['nextPage'] != 0): ?>
            <a href="<?php echo $this->_tpl_vars['PagerControl']['url']; ?>
&amp;<?php echo $this->_tpl_vars['PagerControl']['param']; ?>
=<?php echo $this->_tpl_vars['PagerControl']['nextPage']; ?>
" rel="next">&rarr;</a>
        <?php else: ?>
            <a href="#" onclick="return false">&rarr;</a>
	<?php endif; ?>
    </li>
</ul>
<p>Всего страниц: <?php echo $this->_tpl_vars['PagerControl']['totalPages']; ?>
</p>
<?php endif; ?>