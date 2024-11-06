<?php

namespace Providers;

class ViewProvider
{
    public static function show($template, $params): void
    {
        $template = './views/' . $template . '.php';

        require_once($template);

        die();
    }

    public static function include($component, $params)
    {
        $template = "./views/components/{$component}.php";

        require($template);
    }
}