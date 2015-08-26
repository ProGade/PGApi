<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
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
	private $asTemplates = array();
	
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
	
	@param asTemplates [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function setTemplates($_asTemplates)
	{
		$_asTemplates = $this->getRealParameter(array('oParameters' => $_asTemplates, 'sName' => 'asTemplates', 'xParameter' => $_asTemplates));
		$this->asTemplates = $_asTemplates;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@param sTemplate [needed][type]string[/type]
	[en]...[/en]
	
	@param sName [type]string[/type]
	[en]...[/en]
	*/
	public function setTemplate($_sTemplate, $_sName = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sTemplate, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sTemplate = $this->getRealParameter(array('oParameters' => $_sTemplate, 'sName' => 'sTemplate', 'xParameter' => $_sTemplate));
		if ($_sName === NULL) {$_sName = 'default';}
		$this->asTemplates[$_sName] = $_sTemplate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return sTemplate [type]string[/type]
	[en]...[/en]
	
	@param sName [type]string[/type]
	[en]...[/en]
	*/
	public function getTemplate($_sName = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if ($_sName === NULL) {$_sName = 'default';}
		return $this->asTemplates[$_sName];
	}
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

		$_sName = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		
		if ($_sFile === NULL) {return false;}
		
		$_sTemplate = '';
		
		ob_start();
		include($_sFile);
		$_sTemplate = ob_get_contents();
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
		return $_sTemplate;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	
	@param sName [type]string[/type]
	[en]...[/en]
	
	@param sTemplate [needed][type]string[/type]
	[en]...[/en]
	*/
	public function saveTemplateToFile($_sFile, $_sName = NULL, $_sTemplate = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sName', 'xParameter' => $_sName));
		$_sTemplate = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sTemplate', 'xParameter' => $_sTemplate));
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));

		if ($_sFile === NULL) {return false;}
		if ($_sName === NULL) {$_sName = 'default';}
		if ($_sTemplate === NULL) {$_sTemplate = $this->asTemplates[$_sName];}
		if (file_put_contents($_sFile, $_sTemplate) === false) {return false;}
		return true;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Template
	
	@return sTemplate [type]string[/type]
	[en]...[/en]

	@param sName [type]string[/type]
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
		$_sName = NULL,
		$_xTemplate = NULL, 
		$_bReplaceUrlProtocols = NULL, 
		$_bReplaceBBCode = NULL, 
		$_bReplaceDates = NULL, 
		$_bEncodeMails = NULL
	)
	{
		global $oPGStrings;
		
		$_xTemplate = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		$_bReplaceUrlProtocols = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bReplaceUrlProtocols', 'xParameter' => $_bReplaceUrlProtocols));
		$_bReplaceBBCode = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bReplaceBBCode', 'xParameter' => $_bReplaceBBCode));
		$_bReplaceDates = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bReplaceDates', 'xParameter' => $_bReplaceDates));
		$_bEncodeMails = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bEncodeMails', 'xParameter' => $_bEncodeMails));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

		if ($_sName != NULL) {$_asTemplates = array($_sName => $this->asTemplates[$_sName]);}
		else if ($_xTemplate != NULL)
		{
			if (is_array($_xTemplate)) {$_asTemplates = $_xTemplate;}
			else if (is_string($_xTemplate)) {$_asTemplates['default'] = $_xTemplate;}
		}
		else {$_asTemplates = $this->asTemplates;}
		#
		if ($_bReplaceUrlProtocols === NULL) {$_bReplaceUrlProtocols = $this->bReplaceUrlProtocols;}
		if ($_bReplaceBBCode === NULL) {$_bReplaceBBCode = $this->bReplaceBBCode;}
		if ($_bReplaceDates === NULL) {$_bReplaceDates = $this->bReplaceDates;}
		if ($_bEncodeMails === NULL) {$_bEncodeMails = $this->bEncodeMails;}
		
		if (isset($oPGStrings))
		{
			foreach ($_asTemplates as $_sName => $_sTemplate)
			{
				$_sExtension = $oPGStrings->getFileExtension(array('sString' => $_sTemplate));
				if (strtolower($_sExtension) == strtolower($this->sTemplateFileExtension))
				{
					$_asTemplates[$_sName] = $this->loadTemplateFromFile(array('sFile' => $_sTemplate));
				}
				
				foreach($this->asReplaceVars as $_sSearch => $_sReplace)
				{
					$_asTemplates[$_sName] = str_replace($this->sVariablePrefix.$_sSearch.$this->sVariableSuffix, $_sReplace, $_asTemplates[$_sName]);
				}
				
				if ($_bReplaceDates == true) {$_asTemplates[$_sName] = $oPGStrings->dateReplace(array('sString' => $_asTemplates[$_sName], 'sPrefix' => $this->sVariablePrefix, 'sSuffix' => $this->sVariableSuffix));}
				if ($_bEncodeMails == true) {$_asTemplates[$_sName] = $oPGStrings->findMailsAndEncode(array('sString' => $_asTemplates[$_sName], 'sAt' => NULL, 'sDot' => NULL));}
				if ($_bReplaceUrlProtocols == true) {$_asTemplates[$_sName] = $oPGStrings->changeUrlProtocol(array('sString' => $_asTemplates[$_sName], 'sProtcol' => NULL));}
				// if ($_bReplaceBBCode == true) {$_asTemplates[$_sName] = $oPGStrings->bbCodeToHtml(array('sString' => $_asTemplates[$_sName], 'bBBCodeOnly' => true));}
			}
		}
		
		if ((!empty($_asTemplates['default'])) && (count($_asTemplates) == 1)) {return $_asTemplates['default'];}
		return $_asTemplates;
	}
	/* @end method */
}
/* @end class */
$oPGTemplate = new classPG_Template();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGTemplate', 'xValue' => $oPGTemplate));}
?>