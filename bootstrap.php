<?php
/**
 * Created by PhpStorm.
 * User: kiet
 * Date: 22/12/2019
 * Time: 12:37
 */

spl_autoload_register(function ($class) {
    require_once __DIR__.'/'.str_replace('_', '/', $class).'.php';
});

set_error_handler(function ($e, $m, $f, $l) {
    $ex = new Exception('Error In Development: '.$m.' file: '.$f.' line: '.$l);
    #throw $ex;
}, E_ALL);
error_reporting(E_ALL);