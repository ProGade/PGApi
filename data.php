<?php
error_reporting(E_ALL | E_STRICT);
// error_reporting(0);
date_default_timezone_set('Europe/Berlin');
session_start();

define('PG_API_PATH_PHP', './');
define('PG_API_PATH_JS', 'http://testserver.local:8080/hp/PGApi/');

include(PG_API_PATH_PHP.'system/classbasics.php');
include(PG_API_PATH_PHP.'javascript/jsloader.php');
include(PG_API_PATH_PHP.'php/phploader.php');
include(PG_API_PATH_PHP.'css/cssloader.php');
include(PG_API_PATH_PHP.'include_full.php');
eval($oPGPhpLoader->build());
// include(PG_API_PATH_PHP.'auto_login.php');

$sLanguage = $oPGRegisterVars->getVar(array('sName' => 'sLanguage', 'sType' => 'string'));
$oPGApi->register(array('sName' => 'sLanguage', 'xValue' => $sLanguage));
?>