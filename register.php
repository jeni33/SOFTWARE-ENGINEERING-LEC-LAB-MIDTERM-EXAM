<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Client Register</title>
	<style>
		body {
			font-family: "system-ui";
			background-color: #9B7EBD;
		}
	    input {
			font-size: 1.5em;
			height: 40px;
			width: 200px;
			background-color: #F3F3E0;
		}
		table, th, td {
			border:1px solid black;
		}
        input[type="submit"] {
			font-weight: bold;
		}
	</style>
</head>
<body>
	<h1>Register here!</h1>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: #3B1E54;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username"><strong>Username: </strong></label>
			<input type="text" name="username">
		</p>
		<p>
			<label for="username"><strong>Password: </strong></label>
			<input type="password" name="password">
			<input type="submit" name="registerUserBtn">
		</p>
	</form>
</body>
</html>