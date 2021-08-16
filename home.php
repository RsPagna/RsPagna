<?PHP
	session_start();

	//call to difined var
	include("inc/kh.php");

	//open database
	include("connections/vtmdb.php");

	//Prevent from unauthorized loading page
	if(!isset($_SESSION['user_name'])){
		header("location: 404.shtml");
	}
		
	//Restore session
		$_SESSION['s'] = isset($_REQUEST['s']) ? $_REQUEST['s'] : (isset($_SESSION['s']) ? $_SESSION['s'] : '');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="inc/stylelist.css"/>
<link rel="shortcut icon" href="favicon.ico" />
<script type="text/javascript" src="inc/jquery-3.0.0.0.js"></script>
<title><?= txt_title ?></title>
</head>

<body>
	<h1>ព័ត៌មានសង្ខេប</h1>
	<button id="bt_new_victims" name="new_victims" class="general_button">បញ្ចូល​ទិន្នន័យ​ជនរងគ្រោះ​ថ្មី</button>
</body>
</html>