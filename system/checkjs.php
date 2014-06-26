<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_CheckJS extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct()
	{
		$this->setID('PG_CheckJS');
		$this->setText(array('NoJavaScript' => 'If this text doesn\'t hide after a few seconds then your browser can\'t JavaScript or it\'s disabled. Please check your browsers settings and enable JavaScript!'));
	}
	
	// Methods...
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sID [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sID = NULL)
	{
		if ($_sID === NULL) {$_sID = $this->getNextID();}
		
		$_sHtml = '';
		$_sHtml .= '<div id="'.$this->sID.'">'.$this->asText['NoJavaScript'].'</div>';
		$_sHtml .= '<script language="JavaScript" type="text/javascript">';
		$_sHtml .= 'var _oCheckJSDiv = document.getElementById(\''.$this->sID.'\'); ';
		$_sHtml .= 'if (_oCheckJSDiv) ';
		$_sHtml .= '{';
			$_sHtml .= 'if (typeof(_oCheckJSDiv.outerHTML) != \'undefined\') {_oCheckJSDiv.outerHTML = \'\';} ';
			$_sHtml .= 'else {_oCheckJSDiv.innerHTML = \'\';} ';
		$_sHtml .= '}';
        $_sHtml .= '</script>';
		return $_sHtml;
	}
	/* @end method */
}
/* @end class */
$oPGCheckJS = new classPG_CheckJS();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCheckJS', 'xValue' => $oPGCheckJS));}
?>