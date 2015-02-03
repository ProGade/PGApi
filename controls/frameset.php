<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 21 2012
*/
define('PG_FRAMESET_FRAMES_TYPE_COLS', 0);
define('PG_FRAMESET_FRAMES_TYPE_ROWS', 1);

define('PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC', 0);
define('PG_FRAMESET_FRAMES_BEHAVIOR_STATIC', 1);
define('PG_FRAMESET_FRAMES_BEHAVIOR_STRICT', 2);

define('PG_FRAMESET_FRAMES_MODE_NONE', 0);
define('PG_FRAMESET_FRAMES_MODE_TABBED', 1);

define('PG_FRAMESET_FRAMES_INDEX_BEHAVIOR', 0);	// must be 0. Don't change this!
define('PG_FRAMESET_FRAMES_INDEX_MODE', 1);		// must be 1. Don't change this!
define('PG_FRAMESET_FRAMES_INDEX_SIZE', 2);
define('PG_FRAMESET_FRAMES_INDEX_CONTENT', 3);
define('PG_FRAMESET_FRAMES_INDEX_SCROLLMODE', 4);
define('PG_FRAMESET_FRAMES_INDEX_OVERLAYZINDEX', 5);
define('PG_FRAMESET_FRAMES_INDEX_CSSSTYLE', 6);
define('PG_FRAMESET_FRAMES_INDEX_CSSCLASS', 7);

/*
@start class

@var FramesetTypes
PG_FRAMESET_FRAMES_TYPE_COLS;
PG_FRAMESET_FRAMES_TYPE_ROWS

@description
[en]This class contains methods to create and manage (faked) framesets.[/en]
[de]Diese Klasse enth�lt Methoden zum erstellen und verwalten von (gefakten) Framesets.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Frameset extends classPG_ClassBasics
{
	// Declarations...
	private $iBorderSize = 5;
	
	private $sImageBorderHorizontal = 'frameset_border_horizontal.gif';
	private $sImageBorderVertical = 'frameset_border_vertical.gif';
	
	private $sImageCharactersbarFillerVertical = 'charactersbar_filler_vertical.gif';
	private $sImageCharactersbarFillerVerticalHover = 'charactersbar_filler_vertical_hover.gif';
	private $sImageCharactersbarFillerHorizontal = 'charactersbar_filler_horizontal.gif';
	private $sImageCharactersbarFillerHorizontalHover = 'charactersbar_filler_horizontal_hover.gif';
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGFrameset'));
		$this->initClassBasics();
		$this->setGfxSubPath(array('sPath' => 'controls/'));

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_frameset.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_frameset.php',
                'foundation' => 'gfx/default/templates/controls/foundation_frameset.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets the size of the border for the framesets.[/en]
	[de]Setzt die Gr��e vom Rahmen der Framesets.[/de]
	
	@param iSize [needed][type]int[/type]
	[en]The size in pixels.[/en]
	[de]Die Gr��e in Pixeln.[/de]
	*/
	public function setBorderSize($_iSize)
	{
		$_iSize = $this->getRealParameter(array('oParameters' => $_iSize, 'sName' => 'iSize', 'xParameter' => $_iSize));
		$this->iBorderSize = $_iSize;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the size of borders for framesets.[/en]
	[de]Gibt die Gr��e des Rahmens von Framesets zur�ck.[/de]
	
	@return iSize [type]int[/type]
	[en]Returns the size of borders for framesets as an integer.[/en]
	[de]Gibt die Gr��e des Rahmens von Framesets als Integer zur�ck.[/de]
	*/
	public function getBorderSize() {return $this->iBorderSize;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets an image for the border in the horizontal direction of framesets.[/en]
	[de]Setzt ein Bild f�r den Rahmen in horizontaler Richtung von Framesets.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the border.[/en]
	[de]Das Bild f�r den Rahmen.[/de]
	*/
	public function setImageBorderHorizontal($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageBorderHorizontal = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the image used for the border in the horizontal direction for framesets.[/en]
	[de]Gibt das Bild zur�ck, das f�r Rahmen in horizontaler Richtung f�r Framesets verwendet wird.[/de]
	
	@return sImage [type]string[/type]
	[en]Returns the image used for the border in the horizontal direction for framesets as a string.[/en]
	[de]Gibt das Bild als String zur�ck, das f�r Rahmen in horizontaler Richtung f�r Framesets verwendet wird.[/de]
	*/
	public function getImageBorderHorizontal() {return $this->sImageBorderHorizontal;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets an image for the border in the vertical direction of framesets.[/en]
	[de]Setzt ein Bild f�r den Rahmen in vertikaler Richtung von Framesets.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the border.[/en]
	[de]Das Bild f�r den Rahmen.[/de]
	*/
	public function setImageBorderVertical($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageBorderVertical = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the image used for the border in the vertical direction for framesets.[/en]
	[de]Gibt das Bild zur�ck, das f�r Rahmen in vertikaler Richtung f�r Framesets verwendet wird.[/de]
	
	@return sImage [type]string[/type]
	[en]Returns the image used for the border in the vertical direction for framesets as a string.[/en]
	[de]Gibt das Bild als String zur�ck, das f�r Rahmen in vertikaler Richtung f�r Framesets verwendet wird.[/de]
	*/
	public function getImageBorderVertical() {return $this->sImageBorderVertical;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds a frameset with 3 frames and returns it as an HTML string. (not yet implemented)[/en]
	[de]Erstellt ein Frameset mit 3 Frames und gibt es als HTML-String zur�ck. (noch nicht implementiert)[/de]
	
	@return sFramesetHtml [type]string[/type]
	[en]Returns the frameset as an HTML string.[/en]
	[de]Gibt das Frameset als HTML-String zur�ck.[/de]
	
	@param sFramesetID [type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framsets.[/de]
	
	@param asContents [type]string[][/type]
	[en]The contents of the frames.[/en]
	[de]Die Inhalte der Frames.[/de]
	
	@param sFrame1Size [type]string[/type]
	[en]The size of the first frame.[/en]
	[de]Die Gr��e des ersten Frames.[/de]
	
	@param sFrame3Size [type]string[/type]
	[en]The size of the third frame.[/en]
	[de]Die Gr��e des dritten Frames.[/de]
	
	@param iFramesetType [type]int[/type]
	[en]
		The type of the frameset.
		The follow defines are possible:
		%FramesetTypes%
	[/en]
	[de]
		Der Typ des Framesets.
		Folgende Defines sind m�glich:
		%FramesetTypes%
	[/de]
	
	@param sCssClassFrame [type]string[/type]
	[en]CSS class for the frames.[/en]
	[de]CSS Klasse f�r die Frames.[/de]
	
	@param sCssClassBorder [type]string[/type]
	[en]CSS class for the border.[/en]
	[de]CSS Klasse f�r den Rahmen.[/de]
	*/
	public function buildPatch3(
		$_sFramesetID = NULL,
		$_asContents = NULL,
		$_sFrame1Size = NULL,
		$_sFrame3Size = NULL,
		$_iFramesetType = NULL,
		$_sCssClassFrame = NULL,
		$_sCssClassBorder = NULL
	)
	{
		$_asContents = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'asContents', 'xParameter' => $_asContents));
		$_sFrame1Size = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sFrame1Size', 'xParameter' => $_sFrame1Size));
		$_sFrame3Size = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sFrame3Size', 'xParameter' => $_sFrame3Size));
		$_iFramesetType = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'iFramesetType', 'xParameter' => $_iFramesetType));
		$_sCssClassFrame = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssClassFrame', 'xParameter' => $_sCssClassFrame));
		$_sCssClassBorder = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssClassBorder', 'xParameter' => $_sCssClassBorder));
		$_sFramesetID = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sFramesetID', 'xParameter' => $_sFramesetID));

		if ($_sFramesetID === NULL) {$_sFramesetID = $this->getNextID();}
		if ($_sFrame1Size === NULL) {$_sFrame1Size = '30px';}
		if ($_sFrame3Size === NULL) {$_sFrame3Size = '30px';}
		if ($_iFramesetType === NULL) {$_iFramesetType = PG_FRAMESET_FRAMES_TYPE_ROWS;}
		
		// TODO...
		// $_axFrames[] = $this->buildFrameArray($_sFrame1Size, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sFrame3Size, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		
		return $this->build(
			array(
				'sFramesetID' => $_sFramesetID, 
				'sSizeX' => NULL, 
				'sSizeY' => NULL, 
				'axFrames' => $_axFrames, 
				'iFramesetType' => $_iFramesetType, 
				'sCssClassFrame' => $_sCssClassFrame, 
				'sCssClassBorder' => $_sCssClassBorder
			)
		);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds 3 framesets each with 3 frames and returns it as an HTML string. (not yet implemented)[/en]
	[de]Erstellt 3 Framesets mit jeweils 3 frames und gibt es als HTML-String zur�ck. (noch nicht implementiert)[/de]
	
	@return sFramesetHtml [type]string[/type]
	[en]Returns the frameset as an HTML string.[/en]
	[de]Gibt das Frameset als HTML-String zur�ck.[/de]
	
	@param sFramesetID [type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framsets.[/de]
	
	@param asContents [type]string[][/type]
	[en]The contents of the frames.[/en]
	[de]Die Inhalte der Frames.[/de]
	
	@param sTopSize [type]string[/type]
	[en]The height of the top frames.[/en]
	[de]Die H�he der oberen Frames.[/de]
	
	@param sBottomSize [type]string[/type]
	[en]The height of the bottom frames.[/en]
	[de]Die H�he der unteren Frames.[/de]
	
	@param sLeftSize [type]string[/type]
	[en]The width of the left frames.[/en]
	[de]Die Breite der Linken Frames.[/de]
	
	@param sRightSize [type]string[/type]
	[en]The width of the right frames.[/en]
	[de]Die Breite der rechten Frames.[/de]
	
	@param sCssClassFrame [type]string[/type]
	[en]CSS class for the frames.[/en]
	[de]CSS Klasse f�r die Frames.[/de]
	
	@param sCssClassBorder [type]string[/type]
	[en]CSS class for the border.[/en]
	[de]CSS Klasse f�r den Rahmen.[/de]
	*/
	public function buildPatch9(
		$_sFramesetID = NULL,
		$_asContents = NULL,
		$_sTopSize = NULL,
		$_sBottomSize = NULL,
		$_sLeftSize = NULL,
		$_sRightSize = NULL,
		$_sCssClassFrame = NULL,
		$_sCssClassBorder = NULL
	)
	{
		$_asContents = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'asContents', 'xParameter' => $_asContents));
		$_sTopSize = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sTopSize', 'xParameter' => $_sTopSize));
		$_sBottomSize = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sBottomSize', 'xParameter' => $_sBottomSize));
		$_sLeftSize = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sLeftSize', 'xParameter' => $_sLeftSize));
		$_sRightSize = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sRightSize', 'xParameter' => $_sRightSize));
		$_sCssClassFrame = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssClassFrame', 'xParameter' => $_sCssClassFrame));
		$_sCssClassBorder = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssClassBorder', 'xParameter' => $_sCssClassBorder));
		$_sFramesetID = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sFramesetID', 'xParameter' => $_sFramesetID));

		if ($_sFramesetID === NULL) {$_sFramesetID = $this->getNextID();}
		if ($_sTopSize === NULL) {$_sTopSize = '30px';}
		if ($_sBottomSize === NULL) {$_sBottomSize = '30px';}
		if ($_sLeftSize === NULL) {$_sLeftSize = '30px';}
		if ($_sRightSize === NULL) {$_sRightSize = '30px';}
		
		$_sHtml = '';
		
		// TODO...
		// Top...
		// $_axFrames[] = $this->buildFrameArray($_sLeftSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sRightSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_sHtml .= $this->build($_sFramesetID, NULL, $_sTopSize, $_axFrames, PG_FRAMESET_FRAMES_TYPE_COLS, $_sCssClassFrame, $_sCssClassBorder);
		
		// Middle...
		// $_axFrames[] = $this->buildFrameArray($_sLeftSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sRightSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_sHtml .= $this->build($_sFramesetID, NULL, NULL, $_axFrames, PG_FRAMESET_FRAMES_TYPE_COLS, $_sCssClassFrame, $_sCssClassBorder);
		
		// Bottom...
		// $_axFrames[] = $this->buildFrameArray($_sLeftSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $_axFrames[] = $this->buildFrameArray($_sRightSize, $_sContent, $_iFrameMode, $_iBehavior, $_iOverlayZIndex);
		// $sHTML .= $this->build($_sFramesetID, NULL, $_sBottomSize, $_axFrames, PG_FRAMESET_FRAMES_TYPE_COLS, $_sCssClassFrame, $_sCssClassBorder);
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Builds a frameset and returns it as an HTML string.[/en]
	[de]Erstellt ein Frameset und gibt es als HTML-String zur�ck.[/de]
	
	@return sFramesetHtml [type]string[/type]
	[en]Returns the frameset as an HTML string.[/en]
	[de]Gibt das Frameset als HTML-String zur�ck.[/de]
	
	@param sFramesetID [type]string[/type]
	[en]The ID of the frameset.[/en]
	[de]Die ID des Framsets.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the frameset in pixels.[/en]
	[de]Die Breite des Framesets in Pixeln.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the frameset in pixels.[/en]
	[de]Die H�he des Framesets in Pixeln.[/de]
	
	@param bResizeWithContainer [type]bool[/type]
	[en]Specifies whether the size of the frameset should be automatically change with the size of the container element.[/en]
	[de]Gibt an ob sich die Gr��e des Framesets mit der Gr��e des Kontainer-Elements automatisch ver�ndern soll.[/de]
	
	@param axFrames [type]mixed[][/type]
	[en]The frames of the frameset.[/en]
	[de]Die Frames des Framesets.[/de]
	
	@param iFramesetType [type]int[/type]
	[en]
		The type of the frameset.
		The follow defines are possible:
		%FramesetTypes%
	[/en]
	[de]
		Der Typ des Framesets.
		Folgende Defines sind m�glich:
		%FramesetTypes%
	[/de]
	
	@param iBorderSize [type]int[/type]
	[en]The size of border in pixels.[/en]
	[de]Die Gr��e der Rahmen in Pixeln.[/de]
	
	@param sCssStyleFrame [type]string[/type]
	[en]CSS code for the frames.[/en]
	[de]CSS Code f�r die Frames.[/de]
	
	@param sCssClassFrame [type]string[/type]
	[en]CSS class for the frames.[/en]
	[de]CSS Klasse f�r die Frames.[/de]
	
	@param sCssStyleBorder [type]string[/type]
	[en]CSS Code for the border.[/en]
	[de]CSS Code f�r den Rahmen.[/de]
	
	@param sCssClassBorder [type]string[/type]
	[en]CSS class for the border.[/en]
	[de]CSS Klasse f�r den Rahmen.[/de]
	*/
	public function build(
		$_sFramesetID = NULL,
		$_sSizeX = NULL,
		$_sSizeY = NULL,
		$_bResizeWithContainer = NULL,
		$_axFrames = NULL,
		$_iFramesetType = NULL,
		$_iBorderSize = NULL,
		$_sCssStyleFrame = NULL,
		$_sCssClassFrame = NULL,
		$_sCssStyleBorder = NULL,
		$_sCssClassBorder = NULL
	)
	{
		global $oPGFrame, $oPGTabs, $oPGArrays;
		
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_bResizeWithContainer = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'bResizeWithContainer', 'xParameter' => $_bResizeWithContainer));
		$_axFrames = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'axFrames', 'xParameter' => $_axFrames));
		$_iFramesetType = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'iFramesetType', 'xParameter' => $_iFramesetType));
		$_iBorderSize = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'iBorderSize', 'xParameter' => $_iBorderSize));
		$_sCssStyleFrame = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssStyleFrame', 'xParameter' => $_sCssStyleFrame));
		$_sCssClassFrame = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssClassFrame', 'xParameter' => $_sCssClassFrame));
		$_sCssStyleBorder = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssStyleBorder', 'xParameter' => $_sCssStyleBorder));
		$_sCssClassBorder = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sCssClassBorder', 'xParameter' => $_sCssClassBorder));
		$_sFramesetID = $this->getRealParameter(array('oParameters' => $_sFramesetID, 'sName' => 'sFramesetID', 'xParameter' => $_sFramesetID));

		if ($_sFramesetID === NULL) {$_sFramesetID = $this->getNextID();}
		if ($_sSizeX === NULL) {$_sSizeX = '100px';}
		if ($_sSizeY === NULL) {$_sSizeY = '100px';}
		if ($_iFramesetType === NULL) {$_iFramesetType = PG_FRAMESET_FRAMES_TYPE_COLS;}
		if ($_iBorderSize === NULL) {$_iBorderSize = $this->iBorderSize;}
	
		$_iDynamicFrames = 0;
		$_axJavaScriptFrames = array();
		$_sHtml = '';
		$_sHtml .= $this->getLineBreak();
		
		$_sHtml .= '<div id="'.$_sFramesetID.'" name="Frameset" style="width:'.$_sSizeX.'; height:'.$_sSizeY.'; overflow:hidden;">';
			for ($i=0; $i<count($_axFrames); $i++)
			{			
				// Border...
				if ($i>0)
				{
					$_bStrict = false;
					if (($_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] == PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)
					|| ($_axFrames[$i-1][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] == PG_FRAMESET_FRAMES_BEHAVIOR_STRICT)) {$_bStrict = true;}
					
					$_sHtml .= '<div id="'.$_sFramesetID.'Border'.$i.'" ';
					if (($_sCssClassBorder !== NULL) && ($_sCssClassBorder !== '')) {$_sHtml .= 'class="'.$_sCssClassBorder.'" ';}
					$_sHtml .= 'style="';
					if ($_sCssStyleBorder !== NULL) {$_sHtml .= $_sCssStyleBorder.' ';}
					else if (($_sCssClassBorder === NULL) || ($_sCssClassBorder === ''))
					{
						$_sHtml .= 'background-color:#CCCCCC; ';
						if ($_iFramesetType == PG_FRAMESET_FRAMES_TYPE_COLS)
						{
							if ($this->sImageBorderVertical != '')
							{
								$_sHtml .= 'background-image:url('.$this->getGfxPathImages(array('sImage' => $this->sImageBorderVertical)).'); ';
								$_sHtml .= 'background-repeat:repeat-y; ';
								$_sHtml .= 'background-position:top left; ';
								$_sHtml .= 'background-attachment:scroll; ';
							}
						}
						else
						{
							if ($this->sImageBorderHorizontal != '')
							{
								$_sHtml .= 'background-image:url('.$this->getGfxPathImages(array('sImage' => $this->sImageBorderHorizontal)).'); ';
								$_sHtml .= 'background-repeat:repeat-x; ';
								$_sHtml .= 'background-position:top left; ';
								$_sHtml .= 'background-attachment:scroll; ';
							}
						}
					}
					if ($_iFramesetType == PG_FRAMESET_FRAMES_TYPE_COLS)
					{
						if ($_bStrict == true) {$_sHtml .= 'cursor:default; ';} else {$_sHtml .= 'cursor:col-resize; ';}
						$_sHtml .= 'height:100%; ';
						$_sHtml .= 'width:'.$_iBorderSize.'px; ';
						$_sHtml .= 'float:left; ';
					}
					else
					{
						if ($_bStrict == true) {$_sHtml .= 'cursor:default; ';} else {$_sHtml .= 'cursor:row-resize; ';}
						$_sHtml .= 'width:100%; ';
						$_sHtml .= 'height:'.$_iBorderSize.'px; ';
						$_sHtml .= 'float:none; ';
					}
					$_sHtml .= '" onmousedown="oPGFrameset.frameOnMouseDown({\'sFramesetID\': \''.$_sFramesetID.'\', \'iFrameIndex\': '.($i-1).'});"></div>';
				}
				
				// Frame...
				if ($oPGFrame->isMode(array('iCurrentMode' => $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_SCROLLMODE], 'iMode' => PG_FRAME_MODE_DRAG))) {$_bUseOverlay = true;}
				else {$_bUseOverlay = false;}
				$_iScrollMode = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_SCROLLMODE];
				$_iZIndex = 1;
				$_iOverlayZIndex = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_OVERLAYZINDEX];
				$_sContent = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_CONTENT];

				$_sCssStyleFrame2 = '';
				$_sCssClassFrame2 = '';
				
				if ($_sCssStyleFrame !== NULL) {$_sCssStyleFrame2 = $_sCssStyleFrame;}
				if ($_sCssClassFrame !== NULL) {$_sCssClassFrame2 = $_sCssClassFrame;}
				
				if ($_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_CSSSTYLE] != NULL) {$_sCssStyleFrame2 = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_CSSSTYLE];}
				if ($_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_CSSCLASS] != NULL) {$_sCssClassFrame2 = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_CSSCLASS];}
				
				if ($_iFramesetType == PG_FRAMESET_FRAMES_TYPE_COLS)
				{
					$_sFrameSizeX = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_SIZE];
					$_sFrameSizeY = '100%';
					$_sCssStyleFrame2 .= 'float:left; ';
				}
				else
				{
					$_sFrameSizeX = '100%';
					$_sFrameSizeY = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_SIZE];
					$_sCssStyleFrame2 .= 'float:none; ';
				}
				
				$_sHtml .= '<input type="hidden" id="'.$_sFramesetID.'Frame'.$i.'ControlsType" value="'.PG_CONTROLS_TYPE_FRAME.'" />';
				
				if ($this->isMode(array('iMode' => PG_FRAMESET_FRAMES_MODE_TABBED, 'iCurrentMode' => $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_MODE])))
				{
					$_axTabs = array();
					
					$_axFrameStructure = $oPGFrame->buildStructure(
						array(
							'sSizeX' => $_sFrameSizeX, 
							'sSizeY' => '10px', // $_sFrameSizeY, 
							'sContent' => $_sFramesetID.'Tabs'.$i.'Tab0Frame', // $_sContent, 
							'iZIndex' => $_iZIndex, 
							'iOverlayZIndex' => $_iOverlayZIndex, 
							'iScrollMode' => $_iScrollMode, 
							'bUseOverlay' => $_bUseOverlay, 
							'bVisible' => true,
							'sCssStyle' => $_sCssStyleFrame2.' background-color:#ffcccc;', 
							'sCssClass' => $_sCssClassFrame2
						)
					);
					
					$_axTabs[] = $oPGTabs->buildTabStructure(
						array(
							'sText' => $_sFramesetID.'Tabs'.$i.'Tab0', 
							'axFrameStructure' => $_axFrameStructure
						)
					);
					
					$_axFrameStructure = $oPGFrame->buildStructure(
						array(
							'sSizeX' => $_sFrameSizeX, 
							'sSizeY' => '10px', // $_sFrameSizeY, 
							'sContent' => $_sFramesetID.'Tabs'.$i.'Tab1Frame', // $_sContent, 
							'iZIndex' => $_iZIndex, 
							'iOverlayZIndex' => $_iOverlayZIndex, 
							'iScrollMode' => $_iScrollMode, 
							'bUseOverlay' => $_bUseOverlay, 
							'bVisible' => false,
							'sCssStyle' => $_sCssStyleFrame2.' background-color:#ccffcc;', 
							'sCssClass' => $_sCssClassFrame2
						)
					);
					
					$_axTabs[] = $oPGTabs->buildTabStructure(
						array(
							'sText' => $_sFramesetID.'Tabs'.$i.'Tab1', 
							'axFrameStructure' => $_axFrameStructure
						)
					);

					$_axFrameStructure = $oPGFrame->buildStructure(
						array(
							'sSizeX' => $_sFrameSizeX, 
							'sSizeY' => '10px', // $_sFrameSizeY, 
							'sContent' => $_sFramesetID.'Tabs'.$i.'Tab2Frame', // $_sContent, 
							'iZIndex' => $_iZIndex, 
							'iOverlayZIndex' => $_iOverlayZIndex, 
							'iScrollMode' => $_iScrollMode, 
							'bUseOverlay' => $_bUseOverlay, 
							'bVisible' => false,
							'sCssStyle' => $_sCssStyleFrame2.' background-color:#ccccff;', 
							'sCssClass' => $_sCssClassFrame2
						)
					);
					
					$_axTabs[] = $oPGTabs->buildTabStructure(
						array(
							'sText' => $_sFramesetID.'Tabs'.$i.'Tab2', 
							'axFrameStructure' => $_axFrameStructure
						)
					);

					$_sHtml .= $oPGTabs->build(
						array(
							'sTabsID' => $_sFramesetID.'Tabs'.$i,
							'sSizeX' => $_sFrameSizeX,
							'sSizeY' => $_sFrameSizeY,
							'iTabsMode' => NULL,
							'sContent' => NULL,
							'axTabs' => $_axTabs,
							'sCssStyle' => $_sCssStyleFrame2, 
							'sCssClass' => $_sCssClassFrame2
						)
					);
				}
				else
				{
					$_sHtml .= $oPGFrame->build(
						array(
							'sFrameID' => $_sFramesetID.'Frame'.$i, 
							'sSizeX' => $_sFrameSizeX, 
							'sSizeY' => $_sFrameSizeY, 
							'sContent' => $_sContent, 
							'iZIndex' => $_iZIndex, 
							'iOverlayZIndex' => $_iOverlayZIndex, 
							'iScrollMode' => $_iScrollMode, 
							'bUseOverlay' => $_bUseOverlay, 
							'sCssStyle' => $_sCssStyleFrame2, 
							'sCssClass' => $_sCssClassFrame2
						)
					);
				}
				
				if ($_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] == PG_FRAMESET_FRAMES_BEHAVIOR_DYNAMIC) {$_iDynamicFrames++;}

				$_axJavaScriptFrames[$i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_BEHAVIOR];
				$_axJavaScriptFrames[$i][PG_FRAMESET_FRAMES_INDEX_MODE] = $_axFrames[$i][PG_FRAMESET_FRAMES_INDEX_MODE];
			}
			
			if ($_bResizeWithContainer == true) {$_iResizeWithContainer = 1;}
			else {$_iResizeWithContainer = 0;}
			
			$_sHtml .= '<input type="hidden" id="'.$_sFramesetID.'ControlsType" value="'.PG_CONTROLS_TYPE_FRAMESET.'" />';
			
			$_sHtml .= '<script type="text/javascript">';
				$_sHtml .= 'oPGFrameset.registerFrameset(';
					$_sHtml .= '{';
						$_sHtml .= '"sFramesetID": "'.$_sFramesetID.'", ';
						$_sHtml .= '"iFramesetType": '.$_iFramesetType.', ';
						$_sHtml .= '"iFrameDynamicCount": '.$_iDynamicFrames.', ';
						$_sHtml .= '"iFrameCount": '.count($_axFrames).', ';
						if ($_bResizeWithContainer == true) {$_sHtml .= '"bResizeWithContainer": true, ';}
						else {$_sHtml .= '"bResizeWithContainer": false, ';}
						$_sHtml .= '"axFrames": '.$oPGArrays->toJavaScriptArray(array('axArray' => $_axJavaScriptFrames, 'sStringEscape' => '"'));
					$_sHtml .= '}';
				$_sHtml .= ')';
			$_sHtml .= '</script>';
			
		$_sHtml .= '</div>';
		
		$_sHtml .= $this->getLineBreak();
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the structure for a frame and returns it.[/en]
	[de]Erstellt die Struktur f�r einen Frame und gibt sie zur�ck.[/de]
	
	@return axStructure [type]mixed[][/type]
	[en]Returns the frame structure as an mixed array.[/en]
	[de]Gibt die Frame Struktur als gemischten Array zur�ck.[/de]
	
	@param sSize [needed][type]string[/type]
	[en]The size of the frame in pixels.[/en]
	[de]Die Gr��e des Frames in Pixeln.[/de]
	
	@param sContent [needed][type]string[/type]
	[en]The content of the frame.[/en]
	[de]Der Inhalt des Frames.[/de]
	
	@param iMode [needed][type]int[/type]
	[en]The mode of the frame.[/en]
	[de]Der Modus des Frames.[/de]
	
	@param iScrollMode [needed][type]int[/type]
	[en]The scroll mode of the frame.[/en]
	[de]Der Scroll-Modus des Frames.[/de]
	
	@param iBehavior [needed][type]int[/type]
	[en]The behavior of the frame.[/en]
	[de]Das Verhalten des Frames.[/de]
	
	@param iOverlayZIndex [needed][type]int[/type]
	[en]The level (z-index) on which the overlay (if needed) is placed.[/en]
	[de]Die Ebene (Z-Index) auf der das Overlay (wenn ben�tigt) f�r den Frame gelegt wird.[/de]
	
	*/
	public function buildFrameStructure($_sSize, $_sContent = NULL, $_iMode = NULL, $_iScrollMode = NULL, $_iBehavior = NULL, $_iOverlayZIndex = NULL, $_sCssStyle = NULL, $_sCssClass = NULL)
	{
		$_sContent = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iMode = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'iMode', 'xParameter' => $_iMode));
		$_iScrollMode = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'iScrollMode', 'xParameter' => $_iScrollMode));
		$_iBehavior = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'iBehavior', 'xParameter' => $_iBehavior));
		$_iOverlayZIndex = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'iOverlayZIndex', 'xParameter' => $_iOverlayZIndex));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sSize = $this->getRealParameter(array('oParameters' => $_sSize, 'sName' => 'sSize', 'xParameter' => $_sSize));
		
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_SIZE] = $_sSize;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_CONTENT] = $_sContent;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_MODE] = $_iMode;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_SCROLLMODE] = $_iScrollMode;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_BEHAVIOR] = $_iBehavior;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_OVERLAYZINDEX] = $_iOverlayZIndex;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_CSSSTYLE] = $_sCssStyle;
		$_axFrame[PG_FRAMESET_FRAMES_INDEX_CSSCLASS] = $_sCssClass;
		
		return $_axFrame;
	}
	/* @end method */
}
/* @end class */
$oPGFrameset = new classPG_Frameset();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFrameset', 'xValue' => $oPGFrameset));}
?>