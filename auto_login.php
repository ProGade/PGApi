<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Aug 20 2012
*/
$bPGLoginSessionUsed = false;
// if ($bPGLoginUseActionLog == true) {$oPGLogin->enableActionLog();}
// if ($sPGLoginAdditionalSelect != '') {$oPGLogin->setAdditionalSelect($sPGLoginAdditionalSelect);}
// if ($iPGLoginDebugMode > 0) {$oPGLogin->setDebugMode($iPGLoginDebugMode);}

if (isset($_REQUEST['iPGLogout'])) {$oPGLogin->checkForLogOut(array('xLogout' => $_REQUEST['iPGLogout']));}
if (isset($_REQUEST['logout'])) {$oPGLogin->checkForLogOut(array('xLogout' => $_REQUEST['logout']));}
if (($oPGLogin->isGuest()) && (isset($_POST['s'.$oPGLogin->getID().'Username'])) && (isset($_POST['s'.$oPGLogin->getID().'Password'])))
{
	$bPGLoginSessionUsed = $oPGLogin->checkForLogIn(array('sUsername' => $_POST['s'.$oPGLogin->getID().'Username'], 'sPassword' => $_POST['s'.$oPGLogin->getID().'Password']));
}
if (!isset($_REQUEST['iPGLogout'])) {$oPGLogin->getCookie(array('xWasSessionUsed' => $bPGLoginSessionUsed));}
// test with: if ($oPGLogin->isUserType(PG_LOGIN_USERTYPE_USER | PG_LOGIN_USERTYPE_MODERATOR | PG_LOGIN_USERTYPE_ADMIN))
?>