<?PHP
//Call function
include("inc/fnSelect.php");
include("inc/fnCheck.php");
include("inc/fnGetProvince.php");

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
                $q = "SELECT * FROM `tb_cases_0301` WHERE (`cas_case_number`='".$_REQUEST['n']."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }
            
            $txt_case_number = isset($_REQUEST['n']) ? $_REQUEST['n'] : @$r['cas_case_number'];
            $txt_tac_country = isset($_REQUEST['txt_tac_country']) ? $_REQUEST['txt_tac_country'] : @$r['cas_tac_country'];
            $txt_tac_address = isset($_REQUEST['txt_tac_address']) ? $_REQUEST['txt_tac_address'] : @$r['cas_tac_address'];
            $txt_tac_duration = isset($_REQUEST['txt_tac_duration']) ? $_REQUEST['txt_tac_duration'] : @$r['cas_tac_duration'];
            $txt_tac_location = isset($_REQUEST['txt_tac_location']) ? $_REQUEST['txt_tac_location'] : @$r['cas_tac_location'];
            $txt_tac_location_addr = isset($_REQUEST['txt_tac_location_addr']) ? $_REQUEST['txt_tac_location_addr'] : @$r['cas_tac_location_addr'];
            $txt_tac_cost = isset($_REQUEST['txt_tac_cost']) ? $_REQUEST['txt_tac_cost'] : @$r['cas_tac_cost'];
            $txt_tac_currency = isset($_REQUEST['txt_tac_currency']) ? $_REQUEST['txt_tac_currency'] : @$r['cas_tac_currency'];
            $txt_tac_status = isset($_REQUEST['txt_tac_status']) ? $_REQUEST['txt_tac_status'] : @$r['cas_tac_status'];
            
            $bt_command = bt_edit_label;
            $fm_title = txt_edit_referer;
        }elseif($_REQUEST['fmCommand'] == 'delete'){
            if(isset($_REQUEST['id'])){
                $q = "SELECT * FROM `tb_cases_0301` WHERE (`cas_case_number`='".decode128($_REQUEST['id'])."')";
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

        if(isset($_REQUEST['has_transit']) and $_REQUEST['has_transit']==1){
            $txt_tac_address = '';
            $txt_trn_time = '';
        }

        if(isset($_REQUEST['has_agent']) and $_REQUEST['has_agent']==1){
            $txt_tac_duration = '';
            $txt_tac_location = '';
            $txt_tac_location_addr = '';
            $txt_tac_location_connection = '';
        }

        if(isset($_REQUEST['has_sponsor']) and $_REQUEST['has_sponsor']==1){
            $txt_tac_status = '';
            $txt_tac_status_info = '';

        }

        //Update form 0201
        $q0202 = "UPDATE `tb_cases_0301` SET `cas_tac_country` = '".$txt_tac_country."'
                                            ,`cas_tac_address` = '".$txt_tac_address."'
                                            ,`cas_tac_duration` = '".$txt_tac_duration."'
                                            ,`cas_tac_location` = '".$txt_tac_location."'
                                            ,`cas_tac_location_addr` = '".$txt_tac_location_addr."'
                                            ,`cas_tac_cost` = '".$txt_tac_cost."'
                                            ,`cas_tac_currency` = '".$txt_tac_currency."'
                                            ,`cas_tac_location_connection` = '".$txt_tac_location_connection."'
                                            ,`cas_tac_status` = '".$txt_tac_status."'
                                            ,`last_modify_by` = '".$_SESSION['user_id']."'
                                            ,`date_modify` = '".$date."' 
                        WHERE(`cas_case_number`='".$txt_case_number."')";
        if(!$vtmdb->query($q0202)){ die("Error insert into case 0301!".$vtmdb->error); }else{ $success += 1; }

        if($success > 0){
            //echo '<script>alert ("Successfuly save!")</script>';
        }
    }else{
        
    }
?>

<?PHP include("inc/tab_menu.php"); ?>
<script>
    //To modify current tab menu number
    $(document).ready(function(e){
        $("#t7").addClass("t1-active");
    });
</script>

<form name="fm_case_0301" id="fm_case_0301" action="">
    <h1 style="text-align:center;">ផ្នែកទី២</h1>
    <h1 style="text-align:center;">ដំណាក់កាលសំចត(ក្នុង និងក្រៅប្រទេស)</h1>
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><label><?= $txt_case_number ?></label></div>
    </div>
    
    <div class="flex-container">
        <div class="flex-item-left">ប្រទេសឬកន្លែងសំចត៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_transit = 0;
                if(!empty($txt_tac_country)){
                    $has_transit = 2;
                }else{
                    $has_transit = 1;
                }
            ?>

            គ្មានទេ<input type="radio" name="has_transit" id="no_transit" value="1" style="width:30px;" <?= _checked(1,$has_transit) ?>> 
            បាទ/ចាស៎ មាន<input type="radio" name="has_transit" id="has_transit" value="2" style="width:30px;"  <?= _checked(2,$has_transit) ?>> (សូមបញ្ជាក់)<br />
            ប្រទេស៖ <select name="txt_tac_country" id="txt_tac_country"  style="width:70%;">
                        <option value="">សូមជ្រើសរើស</option>
                        <?php
                            $q = "SELECT * FROM `tb_countries` WHERE(1)";
                            if(!$rs = $vtmdb->query($q)){ die ("Error loading country!"); }  
                            while($r = $rs->fetch_assoc()){
                                echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_tac_country).'>'.$r['cn_name_kh'].'('.$r['cn_acronym'].')</option>';
                            }
                        ?>
                    </select><br />
            អាសយដ្ឋានលំអិត៖ <input type="text" name="txt_tac_address" id="txt_tac_address" value="<?= $txt_tac_address ?>">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">រយៈពេលស្នាក់នៅប្រទេសឬកន្លែងសំចត៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_tac_duration" placeholder="ឧ.​ ២ឆ្នាំ ៦ខែ">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ទីតាំងស្នាក់នៅ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_tac_country" id="txt_tac_country"  style="width:70%;">
                <option value="">សូមជ្រើសរើស</option>
            <?php
                $q = "SELECT * FROM `tb_countries` WHERE(1)";
                if(!$rs = $vtmdb->query($q)){ die ("Error loading country!"); }  
                while($r = $rs->fetch_assoc()){
                    echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_tac_country).'>'.$r['cn_name_kh'].'('.$r['cn_acronym'].')</option>';
                }
            ?>
                </select>
            <input type="radio" name="has_agent" id="no_agent" value="1" style="width:30px;" <?= _checked(1,$has_agent) ?>> 
            បាទ/ចាស<input type="radio" name="has_agent" id="has_agent" value="2" style="width:30px;"  <?= _checked(2,$has_agent) ?>>
            <select name="txt_tac_location" id="txt_tac_location" style="width:70%">
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_tac_location).'>'.$r['agn_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>(សូមបញ្ជាក់បន្ថែម) 
            <input type="text" name="txt_tac_location_addr" id="txt_tac_location_addr" value="<?= $txt_tac_location_addr ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_agent ?>;
                    if(x == 1){
                        $("#txt_tac_location_addr").attr("disabled","disabled");
                        $("#txt_tac_location").attr("disabled","disabled");
                    }

                    $("#no_agent").click(function(){
                        $("#txt_tac_location_addr").attr("disabled","disabled");
                        $("#txt_tac_location").attr("disabled","disabled");
                    });

                    $("#has_agent").click(function(){
                        $("#txt_tac_location_addr").removeAttr("disabled");
                        $("#txt_tac_location").removeAttr("disabled");
                    });

                    $("#txt_tac_location").change(function(){
                        if($(this).val() == "add"){
                            window.open('settings/fmagencies.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">មូលហេតុដែលនាំឲ្យអ្នកស្គាល់ឬទំនាក់ទំនងជាមួយអ្នកនាំឆ្លងកាត់ព្រំដែន៖</div>
        <div class="flex-item-right div-input-row">
            <input type="text" name="txt_tac_location_connection" id="txt_tac_location_connection" value="<?= $txt_tac_location_connection ?>" placeholder="(សូមរៀបរាប់ដោយសង្ខេប)">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អ្នកចំណាយលើថ្លៃឆ្លងកាត់ព្រំដែន៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_sponsor = 0;
                if(!empty($txt_tac_status)){
                    $has_sponsor = 2;
                }else{
                    $has_sponsor = 1;
                }
            ?>
            ខ្លួនឯង<input type="radio" name="has_sponsor" id="no_sponsor" value="1" style="width:30px;" <?= _checked(1,$has_sponsor) ?>> 
            គេជាអ្នកចំណាយ<input type="radio" name="has_sponsor" id="has_sponsor" value="2" style="width:30px;"  <?= _checked(2,$has_sponsor) ?>> (សូមបញ្ជាក់)
            <select name="txt_tac_status" id="txt_tac_status" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading method's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_tac_status).'>'.$r['agn_name'].'</option>';
                    }
                ?>
            </select>
            សូមបញ្ជាក់អំពីឈ្មោះ ភេទ និងសញ្ជាតិ៖ <br />
                <input type="text" name="txt_tac_status_info" id="txt_tac_status_info" value="<?= $txt_tac_status_info ?>"> <br />
            ចំនួនទឹកប្រាក់៖ <input type="number" name="txt_tac_cost" id="txt_tac_cost" value="<?= $txt_tac_cost ?>" style="width:30%" min="0.00" step="0.01">
            <select name="txt_tac_currency" id="txt_tac_currency" style="width:30%">
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_countries` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading currency's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_tac_currency).'>'.$r['cn_currency_kh'].'</option>';
                    }
                ?>
            </select>
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_sponsor ?>;
                    if(x == 1){
                        $("#txt_tac_status_info").attr("disabled","disabled");
                        $("#txt_tac_status").attr("disabled","disabled");
                    }

                    $("#no_sponsor").click(function(){
                        $("#txt_tac_status_info").attr("disabled","disabled");
                        $("#txt_tac_status").attr("disabled","disabled");
                    });

                    $("#has_sponsor").click(function(){
                        $("#txt_tac_status_info").removeAttr("disabled");
                        $("#txt_tac_status").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <!-- @@ -->
  

    <!-- Command -->
    <div style="text-align:center">
        <input type="hidden" name="fmCommand" value="<?= $_REQUEST['fmCommand'] ?>">
        <input type="hidden" name="fmSubmit" value="" id="fmSubmit">
        <input type="hidden" name="load_child_form" value="f0301">
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
                var bef_addr = $("#txt_trn_addr").val();
                var bef_addr_cn = $("#txt_trn_addr_cn").val();
                var bef_date_left = $("#txt_tac_address_left").val();

                if(bef_addr == '' ){
                    i++;
                    $("#txt_trn_addr").focus();
                    $("#txt_trn_addr").css('border','1px solic red');
                }else{
                    $("#txt_trn_addr").css('border','1px solic #cccccc');
                }

                if(bef_addr_cn == '' ){
                    i++;
                    $("#txt_trn_addr_cn").focus();
                    $("#txt_trn_addr_cn").css('border','1px solic red');
                }else{
                    $("#txt_trn_addr_cn").css('border','1px solic #cccccc');
                }

                if(bef_date_left == '' ){
                    i++;
                    $("#txt_tac_address_left").focus();
                    $("#txt_tac_address_left").css('border','1px solic red');
                }else{
                    $("#txt_tac_address_left").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_0301").submit();
                }
            });

            $("#bt_next").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f03031&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_prev").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f0202&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_close").click(function(){
                window.close();
            });

            <?= $script ?>
        });
    </script>
</form>