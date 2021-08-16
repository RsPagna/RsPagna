<?php
session_start();

//Record mistake
$_SESSION['try'] = isset($_SESSION['try']) ? $_SESSION['try'] : 1;

//Collect error info
$error = '';
if ( isset( $_REQUEST[ 'e' ] )and $_REQUEST[ 'e' ] == 1 ) {
  $_SESSION['try'] += 1;
  $error = "<p><span class = 'error'> Incorrect username or password or maybe your account is temporary unavailable. Please try again or contact your system administrator. (". (6 - $_SESSION['try']) .") </span></p>";
}

if ( isset( $_REQUEST[ 'e' ] )and $_REQUEST[ 'e' ] == 2 ) {
  $error = "<p><span class = 'error'> Your account is temporary blocked. Please try again in the next 24h or contact your system administrator. </span></p>";
}

//Clear session
if ( isset( $_REQUEST[ 'l' ] )and $_REQUEST[ 'l' ] == 0 ) {
  unset( $_SESSION[ 'user_name' ], $_SESSION[ 'user_login' ], $_SESSION[ 'user_permission' ] );
}
//Include word library
include_once( 'inc/kh.php' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="inc/stylelist.css"/>
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="inc/jquery-3.0.0.0.js"></script>
<title>
<?= txt_title ?>
</title>
</head>
<body>
<div class="bg-image-blur">
</div>
<div id="div-login-box" class="div-login-box">
  <div>
    <p align="center"><img src="images/ncct-logo-256.png" width="180"></p>
    <h1 align="center"><?= title_moi ?></h1>
    <h2 align="center"><?= title_ncct ?></h2>
  </div>
  <div class="error-404">
    <?= $error ?>
  </div>
  <form method="POST" name="fm-login" id="fm_login" action="login.php">
    <table width="90%" border="0" cellspacing="0">
      <tr>
        <td><input type="text" name="logInID" id="login_id" placeholder="ឈ្មោះគណនី" class="input-text-box"/></td>
      </tr>
      <tr>
        <td><input type="password" name="passIn" id="login_pasw" placeholder="លេខសម្ងាត់" class="input-text-box"/></td>
      </tr>
    </table>
  </form>
  <div align="center">
    <button class="input-button" id="bt_login">ចូល</button>
    <button class="input-button" id="bt_close">ចាកចេញ</button>
  </div>
</div>
<script language="javascript" type="text/javascript">
    $(document).ready(function(e){
        $("#bt_close").click(function(){
            window.open("https://www.facebook.com/436017133191961","_self");
        });

        $("#bt_login").click(function(){
            var logIn = $("#login_id").val();
            var pswIn = $("#login_pasw").val();
            if(logIn != '' & pswIn != ''){
                $("#fm_login").submit();
            }else{
                alert("Please enter username and password to login.");
            }
        });

        $("#login_id").blur(function(){
            var i = $("#login_id").val();
            if(i==""){
                $("#login_id").css({"border-color":"red"});
            }else{
                $("#login_id").css({"border-color":"#aaaaaa"});
            }

        });

        $("#login_pasw").blur(function(){
            var i = $("#login_pasw").val();
            if(i==""){
                $("#login_pasw").css({"border-color":"red"});
            }else{
                $("#login_pasw").css({"border-color":"#aaaaaa"});
            }
        });

        var e = <?= isset($_REQUEST['e'])?$_REQUEST['e']:0 ?>;
        if(e == 2){
          $("#fm_login").submit(function(){
            return false;
          });
          $("#bt_login").hide();
        }
    });
</script>
</body>
</html>