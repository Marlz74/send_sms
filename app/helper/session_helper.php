<?php
    session_start();
    function flashMessage($flash_alert='', $message='',$class='alert_green'){

        if($flash_alert==true && !empty($message)){
            echo "<div class='".$class."' id=flass_message> ".$message."</div>";
            unset($_SESSION['flash_alert']);
            unset($_SESSION['flash_message']);
            
        }elseif(is_null($flash_alert)&& !empty($message)){
            $class='alert_red';
            echo "<div class='".$class."' id=flass_message> ".$message."</div>";
            unset($_SESSION['flash_alert']);
            unset($_SESSION['flash_message']);
        }
    }
    function isloggedin(){
        return isset($_SESSION['user_id'])?true:false;
    }