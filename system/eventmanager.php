<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 10 2012
*/
/*
@start class

@param extends classPG_ClassBascis
*/
class classPG_EventManager extends classPG_ClassBasics
{
	// Declarations...
	private $bUseDragControls = false;
	
	// Construct...
	public function __construct() {}

	// Methods...
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useDragControls($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseDragControls = true;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUse [type]bool[/type]
	[en]...[/en]
	*/
	public function isDragControls()
	{
		return $this->bUseDragControls;
	}
	/* @end method */
}
/* @end class */
$oPGEventManager = new classPG_EventManager();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGEventManager', 'xValue' => $oPGEventManager));}
?>