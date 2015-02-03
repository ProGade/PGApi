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
define('PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD', 0);
define('PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD', 1);
define('PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSERIGHTHOLD', 2);
define('PG_DRAGELEMENT_TYPE_DRAGABLE_ONCLICK', 3);
define('PG_DRAGELEMENT_TYPE_NON_DRAGABLE', 4);

define('PG_DROPAREA_TYPE_SIMPLE', 0);
define('PG_DROPAREA_TYPE_VERTICAL_LIST', 1);
define('PG_DROPAREA_TYPE_HORIZONTAL_LIST', 2);
define('PG_DROPAREA_TYPE_TABLE_LIST', 3);

define('PG_DRAGANDDROP_GROUP_DOCUMENT_ONLY', -2);
define('PG_DRAGANDDROP_GROUP_DOCUMENT_ALL', -1);
define('PG_DRAGANDDROP_GROUP_ALL', '');

define('PG_DRAGANDDROP_ELEMENTCOPYMODE_NOCOPY', 0);
define('PG_DRAGANDDROP_ELEMENTCOPYMODE_COPYONDRAG', 1);

define('PG_DRAGANDDROP_ELEMENTKILLMODE_NOKILL', 0);
define('PG_DRAGANDDROP_ELEMENTKILLMODE_ONDROPINAREA', 1);
define('PG_DRAGANDDROP_ELEMENTKILLMODE_ONRELEASE', 2);

define('PG_DRAGANDDROP_DROPAREA_INDEX_ID', 0);
define('PG_DRAGANDDROP_DROPAREA_INDEX_TYPE', 1);
define('PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID', 2);
define('PG_DRAGANDDROP_DROPAREA_INDEX_GRIDX', 3);
define('PG_DRAGANDDROP_DROPAREA_INDEX_GRIDY', 4);
define('PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTX', 5);
define('PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTY', 6);
define('PG_DRAGANDDROP_DROPAREA_INDEX_DATA', 7);
define('PG_DRAGANDDROP_DROPAREA_INDEX_ONDROP', 8);
define('PG_DRAGANDDROP_DROPAREA_INDEX_MAXELEMENTS', 9);

define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID', 0);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE', 1);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID', 2);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID', 3);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST', 4);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE', 5);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE', 6);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTX', 7);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTY', 8);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA', 9);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONGRAB', 10);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONDROP', 11);
define('PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOVEBOUNDS', 12);

define('PG_DRAGANDDROP_MOUSEOFFSETDIST_EXACT_POSITION', -1);
define('PG_DRAGANDDROP_MOUSEOFFSETDIST_NONE', 0);

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_DragAndDrop extends classPG_ClassBasics
{
	// Declarations...
	private $bAutoRegisterDropAreasToJS = true;
	private $bAutoRegisterDropElementsToJS = true;
	private $axDropAreas = array();
	private $axDropElements = array();

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDragAndDrop'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_draganddrop.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_draganddrop.php',
                'foundation' => 'gfx/default/templates/controls/foundation_draganddrop.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	
	@param iDropAreaType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxDropElements [type]int[/type]
	[en]...[/en]
	*/
	public function registerDropArea(
		$_sDropAreaID, 
		$_iGridX = NULL, 
		$_iGridY = NULL, 
		$_iDropAreaType = NULL, 
		$_sGroupID = NULL, 
		$_sOnDrop = NULL, 
		$_iGrabMoveDistX = NULL,
		$_iGrabMoveDistY = NULL,
		$_axData = NULL, 
		$_iMaxDropElements = NULL
	)
	{
		global $oPGStrings, $oPGDropArea;
		
		$_iGridX = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGridX', 'xParameter' => $_iGridX));
		$_iGridY = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGridY', 'xParameter' => $_iGridY));
		$_iDropAreaType = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iDropAreaType', 'xParameter' => $_iDropAreaType));
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$_sOnDrop = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sOnDrop', 'xParameter' => $_sOnDrop));
		$_iGrabMoveDistX = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGrabMoveDistX', 'xParameter' => $_iGrabMoveDistX));
		$_iGrabMoveDistY = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGrabMoveDistY', 'xParameter' => $_iGrabMoveDistY));
		$_axData = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'axData', 'xParameter' => $_axData));
		$_iMaxDropElements = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iMaxDropElements', 'xParameter' => $_iMaxDropElements));
		$_sDropAreaID = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sDropAreaID', 'xParameter' => $_sDropAreaID));
		
		if ($_iGridX === NULL) {$_iGridX = $oPGDropArea->getDefaultGridX();}
		if ($_iGridY === NULL) {$_iGridY = $oPGDropArea->getDefaultGridY();}
		if ($_sGroupID === NULL) {$_sGroupID = $oPGDropArea->getDefaultGroupID();}
		if ($_iDropAreaType === NULL) {$_iDropAreaType = $oPGDropArea->getDefaultType();}
		if ($_iMaxDropElements === NULL) {$_iMaxDropElements = $oPGDropArea->getDefaultMaxElements();}

		$_iIndex = count($this->axDropAreas);
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID] = $_sDropAreaID;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE] = $_iDropAreaType;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GROUPID] = $_sGroupID;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRIDX] = $_iGridX;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRIDY] = $_iGridY;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTX] = $_iGrabMoveDistX;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_GRABMOVEDISTY] = $_iGrabMoveDistY;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_DATA] = $_axData;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ONDROP] = $_sOnDrop;
		$this->axDropAreas[$_iIndex][PG_DRAGANDDROP_DROPAREA_INDEX_MAXELEMENTS] = $_iMaxDropElements;
		
		$_sHtml = '';
		
		if ($this->bAutoRegisterDropAreasToJS == true)
		{
			$_sHtml .= '<script language="JavaScript" type="text/javascript">';
			$_sHtml .= 'oPGDragAndDrop.registerDropArea({"sDropAreaID": "'.$_sDropAreaID.'", "iGridX": ';
			if ($_iGridX === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iGridX;}
			$_sHtml .= ', "iGridY": ';
			if ($_iGridY === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iGridY;}
			$_sHtml .= ', "iDropAreaType": ';
			if ($_iDropAreaType === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iDropAreaType;}
			$_sHtml .= ', "sGroupID": ';
			if ($_sGroupID === NULL) {$_sHtml .= 'null';} else {$_sHtml .= '"'.$_sGroupID.'"';}
			$_sHtml .= ', "sOnDrop": ';
			if ($_sOnDrop === NULL) {$_sHtml .= 'null';} else {$_sHtml .= '"'.$_sOnDrop.'"';}
			$_sHtml .= ', "iGrabMoveDistX": ';
			if ($_iGrabMoveDistX === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iGrabMoveDistX;}
			$_sHtml .= ', "iGrabMoveDistY": ';
			if ($_iGrabMoveDistY === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iGrabMoveDistY;}
			$_sHtml .= ', "axData": ';
			if ($_axData === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $oPGObjects->toJavaScriptObject(array('oObject' => $_axData, 'sStringEscape' => '"'));}
			$_sHtml .= ', "iMaxDropElements": ';
			if ($_iMaxDropElements === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iMaxDropElements;}
			$_sHtml .= '}); ';
			$_sHtml .= '</script>';
		}
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@return iIndex [type]int[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getDropAreaIndex($_xDropArea)
	{
		$_xDropArea = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'xDropArea', 'xParameter' => $_xDropArea));

		if (is_int($_xDropArea)) {return $_xDropArea;}
		else if (is_string($_xDropArea))
		{
			for ($i=0; $i<count($this->axDropAreas); $i++)
			{
				if ($this->axDropAreas[$i][PG_DRAGANDDROP_DROPAREA_INDEX_ID] == $_xDropArea) {return $i;}
			}
		}
		return NULL;
	}
	/* @end method */

	/*
	@start method
	
	@return sDropAreaID [type]string[/type]
	[en]...[/en]
	
	@param xDropArea [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getDropAreaID($_xDropArea)
	{
		$_xDropArea = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'xDropArea', 'xParameter' => $_xDropArea));

		if (is_string($_xDropArea)) {return $_xDropArea;}
		else if (is_int($_xDropArea)) {return $this->axDropAreas[$_xDropArea][PG_DRAGANDDROP_DROPAREA_INDEX_ID];}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sDragElementID [needed][type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
	[en]...[/en]
	
	@param sDropAreaID [type]string[/type]
	[en]...[/en]
	
	@param iMouseOffsetDist [type]int[/type]
	[en]...[/en]
	
	@param iElementKillMode [type]int[/type]
	[en]...[/en]
	
	@param iElementCopyMode [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param sOnGrab [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	*/
	public function registerDragElement(
		$_sDragElementID, 
		$_iDragElementType = NULL, 
		$_sGroupID = NULL, 
		$_sDropAreaID = NULL, 
		$_iMouseOffsetDist = NULL, 
		$_iElementKillMode = NULL, 
		$_iElementCopyMode = NULL, 
		$_iGrabMoveDistX = NULL,
		$_iGrabMoveDistY = NULL,
		$_aiMoveBounds = NULL,
		$_sOnGrab = NULL,
		$_sOnDrop = NULL,
		$_axData = NULL
	)
	{
		global $oPGStrings, $oPGObjects, $oPGDragElement;

		$_iDragElementType = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'iDragElementType', 'xParameter' => $_iDragElementType));
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$_sDropAreaID = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'sDropAreaID', 'xParameter' => $_sDropAreaID));
		$_iMouseOffsetDist = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'iMouseOffsetDist', 'xParameter' => $_iMouseOffsetDist));
		$_iElementKillMode = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'iElementKillMode', 'xParameter' => $_iElementKillMode));
		$_iElementCopyMode = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'iElementCopyMode', 'xParameter' => $_iElementCopyMode));
		$_iGrabMoveDistX = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'iGrabMoveDistX', 'xParameter' => $_iGrabMoveDistX));
		$_iGrabMoveDistY = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'iGrabMoveDistY', 'xParameter' => $_iGrabMoveDistY));
		$_aiMoveBounds = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'aiMoveBounds', 'xParameter' => $_aiMoveBounds));
		$_sOnGrab = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'sOnGrab', 'xParameter' => $_sOnGrab));
		$_sOnDrop = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'sOnDrop', 'xParameter' => $_sOnDrop));
		$_axData = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'axData', 'xParameter' => $_axData));
		$_sDragElementID = $this->getRealParameter(array('oParameters' => $_sDragElementID, 'sName' => 'sDragElementID', 'xParameter' => $_sDragElementID));
		
		if ($_sDropAreaID === NULL) {$_sDropAreaID = '';}
		if ($_sGroupID === NULL) {$_sGroupID = $oPGDragElement->getDefaultGroupID();}
		if ($_iDragElementType === NULL) {$_iDragElementType = $oPGDragElement->getDefaultType();}
		if ($_iMouseOffsetDist === NULL) {$_iMouseOffsetDist = 0;}
		if ($_iElementCopyMode === NULL) {$_iElementCopyMode = $oPGDragElement->getDefaultCopyMode();}
		if ($_iElementKillMode === NULL) {$_iElementKillMode = $oPGDragElement->getDefaultKillMode();}

		$_iIndex = count($this->axDropElements);
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID] = $_sDragElementID;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_TYPE] = $_iDragElementType;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GROUPID] = $_sGroupID;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DROPAREAID] = $_sDropAreaID;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOUSEOFFSETDIST] = $_iMouseOffsetDist;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_KILLMODE] = $_iElementKillMode;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_COPYMODE] = $_iElementCopyMode;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTX] = $_iGrabMoveDistX;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_GRABMOVEDISTY] = $_iGrabMoveDistY;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_MOVEBOUNDS] = $_aiMoveBounds;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONGRAB] = $_sOnGrab;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ONDROP] = $_sOnDrop;
		$this->axDropElements[$_iIndex][PG_DRAGANDDROP_DRAGELEMENT_INDEX_DATA] = $_axData;

		$_sHtml = '';
		
		if ($this->bAutoRegisterDropElementsToJS == true)
		{
			$_sHtml .= '<script language="JavaScript" type="text/javascript">';
			$_sHtml .= 'oPGDragAndDrop.registerDragElement({"sDragElementID": "'.$_sDragElementID.'", ';
			$_sHtml .= '"iDragElementType": ';
			if ($_iDragElementType === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iDragElementType;}
			$_sHtml .= ', "sGroupID": ';
			if ($_sGroupID === NULL) {$_sHtml .= 'null';} else {$_sHtml .= '"'.$_sGroupID.'"';}
			$_sHtml .= ', "sDropAreaID": ';
			if ($_sDropAreaID === NULL) {$_sHtml .= 'null';} else {$_sHtml .= '"'.$_sDropAreaID.'"';}
			$_sHtml .= ', "iMouseOffsetDist": ';
			if ($_iMouseOffsetDist === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iMouseOffsetDist;}
			$_sHtml .= ', "iElementKillMode": ';
			if ($_iElementKillMode === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iElementKillMode;}
			$_sHtml .= ', "iElementCopyMode": ';
			if ($_iElementCopyMode === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iElementCopyMode;}
			$_sHtml .= ', "iGrabMoveDistX": ';
			if ($_iGrabMoveDistX === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iGrabMoveDistX;}
			$_sHtml .= ', "iGrabMoveDistY": ';
			if ($_iGrabMoveDistY === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $_iGrabMoveDistY;}
			if ($_aiMoveBounds != NULL) {$_sHtml .= '"aiMoveBounds": '.$oPGString->convertPhpArrayToJs(array('axArray' => $_aiMoveBounds, 'bDeclaration' => true, 'bUseDoubleQuotes' => true)).', ';}
			$_sHtml .= ', "sOnGrab": ';
			if ($_sOnGrab === NULL) {$_sHtml .= 'null';} else {$_sHtml .= '"'.$_sOnGrab.'"';}
			$_sHtml .= ', "sOnDrop": ';
			if ($_sOnDrop === NULL) {$_sHtml .= 'null';} else {$_sHtml .= '"'.$_sOnDrop.'"';}
			$_sHtml .= ', "axData": ';
			if ($_axData === NULL) {$_sHtml .= 'null';} else {$_sHtml .= $oPGObjects->toJavaScriptObject(array('oObject' => $_axData, 'sStringEscape' => '"'));}
			$_sHtml .= '}); ';
			$_sHtml .= '</script>';
		}
		
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@return iIndex [type]int[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function getDropElementIndex($_xElement)
	{
		$_xElement = $this->getRealParameter(array('oParameters' => $_xElement, 'sName' => 'xElement', 'xParameter' => $_xElement));

		if (is_int($_xElement)) {return $_xElement;}
		else if (is_string($_xElement))
		{
			for ($i=0; $i<count($this->axDropElements); $i++)
			{
				if ($this->axDropElements[$i][PG_DRAGANDDROP_DRAGELEMENT_INDEX_ID] == $_xElement) {return $i;}
			}
		}
		return NULL;
	}
	/* @end method */
}
/* @end class */
$oPGDragAndDrop = new classPG_DragAndDrop();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDragAndDrop', 'xValue' => $oPGDragAndDrop));}
?>