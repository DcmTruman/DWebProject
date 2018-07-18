<?php
//session_start();

require_once 'db.php';
//var_dump($_POST);
if(isset($_POST["u"]))
{
		
	$uname = $_POST["u"];
	if(check_register($uname) == "OK"){
		echo "OK";}
	else{
		echo "NO";
	}
	//var_dump(jjj);
}


