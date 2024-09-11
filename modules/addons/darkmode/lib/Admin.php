<?php

namespace WHMCS\Module\Addon\DarkMode;

class Admin
{
    public static function getConfig($key)
    {
        $config = \WHMCS\Module\Addon\Setting::module('darkmode')->pluck('value', 'setting');
        return isset($config[$key]) ? $config[$key] : null;
    }
}