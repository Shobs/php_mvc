DROP DATABASE IF EXISTS thr_malware_detect;

CREATE DATABASE thr_malware_detect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use thr_malware_detect;

CREATE TABLE thr_users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(2000) NOT NULL,
    password CHAR(64) NOT NULL,
    salt CHAR(8) NOT NULL,
    role CHAR(5) NOT NULL,
    created TIMESTAMP
)
ENGINE MyISAM;

CREATE TABLE thr_malwares (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    signature CHAR(160) NOT NULL,
    comment TEXT(2000) NULL,
    created TIMESTAMP
)
ENGINE MyISAM;

# adding admin user
INSERT INTO `thr_users` (`firstname`,`lastname`,`email`,`password`,`salt`,`role`) VALUES (
'John', 'Doe', 'john@example.com', '3ccc42c9451ef18f70bc6080fa0def1a0840e456684422530326e73a75fbc5ce', 'tn@T2AMH', 'admin');
# used same salt for simplicity sake, I do have a random salt generator function in user.php model
INSERT INTO `thr_users` (`firstname`,`lastname`,`email`,`password`,`salt`,`role`) VALUES (
'Joe', 'Doe', 'doe@example.com', '3ccc42c9451ef18f70bc6080fa0def1a0840e456684422530326e73a75fbc5ce', 'tn@T2AMH', 'admin');
