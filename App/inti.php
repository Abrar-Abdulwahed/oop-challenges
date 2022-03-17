<?php
ob_start(); 
session_start();

require_once __DIR__.'/../Core/config.php';
require_once __DIR__.'/../App/Interfaces/InterfaceDatabase.php';
spl_autoload_register(function($name){
    require_once __DIR__."/../Classes/{$name}.php";
});

if(isset($_GET['logout']) and $_GET['logout'] == TRUE){
    session_unset();
    session_destroy();
    header("Location: login.php");
}



























$user = new User();
$user->wallet = new Wallet();
if(isset($_SESSION['wallet'])){
    $userId = $_SESSION['user']['uid'];
    $conn = mysqli_connect("localhost", "root" , "" , "ewallet");
    $db = mysqli_query($conn, "SELECT * FROM wallets WHERE `uid` = '$userId'");
    if($db){
        $wallet = mysqli_fetch_array($db);
        $_SESSION['wallet'] = [
            'uid' => $wallet['uid'],
            'pin' => $wallet['pin'],
            'balance' => $wallet['balance'],
            'currency' => $wallet['currency'],
        ];
    }
}


