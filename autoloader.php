<?php
/**
 * Simple autoload for GetYourGuideTest
 */

spl_autoload_register(function ($class) {
    if(strpos($class, 'GetYourGuideTest') === false) {
        return;
    }
    $path = str_replace('\\', '/', $class);
    $path = str_replace('GetYourGuideTest/', '', $path);

    require $path . '.php';
});
