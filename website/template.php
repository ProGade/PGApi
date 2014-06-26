<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 06 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Template extends classPG_ClassBasics
{
	// Declarations...
	private $sVariablePrefix = '{{';
	private $sVariableSuffix = '}}';
	
	private $sTemplateFileExtension = 'php';
	private $sTemplate = '';
	
	private $bReplaceBBCode = true;
	private $bReplaceDates = true;
	private $bReplaceUrlProtocols = true;
	private $bEncodeMails = false;
    private $bBodyOnly = true;
	
	private $asReplaceVars = array();
	
	// Construct...
	// public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group Template
	
	@param sTemplate [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setTemplate($_sTemplate)
	{
		$_sTemplate = $this->getRealParameter(array('oParameters' => $_sTemplate, 'sName' => 'sTemplate', 'xParameter' => $_sTemplate));
		$this->sTemplate = $_sTemplate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return sTemplate [type]string[/type]
	[en]...[/en]
	*/
	public function getTemplate() {return $this->sTemplate;}
	/* @end method */
	
	/*
	@start method
	
	@group Extension
	
	@param sExtension [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setTemplateFileExtension($_sExtension)
	{
		$_sExtension = $this->getRealParameter(array('oParameters' => $_sExtension, 'sName' => 'sExtension', 'xParameter' => $_sExtension));
		$this->sTemplateFileExtension = $_sExtension;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Extension
	
	@return sTemplateFileExtension [type]string[/type]
	[en]...[/en]
	*/
	public function getTemplateFileExtension() {return $this->sTemplateFileExtension;}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useReplaceBBCode($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bReplaceBBCode = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return bReplaceBBCode [type]bool[/type]
	[en]...[/en]
	*/
	public function isReplaceBBCode() {return $this->bReplaceBBCode;}
	/* @end method */
	
	/*
	@start method
	
	@group Dates
	
	@param bUse [needed][type]bool[/en]
	[en]...[/en]
	*/
	public function useReplaceDates($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bReplaceDates = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Dates
	
	@return bReplaceDates [type]bool[/type]
	[en]...[/en]
	*/
	public function isReplaceDates() {return $this->bReplaceDates;}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useReplaceUrlProtocols($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bReplaceUrlProtocols = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@return bReplaceUrlProtocols [type]bool[/type]
	[en]...[/en]
	*/
	public function isReplaceUrlProtocols() {return $this->bReplaceUrlProtocols;}
	/* @end method */
	
	/*
	@start method
	
	@group Mails
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useEncodeMails($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bEncodeMails = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mails
	
	@return bEncodedMails [type]bool[/type]
	[en]...[/en]
	*/
	public function isEncodeMails() {return $this->bEncodeMails;}
	/* @end method */
	
	/*
	@start method
	
	@group Variables
	
	@param asVars [needed][type]string[][/type]
	*/
	public function setReplaceVars($_asVars)
	{
		$_asVars = $this->getRealParameter(array('oParameters' => $_asVars, 'sName' => 'asVars', 'xParameter' => $_asVars, 'bNotNull' => true));
		$this->asReplaceVars = $_asVars;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Variables
	
	@return asReplaceVars [type]string[][/type]
	*/
	public function getReplaceVars() {return $this->asReplaceVars;}
	/* @end method */
	
	/*
	@start method
	
	@group Variables
	
	@param sVarname [needed][type]string[/type]
	[en]...[/en]
	
	@param sReplace [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addReplaceVar($_sVarname, $_sReplace = NULL)
	{
		$_sReplace = $this->getRealParameter(array('oParameters' => $_sVarname, 'sName' => 'sReplace', 'xParameter' => $_sReplace));
		$_sVarname = $this->getRealParameter(array('oParameters' => $_sVarname, 'sName' => 'sVarname', 'xParameter' => $_sVarname));
		$this->asReplaceVars[$_sVarname] = $_sReplace;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Variables
	
	@return sReplace [type]string[/type]
	[en]...[/en]
	
	@param sVarname [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getReplaceVar($_sVarname)
	{
		$_sVarname = $this->getRealParameter(array('oParameters' => $_sVarname, 'sName' => 'sVarname', 'xParameter' => $_sVarname));
		return $this->asReplaceVars[$_sVarname];
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function loadTemplateFromFile($_sFile)
	{
		global $oPGApi;

		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		
		if ($_sFile === NULL) {return false;}
		ob_start();
		include($_sFile);
		$this->sTemplate = ob_get_contents();
		ob_end_clean();

        /*if ($this->bBodyOnly == true)
        {
            $_iBodyOpenTag = stripos($this->sTemplate, '<body');
            $_iBodyCloseTag = stripos($this->sTemplate, '</body>');
            if (($_iBodyOpenTag != false) && ($_iBodyCloseTag != false))
            {
                $this->sTemplate = substr($this->sTemplate, -$_iBodyOpenTag, $_iBodyCloseTag);
            }
        }*/
		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param sTemplate [needed][type]string[/type]
	[en]...[/en]
	*/
	public function saveTemplateToFile($_sFile, $_sTemplate = NULL)
	{
		$_sTemplate = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sTemplate', 'xParameter' => $_sTemplate));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_sFile === NULL) {return false;}
		if ($_sTemplate === NULL) {$_sTemplate = $this->sTemplate;}
		if (file_put_contents($_sFile, $_sTemplate) === false) {return false;}
		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return sTemplate [type]string[/type]
	[en]...[/en]
	
	@param xTemplate [type]mixed[/type]
	[en]...[/en]
	
	@param bReplaceUrlProtocols [type]bool[/type]
	[en]...[/en]
	
	@param bReplaceBBCode [type]bool[/type]
	[en]...[/en]
	
	@param bReplaceDates [type]bool[/type]
	[en]...[/en]
	
	@param bEncodeMails [type]bool[/type]
	[en]...[/en]
	*/
	public function build(
		$_xTemplate = NULL, 
		$_bReplaceUrlProtocols = NULL, 
		$_bReplaceBBCode = NULL, 
		$_bReplaceDates = NULL, 
		$_bEncodeMails = NULL
	)
	{
		global $oPGStrings;
		
		$_bReplaceUrlProtocols = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bReplaceUrlProtocols', 'xParameter' => $_bReplaceUrlProtocols));
		$_bReplaceBBCode = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bReplaceBBCode', 'xParameter' => $_bReplaceBBCode));
		$_bReplaceDates = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bReplaceDates', 'xParameter' => $_bReplaceDates));
		$_bEncodeMails = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'bEncodeMails', 'xParameter' => $_bEncodeMails));
		$_xTemplate = $this->getRealParameter(array('oParameters' => $_xTemplate, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));

		if ($_xTemplate != NULL) {$this->sTemplate = $_xTemplate;}
		if ($_bReplaceUrlProtocols === NULL) {$_bReplaceUrlProtocols = $this->bReplaceUrlProtocols;}
		if ($_bReplaceBBCode === NULL) {$_bReplaceBBCode = $this->bReplaceBBCode;}
		if ($_bReplaceDates === NULL) {$_bReplaceDates = $this->bReplaceDates;}
		if ($_bEncodeMails === NULL) {$_bEncodeMails = $this->bEncodeMails;}
		
		if (isset($oPGStrings))
		{
			$_sExtension = $oPGStrings->getFileExtension(array('sString' => $this->sTemplate));
			if (strtolower($_sExtension) == strtolower($this->sTemplateFileExtension))
			{
				$this->loadTemplateFromFile(array('sFile' => $this->sTemplate));
			}
			
			foreach($this->asReplaceVars as $_sSearch => $_sReplace)
			{
				$this->sTemplate = str_replace($this->sVariablePrefix.$_sSearch.$this->sVariableSuffix, $_sReplace, $this->sTemplate);
			}
			
			if ($_bReplaceDates == true) {$this->sTemplate = $oPGStrings->dateReplace(array('sString' => $this->sTemplate, 'sPrefix' => $this->sVariablePrefix, 'sSuffix' => $this->sVariableSuffix));}
			if ($_bEncodeMails == true) {$this->sTemplate = $oPGStrings->findMailsAndEncode(array('sString' => $this->sTemplate, 'sAt' => NULL, 'sDot' => NULL));}
			if ($_bReplaceUrlProtocols == true) {$this->sTemplate = $oPGStrings->changeUrlProtocol(array('sString' => $this->sTemplate, 'sProtcol' => NULL));}
			// if ($_bReplaceBBCode == true) {$this->sTemplate = $oPGStrings->bbCodeToHtml(array('sString' => $this->sTemplate, 'bBBCodeOnly' => true));}
		}
		
		return $this->sTemplate;
	}
	/* @end method */
}
/* @end class */
$oPGTemplate = new classPG_Template();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGTemplate', 'xValue' => $oPGTemplate));}
?>