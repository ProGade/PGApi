<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Feb 10 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Urls extends classPG_ClassBasics
{
	// Declarations...
	private $sUrlParameterName = 'id';
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@description
	[en]...[/en]
	*/
	public function setUrlParameterName($_sName)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->sUrlParameterName = $_sName;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sName [type]string[/type]
	[en]...[/en]
	*/
	public function getUrlParameterName()
	{
		return $this->sUrlParameterName;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sLink [type]string[/type]
	[en]...[/en]
	
	@param sName [needed][type]string[/type]
	[en]...[/en]
	
	@param sDescription [type]string[/type]
	[en]...[/en]
	
	@param sUrl [type]string[/type]
	[en]...[/en]
	
	@param sUrlTarget [type]string[/type]
	[en]...[/en]
	
	@param axUrlParameters [type]mixed[][/type]
	[en]...[/en]
	
	@param sOnClick [type]string[/type]
	[en]...[/en]
	
	@param bSeoFollow [type]bool[/type]
	[en]...[/en]
	*/
	public function buildLink($_sName, $_sDescription = NULL, $_sUrl = NULL, $_sUrlTarget = NULL, $_axUrlParameters = NULL, $_sOnClick = NULL, $_bSeoFollow = NULL)
	{
		global $oPGStrings;
	
		$_sDescription = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$_sUrlTarget = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sUrlTarget', 'xParameter' => $_sUrlTarget));
		$_axUrlParameters = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'axUrlParameters', 'xParameter' => $_axUrlParameters));
		$_sOnClick = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sOnClick', 'xParameter' => $_sOnClick));
		$_bSeoFollow = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'bSeoFollow', 'xParameter' => $_bSeoFollow));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));

		if ($_sDescription === NULL) {$_sDescription = '';}
		if ($_sUrl === NULL) {$_sUrl = '';}
		if ($_sUrlTarget === NULL) {$_sUrlTarget = '';}
		if ($_sOnClick === NULL) {$_sOnClick = '';}
		if ($_bSeoFollow === NULL) {$_bSeoFollow = true;}
		if ($_axUrlParameters === NULL) {$_axUrlParameters = array();}
	
		if ($_sUrl == '')
		{
			if ($_sOnClick != '')
			{
				$_sUrl = 'javascript:;';
				if ($_sUrlTarget == '') {$_sUrlTarget = '_self';}
			}
			else
			{
				if (count($_axUrlParameters) < 1) {$_axUrlParameters[] = array('sName' => $this->sUrlParameterName, 'xValue' => $oPGStrings->urlEncode(array('sString' => $_sName)));}
				$_sUrl = $this->getUrl();
				if ($_sUrl == '') {$_sUrl = 'index.php';}
				$_sUrl = $this->build(array('sUrl' => $_sUrl, 'axUrlParameters' => $_axUrlParameters));
			}
		}
		else {$_sUrl = $this->build(array('sUrl' => $_sUrl, 'axUrlParameters' => $_axUrlParameters));}
		
		if ($_sUrlTarget == '')
		{
			$_sUrlTarget = $this->getUrlTarget();
			if ($_sUrlTarget == '') {$_sUrlTarget = '_blank';}
		}
			
		$_sHtml = '';
		
		$_sHtml .= '<a href="'.$_sUrl.'" ';
		if ($_bSeoFollow == false) {$_sHtml .= 'rel="nofollow" ';}
		if ($_sOnClick != '') {$_sHtml .= 'onmouseup="'.$_sOnClick.'" ';}
		if ($_sDescription != '') {$_sHtml .= 'title="'.$_sDescription.'" ';}
		$_sHtml .= 'target="'.$_sUrlTarget.'">';
			$_sHtml .= $_sName;
		$_sHtml .= '</a>';
		
		return $_sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	
	@param axUrlParameters [type]mixed[][/type]
	[en]...[/en]
	*/
	public function build($_sUrl, $_axUrlParameters = NULL)
	{
		$_axUrlParameters = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'axUrlParameters', 'xParameter' => $_axUrlParameters));
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));

		$_sString = '';
		$_sString .= $_sUrl;

		$_sParameters = '';
		$_sParameters .= $this->getUrlParametersString();
		if ($_axUrlParameters !== NULL)
		{
			if (count($_axUrlParameters) > 0)
			{
				for ($i=0; $i<count($_axUrlParameters); $i++)
				{
					if ($_sParameters != '') {$_sParameters .= '&';}
					$_sParameters .= $_axUrlParameters[$i]['sName'].'='.$_axUrlParameters[$i]['xValue'];
				}
			}
		}

		if ($_sParameters != '')
		{
			if (stripos($_sUrl, '?') === false) {$_sString .= '?';} else {$_sString .= '&';}
			$_sString .= $_sParameters;
		}
		
		return $_sString;
	}
	/* @end method */
}
/* @end class */
$oPGUrls = new classPG_Urls();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGUrls', 'xValue' => $oPGUrls));}
?>