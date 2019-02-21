<?php
	
	require_once("conn.php");

	$content = $_POST['content'];
	$id = $_POST['id'];

	$sql = "UPDATE elvis1056_testuser SET content=? WHERE id=?";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si", $content, $id);

	if ($stmt->execute()) {
		header('Location: index.php');
	} else {
		echo "錯誤";
	}
	
?>