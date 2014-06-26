<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Sep 10 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_DragElement extends classPG_ClassBasics
{
	// Declarations...
	private $iDefaultType = PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSELEFTHOLD;
	private $sDefaultGroupID = PG_DRAGANDDROP_GROUP_ALL;
	private $iDefaultCopyMode = PG_DRAGANDDROP_ELEMENTCOPYMODE_NOCOPY;
	private $iDefaultKillMode = PG_DRAGANDDROP_ELEMENTKILLMODE_NOKILL;
	
	private $iDefaultGrabMoveDistX = -1;
	private $iDefaultGrabMoveDistY = -1;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDragElement'));
		$this->initClassBasics();
	}

	// Methods...
	/*
	@start method
	
	@param iMoveDistX [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultGrabMoveDistX($_iMoveDistX)
	{
		$_iMoveDistX = $this->getRealParameter(array('oParameters' => $_iMoveDistX, 'sName' => 'iMoveDistX', 'xParameter' => $_iMoveDistX));
		$this->iDefaultGrabMoveDistX = $_iMoveDistX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMoveDistX [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultGrabMoveDistX() {return $this->iDefaultGrabMoveDistX;}
	/* @end method */
	
	/*
	@start method
	
	@param iMoveDistY [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultGrabMoveDistY($_iMoveDistY)
	{
		$_iMoveDistY = $this->getRealParameter(array('oParameters' => $_iMoveDistY, 'sName' => 'iMoveDistY', 'xParameter' => $_iMoveDistY));
		$this->iDefaultGrabMoveDistY = $_iMoveDistY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMoveDistY [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultGrabMoveDistY() {return $this->iDefaultGrabMoveDistY;}
	/* @end method */
	
	/*
	@start method
	
	@param iType [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultType($_iType)
	{
		$_iType = $this->getRealParameter(array('oParameters' => $_iType, 'sName' => 'iType', 'xParameter' => $_iType));
		$this->iDefaultType = $_iType;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iType [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultType() {return $this->iDefaultType;}
	/* @end method */

	/*
	@start method
	
	@param sGroupID [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDefaultGroupID($_sGroupID)
	{
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_sGroupID, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$this->sDefaultGroupID = $_sGroupID;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sGroupID [type]string[/type]
	[en]...[/en]
	*/
	public function getDefaultGroupID() {return $this->sDefaultGroupID;}
	/* @end method */

	/*
	@start method
	
	@param iMode [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultCopyMode($_iMode)
	{
		$_iMode = $this->getRealParameter(array('oParameters' => $_iMode, 'sName' => 'iMode', 'xParameter' => $_iMode));
		$this->iDefaultCopyMode = $_iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iCopyMode [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultCopyMode() {return $this->iDefaultCopyMode;}
	/* @end method */

	/*
	@start method
	
	@param iMode [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultKillMode($_iMode)
	{
		$_iMode = $this->getRealParameter(array('oParameters' => $_iMode, 'sName' => 'iMode', 'xParameter' => $_iMode));
		$this->iDefaultKillMode = $_iMode;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iKillMode [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultKillMode() {return $this->iDefaultKillMode;}
	/* @end method */
	
	/*
	@start method
	
	@return axStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	
	@param sDragElementID [type]string[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
	[en]...[/en]
	
	@param iMouseOffsetDist [type]int[/type]
	[en]...[/en]
	
	@param iElementKillMode [type]int[/type]
	[en]...[/en]
	
	@param iElementCopyMode [type]int[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
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
	
	@param sOnGrab [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	*/
	public function buildStructure(
		$_xDropArea = NULL,
		$_sDragElementID = NULL, 
		
		$_iPosX = NULL, 
		$_iPosY = NULL, 
		$_iSizeX = NULL, 
		$_iSizeY = NULL, 
		
		$_sContent = NULL, 
		$_iDragElementType = NULL, 
		$_sGroupID = NULL, 
		
		$_iMouseOffsetDist = NULL, 
		$_iElementKillMode = NULL, 
		$_iElementCopyMode = NULL, 
		$_axData = NULL,
		
		$_iGrabMoveDistX = NULL,
		$_iGrabMoveDistY = NULL,
		
		$_sOnClick = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL,

		$_sOnGrab = NULL,
		$_sOnDrop = NULL,
		
		$_sCssStyle = NULL,
		$_sCssClass = NULL
	)
	{
		$_sDragElementID = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sDragElementID', 'xParameter' => $_sDragElementID));
		$_iPosX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iPosX', 'xParameter' => $_iPosX));
		$_iPosY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iPosY', 'xParameter' => $_iPosY));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		
		$_sContent = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iDragElementType = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iDragElementType', 'xParameter' => $_iDragElementType));
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$_iMouseOffsetDist = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iMouseOffsetDist', 'xParameter' => $_iMouseOffsetDist));
		$_iElementKillMode = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iElementKillMode', 'xParameter' => $_iElementKillMode));
		$_iElementCopyMode = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iElementCopyMode', 'xParameter' => $_iElementCopyMode));
		$_axData = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'axData', 'xParameter' => $_axData));

		$_iGrabMoveDistX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iGrabMoveDistX', 'xParameter' => $_iGrabMoveDistX));
		$_iGrabMoveDistY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iGrabMoveDistY', 'xParameter' => $_iGrabMoveDistY));
		
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));

		$_sOnGrab = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnGrab', 'xParameter' => $_sOnGrab));
		$_sOnDrop = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnDrop', 'xParameter' => $_sOnDrop));

		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_xDropArea = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'xDropArea', 'xParameter' => $_xDropArea));

		return array(
			'xDropArea' => $_xDropArea,
			'sDragElementID' => $_sDragElementID, 
			'iPosX' => $_iPosX, 
			'iPosY' => $_iPosY, 
			'iSizeX' => $_iSizeX, 
			'iSizeY' => $_iSizeY, 
			
			'sContent' => $_sContent, 
			'iDragElementType' => $_iDragElementType, 
			'sGroupID' => $_sGroupID, 
			'iMouseOffsetDist' => $_iMouseOffsetDist, 
			'iElementKillMode' => $_iElementKillMode, 
			'iElementCopyMode' => $_iElementCopyMode, 
			'axData' => $_axData,
			
			'iGrabMoveDistX' => $_iGrabMoveDistX,
			'iGrabMoveDistY' => $_iGrabMoveDistY,
			
			'sOnClick' => $_sOnClick,
			'sOnMouseDown' => $_sOnMouseDown,
			'sOnMouseUp' => $_sOnMouseUp,
			'sOnMouseOver' => $_sOnMouseOver,
			'sOnMouseOut' => $_sOnMouseOut,
			
			'sOnGrab' => $_sOnGrab,
			'sOnDrop' => $_sOnDrop,

			'sCssStyle' => $_sCssStyle,
			'sCssClass' => $_sCssClass
		);
	}
	/* @end method */

	/*
	@start method
	
	@return sDragElementHtml [type]string[/type]
	[en]...[/en]
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	
	@param sDragElementID [type]string[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
	[en]...[/en]
	
	@param iMouseOffsetDist [type]int[/type]
	[en]...[/en]
	
	@param iElementKillMode [type]int[/type]
	[en]...[/en]
	
	@param iElementCopyMode [type]int[/type]
	[en]...[/en]
	
	@param axData [type]mixed[][/type]
	[en]...[/en]
	
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
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
	
	@param sOnGrab [type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [type]string[/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	*/
	public function build(
		$_xDropArea = NULL,
		$_sDragElementID = NULL, 
		$_iPosX = NULL, 
		$_iPosY = NULL, 
		$_iSizeX = NULL, 
		$_iSizeY = NULL, 
		
		$_sContent = NULL, 
		$_iDragElementType = NULL, 
		$_sGroupID = NULL, 
		$_iMouseOffsetDist = NULL, 
		$_iElementKillMode = NULL, 
		$_iElementCopyMode = NULL, 
		$_axData = NULL,
		
		$_iGrabMoveDistX = NULL,
		$_iGrabMoveDistY = NULL,
		
		$_sOnClick = NULL,
		$_sOnMouseDown = NULL,
		$_sOnMouseUp = NULL,
		$_sOnMouseOver = NULL,
		$_sOnMouseOut = NULL,
		
		$_sOnGrab = NULL,
		$_sOnDrop = NULL,
		
		$_sCssStyle = NULL,
		$_sCssClass = NULL
	)
	{
		global $oPGDragAndDrop;
		
		$_sDragElementID = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sDragElementID', 'xParameter' => $_sDragElementID));
		$_iPosX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iPosX', 'xParameter' => $_iPosX));
		$_iPosY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iPosY', 'xParameter' => $_iPosY));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		
		$_sContent = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iDragElementType = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iDragElementType', 'xParameter' => $_iDragElementType));
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$_iMouseOffsetDist = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iMouseOffsetDist', 'xParameter' => $_iMouseOffsetDist));
		$_iElementKillMode = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iElementKillMode', 'xParameter' => $_iElementKillMode));
		$_iElementCopyMode = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iElementCopyMode', 'xParameter' => $_iElementCopyMode));
		$_axData = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'axData', 'xParameter' => $_axData));

		$_iGrabMoveDistX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iGrabMoveDistX', 'xParameter' => $_iGrabMoveDistX));
		$_iGrabMoveDistY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iGrabMoveDistY', 'xParameter' => $_iGrabMoveDistY));
		
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sOnMouseDown = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseDown', 'xParameter' => $_sOnMouseDown));
		$_sOnMouseUp = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseUp', 'xParameter' => $_sOnMouseUp));
		$_sOnMouseOver = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseOver', 'xParameter' => $_sOnMouseOver));
		$_sOnMouseOut = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnMouseOut', 'xParameter' => $_sOnMouseOut));

		$_sOnGrab = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnGrab', 'xParameter' => $_sOnGrab));
		$_sOnDrop = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnDrop', 'xParameter' => $_sOnDrop));

		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_xDropArea = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'xDropArea', 'xParameter' => $_xDropArea));

		if ($_xDropArea === NULL) {$_xDropArea = '';}
		if ($_sDragElementID === NULL) {$_sDragElementID = $this->getNextID();}
		if ($_iPosX === NULL) {$_iPosX = 0;}
		if ($_iPosY === NULL) {$_iPosY = 0;}
		if ($_sGroupID === NULL) {$_sGroupID = $this->sDefaultGroupID;}
		if ($_iDragElementType === NULL) {$_iDragElementType = $this->iDefaultType;}
		if ($_iMouseOffsetDist === NULL) {$_iMouseOffsetDist = PG_DRAGANDDROP_MOUSEOFFSETDIST_EXACT_POSITION;}
		if ($_iElementCopyMode === NULL) {$_iElementCopyMode = $this->iDefaultCopyMode;}
		if ($_iElementKillMode === NULL) {$_iElementKillMode = $this->iDefaultKillMode;}
		if ($_iGrabMoveDistX === NULL) {$_iGrabMoveDistX = $this->iDefaultGrabMoveDistX;}
		if ($_iGrabMoveDistY === NULL) {$_iGrabMoveDistY = $this->iDefaultGrabMoveDistY;}
		
		$_sDropAreaID = '';

		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sDragElementID.'" ';
		$_sHtml .= 'onmousedown="';
			if ($_sOnMouseDown !== NULL) {$_sHtml .= $_sOnMouseDown.' ';}
			$_sHtml .= 'oPGDragAndDrop.onDragElementMouseDown(event, {\'sDragElementID\': \''.$_sDragElementID.'\'});';
		$_sHtml .= '" ';
		$_sHtml .= 'onclick="';
			if ($_sOnClick !== NULL) {$_sHtml .= $_sOnClick.' ';}
			$_sHtml .= 'oPGDragAndDrop.onDragElementClick({\'sDragElementID\': \''.$_sDragElementID.'\'});';
		$_sHtml .= '" ';
		if ($_sOnMouseUp !== NULL) {$_sHtml .= 'onmouseup="'.$_sOnMouseUp.'" ';}
		if ($_sOnMouseOver !== NULL) {$_sHtml .= 'onmouseover="'.$_sOnMouseOver.'" ';}
		if ($_sOnMouseOut !== NULL) {$_sHtml .= 'onmouseout="'.$_sOnMouseOut.'" ';}
		if ($_sCssClass !== NULL) {$_sHtml .= 'class="'.$_sCssClass.'" ';}
		$_sHtml .= 'style="';
		if ($this->isDebugMode(PG_DEBUG_HIGH)) {$_sHtml .= 'border:solid 1px #00ff00; ';}
		if (($_xDropArea !== '') && ($_xDropArea !== NULL))
		{
			$_sDropAreaID = $oPGDragAndDrop->getDropAreaID(array('xDropArea' => $_xDropArea));
			$_iDropAreaIndex = $oPGDragAndDrop->getDropAreaIndex(array('xDropArea' => $_xDropArea));
			if ($_iDropAreaIndex !== NULL)
			{
				$_iDropAreaType = $oPGDragAndDrop->axDropAreas[$_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE];
					
				if ($_iDropAreaType == PG_DROPAREA_TYPE_SIMPLE) {$_sHtml .= 'position:absolute; ';}
				else {$_sHtml .= 'position:static; ';}
				
				if ($_iDropAreaType == PG_DROPAREA_TYPE_HORIZONTAL_LIST) {$_sHtml .= 'float:left; ';}
				else {$_sHtml.= 'float:none; ';}
			}
		}
		else {$_sHtml .= 'position:absolute; ';}
		if ($_iSizeX !== NULL) {$_sHtml .= 'width:'.$_iSizeX.'px; ';}
		if ($_iSizeY !== NULL) {$_sHtml .= 'height:'.$_iSizeY.'px; ';}
		if ($_sCssStyle !== NULL) {$_sHtml .= $_sCssStyle.' ';}
		$_sHtml .= 'left:'.$_iPosX.'px; top:'.$_iPosY.'px; cursor:default;">';
		if ($_sContent !== NULL) {$_sHtml .= $_sContent;}
		$_sHtml .= '</div>';

		$_sHtml .= $oPGDragAndDrop->registerDragElement(
			array(
				'sDragElementID' => $_sDragElementID, 
				'iDragElementType' => $_iDragElementType, 
				'sGroupID' => $_sGroupID, 
				'sDropAreaID' => $_sDropAreaID, 
				
				'iMouseOffsetDist' => $_iMouseOffsetDist, 
				'iElementKillMode' => $_iElementKillMode, 
				'iElementCopyMode' => $_iElementCopyMode, 
				'iGrabMoveDistX' => $_iGrabMoveDistX,
				'iGrabMoveDistY' => $_iGrabMoveDistY,
				
				'sOnGrab' => $_sOnGrab,
				'sOnDrop' => $_sOnDrop,
				
				'axData' => $_axData
			)
		);
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDragElementHtml [type]string[/type]
	[en]...[/en]
	
	@param xDropArea [type]mixed[/type]
	[en]...[/en]
	
	@param sDragElementID [type]string[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param iDragElementType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [type]string[/type]
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
	public function buildUserDefined(
		$_xDropArea = NULL,
		$_sDragElementID = NULL, 
		$_iPosX = NULL, 
		$_iPosY = NULL, 
		$_iSizeX = NULL, 
		$_iSizeY = NULL, 
		
		$_sContent = NULL, 
		$_iDragElementType = NULL, 
		$_sGroupID = NULL, 
		$_iMouseOffsetDist = NULL, 
		$_iElementKillMode = NULL, 
		$_iElementCopyMode = NULL, 

		$_iGrabMoveDistX = NULL,
		$_iGrabMoveDistY = NULL,
		
		$_sOnGrab = NULL,
		$_sOnDrop = NULL,

		$_axData = NULL
	)
	{
		global $oPGDragAndDrop;
	
		$_sDragElementID = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sDragElementID', 'xParameter' => $_sDragElementID));
		$_iPosX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iPosX', 'xParameter' => $_iPosX));
		$_iPosY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iPosY', 'xParameter' => $_iPosY));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		
		$_sContent = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_iDragElementType = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iDragElementType', 'xParameter' => $_iDragElementType));
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$_iMouseOffsetDist = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iMouseOffsetDist', 'xParameter' => $_iMouseOffsetDist));
		$_iElementKillMode = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iElementKillMode', 'xParameter' => $_iElementKillMode));
		$_iElementCopyMode = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iElementCopyMode', 'xParameter' => $_iElementCopyMode));
		$_axData = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'axData', 'xParameter' => $_axData));
		
		$_iGrabMoveDistX = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iGrabMoveDistX', 'xParameter' => $_iGrabMoveDistX));
		$_iGrabMoveDistY = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'iGrabMoveDistY', 'xParameter' => $_iGrabMoveDistY));

		$_sOnGrab = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnGrab', 'xParameter' => $_sOnGrab));
		$_sOnDrop = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'sOnDrop', 'xParameter' => $_sOnDrop));

		$_xDropArea = $this->getRealParameter(array('oParameters' => $_xDropArea, 'sName' => 'xDropArea', 'xParameter' => $_xDropArea));

		$_iDropAreaIndex = -1;
		$_sDropAreaID = '';
		if ($_xDropArea != NULL)
		{
			$_iDropAreaIndex = $oPGDragAndDrop->getDropAreaIndex(array('xDropArea' => $_xDropArea));
			if (($_iDropAreaIndex > -1) && ($_iDropAreaIndex < count($this->axDropAreas)))
			{
				$_sDropAreaID = $oPGDragAndDrop->axDropAreas[$_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_ID];
			}
			else {$_sDropAreaID = $_xDropArea;}
		}
		
		if ($_sDragElementID === NULL) {$this->getNextID();}
		if ($_iPosX === NULL) {$_iPosX = 0;}
		if ($_iPosY === NULL) {$_iPosY = 0;}
		if ($_sDropAreaID === NULL) {$_sDropAreaID = '';}
		if ($_sGroupID === NULL) {$_sGroupID = $this->sDefaultGroupID;}
		if ($_iDragElementType === NULL) {$_iDragElementType = $this->iDefaultType;}
		if ($_iMouseOffsetDist === NULL) {$_iMouseOffsetDist = 0;}
		if ($_iElementCopyMode === NULL) {$_iElementCopyMode = $this->iDefaultCopyMode;}
		if ($_iElementKillMode === NULL) {$_iElementKillMode = $this->iDefaultKillMode;}
		if ($_iGrabMoveDistX === NULL) {$_iGrabMoveDistX = $this->iDefaultGrabMoveDistX;}
		if ($_iGrabMoveDistY === NULL) {$_iGrabMoveDistY = $this->iDefaultGrabMoveDistY;}
		
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sDragElementID.'" style="';
		if ($this->isDebugMode(PG_DEBUG_HIGH)) {$_sHtml .= 'border:solid 1px #00ff00; ';}
		if ($_sDropAreaID != '')
		{
			if (($_iDropAreaIndex > -1) && ($_iDropAreaIndex < count($this->axDropAreas)))
			{
				$_iDropAreaType = $oPGDragAndDrop->axDropAreas[$_iDropAreaIndex][PG_DRAGANDDROP_DROPAREA_INDEX_TYPE];
				
				if ($_iDropAreaType == PG_DROPAREA_TYPE_SIMPLE) {$_sHtml .= 'position:absolute; ';}
				else {$_sHtml .= 'position:static; ';}
				
				if ($_iDropAreaType == PG_DROPAREA_TYPE_HORIZONTAL_LIST) {$_sHtml .= 'float:left; ';}
				else {$_sHtml .= 'float:none; ';}
			}
		}
		else {$_sHtml .= 'position:absolute; ';}
		if ($_iSizeX !== NULL) {$_sHtml .= 'width:'.$_iSizeX.'px; ';}
		if ($_iSizeY !== NULL) {$_sHtml .= 'height:'.$_iSizeY.'px; ';}
		$_sHtml .= 'left:'.$_iPosX.'px; top:'.$_iPosY.'px;">';
		if ($_sContent !== NULL) {$_sHtml .= $_sContent;}
		$_sHtml .= '</div>';
		
		$_sHtml .= $oPGDragAndDrop->registerDragElement(
			array(
				'sDragElementID' => $_sDragElementID, 
				'iDragElementType' => $_iDragElementType, 
				'sGroupID' => $_sGroupID, 
				'sDropAreaID' => $_sDropAreaID, 
				'iMouseOffsetDist' => $_iMouseOffsetDist, 
				'iElementKillMode' => $_iElementKillMode, 
				'iElementCopyMode' => $_iElementCopyMode, 
				'iGrabMoveDistX' => $_iGrabMoveDistX,
				'iGrabMoveDistY' => $_iGrabMoveDistX,
				'sOnGrab' => $_sOnGrab,
				'sOnDrop' => $_sOnDrop,
				'axData' => $_axData
			)
		);
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGDragElement = new classPG_DragElement();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDragElement', 'xValue' => $oPGDragElement));}
?>