CREATE TABLE bas_users
(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_firstname VARCHAR(50) NOT NULL,
    user_lastname VARCHAR(50) NOT NULL,
    user_username VARCHAR(50) NOT NULL,
    user_email VARCHAR(100) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_authoritylevel INT NOT NULL DEFAULT 0,
    user_mutestatus INT NOT NULL DEFAULT 0,
    user_banstatus INT NOT NULL DEFAULT 0,
    user_registerdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_lastlogin TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
