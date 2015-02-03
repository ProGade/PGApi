<?php
/*
* ProGade API
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* Last changes of this file: Nov 09 2012
*/
define('PG_BUTTON_MODE_NONE', 0);
define('PG_BUTTON_MODE_AUTOSUBMIT', 1);
define('PG_BUTTON_MODE_HYPERLINK', 2);

define('PG_BUTTON_EVENT_ONSUBMIT', 1);

/*
@start class

@var ButtonModeDefines
PG_BUTTON_MODE_NONE
PG_BUTTON_MODE_AUTOSUBMIT
PG_BUTTON_MODE_HYPERLINK

@description
[en]This class has methods to create buttons.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen von Buttons.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Button extends classPG_ClassBasics
{
	// Declarations...
	private $sImageLeft = 'button_left.gif';
	private $sImageFiller = NULL; // 'button_filler.gif';
	private $sImageRight = 'button_right.gif';
	private $sImageLeftHover = 'button_left_hover.gif';
	private $sImageFillerHover = NULL; // 'button_filler_hover.gif';
	private $sImageRightHover = 'button_right_hover.gif';
	private $sImageLeftDown = 'button_left_down.gif';
	private $sImageFillerDown = NULL; // 'button_filler_down.gif';
	private $sImageRightDown = 'button_right_down.gif';
	private $sImageLeftDownHover = 'button_left_down_hover.gif';
	private $sImageFillerDownHover = NULL; // 'button_filler_down_hover.gif';
	private $sImageRightDownHover = 'button_right_down_hover.gif';

	private $sCssClass = NULL;
	private $sCssClassNormal = 'pg_button_normal';
	private $sCssClassDown = 'pg_button_down';
	private $sCssClassLeft = 'pg_button_left';
	private $sCssClassFiller = 'pg_button_filler';
	private $sCssClassRight = 'pg_button_right';

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGButton'));
		$this->initClassBasics();
		$this->setGfxSubPath(array('sPath' => 'controls/'));

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_button.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_button.php',
                'foundation' => 'gfx/default/templates/controls/foundation_button.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Sets the left side image for graphical text buttons.[/en]
	[de]Setzt das linke Seitenbild für grafische Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageLeft($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageLeft = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the filler image for graphical text buttons.[/en]
	[de]Setzt das Füllbild für grafische Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageFiller($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageFiller = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the right side image for graphical text buttons.[/en]
	[de]Setzt das rechte Seitenbild für grafische Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageRight($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageRight = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the left side image for the hover effect of graphical text buttons.[/en]
	[de]Setzt das linke Seitenbild für den Hover-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageLeftHover($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageLeftHover = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the filler image for the hover effect of graphical text buttons.[/en]
	[de]Setzt das Füllbild für den Hover-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageFillerHover($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageFillerHover = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the right side image for the hover effect of graphical text buttons.[/en]
	[de]Setzt das rechte Seitenbild f�r den Hover-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageRightHover($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageRightHover = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the left side image for the pressed effect of graphical text buttons.[/en]
	[de]Setzt das linke Seitenbild für den Gedrückt-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageLeftDown($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageLeftDown = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the filler image for the pressed effect of graphical text buttons.[/en]
	[de]Setzt das Füllbild f�r den Gedrückt-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageFillerDown($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageFillerDown = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the right side image for the pressed effect of graphical text buttons.[/en]
	[de]Setzt das rechte Seitenbild für den Gedrückt-Effeckt von grafischen Textbuttons.[/de]
	
	@param sImage [needed][type]string[/type]
	[en]The image for the button.[/en]
	[de]Das Bild für den Button.[/de]
	*/
	public function setImageRightDown($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageRightDown = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS class for buttons.[/en]
	[de]Setzt die CSS Klasse für Buttons.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for buttons.[/en]
	[de]Die CSS Klasse für Buttons.[/de]
	*/
	public function setCssClass($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClass = $_sClass;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the CSS code for buttons.[/en]
	[de]Setzt den CSS Code für Buttons.[/de]
	
	@return sCssClass [type]string[/type]
	[en]The CSS code for buttons.[/en]
	[de]Der CSS Code für Buttons.[/de]
	*/
	public function getCssClass() {return $this->sCssClass;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS class for the left side of buttons.[/en]
	[de]Setzt die CSS Klasse für die linke Seite von Buttons.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for buttons.[/en]
	[de]Die CSS Klasse für Buttons.[/de]
	*/
	public function setCssClassLeft($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassLeft = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the class for the left side of buttons.[/en]
	[de]Gibt die Klasse für die linke Seite von Buttons zurück.[/de]
	
	@return sCssClass [type]string[/type]
	[en]Returns the class for the left side of buttons as a string.[/en]
	[de]Gibt die Klasse für die linke Seite von Buttons als String zurück.[/de]
	*/
	public function getCssClassLeft() {return $this->sCssClassLeft;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS class for the filling of buttons.[/en]
	[de]Setzt die CSS Klasse für die Füllung von Buttons.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for buttons.[/en]
	[de]Die CSS Klasse für Buttons.[/de]
	*/
	public function setCssClassFiller($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassFiller = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the class for the filling of buttons.[/en]
	[de]Gibt die Klasse für die Füllung von Buttons zurück.[/de]
	
	@return sCssClass [type]string[/type]
	[en]Returns the class for the filling of buttons as a string.[/en]
	[de]Gibt die Klasse für die Füllung von Buttons als String zurück.[/de]
	*/
	public function getCssClassFiller() {return $this->sCssClassFiller;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS class for the right side of buttons.[/en]
	[de]Setzt die CSS Klasse für die rechte Seite von Buttons.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for buttons.[/en]
	[de]Die CSS Klasse für Buttons.[/de]
	*/
	public function setCssClassRight($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassRight = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the class for the right side of buttons.[/en]
	[de]Gibt die Klasse für die rechte Seite von Buttons zurück.[/de]
	
	@return sCssClass [type]string[/type]
	[en]Returns the class for the right side of buttons as a string.[/en]
	[de]Gibt die Klasse für die rechte Seite von Buttons als String zurück.[/de]
	*/
	public function getCssClassRight() {return $this->sCssClassRight;}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Builds a button.[/en]
	[de]Erstellt einen Button.[/de]
	
	@return sButtonHtml [type]string[/type]
	[en]Returns the button as an HTML string.[/en]
	[de]Gibt den Button als HTML String zurück.[/de]
	
	@param sButtonID [type]string[/type]
	[en]The ID of the button.[/en]
	[de]Die ID des Buttons.[/de]
	
	@param sText [type]string[/type]
	[en]The text on the button.[/en]
	[de]Der Text auf dem Button.[/de]
	
	@param sTextHover [type]string[/type]
	[en]The Text on the button on hover effect.[/en]
	[de]Der Text auf dem Button beim Hover-Effeckt.[/de]
	
	@param sTextDown [type]string[/type]
	[en]The Text on the button on pressed effect.[/en]
	[de]Der Text auf dem Button beim Gedrückt-Effeckt.[/de]
	
	@param sTextDownHover [type]string[/type]
	[en]The Text on the button on pressed hover effect.[/en]
	[de]Der Text auf dem Button beim Gedrückt-Hover-Effeckt.[/de]
	
	@param iButtonMode [type]int[/type]
	[en]
		The mode for the button.
		Specifies how the button should behave.
		Following de fines are possible:
		%ButtonModeDefines%
	[/en]
	[de]
		Der Modus für den Button.
		Gibt an wie der Button sich verhalten soll.
		Folgende Defines sind möglich:
		%ButtonModeDefines%
	[/de]
	
	@param sOnClick [type]string[/type]
	[en]The JavaScript code that should be executed on klick.[/en]
	[de]Der JavaScript Code der beim Anklicken des Buttons ausgeführt werden soll.[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the button.[/en]
	[de]Die Breite des Buttons.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the button.[/en]
	[de]Die Höhe des Buttons.[/de]
	
	@param bDisplay [type]bool[/type]
	[en]Specifies whether the button should be displayed.[/en]
	[de]Gibt an ob der Button angezeigt werden soll.[/de]
	
	@param sSendParameters [type]string[/type]
	[en]Parameters which should be sent when submit.[/en]
	[de]Parameter die beim Abschicken geschickt werden sollen.[/de]
	
	@param sOnMouseDown [type]string[/type]
	[en]The JavaScript code that should be executed on mouse down.[/en]
	[de]Der JavaScript Code der beim drücken der Maustaste auf dem Button ausgeführt werden soll.[/de]
	
	@param sOnMouseUp [type]string[/type]
	[en]The JavaScript code that should be executed on mouse up.[/en]
	[de]Der JavaScript Code der beim loslassen der Maustaste auf dem Button ausgeführt werden soll.[/de]
	
	@param sOnMouseOver [type]string[/type]
	[en]The JavaScript code that should be executed on mouse over.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger über den Button bewegt wird.[/de]
	
	@param sOnMouseOut [type]string[/type]
	[en]The JavaScript code that should be executed on mouse out.[/en]
	[de]Der JavaScript Code der ausgeführt werden soll, wenn der Mauszeiger den Button verlässt.[/de]
	
	@param sImageButtonNormal [type]string[/type]
	[en]The image for a pure graphic button in the normal state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton im normalen Zustand.[/de]
	
	@param sImageButtonHover [type]string[/type]
	[en]The image for a pure graphic button in the hover state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton beim Hover-Effeckt.[/de]
	
	@param sImageButtonDown [type]string[/type]
	[en]The image for a pure graphic button in the pressed state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton beim Gedrückt-Effeckt.[/de]
	
	@param sImageButtonDownHover [type]string[/type]
	[en]The image for a pure graphic button in the pressed hover state.[/en]
	[de]Ein Bild für einen reinen Grafikbutton beim Gedrückt-Hover-Effeckt.[/de]
	
	@param sCssStyle [type]string[/type]
	[en]CSS code for the button.[/en]
	[de]CSS Code für den Button.[/de]
	
	@param sCssClass [type]string[/type]
	[en]A CSS class for the button.[/en]
	[de]Eine CSS Klasse für den Button.[/de]
	
	@param sCssClassNormal [type]string[/type]
	[en]A CSS class for the button in the normal state.[/en]
	[de]Eine CSS Klasse für den Button im normalen Zustand[/de]
	
	@param sCssClassDown [type]string[/type]
	[en]A CSS class for the button in the pressed state.[/en]
	[de]Eine CSS Klasse für den Button im gedrückten Zustand[/de]
	*/
	public function build(
		$_sButtonID = NULL,
		$_sText = NULL,
		$_sTextHover = NULL,
		$_sTextDown = NULL,
		$_sTextDownHover = NULL,
		$_iButtonMode = NULL,
		$_sOnClick = NULL,
		$_sSizeX = NULL,
		$_sSizeY = NULL,
		$_bDisplay = NULL,
		$_sSendParameters = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL,
		$_sImageButtonNormal = NULL,
		$_sImageButtonHover = NULL,
		$_sImageButtonDown = NULL,
		$_sImageButtonDownHover = NULL,
		$_sCssStyle = NULL,
		$_sCssClass = NULL,
		$_sCssClassNormal = NULL,
		$_sCssClassDown = NULL,

		$_sTemplateName = NULL
	)
	{
		global $oPGControls;

		$_sText = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sText', 'xParameter' => $_sText));
		$_sTextHover = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sTextHover', 'xParameter' => $_sTextHover));
		$_sTextDown = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sTextDown', 'xParameter' => $_sTextDown));
		$_sTextDownHover = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sTextDownHover', 'xParameter' => $_sTextDownHover));
		$_iButtonMode = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'iButtonMode', 'xParameter' => $_iButtonMode));
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_bDisplay = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'bDisplay', 'xParameter' => $_bDisplay));
		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));
		$_sImageButtonNormal = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sImageButtonNormal', 'xParameter' => $_sImageButtonNormal));
		$_sImageButtonHover = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sImageButtonHover', 'xParameter' => $_sImageButtonHover));
		$_sImageButtonDown = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sImageButtonDown', 'xParameter' => $_sImageButtonDown));
		$_sImageButtonDownHover = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sImageButtonDownHover', 'xParameter' => $_sImageButtonDownHover));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sCssClassNormal = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sCssClassNormal', 'xParameter' => $_sCssClassNormal));
		$_sCssClassDown = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sCssClassDown', 'xParameter' => $_sCssClassDown));
		$_sButtonID = $this->getRealParameter(array('oParameters' => $_sButtonID, 'sName' => 'sButtonID', 'xParameter' => $_sButtonID));
		
		if ($_sButtonID === NULL) {$_sButtonID = $this->getNextID();}
		if ($_sText === NULL) {$_sText = 'ok';}
		if ($_sTextHover === NULL) {$_sTextHover = $_sText;}
		if ($_sTextDown === NULL) {$_sTextDown = $_sTextHover;}
		if ($_sTextDownHover === NULL) {$_sTextDownHover = $_sTextDown;}
		if ($_iButtonMode === NULL) {$_iButtonMode = PG_BUTTON_MODE_NONE;}
		if ($_sCssClass === NULL) {$_sCssClass = $this->sCssClass;}
		if ($_sCssClassNormal === NULL) {$_sCssClassNormal = $this->sCssClassNormal;}
		if ($_sCssClassDown === NULL) {$_sCssClassDown = $this->sCssClassDown;}
//		if ($_sCssStyle === NULL) {if (!$this->isMode(array('iMode' => PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode' => $_iButtonMode))) {$_sCssStyle = 'float:left;';} else {$_sCssStyle = '';}}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}

        $_sHTML = '';
		if ($this->isMode(array('iMode' => PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode' => $_iButtonMode)))
		{
			if ($_sOnClick == '') {$_sOnClick = 'javascript:;';}
			$_sHTML .= '<a href="'.$_sOnClick.'" ';
		}
		else {$_sHTML .= '<div ';}
		$_sHTML .= 'id="'.$_sButtonID.'" ';

		// OnMouseDown...
		$_sHTML .= 'onmousedown="';
		if (($_sOnMouseDown !== '') && ($_sOnMouseDown !== NULL)) {$_sHTML .= str_replace('"', '\"', $_sOnMouseDown).' ';}
		$_sHTML .= 'oPGButton.onButtonMouseDown(\''.$_sButtonID.'\'); ';
		$_sHTML .= '" ';
		
		// OnMouseUp...
		$_sHTML .= 'onmouseup="';
		if (!$this->isMode(array('iMode' => PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode' => $_iButtonMode)))
		{
			if (($_sOnClick !== '') && ($_sOnClick !== NULL)) {$_sHTML .= str_replace('"', '\"', $_sOnClick).' ';}
		}
		if (($_sOnMouseUp !== '') && ($_sOnMouseUp !== NULL)) {$_sHTML .= str_replace('"', '\"', $_sOnMouseUp).' ';}
		$_sHTML .= 'oPGButton.onButtonMouseUp(\''.$_sButtonID.'\'); ';
		$_sHTML .= '" ';
		
		// OnMouseOver...
		$_sHTML .= 'onmouseover="';
		if (($_sOnMouseOver !== '') && ($_sOnMouseOver !== NULL)) {$_sHTML .= str_replace('"', '\"', $_sOnMouseOver).' ';}
		$_sHTML .= 'oPGButton.onButtonMouseOver(\''.$_sButtonID.'\'); ';
		$_sHTML .= '" ';
		
		// OnMouseOut...
		$_sHTML .= 'onmouseout="';
		if (($_sOnMouseOut !== '') && ($_sOnMouseOut !== NULL)) {$_sHTML .= str_replace('"', '\"', $_sOnMouseOut).' ';}
		$_sHTML .= 'oPGButton.onButtonMouseOut(\''.$_sButtonID.'\'); ';
		$_sHTML .= '" ';
		
		if ($_sCssClass != NULL) {$_sHTML .= 'class="'.$_sCssClass.'" ';}
		
		$_sHTML .= 'style="';
		if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
		if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; line-height:'.$_sSizeY.'; ';}
		if (($_bDisplay === NULL) || ($_bDisplay === true)) {$_sHTML .= 'display:inline-block; ';} else {$_sHTML .= 'display:none; ';}
		if (!$this->isMode(array('iMode' => PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode' => $_iButtonMode))) {$_sHTML .= 'cursor:pointer; ';}
		$_sHTML .= $_sCssStyle.'">';
		
		// Normal...
		if ($_sImageButtonNormal != NULL) {$_sHTML .= '<img id="'.$_sButtonID.'ButtonNormal" src="'.$this->getGfxPathImages(array('sImage' => $_sImageButtonNormal)).'" style="border:0; display:inline-block;" />';}
		else if ($this->sImageFiller != NULL)
		{
			$_sHTML .= '<table id="'.$_sButtonID.'ButtonNormal" style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			$_sHTML .= 'display:block; border:0;" cellpadding="0" cellspacing="0">';
			$_sHTML .= '<tr>';
				if ($this->sImageLeft != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageLeft)).'</td>';}
				$_sHTML .= '<td background="'.$this->getGfxPathImages(array('sImage' => $this->sImageFiller)).'" ';
				$_sHTML .= 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:100%; ';}
				if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:100%; ';}
				$_sHTML .= 'text-align:center; vertical-align:middle;">';
				$_sHTML .= '<nobr>'.$_sText.'</nobr>';
				$_sHTML .= '</td>';
				if ($this->sImageRight != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageRight)).'</td>';}
			$_sHTML .= '</tr>';
			$_sHTML .= '</table>';
		}
		else
		{
			$_sHTML .= '<div id="'.$_sButtonID.'ButtonNormal" ';
			if ($_sCssClassNormal != NULL) {$_sHTML .= 'class="'.$_sCssClassNormal.'" ';}
			$_sHTML .= 'style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			if (($_sSizeX !== NULL) && ($_sSizeY !== NULL)) {$_sHTML .= 'overflow:hidden; ';}
			$_sHTML .= 'display:inline-block;">'.$_sText.'</div>';
		}
		
		// NormalHover...
		if ($_sImageButtonHover != NULL) {$_sHTML .= '<img id="'.$_sButtonID.'ButtonHover" src="'.$this->getGfxPathImages(array('sImage' => $_sImageButtonHover)).'" style="border:0; display:none;" />';}
		else if ($this->sImageFillerHover != NULL)
		{
			$_sHTML .= '<table id="'.$_sButtonID.'ButtonHover" style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			$_sHTML .= 'display:none; border:0;" cellpadding="0" cellspacing="0">';
			$_sHTML .= '<tr>';
				if ($this->sImageLeftHover != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageLeftHover)).'</td>';}
				$_sHTML .= '<td background="'.$this->getGfxPathImages(array('sImage' => $this->sImageFillerHover)).'" ';
				$_sHTML .= 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:100%; ';}
				if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:100%; ';}
				$_sHTML .= 'text-align:center; vertical-align:middle;">';
				$_sHTML .= '<nobr>'.$_sText.'</nobr>';
				$_sHTML .= '</td>';
				if ($this->sImageRightHover != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageRightHover)).'</td>';}
			$_sHTML .= '</tr>';
			$_sHTML .= '</table>';
		}
		else
		{
			$_sHTML .= '<div id="'.$_sButtonID.'ButtonHover" ';
			if ($_sCssClassNormal != NULL) {$_sHTML .= 'class="'.$_sCssClassNormal.'" ';}
			$_sHTML .= 'style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			if (($_sSizeX !== NULL) && ($_sSizeY !== NULL)) {$_sHTML .= 'overflow:hidden; ';}
			$_sHTML .= 'display:none;">'.$_sTextHover.'</div>';
		}
		
		// Down...		
		if ($_sImageButtonDown != NULL) {$_sHTML .= '<img id="'.$_sButtonID.'ButtonDown" src="'.$this->getGfxPathImages(array('sImage' => $_sImageButtonDown)).'" style="border:0; display:none;" />';}
		else if ($this->sImageFillerDown != NULL)
		{
			$_sHTML .= '<table id="'.$_sButtonID.'ButtonDown" style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			$_sHTML .= 'display:none; border:0;" cellpadding="0" cellspacing="0">';
			$_sHTML .= '<tr>';
				if ($this->sImageLeftDown != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageLeftDown)).'</td>';}
				$_sHTML .= '<td background="'.$this->getGfxPathImages(array('sImage' => $this->sImageFillerDown)).'" ';
				$_sHTML .= 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:100%; ';}
				if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:100%; ';}
				$_sHTML .= 'text-align:center; vertical-align:middle;">';
				$_sHTML .= '<nobr>'.$_sText.'</nobr>';
				$_sHTML .= '</td>';
				if ($this->sImageRightDown != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageRightDown)).'</td>';}
			$_sHTML .= '</tr>';
			$_sHTML .= '</table>';
		}
		else
		{
			$_sHTML .= '<div id="'.$_sButtonID.'ButtonDown" ';
			if ($_sCssClassDown != NULL) {$_sHTML .= 'class="'.$_sCssClassDown.'" ';}
			$_sHTML .= 'style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			if (($_sSizeX !== NULL) && ($_sSizeY !== NULL)) {$_sHTML .= 'overflow:hidden; ';}
			$_sHTML .= 'display:none;">'.$_sTextDown.'</div>';
		}
		
		// DownHover...
		if ($_sImageButtonDownHover != NULL) {$_sHTML .= '<img id="'.$_sButtonID.'ButtonDownHover" src="'.$this->getGfxPathImages(array('sImage' => $_sImageButtonDownHover)).'" style="border:0; display:none;" />';}
		else if ($this->sImageFillerDownHover != NULL)
		{
			$_sHTML .= '<table id="'.$_sButtonID.'ButtonDownHover" style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			$_sHTML .= 'display:none; border:0;" cellpadding="0" cellspacing="0">';
			$_sHTML .= '<tr>';
				if ($this->sImageLeftDownHover != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageLeftDownHover)).'</td>';}
				$_sHTML .= '<td background="'.$this->getGfxPathImages(array('sImage' => $this->sImageFillerDownHover)).'" ';
				$_sHTML .= 'style="background-repeat:repeat-x; background-position:center center; background-color:transparent; ';
				if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:100%; ';}
				if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:100%; ';}
				$_sHTML .= 'text-align:center; vertical-align:middle;">';
				$_sHTML .= '<nobr>'.$_sText.'</nobr>';
				$_sHTML .= '</td>';
				if ($this->sImageRightDownHover != '') {$_sHTML .= '<td>'.$this->getGfxPathImages(array('sImage' => $this->sImageRightDownHover)).'</td>';}
			$_sHTML .= '</tr>';
			$_sHTML .= '</table>';
		}
		else
		{
			$_sHTML .= '<div id="'.$_sButtonID.'ButtonDownHover" ';
			if ($_sCssClassDown != NULL) {$_sHTML .= 'class="'.$_sCssClassDown.'" ';}
			$_sHTML .= 'style="';
			if (($_sSizeX !== NULL) && ($_sSizeX !== '')) {$_sHTML .= 'width:'.$_sSizeX.'; ';}
			if (($_sSizeY !== NULL) && ($_sSizeY !== '')) {$_sHTML .= 'height:'.$_sSizeY.'; ';}
			if (($_sSizeX !== NULL) && ($_sSizeY !== NULL)) {$_sHTML .= 'overflow:hidden; ';}
			$_sHTML .= 'display:none;">'.$_sTextDownHover.'</div>';
		}

		$_sHTML .= '<input type="hidden" id="'.$_sButtonID.'Mode" value="'.$_iButtonMode.'" />';
		$_sHTML .= '<input type="hidden" id="'.$_sButtonID.'SendParameters" value="'.$_sSendParameters.'" />';
		if (isset($oPGControls)) {$_sHTML .= '<input type="hidden" id="'.$_sButtonID.'ControlsType" value="'.PG_CONTROLS_TYPE_BUTTON.'" />';}
		if ($this->isMode(array('iMode' => PG_BUTTON_MODE_HYPERLINK, 'iCurrentMode' => $_iButtonMode))) {$_sHTML .= '</a>';} else {$_sHTML .= '</div>';}
		
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the ID of the button that has been submit.[/en]
	[de]Gibt die ID des Buttons der abgeschickt wurde zurück.[/de]
	
	@return sButtonID [type]string[/type]
	[en]Returns the ID of the button that has been submit as a string.[/en]
	[de]Gibt die ID des Buttons der abgeschickt wurde als String zurück.[/de]
	*/
	public function getReceivedButtonID() {global $_POST; if (isset($_POST['sButtonID'])) {return utf8_decode($_POST['sButtonID']);} return NULL;}
	/* @end method */
}
/* @end class */
$oPGButton = new classPG_Button();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGButton', 'xValue' => $oPGButton));}
?>