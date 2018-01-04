<?php
//包含连接Mysql数据库文件
include "chooseFile.php";
//构建查询sql语句
$table='student1';
$sql = @"SELECT * FROM $table";
$result = mysql_query($sql);            //执行SQL语句
if ($result) {                         //判断查询结果有没有数据
	while ($arr = mysql_fetch_assoc($result)) {
	$data[]=$arr;
}
}
?>
<script>
    var t;
    var i=0;
    var count=0;         //记录按键的次数

 //前台抽号动画方法
function start(){
    //将PHP读取的数据库数据转换为js数据，以便前端部分操作
    var jsdata = new Array();
    jsdata = <?php echo json_encode($data)?>;       //json_encode对数据进行json编码
	document.getElementById('result').value=jsdata[i]['stuNum']+'                         '+jsdata[i]['stuName'];
	document.getElementById('result').style.fontSize = '22px';
	document.getElementById('result').style.textAlign='center';
	document.getElementById('result').style.fontWeight='bold';
	document.getElementById('start').disabled=true;
	document.getElementById('stop').disabled=false;
	i++;
	if (i==jsdata.length) {
		i=0;
	}
	t=setTimeout("start()",70);
}
//停止抽号，并且根据js中的随机数函数生成最终的随机数值，保证公平性
function stop(){
	//实现随机数函数   Math.round(Math.random()*(jsdata.length-1));   0-jsdata.length-1随机数
	clearTimeout(t);
    document.getElementById('stop').disabled=true;
	document.getElementById('start').disabled=false;
	i=Math.round(Math.random()*(jsdata.length-1));
	document.getElementById('result').value=jsdata[i]['stuNum']+'                         '+jsdata[i]['stuName'];
	//console.log(i);         测试随机数
}
//重置抽号器
function reset(){
	if(document.getElementById('result').value.length == 0){
		location.reload();
	}else{
	clearTimeout(t);
	document.getElementById('result').value="";
	document.getElementById('stop').disabled=true;
	document.getElementById('start').disabled=false;
    location.reload();             //刷新当前界面
}
}
</script>