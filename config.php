<?php

/**
 * Configuration for application
 *
 * admin login:     doe@example.com
 * admin password:  password
 *
 * Major features are located in the following:
 * Database setup  -> setup/install.php
 * mysql script    -> setup/init.sql
 * Validation      -> models/utils.php
 * Sanitization    -> models/utils.php
 * Views           -> view folder
 * Controller      -> Controller folder
 * js              -> public/js
 * css             -> public/css
 *
 *
 * This application uses bower components that can be installed with:
 * $ bower install
 *
 * To set up the database navigate to:
 * setup/install.php
 *
 *******Routing flow******
 * .htaccess has been added that reroutes everything to index.php.
 * index.php loads db connection and layout.php that contains the
 * header, footer and call to routes.php to load the content.
 *
 * routes.php parse the uri and take the first parameter as the controller
 * to be called and the second the method from that controller
 *
 * routes.php also restricts access to the admin routes based on role,
 * logged in status and prevents session fixation
 *
 * routes.php also loads required models that will be needed in the
 * controller that parsed.
 *
 * The controller method will be just that or a call to a view.
 *
 * Downside with this implementation is that ajax is not possible due to
 * the header and footer being loaded prior to the routing.  Also currently
 * this routing system only allows for uri that are 2 levels deep i.e. admin/add
 *
 * Validation flow:
 * request calls a method from a controller where the expected inputs
 * are sanitized and validated calling static methods from the Utils class.
 *
 *
 ******Authentication flow******
 * upon logging a session is set for the user and he has access to the admin
 * side.  The password is hashed salted and checked against the database.
 *
 *
 *******Malware detection flow******
 * Admin uploads a file, name and optionally a comment into the database.
 * The file first 30 bits are hashed and stored into the database for easy storage.
 * The user can then upload a file on the home page and it's hash value with be
 * compared against the database.  This detection method is not comprehensive
 * and should not be used in real world application without serious revamp/improvement.
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

