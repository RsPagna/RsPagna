<?PHP
    if(!isset($vtmdb)){
        header("location: 404.shtml");
    }

    $tr = "";
    $qven = "SELECT * FROM `tb_vendors` ORDER BY `ven_id`";
    if(!$rsven = $vtmdb->query($qven)){
        die('Error vent: [' . $vtmdb->error . ']');
    }else{
        $n = 0;
        while($rven = $rsven->fetch_assoc()){
            $n += 1;

            //Allow user to click for edit
            $edit = "title=\"ចុចដើម្បីកែតម្រូវ\" onClick=\"window.open('setting/fmVendors.php?fmVendCommand=edit&id=".$rven['ven_id']."');\"";
            
            //Allow user to delete record
            $delete = "<div class=\"link_button_delete\" title=\"លុបទិន្នន័យ\" onClick=\"window.open('setting/fmVendors.php?fmVendCommand=delete&id=".$rven['ven_id']."')\" '></div>";

            $tr .= "<tr>
                        <td $edit>$n</td>
                        <td $edit>".$rven['ven_name']."</td>
                        <td $edit>
                            Email: ".$rven['ven_email']."<br />
                            Phone/WhatsApp/Telegram: ".$rven['ven_phone']."<br />
                            Facebook: ".$rven['ven_fb']."<br />
                            www: ".$rven['ven_www']."<br />
                            Address: ".$rven['ven_address1']." ".$rven['ven_address1']."
                        </td $edit>
                        <td>&nbsp;</td>
                        <td>$delete</td>
                    </tr>";
        }
    }
?>
<?php
if($n>3){
    echo "<div style=\"overflow:auto; height:300px\">";
}
?>
<table class="tb-display">
    <thead>
        <tr>
            <th>ល.រ</th>
            <th>ឈ្មោះអង្គភាពឬក្រុមហ៊ុន</th>
            <th>ព័ត៌មានលំអិត</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>

        </tr>
    </thead>
    <tbody>
        <?= $tr ?>
    </tbody>
</table>
<?php
if($n>3){
    echo "</div>";
}
?>