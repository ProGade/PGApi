<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 22 2012
*/
define('PG_CONTROLS_SCROLLDIV_DEFAULT_OVERLAY_ZINDEX', 100);

define('PG_CONTROLS_TYPE_SCROLLDIV', 0);
define('PG_CONTROLS_TYPE_PROGRESSBAR', 1);
define('PG_CONTROLS_TYPE_FRAMESET', 2);
define('PG_CONTROLS_TYPE_FRAME', 3);
define('PG_CONTROLS_TYPE_INPUTFIELD', 4);
define('PG_CONTROLS_TYPE_BUTTON', 5);
define('PG_CONTROLS_TYPE_CHECKBOX', 6);

/*
@start class

@description
[en]This class contains methods to the manage other controls and for common functionality.[/en]
[de]Diese Klasse enthält Methoden zum verwalten von anderen Controls und für gemeinsame Funktionalitäten.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Controls extends classPG_ClassBasics
{
	// Declarations...
	public $sImageScrollbarButtonUp = 'scrollbar_button_up.gif';
	public $sImageScrollbarButtonUpHover = 'scrollbar_button_up_hover.gif';
	public $sImageScrollbarButtonUpDown = 'scrollbar_button_up_down.gif';
	public $sImageScrollbarButtonDown = 'scrollbar_button_down.gif';
	public $sImageScrollbarButtonDownHover = 'scrollbar_button_down_hover.gif';
	public $sImageScrollbarButtonDownDown = 'scrollbar_button_down_down.gif';
	public $sImageScrollbarButtonLeft = 'scrollbar_button_left.gif';
	public $sImageScrollbarButtonLeftHover = 'scrollbar_button_left_hover.gif';
	public $sImageScrollbarButtonLeftDown = 'scrollbar_button_left_down.gif';
	public $sImageScrollbarButtonRight = 'scrollbar_button_right.gif';
	public $sImageScrollbarButtonRightHover = 'scrollbar_button_right_hover.gif';
	public $sImageScrollbarButtonRightDown = 'scrollbar_button_right_down.gif';
	public $sImageScrollbarFaceTopVertical = 'scrollbar_face_top_vertcial.gif';
	public $sImageScrollbarFaceTopVerticalHover = 'scrollbar_face_top_vertical_hover.gif';
	public $sImageScrollbarFaceTopVerticalDown = 'scrollbar_face_top_vertical_down.gif';
	public $sImageScrollbarFaceBottomVertical = 'scrollbar_face_bottom_vertical.gif';
	public $sImageScrollbarFaceBottomVerticalHover = 'scrollbar_face_bottom_vertical_hover.gif';
	public $sImageScrollbarFaceBottomVerticalDown = 'scrollbar_face_bottom_vertical_down.gif';
	public $sImageScrollbarFaceLeftHorizontal = 'scrollbar_face_left_horizontal.gif';
	public $sImageScrollbarFaceLeftHorizontalHover = 'scrollbar_face_left_horizontal_hover.gif';
	public $sImageScrollbarFaceLeftHorizontalDown = 'scrollbar_face_left_horizontal_down.gif';
	public $sImageScrollbarFaceRightHorizontal = 'scrollbar_face_right_horizontal.gif';
	public $sImageScrollbarFaceRightHorizontalHover = 'scrollbar_face_right_horizontal_hover.gif';
	public $sImageScrollbarFaceRightHorizontalDown = 'scrollbar_face_right_horizontal_down.gif';
	public $sImageScrollbarFaceCenterVertical = 'scrollbar_face_center_vertical.gif';
	public $sImageScrollbarFaceCenterVerticalHover = 'scrollbar_face_center_vertical_hover.gif';
	public $sImageScrollbarFaceCenterVerticalDown = 'scrollbar_face_center_vertcial_down.gif';
	public $sImageScrollbarFaceCenterHorizontal = 'scrollbar_face_center_horizontal.gif';
	public $sImageScrollbarFaceCenterHorizontalHover = 'scrollbar_face_center_horizontal_hover.gif';
	public $sImageScrollbarFaceCenterHorizontalDown = 'scrollbar_face_center_horizontal_down.gif';
	public $sImageScrollbarFaceFillerVertical = 'scrollbar_face_filler_vertical.gif';
	public $sImageScrollbarFaceFillerVerticalHover = 'scrollbar_face_filler_vertical_hover.gif';
	public $sImageScrollbarFaceFillerVerticalDown = 'scrollbar_face_filler_vertical_down.gif';
	public $sImageScrollbarFaceFillerHorizontal = 'scrollbar_face_filler_horizontal.gif';
	public $sImageScrollbarFaceFillerHorizontalHover = 'scrollbar_face_filler_horizontal_hover.gif';
	public $sImageScrollbarFaceFillerHorizontalDown = 'scrollbar_face_filler_horizontal_down.gif';
	public $sImageScrollbarTrackFillerVertical = 'scrollbar_track_filler_vertical.gif';
	public $sImageScrollbarTrackFillerHorizontal = 'scrollbar_track_filler_horizontal.gif';
	
	// Construct...
	public function __construct() {}
	
	// Methods...
}
/* @end class */
$oPGControls = new classPG_Controls();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGControls', 'xValue' => $oPGControls));}
?>