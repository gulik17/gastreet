<?php /* Smarty version 2.6.13, created on 2019-11-28 20:07:44
         compiled from /home/c484884/gastreet.com/www/app/Templates/MapControl.html */ ?>
<?php $this->assign('this', $this->_tpl_vars['MapControl']); ?>

<div class="jumbotron-blank">
    <div class="container">
        <div class="row content">
            <div class="col-md-12">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li><span>Gastreet City</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid container-map">
    <div class="row">
        <div class="col-md-12">
            <img src="/images/g20-map.jpg" class="img-fluid">
        </div>
    </div>
</div>

<?php echo '
<style>
    body {
        background: #10093b;}
    .jumbotron-blank {
        display: none;
        z-index: 999;}
    .breadcrumbs li a {
        color: #fff;}
</style>
'; ?>
