<?php

class User extends MysqliConnect{
    protected $firstname , $lastname, $uid, $email , $password1 , $password2, $admin, $md5;
    public Wallet $wallet;

    public function setInputForRegister($firstname , $lastname, $uid, $email , $password1 , $password2){
        $this->firstname    = $this->esc($this->html($firstname));
        $this->lastname     = $this->esc($this->html($lastname));
        $this->uid          = $this->esc($this->html($uid));
        $this->email        = $this->esc($this->html($email));
        $this->password1    = $this->esc($this->html($password1));
        $this->password2    = $this->esc($this->html($password2));

    }
    public function setInputForLogin($email , $password){
        $this->email = $this->esc($this->html($email));
        $this->password = $this->esc($this->html($password));
        $this->md5  = md5(sha1($this->password));
    }

    private function checkInputForLogin(){
        if(empty($this->email)){
            Messages::setMsg('Error: ', 'Please enter your email', 'danger');
            echo Messages::getMsg();
        }else if(empty ($this->password)){
            Messages::setMsg('Error: ', 'Please enter your password', 'danger');
            echo Messages::getMsg();
        }else if(!$this->checkUser()){
            Messages::setMsg('Error: ', 'Entered data is incorrect', 'danger');
            echo Messages::getMsg();
        }
        else{
            return TRUE;
        }
        return FALSE;
    }

    public function checkInputForRegister(){
        if(empty($this->firstname)){
            Messages::setMsg('Error: ', 'Please enter firstname', 'danger');
            echo Messages::getMsg();
        }
        else if(empty($this->lastname)){
            Messages::setMsg('Error: ', 'Please enter lastname', 'danger');
            echo Messages::getMsg();
        }
        else if(empty($this->uid)){
            Messages::setMsg('Error: ', 'Please enter your ID', 'danger');
            echo Messages::getMsg();
        }
        else if(empty($this->email)){
            Messages::setMsg('Error: ', 'Please enter email', 'danger');
            echo Messages::getMsg();
        }
        else if(!$this->checkEmail()){
            Messages::setMsg('Error: ', 'Your email already exists', 'danger');
            echo Messages::getMsg();
        }
        else if(empty($this->password1)){
            Messages::setMsg('Error: ', 'Please enter password', 'danger');
            echo Messages::getMsg();
        }
        else if($this->password1 !== $this->password2){
                Messages::setMsg('خطأ', 'كلمة المرور غير متطابقة', 'danger');
                echo Messages::getMsg();
        }    
        else{
            return true;
        }
        return false;
    }
    
    public function DisplayMsgInRegister(){
        if($this->checkInputForRegister()){
            if($this->register()){
                $this->wallet = new Wallet();
                $this->wallet->setUserID($this->uid);
                $this->wallet->createWallet();
                header("Location: dashboard/index.php");
            }else{
                Messages::setMsg('Error: ', 'Unexpected Error !', 'danger');
                echo Messages::getMsg();
            }
        }
    }

    public function DisplayMsgInLogin(){
        if($this->checkInputForLogin()){
            if($this->login()){
                $userId = $_SESSION['user']['uid'];
                $this->query('*', 'wallets', "WHERE `uid` = '$userId'");
                if($this->execute()){
                    $wallet = $this->fetch();
                    $_SESSION['wallet'] = [
                        'uid' => $wallet['uid'],
                        'pin' => $wallet['pin'],
                        'balance' => $wallet['balance'],
                        'currency' => $wallet['currency'],
                    ];
                }
                header("Location: dashboard/index.php");
            }else{
                Messages::setMsg('Error: ', 'Unexpected Error!', 'danger');
                echo Messages::getMsg();
            }
        }
    }

    private function checkUser(){
        $this->query('id', 'users', "WHERE `email` = '$this->email' AND `password` = '$this->md5'");
        $this->execute();
        if($this->rowCount() > 0){
            return TRUE;
        }
        return FALSE;
    }
    private function checkEmail(){
        $this->query('id', "users", "WHERE `email` = '$this->email'");
        $this->execute();
        if($this->rowCount() == 0){
            return true;
        }
        return false;
    }
    
    private function login(){
        $this->query('*', 'users', "WHERE `email` = '$this->email' AND `password` = '$this->md5'");
        if($this->execute()){
            $user = $this->fetch();
            $admin = ($user['isAdmin'] == 1 ? TRUE : FALSE);
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['user'] = [
                                'fname' => $user['firstname'],
                                'lname' => $user['lastname'],
                                'uid' => $user['uid'],
                                'isAdmin' => $admin
            
            ];
            return true;
        }
        return false;
    }
    private function register(){
        $password1 = md5(sha1($this->password1));
        $this->insert('users', "firstname , lastname, uid, email , password",
                      "'$this->firstname','$this->lastname','$this->uid','$this->email','$password1'"
                     );
        if($this->execute()){
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['user'] = [
                                'fname' => $this->firstname,
                                'lname' => $this->lastname,
                                'uid' => $this->uid,
                                'isAdmin' => false
            ];
            return $this;
        }
        return null;
    }

    public function updateBalanceDeposite($deposite, $id){
        $this->wallet->deposite($deposite, $id);
        
    }
    public function updateBalanceWithdraw($withdraw, $id){
        $this->wallet->withdraw($withdraw, $id);
    }
    
}