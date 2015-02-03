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
define('PG_TABS_TAB_INDEX_FRAMESTRUCTURE', 'axFrameStructure');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Tabs extends classPG_ClassBasics
{
	// Declarations...
	private $sTabsCssStylePressed = 'background-color:#aaaaaa;';
	private $sTabsCssStyleNormal = 'background-color:#888888;';
	private $sTabsCssStyleBasics = 'display:inline-block; padding:5px; border-radius:10px 10px 0px 0px;';
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGTabs'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_tabs.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_tabs.php',
                'foundation' => 'gfx/default/templates/controls/foundation_tabs.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@return sTabsHtml [type]string[/type]
	[en]...[/en]
	
	@param sTabsID [type]string[/type]
	[en]...[/en]
	
	@param sSizeX [type]string[/type]
	[en]...[/en]
	
	@param sSizeY [type]string[/type]
	[en]...[/en]
	
	@param iTabsMode [type]int[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	
	@param axTabs [type]mixed[][/type]
	[en]...[/en]
	
	@param sCssStyle [type]string[/type]
	[en]...[/en]
	
	@param sCssClass [type]string[/type]
	[en]...[/en]
	
	@param sCssStyleTabbar [type]string[/type]
	[en]...[/en]
	
	@param sCssClassTabbar [type]string[/type]
	[en]...[/en]
	
	@param sCssStyleTabs [type]string[/type]
	[en]...[/en]
	
	@param sCssClassTabs [type]string[/type]
	[en]...[/en]
	
	@param sCssStyleContents [type]string[/type]
	[en]...[/en]
	
	@param sCssClassContents [type]string[/type]
	[en]...[/en]
	*/
	public function build(
		$_sTabsID = NULL, 
		$_sSizeX = NULL,
		$_sSizeY = NULL,
		$_iTabsMode = NULL, 
		$_sContent = NULL, 
		$_axTabs = NULL,
		$_sCssStyle = NULL,
		$_sCssClass = NULL,
		$_sCssStyleTabbar = NULL,
		$_sCssClassTabbar = NULL,
		$_sCssStyleTabs = NULL,
		$_sCssClassTabs = NULL,
		$_sCssStyleContents = NULL,
		$_sCssClassContents = NULL,

        $_sTemplateName = NULL
    )
	{
		global $oPGDragElement, $oPGDropArea, $oPGFrame;
	
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_iTabsMode = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'iTabsMode', 'xParameter' => $_iTabsMode));
		$_sContent = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sContent', 'xParameter' => $_sContent));
		$_axTabs = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'axTabs', 'xParameter' => $_axTabs));
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sCssStyleTabbar = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssStyleTabbar', 'xParameter' => $_sCssStyleTabbar));
		$_sCssClassTabbar = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssClassTabbar', 'xParameter' => $_sCssClassTabbar));
		$_sCssStyleTabs = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssStyleTabs', 'xParameter' => $_sCssStyleTabs));
		$_sCssClassTabs = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssClassTabs', 'xParameter' => $_sCssClassTabs));
		$_sCssStyleContents = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssStyleContents', 'xParameter' => $_sCssStyleContents));
		$_sCssClassContents = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sCssClassContents', 'xParameter' => $_sCssClassContents));
		$_sTabsID = $this->getRealParameter(array('oParameters' => $_sTabsID, 'sName' => 'sTabsID', 'xParameter' => $_sTabsID));

		if ($_sTabsID === NULL) {$_sTabsID = $this->getNextID();}
		if ($_sCssStyleTabbar === NULL) {$_sCssStyleTabbar = 'background-color:#666666; padding-top:5px;';}
		if ($_sSizeX === NULL) {$_sSizeX = '100%';}
		if ($_sSizeY === NULL) {$_sSizeY = '300px';}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}

        $_sHtml = '';
		$_sHtml .= $this->getLineBreak();
		
		$_sHtml .= '<div id="'.$_sTabsID.'" style="width:'.$_sSizeX.'; height:'.$_sSizeY.'; ';
		if ($_sCssStyle !== NULL) {$_sHtml .= $_sCssStyle.' ';}
		$_sHtml .= 'overflow:auto; background-color:#aaaaaa; display:inline-block;" ';
		$_sHtml .= '>';

			$_axDragElementsStructure = array();
			
			for ($i=0; $i<count($_axTabs); $i++)
			{
				$_sTabsCurrentCssStyle = '';
				if ($i == 0) {$_sTabsCurrentCssStyle = $this->sTabsCssStylePressed;}
				else {$_sTabsCurrentCssStyle = $this->sTabsCssStyleNormal;}
				$_axTabs[$i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]['sFrameID'] = $_sTabsID.'Tab'.$i.'Frame';
				$_axTabs[$i]['sDragElementID'] = $_sTabsID.'Tab'.$i;
				$_axTabs[$i]['sCssStyle'] = $_sCssStyleTabs.' '.$_sTabsCurrentCssStyle.' '.$this->sTabsCssStyleBasics;
				$_axTabs[$i]['sCssClass'] = $_sCssClassTabs;
				$_axTabs[$i]['axData'] = array('sFrameID' => $_axTabs[$i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]['sFrameID']);
				$_axTabs[$i]['sOnMouseUp'] = 'oPGTabs.onTabMouseUp({\'sTabID\': \''.$_axTabs[$i]['sDragElementID'].'\'});';
				$_axTabs[$i]['sOnGrab'] = 'oPGTabs.onTabGrab({\'sTabID\': \''.$_axTabs[$i]['sDragElementID'].'\'});';
				$_axTabs[$i]['sOnDrop'] = 'oPGTabs.onTabDrop({\'sTabID\': \''.$_axTabs[$i]['sDragElementID'].'\'});';
				$_axDragElementsStructure[] = $oPGDragElement->buildStructure($_axTabs[$i]);
			}

			$_sHtml .= $oPGDropArea->build(
				array(
					'sDropAreaID' => $_sTabsID.'Tabbar', 
					'sSizeX' => '100%', 
					'sSizeY' => '25px', 
					'iGridX' => 0, 
					'iGridY' => 0, 
					'iDropAreaType' => PG_DROPAREA_TYPE_HORIZONTAL_LIST, 
					'iGroupID' => NULL, 
					'sContent' => NULL, 
					'sOnDrop' => NULL, 
					'axData' => NULL, 
					'axDragElementsStructure' => $_axDragElementsStructure,
					'iMaxDropElements' => NULL, 
					'sCssStyle' => $_sCssStyleTabbar, 
					'sCssClass' => $_sCssClassTabbar
				)
			);
			
			for ($i=0; $i<count($_axTabs); $i++)
			{
				// $_axTabs[$i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]['sCssStyle'] = 'float:left; background-color:#ccffcc;';
				$_sHtml .= $oPGFrame->build($_axTabs[$i][PG_TABS_TAB_INDEX_FRAMESTRUCTURE]);
			}
			
		$_sHtml .= '</div>';
		$_sHtml .= '<script type="text/javascript">';
			$_sHtml .= 'oPGTabs.registerTabs({"sTabsID": "'.$_sTabsID.'"}); ';
		$_sHtml .= '</script>';
		
		$_sHtml .= $this->getLineBreak();
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axTabStructure [type]mixed[][/type]
	[en]...[/en]
	
	@param sTabID [needed][type]string[/type]
	[en]...[/en]
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	
	@param xData [needed][type]mixed[/type]
	[en]...[/en]
	
	@param axFrameStructure [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function buildTabStructure($_sTabID, $_sText = NULL, $_xData = NULL, $_axFrameStructure = NULL)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sTabID, 'sName' => 'sText', 'xParameter' => $_sText));
		$_xData = $this->getRealParameter(array('oParameters' => $_sTabID, 'sName' => 'xData', 'xParameter' => $_xData));
		$_axFrameStructure = $this->getRealParameter(array('oParameters' => $_sTabID, 'sName' => 'axFrameStructure', 'xParameter' => $_axFrameStructure));
		$_sTabID = $this->getRealParameter(array('oParameters' => $_sTabID, 'sName' => 'sTabID', 'xParameter' => $_sTabID));
	
		$_axTab = array();
		$_axTab['sContent'] = $_sText;
		$_axTab['iDragElementType'] = PG_DRAGELEMENT_TYPE_DRAGABLE_ONMOUSEHOLD;
		$_axTab['sGroupID'] = NULL;
		$_axTab['iMouseOffsetDist'] = NULL;
		$_axTab['iElementKillMode'] = PG_DRAGANDDROP_ELEMENTKILLMODE_NOKILL;
		$_axTab['iElementCopyMode'] = PG_DRAGANDDROP_ELEMENTCOPYMODE_NOCOPY;
		$_axTab['xData'] = $_xData;
		$_axTab[PG_TABS_TAB_INDEX_FRAMESTRUCTURE] = $_axFrameStructure;
		
		return $_axTab;
	}
	/* @end method */
}
/* @end class */
$oPGTabs = new classPG_Tabs();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGTabs', 'xValue' => $oPGTabs));}
?>