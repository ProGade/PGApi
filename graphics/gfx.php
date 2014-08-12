<?php
/*
* ProGade API
* Copyright (c) 2014 Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 12 2014
*/

/*
@start class

@object oPGGfx

@description
[en]This class has methods to the create of images, convert color values and manage GFX packages.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen von Bildern, umrechnen von Farbwerten und verwalten von GFX Paketen.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Gfx extends classPG_ClassBasics
{
	// Declarations...
	private $sGfxBasePath = 'gfx/default/';
	private $sGfxPath = 'gfx/default/';
	private $sGfxSubPathImages = 'img/';
	// private $sGfxSubPathSecurityCode = 'securitycode/';
	private $sGfxSubPathCss = 'css/';
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the path to the default GFX package. Is used when an item in the other GFX Pack was not found.[/en]
	[de]Setzt den Pfad zum standard GFX Pack. Wird verwendet wenn ein Element im anderen GFX Pack nicht gefunden wurde.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path to the GFX package.[/en]
	[de]Der Pfad zum GFX Pack.[/de]
	*/
	public function setGfxBasePath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sGfxBasePath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the path to the default GFX package.[/en]
	[de]Gibt den Pfad zum standard GFX Pack zurück.[/de]
	
	@return sGfxPath [type]string[/type]
	[en]Returns the path to the default GFX package as a string.[/en]
	[de]Gibt den Pfad zum standard GFX Pack als String zurück.[/de]
	*/
	public function getGfxBasePath() {return $this->sGfxBasePath;}
	/* @end method */

	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the path to the GFX package.[/en]
	[de]Setzt den Pfad zum GFX Pack.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The path to the GFX package.[/en]
	[de]Der Pfad zum GFX Pack.[/de]
	*/
	public function setGfxPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sGfxPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the path to the GFX package.[/en]
	[de]Gibt den Pfad zum GFX Pack zurück.[/de]
	
	@return sGfxPath [type]string[/type]
	[en]Returns the path to the GFX package as a string.[/en]
	[de]Gibt den Pfad zum GFX Pack als String zurück.[/de]
	*/
	public function getGfxPath() {return $this->sGfxPath;}
	/* @end method */

	// Hex and RGB methods...
	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates the hex value to a RGB color value and returns it.[/en]
	[de]Berechnet den Hex Wert zu einem RGB Farbwert und gibt ihn zurück.[/de]
	
	@return sHexColor [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iRed [type]int[/type]
	[en]The red value as an integer from 0 up to 255.[/en]
	[de]Der Rot-Wert als Integer von 0 bis 255.[/de]
	
	@param iGreen [type]int[/type]
	[en]The green value as an integer from 0 up to 255.[/en]
	[de]Der Grün-Wert als Integer von 0 bis 255.[/de]
	
	@param iBlue [type]int[/type]
	[en]The blue value as an integer from 0 up to 255.[/en]
	[de]Der Blau-Wert als Integer von 0 bis 255.[/de]
	*/
	public function rgb2Hex($_iRed, $_iGreen = NULL, $_iBlue = NULL)
	{
		$_iGreen = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iGreen', 'xParameter' => $_iGreen));
		$_iBlue = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iBlue', 'xParameter' => $_iBlue));
		$_iRed = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iRed', 'xParameter' => $_iRed));
		return $this->rgbToHex(array('iRed' => $_iRed, 'iGreen' => $_iGreen, 'iBlue' => $_iBlue));
	}
	/* @end method */
	
	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates the hex value to a RGB color value and returns it.[/en]
	[de]Berechnet den Hex Wert zu einem RGB Farbwert und gibt ihn zurück.[/de]
	
	@return sHexColor [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iRed [type]int[/type]
	[en]The red value as an integer from 0 up to 255.[/en]
	[de]Der Rot-Wert als Integer von 0 bis 255.[/de]
	
	@param iGreen [type]int[/type]
	[en]The green value as an integer from 0 up to 255.[/en]
	[de]Der Grün-Wert als Integer von 0 bis 255.[/de]
	
	@param iBlue [type]int[/type]
	[en]The blue value as an integer from 0 up to 255.[/en]
	[de]Der Blau-Wert als Integer von 0 bis 255.[/de]
	*/
	public function rgbToHex($_iRed, $_iGreen = NULL, $_iBlue = NULL)
	{
		$_iGreen = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iGreen', 'xParameter' => $_iGreen));
		$_iBlue = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iBlue', 'xParameter' => $_iBlue));
		$_iRed = $this->getRealParameter(array('oParameters' => $_iRed, 'sName' => 'iRed', 'xParameter' => $_iRed));
		
		if (strlen($_iRed = dechex($_iRed)) == 1) {$_iRed = '0'.$_iRed;}
		if (strlen($_iGreen = dechex($_iGreen)) == 1) {$_iGreen = '0'.$_iGreen;}
		if (strlen($_iBlue = dechex($_iBlue)) == 1) {$_iBlue = '0'.$_iBlue;}
		
		return '#'.$_iRed.$_iGreen.$_iBlue;
	}
	/* @end method */

	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates a hex value to a Number and returns it.[/en]
	[de]Berechnet einen Hex Wert zu einer Zahl und gibt es zurück.[/de]
	
	@return sHex [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iNumber [needed][type]int[/type]
	[en]The number to be converted.[/en]
	[de]Die Zahl die umgerechnet werden soll.[/de]
	*/
	public function toHex($_iNumber)
	{
		$_iNumber = $this->getRealParameter(array('oParameters' => $_iNumber, 'sName' => 'iNumber', 'xParameter' => $_iNumber));
		return $this->numToHex(array('iNumber' => $_iNumber));
	}
	/* @end method */
	
	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates a hex value to a Number and returns it.[/en]
	[de]Berechnet einen Hex Wert zu einer Zahl und gibt es zurück.[/de]
	
	@return sHex [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iNumber [needed][type]int[/type]
	[en]The number to be converted.[/en]
	[de]Die Zahl die umgerechnet werden soll.[/de]
	*/
	public function num2Hex($_iNumber)
	{
		$_iNumber = $this->getRealParameter(array('oParameters' => $_iNumber, 'sName' => 'iNumber', 'xParameter' => $_iNumber));
		return $this->numToHex(array('iNumber' => $_iNumber));
	}
	/* @end method */
	
	/*
	@start method
	
	@group ToHex
	
	@description
	[en]Calculates a hex value to a Number and returns it.[/en]
	[de]Berechnet einen Hex Wert zu einer Zahl und gibt es zurück.[/de]
	
	@return sHex [type]string[/type]
	[en]Returns the hex value as a string.[/en]
	[de]Gibt den Hex Wert als String zurück.[/de]
	
	@param iNumber [needed][type]int[/type]
	[en]The number to be converted.[/en]
	[de]Die Zahl die umgerechnet werden soll.[/de]
	*/
	public function numToHex($_iNumber)
	{
		$_iNumber = $this->getRealParameter(array('oParameters' => $_iNumber, 'sName' => 'iNumber', 'xParameter' => $_iNumber));
		return dechex($_iNumber);
	}
	/* @end method */

	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the red value of an hex color value and returns it.[/en]
	[de]Berechnet den Rot-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iRed [type]int[/type]
	[en]Returns the red value as an integer from 0 to 255.[/en]
	[de]Gibt den Rot-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function redFromHex($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->hexToRed(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the red value of an hex color value and returns it.[/en]
	[de]Berechnet den Rot-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iRed [type]int[/type]
	[en]Returns the red value as an integer from 0 to 255.[/en]
	[de]Gibt den Rot-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function hex2Red($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->hexToRed(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the red value of an hex color value and returns it.[/en]
	[de]Berechnet den Rot-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iRed [type]int[/type]
	[en]Returns the red value as an integer from 0 to 255.[/en]
	[de]Gibt den Rot-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function hexToRed($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return hexdec(substr($this->cutHexSharp(array('sHexColor' => $_sHexColor)), 0, 2));
	}
	/* @end method */

	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the green value of an hex color value and returns it.[/en]
	[de]Berechnet den Grün-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iGreen [type]int[/type]
	[en]Returns the green value as an integer from 0 to 255.[/en]
	[de]Gibt den Grün-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function greenFromHex($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->hexToGreen(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the green value of an hex color value and returns it.[/en]
	[de]Berechnet den Grün-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iGreen [type]int[/type]
	[en]Returns the green value as an integer from 0 to 255.[/en]
	[de]Gibt den Grün-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function hex2Green($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->hexToGreen(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the green value of an hex color value and returns it.[/en]
	[de]Berechnet den Grün-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iGreen [type]int[/type]
	[en]Returns the green value as an integer from 0 to 255.[/en]
	[de]Gibt den Grün-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function hexToGreen($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return hexdec(substr($this->cutHexSharp(array('sHexColor' => $_sHexColor)), 2, 2));
	}
	/* @end method */

	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the blue value of an hex color value and returns it.[/en]
	[de]Berechnet den Blau-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iBlue [type]int[/type]
	[en]Returns the blue value as an integer from 0 to 255.[/en]
	[de]Gibt den Blau-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function blueFromHex($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->hexToBlue(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the blue value of an hex color value and returns it.[/en]
	[de]Berechnet den Blau-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iBlue [type]int[/type]
	[en]Returns the blue value as an integer from 0 to 255.[/en]
	[de]Gibt den Blau-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function hex2Blue($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->hexToBlue(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@group HexTo
	
	@description
	[en]Calculates the blue value of an hex color value and returns it.[/en]
	[de]Berechnet den Blau-Wert eines Hex-Farbwertes und gibt ihn zurück.[/de]
	
	@return iBlue [type]int[/type]
	[en]Returns the blue value as an integer from 0 to 255.[/en]
	[de]Gibt den Blau-Wert als Integer von 0 bis 255 zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The hex volor value.[/en]
	[de]Der Hex-Farbwert.[/de]
	*/
	public function hexToBlue($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return hexdec(substr($this->cutHexSharp(array('sHexColor' => $_sHexColor)), 4, 2));
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Removes the sharp from a hex color value.[/en]
	[de]Entfernt die Raute von einem Hex-Farbwert.[/de]
	
	@return sColor [type]string[/type]
	[en]Returns the hex color value as a string.[/en]
	[de]Gibt den Hex-Farbwert als String zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The color hex value, whose sharp should be removed.[/en]
	[de]Der Hex-Farbwert, dessen Raute entfernt werden soll.[/de]
	*/
	public function delHexSharp($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return $this->cutHexSharp(array('sHexColor' => $_sHexColor));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Removes the sharp from a hex color value.[/en]
	[de]Entfernt die Raute von einem Hex-Farbwert.[/de]
	
	@return sColor [type]string[/type]
	[en]Returns the hex color value as a string.[/en]
	[de]Gibt den Hex-Farbwert als String zurück.[/de]
	
	@param sHexColor [needed][type]string[/type]
	[en]The color hex value, whose sharp should be removed.[/en]
	[de]Der Hex-Farbwert, dessen Raute entfernt werden soll.[/de]
	*/
	public function cutHexSharp($_sHexColor)
	{
		$_sHexColor = $this->getRealParameter(array('oParameters' => $_sHexColor, 'sName' => 'sHexColor', 'xParameter' => $_sHexColor));
		return str_replace("#", '', $_sHexColor);
	}
	/* @end method */
	
	// Css methods...
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the css files to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die CSS-Dateien zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the css files.[/en]
	[de]Der relative Pfad zu den CSS-Dateien.[/de]
	*/
	public function setCssGfxSubPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->setGfxSubPathCss(array('sPath' => $_sPath));
	}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the css files to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die CSS-Dateien zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the css files.[/en]
	[de]Der relative Pfad zu den CSS-Dateien.[/de]
	*/
	public function setGfxSubPathCss($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sGfxSubPathCss = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the css files are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die CSS-Dateien zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the css files are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die CSS-Dateien zu finden sind.[/de]
	*/
	public function getCssGfxSubPath() {return $this->getGfxSubPathCss();}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the css files are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die CSS-Dateien zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the css files are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die CSS-Dateien zu finden sind.[/de]
	*/
	public function getGfxSubPathCss() {return $this->sGfxSubPathCss;}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@return sCssTag [type]string[/type]
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The CSS file that should be linked.[/en]
	[de]Die CSS Datei, die verlinkt werden soll.[/de]
	*/
	public function getCss($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		return $this->getCssLink(array('sFile' => $_sFile));
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@return sCssTag [type]string[/type]
	[en]Returns the CSS link tag of a css file as HTML string.[/en]
	[de]Gibt den CSS-Link-Tag zu einer CSS Datei als HTML-String zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The CSS file that should be linked.[/en]
	[de]Die CSS Datei, die verlinkt werden soll.[/de]
	*/
	public function getCssLink($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sCompletePath = $this->sGfxPath.$this->sGfxSubPathCss.$_sFile;
		if (!file_exists($_sCompletePath)) {$_sCompletePath = $this->sGfxBasePath.$this->sGfxSubPathCss.$_sFile;}
		return '<link rel="stylesheet" type="text/css" href="'.$_sCompletePath.'" />';
	}
	/* @end method */
	
	// Image methods...
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the images to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die Bilder zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the images.[/en]
	[de]Der relative Pfad zu den Bildern.[/de]
	*/
	public function setImagesPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->setGfxSubPathImages(array('sPath' => $_sPath));
	}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the images to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die Bilder zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the images.[/en]
	[de]Der relative Pfad zu den Bildern.[/de]
	*/
	public function setImagesGfxSubPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->setGfxSubPathImages(array('sPath' => $_sPath));
	}
	/* @end method */
	
	/*
	@start method
	
	@group set
	
	@description
	[en]Sets the sub path or folder for the GFX package in which are the images to find.[/en]
	[de]Setzt den Unterpfad bzw. Verzeichnis für das GFX Pack in dem die Bilder zu finden sind.[/de]
	
	@param sPath [needed][type]string[/type]
	[en]The relative path to the images.[/en]
	[de]Der relative Pfad zu den Bildern.[/de]
	*/
	public function setGfxSubPathImages($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sGfxSubPathImages = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the images are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die Bilder zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the images are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die Bilder zu finden sind.[/de]
	*/
	public function getImagesPath() {return $this->getGfxSubPathImages();}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the images are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die Bilder zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the images are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die Bilder zu finden sind.[/de]
	*/
	public function getImagesGfxSubPath() {return $this->getGfxSubPathImages();}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sub path or directory for the GFX Pack where the images are located.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack zurück in dem die Bilder zu finden sind.[/de]
	
	@return sImagesPath [type]string[/type
	[en]Returns the sub path or directory for the GFX Pack where the images are located as a string.[/en]
	[de]Gibt den Unterpfad bzw. Verzeichnis für das GFX Pack als String zurück in dem die Bilder zu finden sind.[/de]
	*/
	public function getGfxSubPathImages() {return $this->sGfxSubPathImages;}
	/* @end method */

	/*
	@start method
	
	@group Image
	
	@description
	[en]Creates an HTML string to display an image and returns it.[/en]
	[de]Erstellt einen HTML-String um ein Bild anzuzeigen und gibt ihn zurück.[/de]
	
	@return sImageHtml [type]string[/type]
	[en]Returns the image as an HTML string.[/en]
	[de]Gibt das Bild als HTML-String zurück.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The Image to display.[/en]
	[de]Das Bild, das angezeigt werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the image to display.[/en]
	[de]Die Breite in der das Bild angezeigt werden soll.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the image to display.[/en]
	[de]Die Höhe in der das Bild angezeigt werden soll.[/de]
	
	@param sTitle [type]string[/type]
	[en]The title of the image.[/en]
	[de]Der Titel des Bildes.[/de]
	
	@param sAddTag [type]string[/type]
	[en]A string that allows to add additional HTML properties.[/en]
	[de]Ein String, der es ermöglicht weitere HTML-Properties hinzuzufügen.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the image.[/en]
	[de]CSS Code für das Bild.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the image.[/en]
	[de]CSS Klasse für das Bild.[/de]
	*/
	public function loadImage($_sImage, $_xSizeX = NULL, $_xSizeY = NULL, $_sTitle = NULL, $_sAddTag = NULL, $_sCssStyle = NULL, $_sCssClass = NULL)
	{
		$_xSizeX = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'xSizeX', 'xParameter' => $_xSizeX));
		$_xSizeY = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'xSizeY', 'xParameter' => $_xSizeY));
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$_sAddTag = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sAddTag', 'xParameter' => $_sAddTag));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		return $this->img(array('sImage' => $_sImage, 'xSizeX' => $_xSizeX, 'xSizeY' => $_xSizeY, 'sTitle' => $_sTitle, 'sAddTag' => $_sAddTag, 'sCssStyle' => $_sCssStyle, 'sCssClass' => $_sCssClass));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Image
	
	@description
	[en]Creates an HTML string to display an image and returns it.[/en]
	[de]Erstellt einen HTML-String um ein Bild anzuzeigen und gibt ihn zurück.[/de]
	
	@return sImageHtml [type]string[/type]
	[en]Returns the image as an HTML string.[/en]
	[de]Gibt das Bild als HTML-String zurück.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The Image to display.[/en]
	[de]Das Bild, das angezeigt werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the image to display.[/en]
	[de]Die Breite in der das Bild angezeigt werden soll.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the image to display.[/en]
	[de]Die Höhe in der das Bild angezeigt werden soll.[/de]
	
	@param sTitle [type]string[/type]
	[en]The title of the image.[/en]
	[de]Der Titel des Bildes.[/de]
	
	@param sAddTag [type]string[/type]
	[en]A string that allows to add additional HTML properties.[/en]
	[de]Ein String, der es ermöglicht weitere HTML-Properties hinzuzufügen.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the image.[/en]
	[de]CSS Code für das Bild.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the image.[/en]
	[de]CSS Klasse für das Bild.[/de]
	*/
	public function image($_sImage, $_xSizeX = NULL, $_xSizeY = NULL, $_sTitle = NULL, $_sAddTag = NULL, $_sCssStyle = NULL, $_sCssClass = NULL)
	{
		$_xSizeX = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'xSizeX', 'xParameter' => $_xSizeX));
		$_xSizeY = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'xSizeY', 'xParameter' => $_xSizeY));
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$_sAddTag = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sAddTag', 'xParameter' => $_sAddTag));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		return $this->img(array('sImage' => $_sImage, 'xSizeX' => $_xSizeX, 'xSizeY' => $_xSizeY, 'sTitle' => $_sTitle, 'sAddTag' => $_sAddTag, 'sCssStyle' => $_sCssStyle, 'sCssClass' => $_sCssClass));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Image
	
	@description
	[en]Creates an HTML string to display an image and returns it.[/en]
	[de]Erstellt einen HTML-String um ein Bild anzuzeigen und gibt ihn zurück.[/de]
	
	@return sImageHtml [type]string[/type]
	[en]Returns the image as an HTML string.[/en]
	[de]Gibt das Bild als HTML-String zurück.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The Image to display.[/en]
	[de]Das Bild, das angezeigt werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the image to display.[/en]
	[de]Die Breite in der das Bild angezeigt werden soll.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the image to display.[/en]
	[de]Die Höhe in der das Bild angezeigt werden soll.[/de]
	
	@param sTitle [type]string[/type]
	[en]The title of the image.[/en]
	[de]Der Titel des Bildes.[/de]
	
	@param sAddTag [type]string[/type]
	[en]A string that allows to add additional HTML properties.[/en]
	[de]Ein String, der es ermöglicht weitere HTML-Properties hinzuzufügen.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the image.[/en]
	[de]CSS Code für das Bild.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the image.[/en]
	[de]CSS Klasse für das Bild.[/de]
	*/
	public function img(
		$_sImage,
		$_xSizeX = NULL,
		$_xSizeY = NULL,
		$_sTitle = NULL,
		$_sAddTag = NULL,
		$_sCssStyle = NULL,
		$_sCssClass = NULL
	)
	{
		global $oPGBrowser;

		$_xSizeX = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'xSizeX', 'xParameter' => $_xSizeX));
		$_xSizeY = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'xSizeY', 'xParameter' => $_xSizeY));
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$_sAddTag = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sAddTag', 'xParameter' => $_sAddTag));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));

		$_sHTML = '';

		$_sImagePathComplete = $this->sGfxPath.$this->sGfxSubPathImages.$_sImage;
		if (!file_exists($_sImagePathComplete)) {$_sImagePathComplete = $this->sGfxBasePath.$this->sGfxSubPathImages.$_sImage;}

		$_sProtocol = (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == '1') || (strtolower($_SERVER['HTTPS']) == 'on'))) ? 'https' : 'http';
		$_sImagePathComplete = preg_replace('!http(s){0,1}://!is', $_sProtocol.'://', $_sImagePathComplete);
		$_asPathInfo = pathinfo($_sImagePathComplete);
		$_aiSize = getimagesize($_sImagePathComplete);

		$_xSizeX = (string)$_xSizeX;
		$_xSizeY = (string)$_xSizeY;

		if (($_xSizeX == '') && ($_xSizeY == ''))
		{
			$_xSizeX = $_aiSize[0].'px';
			$_xSizeY = $_aiSize[1].'px';
		}
		else
		{
			if ($_xSizeX == '')
			{
				$_iSizeY = str_replace("px", "", $_xSizeY);
				if ((strpos($_iSizeY, "%") === false) && ($_iSizeY != '')) {$_xSizeX = round($_aiSize[0]/$_aiSize[1]*(int)$_iSizeY, 0).'px';}
				else {$_xSizeX = $_aiSize[0];}
			}
			if ($_xSizeY == '')
			{
				$_iSizeX = str_replace("px", "", $_xSizeX);
				if ((strpos($_iSizeX, "%") === false) && ($_iSizeX != '')) {$_xSizeY = round($_aiSize[1]/$_aiSize[0]*(int)$_iSizeX, 0).'px';}
				else {$_xSizeY = $_aiSize[1];}
			}
		}
		
		if ((strpos($_xSizeX, 'px') === false) && (strpos($_xSizeX, '%') === false)) {$_xSizeX .= 'px';}
		if ((strpos($_xSizeY, 'px') === false) && (strpos($_xSizeY, '%') === false)) {$_xSizeY .= 'px';}
		
		if ((($_sCssClass === '') || ($_sCssClass === NULL)) && (($_sCssStyle === '') || ($_sCssStyle === NULL))) {$_sCssStyle = 'border-width:0px; ';}
		if ((strtolower($_asPathInfo['extension']) == 'png')
		&& (strtolower($oPGBrowser->getBrowserName()) == 'internet explorer')
		&& (floor((float)$oPGBrowser->getBrowserVersion()) < 7))
		{
			$_sHTML .= '<div style="';
			$_sHTML .= 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.$_sImagePathComplete.'\', sizingMethod=\'image\'); ';
			$_sHTML .= 'width:'.$_xSizeX.'; height:'.$_xSizeY.'; '.$_sCssStyle.'" ';
			if (($_sCssClass !== '') && ($_sCssClass !== NULL)) {$_sHTML .= 'class="'.$_sCssClass.'" ';}
			if (($_sAddTag !== '') && ($_sAddTag !== NULL)) {$_sHTML .= $_sAddTag.' ';}
			if (($_sTitle !== '') && ($_sTitle !== NULL)) {$_sHTML .= 'title="'.$_sTitle.'" ';}
			$_sHTML .= 'unselectable="on"></div>';
		}
		else
		{
			$_sHTML .= '<img src="'.$_sImagePathComplete.'" style="width:'.$_xSizeX.'; height:'.$_xSizeY.'; '.$_sCssStyle.'" ';
			if (($_sCssClass !== '') && ($_sCssClass !== NULL)) {$_sHTML .= 'class="'.$_sCssClass.'" ';}
			if (($_sAddTag !== '') && ($_sAddTag !== NULL)) {$_sHTML .= $_sAddTag.' ';}
			if (($_sTitle !== '') && ($_sTitle !== NULL)) {$_sHTML .= 'title="'.$_sTitle.'" alt="'.$_sTitle.'" ';}
			$_sHTML .= 'unselectable="on" />';
		}
		return $_sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the file extension of a file.[/en]
	[de]Gibt die Dateiendung einer Datei zurück.[/de]
	
	@return sExtension [type]string[/type]
	[en]Returns the file extension of a file as a string.[/en]
	[de]Gibt die Dateiendung einer Datei als String zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file whose file extension is to be returned.[/en]
	[de]Die Datei, deren Dateiendung zurückgegeben werden soll.[/de]
	*/
	public function getImageFileExtension($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		return strtolower(str_replace(".", "", strrchr($_sFile, ".")));
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the width of a image.[/en]
	[de]Gibt die Breite eines Bildes zurück.[/de]
	
	@return iSizeX [type]int[/type]
	[en]Returns the width of a image as an integer.[/en]
	[de]Gibt die Breite eines Bildes zurück.[/de]
	
	@param xImage [needed][type]mixed[/type]
	[en]The image whose width is to be returned.[/en]
	[de]Das Bild von dem die Breite zurückgegeben werden soll.[/de]
	*/
	public function getImageSizeX($_xImage)
	{
		$_xImage = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'xImage', 'xParameter' => $_xImage));
		if (is_string($_xImage)) {return $this->getImageSizeXFromFile($_xImage);}
		else {return $this->getImageSizeXFromObject(array('oImage' => $_xImage));}
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the height of a image.[/en]
	[de]Gibt die Höhe eines Bildes zurück.[/de]
	
	@return iSizeY [type]int[/type]
	[en]Returns the height of a image as an integer.[/en]
	[de]Gibt die Höhe eines Bildes zurück.[/de]
	
	@param xImage [needed][type]mixed[/type]
	[en]The image whose height is to be returned.[/en]
	[de]Das Bild von dem die Höhe zurückgegeben werden soll.[/de]
	*/
	public function getImageSizeY($_xImage)
	{
		$_xImage = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'xImage', 'xParameter' => $_xImage));
		if (is_string($_xImage)) {return $this->getImageSizeYFromFile(array('sFile' => $_xImage));}
		else {return $this->getImageSizeYFromObject(array('oImage' => $_xImage));}
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sizes of an image.[/en]
	[de]Gibt die Größe (Maße) eines Bildes zurück.[/de]
	
	@return aiSize [type]int[][/type]
	[en]Returns the sizes of an image as an integer array.[/en]
	[de]Gibt die Größe (Maße) eines Bildes als Integer-Array zurück.[/de]
	
	@param xImage [needed][type]mixed[/type]
	[en]The image whose sizes are to be returned.[/en]
	[de]Das Bild, dessen Größe zurückgegeben werden soll.[/de]
	*/
	public function getImageSize($_xImage)
	{
		$_xImage = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'xImage', 'xParameter' => $_xImage));
		if (is_string($_xImage)) {return $this->getImageSizeFromFile(array('sFile' => $_xImage));}
		else {return $this->getImageSizeFromObject(array('oImage' => $_xImage));}
	}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the width of an image object.[/en]
	[de]Gibt die Breite eines Bild-Objekts zurück.[/de]
	
	@return iSizeX [type]int[/type]
	[en]Returns the width of an image object as an integer.[/en]
	[de]Gibt die Breite eines Bild-Objekts als Integer zurück.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object whose width should be read.[/en]
	[de]Das Bild-Objekt, dessen Breite ausgelesen werden soll.[/de]
	*/
	public function getImageSizeXFromObject($_oImage)
	{
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));
		return imagesx($_oImage);
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the height of an image object.[/en]
	[de]Gibt die Höhe eines Bild-Objekts zurück.[/de]
	
	@return iSizeY [type]int[/type]
	[en]Returns the height of an image object as an integer.[/en]
	[de]Gibt die Höhe eines Bild-Objekts als Integer zurück.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object whose height should be read.[/en]
	[de]Das Bild-Objekt, dessen Höhe ausgelesen werden soll.[/de]
	*/
	public function getImageSizeYFromObject($_oImage)
	{
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));
		return imagesy($_oImage);
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sizes of an image object.[/en]
	[de]Gibt die Größen (Maße) eines Bild-Objekts zurück.[/de]
	
	@return aiSize [type]int[][/type]
	[en]Returns the sizes of an image object as an integer array.[/en]
	[de]Gibt die Größe (Maße) eines Bild-Objekts als Integer-Array zurück.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object whose sizes should be read.[/en]
	[de]Das Bild-Objekt, dessen Größen ausgelesen werden soll.[/de]
	*/
	public function getImageSizeFromObject($_oImage)
	{
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));
		$_aiSize = array();
		$_aiSize['iSizeX'] = imagesx($_oImage);
		$_aiSize['iSizeY'] = imagesy($_oImage);
		return $_aiSize;
	}
	/* @end method */

	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the width of an image.[/en]
	[de]Gibt die Breite eines Bildes zurück.[/de]
	
	@return iSizeX [type]int[/type]
	[en]Returns the width of an image as an integer.[/en]
	[de]Gibt die Breite eines Bildes als Integer zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file (path) to the image.[/en]
	[de]Die Datei (Pfad) zum Bild.[/de]
	*/
	public function getImageSizeXFromFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_aiSize = getimagesize($_sFile);
		return $_aiSize[0];
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the height of an image.[/en]
	[de]Gibt die Höhe eines Bildes zurück.[/de]
	
	@return iSizeY [type]int[/type]
	[en]Returns the height of an image as an integer.[/en]
	[de]Gibt die Höhe eines Bildes als Integer zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file (path) to the image.[/en]
	[de]Die Datei (Pfad) zum Bild.[/de]
	*/
	public function getImageSizeYFromFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_aiSize = getimagesize($_sFile);
		return $_aiSize[1];
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns the sizes of an image.[/en]
	[de]Gibt die Größen (Maße) eines Bildes zurück.[/de]
	
	@return aiSize [type]int[][/type]
	[en]Returns the sizes of an image as an integer array.[/en]
	[de]Gibt die Größe (Maße) eines Bildes als Integer-Array zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file (path) to the image.[/en]
	[de]Die Datei (Pfad) zum Bild.[/de]
	*/
	public function getImageSizeFromFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_aiSize = getimagesize($_sFile);
		$_aiSize2 = array();
		$_aiSize2['iSizeX'] = $_aiSize[0];
		$_aiSize2['iSizeY'] = $_aiSize[1];
		return $_aiSize2;
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]Returns an image object to an image (path).[/en]
	[de]Gibt ein Bild-Objekt zu einem Bild (Pfad) zurück.[/de]
	
	@return oImage [type]object[/type]
	[en]Returns an image object to an image (path).[/en]
	[de]Gibt ein Bild-Objekt zu einem Bild (Pfad) zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file (path) to the image.[/en]
	[de]Die Datei (Pfad) zum Bild.[/de]
	*/
	public function getImageObjectFromFile($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_sFileExtension = $this->getImageFileExtension(array('sFile' => $_sFile));
		switch($_sFileExtension)
		{
			case 'gif':
				return imagecreatefromgif($_sFile);
			break;
			
			case 'jpg':
			case 'jpeg':
				return imagecreatefromjpeg($_sFile);
			break;
			
			case 'png':
				return imagecreatefrompng($_sFile);
			break;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Save
	
	@description
	[en]Saves an image object as an image file.[/en]
	[de]Speichert ein Bild-Objekt als eine Bild Datei.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns an boolean whether the save was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object whose should be saved.[/en]
	[de]Das Bild-Objekt, welches gespeichert werden soll.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file (path) where the image should be saved.[/en]
	[de]Die Datei (Pfad) wo das Bild gespeichert werden soll.[/de]
	
	@param iQuality [type]int[/type]
	[en]The quality at compression of an JPG file.[/en]
	[de]Die Qualität beim Komprimieren von JPG Dateien.[/de]
	*/
	public function saveImageObjectToFile($_oImage, $_sFile = NULL, $_iQuality = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_iQuality = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));
		
		$_sFileExtension = $this->getImageFileExtension(array('sFile' => $_sFile));
		switch($_sFileExtension)
		{
			case 'gif':
				return imagegif($_oImage, $_sFile);
			break;
			
			case 'jpg':
			case 'jpeg':
				if (($_iQuality == 0) || ($_iQuality == NULL)) {$_iQuality = 100;}
				return imagejpeg($_oImage, $_sFile, $_iQuality);
			break;
			
			case 'png':
				return imagepng($_oImage, $_sFile);
			break;
		}
		return false;
	}
	/* @end method */

	/*
	@start method

	@param sImageBinary [needed][type]string[/type]
	[en]...[/en]

	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function saveImageBinaryToFile($_sImageBinary, $_sFile = NULL) // , $_iQuality = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sImageBinary, 'sName' => 'sFile', 'xParameter' => $_sFile));
		// $_iQuality = $this->getRealParameter(array('oParameters' => $_sImageBinary, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_sImageBinary = $this->getRealParameter(array('oParameters' => $_sImageBinary, 'sName' => 'sImageBinary', 'xParameter' => $_sImageBinary));

		if ($_oFileHandle = fopen($_sFile, 'wb'))
		{
			fwrite($_oFileHandle, $_sImageBinary);
			fclose($_oFileHandle);
			return true;
		}
		return false;
	}
	/* @end method */

	public function rotateImage($_xImage, $_fDegrees = NULL)
	{
		$_fDegrees = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'fDegrees', 'xParameter' => $_fDegrees));
		$_xImage = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'xImage', 'xParameter' => $_xImage));
		if (is_string($_xImage)) {return $this->rotateImageFileToObject(array('sFile' => $_xImage, 'fDegrees' => $_fDegrees));}
		else {return $this->rotateImageObject(array('oImage' => $_xImage, 'fDegrees' => $_fDegrees));}
	}

	public function rotateImageObject($_oImage, $_fDegrees = NULL)
	{
		$_fDegrees = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'fDegrees', 'xParameter' => $_fDegrees));
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));
		return imagerotate($_oImage, $_fDegrees, $_iBackgroundColor = 0, $_iIgnoreTransparent = 0);
	}

	public function rotateImageFileToObject($_sFile, $_fDegrees = NULL)
	{
		$_fDegrees = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'fDegrees', 'xParameter' => $_fDegrees));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_oImage = $this->getImageObjectFromFile(array('sFile' => $_sFile)))
		{
			$_oImage = $this->rotateImageObject(array('oImage' => $_oImage, 'fDegrees' => $_fDegrees));
			return $this->saveImageObjectToFile(array('oImage' => $_oImage, $_sFile, 100));
		}
		return false;
	}

	/*
	@start method
	
	@group Resize
	
	@description
	[en]Resizes an image file or image object and returns it as an image object.[/en]
	[de]Ändert die Größe (Maße) einer Bilddatei oder eines Bild-Objekts und gibt es als ein Bild-Objekt zurück.[/de]
	
	@return oImage [type]object[/type]
	[en]Returns an image object.[/en]
	[de]Gibt ein Bild-Objekt zurück.[/de]
		
	@param oImage [needed][type]object[/type]
	[en]Returns the image object.[/en]
	[de]Gibt das Bild-Objekt zurück.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	*/
	public function resizeImage($_xImage, $_iSizeX = NULL, $_iSizeY = NULL)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_xImage = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'xImage', 'xParameter' => $_xImage));
		if (is_string($_xImage)) {return $this->resizeImageFileToObject(array('sFile' => $_xImage, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY));}
		else {return $this->resizeImageObject(array('oImage' => $_xImage, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY));}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Resize
	
	@description
	[en]Resizes an image file or image object and saves it as an image file.[/en]
	[de]�ndert die Größe (Maße) einer Bilddatei oder eines Bild-Objekts und speichert es als Bilddatei.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns an boolean whether the save was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param xImage [needed][type]mixed[/type]
	[en]The image (source) as image file or image object.[/en]
	[de]Das Bild (Quelle) als Bilddatei oder Bild-Objekt.[/de]

	@param sFile [needed][type]string[/type]
	[en]The file path where the image should be saved.[/en]
	[de]Der Dateipfad unter dem das Bild gespeichert werden soll.[/de]

	@param iSizeX [type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	
	@param iQuality [type]int[/type]
	[en]The quality at compression of an JPG file.[/en]
	[de]Die Qualität beim Komprimieren von JPG Dateien.[/de]
	*/
	public function resizeImageAndSave($_xImage, $_sFile = NULL, $_iSizeX = NULL, $_iSizeY = NULL, $_iQuality = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iQuality = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_xImage = $this->getRealParameter(array('oParameters' => $_xImage, 'sName' => 'xImage', 'xParameter' => $_xImage));
		if (is_string($_xImage)) {return $this->resizeImageFileToFile(array('sFromFile' => $_xImage, 'sToFile' =>  $_sFile, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY, 'iQuality' => $_iQuality));}
		else {return $this->resizeImageObjectToFile(array('oImage' => $_xImage, 'sFile' => $_sFile, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY, 'iQuality' => $_iQuality));}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Resize
	
	@description
	[en]Resizes an image object.[/en]
	[de]Ändert die Größe (Maße) eines Bild-Objekts.[/de]
	
	@return oImage [type]object[/type]
	[en]Returns an image object.[/en]
	[de]Gibt ein Bild-Objekt zurück.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object which is to resize.[/en]
	[de]Das Bild-Objekt, dessen Größe verändert werden soll.[/de]
	
	@param iSizeX [needed][type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	*/
	public function resizeImageObject($_oImage, $_iSizeX = NULL, $_iSizeY = NULL)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));

		$_iFromSizeX = imagesx($_oImage);
		$_iFromSizeY = imagesy($_oImage);

		if ((($_iSizeX === 0) && ($_iSizeY === 0))
		|| (($_iSizeX === NULL) && ($_iSizeY === NULL)))
		{
			$_iSizeX = $_iFromSizeX;
			$_iSizeY = $_iFromSizeY;
		}
		else
		{
			if (($_iSizeX === 0) || ($_iSizeX === NULL)) {$_iSizeX = round($_iFromSizeX/$_iFromSizeY*$_iSizeY, 0);}
			if (($_iSizeY === 0) || ($_iSizeY === NULL)) {$_iSizeY = round($_iFromSizeY/$_iFromSizeX*$_iSizeX, 0);}
		}

		if ($_oNewPicture = imagecreatetruecolor($_iSizeX, $_iSizeY))
		{
			if (imagecopyresampled($_oNewPicture, $_oImage, 0, 0, 0, 0, $_iSizeX, $_iSizeY, $_iFromSizeX, $_iFromSizeY))
			{
				return $_oNewPicture;
			} // if imagecopyresampled()
		} // if imagecreatetruecolor()
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Resize
	
	@description
	[en]Resizes an image file and returns it as an image object.[/en]
	[de]�ndert die Größe (Maße) einer Bilddatei und gibt es als Bild-Objekt zurück.[/de]
	
	@return oImage [type]object[/type]
	[en]Returns an image object.[/en]
	[de]Gibt ein Bild-Objekt zurück.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The image file which is to resize.[/en]
	[de]Das Bilddatei, dessen Größe verändert werden soll.[/de]
	
	@param iSizeX [needed][type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	*/
	public function resizeImageFileToObject($_sFile, $_iSizeX = NULL, $_iSizeY = NULL)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_oImage = $this->getImageObjectFromFile(array('sFile' => $_sFile)))
		{
			$_oImage2 = $this->resizeImageObject(array('oImage' => $_oImage, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY));
			imagedestroy($_oImage);
			return $_oImage2;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Resize
	
	@description
	[en]Resizes an image object and saves it as an image file.[/en]
	[de]�ndert die Größe (Maße) eines Bild-Objekts und speichert es als Bilddatei.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns an boolean whether the save was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object (source) which is to resize.[/en]
	[de]Das Bild-Objekt (Quelle), dessen Größe verändert werden soll.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The file path where the image should be saved.[/en]
	[de]Der Dateipfad unter dem das Bild gespeichert werden soll.[/de]
	
	@param iSizeX [needed][type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]

	@param iQuality [type]int[/type]
	[en]The quality at compression of an JPG file.[/en]
	[de]Die Qualität beim Komprimieren von JPG Dateien.[/de]
	*/
	public function resizeImageObjectToFile($_oImage, $_sFile = NULL, $_iSizeX = NULL, $_iSizeY = NULL, $_iQuality = NULL)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iQuality = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));

		$_bReturn = false;
		if ($_oImage2 = $this->resizeImageObject(array('oImage' => $_oImage, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY)))
		{
			$_bReturn = $this->saveImageObjectToFile(array('oImage' => $_oImage2, 'sFile' => $_sFile, 'iQuality' => $_iQuality));
			imagedestroy($_oImage2);
		}
		return $_bReturn;
	}
	/* @end method */

	/*
	@start method
	
	@group Resize
	
	@description
	[en]Resizes an image file and saves it as an image file.[/en]
	[de]Ändert die Größe (Maße) einer Bilddatei und speichert es als Bilddatei.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns an boolean whether the save was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param sFromFile [needed][type]string[/type]
	[en]The image file (source) which is to resize.[/en]
	[de]Das Bilddatei (Quelle), dessen Größe verändert werden soll.[/de]
	
	@param sToFile [needed][type]string[/type]
	[en]The file path where the image should be saved.[/en]
	[de]Der Dateipfad unter dem das Bild gespeichert werden soll.[/de]
	
	@param iSizeX [needed][type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iSizeY [needed][type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]

	@param iQuality [type]int[/type]
	[en]The quality at compression of an JPG file.[/en]
	[de]Die Qualität beim Komprimieren von JPG Dateien.[/de]
	*/
	public function resizeImageFileToFile($_sFromFile, $_sToFile = NULL, $_iSizeX = NULL, $_iSizeY = NULL, $_iQuality = NULL)
	{
		$_sToFile = $this->getRealParameter(array('oParameters' => $_sFromFile, 'sName' => 'sToFile', 'xParameter' => $_sToFile));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sFromFile, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sFromFile, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iQuality = $this->getRealParameter(array('oParameters' => $_sFromFile, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_sFromFile = $this->getRealParameter(array('oParameters' => $_sFromFile, 'sName' => 'sFromFile', 'xParameter' => $_sFromFile));

		$_bReturn = false;
		if ($_oImage = $this->getImageObjectFromFile(array('sFile' => $_sFromFile)))
		{
			if ($_oImage2 = $this->resizeImageObject(array('oImage' => $_oImage, 'iSizeX' => $_iSizeX, 'iSizeY' => $_iSizeY)))
			{
				$_bReturn = $this->saveImageObjectToFile(array('oImage' => $_oImage2, 'sFile' => $_sToFile, 'iQuality' => $_iQuality));
				imagedestroy($_oImage2);
			}
			imagedestroy($_oImage);
		}
		return $_bReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]Resizes an image object and places it on an other image object.[/en]
	[de]Verändert die Größe (Maße) eines Bild-Objekts und platziert es auf ein anderes Bild-Objekt.[/de]
	
	@return oImage [type]object[/type]
	[en]Returns the final image object.[/en]
	[de]Gibt das finale Bild-Objekt zurück.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object on which the other image object should be placed.[/en]
	[de]Das Bild-Objekt, auf dem das andere Bild-Objekt platziert werden soll.[/de]
	
	@param oImageToAdd [needed][type]object[/type]
	[en]The image object whose sizes is to be changed and should be placed.[/en]
	[de]Das Bild-Objekt dessen Größe (Maße) verändert werden soll und das platziert werden soll.[/de]
	
	@param iAddSizeX [type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iAddSizeY [type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	*/
	public function imageObjectAddResizedImageObject($_oImage, $_oImageToAdd = NULL, $_iAddSizeX = NULL, $_iAddSizeY = NULL)
	{
		$_oImageToAdd = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImageToAdd', 'xParameter' => $_oImageToAdd));
		$_iAddSizeX = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iAddSizeX', 'xParameter' => $_iAddSizeX));
		$_iAddSizeY = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iAddSizeY', 'xParameter' => $_iAddSizeY));
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));

		$_iFromSizeX = imagesx($_oImageToAdd);
		$_iFromSizeY = imagesy($_oImageToAdd);

		if ((($_iAddSizeX == 0) && ($_iAddSizeY == 0))
		|| (($_iAddSizeX == NULL) && ($_iAddSizeY == NULL)))
		{
			$_iAddSizeX = $_iFromSizeX;
			$_iAddSizeY = $_iFromSizeY;
		}
		else
		{
			if (($_iAddSizeX == 0) || ($_iAddSizeX == NULL)) {$_iAddSizeX = round($_iFromSizeX/$_iFromSizeY*$_iAddSizeY, 0);}
			if (($_iAddSizeY == 0) || ($_iAddSizeY == NULL)) {$_iAddSizeY = round($_iFromSizeY/$_iFromSizeX*$_iAddSizeX, 0);}
		}
		if (imagecopyresampled($_oImage, $_oImageToAdd, 0, 0, 0, 0, $_iAddSizeX, $_iAddSizeY, $_iFromSizeX, $_iFromSizeY))
		{
			return $_oImage;
		} // if imagecopyresampled()
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]Resizes an image file and places it on an other image object.[/en]
	[de]Verändert die Größe (Maße) einer Bilddatei und platziert sie auf ein anderes Bild-Objekt.[/de]
	
	@return oImage [type]object[/type]
	[en]Returns the final image object.[/en]
	[de]Gibt das finale Bild-Objekt zurück.[/de]
	
	@param oImage [needed][type]object[/type]
	[en]The image object on which the other image object should be placed.[/en]
	[de]Das Bild-Objekt, auf dem das andere Bild-Objekt platziert werden soll.[/de]
	
	@param sFileToAdd [needed][type]string[/type]
	[en]The image file whose sizes is to be changed and should be placed.[/en]
	[de]Die Bilddatei dessen Größe (Maße) verändert werden soll und das platziert werden soll.[/de]
	
	@param iAddSizeX [type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iAddSizeY [type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	*/
	public function imageObjectAddResizedImageFile($_oImage, $_sFileToAdd = NULL, $_iAddSizeX = NULL, $_iAddSizeY = NULL)
	{
		$_sFileToAdd = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'sFileToAdd', 'xParameter' => $_sFileToAdd));
		$_iAddSizeX = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iAddSizeX', 'xParameter' => $_iAddSizeX));
		$_iAddSizeY = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'iAddSizeY', 'xParameter' => $_iAddSizeY));
		$_oImage = $this->getRealParameter(array('oParameters' => $_oImage, 'sName' => 'oImage', 'xParameter' => $_oImage));

		if ($_oImageToAdd = $this->getImageObjectFromFile(array('sFile' => $_sFileToAdd)))
		{
			$_oImage = $this->imageObjectAddResizedImageObject(array('oImage' => $_oImage, 'oImageToAdd' => $_oImageToAdd, 'iAddSizeX' => $_iAddSizeX, 'iAddSizeY' => $_iAddSizeY));
			imagedestroy($_oImageToAdd);
			return $_oImage;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]Resizes an image object and places it on an other image file and saves it.[/en]
	[de]Verändert die Größe (Maße) eines Bild-Objekts, platziert es auf eine andere Bilddatei und speichert sie.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns an boolean whether the save was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The image file on which the other image object should be placed.[/en]
	[de]Die Bilddatei, auf dem das andere Bild-Objekt platziert werden soll.[/de]
	
	@param oImageToAdd [needed][type]object[/type]
	[en]The image object whose sizes is to be changed and should be placed.[/en]
	[de]Das Bild-Objekt dessen Größe (Maße) verändert werden soll und das platziert werden soll.[/de]
	
	@param iAddSizeX [type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iAddSizeY [type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	
	@param iQuality [type]int[/type]
	[en]The quality at compression of an JPG file.[/en]
	[de]Die Qualität beim Komprimieren von JPG Dateien.[/de]
	*/
	public function imageFileAddResizedImageObject($_sFile, $_oImageToAdd = NULL, $_iAddSizeX = NULL, $_iAddSizeY = NULL, $_iQuality = NULL)
	{
		$_oImageToAdd = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'oImageToAdd', 'xParameter' => $_oImageToAdd));
		$_iAddSizeX = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iAddSizeX', 'xParameter' => $_iAddSizeX));
		$_iAddSizeY = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iAddSizeY', 'xParameter' => $_iAddSizeY));
		$_iQuality = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		$_bReturn = false;
		if ($_oImage = $this->getImageObjectFromFile(array('sFile' => $_sFile)))
		{
			$_oImage = $this->imageObjectAddResizedImageObject(array('oImage' => $_oImage, 'oImageToAdd' => $_oImageToAdd, 'iAddSizeX' => $_iAddSizeX, 'iAddSizeY' => $_iAddSizeY));
			$_bReturn = $this->saveImageObjectToFile(array('oImage' => $_oImage, 'sFile' => $_sFile, 'iQuality' => $_iQuality));
			imagedestroy($_oImage);
		}
		return $_bReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Add
	
	@description
	[en]Resizes an image file and places it on an other image file and saves it.[/en]
	[de]Verändert die Größe (Maße) einer Bilddatei, platziert sie auf eine andere Bilddatei und speichert sie.[/de]
	
	@return bSuccess [type]bool[/type]
	[en]Returns an boolean whether the save was successful.[/en]
	[de]Gibt einen Boolean zurück, ob das Speichern erfolgreich war.[/de]
	
	@param sFile [needed][type]string[/type]
	[en]The image file on which the other image file should be placed.[/en]
	[de]Die Bilddatei, auf dem die andere Bilddatei platziert werden soll.[/de]
	
	@param sFileToAdd [needed][type]string[/type]
	[en]The image file whose sizes is to be changed and should be placed.[/en]
	[de]Die Bilddatei dessen Größe (Maße) verändert werden soll und das platziert werden soll.[/de]
	
	@param iAddSizeX [type]int[/type]
	[en]The width for the image.[/en]
	[de]Die Breite für das Bild.[/de]
	
	@param iAddSizeY [type]int[/type]
	[en]The height for the image.[/en]
	[de]Die Höhe für das Bild.[/de]
	
	@param iQuality [type]int[/type]
	[en]The quality at compression of an JPG file.[/en]
	[de]Die Qualität beim Komprimieren von JPG Dateien.[/de]
	*/
	public function imageFileAddResizedFile($_sFile, $_sFileToAdd = NULL, $_iAddSizeX = NULL, $_iAddSizeY = NULL, $_iQuality = NULL)
	{
		$_sFileToAdd = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFileToAdd', 'xParameter' => $_sFileToAdd));
		$_iAddSizeX = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iAddSizeX', 'xParameter' => $_iAddSizeX));
		$_iAddSizeY = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iAddSizeY', 'xParameter' => $_iAddSizeY));
		$_iQuality = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'iQuality', 'xParameter' => $_iQuality));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		$_bReturn = false;
		if ($_oImage = $this->getImageObjectFromFile(array('sFile' => $_sFile)))
		{
			if ($_oImageToAdd = $this->getImageObjectFromFile(array('sFile' => $_sFileToAdd)))
			{
				$_oImage = $this->imageObjectAddResizedImageObject(array('oImage' => $_oImage, 'oImageToAdd' => $_oImageToAdd, 'iAddSizeX' => $_iAddSizeX, 'iAddSizeY' => $_iAddSizeY));
				$_bReturn = $this->saveImageObjectToFile(array('oImage' => $_oImage, 'sFile' => $_sFile, 'iQuality' => $_iQuality));
				imagedestroy($_oImageToAdd);
			}
			imagedestroy($_oImage);
		}
		return $_bReturn;
	}
	/* @end method */
	
	// Dynamic Image creation...
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sImgHtml [type]string[/type]
	[en]...[/en]
	
	@param sImageID [needed][type]string[/type]
	[en]...[/en]
	
	@param sImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param sOriginImageFile [needed][type]string[/type]
	[en]...[/en]
	
	@param axData [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function buildSecretImage($_sImageID, $_sImagePhpPath = NULL, $_sOriginImageFile = NULL, $_axData = NULL, $_sCssClass = NULL, $_sCssStyle = NULL)
	{
		global $oPGImgs;

		$_sImagePhpPath = $this->getRealParameter(array('oParameters' => $_sImageID, 'sName' => 'sImagePhpPath', 'xParameter' => $_sImagePhpPath));
		$_sOriginImageFile = $this->getRealParameter(array('oParameters' => $_sImageID, 'sName' => 'sOriginImageFile', 'xParameter' => $_sOriginImageFile));
		$_axData = $this->getRealParameter(array('oParameters' => $_sImageID, 'sName' => 'axData', 'xParameter' => $_axData));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sImageID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sImageID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sImageID = $this->getRealParameter(array('oParameters' => $_sImageID, 'sName' => 'sImageID', 'xParameter' => $_sImageID));

		if (isset($oPGImgs))
		{
			$_sSource = $_sImagePhpPath.'?x='.$this->buildSecretImageData(array('sOriginImageFile' => $_sOriginImageFile, 'axData' => $_axData));
			return $oPGImgs->build(array('sImageID' => $_sImageID, 'sSource' => $_sSource, 'sCssClass' => $_sCssClass, 'sCssStyle' => $_sCssStyle));
		}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Build
	
	@description
	[en]...[/en]
	
	@return sData [type]string[/type]
	[en]...[/en]
	
	@param sOriginImageFile [needed][type]string[/type]
	[en]...[/en]
	
	@param axData [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function buildSecretImageData($_sOriginImageFile, $_axData = NULL)
	{
		$_axData = $this->getRealParameter(array('oParameters' => $_sOriginImageFile, 'sName' => 'axData', 'xParameter' => $_axData));
		$_sOriginImageFile = $this->getRealParameter(array('oParameters' => $_sOriginImageFile, 'sName' => 'sOriginImageFile', 'xParameter' => $_sOriginImageFile));

		$_sSecretData = 'img:*:'.$_sOriginImageFile;
		if ($_axData !== NULL)
		{
			foreach ($_axData as $_sVariable => $_xValue)
			{
				$_sSecretData .= ';*;';
				$_sSecretData .= $_sVariable.':*:'.$_xValue;
			}
		}
		return $this->encodeSecretImageData(array('sSecretData' => $_sSecretData));
	}
	/* @end method */
	
	/*
	@start method
	
	@group get
	
	@description
	[en]...[/en]
	
	@return axData [type]mixed[][/type]
	[en]...[/en]
	
	@param sSecretData [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getSecretImageData($_sSecretData)
	{
		$_sSecretData = $this->getRealParameter(array('oParameters' => $_sSecretData, 'sName' => 'sSecretData', 'xParameter' => $_sSecretData));

		$_axSecretData = array();
		$_axSecretData2 = explode(';*;', $_sSecretData);
		for ($i=0; $i<count($_axSecretData2); $i++)
		{
			$_axSecretData3 = explode(':*:', $_axSecretData2[$i]);
			$_axSecretData[$_axSecretData3[0]] = $_axSecretData3[1];
		}
		return $_axSecretData;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sEncodedData [type]string[/type]
	[en]...[/en]
	
	@param sSecretData [needed][type]string[/type]
	[en]...[/en]
	*/
	public function encodeSecretImageData($_sSecretData)
	{
		$_sSecretData = $this->getRealParameter(array('oParameters' => $_sSecretData, 'sName' => 'sSecretData', 'xParameter' => $_sSecretData));
		return str_replace('=', '|', base64_encode(base64_encode($_sSecretData)));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sDecodedData [type]string[/type]
	[en]...[/en]
	
	@param sEncodedSecretData [type]string[/type]
	[en]...[/en]
	*/
	public function decodeSecretImageData($_sEncodedSecretData)
	{
		$_sEncodedSecretData = $this->getRealParameter(array('oParameters' => $_sEncodedSecretData, 'sName' => 'sEncodedSecretData', 'xParameter' => $_sEncodedSecretData));
		return base64_decode(base64_decode(str_replace('|', '=', $_sEncodedSecretData)));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sSecretData [needed][type]string[/type]
	[en]...[/en]
	
	@param iKompression [type]int[/type]
	[en]...[/en]
	
	@param iScale [type]int[/type]
	[en]...[/en]
	*/
	public function putSecretImage($_sSecretData, $_iCompression = NULL, $_iScale = NULL)
	{
		$_iCompression = $this->getRealParameter(array('oParameters' => $_sSecretData, 'sName' => 'iCompression', 'xParameter' => $_iCompression));
		$_iScale = $this->getRealParameter(array('oParameters' => $_sSecretData, 'sName' => 'iScale', 'xParameter' => $_iScale));
		$_sSecretData = $this->getRealParameter(array('oParameters' => $_sSecretData, 'sName' => 'sSecretData', 'xParameter' => $_sSecretData));
		
		header('Content-type: image/jpeg');
		
		if ($_iCompression === NULL) {$_iCompression = 100;}
		if ($_iScale === NULL) {$_iScale = 1;}
	
		$_axSecretData = $this->getSecretImageData(array('sSecretData' => $_sSecretData));
		$_sImagePath = $this->sGfxPath.$this->sGfxSubPathImages.$_axSecretData['img'];
		if (!file_exists($_sImagePath)) {$_sImagePath = $this->sGfxBasePath.$this->sGfxSubPathImages.$_axSecretData['img'];}
		$_aiImageSize = getimagesize($_sImagePath);
		
		$_iOriginSizeX = $_aiImageSize[0];
		$_iOriginSizeY = $_aiImageSize[1];
		
		$_iScaledSizeX = ceil($_iOriginSizeX*$_iScale);
		$_iScaledSizeY = ceil($_iOriginSizeY*$_iScale);

		if ($_oNewImage = imagecreatetruecolor($_iScaledSizeX, $_iScaledSizeY))
		{
			// generate code image...
			if ($_oNumberImage = imagecreatefromjpeg($_sImagePath))
			{
				imagecopyresized($_oNewImage, $_oNumberImage, 0, 0, 0, 0, $_iScaledSizeX, $_iScaledSizeY, $_iOriginSizeX, $_iOriginSizeY);
			}

			// output code image...
			imagejpeg($_oNewImage, '', $_iCompression);
			imagedestroy($_oNewImage);
		}
		clearstatcache();
	}
	/* @end method */
}
/* @end class */
$oPGGfx = new classPG_Gfx();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGGfx', 'xValue' => $oPGGfx));}
?>