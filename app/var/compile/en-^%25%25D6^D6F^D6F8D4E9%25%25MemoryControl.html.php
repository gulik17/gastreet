<?php /* Smarty version 2.6.13, created on 2019-12-18 13:44:49
         compiled from /home/c484884/gastreet.com/www/app/Templates/MemoryControl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dbtexttohtml', '/home/c484884/gastreet.com/www/app/Templates/MemoryControl.html', 55, false),array('modifier', 'nl2br', '/home/c484884/gastreet.com/www/app/Templates/MemoryControl.html', 55, false),array('modifier', 'truncate', '/home/c484884/gastreet.com/www/app/Templates/MemoryControl.html', 56, false),)), $this); ?>
<?php $this->assign('this', $this->_tpl_vars['MemoryControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="row content">
            <div class="col-md-12">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><span>Memory</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container messagesPage mt-4">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <header id="messagesHeader">
                <h1 class="text-center mb-3">Напиши свои эмоции о&nbsp;GASTREET'19</h1>
            </header>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <form>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Тема</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Сообщение</label>
                        <textarea name="message" class="form-control" rows="6"></textarea>
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-white memory-submit">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="messageContainer mt-5">
        <?php $_from = $this->_tpl_vars['this']['memories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['memory']):
?>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <article class="message">
                        <h1 class="header"><?php echo $this->_tpl_vars['memory']['subject']; ?>
</h1>
                        <p class="bodyText"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['memory']['message'])) ? $this->_run_mod_handler('dbtexttohtml', true, $_tmp) : smarty_modifier_dbtexttohtml($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
                        <p class="author"><?php echo $this->_tpl_vars['memory']['name']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['memory']['lastname'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 2, ".") : smarty_modifier_truncate($_tmp, 2, ".")); ?>
</p>
                    </article>
                </div>
            </div>
        <?php endforeach; endif; unset($_from); ?>
    </div>
</div>