<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

function darkmode_config()
{
    return [
        'name' => 'Dark Mode Admin Area',
        'description' => 'Addon for Dark Mode in Admin Area for any theme',
        'version' => '1.0.0',
        'author' => 'Blockshift',
        'language' => 'english',
        'fields' => [
            'brightness' => [
                'FriendlyName' => 'Brightness',
                'Type' => 'text',
                'Size' => '3',
                'Default' => '100',
                'Description' => 'Set brightness (0-100)',
            ],
            'contrast' => [
                'FriendlyName' => 'Contrast',
                'Type' => 'text',
                'Size' => '3',
                'Default' => '90',
                'Description' => 'Set contrast (0-100)',
            ],
            'sepia' => [
                'FriendlyName' => 'Sepia',
                'Type' => 'text',
                'Size' => '3',
                'Default' => '10',
                'Description' => 'Set sepia (0-100)',
            ],
            'auto_mode' => [
                'FriendlyName' => 'Auto Mode',
                'Type' => 'yesno',
                'Description' => 'Enable auto mode based on system color scheme',
            ],
        ],
    ];
}

function darkmode_activate()
{
    return [
        'status' => 'success',
        'description' => 'Dark Mode addon has been activated successfully.',
    ];
}

function darkmode_deactivate()
{
    return [
        'status' => 'success',
        'description' => 'Dark Mode addon has been deactivated successfully.',
    ];
}
