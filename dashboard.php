<?php
	session_start();
//Include word library
	include_once('inc/kh.php');

//open database
include("connections/vtmdb.php");
	
//Prevent from unauthorized loading page
if(!isset($_SESSION['user_login'])){
	header("location: 404.shtml");
}

//Restore session
$_SESSION['s'] = isset($_REQUEST['s']) ? $_REQUEST['s'] : (isset($_SESSION['s']) ? $_SESSION['s'] : '');

$date = gmstrftime ("%Y/%m/%d %T %Z", time ()+25200);
//	$date = gmdate("Y/m/d", time ()+25200);

	$Y = substr($date,0,4);//YYYY
	$M = substr($date,5,2);//MM
	$D = substr($date,8,2);//DD
//Khmer Date
	$khD = "";
	$khM = "";
	$khY = "";

	function _n($x){
		switch($x){
			case 1: return "១"; break;
			case 2: return "២"; break;
			case 3: return "៣"; break;
			case 4: return "៤"; break;
			case 5: return "៥"; break;
			case 6: return "៦"; break;
			case 7: return "៧"; break;
			case 8: return "៨"; break;
			case 9: return "៩"; break;
			case 0: return "០"; break;
			default:break;
		}	
	}

	$khD = _n(substr($D,0,1))._n(substr($D,1,1));
	$khM = _n(substr($M,0,1))._n(substr($M,1,1));
	$khY = _n(substr($Y,0,1))._n(substr($Y,1,1))._n(substr($Y,2,1))._n(substr($Y,3,1));

//Function Khmer date
	function _KhDate($date){
		if(!empty($date)){
			$Y = substr($date,0,4);//YYYY
			$M = substr($date,5,2);//MM
			$D = substr($date,8,2);//DD
			
			$khD = _n(substr($D,0,1))._n(substr($D,1,1));
			$khM = _n(substr($M,0,1))._n(substr($M,1,1));
			$khY = _n(substr($Y,0,1))._n(substr($Y,1,1))._n(substr($Y,2,1))._n(substr($Y,3,1));
			
			return $khD."/".$khM."/".$khY;
		}
	}

//Function selected
function _selected($a,$b){
	if(isset($a) and isset($b)){
		if($a == $b){
			return 'selected = "selected"';
		}
	}
}
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
	<body>
		<div class="div-top-pane" style="float:left; width:100%; border-bottom:1px solid #aaaaaa; margin:0px;">
			<div style="float:left;"><img src="images/ncct-logo-64.png" height = "42" /></div>
			<div style="float:right; margin:5px 5px 0px 0px;"> <a href="index.php?l=0"><img src="images/logout-icon-64.png" height="32" /></a></div> <div style="float:right; margin:5px 5px 0px 0px; border-right:1px dotted #aaaaaa; padding-right:5px;"><span class="txt-label-01"><?= _KhDate($date) ?></span> | សួស្តី! <?= $_SESSION['user_name'] ?></div>
			<div style="float:left; padding-top:10px; margin-left: 5px;"> <?= title_ncct ?></div>
		</div>
		<div class="div-menu">
			<div class="menu">
					<?PHP
						function _id($str){						
							if($str == $_SESSION['s']){
								return 'active';
							}else{
								return '';
							}
						}
					?>
				<ul>
					<li class="home <?= _id('home') ?>" id="home"><img src="images/home-icon-32.png" height="32"> <?= txt_home ?></li>
					<li class="items <?= _id('victims') ?>" id="victims"><img src="images/items-list-icon-32.png" height="32"> <?= txt_victims_list ?></li>
					<li class="setting <?= _id('setting') ?>" id="settings"><img src="images/setting-icon-32.png" height="32"> <?= txt_setting ?></li>
					<li class="about <?= _id('about') ?>" id="about"><img src="images/about-us-icon-32.png" height="32"> About</li>
				</ul>
			</div>
		</div>
		<div class="div-body-pane">
			<div id="div-loading-content" class="div-loading-content"><h1><?= txt_welcome ?></h1></div>
			<script type="text/javascript" language="javasript">
							
				$(document).ready(function(e){
					var s = "<?= $_SESSION['s'] ?>";
					
					//Load default
					$("#items_heading_tab").hide();

					if(s!=""){
						if(s == "victims"){
							$("#items_heading_tab").show();
							$.ajax({
							url: "victims.php",
							type: "POST",
							async: false,
							data: {
								"done": 1,
								"s":"victims"
							},
							success: function(data){
								$("#div-loading-content").html(data);
							}
							});
						}else if(s == "home"){
							$("#items_heading_tab").hide();
							$.ajax({
							url: "home.php",
							type: "POST",
							async: false,
							data: {
								"done": 1,
								"s":"home"
							},
							success: function(data){
								$("#div-loading-content").html(data);
							}
							});
						}else if(s == "settings"){
							$("#items_heading_tab").hide();
							$.ajax({
							url: "settings.php",
							type: "POST",
							async: false,
							data: {
								"done": 1,
								"s":"settings"
							},
							success: function(data){
								$("#div-loading-content").html(data);
							}
							});
						}
					}

					//Load home content
					$("#home").click(function(){
						$("#items_heading_tab").hide();
						$.ajax({
						url: "home.php",
						type: "POST",
						async: false,
						data: {
							"done": 1,
							"s":"home"
						},
						success: function(data){
							$("#div-loading-content").html(data);
						}
						})
					});


					//Load items list content
					$("#victims").click(function(){
						$("#items_heading_tab").show();
						$.ajax({
						url: "victims.php",
						type: "POST",
						async: false,
						data: {
							"done": 1,
							"s":"victims"
						},
						success: function(data){
							$("#div-loading-content").html(data);
						}
						})
					});

					//Load setings content
					$("#settings").click(function(){
						$("#items_heading_tab").hide();
						$.ajax({
						url: "settings.php",
						type: "POST",
						async: false,
						data: {
							"done": 1,
							"s":"settings"
						},
						success: function(data){
							$("#div-loading-content").html(data);
						}
						})
					});
				});
			</script>
		</div>
		<div class="div-bottom-pane" style="float:left; width:100%; border-top:1px solid #aaaaaa; background:#555; color:#fff">
			<table width="100%" border="0" cellspace="0">
				<tr>
					<td valign="top" width="30%"><p>អំពីកម្មវិធី</p><p>គោលនយោបាយប្រើប្រាស់</p></td>
					<td valign="top"><p>ផេក​ក្រសួងមហាផ្ទៃ</p><p>ផេកនាយកដ្ឋាន​ប្រឆាំងបទល្មើសបច្ចេកវិទ្យា</p><p>ផេកស្នងការ</p><p>ហ្វេសប៊ុកស្នងការ</p><p>ផេកការិយាល័យប្រឆាំងបទល្មើសបច្ចេកវិទ្យា</p><p></p></td>
					<td valign="top" width="30%"><p>ផ្សេងៗ</p></td>
				</tr>
			</table>
		</div>
		<div align="center" style="clear:both; font-size:smaller;"> <?= txt_credit ?> <?= $khY ?></div>
	</body>
</html>