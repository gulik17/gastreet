<?php
/*
* Ревизия
*
* {revision}
*/
function smarty_function_revision($params, &$smarty)
{
	$isDebug = Configurator::get("application:debug");
    $revision = BaseApplication::getRevision();
	if($isDebug)
	{
		return " (Версия #{$revision})";
	}
	else {
        return "{$revision}";
    }

}
