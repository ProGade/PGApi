<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 09 2012
*/
/*
@start class

@description
[en]This class has methods to the create and display HTML alements as popups.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen und anzeigen von HTML-Elementen als Popup.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Popup extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGPopup'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Builds an popup HTML element.[/en]
	[de]Erstellt ein Popup HTML-Element.[/de]
	
	@return sPopupHtml [type]string[/type]
	[en]Returns the popup as an HTML string.[/en]
	[de]Gibt das Popup als HTML String zurück.[/de]
	
	@param sPopupID [type]string[/type]
	[en]The ID of the popup.[/en]
	[de]Die ID des Popups.[/de]
	
	@param sContent [type]string[/type]
	[en]The content for the popup.[/en]
	[de]Der Inhalt für das Popup.[/de]
	
	@param iSizeX [type]int[/type]
	[en]The width of the popup.[/en]
	[de]Die Breite des Popups.[/de]
	
	@param iSizeY [type]int[/type]
	[en]The height of the popup.[/en]
	[de]Die Höhe des Popups.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (Z-index) where the popup should be displayed.[/en]
	[de]Die Ebene (Z-Index) auf der das Popup dargestellt werden soll.[/de]
	
	@param iOverlayAlpha [type]int[/type]
	[en]The transparency of the background where the popup will be displayed. The background is darkened.[/en]
	[de]Die Transparenz für den Hintergrund worauf das Popup dargestellt werden soll. Der Hintergrund wird abgedunkelt.[/de]
	
	@param iOverlayAlphaSpeedTimeout [type]int[/type]
	[en]The speed of darkening the background. The higher the number (in milliseconds) the slower the effect.[/en]
	[de]Die Geschwindigkeit für das Abdunkeln des Hintergundes. Je größer die Zahl (in Millisekunden) um so langsamer der Effeckt.[/de]
	
	@param bHideOnBackgroundClick [type]bool[/type]
	[en]Specifies whether the popup should hide on clicking on the background.[/en]
	[de]Gibt an ob bei einem Klick auf den Hintergrund das Popup geschlossen werden soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the popup element.[/en]
	[de]CSS Code für das Popup Element.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the popup element.[/en]
	[de]CSS Klasse für das Popup Element.[/de]
	*/
	public function build(
		$_sPopupID = NULL,
		$_sContent = NULL,
		$_iSizeX = NULL,
		$_iSizeY = NULL,
		$_iZIndex = NULL,
		$_iOverlayAlpha = NULL,
		$_iOverlayAlphaSpeedTimeout = NULL,
		$_bHideOnBackgroundClick = NULL,
		$_sCssStyle = NULL,
		$_sCssClass = NULL
	)
	{
		$_sContent = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iZIndex = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'iZIndex', 'xParameter' => $_iZIndex));
		$_iOverlayAlpha = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'iOverlayAlpha', 'xParameter' => $_iOverlayAlpha));
		$_iOverlayAlphaSpeedTimeout = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'iOverlayAlphaSpeedTimeout', 'xParameter' => $_iOverlayAlphaSpeedTimeout));
		$_bHideOnBackgroundClick = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'bHideOnBackgroundClick', 'xParameter' => $_bHideOnBackgroundClick));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sPopupID = $this->getRealParameter(array('oParameters' => $_sPopupID, 'sName' => 'sPopupID', 'xParameter' => $_sPopupID));

		if ($_sPopupID === NULL) {$_sPopupID = $this->getNextID();}
		if ($_sContent === NULL) {$_sContent = '';}
		if ($_iSizeX === NULL) {$_iSizeX = 300;}
		if ($_iSizeY === NULL) {$_iSizeY = 200;}
		if ($_iZIndex === NULL) {$_iZIndex = 1000;}
		if ($_iOverlayAlpha === NULL) {$_iOverlayAlpha = 50;}
		if ($_iOverlayAlphaSpeedTimeout === NULL) {$_iOverlayAlphaSpeedTimeout = 0;}
		if ($_bHideOnBackgroundClick === NULL) {$_bHideOnBackgroundClick = false;}
		if ($_sCssStyle === NULL) {$_sCssStyle = '';}
		if ($_sCssClass === NULL) {$_sCssClass = '';}
		
		$_sHtml = '';
		
		$_sHtml .= '<div id="'.$_sPopupID.'Overlay" ';
		if ($_bHideOnBackgroundClick == true) {$_sHtml .= 'onmouseup="oPGPopup.hide({\'sPopupID\': \''.$_sPopupID.'\'});" ';}
		$_sHtml .= 'style="position:fixed; display:none; top:0px; left:0px; width:0px; height:0px; background-color:#000000; z-index:'.$_iZIndex.';"></div>';
		$_sHtml .= '<div id="'.$_sPopupID.'" style="';
		$_sHtml .= 'position:fixed; display:none; width:'.$_iSizeX.'px; height:'.$_iSizeY.'px; z-index:'.($_iZIndex+1).'; ';
		if ($_sCssStyle != '') {$_sHtml .= $_sCssStyle;}
		else if ($_sCssClass == '') {$_sHtml .= 'overflow:auto; background-color:#ffffff; ';}
		$_sHtml .= '" ';
		if ($_sCssClass != '') {$_sHtml .= 'class="'.$_sCssClass.'" ';}
		$_sHtml .= '>';
		$_sHtml .= $_sContent;
		$_sHtml .= '</div>';
		// $_sHtml .= '<input type="hidden" id="'.$_sPopupID.'ContainerID" value="'.$_sContainerID.'" />';
		$_sHtml .= '<input type="hidden" id="'.$_sPopupID.'OverlayAlpha" value="'.$_iOverlayAlpha.'" />';
		$_sHtml .= '<input type="hidden" id="'.$_sPopupID.'OverlayAlphaSpeedTimeout" value="'.$_iOverlayAlphaSpeedTimeout.'" />';
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGPopup = new classPG_Popup();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGPopup', 'xValue' => $oPGPopup));}
?>