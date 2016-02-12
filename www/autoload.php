<?php

$dir = __DIR__;

function __autoload($class)
{
    if (file_exists(__DIR__ . '/controllers/' . $class . '.php')) {
        require __DIR__ . '/controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $class . '.php')) {
        require __DIR__ . '/models/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/classes/' . $class . '.php')) {
        require __DIR__ . '/classes/' . $class . '.php';
    }
    else {
        $classParts = explode('\\', $class);
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts);
        require $path . '.php';
    }
}
