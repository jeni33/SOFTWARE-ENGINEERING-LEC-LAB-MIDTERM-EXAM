<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Client Loan</title>
    <link rel="stylesheet" href="styles.css">
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
    td, th {
    text-align: center;
    }
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>
    <a href="index.php">Return to home</a>

    <?php
    if (isset($_GET['client_id'])) {
        $client_id = $_GET['client_id'];
        $getAllInfoByClientID = getAllInfoByClientID($pdo, $client_id);

        if ($getAllInfoByClientID) {
            echo "<h1>Client: " . ($getAllInfoByClientID['loan_Client']) . "</h1>";
        } else {
            echo "<h1>No client found or query failed.</h1>";
        exit;
        }
    } else {
        echo "<h1>Client ID is missing.</h1>";
        exit; 
    }
    ?>

    <h1>Add New Loan</h1>
    <form action="core/handleForms.php?client_id=<?php echo ($client_id); ?>" method="POST">
        <p>
            <label for="loan_amount"><strong>Loan Amount: </strong></label> 
            <input type="number" name="loan_amount">
        </p>
        <p>
            <label for="interest_rate"><strong>Interest Rate: </strong></label> 
            <input type="number" name="interest_rate">
        </p>
        <p>
            <label for="loan_date"><strong>Loan Date: </strong></label> 
            <input type="datetime-local" name="loan_date">
        </p>
        <p>
            <label for="due_date"><strong>Due Date: </strong></label> 
            <input type="datetime-local" name="due_date">
        </p>
        <p>
			<label for="added_by"><strong>Added By: </strong></label> 
			<input type="text" name="added_by" required>
		</p>
		<p>
			<label for="last_updated"><strong>Last Updated: </strong></label> 
			<input type="datetime-local" name="last_updated" required>
		</p>
        <p>
            <input type="submit" name="insertNewLoanBtn">
        </p>
    </form>

    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>Loan ID</th>
            <th>Loan Amount</th>
            <th>Interest Rate</th>
            <th>Loan Date</th>
            <th>Due Date</th>
            <th>Added By</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>

        <?php
        $getLoanByClient = getLoanByClient($pdo, $client_id);
        
        if (empty($getLoanByClient)) {
            echo "<tr><td colspan='8'>No Loan found for this Client.</td></tr>";
        } else {
            foreach ($getLoanByClient as $row) { ?>
                <tr>
                    <td><?php echo ($row['loan_id']); ?></td>      
                    <td><?php echo ($row['loan_amount']); ?></td>    
                    <td><?php echo ($row['interest_rate']); ?></td>
                    <td><?php echo ($row['loan_date']); ?></td>    
                    <td><?php echo ($row['due_date']); ?></td>
                    <td><?php echo ($row['added_by']); ?></td>    
                    <td><?php echo ($row['last_updated']); ?></td>
                    <td>
                        <a href="editloan.php?loan_id=<?php echo ($row['loan_id']); ?>&client_id=<?php echo ($client_id); ?>">Edit</a>
                        <a href="deleteloan.php?loan_id=<?php echo ($row['loan_id']); ?>&client_id=<?php echo ($client_id); ?>">Delete</a>
                    </td>    
                </tr>
            <?php }
        }
        ?>
    </table>
</body>
</html>