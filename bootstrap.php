<?php
declare(strict_types=1);

ini_set('display_errors', "1");
const ROOT_PATH = __DIR__;

include_once __DIR__ . "/vendor/autoload.php";
$paths = [
    "Model",
    "Controller",
    "Exceptions"
];

foreach ($paths as $path) {
    $dir = new RecursiveDirectoryIterator($path . "/");
    $iter = new RecursiveIteratorIterator($dir);
    $files = new RegexIterator($iter,  '/^.+\.php$/', RecursiveRegexIterator::GET_MATCH);
    foreach ($files as $filename){
        if(is_array($filename)) {
            $filename = $filename[0];
        }

        include_once $filename;
    }
}