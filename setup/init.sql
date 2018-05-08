DROP DATABASE IF EXISTS thr_malware_detect;

CREATE DATABASE thr_malware_detect;

use thr_malware_detect;

CREATE TABLE thr_users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(2000) NOT NULL,
    password CHAR(128) NOT NULL,
    salt CHAR(8) NOT NULL,
    role CHAR(5) NOT NULL,
    created TIMESTAMP
)
ENGINE MyISAM;

CREATE TABLE thr_malwares (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    signature CHAR(10) NOT NULL,
    comment TEXT(2000) NULL,
    created TIMESTAMP
)
ENGINE MyISAM;

INSERT INTO `thr_users` (`id`,`firstname`,`lastname`,`email`,`password`,`salt`,`role`) VALUES (
1, 'Jean', 'Marcellin', 'jean.marcellin@sjsu.edu', '955436287f606f449d5a1150ce5f80e8', 'tn@T2AMH', 'admin');
-- INSERT INTO `thr_malwares` (`id`,`addedBy`,`name`,`signature`, `comment`) VALUES ();
-- INSERT INTO `thr_sessions` (`id`,`userID`,`ipAddress`,`author`, `content`) VALUES ();
