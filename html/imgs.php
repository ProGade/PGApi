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
class classPG_Imgs extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return sImg [type]string[/type]
	[en]...[/en]
	
	@param sImgID [type]string[/type]
	[en]...[/en]
	
	@param sSource [type]string[/type]
	[en]...[/en]
	
	@param xSizeX [type]mixed[/type]
	[en]...[/en]
	
	@param xSizeY [type]mixed[/type]
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
	public function build($_sImgID = NULL, $_sSource = NULL, $_xSizeX = NULL, $_xSizeY = NULL, $_xPosX = NULL, $_xPosY = NULL, $_sPosition = NULL, $_sCssClass = NULL, $_sCssStyle = NULL, $_sOnClick = NULL, $_sOnMouseOver = NULL, $_sOnMouseOut = NULL)
	{
		global $oPGVars;
		if (isset($oPGVars))
		{
			$_xPosX = $oPGVars->cssNumber(array('xVar' => $_xPosX));
			$_xPosY = $oPGVars->cssNumber(array('xVar' => $_xPosY));
			$_xSizeX = $oPGVars->cssNumber(array('xVar' => $_xSizeX));
			$_xSizeY = $oPGVars->cssNumber(array('xVar' => $_xSizeY));
		}
		
		$_sHTML = '';
		$_sHTML .= '<img';
		if (($_sImgID !== NULL) && ($_sImgID !== '')) {$_sHTML .= ' id="'.$_sImgID.'"';}
		if (($_sSource !== NULL) && ($_sSource !== '')) {$_sHTML .= ' src="'.$_sSource.'"';}
		if (($_sOnClick !== NULL) && ($_sOnClick !== '')) {$_sHTML .= ' onclick="'.$_sOnClick.'"';}
		if (($_sOnMouseOver !== NULL) && ($_sOnMouseOver !== '')) {$_sHTML .= ' onmouseover="'.$_sOnMouseOver.'"';}
		if (($_sOnMouseOut !== NULL) && ($_sOnMouseOut !== '')) {$_sHTML .= ' onmouseout="'.$_sOnMouseOut.'"';}
		if (($_sCssClass !== NULL) && ($_sCssClass !== '')) {$_sHTML .= ' class="'.$_sCssClass.'"';}
		
		if
		(
			(($_xSizeX !== NULL) && ($_xSizeX !== ''))
			|| (($_xSizeY !== NULL) && ($_xSizeY !== ''))
			|| (($_xPosX !== NULL) && ($_xPosX !== ''))
			|| (($_xPosY !== NULL) && ($_xPosY !== ''))
			|| (($_sPosition !== NULL) && ($_sPosition !== ''))
			|| (($_sCssStyle !== NULL) && ($_sCssStyle !== ''))
		)
		{
			$_sHTML .= ' style="';
			if (($_xSizeX !== NULL) && ($_xSizeX !== '')) {$_sHTML .= 'width:'.$_xSizeX.'; ';}
			if (($_xSizeY !== NULL) && ($_xSizeY !== '')) {$_sHTML .= 'height:'.$_xSizeY.'; ';}
			if (($_xPosX !== NULL) && ($_xPosX !== '')) {$_sHTML .= 'left:'.$_xPosX.'; ';}
			if (($_xPosY !== NULL) && ($_xPosY !== '')) {$_sHTML .= 'top:'.$_xPosY.'; ';}
			if (($_sPosition !== NULL) && ($_sPosition !== '')) {$_sHTML .= 'position:'.$_sPosition.'; ';}
			if (($_sCssStyle !== NULL) && ($_sCssStyle !== '')) {$_sHTML .= ' '.$_sCssStyle;}
			$_sHTML .= '"';
		}
		
		$_sHTML .= ' />';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGImgs = new classPG_Imgs();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGImgs', 'xValue' => $oPGImgs));}
?>