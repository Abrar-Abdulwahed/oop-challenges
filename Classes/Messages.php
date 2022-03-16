<?php

class Messages{
    public static $message;
    
    public static function setMsg($title , $msg , $type){
        self::$message = '<div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
                        <strong>'.$title.'</strong>'.$msg.'
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
    }

    public static function getMsg(){
        return self::$message;
    }
}

