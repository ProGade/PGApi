<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 13 2012
*/
define('PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR', 0);
define('PG_PROGRESSBAR_TYPE_VERTICAL_BAR', 1);

/*
@start class

@var ProgressBarTypes
PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR
PG_PROGRESSBAR_TYPE_VERTICAL_BAR

@description
[en]This class has methods to the creating progress bars.[/en]
[de]Diese Klasse verf�gt �ber Methoden zum erstellen von Fortschrittsanzeigen.[/de]

@param extends classPG_ClassBasics
*/
class classPG_ProgressBar extends classPG_ClassBasics
{
	// Declarations...

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGProgressBar'));
		$this->initClassBasics();

        // Templates...
        $_oTemplate = new classPG_Template();
        $_oTemplate->setTemplateFileExtension(array('sExtension' => 'php'));
        $_oTemplate->setTemplates(
            array(
                'default' => 'gfx/default/templates/controls/default_progressbar.php',
                'bootstrap' => 'gfx/default/templates/controls/bootstrap_progressbar.php',
                'foundation' => 'gfx/default/templates/controls/foundation_progressbar.php'
            )
        );
        $this->setTemplate(array('xTemplate' => $_oTemplate));
    }
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Builds a progress bar.[/en]
	[de]Erstellt eine Fortschrittsanzeige.[/de]
	
	@return sProgressBarHtml [type]string[/type]
	[en]Returns the progress bar as an HTML string.[/en]
	[de]Gibt die Fortschrittsanzeige als HTML String zur�ck.[/de]
	
	@param sProgressBarID [type]string[/type]
	[en]The ID of the progress bar.[/en]
	[de]Die ID der Fortschrittsanzeige.[/de]
	
	@param iType [type]int[/type]
	[en]
		The type of the progress bar.
		Specifies the look and behaviour.
		Follow defines are possible:
		%ProgressBarTypes%
	[/en]
	[de]
		Den Typ der Fortschrittsanzeige.
		Bestimmt das Aussehen und verhalten.
		Forlgende Defines sind m�glich:
		%ProgressBarTypes%
	[/de]
	
	@param sSizeX [type]string[/type]
	[en]The width of the progress bar.[/en]
	[de]Die Breite der Fortschrittsanzeige.[/de]
	
	@param sSizeY [type]string[/type]
	[en]The height of the progress bar.[/en]
	[de]Die H�he der Fortschrittsanzeige.[/de]
	
	@param sBackgroundCssClass [type]string[/type]
	[en]The CSS class for the background of the progress bar.[/en]
	[de]Die CSS Klasse f�r den Hintergrund der Fortschrittsanzeige.[/de]
	
	@param sBackgroundCssStyle [type]string[/type]
	[en]The CSS code for the background of the progress bar.[/en]
	[de]Die CSS Code f�r den Hintergrund der Fortschrittsanzeige.[/de]
	
	@param sBarCssClass [type]string[/type]
	[en]The CSS class for the foreground of the progress bar.[/en]
	[de]Die CSS Klasse f�r den Vordergrund der Fortschrittsanzeige.[/de]
	
	@param sBarCssStyle [type]string[/type]
	[en]The CSS code for the foreground of the progress bar.[/en]
	[de]Die CSS Code f�r den Vordergrund der Fortschrittsanzeige.[/de]
	*/
	public function build(
		$_sProgressBarID = NULL,
		$_iType = NULL,
		$_sSizeX = NULL,
		$_sSizeY = NULL,
		$_iPercent = NULL,
		$_sBackgroundCssClass = NULL,
		$_sBackgroundCssStyle = NULL,
		$_sBarCssClass = NULL,
		$_sBarCssStyle = NULL,

        $_sTemplateName = NULL
    )
	{
		global $oPGControls;
		
		$_iType = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'iType', 'xParameter' => $_iType));
		$_sSizeX = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sSizeX', 'xParameter' => $_sSizeX));
		$_sSizeY = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sSizeY', 'xParameter' => $_sSizeY));
		$_iPercent = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'iPercent', 'xParameter' => $_iPercent));
		$_sBackgroundCssClass = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sBackgroundCssClass', 'xParameter' => $_sBackgroundCssClass));
		$_sBackgroundCssStyle = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sBackgroundCssStyle', 'xParameter' => $_sBackgroundCssStyle));
		$_sBarCssClass = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sBarCssClass', 'xParameter' => $_sBarCssClass));
		$_sBarCssStyle = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sBarCssStyle', 'xParameter' => $_sBarCssStyle));
		$_sProgressBarID = $this->getRealParameter(array('oParameters' => $_sProgressBarID, 'sName' => 'sProgressBarID', 'xParameter' => $_sProgressBarID));

		$_sHTML = '';
		
		if ($_sProgressBarID === NULL) {$_sProgressBarID = $this->getNextID();}
		if ($_iPercent === NULL) {$_iPercent = 0;}
		
		$_iPercent = min(max($_iPercent, 0), 100);
		
		if ($_iType == NULL) {$_iType = PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR;}
		if ($_iType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR)
		{
			if ($_sSizeX === NULL) {$_sSizeX = '100%';}
			if ($_sSizeY === NULL) {$_sSizeY = '25px';}
		}
		else if ($_iType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR)
		{
			if ($_sSizeX === NULL) {$_sSizeX = '45px';}
			if ($_sSizeY === NULL) {$_sSizeY = '100%';}
		}
		
		$_sHTML .= '<table cellpadding="0" cellspacing="0" style="width:'.$_sSizeX.'; height:'.$_sSizeY.'; border:0;">';
		$_sHTML .= '<tr>';
			$_sHTML .= '<td id="'.$_sProgressBarID.'Container" style="width:'.$_sSizeX.'; height:'.$_sSizeY.'; ';
			if (($_sBackgroundCssStyle !== '') && ($_sBackgroundCssStyle !== NULL)) {$_sHTML .= $_sBackgroundCssStyle.' ';}
			if ((($_sBackgroundCssStyle === '') || ($_sBackgroundCssStyle === NULL))
			&& (($_sBackgroundCssClass === '') || ($_sBackgroundCssClass === NULL)))
			{
				$_sHTML .= 'background-color:#808080; ';
				$_sHTML .= 'color:#000000; ';
				$_sHTML .= 'font-weight:bold; ';
				$_sHTML .= 'font-size:12px; ';
				$_sHTML .= 'font-family:Arial, Verdana; ';
				$_sHTML .= 'border:solid 1px #000000; ';
				$_sHTML .= 'padding:0px; ';
				if ($_iType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR) {$_sHTML .= 'vertical-align:bottom; ';}
			}
			$_sHTML .= '" ';
			if (($_sBackgroundCssClass !== '') && ($_sBackgroundCssClass !== NULL)) {$_sHTML .= 'class="'.$_sBackgroundCssClass.'" ';}
			$_sHTML .= '>';
			
				$_sHTML .= '<table cellpadding="0" cellspacing="0" style="border:0;">';
				$_sHTML .= '<tr>';
					$_sHTML .= '<td id="'.$_sProgressBarID.'" ';
					if (($_sBarCssClass !== '') && ($_sBarCssClass !== NULL)) {$_sHTML .= 'class="'.$_sBarCssClass.'" ';}
					$_sHTML .= 'style="';
					if ($_iType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR) {$_sHTML .= 'height:'.$_sSizeY.'; width:1px; ';}
					else if ($_iType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR) {$_sHTML .= 'width:'.$_sSizeX.'; height:1px; ';}
					if (($_sBarCssStyle !== '') && ($_sBarCssStyle !== NULL)) {$_sHTML .= $_sBarCssStyle.' ';}
					if ((($_sBarCssStyle === '') || ($_sBarCssStyle === NULL))
					&& (($_sBarCssClass === '') || ($_sBarCssClass === NULL)))
					{
						$_sHTML .= 'background-color:#150185; ';
						$_sHTML .= 'color:#FFFFFF; ';
						$_sHTML .= 'font-weight:bold; ';
						$_sHTML .= 'padding:5px; ';
						if ($_iType == PG_PROGRESSBAR_TYPE_HORIZONTAL_BAR)
						{
							$_sHTML .= 'vertical-align:middle; ';
							$_sHTML .= 'text-align:right; ';
						}
						else if ($_iType == PG_PROGRESSBAR_TYPE_VERTICAL_BAR)
						{
							$_sHTML .= 'vertical-align:top; ';
							$_sHTML .= 'text-align:center; ';
						}
					}
					$_sHTML .= '"></td>';
				$_sHTML .= '</tr>';
				$_sHTML .= '</table>';
				
			$_sHTML .= '</td>';
		$_sHTML .= '</tr>';
		$_sHTML .= '</table>';
		if (isset($oPGControls)) {$_sHTML .= '<input type="hidden" id="'.$_sProgressBarID.'ControlsType" value="'.PG_CONTROLS_TYPE_PROGRESSBAR.'" />';}
		$_sHTML .= '<input type="hidden" id="'.$_sProgressBarID.'ProgressBarType" value="'.$_iType.'" />';
		
		if ($_iPercent > 0)
		{
			$_sHTML .= '<script type="text/javascript">';
				$_sHTML .= 'oPGProgressBar.setPercent({"sProgressBarID": "'.$_sProgressBarID.'", "iPercent": '.$_iPercent.'}); ';
			$_sHTML .= '</script>';
		}
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGProgressBar = new classPG_ProgressBar();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGProgressBar', 'xValue' => $oPGProgressBar));}
?>