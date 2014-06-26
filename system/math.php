<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Math extends classPG_ClassBasics
{
}
/* @end class */
$oPGMath = new classPG_Math();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMath', 'xValue' => $oPGMath));}
?>