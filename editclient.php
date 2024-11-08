<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Client</title>
</head>
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
	input[type="submit"] {
			font-weight: bold;
		}
</style>
<body>
	<a href="index.php">Return to home</a>
	<?php $getClientByID = getClientByID($pdo, $_GET['client_id']); ?>
	<h1>Modify client details</h1>
	<form action="core/handleForms.php?client_id=<?php echo $_GET['client_id']; ?>" method="POST">
		<p>
			<label for="first_name"><strong>First Name:</strong></label> 
			<input type="text" name="first_name" value="<?php echo $getClientByID['first_name']; ?>">
		</p>
		<p>
			<label for="last_name"><strong>Last Name:</strong></label> 
			<input type="text" name="last_name" value="<?php echo $getClientByID['last_name']; ?>">
		</p>
		<p>
			<label for="age"><strong>Age:</strong></label> 
			<input type="number" name="age" value="<?php echo $getClientByID['age']; ?>">
		</p>
		<p>
			<label for="contact_number"><strong>Contact Number:</strong></label> 
			<input type="text" name="contact_number" value="<?php echo $getClientByID['contact_number']; ?>">
		</p>
		<p>
			<label for="client_address"><strong>Address :</strong></label> 
			<input type="text" name="client_address" value="<?php echo $getClientByID['client_address']; ?>">
		</p>
		<p>
			<input type="submit" name="editClientBtn">
		</p>
	</form>
</body>
</html>