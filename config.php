<?php

/**
 * Configuration for application
 *
 */

$configs = array(
    'DB' => array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'DBName' => 'thr_malware_detect',
        'options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    ),
    'App' => array(
        'base_dir' => 'malwaredetect'
    )
);



$configs['DB']['dsn'] = sprintf('mysql:host="%1$s";dbname="%2$s";', $configs['DB']['host'], $configs['DB']['DBName']);