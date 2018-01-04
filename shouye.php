<?php
include "input.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>欢迎使用在线抽奖软件</title>
	<link rel="stylesheet" href="css/index.css">
	<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<h1>在线抽奖平台</h1>
	<form action="dealWith.php" method="post" enctype="multipart/form-data">
<!--表单标签中设置enctype="multipart/form-data"来确保匿名上载文件的正确编码。不设置上传文件会报错-->
    <div id="file">
		<span>上传文件：</span><input type="file" name="file">
	    <input type="submit" value="上传文件" class="btn">
	</div>
	</form>
	<?php include "explain.html" ?>
	<div id="container">
		<select name="files" id="files">
			<option value="0">选择上传过的文件</option>
				<?php
					$sql = "SELECT * FROM dataname";
					$result = mysql_query($sql);
					while ($arr =mysql_fetch_assoc($result)) {
				?>
						<option value="<?php echo $arr['id']?>"><?php echo $arr['fileName'] ?></option>
					<?php } ?>
			</option>
		</select>
		<input type="text" name="" id="result">
	</div>
	<div id="foot">
		<input type="submit" name="" value="开始摇号" class="foot_btn" id="start" onclick="qwe();start()">
		<input type="submit" name="" value="停止摇号" class="foot_btn" id="stop" onclick="stop()" disabled="true">
		<input type="reset" name="" value="重置" class="foot_btn" onclick="reset()">
	</div>
	<div class="foot">
  <div class="text_div">
  <span class="text">
		<P>地址：陕西省渭南市朝阳大街渭南师范学院6#531办公室</P>
		<p>邮编：714000</p>
		<P>电话：13991548742</P>
		<p>Copyright 2017-~&nbsp;&nbsp;&nbsp;&nbsp;礼拜八网络科技有限公司版权所有&copy;</p>
  </span>
  </div>
</div>
</body>
</html>