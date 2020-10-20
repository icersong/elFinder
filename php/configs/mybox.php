<?php
    error_reporting(0); // Set E_ALL for debuging
    array_push($opts['roots'], array(
    'alias'         => 'MyBox',
    'driver'        => 'LocalFileSystem',
    'path'          => '/srv/MyBox/',
    'URL'           => dirname($_SERVER['PHP_SELF']) . '/../files/MyBox',
    'trashHash'     => 't1_Lw',
    'winHashFix'    => DIRECTORY_SEPARATOR !== '/',
    'uploadDeny'    => array('all'),
    'uploadAllow'   => array('image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/x-icon', 'text/plain'),
    'uploadOrder'   => array('deny', 'allow'),
    'accessControl' => 'access'
));
