<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_CodeConverter extends classPG_ClassBasics
{
	// Declarations...
	private $bConvertToMonoCSharp = false;
	private $bConvertToJava = false;
	private $bConvertToJavaAndroid = false;
	private $bConvertToPhpAndJavaScript = false;

	// Construct...
	public function __construct() {}

	// Methods...
	/*
	@start method
	@param bUse
	*/
	public function useConvertToMonoCSharp($_bUse) {$this->bConvertToMonoCSharp = $_bUse;}
	/* @end method */

	/* @start method */
	public function isConvertToMonoCSharp() {return $this->bConvertToMonoCSharp;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useConvertToJava($_bUse) {$this->bConvertToJava = $_bUse;}
	/* @end method */

	/* @start method */
	public function isConvertToJava() {return $this->bConvertToJava;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useConvertToJavaAndroid($_bUse) {$this->bConvertToJavaAndroid = $_bUse;}
	/* @end method */

	/* @start method */
	public function isConvertToJavaAndroid() {return $this->bConvertToJavaAndroid;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useConvertToPhpAndJavaScript($_bUse) {$this->bConvertToPhpAndJavaScript = $_bUse;}
	/* @end method */

	/* @start method */
	public function isConvertToPhpAndJavaScript() {return $this->bConvertToPhpAndJavaScript;}
	/* @end method */
	
	/*
	@start method
	@param sCodeSource
	*/
	public function buildMonoCSharpCode($_sCodeSource)
	{
		$_sCode = '';
		return $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	@param sCodeSource
	*/
	public function buildJavaCode($_sCodeSource)
	{
		$_sCode = '';
		return $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	@param sCodeSource
	*/
	public function buildJavaAndroidCode($_sCodeSource)
	{
		$_sCode = '';
		return $_sCode;
	}
	/* @end method */
	
	/*
	@start method
	@param sCodeSource
	*/
	public function buildPhpAndJavaScriptCode($_sCodeSource)
	{
		$_sCode = '';
		return $_sCode;
	}
	/* @end method */
	
	/* @start method */
	public function build()
	{
	}
	/* @end method */
}
/* @end class */
$oPGCodeConverter = new classPG_CodeConverter();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCodeConverter', 'xValue' => $oPGCodeConverter));}
?>