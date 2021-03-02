<?php
function smarty_function_copyright($string)
{
	return '<button class="btn btn-default btn-sm back-top copylnkbtn" type="button"><span class="glyphicon glyphicon-arrow-up"></span></button> &nbsp; <a href="' . Configurator::get('application:protocol') . $_SERVER['HTTP_HOST'].'" class="copylnk1st" title="">gss.ru</a>';
}