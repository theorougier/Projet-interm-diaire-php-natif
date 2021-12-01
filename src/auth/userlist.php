<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
$DATABASE_HOST = 'edd48e466bf6';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'example';
$DATABASE_NAME = 'phplogin';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$id=$_SESSION['id'];
$query=mysqli_query($con,"SELECT * FROM accounts")or die(mysqli_error());
$row=mysqli_fetch_array($query);
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../css/index.css"></link>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <a href='/home.php'><h1>Project Php</h1></a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
                <form method="post" action="#">
				<table>
                    <thread>
                    <tr>
                    <td><label>Username:</label></td>
                    <td><label>Email:</label></td>
                    <td><label>Admin (1=true, 0=false):</label></td>
					</tr>
                    </thread>
                    <tbody>
                        <?php foreach($query as $user) { ?>
                        <tr>
                        <td><?php echo $user.username; ?></td>
                        <td><?php echo $user.email; ?></td>
                        <td><?php echo $user.email; ?></td>
					    </tr>
                        <?php } ?>
                    </tbody>
				</table>
                </form>
			</div>
		</div>
	</body>
</html>
<?php
      if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $admin = $_POST['admin'];
      $query = "UPDATE accounts SET username = '$username',
                      password = '$password', email = '$email', admin = '$admin'
                      WHERE $id";
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                    ?>
        <script type="text/javascript">
            alert("Update Successfull.");
            console.log('$result')
            window.location = "/home.php";
        </script>
        <?php
             }               
?>