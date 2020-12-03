<?php
error_reporting(0); // Set E_ALL for debuging


/**
 * 根据给定信息生成挂载磁盘路径的配置。
 * 每个新挂载的磁盘，都需要独立配置来完成。
 * 此函数即用来生成挂载路径的配置信息
 **/
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

/**
 * 获取命令行执行结果
 * 执行给定命令，并获取其执行过程标准输出的信息
 **/
function get_exec($cmd) {
    $buffer = "";
    $handle = popen($cmd, 'r');
    while(!feof($handle)) {
         $buffer.=fgets($handle);
    }
    pclose($handle);
    return $buffer;
}

/**
 * 获取挂载路径的"标签"名称
 **/
function get_label($dev) {
    $buffer = get_exec('blkid -p '.$dev.' -s LABEL -o value');
    if (trim($buffer) !== '') {
        return trim($buffer);
    }
    return trim(get_exec("blkid -p ".$dev." -s PART_ENTRY_UUID -o value"));
}


/**
 * 扫描所有已经挂载的路径，并根据挂载的路径生成响应的配置文件，挂载到elFinder根路径下
 **/
function get_all($opts) {
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
}

get_all($opts);
