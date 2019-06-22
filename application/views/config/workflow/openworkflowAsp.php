<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <base href="<?php echo base_url(); ?>" />

</head>
<body>
<table style="widht:50%;margin:10px auto;">
 <tr><th>名称</th><th>查看</th></tr>
<?php

	foreach ($result as $row){
 ?>
 <tr>
    <td><?echo $row['wf_name']  ?></td>
    <td><a href="index.php/config/workflow/wfconfigAsp/detail?wfuid=<?= $row['wf_uid'] ?>" target="_blank">查看</a></td>
    <td><a href="index.php/config/workflow/wfconfigAsp/edit?wfuid=<?= $row['wf_uid'] ?>" target="_blank">编辑</a></td>
 </tr>

 <?php
 }
?>
</table>
</body>
</html>