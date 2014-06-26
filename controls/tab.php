<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 24 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Tab extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGTab'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@return sTabHtml [type]string[/type]
	[en]...[/en]
	
	@param sTabID [type]string[/type]
	[en]...[/en]
	
	@param iTabMode [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sTabID = NULL, $_iTabMode = NULL, $_sContent = NULL)
	{
		$_sHtml = '';
		
		$_sHtml .= '<div id="'.$_sTabID.'" style="overflow:hidden;">';
		
			$_sHtml .= $oPGDragAndDrop->buildDropArea(
				array(
					'sDropAreaID' => $_sTabID.'Navigation', 
					'sSizeX' => '100%', 
					'sSizeY' => '20px', 
					'iGridX' => 0, 
					'iGridY' => 0, 
					'iDropAreaType' => PG_DRAGANDDROP_AREATYPE_HORIZONTAL_LIST, 
					'iGroupID' => NULL, 
					'sContent' => NULL, 
					'sOnDrop' => NULL, 
					'xData' => NULL, 
					'iMaxDropElements' => NULL, 
					'sCssStyle' => NULL, 
					'sCssClass' => NULL
				)
			);
			
			$_sHtml .= '<div id="'.$_sTabID.'Content">';
			$_sHtml .= '</div>';
			
		$_sHtml .= '</div>';
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGTab = new classPG_Tab();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGTab', 'xValue' => $oPGTab));}
?>