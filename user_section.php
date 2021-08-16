<?PHP
    if(!isset($vtmdb)){
        header("location: 404.shtml");
    }
if(isset($_SESSION['user_permission']) and $_SESSION['user_permission'] == 'SA'){
    $tr = "";
    $quser = "SELECT * FROM `tb_users` WHERE(1)";
    if(!$rsuser = $vtmdb->query($quser)){
        die('Error user: [' . $vtmdb->error . ']');
    }else{
        $n = 0;
        while($ruser = $rsuser->fetch_assoc()){
            $n += 1;
            $profile = !empty($ruser['u_profile']) ? "images/profile/".$ruser['u_profile']:'';

            //Allow user to click for edit
            $edit = "title=\"ចុចដើម្បីកែតម្រូវ\" onClick=\"window.open('setting/fmUsers.php?fmUserCommand=edit&id=".$ruser['u_id']."');\"";
            
            //Allow user to delete record
            $delete = "<div class=\"link_button_delete\" title=\"លុបទិន្នន័យ\" onClick=\"window.open('setting/fmUsers.php?fmUserCommand=delete&id=".$ruser['u_id']."')\" '></div>";

            $tr .= "<tr>
                    <td $edit>$n</td>
                    <td $edit><div><img src=\"$profile\" class=\"avatar\" width=\"32\" /></div></td>
                    <td $edit>".$ruser['u_fname']." ".$ruser['u_lname']."</td>
                    <td $edit>".$ruser['u_user']."</td>
                    <td $edit>".$ruser['u_email']."</td>
                    <td $edit>".$ruser['u_permission']."</td>
                    <td $edit>".$ruser['u_status']."</td>
                    <td>&nbsp;</td>
                    <td>$delete</td>
                </tr>";
        }
    }
}else{
    $quser = "SELECT * FROM `tb_users` WHERE(`u_id`='".$_SESSION['user_id']."') LIMIT 1";
    if(!$rsuser = $vtmdb->query($quser)){
        die('Error user: [' . $vtmdb->error . ']');
    }else{
        $ruser = $rsuser->fetch_assoc();
        $name = $ruser['u_fname']." ".$ruser['u_lname'];
        $user = $ruser['u_user'];
        $email = $ruser['u_email'];
        $permission = $ruser['u_permission'];
        $status = $ruser['u_status'];
        $profile = !empty($ruser['u_profile']) ? "images/profile/".$ruser['u_profile']:'';
    }
}
?>
<?PHP
if(isset($_SESSION['user_permission']) and $_SESSION['user_permission'] == 'SA'){
    if($n>5){
        echo "<div style=\"overflow:auto; height:300px\">";
    }
?>
<table  class="tb-display">
    <thead>
        <tr>
            <th>ល.រ</th>
            <th>&nbsp;</th>
            <th>គោត្តនាម និងនាម</th>
            <th>ឈ្មោះគណនី</th>
            <th>អ៊ីម៉ែល</th>
            <th>អភ័យឯកសិទ្ធិ</th>
            <th>ស្ថានភាពប្រើប្រាស់</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?= $tr ?>
    </tbody>
</table>
<?php
    if($n>5){
        echo "</div>";
    }
}else{
?>
<h1>ព័ត៌មានអំពីអ្នក</h1>
<div class="user-profile">
    <div><img src="<?= $profile ?>" class="avatar" width="180"/></div>
    <div>
        <p>ឈ្មោះ៖ <?= $name ?></p>
        <p>ឈ្មោះគណនីប្រើប្រាស់៖ <?= $user ?> </p>
        <p>អ៊ីម៉ែល៖ <?= $email ?></p>
        <p>អភ័យឯកសិទ្ធិ៖ <?= $permission ?></p>
        <p>ស្ថានភាពប្រើប្រាស់៖ <?= $status ?></p>
    </div>
</div>
<?PHP
}
?>
