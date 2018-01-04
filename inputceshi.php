<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ceshi</title>
    <link rel="stylesheet" href="">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>
<body>
   <div id="content"></div>
<script>
$(function(){
    var myselect = document.getElementById("files");       //获取select对象
    var index = myselect.selectedIndex;                    //获取选中项的索引
var my_data= index;
$.ajax({
url: "inputceshi.php",
type: "POST",
data: {trans_data:my_data},
error: function(){
alert('Error');
},
success: function(data,status){
$("#content").html(data);
}
});
});
</script> 
</body>
</html>
<?php
error_reporting(0);
$backValue = $_POST['trans_data'];
echo $backValue;
$chooseTable = "student".backValue;
?>