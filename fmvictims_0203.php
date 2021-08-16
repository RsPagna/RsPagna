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
                $q = "SELECT * FROM `tb_cases_0203` WHERE (`cas_case_number`='".$_REQUEST['n']."')";
                if(!$rs = $vtmdb->query($q)){ die('Error: [' . $vtmdb->error . ']');}
                $r = $rs->fetch_assoc();
            }
            
            $txt_case_number = isset($_REQUEST['n']) ? $_REQUEST['n'] : @$r['cas_case_number'];
            $txt_trn_checkpoint = isset($_REQUEST['txt_trn_checkpoint']) ? $_REQUEST['txt_trn_checkpoint'] : @$r['cas_trn_checkpoint'];
            $txt_trn_date = isset($_REQUEST['txt_trn_date']) ? $_REQUEST['txt_trn_date'] : @$r['cas_trn_date'];

            $txt_hour = isset($_REQUEST['txt_hour']) ? $_REQUEST['txt_hour'] : substr(@$r['cas_trn_time'],0,2);
            $txt_minute = isset($_REQUEST['txt_minute']) ? $_REQUEST['txt_minute'] : substr(@$r['cas_trn_time'],3,2);
            $txt_shift = isset($_REQUEST['txt_shift']) ? $_REQUEST['txt_shift'] : substr(@$r['cas_trn_time'],-1,2);
            $txt_trn_time = isset($_REQUEST['txt_trn_time']) ? $_REQUEST['txt_trn_time'] : @$r['cas_trn_time'];
            if(!empty($txt_hour) and !empty($txt_minute)){
                $txt_trn_time = $txt_hour.":".$txt_minute." ".$txt_shift;
            }

            $txt_trn_docs = isset($_REQUEST['txt_trn_docs']) ? $_REQUEST['txt_trn_docs'] : @$r['cas_trn_docs'];
            $txt_trn_informer = isset($_REQUEST['txt_trn_informer']) ? $_REQUEST['txt_trn_informer'] : @$r['cas_trn_informer'];
            $txt_trn_informer_info = isset($_REQUEST['txt_trn_informer_info']) ? $_REQUEST['txt_trn_informer_info'] : @$r['cas_trn_informer_info'];
            $txt_trn_informer_connection = isset($_REQUEST['txt_trn_informer_connection']) ? $_REQUEST['txt_trn_informer_connection'] : @$r['cas_trn_informer_connection'];
            $txt_trn_cost = isset($_REQUEST['txt_trn_cost']) ? $_REQUEST['txt_trn_cost'] : @$r['cas_trn_cost'];
            $txt_trn_currency = isset($_REQUEST['txt_trn_currency']) ? $_REQUEST['txt_trn_currency'] : @$r['cas_trn_currency'];
            $txt_trn_sponsor = isset($_REQUEST['txt_trn_sponsor']) ? $_REQUEST['txt_trn_sponsor'] : @$r['cas_trn_sponsor'];
            $txt_trn_sponsor_info = isset($_REQUEST['txt_trn_sponsor_info']) ? $_REQUEST['txt_trn_sponsor_info'] : @$r['cas_trn_sponsor_info'];
            
            $bt_command = bt_edit_label;
            $fm_title = txt_edit_referer;
        }elseif($_REQUEST['fmCommand'] == 'delete'){
            if(isset($_REQUEST['id'])){
                $q = "SELECT * FROM `tb_cases_0203` WHERE (`cas_case_number`='".decode128($_REQUEST['id'])."')";
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

        if(isset($_REQUEST['has_cross_border']) and $_REQUEST['has_cross_border']==1){
            $txt_trn_date = '';
            $txt_trn_time = '';
        }

        if(isset($_REQUEST['has_agent']) and $_REQUEST['has_agent']==1){
            $txt_trn_docs = '';
            $txt_trn_informer = '';
            $txt_trn_informer_info = '';
            $txt_trn_informer_connection = '';
        }

        if(isset($_REQUEST['has_sponsor']) and $_REQUEST['has_sponsor']==1){
            $txt_trn_sponsor = '';
            $txt_trn_sponsor_info = '';

        }

        //Update form 0201
        $q0202 = "UPDATE `tb_cases_0203` SET `cas_trn_checkpoint` = '".$txt_trn_checkpoint."'
                                            ,`cas_trn_date` = '".$txt_trn_date."'
                                            ,`cas_trn_time` = '".$txt_trn_time."'
                                            ,`cas_trn_docs` = '".$txt_trn_docs."'
                                            ,`cas_trn_informer` = '".$txt_trn_informer."'
                                            ,`cas_trn_informer_info` = '".$txt_trn_informer_info."'
                                            ,`cas_trn_informer_connection` = '".$txt_trn_informer_connection."'
                                            ,`cas_trn_cost` = '".$txt_trn_cost."'
                                            ,`cas_trn_currency` = '".$txt_trn_currency."'
                                            ,`cas_trn_informer_connection` = '".$txt_trn_informer_connection."'
                                            ,`cas_trn_sponsor` = '".$txt_trn_sponsor."'
                                            ,`cas_trn_sponsor_info` = '".$txt_trn_sponsor_info."'
                                            ,`last_modify_by` = '".$_SESSION['user_id']."'
                                            ,`date_modify` = '".$date."' 
                        WHERE(`cas_case_number`='".$txt_case_number."')";
        if(!$vtmdb->query($q0202)){ die("Error insert into case 0203!".$vtmdb->error); }else{ $success += 1; }

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
        $("#t6").addClass("t1-active");
    });
</script>

<form name="fm_case_0203" id="fm_case_0203" action="">
    <h1 style="text-align:center;">ផ្នែកទី២</h1>
    <h1 style="text-align:center;">ដំណាក់កាលឆ្លងកាត់ព្រំដែន</h1>
    <div class="flex-container">
        <div class="flex-item-left">លេខករណី៖</div>
        <div class="flex-item-right div-input-row"><label><?= $txt_case_number ?></label></div>
    </div>
    
    <div class="flex-container">
        <div class="flex-item-left">បានឆ្លងកាត់ព្រំដែន​ទៅកាន់ប្រទេសផ្សេង៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_cross_border = 0;
                if(!empty($txt_trn_checkpoint)){
                    $has_cross_border = 2;
                }else{
                    $has_cross_border = 1;
                }
            ?>

            គ្មានទេ<input type="radio" name="has_cross_border" id="no_cross_border" value="1" style="width:30px;" <?= _checked(1,$has_cross_border) ?>> 
            បាទ/ចាស៎ មាន<input type="radio" name="has_cross_border" id="has_cross_border" value="2" style="width:30px;"  <?= _checked(2,$has_cross_border) ?>> (សូមបញ្ជាក់)
            តាមច្រក៖ <select name="txt_trn_checkpoint" id="txt_trn_checkpoint">
                        <option value="">សូមជ្រើសរើស</option>
                        <?php
                            $q = "SELECT * FROM `tb_checkpoints` WHERE(1)";
                            if(!$rs = $vtmdb->query($q)){ die ("Error loading checkpoint!"); }  
                            while($r = $rs->fetch_assoc()){
                                echo '<option value="'.$r['chkp_id'].'" '._selected($r['chkp_id'],$txt_trn_checkpoint).'>'.$r['chkp_name'].'('.get_province($r['chrk_province']).')</option>';
                            }
                        ?>
                    </select>
                    <?PHP
                        $d = gmstrftime ("%Y-%m-%d", time ()+25200);
                    ?>
            កាលបរិច្ចេទ៖ <input type="date" name="txt_trn_date" id="txt_trn_date" value="<?= $txt_trn_date ?>" min="1979-01-01" max="<?= $d ?>" style="width:70%;"><br />
            ពេលវេលា៖
                <select name="txt_hour" id="txt_hour" style="width:80px !important;">
                    <?PHP
                        for($i=0; $i<12; $i++){
                            $h = $i<10 ? '0'.$i : $i;
                            echo '<option value="'.$h.'" '._selected($i,$txt_hour).'>'.$h.'</option>';
                        }
                    ?>
                </select>:
                <select name="txt_minute" id="txt_minute" style="width:80px !important;">
                    <?PHP
                        for($i=0; $i<60; $i++){
                            $m = $i<10 ? '0'.$i : $i;
                            echo '<option value="'.$m.'" '._selected($i,$txt_minute).'>'.$m.'</option>';
                        }
                    ?>
                </select>
                <select name="txt_shift" id="txt_shift" style="width:80px !important;">
                    <option value="am" <?= _selected('am',$txt_shift) ?>>AM</option>
                    <option value="pm" <?= _selected('pm',$txt_shift) ?>>PM</option>
                </select>
            មិនដឹង <input type="checkbox" name="txt_dont_know_time" id="txt_dont_know_time" value="1" style="width:30px">
            <script>
                $(document).ready(function(e){
                    $("#txt_dont_know_time").change(function(){
                        if($(this).is(":checked")){
                            $("#txt_hour").attr("disabled","disabled");
                            $("#txt_minute").attr("disabled","disablerd");
                            $("#txt_shift").attr("disabled","disabled");
                        }else{
                            $("#txt_hour").removeAttr("disabled");
                            $("#txt_minute").removeAttr("disabled");
                            $("#txt_shift").removeAttr("disabled");
                        }
                    });
                });
            </script>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">ឯកសារសម្រាប់ឆ្លងដែន៖</div>
        <div class="flex-item-right div-input-row">
            <select name="txt_trn_docs" id="txt_trn_docs" >
                <option value="-1">សូមជ្រើសរើស</option>
                <option value="1" <?= _selected(1,$txt_trn_docs);?>>លិខិតឆ្លងដែន</option>
                <option value="2" <?= _selected(2,$txt_trn_docs);?>>លិខិត​បើកផ្លូវ</option>
                <option value="3" <?= _selected(3,$txt_trn_docs);?>>ប័ណញែព្រំដែន</option>
                <option value="4" <?= _selected(4,$txt_trn_docs);?>>ផ្សេងៗ</option>
                <option value="5"<?= _selected(5,$txt_trn_docs);?>>គ្មាន</option>
            </select>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អ្នកជួយ​នាំឆ្លងកាត់ព្រំដែន៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_agent = 0;
                if(!empty($txt_trn_informer_info)){
                    $has_agent = 2;
                }else{
                    $has_agent = 1;
                }
            ?>
            មិនមាន<input type="radio" name="has_agent" id="no_agent" value="1" style="width:30px;" <?= _checked(1,$has_agent) ?>> 
            បាទ/ចាស<input type="radio" name="has_agent" id="has_agent" value="2" style="width:30px;"  <?= _checked(2,$has_agent) ?>>
            <select name="txt_trn_informer" id="txt_trn_informer" style="width:70%">
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading agency's type name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_trn_informer).'>'.$r['agn_name'].'</option>';
                    }
                ?>
                <option value = "" disabled="disabled">----------------</option>
                <option value = "add">បន្ថែមថ្មី</option>
            </select>(សូមបញ្ជាក់បន្ថែម) 
            <input type="text" name="txt_trn_informer_info" id="txt_trn_informer_info" value="<?= $txt_trn_informer_info ?>">
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_agent ?>;
                    if(x == 1){
                        $("#txt_trn_informer_info").attr("disabled","disabled");
                        $("#txt_trn_informer").attr("disabled","disabled");
                    }

                    $("#no_agent").click(function(){
                        $("#txt_trn_informer_info").attr("disabled","disabled");
                        $("#txt_trn_informer").attr("disabled","disabled");
                    });

                    $("#has_agent").click(function(){
                        $("#txt_trn_informer_info").removeAttr("disabled");
                        $("#txt_trn_informer").removeAttr("disabled");
                    });

                    $("#txt_trn_informer").change(function(){
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
            <input type="text" name="txt_trn_informer_connection" id="txt_trn_informer_connection" value="<?= $txt_trn_informer_connection ?>" placeholder="(សូមរៀបរាប់ដោយសង្ខេប)">
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">អ្នកចំណាយលើថ្លៃឆ្លងកាត់ព្រំដែន៖</div>
        <div class="flex-item-right div-input-row">
            <?php
                $has_sponsor = 0;
                if(!empty($txt_trn_sponsor)){
                    $has_sponsor = 2;
                }else{
                    $has_sponsor = 1;
                }
            ?>
            ខ្លួនឯង<input type="radio" name="has_sponsor" id="no_sponsor" value="1" style="width:30px;" <?= _checked(1,$has_sponsor) ?>> 
            គេជាអ្នកចំណាយ<input type="radio" name="has_sponsor" id="has_sponsor" value="2" style="width:30px;"  <?= _checked(2,$has_sponsor) ?>> (សូមបញ្ជាក់)
            <select name="txt_trn_sponsor" id="txt_trn_sponsor" >
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_agencies` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading method's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['agn_id'].'" '._selected($r['agn_id'],$txt_trn_sponsor).'>'.$r['agn_name'].'</option>';
                    }
                ?>
            </select>
            សូមបញ្ជាក់អំពីឈ្មោះ ភេទ និងសញ្ជាតិ៖ <br />
                <input type="text" name="txt_trn_sponsor_info" id="txt_trn_sponsor_info" value="<?= $txt_trn_sponsor_info ?>"> <br />
            ចំនួនទឹកប្រាក់៖ <input type="number" name="txt_trn_cost" id="txt_trn_cost" value="<?= $txt_trn_cost ?>" style="width:30%" min="0.00" step="0.01">
            <select name="txt_trn_currency" id="txt_trn_currency" style="width:30%">
                <option value = "">សូមជ្រើសរើស</option>
                <?php
                    $q = "SELECT * FROM `tb_countries` WHERE(1)";
                    if(!$rs = $vtmdb->query($q)){ die("Error loading currency's name!");}
                    while($r = $rs->fetch_assoc()){
                        echo '<option value="'.$r['cn_id'].'" '._selected($r['cn_id'],$txt_trn_currency).'>'.$r['cn_currency_kh'].'</option>';
                    }
                ?>
            </select>
            <script>
                $(document).ready(function(e){
                    //Initializing attribute
                    var x = <?= $has_sponsor ?>;
                    if(x == 1){
                        $("#txt_trn_sponsor_info").attr("disabled","disabled");
                        $("#txt_trn_sponsor").attr("disabled","disabled");
                    }

                    $("#no_sponsor").click(function(){
                        $("#txt_trn_sponsor_info").attr("disabled","disabled");
                        $("#txt_trn_sponsor").attr("disabled","disabled");
                    });

                    $("#has_sponsor").click(function(){
                        $("#txt_trn_sponsor_info").removeAttr("disabled");
                        $("#txt_trn_sponsor").removeAttr("disabled");
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
        <input type="hidden" name="load_child_form" value="f0203">
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
                var bef_date_left = $("#txt_trn_date_left").val();

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
                    $("#txt_trn_date_left").focus();
                    $("#txt_trn_date_left").css('border','1px solic red');
                }else{
                    $("#txt_trn_date_left").css('border','1px solic #cccccc');
                }

                if(i>0){
                    alert("សូមបំពេញព័ត៌មាន​ចាំបាច់​ចំនួន "+i+"កន្លែង ឲ្យបានគ្រប់គ្រាន់ជាមុនសិន!")
                }else{
                    $("#fm_case_0203").submit();
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