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
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Download
{
	// Declarations...
	private $sFilePath = '';
	private $sFileName = '';
	private $dFileSize = 0;
	private $sExtension = '';
	private $sContentType = '';
	private $sContentEncoding = '';
	private $sContentText = '';
	private $sCharset = '';
	private $bNoCache = true;
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setFilePath($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sFilePath = $_sPath;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFilePath [type]string[/type]
	[en]...[/en]
	*/
	public function getFilePath() {return $this->sFilePath;}
	/* @end method */
	
	/*
	@start method
	
	@param sFile [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setFileName($_sFile)
	{
		$_sFile = $this->getRealParameter(array('oParameters' => $_sFile, 'sName' => 'sFile', 'xParameter' => $_sFile));
		$this->sFileName = $_sFile;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFileName [type]string[/type]
	[en]...[/en]
	*/
	public function getFileName() {return $this->sFileName;}
	/* @end method */
	
	/*
	@start method
	
	@param sExtension [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setExtension($_sExtension)
	{
		$_sExtension = $this->getRealParameter(array('oParameters' => $_sExtension, 'sName' => 'sExtension', 'xParameter' => $_sExtension));
		$this->sExtension = $_sExtension;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sExtension [type]string[/type]
	[en]...[/en]
	*/
	public function getExtension() {return $this->sExtension;}
	/* @end method */
	
	/*
	@start method
	
	@param sContentType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContentType($_sContentType)
	{
		$_sContentType = $this->getRealParameter(array('oParameters' => $_sContentType, 'sName' => 'sContentType', 'xParameter' => $_sContentType));
		$this->sContentType = $_sContentType;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContentType [type]string[/type]
	[en]...[/en]
	*/
	public function getContentType() {return $this->sContentType;}
	/* @end method */
	
	/*
	@start method
	
	@param sContentEncoding [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContentEncoding($_sContentEncoding)
	{
		$_sContentEncoding = $this->getRealParameter(array('oParameters' => $_sContentEncoding, 'sName' => 'sContentEncoding', 'xParameter' => $_sContentEncoding));
		$this->sContentEncoding = $_sContentEncoding;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContentEncoding [type]string[/type]
	[en]...[/en]
	*/
	public function getContentEncoding() {return $this->sContentEncoding;}
	/* @end method */
	
	/*
	@start method
	
	@param sContentText [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setContentText($_sContentText)
	{
		$_sContentText = $this->getRealParameter(array('oParameters' => $_sContentText, 'sName' => 'sContentText', 'xParameter' => $_sContentText));
		$this->sContentText = $_sContentText;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sContentText [type]string[/type]
	[en]...[/en]
	*/
	public function getContentText() {return $this->sContentText;}
	/* @end method */
	
	/*
	@start method
	
	@param sCharset [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setCharset($_sCharset)
	{
		$_sCharset = $this->getRealParameter(array('oParameters' => $_sCharset, 'sName' => 'sCharset', 'xParameter' => $_sCharset));
		$this->sCharset = $_sCharset;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sCharset [type]string[/type]
	[en]...[/en]
	*/
	public function getCharset() {return $this->sCharset;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useNoCache($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bNoCache = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bNoCache [type]bool[/type]
	[en]...[/en]
	*/
	public function isNoCache() {return $this->bNoCache;}
	/* @end method */
	
	/*
	@start method
	
	@return sFileContent [type]string[/type]
	[en]...[/en]
	*/
	public function build()
	{
		$_sHtml = '';
		if ($this->sFilePath != '')
		{
			if (file_exists($this->sFilePath))
			{
				$this->dFileSize = filesize($this->sFilePath);
				$_axFileParts = pathinfo($this->sFilePath);
				$this->sExtension = strtolower($_axFileParts['extension']);
				if ($this->sFileName == '') {$this->sFileName = basename($this->sFilePath, '.'.$this->sExtension);}
			}
		}
		
		if ($this->sFileName == '') {$this->sFileName = 'unnamed';}
		if ($this->sCharset == '') {$this->sCharset = 'iso-8859-1';}

		if ($this->sContentType == '')
		{
			switch ($this->sExtension)
			{
				case "pdf": $this->sContentType = 'application/pdf'; break;
				case "exe": $this->sContentType = 'application/octet-stream'; break;
				case "zip": $this->sContentType = 'application/zip'; break;
				case "doc": $this->sContentType = 'application/msword'; break;
				case "xls": $this->sContentType = 'application/vnd.ms-excel'; break;
				case "ppt": $this->sContentType = 'application/vnd.ms-powerpoint'; break;
				case 'csv': $this->sContentType = 'text/csv'; $this->sCharset = 'utf-8'; break;
				case "gif": $this->sContentType = 'image/gif'; break;
				case "png": $this->sContentType = 'image/png'; break;
				case "jpeg":
				case 'jpg': $this->sContentType = 'image/jpg'; break;
				// default: $this->sContentType = 'application/force-download';
				default: $this->sContentType = 'application/octet-stream';
			}
		}
		
		if ($this->sContentEncoding == '') {$this->sContentEncoding = $this->sCharset;}

		header("Pragma: public"); // required
		if ($this->bNoCache == true)
		{
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Cache-Control: private', false); // required for certain browsers
		}
		header('Content-Encoding: '.$this->sContentEncoding);
		header('Content-Type: '.$this->sContentType.'; charset='.$this->sCharset);
		// header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.str_replace('.'.$this->sExtension, "", $this->sFileName).'.'.$this->sExtension.'"');
		header('Content-Transfer-Encoding: binary');
		if ($this->dFileSize > 0) {header("Content-Length: ".$this->dFileSize);}
		if (($this->sContentType == 'text/csv') && ($this->sCharset == 'utf-8')) {$_sHtml .= "\xEF\xBB\xBF";} // UTF-8 BOM
		
		if ($this->sFilePath != '')
		{
			ob_start();
			readfile($this->sFilePath);
			$_sHtml .= ob_get_contents();
			ob_end_clean();
		}
		else {$_sHtml .= $this->sContentText;}
		
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGDownload = new classPG_Download();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGDownload', 'xValue' => $oPGDownload));}
?>