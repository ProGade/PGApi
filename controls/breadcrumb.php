<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 20 2012
*/
/*
@start class

@description
[en]This class has methods to create a breadcrumb navigation.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen einer Brotkrümmel-Navigation.[/de]

@param extends classPG_ClassBasics
*/
class classPG_BreadCrumb extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGBreadCrumb'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_breadcrumb.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_breadcrumb.php',
                'foundation' => 'gfx/default/templates/controls/foundation_breadcrumb.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Builds a link structure array for the breadcrumb navigation.[/en]
	[de]Erstellt einen Link-Structure-Array für die Brotkrümmel Navigation.[/de]
	
	@return axLink [type]mixed[][/type]
	[en]Returns the link structure array.[/en]
	[de]Gibt den Link-Structure-Array zurück.[/de]
	
	@param sUrl [needed][type]string[/type]
	[en]The URL for the link.[/en]
	[de]Die URL für den Link.[/de]
	
	@param sName [type]string[/type]
	[en]The name of the link.[/en]
	[de]Der Name des Links.[/de]
	
	@param sTarget [type]string[/type]
	[en]The target frame for the link.[/en]
	[de]Das Zielframe für den Link.[/de]
	*/
	public function buildLinkStructure($_sUrl, $_sName = NULL, $_sTarget = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sTarget = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sTarget', 'xParameter' => $_sTarget));
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		return array('Url' => $_sUrl, 'Name' => $_sName, 'Target' => $_sTarget);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the breadcrumb navigation.[/en]
	[de]Erstellt die Brotkrümmel-Navigation.[/de]
	
	@return sHtml [type]string[/type]
	[en]Returns the breadcrumb navigation as a string.[/en]
	[de]Gibt die Brotkrümmel-Navigation als String zurück.[/de]
	
	@param sBreadCrumbID [type]string[/type]
	[en]The ID for the breadcrumb navigation.[/en]
	[de]Die ID für die Brotkrümmel-Navigation.[/de]
	
	@param axLinkStructures [type]mixed[][/type]
	[en]The link structure array to build the navigation.[/en]
	[de]Das Link-Struktur-Array zum Aufbauen der Navigation.[/de]
	
	@param sSeparator [type]string[/type]
	[en]The separator characters to be placed between the links of the navigation.[/en]
	[de]Die Trennzeichen, die zwischen den Links der Navigation gesetzt werden sollen.[/de]
	
	@param sPrefixText [type]string[/type]
	[en]The introductory text before the navigation.[/en]
	[de]Der Einleitungstext vor der Navigation.[/de]
	
	@param sSuffixText [type]string[/type]
	[en]The final text behind the navigation.[/en]
	[de]Der Schlusstext nach der Navigation.[/de]
	*/
	public function build(
        $_sBreadCrumbID = NULL,
        $_axLinkStructures = NULL,
        $_sSeparator = NULL,
        $_sPrefixText = NULL,
        $_sSuffixText = NULL,

        $_sTemplateName = NULL
    )
	{
		$_axLinkStructures = $this->getRealParameter(array('oParameters' => $_sBreadCrumbID, 'sName' => 'axLinkStructures', 'xParameter' => $_axLinkStructures));
		$_sSeparator = $this->getRealParameter(array('oParameters' => $_sBreadCrumbID, 'sName' => 'sSeparator', 'xParameter' => $_sSeparator));
		$_sPrefixText = $this->getRealParameter(array('oParameters' => $_sBreadCrumbID, 'sName' => 'sPrefixText', 'xParameter' => $_sPrefixText));
		$_sSuffixText = $this->getRealParameter(array('oParameters' => $_sBreadCrumbID, 'sName' => 'sSuffixText', 'xParameter' => $_sSuffixText));
		$_sBreadCrumbID = $this->getRealParameter(array('oParameters' => $_sBreadCrumbID, 'sName' => 'sBreadCrumbID', 'xParameter' => $_sBreadCrumbID));

		if ($_sBreadCrumbID === NULL) {$_sBreadCrumbID = $this->getNextID();}
		if ($_axLinkStructures === NULL) {$_axLinkStructures = array();}
		if ($_sSeparator === NULL) {$_sSeparator = '&gt;';}
		if ($_sPrefixText === NULL) {$_sPrefixText = '';}
		if ($_sSuffixText === NULL) {$_sSuffixText = '';}

        if ($_sTemplateName !== NULL) {return $this->getTemplate()->build(array('sName' => $_sTemplateName));}

        $_sHTML = '';
		
		$_sHTML .= '<div id="'.$_sBreadCrumbID.'">';
		if ($_sPrefixText != '') {$_sHTML .= $_sPrefixText.' ';}
		for ($i=0; $i<count($_axLinkStructures); $i++)
		{
			if ($i>0) {$_sHTML .= ' '.$_sSeparator.' ';}
			if (($_axLinkStructures[$i]['Target'] === '') || ($_axLinkStructures[$i]['Target'] === NULL)) {$_axLinkStructures[$i]['Target'] = '_self';}
			if (($_axLinkStructures[$i]['Url'] === '') || ($_axLinkStructures[$i]['Url'] === NULL)) {$_axLinkStructures[$i]['Url'] = 'index.php';}
			if (($_axLinkStructures[$i]['Name'] === '') || ($_axLinkStructures[$i]['Name'] === NULL)) {$_axLinkStructures[$i]['Name'] = $_axLinkStructures[$i]['Url'];}
			$_sHTML .= '<a href="'.$_axLinkStructures[$i]['Url'].'" target="'.$_axLinkStructures[$i]['Target'].'">'.$_axLinkStructures[$i]['Name'].'</a>';
		}
		if ($_sSuffixText != '') {$_sHTML .= ' '.$_sSuffixText;}
		$_sHTML .= '</div>';
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGBreadCrumb = new classPG_BreadCrumb();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGBreadCrumb', 'xValue' => $oPGBreadCrumb));}
?>