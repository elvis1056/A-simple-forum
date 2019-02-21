<?php
	require_once('conn.php');
	include_once('check_login.php');
	$is_login = false;
	$id = $_GET['id'];
	if ($username) {
		$is_login = true;
	} else {

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>week5.hw2</title>
	<meta charset="utf-8" content="width=device-width, initial-scale=1">
</head>

<style type="text/css">
	
	
	body {
		background-color: #EEE; 
	}




	.container {
		max-width: 600px;
		margin: 20px auto;
	}




	.header {
		display: flex;
		justify-content: space-around;
		align-items: center;
	}

	.title {
		font-size: 50px;
		color: green;
	}

	.button__log {
		font-size: 18px;
		padding: 5px;
		border: 1px solid rgba(0,0,0,0.5);
		border-radius: 10px;
		margin-right: 10px;
		cursor: pointer;
	}




	.comment__list {
		margin: 5px;
		padding: 10px;
		border: 2px solid;
	}

	.comment__mainform__user > input {
		width:50%;
	}

	.comment__mainform__textarea > textarea {
		width: 100%;
		height: 200px;
		margin-top: 10px;
	}

	.comment__mainform__button {
		padding: 10px 40px;
		background: #3597dc;
		color: white;
		cursor: pointer;
	}

</style>

<body>

	<!-- 整個網頁 -->
	<div class="container">

		<!-- 上方列表 -->
		<div class="header">
			<div class="title">留言板</div>
			<?php
					if(!$is_login) {
			?>
							<a href="register.php" class="button__log" >註冊</a>
							<a href="login.php" class="button__log" >登入</a>
			<?php	} else {
			?>
							<a href="logout.php" class="button__log" >登出</a>
			<?php
					}
			?>
		</div>
		
		<!-- 留言撰寫 -->
		<div class="comment__list">
			<div class="comment__mainform">
				<form method="post" action="handle_edit_comment.php">
					<!--  主留言暱稱
					<div class="comment__mainform__user">		
						<input name="nickname" type="text" placeholder="暱稱" required />
					</div>
					-->
					<div class="comment__mainform__textarea">
						<textarea name="content" placeholder="請在這編輯"></textarea>
					</div>
					<input type="hidden" name="id" value=<?php echo $_GET['id'] ?> />
					<?php
						if ($is_login) {
							echo "<input type='submit' class='comment__mainform__button' value='送出' />";
						} else {
							echo "<input type='submit' class='comment__mainform__button' value='請先登入' disabled />";
						}
					?>
				</form>
			</div>
		</div>
		
</body>
</html>