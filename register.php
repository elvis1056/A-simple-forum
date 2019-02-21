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
		max-width: 300px;
		margin: 20px auto;
		border: 1px solid;
		text-align: center;
		padding: 5px;
	}

	.title {
		margin: 20px 10px;
	}

	.form {
		padding: 5px;
	}

	.button {
		padding: 8px 25px;
		cursor: pointer;
		border-radius: 5px;
		background: #3597dc;
		color: white;
		display: inline-block;
	}

</style>

<body>

	<div class="container">
		
		<h1 class="title">註冊</h1>

		<form class="form" method="post" action="handle_register.php">
			<div>
				username: <input type="text" name="username" />
			</div>

			<div>
				password: <input type="password" name="password" />
			</div>

			<div>
				nickname: <input type="text" name="nickname" />
			</div>
			
			<input class="button" type="submit" >
		</form>

	</div>
</body>

</html>