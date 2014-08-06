<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Feb 10 2012
*/
// Example: $asPGRegisterVars = array('myVarName1' => 'string', 'myVarName2' => 'int');
// $bPGRegisterSessions can be used to get session vars without to use the session class
if (isset($asPGRegisterVars))
{
	foreach ($asPGRegisterVars as $sPGVarName => $sPGVarType)
	{
		$$sPGVarName = NULL;
	}
}
?>