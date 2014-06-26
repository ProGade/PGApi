<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 06 2012
*/
$axPGApi = $oPGApi->getRegistered();
foreach ($axPGApi as $sPGName => $xPGValue)
{
	if (!isset($$sName)) {$$sPGName = $xPGValue;}
}
?>