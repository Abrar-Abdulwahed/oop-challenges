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
    public function getBalance($id){
        $this->query("balance" ,"wallets", "WHERE `uid` = '$id'"); 
        $this->execute();
        return $this->fetch();
    }


    public function deposite($amount, $id)
    {
        $currentBalance = $this->getBalance($id);
        $totalBalance = floatval($currentBalance['balance']) + floatval($amount);
        $this->update("wallets" ,"balance = '$totalBalance'", "uid", $id);
        $this->execute();
    }

    public function withdraw($amount, $id)
    {
        $currentBalance = $this->getBalance($id);
        if((floatval($currentBalance['balance']) - floatval($amount)) > 0.0 ){
            $totalBalance = floatval($currentBalance['balance']) - floatval($amount);
            $this->update("wallets" ,"balance = '$totalBalance'", "uid", $id);
            $this->execute();
        }
        else{
            Messages::setMsg('Error: ', 'Your Balance is not enough!', 'danger');
            echo Messages::getMsg();
        }
    }

}