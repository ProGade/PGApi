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
define('PG_TEXTAREA_MODE_NONE', 0);
define('PG_TEXTAREA_MODE_AUTOSAVE', 1);

define('PG_TEXTAREA_EVENT_ONBLUR', 'OnBlur');

define('PG_TEXTAREA_ACTIONSTATUS_SUCCESS', 1);
define('PG_TEXTAREA_ACTIONSTATUS_FAILED', 0);

define('PG_TEXTAREA_NETWORK_REQUESTTYPE', 'PG_TextareaNetworkRequestType');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_TextArea extends classPG_ClassBasics
{
	// Declarations...
	private $sCssStyleNormal = 'background-color:#FFFFFF; color:#000000; border:solid 1px #707070;';
	private $sCssStyleNoData = 'background-color:#FFFFFF; color:#CCCCCC; border:solid 1px #000000;';

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGTextArea'));
		$this->initClassBasics();
	}

	// Methods...
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCssStyleNormal($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleNormal = $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCssStyleNoData($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleNoData = $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sTextAreaHtml [type]string[/type]
	[en]...[/en]
	
	@param sTextAreaID [type]string[/type]
	[en]...[/en]
	
	@param iTextAreaMode [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iRows [type]int[/type]
	[en]...[/en]
	
	@param sName [type]string[/type]
	[en]...[/en]
	
	@param sText [type]string[/type]
	[en]...[/en]
	
	@param sNoDataText [type]string[/type]
	[en]...[/en]
	
	@param sAccessKey [type]string[/type]
	[en]...[/en]
	
	@param bRequired [type]bool[/type]
	[en]...[/en]
	
	@param iMaxLength [type]int[/type]
	[en]...[/en]
	
	@param iTabIndex [type]int[/type]
	[en]...[/en]
	
	@param iLineBreakCharCount [type]int[/type]
	[en]...[/en]
	
	@param iFreeSpaceCharCount [type]int[/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnBlur [type]string[/type]
	[en]...[/en]
	
	@param sOnFocus [type]string[/type]
	[en]...[/en]
	
	@param sOnKeyDown [type]string[/type]
	[en]...[/en]
	
	@param sOnKeyUp [type]string[/type]
	[en]...[/en]
	
	@param sOnClick [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseDown [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseUp [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOver [type]string[/type]
	[en]...[/en]
	
	@param sOnMouseOut [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sTextAreaID = NULL, 
						  $_iTextAreaMode = NULL, 
						  $_iSizeX = NULL, 
						  $_iRows = NULL, 
						  
						  $_sName = NULL,
						  $_sText = NULL, 
						  $_sNoDataText = NULL, 
						  
						  $_sAccessKey = NULL,
						  $_bRequired = NULL, 
						  $_iMaxLength = NULL,
						  $_iTabIndex = NULL,
						  
						  $_iLineBreakCharCount = NULL,
						  $_iFreeSpaceCharCount = NULL,
						  
						  $_sSendParameters = NULL,

						  $_sOnBlur = NULL,
						  $_sOnFocus = NULL,
						  $_sOnKeyDown = NULL,
						  $_sOnKeyUp = NULL,
						
						  $_sOnClick = NULL,
						  $_sOnMouseDown = NULL,
						  $_sOnMouseUp = NULL,
						  $_sOnMouseOver = NULL,
						  $_sOnMouseOut = NULL)
	{
		$_iTextAreaMode = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iTextAreaMode', 'xParameter' => $_iTextAreaMode));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iRows = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iRows', 'xParameter' => $_iRows));

		$_sName = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sText = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sText', 'xParameter' => $_sText));
		$_sNoDataText = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sNoDataText', 'xParameter' => $_sNoDataText));

		$_sAccessKey = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sAccessKey', 'xParameter' => $_sAccessKey));
		$_bRequired = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'bRequired', 'xParameter' => $_bRequired));
		$_iMaxLength = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iMaxLength', 'xParameter' => $_iMaxLength));
		$_iTabIndex = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iTabIndex', 'xParameter' => $_iTabIndex));

		$_iLineBreakCharCount = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iLineBreakCharCount', 'xParameter' => $_iLineBreakCharCount));
		$_iFreeSpaceCharCount = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'iFreeSpaceCharCount', 'xParameter' => $_iFreeSpaceCharCount));

		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));

		$_sOnBlur = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnBlur', 'xParameter' => $_sOnBlur));
		$_sOnFocus = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnFocus', 'xParameter' => $_sOnFocus));
		$_sOnKeyDown = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnKeyDown', 'xParameter' => $_sOnKeyDown));
		$_sOnKeyUp = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnKeyUp', 'xParameter' => $_sOnKeyUp));

		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));

		$_sTextAreaID = $this->getRealParameter(array('oParameters' => $_sTextAreaID, 'sName' => 'sTextAreaID', 'xParameter' => $_sTextAreaID));

		if (($_sTextAreaID === NULL) || ($_sTextAreaID === '')) {$_sTextAreaID = $this->getNextID();}
		if ($_iTextAreaMode === NULL) {$_iTextAreaMode = PG_TEXTAREA_MODE_NONE;}
		if ($_iSizeX === NULL) {$_iSizeX = 180;}
		if ($_iRows === NULL) {$_iRows = 5;}
		
		if ($_sName === NULL) {$_sName = '';}
		if ($_sText === NULL) {$_sText = '';}
		if ($_sNoDataText === NULL) {$_sNoDataText = '';}
		
		if ($_sAccessKey === NULL) {$_sAccessKey = '';}
		if ($_bRequired === NULL) {$_bRequired = false;}
		if ($_iMaxLength === NULL) {$_iMaxLength = 0;}
		if ($_iTabIndex === NULL) {$_iTabIndex = 0;}
		
		if ($_iLineBreakCharCount === NULL) {$_iLineBreakCharCount = 0;}
		if ($_iFreeSpaceCharCount === NULL) {$_iFreeSpaceCharCount = 0;}
		
		if ($_sSendParameters === NULL) {$_sSendParameters = '';}

		if ($_sOnBlur === NULL) {$_sOnBlur = '';}
		if ($_sOnFocus === NULL) {$_sOnFocus = '';}
		if ($_sOnKeyDown === NULL) {$_sOnKeyDown = '';}
		if ($_sOnKeyUp === NULL) {$_sOnKeyUp = '';}
		
		if ($_sOnClick === NULL) {$_sOnClick = '';}
		if ($_sOnMouseDown === NULL) {$_sOnMouseDown = '';}
		if ($_sOnMouseUp === NULL) {$_sOnMouseUp = '';}
		if ($_sOnMouseOver === NULL) {$_sOnMouseOver = '';}
		if ($_sOnMouseOut === NULL) {$_sOnMouseOut = '';}
		
		if ($_sName == '') {$_sName = $_sTextAreaID;}
		
		$_sHTML = '';
		$_sHTML .= '<textarea id="'.$_sTextAreaID.'" ';
		$_sHTML .= 'name="'.$_sName.'" ';
		$_sHTML .= 'style="width:'.$_iSizeX.'px; ';
		if (($_sText !== '') && ($_sText !== NULL)) {$_sHTML .= $this->sCssStyleNormal.' ';}
		else {$_sHTML .= $this->sCssStyleNoData.' ';}
		$_sHTML .= '" rows="'.$_iRows.'" ';
		
		// OnBlur...
		$_sHTML .= 'onblur="';
		if ($_sOnBlur != '') {$_sHTML .= str_replace('"', '\"', $_sOnBlur).' ';}
		$_sHTML .= 'oPGTextArea.textAreaOnBlur({\'sTextAreaID\': \''.$_sTextAreaID.'\'});" ';
		
		// OnFocus...
		$_sHTML .= 'onfocus="';
		if ($_sOnFocus != '') {$_sHTML .= str_replace('"', '\"', $_sOnFocus).' ';}
		$_sHTML .= 'oPGTextArea.textAreaOnFocus({\'sTextAreaID\': \''.$_sTextAreaID.'\'});" ';
		
		// OnKeyDown...
		$_sHTML .= 'onkeydown="';
		if ($_sOnKeyDown != '') {$_sHTML .= str_replace('"', '\"', $_sOnKeyDown).' ';}
		$_sHTML .= 'oPGTextArea.textAreaOnKeyDown({\'sTextAreaID\': \''.$_sTextAreaID.'\'});" ';
		
		// OnKeyUp...
		$_sHTML .= 'onkeyup="';
		if ($_sOnKeyUp != '') {$_sHTML .= str_replace('"', '\"', $_sOnKeyUp).' ';}
		$_sHTML .= 'oPGTextArea.textAreaOnKeyUp({\'sTextAreaID\': \''.$_sTextAreaID.'\'});" ';

		// OnClick...
		if ($_sOnClick !== '') {$_sHTML .= 'onclick="'.str_replace('"', '\"', $_sOnClick).'"';}
		
		// OnMouseDown...
		if ($_sOnMouseDown !== '') {$_sHTML .= 'onmousedown="'.str_replace('"', '\"', $_sOnMouseDown).'"';}
		
		// OnMouseUp...
		if ($_sOnMouseUp !== '') {$_sHTML .= 'onmouseup="'.str_replace('"', '\"', $_sOnMouseUp).'"';}
		
		// OnMouseOver...
		if ($_sOnMouseOver !== '') {$_sHTML .= 'onmouseover="'.str_replace('"', '\"', $_sOnMouseOver).'"';}
		
		// OnMouseOut...
		if ($_sOnMouseOut !== '') {$_sHTML .= 'onmouseout="'.str_replace('"', '\"', $_sOnMouseOut).'"';}
		
		// TabIndex...
		if ($_iTabIndex > 0) {$_sHTML .= 'tabindex="'.$_iTabIndex.'" ';}
		
		$_sHTML .= '>';
		if ($_sText !== '') {$_sHTML .= $_sText;}
		else if ($_sNoDataText !== '') {$_sHTML .= $_sNoDataText;}
		$_sHTML .= '</textarea>';
		
		$_iCurrentCharCounter = $_iMaxLength;
		if ($_sText != '') {$_iCurrentCharCounter -= strlen($_sText);}
		$_sHTML .= '<br /><span id="'.$_sTextAreaID.'CharCounter" style="';
		if ($_iMaxLength > 0) {$_sHTML .= 'display:inline ';} else {$_sHTML .= 'display:none; ';}
		$_sHTML .= '">noch '.$_iCurrentCharCounter.' Zeichen</span>';
		
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'SendParams" name="'.$_sTextAreaID.'SendParams" value="'.$_sSendParameters.'" />';
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'Mode" name="'.$_sTextAreaID.'Mode" value="'.$_iTextAreaMode.'" />';
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'Required" name="'.$_sTextAreaID.'Required" ';
		if ($_bRequired == true) {$_sHTML .= 'value="1" ';} else {$_sHTML .= 'value="0" ';}
		$_sHTML .= ' />';
		
		// Counter...
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'MaxChars" name="'.$_sTextAreaID.'MaxChars" value="'.$_iMaxLength.'" />';
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'LineBreakCharCount" name="'.$_sTextAreaID.'LineBreakCharCount" value="'.$_iLineBreakCharCount.'" />';
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'FreeSpaceCharCount" name="'.$_sTextAreaID.'FreeSpaceCharCount" value="'.$_iFreeSpaceCharCount.'" />';

		// Is NoData...
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'NoData" value="'.$_sNoDataText.'" />';
		$_sHTML .= '<input type="hidden" id="'.$_sTextAreaID.'IsNoData" value="';
		if ($_sText != '') {$_sHTML .= '0';} else {$_sHTML .= '1';}
		$_sHTML .= '" />';

		return $_sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@return sEvent [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedEvent() {global $_POST; if (isset($_POST['sEvent'])) {return utf8_decode($_POST['sEvent']);} return NULL;}
	/* @end method */

	/*
	@start method
	
	@return sName [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedName() {global $_POST; if (isset($_POST['sName'])) {return utf8_decode($_POST['sName']);} return NULL;}
	/* @end method */

	/*
	@start method
	
	@return sText [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedText() {global $_POST; if (isset($_POST['sText'])) {return utf8_decode($_POST['sText']);} return NULL;}
	/* @end method */

	/*
	@start method
	
	@return sTextAreaID [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedTextareaID() {global $_POST; if (isset($_POST['sTextAreaID'])) {return utf8_decode($_POST['sTextAreaID']);} return NULL;}
	/* @end method */

	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setNetworkMainData(&$_oObject)
	{
		global $_POST;
		$_oObject->addNetworkData('PG_TextAreaID', utf8_decode($_POST['sTextAreaID']));
		$_oObject->addNetworkData('PG_TextAreaEvent', utf8_decode($_POST['sEvent']));
	}
	/* @end method */
	
	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param iStatusCode [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setNetworkActionStatus(&$_oObject, $_iStatusCode)
	{
		$_iStatusCode = $this->getRealParameter(array('oParameters' => $_iStatusCode, 'sName' => 'iStatusCode', 'xParameter' => $_iStatusCode));
		$_oObject->addNetworkData('PG_TextAreaActionStatus', $_iStatusCode, NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setNetworkJavaScriptToExecute(&$_oObject, $_sJavaScriptToExecute)
	{
		$_sJavaScriptToExecute = $this->getRealParameter(array('oParameters' => $_sJavaScriptToExecute, 'sName' => 'sJavaScriptToExecute', 'xParameter' => $_sJavaScriptToExecute));
		$_oObject->addNetworkData('PG_TextAreaJavaScriptToExecute', $_sJavaScriptToExecute, NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setXmlHead(&$_oXMLWrite)
	{
		global $_POST;
		$_oXMLWrite->setTextDataTag('PG_TextAreaEvent', utf8_decode($_POST['sEvent']), NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	
	@param iStatusCode [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setXmlActionStatus(&$_oXMLWrite, $_iStatusCode)
	{
		$_iStatusCode = $this->getRealParameter(array('oParameters' => $_iStatusCode, 'sName' => 'iStatusCode', 'xParameter' => $_iStatusCode));
		$_oXMLWrite->setNumDataTag('PG_TextAreaActionStatus', $_iStatusCode, NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setXmlJavaScriptToExecute(&$_oXMLWrite, $_sJavaScriptToExecute)
	{
		$_sJavaScriptToExecute = $this->getRealParameter(array('oParameters' => $_sJavaScriptToExecute, 'sName' => 'sJavaScriptToExecute', 'xParameter' => $_sJavaScriptToExecute));
		$_oXMLWrite->setCDataTag('PG_TextAreaJavaScriptToExecute', $_sJavaScriptToExecute, NULL);
	}
	/* @end method */
}
/* @end class */
$oPGTextArea = new classPG_TextArea();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGTextArea', 'xValue' => $oPGTextArea));}
?>