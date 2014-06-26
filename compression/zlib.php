<?php
/*
* ProGade API
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
*
* Last changes of this file: Aug 20 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_ZLib extends classPG_ClassBasics
{
}
/* @end class */
$oPGZLib = new classPG_ZLib();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGZLib', 'xValue' => $oPGZLib));}
?>