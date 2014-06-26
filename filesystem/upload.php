<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 16 2012
*/
define('PG_UPLOAD_METHOD_HTML', 0);
define('PG_UPLOAD_METHOD_PERLCGI', 1);
define('PG_UPLOAD_METHOD_FLASH', 2);

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Upload extends classPG_ClassBasics
{
	// Declarations...
	private $iUploadMethod = PG_UPLOAD_METHOD_HTML;
	private $sUploadFileID = '';
	private $sFileTargetDir = '';
	private $sTargetPageURL = '';
	private $sPerlCGIPath = 'C:/inetpub/wwwroot/cgi-bin/';
	private $sUploadPerlScript = 'upload.pl';
	private $sFormFileFieldText = 'File: ';
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGUpload'));
		$this->initClassBasics();
	}
	
	// Methods...
	/*
	@start method
	
	@param iUploadMethod [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setMethod($_iUploadMethod)
	{
		$_iUploadMethod = $this->getRealParameter(array('oParameters' => $_iUploadMethod, 'sName' => 'iUploadMethod', 'xParameter' => $_iUploadMethod));
		$this->iUploadMethod = $_iUploadMethod;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iUploadMethod [type]int[/type]
	[en]...[/en]
	*/
	public function getMethod() {return $this->iUploadMethod;}
	/* @end method */
	
	/*
	@start method
	
	@param sDir [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setFileTargetDir($_sDir)
	{
		$_sDir = $this->getRealParameter(array('oParameters' => $_sDir, 'sName' => 'sDir', 'xParameter' => $_sDir));
		$this->sFileTargetDir = $_sDir;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFileTargetDir [type]string[/type]
	[en]...[/en]
	*/
	public function getFileTargetDir() {return $this->sFileTargetDir;}
	/* @end method */

	/*
	@start method
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setTargetPageUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sTargetPageURL = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sTargetPageURL [type]string[/type]
	[en]...[/en]
	*/
	public function getTargetPageUrl() {return $this->sTargetPageURL;}
	/* @end method */
	
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setPerlCGIPath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sPerlCGIPath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sPerlCGIPath [type]string[/type]
	[en]...[/en]
	*/
	public function getPerlCGIPath() {return $this->sPerlCGIPath;}
	/* @end method */
	
	/*
	@start method
	
	@param sScript [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setPerlUploadScript($_sScript)
	{
		$_sScript = $this->getRealParameter(array('oParameters' => $_sScript, 'sName' => 'sScript', 'xParameter' => $_sScript));
		$this->sUploadPerlScript = $_sScript;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUploadPerlScript [type]string[/type]
	[en]...[/en]
	*/
	public function getPerlUploadScript() {return $this->sUploadPerlScript;}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sUploadID [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sUploadID = NULL)
	{
		$_sUploadID = $this->getRealParameter(array('oParameters' => $_sUploadID, 'sName' => 'sUploadID', 'xParameter' => $_sUploadID));

		$_sReturn = '';
		if ($_sUploadID === NULL) {$_sUploadID = $this->getNextID();}
		if ($this->sUploadFileID == '') {$this->sUploadFileID = $this->buildUploadFileID();}
		
		$_sReturn .= '<div id="'.$_sUploadID.'UploadFormDiv" style="display:block;">';
			switch($this->iUploadMethod)
			{
				case PG_UPLOAD_METHOD_HTML:
					$_sReturn .= '<form id="'.$_sUploadID.'UploadForm" action="'.$this->sTargetPageURL.'" target="_self" method="post" enctype="multipart/form-data">';
					$_sReturn .= $this->sFormFileFieldText.'<input type="file" id="'.$_sUploadID.'UploadFile" name="sUploadFile" />'; // accept="text/*" maxlength="2097152" />'; // maxlength = size in bytes
					$_sReturn .= '<br /><br />';
					$_sReturn .= '<input id="'.$_sUploadID.'UploadHTMLButton" type="submit" value="upload" />';
					$_sReturn .= '</form>';
				break;
				
				case PG_UPLOAD_METHOD_PERLCGI:
					$_sReturn .= '<form id="'.$_sUploadID.'UploadForm" action="'.$this->sPerlCGIPath.$this->sUploadPerlScript;
					$_sReturn .= '?sUploadFileID='.$this->sUploadFileID;
					$_sReturn .= '&sTargetDir='.$this->sFileTargetDir;
					$_sReturn .= '" method="post" enctype="multipart/form-data" ';
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$_sReturn .= 'target="'.$_sUploadID.'UploadFrame" ';}
					else {$_sReturn .= 'target="_self" ';}
					$_sReturn .= '>';
					$_sReturn .= $this->sFormFileFieldText.'<input type="file" id="'.$_sUploadID.'UploadFile" name="sUploadFile" />'; // accept="text/*" maxlength="2097152" />';
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH)))
					{
						$_sReturn .= '<br /><br />';
						$_sReturn .= '<iframe id="'.$_sUploadID.'UploadFrame" name="'.$_sUploadID.'UploadFrame" frameborder="0" style="width:500px; height:50px;"></iframe>';
					}
					$_sReturn .= '<br /><br />';
					$_sReturn .= '<input id="'.$_sUploadID.'UploadJSButton" type="button" value="upload" onclick="oPGUpload.start(\''.$_sUploadID.'\');" style="display:none;" />';
					$_sReturn .= '<input id="'.$_sUploadID.'UploadHTMLButton" type="submit" value="upload" />';
					$_sReturn .= '</form>';
				break;
				
				case PG_UPLOAD_METHOD_FLASH:
				break;
			}
			$_sReturn .= '<input type="hidden" id="'.$_sUploadID.'UploadFileID" value="'.$this->sUploadFileID.'" />';
		$_sReturn .= '</div>';
		
		if ($this->iUploadMethod == PG_UPLOAD_METHOD_PERLCGI)
		{
			$_sReturn .= '<div id="'.$_sUploadID.'UploadStatusDiv" style="overflow:auto; display:none; width:500px; height:200px; border:solid 1px #000000;"></div>';
		}
		
		return $_sReturn;
	}
	/* @end method */

	/*
	@start method
	
	@return fSeed [type]float[/type]
	[en]...[/en]
	*/
	public function makeSeed()
	{
		list($_iUSec, $_iSec) = explode(' ', microtime());
		return (float) $_iUSec + ((float) $_iSec * 100000);
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUploadID [type]string[/type]
	[en]...[/en]
	*/
	public function buildUploadFileID()
	{
		mt_srand($this->makeSeed());
		return md5(time().'_'.mt_rand());
	}
	/* @end method */
	
	/* @start method */
	public function putXmlHader()
	{
		header("Content-Type: text/xml");
	}
	/* @end method */
}
/* @end class */
$oPGUpload = new classPG_Upload();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGUpload', 'xValue' => $oPGUpload));}
?>