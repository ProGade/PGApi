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
define('PG_INPUTFIELD_MODE_NONE', 0);
define('PG_INPUTFIELD_MODE_AUTOCOMPLETE', 1);	// Default autocomplete from os system
define('PG_INPUTFIELD_MODE_DROPDOWN', 2);		// Dropdown button on right of field
define('PG_INPUTFIELD_MODE_SEARCH', 4);			// Input is also searching
define('PG_INPUTFIELD_MODE_AUTOSAVE', 8);		// Save on select data (and on lost focus if all needed fields are filled)
define('PG_INPUTFIELD_MODE_CREATE', 16);		// allow creating data
define('PG_INPUTFIELD_MODE_UPDATE', 32);		// allow changing data
define('PG_INPUTFIELD_MODE_DELETE', 64);		// allow deleting data
define('PG_INPUTFIELD_MODE_READONLY', 128);
define('PG_INPUTFIELD_MODE_AUTOCLOSE', 256);
define('PG_INPUTFIELD_MODE_RESETONBLUR', 512);
define('PG_INPUTFIELD_MODE_RESETONDROPDOWNCLOSE', 1024);
define('PG_INPUTFIELD_MODE_AUTOSAVEONCREATE', 2048);
define('PG_INPUTFIELD_MODE_STREAMINGDROPDOWN', 4096);

define('PG_INPUTFIELD_TYPE_TEXT', 'text');
define('PG_INPUTFIELD_TYPE_EMAIL', 'email');
define('PG_INPUTFIELD_TYPE_DATE', 'date');
define('PG_INPUTFIELD_TYPE_DATETIME', 'datetime');
define('PG_INPUTFIELD_TYPE_DATETIMELOCAL', 'datetime-local');
define('PG_INPUTFIELD_TYPE_MONTH', 'month');
define('PG_INPUTFIELD_TYPE_NUMBER', 'number');
define('PG_INPUTFIELD_TYPE_PASSWORD', 'password');
define('PG_INPUTFIELD_TYPE_TEL', 'tel');
define('PG_INPUTFIELD_TYPE_TIME', 'time');
define('PG_INPUTFIELD_TYPE_URL', 'url');
define('PG_INPUTFIELD_TYPE_WEEK', 'week');
define('PG_INPUTFIELD_TYPE_SEARCH', 'search');

define('PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX', 0);
define('PG_INPUTFIELD_STRUCTURE_INDEX_NAME', 1);
define('PG_INPUTFIELD_STRUCTURE_INDEX_VALUE', 2);
define('PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE', 3);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ACCESSKEY', 4);
define('PG_INPUTFIELD_STRUCTURE_INDEX_REQUIRED', 5);
define('PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH', 6);
define('PG_INPUTFIELD_STRUCTURE_INDEX_TYPE', 7);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR', 8);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS', 9);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN', 10);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP', 11);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK', 12);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN', 13);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP', 14);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER', 15);
define('PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT', 16);

define('PG_INPUTFIELD_DATASET_INDEX_ID', 0);
define('PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE', 1);

define('PG_INPUTFIELD_ACTIONSTATUS_FAILED', 0);
define('PG_INPUTFIELD_ACTIONSTATUS_SUCCESS', 1);

define('PG_INPUTFIELD_EVENT_ONBLUR', 'OnBlur');
define('PG_INPUTFIELD_EVENT_ONSEARCH', 'OnSearch');
define('PG_INPUTFIELD_EVENT_ONSTREAM', 'OnStream');
define('PG_INPUTFIELD_EVENT_ONSELECT_DATASET', 'OnSelectDataset');
define('PG_INPUTFIELD_EVENT_ONCREATE_DATASET', 'OnCreateDataset');
define('PG_INPUTFIELD_EVENT_ONUPDATE_DATASET', 'OnUpdateDataset');
define('PG_INPUTFIELD_EVENT_ONDELETE_DATASET', 'OnDeleteDataset');

define('PG_INPUTFIELD_NETWORK_REQUESTTYPE', 'PG_InputFieldNetworkRequestType');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_InputField extends classPG_ClassBasics
{
	// Declarations...
	private $iDropdownZIndex = 100000;
	
	private $sImageDropdownButtonLeft = 'button_left.gif';
	private $sImageDropdownButtonRight = 'button_right.gif';
	private $sImageDropdownButtonLeftHover = 'button_left_hover.gif';
	private $sImageDropdownButtonRightHover = 'button_right_hover.gif';
	private $sImageDropdownButton = 'button_dropdown.gif';
	private $sImageDropdownButtonHover = 'button_dropdown_hover.gif';
	private $sImageDropdownButtonHide = 'button_dropdown_hide.gif';
	private $sImageDropdownButtonHideHover = 'button_dropdown_hide_hover.gif';
	
	private $sCssStyleInputFieldDatasetHover = 'background-color:#A1C6F0; color:#000000;';
	private $sCssStyleInputField = 'background-color:#FFFFFF; color:#000000; border:solid 1px #000000;';
	private $sCssStyleInputFieldNoData = 'background-color:#FFFFFF; color:#CCCCCC; border:solid 1px #707070;';
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGInputField'));
		$this->initClassBasics();
		$this->setGfxSubPath(array('sPath' => 'controls/'));
		$this->setText(
			array('xType' =>
				array(
					'DeleteQuestion' => 'delete?',
					'YesButton' => 'yes',
					'NoButton' => 'no',
					'SwitchEditModeButton' => 'switch edit mode',
					'CreateDatasetButton' => 'create dataset',
					'UpdateDatasetButton' => 'update dataset',
					'DeleteDatasetButton' => 'delete'
				)
			)
		);

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_inputfield.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_inputfield.php',
                'foundation' => 'gfx/default/templates/controls/foundation_inputfield.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }

	// Methods...
	/*
	@start method
	
	@param iZIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDropdownZIndex($_iZIndex)
	{
		$_iZIndex = $this->getRealParameter(array('oParameters' => $_iZIndex, 'sName' => 'iZIndex', 'xParameter' => $_iZIndex));
		$this->iDropdownZIndex = $_iZIndex;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iZIndex [type]int[/type]
	[en]...[/en]
	*/
	public function getDropdownZIndex() {return $this->iDropdownZIndex;}
	/* @end method */
	
	/*
	@start method
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImageDropdownButton($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageDropdownButton = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImageDropdownButtonHover($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageDropdownButtonHover = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImageDropdownButtonHide($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageDropdownButtonHide = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImageDropdownButtonHideHover($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sImageDropdownButtonHideHover = $_sImage;
	}
	/* @end method */

	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCssStyleInputFieldDatasetHover($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleInputFieldDatasetHover = $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getCssStyleInputFieldDatasetHover() {return $this->sCssStyleInputFieldDatasetHover;}
	/* @end method */

	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCssStyleInputField($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleInputField = $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getCssStyleInputField() {return $this->sCssStyleInputField;}
	/* @end method */

	/*
	@start method
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCssStyleInputFieldNoData($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleInputFieldNoData = $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getCssStyleInputFieldNoData() {return $this->sCssStyleInputFieldNoData;}
	/* @end method */

	/*
	@start method
	
	@return sInputFieldHtml [type]string[/type]
	[en]...[/en]
	
	@param sInputFieldID [type]string[/type]
	[en]...[/en]
	
	@param iInputFieldMode [type]int[/type]
	[en]...[/en]
	
	@param iFieldSizeX [type]int[/type]
	[en]...[/en]
	
	@param sFieldName [type]string[/type]
	[en]...[/en]
	
	@param xFieldValue [type]mixed[/type]
	[en]...[/en]
	
	@param xFieldNoValue [type]mixed[/type]
	[en]...[/en]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]...[/en]
	
	@param sFieldAccessKey [type]string[/type]
	[en]...[/en]
	
	@param bFieldRequired [type]bool[/type]
	[en]...[/en]
	
	@param iFieldMaxLength [type]int[/type]
	[en]...[/en]
	
	@param iFieldTabIndex [type]int[/type]
	[en]...[/en]
	
	@param sFieldType [type]string[/type]
	[en]...[/en]
	
	@param iDropdownZIndex [type]int[/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldBlur [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldFocus [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldKeyDown [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldKeyUp [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldClick [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldMouseDown [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldMouseUp [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldMouseOver [type]string[/type]
	[en]...[/en]
	
	@param sOnFieldMouseOut [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]...[/en]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]...[/en]
	*/
	public function build(
		$_sInputFieldID = NULL,
		$_iInputFieldMode = NULL,
		$_iFieldSizeX = NULL,

		$_sFieldName = NULL,
		$_xFieldValue = NULL,
		$_xFieldNoValue = NULL,
		$_xFieldDatasetID = NULL,

		$_sFieldAccessKey = NULL,
		$_bFieldRequired = NULL,
		$_iFieldMaxLength = NULL,
		$_iFieldTabIndex = NULL,
		$_sFieldType = NULL,
		$_iDropdownZIndex = NULL,

		$_axDatasets = NULL,

		$_sSendParameters = NULL,

		$_sOnFieldBlur = NULL,
		$_sOnFieldFocus = NULL,
		$_sOnFieldKeyDown = NULL,
		$_sOnFieldKeyUp = NULL,

		$_sOnFieldClick = NULL,
		$_sOnFieldMouseDown = NULL,
		$_sOnFieldMouseUp = NULL,
		$_sOnFieldMouseOver = NULL,
		$_sOnFieldMouseOut = NULL,

		$_sOnDatasetSelect = NULL,
		$_sOnSwitchEditMode = NULL,
		$_sOnDatasetCreate = NULL,
		$_sOnDatasetUpdate = NULL,
		$_sOnDatasetDelete = NULL,

        $_sTemplateName = NULL
    )
	{
		$_iInputFieldMode = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'iInputFieldMode', 'xParameter' => $_iInputFieldMode));
		$_iFieldSizeX = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'iFieldSizeX', 'xParameter' => $_iFieldSizeX));

		$_sFieldName = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sFieldName', 'xParameter' => $_sFieldName));
		$_xFieldValue = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'xFieldValue', 'xParameter' => $_xFieldValue));
		$_xFieldNoValue = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'xFieldNoValue', 'xParameter' => $_xFieldNoValue));
		$_xFieldDatasetID = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'xFieldDatasetID', 'xParameter' => $_xFieldDatasetID));

		$_sFieldAccessKey = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sFieldAccessKey', 'xParameter' => $_sFieldAccessKey));
		$_bFieldRequired = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'bFieldRequired', 'xParameter' => $_bFieldRequired));
		$_iFieldMaxLength = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'iFieldMaxLength', 'xParameter' => $_iFieldMaxLength));
		$_iFieldTabIndex = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'iFieldTabIndex', 'xParameter' => $_iFieldTabIndex));
		$_sFieldType = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sFieldType', 'xParameter' => $_sFieldType));
		$_iDropdownZIndex = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => '_DropdownZIndex', 'xParameter' => $_iDropdownZIndex));

		$_axDatasets = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'axDatasets', 'xParameter' => $_axDatasets));

		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));

		$_sOnFieldBlur = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldBlur', 'xParameter' => $_sOnFieldBlur));
		$_sOnFieldFocus = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldFocus', 'xParameter' => $_sOnFieldFocus));
		$_sOnFieldKeyDown = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldKeyDown', 'xParameter' => $_sOnFieldKeyDown));
		$_sOnFieldKeyUp = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldKeyUp', 'xParameter' => $_sOnFieldKeyUp));

		$_sOnFieldClick = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldClick', 'xParameter' => $_sOnFieldClick));
		$_sOnFieldMouseDown = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldMouseDown', 'xParameter' => $_sOnFieldMouseDown));
		$_sOnFieldMouseUp = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldMouseUp', 'xParameter' => $_sOnFieldMouseUp));
		$_sOnFieldMouseOver = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldMouseOver', 'xParameter' => $_sOnFieldMouseOver));
		$_sOnFieldMouseOut = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnFieldMouseOut', 'xParameter' => $_sOnFieldMouseOut));

		$_sOnDatasetSelect = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetSelect', 'xParameter' => $_sOnDatasetSelect));
		$_sOnSwitchEditMode = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnSwitchEditMode', 'xParameter' => $_sOnSwitchEditMode));
		$_sOnDatasetCreate = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetCreate', 'xParameter' => $_sOnDatasetCreate));
		$_sOnDatasetUpdate = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetUpdate', 'xParameter' => $_sOnDatasetUpdate));
		$_sOnDatasetDelete = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetDelete', 'xParameter' => $_sOnDatasetDelete));

		$_sInputFieldID = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sInputFieldID', 'xParameter' => $_sInputFieldID));

		if (($_sInputFieldID === NULL) || ($_sInputFieldID === '')) {$_sInputFieldID = $this->getNextID();}
		if (($_iFieldSizeX === NULL) || ($_iFieldSizeX === 0)) {$_iFieldSizeX = 150;}
		if ($_bFieldRequired === NULL) {$_bFieldRequired = false;}
		
		$_axFieldStructures[] = $this->buildFieldStructure(
			array(
				'iSizeX' => $_iFieldSizeX, 'sName' => $_sFieldName, 'xValue' => $_xFieldValue, 'xNoValue' => $_xFieldNoValue,
				'sAccessKey' => $_sFieldAccessKey, 'bRequired' => $_bFieldRequired, 'iMaxLength' => $_iFieldMaxLength, 'sType' => $_sFieldType,
				'sOnBlur' => $_sOnFieldBlur, 'sOnFocus' => $_sOnFieldFocus, 'sOnKeyDown' => $_sOnFieldKeyDown, 'sOnKeyUp' => $_sOnFieldKeyUp,
				'sOnClick' => $_sOnFieldClick, 'sOnMouseDown' => $_sOnFieldMouseDown, 'sOnMouseUp' => $_sOnFieldMouseUp, 'sOnMouseOver' => $_sOnFieldMouseOver, 'sOnMouseOut' => $_sOnFieldMouseOut
			)
		);

		return $this->buildMulti(
			array(
				'sInputFieldID' => $_sInputFieldID, 'iInputFieldMode' => $_iInputFieldMode,
				'axFieldStructures' => $_axFieldStructures, 'xFieldDatasetID' => $_xFieldDatasetID,
				'iTabIndex' => $_iFieldTabIndex, 'iDropdownZIndex' => $_iDropdownZIndex,
				'axDatasets' => $_axDatasets,
				'sSendParameters' => $_sSendParameters,
				'sOnDatasetSelect' => $_sOnDatasetSelect, 'sOnSwitchEditMode' => $_sOnSwitchEditMode, 'sOnDatasetCreate' => $_sOnDatasetCreate, 'sOnDatasetUpdate' => $_sOnDatasetUpdate, 'sOnDatasetDelete' =>  $_sOnDatasetDelete
			)
		);
	}
	/* @end method */

	/*
	@start method
	
	@return sInputFieldHtml [type]string[/type]
	[en]...[/en]
	
	@param sInputFieldID [type]string[/type]
	[en]...[/en]
	
	@param iInputFieldMode [type]int[/type]
	[en]...[/en]
	
	@param axFieldStructures [type]mixed[][/type]
	[en]...[/en]
	
	@param xFieldDatasetID [type]mixed[/type]
	[en]...[/en]
	
	@param iTabIndex [type]int[/type]
	[en]...[/en]
	
	@param iDropdownZIndex [type]int[/type]
	[en]...[/en]
	
	@param axDatasets [type]mixed[][/type]
	[en]...[/en]
	
	@param sSendParameters [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetSelect [type]string[/type]
	[en]...[/en]
	
	@param sOnSwitchEditMode [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetCreate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetUpdate [type]string[/type]
	[en]...[/en]
	
	@param sOnDatasetDelete [type]string[/type]
	[en]...[/en]
	*/
	public function buildMulti(
		$_sInputFieldID = NULL,
		$_iInputFieldMode = NULL,

		$_axFieldStructures = NULL,
		$_xFieldDatasetID = NULL,

		$_iTabIndex = NULL,
		$_iDropdownZIndex = NULL,

		$_axDatasets = NULL,

		$_sSendParameters = NULL,

		$_sOnDatasetSelect = NULL,
		$_sOnSwitchEditMode = NULL,
		$_sOnDatasetCreate = NULL,
		$_sOnDatasetUpdate = NULL,
		$_sOnDatasetDelete = NULL
	)
	{
		global $oPGButton;
		
		$_iInputFieldMode = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'iInputFieldMode', 'xParameter' => $_iInputFieldMode));
		
		$_axFieldStructures = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'axFieldStructures', 'xParameter' => $_axFieldStructures));
		$_xFieldDatasetID = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'xFieldDatasetID', 'xParameter' => $_xFieldDatasetID));

		$_iTabIndex = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'iTabIndex', 'xParameter' => $_iTabIndex));
		$_iDropdownZIndex = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => '_DropdownZIndex', 'xParameter' => $_iDropdownZIndex));

		$_axDatasets = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'axDatasets', 'xParameter' => $_axDatasets));

		$_sSendParameters = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sSendParameters', 'xParameter' => $_sSendParameters));

		$_sOnDatasetSelect = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetSelect', 'xParameter' => $_sOnDatasetSelect));
		$_sOnSwitchEditMode = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnSwitchEditMode', 'xParameter' => $_sOnSwitchEditMode));
		$_sOnDatasetCreate = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetCreate', 'xParameter' => $_sOnDatasetCreate));
		$_sOnDatasetUpdate = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetUpdate', 'xParameter' => $_sOnDatasetUpdate));
		$_sOnDatasetDelete = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sOnDatasetDelete', 'xParameter' => $_sOnDatasetDelete));

		$_sInputFieldID = $this->getRealParameter(array('oParameters' => $_sInputFieldID, 'sName' => 'sInputFieldID', 'xParameter' => $_sInputFieldID));

		if (($_sInputFieldID === NULL) || ($_sInputFieldID === '')) {$_sInputFieldID = $this->getNextID();}
		if (($_iInputFieldMode === NULL) || ($_iInputFieldMode === 0)) {$_iInputFieldMode = PG_INPUTFIELD_MODE_NONE;}
		
		if ($_xFieldDatasetID === NULL) {$_xFieldDatasetID = '';}
		if ($_iInputFieldMode === NULL) {$_iInputFieldMode = 0;}
		if ($_sSendParameters === NULL) {$_sSendParameters = '';}
		if ($_axFieldStructures === NULL) {$_axFieldStructures = $this->buildFieldStructure(array('iSizeX' => 150, 'sName' => $_sInputFieldID));}
		if ($_iDropdownZIndex === NULL) {$_iDropdownZIndex = $this->iDropdownZIndex;}
		
		$_iFullSizeX = 0;
		$_sHTML = '';
		$_sHTML .= '<div id="'.$_sInputFieldID.'" style="float:left; position:relative;" ';
		$_sHTML .= 'onmouseover="oPGInputField.inputFieldOnMouseOver({\'sInputFieldID\': \''.$_sInputFieldID.'\'});" ';
		$_sHTML .= 'onmouseout="oPGInputField.inputFieldOnMouseOut({\'sInputFieldID\': \''.$_sInputFieldID.'\'});" ';
		$_sHTML .= '>';
		$_sHTML .= '<table style="border-width:0px;" cellpadding="0" cellspacing="0">';
		$_sHTML .= '<tr>';
			for ($i=0; $i<count($_axFieldStructures); $i++)
			{
				if ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME] == '') {$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME] = $_sInputFieldID.'Field'.$i;}
				if ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX] < 1) {$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX] = 150;}
				if ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] === NULL) {$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] = '';}
				if ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE] === NULL) {$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE] = '';}
				$_iFullSizeX += $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX]+2;
				
				// Field...
				$_sHTML .= '<td>';
				$_sHTML .= '<input type="'.$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_TYPE].'" id="'.$_sInputFieldID.'Field'.$i.'" style="';
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== NULL)) {$_sHTML .= $this->sCssStyleInputField.' ';}
				else {$_sHTML .= $this->sCssStyleInputFieldNoData.' ';}
				$_sHTML .= 'padding-left:0px; padding-right:0px; margin-left:0px; margin-right:0px; ';
				$_sHTML .= 'width:'.$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX].'px; ';
				$_sHTML .= '" name="'.$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME].'" ';
				if ($_iTabIndex > 0) {$_sHTML .= 'tabindex="'.($_iTabIndex+$i).'" ';}
				if (!$this->isMode(array('iMode' => PG_INPUTFIELD_MODE_AUTOCOMPLETE, 'iCurrentMode' => $_iInputFieldMode))) {$_sHTML .= 'autocomplete="off" ';}
				if ($this->isMode(array('iMode' => PG_INPUTFIELD_MODE_READONLY, 'iCurrentMode' => $_iInputFieldMode))) {$_sHTML .= 'readonly ';}
				if ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH] > 0) {$_sHTML .= 'maxlength="'.$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH].'" ';}
				
				// KeyDown...
				$_sHTML .= 'onkeydown="';
					if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN] !== NULL))
					{
						$_sHTML .= str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN]).' ';
					}
					$_sHTML .= 'oPGInputField.inputFieldOnKeyDown({\'sInputFieldID\': \''.$_sInputFieldID.'\'}); ';
				$_sHTML .= '" ';
				
				// KeyUp...
				$_sHTML .= 'onkeyup="';
					if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP] !== NULL))
					{
						$_sHTML .= str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP]).' ';
					}
					$_sHTML .= 'oPGInputField.inputFieldOnKeyUp({\'sInputFieldID\': \''.$_sInputFieldID.'\'}); ';
				$_sHTML .= '" ';
				
				// OnBlur...
				$_sHTML .= 'onblur="';
					if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR] !== NULL))
					{
						$_sHTML .= str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR]).' ';
					}
					$_sHTML .= 'oPGInputField.inputFieldOnBlur({\'sInputFieldID\': \''.$_sInputFieldID.'\', \'iFieldIndex\': '.$i.'}); ';
				$_sHTML .= '" ';
				
				// OnFocus...
				$_sHTML .= 'onfocus="';
					if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS] !== NULL))
					{
						$_sHTML .= str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS]).' ';
					}
					$_sHTML .= 'oPGInputField.inputFieldOnFocus({\'sInputFieldID\': \''.$_sInputFieldID.'\', \'iFieldIndex\': '.$i.'}); ';
				$_sHTML .= '" ';
				
				// OnClick...
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK] !== NULL))
				{
					$_sHTML .= 'onclick="'.str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK]).'"';
				}
				
				// OnMouseDown...
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN] !== NULL))
				{
					$_sHTML .= 'onmousedown="'.str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN]).'"';
				}
				
				// OnMouseUp...
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP] !== NULL))
				{
					$_sHTML .= 'onmouseup="'.str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP]).'"';
				}
				
				// OnMouseOver...
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER] !== NULL))
				{
					$_sHTML .= 'onmouseover="'.str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER]).'"';
				}
				
				// OnMouseOut...
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT] !== NULL))
				{
					$_sHTML .= 'onmouseout="'.str_replace('"', '\"', $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT]).'"';
				}
				
				// Value...
				$_sHTML .= 'value="';
					if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== NULL))
					{
						$_sHTML .= $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE];
					}
					else {$_sHTML .= $_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE];}
				$_sHTML .= '" />';
				
				// Required...
				$_sHTML .= '<input type="hidden" id="'.$_sInputFieldID.'Field'.$i.'Required" ';
				if ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_REQUIRED] == true) {$_sHTML .= 'value="1" ';} else {$_sHTML .= 'value="0" ';}
				$_sHTML .= ' name="'.$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NAME].'Required" />';
				
				// IsNoData/NoValue...
				$_sHTML .= '<input type="hidden" id="'.$_sInputFieldID.'Field'.$i.'NoData" value="'.$_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE].'" />';
				$_sHTML .= '<input type="hidden" id="'.$_sInputFieldID.'Field'.$i.'IsNoData" value="';
				if (($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== '') && ($_axFieldStructures[$i][PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] !== NULL)) {$_sHTML .= '0';}
				else {$_sHTML .= '1';}
				$_sHTML .= '" />';

				$_sHTML .= '</td>';
			}
			
			// Dropdown...
			if ($this->isMode(array('iMode' => PG_INPUTFIELD_MODE_DROPDOWN, 'iCurrentMode' => $_iInputFieldMode)))
			{
				// Dropdown button...
				// TODO: austauschen durch controls button?
				$_sHTML .= '<td>';
					if (isset($oPGButton))
					{
						$_sHTML .= $oPGButton->build(
							array(
								'sButtonID' => $_sInputFieldID.'DropdownButton',
								'sText' => '&gt;',
								'sSizeX' => '20px',
								'sSizeY' => '17px',
								'sOnClick' => 'oPGInputField.switchDropdown({\'sInputFieldID\': \''.$_sInputFieldID.'\'});'
							)
						);
					}
					else
					{
						$_sHTML .= '<div ';
						$_sHTML .= 'onmouseover="oPGInputField.changeDropdownButton({\'sInputFieldID\': \''.$_sInputFieldID.'\', \'sToDisplay\': \'Hover\'});" ';
						$_sHTML .= 'onmouseout="oPGInputField.changeDropdownButton({\'sInputFieldID\': \''.$_sInputFieldID.'\', \'sToDisplay\': \'Normal\'});" ';
						// $_sHTML .= 'class="'.$this->sCssClassButton.'" ';
						$_sHTML .= '>';
						$_sHTML .= '<table id="'.$_sInputFieldID.'DropdownButtonNormal" ';
						$_sHTML .= 'onclick="oPGInputField.showDropdown({\'sInputFieldID\': \''.$_sInputFieldID.'\'});" ';
						$_sHTML .= 'style="display:block; border-width:0px;" cellpadding="0" cellspacing="0">';
						$_sHTML .= '<tr>';
							if ($this->sImageDropdownButtonLeft != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonLeft)).'" style="border-width:0px;" unselectable="on" /></td>';}
							$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButton)).'" style="border-width:0px;" unselectable="on" /></td>';
							if ($this->sImageDropdownButtonRight != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonRight)).'" style="border-width:0px;" unselectable="on" /></td>';}
						$_sHTML .= '</tr>';
						$_sHTML .= '</table>';
						$_sHTML .= '<table id="'.$_sInputFieldID.'DropdownButtonHover" ';
						$_sHTML .= 'onclick="oPGInputField.showDropdown({\'sInputFieldID\': \''.$_sInputFieldID.'\'});" ';
						$_sHTML .= 'style="display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
						$_sHTML .= '<tr>';
							if ($this->sImageDropdownButtonLeftHover != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonLeftHover)).'" style="border-width:0px;" unselectable="on" /></td>';}
							$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonHover)).'" style="border-width:0px;" unselectable="on" /></td>';
							if ($this->sImageDropdownButtonRightHover != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonRightHover)).'" style="border-width:0px;" unselectable="on" /></td>';}
						$_sHTML .= '</tr>';
						$_sHTML .= '</table>';
						$_sHTML .= '<table id="'.$_sInputFieldID.'DropdownButtonHideNormal" ';
						$_sHTML .= 'onclick="oPGInputField.hideDropdown({\'sInputFieldID\': \''.$_sInputFieldID.'\'});" ';
						$_sHTML .= 'style="display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
						$_sHTML .= '<tr>';
							if ($this->sImageDropdownButtonLeft != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonLeft)).'" style="border-width:0px;" unselectable="on" /></td>';}
							$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonHide)).'" style="border-width:0px;" unselectable="on" /></td>';
							if ($this->sImageDropdownButtonRight != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonRight)).'" style="border-width:0px;" unselectable="on" /></td>';}
						$_sHTML .= '</tr>';
						$_sHTML .= '</table>';
						$_sHTML .= '<table id="'.$_sInputFieldID.'DropdownButtonHideHover" ';
						$_sHTML .= 'onclick="oPGInputField.hideDropdown({\'sInputFieldID\': \''.$_sInputFieldID.'\'});" ';
						$_sHTML .= 'style="display:none; border-width:0px;" cellpadding="0" cellspacing="0">';
						$_sHTML .= '<tr>';
							if ($this->sImageDropdownButtonLeftHover != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonLeftHover)).'" style="border-width:0px;" unselectable="on" /></td>';}
							$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonHideHover)).'" style="border-width:0px;" unselectable="on" /></td>';
							if ($this->sImageDropdownButtonRightHover != '') {$_sHTML .= '<td><img src="'.$this->getGfxPathImages(array('sImage' => $this->sImageDropdownButtonRightHover)).'" style="border-width:0px;" unselectable="on" /></td>';}
						$_sHTML .= '</tr>';
						$_sHTML .= '</table>';
						$_sHTML .= '</div>';
					}
				$_sHTML .= '</td>';
			}
			
		$_sHTML .= '</tr>';
		$_sHTML .= '</table>';
		
		// Dropdown...
		if ($this->isMode(array('iMode' => PG_INPUTFIELD_MODE_DROPDOWN, 'iCurrentMode' => $_iInputFieldMode)))
		{
			// Dropdown div...
			$_sHTML .= '<div id="'.$_sInputFieldID.'DropdownDiv" style="position:absolute; top:0px; left:0px; display:none; ';
			if ($_iDropdownZIndex !== NULL) {$_sHTML .= 'z-index:'.$_iDropdownZIndex.'; ';}
			$_sHTML .= 'width:'.($_iFullSizeX+22).'px; border:solid 1px #000000; background-color:#FFFFFF;">';
				$_sHTML .= '<div id="'.$_sInputFieldID.'DropdownDataDiv" style="overflow:auto; width:'.($_iFullSizeX+22).'px; height:150px;">';
				for ($i=0; $i<count($_axDatasets); $i++)
				{
					$_sHighlightArray = 'new Array(\''.$_sInputFieldID.'Dataset'.$i.'\')';
					
					$_sHTML .= '<table id="'.$_sInputFieldID.'Dataset'.$i.'" style="border-collapse:collapse; cursor:default;" ';
					$_sHTML .= 'onmouseover="if (typeof(oPGHover) != \'undefined\') {oPGHover.showHighlight('.$_sHighlightArray.', \'border-collapse:collapse; cursor:default; '.$this->sCssStyleInputFieldDatasetHover.'\');}" ';
					$_sHTML .= 'onmouseout="if (typeof(oPGHover) != \'undefined\') {oPGHover.hideHighlight();}" ';
					$_sHTML .= 'cellpadding="0" cellspacing="0">';
					$_sHTML .= '<tr>';
						$_sHTML .= '<td id="'.$_sInputFieldID.'Dataset'.$i.'Panel" style="display:none; border-style:solid; border-color:#CCCCCC; border-top-width:0px; border-bottom-width:1px; border-left-width:1px; border-right-width:1px; padding:0px;">';
						// $_sHTML .= '<span onclick="oPGInputField.showDatasetQuestion(\''.$_sInputFieldID.'\', \'delete?\', \'oPGInputField.inputFieldOnDeleteDatasetWithIndex(\\\''.$_sInputFieldID.'\\\', '.$i.');\', \'\');">[del]</span>';
						$_bEditable = true;
						if ($_axDatasets[$i][PG_INPUTFIELD_DATASET_INDEX_ID] < 0)
						{
							$_bEditable = false;
						}
						if ($_bEditable == true)
						{
							$_iButtonMode = 0;
							$_sButtonDisplayValue = $this->getText(array('sType' => 'DeleteDatasetButton'));
							$_sButtonOnClick = '';
							$_sButtonOnClick .= "oPGInputField.showDatasetQuestion({";
							$_sButtonOnClick .= "'sInputFieldID': '".$_sInputFieldID."', ";
							$_sButtonOnClick .= "'sQuestion': '".$this->getText(array('sType' => 'DeleteQuestion'))."', ";
							$_sButtonOnClick .= "'sExecuteOnYes': 'oPGInputField.inputFieldOnDeleteDatasetWithIndex({\'sInputFieldID\': \'".$_sInputFieldID."\', \'iIndex\': ".$i."});', ";
							$_sButtonOnClick .= "'sExecuteOnNo': ''});";
							$_sHTML .= $oPGButton->build(
								array(
									'sButtonID' => $_sInputFieldID.'Dataset'.$i.'DeleteButton', 
									'sText' => $_sButtonDisplayValue, 
									'iButtonMode' => $_iButtonMode, 
									'sOnClick' => $_sButtonOnClick
								)
							);
						}
						$_sHTML .= '</td>';
						for ($t=PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE; $t<count($_axDatasets[$i]); $t++)
						{
							if (count($_axFieldStructures) > $t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE) {$_iSizeX = $_axFieldStructures[$t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE][PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX]+1;}
							else {$_iSizeX = 151;}
							$_sHTML .= '<td onclick="';
							$_sHTML .= 'oPGInputField.inputFieldOnSelectDataset({\'sInputFieldID\': \''.$_sInputFieldID.'\', \'iDatasetIndex\': '.$i.'}); ';
							if (($_sOnDatasetSelect !== '') && ($_sOnDatasetSelect !== NULL)) {$_sHTML .= str_replace('"', '\"', $_sOnDatasetSelect);}
							$_sHTML .= '" ';
							$_sHTML .= 'style="border-style:solid; border-color:#CCCCCC; border-top-width:0px; border-bottom-width:1px; border-left-width:1px; border-right-width:1px; padding:0px;">';
							$_sHTML .= '<div style="width:'.$_iSizeX.'px; overflow:hidden; cursor:default; background-color:transparent;">';
							$_sHTML .= $_axDatasets[$i][$t];
							$_sHTML .= '<input type="hidden" id="'.$_sInputFieldID.'Dataset'.$i.'Field'.($t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE).'" value="'.$_axDatasets[$i][$t].'" />';
							$_sHTML .= '</div>';
							$_sHTML .= '</td>';
						}
					$_sHTML .= '</tr>';
					$_sHTML .= '</table>';
					$_sHTML .= '<input type="hidden" id="'.$_sInputFieldID.'Dataset'.$i.'ID" value="'.$_axDatasets[$i][PG_INPUTFIELD_DATASET_INDEX_ID].'" />';
					$_sHTML .= '<input type="hidden" id="'.$_sInputFieldID.'Dataset'.$i.'FieldCount" value="'.(count($_axDatasets[$i])-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE).'" />';
				}
				$_sHTML .= '</div>';
				$_sHTML .= '<div style="text-align:center; overflow:hidden; width:'.($_iFullSizeX+22).'px;">';
				if ($this->isMode(array('iMode' => PG_INPUTFIELD_MODE_CREATE, 'iCurrentMode' => $_iInputFieldMode)))
				{
					$_iButtonMode = 0;
					$_sButtonDisplayValue = $this->getText(array('sType' => 'CreateDatasetButton'));
					$_sButtonOnClick = '';
					$_sButtonOnClick .= 'oPGInputField.inputFieldOnCreateDataset({\'sInputFieldID\': \''.$_sInputFieldID.'\'}); ';
					if (($_sOnDatasetCreate !== '') && ($_sOnDatasetCreate !== NULL)) {$_sButtonOnClick .= $_sOnDatasetCreate.' ';}
					$_sButtonOnClick .= "window.setTimeout('oPGInputField.showDropdown({\'sInputFieldID\': \'".$_sInputFieldID."\'})', 100);";
					$_sHTML .= $oPGButton->build(
						array(
							'sButtonID' => $_sInputFieldID.'DatasetCreateButton',
							'sText' => $_sButtonDisplayValue, 
							'iButtonMode' => $_iButtonMode, 
							'sOnClick' => $_sButtonOnClick, 
							'sSizeX' => '100%'
						)
					);
				}

				if ($this->isMode(array('iMode' => PG_INPUTFIELD_MODE_UPDATE, 'iCurrentMode' => $_iInputFieldMode)))
				{
					$_iButtonMode = 0;
					$_sButtonDisplayValue = $this->getText(array('sType' => 'UpdateDatasetButton'));
					$_sButtonOnClick = '';
					$_sButtonOnClick .= 'oPGInputField.inputFieldOnUpdateDataset({\'sInputFieldID\': \''.$_sInputFieldID.'\'}); ';
					if (($_sOnDatasetUpdate !== '') && ($_sOnDatasetUpdate !== NULL)) {$_sButtonOnClick .= $_sOnDatasetUpdate.' ';}
					$_sButtonOnClick .= "window.setTimeout('oPGInputField.showDropdown({\'sInputFieldID\': \'".$_sInputFieldID."\'})', 100);";
					$_sHTML .= $oPGButton->build(
						array(
							'sButtonID' => $_sInputFieldID.'DatasetUpdateButton', 
							'sText' => $_sButtonDisplayValue, 
							'iButtonMode' => $_iButtonMode, 
							'sOnClick' => $_sButtonOnClick, 
							'sSizeX' => '100%'
						)
					);
				}

				if ($this->isMode(array('iMode' => PG_INPUTFIELD_MODE_DELETE, 'iCurrentMode' => $_iInputFieldMode)))
				{
					$_iButtonMode = 0;
					$_sButtonDisplayValue = $this->getText(array('sType' => 'SwitchEditModeButton'));
					$_sButtonOnClick = '';
					$_sButtonOnClick .= 'oPGInputField.inputFieldOnSwitchDatasetEditMode({\'sInputFieldID\': \''.$_sInputFieldID.'\'}); ';
					if (($_sOnSwitchEditMode !== '') && ($_sOnSwitchEditMode !== NULL)) {$_sButtonOnClick .= $_sOnSwitchEditMode.' ';}
					$_sButtonOnClick .= "window.setTimeout('oPGInputField.showDropdown({\'sInputFieldID\': \'".$_sInputFieldID."\'})', 100);";
					$_sHTML .= $oPGButton->build(
						array(
							'sButtonID' => $_sInputFieldID.'SwitchEditModeButton', 
							'sText' => $_sButtonDisplayValue, 
							'iButtonMode' => $_iButtonMode, 
							'sOnClick' => $_sButtonOnClick, 
							'sSizeX' => '100%'
						)
					);
				}
				$_sHTML .= '</div>';
			$_sHTML .= '<div id="'.$_sInputFieldID.'DropdownOverlay" style="display:none; position:absolute; top:0px; left:0px; width:'.($_iFullSizeX+22).'px; height:150px; background-color:#000000;">&nbsp;</div>';
			$_sHTML .= '</div>';
		}
		
		$_sHiddenType = 'hidden';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
		{
			$_sHiddenType = 'text';
			$_sHTML .= '<table style="border-width:0px;">';
			$_sHTML .= $_sInputFieldID.'<br />';
		}
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '<tr><td>OldFieldValue:</td><td>';}			$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'OldFieldValue" name="'.$_sInputFieldID.'OldFieldValue" value="" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>OldFieldID:</td><td>';}		$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'OldFieldID" name="'.$_sInputFieldID.'OldFieldID" value="" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>SelectedIndex:</td><td>';}	$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'SelectedIndex" name="'.$_sInputFieldID.'SelectedIndex" value="" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>DataID:</td><td>';}			$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'DataID" name="'.$_sInputFieldID.'DataID" value="'.$_xFieldDatasetID.'" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>Mode:</td><td>';}			$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'Mode" name="'.$_sInputFieldID.'Mode" value="'.$_iInputFieldMode.'" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>FieldCount:</td><td>';}		$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'FieldCount" name="'.$_sInputFieldID.'FieldCount" value="'.count($_axFieldStructures).'" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>DatasetCount:</td><td>';}	$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'DatasetCount" name="'.$_sInputFieldID.'DatasetCount" value="'.count($_axDatasets).'" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHTML .= '</td></tr><tr><td>SendParams:</td><td>';}		$_sHTML .= '<input type="'.$_sHiddenType.'" id="'.$_sInputFieldID.'SendParams" name="'.$_sInputFieldID.'SendParams" value="'.$_sSendParameters.'" />';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))

		{
			$_sHTML .= '</td></tr>';
			$_sHTML .= '</table>';
		}

		$_sHTML .= '</div>';

		return $_sHTML;
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
	
	@return iStreamCount [type]int[/type]
	[en]...[/en]
	*/
	public function getReceivedStreamCount() {global $_POST; return $_POST['iStreamCount'];}
	/* @end method */

	/*
	@start method
	
	@return sDataID [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedDataID() {global $_POST; return utf8_decode($_POST['sDataID']);}
	/* @end method */

	/*
	@start method
	
	@return iDatasetIndex [type]int[/type]
	[en]...[/en]
	*/
	public function getReceivedDatasetIndex() {global $_POST; return $_POST['iDatasetIndex'];}
	/* @end method */

	/*
	@start method
	
	@return sInputFieldID [type]string[/type]
	[en]...[/en]
	*/
	public function getReceivedInputFieldID() {global $_POST; return utf8_decode($_POST['sInputFieldID']);}
	/* @end method */

	/*
	@start method
	
	@return asFieldName [type]string[][/type]
	[en]...[/en]
	*/
	public function getReceivedFieldNames()
	{
		global $_POST;
		$_asFieldName = $_POST['asFieldName'];
		for ($i=0; $i<count($_asFieldName); $i++) {$_asFieldName[$i] = utf8_decode($_asFieldName[$i]);}
		return $_asFieldName;
	}
	/* @end method */

	/*
	@start method
	
	@return asFieldValue [type]string[][/type]
	[en]...[/en]
	*/
	public function getReceivedFieldValues()
	{
		global $_POST;
		$_asFieldValue = $_POST['asFieldValue'];
		for ($i=0; $i<count($_asFieldValue); $i++) {$_asFieldValue[$i] = utf8_decode($_asFieldValue[$i]);}
		return $_asFieldValue;
	}
	/* @end method */
	
	/*
	@start method
	
	@param oObject [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setNetworkMainData(&$_oObject)
	{
		global $_POST;
		$_oObject->addNetworkData('PG_InputFieldEvent', utf8_decode($_POST['sEvent']));
		$_oObject->addNetworkData('PG_InputFieldID', utf8_decode($_POST['sInputFieldID']));
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
		$_oObject->addNetworkData('PG_InputFieldActionStatus', $_iStatusCode);
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
		$_oObject->addNetworkData('PG_InputFieldJavaScriptToExecute', $_sJavaScriptToExecute, NULL);
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
		$_oXMLWrite->setTextDataTag('PG_InputFieldEvent', utf8_decode($_POST['sEvent']), NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	
	@param iStatusCode [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setXMLActionStatus(&$_oXMLWrite, $_iStatusCode)
	{
		$_iStatusCode = $this->getRealParameter(array('oParameters' => $_iStatusCode, 'sName' => 'iStatusCode', 'xParameter' => $_iStatusCode));
		$_oXMLWrite->setNumDataTag('PG_InputFieldActionStatus', $_iStatusCode, NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	
	@param xDataID [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function setXMLDataID(&$_oXMLWrite, $_xDataID)
	{
		$_xDataID = $this->getRealParameter(array('oParameters' => $_xDataID, 'sName' => 'xDataID', 'xParameter' => $_xDataID));
		$_oXMLWrite->setCDataTag('PG_InputFieldDataID', $_xDataID, NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	
	@param axDataset [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function setXMLDataset(&$_oXMLWrite, $_axDataset)
	{
		$_axDataset = $this->getRealParameter(array('oParameters' => $_axDataset, 'sName' => 'axDataset', 'xParameter' => $_axDataset, 'bNotNull' => true));
		for ($i=0; $i<count($_axDataset); $i++)
		{
			$_oXMLWrite->setCDataTag('PG_InputFieldDataset'.$i.'DataID', $_axDataset[$i][PG_INPUTFIELD_DATASET_INDEX_ID], NULL);
			for ($t=PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE; $t<count($_axDataset[$i]); $t++)
			{
				$_oXMLWrite->setCDataTag('PG_InputFieldDataset'.$i.'Field'.($t-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE), $_axDataset[$i][$t], NULL);
			}
			$_oXMLWrite->setNumDataTag('PG_InputFieldDataset'.$i.'FieldCount', count($_axDataset[$i])-PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE, NULL);
		}
		$_oXMLWrite->setNumDataTag('PG_InputFieldDatasetCount', count($_axDataset), NULL);
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
		$_oXMLWrite->setCDataTag('PG_InputFieldJavaScriptToExecute', $_sJavaScriptToExecute, NULL);
	}
	/* @end method */
	
	/*
	@start method
	
	@param oXMLWrite [needed][type]object[/type]
	[en]...[/en]
	*/
	public function setXMLDatasetIndex(&$_oXMLWrite)
	{
		global $_POST;
		$_oXMLWrite->setNumDataTag('PG_InputFieldDatasetIndex', $_POST['iDatasetIndex'], NULL);
	}
	/* @end method */

	/*
	@start method
	
	@return axDataset [type]mixed[][/type]
	[en]...[/en]
	
	@param xDatasetID [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axDatasetFieldsValues [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function buildDataset($_xDatasetID, $_axDatasetFieldsValues = NULL)
	{
		$_axDatasetFieldsValues = $this->getRealParameter(array('oParameters' => $_xDatasetID, 'sName' => 'axDatasetFieldsValues', 'xParameter' => $_axDatasetFieldsValues));
		$_xDatasetID = $this->getRealParameter(array('oParameters' => $_xDatasetID, 'sName' => 'xDatasetID', 'xParameter' => $_xDatasetID));
		return array_merge(array($_xDatasetID), $_axDatasetFieldsValues);
		/*$_axDataset = array();
		$_axDataset[PG_INPUTFIELD_DATASET_INDEX_ID] = $_xDatasetID;
		for ($i=0; $i<count($_axDatasetFieldsValues); $i++)
		{
			$_axDataset[PG_INPUTFIELD_DATASET_INDEX_FIRST_VALUE+$i] = $_axDatasetFieldsValues[$i];
		}
		return $_axDataset;*/
	}
	/* @end method */

	/*
	@start method
	
	@return axFieldStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param sName [type]string[/type]
	[en]...[/en]
	
	@param xValue [type]mixed[/type]
	[en]...[/en]
	
	@param xNoValue [type]mixed[/type]
	[en]...[/en]
	
	@param sAccessKey [type]string[/type]
	[en]...[/en]
	
	@param bRequired [type]bool[/type]
	[en]...[/en]
	
	@param iMaxLength [type]int[/type]
	[en]...[/en]
	
	@param sType [type]string[/type]
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
	public function buildFieldStructure(
		$_iSizeX,
		$_sName = NULL,
		$_xValue = NULL,
		$_xNoValue = NULL,

		$_sAccessKey = NULL,
		$_bRequired = NULL,
		$_iMaxLength = NULL,
		$_sType = NULL,

		$_sOnBlur = NULL,
		$_sOnFocus = NULL,
		$_sOnKeyDown = NULL,
		$_sOnKeyUp = NULL,

		$_sOnClick = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL
	)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sName', 'xParameter' => $_sName));
		$_xValue = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_xNoValue = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'xNoValue', 'xParameter' => $_xNoValue));

		$_sAccessKey = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sAccessKey', 'xParameter' => $_sAccessKey));
		$_bRequired = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'bRequired', 'xParameter' => $_bRequired));
		$_iMaxLength = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iMaxLength', 'xParameter' => $_iMaxLength));
		$_sType = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sType', 'xParameter' => $_sType));

		$_sOnBlur = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnBlur', 'xParameter' => $_sOnBlur));
		$_sOnFocus = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnFocus', 'xParameter' => $_sOnFocus));
		$_sOnKeyDown = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnKeyDown', 'xParameter' => $_sOnKeyDown));
		$_sOnKeyUp = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnKeyUp', 'xParameter' => $_sOnKeyUp));

		$_sOnClick = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));

		$_iSizeX = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));

		if ($_xValue === NULL) {$_xValue = '';}
		if ($_xNoValue === NULL) {$_xNoValue = '';}
		if ($_bRequired === NULL) {$_bRequired = false;}
		if ($_sType === NULL) {$_sType = PG_INPUTFIELD_TYPE_TEXT;}
		
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_SIZEX] = $_iSizeX;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_NAME] = $_sName;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_VALUE] = $_xValue;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_NOVALUE] = $_xNoValue;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ACCESSKEY] = $_sAccessKey;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_REQUIRED] = $_bRequired;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_MAXLENGTH] = $_iMaxLength;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_TYPE] = $_sType;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONBLUR] = $_sOnBlur;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONFOCUS] = $_sOnFocus;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYDOWN] = $_sOnKeyDown;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONKEYUP] = $_sOnKeyUp;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONCLICK] = $_sOnClick;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEDOWN] = $_sOnMouseDown;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEUP] = $_sOnMouseUp;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOVER] = $_sOnMouseOver;
		$_axFieldStructure[PG_INPUTFIELD_STRUCTURE_INDEX_ONMOUSEOUT] = $_sOnMouseOut;

		return $_axFieldStructure;
	}
	/* @end method */
}
/* @end class */
$oPGInputField = new classPG_InputField();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGInputField', 'xValue' => $oPGInputField));}
?>