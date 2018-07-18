<?php
session_start()
?>
<!DOCTYPE html>
<html lang = "zh">

<head>
	<meta charset="utf-8">
	<title>小灯网盘-注册</title>
</head>

<body>
	  <div >
    <form action="register_d.php" method="post">
      <h1>小灯网盘</h1>
      <div>
        <div>
          <label for="i_username">用户名</label>
          <input type="email" id="i_username" name="username" placeholder="请输入用户名" onblur="check_register_name()" oninput="check_register_name()" ><p class="help-block" id="uname_allow"></p>
        </div>
        <div id = "iPasswordDiv"> 
          <label for="iPassword">口令</label>
          <input type="password" id="iPassword" name="password" placeholder="请输入登录口令" oninput="checkRegister()">
        </div>
        <div id="re-iPasswordDiv" >
          <label for="re-iPassword">确认口令</label>
          <input type="password" id="re-iPassword" name="password2" placeholder="请再次输入登录口令" onblur="checkRegister()" oninput="checkRegister()">
		  <p class="help-block" id="password2prompt"></p>
          <script language='javascript' type='text/javascript'>
          // FIXME Bad Coding Style

	function check_register_name()
	{
	//	console.log("fuck");
		var uname = $('#i_username').val();
		$.ajax({
			url:"register_d.php",
			data:{u:uname},
			type:"POST",
			dataType:"TEXT",
			success:function(data){
				if(data.trim() == "OK")
				{
					$('#uname_allow').text("该用户名尚未注册");
					$('#uname_allow').css("color","green");	
				}
				else
				{
					$('#uname_allow').text("该用户名已注册");
					$('#uname_allow').css("color","red");	
				}
			}
		
		
		});
	}
    function checkRegister() {
		//用于检测两次输入密码是否相同
        if ($('#iPassword').val() != $('#re-iPassword').val()) {
            $('#password2prompt').text('两次不相同');
            $('#iPasswordDiv').addClass('has-warning');
            $('#re-iPasswordDiv').addClass('has-warning');
            $('#registerBtn').prop('disabled', true);

		} 
		else if(function(){
			var pwd = $('#iPassword').val();
			function CharMode(iN){  
				if (iN>=48 && iN <=57) //数字  
					return 1;  
				if (iN>=65 && iN <=90) //大写  
					return 2;  
				if (iN>=97 && iN <=122) //小写  
					return 4;  
				else  
					return 8;   
			}
			//bitTotal函数  
			//计算密码模式  
			function bitTotal(num){  
				modes=0;  
				for (i=0;i<4;i++){  
					if (num & 1) modes++;  
					num>>>=1;  
				}
				return modes;  
			}
			//返回强度级别  
			function checkStrong(sPW){  
				if (sPW.length<6)  
					return 0; //密码太短，不检测级别
				Modes=0;  
				for (i=0;i<sPW.length;i++){  
					//密码模式  
					Modes|=CharMode(sPW.charCodeAt(i));  
				}
				return bitTotal(Modes);  
			}
		   
			var S_level=checkStrong(pwd);
			if(S_level<3){return true;}
			else {return false;}
			}()  	
		){
			$('#password2prompt').text('请输入含有数字、大小写字母且8位以上的密码');
            $('#iPasswordDiv').addClass('has-warning');
            $('#re-iPasswordDiv').addClass('has-warning');
            $('#registerBtn').prop('disabled', true);;
		}	
		else {
            // input is valid -- reset the error message
            $('#password2prompt').text('');
            $('#iPasswordDiv').removeClass('has-warning');
            $('#re-iPasswordDiv').removeClass('has-warning');
            $('#registerBtn').prop('disabled', false);;
        }
    }
</script>
        </div>
        <button type="submit" class="btn btn-primary btn-lg" id="registerBtn" name="register" disabled>注册</button>
      </div>
    </form>

</div>
	<script src="./js_mod/jquery/jquery.min.js"></script>
	<script src="./js_mod/bootstrap/js/bootstrap.min.js"></script>
</body>
