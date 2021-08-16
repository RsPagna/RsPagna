<?PHP
	session_start();

//set session
    $_SESSION['cn_id'] = isset($_REQUEST['txt_case_loc_cn']) ? $_REQUEST['txt_case_loc_cn'] : (isset($_SESSION['cn_id']) ? $_SESSION['cn_id'] : '');
    $_SESSION['p_id'] = isset($_REQUEST['txt_case_loc_p']) ? $_REQUEST['txt_case_loc_p'] : (isset($_SESSION['p_id']) ? $_SESSION['p_id'] : '');
    $_SESSION['d_id'] = isset($_REQUEST['txt_case_loc_d']) ? $_REQUEST['txt_case_loc_d'] : (isset($_SESSION['d_id']) ? $_SESSION['d_id'] : '');
    $_SESSION['c_id'] = isset($_REQUEST['txt_case_loc_c']) ? $_REQUEST['txt_case_loc_c'] : (isset($_SESSION['c_id']) ? $_SESSION['c_id'] : '');

//call to difined var
	include("inc/kh.php");

//open database
	include("connections/vtmdb.php");

//Prevent from unauthorized loading page
	if(!isset($_SESSION['user_login'])){
		header("location: 404.shtml");
	}

//date
	$date = gmstrftime ("%Y-%m-%d %T", time ()+25200);
    $short_date = gmstrftime ("%Y-%m-%d", time ()+25200);
		
    $Y = substr($date,0,4);//YYYY
    $M = substr($date,5,2);//MM
    $D = substr($date,8,2);//DD

//Khmer Date
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
    
    function khD($D){
        _n(substr($D,0,1))._n(substr($D,1,1));
    }

    function khM($M){
        return _n(substr($M,0,1))._n(substr($M,1,1));
    }

    function khY($Y){
        return _n(substr($Y,0,1))._n(substr($Y,1,1))._n(substr($Y,2,1))._n(substr($Y,3,1));
    }

//Load form tab if edit
    if(isset($_REQUEST['fmCommand']) and $_REQUEST['fmCommand'] == 'edit'){
        
    }
//
//load form
    $load_child_form = isset($_REQUEST['load_child_form']) ? $_REQUEST['load_child_form'] : 'fm';

    $bt_next = "Next";
    $bt_previous = "Previous";
    $bt_close = "Close";
    $bt_save = "Save";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="inc/stylelist.css" />
<link rel="shortcut icon" href="favicon.ico" />
<script src="inc/jquery-3.0.0.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= txt_title ?></title>
	
</head>

<body>
    <div class="input_forms">
        <div>
        <?PHP
            if(isset($load_child_form)){
                switch ($load_child_form){
                    case 'fm' : include("fmvictims_main.php"); break;
                    case 'fp' : include("fmvictims_parent.php"); break;
                    case 'f0101' : include("fmvictims_0101.php"); break;
                    case 'f0201' : include("fmvictims_0201.php"); break;
                    case 'f0202' : include("fmvictims_0202.php"); break;
                    case 'f0203' : include("fmvictims_0203.php"); break;
                    case 'f0301' : include("fmvictims_0301.php"); break;
                    case 'f0401' : include("fmvictims_0401.php"); break;
                    case 'f0501' : include("fmvictims_0501.php"); break;
                    case 'f0601' : include("fmvictims_0601.php"); break;
                    case 'f0701' : include("fmvictims_0701.php"); break;
                    case 'f0801' : include("fmvictims_0801.php"); break;
                    case 'f0901' : include("fmvictims_0901.php"); break;
                    default: include("fmvictims_main.php"); break;
                }
            }else{
                include("fmvictims_main.php");
            }
        ?>
        </div>
    </div>
</body>
</html>