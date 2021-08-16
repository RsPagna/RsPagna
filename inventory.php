<?php
//Include word library
    include_once('inc/kh.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="inc/stylelist.css"/>
        <link rel="shortcut icon" href="favicon.ico" />
        <script type="text/javascript" src="inc/jquery-3.0.0.0.js"></script>
        <title><?= txt_title ?></title>
    </head>
    </head>
        <body>
            <div class="div-top-pane" style="float:left; width:100%; border-bottom:1px solid #aaaaaa">
                <div style="float:left;"><img src="images/singha_cppp.png" height = "42" /></div>
                <div style="float:right;"><a href="index.php?l=0">logout</a></div>
                <p>ស្នងការដ្ឋាន​នគរបាល​រាជធានីភ្នំពេញ</p>
            </div>
            <div class="div-left-pane" style="float:left; width:300px; border-right:1px solid #aaaaaa">
                <h1>left section</h1>
                <div class="menu">
                    <ul>
                        <li>Home</li>
                        <li>Staff List</li>
                        <li>About</li>
                    </ul>
                </div>
            </div>
            <div class="div-body-pane" style="float:left; width:900px; padding-left:10px;">
                <h1>body section</h1>
                <div id="div-loading-content"></div>
                <script type="text/javascript" language="javasript">
                    $(document).ready(function(e){
                        var text;
                    });
                </script>
            </div>
            <div class="div-bottom-pane" style="float:left; width:100%; border-top:1px solid #aaaaaa; background:#555; color:#fff">
                <table width="100%" border="0" cellspace="0" class="tb-footer">
                    <tr>
                        <td width="30%"><p>អំពីកម្មវិធី</p><p>គោលនយោបាយប្រើប្រាស់</p></td>
                        <td><p>ផេក​ក្រសួងមហាផ្ទៃ</p><p>ផេកនាយកដ្ឋាន​ប្រឆាំងបទល្មើសបច្ចេកវិទ្យា</p><p>ផេកស្នងការ</p><p>ហ្វេសប៊ុកស្នងការ</p><p>ផេកការិយាល័យប្រឆាំងបទល្មើសបច្ចេកវិទ្យា</p><p></p></td>
                        <td width="30%"><p>ផ្សេងៗ</p></td>
                    </tr>
                </table>
                <p>footer section</p>
            </div>
        </body>
</html>