<?php

/**
 * Позволяет сформировать список МК спикера
 * 
 * Неуниверсальная функция / для модальных окон на странице спикеров /
 *
 * @example 
 * {loadscript file='js/example.js' type='js'}
 * {loadscript file='js/example.css' type='css'}
 */

function smarty_function_getmkbyspeaker($params, &$smarty) {
    $id = (int) $params['id'];
    $lang = UIGenerator::getLang();

    $pm = new ProductManager();
    $pmList = $pm->getAllActiveBySpeakerId($id);

    $text = "";
    if ($pmList) {
        foreach ($pmList as &$v) {
            $text .= "<div class=\"row block-body row-date ".$pm->tagToCssClass($v->tags)."\">";
            $text .= "<div class=\"col-xs-12\">";
            $text .= "<div class=\"row gss-tag-tr\">";
            $text .= "<div class=\"col-sm-3 td c-time\">";
            if ( (date("H", $v->eventTsStart) == "00") && (date("H", $v->eventTsFinish) == "00") ) {
                $text .= ($lang == 'en') ? "Time to be confirmed" : "Время уточняется";
            } else {
                $text .= "<span class=\"hidden-lg hidden-md hidden-sm\">".(($lang == 'en') ? "Time" : "Время").": </span>";
                $text .= "<b>".date("d", $v->eventTsStart)." ".(($lang == 'en') ? "May" : "мая")."</b> <br>".date("H:i", $v->eventTsStart)."-".date("H:i", $v->eventTsFinish);
            }
            $text .= "</div>";
            $text .= "<div class=\"col-sm-5 td c-title\">";
            $text .= $v->name;
            $text .= "</div>";
            $text .= "<div class=\"col-sm-4 td c-btn\">";
            if ($v->leftCount == 0) {
                $text .= "<a href=\"#\" class=\"btn-cart hidden\" onclick='window.location.href = \"/index.php?do=add&product={$product->id}\";return false;' title=\"\">Купить</a>";
            }
            $text .= "</div>";
            $text .= "</div>";
            $text .= "</div>";
            $text .= "</div>";
        }
    }

    return $text;
}