<?php
    session_start();

    include("connections/vtmdb.php");

    $user = !empty($_POST['logInID'])?$_POST['logInID']:'';
    $psw = !empty($_POST['passIn'])?$_POST['passIn']:'';

    //Set cookie to avoid over-mistaken
    if(isset($_SESSION['try']) and $_SESSION['try']>5){
        $cookie_name = "banned";
        $cookie_value = $user;
        setcookie($cookie_name,$cookie_value,time()+(86400*1),"/");
    }

    if(!isset($_COOKIE["banned"])){
        if(isset($_REQUEST['logInID']) and isset($_REQUEST['passIn'])){
            $q = "SELECT * FROM `tb_users` WHERE(`auth_username` = BINARY '".$user."' and `auth_pasw` = BINARY '".$psw."' and `auth_status` = 1)";
            if(!$rs = $vtmdb->query($q)){ die('Error login [' . $vtmdb->error . ']'); }
            $r = $rs->fetch_assoc();
            if(!empty($r['auth_id'])){
                $_SESSION['user_name'] = $r['auth_fullname'];
                $_SESSION['user_login'] = $r['auth_username'];
                $_SESSION['user_id'] = $r['auth_id'];
                $_SESSION['user_permission'] = $r['auth_permission'];

                echo "<script type='text/javascript' language='javascript'>
                        window.open('dashboard.php','_self');        
                    </script>";
            }else{
                echo "<script type='text/javascript' language='javascript'>
                    window.open('index.php?e=1','_self');        
                </script>";
            }
        }else{
            header('location: 404.shtml');
        }
    }else{
        if($_COOKIE["banned"] == $user){
            echo "<script type='text/javascript' language='javascript'>
                        window.open('index.php?e=2','_self');        
                    </script>";
        }else{
            if(isset($_REQUEST['logInID']) and isset($_REQUEST['passIn'])){
                $q = "SELECT * FROM `tb_users` WHERE(`auth_username` = BINARY '".$user."' and `auth_pasw` = BINARY '".$psw."' and `auth_status` = 1)";
                if(!$rs = $vtmdb->query($q)){ die('Error login [' . $vtmdb->error . ']'); }
                $r = $rs->fetch_assoc();
                if(!empty($r['auth_id'])){
                    $_SESSION['user_name'] = $r['auth_fullname'];
                    $_SESSION['user_login'] = $r['auth_username'];
                    $_SESSION['user_id'] = $r['auth_id'];
                    $_SESSION['user_permission'] = $r['auth_permission'];

                    echo "<script type='text/javascript' language='javascript'>
                        window.open('dashboard.php','_self');        
                    </script>";
                }else{
                    echo "<script type='text/javascript' language='javascript'>
                        window.open('index.php?e=1','_self');        
                    </script>";
                }
            }
        }
    }
?>