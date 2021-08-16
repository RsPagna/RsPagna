<?PHP
//Call function
include("inc/fnSelect.php");
include("inc/fnCheck.php");

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
                $q = "SELECT * FROM `tb_cases_0201` WHERE (`cas_case_number`='".$_REQUEST['n']."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }
            
            $txt_case_number = isset($_REQUEST['n']) ? $_REQUEST['n'] : @$r['cas_case_number'];
            $txt_bef_addr = isset($_REQUEST['txt_bef_addr']) ? $_REQUEST['txt_bef_addr'] : @$r['cas_bef_addr'];
            $txt_bef_addr_cn = isset($_REQUEST['txt_bef_addr_cn']) ? $_REQUEST['txt_bef_addr_cn'] : @$r['cas_bef_addr_cn'];
            $txt_bef_date_left = isset($_REQUEST['txt_bef_date_left']) ? $_REQUEST['txt_bef_date_left'] : @$r['cas_bef_date_left'];
            $txt_bef_agent = isset($_REQUEST['txt_bef_agent']) ? $_REQUEST['txt_bef_agent'] : @$r['cas_bef_agent'];
            $txt_bef_agent_info = isset($_REQUEST['txt_bef_agent_info']) ? $_REQUEST['txt_bef_agent_info'] : @$r['cas_bef_agent_info'];
            $txt_bef_job_promissed = isset($_REQUEST['txt_bef_job_promissed']) ? $_REQUEST['txt_bef_job_promissed'] : @$r['cas_bef_job_promissed'];
            $txt_bef_wage_promissed = isset($_REQUEST['txt_bef_wage_promissed']) ? $_REQUEST['txt_bef_wage_promissed'] : @$r['cas_bef_wage_promissed'];
            $txt_bef_wage_currency = isset($_REQUEST['txt_bef_wage_currency']) ? $_REQUEST['txt_bef_wage_currency'] : @$r['cas_bef_wage_currency'];
            $txt_bef_wage_period = isset($_REQUEST['txt_bef_wage_period']) ? $_REQUEST['txt_bef_wage_period'] : @$r['cas_bef_wage_period'];
            $wage_period = '';
            switch($txt_bef_wage_period){
                case 1: $wage_period = 1; $txt_bef_wage_period = ""; break;
                case 2: $wage_period = 2; $txt_bef_wage_period = ""; break;
                case 3: $wage_period = 3; $txt_bef_wage_period = ""; break;
                case 4: $wage_period = 4; $txt_bef_wage_period = ""; break;
                default: $wage_period = 5; break;
            }
            $txt_bef_other_promissed = isset($_REQUEST['txt_bef_other_promissed']) ? $_REQUEST['txt_bef_other_promissed'] : @$r['cas_bef_other_promissed'];
            $txt_bef_job_service_cost = isset($_REQUEST['txt_bef_job_service_cost']) ? $_REQUEST['txt_bef_job_service_cost'] : @$r['cas_bef_job_service_cost'];
            $txt_bef_job_service_currency = isset($_REQUEST['txt_bef_job_service_currency']) ? $_REQUEST['txt_bef_job_service_currency'] : @$r['cas_bef_job_service_currency'];
            $txt_bef_job_service_purpose = isset($_REQUEST['txt_bef_job_service_purpose']) ? $_REQUEST['txt_bef_job_service_purpose'] : @$r['cas_bef_job_service_purpose'];
            $txt_bef_job_service_receiver = isset($_REQUEST['txt_bef_job_service_receiver']) ? $_REQUEST['txt_bef_job_service_receiver'] : @$r['cas_bef_job_service_receiver'];
            $txt_bef_job_deposit = isset($_REQUEST['txt_bef_job_deposit']) ? $_REQUEST['txt_bef_job_deposit'] : @$r['cas_bef_job_deposit'];
            $txt_bef_job_deposit_currency = isset($_REQUEST['txt_bef_job_deposit_currency']) ? $_REQUEST['txt_bef_job_deposit_currency'] : @$r['cas_bef_job_deposit_currency'];
            $txt_bef_job_deposit_purpose = isset($_REQUEST['txt_bef_job_deposit_purpose']) ? $_REQUEST['txt_bef_job_deposit_purpose'] : @$r['cas_bef_job_deposit_purpose'];
            $txt_bef_job_deposit_receiver = isset($_REQUEST['txt_bef_job_deposit_receiver']) ? $_REQUEST['txt_bef_job_deposit_receiver'] : @$r['cas_bef_job_deposit_receiver'];
            
            $bt_command = bt_edit_label;
            $fm_title = txt_edit_referer;
        }elseif($_REQUEST['fmCommand'] == 'delete'){
            if(isset($_REQUEST['id'])){
                $q = "SELECT * FROM `tb_cases_0201` WHERE (`cas_number`='".decode128($_REQUEST['id'])."')";
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

        if(isset($_REQUEST['has_agent']) and $_REQUEST['has_agent']==1){
            $txt_bef_agent = '';
            $txt_bef_agent_info = '';
        }

        if(isset($_REQUEST['wage_promissed']) and $_REQUEST['wage_promissed']==1){
            $txt_bef_wage_promissed = '';
            $txt_bef_wage_period = '';
            $txt_bef_wage_currency = '';
        }

        if(isset($_REQUEST['other_promissed']) and $_REQUEST['other_promissed']==1){
            $txt_bef_other_promissed = '';

        }

        if(isset($_REQUEST['commission']) and $_REQUEST['commission']==1){
            $txt_bef_job_service_cost = '';
            $txt_bef_job_service_currency = '';
            $txt_bef_job_service_purpose = '';
            $txt_bef_job_service_receiver = '';
        }

        if(isset($_REQUEST['deposit']) and $_REQUEST['deposit']==1){
            $txt_bef_job_deposit = '';
            $txt_bef_job_deposit_currency = '';
            $txt_bef_job_deposit_purpose = '';
            $txt_bef_job_deposit_receiver = '';
        }

        //Update form 0201
        $q0201 = "UPDATE `tb_cases_0201` SET `cas_bef_addr` = '".$txt_bef_addr."'
                                            ,`cas_bef_addr_cn` = '".$txt_bef_addr_cn."'
                                            ,`cas_bef_date_left` = '".$txt_bef_date_left."'
                                            ,`cas_bef_agent` = '".$txt_bef_agent."'
                                            ,`cas_bef_agent_info` = '".$txt_bef_agent_info."'
                                            ,`cas_bef_job_promissed` = '".$txt_bef_job_promissed."'
                                            ,`cas_bef_wage_promissed` = '".$txt_bef_wage_promissed."'
                                            ,`cas_bef_wage_currency` = '".$txt_bef_wage_currency."'
                                            ,`cas_bef_wage_period` = '".$txt_bef_wage_period."'
                                            ,`cas_bef_other_promissed` = '".$txt_bef_other_promissed."'
                                            ,`cas_bef_job_service_cost` = '".$txt_bef_job_service_cost."'
                                            ,`cas_bef_job_service_currency` = '".$txt_bef_job_service_currency."'
                                            ,`cas_bef_job_service_purpose` = '".$txt_bef_job_service_purpose."'
                                            ,`cas_bef_job_service_receiver` = '".$txt_bef_job_service_receiver."'
                                            ,`cas_bef_job_deposit` = '".$txt_bef_job_deposit."'
                                            ,`cas_bef_job_deposit_currency` = '".$txt_bef_job_deposit_currency."'
                                            ,`cas_bef_job_deposit_purpose` = '".$txt_bef_job_deposit_purpose."'
                                            ,`cas_bef_job_deposit_receiver` = '".$txt_bef_job_deposit_receiver."'
                                            ,`last_modify_by` = '".$_SESSION['user_id']."'
                                            ,`date_modify` = '".$date."' 
                        WHERE(`cas_case_number`='".$txt_case_number."')";
        if(!$vtmdb->query($q0201)){ die("Error insert into case 0201!".$vtmdb->error); }else{ $success += 1; }

        if($success > 0){

        }
    }else{
        
    }
?>

<?PHP include("inc/tab_menu.php"); ?>
<script>
    //To modify current tab menu number
    $(document).ready(function(e){
        $("#t4").addClass("t1-active");
    });
</script>

<form name="fm_case_0201" id="fm_case_0201" action="">
    <h1 style="text-align:center;">ផ្នែកទី២</h1>
    <h1 style="text-align:center;">ដំណាក់កាលជ្រើសរើស</h1>
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><label><?= $txt_case_number ?></label></div>
    </div>
        
    <!-- Address befor issue occured -->
    <div class="flex-container">
        <div class="flex-item-left">ទីកន្លែងរស់នៅមុនពេលកើតហេតុ៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left"><?= txt_country ?>៖</div>
                <div class="flex-item-right">
                    <select name="txt_bef_addr_cn" id="txt_bef_addr_cn" >
                        <option value="-1">សូមជ្រើសរើស</option>
                        <?PHP
                            $txt_country = $_SESSION['cn_id'];

                            $qc = "SELECT * FROM `tb_countries` WHERE(1) ORDER BY `cn_name_en`";
                            if(!$rsc = $vtmdb->query($qc)) { die("Error select country: ".$vtmdb->error); }
                            while($rc = $rsc->fetch_assoc()){
                                echo "<option value=\"".$rc['cn_id']."\" "._selected($rc['cn_id'],$txt_bef_addr_cn).">".$rc['cn_acronym']." (".$rc['cn_name_kh'].")</option>";
                            }
                            unset($qc,$rsc,$rc);
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left">អាសយដ្ឋាន៖</div>
                <div class="flex-item-right">
                    <input type="text" name="txt_bef_addr" id="txt_bef_addr" value="<?= $txt_bef_addr ?>">
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex-container">
        <div class="flex-item-left">ពេលវេលា​ចាកចេញ៖</div>
        <div class="flex-item-right div-input-row">
            <?PHP
                //$t = strtotime("-15 year", time());
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            ភ្លេច៖ <input type="checkbox" name="is_forget" id="is_forget" value="1" style="width:30px;"> 
            <?PHP
                $d = gmstrftime ("%Y-%m-%d", time ()+25200);
            ?>
            <input type="date" name="txt_bef_date_left" id="txt_bef_date_left" value="<?= $txt_bef_date_left?>" min="1900-01-01" max="<?= $d ?>">
            <script>
                $(document).ready(function(e){
                    $('#is_forget').change(function(){
                        if($(this).is(':checked')){
                            $("#txt_bef_date_left").attr("disabled","disabled");
                        }else{
                            $("#txt_bef_date_left").removeAttr("disabled");
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អ្នកជ្រើសរើសឬអ្នកនាំ៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_agent = 0;
                if(!empty($txt_bef_agent_info)){
                    $has_agent = 2;
                }else{
                    $has_agent = 1;
                }
            ?>
            មិនមាន<input type="radio" name="has_agent" id="no_agent" value="1" style="width:30px;" <?= _checked(1,$has_agent) ?>> 
            បាទ/ចាស<input type="radio" name="has_agent" id="has_agent" value="2" style="width:30px;"  <?= _checked(2,$has_agent) ?>> (សូមបញ្ជាក់សកម្មភាព)
            <input type="text" name="txt_bef_agent_info" id="txt_bef_agent_info" value="<?= $txt_bef_agent_info ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_agent ?>;
                    if(x == 1){
                        $("#txt_bef_agent_info").attr("disabled","disabled");
                        $("#txt_bef_agent").attr("disabled","disabled");
                    }

                    $("#no_agent").click(function(){
                        $("#txt_bef_agent_info").attr("disabled","disabled");
                        $("#txt_bef_agent").attr("disabled","disabled");
                    });

                    $("#has_agent").click(function(){
                        $("#txt_bef_agent_info").removeAttr("disabled");
                        $("#txt_bef_agent").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អំពីអ្នកជ្រើសរើសឬអ្នកនាំ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_bef_agent" id="txt_bef_agent" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_bef_agent).'>'.$r['agn_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_bef_agent").change(function(){
                        if($(this).val() == "add"){
                            window.open('settings/fmagencies.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អំពី​ការងារ​ដែល​អ្នក​ជ្រើស​រើស​ឬ​អ្នក​នាំ​នោះ​បាន​សន្យា៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_bef_job_promissed" id="txt_bef_job_promissed" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_occupations` WHERE(`occ_category`='2')";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['occ_id'].'" '._selected($r['occ_id'],$txt_bef_agent).'>'.$r['occ_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_bef_job_promissed").change(function(){
                        if($(this).val() == "add"){
                            window.open('settings/fmoccupations.php?fmCommand=add&txt_category=2','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ប្រាក់​ខែ​ដែល​អ្នក​ជ្រើស​រើស​​ឬ​អ្នក​នាំ​​បាន​សន្យា៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $wage_promissed = 0;
                if(!empty($txt_bef_wage_promissed)){
                    $wage_promissed = 2;
                }else{
                    $wage_promissed = 1;
                }
            ?>
            មិនមាន<input type="radio" name="wage_promissed" id="no_wage_promissed" value="1" style="width:30px;" <?= _checked(1,$wage_promissed) ?>> 
            បាទ/ចាស<input type="radio" name="wage_promissed" id="has_wage_promissed" value="2" style="width:30px;"  <?= _checked(2,$wage_promissed) ?>> (សូមបញ្ជាក់ខាងក្រោម)<br />
            ចំនួន៖ <input type="number" name="txt_bef_wage_promissed" id="txt_bef_wage_promissed" value="<?= $txt_bef_wage_promissed ?>" style="width:30%" min="0.00" step="0.01">
            <select name="txt_bef_wage_currency" id="txt_bef_wage_currency" style="width:30%">
                <option value = "">ប្រភេទរូបិយប័ណ្ណ</option>
                <?php
                    $q = "SELECT * FROM `tb_countries` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_bef_wage_currency).'>'.$r['cn_currency_kh'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select><br />
            ប្រចាំថ្ងៃ<input type="radio" name="txt_bef_wage_period" id="wage_daily" value="1" <?= _checked(1,$wage_period) ?> style="width:30px;"> 
            ប្រចាំសប្តាហ៍<input type="radio" name="txt_bef_wage_period" id="wage_weekly" value="2" <?= _checked(2,$wage_period) ?> style="width:30px;"> 
            ប្រចាំខែ<input type="radio" name="txt_bef_wage_period" id="wage_monthly" value="3" <?= _checked(3,$wage_period) ?> style="width:30px;"> 
            ប្រចាំឆ្នាំ<input type="radio" name="txt_bef_wage_period" id="wage_yearly" value="4" <?= _checked(4,$wage_period) ?> style="width:30px;"><br />
            ផ្សេងៗ<input type="radio" name="wage_other" id="wage_other" value="5" <?= _checked(5,$wage_period) ?> style="width:30px;">(សូមបញ្ជាក់)<br />
            <input type="text" name="txt_bef_wage_period" id="txt_bef_wage_period" value="<?= $txt_bef_wage_period ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $wage_promissed ?>;
                    if(x == 1){
                        $("#txt_bef_wage_promissed").attr("disabled","disabled");
                        $("#txt_bef_wage_currency").attr("disabled","disabled");
                        $("#wage_daily").attr("disabled","disabled");
                        $("#wage_weekly").attr("disabled","disabled");
                        $("#wage_monthly").attr("disabled","disabled");
                        $("#wage_yearly").attr("disabled","disabled");
                        $("#wage_other").attr("disabled","disabled");
                        $("txt_bef_wage_period").attr("disabled","disabled");
                    }

                    var y = <?= $wage_period ?>
                    if(y == 5){
                        $("txt_bef_wage_period").removeAttr("disabled");
                    }
                    
                    $("#txt_bef_wage_currency").change(function(){
                        if($(this).val() == "add"){
                            window.open('settings/fmcurrencies.php?fmCommand=add','_blank');
                        }
                    });

                    //Wage
                    //Cost and currency
                    $("#no_wage_promissed").click(function(){
                        $("#txt_bef_wage_promissed").attr("disabled","disabled");
                        $("#txt_bef_wage_currency").attr("disabled","disabled");
                        $("#wage_daily").attr("disabled","disabled");
                        $("#wage_weekly").attr("disabled","disabled");
                        $("#wage_monthly").attr("disabled","disabled");
                        $("#wage_yearly").attr("disabled","disabled");
                        $("#wage_other").attr("disabled","disabled");
                        $("txt_bef_wage_period").attr("disabled","disabled");
                    });

                    $("#has_wage_promissed").click(function(){
                        $("#txt_bef_wage_promissed").removeAttr("disabled");
                        $("#txt_bef_wage_currency").removeAttr("disabled");
                        $("#wage_daily").removeAttr("disabled");
                        $("#wage_weekly").removeAttr("disabled");
                        $("#wage_monthly").removeAttr("disabled");
                        $("#wage_yearly").removeAttr("disabled");
                        $("#wage_other").removeAttr("disabled");
                        $("txt_bef_wage_period").removeAttr("disabled");
                    });

                    //Period
                    //disable by default
                    $("#txt_bef_wage_period").attr("disabled","disabled");

                    $("#wage_daily,#wage_weekly,#wage_monthly,#wage_yearly").click(function(){
                        $("#txt_bef_wage_period").attr("disabled","disabled");
                    });

                    $("#wage_other").click(function(){
                        $("#txt_bef_wage_period").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ការសន្យាផ្សេងទៀត ដោយអ្នកជ្រើសរើសឬអ្នកនាំ៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $other_promissed = 0;
                if(!empty($txt_bef_other_promissed)){
                    $other_promissed = 2;
                }else{
                    $other_promissed = 1;
                }
            ?>
            មិនមាន<input type="radio" name="other_promissed" id="no_other_promissed" value="1" style="width:30px;" <?= _checked(1,$other_promissed) ?>> 
            បាទ/ចាស<input type="radio" name="other_promissed" id="has_other_promissed" value="2" style="width:30px;" <?= _checked(2,$other_promissed) ?>> (សូមបញ្ជាក់​ដោយសង្ខេប)
            <input type="text" name="txt_bef_other_promissed" id="txt_bef_other_promissed" value="<?= $txt_bef_other_promissed ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $other_promissed ?>;
                    if(x == 1){
                        $("#txt_bef_other_promissed").attr("disabled","disabled");
                    }

                    $("#no_other_promissed").click(function(){
                        $("#txt_bef_other_promissed").attr("disabled","disabled");
                    });

                    $("#has_other_promissed").click(function(){
                        $("#txt_bef_other_promissed").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">បានប្រាប់អំពី​ការ​កាត់​ប្រាក់​ឈ្នួល​ឬ​កម្រៃ​ជើងសារ ដោយអ្នកជ្រើសរើសឬអ្នកនាំ៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $commission = 0;
                if(!empty($txt_bef_job_service_cost)){
                    $commission = 2;
                }else{
                    $commission = 1;
                }
            ?>
            មិនមាន<input type="radio" name="commission" id="no_commission" value="1" style="width:30px;" <?= _checked(1,$commission) ?>> 
            បាទ/ចាស<input type="radio" name="commission" id="has_commission" value="2" style="width:30px;" <?= _checked(2,$commission) ?>> (សូមបញ្ជាក់ខាងក្រោម)<br />
            ចំនួន៖ <input type="number" name="txt_bef_job_service_cost" id="txt_bef_job_service_cost" value="<?= $txt_bef_job_service_cost ?>" style="width:30%" min="0.00" step="0.01">
            <select name="txt_bef_job_service_currency" id="txt_bef_job_service_currency" style="width:30%">
                <option value = "">ប្រភេទរូបិយប័ណ្ណ</option>
                <?php
                    $q = "SELECT * FROM `tb_countries` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_bef_job_service_currency).'>'.$r['cn_currency_kh'].'</option>';
                    }
                ?>
            </select>
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $commission ?>;
                    if(x == 1){
                        $("#txt_bef_job_service_cost").attr("disabled","disabled");
                        $("#txt_bef_job_service_currency").attr("disabled","disabled");
                        $("#txt_bef_job_service_receiver").attr("disabled","disabled");
                        $("#txt_bef_job_service_purpose").attr("disabled","disabled");
                    }

                    $("#no_commission").click(function(){
                        $("#txt_bef_job_service_cost").attr("disabled","disabled");
                        $("#txt_bef_job_service_currency").attr("disabled","disabled");
                        $("#txt_bef_job_service_receiver").attr("disabled","disabled");
                        $("#txt_bef_job_service_purpose").attr("disabled","disabled");
                    });

                    $("#has_commission").click(function(){
                        $("#txt_bef_job_service_cost").removeAttr("disabled");
                        $("#txt_bef_job_service_currency").removeAttr("disabled");
                        $("#txt_bef_job_service_receiver").removeAttr("disabled");
                        $("#txt_bef_job_service_purpose").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អំពី​ការ​កាត់​ប្រាក់​ឈ្នួល​ឬ​កម្រៃ​ជើងសារ៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left">កាត់ទៅឲ្យ៖</div>
                <div class="flex-item-right">
                    <select name="txt_bef_job_service_receiver" id="txt_bef_job_service_receiver">
                        <option value = "">សូមជ្រើសរើស</option>
                        <?php
                            $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                            if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                            while($r = $rs->fetch_assoc()){
                                echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_bef_job_service_receiver).'>'.$r['agn_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left">ដើម្បី៖</div>
                <div class="flex-item-right">
                    <select name="txt_bef_job_service_purpose" id="txt_bef_job_service_purpose">
                        <option value = "">សូមជ្រើសរើស</option>
                        <?php
                            $q = "SELECT * FROM `tb_purposes` WHERE(`prp_type`='2')";
                            if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                            while($r = $rs->fetch_assoc()){
                                echo '<option value="'.$r['prp_id'].'" '._selected($r['prp_id'],$txt_bef_job_service_purpose).'>'.$r['prp_desc'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ការតម្រូវ​ឲ្យបង់ប្រាក់​ជាមុន៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $deposit = 0;
                if(!empty($txt_bef_job_deposit)){
                    $deposit = 2;
                }else{
                    $deposit = 1;
                }
            ?>
            គ្មានទេ<input type="radio" name="deposit" id="no_deposit" value="1" style="width:30px;" <?= _checked(1,$deposit) ?>> 
            បាទ/ចាស<input type="radio" name="deposit" id="has_deposit" value="2" style="width:30px;" <?= _checked(2,$deposit) ?>> (សូមបញ្ជាក់ខាងក្រោម)<br />
            ចំនួន៖ <input type="number" name="txt_bef_job_deposit" id="txt_bef_job_deposit" value="<?= $txt_bef_job_service_cost ?>" style="width:30%" min="0.00" step="0.01">
            <select name="txt_bef_job_deposit_currency" id="txt_bef_job_deposit_currency" style="width:30%">
                <option value = "">ប្រភេទរូបិយប័ណ្ណ</option>
                <?php
                    $q = "SELECT * FROM `tb_countries` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_bef_job_deposit_currency).'>'.$r['cn_currency_kh'].'</option>';
                    }
                ?>
            </select>
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $deposit ?>;
                    if(x == 1){
                        $("#txt_bef_job_deposit").attr("disabled","disabled");
                        $("#txt_bef_job_deposit_currency").attr("disabled","disabled");
                        $("#txt_bef_job_deposit_receiver").attr("disabled","disabled");
                        $("#txt_bef_job_deposit_purpose").attr("disabled","disabled");
                    }

                    $("#no_deposit").click(function(){
                        $("#txt_bef_job_deposit").attr("disabled","disabled");
                        $("#txt_bef_job_deposit_currency").attr("disabled","disabled");
                        $("#txt_bef_job_deposit_receiver").attr("disabled","disabled");
                        $("#txt_bef_job_deposit_purpose").attr("disabled","disabled");
                    });

                    $("#has_deposit").click(function(){
                        $("#txt_bef_job_deposit").removeAttr("disabled");
                        $("#txt_bef_job_deposit_currency").removeAttr("disabled");
                        $("#txt_bef_job_deposit_receiver").removeAttr("disabled");
                        $("#txt_bef_job_deposit_purpose").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អំពី​ការ​បង់ប្រាក់​ជាមុន៖</div>
        <div class="flex-item-right">
            <div class="flex-container div-input-row">
                <div class="flex-item-left">បង់ទៅឲ្យ៖</div>
                <div class="flex-item-right">
                    <select name="txt_bef_job_deposit_receiver" id="txt_bef_job_deposit_receiver">
                        <option value = "">សូមជ្រើសរើស</option>
                        <?php
                            $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                            if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                            while($r = $rs->fetch_assoc()){
                                echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_bef_job_deposit_receiver).'>'.$r['agn_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="flex-container div-input-row">
                <div class="flex-item-left">ដើម្បី៖</div>
                <div class="flex-item-right">
                    <select name="txt_bef_job_deposit_purpose" id="txt_bef_job_deposit_purpose">
                        <option value = "">សូមជ្រើសរើស</option>
                        <?php
                            $q = "SELECT * FROM `tb_purposes` WHERE(`prp_type`='2')";
                            if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                            while($r = $rs->fetch_assoc()){
                                echo '<option value="'.$r['prp_id'].'" '._selected($r['prp_id'],$txt_bef_job_deposit_purpose).'>'.$r['prp_desc'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Command -->
    <div style="text-align:center">
        <input type="hidden" name="fmCommand" value="<?= $_REQUEST['fmCommand'] ?>">
        <input type="hidden" name="fmSubmit" value="" id="fmSubmit">
        <input type="hidden" name="load_child_form" value="f0201">
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
                var bef_addr = $("#txt_bef_addr").val();
                var bef_addr_cn = $("#txt_bef_addr_cn").val();
                var bef_date_left = $("#txt_bef_date_left").val();

                if(bef_addr == '' ){
                    i++;
                    $("#txt_bef_addr").focus();
                    $("#txt_bef_addr").css('border','1px solic red');
                }else{
                    $("#txt_bef_addr").css('border','1px solic #cccccc');
                }

                if(bef_addr_cn == '' ){
                    i++;
                    $("#txt_bef_addr_cn").focus();
                    $("#txt_bef_addr_cn").css('border','1px solic red');
                }else{
                    $("#txt_bef_addr_cn").css('border','1px solic #cccccc');
                }

                if(bef_date_left == '' ){
                    i++;
                    $("#txt_bef_date_left").focus();
                    $("#txt_bef_date_left").css('border','1px solic red');
                }else{
                    $("#txt_bef_date_left").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_0201").submit();
                }
            });

            $("#bt_next").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f0202&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_prev").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f0101&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_close").click(function(){
                window.close();
            });

            <?= $script ?>
        });
    </script>
</form>