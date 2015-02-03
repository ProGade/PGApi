<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 21 2012
*/
class classPG_Wysiwyg extends classPG_ClassBasics
{
	private $asEditorToolbarCommands = array(
		'gerneral' => array(
			'switcheditmode' => 'oPGWysiwyg.switchEditMode({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'switchdisplaymode' => 'oPGWysiwyg.switchDisplayMode({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'cut' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'cut\'});',
			'copy' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'copy\'});',
			'paste' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'paste\'});',
			'delete' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'delete\'});',
			'undo' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'undo\'});',
			'redo' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'redo\'});'
		),
		
		'linking' => array(
			'createlink' => 'oPGWysiwyg.onCreateLinkPress({\'sWysiwygID\': \'%sWysiwygID%\', \'sRichEditCommand\': \'createlink\'});',
			'unlink' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'unlink\'});'
			// ? Anker einf�gen ?
		),
		
		'inserting' => array(
			'insertimage' => 'oPGWysiwyg.onInsertImagePress({\'sWysiwygID\': \'%sWysiwygID%\', \'sRichEditCommand\': \'insertimage\'});',
			'inserttable' => 'oPGWysiwyg.onInsertTablePress({\'sWysiwygID\': \'%sWysiwygID%\', \'sRichEditCommand\': \'inserttable\'});',
			'inserthorizontalrule' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'inserthorizontalrule\'});',
			'insertparagraph' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'insertparagraph\'});'
		),

		// ? Sonderzeichen Tabelle ?

		'basic_formating' => array(
			'bold' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'bold\'});',
			'italic' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'italic\'});',
			'underline' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'underline\'});',
			'strikethrough' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'strikethrough\'});',
			'subscript' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'subscript\'});',
			'superscript' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'superscript\'});',
			'removeformat' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'removeformat\'});'
		),
		
		'advanced_formating' => array(
			'backcolor' => 'oPGWysiwyg.onColorPress({\'sWysiwygID\': \'%sWysiwygID%\', \'sRichEditCommand\': \'backcolor\'});',
			'forecolor' => 'oPGWysiwyg.onColorPress({\'sWysiwygID\': \'%sWysiwygID%\', \'sRichEditCommand\': \'forecolor\'});',
			// fontname
			'fontsize' => 'oPGWysiwyg.onFontSizePress({\'sWysiwygID\': \'%sWysiwygID%\', \'sRichEditCommand\': \'fontsize\'});'
			// 'stylewithcss' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'stylewithcss\', \'sExpression\': \'font-size:30px; font-family:Verdana, Arial; background-color:#ffcccc; font-weight:bold;\'});',
		),
		
		'alignment' => array(
			'justifyleft' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'justifyleft\'});',
			'justifycenter' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'justifycenter\'});',
			'justifyright' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'justifyright\'});',
			'justifyfull' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'justifyfull\'});'
		),
		
		'groupformat' => array(
			'insertorderedlist' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'insertorderedlist\'});',
			'insertunorderedlist' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'insertunorderedlist\'});',
			'indent' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'indent\'});',
			'outdent' => 'oPGWysiwyg.richEdit({\'sWysiwygID\': \'%sWysiwygID%\', \'sCommand\': \'outdent\'});'
		),
		
		'table_formating' => array(
			'inserttablerow' => 'oPGWysiwyg.tableAddRow({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'inserttablecol' => 'oPGWysiwyg.tableAddCol({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'removetablerow' => 'oPGWysiwyg.tableRemoveRow({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'removetablecol' => 'oPGWysiwyg.tableRemoveCol({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'mergetablecellsx' => 'oPGWysiwyg.tableMergeCellsX({\'sWysiwygID\': \'%sWysiwygID%\'});',
			'mergetablecellsy' => 'oPGWysiwyg.tableMergeCellsY({\'sWysiwygID\': \'%sWysiwygID%\'});'
		)
		
		// ? Zitat Block ?
		// ? Code Block ?
	);

	public function __construct()
	{
		$this->setID(array('sID' => 'PGWysiwyg'));
		$this->initClassBasics();
		$this->setGfxSubPath(array('sPath' => 'wysiwyg/'));

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_wysiwyg.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_wysiwyg.php',
                'foundation' => 'gfx/default/templates/controls/foundation_wysiwyg.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));

    }

	public function build(
        $_sWysiwygID = NULL,
        $_bEditable = NULL,
        $_bHtmlMode = NULL,
        $_sSourceFile = NULL,
        $_sSourceCode = NULL,
        $_sOnImageOpenClick = NULL,
        $_sOnFileOpenClick = NULL,

        $_sTemplateName = NULL
    )

    {
		global $oPGButton, $oPGPopup, $oPGColorPicker;
	
		$_bHtmlMode = $this->getRealParameter(array('oParameters' => $_sWysiwygID, 'sName' => 'bHtmlMode', 'xParameter' => $_bHtmlMode));
		$_sSourceFile = $this->getRealParameter(array('oParameters' => $_sWysiwygID, 'sName' => 'sSourceFile', 'xParameter' => $_sSourceFile));
		$_sSourceCode = $this->getRealParameter(array('oParameters' => $_sWysiwygID, 'sName' => 'sSourceCode', 'xParameter' => $_sSourceCode));
		$_sOnImageOpenClick = $this->getRealParameter(array('oParameters' => $_sWysiwygID, 'sName' => 'sOnImageOpenClick', 'xParameter' => $_sOnImageOpenClick));
		$_sOnFileOpenClick = $this->getRealParameter(array('oParameters' => $_sWysiwygID, 'sName' => 'sOnFileOpenClick', 'xParameter' => $_sOnFileOpenClick));
		$_sWysiwygID = $this->getRealParameter(array('oParameters' => $_sWysiwygID, 'sName' => 'sWysiwygID', 'xParameter' => $_sWysiwygID));

		if ($_sWysiwygID === NULL) {$_sWysiwygID = $this->getNextID();}
		if ($_bEditable === NULL) {$_bEditable = true;}
	
		$_sHtml = '';
		$_sHtml .= '<div id="'.$_sWysiwygID.'ToolbarContainer" class="wysiwyg_editor_toolbar" style="display:inline-block; width:100%;">';
			foreach ($this->asEditorToolbarCommands as $_sGroupName => $_sCommandList)
			{
				$_sHtml .= '<div id="'.$_sWysiwygID.'ToolbarGroup'.$_sGroupName.'" style="float:left; padding:5px;">';
				foreach ($_sCommandList as $_sName => $_sCommand)
				{
					$_sCommand = str_replace('%sWysiwygID%', $_sWysiwygID, $_sCommand);
					$_sHtml .= $oPGButton->build(
						array(
							'sButtonID' => $_sWysiwygID.'Button'.$_sName,
							// 'sSizeX' => '25px',
							'sSizeY' => '25px',
							// 'sText' => $_sName, 
							'sText' => $this->img(array('sImage' => $_sName.'.png', 'sCssStyle' => 'vertical-align:top; text-align:center;')),
							'iButtonMode' => PG_BUTTON_MODE_NONE,
							'sOnClick' => $_sCommand,
							'sCssStyle' => 'margin:2px;'
						)
					);
				}
				$_sHtml .= '</div>';
			}
		$_sHtml .= '</div>';
		$_sHtml .= '<div id="'.$_sWysiwygID.'EditorContainer" class="wysiwyg_editor_container" style="width:100%; height:500px;"></div>';
		$_sHtml .= '<div id="'.$_sWysiwygID.'EditorStatusBar" class="wysiwyg_editor_statusbar" style="display:inline-block; width:100%;">';
			$_sHtml .= '<div id="'.$_sWysiwygID.'EditorStatusBarNodes" style="float:left;"></div>';
			$_sHtml .= '<div id="'.$_sWysiwygID.'EditorStatusBarControls" style="float:right;">';
				$_sHtml .= '<div style="width:16px; height:16px; line-height:16px; text-align:center; cursor:pointer; float:left;" onclick="oPGWysiwyg.addSize({\'sWysiwygID\': \''.$_sWysiwygID.'\', \'iSizeY\': -100});">-</div>';
				$_sHtml .= '<div style="width:16px; height:16px; line-height:16px; text-align:center; cursor:pointer; float:left;" onclick="oPGWysiwyg.addSize({\'sWysiwygID\': \''.$_sWysiwygID.'\', \'iSizeY\': 100});">+</div>';
			$_sHtml .= '</div>';
		$_sHtml .= '</div>';

		$_sCssStyle = 'position:absolute; left:0px; top:0px; background-color:#ffffff; border:solid 1px #000000; border-radius:5px; padding:5px;';
		$_sHtml .= $oPGColorPicker->build(
			array(
				'sPickerID' => $_sWysiwygID.'ColorPicker', 
				'iSizeX' => 256, 
				'iSizeY' => 128, 
				'sOnColorAccept' => 'oPGWysiwyg.onColorPickerAccept({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 
				'sOnColorAbort' => 'oPGWysiwyg.onColorPickerAbort({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 
				'bDisplay' => false, 
				'sCssStyle' => $_sCssStyle
			)
		);

		$_sHtml .= '<div id="'.$_sWysiwygID.'FontSizeSelection" style="'.$_sCssStyle.' display:none; width:100px;">';
		for ($i=1; $i<=7; $i++)
		{
			$_iFontSize = 8+($i*2);
			$_sHtml .= '<div onmousedown="return false;" onclick="oPGWysiwyg.onFontSizeAccept({\'sWysiwygID\': \''.$_sWysiwygID.'\', \'iFontSize\': \''.$i.'\', \'sFontSize\': \''.$_iFontSize.'px\'});" ';
			$_sHtml .= 'style="display:block; text-align:center; height:25px; line-height:30px; border:solid 1px #000000; cursor:pointer;" ';
			$_sHtml .= '>'.$_iFontSize.'px</div>';
		}
		$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'FontSizeButtonAbort', 'sText' => 'abort', 'sOnClick' => 'oPGWysiwyg.onFontSizeAbort({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '98px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
		$_sHtml .= '</div>';
		
		$_sHtml .= '<div id="'.$_sWysiwygID.'CreateLink" style="'.$_sCssStyle.' display:none; width:200px;">';
			$_sHtml .= '<input type="text" id="'.$_sWysiwygID.'CreateLinkHref" value="http://" style="width:192px;" /><br />';
			$_sHtml .= '<select id="'.$_sWysiwygID.'CreateLinkTarget" style="width:192px;">';
				$_sHtml .= '<option value="_blank">neues Fenster</option>';
				$_sHtml .= '<option value="_self">gleiches Fenster</option>';
			$_sHtml .= '</select>';
			$_sHtml .= '<br />';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'CreateLinkButtonAccept', 'sText' => 'accept', 'sOnClick' => 'oPGWysiwyg.onCreateLinkAccept({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '94px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
			$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'CreateLinkButtonAbort', 'sText' => 'close', 'sOnClick' => 'oPGWysiwyg.onCreateLinkClose({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '94px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
		$_sHtml .= '</div>';
		
		$_sHtml .= '<div id="'.$_sWysiwygID.'InsertImage" style="'.$_sCssStyle.' display:none; width:200px;">';
			if ($_sOnImageOpenClick != NULL) {$_iInputSizeX = 145;} else {$_iInputSizeX = 190;}
			$_sHtml .= '<input type="text" id="'.$_sWysiwygID.'InsertImageSrc" value="http://" style="width:'.$_iInputSizeX.'px;" />';
			if ($_sOnImageOpenClick != NULL) {$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'InsertImageButtonOpen', 'sText' => 'open', 'sOnClick' => str_replace('[sInputID]', $_sWysiwygID.'InsertImageSrc', $_sOnImageOpenClick), 'sSizeX' => '40px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;', 'sCssStyle' => 'margin:2px;'));}
			$_sHtml .= '<br />';
			$_sHtml .= '<input type="checkbox" id="'.$_sWysiwygID.'InsertImagePopupCheckbox" /> insert as popup to:<br />';
			$_sHtml .= '<input type="text" id="'.$_sWysiwygID.'InsertImagePopupUrl" style="width:'.$_iInputSizeX.'px;" />';
			if ($_sOnFileOpenClick != NULL) {$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'InsertImageButtonOpen', 'sText' => 'open', 'sOnClick' => str_replace('[sInputID]', $_sWysiwygID.'InsertImagePopupUrl', $_sOnFileOpenClick), 'sSizeX' => '40px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;', 'sCssStyle' => 'margin:2px;'));}
			$_sHtml .= '<br />';
			$_sHtml .= '<input type="text" id="'.$_sWysiwygID.'InsertImagePopupSizeX" value="500" style="width:30px;" />px width ';
			$_sHtml .= '<input type="text" id="'.$_sWysiwygID.'InsertImagePopupSizeY" value="350" style="width:30px;" />px height ';
			$_sHtml .= '[<a href="javascript:;" target="_self" onclick="oPGWysiwyg.previewInsertImagePopup({\'sWysiwygID\': \''.$_sWysiwygID.'\'});">preview</a>]';
			$_sHtml .= '<br />';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'InsertImageButtonAccept', 'sText' => 'accept', 'sOnClick' => 'oPGWysiwyg.onInsertImageAccept({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '94px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
			$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'InsertImageButtonAbort', 'sText' => 'close', 'sOnClick' => 'oPGWysiwyg.onInsertImageClose({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '94px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
		$_sHtml .= '</div>';
		
		$_sHtml .= '<div id="'.$_sWysiwygID.'InsertTable" style="'.$_sCssStyle.' display:none; width:200px;">';
			$_sHtml .= '<table>';
			$_sHtml .= '<tr><td>Spalten:</td><td><input type="text" id="'.$_sWysiwygID.'InsertTableCellsCountX" value="2" style="width:50px;" /></td></tr>';
			$_sHtml .= '<tr><td>Zeilen:</td><td><input type="text" id="'.$_sWysiwygID.'InsertTableCellsCountY" value="2" style="width:50px;" /></td></tr>';
			$_sHtml .= '</table>';
			$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'InsertImageButtonAccept', 'sText' => 'accept', 'sOnClick' => 'oPGWysiwyg.onInsertTableAccept({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '94px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
			$_sHtml .= $oPGButton->build(array('sButtonID' => $_sWysiwygID.'InsertImageButtonAbort', 'sText' => 'close', 'sOnClick' => 'oPGWysiwyg.onInsertTableClose({\'sWysiwygID\': \''.$_sWysiwygID.'\'});', 'sSizeX' => '94px', 'sSizeY' => '24px', 'sCssStyle' => 'margin:2px;'));
		$_sHtml .= '</div>';
		
		if (isset($oPGPopup)) {$_sHtml .= $oPGPopup->build(array('sPopupID' => $_sWysiwygID.'Popup', 'bHideOnBackgroundClick' => true));}

		$_sHtml .= '<script type="text/javascript">';
			$_sHtml .= 'oPGWysiwyg.buildEditorInto(';
				$_sHtml .= '{';
					$_sHtml .= '"sWysiwygID": "'.$_sWysiwygID.'"';
					if ($_bEditable == true) {$_sHtml .= ', "bEditable": true';} else if ($_bEditable == false) {$_sHtml .= ', "bEditable": false';}
					if ($_sSourceFile != NULL) {$_sHtml .= ', "sSourceFile": "'.$_sSourceFile.'"';}
					if ($_sSourceCode != NULL) {$_sHtml .= ', "sSourceCode": "'.str_replace('"', '\"', $_sSourceCode).'"';}
					if ($_bHtmlMode == true) {$_sHtml .= ', "bHtmlMode": true';} else if ($_bHtmlMode == false) {$_sHtml .= ', "bHtmlMode": false';}
				$_sHtml .= '}';
			$_sHtml .= '); ';
		$_sHtml .= '</script>';
		return $_sHtml;
	}
}
$oPGWysiwyg = new classPG_Wysiwyg();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGWysiwyg', 'xValue' => $oPGWysiwyg));}
?>