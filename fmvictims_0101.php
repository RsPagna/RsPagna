<?PHP
//Call function
include("inc/fnSelect.php");

//Function
    
    if(isset($_REQUEST['fmCommand'])){
        $bt_command = '';
        $fm_title = '';
        $item_exist = true;
        $script = '';
        $success = 0;

        if($_REQUEST['fmCommand'] == 'add'){
            $bt_command = bt_add_label;
            $fm_title = txt_add_new_referer;
        }elseif($_REQUEST['fmCommand'] == 'edit'){
            if(isset($_REQUEST['n'])){
                $q = "SELECT * FROM `tb_cases_0101` WHERE (`cas_case_number`='".$_REQUEST['n']."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }
            
            $txt_case_number = isset($_REQUEST['txt_case_number']) ? $_REQUEST['txt_case_number'] : $r['cas_case_number'];
            $txt_agn_type = isset($_REQUEST['txt_agn_type']) ? $_REQUEST['txt_agn_type'] : $r['cas_agn_type'];
            $txt_agn_fname = isset($_REQUEST['txt_agn_fname']) ? $_REQUEST['txt_agn_fname'] : $r['cas_agn_fname'];
            $txt_agn_lname = isset($_REQUEST['txt_agn_lname']) ? $_REQUEST['txt_agn_lname'] : $r['cas_agn_lname'];
            $txt_agn_nick_name = isset($_REQUEST['txt_agn_nick_name']) ? $_REQUEST['txt_agn_nick_name'] : $r['cas_agn_nick_name'];
            $txt_agn_sex = isset($_REQUEST['txt_agn_sex']) ? $_REQUEST['txt_agn_sex'] : $r['cas_agn_sex'];
            $txt_agn_dob = isset($_REQUEST['txt_agn_dob']) ? $_REQUEST['txt_agn_dob'] : $r['cas_agn_dob'];
            $txt_agn_age = isset($_REQUEST['txt_agn_age']) ? $_REQUEST['txt_agn_age'] : $r['cas_agn_age'];
            $txt_agn_family_status = isset($_REQUEST['txt_agn_family_status']) ? $_REQUEST['txt_agn_family_status'] : $r['cas_agn_family_status'];
            $txt_agn_origin = isset($_REQUEST['txt_agn_origin']) ? $_REQUEST['txt_agn_origin'] : $r['cas_agn_origin'];
            $txt_agn_nationality = isset($_REQUEST['txt_agn_nationality']) ? $_REQUEST['txt_agn_nationality'] : $r['cas_agn_nationality'];
            $txt_agn_id_number = isset($_REQUEST['txt_agn_id_number']) ? $_REQUEST['txt_agn_id_number'] : $r['cas_agn_id_number'];
            $txt_agn_id_expire_date = isset($_REQUEST['txt_agn_id_expire_date']) ? $_REQUEST['txt_agn_id_expire_date'] : $r['cas_agn_id_expire_date'];
            $txt_agn_occupation = isset($_REQUEST['txt_agn_occupation']) ? $_REQUEST['txt_agn_occupation'] : $r['cas_agn_occupation'];
            $txt_agn_addr_v = isset($_REQUEST['txt_agn_addr_v']) ? $_REQUEST['txt_agn_addr_v'] : $r['cas_agn_addr_v'];
            $txt_agn_addr_c = isset($_REQUEST['txt_agn_addr_c']) ? $_REQUEST['txt_agn_addr_c'] : $r['cas_agn_addr_c'];
            $txt_agn_addr_d = isset($_REQUEST['txt_agn_addr_d']) ? $_REQUEST['txt_agn_addr_d'] : $r['cas_agn_addr_d'];
            $txt_agn_addr_p = isset($_REQUEST['txt_agn_addr_p']) ? $_REQUEST['txt_agn_addr_p'] : $r['cas_agn_addr_p'];
            $txt_agn_addr_cn = isset($_REQUEST['txt_agn_addr_cn']) ? $_REQUEST['txt_agn_addr_cn'] : $r['cas_agn_addr_cn'];
            $txt_agn_addr2_v = isset($_REQUEST['txt_agn_addr2_v']) ? $_REQUEST['txt_agn_addr2_v'] : $r['cas_agn_addr2_v'];
            $txt_agn_addr2_c = isset($_REQUEST['txt_agn_addr2_c']) ? $_REQUEST['txt_agn_addr2_c'] : $r['cas_agn_addr2_c'];
            $txt_agn_addr2_d = isset($_REQUEST['txt_agn_addr2_d']) ? $_REQUEST['txt_agn_addr2_d'] : $r['cas_agn_addr2_d'];
            $txt_agn_addr2_p = isset($_REQUEST['txt_agn_addr2_p']) ? $_REQUEST['txt_agn_addr2_p'] : $r['cas_agn_addr2_p'];
            $txt_agn_addr2_cn = isset($_REQUEST['txt_agn_addr2_cn']) ? $_REQUEST['txt_agn_addr2_cn'] : $r['cas_agn_addr2_cn'];
            $txt_agn_file = isset($_FILES['txt_agn_file']) ? $txt_case_number.$_FILES['txt_agn_file']['name'] : '';
            $txt_agn_filex = !empty($txt_agn_file) ? $txt_agn_file : (!empty($r['cas_agn_legal_doc']) ? $r['cas_agn_legal_doc'] : '');
            $txt_agn_contact = isset($_REQUEST['txt_agn_contact']) ? $_REQUEST['txt_agn_contact'] : $r['cas_agn_contact'];
            
            $bt_command = bt_edit_label;
            $fm_title = txt_edit_referer;
        }elseif($_REQUEST['fmCommand'] == 'delete'){
            if(isset($_REQUEST['id'])){
                $q = "SELECT * FROM `tb_cases_0101` WHERE (`cas_number`='".decode128($_REQUEST['id'])."')";
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
   
    if(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == "next"){

        echo "<script language='javascript' type='text/javascript'>
                window.open('fmvictims.php?fmCommand=edit&load_child_form=f0101&n=".$txt_case_number."','_self');
            </script> ";
    }elseif(isset($_REQUEST['fmSubmit']) and $_REQUEST['fmSubmit'] == "save"){

        //upload file if any
        if(!empty($txt_agn_file)){
                
            $target_path = "images/uploaded/";

            //remove old photo
            if(!empty($_REQUEST['txt_agn_filex'])){
                unlink($target_path.$_REQUEST['txt_agn_filex']);
            }

            $target_path = $target_path.basename($txt_case_number."_0101_".$_FILES['txt_agn_file']['name']); 

            if(!move_uploaded_file($_FILES['txt_agn_file']['tmp_name'], $target_path)) {
                $txt_agn_file = "There was an error uploading the file, please try again!";
            }else{
                $txt_agn_file = $txt_case_number."_0101_".$_FILES['txt_agn_file']['name'];
            }
            $txt_agn_filex = $txt_agn_file;
        }else{
            $txt_agn_file = !empty($txt_agn_filex) ? $txt_agn_filex : '';
        }

        //Update form 0101
        $q0101 = "UPDATE `tb_cases_0101` SET `cas_agn_type` = '".$txt_agn_type."'
                                            ,`cas_agn_fname` = '".$txt_agn_fname."'
                                            ,`cas_agn_lname` = '".$txt_agn_lname."'
                                            ,`cas_agn_nick_name` = '".$txt_agn_nick_name."'
                                            ,`cas_agn_sex` = '".$txt_agn_sex."'
                                            ,`cas_agn_dob` = '".$txt_agn_dob."'
                                            ,`cas_agn_age` = '".$txt_agn_age."'
                                            ,`cas_agn_family_status` = '".$txt_agn_family_status."'
                                            ,`cas_agn_origin` = '".$txt_agn_origin."'
                                            ,`cas_agn_nationality` = '".$txt_agn_nationality."'
                                            ,`cas_agn_id_number` = '".$txt_agn_id_number."'
                                            ,`cas_agn_id_expire_date` = '".$txt_agn_id_expire_date."'
                                            ,`cas_agn_occupation` = '".$txt_agn_occupation."'
                                            ,`cas_agn_addr_v` = '".$txt_agn_addr_v."'
                                            ,`cas_agn_addr_c` = '".$txt_agn_addr_c."'
                                            ,`cas_agn_addr_d` = '".$txt_agn_addr_d."'
                                            ,`cas_agn_addr_p` = '".$txt_agn_addr_p."'
                                            ,`cas_agn_addr_cn` = '".$txt_agn_addr_cn."'
                                            ,`cas_agn_addr2_v` = '".$txt_agn_addr2_v."'
                                            ,`cas_agn_addr2_c` = '".$txt_agn_addr2_c."'
                                            ,`cas_agn_addr2_d` = '".$txt_agn_addr2_d."'
                                            ,`cas_agn_addr2_p` = '".$txt_agn_addr2_p."'
                                            ,`cas_agn_addr2_cn` = '".$txt_agn_addr2_cn."'
                                            ,`cas_agn_legal_doc` = '".$txt_agn_file."'
                                            ,`cas_agn_contact` = '".$txt_agn_contact."'
                                            ,`last_modify_by` = '".$_SESSION['user_id']."'
                                            ,`date_modify` = '".$date."' 
                        WHERE(`cas_case_number`='".$txt_case_number."')";
        if(!$vtmdb->query($q0101)){ die("Error insert into case 0101!".$vtmdb->error); }else{ $success += 1; }

        if($success > 0){

        }
    }else{
        
    }
?>

<?PHP include("inc/tab_menu.php"); ?>
<script>
    //To modify current tab menu number
    $(document).ready(function(e){
        $("#t3").addClass("t1-active");
    });
</script>

<form name="fm_case_0101" id="fm_case_0101" action="" method="post" enctype="multipart/form-data">
<h1 style="text-align:center;">ផ្នែកទី១</h1>
    <h1 style="text-align:center;">ព័ត៌មានអំពីភ្នាក់ងារ</h1>
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><label><?= $txt_case_number ?></label></div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ប្រភេទ​ភ្នាក់ងារ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_agn_type" id="txt_agn_type" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_agn_type).'>'.$r['agn_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_agn_type").change(function(){
                        if($(this).val() == "add"){
                            window.open('settings/fmagencies.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមត្រកូល៖</div>
        <div class="flex-item-right div-input-row"><input type="text" name="txt_agn_fname" id="txt_agn_fname" value="<?= $txt_agn_fname ?>"/></div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>នាមឈ្មោះ៖</div>
        <div class="flex-item-right div-input-row"><input type="text" name="txt_agn_lname" id="txt_agn_lname" value="<?= $txt_agn_lname ?>"/></div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឈ្មោះហៅក្រៅ៖</div>
        <div class="flex-item-right div-input-row"><input type="text" name="txt_agn_nick_name" id="txt_agn_nick_name" value="<?= $txt_agn_nick_name ?>"/></div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ភេទ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_agn_sex" id="txt_tvm_sex">
                <option value="0">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_agn_sex) ?>>ប្រុស</option>
                <option value="2" <?= _selected(2,$txt_agn_sex) ?>>ស្រី</option>
                <option value="3" <?= _selected(3,$txt_agn_sex) ?>>ផ្សេងៗ</option>
                <option value="4" <?= _selected(4,$txt_agn_sex) ?>>n/a</option>
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
            <input type="date" name="txt_agn_dob" id="txt_agn_dob" value="<?= $txt_agn_dob?>" min="1900-01-01" max="<?= $d ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អាយុ៖</div>
        <div class="flex-item-right div-input-row"><input type="text" name="txt_agn_age" id="txt_agn_age" value="<?= $txt_agn_age ?>"/></div>
    </div>
    <script>
        $(document).ready(function(e){
            $("#txt_agn_dob").change(function(){
                var dob = $(this).val();
                var yob = dob.substring(0,4);
                var current_year = <?= $Y ?>;
                var age = current_year - yob;
                $("#txt_agn_age").val(age);
            });
        });
    </script>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>ជនជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_agn_origin" id="txt_agn_origin">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_agn_origin).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">សញ្ជាតិ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_agn_nationality" id="txt_agn_nationality">
                <option value="0">សូមជ្រើសរើស</option>
                <?PHP
                    $q = "SELECT * FROM `tb_countries` ORDER BY `cn_acronym`";
                    if(!$rs = $vtmdb->query($q)){ die("Error language: ".$vtmdb->error); }
                    while($r = $rs->fetch_assoc()){
                        echo "<option value=\"".$r['cn_id']."\" "._selected($r['cn_id'],$txt_agn_nationality).">".$r['cn_acronym']."(".$r['cn_nationality_kh'].")</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left"><span class="error">*</span>លេខ​អត្តសញ្ញាណ​ប័ណ្ណ​សញ្ជាតិ​ខ្មែរ៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_agn_id_number" id="txt_agn_id_number" value="<?= $txt_agn_id_number ?>" maxlength="9">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">កាលបរិច្ឆេទ​ផុតកំណត់៖</div>
        <div class="flex-item-right div-input-row">
            នៅមានសុពលភាព៖ <input type="radio" name="txt_agn_id_expired" id="txt_agn_id_not_expired" value="1" style="width:30px;" checked="checked"> 
            ហួសសុពលភាព៖ <input type="radio" name="txt_agn_id_expired" id="txt_agn_id_expired" value="-1" style="width:30px;">
            <?PHP
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_agn_id_expire_date" id="txt_agn_expire_date" min="<?= $d ?>" max="9999" value="<?= $txt_agn_id_expire_date ?>">
            <script>
                $(document).ready(function(e){
                    $("#txt_agn_id_expired").click(function(){
                        $("#txt_agn_expire_date").attr("disabled","disabled");
                    });

                    $("#txt_agn_id_not_expired").click(function(){
                        $("#txt_agn_expire_date").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ស្ថានភាពគ្រួសារ</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_agn_married_status" id="txt_agn_married_status" >
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
        <div class="flex-item-left">មុខរបរ​បច្ចុប្បន្ន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_agn_occupation" id="txt_agn_occupation" >
                <option value="">សូមជ្រើសរើស</option>
                <?php
                    $q2 = "SELECT * FROM `tb_occupations` WHERE(1)";
                    if(!$rs2 = $vtmdb->query($q2)){ die("Error query occupation"); }
                    while($r2 = $rs2->fetch_assoc()){
                        echo '<option value="'.$r2['occ_id'].'" '._selected($r2['occ_id'],$txt_agn_occupation).'>'.$r2['occ_name'].'</option>';
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
                    <select name="txt_agn_addr_cn" id="txt_agn_addr_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $_SESSION['cn_id'];

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_agn_addr_cn).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_province ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr_p" id="txt_agn_addr_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr_d" id="txt_agn_addr_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr_c" id="txt_agn_addr_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr_v" id="txt_agn_addr_v" >
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
                    var id = "<?= $txt_agn_addr_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_agn_addr_p").empty();
                                $("#txt_agn_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_agn_addr_d").empty();
                                $("#txt_agn_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_agn_addr_c").empty();
                                $("#txt_agn_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_agn_addr_v").empty();
                                $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_agn_addr_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_agn_addr_p?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_agn_addr_d").empty();
                                $("#txt_agn_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_agn_addr_c").empty();
                                $("#txt_agn_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_agn_addr_v").empty();
                                $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_agn_addr_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_agn_addr_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_agn_addr_c").empty();
                                $("#txt_agn_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_agn_addr_v").empty();
                                $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_agn_addr_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_agn_addr_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_agn_addr_v").empty();
                                $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_agn_addr_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_agn_addr_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_agn_addr_p").empty();
                                    $("#txt_agn_addr_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_agn_addr_d").empty();
                                    $("#txt_agn_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_agn_addr_c").empty();
                                    $("#txt_agn_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_agn_addr_v").empty();
                                    $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_agn_addr_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_agn_addr_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_agn_addr_d").empty();
                                    $("#txt_agn_addr_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_agn_addr_c").empty();
                                    $("#txt_agn_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_agn_addr_v").empty();
                                    $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_agn_addr_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_agn_addr_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_agn_addr_c").empty();
                                    $("#txt_agn_addr_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_agn_addr_v").empty();
                                    $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_agn_addr_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_agn_addr_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_agn_addr_v").empty();
                                    $("#txt_agn_addr_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_agn_addr_v").append("<option value='"+v_id+"'>"+name+"</option>");
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
                    <select name="txt_agn_addr2_cn" id="txt_agn_addr2_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $txt_agn_addr2_cn;

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
                    <select name="txt_agn_addr2_p" id="txt_agn_addr2_p" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected country -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_district ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr2_d" id="txt_agn_addr2_d" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_commune ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr2_c" id="txt_agn_addr2_c" >
                        <option value="">សូមជ្រើសរើស</option>
                        <!-- Loading by selected province -->
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_village ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_agn_addr2_v" id="txt_agn_addr2_v" >
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
                    var id = "<?= $txt_agn_addr2_cn ?>";

                        $.ajax({
                            url: 'settings/load_provinces.php',
                            type: 'post',
                            data: {cn_id:id},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear province
                                $("#txt_agn_addr2_p").empty();
                                $("#txt_agn_addr2_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                
                                //Clear district
                                $("#txt_agn_addr2_d").empty();
                                $("#txt_agn_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_agn_addr2_c").empty();
                                $("#txt_agn_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_agn_addr2_v").empty();
                                $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var p_id = response[i]['p_id'];
                                    var name = response[i]['p_name_kh'];
                                    var selected = '';
                                    if(p_id == '<?= $txt_agn_addr2_p ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr2_p").append("<option value='"+p_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load district
                    var id2 = "<?= $txt_agn_addr2_p ?>";
                        
                        $.ajax({
                            url: 'settings/load_districts.php',
                            type: 'post',
                            data: {p_id:id2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear district
                                $("#txt_agn_addr2_d").empty();
                                $("#txt_agn_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                //Clear commune
                                $("#txt_agn_addr2_c").empty();
                                $("#txt_agn_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_agn_addr2_v").empty();
                                $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var d_id = response[i]['d_id'];
                                    var name = response[i]['d_name_kh'];
                                    var selected = '';
                                    if(d_id == '<?= $txt_agn_addr2_d ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr2_d").append("<option value='"+d_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load commune
                    var id3 = "<?= $txt_agn_addr2_d ?>";
                        
                        $.ajax({
                            url: 'settings/load_communes.php',
                            type: 'post',
                            data: {d_id:id3},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear commune
                                $("#txt_agn_addr2_c").empty();
                                $("#txt_agn_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                //Clear village
                                $("#txt_agn_addr2_v").empty();
                                $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var c_id = response[i]['c_id'];
                                    var name = response[i]['c_name_kh'];
                                    var selected = '';
                                    if(c_id == '<?= $txt_agn_addr2_c ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr2_c").append("<option value='"+c_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                    //load village
                    var id4 = "<?= $txt_agn_addr2_c ?>";
                        
                        $.ajax({
                            url: 'settings/load_villages.php',
                            type: 'post',
                            data: {c_id:id4},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;
                                //Clear village
                                $("#txt_agn_addr2_v").empty();
                                $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                for( var i = 0; i<len; i++){
                                    var v_id = response[i]['v_id'];
                                    var name = response[i]['v_name_kh'];
                                    var selected = '';
                                    if(v_id == '<?= $txt_agn_addr2_v ?>'){
                                        selected = 'selected = "selected"';
                                    }

                                    $("#txt_agn_addr2_v").append("<option value='"+v_id+"' "+selected+">"+name+"</option>");
                                }
                            }
                        });

                        $("#txt_agn_addr2_cn").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_provinces.php',
                                type: 'post',
                                data: {cn_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear province
                                    $("#txt_agn_addr2_p").empty();
                                    $("#txt_agn_addr2_p").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះខេត្ត-រាជធានី-រដ្ឋ</option>");
                                    
                                    //Clear district
                                    $("#txt_agn_addr2_d").empty();
                                    $("#txt_agn_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_agn_addr2_c").empty();
                                    $("#txt_agn_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_agn_addr2_v").empty();
                                    $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var p_id = response[i]['p_id'];
                                        var name = response[i]['p_name_kh'];

                                        $("#txt_agn_addr2_p").append("<option value='"+p_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        }); 
                    
                        $("#txt_agn_addr2_p").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_districts.php',
                                type: 'post',
                                data: {p_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;
                                    //Clear district
                                    $("#txt_agn_addr2_d").empty();
                                    $("#txt_agn_addr2_d").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះស្រុក-ក្រុង-ខណ្ឌ</option>");

                                    //Clear commune
                                    $("#txt_agn_addr2_c").empty();
                                    $("#txt_agn_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_agn_addr2_v").empty();
                                    $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var d_id = response[i]['d_id'];
                                        var name = response[i]['d_name_kh'];

                                        $("#txt_agn_addr2_d").append("<option value='"+d_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });
                        
                        $("#txt_agn_addr2_d").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_communes.php',
                                type: 'post',
                                data: {d_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear commune
                                    $("#txt_agn_addr2_c").empty();
                                    $("#txt_agn_addr2_c").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះឃុំ-សង្កាត់</option>");

                                    //Clear village
                                    $("#txt_agn_addr2_v").empty();
                                    $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var c_id = response[i]['c_id'];
                                        var name = response[i]['c_name_kh'];

                                        $("#txt_agn_addr2_c").append("<option value='"+c_id+"'>"+name+"</option>");
                                    }
                                }
                            });
                        });

                        $("#txt_agn_addr2_c").change(function(){
                            var id = $(this).val();

                            $.ajax({
                                url: 'settings/load_villages.php',
                                type: 'post',
                                data: {c_id:id},
                                dataType: 'json',
                                success:function(response){

                                    var len = response.length;

                                    //Clear village
                                    $("#txt_agn_addr2_v").empty();
                                    $("#txt_agn_addr2_v").append("<option value='-1'>សូមជ្រើសរើសឈ្មោះភូមិ</option>");

                                    for( var i = 0; i<len; i++){
                                        var v_id = response[i]['v_id'];
                                        var name = response[i]['v_name_kh'];

                                        $("#txt_agn_addr2_v").append("<option value='"+v_id+"'>"+name+"</option>");
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
            <input type="file" name="txt_agn_file" id="txt_agn_file" accept="image/*" capture="camera"> 
            <?php
                if(!empty($txt_agn_filex)){
                    echo '<a href="#" onclick="window.open(\'images/uploaded/'.$txt_agn_filex.'\',\'_blank\')">'.$txt_agn_filex.'</a>';
                    echo '<input type="hidden" name="txt_agn_filex" value="'.$txt_agn_filex.'">';
                }
            ?>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ព័ត៌មានទំនាក់ទំនង៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_agn_contact" id="txt_agn_contact" value="<?= $txt_agn_contact ?>" placeholder="012345678, my.email@email.com">
        </div>
    </div>
    
    <!-- Command -->
    <div style="text-align:center">
        <input type="hidden" name="fmCommand" value="<?= $_REQUEST['fmCommand'] ?>">
        <input type="hidden" name="fmSubmit" value="" id="fmSubmit">
        <input type="hidden" name="load_child_form" value="f0101">
        <input type="hidden" name="n" value="<?= $txt_case_number ?>">

        <div class="flex-container">
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="button" id="bt_prev" name="bt_previous" value="<?= $bt_previous ?>" class="command_button"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="button" id="bt_next" name="bt_next" value="<?= $bt_next ?>" class="command_button"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="submit" id="bt_save" name="bt_save" value="<?= $bt_save ?>" class="command_button bt-submit"></div>
            <div style="flex:20%; margin:0px 5px 0px 5px;"><input type="button" id="bt_close" name="bt_close" value="<?= $bt_close ?>" class="command_button"></div>
        </div>
    </div>
    <script>
        $(document).ready(function(e){
            $("#bt_save").click(function(e){
                e.preventDefault();

                //Set value to fmSubmit
                $("#fmSubmit").val('save');

                var i = 0;
                var agn_type = $("#txt_agn_type").val();
                var agn_lname = $("#txt_agn_lname").val();
                var agn_fname = $("#txt_agn_fname").val();
                var agn_sex = $("#txt_agn_sex").val();
                var agn_dob = $("#txt_agn_dob").val();

                if(agn_type == '' ){
                    i++;
                    $("#txt_agn_type").focus();
                    $("#txt_agn_type").css('border','1px solic red');
                }else{
                    $("#txt_agn_type").css('border','1px solic #cccccc');
                }

                if(agn_lname == '' ){
                    i++;
                    $("#txt_agn_lname").focus();
                    $("#txt_agn_lname").css('border','1px solic red');
                }else{
                    $("#txt_agn_lname").css('border','1px solic #cccccc');
                }

                if(agn_fname == '' ){
                    i++;
                    $("#txt_agn_fname").focus();
                    $("#txt_agn_fname").css('border','1px solic red');
                }else{
                    $("#txt_agn_fname").css('border','1px solic #cccccc');
                }

                if(agn_sex == '' ){
                    i++;
                    $("#txt_agn_sex").focus();
                    $("#txt_agn_sex").css('border','1px solic red');
                }else{
                    $("#txt_agn_sex").css('border','1px solic #cccccc');
                }

                if(agn_dob == '' ){
                    i++;
                    $("#txt_agn_dob").focus();
                    $("#txt_agn_dob").css('border','1px solic red');
                }else{
                    $("#txt_agn_dob").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_0101").submit();
                }
            });

            $("#bt_next").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f0201&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_prev").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=fp&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_close").click(function(){
                window.close();
            });

            <?= $script ?>
        });
    </script>
</form>