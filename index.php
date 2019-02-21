<?php
	require_once('conn.php');
	require_once('utils.php');
	include_once('check_login.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>week5.hw2</title>
	<meta charset="utf-8" content="width=device-width, initial-scale=1">
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<body>
	<!-- 上方列表 -->
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top" style="background-color: #e3f2fd;">
  		<div class="title navbar-brand">留言板</div>
			<?php
					if($username) {
			?>
						<a href="logout.php" class="button__log" >登出</a>
							
			<?php	} else {
			?>		<div>
						<a href="register.php" class="button__log" >註冊</a>
						<a href="login.php" class="button__log" >登入</a>
					</div>
			<?php
					}
			?>
	</nav>

	<!-- 整個網頁 -->
	<div class="container">
		
		<!-- 留言撰寫 -->
		<div class="comment__list">
			
			<div class="comment__mainform">
				<form method="post" action="add__comment.php">
					<!--  主留言暱稱
					<div class="comment__mainform__user">		
						<input name="nickname" type="text" placeholder="暱稱" required />
					</div>
					-->
					<div class="comment__mainform__textarea">
						<textarea name="content" placeholder="請在這輸入"></textarea>
					</div>
					<input type="hidden" name="parent_id" value='0' />
					<?php
						if ($username) {
							echo "<input type='submit' class='comment__mainform__button' value='送出' />";
						} else {
							echo "<input type='submit' class='comment__mainform__button' value='請先登入' disabled />";
						}
					?>
				</form>
			</div>
		</div>
		

		<!-- 留言評論撰寫 -->
		<div class="board__comments">

		<?php
			//查詢主要留言筆數
			$page = 1; //假如$_GET["page"]未設置 //則在此設定起始頁數
			if( isset( $_GET['page'])){
				$page =  intval( $_GET['page'] ); //確認頁數只能夠是數值資料
			}
			$pages_size = 5;
			$start = $pages_size * ($page - 1);
			$sql = "SELECT elvis1056_testuser.*, elvis1056_register.nickname FROM elvis1056_testuser left join elvis1056_register on elvis1056_testuser.user_id = elvis1056_register.id WHERE parent_id = 0 order by created_at DESC LIMIT $start, $pages_size";
			$results = $conn->query( $sql );	

			if( $results->num_rows > 0 ) {
				while($row = $results->fetch_assoc()) {
		?>

			<div class="comment">
				<div class="comment__user">		
					<div class="comment__author"><?php echo $row["nickname"]; ?></div>
					<div class="comment__time"><?php echo $row["created_at"]; ?></div>
					<div class="comment__content">
						<?php echo htmlspecialchars($row["content"], ENT_QUOTES, 'UTF-8'); ?>
					</div>
					<div class='comment__edit'>
						<?php
							if ($id == $row["user_id"]) {
								echo renderEditBtn($row["id"]);
								echo renderDeleteBtn($row["id"]);
							}
						?>
					</div>
				</div>

				
				<div class="board__subcomments">

					<?php
						$parent_id = $row["id"];
						$sub_sql = "SELECT elvis1056_testuser.*, elvis1056_register.nickname FROM elvis1056_testuser left join elvis1056_register on elvis1056_testuser.user_id = elvis1056_register.id WHERE parent_id = $parent_id order by created_at DESC";

						$sub_result = $conn->query( $sub_sql );
						while( $sub_row = $sub_result->fetch_assoc() ) {
					?>

					<div class="comment__user__sub">	
						<div class="comment__author"><?php echo $sub_row["nickname"]; ?></div>
						<div class="comment__time"><?php echo $sub_row["created_at"]; ?></div>
						<div class="board__subcomment__content">
							<?php echo htmlspecialchars($sub_row["content"], ENT_QUOTES, 'UTF-8'); ?>
						</div>
						<div class='comment__edit'>
							<?php
								if ($id == $sub_row["user_id"]) {
									echo renderEditBtn($sub_row["id"]);
									echo renderDeleteBtn($sub_row["id"]);
								}
							?>
						</div>
					</div>


					<?php
						}
					?>
					
					<!-- 次留言撰寫 -->
					<div class="comment__subform">
						<form method="post" action="add__comment.php">
							<!--  次留言暱稱
							<div class="comment__subform__user">		
								<input name="nickname" type="text" placeholder="暱稱" required />
							</div>
							-->
							<div class="comment__subform__textarea">
								<textarea name="content" placeholder="請在這輸入"></textarea>
							</div>
							<input name="parent_id" type="hidden" value=<?php echo $row['id']; ?> />
							<?php
								if ($username) {
									echo "<input type='submit' class='comment__subform__button' value='送出' />";
								} else {
									echo "<input type='submit' class='comment__subform__button' value='請先登入' disabled />";
								}
							?>
						</form>
					</div>
				</div>
			</div>

		<?php
					}
			} else {
				echo "";
			}
		?>

		</div>

		<!-- 留言分頁撰寫 -->
		<?php
			$pages_sql = "SELECT COUNT(parent_id) AS count FROM elvis1056_testuser WHERE parent_id = 0";
			$pages_result = $conn->query( $pages_sql );
			$pages_row = $pages_result->fetch_assoc();
			$pagesnum = ceil ( $pages_row['count'] / $pages_size );
		?>
		<nav aria-label="Page navigation example">
  			<ul class="pagination justify-content-center">
    			<?php
    			for($i=1; $i<=$pagesnum; $i++){
    				if($i === $page){
    					echo '<li class="page-item"><a class="page-link">'.$i.'</a></li>';
    				} else {
    					echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
    				}
    			}
    			?>
  			</ul>
		</nav>

		<!-- 原始分頁撰寫
		<div class="pagesnum">
			<div class="totalpages">
			<?php
				//分頁頁碼
				echo '共 '.$pagesnum.' 頁 - 第 '.$page.' 頁';
			?>
			</div >
				<ul class="every_num">
					<?php
						for($i=1; $i <= $pagesnum; $i++ ){
							if( $i === $page ) { 
							echo "<li>[ $i ]</li>";
							} else {
							echo "<li><a href='index.php?page= " . $i . "'> " . $i . " </a></li> ";
							}
						}
					?>
				</ul>
		</div>
		 -->
	</div>
</body>
</html>