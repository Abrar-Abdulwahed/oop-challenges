<?php
ob_start();
session_start();
require_once __DIR__.'/../Core/config.php';
require_once __DIR__.'/../Interfaces/InterfaceDatabase.php';
spl_autoload_register(function($name){
    require_once __DIR__."/../Classes/{$name}.php";
});


if(!isset($_GET['page']))
    $page = 1;
else 
    $page = (int)$_GET['page'];


$category = new Category();


$start_from = ($page-1) * PERPAGE;
