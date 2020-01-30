<?php

/**
 * Тег для формирования ссылки
 */
function smarty_function_link($params, &$smarty) {
    $action = $params["do"];
    unset($params["do"]);

    $target = $params["show"];
    unset($params["show"]);

    $fullUrl = $params["fullUrl"];
    unset($params["fullUrl"]);

    $fullUrlHttps = $params["fullUrlHttps"];
    unset($params["fullUrlHttps"]);

    if (!$action && !$target || $action && $target) {
        return "Link: one parameter expected";
    }
    if ($action) {
        return Application::normalizePath(Utils::linkAction($action, $params));
    } else {
        return Application::normalizePath(Utils::linkTarget($target, $params));
    }
    return Configurator::get('application:protocol') . $_SERVER['HTTP_HOST'] . '/' . $target;
}

function isSecureLink() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
}