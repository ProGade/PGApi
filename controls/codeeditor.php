<?php
/*
* ProGade API
* Copyright 2014, Hans-Peter Wandura (ProGade)
* Last changes of this file: Sep 09 2014
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_CodeEditor extends classPG_ClassBasics
{
	// Declarations...
	private $iSizeX = 500;
	private $iSizeY = 200;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGCodeEditor'));

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_codeeditor.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_codeeeditor.php',
                'foundation' => 'gfx/default/templates/controls/foundation_codeeeditor.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));

    }
	
	// Methods...
	/*
	@start method
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setSizeX($_iSizeX)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$this->iSizeX = $_iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	*/
	public function getSizeX() {return $this->iSizeX;}
	/* @end method */

	/*
	@start method
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setSizeY($_iSizeY)
	{
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_iSizeY, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$this->iSizeY = $_iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function getSizeY() {return $this->iSizeY;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function setSize($_iSizeX, $_iSizeY = NULL)
	{
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		
		if ($_iSizeX != NULL) {$this->iSizeX = $_iSizeX;}
		if ($_iSizeY != NULL) {$this->iSizeY = $_iSizeY;}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sEditorHtml [type]string[/type]
	[en]...[/en]
	
	@param sContent [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sContent = NULL)
	{
		$_sContent = $this->getRealParameter(array('oParameters' => $_sContent, 'sName' => 'sContent', 'xParameter' => $_sContent));

		if ($_sContent === NULL) {$_sContent = '';}
		
		$_asArray = array();
		$_iLineCount = preg_match_all("/\n/i", $_sContent, $_asArray);
		
		$_sEditorID = $this->getID();
		
		$_sCssFormation = 'font-family:\'Courier New\', Fixedsys, Courier, monospace; font-size:10pt; font-weight:bold; color:#000000; '; // 10pt ist wichtig, damit im IE kein Versatz durch unterschiedliche Tabbreiten vorkommt!
		// $_sCssFormation .= '-moz-tab-size:4 !important; -o-tab-size:4; -webkit-tab-size:4; tab-size:4 !important; ';
		
		$_sHTML = '';
		$_sHTML .= '<div id="'.$_sEditorID.'" style="width:'.$this->iSizeX.'px; height:'.$this->iSizeY.'px; margin:0px; padding:0px;">';
		
			$_sHTML .= '<div id="'.$_sEditorID.'LineNumbers" ';
			// $_sHTML .= 'onfocus="oPGCodeEditor.onCodeEditorFocus();" onblur="oPGCodeEditor.onCodeEditorBlur();" ';
			$_sHTML .= 'style="';
			$_sHTML .= 'width:50px; height:'.$this->iSizeY.'px; display:none; ';
			$_sHTML .= 'position:absolute; margin:0px; padding:0px; z-index:3; overflow:hidden; ';
			$_sHTML .= $_sCssFormation;
			$_sHTML .= '">';
			for ($i=0; $i<=$_iLineCount; $i++)
			{
				$_sHTML .= ($i+1).'<br />';
			}
			$_sHTML .= '</div>';
		
			$_sHTML .= '<pre id="'.$_sEditorID.'FormatedText" style="';
			$_sHTML .= 'width:'.$this->iSizeX.'px; height:'.$this->iSizeY.'px; display:none; border:solid 1px #000000;';
			$_sHTML .= 'position:absolute; margin:0px; padding:0px; z-index:1; overflow:scroll; ';
			$_sHTML .= $_sCssFormation;
			$_sHTML .= ' white-space:pre;"></pre>'; // wrap="off"
		
			$_sHTML .= '<textarea id="'.$_sEditorID.'TextArea" name="'.$_sEditorID.'TextArea" onmouseup="oPGCodeEditor.onTextChange();" '; // onkeyup="oPGCodeEditor.onTextChange();"
			$_sHTML .= 'onfocus="oPGCodeEditor.onCodeEditorFocus();" onblur="oPGCodeEditor.onCodeEditorBlur();" ';
			$_sHTML .= 'style="';
			$_sHTML .= 'width:'.$this->iSizeX.'px; height:'.$this->iSizeY.'px; display:block;  border:solid 1px #000000; ';
			$_sHTML .= 'position:absolute; margin:0px; padding:0px; z-index:2; overflow:scroll; ';
			$_sHTML .= $_sCssFormation;
			$_sHTML .= '" wrap="off">'.$_sContent.'</textarea>'; // wrap="virtual"
		$_sHTML .= '</div>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGCodeEditor = new classPG_CodeEditor();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGCodeEditor', 'xValue' => $oPGCodeEditor));}
?>