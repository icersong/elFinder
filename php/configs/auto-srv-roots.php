<?php
error_reporting(0); // Set E_ALL for debuging


function get_root($path, $alias) {
   system('echo "'.$path.'" >> '.'/tmp/xxxx.log');
   $folder = explode('/', $path)[count(explode('/', $path)) - 1];
   system('echo "'. $folder .'" >> '.'/tmp/xxxx.log');
  //array_push($opts['roots'], array(
  return array(
    'alias'         => $alias,
    'driver'        => 'LocalFileSystem',
    'path'          => $path, 
    'URL'           => dirname($_SERVER['PHP_SELF']) . '/../files/'. $folder,
    //'trashHash'     => 't0_Lw',
    'winHashFix'    => DIRECTORY_SEPARATOR !== '/',
    //'uploadDeny'    => array('all'),
    //'uploadAllow'   => array('image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/x-icon', 'text/plain'),
    'uploadAllow'    => array('all'),
    'uploadOrder'   => array('deny', 'allow'),
    'accessControl' => 'access'
  );
}


function get_exec($cmd) {
    $buffer = "";
    $handle = popen($cmd, 'r');
    while(!feof($handle)) {
         $buffer.=fgets($handle);
    }
    pclose($handle);
    return $buffer;
}


function get_label($dev) {
    $buffer = get_exec('blkid -p '.$dev.' -s LABEL -o value');
    if (trim($buffer) !== '') {
        return trim($buffer);
    }
    return trim(get_exec("blkid -p ".$dev." -s PART_ENTRY_UUID -o value"));
}


$buffer = get_exec("mount |grep ' on /srv/'|awk -F'[ ]' '{print $1 \" \" $3}'");
foreach(explode("\n",$buffer) as $line) {
    if (trim($line) === '') { continue; }
    system('echo "'.$line.'" >> '.'/tmp/xxxx.log');
    list($dev, $path) = explode(" ", $line);
    // $label = get_label($dev);
    list($_empty_, $_root_, $label) = explode('/', $dev);
    //add_root($opts, $path, $label);
    array_push($opts['roots'], get_root($path, $label));
}
