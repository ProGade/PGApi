<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Random extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	/* @start method */
	public function __construct() {$this->init();}
	/* @end method */
	
	// Methods...
	/*
	@start method
	
	@return dSeed [type]double[/type]
	[en]...[/en]
	*/
	public function seed()
	{
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
	/* @end method */

	/* @start method */
	public function init()
	{
		mt_srand($this->seed());
	}
	/* @end method */
	
	/*
	@start method
	
	@return iRandom [type]int[/type]
	[en]...[/en]
	
	@param iMax [type]int[/type]
	[en]...[/en]
	
	@param iMin [type]int[/type]
	[en]...[/en]
	*/
	public function build($_iMax = NULL, $_iMin = NULL)
	{
		$_iMin = $this->getRealParameter(array('oParameters' => $_iMax, 'sName' => 'iMin', 'xParameter' => $_iMin));
		$_iMax = $this->getRealParameter(array('oParameters' => $_iMax, 'sName' => 'iMax', 'xParameter' => $_iMax));
		if (($_iMin !== NULL) && ($_iMax !== NULL)) {return mt_rand($_iMin, $_iMax);}
		else if ($_iMax !== NULL) {return mt_rand(0, $_iMax);}
		return mt_rand();
	}
	/* @end method */
}
/* @end class */
$oPGRandom = new classPG_Random();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGRandom', 'xValue' => $oPGRandom));}
?>