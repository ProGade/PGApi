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
define('PG_CHECKBOX_MODE_NONE', 0);
define('PG_CHECKBOX_MODE_AUTOSAVE', 1);

define('PG_CHECKBOX_STATUS_INDEX_STATUS', 0);
define('PG_CHECKBOX_STATUS_INDEX_VALUE', 1);
define('PG_CHECKBOX_STATUS_INDEX_IMAGE', 2);

define('PG_CHECKBOX_EVENT_ONCHANGE', 'OnChange');

define('PG_CHECKBOX_NETWORK_REQUESTTYPE', 'PG_CheckBoxNetworkRequestType');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_CheckBox extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGCheckBox'));
		$this->initClassBasics();
		$this->setGfxSubPath(array('sPath' => 'controls/'));
		
		// Templates...
		$_oTemplate = new classPG_Template();
		$_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
		$_oTemplate->setTemplates(
			array(
				'default' => 'gfx/default/templates/controls/default_checkbox.php',
				'bootstrap' => 'gfx/default/templates/controls/bootstrap_checkbox.php',
				'foundation' => 'gfx/default/templates/controls/foundation_checkbox.php'
			)
		);
		$this->setTemplate(array('xTemplate' => $_oTemplate));
	}

	// Methods...
	/*
	@start method
	
	@return sCheckBoxHtml [type]string[/type]
	[en]...[/en]
	
	@param sCheckBoxID [type]string[/type]
	[en]...[/en]
	
	@param iCheckBoxMode [type]int[/type]
	[en]...[/en]
	
	@param xSelectedStatus [type]mixed[/type]
	[en]...[/en]
	
	@param axStatusStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
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
	public function build(
		$_sCheckBoxID = NULL,
		$_iCheckBoxMode = NULL,
		$_sName = NULL,

		$_xSelectedStatus = NULL,
		$_axStatusStructure = NULL,

		$_sSendParameters = NULL,

		$_sOnClick = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL,
		
		$_sTemplateName = NULL
	)
	{
		global $oPGSprites;

		$_iCheckBoxMode = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'iCheckBoxMode', 'xParameter' => $_iCheckBoxMode));
		$_sName = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sName', 'xParameter' => $_sName));
		$_xSelectedStatus = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'xSelectedStatus', 'xParameter' => $_xSelectedStatus));
		$_axStatusStructure = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'axStatusStructure', 'xParameter' => $_axStatusStructure));
		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));
		$_sTemplateName = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sTemplateName', 'xParameter' => $_sTemplateName));
		$_sCheckBoxID = $this->getRealParameter(array('oParameters' => $_sCheckBoxID, 'sName' => 'sCheckBoxID', 'xParameter' => $_sCheckBoxID));
		
		if (($_sCheckBoxID === NULL) || ($_sCheckBoxID === '')) {$_sCheckBoxID = $this->getNextID();}
		if ($_iCheckBoxMode === NULL) {$_iCheckBoxMode = PG_CHECKBOX_MODE_NONE;}
		
		if ($_axStatusStructure === NULL)
		{
			$_axStatusStructure[] = $this->buildStatusStructure(array('xStatus' => 0, 'xValue' => NULL, 'sImage' => NULL));
			$_axStatusStructure[] = $this->buildStatusStructure(array('xStatus' => 1, 'xValue' => NULL, 'sImage' => NULL));
		}
		if ($_xSelectedStatus === NULL) {$_xSelectedStatus = $_axStatusStructure[0][PG_CHECKBOX_STATUS_INDEX_STATUS];}
		
		if ($_sSendParameters === NULL) {$_sSendParameters = '';}

		if ($_sOnClick === NULL) {$_sOnClick = '';}
		if ($_sOnMouseDown === NULL) {$_sOnMouseDown = '';}
		if ($_sOnMouseUp === NULL) {$_sOnMouseUp = '';}
		if ($_sOnMouseOver === NULL) {$_sOnMouseOver = '';}
		if ($_sOnMouseOut === NULL) {$_sOnMouseOut = '';}
		
		if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}
		
		$_sHtml = '';
		$_iDefaultStatus = 0;
		
		if (count($_axStatusStructure) == 2)
		{
			$i=0;
			$_sHtml .= '<input type="checkbox" id="'.$_sCheckBoxID.'Symbol" name="'.$_sCheckBoxID.'" ';
			if ($_xSelectedStatus == $_axStatusStructure[1][PG_CHECKBOX_STATUS_INDEX_STATUS]) {$_sHtml .= 'checked '; $_iDefaultStatus = 1;}
			if ($_sOnMouseDown !== '') {$_sHtml .= 'onmousedown="'.str_replace('"', '\"', $_sOnMouseDown).'" ';}
			if ($_sOnMouseUp !== '') {$_sHtml .= 'onmouseup="'.str_replace('"', '\"', $_sOnMouseUp).'" ';}
			if ($_sOnMouseOver !== '') {$_sHtml .= 'onmouseover="'.str_replace('"', '\"', $_sOnMouseOver).'" ';}
			if ($_sOnMouseOut !== '') {$_sHtml .= 'onmouseout="'.str_replace('"', '\"', $_sOnMouseOut).'" ';}
			$_sHtml .= 'onclick="';
			if ($_sOnClick !== '') {$_sHtml .= str_replace('"', '\"', $_sOnClick).' ';}
			$_sHtml .= 'oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''.$_sCheckBoxID.'\'}); ';
			$_sHtml .= '" value="1" />';
		}
		
		for ($i=0; $i<count($_axStatusStructure); $i++)
		{
			if (($_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_IMAGE] !== '') && ($_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_IMAGE] !== NULL))
			{
				if ((is_object($_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_IMAGE])) && (isset($oPGSprites)))
				{
					$_sHtml .= '<div id="'.$_sCheckBoxID.'Symbol'.$i.'" ';
					$_sHtml .= 'style="border-width:0px; float:left; cursor:pointer; ';
					if ($_xSelectedStatus == $_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_STATUS])
					{
						$_iDefaultStatus = $i;
						$_sHtml .= 'display:block; ';
					}
					else {$_sHtml .= 'display:none; ';}
					$_sHtml .= '" onclick="oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''.$_sCheckBoxID.'\', \'iStatusIndex\': '.$i.'});">';
					$_oSprite = $_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_IMAGE];
					$_sHtml .= $_oSprite->animate();
					$_sHtml .= '</div>';
				}
				else
				{
					$_sHtml .= '<img id="'.$_sCheckBoxID.'Symbol'.$i.'" ';
					$_sHtml .= 'src="'.$this->getGfxPathImages($_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_IMAGE]).'" ';
					$_sHtml .= 'style="border-width:0px; float:left; ';
					if ($_xSelectedStatus == $_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_STATUS])
					{
						$_iDefaultStatus = $i;
						$_sHtml .= 'display:inline; ';
					}
					else {$_sHtml .= 'display:none; ';}
					$_sHtml .= '" ';
					if ($_sOnMouseDown !== '') {$_sHtml .= 'onmousedown="'.str_replace('"', '\"', $_sOnMouseDown).'" ';}
					if ($_sOnMouseUp !== '') {$_sHtml .= 'onmouseup="'.str_replace('"', '\"', $_sOnMouseUp).'" ';}
					if ($_sOnMouseOver !== '') {$_sHtml .= 'onmouseover="'.str_replace('"', '\"', $_sOnMouseOver).'" ';}
					if ($_sOnMouseOut !== '') {$_sHtml .= 'onmouseout="'.str_replace('"', '\"', $_sOnMouseOut).'" ';}
					$_sHtml .= 'onclick="';
					if ($_sOnClick !== '') {$_sHtml .= str_replace('"', '\"', $_sOnClick).' ';}
					$_sHtml .= 'oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''.$_sCheckBoxID.'\', \'iStatusIndex\': '.$i.'}); ';
					$_sHtml .= '" />';
				}
			}
			else if (count($_axStatusStructure) > 2)
			{
				$_sHtml .= '<a id="'.$_sCheckBoxID.'Symbol'.$i.'" href="javascript:;" ';
				$_sHtml .= 'style="float:left; ';
				if ($_xSelectedStatus == $_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_STATUS])
				{
					$_iDefaultStatus = $i;
					$_sHtml .= 'display:inline; ';
				}
				else {$_sHtml .= 'display:none; ';}
				$_sHtml .= '" ';
				if ($_sOnMouseDown !== '') {$_sHtml .= 'onmousedown="'.str_replace('"', '\"', $_sOnMouseDown).'" ';}
				if ($_sOnMouseUp !== '') {$_sHtml .= 'onmouseup="'.str_replace('"', '\"', $_sOnMouseUp).'" ';}
				if ($_sOnMouseOver !== '') {$_sHtml .= 'onmouseover="'.str_replace('"', '\"', $_sOnMouseOver).'" ';}
				if ($_sOnMouseOut !== '') {$_sHtml .= 'onmouseout="'.str_replace('"', '\"', $_sOnMouseOut).'" ';}
				$_sHtml .= 'onclick="';
				if ($_sOnClick !== '') {$_sHtml .= str_replace('"', '\"', $_sOnClick).' ';}
				$_sHtml .= 'oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''.$_sCheckBoxID.'\', \'iStatusIndex\': '.$i.'}); ';
				$_sHtml .= '">'.$i.'</a>';
			}
			
			$_sHtml .= '<a href="javascript:;" onclick="oPGCheckBox.checkBoxOnClick({\'sCheckBoxID\': \''.$_sCheckBoxID.'\', \'iStatusIndex\': '.$i.'});" target="_self">';
			$_sHtml .= '<span id="'.$_sCheckBoxID.'Value'.$i.'" style="';
			if ($_xSelectedStatus == $_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_STATUS]) {$_sHtml .= 'display:inline; ';}
			else {$_sHtml .= 'display:none; ';}
			$_sHtml .= '">';
			if ($_sName == NULL) {$_sHtml .= $_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_VALUE];}
			else {$_sHtml .= $_sName;}
			$_sHtml .= '</span>';
			$_sHtml .= '</a>';
			$_sHtml .= '<input type="hidden" id="'.$_sCheckBoxID.'Status'.$i.'" value="'.htmlspecialchars($_axStatusStructure[$i][PG_CHECKBOX_STATUS_INDEX_STATUS]).'" />';
		}

		$_sHtml .= '<input type="hidden" id="'.$_sCheckBoxID.'CurrentStatus" name="'.$_sCheckBoxID.'Status" value="'.$_iDefaultStatus.'" />';
		$_sHtml .= '<input type="hidden" id="'.$_sCheckBoxID.'MaxStatus" value="'.count($_axStatusStructure).'" />';
		$_sHtml .= '<input type="hidden" id="'.$_sCheckBoxID.'SendParams" value="'.$_sSendParameters.'" />';
		$_sHtml .= '<input type="hidden" id="'.$_sCheckBoxID.'Mode" value="'.$_iCheckBoxMode.'" />';
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sEvent [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedEvent() {global $_POST; return utf8_decode($_POST['sEvent']);}
	/* @end method */

	/*
	@start method
	
	@return sStatus [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedStatus() {global $_POST; return utf8_decode($_POST['sStatus']);}
	/* @end method */

	/*
	@start method
	
	@return sValue [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedValue() {global $_POST; return utf8_decode($_POST['sValue']);}
	/* @end method */

	/*
	@start method
	
	@return sCheckBoxID [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedCheckBoxID() {global $_POST; return utf8_decode($_POST['sCheckBoxID']);}
	/* @end method */
	
	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	*/
	public function setNetworkMainData(&$_oObject)
	{
		global $_POST;
		$_oObject->addNetworkData('PG_CheckBoxID', utf8_decode($_POST['sCheckBoxID']));
		$_oObject->addNetworkData('PG_CheckBoxEvent', utf8_decode($_POST['sEvent']));
		$_oObject->addNetworkData('PG_CheckBoxStatus', utf8_decode($_POST['iStatus']));
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
		$_oObject->addNetworkData('PG_CheckBoxJavaScriptToExecute', $_sJavaScriptToExecute);
	}
	/* @end method */

	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setXMLHead(&$_oXMLWrite)
	{
		global $_POST;
		$_oXMLWrite->setTextDataTag('PG_CheckBoxEvent', utf8_decode($_POST['sEvent']), NULL);
		$_oXMLWrite->setTextDataTag('PG_CheckBoxStatus', utf8_decode($_POST['iStatus']), NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	
	@param sJavaScriptToExecute [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setXMLJavaScriptToExecute(&$_oXMLWrite, $_sJavaScriptToExecute)
	{
		$_sJavaScriptToExecute = $this->getRealParameter(array('oParameters' => $_sJavaScriptToExecute, 'sName' => 'sJavaScriptToExecute', 'xParameter' => $_sJavaScriptToExecute));
		$_oXMLWrite->setCDataTag('PG_CheckBoxJavaScriptToExecute', $_sJavaScriptToExecute, NULL);
	}
	/* @end method */

	/*
	@start method
	
	@return axStatusStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param xStatus [needed][type]mixed[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function buildStatusStructure($_xStatus, $_xValue = NULL, $_sImage = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_xStatus, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_sImage = $this->getRealParameter(array('oParameters' => $_xStatus, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$_xStatus = $this->getRealParameter(array('oParameters' => $_xStatus, 'sName' => 'xStatus', 'xParameter' => $_xStatus));
		return array($_xStatus, $_xValue, $_sImage);
	}
	/* @end method */
}
/* @end class */
$oPGCheckBox = new classPG_CheckBox();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCheckBox', 'xValue' => $oPGCheckBox));}
?>