<?php
error_reporting(0); // Set E_ALL for debuging
array_push($opts['roots'], array(
    'alias'         => 'Trash',
    'id'            => '1',
    'driver'        => 'Trash',
    'path'          => '../files/.trash/',
    'tmbURL'        => dirname($_SERVER['PHP_SELF']) . '/../files/.trash/.tmb/',
    'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
    'uploadDeny'    => array('all'),                // Recomend the same settings as the original volume that uses the trash
    'uploadAllow'   => array('image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/x-icon', 'text/plain'), // Same as above
    'uploadOrder'   => array('deny', 'allow'),      // Same as above
    'accessControl' => 'access',                    // Same as above
));
