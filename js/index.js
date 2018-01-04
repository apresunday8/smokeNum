//按钮控制部分
document.onkeydown=function(event){
	var e = event || window.event || arguments.callee.caller.arguments[0];      // 创建按键的对象
	if(e && e.keyCode==38 || e && e.keyCode==37){               //上键键值为38,左键为37
	document.getElementById('start').click();
}
	if(e && e.keyCode==40 || e && e.keyCode==39){                //下键为40 ,右键为39
	document.getElementById('stop').click();
}
    if (e && e.keyCode==13) {
        count++;                     //count统计键盘按键次数
      if (count%2!=0) {              //为奇数的话就开始抽号
            document.getElementById('start').click();
        }else {                      //偶数的话就停止抽号
            document.getElementById('stop').click();
        }
    }
};
