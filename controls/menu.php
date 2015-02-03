<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Feb 10 2012
*/

define('PG_MENUITEM_INDEX_ID', 'sMenuItemID');
define('PG_MENUITEM_INDEX_NAME', 'sName');
define('PG_MENUITEM_INDEX_URL', 'sUrl');
define('PG_MENUITEM_INDEX_URLTARGET', 'sUrlTarget');
define('PG_MENUITEM_INDEX_URLPARAMETERS', 'axUrlParameters');
define('PG_MENUITEM_INDEX_ONCLICK', 'sOnClick');
define('PG_MENUITEM_INDEX_SHORTDESCRIPTION', 'sShortDescription');
define('PG_MENUITEM_INDEX_DESCRIPTION', 'sDescription');
define('PG_MENUITEM_INDEX_SEOFOLLOW', 'bSeoFollow');
define('PG_MENUITEM_INDEX_SUBMENU', 'axSubMenu');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Menu extends classPG_ClassBasics
{
	// Declarations...
	private $axMenuItems = array();
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGMenu'));

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_menu.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_menu.php',
                'foundation' => 'gfx/default/templates/controls/foundation_menu.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sDescription [type]string[/type]
	[en]...[/en]
	
	@param iMenuItemIndex [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getDescription($_iMenuItemIndex)
	{
		$_iMenuItemIndex = $this->getRealParameter(array('oParameters' => $_iMenuItemIndex, 'sName' => 'iMenuItemIndex', 'xParameter' => $_iMenuItemIndex));
		return $this->axMenuItems[$_iMenuItemIndex][PG_MENUITEM_INDEX_DESCRIPTION];
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return iMenuItemIndex [type]int[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sMenuItemID [type]string[/type]
	[en]...[/en]
	
	@param sUrl [type]string[/type]
	[en]...[/en]
	
	@param sUrlTarget [type]string[/type]
	[en]...[/en]
	
	@param axUrlParameters [type]mixed[][/type]
	[en]...[/en]
	
	@param sOnClick [type]string[/type]
	[en]...[/en]
	
	@param sShortDescription [type]string[/type]
	[en]...[/en]
	
	@param sDescription [type]string[/type]
	[en]...[/en]
	
	@param bSeoFollow [type]bool[/type]
	[en]...[/en]
	*/
	public function addMenuItem(
		$_sName, 
		$_sMenuItemID = NULL, 
		$_sUrl = NULL, 
		$_sUrlTarget = NULL, 
		$_axUrlParameters = NULL, 
		$_sOnClick = NULL, 
		$_sShortDescription = NULL, 
		$_sDescription = NULL,
		$_bSeoFollow = NULL
	)
	{
		$_sMenuItemID = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sMenuItemID', 'xParameter' => $_sMenuItemID));
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$_sUrlTarget = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sUrlTarget', 'xParameter' => $_sUrlTarget));
		$_axUrlParameters = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'axUrlParameters', 'xParameter' => $_axUrlParameters));
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_sShortDescription = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sShortDescription', 'xParameter' => $_sShortDescription));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_bSeoFollow = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bSeoFollow', 'xParameter' => $_bSeoFollow));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

		$this->axMenuItems[] = array(
			PG_MENUITEM_INDEX_ID => $_sMenuItemID,
			PG_MENUITEM_INDEX_NAME => $_sName,
			PG_MENUITEM_INDEX_URL => $_sUrl,
			PG_MENUITEM_INDEX_URLTARGET => $_sUrlTarget,
			PG_MENUITEM_INDEX_URLPARAMETERS => $_axUrlParameters,
			PG_MENUITEM_INDEX_ONCLICK => $_sOnClick,
			PG_MENUITEM_INDEX_SHORTDESCRIPTION => $_sShortDescription,
			PG_MENUITEM_INDEX_DESCRIPTION => $_sDescription,
			PG_MENUITEM_INDEX_SEOFOLLOW => $_bSeoFollow
		);
		
		return count($this->axMenuItems)-1;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sMenuHtml [type]string[/type]
	[en]...[/en]
	
	@param sMenuID [type]string[/type]
	[en]...[/en]
	
	@param sUrl [type]string[/type]
	[en]...[/en]
	
	@param sUrlTarget [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sMenuID = NULL, $_sUrl = NULL, $_sUrlTarget = NULL, $_axMenuItems = NULL, $_sTemplateName = NULL)
	{
		global $oPGStrings, $oPGUrls;
	
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sMenuID, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$_sUrlTarget = $this->getRealParameter(array('oParameters' => $_sMenuID, 'sName' => 'sUrlTarget', 'xParameter' => $_sUrlTarget));
		$_axMenuItems = $this->getRealParameter(array('oParameters' => $_sMenuID, 'sName' => 'axMenuItems', 'xParameter' => $_axMenuItems));
        $_sTemplateName = $this->getRealParameter(array('oParameters' => $_sMenuID, 'sName' => 'sTemplateName', 'xParameter' => $_sTemplateName));
		$_sMenuID = $this->getRealParameter(array('oParameters' => $_sMenuID, 'sName' => 'sMenuID', 'xParameter' => $_sMenuID));

		if ($_sUrl === NULL) {$_sUrl = $this->getUrl();}
		if ($_sUrlTarget === NULL) {$_sUrlTarget = $this->getUrlTarget();}
		if ($_axMenuItems === NULL) {$_axMenuItems = $this->axMenuItems;}
		
		$_bFirstMenu = false;
		if ($_sMenuID === NULL) {$_sMenuID = $this->getNextID(); $_bFirstMenu = true;}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}

		$_sHtml = '';
		$_sHtml .= '<ul id="'.$_sMenuID.'" style="';
			if ($_bFirstMenu == true) {$_sHtml .= 'display:block; ';} else {$_sHtml .= 'display:none; ';}
		$_sHtml .= '" class="menu">';
		
		for ($i=0; $i<count($_axMenuItems); $i++)
		{
			if ($_axMenuItems[$i][PG_MENUITEM_INDEX_URL] === NULL) {$_axMenuItems[$i][PG_MENUITEM_INDEX_URL] = '';}
			if ($_axMenuItems[$i][PG_MENUITEM_INDEX_URLTARGET] === NULL) {$_axMenuItems[$i][PG_MENUITEM_INDEX_URLTARGET] = '';}
			if ($_axMenuItems[$i][PG_MENUITEM_INDEX_ONCLICK] === NULL) {$_axMenuItems[$i][PG_MENUITEM_INDEX_ONCLICK] = '';}
			if ($_axMenuItems[$i][PG_MENUITEM_INDEX_SHORTDESCRIPTION] === NULL) {$_axMenuItems[$i][PG_MENUITEM_INDEX_SHORTDESCRIPTION] = '';}
			if ($_axMenuItems[$i][PG_MENUITEM_INDEX_SEOFOLLOW] === NULL) {$_axMenuItems[$i][PG_MENUITEM_INDEX_SEOFOLLOW] = true;}
		
			$_sUrlTarget2 = $_axMenuItems[$i][PG_MENUITEM_INDEX_URLTARGET];
			if ($_sUrlTarget2 == '') {$_sUrlTarget2 = $_sUrlTarget;}
		
			$_bIsLink = true; // TODO!
			if (($_axMenuItems[$i][PG_MENUITEM_INDEX_URL] != '') || ($_axMenuItems[$i][PG_MENUITEM_INDEX_ONCLICK] != '')) {$_bIsLink = true;}
		
			$_sHtml .= '<li id="'.$_sMenuID.'MenuPoint'.$i.'" class="menu_item">';
				if ($_bIsLink == true)
				{
					$_sHtml .= $oPGUrls->buildLink(
						array(
							'sName' => $_axMenuItems[$i][PG_MENUITEM_INDEX_NAME],
							'sDescription' => $_axMenuItems[$i][PG_MENUITEM_INDEX_SHORTDESCRIPTION],
							'sUrl' => $_axMenuItems[$i][PG_MENUITEM_INDEX_URL],
							'sUrlTarget' => $_sUrlTarget2,
							'axUrlParameters' => $_axMenuItems[$i][PG_MENUITEM_INDEX_URLPARAMETERS],
							'sOnClick' => $_axMenuItems[$i][PG_MENUITEM_INDEX_ONCLICK],
							'bSeoFollow' => $_axMenuItems[$i][PG_MENUITEM_INDEX_SEOFOLLOW]
						)
					);
				}
				else {$_sHtml .= $_axMenuItems[$i][PG_MENUITEM_INDEX_NAME];}
			$_sHtml .= '</li>';
			if (isset($_axMenuItems[$i][PG_MENUITEM_INDEX_SUBMENU]))
			{
				if ($_axMenuItems[$i][PG_MENUITEM_INDEX_SUBMENU] != NULL)
				{
					$_sHtml .= $this->build(
						array(
							'sMenuID' => $_sMenuID.'_'.$oPGStrings->urlEncode(array('sString' => $_axMenuItems[$i]['sName'])),
							'sUrl' => $_sUrl,
							'sUrlTarget' => $_sUrlTarget,
							'axMenuItems' => $_axMenuItems[$i][PG_MENUITEM_INDEX_SUBMENU]
						)
					);
				}
			}
		}
		
		$_sHtml .= '</ul>';
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGMenu = new classPG_Menu();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMenu', 'xValue' => $oPGMenu));}
?>