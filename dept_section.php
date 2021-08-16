<?PHP
    if(!isset($vtmdb)){
        header("location: 404.shtml");
    }

    $tr = "";
    $qdept = "SELECT * FROM `tb_department` ORDER BY `dept_order`";
    if(!$rsdept = $vtmdb->query($qdept)){
        die('Error dept: [' . $vtmdb->error . ']');
    }else{
        $n = 0;
        while($rdept = $rsdept->fetch_assoc()){
            $n += 1;

            //Allow user to click for edit
            $edit = "title=\"ចុចដើម្បីកែតម្រូវ\" onClick=\"window.open('setting/fmDepartments.php?fmDeptCommand=edit&id=".$rdept['dept_id']."');\"";
            
            //Allow user to delete record
            $delete = "<div class=\"link_button_delete\" title=\"លុបទិន្នន័យ\" onClick=\"window.open('setting/fmDepartments.php?fmDeptCommand=delete&id=".$rdept['dept_id']."')\" '></div>";

            $tr .= "<tr>
                        <td $edit>".$rdept['dept_order']."</td>
                        <td $edit>".$rdept['dept_name']."</td>
                        <td $edit>".$rdept['dept_address']."</td>
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
            <th>ឈ្មោះអង្គភាពគ្រប់គ្រង</th>
            <th>អាសយដ្ឋាន</th>
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