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
	try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset", $username, $password, $options);
    return $conn;
	}catch(PDOException $e){throw $e;}
}

function check_register($name){
	//用于判断用户名是否注册
	try {
			$conn = connect_database();//创建数据库连接
			$sql = "select password from users where name=:name";
			$stmt = $conn->prepare($sql);//使用prepare进行预编译
			$stmt->bindParam(':name', $name);//绑定参数
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);//将对应结果集中的每一行作为一个列名索引数组返回
			return isset($result['password']) ? "NO": "OK";
		} catch(PDOException $e) {
			throw $e;
		}	
}

function get_user_info($name){
	//操作与之前检查是否注册类似
	try {
        $conn = connect_database();
        $sql = "select * from users where name=:name";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    } catch(PDOException $e) {
        throw $e;
    }
}

function uploadFileInDb($name, $size, $enckey, $sha256, $uid, $datetime) {
	//将用户数据插入表中用法类似
    try {
        $conn = connect_database();
        $sql = "INSERT INTO files (name, size, enckey, sha256, uid, create_time) VALUES (:name, :size, :enckey, :sha256, :uid, :datetime)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':enckey', $enckey);
        $stmt->bindParam(':sha256', $sha256);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':datetime', $datetime);
        $result = $stmt->execute();
        return $result;
    } catch(PDOException $e) {
        throw $e;
    }
}
