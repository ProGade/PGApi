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
class classPG_DropArea extends classPG_ClassBasics
{
	// Declarations...
	private $iDefaultGridX = 0;
	private $iDefaultGridY = 0;
	private $iDefaultMaxElements = 0;
	private $iDefaultType = PG_DROPAREA_TYPE_SIMPLE;
	private $sDefaultGroupID = PG_DRAGANDDROP_GROUP_ALL;
	private $sDefaultCssStyle = '';
	private $sDefaultCssClass = '';
	
	private $iDefaultGrabMoveDistX = -1;
	private $iDefaultGrabMoveDistY = -1;

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGDropArea'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_droparea.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_droparea.php',
                'foundation' => 'gfx/default/templates/controls/foundation_droparea.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
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
	
	@param sStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDefaultCssStyle($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sDefaultCssStyle = $_sStyle;
	}
	/* @end method */

	/*
	@start method
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getDefaultCssStyle() {return $this->sDefaultCssStyle;}
	/* @end method */

	/*
	@start method
	
	@param sClass [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setDefaultCssClass($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sDefaultCssClass = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	public function getDefaultCssClass() {return $this->sDefaultCssClass;}
	/* @end method */

	/*
	@start method
	
	@param iGridX [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultGridX($_iGridX)
	{
		$_iGridX = $this->getRealParameter(array('oParameters' => $_iGridX, 'sName' => 'iGridX', 'xParameter' => $_iGridX));
		$this->iDefaultGridX = $_iGridX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGridX [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultGridX() {return $this->iDefaultGridX;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridY [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultGridY($_iGridY)
	{
		$_iGridY = $this->getRealParameter(array('oParameters' => $_iGridY, 'sName' => 'iGridY', 'xParameter' => $_iGridY));
		$this->iDefaultGridY = $_iGridY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iGridY [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultGridY() {return $this->iDefaultGridY;}
	/* @end method */
	
	/*
	@start method
	
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultGrid($_iGridX, $_iGridY = NULL)
	{
		$_iGridY = $this->getRealParameter(array('oParameters' => $_iGridX, 'sName' => 'iGridY', 'xParameter' => $_iGridY));
		$_iGridX = $this->getRealParameter(array('oParameters' => $_iGridX, 'sName' => 'iGridX', 'xParameter' => $_iGridX));

		$this->iDefaultGridX = $_iGridX;
		$this->iDefaultGridY = $_iGridY;
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMax [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setDefaultMaxElements($_iMax)
	{
		$_iMax = $this->getRealParameter(array('oParameters' => $_iMax, 'sName' => 'iMax', 'xParameter' => $_iMax));
		$this->iDefaultMaxElements = $_iMax;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iMaxElements [type]int[/type]
	[en]...[/en]
	*/
	public function getDefaultMaxElements() {return $this->iDefaultMaxElements;}
	/* @end method */

	/*
	@start method
	
	@return sDropAreaHtml [type]string[/type]
	[en]...[/en]
	
	@param sDropAreaID [needed][type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	 
	@param iGridX [type]int[/type]
	[en]...[/en]
	
	@param iGridY [type]int[/type]
	[en]...[/en]
	
	@param iDropAreaType [type]int[/type]
	[en]...[/en]
	
	@param sGroupID [needed][type]string[/type]
	[en]...[/en]
	
	@param sContent [needed][type]string[/type]
	[en]...[/en]
	
	@param sOnDrop [needed][type]string[/type]
	[en]...[/en]
	
	@param axData
	@param iGrabMoveDistX [type]int[/type]
	[en]...[/en]
	
	@param iGrabMoveDistY [type]int[/type]
	[en]...[/en]
	
	@param axDragElementsStructure [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param iMaxDragElements [type]int[/type]
	[en]...[/en]
	
	@param sCssStyle [needed][type]string[/type]
	[en]...[/en]
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	public function build(
		$_sDropAreaID, 
		$_sSizeX = NULL, 
		$_sSizeY = NULL, 
		$_iGridX = NULL, 
		$_iGridY = NULL, 
		
		$_iDropAreaType = NULL, 
		$_sGroupID = NULL, 
		$_sContent = NULL, 
		$_sOnDrop = NULL, 
		$_axData = NULL, 
		
		$_iGrabMoveDistX = NULL,
		$_iGrabMoveDistY = NULL,
		
		$_axDragElementsStructure = NULL,
		$_iMaxDragElements = NULL, 
		$_sCssStyle = NULL, 
		$_sCssClass = NULL,

        $_sTemplateName = NULL
    )
	{
		global $oPGDragAndDrop, $oPGDragElement;
	
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_iGridX = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGridX', 'xParameter' => $_iGridX));
		$_iGridY = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGridY', 'xParameter' => $_iGridY));
		
		$_iDropAreaType = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iDropAreaType', 'xParameter' => $_iDropAreaType));
		$_sGroupID = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sGroupID', 'xParameter' => $_sGroupID));
		$_sContent = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_sOnDrop = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sOnDrop', 'xParameter' => $_sOnDrop));
		$_axData = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'axData', 'xParameter' => $_axData));
		
		$_iGrabMoveDistX = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGrabMoveDistX', 'xParameter' => $_iGrabMoveDistX));
		$_iGrabMoveDistY = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iGrabMoveDistY', 'xParameter' => $_iGrabMoveDistY));

		$_axDragElementsStructure = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'axDragElementsStructure', 'xParameter' => $_axDragElementsStructure));
		$_iMaxDragElements = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'iMaxDragElements', 'xParameter' => $_iMaxDragElements));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sDropAreaID = $this->getRealParameter(array('oParameters' => $_sDropAreaID, 'sName' => 'sDropAreaID', 'xParameter' => $_sDropAreaID));
		
		if ($_sDropAreaID === NULL) {$_sDropAreaID = $this->getNextID();}
		if ($_iGridX === NULL) {$_iGridX = $this->iDefaultGridX;}
		if ($_iGridY === NULL) {$_iGridY = $this->iDefaultGridY;}
		if ($_sGroupID === NULL) {$_sGroupID = $this->sDefaultGroupID;}
		if ($_iDropAreaType === NULL) {$_iDropAreaType = $this->iDefaultType;}
		if ($_iMaxDragElements === NULL) {$_iMaxDragElements = $this->iDefaultMaxElements;}
		if ($_sCssStyle === NULL) {$_sCssStyle = $this->sDefaultCssStyle;}
		if ($_sCssClass === NULL) {$_sCssClass = $this->sDefaultCssClass;}
		if ($_iGrabMoveDistX === NULL) {$_iGrabMoveDistX = $this->iDefaultGrabMoveDistX;}
		if ($_iGrabMoveDistY === NULL) {$_iGrabMoveDistY = $this->iDefaultGrabMoveDistY;}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}

        $_sHtml = '';
		$_sHtml .= $this->getLineBreak();
		$_sHtml .= '<div id="'.$_sDropAreaID.'" style="position:relative; width:'.$_sSizeX.'; height:'.$_sSizeY.'; overflow:hidden; top:0px; left:0px; ';
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sHtml .= 'border:solid 1px #ff0000; ';}
		if (($_sCssStyle !== NULL) && ($_sCssStyle !== '')) {$_sHtml .= $_sCssStyle.' ';}
		$_sHtml .= '" ';
		if (($_sCssClass !== NULL) && ($_sCssClass !== '')) {$_sHtml .= 'class="'.$_sCssClass.'" ';}
		$_sHtml .= '>';
		if ($_sContent !== NULL) {$_sHtml .= $_sContent;}
		
		if ($_axDragElementsStructure !== NULL)
		{
			for ($i=0; $i<count($_axDragElementsStructure); $i++)
			{
				$_axDragElementsStructure[$i]['xDropArea'] = $_sDropAreaID;
				$_sHtml .= $oPGDragElement->build($_axDragElementsStructure[$i]);
			}
		}
		
		$_sHtml .= '</div>';
		$_sHtml .= $this->getLineBreak();

		$_sHtml .= $oPGDragAndDrop->registerDropArea(
			array(
				'sDropAreaID' => $_sDropAreaID, 
				'iGridX' => $_iGridX, 
				'iGridY' => $_iGridY, 
				'iDropAreaType' => $_iDropAreaType, 
				'sGroupID' => $_sGroupID, 
				'sOnDrop' => $_sOnDrop, 
				'iGrabMoveDistX' => $_iGrabMoveDistX,
				'iGrabMoveDistY' => $_iGrabMoveDistY,
				'axData' => $_axData, 
				'iMaxDragElements' => $_iMaxDragElements
			)
		);

		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGDropArea = new classPG_DropArea();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDropArea', 'xValue' => $oPGDropArea));}
?>