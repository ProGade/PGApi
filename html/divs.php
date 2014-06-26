<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 16 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Divs extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return sDiv [type]string[/type]
	[en]...[/en]
	
	@param sDivID [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
	[en]...[/en]
	
	@param sOverflow [type]string[/type]
	[en]...[/en]
	
	@param xPosX [type]mixed[/type]
	[en]...[/en]
	
	@param xPosY [type]mixed[/type]
	[en]...[/en]
	
	@param sPosition [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]

	@param sOnClick [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOver [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOut [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sDivID = NULL, $_sContent = NULL, $_xSizeX = NULL, $_xSizeY = NULL, $_sOverflow = NULL, $_xPosX = NULL, $_xPosY = NULL, $_sPosition = NULL, $_sCssClass = NULL, $_sCssStyle = NULL, $_sOnClick = NULL, $_sOnMouseOver = NULL, $_sOnMouseOut = NULL)
	{
		global $oPGVars;
		if (isset($oPGVars))
		{
			$_xPosX = $oPGVars->cssNumber(array('xVar' => $_xPosX));
			$_xPosY = $oPGVars->cssNumber(array('xVar' => $_xPosY));
			$_xSizeX = $oPGVars->cssNumber(array('xVar' => $_xSizeX));
			$_xSizeY = $oPGVars->cssNumber(array('xVar' => $_xSizeY));
		}
		
		$_sDiv = '<div ';
		if (($_sDivID !== NULL) && ($_sDivID !== '')) {$_sDiv .= 'id="'.$_sDivID.'" ';}
		if (($_sOnClick !== NULL) && ($_sOnClick !== '')) {$_sHTML .= ' onclick="'.$_sOnClick.'"';}
		if (($_sOnMouseOver !== NULL) && ($_sOnMouseOver !== '')) {$_sHTML .= ' onmouseover="'.$_sOnMouseOver.'"';}
		if (($_sOnMouseOut !== NULL) && ($_sOnMouseOut !== '')) {$_sHTML .= ' onmouseout="'.$_sOnMouseOut.'"';}
		if (($_sCssClass !== NULL) && ($_sCssClass !== '')) {$_sDiv .= 'class="'.$_sCssClass.'" ';}
				
		if
		(
			(($_xSizeX !== NULL) && ($_xSizeX !== ''))
			|| (($_xSizeY !== NULL) && ($_xSizeY !== ''))
			|| (($_sOverflow !== NULL) && ($_sOverflow !== ''))
			|| (($_xPosX !== NULL) && ($_xPosX !== ''))
			|| (($_xPosY !== NULL) && ($_xPosY !== ''))
			|| (($_sPosition !== NULL) && ($_sPosition !== ''))
			|| (($_sCssStyle !== NULL) && ($_sCssStyle !== ''))
		)
		{
			$_sDiv .= 'style="';
			if (($_xSizeX !== NULL) && ($_xSizeX !== '')) {$_sDiv .= 'width:'.$_xSizeX.'; ';}
			if (($_xSizeY !== NULL) && ($_xSizeY !== '')) {$_sDiv .= 'height:'.$_xSizeY.'; ';}
			if (($_sOverflow !== NULL) && ($_sOverflow !== '')) {$_sDiv .= 'overflow:'.$_sOverflow.'; ';}
			if (($_xPosX !== NULL) && ($_xPosX !== '')) {$_sDiv .= 'left:'.$_xPosX.'; ';}
			if (($_xPosY !== NULL) && ($_xPosY !== '')) {$_sDiv .= 'top:'.$_xPosY.'; ';}
			if (($_sPosition !== NULL) && ($_sPosition !== '')) {$_sDiv .= 'position:'.$_sPosition.'; ';}
			if (($_sCssStyle !== NULL) && ($_sCssStyle !== '')) {$_sDiv .= $_sCssStyle;}
			$_sDiv .= '" ';
		}
		
		$_sDiv .= '>';
		if (($_sContent !== NULL) && ($_sContent !== '')) {$_sDiv .= $_sContent;}
		$_sDiv .= '</div>';
		return $_sDiv;
	}
	/* @end method */
}
/* @end class */
$oPGDivs = new classPG_Divs();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDivs', 'xValue' => $oPGDivs));}
?>