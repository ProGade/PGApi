<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 17 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_DebugConsole extends classPG_ClassBasics
{
	// Declarations...
	private $sCssClassPrefix = 'pg_debug_';
	private $sCssClassMassageContainerTable = 'message_container_table';

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDebugConsole'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@param sContainerID [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setMessageContainerID($_sContainerID)
	{
		$_sContainerID = $this->getRealParameter(array('oParameters' => $_sContainerID, 'sName' => 'sContainerID', 'xParameter' => $_sContainerID));
		$this->setID($_sContainerID);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sID [type]string[/type]
	[en]...[/en]
	*/
	public function getMessageContainerID() {return $this->getID();}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	*/
	public function buildCommandBar($_sSizeX = NULL)
	{
		global $oPGInputField;

		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sSizeX, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		
		if ($_sSizeX === NULL) {$_sSizeX = '';}
		
		$_sHtml = '';
		$_sHtml .= '<table id="'.$this->getID().'CommandBar" style="border-width:0px; ';
		if ($_sSizeX != '') {$_sHtml .= 'width:'.$_sSizeX.'; ';}
		$_sHtml .= '" cellpadding="0" cellspacing="0">';
		$_sHtml .= '<tr>';
			$_sHtml .= '<td style="text-align:right;">';
			if (isset($oPGInputField))
			{
				$_sInputFieldID = $this->getID().'CommandLineString';
				$_iInputFieldMode = PG_INPUTFIELD_MODE_NONE;
				$_iFieldWidth = 300;
				$_sHtml .= $oPGInputField->build(array('sInputFieldID' => $_sInputFieldID, 'iInputFieldMode' => $_iInputFieldMode, 'iFieldWidth' => $_iFieldWidth));
			}
			else {$_sHtml .= '<input type="text" id="'.$this->getID().'CommandLineString" style="width:300px;" autocomplete="off" />';}
			$_sHtml .= '</td>';
			$_sHtml .= '<td style="width:80px;"><input type="button" value="execute" onclick="oPGDebugConsole.executeCommandLine();" style="width:80px;" /></td>';
		$_sHtml .= '</tr>';
		$_sHtml .= '</table>';
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	*/
	public function buildMessageContainer($_sSizeX = NULL, $_sSizeY = NULL)
	{
		global $oPGButton;

		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sSizeX, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sSizeX, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		
		if ($_sSizeX === NULL) {$_sSizeX = '100%';}
		if ($_sSizeY === NULL) {$_sSizeY = '100px';}
		
		$_sHtml = '';
		$_sHtml .= '<table id="'.$this->getID().'Table" class="'.$this->sCssClassPrefix.$this->sCssClassMassageContainerTable.'" style="border-width:0px; width:'.$_sSizeX.'; height:'.$_sSizeY.';" cellpadding="0" cellspacing="0">';
		$_sHtml .= '<tr>';
			$_sHtml .= '<td style="width:20px;">';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $this->getID().'ButtonJumpToTop',
											   'sOnClick' => 'oPGDebugConsole.jumpToTop();',
											   'bDisplay' => true,
											   'sImageButtonNormal' => 'button_top_small_normal.png',
											   'sImageButtonHover' => 'button_top_small_hover.png',
											   'sImageButtonDown' => 'butto_top_small_down.png'));
			// $_sHtml .= '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_top.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToTop();" />';
			$_sHtml .= '<br />';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $this->getID().'ButtonJumpToNext',
											   'sOnClick' => 'oPGDebugConsole.jumpToNextMessage();',
											   'bDisplay' => true,
											   'sImageButtonNormal' => 'button_up_small_normal.png',
											   'sImageButtonHover' => 'button_up_small_hover.png',
											   'sImageButtonDown' => 'butto_up_small_down.png'));
			// $_sHtml .= '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_previous.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToNextMessage();" />';
			$_sHtml .= '<br />';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $this->getID().'ButtonJumpToActiveMessage',
											   'sOnClick' => 'oPGDebugConsole.jumpToActiveMessage();',
											   'bDisplay' => true,
											   'sImageButtonNormal' => 'button_point_small_normal.png',
											   'sImageButtonHover' => 'button_point_small_hover.png',
											   'sImageButtonDown' => 'butto_point_small_down.png'));
			// $_sHtml .= '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_active.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToActiveMessage();" />';
			$_sHtml .= '<br />';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $this->getID().'ButtonJumpToPrevious',
											   'sOnClick' => 'oPGDebugConsole.jumpToPreviousMessage();',
											   'bDisplay' => true,
											   'sImageButtonNormal' => 'button_down_small_normal.png',
											   'sImageButtonHover' => 'button_down_small_hover.png',
											   'sImageButtonDown' => 'butto_down_small_down.png'));
			// $_sHtml .= '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_next.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToPreviousMessage();" />';
			$_sHtml .= '<br />';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $this->getID().'ButtonJumpToBottom',
											   'sOnClick' => 'oPGDebugConsole.jumpToBottom();',
											   'bDisplay' => true,
											   'sImageButtonNormal' => 'button_bottom_small_normal.png',
											   'sImageButtonHover' => 'button_bottom_small_hover.png',
											   'sImageButtonDown' => 'butto_bottom_small_down.png'));
			// $_sHtml .= '<img src="http://api.progade.de/1.00.00/docu/examples/debug/button_jump_to_bottom.gif" style="border-width:0px;" onclick="oPGDebugConsole.jumpToBottom();" />';
			$_sHtml .= '</td>';
			$_sHtml .= '<td>';
				$_sHtml .= '<div id="'.$this->getID().'" style="overflow:auto; width:100%; height:'.$_sSizeY.'; margin:0px; padding:0px;">';
					$_sHtml .= '<a name="'.$this->getID().'Top"></a>';
					$_sHtml .= '<div id="'.$this->getID().'Messages">';
					$_sHtml .= '<a name="'.$this->getID().'Bottom"></a>';
					$_sHtml .= '</div>';
				$_sHtml .= '</div>';
			$_sHtml .= '</td>';
		$_sHtml .= '</tr>';
		$_sHtml .= '</table>';
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param bDisplay [type]bool[/type]
	[en]...[/en]
	
	@param bContentOverlapping [type]bool[/type]
	[en]...[/en]
	*/
	public function build($_bDisplay = NULL, $_bContentOverlapping = NULL)
	{
		$_bContentOverlapping = $this->getRealParameter(array('oParameters' => $_bDisplay, 'sName' => 'bContentOverlapping', 'xParameter' => $_bContentOverlapping));
		$_bDisplay = $this->getRealParameter(array('oParameters' => $_bDisplay, 'sName' => 'bDisplay', 'xParameter' => $_bDisplay));

		if ($_bDisplay === NULL) {$_bDisplay = false;}
		if ($_bContentOverlapping === NULL) {$_bContentOverlapping = false;}

		$_sHtml = '';
		$_sHtml .= '<div id="'.$this->getID().'Panel" style="';
		if ($_bContentOverlapping == true) {$_sHtml .= 'position:absolute; ';} else {$_sHtml .= 'position:static; ';}
		if ($_bDisplay == true) {$_sHtml .= 'display:block; ';} else {$_sHtml .= 'display:none; ';}
		$_sHtml .= 'top:0px; left:0px; width:100%; z-index:1000000000000; background-color:#DDDDFF;">';
		$_sHtml .= $this->buildCommandBar();
		$_sHtml .= $this->buildMessageContainer();
		$_sHtml .= '</div>';
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGDebugConsole = new classPG_DebugConsole();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDebugConsole', 'xValue' => $oPGDebugConsole));}
?>