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
class classPG_Google extends classPG_ClassBasics
{
}
/* @end class */
$oPGGoogle = new classPG_Google();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGGoogle', 'xValue' => $oPGGoogle));}
?>