<?php 
include "linkMysql.php";
$sql = "SELECT * FROM dataname";
$result = mysql_query($sql);
$brr = (int)mysql_fetch_assoc($result);
?>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	function qwe(){
	var asd = <?php echo $brr ?>;
	if(asd==0){
		alert("请先上传数据后再操作");
	}else{
	var myselect = document.getElementById("files");       //获取select对象
	var index = myselect.selectedIndex;					   //获取选中项的索引
	if(myselect.options[index].value == 0){                //获取选中项的值
		alert("请选择文件后再进行操作");
		exit();
	}else{
		var tableSuffix = myselect.options[index].value;
		var tableName = "student"+tableSuffix;
	}
	}
}
</script>