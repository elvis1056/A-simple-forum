<?php
	session_start();
	require_once("conn.php");
		$error_message ="";
	if(isset($_POST['username']) && !empty($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$stmt = $conn->prepare("SELECT * FROM elvis1056_register where username=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$hash_password = $row['password'];
		$id = $row['id'];

		if(password_verify($password, $hash_password)) {
			$_SESSION['username'] = $username;
			$_SESSION['id'] = $id;
			header('Location: ./index.php');
		} else {
			$error_message = "帳號或密碼錯誤";
			echo '<script>alert("帳號或密碼錯誤"); window.location = "./login.php"</script>';
		}
		$conn->close();
	}
?>