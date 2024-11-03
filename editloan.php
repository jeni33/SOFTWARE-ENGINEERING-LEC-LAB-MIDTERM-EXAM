<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Loan</title>
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
	<a href="viewloans.php?client_id=<?php echo $_GET['client_id']; ?>">
	View the loans</a>
	<h1>Modify loan details</h1>
	<?php $getLoanByID = getLoanByID($pdo, $_GET['loan_id']); ?>
	<form action="core/handleForms.php?loan_id=<?php echo $_GET['loan_id']; ?>&client_id=<?php echo $_GET['client_id']; ?>" method="POST">
		<p>
			<label for="loan_amount"><strong>Loan Amount: </strong></label> 
			<input type="text" name="loan_amount" value="<?php echo $getLoanByID['loan_amount']; ?>">
		</p>
		<p>
			<label for="interest_rate"><strong>Interest Rate: </strong></label> 
			<input type="text" name="interest_rate" value="<?php echo $getLoanByID['interest_rate']; ?>">
		</p>
		<p>
    		<label for="loan_date"><strong>Loan Date: </strong></label> 
    		<input type="datetime-local" name="loan_date" value="<?php echo isset($getLoanByID['loan_date']) ? $getLoanByID['loan_date'] : ''; ?>">
		</p>
		<p>
    		<label for="due_date"><strong>Due Date: </strong></label> 
    		<input type="datetime-local" name="due_date" value="<?php echo isset($getLoanByID['due_date']) ? $getLoanByID['due_date'] : ''; ?>">
		</p>
		<p>
			<label for="added_by"><strong>Added By: </strong></label> 
			<input type="text" name="added_by" value="<?php echo $getLoanByID['added_by']; ?>">
		</p>
		<p>
    		<label for="last_updated"><strong>Last Updated: </strong></label> 
    		<input type="datetime-local" name="last_updated" value="<?php echo isset($getLoanByID['last_updated']) ? $getLoanByID['last_updated'] : ''; ?>">
		</p>
		<p>
			<input type="submit" name="editLoanBtn">
		</p>
	</form>
</body>
</html>