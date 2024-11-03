<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Loan</title>
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
<?php $getLoanByID = getLoanByID($pdo, $_GET['loan_id']); ?>
	<h1>Are you sure you want to delete this loan?</h1>
	<div class="container" style="border-style: solid; height: 400px; background-color: #F3F3E0;">
		<h2>Loan Amount: <?php echo $getLoanByID['loan_amount'] ?></h2>
		<h2>Interest Rate: <?php echo $getLoanByID['interest_rate'] ?></h2>
		<h2>Loan Date: <?php echo $getLoanByID['loan_date'] ?></h2>
		<h2>Due Date: <?php echo $getLoanByID['due_date'] ?></h2>
		<h2>Added By: <?php echo $getLoanByID['added_by'] ?></h2>
		<h2>Last Updated: <?php echo $getLoanByID['last_updated'] ?></h2>
		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?loan_id=<?php echo $_GET['loan_id']; ?>&client_id=<?php echo $_GET['client_id']; ?>" method="POST">
				<input type="submit" name="deleteLoanBtn" value="Delete">
			</form>				
			
		</div>	

	</div>
</body>
</html>