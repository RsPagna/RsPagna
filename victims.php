<?PHP
	session_start();

	//call to difined var
	include("inc/kh.php");

	//open database
	include("connections/vtmdb.php");

	//Prevent from unauthorized loading page
	if(!isset($_SESSION['user_login'])){
		header("location: 404.shtml");
	}
		
	//Restore session
		$_SESSION['s'] = isset($_REQUEST['s']) ? $_REQUEST['s'] : (isset($_SESSION['s']) ? $_SESSION['s'] : '');
    
    //date
	$date = gmstrftime ("%Y-%m-%d %T", time ()+25200);
    $short_date = gmstrftime ("%Y-%m-%d", time ()+25200);
		
    $Y = substr($date,0,4);//YYYY
    $M = substr($date,5,2);//MM
    $D = substr($date,8,2);//DD

	//include function
	include("inc/fnGetVillage.php");
	include("inc/fnGetCommune.php");
	include("inc/fnGetDistrict.php");
	include("inc/fnGetProvince.php");
	include("inc/fnGetCountry.php");
	include("inc/fnGetReferer.php");
	include("inc/fnGetRefererType.php");
	include("inc/fnGetInterviewer.php");
	include("inc/fnGetTranslator.php");
	include("inc/fnGetOrganization.php");
	include("inc/fnGetSex.php");
	include("inc/fnEncode128.php");
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="inc/stylelist.css"/>
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="inc/jquery-3.0.0.0.js"></script>
<script type="text/javascript" language="javascript">
	//Apply checkbox even
	$(document).ready(function(e) {
		$("#div-checkbox").fadeOut(100);

        $("#chx_select_all").click(function(){
			$("input:checkbox").prop('checked', this.checked);
		});
		$("input:checkbox").click(function(){
			$("#div-checkbox").fadeIn(100);	
			if($('input:checkbox:checked').length == 0){
				$("#div-checkbox").fadeOut(100);
			}
		});
    });
</script>
<title><?= txt_victims_title." - ".txt_victim ?></title>
	
</head>
<body>
    <div style="float:left;"><h1><?= txt_victims_title ?></h1></div><div style="float:left;" class="link_button_add" onclick="window.open('fmvictims.php?fmCommand=add')"  title="បញ្ចូលទិន្នន័យថ្មី"></div>
	<div id="content-section" style="height:700px; overflow:auto; clear:both;">
		<table id="tb-items-list" class="tb-display">
				<thead>
					<tr>
						<th width="50">ល.រ</th>
						<th width="80">លេខកូដករណី</th>
						<th width="80">កាលបរិច្ឆេទ​សម្ភាសន៍</th>
						<th width="140">ទីកន្លែង​សម្ភាសន៍</th>
						<th>ឈ្មោះជនរងគ្រោះ</th>
						<th width="30">ភេទ</th>
						<th width="30">អាយុ</th>
						<th width="80">សញ្ញាតិ</th>
                        <th width="140">ទីកន្លែងកំណើត</th>
						<th width="180">ប្រភពបញ្ជូន</th>
						<th width="180">អ្នកសម្ភាសន៍</th>
						<th width="180">អ្នកបកប្រែ</th>
						
                <?PHP
                    if($_SESSION['user_permission'] == 101){
                ?>
                        <th width="">អ្នកបញ្ជូលទិន្នន័យ</th>
                        <th width="">កាលបរិច្ឆេទ</th>
                        <th width="80"></th>
                <?PHP
                    }
                ?>
					</tr>
				</thead>
				<tbody>
				<?php
					$case_number = "";
					$case_date = "";
					$case_address = "";
					$case_referer = "";
					$case_translator = "";
					$case_interviewer = "";

					$victim_name = "";
					$victim_sex = "";
					$victim_age = "";
					$victim_nationality = "";
					$victim_pob = "";

					$n = 0;
					$tr = "";
					$link = "";
					$del = "";

					$q = "SELECT *,`tb_cases`.`date_modify` as `case_date_modify` FROM `tb_cases`,`tb_victims` WHERE(`case_number`=`vtm_number`) ORDER BY `case_id` DESC";
					if(!$rs = $vtmdb->query($q)){ die ("Error query main cases!");}
					while($r = $rs->fetch_assoc()){
						$n += 1;

						$case_number = $r['case_number'];
						$case_date = $r['case_date'];
						$case_address = get_village($r['case_loc_v'])."<br />".get_commune($r['case_loc_c'])."<br />".get_district($r['case_loc_d'])."<br />".get_province($r['case_loc_p']);
						$case_referer = get_referer($r['case_referer']);
						$case_interviewer = get_interviewer($r['case_interviewer']);
						$case_translator = get_translator($r['case_translator']);

						$victim_name = $r['vtm_fname']." ".$r['vtm_lname'];
						$victim_sex = get_sex($r['vtm_sex']);
						$victim_age = $Y - substr($r['vtm_dob'],0,4)."ឆ្នាំ";
						$victim_nationality = get_country($r['vtm_nationality'],'nl');
						$victim_pob = get_village($r['vtm_pob_v'])."<br />".get_commune($r['vtm_pob_v'])."<br />".get_district($r['vtm_pob_v'])."<br />".get_province($r['vtm_pob_v']);

						if(isset($_SESSION['user_permission']) and $_SESSION['user_permission']=='101'){
							$link = 'onclick="window.open(\'fmvictims.php?fmCommand=edit&load_child_form=fm&id='.encode128($r['case_id']).'\',\'_blank\')"';
							$del = '';
						}

						$tr .="<tr>
								<td>$n</td>
								<td $link>$case_number</td>
								<td $link>$case_date</td>
								<td $link>$case_address</td>
								<td $link>$victim_name</td>
								<td $link>$victim_sex</td>
								<td $link>$victim_age</td>
								<td $link>$victim_nationality</td>
								<td $link>$victim_pob</td>
								<td $link>$case_referer</td>
								<td $link>$case_interviewer</td>
								<td $link>$case_translator</td>";
						if(isset($_SESSION['user_permission']) and $_SESSION['user_permission']=='101'){
							$tr .="<td>".$r['last_modify_by']."</td>
									<td>".$r['case_date_modify']."<td>";
						}
						$tr .="</tr>";
					}
					echo $tr;
				?>
				</tbody>
		</table>
	</div>
	<div style="float:left; padding:5px;"> <input type="button" name="bt_report_1" onClick="window.open('report_by_dept.php<?= $data ?>','_blank');" class="command_button" value="របាយការណ៍" /></div>
	<div id="div-checkbox" style="float:right; background: rgb(255, 241, 215); padding:5px 5px 5px 10px; border-radius: 15px 0px 0px 0px;">
		<div style="float:left;">ជាមួយនឹងទិន្នន័យដែលបានជ្រើសរើស៖</div>
		<div style="float:left;"><input type="checkbox" name="chx_select_all" id="chx_select_all" value="all" /> Select All |&nbsp;</div>
		<div style="float:left;"> Modify-all | Delete-all | Make-report</div>
	</div>
</body>
</html>