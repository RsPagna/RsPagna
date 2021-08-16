<?PHP
    $tr = "";
    $qcat = "SELECT * FROM `tb_categories` ORDER BY `cat_order`";
    if(!$rscat = $itmdb->query($qcat)){
        die('Error cat: [' . $itmdb->error . ']');
    }else{
        $n = 0;
        while($rcat = $rscat->fetch_assoc()){
            $n += 1;

            //Allow user to click for edit
            $edit = "title=\"ចុចដើម្បីកែតម្រូវ\" onClick=\"window.open('settings/fmCategory.php?fmCatCommand=edit&id=".$rcat['cat_id']."');\"";
            
            //Allow user to delete record
            $delete = "<div class=\"link_button_delete\" title=\"លុបទិន្នន័យ\" onClick=\"window.open('settings/fmCategory.php?fmCatCommand=delete&id=".$rcat['cat_id']."')\" '></div>";

            $tr .= "<tr>
                        <td $edit>".$rcat['cat_order']."</td>
                        <td $edit>".$rcat['cat_name']."</td>
                        <td $edit>".$rcat['cat_desc']."</td>
                        <td>&nbsp;</td>
                        <td>$delete</td>
                    </tr>";
        }
    }
?>
<?php
if($n>5){
    echo "<div style=\"overflow:auto; height:300px\">";
}
?>
<table  class="tb-display">
    <thead>
        <tr>
            <th>លេខលំដាប់</th>
            <th>ឈ្មោះផ្នែកឬក្រុម​ប្រភេទសម្ភារ</th>
            <th>បរិយាយ</th>
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
?>