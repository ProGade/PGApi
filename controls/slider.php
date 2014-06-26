<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 20 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Slider extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGProgressBar'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@description [type]string[/type]
	[en]...[/en]
	
	@return sSliderHtml [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sSliderID = NULL)
	{
		global $oPGDragElement;
	
		$_sSliderID = $this->getRealParameter(array('oParameters' => $_sSliderID, 'sName' => 'sSliderID', 'xParameter' => $_sSliderID));
	
		if ($_sSliderID === NULL) {$_sSliderID = $this->getNextID();}
	
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sSliderID.'" style="border:solid 1px #000000;">';
			$_sHtml .= $oPGDragElement->build(
				array(
					'sDragElementID' => $_sSliderID.'DragElement',
					'iSizeX' => 50,
					'iSizeY' => 50,
					'aiBounds' => array(100, 100, 200, 200),
					'sCssClass' => 'slider_drag_element'
				)
			);
		$_sHtml .= '</div>';
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGSlider = new classPG_Slider();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGSlider', 'xValue' => $oPGSlider));}
?>