<?PHP
	session_start();

	//set session for dept
	$_SESSION['dept_id'] = isset($_REQUEST['txt_dept']) ? $_REQUEST['txt_dept'] : (isset($_SESSION['dept_id']) ? $_SESSION['dept_id'] : '');

	//call to difined var
	include("inc/kh.php");

	//open database
	include("connections/vtmdb.php");

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
            
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="inc/stylelist.css"/>
<link rel="shortcut icon" href="favicon.ico" />
<title><?= txt_title ?></title>
<script type="text/javascript" src="jquery-3.0.0.0.js"></script>
</head>
<body>
<div class="print_preview"><img src="images/print.png" width="28" height="28" alt="Print Preview" onclick="window.print()"/> <img src="images/close.png" width="28" height="28" alt="Close Preview" onclick="window.close()"/></div>
<div class="A4">
<?PHP include("inc/header_5.php"); ?>
<div align="center"><span id="h1">របាយការណ៍អំពី សម្ភារ និងសង្ហារឹម</span></div>
<table class="table_print2" width="98%" border="0" cellspacing="0" cellpadding="0">
<thead>
    <tr align="center" style="font-weight:bold">
    <td width="30">ល.រ</td>
    <td width="160">តាម​ប្រភេទ</td>
    <td>បរិយាយ</td>
    <td width="120">ប្រើ​ប្រាស់<br/>
        ពីថ្ងៃ</td>
    <td width="200">អត្ត​សញ្ញាណ​កម្ម</td>
    <td width="60">បរិមាណ</td>
    <td width="60">តំលៃ<br/>
    (រៀល)</td>
    <td width="60">ស្ថានភាព</td>
    <td width="140" id="displayed">ផ្សេងៗ</td>
    </tr>
</thead>
<tbody>
    <?php
    //Function
    function _status($a){
        switch($a){
            case 3: return "ល្អ"; break;
            case 2: return "មធ្យម"; break;
            case 1: return "ខូច"; break;
            case -1: return "បាត់"; break;
            case 0: return "គ្មានទិន្នន័យ"; break;
        }
    }

	$f = isset($_REQUEST["f"]) ? " WHERE(`itm_dept`='".$_REQUEST["f"]."')" : "WHERE(1)";
		
    //Retrive data from tb_vehicle
    $q = "SELECT * FROM `tb_items` $f ORDER BY `itm_desc` ASC";
    if(!$rs = $vtmdb->query($q)){
        die('Error item: [' . $vtmdb->error . ']');
    }
    $n = 0;
    while($r = $rs -> fetch_assoc()){      
            $n += 1;

            $qc = "SELECT `cat_name`,`cat_abbr` FROM `tb_categories` WHERE(`cat_id`='".$r['itm_category']."');";
            if(!$rsc = $vtmdb->query($qc)){
                die('Error Category: [' . $vtmdb->error . ']');
            }else{
                $rc = $rsc->fetch_assoc();
                $itm_category = !empty($rc['cat_name'])?$rc['cat_name']:'';
                $catAbbreviation = !empty($rc['cat_abbr']) ? $rc['cat_abbr'] : '';
            }
    ?>
            <tr>
            <td align="center"><?= $n ?></td>
            <td align="center" title="<?= $itm_category ?>"><?= $catAbbreviation ?></td>
            <td><?= $r['itm_desc'] ?></td>
            <td align="center"><?= $r['itm_dateout'] ?></td>
            <td class="str2uppercase">- ឈ្មោះ​អ្នក​ធ្វើ: <?= $r['itm_brand'] ?><br/>
                - ឈ្មោះសំគាល់: <?= $r['itm_model'] ?><br />
                - លេខតាម​ធុន: <?= $r['itm_sn'] ?>
            </td>
            <td align="center"><?= $r['itm_qty'] ?></td>
            <td align="center"><?= $r['itm_cost']==0 ? '' : number_format($r['itm_cost'],0,'.',',') ?></td>
            <td align="center"><?= _status($r['itm_status']) ?></td>
            <td align="center"><?= $r['itm_note'] ?></td>
            </tr>
    <?php
    }
    unset($r,$rs,$q);

if($n==0){
    echo "<tr>
                <td>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/>&nbsp;&nbsp;<br/>&nbsp;<br/>&nbsp;<br/></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>";
                $n = 1;
}
    ?>
    </tbody>
</table>
<script language="javascript" type="text/javascript">
$(document).ready(function(e) {
    var n = <?= $n ?>;
    $("#displayed").toggle();
    for(i=1;i<n+1;i++){
        $("#displayed"+i).toggle();
    }
    $("#bt_displayed").click(function(){
        $("#displayed").toggle();
        for(i=1;i<n+1;i++){
            $("#displayed"+i).toggle();
        }
    });
});
</script>
<?php 
    $vtmdb->close(); 
?>
</div>
</body>
</html>