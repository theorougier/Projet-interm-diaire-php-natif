<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="./css/index.css"></link>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<a href='/home.php'><h1>Project Php</h1></a>
                <?php
                if (isset($_SESSION['loggedin'])) {
                    ?>
				<a href="/auth/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="/auth/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                <?php }else{ ?>
				<a href="/index.php"><i class="fas fa-user-circle"></i>Login</a>
                <?php } ?>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>