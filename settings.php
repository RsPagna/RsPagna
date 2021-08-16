<?PHP
	session_start();
    //set page history
    $_SESSION['page'] = isset($_REQUEST['page']) ? $_REQUEST['page'] : (isset($_SESSION['page']) ? $_SESSION['page'] : "");
    $_SESSION['subpage'] = isset($_REQUEST['subpage']) ? $_REQUEST['subpage'] : (isset($_SESSION['subpage']) ? $_SESSION['subpage'] : '');

    //Restore session
    $_SESSION['s'] = isset($_REQUEST['s']) ? $_REQUEST['s'] : (isset($_SESSION['s']) ? $_SESSION['s'] : '');

	//call to difined var
	include("inc/kh.php");

	//open database
    include("connections/vtmdb.php");
    
    //Prevent from unauthorized loading page
	if(!isset($_SESSION['user_name'])){
		header("location: 404.shtml");
	}
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
<title><?= txt_title ?></title>
	
</head>

<body>
    <div style="float:left; clear:left;"><h1><?= txt_settings_title ?></h1></div>
    <div class="content-setting">
        <div class="left-pan content-setting">
            <div class="menu2">
            <ul>
                <li id="bt_organization">អំពី​អង្គភាព/ស្ថាប័ន/ក្រុមហ៊ុន</a></li>
                <li id="bt_interviewer">អំពី​អ្នកសម្ភាសន៍</li>
                <li id="bt_translator">អំពី​អ្នកបកប្រែ</li>
                <li id="bt_agency">អំពី​ភ្នាក់ងារ</li>
                <li id="bt_nationality">អំពី​ជាតិសាសន៍</li>
                <li id="bt_country">អំពី​ប្រទេស</li>
                <li id="bt_currency">អំពី​រូបីយប័ណ្ណ</li>
                <li id="bt_province">អំពី​ខេត្ត/រាជធានី/រដ្ឋ</li>
                <li id="bt_district">អំពី​ស្រុក/ក្រុង/ខណ្ឌ</li>
                <li id="bt_commune">អំពី​ឃុំ/សង្កាត់</li>
                <li id="bt_village">អំពី​ភូមិ</li>
                <li id="bt_occupation">អំពី​ការងារ/មុខរបរ</li>
                <li id="bt_service">អំពី​សេវា</li>
                <li id="bt_situation">អំពី​ស្ថានភាព</li>
                <li id="bt_purpose">អំពី​គោលបំណង</li>
				<li id="bt_methods">អំពី​មធ្យោបាយ</li>
				<li id="bt_checkpoints">អំពី​ច្រកព្រំដែន</li>
                <li id="bt_users"><img src="images/profile/default_m_profile.png" width="32" /> អំពី​អ្នកប្រើប្រាស់</li>
            </ul>
            </div>
        </div>
        <div class="middle-pan" id="content_loader" >សូមជ្រើសរើស...</div>
    </div>
	<script type="text/javascript" language="javascript">
		$(document).ready(function(e){
			//Load setings/organization content
			var page = "<?= (isset($_SESSION['page']) ? $_SESSION['page'] : '') ?>";
            
            if(page != ""){
                $.ajax({
                url: "settings/"+page+".php",
                type: "POST",
                async: false,
                data: {
                    "done": 1,
                    "s":"settings"
                },
                success: function(data){
                    $("#content_loader").html(data);
                }
                });
            }
            
            //Load setings/organization content
			$("#bt_organization").click(function(){
				$.ajax({
				url: "settings/organizations.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "organizations",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
			
			//Load setings/interviewer content
			$("#bt_interviewer").click(function(){
				$.ajax({
				url: "settings/interviewers.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "interviewers",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
			
			//Load setings/translators content
			$("#bt_translator").click(function(){
				$.ajax({
				url: "settings/translators.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "translators",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
			
			//Load setings/agencies content
			$("#bt_agency").click(function(){
				$.ajax({
				url: "settings/agencies.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "agencies",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
			//Load setings/nationalities content
			$("#bt_nationality").click(function(){
				$.ajax({
				url: "settings/nationalities.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "nationalities",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/countries content
			$("#bt_country").click(function(){
				$.ajax({
				url: "settings/countries.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "countries",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/currencies content
			$("#bt_currency").click(function(){
				$.ajax({
				url: "settings/currencies.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "currencies",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/provinces content
			$("#bt_province").click(function(){
				$.ajax({
				url: "settings/provinces.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "provinces",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/districts content
			$("#bt_district").click(function(){
				$.ajax({
				url: "settings/districts.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "districts",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/communes content
			$("#bt_commune").click(function(){
				$.ajax({
				url: "settings/communes.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "communes",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/villages content
			$("#bt_village").click(function(){
				$.ajax({
				url: "settings/villages.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "villages",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/occupations content
			$("#bt_occupation").click(function(){
				$.ajax({
				url: "settings/occupations.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "occupations",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/services content
			$("#bt_service").click(function(){
				$.ajax({
				url: "settings/services.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "services",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/status content
			$("#bt_situation").click(function(){
				$.ajax({
				url: "settings/status.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "status",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
            //Load setings/purposes content
			$("#bt_purpose").click(function(){
				$.ajax({
				url: "settings/purposes.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "purposes",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});

			//Load setings/method content
			$("#bt_methods").click(function(){
				$.ajax({
				url: "settings/methods.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "methods",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});

			//Load setings/checkpoint content
			$("#bt_checkpoints").click(function(){
				$.ajax({
				url: "settings/checkpoints.php",
				type: "POST",
				async: false,
				data: {
					"done": 1,
                    "page": "checkpoints",
					"s":"settings"
				},
				success: function(data){
					$("#content_loader").html(data);
				}
				})
			});
            
		});
	</script>
</body>
</html>