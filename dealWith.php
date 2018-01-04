<?php
//包含连接数据库的文件
include "linkMysql.php";
//检测有没有选择上传的文件
if (empty($_FILES['file']['name'])) {
	echo "<script>alert('您没有选择任何文件！');history.go(-1)</script>";
	exit();
}
$fileName = $_FILES['file']['name'];     //获取文件名称

$QfileName = substr($fileName,0,strrpos($fileName, '.'));         //获取去电文件后缀后的文件名
//构建SQL语句
$sql = "INSERT INTO dataname VALUES(null,'$QfileName')";
mysql_query($sql);
//检测文件格式
    $filePath = pathinfo($fileName);              //获取文件扩展的相关信息输出结果为一个数据类型
    $fileFromat = $filePath['extension'];         //获取文件后缀名(pathinfo返回值的'extension'为文件扩展名
//检测文件大小
$fileSize = $_FILES['file']['size'];
if ($fileSize>5*1024*1024) {
	echo "<script>alert('上传失败你选择的excel文件超过了5M,请重新上传！');history.go(-1)</script>";
	$sql = "DELETE FROM dataname WHERE fileName='$QfileName'";
	mysql_query($sql);
}
//限制文件上传格式
if($fileFromat!='xlsx'&&$fileFromat!='xls'){
    $sql = "DELETE FROM dataname WHERE fileName='$QfileName'";
    mysql_query($sql);
	echo "<script>alert('格式错误，请上传excel文件格式为.xls或.xlsx！');history.go(-1)</script>";
	exit();
}
$fileTemName = $_FILES['file']['tmp_name'];
if(is_uploaded_file($fileTemName)){           //判断文件是否成功上传
	require_once "Classes/PHPExcel.php";
	require_once "Classes/PHPExcel/IOFactory.php";
	require_once "Classes/PHPExcel/Reader/Excel2007.php";
	require_once "Classes/PHPExcel/Reader/Excel5.php";
	if ($fileFromat=='xls') {
		$objReader = PHPExcel_IOFactory::createReader('Excel5');
	}else if ($fileFromat =='xlsx'){
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	}
	$objPHPExcel = $objReader->load($fileTemName);     //获取上传的Excel文件
	$sheet = $objPHPExcel->getSheet(0);             //获取excel文件中的第一张表格
	$highestRow = $sheet->getHighestRow();          //获取第一张表格中数据的总行数
    //判断上传的数据完整性
	for($i=2;$i<=$highestRow;$i++){
		$a = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();   //获取表格中第i行第一列(学号)的数据的值
		$b = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();   //第i行第二列(姓名)的数据值
		//判断上传的表格中是否有数据
		if (empty($a)||empty($b)) {
			echo "<script>alert('请检查你上传的文件，文件内数据不完整，请检查！');location.href='shouye.php'</script>";
            $sql = "DELETE FROM dataname WHERE fileName='$QfileName'";
            mysql_query($sql);
			exit();
		}
}
//动态创建数据表，独立文件之间是一个数据表
//动态构建要创建的数据表名称
	$sql = "SELECT * FROM dataname";
	$result = mysql_query($sql);
while ($arr = mysql_fetch_assoc($result)) {
	$data = $arr;
}
	$txt1 = "student";
	$txt2 = $data['id'];
	$table = $txt1.$txt2;
//构建动态创建数据表的sql语句
$sql = "CREATE TABLE $table(
	`id` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`stuNum` INT(10) NOT NULL,
	`stuName` VARCHAR(20) NOT NULL)";
	if(mysql_query($sql)){
    //循环插入数据
	for($i=2;$i<=$highestRow;$i++){
		$a = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();   //获取表格中第i行第一列(学号)的数据的值
		$b = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();   //第i行第二列(姓名)的数据值
		//构建插入数据库的sql语句
		$sql = "INSERT INTO $table VALUES(null,'$a','$b')";
		$result = mysql_query($sql);
		if ($result) {
			echo "<script>alert('恭喜你上传数据成功，开始摇奖吧！');location.href='shouye.php'</script>";
		}else{
			echo "<script>alert('插入数据失败，请检查上传文件格式后重新插入');location.href='shouye.php'</script>";
			exit();
		}
	}
}else{
     echo "<script>alert('插入数据失败，上传文件过程中创建数据表错误，请联系管理员');location.href='shouye.php'</script>";
     exit();
}
}
?>