<?php
	
	require_once("conn.php");
	include_once("check_login.php");

	$data_id = $_POST['id'];
	$sql = "DELETE FROM elvis1056_testuser WHERE (id=? or parent_id=?) AND user_id=? ";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iii", $data_id, $data_id, $id);

	if ($stmt->execute()) {
		echo '<script>alert("YES DELETE"); window.location = "./index.php"</script>';
	} else {
		echo '<script>alert("NO DELETE, PLEASE CHECK"); window.location = "./index.php"</script>';
	}
	
?>			