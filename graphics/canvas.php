<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Canvas extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGCanvas'));
	}
	
	// Methods...
	/*
	@start method
	
	@return sCanvasHtml [type]string[/type]
	[en]...[/en]
	
	@param sCanvasID [type]string[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	*/
	public function build($_sCanvasID = NULL, $_iSizeX = NULL, $_iSizeY = NULL, $_sContent = NULL)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sCanvasID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sCanvasID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_sContent = $this->getRealParameter(array('oParameters' => $_sCanvasID, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_sCanvasID = $this->getRealParameter(array('oParameters' => $_sCanvasID, 'sName' => 'sCanvasID', 'xParameter' => $_sCanvasID));
		
		if ($_sCanvasID === NULL) {$_sCanvasID = $this->getNextID();}
		if ($_iSizeX === NULL) {$_iSizeX = 320;}
		if ($_iSizeY === NULL) {$_iSizeY = 240;}
		if ($_sContent === NULL) {$_sContent = '';}
		
		$_sHtml = '';
		$_sHtml .= '<canvas id="'.$_sCanvasID.'" width="'.$_iSizeX.'" height="'.$_iSizeY.'" style="background-color:#888888;">';
		$_sHtml .= $_sContent;
		$_sHtml .= '</canvas>';
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGCanvas = new classPG_Canvas();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCanvas', 'xValue' => $oPGCanvas));}
?>