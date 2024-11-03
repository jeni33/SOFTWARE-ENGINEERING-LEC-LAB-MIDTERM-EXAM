<?php  

function insertClient($pdo, $first_name, $last_name, $age, $contact_number, $client_address) {

	$sql = "INSERT INTO clients (first_name, last_name, age, 
		contact_number, client_address) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, $age,
		$contact_number, $client_address]);

	if ($executeQuery) {
		return true;
	}
}

function getAllClients($pdo) {
	$sql = "SELECT * FROM clients";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getClientByID($pdo, $client_id) {
	$sql = "SELECT * FROM clients WHERE client_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateClient($pdo, $first_name, $last_name, $age, 
	$contact_number, $client_address, $client_id) {

	$sql = "UPDATE clients
			SET first_name = ?,
				last_name = ?,
				age = ?,
				contact_number = ?,
				client_address = ?
			WHERE client_id = ?";
	
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$first_name, $last_name, $age,
		$contact_number, $client_address, $client_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteClient($pdo, $client_id) {
	$deleteClientLoan = "DELETE FROM loans WHERE client_id = ?";
	$deleteStmt = $pdo->prepare($deleteClientLoan);
	$executeDeleteQuery = $deleteStmt->execute([$client_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM clients WHERE client_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$client_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}

function getAllInfoByClientID($pdo, $client_id) {
    $sql = "SELECT CONCAT(clients.first_name,' ',clients.last_name) AS loan_Client
            FROM clients
            WHERE client_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$client_id]);
    
    if ($executeQuery) {
        $result = $stmt->fetch();
        if ($result) {
            return $result;
        } else {
            return false; 
        }
    }

    return false; 
}
	
function getLoanByClient($pdo, $client_id) {
	
	$sql = "SELECT 
				loans.loan_id AS loan_id,
				loans.loan_amount AS loan_amount,
				loans.interest_rate AS interest_rate,
				CONCAT(clients.first_name,' ',clients.last_name) AS Client,
				loans.loan_date AS loan_date,
				loans.due_date AS due_date,
				loans.added_by AS added_by,
				loans.last_updated AS last_updated
			FROM loans
			JOIN clients ON loans.client_id = clients.client_id
			WHERE loans.client_id = ? 
			GROUP BY loans.loan_amount;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertLoan($pdo, $loan_amount, $interest_rate, $loan_date, $client_id, $due_date, $added_by, $last_updated) {
    $sql = "INSERT INTO loans (loan_amount, interest_rate, loan_date, client_id, due_date, added_by, last_updated) 
            VALUES (?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$loan_amount, $interest_rate, $loan_date, $client_id, $due_date, $added_by, $last_updated]);
    
    if ($executeQuery) {
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false;
    }
}

function getLoanByID($pdo, $loan_id) {
    $sql = "SELECT 
                loans.loan_id AS loan_id,
                loans.loan_amount AS loan_amount,
                loans.interest_rate AS interest_rate,
                loans.loan_date AS loan_date,
                loans.due_date AS due_date,
				loans.added_by AS added_by,
				loans.last_updated AS last_updated,
                CONCAT(clients.first_name, ' ', clients.last_name) AS loan_Client
            FROM loans
            JOIN clients ON loans.client_id = clients.client_id
            WHERE loans.loan_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$loan_id]);
    
    if ($executeQuery) {
        $result = $stmt->fetch();
        if ($result) {
            return $result; 
        } else {
            return false; 
        }
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false;
    }
}

function updateLoan($pdo, $loan_amount, $interest_rate, $loan_date, $client_id, $due_date, $added_by, $last_updated, $loan_id) {
    $sql = "UPDATE loans
            SET loan_amount = ?,
                interest_rate = ?,
                loan_date = ?,
                client_id = ?,
                due_date = ?,
				added_by = ?,
				last_updated = ?
            WHERE loan_id = ?;";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$loan_amount, $interest_rate, $loan_date, $client_id, $due_date, $added_by, $last_updated, $loan_id]);

    if ($executeQuery) {
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false;
    }
}

function deleteLoan($pdo, $loan_id) {
    $sql = "DELETE FROM loans WHERE loan_id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$loan_id])) {
        return true;
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "SQL error: " . $errorInfo[2];
        return false; 
    }
}

function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM users_password WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO users_password (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}

function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM users_password WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM users_password";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM users_password WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

?> 