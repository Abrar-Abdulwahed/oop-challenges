<?php

class Wallet extends MysqliConnect{
    private $uid;
    private $PIN;
    private $balance;
    private $currency;

    public function __construct()
    {
        Parent::__construct();
        $this->PIN= bin2hex(random_bytes(15));
        $this->balance=0;
        $this->currency="YR";
    }

    public function setUserID($uid){
        $this->uid = $uid;
    }
    public function createWallet()
    {
        $this->insert("wallets", "uid, PIN, balance, currency", "'$this->uid', '$this->PIN', '$this->balance','$this->currency'");
        if($this->execute()){
            $_SESSION['wallet'] = [
                                'uid' => $this->uid,
                                'balance' => $this->balance,
                                'currency' => $this->currency
            ];
        }
    }
    public function getBalance($other){
        $this->query("wallets", "balance", $other);
        return $this->execute();
    }


    public function deposite($deposite, $id)
    {
        print_r('777777777777777777777777777777777777777777777777777777');
        // $this->query("balance" ,"wallet", "WHERE `uid` = '$id'"); 
        echo '888888888888888888888888888888888888888888888888888888';
        // print_r($this->execute());
        echo '999999999999999999999999999999999999999999999999999999';
        $totalBalance;
        $this->update("wallets" ,"balance = '$deposite'", "uid", $id);
        $this->execute();
    }

}