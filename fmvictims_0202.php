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
                $q = "SELECT * FROM `tb_cases_0202` WHERE (`cas_case_number`='".$_REQUEST['n']."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }
            
            $txt_case_number = isset($_REQUEST['n']) ? $_REQUEST['n'] : @$r['cas_case_number'];
            $txt_trv_method = isset($_REQUEST['txt_trv_method']) ? $_REQUEST['txt_trv_method'] : @$r['cas_trv_method'];
            $txt_trv_participant = isset($_REQUEST['txt_trv_participant']) ? $_REQUEST['txt_trv_participant'] : @$r['cas_trv_participant'];
            $txt_trv_participant_info = isset($_REQUEST['txt_trv_participant_info']) ? $_REQUEST['txt_trv_participant_info'] : @$r['cas_trv_participant_info'];
            $txt_trv_sponsor = isset($_REQUEST['txt_trv_sponsor']) ? $_REQUEST['txt_trv_sponsor'] : @$r['cas_trv_sponsor'];
            $txt_trv_sponsor_info = isset($_REQUEST['txt_trv_sponsor_info']) ? $_REQUEST['txt_trv_sponsor_info'] : @$r['cas_trv_sponsor_info'];
            $txt_trv_cost = isset($_REQUEST['txt_trv_cost']) ? $_REQUEST['txt_trv_cost'] : @$r['cas_trv_cost'];
            $txt_trv_currency = isset($_REQUEST['txt_trv_currency']) ? $_REQUEST['txt_trv_currency'] : @$r['cas_trv_currency'];
            $txt_trv_cost_info = isset($_REQUEST['txt_trv_cost_info']) ? $_REQUEST['txt_trv_cost_info'] : @$r['cas_trv_cost_info'];
            $txt_trv_intimidation = isset($_REQUEST['txt_trv_intimidation']) ? $_REQUEST['txt_trv_intimidation'] : @$r['cas_trv_intimidation'];
            $txt_trv_accom = isset($_REQUEST['txt_trv_accom']) ? $_REQUEST['txt_trv_accom'] : @$r['cas_trv_accom'];
            $txt_trv_accom_info = isset($_REQUEST['txt_trv_accom_info']) ? $_REQUEST['txt_trv_accom_info'] : @$r['cas_trv_accom_info'];
            $txt_trv_accom_other = isset($_REQUEST['txt_trv_accom_other']) ? $_REQUEST['txt_trv_accom_other'] : @$r['cas_trv_accom_other'];
            
            $bt_command = bt_edit_label;
            $fm_title = txt_edit_referer;
        }elseif($_REQUEST['fmCommand'] == 'delete'){
            if(isset($_REQUEST['id'])){
                $q = "SELECT * FROM `tb_cases_0202` WHERE (`cas_case_number`='".decode128($_REQUEST['id'])."')";
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

        if(isset($_REQUEST['has_participant']) and $_REQUEST['has_participant']==1){
            $txt_trv_participant = '';
            $txt_trv_participant_info = '';
        }

        if(isset($_REQUEST['has_sponsor']) and $_REQUEST['has_sponsor']==1){
            $txt_trv_sponsor = '';
            $txt_trv_sponsor_info = '';
        }

        if(isset($_REQUEST['has_intimidation']) and $_REQUEST['has_intimidation']==1){
            $txt_trv_intimidation = '';

        }

        if(isset($_REQUEST['has_accom']) and $_REQUEST['has_accom']==1){
            $txt_trv_accom = '';
            $txt_trv_accom_info = '';
            $txt_trv_accom_other = '';
        }

        //Update form 0201
        $q0202 = "UPDATE `tb_cases_0202` SET `cas_trv_method` = '".$txt_trv_method."'
                                            ,`cas_trv_participant` = '".$txt_trv_participant."'
                                            ,`cas_trv_participant_info` = '".$txt_trv_participant_info."'
                                            ,`cas_trv_sponsor` = '".$txt_trv_sponsor."'
                                            ,`cas_trv_sponsor_info` = '".$txt_trv_sponsor_info."'
                                            ,`cas_trv_cost` = '".$txt_trv_cost."'
                                            ,`cas_trv_currency` = '".$txt_trv_currency."'
                                            ,`cas_trv_cost_info` = '".$txt_trv_cost_info."'
                                            ,`cas_trv_intimidation` = '".$txt_trv_intimidation."'
                                            ,`cas_trv_accom` = '".$txt_trv_accom."'
                                            ,`cas_trv_accom_info` = '".$txt_trv_accom_info."'
                                            ,`cas_trv_accom_other` = '".$txt_trv_accom_other."'
                                            ,`last_modify_by` = '".$_SESSION['user_id']."'
                                            ,`date_modify` = '".$date."' 
                        WHERE(`cas_case_number`='".$txt_case_number."')";
        if(!$vtmdb->query($q0202)){ die("Error insert into case 0202!".$vtmdb->error); }else{ $success += 1; }

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
        $("#t5").addClass("t1-active");
    });
</script>

<form name="fm_case_0202" id="fm_case_0202" action="">
    <h1 style="text-align:center;">ផ្នែកទី២</h1>
    <h1 style="text-align:center;">ដំណាក់កាលដឹក​ជញ្ជូន</h1>
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><label><?= $txt_case_number ?></label></div>
    </div>
        
    <!-- Address befor issue occured -->
    <div class="flex-container">
        <div class="flex-item-left">មធ្យោបាយធ្វើដំណើរ​ចេញពី​កន្លែងរស់នៅ៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_trv_method" id="txt_trv_method" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_methods` WHERE(`mth_category`='1')";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading method's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['mth_id'].'" '._selected($r['mth_id'],$txt_trv_method).'>'.$r['mth_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>
            <script>
                $(document).ready(function(e){
                    $("#txt_trv_method").change(function(){
                        if($(this).val() == "add"){
                            window.open('settings/fmmethods.php?fmCommand=add','_blank');
                        }
                    });
                });
            </script>
        </div>
    </div>
    
    <div class="flex-container">
        <div class="flex-item-left">អ្នករួមដំណើរជាមួយ៖</div>
        <div class="flex-item-right div-input-row">
        <?php
                $has_partner = 0;
                if(!empty($txt_trv_participant)){
                    $has_partner = 2;
                }else{
                    $has_partner = 1;
                }
            ?>
            តែម្នាក់ឯង<input type="radio" name="has_partner" id="no_partner" value="1" style="width:30px;" <?= _checked(1,$has_partner) ?>> 
            មានគ្នា<input type="radio" name="has_partner" id="has_partner" value="2" style="width:30px;"  <?= _checked(2,$has_partner) ?>> (សូមបញ្ជាក់)
            <select name="txt_trv_participant" id="txt_trv_participant" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading method's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_trv_participant).'>'.$r['agn_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>
            សូមបញ្ជាក់អំពីឈ្មោះ ភេទ និងសញ្ជាតិ៖ <br />
                <input type="text" name="txt_trv_participant_info" id="txt_trv_participant_info" value="<?= $txt_trv_participant_info ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_partner ?>;
                    if(x == 1){
                        $("#txt_trv_participant_info").attr("disabled","disabled");
                        $("#txt_trv_participant").attr("disabled","disabled");
                    }

                    $("#no_partner").click(function(){
                        $("#txt_trv_participant_info").attr("disabled","disabled");
                        $("#txt_trv_participant").attr("disabled","disabled");
                    });

                    $("#has_partner").click(function(){
                        $("#txt_trv_participant_info").removeAttr("disabled");
                        $("#txt_trv_participant").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អ្នកចំណាយលើថ្លៃធ្វើដំណើរ៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_sponsor = 0;
                if(!empty($txt_trv_sponsor)){
                    $has_sponsor = 2;
                }else{
                    $has_sponsor = 1;
                }
            ?>
            ខ្លួនឯង<input type="radio" name="has_sponsor" id="no_sponsor" value="1" style="width:30px;" <?= _checked(1,$has_sponsor) ?>> 
            គេជាអ្នកចំណាយ<input type="radio" name="has_sponsor" id="has_sponsor" value="2" style="width:30px;"  <?= _checked(2,$has_sponsor) ?>> (សូមបញ្ជាក់)
            <select name="txt_trv_sponsor" id="txt_trv_sponsor" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading method's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_trv_sponsor).'>'.$r['agn_name'].'</option>';
                    }
                ?>
            </select>
            សូមបញ្ជាក់អំពីឈ្មោះ ភេទ និងសញ្ជាតិ៖ <br />
                <input type="text" name="txt_trv_sponsor_info" id="txt_trv_sponsor_info" value="<?= $txt_trv_sponsor_info ?>"> <br />
            ចំនួនទឹកប្រាក់៖ <input type="number" name="txt_trv_cost" id="txt_trv_cost" value="<?= $txt_trv_cost ?>" style="width:30%" min="0.00" step="0.01">
            <select name="txt_trv_currency" id="txt_trv_currency" style="width:30%">
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_countries` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading currency's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_trv_currency).'>'.$r['cn_currency_kh'].'</option>';
                    }
                ?>
            </select> <br />
            សូមលម្អិតបន្ថែមករណីបង់ថ្លៃធ្វើដំណើរ​ជាដំណាក់ៗ៖ <br />
                <input type="text" name="txt_trv_cost_info" id="txt_trv_cost_info" value="<?= $txt_trv_cost_info ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_sponsor ?>;
                    if(x == 1){
                        $("#txt_trv_sponsor_info").attr("disabled","disabled");
                        $("#txt_trv_sponsor").attr("disabled","disabled");
                    }

                    $("#no_sponsor").click(function(){
                        $("#txt_trv_sponsor_info").attr("disabled","disabled");
                        $("#txt_trv_sponsor").attr("disabled","disabled");
                    });

                    $("#has_sponsor").click(function(){
                        $("#txt_trv_sponsor_info").removeAttr("disabled");
                        $("#txt_trv_sponsor").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ការគម្រាមកំហែងក្នុងពេលធ្វើដំណើរ៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_intimidation = 0;
                if(!empty($txt_trv_intimidation)){
                    $has_intimidation = 2;
                }else{
                    $has_intimidation = 1;
                }
            ?>

            គ្មានទេ<input type="radio" name="has_intimidation" id="no_intimidation" value="1" style="width:30px;" <?= _checked(1,$has_intimidation) ?>> 
            បាទ/ចាស៎ មាន<input type="radio" name="has_intimidation" id="has_intimidation" value="2" style="width:30px;"  <?= _checked(2,$has_intimidation) ?>> (សូមបញ្ជាក់)
            <input type="text" name="txt_trv_intimidation" id="txt_trv_intimidation" value="<?= $txt_trv_intimidation ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_intimidation ?>;
                    if(x == 1){
                        $("#txt_trv_intimidation").attr("disabled","disabled");
                    }

                    $("#no_intimidation").click(function(){
                        $("#txt_trv_intimidation").attr("disabled","disabled");
                    });

                    $("#has_intimidation").click(function(){
                        $("#txt_trv_intimidation").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">លក្ខណៈនៃការស្នាក់នៅក្នុងអំឡុងពេលធ្វើដំណើរ៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_accom = 0;
                if(!empty($txt_trv_accom)){
                    $has_accom = 2;
                }else{
                    $has_accom = 1;
                }
            ?>

            គ្មានទេ<input type="radio" name="has_accom" id="no_accom" value="1" style="width:30px;" <?= _checked(1,$has_accom) ?>> 
            បាទ/ចាស៎ មាន<input type="radio" name="has_accom" id="has_accom" value="2" style="width:30px;"  <?= _checked(2,$has_accom) ?>> (សូមបញ្ជាក់)
            ទីកន្លែងស្នាក់នៅ៖
            <input type="text" name="txt_trv_accom_info" id="txt_trv_accom_info" value="<?= $txt_trv_accom_info ?>">
            លក្ខណៈនៃការស្នាក់នៅ៖ <br />
            <input type="radio" name="txt_trv_accom" id="accom_situation1" value="1" <?= _checked(1,$txt_trv_accom) ?>> ឃុំឃាំង <br />
            <input type="radio" name="txt_trv_accom" id="accom_situation2" value="2" <?= _checked(2,$txt_trv_accom) ?>> បំបិទសិទ្ធិ​សេរីភាព​ពេលធ្វើដំណើរ <br />
            <input type="radio" name="txt_trv_accom" id="accom_situation3" value="3" <?= _checked(3,$txt_trv_accom) ?>> មានសេរីភាពពេញបរិបូណ៌ក្នុងការ​ធ្វើដំណើរ <br />
            <input type="radio" name="txt_trv_accom" id="accom_situation4" value="4" <?= _checked(4,$txt_trv_accom) ?>> មានម្ហូបអាហារគ្រប់គ្រាន់និងលក្ខណខណ្ឌស្នាក់នៅ​សមរម្យ <br />
            <input type="radio" name="txt_trv_accom" id="accom_situation5" value="5" <?= _checked(5,$txt_trv_accom) ?>> ផ្សេងៗ <input type="text" name="txt_trv_accom_other" id="txt_trv_accom_other" value="<?= $txt_trv_accom_other ?>" style="width:80%;">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    $("#accom_situation1").attr("disabled","disabled");
                    $("#accom_situation2").attr("disabled","disabled");
                    $("#accom_situation3").attr("disabled","disabled");
                    $("#accom_situation4").attr("disabled","disabled");
                    $("#accom_situation5").attr("disabled","disabled");
                    $("#txt_trv_accom_other").attr("disabled","disabled");
                    $("#txt_trv_accom_info").attr("disabled","disabled");

                    $("#accom_situation1").click(function(){
                        $("#txt_trv_accom_other").attr("disabled","disabled");
                    });
                    $("#accom_situation2").click(function(){
                        $("#txt_trv_accom_other").attr("disabled","disabled");
                    });
                    $("#accom_situation3").click(function(){
                        $("#txt_trv_accom_other").attr("disabled","disabled");
                    });
                    $("#accom_situation4").click(function(){
                        $("#txt_trv_accom_other").attr("disabled","disabled");
                    });
                    $("#accom_situation5").click(function(){
                        $("#txt_trv_accom_other").removeAttr("disabled");
                        $("#txt_trv_accom_other").focus();
                    });

                    $("#txt_trv_accom_other").focus(function(){
                        $("#accom_situation5").attr("checked","checked");
                    });

                    if($("#has_accom").is(':checked')){
                        $("#accom_situation1").removeAttr("disabled");
                        $("#accom_situation2").removeAttr("disabled");
                        $("#accom_situation3").removeAttr("disabled");
                        $("#accom_situation4").removeAttr("disabled");
                        $("#accom_situation5").removeAttr("disabled");
                        $("#txt_trv_accom_info").removeAttr("disabled");
                    }

                    if($("#no_accom").is(':checked')){
                        $("#txt_trv_accom_info").attr("disabled","disabled");
                    }

                    $("#no_accom").click(function(){
                        $("#accom_situation1").attr("disabled","disabled");
                        $("#accom_situation2").attr("disabled","disabled");
                        $("#accom_situation3").attr("disabled","disabled");
                        $("#accom_situation4").attr("disabled","disabled");
                        $("#accom_situation5").attr("disabled","disabled");
                        $("#txt_trv_accom_other").attr("disabled","disabled");
                        $("#txt_trv_accom_info").attr("disabled","disabled");
                    });

                    $("#has_accom").click(function(){
                        $("#accom_situation1").removeAttr("disabled");
                        $("#accom_situation2").removeAttr("disabled");
                        $("#accom_situation3").removeAttr("disabled");
                        $("#accom_situation4").removeAttr("disabled");
                        $("#accom_situation5").removeAttr("disabled");
                        $("#txt_trv_accom_other").removeAttr("disabled");
                        $("#txt_trv_accom_info").removeAttr("disabled");
                    });
                });
            </script>
        </div>
    </div>

    <!-- Command -->
    <div style="text-align:center">
        <input type="hidden" name="fmCommand" value="<?= $_REQUEST['fmCommand'] ?>">
        <input type="hidden" name="fmSubmit" value="" id="fmSubmit">
        <input type="hidden" name="load_child_form" value="f0202">
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
                var bef_addr = $("#txt_trv_addr").val();
                var bef_addr_cn = $("#txt_trv_addr_cn").val();
                var bef_date_left = $("#txt_trv_date_left").val();

                if(bef_addr == '' ){
                    i++;
                    $("#txt_trv_addr").focus();
                    $("#txt_trv_addr").css('border','1px solic red');
                }else{
                    $("#txt_trv_addr").css('border','1px solic #cccccc');
                }

                if(bef_addr_cn == '' ){
                    i++;
                    $("#txt_trv_addr_cn").focus();
                    $("#txt_trv_addr_cn").css('border','1px solic red');
                }else{
                    $("#txt_trv_addr_cn").css('border','1px solic #cccccc');
                }

                if(bef_date_left == '' ){
                    i++;
                    $("#txt_trv_date_left").focus();
                    $("#txt_trv_date_left").css('border','1px solic red');
                }else{
                    $("#txt_trv_date_left").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_0202").submit();
                }
            });

            $("#bt_next").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f0203&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_prev").click(function(){
                window.open("fmvictims.php?fmCommand=edit&load_child_form=f0201&n=<?= $txt_case_number ?>","_self");
            });

            $("#bt_close").click(function(){
                window.close();
            });

            <?= $script ?>
        });
    </script>
</form>