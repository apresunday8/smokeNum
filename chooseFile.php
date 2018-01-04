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
		alert("亲，你还没上传文件的呦~");
	}else{
	var myselect = document.getElementById("files");       //获取select对象
	var index = myselect.selectedIndex;					   //获取选中项的索引
	if(myselect.options[index].value == 0){                //获取选中项的值
		alert("您现在需要选择文件才能开始喔~");
		exit();
	}else{
		var tableSuffix = myselect.options[index].value;
		var tableName = "student"+tableSuffix;
	}
	}
}
</script>