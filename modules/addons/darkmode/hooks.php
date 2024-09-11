<?php

use WHMCS\Module\Addon\DarkMode\Admin;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

require_once __DIR__ . '/lib/Admin.php';

add_hook('AdminAreaHeaderOutput', 1, function ($vars) {
    $moduleLink = $vars['WEB_ROOT'] . '/modules/addons/darkmode';

    // Get configuration
    $brightness = Admin::getConfig('brightness') ?? 100;
    $contrast = Admin::getConfig('contrast') ?? 90;
    $sepia = Admin::getConfig('sepia') ?? 10;
    $autoMode = Admin::getConfig('auto_mode') ?? false;

    return <<<HTML
<script src="{$moduleLink}/js/darkreader.min.js"></script>
<script>
    DarkReader.setFetchMethod(window.fetch);
    const darkReaderOptions = {
        brightness: {$brightness},
        contrast: {$contrast},
        sepia: {$sepia}
    };
    const autoMode = '{$autoMode}' === 'on';

    function toggleDarkMode() {
        if (localStorage.getItem('darkModeEnabled') === 'true') {
            DarkReader.disable();
            localStorage.setItem('darkModeEnabled', 'false');
        } else {
            DarkReader.enable(darkReaderOptions);
            localStorage.setItem('darkModeEnabled', 'true');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        
        const iconMoon = '<i class="fa fa-moon always"></i>';
        const iconSun = '<i class="fa fa-sun always"></i>';
        
        const ulElement = document.querySelector('.right-nav');
        
        if (ulElement && !autoMode) {
            const darkModeToggleListItem = document.createElement('LI');
            darkModeToggleListItem.className = 'bt';

            const darkModeToggleAnchor = document.createElement('A');
            darkModeToggleAnchor.innerHTML = DarkReader.isEnabled() ? iconSun : iconMoon;

            darkModeToggleListItem.appendChild(darkModeToggleAnchor);
            darkModeToggleListItem.addEventListener('click', function() {
                toggleDarkMode();
                darkModeToggleAnchor.innerHTML = DarkReader.isEnabled() ? iconSun : iconMoon;
            });

            ulElement.appendChild(darkModeToggleListItem);
        }
  
        if (autoMode) {
            DarkReader.auto(darkReaderOptions);
        } else {
            if (localStorage.getItem('darkModeEnabled') === 'true') {
                DarkReader.enable(darkReaderOptions);
            }
        }
    });
</script>
HTML;
});
