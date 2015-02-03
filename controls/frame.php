<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 23 2012
*/
define('PG_FRAME_DEFAULT_OVERLAY_ZINDEX', 100);

define('PG_FRAME_MODE_NONE', 0);
define('PG_FRAME_MODE_SCROLLBAR', 1);
define('PG_FRAME_MODE_HOVER', 2);
define('PG_FRAME_MODE_BORDERHOVER', 4);
define('PG_FRAME_MODE_DRAG', 8);
define('PG_FRAME_MODE_CHARACTERSBAR_LEFT', 16);
define('PG_FRAME_MODE_CHARACTERSBAR_RIGHT', 32);
define('PG_FRAME_MODE_CHARACTERSBAR_TOP', 64);
define('PG_FRAME_MODE_CHARACTERSBAR_BOTTOM', 128);
define('PG_FRAME_MODE_SCROLLBAR_LEFT', 256);
define('PG_FRAME_MODE_SCROLLBAR_RIGHT', 512);
define('PG_FRAME_MODE_SCROLLBAR_TOP', 1024);
define('PG_FRAME_MODE_SCROLLBAR_BOTTOM', 2048);

/*
@start class

@description
[en]This class has methods to create and manage frames.[/en]
[de]Diese Klasse verf�gt �ber Methoden zum Erstellen und Verwalten von Frames.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Frame extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGFrame'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_frame.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_frame.php',
                'foundation' => 'gfx/default/templates/controls/foundation_frame.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Builds a structure of a frame and returns it.[/en]
	[de]Erstellt eine Struktur eines Frames und gibt sie zur�ck.[/de]
	
	@return axStructure [type]mixed[][/type]
	[en]Builds a structure of a frame and returns it as an mixed array.[/en]
	[de]Erstellt eine Struktur eines Frames und gibt sie als mixed Array zur�ck.[/de]
	
	@param sFrameID [type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the frame.[/en]
	[de]Die Breite des Frames.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the frame.[/en]
	[de]Die H�he des Frames.[/de]
	
	@param sContent [type]string[/type]
	[en]The content of the frame.[/en]
	[de]Der Inhalt des Frames.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) on which the frame should be placed.[/en]
	[de]Die Ebene (Z-Inxed) auf die der Frame liegen soll.[/de]
	
	@param iOverlayZIndex [type]int[/type]
	[en]The level (z-index) on which the overlay of the frame should be placed.[/en]
	[de]Die Ebene (Z-Index) auf die das Overlay des Frames liegen soll.[/de]
	
	@param iScrollMode [type]int[/type]
	[en]The scroll mode of the frame.[/en]
	[de]Der Scroll-Modus vom Frame.[/de]
	
	@param bUseOverlay [type]bool[/type]
	[en]Specifies whether the Frame should use an overlay.[/en]
	[de]Gibt an ob der Frame ein Overlay verwenden soll.[/de]
	
	@param bVisible [type]bool[/type]
	[en]Specifies whether the frame should be visible.[/en]
	[de]Gibt an ob der Frame sichtbar sein soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the frame.[/en]
	[de]CSS Code f�r den Frame.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the frame.[/en]
	[de]CSS Klasse f�r den Frame.[/de]
	*/
	public function buildStructure(
		$_sFrameID = NULL, 
		$_sSizeX = NULL, 
		$_sSizeY = NULL, 
		$_sContent = NULL, 
		$_iZIndex = NULL, 
		$_iOverlayZIndex = NULL, 
		$_iScrollMode = NULL, 
		$_bUseOverlay = NULL, 
		$_bVisible = NULL,
		$_sCssStyle = NULL, 
		$_sCssClass = NULL
    )
	{
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_sContent = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iZIndex = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iZIndex', 'xParameter' => $_iZIndex));
		$_iOverlayZIndex = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iOverlayZIndex', 'xParameter' => $_iOverlayZIndex));
		$_iScrollMode = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iScrollMode', 'xParameter' => $_iScrollMode));
		$_bUseOverlay = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'bUseOverlay', 'xParameter' => $_bUseOverlay));
		$_bVisible = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'bVisible', 'xParameter' => $_bVisible));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sFrameID = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sFrameID', 'xParameter' => $_sFrameID));

		return array(
			'sFrameID' => $_sFrameID,
			'sSizeX' => $_sSizeX,
			'sSizeY' => $_sSizeY,
			'sContent' => $_sContent,
			'iZIndex' => $_iZIndex,
			'iOverlayZIndex' => $_iOverlayZIndex,
			'iScrollMode' => $_iScrollMode,
			'bUseOverlay' => $_bUseOverlay,
			'bVisible' => $_bVisible,
			'sCssStyle' => $_sCssStyle,
			'sCssClass' => $_sCssClass
		);
	}
	/* @end method */
	
 	/*
	@start method
	
	@description
	[en]Builds an frame and returns it as an HTML string.[/en]
	[de]Erstellt einen Frame und gibt ihn als HTML-String zur�ck.[/de]
	
	@return sFrameHtml [type]string[/type]
	[en]Builds an frame and returns it as an HTML string.[/en]
	[de]Erstellt einen Frame und gibt ihn als HTML-String zur�ck.[/de]
	
	@param sFrameID [type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the frame.[/en]
	[de]Die Breite des Frames.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the frame.[/en]
	[de]Die H�he des Frames.[/de]
	
	@param sContent [type]string[/type]
	[en]The content of the frame.[/en]
	[de]Der Inhalt des Frames.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) on which the frame should be placed.[/en]
	[de]Die Ebene (Z-Inxed) auf die der Frame liegen soll.[/de]
	
	@param iOverlayZIndex [type]int[/type]
	[en]The level (z-index) on which the overlay of the frame should be placed.[/en]
	[de]Die Ebene (Z-Index) auf die das Overlay des Frames liegen soll.[/de]
	
	@param iScrollMode [type]int[/type]
	[en]The scroll mode of the frame.[/en]
	[de]Der Scroll-Modus vom Frame.[/de]
	
	@param bUseOverlay [type]bool[/type]
	[en]Specifies whether the Frame should use an overlay.[/en]
	[de]Gibt an ob der Frame ein Overlay verwenden soll.[/de]
	
	@param bVisible [type]bool[/type]
	[en]Specifies whether the frame should be visible.[/en]
	[de]Gibt an ob der Frame sichtbar sein soll.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the frame.[/en]
	[de]CSS Code f�r den Frame.[/de]
	
	@param sCssClass [type]string[/type]
	[en]CSS class for the frame.[/en]
	[de]CSS Klasse f�r den Frame.[/de]
	*/
	public function build(
		$_sFrameID = NULL, 
		$_sSizeX = NULL, 
		$_sSizeY = NULL, 
		$_sContent = NULL, 
		$_iZIndex = NULL, 
		$_iOverlayZIndex = NULL, 
		$_iScrollMode = NULL, 
		$_bUseOverlay = NULL, 
		$_bVisible = NULL,
		$_sCssStyle = NULL, 
		$_sCssClass = NULL,

        $_sTemplateName = NULL
    )
	{
		global $oPGBrowser;

		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_sContent = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iZIndex = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iZIndex', 'xParameter' => $_iZIndex));
		$_iOverlayZIndex = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iOverlayZIndex', 'xParameter' => $_iOverlayZIndex));
		$_iScrollMode = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iScrollMode', 'xParameter' => $_iScrollMode));
		$_bUseOverlay = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'bUseOverlay', 'xParameter' => $_bUseOverlay));
		$_bVisible = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'bVisible', 'xParameter' => $_bVisible));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
        $_sTemplateName = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sTemplateName', 'xParameter' => $_sTemplateName));
		$_sFrameID = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sFrameID', 'xParameter' => $_sFrameID));

		if ($_sFrameID === NULL) {$_sDiv = $this->getNextID();}
		if ($_sSizeX === NULL) {$_sSizeX = '200px';}
		if ($_sSizeY === NULL) {$_sSizeY = '150px';}
		if ($_sContent === NULL) {$_sContent = '';}
		if ($_iZIndex === NULL) {$_iZIndex = 1;}
		if ($_iOverlayZIndex === NULL) {$_iOverlayZIndex = $_iZIndex+PG_FRAME_DEFAULT_OVERLAY_ZINDEX;}
		if ($_iScrollMode === NULL) {$_iScrollMode = PG_FRAME_MODE_NONE;}
		if ($_bUseOverlay === NULL) {$_bUseOverlay = false;}
		if ($_bVisible === NULL) {$_bVisible = true;}
		if ($_sCssStyle === NULL) {$_sCssStyle = '';}
		if ($_sCssClass === NULL) {$_sCssClass = '';}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}

        $_sHtml = '';

		if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode' => $_iScrollMode)))
		{
			$_sHtml .= '<div style="position:relative;">'.$this->buildCharactersbar(array('sFrameID' => $_sFrameID, 'iCharactersbarType' => PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iZIndex' => $_iOverlayZIndex+1)).'</div>';
		}
		if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode)))
		{
			$_sHtml .= '<div style="position:relative;">'.$this->buildCharactersbar(array('sFrameID' => $_sFrameID, 'iCharactersbarType' => PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iZIndex' => $_iOverlayZIndex+1)).'</div>';
		}
		if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode' => $_iScrollMode)))
		{
			$_sHtml .= '<div style="position:relative;">'.$this->buildCharactersbar(array('sFrameID' => $_sFrameID, 'iCharactersbarType' => PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iZIndex' => $_iOverlayZIndex+1)).'</div>';
		}
		if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode)))
		{
			$_sHtml .= '<div style="position:relative;">'.$this->buildCharactersbar(array('sFrameID' => $_sFrameID, 'iCharactersbarType' => PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iZIndex' => $_iOverlayZIndex+1)).'</div>';
		}
		
		// $_sHtml .= '<div style="position:relative; width:'.$_sSizeX.'; height:'.$_sSizeY.'; z-index:'.$_iZIndex.'; display:block; overflow:hidden;">';

			$_sHtml .= '<div style="position:relative; width:'.$_sSizeX.'; height:'.$_sSizeY.'; z-index:'.$_iZIndex.'; ';
			if ($_bVisible == true) {$_sHtml .= 'display:block; ';} else {$_sHtml .= 'display:none; ';}
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= 'overflow:auto; ';}
			else {$_sHtml .= 'overflow:hidden; ';}
			if ($_sCssStyle != '') {$_sHtml .= $_sCssStyle;}
			$_sHtml .= '" ';
			if ($_sCssClass != '') {$_sHtml .= 'class="'.$_sCssClass.'" ';}
			$_sHtml .= 'id="'.$_sFrameID.'Container">';
			
				$_sHtml .= '<div id="'.$_sFrameID.'" style="position:absolute; left:0px; top:0px; display:block; padding:0px; ';
				if (($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode' => $_iScrollMode))) || ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_LEFT, 'iCurrentMode' => $_iScrollMode)))) {$_sHtml .= 'padding-left:20px; right:0px; ';}
				if (($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) || ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iCurrentMode' => $_iScrollMode)))) {$_sHtml .= 'padding-right:20px; right:0px; ';}
				if (($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode' => $_iScrollMode))) || ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_TOP, 'iCurrentMode' => $_iScrollMode)))) {$_sHtml .= 'padding-top:20px; bottom:0px; ';}
				if (($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode))) || ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode)))) {$_sHtml .= 'padding-bottom:20px; bottom:0px; ';}
				if
				(
					(!$this->isMode(array('iMode' => PG_FRAME_MODE_HOVER, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_BORDERHOVER, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_DRAG, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_LEFT, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_TOP, 'iCurrentMode' => $_iScrollMode)))
					&& (!$this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode)))
				)
				{
					$_sHtml .= 'width:100%; ';
					$_sHtml .= 'height:100%; ';
				}
				$_sHtml .= '">';
				if ($_sContent != '') {$_sHtml .= $_sContent;}
				else if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT | PG_FRAME_MODE_CHARACTERSBAR_TOP | PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode)))
				{
					if ($_sContent == '') {$_sHtml .= $this->buildCharactersContainer(array('sFrameID' => $_sFrameID, 'iScrollMode' => $_iScrollMode));}
				}
		
				$_sHtml .= '</div>';
				$_sHtml .= '<input type="hidden" id="'.$_sFrameID.'ControlsType" value="'.PG_CONTROLS_TYPE_FRAME.'" />';
			
				$_sHtml .= '<div id="'.$_sFrameID.'Overlay" ';
				$_sHtml .= 'onmousedown="oPGFrame.onMouseDown({\'sFrameID\': \''.$_sFrameID.'\'});" ';
				$_sHtml .= 'onmouseup="oPGFrame.onMouseUp({\'sFrameID\': \''.$_sFrameID.'\'});" ';
				$_sHtml .= 'style="position:absolute; width:'.$_sSizeX.'; height:'.$_sSizeY.'; cursor:default; ';
				if ($oPGBrowser->getName() == PG_BROWSER_INTERNET_EXPLORER) {$_sHtml .= 'filter:alpha(opacity=1); ';}
				else {$_sHtml .= 'opacity:0.01; ';}
				if ($_bUseOverlay == true) {$_sHtml .= 'display:block; ';} else {$_sHtml .= 'display:none; ';}
				$_sHtml .= 'left:0px; top:0px; z-index:'.$_iOverlayZIndex.'; background-color:#000000;"></div>';
	
			$_sHtml .= '</div>';
			
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_LEFT, 'iScrollMode' => $_iScrollMode))) {$_sHtml .= $this->buildScrollbar(array('sFrameID' => $_sFrameID, 'iScrollbarType' => PG_FRAME_MODE_SCROLLBAR_LEFT, 'iZIndex' => $_iOverlayZIndex+1));}
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iScrollMode' => $_iScrollMode))) {$_sHtml .= $this->buildScrollbar(array('sFrameID' => $_sFrameID, 'iScrollbarType' => PG_FRAME_MODE_SCROLLBAR_RIGHT, 'iZIndex' => $_iOverlayZIndex+1));}
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_TOP, 'iScrollMode' => $_iScrollMode))) {$_sHtml .= $this->buildScrollbar(array('sFrameID' => $_sFrameID, 'iScrollbarType' => PG_FRAME_MODE_SCROLLBAR_TOP, 'iZIndex' => $_iOverlayZIndex+1));}
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iScrollMode' => $_iScrollMode))) {$_sHtml .= $this->buildScrollbar(array('sFrameID' => $_sFrameID, 'iScrollbarType' => PG_FRAME_MODE_SCROLLBAR_BOTTOM, 'iZIndex' => $_iOverlayZIndex+1));}
			
		// $_sHtml .= '</div>';
		
		$_sHtml .= '<script type="text/javascript">';
			$_sHtml .= 'oPGFrame.registerFrame(';
				$_sHtml .= '{';
					$_sHtml .= '"sFrameID": "'.$_sFrameID.'", ';
					$_sHtml .= '"iScrollMode": '.$_iScrollMode.', ';
					if ($_bUseOverlay == true) {$_sHtml .= '"bUseOverlay": true';}
					else {$_sHtml .= '"bUseOverlay": false';}
				$_sHtml .= '}';
			$_sHtml .= ');';
		$_sHtml .= '</script>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a scrollbar for an frame and returns it as an HTML string.[/en]
	[de]Erstellt eine Scrollbar f�r einen Frame und gibt sie als HTML-String zur�ck.[/de]
	
	@return sScrollBarHtml [type]string[/type]
	[en]Builds a scrollbar for an frame and returns it as an HTML string.[/en]
	[de]Erstellt eine Scrollbar f�r einen Frame und gibt sie als HTML-String zur�ck.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iScrollbarType [type]int[/type]
	[en]The type of the scrollbar.[/en]
	[de]Der Typ der Scrollbar.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) on which the scrollbar should be placed.[/en]
	[de]Die Ebene (Z-Inxed) auf die der Scrollbar liegen soll.[/de]
	*/
	public function buildScrollbar($_sFrameID, $_iScrollbarType = NULL, $_iZIndex = NULL)
	{
		global $oPGBrowser, $oPGControls;

		$_iScrollbarType = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iScrollbarType', 'xParameter' => $_iScrollbarType));
		$_iZIndex = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iZIndex', 'xParameter' => $_iZIndex));
		$_sFrameID = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sFrameID', 'xParameter' => $_sFrameID));
		
		if ($_iScrollbarType === NULL) {$_iScrollbarType = PG_FRAME_MODE_SCROLLBAR_RIGHT;}
		if ($_iZIndex === NULL) {$_iZIndex = 1;}
		
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sFrameID.'Scrollbar'.$_iScrollbarType.'" style="position:absolute; z-index:'.$_iZIndex.'; ';
		if (($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_LEFT) || ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_RIGHT)) {$_sHtml .= 'width:15px; ';}
		else {$_sHtml .= 'height:15px; ';}
		if ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_LEFT) {$_sHtml .= 'top:0px; left:0px; ';}
		if ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_RIGHT) {$_sHtml .= 'top:0px; right:0px; ';}
		if ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_TOP) {$_sHtml .= 'top:0px; left:0px; ';}
		if ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_BOTTOM) {$_sHtml .= 'bottom:0px; left:0px; ';}
		$_sHtml .= '">';
		
			// Button left or up....
			$_sHtml .= '<div id="'.$_sFrameID.'Scrollbar'.$_iScrollbarType.'Button1" ';
			$_sHtml .= 'onmouseout="oPGFrame.stopScrollBarMove();" ';
			$_sHtml .= 'onmouseup="oPGFrame.onScrollBarMoveRelease();" ';
			$_sHtml .= 'onmousedown="';
			if (($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_LEFT) || ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_RIGHT)) {$_sHtml .= 'oPGFrame.onScrollBarMoveTouch({\'sFrameID\': \''.$_sFrameID.'\', \'iMoveX\': null, \'iMoveY\': -20}); ';}
			else {$_sHtml .= 'oPGFrame.onScrollBarMoveTouch({\'sFrameID\': \''.$_sFrameID.'\', \'iMoveX\': -20, \'iMoveY\': null}); ';}
			$_sHtml .= '" style="background-color:#cccccc; ';
			if (($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_TOP) || ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_BOTTOM)) {$_sHtml .= 'float:left; ';}
			$_sHtml .= 'width:15px; height:15px; z-index:'.($_iZIndex+1).';">';
			$_sHtml .= '</div>';
			
			// Trackbar...
			$_sHtml .= '<div id="'.$_sFrameID.'Scrollbar'.$_iScrollbarType.'Track" ';
			if ($oPGBrowser->isMobile()) {$_sHtml .= 'onclick="oPGFrame.showScrollBarTouchHelper({\'sFrameID\': \''.$_sFrameID.'\', \'iScrollbarType\': '.$_iScrollbarType.'});" ';}
			$_sHtml .= 'style="background-color:#888888; ';
			if (($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_TOP) || ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_BOTTOM)) {$_sHtml .= 'float:left; ';}
			$_sHtml .= 'width:15px; height:15px;">';
			
			$_sHtml .= '</div>';

			// Button right or down...
			$_sHtml .= '<div id="'.$_sFrameID.'Scrollbar'.$_iScrollbarType.'Button2" ';
			$_sHtml .= 'onmouseout="oPGFrame.stopScrollBarMove();" ';
			$_sHtml .= 'onmouseup="oPGFrame.onScrollBarMoveRelease();" ';
			$_sHtml .= 'onmousedown="';
			if (($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_LEFT) || ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_RIGHT)) {$_sHtml .= 'oPGFrame.onScrollBarMoveTouch({\'sFrameID\': \''.$_sFrameID.'\', \'iMoveX\': null, \'iMoveY\': 20}); ';}
			else {$_sHtml .= 'oPGFrame.onScrollBarMoveTouch({\'sFrameID\': \''.$_sFrameID.'\', \'iMoveX\': 20, \'iMoveY\': null}); ';}
			$_sHtml .= '" ';
			$_sHtml .= ' style="background-color:#cccccc; ';
			if (($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_TOP) || ($_iScrollbarType == PG_FRAME_MODE_SCROLLBAR_BOTTOM)) {$_sHtml .= 'float:left; ';}
			$_sHtml .= 'width:15px; height:15px; z-index:'.($_iZIndex+1).';">';
			$_sHtml .= '</div>';

		$_sHtml .= '</div>';
		if ($oPGBrowser->isMobile())
		{
			$_sHtml .= '<div id="'.$_sFrameID.'Scrollbar'.$_iScrollbarType.'Helper" ';
			// $_sHtml .= 'onmousemove="oPGFrame.moveWithScrollBarHelper({\'sFrameID\': \''.$_sFrameID.'\', \'iScrollbarType\': '.$_iScrollbarType.'});" ';
			$_sHtml .= 'style="background-color:#cccccc; display:block; position:absolute; top:0px; left:0px; width:50px; height:50px; z-index:'.($_iZIndex+1).';"></div>';
		}
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a charactersbar for an frame and returns it as an HTML string.[/en]
	[de]Erstellt eine Charaktersbar f�r einen Frame und gibt sie als HTML-String zur�ck.[/de]
	
	@return sCharactersBarHtml [type]string[/type]
	[en]Builds a charactersbar for an frame and returns it as an HTML string.[/en]
	[de]Erstellt eine Charaktersbar f�r einen Frame und gibt sie als HTML-String zur�ck.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iCharactersbarType [type]int[/type]
	[en]The type of the charactersbar.[/en]
	[de]Der Typ der Charactersbar.[/de]
	
	@param iZIndex [type]int[/type]
	[en]The level (z-index) on which the characters bar should be placed.[/en]
	[de]Die Ebene (Z-Inxed) auf die der Charactersbar liegen soll.[/de]
	*/
	public function buildCharactersbar($_sFrameID, $_iCharactersbarType = NULL, $_iZIndex = NULL)
	{
		global $oPGControls;
		
		$_iCharactersbarType = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iCharactersbarType', 'xParameter' => $_iCharactersbarType));
		$_iZIndex = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iZIndex', 'xParameter' => $_iZIndex));
		$_sFrameID = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sFrameID', 'xParameter' => $_sFrameID));

		if ($_iCharactersbarType === NULL) {$_iCharactersbarType = PG_FRAME_MODE_CHARACTERSBAR_LEFT;}
		if ($_iZIndex === NULL) {$_iZIndex = 1;}
		
		$_sHtml = '';
		$_sHtml .= '<table id="'.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'" style="position:absolute; cursor:default; background-position:top left; background-attachment:scroll; ';
		if ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_LEFT) {$_sHtml .= 'background-repeat:repeat-y; width:15px; left:0px; ';}
		else if ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_RIGHT) {$_sHtml .= 'background-repeat:repeat-y; width:15px; right:0px; ';}
		else if ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_TOP) {$_sHtml .= 'background-repeat:repeat-x; height:15px; top:0px; ';}
		else if ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_BOTTOM) {$_sHtml .= 'background-repeat:repeat-x; height:15px; bottom:0px; ';}
		$_sHtml .= 'z-index:'.$_iZIndex.';" cellpadding="0" cellspacing="0" ';

		$_sHighlightBackground = '';
		$_sNormalBackground = '';
		if (($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_LEFT)
		|| ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_RIGHT))
		{
			$_sNormalBackground .= $this->getGfxPathImages(array('sImage' => $oPGControls->sImageCharactersbarFillerVertical));
			$_sHighlightBackground .= $this->getGfxPathImages(array('sImage' => $oPGControls->sImageCharactersbarFillerVerticalHover));

			$_sHtml .= 'background="'.$_sNormalBackground.'" ';
		}
		else if (($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_TOP)
		|| ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_BOTTOM))
		{
			$_sNormalBackground .= $this->getGfxPathImages(array('sImage' => $oPGControls->sImageCharactersbarFillerHorizontal));
			$_sHighlightBackground .= $this->getGfxPathImages(array('sImage' => $oPGControls->sImageCharactersbarFillerHorizontalHover));

			$_sHtml .= 'background="'.$_sNormalBackground.'" ';
		}
		$_sHtml .= '>';
		$_sHtml .= '<tr>';

			$_sHtml .= '<td id="'.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'Sharp" style="text-align:center; vertical-align:middle; font-size:8px; font-family:Verdana, Arial;" ';
			$_sHtml .= 'onmouseover="document.getElementById(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'Sharp\').background=\''.$_sHighlightBackground.'\';" ';
			$_sHtml .= 'onmouseout="document.getElementById(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'Sharp\').background=\''.$_sNormalBackground.'\';" ';
			$_sHtml .= 'onclick="oPGFrame.jumpToCharacter({\'sFrameID\': \''.$_sFrameID.'\', \'sCharacter\': \'Sharp\'});">#</td>';
			for ($i='A'; $i!='Z'; $i++)
			{
				// $_sHighlightArray = 'new Array(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.$i.'\')';
				if (($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_LEFT) || ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_RIGHT)) {$_sHtml .= '</tr><tr>';}
				$_sHtml .= '<td id="'.$_sFrameID.'Charactersbar'.$_iCharactersbarType.$i.'" style="text-align:center; vertical-align:middle; font-size:8px; font-family:Verdana, Arial;" ';
				$_sHtml .= 'onmouseover="document.getElementById(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.$i.'\').background=\''.$_sHighlightBackground.'\';" ';
				$_sHtml .= 'onmouseout="document.getElementById(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.$i.'\').background=\''.$_sNormalBackground.'\';" ';
				// $_sHtml .= 'onmouseover="if (typeof(oPGHover) != \'undefined\') {oPGHover.showHighlight('.$_sHighlightArray.', \'border-collapse:collapse; cursor:default; '.$this->sCssStyleInputFieldDatasetHover.'\');}" ';
				// $_sHtml .= 'onmouseout="if (typeof(oPGHover) != \'undefined\') {oPGHover.hideHighlight();}" ';
				$_sHtml .= 'onclick="oPGFrame.jumpToCharacter({\'sFrameID\': \''.$_sFrameID.'\', \'sCharacter\': \''.$i.'\'});">'.$i.'</td>';
			}
			if (($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_LEFT) || ($_iCharactersbarType == PG_FRAME_MODE_CHARACTERSBAR_RIGHT)) {$_sHtml .= '</tr><tr>';}
			$_sHtml .= '<td id="'.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'Z" style="text-align:center; vertical-align:middle; font-size:8px; font-family:Verdana, Arial;" ';
			$_sHtml .= 'onmouseover="document.getElementById(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'Z\').background=\''.$_sHighlightBackground.'\';" ';
			$_sHtml .= 'onmouseout="document.getElementById(\''.$_sFrameID.'Charactersbar'.$_iCharactersbarType.'Z\').background=\''.$_sNormalBackground.'\';" ';
			$_sHtml .= 'onclick="oPGFrame.jumpToCharacter({\'sFrameID\': \''.$_sFrameID.'\', \'sCharacter\': \'Z\'});">Z</td>';
		$_sHtml .= '</tr>';
		$_sHtml .= '</table>';
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Creates a characters container for content to a character bar and returns it as an HTML string.[/en]
	[de]Erstellt einen Characters-Kontainer f�r Inhalte zu einer Charaktersbar und gibt es als HTML-String zur�ck.[/de]
	
	@return sChaktersBarContainerHtml [type]string[/type]
	[en]Returns the characters container as an HTML string.[/en]
	[de]Gibt den Ckaracters-Kontainer als HTML-String zur�ck.[/de]
	
	@param sFrameID [needed][type]string[/type]
	[en]The ID of the frame.[/en]
	[de]Die ID des Frames.[/de]
	
	@param iScrollMode [type]int[/type]
	[en]The scroll mode of the frame.[/en]
	[de]Der Scroll-Modus vom Frame.[/de]
	
	@param axContents [type]mixed[][/type]
	[en]The contents for the characters containers.[/en]
	[de]Die Inhalte f�r die Characters-Kontainer.[/de]
	*/
	public function buildCharactersContainer($_sFrameID, $_iScrollMode = NULL, $_axContents = NULL)
	{
		$_iScrollMode = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'iScrollMode', 'xParameter' => $_iScrollMode));
		$_axContents = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'axContents', 'xParameter' => $_axContents));
		$_sFrameID = $this->getRealParameter(array('oParameters' => $_sFrameID, 'sName' => 'sFrameID', 'xParameter' => $_sFrameID));

		if ($_iScrollMode === NULL) {$_iScrollMode = PG_FRAME_MODE_NONE;}
		
		$_sHtml = '';
		$_sHtml .= '<table style="border-width:0px; ';
		if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= 'width:100%; ';}
		else if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= 'width:100%; ';}
		else if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_TOP, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= 'height:100%; ';}
		else if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_BOTTOM, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= 'height:100%; ';}
		$_sHtml .= '" cellpadding="0" cellspacing="0">';
		$_sHtml .= '<tr>';
			$_sHtml .= '<td id="'.$_sFrameID.'CharactersContainerSharp" style="font-size:16px; font-weight:bold; background-color:#CCCCCC;">#</td>';
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= '</tr><tr>';}
			$_sHtml .= '<td id="'.$_sFrameID.'CharactersContainerSharpContent">';
			if ($_axContents !== NULL) {$_sHtml .= $_axContents['#'];}
			$_sHtml .= '</td>';
			for ($i='A'; $i!='Z'; $i++)
			{
				if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= '</tr><tr>';}
				$_sHtml .= '<td id="'.$_sFrameID.'CharactersContainer'.$i.'" style="font-size:16px; font-weight:bold; background-color:#CCCCCC;">'.$i.'</td>';
				if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= '</tr><tr>';}
				$_sHtml .= '<td id="'.$_sFrameID.'CharactersContainer'.$i.'Content">';
				if ($_axContents !== NULL) {$_sHtml .= $_axContents[$i];}
				$_sHtml .= '</td>';
			}
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= '</tr><tr>';}
			$_sHtml .= '<td id="'.$_sFrameID.'CharactersContainerZ" style="font-size:16px; font-weight:bold; background-color:#CCCCCC;">Z</td>';
			if ($this->isMode(array('iMode' => PG_FRAME_MODE_CHARACTERSBAR_LEFT | PG_FRAME_MODE_CHARACTERSBAR_RIGHT, 'iCurrentMode' => $_iScrollMode))) {$_sHtml .= '</tr><tr>';}
			$_sHtml .= '<td id="'.$_sFrameID.'CharactersContainerZContent">';
			if ($_axContents !== NULL) {$_sHtml .= $_axContents['Z'];}
			$_sHtml .= '</td>';
		$_sHtml .= '</tr>';
		$_sHtml .= '</table>';
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGFrame = new classPG_Frame();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFrame', 'xValue' => $oPGFrame));}
?>