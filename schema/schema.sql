CREATE TABLE cashier (
    cashier_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(128) NOT NULL,
    last_name VARCHAR(128) NOT NULL,
    user_email VARCHAR(256) UNIQUE NOT NULL,
    user_password TEXT NOT NULL,
    user_role ENUM('admin', 'superadmin') NOT NULL,
    user_status ENUM('normal', 'suspended') NOT NULL DEFAULT 'normal',
    contact_number VARCHAR(16),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE inventory (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(256) NOT NULL,
    item_image TEXT,
    price INT NOT NULL,
    added_by INT NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transactions (
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    item_quantity INT NOT NULL,
    date_transacted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO cashier (first_name, last_name, user_email, user_password, user_role, contact_number) VALUES ('Admin', 'Super', 'superadmin@email.com', '$2y$10$.wXbyp8Xm6wO2oDyPFSy7u/2P.OubagCCpZvm7g8gmeZDN1dRU8C2', 'superadmin', '0912 345 6789')