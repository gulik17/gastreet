<?php /* Smarty version 2.6.13, created on 2019-11-29 08:07:14
         compiled from /home/c484884/gastreet.com/www/app/Templates/SpeakersPrevControl.html */ ?>
<?php $this->assign('this', $this->_tpl_vars['SpeakersPrevControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs">
                <li><a href="/">Главная</a></li>
                <li><span>Презентации</span></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="gss-speakers-container">
        <h1 class="page-headline gss-speakers-title">Презентации спикеров</h1>
    </div>

    <div class="speakers-grid js-speakers-grid">
        <div class="row grid js-grid">
            <?php if ($this->_tpl_vars['this']['spmList']): ?>
            <!-- loop start -->
            <?php $_from = $this->_tpl_vars['this']['spmList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['speaker']):
?>
            <div class="col-6 col-md-3 grid-entry">
                <div class="person-teaser" data-timer="on">
                    <div class="icon-country <?php echo $this->_tpl_vars['speaker']->country; ?>
"></div>
                    <?php if ($this->_tpl_vars['speaker']->pic1): ?>
                        <img src="/images/speackers/resized/<?php echo $this->_tpl_vars['speaker']->pic1; ?>
?v=<?php echo $this->_tpl_vars['speaker']->tsUpdated; ?>
" data-ratio="1">
                    <?php else: ?>
                        <img src="/images/gss/speaker.jpg" data-ratio="1">
                    <?php endif; ?>
                    <div class="about">
                        <?php if (! $this->_tpl_vars['this']['actor']): ?>
                            <p class="name mb-1"><?php echo $this->_tpl_vars['speaker']->name; ?>
<br/><?php echo $this->_tpl_vars['speaker']->secondName; ?>
</p>
                            <p class="job m-0" style="opacity: 1;"><?php echo $this->_tpl_vars['speaker']->company; ?>
</p>
                            <p class="job m-0 mt-3" style="opacity: 1;"><a href="/userlogin" onclick="alert('Перед загрузкой презентации необходимо авторизоваться');" target="_blank" class="buttonDownload">Скачать презентацию</a></p>
                        <?php else: ?>
                            <p class="name mb-1"><?php echo $this->_tpl_vars['speaker']->name; ?>
<br/><?php echo $this->_tpl_vars['speaker']->secondName; ?>
</p>
                            <p class="job m-0" style="opacity: 1;"><?php echo $this->_tpl_vars['speaker']->company; ?>
</p>
                            <p class="job m-0 mt-3" style="opacity: 1;"><a href="/pdf/presentation/<?php echo $this->_tpl_vars['speaker']->presentation; ?>
" target="_blank" class="buttonDownload">Скачать презентацию</a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; unset($_from); ?>
            <!-- loop end -->
            <?php endif; ?>
        </div>
    </div>
</div>