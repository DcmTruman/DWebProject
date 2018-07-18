<?php

//增删查改
//连接数据库函数
//数据库中用户名注册判重
//注册新的用户
//修改用户信息

function connect_database(){
	$servername = getenv('DB_AC_SERVERNAME');
    $username = getenv('DB_AC_USERNAME');
    $password = getenv('DB_AC_PASSWORD');
    $dbname = getenv('DB_AC_DBNAME');
    $charset = "utf8mb4";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset", $username, $password, $options);
    return $conn;
}


