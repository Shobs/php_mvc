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
    ),
    'App' => array(
        'base_dir' => 'malwaredetect',
        'root' => $_SERVER['DOCUMENT_ROOT']
    )
);

