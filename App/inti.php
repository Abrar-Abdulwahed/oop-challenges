<?php
ob_start();
session_start();
require_once __DIR__.'/../Core/config.php';
require_once __DIR__.'/../Interfaces/InterfaceDatabase.php';
spl_autoload_register(function($name){
    require_once __DIR__."/../Classes/{$name}.php";
});

