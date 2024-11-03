CREATE TABLE users_password (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50),
	password VARCHAR(50),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    age INT,
    contact_number VARCHAR(20),
    client_address VARCHAR(50),
);
CREATE TABLE loans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    loan_amount DECIMAL(10, 2),
    interest_rate DECIMAL(5, 2),
    loan_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    due_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    added_by VARCHAR(50) NOT NULL, 
    last_updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_client FOREIGN KEY (client_id) REFERENCES clients(client_id)
);
