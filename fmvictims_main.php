<?PHP
//Generate case code
function codeGen($date){
    $A = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $d = substr($date,0,4).substr($date,5,2).substr($date,8,2).substr($date,11,2).substr($date,14,2).substr($date,17,2);

    $A_len = strlen($A) - 1;
    $n_len = strlen($d) - 1; 

    $code = "";
    //A-Z
    for($i=0; $i<3; $i++){
        $code .= $A[rand(0,$A_len)];
    }
    //0-9
    for($i=0; $i<7; $i++){
        $code .= $d[rand(0,$n_len)];
    }
    return $code;
}

//Function
	include('inc/fnSelect.php');
    include('inc/fnCheck.php');
    include('inc/fnGetRefererType.php');
    include('inc/fnGetOrganization.php');
    include('inc/fnDecode128.php');
    
    if(isset($_REQUEST['fmCommand'])){
        $bt_command = '';
        $fm_title = '';
        $item_exist = true;
        $script = '';

        if($_REQUEST['fmCommand'] == 'add'){

            //Main info
            $txt_case_number = isset($_REQUEST['txt_case_number']) ? $_REQUEST['txt_case_number'] : codeGen($date);
            $txt_case_date = isset($_REQUEST['txt_case_date']) ? $_REQUEST['txt_case_date'] : $short_date;
            $txt_hour = isset($_REQUEST['txt_hour']) ? $_REQUEST['txt_hour'] : '';
            $txt_minute = isset($_REQUEST['txt_minute']) ? $_REQUEST['txt_minute'] : '';
            $txt_shift = isset($_REQUEST['txt_shift']) ? $_REQUEST['txt_shift'] : '';
            $txt_case_time = '';
            if(!empty($txt_hour) and !empty($txt_minute)){
                if($txt_hour < 10){
                    $txt_hour = '0'.$txt_hour;
                }

                if($txt_minute < 10){
                    $txt_minute = '0'.$txt_minute;
                }

                $txt_case_time = $txt_hour.":".$txt_minute." ".$txt_shift;
            }
            $txt_case_loc_v = isset($_REQUEST['txt_case_loc_v']) ? $_REQUEST['txt_case_loc_v'] : '';
            $txt_case_loc_c = isset($_REQUEST['txt_case_loc_c']) ? $_REQUEST['txt_case_loc_c'] : $_SESSION['c_id'];
            $txt_case_loc_d = isset($_REQUEST['txt_case_loc_d']) ? $_REQUEST['txt_case_loc_d'] : $_SESSION['d_id'];
            $txt_case_loc_p = isset($_REQUEST['txt_case_loc_p']) ? $_REQUEST['txt_case_loc_p'] : $_SESSION['p_id'];
            $txt_case_loc_cn = isset($_REQUEST['txt_case_loc_cn']) ? $_REQUEST['txt_case_loc_cn'] : $_SESSION['cn_id'];
            $txt_referer = isset($_REQUEST['txt_referer']) ? $_REQUEST['txt_referer'] : '';
            $txt_interviewer = isset($_REQUEST['txt_interviewer']) ? $_REQUEST['txt_interviewer'] : '';
            $txt_translator = isset($_REQUEST['txt_translator']) ? $_REQUEST['txt_translator'] : '';
            
            //Victim info
            //
            $txt_vtm_photo = !empty($_FILES['txt_vtm_photo']) ? $_FILES['txt_vtm_photo']['name'] : '';
            $txt_vtm_photox = !empty($txt_vtm_photo) ? $txt_vtm_photo : '';
            $txt_vtm_fname = isset($_REQUEST['txt_vtm_fname']) ? $_REQUEST['txt_vtm_fname'] : '';
            $txt_vtm_lname = isset($_REQUEST['txt_vtm_lname']) ? $_REQUEST['txt_vtm_lname'] : '';
            $txt_vtm_nick_name = isset($_REQUEST['txt_vtm_nick_name']) ? $_REQUEST['txt_vtm_nick_name'] : '';
            $txt_vtm_sex = isset($_REQUEST['txt_vtm_sex']) ? $_REQUEST['txt_vtm_sex'] : '';
            $txt_vtm_dob = isset($_REQUEST['txt_vtm_dob']) ? $_REQUEST['txt_vtm_dob'] : '';
            $txt_vtm_origin = isset($_REQUEST['txt_vtm_origin']) ? $_REQUEST['txt_vtm_origin'] : '';
            $txt_vtm_nationality = isset($_REQUEST['txt_vtm_nationality']) ? $_REQUEST['txt_vtm_nationality'] : '';
            $txt_vtm_id_number = isset($_REQUEST['txt_vtm_id_number']) ? $_REQUEST['txt_vtm_id_number'] : '';
            $txt_vtm_id_expire_date = isset($_REQUEST['txt_vtm_id_expire_date']) ? $_REQUEST['txt_vtm_id_expire_date'] : '';
            $txt_vtm_id_issue_place = isset($_REQUEST['txt_vtm_id_issue_place']) ? $_REQUEST['txt_vtm_id_issue_place'] : '';
            $txt_vtm_pob_v = isset($_REQUEST['txt_vtm_pob_v']) ? $_REQUEST['txt_vtm_pob_v'] : '';
            $txt_vtm_pob_c = isset($_REQUEST['txt_vtm_pob_c']) ? $_REQUEST['txt_vtm_pob_c'] : '';
            $txt_vtm_pob_d = isset($_REQUEST['txt_vtm_pob_d']) ? $_REQUEST['txt_vtm_pob_d'] : '';
            $txt_vtm_pob_p = isset($_REQUEST['txt_vtm_pob_p']) ? $_REQUEST['txt_vtm_pob_p'] : '';
            $txt_vtm_pob_cn = isset($_REQUEST['txt_vtm_pob_cn']) ? $_REQUEST['txt_vtm_pob_cn'] : '';
            $txt_vtm_leave_date = isset($_REQUEST['txt_vtm_leave_date']) ? $_REQUEST['txt_vtm_leave_date'] : '';
            $txt_vtm_leave_age = isset($_REQUEST['txt_vtm_leave_age']) ? $_REQUEST['txt_vtm_leave_age'] : '';
            $txt_vtm_married_status = isset($_REQUEST['txt_vtm_married_status']) ? $_REQUEST['txt_vtm_married_status'] : '';
            $txt_vtm_family_member = isset($_REQUEST['txt_vtm_family_member']) ? $_REQUEST['txt_vtm_family_member'] : '';
            $txt_vtm_edu = isset($_REQUEST['txt_vtm_edu']) ? $_REQUEST['txt_vtm_edu'] : '';
            $txt_vtm_occupation = isset($_REQUEST['txt_vtm_occupation']) ? $_REQUEST['txt_vtm_occupation'] : '';
            $txt_vtm_previous_occ = isset($_REQUEST['txt_vtm_previous_occ']) ? $_REQUEST['txt_vtm_previous_occ'] : '';
            $txt_vtm_addr_v = isset($_REQUEST['txt_vtm_addr_v']) ? $_REQUEST['txt_vtm_addr_v'] : '';
            $txt_vtm_addr_c = isset($_REQUEST['txt_vtm_addr_c']) ? $_REQUEST['txt_vtm_addr_c'] : '';
            $txt_vtm_addr_d = isset($_REQUEST['txt_vtm_addr_d']) ? $_REQUEST['txt_vtm_addr_d'] : '';
            $txt_vtm_addr_p = isset($_REQUEST['txt_vtm_addr_p']) ? $_REQUEST['txt_vtm_addr_p'] : '';
            $txt_vtm_addr_cn = isset($_REQUEST['txt_vtm_addr_cn']) ? $_REQUEST['txt_vtm_addr_cn'] : '';
            $txt_vtm_addr2_v = isset($_REQUEST['txt_vtm_addr2_v']) ? $_REQUEST['txt_vtm_addr2_v'] : '';
            $txt_vtm_addr2_c = isset($_REQUEST['txt_vtm_addr2_c']) ? $_REQUEST['txt_vtm_addr2_c'] : '';
            $txt_vtm_addr2_d = isset($_REQUEST['txt_vtm_addr2_d']) ? $_REQUEST['txt_vtm_addr2_d'] : '';
            $txt_vtm_addr2_p = isset($_REQUEST['txt_vtm_addr2_p']) ? $_REQUEST['txt_vtm_addr2_p'] : '';
            $txt_vtm_addr2_cn = isset($_REQUEST['txt_vtm_addr2_cn']) ? $_REQUEST['txt_vtm_addr2_cn'] : '';
            $txt_vtm_contact = isset($_REQUEST['txt_vtm_contact']) ? $_REQUEST['txt_vtm_contact'] : '';
            $txt_vtm_parents = isset($_REQUEST['txt_vtm_parents']) ? $_REQUEST['txt_vtm_parents'] : '';
           
            $bt_command = bt_add_label;
            $fm_title = txt_add_new_case;
        }elseif($_REQUEST['fmCommand'] == 'edit'){
            if(isset($_REQUEST['id'])){
                //Main case
                $q = "SELECT * FROM `tb_cases` WHERE (`case_id`='".decode128($_REQUEST['id'])."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }elseif(isset($_REQUEST['n'])){
                //Main case
                $q = "SELECT * FROM `tb_cases` WHERE (`case_number`='".$_REQUEST['n']."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }

            //Check command button
            if(isset($_REQUEST['bt_submit'])){
                $bt_submit = $_REQUEST['bt_submit'];
            }

            //Main info
            $txt_case_number = isset($_REQUEST['txt_case_number']) ? $_REQUEST['txt_case_number'] : $r['case_number'];
            $txt_case_date = isset($_REQUEST['txt_case_date']) ? $_REQUEST['txt_case_date'] : $r['case_date'];
            $txt_case_time = isset($_REQUEST['txt_case_time']) ? $_REQUEST['txt_case_time'] : $r['case_time'];
            if($txt_case_time <> ''){
                $txt_hour = substr($txt_case_time,0,2);
                $txt_minute = substr($txt_case_time,3,2);
                $txt_shift = substr($txt_case_time,5,2);
            }
            $txt_case_loc_v = isset($_REQUEST['txt_case_loc_v']) ? $_REQUEST['txt_case_loc_v'] : $r['case_loc_v'];
            $txt_case_loc_c = isset($_REQUEST['txt_case_loc_c']) ? $_REQUEST['txt_case_loc_c'] : $r['case_loc_c'];
            $txt_case_loc_d = isset($_REQUEST['txt_case_loc_d']) ? $_REQUEST['txt_case_loc_d'] : $r['case_loc_d'];
            $txt_case_loc_p = isset($_REQUEST['txt_case_loc_p']) ? $_REQUEST['txt_case_loc_p'] : $r['case_loc_p'];
            $txt_case_loc_cn = isset($_REQUEST['txt_case_loc_cn']) ? $_REQUEST['txt_case_loc_cn'] : $r['case_loc_cn'];
            $txt_referer = isset($_REQUEST['txt_referer']) ? $_REQUEST['txt_referer'] : $r['case_referer'];
            $txt_interviewer = isset($_REQUEST['txt_interviewer']) ? $_REQUEST['txt_interviewer'] : $r['case_interviewer'];
            $txt_translator = isset($_REQUEST['txt_translator']) ? $_REQUEST['txt_translator'] : $r['case_translator'];
            
            //Victim info
            //
            $q = "SELECT * FROM `tb_victims` WHERE (`vtm_number`='".$r['case_number']."')";
            if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
            $r = $rs->fetch_assoc();

            $txt_vtm_photo = !empty($_FILES['txt_vtm_photo']['name']) ? $_FILES['txt_vtm_photo']['name'] : '';
            $txt_vtm_photox = !empty($r['vtm_photo']) ? $r['vtm_photo'] : '';
            $txt_vtm_fname = isset($_REQUEST['txt_vtm_fname']) ? $_REQUEST['txt_vtm_fname'] : $r['vtm_fname'];
            $txt_vtm_lname = isset($_REQUEST['txt_vtm_lname']) ? $_REQUEST['txt_vtm_lname'] : $r['vtm_lname'];
            $txt_vtm_nick_name = isset($_REQUEST['txt_vtm_nick_name']) ? $_REQUEST['txt_vtm_nick_name'] : $r['vtm_nick_name'];
            $txt_vtm_sex = isset($_REQUEST['txt_vtm_sex']) ? $_REQUEST['txt_vtm_sex'] : $r['vtm_sex'];
            $txt_vtm_dob = isset($_REQUEST['txt_vtm_dob']) ? $_REQUEST['txt_vtm_dob'] : $r['vtm_dob'];
            $txt_vtm_origin = isset($_REQUEST['txt_vtm_origin']) ? $_REQUEST['txt_vtm_origin'] : $r['vtm_origin'];
            $txt_vtm_nationality = isset($_REQUEST['txt_vtm_nationality']) ? $_REQUEST['txt_vtm_nationality'] : $r['vtm_nationality'];
            $txt_vtm_id_number = isset($_REQUEST['txt_vtm_id_number']) ? $_REQUEST['txt_vtm_id_number'] : $r['vtm_id_number'];
            $txt_vtm_id_expire_date = isset($_REQUEST['txt_vtm_id_expire_date']) ? $_REQUEST['txt_vtm_id_expire_date'] : $r['vtm_id_expire_date'];
            $txt_vtm_id_issue_place = isset($_REQUEST['txt_vtm_id_issue_place']) ? $_REQUEST['txt_vtm_id_issue_place'] : $r['vtm_id_issue_place'];
            $txt_vtm_pob_v = isset($_REQUEST['txt_vtm_pob_v']) ? $_REQUEST['txt_vtm_pob_v'] : $r['vtm_pob_v'];
            $txt_vtm_pob_c = isset($_REQUEST['txt_vtm_pob_c']) ? $_REQUEST['txt_vtm_pob_c'] : $r['vtm_pob_c'];
            $txt_vtm_pob_d = isset($_REQUEST['txt_vtm_pob_d']) ? $_REQUEST['txt_vtm_pob_d'] : $r['vtm_pob_d'];
            $txt_vtm_pob_p = isset($_REQUEST['txt_vtm_pob_p']) ? $_REQUEST['txt_vtm_pob_p'] : $r['vtm_pob_p'];
            $txt_vtm_pob_cn = isset($_REQUEST['txt_vtm_pob_cn']) ? $_REQUEST['txt_vtm_pob_cn'] : $r['vtm_pob_cn'];
            $txt_vtm_leave_date = isset($_REQUEST['txt_vtm_leave_date']) ? $_REQUEST['txt_vtm_leave_date'] : $r['vtm_leave_date'];
            $txt_vtm_leave_age = isset($_REQUEST['txt_vtm_leave_age']) ? $_REQUEST['txt_vtm_leave_age'] : $r['vtm_leave_age'];
            $txt_vtm_married_status = isset($_REQUEST['txt_vtm_married_status']) ? $_REQUEST['txt_vtm_married_status'] : $r['vtm_married_status'];
            $txt_vtm_family_member = isset($_REQUEST['txt_vtm_family_member']) ? $_REQUEST['txt_vtm_family_member'] : $r['vtm_family_member'];
            $txt_vtm_edu = isset($_REQUEST['txt_vtm_edu']) ? $_REQUEST['txt_vtm_edu'] : $r['vtm_edu'];
            $txt_vtm_occupation = isset($_REQUEST['txt_vtm_occupation']) ? $_REQUEST['txt_vtm_occupation'] : $r['vtm_occupation'];
            $txt_vtm_previous_occ = isset($_REQUEST['txt_vtm_previous_occ']) ? $_REQUEST['txt_vtm_previous_occ'] : $r['vtm_previous_occ'];
            $txt_vtm_addr_v = isset($_REQUEST['txt_vtm_addr_v']) ? $_REQUEST['txt_vtm_addr_v'] : $r['vtm_addr_v'];
            $txt_vtm_addr_c = isset($_REQUEST['txt_vtm_addr_c']) ? $_REQUEST['txt_vtm_addr_c'] : $r['vtm_addr_c'];
            $txt_vtm_addr_d = isset($_REQUEST['txt_vtm_addr_d']) ? $_REQUEST['txt_vtm_addr_d'] : $r['vtm_addr_d'];
            $txt_vtm_addr_p = isset($_REQUEST['txt_vtm_addr_p']) ? $_REQUEST['txt_vtm_addr_p'] : $r['vtm_addr_p'];
            $txt_vtm_addr_cn = isset($_REQUEST['txt_vtm_addr_cn']) ? $_REQUEST['txt_vtm_addr_cn'] : $r['vtm_addr_cn'];
            $txt_vtm_addr2_v = isset($_REQUEST['txt_vtm_addr2_v']) ? $_REQUEST['txt_vtm_addr2_v'] : $r['vtm_addr2_v'];
            $txt_vtm_addr2_c = isset($_REQUEST['txt_vtm_addr2_c']) ? $_REQUEST['txt_vtm_addr2_c'] : $r['vtm_addr2_c'];
            $txt_vtm_addr2_d = isset($_REQUEST['txt_vtm_addr2_d']) ? $_REQUEST['txt_vtm_addr2_d'] : $r['vtm_addr2_d'];
            $txt_vtm_addr2_p = isset($_REQUEST['txt_vtm_addr2_p']) ? $_REQUEST['txt_vtm_addr2_p'] : $r['vtm_addr2_p'];
            $txt_vtm_addr2_cn = isset($_REQUEST['txt_vtm_addr2_cn']) ? $_REQUEST['txt_vtm_addr2_cn'] : $r['vtm_addr2_cn'];
            $txt_vtm_contact = isset($_REQUEST['txt_vtm_contact']) ? $_REQUEST['txt_vtm_contact'] : $r['vtm_contact'];
            $txt_vtm_parents = isset($_REQUEST['txt_vtm_parents']) ? $_REQUEST['txt_vtm_parents'] : $r['vtm_parents'];

            $bt_command = bt_edit_label;
            $fm_title = txt_edit_case;
        }elseif($_REQUEST['fmCommand'] == 'delete'){
            if(isset($_REQUEST['id'])){
                $q = "SELECT * FROM `tb_referers` WHERE (`rfr_id`='".decode128($_REQUEST['id'])."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
                
                $txt_name = isset($_REQUEST['txt_name']) ? $_REQUEST['txt_name'] : $r['rfr_name'];
                $txt_type = isset($_REQUEST['txt_type']) ? $_REQUEST['txt_type'] : $r['rfr_type'];
                $txt_address = isset($_REQUEST['txt_address']) ? $_REQUEST['txt_address'] : $r['rfr_address'];
                $txt_contact = isset($_REQUEST['txt_contact']) ? $_REQUEST['txt_contact'] : $r['rfr_contact'];
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
if(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == "next"){
    
    //Check to avoid reload page
    if(isset($_REQUEST['txt_case_number'])){
        $qcheck = "SELECT `case_number` FROM `tb_cases` WHERE(`case_number`='".$_REQUEST['txt_case_number']."')";
        if(!$rsc = $vtmdb->query($qcheck)){ die("Error query case number"); }else{
            $rc = $rsc->fetch_assoc();
            if(empty($rc['case_number'])){
                $item_exist = false;
            }
        }
    }

    if(!$item_exist){
        $q = "INSERT INTO `tb_cases`(`case_id`
                                    ,`case_number`
                                    ,`case_date`
                                    ,`case_time`
                                    ,`case_loc_v`
                                    ,`case_loc_c`
                                    ,`case_loc_d`
                                    ,`case_loc_p`
                                    ,`case_loc_cn`
                                    ,`case_referer`
                                    ,`case_interviewer`
                                    ,`case_translator`
                                    ,`created_by`
                                    ,`date_rec`
                                    ,`last_modify_by`
                                    ,`date_modify`) 
                    VALUES(''
                            ,'".$txt_case_number."'
                            ,'".$txt_case_date."'
                            ,'".$txt_case_time."'
                            ,'".$txt_case_loc_v."'
                            ,'".$txt_case_loc_c."'
                            ,'".$txt_case_loc_d."'
                            ,'".$txt_case_loc_p."'
                            ,'".$txt_case_loc_cn."'
                            ,'".$txt_referer."'
                            ,'".$txt_interviewer."'
                            ,'".$txt_translator."'
                            ,'".$_SESSION['user_id']."'
                            ,'".$date."'
                            ,'".$_SESSION['user_id']."'
                            ,'".$date."')";
        //Create victim table
        //upload Victim's photo if any
        if(!empty($txt_vtm_photo)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_vtm_photox'])){
                unlink($target_path.$_REQUEST['txt_vtm_photox']);
            }

            $target_path = $target_path.basename($txt_case_number."_v_".$_FILES['txt_vtm_photo']['name']); 

            if(!move_uploaded_file($_FILES['txt_vtm_photo']['tmp_name'], $target_path)) {
                $txt_vtm_photo = "There was an error uploading the file, please try again!";
            }else{
                $txt_vtm_photo = $txt_case_number."_v_".$_FILES['txt_vtm_photo']['name'];
            }
        }
            
        $qvictim = "INSERT INTO `tb_victims`(`vtm_id`
                                        ,`vtm_number`
                                        ,`vtm_photo`
                                        ,`vtm_fname`
                                        ,`vtm_lname`
                                        ,`vtm_nick_name`
                                        ,`vtm_sex`
                                        ,`vtm_dob`
                                        ,`vtm_origin`
                                        ,`vtm_nationality`
                                        ,`vtm_id_number`
                                        ,`vtm_id_expire_date`
                                        ,`vtm_id_issue_place`
                                        ,`vtm_pob_v`
                                        ,`vtm_pob_c`
                                        ,`vtm_pob_d`
                                        ,`vtm_pob_p`
                                        ,`vtm_pob_cn`
                                        ,`vtm_leave_date`
                                        ,`vtm_leave_age`
                                        ,`vtm_addr_v`
                                        ,`vtm_addr_c`
                                        ,`vtm_addr_d`
                                        ,`vtm_addr_p`
                                        ,`vtm_addr_cn`
                                        ,`vtm_married_status`
                                        ,`vtm_family_member`
                                        ,`vtm_edu`
                                        ,`vtm_occupation`
                                        ,`vtm_previous_occ`
                                        ,`vtm_addr2_v`
                                        ,`vtm_addr2_c`
                                        ,`vtm_addr2_d`
                                        ,`vtm_addr2_p`
                                        ,`vtm_addr2_cn`
                                        ,`vtm_contact`
                                        ,`vtm_parents`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$txt_vtm_photo."'
                        ,'".$txt_vtm_fname."'
                        ,'".$txt_vtm_lname."'
                        ,'".$txt_vtm_nick_name."'
                        ,'".$txt_vtm_sex."'
                        ,'".$txt_vtm_dob."'
                        ,'".$txt_vtm_origin."'
                        ,'".$txt_vtm_nationality."'
                        ,'".$txt_vtm_id_number."'
                        ,'".$txt_vtm_id_expire_date."'
                        ,'".$txt_vtm_id_issue_place."'
                        ,'".$txt_vtm_pob_v."'
                        ,'".$txt_vtm_pob_c."'
                        ,'".$txt_vtm_pob_d."'
                        ,'".$txt_vtm_pob_p."'
                        ,'".$txt_vtm_pob_cn."'
                        ,'".$txt_vtm_leave_date."'
                        ,'".$txt_vtm_leave_age."'
                        ,'".$txt_vtm_addr_v."'
                        ,'".$txt_vtm_addr_c."'
                        ,'".$txt_vtm_addr_d."'
                        ,'".$txt_vtm_addr_p."'
                        ,'".$txt_vtm_addr_cn."'
                        ,'".$txt_vtm_married_status."'
                        ,'".$txt_vtm_family_member."'
                        ,'".$txt_vtm_edu."'
                        ,'".$txt_vtm_occupation."'
                        ,'".$txt_vtm_previous_occ."'
                        ,'".$txt_vtm_addr2_v."'
                        ,'".$txt_vtm_addr2_c."'
                        ,'".$txt_vtm_addr2_d."'
                        ,'".$txt_vtm_addr2_p."'
                        ,'".$txt_vtm_addr2_cn."'
                        ,'".$txt_vtm_contact."'
                        ,'".$txt_vtm_parents."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0101
        $qparent = "INSERT INTO `tb_parents`(`prn_id`
                                        ,`prn_case_number`) 
                    VALUES(''
                        ,'".$txt_case_number."')";

        //Create cases_0101
        $q0101 = "INSERT INTO `tb_cases_0101`(`cas_0101_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0201
        $q0201 = "INSERT INTO `tb_cases_0201`(`cas_0201_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0202
        $q0202 = "INSERT INTO `tb_cases_0202`(`cas_0202_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0203
        $q0203 = "INSERT INTO `tb_cases_0203`(`cas_0203_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0301
        $q0301 = "INSERT INTO `tb_cases_0301`(`cas_0301_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0401
        $q0401 = "INSERT INTO `tb_cases_0401`(`cas_0401_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0501
        $q0501 = "INSERT INTO `tb_cases_0501`(`cas_0501_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0601
        $q0601 = "INSERT INTO `tb_cases_0601`(`cas_0601_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0701
        $q0701 = "INSERT INTO `tb_cases_0701`(`cas_0701_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0801
        $q0801 = "INSERT INTO `tb_cases_0801`(`cas_0801_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0901
        $q0901 = "INSERT INTO `tb_cases_0901`(`cas_0901_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
                                        
        $success = 0;
        //echo $q; exit;
        //Main table
        if(!$vtmdb->query($q)){ die("Error insert into main case!"); }else{ $success += 1; }
        
        //Sub table
        if(!$vtmdb->query($qvictim)){ die("Error insert into victim!"); }else{ $success += 1; }
        if(!$vtmdb->query($qparent)){ die("Error insert into parent!"); }else{ $success += 1; }

        //Referance table
        if(!$vtmdb->query($q0101)){ die("Error insert into case 0101!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0201)){ die("Error insert into case 0201!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0202)){ die("Error insert into case 0202!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0203)){ die("Error insert into case 0203!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0301)){ die("Error insert into case 0301!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0401)){ die("Error insert into case 0401!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0501)){ die("Error insert into case 0501!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0601)){ die("Error insert into case 0601!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0701)){ die("Error insert into case 0701!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0801)){ die("Error insert into case 0801!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0901)){ die("Error insert into case 0901!"); }else{ $success += 1; }

        if($success > 0){
            
        }
        //Move on after create one
        echo '<script type="text/javascript" language="javascript">
                window.open("fmvictims.php?fmCommand=edit&load_child_form=fp&n='.$txt_case_number.'","_self");
            </script>';
    }else{ 
        //if exist move on without change
        echo '<script type="text/javascript" language="javascript">
                window.open("fmvictims.php?fmCommand=edit&load_child_form=fp&n='.$txt_case_number.'","_self");
            </script>';
    }
}elseif(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == "save"){

    //Check to avoid reload page
    if(isset($_REQUEST['txt_case_numberx'])){
        $qcheck = "SELECT `case_number` FROM `tb_cases` WHERE(`case_number`='".$_REQUEST['txt_case_numberx']."')";
        if(!$rsc = $vtmdb->query($qcheck)){ die("Error query case number"); }else{
            $rc = $rsc->fetch_assoc();
            if(empty($rc['case_number'])){
                $item_exist = false;
            }
        }
    }

    if(!$item_exist){
        $q = "INSERT INTO `tb_cases`(`case_id`
                                    ,`case_number`
                                    ,`case_date`
                                    ,`case_time`
                                    ,`case_loc_v`
                                    ,`case_loc_c`
                                    ,`case_loc_d`
                                    ,`case_loc_p`
                                    ,`case_loc_cn`
                                    ,`case_referer`
                                    ,`case_interviewer`
                                    ,`case_translator`
                                    ,`created_by`
                                    ,`date_rec`
                                    ,`last_modify_by`
                                    ,`date_modify`) 
                    VALUES(''
                            ,'".$txt_case_number."'
                            ,'".$txt_case_date."'
                            ,'".$txt_case_time."'
                            ,'".$txt_case_loc_v."'
                            ,'".$txt_case_loc_c."'
                            ,'".$txt_case_loc_d."'
                            ,'".$txt_case_loc_p."'
                            ,'".$txt_case_loc_cn."'
                            ,'".$txt_referer."'
                            ,'".$txt_interviewer."'
                            ,'".$txt_translator."'
                            ,'".$_SESSION['user_id']."'
                            ,'".$date."'
                            ,'".$_SESSION['user_id']."'
                            ,'".$date."')";
        //Create victim table
        //upload Victim's photo if any
        if(!empty($txt_vtm_photo)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_vtm_photox'])){
                unlink($target_path.$_REQUEST['txt_vtm_photox']);
            }

            $target_path = $target_path.basename($txt_case_number."_v_".$_FILES['txt_vtm_photo']['name']); 

            if(!move_uploaded_file($_FILES['txt_vtm_photo']['tmp_name'], $target_path)) {
                $txt_vtm_photo = "There was an error uploading the file, please try again!";
            }else{
                $txt_vtm_photo = $txt_case_number."_v_".$_FILES['txt_vtm_photo']['name'];
            }
        }
            
        $qvictim = "INSERT INTO `tb_victims`(`vtm_id`
                                        ,`vtm_number`
                                        ,`vtm_photo`
                                        ,`vtm_fname`
                                        ,`vtm_lname`
                                        ,`vtm_nick_name`
                                        ,`vtm_sex`
                                        ,`vtm_dob`
                                        ,`vtm_origin`
                                        ,`vtm_nationality`
                                        ,`vtm_id_number`
                                        ,`vtm_id_expire_date`
                                        ,`vtm_id_issue_place`
                                        ,`vtm_pob_v`
                                        ,`vtm_pob_c`
                                        ,`vtm_pob_d`
                                        ,`vtm_pob_p`
                                        ,`vtm_pob_cn`
                                        ,`vtm_leave_date`
                                        ,`vtm_leave_age`
                                        ,`vtm_addr_v`
                                        ,`vtm_addr_c`
                                        ,`vtm_addr_d`
                                        ,`vtm_addr_p`
                                        ,`vtm_addr_cn`
                                        ,`vtm_married_status`
                                        ,`vtm_family_member`
                                        ,`vtm_edu`
                                        ,`vtm_occupation`
                                        ,`vtm_previous_occ`
                                        ,`vtm_addr2_v`
                                        ,`vtm_addr2_c`
                                        ,`vtm_addr2_d`
                                        ,`vtm_addr2_p`
                                        ,`vtm_addr2_cn`
                                        ,`vtm_contact`
                                        ,`vtm_parents`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$txt_vtm_photo."'
                        ,'".$txt_vtm_fname."'
                        ,'".$txt_vtm_lname."'
                        ,'".$txt_vtm_nick_name."'
                        ,'".$txt_vtm_sex."'
                        ,'".$txt_vtm_dob."'
                        ,'".$txt_vtm_origin."'
                        ,'".$txt_vtm_nationality."'
                        ,'".$txt_vtm_id_number."'
                        ,'".$txt_vtm_id_expire_date."'
                        ,'".$txt_vtm_id_issue_place."'
                        ,'".$txt_vtm_pob_v."'
                        ,'".$txt_vtm_pob_c."'
                        ,'".$txt_vtm_pob_d."'
                        ,'".$txt_vtm_pob_p."'
                        ,'".$txt_vtm_pob_cn."'
                        ,'".$txt_vtm_leave_date."'
                        ,'".$txt_vtm_leave_age."'
                        ,'".$txt_vtm_addr_v."'
                        ,'".$txt_vtm_addr_c."'
                        ,'".$txt_vtm_addr_d."'
                        ,'".$txt_vtm_addr_p."'
                        ,'".$txt_vtm_addr_cn."'
                        ,'".$txt_vtm_married_status."'
                        ,'".$txt_vtm_family_member."'
                        ,'".$txt_vtm_edu."'
                        ,'".$txt_vtm_occupation."'
                        ,'".$txt_vtm_previous_occ."'
                        ,'".$txt_vtm_addr2_v."'
                        ,'".$txt_vtm_addr2_c."'
                        ,'".$txt_vtm_addr2_d."'
                        ,'".$txt_vtm_addr2_p."'
                        ,'".$txt_vtm_addr2_cn."'
                        ,'".$txt_vtm_contact."'
                        ,'".$txt_vtm_parents."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0101
        $q0101 = "INSERT INTO `tb_cases_0101`(`cas_0101_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0201
        $q0201 = "INSERT INTO `tb_cases_0201`(`cas_0201_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0202
        $q0202 = "INSERT INTO `tb_cases_0202`(`cas_0202_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0203
        $q0203 = "INSERT INTO `tb_cases_0203`(`cas_0203_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0301
        $q0301 = "INSERT INTO `tb_cases_0301`(`cas_0301_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0401
        $q0401 = "INSERT INTO `tb_cases_0401`(`cas_0401_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0501
        $q0501 = "INSERT INTO `tb_cases_0501`(`cas_0501_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0601
        $q0601 = "INSERT INTO `tb_cases_0601`(`cas_0601_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";

        //Create cases_0701
        $q0701 = "INSERT INTO `tb_cases_0701`(`cas_0701_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0801
        $q0801 = "INSERT INTO `tb_cases_0801`(`cas_0801_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
    
        //Create cases_0901
        $q0901 = "INSERT INTO `tb_cases_0901`(`cas_0901_id`
                                        ,`cas_number`
                                        ,`created_by`
                                        ,`date_rec`
                                        ,`last_modify_by`
                                        ,`date_modify`) 
                    VALUES(''
                        ,'".$txt_case_number."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."'
                        ,'".$_SESSION['user_id']."'
                        ,'".$date."')";
        
        $success = 0;
        //echo $q; exit;
        //Main table
        if(!$vtmdb->query($q)){ die("Error insert into main case!"); }else{ $success += 1; }
        
        //Sub table
        if(!$vtmdb->query($qvictim)){ die("Error insert into victim!"); }else{ $success += 1; }

        //Referance table
        if(!$vtmdb->query($q0101)){ die("Error insert into case 0101!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0201)){ die("Error insert into case 0201!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0202)){ die("Error insert into case 0202!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0203)){ die("Error insert into case 0203!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0301)){ die("Error insert into case 0301!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0401)){ die("Error insert into case 0401!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0501)){ die("Error insert into case 0501!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0601)){ die("Error insert into case 0601!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0701)){ die("Error insert into case 0701!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0801)){ die("Error insert into case 0801!"); }else{ $success += 1; }
        if(!$vtmdb->query($q0901)){ die("Error insert into case 0901!"); }else{ $success += 1; }

        if($success > 0){
            
        }

    }else{
        $success = 0;
        
        $q = "UPDATE `tb_cases` SET `case_date` = '".$txt_case_date."'
                                    ,`case_time` = '".$txt_case_time."'
                                    ,`case_loc_v` = '".$txt_case_loc_v."'
                                    ,`case_loc_c` = '".$txt_case_loc_c."'
                                    ,`case_loc_d` = '".$txt_case_loc_d."'
                                    ,`case_loc_p` = '".$txt_case_loc_p."'
                                    ,`case_loc_cn` = '".$txt_case_loc_cn."'
                                    ,`case_referer` = '".$txt_referer."'
                                    ,`case_interviewer` = '".$txt_interviewer."'
                                    ,`case_translator` = '".$txt_translator."' 
                    WHERE(`case_number` = '".$txt_case_number."')";

        //Create victim table
        //upload Victim's photo if any
        if(!empty($txt_vtm_photo)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_vtm_photox'])){
                @unlink($target_path.$_REQUEST['txt_vtm_photox']);
            }

            $target_path = $target_path.basename($txt_case_number."_v_".$_FILES['txt_vtm_photo']['name']); 

            if(!move_uploaded_file($_FILES['txt_vtm_photo']['tmp_name'], $target_path)) {
                $txt_vtm_photo = "There was an error uploading the file, please try again!";
            }else{
                $txt_vtm_photo = $txt_case_number."_v_".$_FILES['txt_vtm_photo']['name'];
            }
        }else{
            $txt_vtm_photo = !empty($txt_vtm_photox) ? $txt_vtm_photox : '';
        }
            
        $qvictim = "UPDATE `tb_victims` SET `vtm_photo` = '".$txt_vtm_photo."'
                                        ,`vtm_fname` = '".$txt_vtm_fname."'
                                        ,`vtm_lname` = '".$txt_vtm_lname."'
                                        ,`vtm_nick_name` = '".$txt_vtm_nick_name."'
                                        ,`vtm_sex` = '".$txt_vtm_sex."'
                                        ,`vtm_dob` = '".$txt_vtm_dob."'
                                        ,`vtm_origin` = '".$txt_vtm_origin."'
                                        ,`vtm_nationality` = '".$txt_vtm_nationality."'
                                        ,`vtm_id_number` = '".$txt_vtm_id_number."'
                                        ,`vtm_id_expire_date` = '".$txt_vtm_id_expire_date."'
                                        ,`vtm_id_issue_place` = '".$txt_vtm_id_issue_place."'
                                        ,`vtm_pob_v` = '".$txt_vtm_pob_v."'
                                        ,`vtm_pob_c` = '".$txt_vtm_pob_c."'
                                        ,`vtm_pob_d` = '".$txt_vtm_pob_d."'
                                        ,`vtm_pob_p` = '".$txt_vtm_pob_p."'
                                        ,`vtm_pob_cn` = '".$txt_vtm_pob_cn."'
                                        ,`vtm_leave_date` = '".$txt_vtm_leave_date."'
                                        ,`vtm_leave_age` = '".$txt_vtm_leave_age."'
                                        ,`vtm_addr_v` = '".$txt_vtm_addr_v."'
                                        ,`vtm_addr_c` = '".$txt_vtm_addr_c."'
                                        ,`vtm_addr_d` = '".$txt_vtm_addr_d."'
                                        ,`vtm_addr_p` = '".$txt_vtm_addr_p."'
                                        ,`vtm_addr_cn` = '".$txt_vtm_addr_cn."'
                                        ,`vtm_married_status` = '".$txt_vtm_married_status."'
                                        ,`vtm_family_member` = '".$txt_vtm_family_member."'
                                        ,`vtm_edu` = '".$txt_vtm_edu."'
                                        ,`vtm_occupation` = '".$txt_vtm_occupation."'
                                        ,`vtm_previous_occ` = '".$txt_vtm_previous_occ."'
                                        ,`vtm_addr2_v` = '".$txt_vtm_addr2_v."'
                                        ,`vtm_addr2_c` = '".$txt_vtm_addr2_c."'
                                        ,`vtm_addr2_d` = '".$txt_vtm_addr2_d."'
                                        ,`vtm_addr2_p` = '".$txt_vtm_addr2_p."'
                                        ,`vtm_addr2_cn` = '".$txt_vtm_addr2_cn."'
                                        ,`vtm_contact` = '".$txt_vtm_contact."' 
                    WHERE(`vtm_number` = '".$txt_case_number."')";

        //Update data
        if(!$vtmdb->query($q)){ die("Error updating table case!"); } else { $success += 1; }
        if(!$vtmdb->query($qvictim)){ die("Error updating table victim!"); }else{ $success += 1; }

        //update case number if changed
        if(isset($_REQUEST['txt_case_numberx']) and !empty($_REQUEST['txt_case_numberx'])){
            if($_REQUEST['txt_case_numberx'] != $txt_case_number){
                //Update table case
                $q = "UPDATE `tb_cases` SET `case_number` = '".$txt_case_number."' WHERE(`case_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update victim
                $qvictim = "UPDATE `tb_victims` SET `vtm_number` = '".$txt_case_number."' WHERE(`vtm_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0101
                $q0101 = "UPDATE `tb_cases_0101` SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0201
                $q0201 = "UPDATE `tb_cases_0201` SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0202
                $q0202 = "UPDATE `tb_cases_0202`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0203
                $q0203 = "UPDATE `tb_cases_0203`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0301
                $q0301 = "UPDATE `tb_cases_0301`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0401
                $q0401 = "UPDATE `tb_cases_0401`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0501
                $q0501 = "UPDATE `tb_cases_0501`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0601
                $q0601 = "UPDATE `tb_cases_0601`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0701
                $q0701 = "UPDATE `tb_cases_0701` SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0801
                $q0801 = "UPDATE `tb_cases_0801`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";
                //Update cases_0901
                $q0901 = "UPDATE `tb_cases_0901`  SET `cas_number` = '".$txt_case_number."' WHERE(`cas_number`='".$_REQUEST['txt_case_numberx']."')";

                if(!$vtmdb->query($q)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($qvictim)){ die("Error updating table victim!"); }else{ $success += 1; }
                if(!$vtmdb->query($q0101)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0201)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0202)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0203)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0301)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0401)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0501)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0601)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0701)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0801)){ die("Error updating table case!"); } else { $success += 1; }
                if(!$vtmdb->query($q0901)){ die("Error updating table case!"); } else { $success += 1; }

            }
        }

        if($success > 0){

        }
    }
}elseif(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == "prev"){
    //Go back to previous page without change
    echo '<script type="text/javascript" language="javascript">
            window.open("fmvictims.php?fmCommand=edit&load_child_form=fm&n='.$txt_case_number.'","_self");
        </script>';
}else{}
?>

<?PHP include("inc/tab_menu.php"); ?>
<script>
    //To modify current tab menu number
    $(document).ready(function(e){
        $("#t1").addClass("t1-active");
    });
</script>

<form name="fm_case_main" id="fm_case_main" action="" method="post" enctype="multipart/form-data">
    <h1 style="text-align:center;">ផ្នែកទី១</h1>
    <h1 style="text-align:center;" id="bt_general">ព័ត៌មានទូទៅ</h1>
    <section id="general">
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><input type="text" name="txt_case_number" id="txt_case_number" value="<?= $txt_case_number ?>"></div>
        <script>
            $(document).ready(function(e){
                $("#txt_case_number").keypress(function(e){
                    e.preventDefault();
                    alert("ទិន្នន័យក្នុងប្រអប់នេះ មិនអាចកែប្រែបានទេ!");
                });
            });
        </script>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>កាលបរិច្ឆេទ៖</div>
        <?PHP
            $t = strtotime("-10 year", time());
            $d1 = date("Y-m-d", $t);    
            $d2 = gmstrftime ("%Y-%m-%d", time ()+25200);
        ?>
        <div class="flex-item-right div-input-row"><input type="date" name="txt_case_date" id="txt_case_date" min="<?= $d1 ?>" max="<?= $d2 ?>" value="<?= $txt_case_date ?>" required /></div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ពេលវេលា៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_hour" style="width:80px !important;">
                <?PHP
                    for($i=0; $i<12; $i++){
                        $h = $i<10 ? '0'.$i : $i;
                        echo '<option value="'.$i.'" '._selected($i,$txt_hour).'>'.$h.'</option>';
                    }
                ?>
            </select>:
            <select name="txt_minute" style="width:80px !important;">
                <?PHP
                    for($i=0; $i<60; $i++){
                        $m = $i<10 ? '0'.$i : $i;
                        echo '<option value="'.$i.'" '._selected($i,$txt_minute).'>'.$m.'</option>';
                    }
                ?>
            </select>
            <select name="txt_shift" style="width:80px !important;">
                <option value="am" <?= _selected('am',$txt_shift) ?>>AM</option>
                <option value="pm" <?= _selected('pm',$txt_shift) ?>>PM</option></select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ទីកន្លែងទទួលករណី៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><span class="error">*</span><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_case_loc_cn" id="txt_country">
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_case_loc_cn;

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
                <div class="flex-item-left"><span class="error">*</span><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_case_loc_p" id="txt_province">
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_case_loc_d" id="txt_district" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_case_loc_c" id="txt_commune" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_case_loc_v" id="txt_village" >
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
                    var id = "<?= $txt_case_loc_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_province").empty();
                                $("#txt_province").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_district").empty();
                                $("#txt_district").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_commune").empty();
                                $("#txt_commune").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_village").empty();
                                $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_case_loc_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_province").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_case_loc_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_district").empty();
                                $("#txt_district").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_commune").empty();
                                $("#txt_commune").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_village").empty();
                                $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_case_loc_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_district").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_case_loc_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_commune").empty();
                                $("#txt_commune").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_village").empty();
                                $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_case_loc_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_commune").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_case_loc_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_village").empty();
                                $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_case_loc_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_village").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_country").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_province").empty();
                                    $("#txt_province").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_district").empty();
                                    $("#txt_district").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_commune").empty();
                                    $("#txt_commune").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");
                                    
                                    //Clear village
                                    $("#txt_village").empty();
                                    $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_province").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_province").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_district").empty();
                                    $("#txt_district").append("<option value=''>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_commune").empty();
                                    $("#txt_commune").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_village").empty();
                                    $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_district").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_district").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_commune").empty();
                                    $("#txt_commune").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_village").empty();
                                    $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_commune").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_commune").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_village").empty();
                                    $("#txt_village").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_village").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div>    
        <!-- Referer -->
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ប្រភពបញ្ជូនមក៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_referer" id="txt_referer">
                <option value="-1">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_referers` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)) { die("Error loading type of referer."); }
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['rfr_id'].'" '._selected($r['rfr_id'],$txt_referer).'>'.$r['rfr_name'].'('.get_referer_type($r['rfr_type']).')</option>';
                    }
                ?>
                <option value="" disabled="disabled">...............</option>
                <option value="add">បន្ថែមប្រភពបញ្ជូនថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_referer").click(function(){
                        var value = $(this).val();
                        if(value == 'add'){
                            window.open('settings/fmreferers.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>

    <!-- interviewer -->
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span><?= txt_interviewer ?>៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_interviewer" id="txt_interviewer">
                <option value="-1">សូមជ្រើសរើស</option>
                <?PHP
                    $org = new Organization;
                    $q = "SELECT * FROM `tb_interviewers` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)) { die("Error loading type of referer."); }
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['inv_id'].'" '._selected($r['inv_id'],$txt_interviewer).'>'.$r['inv_name_kh'].'('.$org->get_name($r['inv_organization']).')</option>';
                    }
                ?>
                <option value="" disabled="disabled">...............</option>
                <option value="add">បន្ថែមអ្នកសម្ភាសន៍ថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_interviewer").click(function(){
                        var value = $(this).val();
                        if(value == 'add'){
                            window.open('settings/fminterviewers.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>

    <!-- translator -->
    <div class="flex-container">
        <div class="flex-item-left"><?= txt_translator ?>៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_translator" id="txt_translator">
                <option value="-1">សូមជ្រើសរើស</option>
                <?PHP
                    $org = new Organization;
                    $txt_contact = '';
                    $q = "SELECT * FROM `tb_translators` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)) { die("Error loading type of referer."); }
                    while($r = $rs->fetch_assoc()){
                        $txt_contact .= !empty($txt_contact) ? (!empty($r['tns_phone']) ? ", ".$r['tns_phone'] : "") : (!empty($r['tns_phone']) ? $r['tns_phone'] : "");
                        $txt_contact .= !empty($txt_contact) ? (!empty($r['tns_email']) ? ", ".$r['tns_email'] : "") : (!empty($r['tns_email']) ? $r['tns_email'] : "");
                        echo '<option value="'.$r['tns_id'].'" '._selected($r['tns_id'],$txt_translator).'>'.$r['tns_name_kh'].'('.$txt_contact.')</option>';
                    }
                ?>
                <option value="" disabled="disabled">...............</option>
                <option value="add">បន្ថែមអ្នកសម្ភាសន៍ថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_interviewer").click(function(){
                        var value = $(this).val();
                        if(value == 'add'){
                            window.open('settings/fminterviewers.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>
    </section>

    <!-- victim -->
    <h1 style="text-align:center;" id="bt_victim">អំពីជនរងគ្រោះ</h1>
    <section id="victim">
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>រូបថត៖</div>
        <div class="flex-item-right div-input-row">
            <input type="file" name="txt_vtm_photo" id="txt_vtm_photo" accept="image/*" capture="camera"> 
            <?php
                if(!empty($txt_vtm_photox)){
                    echo '<a href="#" class="image_link" onclick="window.open(\'images/uploaded/'.$txt_vtm_photox.'\',\'_blank\')">'.$txt_vtm_photox.'</a>';
                    echo '<input type="hidden" name="txt_vtm_photox" value="'.$txt_vtm_photox.'">';
                }
            ?>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមត្រកូល៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_vtm_fname" id="txt_vtm_fname" value="<?= $txt_vtm_fname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមឈ្មោះ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_vtm_lname" id="txt_vtm_lname" value="<?= $txt_vtm_lname ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឈ្មោះហៅក្រៅ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_vtm_nick_name" id="txt_vtm_nick_name" value="<?= $txt_vtm_nick_name ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ភេទ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_sex" id="txt_tvm_sex">
                <option value="0">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_vtm_sex) ?>>ប្រុស</option>
                <option value="2" <?= _selected(2,$txt_vtm_sex) ?>>ស្រី</option>
                <option value="3" <?= _selected(3,$txt_vtm_sex) ?>>ផ្សេងៗ</option>
                <option value="4" <?= _selected(4,$txt_vtm_sex) ?>>n/a</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ថ្ងៃខែឆ្នាំកំណើត៖</div>
        <div class="flex-item-right div-input-row">
            <?PHP
                $t = strtotime("-15 year", time());
                $d = date("Y-m-d", $t);
            ?>
            <input type="date" name="txt_vtm_dob" id="txt_vtm_dob" value="<?= $txt_vtm_dob?>" min="1900-01-01" max="<?= $d ?>" value="<?= $txt_vtm_dob ?>" style="width:40%;">
            អាយុ៖ <input type="number" name="txt_vtm_age" id="txt_vtm_age" value="" style="width:40%;" disabled="disabled">ឆ្នាំ
            <script>
                $(document).ready(function(e){
                    var dob = $("#txt_vtm_dob").val();
                    var yob = dob.substring(0,4);
                    var current_year = <?= $Y ?>;
                    var age = current_year - yob;
                    $("#txt_vtm_age").val(age);

                    $("#txt_vtm_dob").change(function(){
                        var dob = $("#txt_vtm_dob").val();
                        var yob = dob.substring(0,4);
                        var current_year = <?= $Y ?>;
                        var age = current_year - yob;
                        $("#txt_vtm_age").val(age);
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ជនជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_origin" id="txt_vtm_origin">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_vtm_origin).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">សញ្ជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_nationality" id="txt_vtm_nationality">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_vtm_nationality).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>លេខ​អត្តសញ្ញាណ​ប័ណ្ណ​សញ្ជាតិ​ខ្មែរ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_vtm_id_number" id="txt_vtm_id_number" value="<?= $txt_vtm_id_number ?>" maxlength="9">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">កាលបរិច្ឆេទ​ផុតកំណត់៖</div>
        <div class="flex-item-right div-input-row">
            នៅមានសុពលភាព៖ <input type="radio" name="txt_vtm_id_expired" id="txt_vtm_id_not_expired" value="1" style="width:30px;" checked="checked"> 
            ហួសសុពលភាព៖ <input type="radio" name="txt_vtm_id_expired" id="txt_vtm_id_expired" value="-1" style="width:30px;">
            <?PHP
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_vtm_id_expire_date" id="txt_vtm_expire_date" min="<?= $d ?>" max="9999" value="<?= $txt_vtm_id_expire_date ?>">
            <script>
                $(document).ready(function(e){
                    $("#txt_vtm_id_expired").click(function(){
                        $("#txt_vtm_expire_date").attr("disabled","disabled");
                    });

                    $("#txt_vtm_id_not_expired").click(function(){
                        $("#txt_vtm_expire_date").removeAttr("disabled");
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
                <div class="flex-item-left"><span class="error">*</span><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_pob_cn" id="txt_vtm_pob_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_vtm_pob_cn;

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
                <div class="flex-item-left"><span class="error">*</span><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_pob_p" id="txt_vtm_pob_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_pob_d" id="txt_vtm_pob_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_pob_c" id="txt_vtm_pob_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_pob_v" id="txt_vtm_pob_v" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            
            <!-- Load district by province-->
            <script language="javascript" type="text/javascript">

                $(document).ready(function(e) {

                //load province
                var id = "<?= $txt_vtm_pob_cn ?>";

                $.ajax({
                    url: 'settings/load_provinces.php',
                    type: 'post',
                    data: {cn_id:id},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;
                        //Clear province
                        $("#txt_vtm_pob_p").empty();
                        $("#txt_vtm_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                        
                        //Clear district
                        $("#txt_vtm_pob_d").empty();
                        $("#txt_vtm_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                        //Clear commune
                        $("#txt_vtm_pob_c").empty();
                        $("#txt_vtm_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                        //Clear village
                        $("#txt_vtm_pob_v").empty();
                        $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                        for( var i = 0; i<len; i++){
                            var p_id = response[i]['p_id'];
                            var name = response[i]['p_name_kh'];
                            var selected = '';
                            if(p_id == '<?= $txt_vtm_pob_p ?>'){
                                selected = 'selected = "selected"';
                            }

                            $("#txt_vtm_pob_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                        }
                    }
                });

                //load district
                var id2 = "<?= $txt_vtm_pob_p ?>";
                    
                $.ajax({
                    url: 'settings/load_districts.php',
                    type: 'post',
                    data: {p_id:id2},
                    dataType: 'json',
                    success:function(response){

                        var len = response.length;
                        //Clear district
                        $("#txt_vtm_pob_d").empty();
                        $("#txt_vtm_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                        //Clear commune
                        $("#txt_vtm_pob_c").empty();
                        $("#txt_vtm_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                        //Clear village
                        $("#txt_vtm_pob_v").empty();
                        $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                        for( var i = 0; i<len; i++){
                            var d_id = response[i]['d_id'];
                            var name = response[i]['d_name_kh'];
                            var selected = '';
                            if(d_id == '<?= $txt_vtm_pob_d ?>'){
                                selected = 'selected = "selected"';
                            }

                            $("#txt_vtm_pob_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                        }
                    }
                });

                //load commune
                var id3 = "<?= $txt_vtm_pob_d ?>";
                    
                    $.ajax({
                        url: 'settings/load_communes.php',
                        type: 'post',
                        data: {d_id:id3},
                        dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            //Clear commune
                            $("#txt_vtm_pob_c").empty();
                            $("#txt_vtm_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                            //Clear village
                            $("#txt_vtm_pob_v").empty();
                            $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                            for( var i = 0; i<len; i++){
                                var c_id = response[i]['c_id'];
                                var name = response[i]['c_name_kh'];
                                var selected = '';
                                if(c_id == '<?= $txt_vtm_pob_c ?>'){
                                    selected = 'selected = "selected"';
                                }

                                $("#txt_vtm_pob_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                            }
                        }
                    });

                //load village
                var id4 = "<?= $txt_vtm_pob_c ?>";
                    
                    $.ajax({
                        url: 'settings/load_villages.php',
                        type: 'post',
                        data: {c_id:id4},
                        dataType: 'json',
                        success:function(response){

                            var len = response.length;
                            //Clear village
                            $("#txt_vtm_pob_v").empty();
                            $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                            for( var i = 0; i<len; i++){
                                var v_id = response[i]['v_id'];
                                var name = response[i]['v_name_kh'];
                                var selected = '';
                                if(v_id == '<?= $txt_vtm_pob_v ?>'){
                                    selected = 'selected = "selected"';
                                }

                                $("#txt_vtm_pob_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                            }
                        }
                    });

                    $("#txt_vtm_pob_cn").change(function(){
                        var id = $(this).val();

                        var code = $("#txt_case_number").val();
                        var new_code = '';
                        if(id>10){
                            new_code = id + code.slice(code.length - 10);
                        }else{
                            new_code = '0' + id + code.slice(code.length - 10);
                        }
                        $("#txt_case_number").val(new_code);

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_vtm_pob_p").empty();
                                $("#txt_vtm_pob_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_vtm_pob_d").empty();
                                $("#txt_vtm_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_vtm_pob_c").empty();
                                $("#txt_vtm_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_pob_v").empty();
                                $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_vtm_pob_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_pob_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });
                    }); 

                    $("#txt_vtm_pob_p").change(function(){
                        var id = $(this).val();

                        var code = $("#txt_case_number").val();
                        var new_code = '';
                        if(id>10){
                            new_code = id + code.slice(code.length - 12);
                        }else{
                            new_code = '0' + id + code.slice(code.length - 12);
                        }
                        $("#txt_case_number").val(new_code);

                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_vtm_pob_d").empty();
                                $("#txt_vtm_pob_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_vtm_pob_c").empty();
                                $("#txt_vtm_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_pob_v").empty();
                                $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_vtm_pob_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_pob_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });
                    });
                    
                    $("#txt_vtm_pob_d").change(function(){
                        var id = $(this).val();

                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_vtm_pob_c").empty();
                                $("#txt_vtm_pob_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_pob_v").empty();
                                $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_vtm_pob_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_pob_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });
                    });

                    $("#txt_vtm_pob_c").change(function(){
                        var id = $(this).val();

                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_vtm_pob_v").empty();
                                $("#txt_vtm_pob_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_vtm_pob_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_pob_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });
                    });
                });

            </script>
        </div>
    </div> 
    <div class="flex-container">
        <div class="flex-item-left">ថ្ងៃខែឆ្នាំ ចាកចេញ​ពីទីលំនៅ​ចុងក្រោយ៖</div>
        <div class="flex-item-right div-input-row">
            <?PHP
                $t = strtotime("-1 year", time());
                $d1 = date("Y-m-d", $t);
                $d2 = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_vtm_leave_date" id="txt_vtm_leave_date" value="<?= $txt_vtm_leave_date?>" min="1979-01-01" max="<?= $d2 ?>" style="width:40%;"> 
            អាយុ៖ <input type="number" name="txt_vtm_leave_age" id="txt_vtm_leave_age" value="<?= $txt_vtm_leave_age?>" min="1" max="999" style="width:40%;">ឆ្នាំ
            <script>
                $(document).ready(function(e){
                    $("#txt_vtm_leave_date").change(function(){
                        var dob = $("#txt_vtm_dob").val();
                        var yob = dob.substring(0,4);
                        var leave_date = $("#txt_vtm_leave_date").val();
                        var leave_year = leave_date.substring(0,4);
                        var age = leave_year - yob;
                        $("#txt_vtm_leave_age").val(age);
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ស្ថានភាពគ្រួសារ</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_married_status" id="txt_vtm_married_status" >
                <option value="">សូមជ្រើសរើស</option>
                <option value="1">នៅលីវ</option>
                <option value="2">មានប្តី/ប្រពន្ធ</option>
                <option value="3">ពោះម៉ាយ/មេម៉ាយ</option>
                <option value="4">លែងលះ</option>
                <option value="5">ផ្សេងៗ</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ចំនួនអ្នកនៅ​ក្នុងបន្ទុក៖</div>
        <div class="flex-item-right div-input-row">
            <input type="number" name="txt_vtm_family_member" id="txt_vtm_family_member" value="<?= $txt_vtm_family_member?>" min="1" max="999">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">កម្រិតវប្បធម៌៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_edu" id="txt_vtm_edu" >
                <option value="">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_vtm_edu) ?>>អនក្ខរកម្ម</option>
                <option value="2" <?= _selected(2,$txt_vtm_edu) ?>>ថ្នាក់ទី១-៦</option>
                <option value="3" <?= _selected(3,$txt_vtm_edu) ?>>ថ្នាក់ទី៧-៩</option>
                <option value="4" <?= _selected(4,$txt_vtm_edu) ?>>ថ្នាក់ទី៩​-១២</option>
                <option value="5"> <?= _selected(5,$txt_vtm_edu) ?>ទុតិយភូមិ</option>
                <option value="6" <?= _selected(6,$txt_vtm_edu) ?>>សិស្សិត​មហាវិទ្យាល័យ</option>
                <option value="7" <?= _selected(7,$txt_vtm_edu) ?>>បរិញ្ញាប័ត្រ</option>
                <option value="8" <?= _selected(8,$txt_vtm_edu) ?>>បរិញ្ញាប័ត្រជាន់ខ្ពស់</option>
                <option value="9" <?= _selected(9,$txt_vtm_edu) ?>>បណ្ឌិត</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">មុខរបរ​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_occupation" id="txt_vtm_occupation" >
                <option value="">សូមជ្រើសរើស</option>
                <?php
                    $q2 = "SELECT * FROM `tb_occupations` WHERE(1)";
                    if(!$rs2 = $vtmdb->query($q2)){ die("Error query occupation"); }
                    while($r2 = $rs2->fetch_assoc()){
                        echo '<option value="'.$r2['occ_id'].'" '._selected($r2['occ_id'],$txt_vtm_occupation).'>'.$r2['occ_name'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">មុខរបរ​ពីមុន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_vtm_previous_occ" id="txt_vtm_previous_occ" >
                <option value="">សូមជ្រើសរើស</option>
                <?php
                    $q2 = "SELECT * FROM `tb_occupations` WHERE(1)";
                    if(!$rs2 = $vtmdb->query($q2)){ die("Error query occupation"); }
                    while($r2 = $rs2->fetch_assoc()){
                        echo '<option value="'.$r2['occ_id'].'" '._selected($r2['occ_id'],$txt_vtm_previous_occ).'>'.$r2['occ_name'].'</option>';
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
                    <select name="txt_vtm_addr_cn" id="txt_vtm_addr_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $_SESSION['cn_id'];

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_vtm_addr_cn).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr_p" id="txt_vtm_addr_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr_d" id="txt_vtm_addr_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr_c" id="txt_vtm_addr_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr_v" id="txt_vtm_addr_v" >
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
                                $("#txt_vtm_addr_p").empty();
                                $("#txt_vtm_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_vtm_addr_d").empty();
                                $("#txt_vtm_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_vtm_addr_c").empty();
                                $("#txt_vtm_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_addr_v").empty();
                                $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_vtm_addr_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_vtm_addr_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_vtm_addr_d").empty();
                                $("#txt_vtm_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_vtm_addr_c").empty();
                                $("#txt_vtm_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_addr_v").empty();
                                $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_vtm_addr_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_vtm_addr_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_vtm_addr_c").empty();
                                $("#txt_vtm_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_addr_v").empty();
                                $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_vtm_addr_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_vtm_addr_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_vtm_addr_v").empty();
                                $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_vtm_addr_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_vtm_addr_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_vtm_addr_p").empty();
                                    $("#txt_vtm_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_vtm_addr_d").empty();
                                    $("#txt_vtm_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_vtm_addr_c").empty();
                                    $("#txt_vtm_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_vtm_addr_v").empty();
                                    $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_vtm_addr_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_vtm_addr_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_vtm_addr_d").empty();
                                    $("#txt_vtm_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_vtm_addr_c").empty();
                                    $("#txt_vtm_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_vtm_addr_v").empty();
                                    $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_vtm_addr_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_vtm_addr_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_vtm_addr_c").empty();
                                    $("#txt_vtm_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_vtm_addr_v").empty();
                                    $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_vtm_addr_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_vtm_addr_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_vtm_addr_v").empty();
                                    $("#txt_vtm_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_vtm_addr_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div>
    
    <!-- Previous Address -->
    <div class="flex-container">
        <div class="flex-item-left">អាសយដ្ឋាន​បណ្តោះអាសន្ន៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr2_cn" id="txt_vtm_addr2_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_vtm_addr2_cn;

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
                    <select name="txt_vtm_addr2_p" id="txt_vtm_addr2_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr2_d" id="txt_vtm_addr2_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr2_c" id="txt_vtm_addr2_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_vtm_addr2_v" id="txt_vtm_addr2_v" >
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
                    var id = "<?= $txt_vtm_addr2_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_vtm_addr2_p").empty();
                                $("#txt_vtm_addr2_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_vtm_addr2_d").empty();
                                $("#txt_vtm_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_vtm_addr2_c").empty();
                                $("#txt_vtm_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_addr2_v").empty();
                                $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_vtm_addr2_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr2_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_vtm_addr2_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_vtm_addr2_d").empty();
                                $("#txt_vtm_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_vtm_addr2_c").empty();
                                $("#txt_vtm_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_addr2_v").empty();
                                $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_vtm_addr2_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr2_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_vtm_addr2_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_vtm_addr2_c").empty();
                                $("#txt_vtm_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_vtm_addr2_v").empty();
                                $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_vtm_addr2_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr2_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_vtm_addr2_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_vtm_addr2_v").empty();
                                $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_vtm_addr2_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_vtm_addr2_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_vtm_addr2_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_vtm_addr2_p").empty();
                                    $("#txt_vtm_addr2_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_vtm_addr2_d").empty();
                                    $("#txt_vtm_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_vtm_addr2_c").empty();
                                    $("#txt_vtm_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_vtm_addr2_v").empty();
                                    $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_vtm_addr2_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_vtm_addr2_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_vtm_addr2_d").empty();
                                    $("#txt_vtm_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_vtm_addr2_c").empty();
                                    $("#txt_vtm_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_vtm_addr2_v").empty();
                                    $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_vtm_addr2_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_vtm_addr2_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_vtm_addr2_c").empty();
                                    $("#txt_vtm_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_vtm_addr2_v").empty();
                                    $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_vtm_addr2_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_vtm_addr2_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_vtm_addr2_v").empty();
                                    $("#txt_vtm_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_vtm_addr2_v").append("<option value='"+v_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ព័ត៌មានទំនាក់ទំនង៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_vtm_contact" id="txt_vtm_contact" value="<?= $txt_vtm_contact ?>" placeholder="012345678, my.email@email.com">
        </div>
    </div>
    </section>

    <!-- Command -->
    <div style="text-align:center">
        <input type="hidden" name="fmCommand" value="<?= $_REQUEST['fmCommand'] ?>">
        <input type="hidden" name="fmSubmit" value="" id="fmSubmit">
        <input type="hidden" name="txt_case_numberx" id="txt_case_numberx" value="<?= $txt_case_number ?>">

        <div class="flex-container">
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_previous1" name="bt_previous" value="<?= $bt_previous ?>" class="command_button" disabled="disabled"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_next1" name="bt_next" value="<?= $bt_next ?>" class="command_button"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_save1" name="bt_save" value="<?= $bt_save ?>" class="command_button bt-submit"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="button" id="bt_close1" name="bt_close" value="<?= $bt_close ?>" class="command_button"></div>
        </div>
    </div>
    <script type="text/javascript" language="javascript">
        $(document).ready(function(e){
            $("#bt_next1").click(function(e){
                e.preventDefault();
                var i = 0;
                var case_loc_cn = $("#txt_country").val();
                var case_loc_p = $("#txt_province").val();
                var vtm_lname = $("#txt_vtm_lname").val();
                var vtm_fname = $("#txt_vtm_fname").val();
                var vtm_sex = $("#txt_vtm_sex").val();
                var vtm_dob = $("#txt_vtm_dob").val();

                $("#fmSubmit").val('next');

                if(case_loc_cn < 0 ){
                    i++;
                    $("#txt_country").focus();
                    $("#txt_country").css('border','1px solic red');
                }else{
                    $("#txt_country").css('border','1px solic #cccccc');
                }

                if(case_loc_p < 0 ){
                    i++;
                    $("#txt_province").focus();
                    $("#txt_province").css('border','1px solic red');
                }else{
                    $("#txt_province").css('border','1px solic #cccccc');
                }

                if(vtm_lname == '' ){
                    i++;
                    $("#txt_vtm_lname").focus();
                    $("#txt_vtm_lname").css('border','1px solic red');
                }else{
                    $("#txt_vtm_lname").css('border','1px solic #cccccc');
                }

                if(vtm_fname == '' ){
                    i++;
                    $("#txt_vtm_fname").focus();
                    $("#txt_vtm_fname").css('border','1px solic red');
                }else{
                    $("#txt_vtm_fname").css('border','1px solic #cccccc');
                }

                if(vtm_sex == '' ){
                    i++;
                    $("#txt_vtm_sex").focus();
                    $("#txt_vtm_sex").css('border','1px solic red');
                }else{
                    $("#txt_vtm_sex").css('border','1px solic #cccccc');
                }

                if(vtm_dob == '' ){
                    i++;
                    $("#txt_vtm_dob").focus();
                    $("#txt_vtm_dob").css('border','1px solic red');
                }else{
                    $("#txt_vtm_dob").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_main").submit();
                }
            });

            $("#bt_save1").click(function(e){
                e.preventDefault();
                var i = 0;
                var case_loc_cn = $("#txt_country").val();
                var case_loc_p = $("#txt_province").val();
                var vtm_lname = $("#txt_vtm_lname").val();
                var vtm_fname = $("#txt_vtm_fname").val();
                var vtm_sex = $("#txt_vtm_sex").val();
                var vtm_dob = $("#txt_vtm_dob").val();

                $("#fmSubmit").val('save');

                if(case_loc_cn < 0 ){
                    i++;
                    $("#txt_country").focus();
                    $("#txt_country").css('border','1px solic red');
                }else{
                    $("#txt_country").css('border','1px solic #cccccc');
                }

                if(case_loc_p < 0 ){
                    i++;
                    $("#txt_province").focus();
                    $("#txt_province").css('border','1px solic red');
                }else{
                    $("#txt_province").css('border','1px solic #cccccc');
                }

                if(vtm_lname == '' ){
                    i++;
                    $("#txt_vtm_lname").focus();
                    $("#txt_vtm_lname").css('border','1px solic red');
                }else{
                    $("#txt_vtm_lname").css('border','1px solic #cccccc');
                }

                if(vtm_fname == '' ){
                    i++;
                    $("#txt_vtm_fname").focus();
                    $("#txt_vtm_fname").css('border','1px solic red');
                }else{
                    $("#txt_vtm_fname").css('border','1px solic #cccccc');
                }

                if(vtm_sex == '' ){
                    i++;
                    $("#txt_vtm_sex").focus();
                    $("#txt_vtm_sex").css('border','1px solic red');
                }else{
                    $("#txt_vtm_sex").css('border','1px solic #cccccc');
                }

                if(vtm_dob == '' ){
                    i++;
                    $("#txt_vtm_dob").focus();
                    $("#txt_vtm_dob").css('border','1px solic red');
                }else{
                    $("#txt_vtm_dob").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_main").submit();
                }
            });

            $("#victim").hide();

            $("#bt_general").click(function(){
                $("#general").slideToggle("slow");
            });

            $("#bt_victim").click(function(){
                $("#victim").slideToggle("slow");
            });

            $("#bt_close1").click(function(){
                window.close();
            });

            <?= $script; ?>
        });
    </script>
</form>