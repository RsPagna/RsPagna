<?PHP
//Initialized case_number
$txt_case_number = isset($_REQUEST['n']) ? $_REQUEST['n'] : '';

//Include functions
    include("inc/fnDecode128.php");
    include("inc/fnSelect.php");

//Function
if(isset($_REQUEST['fmCommand'])){
    $bt_command = '';
    $fm_title = '';
    $script = '';
    $item_exist = 0;
    $success = 0;

    //Check if father, mother and guardian are already recreated
    //Check father
    $q = "SELECT `prn_father_id`as `prn_father` FROM `tb_fathers` WHERE (`prn_case_number`='".$txt_case_number."') LIMIT 1";
    if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
    $r = $rs->fetch_assoc();
    $father = !empty($r['prn_father']) ? $r['prn_father'] : '';

    //check mother
    $q = "SELECT `prn_mother_id`as `prn_mother` FROM `tb_mothers` WHERE (`prn_case_number`='".$txt_case_number."') LIMIT 1";
    if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
    $r = $rs->fetch_assoc();
    $mother = !empty($r['prn_mother']) ? $r['prn_mother'] : '';

    //check guardian
    $q = "SELECT `prn_guardian_id`as `prn_guardian` FROM `tb_guardians` WHERE (`prn_case_number`='".$txt_case_number."') LIMIT 1";
    if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
    $r = $rs->fetch_assoc();
    $guardian  = !empty($r['prn_guardian']) ? $r['prn_guardian'] : '';

    if($_REQUEST['fmCommand'] == 'add'){

        //Father
            $txt_prn_father_fname = isset($_REQUEST['txt_prn_father_fname']) ? $_REQUEST['txt_prn_father_fname'] : '';
            $txt_prn_father_lname = isset($_REQUEST['txt_prn_father_lname']) ? $_REQUEST['txt_prn_father_lname'] : '';
            $txt_prn_father_nick_name = isset($_REQUEST['txt_prn_father_nick_name']) ? $_REQUEST['txt_prn_father_nick_name'] : '';
            $txt_prn_father_dob = isset($_REQUEST['txt_prn_father_dob']) ? $_REQUEST['txt_prn_father_dob'] : '';
            $txt_prn_father_origin = isset($_REQUEST['txt_prn_father_origin']) ? $_REQUEST['txt_prn_father_origin'] : '';
            $txt_prn_father_nationality = isset($_REQUEST['txt_prn_father_nationality']) ? $_REQUEST['txt_prn_father_nationality'] : '';
            $txt_prn_father_id_number = isset($_REQUEST['txt_prn_father_id_number']) ? $_REQUEST['txt_prn_father_id_number'] : '';
            $txt_prn_father_id_expire_date = isset($_REQUEST['txt_prn_father_id_expire_date']) ? $_REQUEST['txt_prn_father_id_expire_date'] : '';
            $txt_prn_father_pob_v = isset($_REQUEST['txt_prn_father_pob_v']) ? $_REQUEST['txt_prn_father_pob_v'] : '';
            $txt_prn_father_pob_c = isset($_REQUEST['txt_prn_father_pob_c']) ? $_REQUEST['txt_prn_father_pob_c'] : '';
            $txt_prn_father_pob_d = isset($_REQUEST['txt_prn_father_pob_d']) ? $_REQUEST['txt_prn_father_pob_d'] : '';
            $txt_prn_father_pob_p = isset($_REQUEST['txt_prn_father_pob_p']) ? $_REQUEST['txt_prn_father_pob_p'] : '';
            $txt_prn_father_pob_cn = isset($_REQUEST['txt_prn_father_pob_cn']) ? $_REQUEST['txt_prn_father_pob_cn'] : '';
            $txt_prn_father_edu = isset($_REQUEST['txt_prn_father_edu']) ? $_REQUEST['txt_prn_father_edu'] : '';
            $txt_prn_father_occupation = isset($_REQUEST['txt_prn_father_occupation']) ? $_REQUEST['txt_prn_father_occupation'] : '';
            $txt_prn_father_addr_v = isset($_REQUEST['txt_prn_father_addr_v']) ? $_REQUEST['txt_prn_father_addr_v'] : '';
            $txt_prn_father_addr_c = isset($_REQUEST['txt_prn_father_addr_c']) ? $_REQUEST['txt_prn_father_addr_c'] : '';
            $txt_prn_father_addr_d = isset($_REQUEST['txt_prn_father_addr_d']) ? $_REQUEST['txt_prn_father_addr_d'] : '';
            $txt_prn_father_addr_p = isset($_REQUEST['txt_prn_father_addr_p']) ? $_REQUEST['txt_prn_father_addr_p'] : '';
            $txt_prn_father_addr_cn = isset($_REQUEST['txt_prn_father_addr_cn']) ? $_REQUEST['txt_prn_father_addr_cn'] : '';
            $txt_prn_father_file = !empty($_FILES['txt_prn_father_file']) ? $_FILES['txt_prn_father_file']['name'] : '';
            $txt_prn_father_filex = !empty($txt_prn_father_file) ? $txt_prn_father_file : '';
            $txt_prn_father_contact = isset($_REQUEST['txt_prn_father_contact']) ? $_REQUEST['txt_prn_father_contact'] : '';

        //Mother
            $txt_prn_mother_fname = isset($_REQUEST['txt_prn_mother_fname']) ? $_REQUEST['txt_prn_mother_fname'] : '';
            $txt_prn_mother_lname = isset($_REQUEST['txt_prn_mother_lname']) ? $_REQUEST['txt_prn_mother_lname'] : '';
            $txt_prn_mother_nick_name = isset($_REQUEST['txt_prn_mother_nick_name']) ? $_REQUEST['txt_prn_mother_nick_name'] : '';
            $txt_prn_mother_dob = isset($_REQUEST['txt_prn_mother_dob']) ? $_REQUEST['txt_prn_mother_dob'] : '';
            $txt_prn_mother_origin = isset($_REQUEST['txt_prn_mother_origin']) ? $_REQUEST['txt_prn_mother_origin'] : '';
            $txt_prn_mother_nationality = isset($_REQUEST['txt_prn_mother_nationality']) ? $_REQUEST['txt_prn_mother_nationality'] : '';
            $txt_prn_mother_id_number = isset($_REQUEST['txt_prn_mother_id_number']) ? $_REQUEST['txt_prn_mother_id_number'] : '';
            $txt_prn_mother_id_expire_date = isset($_REQUEST['txt_prn_mother_id_expire_date']) ? $_REQUEST['txt_prn_mother_id_expire_date'] : '';
            $txt_prn_mother_pob_v = isset($_REQUEST['txt_prn_mother_pob_v']) ? $_REQUEST['txt_prn_mother_pob_v'] : '';
            $txt_prn_mother_pob_c = isset($_REQUEST['txt_prn_mother_pob_c']) ? $_REQUEST['txt_prn_mother_pob_c'] : '';
            $txt_prn_mother_pob_d = isset($_REQUEST['txt_prn_mother_pob_d']) ? $_REQUEST['txt_prn_mother_pob_d'] : '';
            $txt_prn_mother_pob_p = isset($_REQUEST['txt_prn_mother_pob_p']) ? $_REQUEST['txt_prn_mother_pob_p'] : '';
            $txt_prn_mother_pob_cn = isset($_REQUEST['txt_prn_mother_pob_cn']) ? $_REQUEST['txt_prn_mother_pob_cn'] : '';
            $txt_prn_mother_edu = isset($_REQUEST['txt_prn_mother_edu']) ? $_REQUEST['txt_prn_mother_edu'] : '';
            $txt_prn_mother_occupation = isset($_REQUEST['txt_prn_mother_occupation']) ? $_REQUEST['txt_prn_mother_occupation'] : '';
            $txt_prn_mother_addr_v = isset($_REQUEST['txt_prn_mother_addr_v']) ? $_REQUEST['txt_prn_mother_addr_v'] : '';
            $txt_prn_mother_addr_c = isset($_REQUEST['txt_prn_mother_addr_c']) ? $_REQUEST['txt_prn_mother_addr_c'] : '';
            $txt_prn_mother_addr_d = isset($_REQUEST['txt_prn_mother_addr_d']) ? $_REQUEST['txt_prn_mother_addr_d'] : '';
            $txt_prn_mother_addr_p = isset($_REQUEST['txt_prn_mother_addr_p']) ? $_REQUEST['txt_prn_mother_addr_p'] : '';
            $txt_prn_mother_addr_cn = isset($_REQUEST['txt_prn_mother_addr_cn']) ? $_REQUEST['txt_prn_mother_addr_cn'] : '';
            $txt_prn_mother_file = !empty($_FILES['txt_prn_mother_file']) ? $_FILES['txt_prn_mother_file']['name'] : '';
            $txt_prn_mother_filex = !empty($txt_prn_mother_file) ? $txt_prn_mother_file : '';
            $txt_prn_mother_contact = isset($_REQUEST['txt_prn_mother_contact']) ? $_REQUEST['txt_prn_mother_contact'] : '';

        //Guardian
            $txt_prn_guardian_relationship = isset($_REQUEST['txt_prn_guardian_relationship']) ? $_REQUEST['txt_prn_guardian_relationship'] : '';
            $txt_prn_guardian_fname = isset($_REQUEST['txt_prn_guardian_fname']) ? $_REQUEST['txt_prn_guardian_fname'] : '';
            $txt_prn_guardian_lname = isset($_REQUEST['txt_prn_guardian_lname']) ? $_REQUEST['txt_prn_guardian_lname'] : '';
            $txt_prn_guardian_nick_name = isset($_REQUEST['txt_prn_guardian_nick_name']) ? $_REQUEST['txt_prn_guardian_nick_name'] : '';
            $txt_prn_guardian_dob = isset($_REQUEST['txt_prn_guardian_dob']) ? $_REQUEST['txt_prn_guardian_dob'] : '';
            $txt_prn_guardian_origin = isset($_REQUEST['txt_prn_guardian_origin']) ? $_REQUEST['txt_prn_guardian_origin'] : '';
            $txt_prn_guardian_nationality = isset($_REQUEST['txt_prn_guardian_nationality']) ? $_REQUEST['txt_prn_guardian_nationality'] : '';
            $txt_prn_guardian_id_number = isset($_REQUEST['txt_prn_guardian_id_number']) ? $_REQUEST['txt_prn_guardian_id_number'] : '';
            $txt_prn_guardian_id_expire_date = isset($_REQUEST['txt_prn_guardian_id_expire_date']) ? $_REQUEST['txt_prn_guardian_id_expire_date'] : '';
            $txt_prn_guardian_pob_v = isset($_REQUEST['txt_prn_guardian_pob_v']) ? $_REQUEST['txt_prn_guardian_pob_v'] : '';
            $txt_prn_guardian_pob_c = isset($_REQUEST['txt_prn_guardian_pob_c']) ? $_REQUEST['txt_prn_guardian_pob_c'] : '';
            $txt_prn_guardian_pob_d = isset($_REQUEST['txt_prn_guardian_pob_d']) ? $_REQUEST['txt_prn_guardian_pob_d'] : '';
            $txt_prn_guardian_pob_p = isset($_REQUEST['txt_prn_guardian_pob_p']) ? $_REQUEST['txt_prn_guardian_pob_p'] : '';
            $txt_prn_guardian_pob_cn = isset($_REQUEST['txt_prn_guardian_pob_cn']) ? $_REQUEST['txt_prn_guardian_pob_cn'] : '';
            $txt_prn_guardian_edu = isset($_REQUEST['txt_prn_guardian_edu']) ? $_REQUEST['txt_prn_guardian_edu'] : '';
            $txt_prn_guardian_occupation = isset($_REQUEST['txt_prn_guardian_occupation']) ? $_REQUEST['txt_prn_guardian_occupation'] : '';
            $txt_prn_guardian_addr_v = isset($_REQUEST['txt_prn_guardian_addr_v']) ? $_REQUEST['txt_prn_guardian_addr_v'] : '';
            $txt_prn_guardian_addr_c = isset($_REQUEST['txt_prn_guardian_addr_c']) ? $_REQUEST['txt_prn_guardian_addr_c'] : '';
            $txt_prn_guardian_addr_d = isset($_REQUEST['txt_prn_guardian_addr_d']) ? $_REQUEST['txt_prn_guardian_addr_d'] : '';
            $txt_prn_guardian_addr_p = isset($_REQUEST['txt_prn_guardian_addr_p']) ? $_REQUEST['txt_prn_guardian_addr_p'] : '';
            $txt_prn_guardian_addr_cn = isset($_REQUEST['txt_prn_guardian_addr_cn']) ? $_REQUEST['txt_prn_guardian_addr_cn'] : '';
            $txt_prn_guardian_file = !empty($_FILES['txt_prn_guardian_file']) ? $_FILES['txt_prn_guardian_file']['name'] : '';
            $txt_prn_guardian_filex = !empty($txt_prn_guardian_file) ? $txt_prn_guardian_file : '';
            $txt_prn_guardian_contact = isset($_REQUEST['txt_prn_guardian_contact']) ? $_REQUEST['txt_prn_guardian_contact'] : '';

        $bt_command = bt_add_label;
        $fm_title = txt_add_new_referer;
    }elseif($_REQUEST['fmCommand'] == 'edit'){

        //Father
        if(empty($father)){

            $txt_prn_father_fname = isset($_REQUEST['txt_prn_father_fname']) ? $_REQUEST['txt_prn_father_fname'] : '';
            $txt_prn_father_lname = isset($_REQUEST['txt_prn_father_lname']) ? $_REQUEST['txt_prn_father_lname'] : '';
            $txt_prn_father_nick_name = isset($_REQUEST['txt_prn_father_nick_name']) ? $_REQUEST['txt_prn_father_nick_name'] : '';
            $txt_prn_father_dob = isset($_REQUEST['txt_prn_father_dob']) ? $_REQUEST['txt_prn_father_dob'] : '';
            $txt_prn_father_origin = isset($_REQUEST['txt_prn_father_origin']) ? $_REQUEST['txt_prn_father_origin'] : '';
            $txt_prn_father_nationality = isset($_REQUEST['txt_prn_father_nationality']) ? $_REQUEST['txt_prn_father_nationality'] : '';
            $txt_prn_father_id_number = isset($_REQUEST['txt_prn_father_id_number']) ? $_REQUEST['txt_prn_father_id_number'] : '';
            $txt_prn_father_id_expire_date = isset($_REQUEST['txt_prn_father_id_expire_date']) ? $_REQUEST['txt_prn_father_id_expire_date'] : '';
            $txt_prn_father_pob_v = isset($_REQUEST['txt_prn_father_pob_v']) ? $_REQUEST['txt_prn_father_pob_v'] : '';
            $txt_prn_father_pob_c = isset($_REQUEST['txt_prn_father_pob_c']) ? $_REQUEST['txt_prn_father_pob_c'] : '';
            $txt_prn_father_pob_d = isset($_REQUEST['txt_prn_father_pob_d']) ? $_REQUEST['txt_prn_father_pob_d'] : '';
            $txt_prn_father_pob_p = isset($_REQUEST['txt_prn_father_pob_p']) ? $_REQUEST['txt_prn_father_pob_p'] : '';
            $txt_prn_father_pob_cn = isset($_REQUEST['txt_prn_father_pob_cn']) ? $_REQUEST['txt_prn_father_pob_cn'] : '';
            $txt_prn_father_edu = isset($_REQUEST['txt_prn_father_edu']) ? $_REQUEST['txt_prn_father_edu'] : '';
            $txt_prn_father_occupation = isset($_REQUEST['txt_prn_father_occupation']) ? $_REQUEST['txt_prn_father_occupation'] : '';
            $txt_prn_father_addr_v = isset($_REQUEST['txt_prn_father_addr_v']) ? $_REQUEST['txt_prn_father_addr_v'] : '';
            $txt_prn_father_addr_c = isset($_REQUEST['txt_prn_father_addr_c']) ? $_REQUEST['txt_prn_father_addr_c'] : '';
            $txt_prn_father_addr_d = isset($_REQUEST['txt_prn_father_addr_d']) ? $_REQUEST['txt_prn_father_addr_d'] : '';
            $txt_prn_father_addr_p = isset($_REQUEST['txt_prn_father_addr_p']) ? $_REQUEST['txt_prn_father_addr_p'] : '';
            $txt_prn_father_addr_cn = isset($_REQUEST['txt_prn_father_addr_cn']) ? $_REQUEST['txt_prn_father_addr_cn'] : '';
            $txt_prn_father_file = isset($_FILES['txt_prn_father_file']) ? $_FILES['txt_prn_father_file']['name'] : '';
            $txt_prn_father_filex = !empty($txt_prn_father_file) ? $txt_prn_father_file : '';
            $txt_prn_father_contact = isset($_REQUEST['txt_prn_father_contact']) ? $_REQUEST['txt_prn_father_contact'] : '';

        }else{

            $q = "SELECT * FROM `tb_fathers` WHERE(`prn_father_id`='".$father."')";
            if(!$rs = $vtmdb->query($q)){ die("Error query table father."); }
            $r = $rs->fetch_assoc();

            $txt_prn_father_fname = isset($_REQUEST['txt_prn_father_fname']) ? $_REQUEST['txt_prn_father_fname'] : @$r['prn_father_fname'];
            $txt_prn_father_lname = isset($_REQUEST['txt_prn_father_lname']) ? $_REQUEST['txt_prn_father_lname'] : @$r['prn_father_lname'];
            $txt_prn_father_nick_name = isset($_REQUEST['txt_prn_father_nick_name']) ? $_REQUEST['txt_prn_father_nick_name'] : @$r['prn_father_nick_name'];
            $txt_prn_father_dob = isset($_REQUEST['txt_prn_father_dob']) ? $_REQUEST['txt_prn_father_dob'] : @$r['prn_father_dob'];
            $txt_prn_father_origin = isset($_REQUEST['txt_prn_father_origin']) ? $_REQUEST['txt_prn_father_origin'] : @$r['prn_father_origin'];
            $txt_prn_father_nationality = isset($_REQUEST['txt_prn_father_nationality']) ? $_REQUEST['txt_prn_father_nationality'] : @$r['prn_father_nationality'];
            $txt_prn_father_id_number = isset($_REQUEST['txt_prn_father_id_number']) ? $_REQUEST['txt_prn_father_id_number'] : @$r['prn_father_id_number'];
            $txt_prn_father_id_expire_date = isset($_REQUEST['txt_prn_father_id_expire_date']) ? $_REQUEST['txt_prn_father_id_expire_date'] : @$r['prn_father_id_expire_date'];
            $txt_prn_father_pob_v = isset($_REQUEST['txt_prn_father_pob_v']) ? $_REQUEST['txt_prn_father_pob_v'] : @$r['prn_father_pob_v'];
            $txt_prn_father_pob_c = isset($_REQUEST['txt_prn_father_pob_c']) ? $_REQUEST['txt_prn_father_pob_c'] : @$r['prn_father_pob_c'];
            $txt_prn_father_pob_d = isset($_REQUEST['txt_prn_father_pob_d']) ? $_REQUEST['txt_prn_father_pob_d'] : @$r['prn_father_pob_d'];
            $txt_prn_father_pob_p = isset($_REQUEST['txt_prn_father_pob_p']) ? $_REQUEST['txt_prn_father_pob_p'] : @$r['prn_father_pob_p'];
            $txt_prn_father_pob_cn = isset($_REQUEST['txt_prn_father_pob_cn']) ? $_REQUEST['txt_prn_father_pob_cn'] : @$r['prn_father_pob_cn'];
            $txt_prn_father_edu = isset($_REQUEST['txt_prn_father_edu']) ? $_REQUEST['txt_prn_father_edu'] : @$r['prn_father_edu'];
            $txt_prn_father_occupation = isset($_REQUEST['txt_prn_father_occupation']) ? $_REQUEST['txt_prn_father_occupation'] : @$r['prn_father_occupation'];
            $txt_prn_father_addr_v = isset($_REQUEST['txt_prn_father_addr_v']) ? $_REQUEST['txt_prn_father_addr_v'] : @$r['prn_father_addr_v'];
            $txt_prn_father_addr_c = isset($_REQUEST['txt_prn_father_addr_c']) ? $_REQUEST['txt_prn_father_addr_c'] : @$r['prn_father_addr_c'];
            $txt_prn_father_addr_d = isset($_REQUEST['txt_prn_father_addr_d']) ? $_REQUEST['txt_prn_father_addr_d'] : @$r['prn_father_addr_d'];
            $txt_prn_father_addr_p = isset($_REQUEST['txt_prn_father_addr_p']) ? $_REQUEST['txt_prn_father_addr_p'] : @$r['prn_father_addr_p'];
            $txt_prn_father_addr_cn = isset($_REQUEST['txt_prn_father_addr_cn']) ? $_REQUEST['txt_prn_father_addr_cn'] : @$r['prn_father_addr_cn'];
            $txt_prn_father_file = isset($_FILES['txt_prn_father_file']) ? $_FILES['txt_prn_father_file']['name'] : '';
            $txt_prn_father_filex = !empty($r['prn_father_file']) ? $r['prn_father_file'] : (!empty($prn_father_file) ? $prn_father_file : '');
            $txt_prn_father_contact = isset($_REQUEST['txt_prn_father_contact']) ? $_REQUEST['txt_prn_father_contact'] : @$r['prn_father_contact'];

        }

        //Mother
        if(empty($mother)){

            $txt_prn_mother_fname = isset($_REQUEST['txt_prn_mother_fname']) ? $_REQUEST['txt_prn_mother_fname'] : '';
            $txt_prn_mother_lname = isset($_REQUEST['txt_prn_mother_lname']) ? $_REQUEST['txt_prn_mother_lname'] : '';
            $txt_prn_mother_nick_name = isset($_REQUEST['txt_prn_mother_nick_name']) ? $_REQUEST['txt_prn_mother_nick_name'] : '';
            $txt_prn_mother_dob = isset($_REQUEST['txt_prn_mother_dob']) ? $_REQUEST['txt_prn_mother_dob'] : '';
            $txt_prn_mother_origin = isset($_REQUEST['txt_prn_mother_origin']) ? $_REQUEST['txt_prn_mother_origin'] : '';
            $txt_prn_mother_nationality = isset($_REQUEST['txt_prn_mother_nationality']) ? $_REQUEST['txt_prn_mother_nationality'] : '';
            $txt_prn_mother_id_number = isset($_REQUEST['txt_prn_mother_id_number']) ? $_REQUEST['txt_prn_mother_id_number'] : '';
            $txt_prn_mother_id_expire_date = isset($_REQUEST['txt_prn_mother_id_expire_date']) ? $_REQUEST['txt_prn_mother_id_expire_date'] : '';
            $txt_prn_mother_pob_v = isset($_REQUEST['txt_prn_mother_pob_v']) ? $_REQUEST['txt_prn_mother_pob_v'] : '';
            $txt_prn_mother_pob_c = isset($_REQUEST['txt_prn_mother_pob_c']) ? $_REQUEST['txt_prn_mother_pob_c'] : '';
            $txt_prn_mother_pob_d = isset($_REQUEST['txt_prn_mother_pob_d']) ? $_REQUEST['txt_prn_mother_pob_d'] : '';
            $txt_prn_mother_pob_p = isset($_REQUEST['txt_prn_mother_pob_p']) ? $_REQUEST['txt_prn_mother_pob_p'] : '';
            $txt_prn_mother_pob_cn = isset($_REQUEST['txt_prn_mother_pob_cn']) ? $_REQUEST['txt_prn_mother_pob_cn'] : '';
            $txt_prn_mother_edu = isset($_REQUEST['txt_prn_mother_edu']) ? $_REQUEST['txt_prn_mother_edu'] : '';
            $txt_prn_mother_occupation = isset($_REQUEST['txt_prn_mother_occupation']) ? $_REQUEST['txt_prn_mother_occupation'] : '';
            $txt_prn_mother_addr_v = isset($_REQUEST['txt_prn_mother_addr_v']) ? $_REQUEST['txt_prn_mother_addr_v'] : '';
            $txt_prn_mother_addr_c = isset($_REQUEST['txt_prn_mother_addr_c']) ? $_REQUEST['txt_prn_mother_addr_c'] : '';
            $txt_prn_mother_addr_d = isset($_REQUEST['txt_prn_mother_addr_d']) ? $_REQUEST['txt_prn_mother_addr_d'] : '';
            $txt_prn_mother_addr_p = isset($_REQUEST['txt_prn_mother_addr_p']) ? $_REQUEST['txt_prn_mother_addr_p'] : '';
            $txt_prn_mother_addr_cn = isset($_REQUEST['txt_prn_mother_addr_cn']) ? $_REQUEST['txt_prn_mother_addr_cn'] : '';
            $txt_prn_mother_file = isset($_FILES['txt_prn_mother_file']) ? $_FILES['txt_prn_mother_file']['name'] : '';
            $txt_prn_mother_filex = !empty($txt_prn_mother_file) ? $txt_prn_mother_file : '';
            $txt_prn_mother_contact = isset($_REQUEST['txt_prn_mother_contact']) ? $_REQUEST['txt_prn_mother_contact'] : '';

        }else{

            $q = "SELECT * FROM `tb_mothers` WHERE(`prn_mother_id`='".$mother."')";
            if(!$rs = $vtmdb->query($q)){ die("Error query table mother."); }
            $r = $rs->fetch_assoc();

            $txt_prn_mother_fname = isset($_REQUEST['txt_prn_mother_fname']) ? $_REQUEST['txt_prn_mother_fname'] : @$r['prn_mother_fname'];
            $txt_prn_mother_lname = isset($_REQUEST['txt_prn_mother_lname']) ? $_REQUEST['txt_prn_mother_lname'] : @$r['prn_mother_lname'];
            $txt_prn_mother_nick_name = isset($_REQUEST['txt_prn_mother_nick_name']) ? $_REQUEST['txt_prn_mother_nick_name'] : @$r['prn_mother_nick_name'];
            $txt_prn_mother_dob = isset($_REQUEST['txt_prn_mother_dob']) ? $_REQUEST['txt_prn_mother_dob'] : @$r['prn_mother_dob'];
            $txt_prn_mother_origin = isset($_REQUEST['txt_prn_mother_origin']) ? $_REQUEST['txt_prn_mother_origin'] : @$r['prn_mother_origin'];
            $txt_prn_mother_nationality = isset($_REQUEST['txt_prn_mother_nationality']) ? $_REQUEST['txt_prn_mother_nationality'] : @$r['prn_mother_nationality'];
            $txt_prn_mother_id_number = isset($_REQUEST['txt_prn_mother_id_number']) ? $_REQUEST['txt_prn_mother_id_number'] : @$r['prn_mother_id_number'];
            $txt_prn_mother_id_expire_date = isset($_REQUEST['txt_prn_mother_id_expire_date']) ? $_REQUEST['txt_prn_mother_id_expire_date'] : @$r['prn_mother_id_expire_date'];
            $txt_prn_mother_pob_v = isset($_REQUEST['txt_prn_mother_pob_v']) ? $_REQUEST['txt_prn_mother_pob_v'] : @$r['prn_mother_pob_v'];
            $txt_prn_mother_pob_c = isset($_REQUEST['txt_prn_mother_pob_c']) ? $_REQUEST['txt_prn_mother_pob_c'] : @$r['prn_mother_pob_c'];
            $txt_prn_mother_pob_d = isset($_REQUEST['txt_prn_mother_pob_d']) ? $_REQUEST['txt_prn_mother_pob_d'] : @$r['prn_mother_pob_d'];
            $txt_prn_mother_pob_p = isset($_REQUEST['txt_prn_mother_pob_p']) ? $_REQUEST['txt_prn_mother_pob_p'] : @$r['prn_mother_pob_p'];
            $txt_prn_mother_pob_cn = isset($_REQUEST['txt_prn_mother_pob_cn']) ? $_REQUEST['txt_prn_mother_pob_cn'] : @$r['prn_mother_pob_cn'];
            $txt_prn_mother_edu = isset($_REQUEST['txt_prn_mother_edu']) ? $_REQUEST['txt_prn_mother_edu'] : @$r['prn_mother_edu'];
            $txt_prn_mother_occupation = isset($_REQUEST['txt_prn_mother_occupation']) ? $_REQUEST['txt_prn_mother_occupation'] : @$r['prn_mother_occupation'];
            $txt_prn_mother_addr_v = isset($_REQUEST['txt_prn_mother_addr_v']) ? $_REQUEST['txt_prn_mother_addr_v'] : @$r['prn_mother_addr_v'];
            $txt_prn_mother_addr_c = isset($_REQUEST['txt_prn_mother_addr_c']) ? $_REQUEST['txt_prn_mother_addr_c'] : @$r['prn_mother_addr_c'];
            $txt_prn_mother_addr_d = isset($_REQUEST['txt_prn_mother_addr_d']) ? $_REQUEST['txt_prn_mother_addr_d'] : @$r['prn_mother_addr_d'];
            $txt_prn_mother_addr_p = isset($_REQUEST['txt_prn_mother_addr_p']) ? $_REQUEST['txt_prn_mother_addr_p'] : @$r['prn_mother_addr_p'];
            $txt_prn_mother_addr_cn = isset($_REQUEST['txt_prn_mother_addr_cn']) ? $_REQUEST['txt_prn_mother_addr_cn'] : @$r['prn_mother_addr_cn'];
            $txt_prn_mother_file = isset($_FILES['txt_prn_mother_file']) ? $_FILES['txt_prn_mother_file']['name'] : '';
            $txt_prn_mother_filex = !empty($r['prn_mother_file']) ? $r['prn_mother_file'] : (!empty($prn_mother_file) ? $prn_mother_file : '');
            $txt_prn_mother_contact = isset($_REQUEST['txt_prn_mother_contact']) ? $_REQUEST['txt_prn_mother_contact'] : @$r['prn_mother_contact'];

        }

        //Guardian
        if(empty($guardian)){

            $txt_prn_guardian_relationship = isset($_REQUEST['txt_prn_guardian_relationship']) ? $_REQUEST['txt_prn_guardian_relationship'] : '';
            $txt_prn_guardian_fname = isset($_REQUEST['txt_prn_guardian_fname']) ? $_REQUEST['txt_prn_guardian_fname'] : '';
            $txt_prn_guardian_lname = isset($_REQUEST['txt_prn_guardian_lname']) ? $_REQUEST['txt_prn_guardian_lname'] : '';
            $txt_prn_guardian_nick_name = isset($_REQUEST['txt_prn_guardian_nick_name']) ? $_REQUEST['txt_prn_guardian_nick_name'] : '';
            $txt_prn_guardian_dob = isset($_REQUEST['txt_prn_guardian_dob']) ? $_REQUEST['txt_prn_guardian_dob'] : '';
            $txt_prn_guardian_origin = isset($_REQUEST['txt_prn_guardian_origin']) ? $_REQUEST['txt_prn_guardian_origin'] : '';
            $txt_prn_guardian_nationality = isset($_REQUEST['txt_prn_guardian_nationality']) ? $_REQUEST['txt_prn_guardian_nationality'] : '';
            $txt_prn_guardian_id_number = isset($_REQUEST['txt_prn_guardian_id_number']) ? $_REQUEST['txt_prn_guardian_id_number'] : '';
            $txt_prn_guardian_id_expire_date = isset($_REQUEST['txt_prn_guardian_id_expire_date']) ? $_REQUEST['txt_prn_guardian_id_expire_date'] : '';
            $txt_prn_guardian_pob_v = isset($_REQUEST['txt_prn_guardian_pob_v']) ? $_REQUEST['txt_prn_guardian_pob_v'] : '';
            $txt_prn_guardian_pob_c = isset($_REQUEST['txt_prn_guardian_pob_c']) ? $_REQUEST['txt_prn_guardian_pob_c'] : '';
            $txt_prn_guardian_pob_d = isset($_REQUEST['txt_prn_guardian_pob_d']) ? $_REQUEST['txt_prn_guardian_pob_d'] : '';
            $txt_prn_guardian_pob_p = isset($_REQUEST['txt_prn_guardian_pob_p']) ? $_REQUEST['txt_prn_guardian_pob_p'] : '';
            $txt_prn_guardian_pob_cn = isset($_REQUEST['txt_prn_guardian_pob_cn']) ? $_REQUEST['txt_prn_guardian_pob_cn'] : '';
            $txt_prn_guardian_edu = isset($_REQUEST['txt_prn_guardian_edu']) ? $_REQUEST['txt_prn_guardian_edu'] : '';
            $txt_prn_guardian_occupation = isset($_REQUEST['txt_prn_guardian_occupation']) ? $_REQUEST['txt_prn_guardian_occupation'] : '';
            $txt_prn_guardian_addr_v = isset($_REQUEST['txt_prn_guardian_addr_v']) ? $_REQUEST['txt_prn_guardian_addr_v'] : '';
            $txt_prn_guardian_addr_c = isset($_REQUEST['txt_prn_guardian_addr_c']) ? $_REQUEST['txt_prn_guardian_addr_c'] : '';
            $txt_prn_guardian_addr_d = isset($_REQUEST['txt_prn_guardian_addr_d']) ? $_REQUEST['txt_prn_guardian_addr_d'] : '';
            $txt_prn_guardian_addr_p = isset($_REQUEST['txt_prn_guardian_addr_p']) ? $_REQUEST['txt_prn_guardian_addr_p'] : '';
            $txt_prn_guardian_addr_cn = isset($_REQUEST['txt_prn_guardian_addr_cn']) ? $_REQUEST['txt_prn_guardian_addr_cn'] : '';
            $txt_prn_guardian_file = isset($_FILES['txt_prn_guardian_file']) ? $_FILES['txt_prn_guardian_file']['name'] : '';
            $txt_prn_guardian_filex = !empty($txt_prn_guardian_file) ? $txt_prn_guardian_file : '';
            $txt_prn_guardian_contact = isset($_REQUEST['txt_prn_guardian_contact']) ? $_REQUEST['txt_prn_guardian_contact'] : '';
        }else{

            $q = "SELECT * FROM `tb_guardians` WHERE(`prn_guardian_id`='".$guardian."')";
            if(!$rs = $vtmdb->query($q)){ die("Error query table mother."); }
            $r = $rs->fetch_assoc();

            $txt_prn_guardian_relationship = isset($_REQUEST['txt_prn_guardian_relationship']) ? $_REQUEST['txt_prn_guardian_relationship'] : @$r['prn_guardian_relationship'];
            $txt_prn_guardian_fname = isset($_REQUEST['txt_prn_guardian_fname']) ? $_REQUEST['txt_prn_guardian_fname'] : @$r['prn_guardian_fname'];
            $txt_prn_guardian_lname = isset($_REQUEST['txt_prn_guardian_lname']) ? $_REQUEST['txt_prn_guardian_lname'] : @$r['prn_guardian_lname'];
            $txt_prn_guardian_nick_name = isset($_REQUEST['txt_prn_guardian_nick_name']) ? $_REQUEST['txt_prn_guardian_nick_name'] : @$r['prn_guardian_nick_name'];
            $txt_prn_guardian_dob = isset($_REQUEST['txt_prn_guardian_dob']) ? $_REQUEST['txt_prn_guardian_dob'] : @$r['prn_guardian_dob'];
            $txt_prn_guardian_origin = isset($_REQUEST['txt_prn_guardian_origin']) ? $_REQUEST['txt_prn_guardian_origin'] : @$r['prn_guardian_origin'];
            $txt_prn_guardian_nationality = isset($_REQUEST['txt_prn_guardian_nationality']) ? $_REQUEST['txt_prn_guardian_nationality'] : @$r['prn_guardian_nationality'];
            $txt_prn_guardian_id_number = isset($_REQUEST['txt_prn_guardian_id_number']) ? $_REQUEST['txt_prn_guardian_id_number'] : @$r['prn_guardian_id_number'];
            $txt_prn_guardian_id_expire_date = isset($_REQUEST['txt_prn_guardian_id_expire_date']) ? $_REQUEST['txt_prn_guardian_id_expire_date'] : @$r['prn_guardian_id_expire_date'];
            $txt_prn_guardian_pob_v = isset($_REQUEST['txt_prn_guardian_pob_v']) ? $_REQUEST['txt_prn_guardian_pob_v'] : @$r['prn_guardian_pob_v'];
            $txt_prn_guardian_pob_c = isset($_REQUEST['txt_prn_guardian_pob_c']) ? $_REQUEST['txt_prn_guardian_pob_c'] : @$r['prn_guardian_pob_c'];
            $txt_prn_guardian_pob_d = isset($_REQUEST['txt_prn_guardian_pob_d']) ? $_REQUEST['txt_prn_guardian_pob_d'] : @$r['prn_guardian_pob_d'];
            $txt_prn_guardian_pob_p = isset($_REQUEST['txt_prn_guardian_pob_p']) ? $_REQUEST['txt_prn_guardian_pob_p'] : @$r['prn_guardian_pob_p'];
            $txt_prn_guardian_pob_cn = isset($_REQUEST['txt_prn_guardian_pob_cn']) ? $_REQUEST['txt_prn_guardian_pob_cn'] : @$r['prn_guardian_pob_cn'];
            $txt_prn_guardian_edu = isset($_REQUEST['txt_prn_guardian_edu']) ? $_REQUEST['txt_prn_guardian_edu'] : @$r['prn_guardian_edu'];
            $txt_prn_guardian_occupation = isset($_REQUEST['txt_prn_guardian_occupation']) ? $_REQUEST['txt_prn_guardian_occupation'] : @$r['prn_guardian_occupation'];
            $txt_prn_guardian_addr_v = isset($_REQUEST['txt_prn_guardian_addr_v']) ? $_REQUEST['txt_prn_guardian_addr_v'] : @$r['prn_guardian_addr_v'];
            $txt_prn_guardian_addr_c = isset($_REQUEST['txt_prn_guardian_addr_c']) ? $_REQUEST['txt_prn_guardian_addr_c'] : @$r['prn_guardian_addr_c'];
            $txt_prn_guardian_addr_d = isset($_REQUEST['txt_prn_guardian_addr_d']) ? $_REQUEST['txt_prn_guardian_addr_d'] : @$r['prn_guardian_addr_d'];
            $txt_prn_guardian_addr_p = isset($_REQUEST['txt_prn_guardian_addr_p']) ? $_REQUEST['txt_prn_guardian_addr_p'] : @$r['prn_guardian_addr_p'];
            $txt_prn_guardian_addr_cn = isset($_REQUEST['txt_prn_guardian_addr_cn']) ? $_REQUEST['txt_prn_guardian_addr_cn'] : @$r['prn_guardian_addr_cn'];
            $txt_prn_guardian_file = isset($_FILES['txt_prn_guardian_file']) ? $_FILES['txt_prn_guardian_file']['name'] : '';
            $txt_prn_guardian_filex = !empty($r['prn_guardian_file']) ? $r['prn_guardian_file'] : (!empty($prn_guardian_file) ? $prn_guardian_file : '');
            $txt_prn_guardian_contact = isset($_REQUEST['txt_prn_guardian_contact']) ? $_REQUEST['txt_prn_guardian_contact'] : @$r['prn_guardian_contact'];

        }            
        
        $bt_command = bt_edit_label;
        $fm_title = txt_edit_referer;
    }elseif($_REQUEST['fmCommand'] == 'delete'){
        if(isset($_REQUEST['id'])){
            $q = "SELECT * FROM `tb_parents` WHERE (`cas_number`='".decode128($_REQUEST['id'])."')";
            if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
            $r = $rs->fetch_assoc();
        }

        $bt_command = bt_delete_label;
        $fm_title = txt_delete;
    }else{
        echo '<script type="text/javascript" language="javascript">
                window.close();
            </script>';
    }
}else{
    echo '<script type="text/javascript" language="javascript">
            window.close();
        </script>';
}

//Execution
//
if(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == 'next'){
    
    echo "<script language='javascript' type='text/javascript'>
                window.open('fmvictims.php?fmCommand=edit&load_child_form=f0101&n=".$txt_case_number."','_self');
            </script> ";
    
}elseif(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == 'save'){

    if(empty($father)){
        //Add father
        //upload father's file if any
        if(!empty($txt_prn_father_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_prn_father_filex'])){
                unlink($target_path.$_REQUEST['txt_prn_father_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_f_".$_FILES['txt_prn_father_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_prn_father_file']['tmp_name'], $target_path)) {
                $txt_prn_father_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_prn_father_file = $txt_case_number."_f_".$_FILES['txt_prn_father_file']['name'];
            }
            $txt_prn_father_filex = $txt_prn_father_file;
        }else{
            $txt_prn_father_file = !empty($txt_prn_father_filex) ? $txt_prn_father_filex : '';
        }

        $qf = "INSERT INTO `tb_fathers`(`prn_case_number`
                                        ,`prn_father_fname`
                                        ,`prn_father_lname`
                                        ,`prn_father_nick_name`
                                        ,`prn_father_dob`
                                        ,`prn_father_pob_v`
                                        ,`prn_father_pob_c`
                                        ,`prn_father_pob_d`
                                        ,`prn_father_pob_p`
                                        ,`prn_father_pob_cn`
                                        ,`prn_father_origin`
                                        ,`prn_father_nationality`
                                        ,`prn_father_id_number`
                                        ,`prn_father_id_expire_date`
                                        ,`prn_father_edu`
                                        ,`prn_father_occupation`
                                        ,`prn_father_addr_v`
                                        ,`prn_father_addr_c`
                                        ,`prn_father_addr_d`
                                        ,`prn_father_addr_p`
                                        ,`prn_father_addr_cn`
                                        ,`prn_father_file`
                                        ,`prn_father_contact`) 
                                VALUES('".$txt_case_number."'
                                        ,'".$txt_prn_father_fname."'
                                        ,'".$txt_prn_father_lname."'
                                        ,'".$txt_prn_father_nick_name."'
                                        ,'".$txt_prn_father_dob."'
                                        ,'".$txt_prn_father_pob_v."'
                                        ,'".$txt_prn_father_pob_c."'
                                        ,'".$txt_prn_father_pob_d."'
                                        ,'".$txt_prn_father_pob_p."'
                                        ,'".$txt_prn_father_pob_cn."'
                                        ,'".$txt_prn_father_origin."'
                                        ,'".$txt_prn_father_nationality."'
                                        ,'".$txt_prn_father_id_number."'
                                        ,'".$txt_prn_father_id_expire_date."'
                                        ,'".$txt_prn_father_edu."'
                                        ,'".$txt_prn_father_occupation."'
                                        ,'".$txt_prn_father_addr_v."'
                                        ,'".$txt_prn_father_addr_c."'
                                        ,'".$txt_prn_father_addr_d."'
                                        ,'".$txt_prn_father_addr_p."'
                                        ,'".$txt_prn_father_addr_cn."'
                                        ,'".$txt_prn_father_file."'
                                        ,'".$txt_prn_father_contact."')";
        //Execut query
        if(!$vtmdb->query($qf)){ die("Error insert into fathe!"); }else{ $success += 1; }
    }else{
        //Update father if already exist.
        //upload father's file if any
        if(!empty($txt_prn_father_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_prn_father_filex'])){
                unlink($target_path.$_REQUEST['txt_prn_father_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_f_".$_FILES['txt_prn_father_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_prn_father_file']['tmp_name'], $target_path)) {
                $txt_prn_father_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_prn_father_file = $txt_case_number."_f_".$_FILES['txt_prn_father_file']['name'];
            }
            $txt_prn_father_filex = $txt_prn_father_file;
        }else{
            $txt_prn_father_file = !empty($txt_prn_father_filex) ? $txt_prn_father_filex : '';
        }

        $qf = "UPDATE `tb_fathers` SET  `prn_father_fname`='".$txt_prn_father_fname."'
                                        ,`prn_father_lname`='".$txt_prn_father_lname."'
                                        ,`prn_father_nick_name`='".$txt_prn_father_nick_name."'
                                        ,`prn_father_dob`='".$txt_prn_father_dob."'
                                        ,`prn_father_pob_v`='".$txt_prn_father_pob_v."'
                                        ,`prn_father_pob_c`='".$txt_prn_father_pob_c."'
                                        ,`prn_father_pob_d`='".$txt_prn_father_pob_d."'
                                        ,`prn_father_pob_p`='".$txt_prn_father_pob_p."'
                                        ,`prn_father_pob_cn`='".$txt_prn_father_pob_cn."'
                                        ,`prn_father_origin`='".$txt_prn_father_origin."'
                                        ,`prn_father_nationality`='".$txt_prn_father_nationality."'
                                        ,`prn_father_id_number`='".$txt_prn_father_id_number."'
                                        ,`prn_father_id_expire_date`='".$txt_prn_father_id_expire_date."'
                                        ,`prn_father_edu`='".$txt_prn_father_edu."'
                                        ,`prn_father_occupation`='".$txt_prn_father_occupation."'
                                        ,`prn_father_addr_v`='".$txt_prn_father_addr_v."'
                                        ,`prn_father_addr_c`='".$txt_prn_father_addr_c."'
                                        ,`prn_father_addr_d`='".$txt_prn_father_addr_d."'
                                        ,`prn_father_addr_p`='".$txt_prn_father_addr_p."'
                                        ,`prn_father_addr_cn`='".$txt_prn_father_addr_cn."'
                                        ,`prn_father_file`='".$txt_prn_father_file."'
                                        ,`prn_father_contact`='".$txt_prn_father_contact."'
                                WHERE(`prn_father_id` = '".$father."')";
        //Execut query
        if(!$vtmdb->query($qf)){ die("Error update fathe!"); }else{ $success += 1; }
    }

    if(empty($mother)){
        //Add mother
        //upload mother's file if any
        if(!empty($txt_prn_mother_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_prn_mother_filex'])){
                unlink($target_path.$_REQUEST['txt_prn_mother_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_m_".$_FILES['txt_prn_mother_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_prn_mother_file']['tmp_name'], $target_path)) {
                $txt_prn_mother_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_prn_mother_file = $txt_case_number."_m_".$_FILES['txt_prn_mother_file']['name'];
            }
            $txt_prn_mother_filex = $txt_prn_mother_file;
        }else{
            $txt_prn_mother_file = !empty($txt_prn_mother_filex) ? $txt_prn_mother_filex : '';
        }

        $qm = "INSERT INTO `tb_mothers`(`prn_case_number`
                                        ,`prn_mother_fname`
                                        ,`prn_mother_lname`
                                        ,`prn_mother_nick_name`
                                        ,`prn_mother_dob`
                                        ,`prn_mother_pob_v`
                                        ,`prn_mother_pob_c`
                                        ,`prn_mother_pob_d`
                                        ,`prn_mother_pob_p`
                                        ,`prn_mother_pob_cn`
                                        ,`prn_mother_origin`
                                        ,`prn_mother_nationality`
                                        ,`prn_mother_id_number`
                                        ,`prn_mother_id_expire_date`
                                        ,`prn_mother_edu`
                                        ,`prn_mother_occupation`
                                        ,`prn_mother_addr_v`
                                        ,`prn_mother_addr_c`
                                        ,`prn_mother_addr_d`
                                        ,`prn_mother_addr_p`
                                        ,`prn_mother_addr_cn`
                                        ,`prn_mother_file`
                                        ,`prn_mother_contact`) 
                                VALUES('".$txt_case_number."'
                                        ,'".$txt_prn_mother_fname."'
                                        ,'".$txt_prn_mother_lname."'
                                        ,'".$txt_prn_mother_nick_name."'
                                        ,'".$txt_prn_mother_dob."'
                                        ,'".$txt_prn_mother_pob_v."'
                                        ,'".$txt_prn_mother_pob_c."'
                                        ,'".$txt_prn_mother_pob_d."'
                                        ,'".$txt_prn_mother_pob_p."'
                                        ,'".$txt_prn_mother_pob_cn."'
                                        ,'".$txt_prn_mother_origin."'
                                        ,'".$txt_prn_mother_nationality."'
                                        ,'".$txt_prn_mother_id_number."'
                                        ,'".$txt_prn_mother_id_expire_date."'
                                        ,'".$txt_prn_mother_edu."'
                                        ,'".$txt_prn_mother_occupation."'
                                        ,'".$txt_prn_mother_addr_v."'
                                        ,'".$txt_prn_mother_addr_c."'
                                        ,'".$txt_prn_mother_addr_d."'
                                        ,'".$txt_prn_mother_addr_p."'
                                        ,'".$txt_prn_mother_addr_cn."'
                                        ,'".$txt_prn_mother_file."'
                                        ,'".$txt_prn_mother_contact."')";
        //Execute
        if(!$vtmdb->query($qm)){ die("Error insert into mother!".$vtmdb->error); }else{ $success += 1; }
        
    }else{

        //Add mother
        //upload mother's file if any
        if(!empty($txt_prn_mother_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_prn_mother_filex'])){
                unlink($target_path.$_REQUEST['txt_prn_mother_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_m_".$_FILES['txt_prn_mother_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_prn_mother_file']['tmp_name'], $target_path)) {
                $txt_prn_mother_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_prn_mother_file = $txt_case_number."_m_".$_FILES['txt_prn_mother_file']['name'];
            }
            $txt_prn_mother_filex = $txt_prn_mother_file;
        }else{
            $txt_prn_mother_file = !empty($txt_prn_mother_filex) ? $txt_prn_mother_filex : '';
        }

        //Update mother if already exist.
        $qm = "UPDATE `tb_mothers` SET `prn_mother_fname`='".$txt_prn_mother_fname."'
                                        ,`prn_mother_lname`='".$txt_prn_mother_lname."'
                                        ,`prn_mother_nick_name`='".$txt_prn_mother_nick_name."'
                                        ,`prn_mother_dob`='".$txt_prn_mother_dob."'
                                        ,`prn_mother_pob_v`='".$txt_prn_mother_pob_v."'
                                        ,`prn_mother_pob_c`='".$txt_prn_mother_pob_c."'
                                        ,`prn_mother_pob_d`='".$txt_prn_mother_pob_d."'
                                        ,`prn_mother_pob_p`='".$txt_prn_mother_pob_p."'
                                        ,`prn_mother_pob_cn`='".$txt_prn_mother_pob_cn."'
                                        ,`prn_mother_origin`='".$txt_prn_mother_origin."'
                                        ,`prn_mother_nationality`='".$txt_prn_mother_nationality."'
                                        ,`prn_mother_id_number`='".$txt_prn_mother_id_number."'
                                        ,`prn_mother_id_expire_date`='".$txt_prn_mother_id_expire_date."'
                                        ,`prn_mother_edu`='".$txt_prn_mother_edu."'
                                        ,`prn_mother_occupation`='".$txt_prn_mother_occupation."'
                                        ,`prn_mother_addr_v`='".$txt_prn_mother_addr_v."'
                                        ,`prn_mother_addr_c`='".$txt_prn_mother_addr_c."'
                                        ,`prn_mother_addr_d`='".$txt_prn_mother_addr_d."'
                                        ,`prn_mother_addr_p`='".$txt_prn_mother_addr_p."'
                                        ,`prn_mother_addr_cn`='".$txt_prn_mother_addr_cn."'
                                        ,`prn_mother_file`='".$txt_prn_mother_file."'
                                        ,`prn_mother_contact`='".$txt_prn_mother_contact."'  
                                WHERE(`prn_mother_id`=".$mother.")";
        //Execute
        if(!$vtmdb->query($qm)){ die("Error update mother!".$vtmdb->error); }else{ $success += 1; }
    }

    if(empty($guardian)){
        //Add guardian
        //upload Guardian's file if any
        if(!empty($txt_prn_guardian_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_prn_guardian_filex'])){
                unlink($target_path.$_REQUEST['txt_prn_guardian_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_g_".$_FILES['txt_prn_guardian_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_prn_guardian_file']['tmp_name'], $target_path)) {
                $txt_prn_guardian_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_prn_guardian_file = $txt_case_number."_g_".$_FILES['txt_prn_guardian_file']['name'];
            }
            $txt_prn_guardian_filex = $txt_prn_guardian_file;
        }else{
            $txt_prn_guardian_file = !empty($txt_prn_guardian_filex) ? $txt_prn_guardian_filex : '';
        }
        
        $qg = "INSERT INTO `tb_guardians`(`prn_case_number`
                                        ,`prn_guardian_relationship`
                                        ,`prn_guardian_fname`
                                        ,`prn_guardian_lname`
                                        ,`prn_guardian_nick_name`
                                        ,`prn_guardian_dob`
                                        ,`prn_guardian_pob_v`
                                        ,`prn_guardian_pob_c`
                                        ,`prn_guardian_pob_d`
                                        ,`prn_guardian_pob_p`
                                        ,`prn_guardian_pob_cn`
                                        ,`prn_guardian_origin`
                                        ,`prn_guardian_nationality`
                                        ,`prn_guardian_id_number`
                                        ,`prn_guardian_id_expire_date`
                                        ,`prn_guardian_edu`
                                        ,`prn_guardian_occupation`
                                        ,`prn_guardian_addr_v`
                                        ,`prn_guardian_addr_c`
                                        ,`prn_guardian_addr_d`
                                        ,`prn_guardian_addr_p`
                                        ,`prn_guardian_addr_cn`
                                        ,`prn_guardian_file`
                                        ,`prn_guardian_contact`)  
                                VALUES ('".$txt_case_number."'
                                        ,'".$txt_prn_guardian_relationship."'
                                        ,'".$txt_prn_guardian_fname."'
                                        ,'".$txt_prn_guardian_lname."'
                                        ,'".$txt_prn_guardian_nick_name."'
                                        ,'".$txt_prn_guardian_dob."'
                                        ,'".$txt_prn_guardian_pob_v."'
                                        ,'".$txt_prn_guardian_pob_c."'
                                        ,'".$txt_prn_guardian_pob_d."'
                                        ,'".$txt_prn_guardian_pob_p."'
                                        ,'".$txt_prn_guardian_pob_cn."'
                                        ,'".$txt_prn_guardian_origin."'
                                        ,'".$txt_prn_guardian_nationality."'
                                        ,'".$txt_prn_guardian_id_number."'
                                        ,'".$txt_prn_guardian_id_expire_date."'
                                        ,'".$txt_prn_guardian_edu."'
                                        ,'".$txt_prn_guardian_occupation."'
                                        ,'".$txt_prn_guardian_addr_v."'
                                        ,'".$txt_prn_guardian_addr_c."'
                                        ,'".$txt_prn_guardian_addr_d."'
                                        ,'".$txt_prn_guardian_addr_p."'
                                        ,'".$txt_prn_guardian_addr_cn."'
                                        ,'".$txt_prn_guardian_file."'
                                        ,'".$txt_prn_guardian_contact."')";
        //Execute
        if(!$vtmdb->query($qg)){ die("Error insert into guardian!".$vtmdb->error); }else{ $success += 1; }
    }else{
        //Update guardian if already exist.
        //Add guardian
        //upload Guardian's file if any
        if(!empty($txt_prn_guardian_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_prn_guardian_filex'])){
                unlink($target_path.$_REQUEST['txt_prn_guardian_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_g_".$_FILES['txt_prn_guardian_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_prn_guardian_file']['tmp_name'], $target_path)) {
                $txt_prn_guardian_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_prn_guardian_file = $txt_case_number."_g_".$_FILES['txt_prn_guardian_file']['name'];
            }
            $txt_prn_guardian_filex = $txt_prn_guardian_file;
        }else{
            $txt_prn_guardian_file = !empty($txt_prn_guardian_filex) ? $txt_prn_guardian_filex : '';
        }
        
        $qg = "UPDATE `tb_guardians` SET `prn_guardian_relationship`='".$txt_prn_guardian_relationship."'
                                        ,`prn_guardian_fname`='".$txt_prn_guardian_fname."'
                                        ,`prn_guardian_lname`='".$txt_prn_guardian_lname."'
                                        ,`prn_guardian_nick_name`='".$txt_prn_guardian_nick_name."'
                                        ,`prn_guardian_dob`='".$txt_prn_guardian_dob."'
                                        ,`prn_guardian_pob_v`='".$txt_prn_guardian_pob_v."'
                                        ,`prn_guardian_pob_c`='".$txt_prn_guardian_pob_c."'
                                        ,`prn_guardian_pob_d`='".$txt_prn_guardian_pob_d."'
                                        ,`prn_guardian_pob_p`='".$txt_prn_guardian_pob_p."'
                                        ,`prn_guardian_pob_cn`='".$txt_prn_guardian_pob_cn."'
                                        ,`prn_guardian_origin`='".$txt_prn_guardian_origin."'
                                        ,`prn_guardian_nationality`='".$txt_prn_guardian_nationality."'
                                        ,`prn_guardian_id_number`='".$txt_prn_guardian_id_number."'
                                        ,`prn_guardian_id_expire_date`='".$txt_prn_guardian_id_expire_date."'
                                        ,`prn_guardian_edu`='".$txt_prn_guardian_edu."'
                                        ,`prn_guardian_occupation`='".$txt_prn_guardian_occupation."'
                                        ,`prn_guardian_addr_v`='".$txt_prn_guardian_addr_v."'
                                        ,`prn_guardian_addr_c`='".$txt_prn_guardian_addr_c."'
                                        ,`prn_guardian_addr_d`='".$txt_prn_guardian_addr_d."'
                                        ,`prn_guardian_addr_p`='".$txt_prn_guardian_addr_p."'
                                        ,`prn_guardian_addr_cn`='".$txt_prn_guardian_addr_cn."'
                                        ,`prn_guardian_file`='".$txt_prn_guardian_file."'
                                        ,`prn_guardian_contact`='".$txt_prn_guardian_contact."'  
                                WHERE(`prn_guardian_id`=".$guardian.")";
        //Execute
        if(!$vtmdb->query($qg)){ die("Error insert into guardian!".$vtmdb->error); }else{ $success += 1; }
    }

    if($success > 0){
    }
}elseif(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == 'prev'){
    echo "<script language='javascript' type='text/javascript'>
                window.open('fmvictims.php?fmCommand=edit&load_child_form=fm&n=".$txt_case_number."','_self');
            </script> ";
}else{}
?>

<?PHP include("inc/tab_menu.php"); ?>
<script>
    //To modify current tab menu number
    $(document).ready(function(e){
        $("#t2").addClass("t1-active");
    });
</script>

<form name="fm_parent" id="fm_parent" action="" method="post" enctype="multipart/form-data">
    <h1 style="text-align:center;">ផ្នែកទី១</h1>
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><label><?= $txt_case_number ?></label></div>
    </div>

    <!-- Father -->
    <h1 style="text-align:center;" id="bt_father">អំពីឪពុក</h1>
    <section id="father">
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមត្រកូល៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_father_fname" id="txt_prn_father_fname" value="<?= $txt_prn_father_fname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមឈ្មោះ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_father_lname" id="txt_prn_father_lname" value="<?= $txt_prn_father_lname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឈ្មោះហៅក្រៅ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_father_nick_name" id="txt_prn_father_nick_name" value="<?= $txt_prn_father_nick_name ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ថ្ងៃខែឆ្នាំកំណើត៖</div>
        <div class="flex-item-right div-input-row">
            <?PHP
                $t = strtotime("-15 year", time());
                $d = date("Y-m-d", $t);
            ?>
            <input type="date" name="txt_prn_father_dob" id="txt_prn_father_dob" value="<?= $txt_prn_father_dob?>" min="1900-01-01" max="<?= $d ?>" style="width:40%;">
            អាយុ៖ <input type="number" name="txt_prn_father_age" id="txt_prn_father_age" value="" style="width:40%;" disabled="disabled">ឆ្នាំ
            <script>
                $(document).ready(function(e){
                    if($("#txt_prn_father_dob").val() !== ''){
                        var dob = $("#txt_prn_father_dob").val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_prn_father_age").val(age);
                    }

                    $("#txt_prn_father_dob").change(function(){
                        var dob = $(this).val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_prn_father_age").val(age);
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ជនជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_father_origin" id="txt_prn_father_origin">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_prn_father_origin).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">សញ្ជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_father_nationality" id="txt_prn_father_nationality">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_prn_father_nationality).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">លេខ​អត្តសញ្ញាណ​ប័ណ្ណ​សញ្ជាតិ​ខ្មែរ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_father_id_number" id="txt_prn_father_id_number" value="<?= $txt_prn_father_id_number ?>" maxlength="9">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">កាលបរិច្ឆេទ​ផុតកំណត់៖</div>
        <div class="flex-item-right div-input-row">
            នៅមានសុពលភាព៖ <input type="radio" name="txt_prn_father_id_expired" id="txt_prn_father_id_not_expired" value="1" style="width:30px;" checked="checked"> 
            ហួសសុពលភាព៖ <input type="radio" name="txt_prn_father_id_expired" id="txt_prn_father_id_expired" value="-1" style="width:30px;">
            <?PHP
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_prn_father_id_expire_date" id="txt_prn_father_expire_date" min="<?= $d ?>" max="9999" value="<?= $txt_prn_father_id_expire_date ?>">
            <script>
                $(document).ready(function(e){
                    $("#txt_prn_father_id_expired").click(function(){
                        $("#txt_prn_father_expire_date").attr("disabled","disabled");
                    });

                    $("#txt_prn_father_id_not_expired").click(function(){
                        $("#txt_prn_father_expire_date").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>

    <!-- Place of Birth -->
    <div class="flex-container">
        <div class="flex-item-left">ទីកន្លែងកំណើត៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_pob_cn" id="txt_prn_father_pob_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_prn_father_pob_cn;

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_country).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_pob_p" id="txt_prn_father_pob_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_pob_d" id="txt_prn_father_pob_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_pob_c" id="txt_prn_father_pob_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_pob_v" id="txt_prn_father_pob_v" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">
                $(document).ready(function(e) {

                    //load provinces and districts
                    //
                    //load province
                    var id = "<?= $txt_prn_father_pob_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_prn_father_pob_p").empty();
                                $("#txt_prn_father_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_prn_father_pob_d").empty();
                                $("#txt_prn_father_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_father_pob_c").empty();
                                $("#txt_prn_father_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_father_pob_v").empty();
                                $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];

                                    var selected = '';
                                    if(p_id == '<?= $txt_prn_father_pob_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_pob_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_prn_father_pob_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_prn_father_pob_d").empty();
                                $("#txt_prn_father_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_father_pob_c").empty();
                                $("#txt_prn_father_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_father_pob_v").empty();
                                $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_prn_father_pob_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_pob_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_prn_father_pob_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_prn_father_pob_c").empty();
                                $("#txt_prn_father_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_father_pob_v").empty();
                                $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_prn_father_pob_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_pob_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_prn_father_pob_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_prn_father_pob_v").empty();
                                $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_prn_father_pob_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_pob_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_prn_father_pob_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_prn_father_pob_p").empty();
                                    $("#txt_prn_father_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_prn_father_pob_d").empty();
                                    $("#txt_prn_father_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_father_pob_c").empty();
                                    $("#txt_prn_father_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_father_pob_v").empty();
                                    $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_prn_father_pob_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_prn_father_pob_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_prn_father_pob_d").empty();
                                    $("#txt_prn_father_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_father_pob_c").empty();
                                    $("#txt_prn_father_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_father_pob_v").empty();
                                    $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_prn_father_pob_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_prn_father_pob_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_prn_father_pob_c").empty();
                                    $("#txt_prn_father_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_father_pob_v").empty();
                                    $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_prn_father_pob_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_prn_father_pob_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_prn_father_pob_v").empty();
                                    $("#txt_prn_father_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_prn_father_pob_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div> 
    <div class="flex-container">
        <div class="flex-item-left">កម្រិតវប្បធម៌៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_father_edu" id="txt_prn_father_edu" >
                <option value="">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_prn_father_edu) ?>>អនក្ខរកម្ម</option>
                <option value="2" <?= _selected(2,$txt_prn_father_edu) ?>>ថ្នាក់ទី១-៦</option>
                <option value="3" <?= _selected(3,$txt_prn_father_edu) ?>>ថ្នាក់ទី៧-៩</option>
                <option value="4" <?= _selected(4,$txt_prn_father_edu) ?>>ថ្នាក់ទី៩​-១២</option>
                <option value="5"> <?= _selected(5,$txt_prn_father_edu) ?>ទុតិយភូមិ</option>
                <option value="6" <?= _selected(6,$txt_prn_father_edu) ?>>សិស្សិត​មហាវិទ្យាល័យ</option>
                <option value="7" <?= _selected(7,$txt_prn_father_edu) ?>>បរិញ្ញាប័ត្រ</option>
                <option value="8" <?= _selected(8,$txt_prn_father_edu) ?>>បរិញ្ញាប័ត្រជាន់ខ្ពស់</option>
                <option value="9" <?= _selected(9,$txt_prn_father_edu) ?>>បណ្ឌិត</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">មុខរបរ​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_father_occupation" id="txt_prn_father_occupation" >
                <option value="">សូមជ្រើសរើស</option>
                <?php
                    $q2 = "SELECT * FROM `tb_occupations` WHERE(1)";
                    if(!$rs2 = $vtmdb->query($q2)){ die("Error query occupation"); }
                    while($r2 = $rs2->fetch_assoc()){
                        echo '<option value="'.$r2['occ_id'].'" '._selected($r2['occ_id'],$txt_prn_father_occupation).'>'.$r2['occ_name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    
    <!-- Current Address -->
    <div class="flex-container">
        <div class="flex-item-left">អាសយដ្ឋាន​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_addr_cn" id="txt_prn_father_addr_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $_SESSION['cn_id'];

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_prn_father_addr_cn).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_addr_p" id="txt_prn_father_addr_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_addr_d" id="txt_prn_father_addr_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_addr_c" id="txt_prn_father_addr_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_father_addr_v" id="txt_prn_father_addr_v" >
                    <option value="">សូមជ្រើសរើស</option>
                    <!-- Loading by selected province -->
                </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">
                $(document).ready(function(e) {

                    //load provinces and districts
                    //
                    //load province
                    var id = "<?= $txt_prn_father_addr_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_prn_father_addr_p").empty();
                                $("#txt_prn_father_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_prn_father_addr_d").empty();
                                $("#txt_prn_father_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_father_addr_c").empty();
                                $("#txt_prn_father_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_father_addr_v").empty();
                                $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_prn_father_addr_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_addr_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_prn_father_addr_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_prn_father_addr_d").empty();
                                $("#txt_prn_father_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_father_addr_c").empty();
                                $("#txt_prn_father_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_father_addr_v").empty();
                                $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_prn_father_addr_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_addr_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_prn_father_addr_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_prn_father_addr_c").empty();
                                $("#txt_prn_father_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_father_addr_v").empty();
                                $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_prn_father_addr_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_addr_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_prn_father_addr_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_prn_father_addr_v").empty();
                                $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_prn_father_addr_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_father_addr_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_prn_father_addr_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_prn_father_addr_p").empty();
                                    $("#txt_prn_father_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_prn_father_addr_d").empty();
                                    $("#txt_prn_father_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_father_addr_c").empty();
                                    $("#txt_prn_father_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_father_addr_v").empty();
                                    $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_prn_father_addr_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_prn_father_addr_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_prn_father_addr_d").empty();
                                    $("#txt_prn_father_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_father_addr_c").empty();
                                    $("#txt_prn_father_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_father_addr_v").empty();
                                    $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_prn_father_addr_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_prn_father_addr_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_prn_father_addr_c").empty();
                                    $("#txt_prn_father_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_father_addr_v").empty();
                                    $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_prn_father_addr_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_prn_father_addr_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_prn_father_addr_v").empty();
                                    $("#txt_prn_father_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_prn_father_addr_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឯកសារភ្ជាប់៖</div>
        <div class="flex-item-right div-input-row">
            <input type="file" name="txt_prn_father_file" id="txt_prn_father_file" /> 
            <?PHP
                if(!empty($txt_prn_father_filex)){
                    echo '<a href="#" onclick="window.open(\'images/uploaded/'.$txt_prn_father_filex.'\',\'_blank\')">'.$txt_prn_father_filex.'</a>';
                    echo '<input type="hidden" name="txt_prn_father_filex" value="'.$txt_prn_father_filex.'">';
                }
            ?>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ព័ត៌មានទំនាក់ទំនង៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_father_contact" id="txt_prn_father_contact" value="<?= $txt_prn_father_contact ?>" placeholder="012345678, my.email@email.com">
        </div>
    </div>
    </section>

    <!-- Mother -->
    <h1 style="text-align:center;" id="bt_mother">អំពីម្តាយ</h1>
    <section id="mother">
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមត្រកូល៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_mother_fname" id="txt_prn_mother_fname" value="<?= $txt_prn_mother_fname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមឈ្មោះ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_mother_lname" id="txt_prn_mother_lname" value="<?= $txt_prn_mother_lname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឈ្មោះហៅក្រៅ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_mother_nick_name" id="txt_prn_mother_nick_name" value="<?= $txt_prn_mother_nick_name ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ថ្ងៃខែឆ្នាំកំណើត៖</div>
        <div class="flex-item-right div-input-row">
            <?PHP
                $t = strtotime("-15 year", time());
                $d = date("Y-m-d", $t);
            ?>
            <input type="date" name="txt_prn_mother_dob" id="txt_prn_mother_dob" value="<?= $txt_prn_mother_dob?>" min="1900-01-01" max="<?= $d ?>" style="width:40%;">
            អាយុ៖ <input type="number" name="txt_prn_mother_age" id="txt_prn_mother_age" value="" style="width:40%;" disabled="disabled">ឆ្នាំ
            <script>
                $(document).ready(function(e){
                    if($("#txt_prn_mother_dob").val() !== ''){
                        var dob = $("#txt_prn_mother_dob").val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_prn_mother_age").val(age);
                    }

                    $("#txt_prn_mother_dob").change(function(){
                        var dob = $(this).val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_prn_mother_age").val(age);
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ជនជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_mother_origin" id="txt_prn_mother_origin">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_prn_mother_origin).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">សញ្ជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_mother_nationality" id="txt_prn_mother_nationality">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_prn_mother_nationality).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">លេខ​អត្តសញ្ញាណ​ប័ណ្ណ​សញ្ជាតិ​ខ្មែរ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_mother_id_number" id="txt_prn_mother_id_number" value="<?= $txt_prn_mother_id_number ?>" maxlength="9">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">កាលបរិច្ឆេទ​ផុតកំណត់៖</div>
        <div class="flex-item-right div-input-row">
            នៅមានសុពលភាព៖ <input type="radio" name="txt_prn_mother_id_expired" id="txt_prn_mother_id_not_expired" value="1" style="width:30px;" checked="checked"> 
            ហួសសុពលភាព៖ <input type="radio" name="txt_prn_mother_id_expired" id="txt_prn_mother_id_expired" value="-1" style="width:30px;">
            <?PHP
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_prn_mother_id_expire_date" id="txt_prn_mother_expire_date" min="<?= $d ?>" max="9999" value="<?= $txt_prn_mother_id_expire_date ?>">
            <script>
                $(document).ready(function(e){
                    $("#txt_prn_mother_id_expired").click(function(){
                        $("#txt_prn_mother_expire_date").attr("disabled","disabled");
                    });

                    $("#txt_prn_mother_id_not_expired").click(function(){
                        $("#txt_prn_mother_expire_date").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>

    <!-- Place of Birth -->
    <div class="flex-container">
        <div class="flex-item-left">ទីកន្លែងកំណើត៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_pob_cn" id="txt_prn_mother_pob_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_prn_mother_pob_cn;

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_country).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_pob_p" id="txt_prn_mother_pob_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_pob_d" id="txt_prn_mother_pob_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_pob_c" id="txt_prn_mother_pob_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_pob_v" id="txt_prn_mother_pob_v" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">
                $(document).ready(function(e) {

                    //load provinces and districts
                    //
                    //load province
                    var id = "<?= $txt_prn_mother_pob_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_prn_mother_pob_p").empty();
                                $("#txt_prn_mother_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_prn_mother_pob_d").empty();
                                $("#txt_prn_mother_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_mother_pob_c").empty();
                                $("#txt_prn_mother_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_mother_pob_v").empty();
                                $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];

                                    var selected = '';
                                    if(p_id == '<?= $txt_prn_mother_pob_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_pob_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_prn_mother_pob_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_prn_mother_pob_d").empty();
                                $("#txt_prn_mother_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_mother_pob_c").empty();
                                $("#txt_prn_mother_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_mother_pob_v").empty();
                                $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_prn_mother_pob_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_pob_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_prn_mother_pob_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_prn_mother_pob_c").empty();
                                $("#txt_prn_mother_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_mother_pob_v").empty();
                                $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_prn_mother_pob_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_pob_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_prn_mother_pob_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_prn_mother_pob_v").empty();
                                $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_prn_mother_pob_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_pob_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_prn_mother_pob_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_prn_mother_pob_p").empty();
                                    $("#txt_prn_mother_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_prn_mother_pob_d").empty();
                                    $("#txt_prn_mother_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_mother_pob_c").empty();
                                    $("#txt_prn_mother_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_mother_pob_v").empty();
                                    $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_prn_mother_pob_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_prn_mother_pob_p").change(function(){
                            var id = $(this).val();
                            
                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_prn_mother_pob_d").empty();
                                    $("#txt_prn_mother_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_mother_pob_c").empty();
                                    $("#txt_prn_mother_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_mother_pob_v").empty();
                                    $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_prn_mother_pob_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_prn_mother_pob_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_prn_mother_pob_c").empty();
                                    $("#txt_prn_mother_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_mother_pob_v").empty();
                                    $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_prn_mother_pob_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_prn_mother_pob_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_prn_mother_pob_v").empty();
                                    $("#txt_prn_mother_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_prn_mother_pob_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div> 
    <div class="flex-container">
        <div class="flex-item-left">កម្រិតវប្បធម៌៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_mother_edu" id="txt_prn_mother_edu" >
                <option value="">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_prn_mother_edu) ?>>អនក្ខរកម្ម</option>
                <option value="2" <?= _selected(2,$txt_prn_mother_edu) ?>>ថ្នាក់ទី១-៦</option>
                <option value="3" <?= _selected(3,$txt_prn_mother_edu) ?>>ថ្នាក់ទី៧-៩</option>
                <option value="4" <?= _selected(4,$txt_prn_mother_edu) ?>>ថ្នាក់ទី៩​-១២</option>
                <option value="5"> <?= _selected(5,$txt_prn_mother_edu) ?>ទុតិយភូមិ</option>
                <option value="6" <?= _selected(6,$txt_prn_mother_edu) ?>>សិស្សិត​មហាវិទ្យាល័យ</option>
                <option value="7" <?= _selected(7,$txt_prn_mother_edu) ?>>បរិញ្ញាប័ត្រ</option>
                <option value="8" <?= _selected(8,$txt_prn_mother_edu) ?>>បរិញ្ញាប័ត្រជាន់ខ្ពស់</option>
                <option value="9" <?= _selected(9,$txt_prn_mother_edu) ?>>បណ្ឌិត</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">មុខរបរ​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_mother_occupation" id="txt_prn_mother_occupation" >
                <option value="">សូមជ្រើសរើស</option>
                <?php
                    $q2 = "SELECT * FROM `tb_occupations` WHERE(1)";
                    if(!$rs2 = $vtmdb->query($q2)){ die("Error query occupation"); }
                    while($r2 = $rs2->fetch_assoc()){
                        echo '<option value="'.$r2['occ_id'].'" '._selected($r2['occ_id'],$txt_prn_mother_occupation).'>'.$r2['occ_name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    
    <!-- Current Address -->
    <div class="flex-container">
        <div class="flex-item-left">អាសយដ្ឋាន​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_addr_cn" id="txt_prn_mother_addr_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $_SESSION['cn_id'];

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_prn_mother_addr_cn).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_addr_p" id="txt_prn_mother_addr_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_addr_d" id="txt_prn_mother_addr_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_addr_c" id="txt_prn_mother_addr_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_mother_addr_v" id="txt_prn_mother_addr_v" >
                    <option value="">សូមជ្រើសរើស</option>
                    <!-- Loading by selected province -->
                </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">
                $(document).ready(function(e) {

                    //load provinces and districts
                    //
                    //load province
                    var id = "<?= $_SESSION['cn_id'] ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_prn_mother_addr_p").empty();
                                $("#txt_prn_mother_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_prn_mother_addr_d").empty();
                                $("#txt_prn_mother_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_mother_addr_c").empty();
                                $("#txt_prn_mother_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_mother_addr_v").empty();
                                $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_prn_mother_addr_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_addr_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $_SESSION['p_id'] ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_prn_mother_addr_d").empty();
                                $("#txt_prn_mother_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_mother_addr_c").empty();
                                $("#txt_prn_mother_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_mother_addr_v").empty();
                                $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_prn_mother_addr_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_addr_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $_SESSION['d_id'] ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_prn_mother_addr_c").empty();
                                $("#txt_prn_mother_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_mother_addr_v").empty();
                                $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_prn_mother_addr_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_addr_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $_SESSION['c_id'] ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_prn_mother_addr_v").empty();
                                $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_prn_mother_addr_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_mother_addr_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_prn_mother_addr_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_prn_mother_addr_p").empty();
                                    $("#txt_prn_mother_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_prn_mother_addr_d").empty();
                                    $("#txt_prn_mother_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_mother_addr_c").empty();
                                    $("#txt_prn_mother_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_mother_addr_v").empty();
                                    $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_prn_mother_addr_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_prn_mother_addr_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_prn_mother_addr_d").empty();
                                    $("#txt_prn_mother_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_mother_addr_c").empty();
                                    $("#txt_prn_mother_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_mother_addr_v").empty();
                                    $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_prn_mother_addr_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_prn_mother_addr_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_prn_mother_addr_c").empty();
                                    $("#txt_prn_mother_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_mother_addr_v").empty();
                                    $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_prn_mother_addr_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_prn_mother_addr_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_prn_mother_addr_v").empty();
                                    $("#txt_prn_mother_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_prn_mother_addr_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឯកសារភ្ជាប់៖</div>
        <div class="flex-item-right div-input-row">
            <input type="file" name="txt_prn_mother_file" id="txt_prn_mother_file" />
            <?PHP
                if(!empty($txt_prn_mother_filex)){
                    echo '<a href="#" onclick="window.open(\'images/uploaded/'.$txt_prn_mother_filex.'\',\'_blank\')">'.$txt_prn_mother_filex.'</a>';
                    echo '<input type="hidden" name="txt_prn_mother_filex" value="'.$txt_prn_mother_filex.'">';
                }
            ?>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ព័ត៌មានទំនាក់ទំនង៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_mother_contact" id="txt_prn_mother_contact" value="<?= $txt_prn_mother_contact ?>" placeholder="012345678, my.email@email.com">
        </div>
    </div>
    </section>

    <!-- Guardian -->
    <h1 style="text-align:center;" id="bt_guardian">អំពីអាណាព្យាបាល</h1>
    <section id="guardian">
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ត្រូវជា៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_guardian_relationship" id="txt_prn_guardian_relationship">
                <option value="0">សូមជ្រើសរើស</option>
                <option value="1">បង</option>
                <option value="2">បងជីដូនមួយ</option>
                <option value="3">ពូមីង</option>
                <option value="4">អ៊ំ</option>
                <option value="5">តាយាយ</option>
                <option value="6">ឪពុកម្តាយចិញ្ចឹម</option>
                <option value="7">ផ្សេងៗ</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមត្រកូល៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_guardian_fname" id="txt_prn_guardian_fname" value="<?= $txt_prn_guardian_fname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមឈ្មោះ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_guardian_lname" id="txt_prn_guardian_lname" value="<?= $txt_prn_guardian_lname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឈ្មោះហៅក្រៅ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_guardian_nick_name" id="txt_prn_guardian_nick_name" value="<?= $txt_prn_guardian_nick_name ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ថ្ងៃខែឆ្នាំកំណើត៖</div>
        <div class="flex-item-right div-input-row">
            <?PHP
                $t = strtotime("-15 year", time());
                $d = date("Y-m-d", $t);
            ?>
            <input type="date" name="txt_prn_guardian_dob" id="txt_prn_guardian_dob" value="<?= $txt_prn_guardian_dob?>" min="1900-01-01" max="<?= $d ?>"  style="width:40%;">
            អាយុ៖ <input type="number" name="txt_prn_guardian_age" id="txt_prn_gurdian_age" value="" style="width:40%;" disabled="disabled">ឆ្នាំ
            <script>
                $(document).ready(function(e){
                    if($("#txt_prn_guardian_dob").val() !== ''){
                        var dob = $("#txt_prn_guardian_dob").val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_prn_gurdian_age").val(age);
                    }

                    $("#txt_prn_guardian_dob").change(function(){
                        var dob = $(this).val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_prn_gurdian_age").val(age);
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ជនជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_guardian_origin" id="txt_prn_guardian_origin">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_prn_guardian_origin).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">សញ្ជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_guardian_nationality" id="txt_prn_guardian_nationality">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_prn_guardian_nationality).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">លេខ​អត្តសញ្ញាណ​ប័ណ្ណ​សញ្ជាតិ​ខ្មែរ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_guardian_id_number" id="txt_prn_guardian_id_number" value="<?= $txt_prn_guardian_id_number ?>" maxlength="9">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">កាលបរិច្ឆេទ​ផុតកំណត់៖</div>
        <div class="flex-item-right div-input-row">
            នៅមានសុពលភាព៖ <input type="radio" name="txt_prn_guardian_id_expired" id="txt_prn_guardian_id_not_expired" value="1" style="width:30px;" checked="checked"> 
            ហួសសុពលភាព៖ <input type="radio" name="txt_prn_guardian_id_expired" id="txt_prn_guardian_id_expired" value="-1" style="width:30px;">
            <?PHP
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_prn_guardian_id_expire_date" id="txt_prn_guardian_expire_date" min="<?= $d ?>" max="9999" value="<?= $txt_prn_guardian_id_expire_date ?>">
            <script>
                $(document).ready(function(e){
                    $("#txt_prn_guardian_id_expired").click(function(){
                        $("#txt_prn_guardian_expire_date").attr("disabled","disabled");
                    });

                    $("#txt_prn_guardian_id_not_expired").click(function(){
                        $("#txt_prn_guardian_expire_date").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>

    <!-- Place of Birth -->
    <div class="flex-container">
        <div class="flex-item-left">ទីកន្លែងកំណើត៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_pob_cn" id="txt_prn_guardian_pob_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_prn_guardian_pob_cn;

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_country).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_pob_p" id="txt_prn_guardian_pob_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_pob_d" id="txt_prn_guardian_pob_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_pob_c" id="txt_prn_guardian_pob_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_pob_v" id="txt_prn_guardian_pob_v" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">
                $(document).ready(function(e) {

                    //load provinces and districts
                    //
                    //load province
                    var id = "<?= $txt_prn_guardian_pob_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_prn_guardian_pob_p").empty();
                                $("#txt_prn_guardian_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_prn_guardian_pob_d").empty();
                                $("#txt_prn_guardian_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_guardian_pob_c").empty();
                                $("#txt_prn_guardian_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_guardian_pob_v").empty();
                                $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];

                                    var selected = '';
                                    if(p_id == '<?= $txt_prn_guardian_pob_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_pob_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_prn_guardian_pob_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_prn_guardian_pob_d").empty();
                                $("#txt_prn_guardian_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_guardian_pob_c").empty();
                                $("#txt_prn_guardian_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_guardian_pob_v").empty();
                                $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_prn_guardian_pob_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_pob_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_prn_guardian_pob_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_prn_guardian_pob_c").empty();
                                $("#txt_prn_guardian_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_guardian_pob_v").empty();
                                $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_prn_guardian_pob_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_pob_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_prn_guardian_pob_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_prn_guardian_pob_v").empty();
                                $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_prn_guardian_pob_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_pob_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_prn_guardian_pob_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_prn_guardian_pob_p").empty();
                                    $("#txt_prn_guardian_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_prn_guardian_pob_d").empty();
                                    $("#txt_prn_guardian_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_guardian_pob_c").empty();
                                    $("#txt_prn_guardian_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_guardian_pob_v").empty();
                                    $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_prn_guardian_pob_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_prn_guardian_pob_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_prn_guardian_pob_d").empty();
                                    $("#txt_prn_guardian_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_guardian_pob_c").empty();
                                    $("#txt_prn_guardian_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_guardian_pob_v").empty();
                                    $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_prn_guardian_pob_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_prn_guardian_pob_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_prn_guardian_pob_c").empty();
                                    $("#txt_prn_guardian_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_guardian_pob_v").empty();
                                    $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_prn_guardian_pob_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_prn_guardian_pob_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_prn_guardian_pob_v").empty();
                                    $("#txt_prn_guardian_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_prn_guardian_pob_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div> 
    <div class="flex-container">
        <div class="flex-item-left">កម្រិតវប្បធម៌៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_guardian_edu" id="txt_prn_guardian_edu" >
                <option value="">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_prn_guardian_edu) ?>>អនក្ខរកម្ម</option>
                <option value="2" <?= _selected(2,$txt_prn_guardian_edu) ?>>ថ្នាក់ទី១-៦</option>
                <option value="3" <?= _selected(3,$txt_prn_guardian_edu) ?>>ថ្នាក់ទី៧-៩</option>
                <option value="4" <?= _selected(4,$txt_prn_guardian_edu) ?>>ថ្នាក់ទី៩​-១២</option>
                <option value="5"> <?= _selected(5,$txt_prn_guardian_edu) ?>ទុតិយភូមិ</option>
                <option value="6" <?= _selected(6,$txt_prn_guardian_edu) ?>>សិស្សិត​មហាវិទ្យាល័យ</option>
                <option value="7" <?= _selected(7,$txt_prn_guardian_edu) ?>>បរិញ្ញាប័ត្រ</option>
                <option value="8" <?= _selected(8,$txt_prn_guardian_edu) ?>>បរិញ្ញាប័ត្រជាន់ខ្ពស់</option>
                <option value="9" <?= _selected(9,$txt_prn_guardian_edu) ?>>បណ្ឌិត</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">មុខរបរ​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_prn_guardian_occupation" id="txt_prn_guardian_occupation" >
                <option value="">សូមជ្រើសរើស</option>
                <?php
                    $q2 = "SELECT * FROM `tb_occupations` WHERE(1)";
                    if(!$rs2 = $vtmdb->query($q2)){ die("Error query occupation"); }
                    while($r2 = $rs2->fetch_assoc()){
                        echo '<option value="'.$r2['occ_id'].'" '._selected($r2['occ_id'],$txt_prn_guardian_occupation).'>'.$r2['occ_name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    
    <!-- Current Address -->
    <div class="flex-container">
        <div class="flex-item-left">អាសយដ្ឋាន​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_addr_cn" id="txt_prn_guardian_addr_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $_SESSION['cn_id'];

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_prn_guardian_addr_cn).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_addr_p" id="txt_prn_guardian_addr_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_addr_d" id="txt_prn_guardian_addr_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_addr_c" id="txt_prn_guardian_addr_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_prn_guardian_addr_v" id="txt_prn_guardian_addr_v" >
                    <option value="">សូមជ្រើសរើស</option>
                    <!-- Loading by selected province -->
                </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">
                $(document).ready(function(e) {

                    //load provinces and districts
                    //
                    //load province
                    var id = "<?= $_SESSION['cn_id'] ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_prn_guardian_addr_p").empty();
                                $("#txt_prn_guardian_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_prn_guardian_addr_d").empty();
                                $("#txt_prn_guardian_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_guardian_addr_c").empty();
                                $("#txt_prn_guardian_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_guardian_addr_v").empty();
                                $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_prn_guardian_addr_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_addr_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $_SESSION['p_id'] ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_prn_guardian_addr_d").empty();
                                $("#txt_prn_guardian_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_prn_guardian_addr_c").empty();
                                $("#txt_prn_guardian_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_guardian_addr_v").empty();
                                $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_prn_guardian_addr_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_addr_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $_SESSION['d_id'] ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_prn_guardian_addr_c").empty();
                                $("#txt_prn_guardian_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_prn_guardian_addr_v").empty();
                                $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_prn_guardian_addr_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_addr_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $_SESSION['c_id'] ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_prn_guardian_addr_v").empty();
                                $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_prn_guardian_addr_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_prn_guardian_addr_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_prn_guardian_addr_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_prn_guardian_addr_p").empty();
                                    $("#txt_prn_guardian_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_prn_guardian_addr_d").empty();
                                    $("#txt_prn_guardian_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_guardian_addr_c").empty();
                                    $("#txt_prn_guardian_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_guardian_addr_v").empty();
                                    $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_prn_guardian_addr_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_prn_guardian_addr_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_prn_guardian_addr_d").empty();
                                    $("#txt_prn_guardian_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_prn_guardian_addr_c").empty();
                                    $("#txt_prn_guardian_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_guardian_addr_v").empty();
                                    $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_prn_guardian_addr_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_prn_guardian_addr_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_prn_guardian_addr_c").empty();
                                    $("#txt_prn_guardian_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_prn_guardian_addr_v").empty();
                                    $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_prn_guardian_addr_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_prn_guardian_addr_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_prn_guardian_addr_v").empty();
                                    $("#txt_prn_guardian_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_prn_guardian_addr_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឯកសារភ្ជាប់៖</div>
        <div class="flex-item-right div-input-row">
            <input type="file" name="txt_prn_guardian_file" id="txt_prn_guardian_file" />
            <?PHP
                if(!empty($txt_prn_guardian_filex)){
                    echo '<a href="#" onclick="window.open(\'images/uploaded/'.$txt_prn_guardian_filex.'\',\'_blank\')">'.$txt_prn_guardian_filex.'</a>';
                    echo '<input type="hidden" name="txt_prn_guardian_filex" value="'.$txt_prn_guardian_filex.'">';
                }
            ?>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ព័ត៌មានទំនាក់ទំនង៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_prn_guardian_contact" id="txt_prn_guardian_contact" value="<?= $txt_prn_guardian_contact ?>" placeholder="012345678, my.email@email.com">
        </div>
    </div>
    </section>

    <div style="text-align:center">
        <input type="hidden" name="fmCommand" value="<?= $_REQUEST['fmCommand'] ?>">
        <input type="hidden" name="id" value="<?= $_REQUEST['id'] ?>">
        <input type="hidden" name="fmSubmit" value="" id="fmSubmit">
        <input type="hidden" name="load_child_form" value="fp">
        <input type="hidden" name="n" value="<?= $txt_case_number ?>">

        <div class="flex-container">
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_previous" name="bt_previous" value="<?= $bt_previous ?>" class="command_button"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_next" name="bt_next" value="<?= $bt_next ?>" class="command_button"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_save" name="bt_save" value="<?= $bt_save ?>" class="command_button bt-submit"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="button" id="bt_close" name="bt_close" value="<?= $bt_close ?>" class="command_button"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(e){
            $("#bt_next").click(function(e){
                e.preventDefault();
                var prn_father_fname = $("#txt_prn_father_fname").val();
                var prn_father_lname = $("#txt_prn_father_lname").val();
                var prn_father_dob = $("#txt_prn_father_dob").val();

                var prn_mother_fname = $("#txt_prn_mother_fname").val();
                var prn_mother_lname = $("#txt_prn_mother_lname").val();
                var prn_mother_dob = $("#txt_prn_mother_dob").val();

                var prn_guardian_fname = $("#txt_prn_guardian_fname").val();
                var prn_guardian_lname = $("#txt_prn_guardian_lname").val();
                var prn_guardian_dob = $("#txt_prn_guardian_dob").val();

                var i = 0;

                //Set value to fmSubmit
                $("#fmSubmit").val("next");
                
                if(prn_father_fname == ''){
                    i++;
                    $("txt_prn_fname").focus();
                    $("txt_prn_fname").css('border','1px solid red');
                }else{
                    $("txt_prn_fname").css('border','1px solid #cccccc');
                }

                if(prn_father_lname == ''){
                    i++;
                    $("txt_prn_lname").focus();
                    $("txt_prn_lname").css('border','1px solid red');
                }else{
                    $("txt_prn_lname").css('border','1px solid #cccccc');
                }

                if(prn_father_dob == ''){
                    i++;
                    $("txt_prn_dob").focus();
                    $("txt_prn_dob").css('border','1px solid red');
                }else{
                    $("txt_prn_dob").css('border','1px solid #cccccc');
                }

                if(prn_mother_fname == ''){
                    if(prn_father_fname == ''){
                        i++;
                        $("prn_mother_fname").focus();
                        $("prn_mother_fname").css('border','1px solid red');
                    }
                }else{
                    $("prn_mother_fname").css('border','1px solid #cccccc');
                }

                if(prn_mother_lname == ''){
                    if(prn_father_lname == ''){
                        i++;
                        $("prn_mother_lname").focus();
                        $("prn_mother_lname").css('border','1px solid red');
                    }
                }else{
                    $("prn_mother_lname").css('border','1px solid #cccccc');
                }

                if(prn_mother_dob == ''){
                    if(prn_father_dob == ''){
                        i++;
                        $("prn_mother_dob").focus();
                        $("prn_mother_dob").css('border','1px solid red');
                    }
                }else{
                    $("prn_mother_dob").css('border','1px solid #cccccc');
                }

                if(prn_guardian_fname == ''){
                    if(prn_mother_fname == ''){
                        if(prn_father_fname == ''){
                            i++;
                            $("prn_guardian_fname").focus();
                            $("prn_guardian_fname").css('border','1px solid red');
                        }
                    }
                }else{
                    $("prn_guardian_fname").css('border','1px solid #cccccc');
                }

                if(prn_guardian_lname == ''){
                    if(prn_mother_lname == ''){
                        if(prn_father_lname == ''){
                            i++;
                            $("prn_guardian_lname").focus();
                            $("prn_guardian_lname").css('border','1px solid red');
                        }
                    }
                }else{
                    $("prn_guardian_lname").css('border','1px solid #cccccc');
                }

                if(prn_guardian_dob == ''){
                    if(prn_mother_dob == ''){
                        if(prn_father_dob == ''){
                            i++;
                            $("prn_guardian_dob").focus();
                            $("prn_guardian_dob").css('border','1px solid red');
                        }
                    }
                }else{
                    $("prn_guardian_dob").css('border','1px solid #cccccc');
                }

                if(i == 0){
                    $("#fm_parent").submit();
                }else{
                    alert("សូមបំពេញព័ត៌មានចាំបាច់ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!");
                }
            });

            $("#bt_save").click(function(e){
                //Set value to fmSubmit
                $("#fmSubmit").val("save");

                e.preventDefault();
                var prn_father_fname = $("#txt_prn_father_fname").val();
                var prn_father_lname = $("#txt_prn_father_lname").val();
                var prn_father_dob = $("#txt_prn_father_dob").val();

                var prn_mother_fname = $("#txt_prn_mother_fname").val();
                var prn_mother_lname = $("#txt_prn_mother_lname").val();
                var prn_mother_dob = $("#txt_prn_mother_dob").val();

                var prn_guardian_fname = $("#txt_prn_guardian_fname").val();
                var prn_guardian_lname = $("#txt_prn_guardian_lname").val();
                var prn_guardian_dob = $("#txt_prn_guardian_dob").val();

                var i = 0;
                
                if(prn_father_fname == ''){
                    i++;
                    $("txt_prn_fname").focus();
                    $("txt_prn_fname").css('border','1px solid red');
                }else{
                    $("txt_prn_fname").css('border','1px solid #cccccc');
                }

                if(prn_father_lname == ''){
                    i++;
                    $("txt_prn_lname").focus();
                    $("txt_prn_lname").css('border','1px solid red');
                }else{
                    $("txt_prn_lname").css('border','1px solid #cccccc');
                }

                if(prn_father_dob == ''){
                    i++;
                    $("txt_prn_dob").focus();
                    $("txt_prn_dob").css('border','1px solid red');
                }else{
                    $("txt_prn_dob").css('border','1px solid #cccccc');
                }

                if(prn_mother_fname == ''){
                    if(prn_father_fname == ''){
                        i++;
                        $("prn_mother_fname").focus();
                        $("prn_mother_fname").css('border','1px solid red');
                    }
                }else{
                    $("prn_mother_fname").css('border','1px solid #cccccc');
                }

                if(prn_mother_lname == ''){
                    if(prn_father_lname == ''){
                        i++;
                        $("prn_mother_lname").focus();
                        $("prn_mother_lname").css('border','1px solid red');
                    }
                }else{
                    $("prn_mother_lname").css('border','1px solid #cccccc');
                }

                if(prn_mother_dob == ''){
                    if(prn_father_dob == ''){
                        i++;
                        $("prn_mother_dob").focus();
                        $("prn_mother_dob").css('border','1px solid red');
                    }
                }else{
                    $("prn_mother_dob").css('border','1px solid #cccccc');
                }

                if(prn_guardian_fname == ''){
                    if(prn_mother_fname == ''){
                        if(prn_father_fname == ''){
                            i++;
                            $("prn_guardian_fname").focus();
                            $("prn_guardian_fname").css('border','1px solid red');
                        }
                    }
                }else{
                    $("prn_guardian_fname").css('border','1px solid #cccccc');
                }

                if(prn_guardian_lname == ''){
                    if(prn_mother_lname == ''){
                        if(prn_father_lname == ''){
                            i++;
                            $("prn_guardian_lname").focus();
                            $("prn_guardian_lname").css('border','1px solid red');
                        }
                    }
                }else{
                    $("prn_guardian_lname").css('border','1px solid #cccccc');
                }

                if(prn_guardian_dob == ''){
                    if(prn_mother_dob == ''){
                        if(prn_father_dob == ''){
                            i++;
                            $("prn_guardian_dob").focus();
                            $("prn_guardian_dob").css('border','1px solid red');
                        }
                    }
                }else{
                    $("prn_guardian_dob").css('border','1px solid #cccccc');
                }

                if(i == 0){
                    $("#fm_parent").submit();
                }else{
                    alert("សូមបំពេញព័ត៌មានចាំបាច់ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!");
                }
            });

            $("#mother").hide();
            $("#guardian").hide();

            $("#bt_father").click(function(){
                $("#father").slideToggle("slow");
                $("#mother").slideUp("slow");
                $("#guardian").slideUP("slow");
            });
            $("#bt_mother").click(function(){
                $("#mother").slideToggle("slow");
                $("#father").slideUp("slow");
                $("#guardian").slideUp("slow");
            });
            $("#bt_guardian").click(function(){
                $("#guardian").slideToggle("slow");
                $("#father").slideUp("slow");
                $("#mother").slideUp("slow");
            });

            $("#bt_previous").click(function(){
                //Set value to fmSubmit
                $("#fmSubmit").val("prev");
            });

            $("#bt_close").click(function(){
                window.close();
            });
        });
    </script>
</form>