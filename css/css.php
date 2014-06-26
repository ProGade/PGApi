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
class classPG_Css extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct()
	{
		$this->setLineBreak(array('sString' => "\n"));
		$this->useLineBreak(array('bUse' => true));
	}
	
	// Methods...
	/*
	@start method
	
	@return sStyle [type]string[/type]
	[en]...[/en]
	
	@param sSize [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setRoundCorner($_sSize)
	{
		global $oPGBrowser;

		$_sSize = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'sSize', 'xParameter' => $_sSize));

		$_sStyle = '';
		$_sBrowserName = $oPGBrowser->getName();
		if ($_sBrowserName == PG_BROWSER_FIREFOX) {$_sStyle .= '-moz-border-radius:'.$_sSize.'; ';} // Mozilla
		else if ($_sBrowserName == PG_BROWSER_CHROME) {$_sStyle .= '-webkit-border-radius:'.$_sSize.'; ';} // Crome und Opera
		else if ($_sBrowserName == PG_BROWSER_SAFARI) {$_sStyle .= '-khtml-border-radius:'.$_sSize.'; ';} // Safari und Linux
		else {$_sStyle .= 'border-radius:'.$_sSize.'; ';} // CSS3
		// if ($_sBrowserName== PG_BROWSER_INTERNET_EXPLORER) {$_sStyle .= 'behavior:url(http://api.progade.de/1.00.00/htc/ie-css3.htc); ';} // Internet Explorer
		return $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsHex [type]bool[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function isHex($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_sString = trim($_sString);
		if ($_sString[0] == '#') {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function cutHexSharp($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return str_replace("#", '', $_sString);
	}
	/* @end method */
	
	/*
	@start method
	
	@return iRed [type]int[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getRedFromHex($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_sString = $this->cutHexSharp(array('sString' => $_sString));
		if (strlen($_sString) == 3) {return hexdec(substr($_sString, 0, 1).substr($_sString, 0, 1));}
		return hexdec(substr($_sString, 0, 2));
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGreen [type]int[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getGreenFromHex($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_sString = $this->cutHexSharp(array('sString' => $_sString));
		if (strlen($_sString) == 3) {return hexdec(substr($_sString, 1, 1).substr($_sString, 1, 1));}
		return hexdec(substr($_sString, 2, 2));
	}
	/* @end method */
	
	/*
	@start method
	
	@return iBlue [type]int[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getBlueFromHex($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_sString = $this->cutHexSharp(array('sString' => $_sString));
		if (strlen($_sString) == 3) {return hexdec(substr($_sString, 2, 1).substr($_sString, 2, 1));}
		return hexdec(substr($_sString, 4, 2));
	}
	/* @end method */
	
	/*
	@start method
	
	@return iRed [type]int[/type]
	[en]...[/en]
	
	@param xColor [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getRed($_xColor)
	{
		$_xColor = $this->getRealParameter(array('oParameters' => $_xColor, 'sName' => 'xColor', 'xParameter' => $_xColor));
		$_iRed = 0;
		if (is_string($_xColor))
		{
			if ($this->isHex($_xColor)) {$_iRed = $this->getRedFromHex(array('sString' => $_xColor));}
			else
			{
				$_iRed = preg_replace('/.*rgb(a){0,1}\(([0-9]+),([0-9]+),([0-9]+)\).*/is', '$2', $_xColor);
			}
		}
		else if (is_array($_xColor))
		{
			if (isset($_xColor['iRed'])) {$_iRed = $_xColor['iRed'];}
			else if (isset($_xColor['sColor'])) {$_iRed = $this->getRed(array('xColor' => $_xColor['sColor']));}
		}
		return $_iRed;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGreen [type]int[/type]
	[en]...[/en]
	
	@param xColor [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getGreen($_xColor)
	{
		$_xColor = $this->getRealParameter(array('oParameters' => $_xColor, 'sName' => 'xColor', 'xParameter' => $_xColor));
		$_iGreen = 0;
		if (is_string($_xColor))
		{
			if ($this->isHex($_xColor)) {$_iGreen = $this->getGreenFromHex(array('sString' => $_xColor));}
			else
			{
				$_iGreen = preg_replace('/.*rgb(a){0,1}\(([0-9]+),([0-9]+),([0-9]+)\).*/is', '$3', $_xColor);
			}
		}
		else if (is_array($_xColor))
		{
			if (isset($_xColor['iGreen'])) {$_iGreen = $_xColor['iGreen'];}
			else if (isset($_xColor['sColor'])) {$_iGreen = $this->getGreen(array('xColor' => $_xColor['sColor']));}
		}
		return $_iGreen;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iBlue [type]int[/type]
	[en]...[/en]
	
	@param xColor [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getBlue($_xColor)
	{
		$_xColor = $this->getRealParameter(array('oParameters' => $_xColor, 'sName' => 'xColor', 'xParameter' => $_xColor));
		$_iBlue = 0;
		if (is_string($_xColor))
		{
			if ($this->isHex($_xColor)) {$_iBlue = $this->getBlueFromHex(array('sString' => $_xColor));}
			else
			{
				$_iBlue = preg_replace('/.*rgb(a){0,1}\(([0-9]+),([0-9]+),([0-9]+)\).*/is', '$4', $_xColor);
			}
		}
		else if (is_array($_xColor))
		{
			if (isset($_xColor['iBlue'])) {$_iBlue = $_xColor['iBlue'];}
			else if (isset($_xColor['sColor'])) {$_iBlue = $this->getBlue(array('xColor' => $_xColor['sColor']));}
		}
		return $_iBlue;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHexColor [type]string[/type]
	[en]...[/en]
	
	@param iRed [needed][type]int[/type]
	[en]...[/en]
	
	@param iGreen [needed][type]int[/type]
	[en]...[/en]
	
	@param iBlue [needed][type]int[/type]
	[en]...[/en]
	*/
	public function rgbToHex($_iRed, $_iGreen = NULL, $_iBlue = NULL)
	{
		$_iGreen = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iGreen', 'xParameter' => $_iGreen));
		$_iBlue = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iBlue', 'xParameter' => $_iBlue));
		$_iRed = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iRed', 'xParameter' => $_iRed));
		return '#'.dechex($_iRed).dechex($_iGreen).dechex($_iBlue);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHexColor [type]string[/type]
	[en]...[/en]
	
	@param sOperator [needed][type]string[/type]
	[en]...[/en]
	
	@param xColor1 [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xColor2 [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function calculateColorsToHex($_sOperator, $_xColor1 = NULL, $_xColor2 = NULL)
	{
		$_xColor1 = $this->getRealParameter(array('oParameters' => $_sOperator, 'sName' => 'xColor1', 'xParameter' => $_xColor1));
		$_xColor2 = $this->getRealParameter(array('oParameters' => $_sOperator, 'sName' => 'xColor2', 'xParameter' => $_xColor2));
		$_sOperator = $this->getRealParameter(array('oParameters' => $_sOperator, 'sName' => 'sOperator', 'xParameter' => $_sOperator));

		$_iRed1 = $this->getRed(array('xColor' => $_xColor1));
		$_iGreen1 = $this->getGreen(array('xColor' => $_xColor1));
		$_iBlue1 = $this->getBlue(array('xColor' => $_xColor1));
		
		$_iRed2 = $this->getRed(array('xColor' => $_xColor2));
		$_iGreen2 = $this->getGreen(array('xColor' => $_xColor2));
		$_iBlue2 = $this->getBlue(array('xColor' => $_xColor2));

		$_iRed = max(min(eval('return '.$_iRed1.$_sOperator.$_iRed2.';'), 255), 0);
		$_iGreen = max(min(eval('return '.$_iGreen1.$_sOperator.$_iGreen2.';'), 255), 0);
		$_iBlue = max(min(eval('return '.$_iBlue1.$_sOperator.$_iBlue2.';'), 255), 0);
		
		return $this->rgbToHex(array('iRed' => $_iRed, 'iGreen' => $_iGreen, 'iBlue' => $_iBlue));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHexColor [type]string[/type]
	[en]...[/en]
	
	@param xColor1 [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xColor2 [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function addColorsToHex($_xColor1, $_xColor2 = NULL)
	{
		$_xColor2 = $this->getRealParameter(array('oParameters' => $_xColor1, 'sName' => 'xColor2', 'xParameter' => $_xColor2));
		$_xColor1 = $this->getRealParameter(array('oParameters' => $_xColor1, 'sName' => 'xColor1', 'xParameter' => $_xColor1, 'bNotNull' => true));
		return $this->calculateColorsToHex(array('xColor1' => $_xColor1, 'sOperator' => '+', 'xColor2' => $_xColor2));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHexColor [type]string[/type]
	[en]...[/en]
	
	@param xColor1 [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xColor2 [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function subColorsToHex($_xColor1, $_xColor2 = NULL)
	{
		$_xColor2 = $this->getRealParameter(array('oParameters' => $_xColor1, 'sName' => 'xColor2', 'xParameter' => $_xColor2));
		$_xColor1 = $this->getRealParameter(array('oParameters' => $_xColor1, 'sName' => 'xColor1', 'xParameter' => $_xColor1, 'bNotNull' => true));
		return $this->calculateColorsToHex(array('xColor1' => $_xColor1, 'sOperator' => '-', 'xColor2' => $_xColor2));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHexColor [type]string[/type]
	[en]...[/en]
	
	@param xColor [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getHexColor($_xColor)
	{
		$_xColor = $this->getRealParameter(array('oParameters' => $_xColor, 'sName' => 'xColor', 'xParameter' => $_xColor, 'bNotNull' => true));
		
		$_iRed = $this->getRed(array('xColor' => $_xColor));
		$_iGreen = $this->getGreen(array('xColor' => $_xColor));
		$_iBlue = $this->getBlue(array('xColor' => $_xColor));
		
		return $this->rgbToHex(array('iRed' => $_iRed, 'iGreen' => $_iGreen, 'iBlue' => $_iBlue));
	}
	/* @end method */
}
/* @end class */
$oPGCss = new classPG_Css();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCss', 'xValue' => $oPGCss));}
?>