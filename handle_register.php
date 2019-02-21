<?php
	session_start();
	require_once("conn.php");

	$username = $_POST["username"];
	//原始密碼沒有經過 hash 時
	//$password = $_POST["password"];
	//使用 hash function 將密碼變成亂碼，相同字串每次變成的亂碼都不一樣
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$nickname = $_POST["nickname"];
	$sql = "INSERT INTO elvis1056_register (username, password, nickname) VALUES (?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("sss", $username, $password, $nickname);
	
	if($stmt->execute()){
		$_SESSION['username'] = $username;
		header('Location: ./index.php');
	} else {
		echo "註冊失敗";
	}

	//$conn->query($sql) or die('Error');
	//echo $sql;
	$conn->close();
?>