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
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Strings extends classPG_ClassBasics
{
	// Declarations...
	private $sHighlightDivCssClass = '';
	private $sHighlightDivCssStyle = 'margin:10px; padding:0px; color:#000000; background-color:#ffffff; border:solid 1px #000000;';

	private $sHighlightTitleCssClass = '';
	private $sHighlightTitleCssStyle = 'font-size:15px; font-weight:bold; color:#bb0000; width:100%; background-color:#F8E6CB;';

	private $sHighlightTextCssClass = '';
	private $sHighlightTextCssStyle = 'font-size:11px; font-family:\'Lucida Console, arial, verdana\';';
	
	private $sRegExpEmail = "/(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\._-]+)@([a-zA-Z0-9_-]+)(\.)(.{2,5})/is"; //(de|com|info|org|net|jp|nu|it|nl|ru|tv)!is"
	private $sRegExpEmailEncoded = "/(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\._-]+)\[at\]([a-zA-Z0-9_-]+)\[dot\](.{2,5})/is";
	private $sRegExpEmailOnly = "/([a-zA-Z0-9\._-]+)@([a-zA-Z0-9_-]+)(\.)(.{2,5})/is";

	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function isUtf8($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return (utf8_encode(utf8_decode($_sString)) == $_sString);
	}
	/* @end method */

	/*
	@start method
	
	@group Encode
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function urlEncode($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->makeUrlSafe(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Encode
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function toUrlSafe($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->makeUrlSafe(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Encode
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function makeUrlSafe($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		// return htmlentities(urlencode(trim($_sString)));
		return urlencode(trim($_sString));
	}
	/* @end method */

	/*
	@start method
	
	@group Decode
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function urlDecode($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->removeUrlSafe(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Decode
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function toUrlUnsafe($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->removeUrlSafe(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Decode
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function removeUrlSafe($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return stripslashes(urldecode($_sString));
	}
	/* @end method */

	/*
	@start method
	
	@group Replace
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param asReplace [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function replace($_sString, $_asReplace = NULL)
	{
		$_asReplace = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'asReplace', 'xParameter' => $_asReplace));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		foreach ($_asReplace as $_sSearchString => $_sReplaceString)
		{
			$_sString = str_replace($_sSearchString, $_sReplaceString, $_sString);
		}
		return $_sString;
	}
	/* @end method */

	/*
	@start method
	
	@group Replace
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param asReplace [needed][type]string[][/type]
	[en]...[/en]
	*/
	public function pregReplace($_sString, $_asReplace = NULL)
	{
		$_asReplace = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'asReplace', 'xParameter' => $_asReplace));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		foreach ($_asReplace as $_sSearchString => $_sReplaceString)
		{
			$_sString = preg_replace($_sSearchString, $_sReplaceString, $_sString);
		}
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Replace
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sPrefix [type]string[/type]
	[en]...[/en]
	
	@param sSuffix [type]string[/type]
	[en]...[/en]
	*/
	public function dateReplace($_sString, $_sPrefix = NULL, $_sSuffix = NULL)
	{
		$_sPrefix = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sPrefix', 'xParameter' => $_sPrefix));
		$_sSuffix = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sSuffix', 'xParameter' => $_sSuffix));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		if ($_sPrefix === NULL) {$_sPrefix = '%';}
		if ($_sSuffix === NULL) {$_sSuffix = '%';}
		$_asDate = array(
			$_sPrefix.'day'.$_sSuffix	=> date("d"),
			$_sPrefix.'month'.$_sSuffix	=> date("m"),
			$_sPrefix.'Year'.$_sSuffix	=> date("Y"),
			$_sPrefix.'year'.$_sSuffix	=> date("y")
		);
		$this->replace(array('sString' => $_sString, 'asReplace' => $_asDate));
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Remove
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function delHtml($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->stripHtml(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Remove
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function removeHtml($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->stripHtml(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Remove
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function stripHtml($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_sString = preg_replace("!(\<.*\>)(.*?)(\<\/.*\>)!im", "\\2", $_sString);
		$_sString = preg_replace("!(\<.*\>)!im", "", $_sString);
		return strip_tags($_sString); // for security reasons use also strip_tags from php!
	}
	/* @end method */
	
	/*
	@start method
	
	@group Remove
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iCharCount [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setMaxChars($_sString, $_iCharCount = NULL)
	{
		$_iCharCount = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'iCharCount', 'xParameter' => $_iCharCount));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->cutText(array('sString' => $_sString, 'iCharCount' => $_iCharCount));
	}
	/* @end method */

	/*
	@start method
	
	@group Remove
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iCharCount [needed][type]int[/type]
	[en]...[/en]
	*/
	public function cutString($_sString, $_iCharCount = NULL)
	{
		$_iCharCount = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'iCharCount', 'xParameter' => $_iCharCount));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->cutText(array('sString' => $_sString, 'iCharCount' => $_iCharCount));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Remove
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iCharCount [needed][type]int[/type]
	[en]...[/en]

	@param sEndWithChars [type]string[/type]
	[en]...[/en]
	
	@param bForceEndChars [type]string[/type]
	[en]...[/en]
	*/
	public function cutText($_sString, $_iCharCount = NULL, $_sEndWithChars = NULL, $_bForceEndChars = NULL)
	{
		$_iCharCount = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'iCharCount', 'xParameter' => $_iCharCount));
		$_sEndWithChars = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sEndWithChars', 'xParameter' => $_sEndWithChars));
		$_bForceEndChars = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bForceEndChars', 'xParameter' => $_bForceEndChars));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sEndWithChars === NULL) {$_sEndWithChars = '...';}
		if ($_bForceEndChars === NULL) {$_bForceEndChars = false;}
		if (strlen($_sString) > $_iCharCount) {return substr_replace($_sString, $_sEndWithChars, max($_iCharCount-strlen($_sEndWithChars), 1), strlen($_sString));}
		else if ($_bForceEndChars == true) {return $_sString.$_sEndWithChars;}
		else {return $_sString;}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param bAllowHtmlTags [type]bool[/type]
	[en]...[/en]
	
	@param bConvertUris [type]bool[/type]
	[en]...[/en]
	*/
	public function text2Html($_sString, $_bAllowHtmlTags = NULL, $_bConvertUris = NULL)
	{
		$_bAllowHtmlTags = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bAllowHtmlTags', 'xParameter' => $_bAllowHtmlTags));
		$_bConvertUris = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bConvertUris', 'xParameter' => $_bConvertUris));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->textToHTML(array('sString' => $_sString, 'bAllowHtmlTags' => $_bAllowHtmlTags, 'bConvertUris' => $_bConvertUris));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param bAllowHtmlTags [type]bool[/type]
	[en]...[/en]
	
	@param bConvertUris [type]bool[/type]
	[en]...[/en]
	*/
	public function textToHtml($_sString, $_bAllowHtmlTags = NULL, $_bConvertUris = NULL)
	{
		$_bAllowHtmlTags = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bAllowHtmlTags', 'xParameter' => $_bAllowHtmlTags));
		$_bConvertUris = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bConvertUris', 'xParameter' => $_bConvertUris));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_bAllowHtmlTags === NULL) {$_bAllowHtmlTags = false;}
		if ($_bConvertUris === NULL) {$_bConvertUris = false;}
		
		$_asReplace["&"] = '&amp;';
		if ($_bAllowHtmlTags == false)
		{
			$_asReplace["<"] = '&lt;';
			$_asReplace[">"] = '&gt;';
			$_asReplace['"'] = '&quot;';
		}
		$_asReplace["\r\n"] = '<br />';
		$_asReplace["\n"] = '<br />';
		// $_asReplace[' '] = '&nbsp;';
		$_asReplace["\t"] = '&nbsp;&nbsp;&nbsp;&nbsp;';
		$_asReplace["€"] = '&euro;';
		$_asReplace["(c)"] = '&copy;';
		$_asReplace["(r)"] = '&reg;';
		$_asReplace["(tm)"] = '&trade;';
		$_asReplace["²"] = '&sup2;';
		$_asReplace["³"] = '&sup3;';
		$_asReplace['ä'] = '&auml;';
		$_asReplace['Ä'] = '&Auml;';
		$_asReplace['ü'] = '&uuml;';
		$_asReplace['Ü'] = '&Uuml;';
		$_asReplace['ö'] = '&ouml;';
		$_asReplace['Ö'] = '&Ouml;';
		$_sString = $this->replace(array('sString' => $_sString, 'asReplace' => $_asReplace));

		if ($_bConvertUris == true)
		{
			$_asReplace = array(
				// Bilder mit http oder ftp...
				"!(^|\ |\n|<br>|<br\ \/>)(http:\/\/|ftp:)([a-zA-Z0-9\.\/\_-]+)(\.)(jpeg|jpg|gif|png)!is" => "\\1<img src=\"\\2\\3\\4\\5\" boder=\"0\" />",
				// Bilder nur mit www.
				"!(^|\ |\n|<br>|<br\ \/>)(www\.)([a-zA-Z0-9\.\/\_-]+)(\.)(jpeg|jpg|gif|png)!is" => "\\1<img src=\"http://\\2\\3\\4\\5\" boder=\"0\" />",
				// Bilder mit relativem Pfad...
				"!(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\.\/\_-]+)(\.)(jpeg|jpg|gif|png)!is" => "\\1<img src=\"http://\\2\\3\\4\\5\" boder=\"0\" />",
		
				// Links zu Seiten...
				"!(^|\ |\n|<br>|<br\ \/>)(http:\/\/|ftp:)([a-zA-Z0-9\+\%\?\=\&\.\/\_-]+)!is" => "\\1<a href=\"\\2\\3\" target=\"_blank\">\\2\\3</a>",
				// Links zu Seten nur mit www.
				"!(^|\ |\n|<br>|<br\ \/>)(www\.)([a-zA-Z0-9\+\%\?\=\&\.\/\_-]+)!is" => "\\1<a href=\"http://\\2\\3\" target=\"_blank\">\\2\\3</a>",
		
				// emailverlinkungen...
				// "!(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\._-]+)@([a-zA-z0-9_-]+)(\.)(.{2,3,4})!is" //(de|com|info|org|net|jp|nu|it|nl|ru|tv)!is"
				$this->sRegExpEmail => "\\1<a href=\"mailto:\\2@\\3\\4\\5\">\\2@\\3\\4\\5</a>"
			);
			$_sString = $this->pregReplace(array('sString' => $_sString, 'asReplace' => $_asReplace));
		}

		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function html2Text($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->htmlToText(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function htmlToText($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_asReplace = array(
			'<br>' => "\r\n",
			'<br />' => "\r\n",
			'&auml;' => 'ä',
			'&Auml;' => 'Ä',
			'&uuml;' => 'ü',
			'&Uuml;' => 'Ü',
			'&ouml;' => 'ö',
			'&Ouml;' => 'Ö',
			'&quot;' => '"',
			'&nbsp;&nbsp;&nbsp;&nbsp;' => "\t",
			'&nbsp;' => ' ',
			'&amp;' => '&',
			'&euro;' => '€',
			'&copy;' => '(c)',
			'&reg;' => '(r)',
			'&trade;' => '(tm)',
			'&sup2;' => '²',
			'&sup3;' => '³',
			'&lt;' => '<',
			'&gt;' => '>'
		);
		return $this->replace(array('sString' => $_sString, 'asReplace' => $_asReplace));
	}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHighlightDivClass($_sCssClass)
	{
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sCssClass, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$this->sHighlightDivCssClass = $_sCssClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@param sCssStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHighlightDivStyle($_sCssStyle)
	{
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sCssStyle, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$this->sHighlightDivCssStyle = $_sCssStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHighlightTitleClass($_sCssClass)
	{
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sCssClass, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$this->sHighlightTitleCssClass = $_sCssClass;
	}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@param sCssStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHighlightTitleStyle($_sCssStyle)
	{
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sCssStyle, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$this->sHighlightTitleCssStyle = $_sCssStyle;
	}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@param sCssClass [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHighlightTextClass($_sCssClass)
	{
		$_sCssClass = $this->getRealParameter(array('oParameters' => $_sCssClass, 'sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$this->sHighlightTextCssClass = $_sCssClass;
	}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@param sCssStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setHighlightTextStyle($_sCssStyle)
	{
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sCssStyle, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$this->sHighlightTextCssStyle = $_sCssStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	public function getHighlightDivClass() {return $this->sHighlightDivCssClass;}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getHighlightDivStyle() {return $this->sHighlightDivCssStyle;}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	public function getHighlightTitleClass() {return $this->sHighlightTitleCssClass;}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getHighlightTitleStyle() {return $this->sHighlightTitleCssStyle;}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@return sCssClass [type]string[/type]
	[en]...[/en]
	*/
	public function getHighlightTextClass() {return $this->sHighlightTextCssClass;}
	/* @end method */

	/*
	@start method
	
	@group Highlight
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getHighlightTextStyle() {return $this->sHighlightTextCssStyle;}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sTag [needed][type]string[/type]
	[en]...[/en]
	
	@param asHighlight [type]string[][/type]
	[en]...[/en]
	
	@param bWithContainer [type]bool[/type]
	[en]...[/en]
	*/
	public function highlight($_sString, $_sTag = NULL, $_asHighlight = NULL, $_bWithContainer = NULL)
	{
		$_sTag = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$_asHighlight = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'asHighlight', 'xParameter' => $_asHighlight));
		$_bWithContainer = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bWithContainer', 'xParameter' => $_bWithContainer));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		$_sContainerDivStart = '';
		$_sContainerDivEnd = '';

		if ($_bWithContainer == true)
		{
			if ($this->sHighlightDivCssClass != '') {$_sContainerDivStart .= '<div class="'.$this->sHighlightDivCssClass.'">';}
			else {$_sContainerDivStart .= '<div style="'.$this->sHighlightDivCssStyle.'">';}
	
			if ($this->sHighlightTitleCssClass != '') {$_sContainerDivStart .= '<span class="'.$this->sHighlightTitleCssClass.'">';}
			else {$_sContainerDivStart .= '<span style="'.$this->sHighlightTitleCssStyle.'">';}
	
			// $_sContainerDivStart .= '&nbsp;<img src="'.$HPW_COMBOPath.'img/filetypes/'.strtolower($_sTag).'.gif" border="0">';
			$_sContainerDivStart .= '&nbsp;'.strtoupper($_sTag).'</span>';
	
			if ($this->sHighlightTextCssClass != '') {$_sContainerDivStart .= '<br><span class="'.$this->sHighlightTextCssClass.'">';}
			else {$_sContainerDivStart .= '<br><span style="'.$this->sHighlightTextCssStyle.'">';}
			
			$_sContainerDivEnd = '</span></div>';
		}

		$_sString = preg_replace("!(.*?|^|\n)(\[".$_sTag."\].*?\[\/".$_sTag."\])(.*?|$|/n)!is", "\\1;**;\\2;**;\\3", $_sString);
		$_asText = explode(";**;", $_sString);
		for ($i=0; $i<count($_asText); $i++)
		{
			if (preg_match("!\[".$_sTag."\](.*?)\[\/".$_sTag."\]!is", $_asText[$i]))
			{
				$_asText[$i] = str_replace("[".$_sTag."]", "", $_asText[$i]);
				$_asText[$i] = str_replace("[/".$_sTag."]", "", $_asText[$i]);
				if ($_asHighlight == NULL) {$_asText[$i] = highlight_string("<?php\n".$_asText[$i]."\n?>", true);}
				else
				{
					$_asText[$i] = str_replace("\r\n", "<br />", $_asText[$i]);
					$_asText[$i] = str_replace("\n", "<br />", $_asText[$i]);
					$_asText[$i] = str_replace("\"", "&quot;", $_asText[$i]);
					$_asText[$i] = preg_replace("!(\ )!mi", "&nbsp;", $_asText[$i]);
					$_asText[$i] = preg_replace("!(\t)!mi", "&nbsp;&nbsp;&nbsp;&nbsp;", $_asText[$i]);
					foreach ($_asHighlight as $_sKey => $_sElem)
					{
						$_asText[$i] = preg_replace($_sKey, "<span style=\"color:#".str_replace("#", "", $_sElem)."\">\\1</span>", $_asText[$i]);
					}
				}
				$_asText[$i] = $_sContainerDivStart.$_asText[$i].$_sContainerDivEnd;
			}
		}
		$_sString = implode("", $_asText);
		
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sTag [needed][type]string[/type]
	[en]...[/en]
	*/
	public function highlightDefault($_sString, $_sTag = NULL)
	{
		$_sTag = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sTag', 'xParameter' => $_sTag));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->highlight(array('sString' => $_sString, 'sTag' => $_sTag, 'asHighlight' => NULL, 'bWithContainer' => true));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function highlightPhp($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->highlightDefault($_sString, 'php');
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function highlightHtml($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_asHtml = array(
			"!(&lt;.*?&gt;)!mi" => "0000bb",
			"!(&lt;/.*?&gt;)!mi" => "0000bb",
			"!('.*?')!mi" => "009900",
			"!(&quot;.*?&quot;)!mi" => "009900"
		);
		return $this->highlight(array('sString' => $_sString, 'sTag' => 'html', 'asHighlight' => $_asHtml, 'bWithContainer' => true));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Highlight
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function highlightCode($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_asCode = array(
			"!(function)!mi" => "0000bb",
			"!(\{)!mi" => "0000bb",
			"!(\})!mi" => "0000bb",
			"!(\()!mi" => "0000bb",
			"!(\))!mi" => "0000bb",
			"!(if)!mi" => "009900",
			"!(else)!mi" => "009900",
			"!(else if)!mi" => "009900",
			"!(elseif)!mi" => "009900",
			"!(for)!mi" => "009900",
			"!(echo)!mi" => "009900",
			"!(&quot;.*?&quot;)!mi" => "bb0000",
			"!('.*?')!mi" => "bb0000",
			"!(&quot;.*?&quot;)!mi" => "bb0000"
		);
		return $this->highlight(array('sString' => $_sString, 'sTag' => 'html', 'asHighlight' => $_asCode, 'bWithContainer' => true));
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function bb($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->bbCodeToHtml(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function bb2Html($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->bbCodeToHtml(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function bbCode2Html($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->bbCodeToHtml(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function bbToHtml($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->bbCodeToHtml(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param bBBCodeOnly [type]bool[/type]
	[en]...[/en]
	*/
	public function bbCodeToHtml($_sString, $_bBBCodeOnly = NULL)
	{
		$_bBBCodeOnly = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'bBBCodeOnly', 'xParameter' => $_bBBCodeOnly));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_bBBCodeOnly === NULL) {$_bBBCodeOnly = true;}
		
		$_asBBCode = array(
		"!\[fläche=([0-9]+),([0-9]+)\](.*?)\[\/fläche\]!is" => "<div style=\"width:\\1px; height:\\2px;\">\\3</div>", // mi
		
		// Absolute Layer...
		"!\[ebene=([0-9\-]+),([0-9\-]+),([0-9]+)\](.*?)\[\/ebene\]!is" => "<div style=\"position:relative; left:\\1px; top:\\2px; z-index:\\3;\"><div style=\"position:absolute;\">\\4</div></div>",
		
		// Schriftgröße...
		"!\[size=([0-9]*)\](.*?)\[\/size\]!mi" => "<span style=\"font-size:\\1px;\">\\2</span>",
		
		// Schriftfarbe...
		"!\[color=([A-Za-z0-9]*)\](.*?)\[\/color\]!is" => "<span style=\"color:\\1;\">\\2</span>",
		
		// Hintergrundfarbe...
		"!\[bgcolor=(.*?)\](.*?)\[\/bgcolor\]!is" => "<div style=\"width:100%; background-color:\\1;\">\\2</div>",
		
		// Dicke Schrift...
		"!\[b\](.*?)\[\/b\]!is" => "<b>\\1</b>",
		"!\[bold\](.*?)\[\/bold\]!is" => "<b>\\1</b>",
		"!\[dick\](.*?)\[\/dick\]!is" => "<b>\\1</b>",

		// Kursive Schrift...
		"!\[i\](.*?)\[\/i\]!is" => "<i>\\1</i>",
		"!\[italic\](.*?)\[\/italic\]!is" => "<i>\\1</i>",
		"!\[kursiv\](.*?)\[\/kursiv\]!is" => "<i>\\1</i>",
		"!\[schräg\](.*?)\[\/schräg\]!is" => "<i>\\1</i>",

		// Unterstrichene Schrift...
		"!\[u\](.*?)\[\/u\]!is" => "<u>\\1</u>",
		"!\[underline\](.*?)\[\/underline\]!is" => "<u>\\1</u>",
		"!\[unterstrichen\](.*?)\[\/unterstrichen\]!is" => "<u>\\1</u>",
		
		// Zentrierte Ausrichtung (Horizontal)...
		"!\[center\](.*?)\[\/center\]!is" => "<center>\\1</center>",
		"!\[zentriert\](.*?)\[\/zentriert\]!is" => "<center>\\1</center>",
		
		// Mittige Ausrichtung (Vertikal)...
		"!\[middle\](.*?)\[\/middle\]!is" => "<div height=\"100%\" valign=\"middle\">\\1</div>",
		"!\[mittig\](.*?)\[\/mittig\]!is" => "<div height=\"100%\" valign=\"middle\">\\1</div>",
		
		// Links Ausgerichtet...
		"!\[left\](.*?)\[\/left\]!is" => "<div width=\"100%\" style=\"text-align:left;\">\\1</div>",
		"!\[links\](.*?)\[\/links\]!is" => "<div width=\"100%\" style=\"text-align:left;\">\\1</div>",
		
		// Rechts Ausgerichtet...
		"!\[right\](.*?)\[\/right\]!is" => "<div width=\"100%\" style=\"text-align:right;\">\\1</div>",
		"!\[rechts\](.*?)\[\/rechts\]!is" => "<div width=\"100%\" style=\"text-align:right;\">\\1</div>",

		// Oben Ausgerichtet...
		"!\[top\](.*?)\[\/top\]!is" => "<div height=\"100%\" valign=\"top\">\\1</div>",
		"!\[oben\](.*?)\[\/oben\]!is" => "<div height=\"100%\" valign=\"top\">\\1</div>",
		
		// Unten Ausgerichtet...
		"!\[bottom\](.*?)\[\/bottom\]!is" => "<div height=\"100%\" valign=\"bottom\">\\1</div>",
		"!\[unten\](.*?)\[\/unten\]!is" => "<div height=\"100%\" valign=\"bottom\">\\1</div>",

		// Blocksatz Ausrichtung...
		"!\[justify\](.*?)\[\/justify\]!is" => "<div style=\"text-align:justify;\">\\1</div>",
		"!\[blocksatz\](.*?)\[\/blocksatz\]!is" => "<div style=\"text-align:justify;\">\\1</div>",

		// Listen...
		"!\[liste=num\](.*?)\[\/liste\]!is" => "<ol>\\1</ol>",
		"!\[liste=num(.*?)\](.*?)\[\/liste\]!is" => "<ol type=\"\\1\">\\2</ol>",
		"!\[liste\](.*?)\[\/liste\]!mi" => "<ul>\\1</ul>",
		"!\[liste=(.*?)\](.*?)\[\/liste\]!is" => "<ul type=\"\\1\">\\2</ul>",
		"!\[ol\](.*?)\[\/ol\]!mi" => "<ol>\\1</ol>",
		"!\[ol=(.*?)\](.*?)\[\/ol\]!is" => "<ol type=\"\\1\">\\2</ol>",
		"!\[ul\](.*?)\[\/ul\]!is" => "<ul>\\1</ul>",
		"!\[ul=(.*?)\](.*?)\[\/ul\]!is" => "<ul type=\"\\1\">\\2</ul>",
		"!\[lp\](.*?)\[\/lp\]!is" => "<li>\\1</li>",
		"!\[li\](.*?)\[\/li\]!is" => "<li>\\1</li>",
		"!\[listenpunkt\](.*?)\[\/listenpunkt\]!is" => "<li>\\1</li>",
		
		// Bilder...
		"!\[img\](.*?)\[\/img\]!is" => "<img src=\"\\1\" border=\"0\" />",
		"!\[image\](.*?)\[\/image\]!is" => "<img src=\"\\1\" border=\"0\" />",
		"!\[bild\](.*?)\[\/bild\]!is" => "<img src=\"\\1\" border=\"0\" />",
		
		// Links ohne Alternativtext...
		"!\[url\](.*?)\[\/url\]!is" => "<a href=\"\\1\" target=\"_blank\">\\1</a>",
		"!\[link\](.*?)\[\/link\]!is" => "<a href=\"\\1\" target=\"_blank\">\\1</a>",
		"!\[seite\](.*?)\[\/seite\]!is" => "<a href=\"\\1\" target=\"_blank\">\\1</a>",
		
		// Mailto...
		"!(\[)mailto:(.*?)(\])!is" => "\\1<a href=\"mailto:\\2\" target=\"_self\">\\2</a>\\3",
		
		// Links mit Text und eigenem Target...
		"!\[url=(.*?),(.*?)\](.*?)\[\/url\]!is" => "<a href=\"\\1\" target=\"\\2\">\\3</a>",
		
		// Popuplink...
		// "!\[popup=([0-9]+),([0-9]+),(.*?)\](.*?)\[\/popup\]!is" => "<a href=\"javascript:;\" onclick=\"HPW_OpenManualPopup('\\3',\\1,\\2,'ComboBBCodePopup','yes,resizable=yes');\" target=\"_self\">\\4</a>",
		
		// Links mit Text...
		"!\[url=(.*?)\](.*?)\[\/url\]!is" => "<a href=\"\\1\" target=\"_blank\">\\2</a>",
		"!\[link=(.*?)\](.*?)\[\/link\]!is" => "<a href=\"\\1\" target=\"_blank\">\\2</a>",
		"!\[website=(.*?)\](.*?)\[\/website\]!is" => "<a href=\"\\1\" target=\"_blank\">\\2</a>",
		"!\[seite=(.*?)\](.*?)\[\/seite\]!is" => "<a href=\"\\1\" target=\"_blank\">\\2</a>",
		"!\[webseite=(.*?)\](.*?)\[\/webseite\]!is" => "<a href=\"\\1\" target=\"_blank\">\\2</a>",

		// Zitate...
		"!\[quote\](.*?)\[\/quote\]!is" => "<div style=\"margin:10px; padding:5px;\" class=\"title2\"><b>Quote from anonyous: </b><br><i>\" \\2 \"</i></div>",
		"!\[quote=\"?(.*?)\"?\](.*?)\[\/quote\]!is" => "<div style=\"margin:10px; padding:5px;\" class=\"title2\"><b>Quote from \\1: </b><br><i>\" \\2 \"</i></div>",
		"!\[zitat\](.*?)\[\/zitat\]!is" => "<div style=\"margin:10px; padding:5px;\" class=\"title2\"><b>Zitat von unbekannt: </b><br><i>\" \\2 \"</i></div>",
		"!\[zitat=\"?(.*?)\"?\](.*?)\[\/zitat\]!is" => "<div style=\"margin:10px; padding:5px;\" class=\"title2\"><b>Zitat von \\1: </b><br><i>\" \\2 \"</i></div>"
		);
		$_sString = $this->pregReplace(array('sString' => $_sString, 'asReplace' => $_asBBCode));

		if ($_bBBCodeOnly == false)
		{
			$_asBBCode = array(
			// Bilder mit http oder ftp...
			"!(^|\ |\n|<br>|<br\ \/>)(http:\/\/|ftp:)([a-zA-Z0-9\.\/\_-]+)(\.)(jpeg|jpg|gif|png)!is" => "\\1<img src=\"\\2\\3\\4\\5\" boder=\"0\" />",
			// Bilder nur mit www.
			"!(^|\ |\n|<br>|<br\ \/>)(www\.)([a-zA-Z0-9\.\/\_-]+)(\.)(jpeg|jpg|gif|png)!is" => "\\1<img src=\"http://\\2\\3\\4\\5\" boder=\"0\" />",
			// Bilder mit relativem Pfad...
			"!(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\.\/\_-]+)(\.)(jpeg|jpg|gif|png)!is" => "\\1<img src=\"http://\\2\\3\\4\\5\" boder=\"0\" />",
	
			// Links zu Seiten...
			"!(^|\ |\n|<br>|<br\ \/>)(http:\/\/|ftp:)([a-zA-Z0-9\+\%\?\=\&\.\/\_-]+)!is" => "\\1<a href=\"\\2\\3\" target=\"_blank\">\\2\\3</a>",
			// Links zu Seten nur mit www.
			"!(^|\ |\n|<br>|<br\ \/>)(www\.)([a-zA-Z0-9\+\%\?\=\&\.\/\_-]+)!is" => "\\1<a href=\"http://\\2\\3\" target=\"_blank\">\\2\\3</a>",
	
			// emailverlinkungen...
			// "!(^|\ |\n|<br>|<br\ \/>)([a-zA-Z0-9\._-]+)@([a-zA-z0-9_-]+)(\.)(.{2,3,4})!is" //(de|com|info|org|net|jp|nu|it|nl|ru|tv)!is"
			$this->sRegExpEmail => "\\1<a href=\"mailto:\\2@\\3\\4\\5\">\\2@\\3\\4\\5</a>"
			);
			$_sString = $this->pregReplace(array('sString' => $_sString, 'asReplace' => $_asBBCode));
		}

		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function html2BB($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->htmlToBB(array('sString' => $_sString));
	}
	/* @end method */

	/*
	@start method
	
	@group BB-Code
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function htmlToBB($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		// TODO
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function html2Context($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->htmlToContext(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function htmlToContext($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		$_asReplace = array(
			"!(\n|<br>|<br\ \/>)!is" => "&#10",
			// "!(\n|<>)!is" => "&#13;", // TODO
			"!(\t|<blockquote>)!is" => "&#09;" // TODO
		);
		$_sString = $this->pregReplace(array('sString' => $_sString, 'asReplace' => $_asReplace));
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group File
	
	@return sExtension [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getFileExtension($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return strtolower(str_replace(".", "", strrchr($_sString, ".")));
	}
	/* @end method */
	
	/*
	@start method
	
	@group File
	*/
	public function stripFileExtension($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return substr($_sString, 0, -strlen(strrchr($_sString, ".")));
	}
	/* @end method */
	
	/*
	@start method
	
	@group File
	
	@return sFileName [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getFileNameOfPath($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		if ($_sFileName = strrchr($_sString, "/")) {return str_replace("/", "", $_sFileName);}
		if ($_sFileName = strrchr($_sString, "\\")) {return str_replace("\\", "", $_sFileName);}
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return sArrayString [type]string[/type]
	[en]...[/en]
	
	@param axArray [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param bDeclaration [type]bool[/type]
	[en]...[/en]
	
	@param bUseDoubleQuotes [type]bool[/type]
	[en]...[/en]
	*/
	public function convertPhpArrayToJs($_axArray, $_bDeclaration = NULL, $_bUseDoubleQuotes = NULL)
	{
		$_bDeclaration = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'bDeclaration', 'xParameter' => $_bDeclaration));
		$_bUseDoubleQuotes = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'bUseDoubleQuotes', 'xParameter' => $_bUseDoubleQuotes));
		$_axArray = $this->getRealParameter(array('oParameters' => $_axArray, 'sName' => 'axArray', 'xParameter' => $_axArray, 'bNotNull' => true));

		if ($_bDeclaration === NULL) {$_bDeclaration = true;}
		if ($_bUseDoubleQuotes === NULL) {$_bUseDoubleQuotes = false;}
		
		$_sStringQuotes = "'";
		if ($_bUseDoubleQuotes == true) {$_sStringQuotes .= '"';}
		
		$_sString = '';
		if ($_bDeclaration == true) {$_sString .= 'new Array(';}
		for ($i=0; $i<count($_axArray); $i++)
		{
			if ($i>0) {$_sString .= ',';}
			/*
			if (is_string($_axArray[$i])) {$_sString .= $_sStringQuotes.$_axArray[$i].$_sStringQuotes;}
			else if (is_array($_axArray[$i])) {$_sString .= $this->convertPHPArrayToJS($_axArray[$i], true, $_bUseDoubleQuotes);}
			else if (is_bool($_axArray[$i])) {if ($_axArray[$i] == true) {$_sString .= 'true';} else {$_sString .= 'false';}}
			else if (!is_nan($_axArray[$i])) {$_sString .= $_axArray[$i];}
			else if ($_axArray[$i] === NULL) {$_sString .= 'null';}
			else {$_sString .= 'null';}
			*/
			$_sString .= $this->convertPhpParametersToJs(array('xParameters' => $_axArray[$i], 'bUseDoubleQuotes' => $_bUseDoubleQuotes));
		}
		if ($_bDeclaration == true) {$_sString .= ')';}
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return sArrayString [type]string[/type]
	[en]...[/en]
	
	@param xParameters [needed][type]mixed[/type]
	[en]...[/en]
	
	@param bUseDoubleQuotes [type]bool[/type]
	[en]...[/en]
	*/
	public function convertPhpParametersToJs($_xParameters, $_bUseDoubleQuotes = NULL)
	{
		$_bUseDoubleQuotes = $this->getRealParameter(array('oParameters' => $_xParameters, 'sName' => 'bUseDoubleQuotes', 'xParameter' => $_bUseDoubleQuotes));
		$_xParameters = $this->getRealParameter(array('oParameters' => $_xParameters, 'sName' => 'xParameters', 'xParameter' => $_xParameters, 'bNotNull' => true));

		if ($_bUseDoubleQuotes === NULL) {$_bUseDoubleQuotes = false;}
		
		$_sStringQuotes = "'";
		if ($_bUseDoubleQuotes == true) {$_sStringQuotes .= '"';}
		
		$_sString = '';
		
		if ($_xParameters === NULL) {$_sString .= 'null';}
		if (is_string($_xParameters)) {$_sString .= $_sStringQuotes.$_xParameters.$_sStringQuotes;}
		else if (is_array($_xParameters)) {$_sString .= $this->convertPhpArrayToJS(array('axArray' => $_xParameters, 'bDeclaration' => true, 'bUseDoubleQuotes' => $_bUseDoubleQuotes));}
		else if (is_bool($_xParameters)) {if ($_xParameters == true) {$_sString .= 'true';} else {$_sString .= 'false';}}
		else if (!is_nan($_xParameters)) {$_sString .= $_xParameters;}
		else {$_sString .= 'null';}
	
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iPercent [type]int[/type]
	[en]...[/en]
	*/
	public function toLeet($_sString, $_iPercent = NULL)
	{
		$_iPercent = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'iPercent', 'xParameter' => $_iPercent));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_iPercent === NULL) {$_iPercent = 50;}
		if (($_iPercent > 0) && ($_iPercent <= 25))
		{
			$_axReplace = array(
				'a' => '4',
				'b' => '8',
				'e' => '3',
				'g' => '9',
				'i' => '1',
				'l' => '1',
				'o' => '0',
				'q' => '0,',
				'r' => '12',
				's' => '5',
				't' => '7',
				'z' => '2'
			);
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace($_sSearch, $_sReplace, $_sString);}
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace(strtoupper($_sSearch), $_sReplace, $_sString);}
		}
		else if (($_iPercent > 25) && ($_iPercent <= 50))
		{
			$_axReplace = array(
				'a' => '4',
				'b' => '|3',
				'c' => '(',
				'd' => '|)',
				'e' => '3',
				'g' => '9',
				'i' => '|',
				'k' => '|<',
				'l' => '1',
				'm' => '(V)',
				'o' => '0',
				'r' => '|2',
				's' => '5',
				't' => '7',
				'v' => '\\/',
				'w' => 'VV',
				'x' => '><',
				'z' => '2',
			);
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace($_sSearch, $_sReplace, $_sString);}
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace(strtoupper($_sSearch), $_sReplace, $_sString);}
		}
		else if (($_iPercent > 50) && ($_iPercent <= 75))
		{
			$_axReplace = array(
				'a' => '4',
				'b' => '|3',
				'c' => '<',
				'd' => '|)',
				'e' => '[-',
				'f' => '|=',
				'g' => '9',
				'h' => '|-|',
				'i' => '|',
				'j' => '_|',
				'k' => '|<',
				'l' => '1',
				'm' => '(V)',
				'n' => '|\\|',
				'o' => '0',
				'p' => '|"',
				'q' => '0,',
				'r' => '|2',
				's' => '5',
				't' => '7',
				'u' => '|_|',
				'v' => '\\/',
				'w' => 'VV',
				'x' => '><',
				'y' => "'/",
				'z' => '2'
			);
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace($_sSearch, $_sReplace, $_sString);}
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace(strtoupper($_sSearch), $_sReplace, $_sString);}
		}
		else if ($_iPercent > 75)
		{
			$_axReplace = array(
				'a' => '/-\\',
				'b' => '|3',
				'c' => '<',
				'd' => '|>',
				'e' => '[-',
				'f' => '|=',
				'g' => '(_+',
				'h' => '|-|',
				'i' => '|',
				'j' => '_|',
				'k' => '|<',
				'l' => '|_',
				'm' => '/\\/\\',
				'n' => '|\\|',
				'o' => '()',
				'p' => '|"',
				'q' => '0,',
				'r' => '|2',
				's' => '5',
				't' => '+',
				'u' => '|_|',
				'v' => '\\/',
				'w' => '\\_|_/',
				'x' => '><',
				'y' => "'/",
				'z' => '2'
			);
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace($_sSearch, $_sReplace, $_sString);}
			foreach ($_axReplace as $_sSearch => $_sReplace) {$_sString = str_replace(strtoupper($_sSearch), $_sReplace, $_sString);}
		}
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iPercent [type]int[/type]
	[en]...[/en]
	*/
	public function toL33t($_sString, $_iPercent = NULL)
	{
		$_iPercent = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'iPercent', 'xParameter' => $_iPercent));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->toLeet(array('sString' => $_sString, 'iPercent' => $_iPercent));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param iPercent [type]int[/type]
	[en]...[/en]
	*/
	public function to1337($_sString, $_iPercent = NULL)
	{
		$_iPercent = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'iPercent', 'xParameter' => $_iPercent));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->toLeet(array('sString' => $_sString, 'iPercent' => $_iPercent));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Convert
	
	@return oObject [type]object[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sParameterSeperator [type]string[/type]
	[en]...[/en]
	
	@param sValueSeperator [type]string[/type]
	[en]...[/en]
	*/
	public function toObject($_sString, $_sParameterSeperator = NULL, $_sValueSeperator = NULL)
	{
		$_sParameterSeperator = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sParameterSeperator', 'xParameter' => $_sParameterSeperator));
		$_sValueSeperator = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sValueSeperator', 'xParameter' => $_sValueSeperator));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sParameterSeperator === NULL) {$_sParameterSeperator = '&';}
		if ($_sValueSeperator === NULL) {$_sValueSeperator = '=';}
		$_asArray = explode($_sParameterSeperator, $_sString);
		$_oObject = NULL;
		for ($i=0; $i<count($_asArray); $i++)
		{
			$_asArray2 = explode($_sValueSeperator, $_asArray[$i]);
			$_oObject->$_asArray2[0] = $_asArray2[1];
		}
		return $_oObject;
	}
	/* @end method */

	/*
	@start method
	
	@group Convert
	
	@return asArray [type]string[][/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sSeperator [type]string[/type]
	[en]...[/en]
	*/
	public function toArray($_sString, $_sSeperator = NULL)
	{
		$_sSeperator = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sSeperator', 'xParameter' => $_sSeperator));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sSeperator === NULL) {$_sSeperator = '';}
		// if ($_sSeperator != '')
		if (is_array($_sString))
		{
			$_asArray = array();
			for ($i=0; $i<strlen($_sString); $i++) {$_asArray[$i] = $_sString[$i];}
		}
		else {$_asArray = explode($_sSeperator, $_sString);}
		return $_asArray;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function backwards($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		/*
		$_sNewString = '';
		for ($i=count($_sString)-1; $i>=0; $i--) {$_sNewString .= $_sString[i];}
		return $_sNewString;
		*/
		return strrev($_sString);
	}
	/* @end method */

	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function toBackwards($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->backwards(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function reverse($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->backwards(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function toReverse($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->backwards(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function toLaola($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		$_bToUpperCase = true;
		$_sNewString = '';
		for ($i=0; $i<strlen($_sString); $i++)
		{
			if (preg_match("![\ \.\,\!\-\_\+\\\/\?\=\(\)\&\%\$\"\'\<\>]!i", $_sString[$i])) {$_sNewString .= $_sString[$i];}
			else if ($_bToUpperCase == true) {$_sNewString .= strtoupper($_sString[$i]); $_bToUpperCase = false;}
			else {$_sNewString .= strtolower($_sString[$i]); $_bToUpperCase = true;}
		}
		return $_sNewString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Translate
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function laola($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		return $this->toLaola(array('sString' => $_sString));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Encode
	
	@return sMail [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	public function mailEncode($_sString, $_sAt = NULL, $_sDot = NULL)
	{
		$_sAt = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sAt', 'xParameter' => $_sAt));
		$_sDot = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sDot', 'xParameter' => $_sDot));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sAt === NULL) {$_sAt = '[at]';}
		if ($_sDot === NULL) {$_sDot = '[dot]';}
		
		$_sString = str_replace('@', $_sAt, $_sString);
		$_sString = str_replace('.', $_sDot, $_sString);
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Decode
	
	@return sMail [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	public function mailDecode($_sString, $_sAt = NULL, $_sDot = NULL)
	{
		$_sAt = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sAt', 'xParameter' => $_sAt));
		$_sDot = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sDot', 'xParameter' => $_sDot));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sAt === NULL) {$_sAt = '[at]';}
		if ($_sDot === NULL) {$_sDot = '[dot]';}
		
		$_sString = str_replace($_sAt, '@', $_sString);
		$_sString = str_replace($_sDot, '.', $_sString);
		return $_sString;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Encode
	
	@return sMail [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	public function findMailsAndEncode($_sString, $_sAt = NULL, $_sDot = NULL)
	{
		$_sAt = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sAt', 'xParameter' => $_sAt));
		$_sDot = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sDot', 'xParameter' => $_sDot));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sAt === NULL) {$_sAt = '[at]';}
		if ($_sDot === NULL) {$_sDot = '[dot]';}
		
		return preg_replace($this->sRegExpEmail, "\\1\\2".$_sAt."\\3".$_sDot."\\4", $_sString);
	}
	/* @end method */

	/*
	@start method
	
	@group Decode
	
	@return sMail [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sAt [type]string[/type]
	[en]...[/en]
	
	@param sDot [type]string[/type]
	[en]...[/en]
	*/
	public function findMailsAndDecode($_sString, $_sAt = NULL, $_sDot = NULL)
	{
		$_sAt = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sAt', 'xParameter' => $_sAt));
		$_sDot = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sDot', 'xParameter' => $_sDot));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		if ($_sAt === NULL) {$_sAt = '\[at\]';}
		if ($_sDot === NULL) {$_sDot = '\[dot\]';}
		
		return preg_replace(str_replace('\[at\]', $_sAt, str_replace('\[dot\]', $_sDot, $this->sRegExpEmailEncoded)), "\\1\\2@\\3.\\4", $_sString);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Validation
	
	@return bIsValid [type]bool[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function isValidEmailAdress($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		if (preg_match($this->sRegExpEmailOnly, $_sString) > 0) {return true;}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	
	@param sProtocol [type]string[/type]
	[en]...[/en]
	*/
	public function changeUrlProtocol($_sString, $_sProtocol = NULL)
	{
		$_sProtocol = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sProtocol', 'xParameter' => $_sProtocol));
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		if ($_sProtocol === NULL) {$_sProtocol = (isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == '1') || (strtolower($_SERVER['HTTPS']) == 'on'))) ? 'https' : 'http';}
		return preg_replace('/http(s){0,1}:\/\//is', $_sProtocol.'://', $_sString);
	}
	/* @end method */
}
/* @end class */
$oPGStrings = new classPG_Strings();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGStrings', 'xValue' => $oPGStrings));}
?>