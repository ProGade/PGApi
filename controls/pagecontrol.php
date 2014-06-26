<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright (c) 2012 Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: "http://api.progade.de/api_terms.php" or "./license.txt"
*
* Last changes of this file: Nov 09 2012
*/
/*
@start class

@description
[en]This class has methods to create page navigations.[/en]
[de]Diese Klasse verfügt über Methoden zum erstellen von Seitennavigationen.[/de]

@param extends classPG_ClassBasics
*/
class classPG_PageControl extends classPG_ClassBasics
{
	// Declarations...
	private $iPageCount = 1;
	private $iPageActive = 1;
	private $iPagesToShow = 5;

	private $sCssClassActive = 'pageactive';
	private $sCssClassNormal = 'pagenormal';
	private $sCssStyleActive = ''; // text-decoration:underline; color:#000000;';
	private $sCssStyleNormal = ''; // text-decoration:none; color:#0000CC;';
	
	private $axUrlParameters = array();

	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGPageControl'));
		$this->setText(
			array('xType' =>
				array(
					'PreviousPage' => '&lt; Previous',
					'NextPage' => 'Next &gt;',
					'Seperator' => '|'
				)
			)
		);
	}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Calculates the count of pages.[/en]
	[de]Berechnet die Anzahl an Seiten.[/de]
	
	@return iCount [type]int[/type]
	[en]Returns the count of pages as an integer.[/en]
	[de]Gibt die Anzahl an Seiten als Integer zurück.[/de]
	
	@param iEntriesCount [needed][type]int[/type]
	[en]The entries that should be displayed on all pages as a whole.[/en]
	[de]Die Einträge die Insgesamt auf allen Seiten dargestellt werden sollen.[/de]
	
	@param iEntriesPerPage [needed][type]int[/type]
	[en]The number of entries that should be displayed per page.[/en]
	[de]Die Anzahl an Einträgen, die pro Seite dargestellt werden sollen.[/de]
	*/
	public function calcPageCount($_iEntriesCount, $_iEntriesPerPage = NULL)
	{
		$_iEntriesPerPage = $this->getRealParameter(array('oParameters' => $_iEntriesCount, 'sName' => 'iEntriesPerPage', 'xParameter' => $_iEntriesPerPage));
		$_iEntriesCount = $this->getRealParameter(array('oParameters' => $_iEntriesCount, 'sName' => 'iEntriesCount', 'xParameter' => $_iEntriesCount));
		return ceil($_iEntriesCount/$_iEntriesPerPage);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the page navigation.[/en]
	[de]Erstellt die Seitennavigation.[/de]
	
	@return sPageControlHtml [type]string[/type]
	[en]Returns the page navigation as an HTML string.[/en]
	[de]Gibt die Seitennavigation als HTML String zurück.[/de]
	
	@param iPageCount [type]int[/type]
	[en]The number of pages that should be used.[/en]
	[de]Die Anzahl an Seiten die verwendet werden sollen.[/de]
	
	@param iPageActive [type]int[/type]
	[en]The page that is currently selected.[/en]
	[de]Die Seite die gerade ausgewählt ist.[/de]
	
	@param iPagesToShow [type]int[/type]
	[en]The number of pages that are directly selectable in navigation.[/en]
	[de]Die Anzahl an Seiten die bei der Navigation direkt anwählbar sind.[/de]
	
	@param sSeperator [type]string[/type]
	[en]The separators between page numbers.[/en]
	[de]Das Trennzeichen zwischen den Seitenzahlen.[/de]
	
	@param sPreviousPageText [type]string[/type]
	[en]The text for the previous page.[/en]
	[de]Der Text für die vorherige Seite.[/de]
	
	@param sNextPageText [type]string[/type]
	[en]The text for the next page.[/en]
	[de]Der Text für die nächste Seite.[/de]
	*/
	public function build($_iPageCount = NULL, $_iPageActive = NULL, $_iPagesToShow = NULL, $_sSeperator = NULL, $_sPreviousPageText = NULL, $_sNextPageText = NULL)
	{
		$_iPageActive = $this->getRealParameter(array('oParameters' => $_iPageCount, 'sName' => 'iPageActive', 'xParameter' => $_iPageActive));
		$_iPagesToShow = $this->getRealParameter(array('oParameters' => $_iPageCount, 'sName' => 'iPagesToShow', 'xParameter' => $_iPagesToShow));
		$_sSeperator = $this->getRealParameter(array('oParameters' => $_iPageCount, 'sName' => 'sSeperator', 'xParameter' => $_sSeperator));
		$_sPreviousPageText = $this->getRealParameter(array('oParameters' => $_iPageCount, 'sName' => 'sPreviousPageText', 'xParameter' => $_sPreviousPageText));
		$_sNextPageText = $this->getRealParameter(array('oParameters' => $_iPageCount, 'sName' => 'sNextPageText', 'xParameter' => $_sNextPageText));
		$_iPageCount = $this->getRealParameter(array('oParameters' => $_iPageCount, 'sName' => 'iPageCount', 'xParameter' => $_iPageCount));

		if ($_iPageCount !== NULL) {$this->iPageCount = $_iPageCount;}
		if ($_iPageActive !== NULL) {$this->iPageActive = $_iPageActive;}
		if ($_iPagesToShow !== NULL) {$this->iPagesToShow = $_iPagesToShow;}
		if ($_sSeperator === NULL) {$_sSeperator = $this->getText(array('sType' => 'Seperator'));}
		if ($_sPreviousPageText === NULL) {$_sPreviousPageText = $this->getText(array('sType' => 'PreviousPage'));}
		if ($_sNextPageText === NULL) {$_sNextPageText = $this->getText(array('sType' => 'NextPage'));}
		
		$_sHTML = '';
		$_iStartPage = max($this->iPageActive - ceil($this->iPagesToShow/3), 1);
		$_iStartPage = min($_iStartPage, max($this->iPageCount-$this->iPagesToShow, 1));
		$_sUrlParameters = $this->getUrlParametersString();
		
		// Previous page...
		if ($this->iPageActive-1 > 0)
		{
			$_sLink = $this->getUrl().'?'.$this->getID().'Page='.($this->iPageActive-1);
			if ($_sUrlParameters != '') {$_sLink .= '&'.$_sUrlParameters;}
			$_sHTML .= '<a href="'.$_sLink.'" target="'.$this->getUrlTarget().'" ';
			if ($this->sCssClassNormal != '') {$_sHTML .= 'class="'.$this->sCssClassNormal.'" ';}
			else {$_sHTML .= 'style="'.$this->sCssStyleNormal.'" ';}
			$_sHTML .= '>';
		}
		$_sHTML .= $_sPreviousPageText;
		if ($this->iPageActive-1 > 0) {$_sHTML .= '</a>';}
		
		// First page...
		$_sLink = $this->getUrl().'?'.$this->getID().'Page=1';
		if ($_sUrlParameters != '') {$_sLink .= '&'.$_sUrlParameters;}
		$_sHTML .= ' ';
		$_sHTML .= '<a href="'.$_sLink.'" ';
		if ($this->iPageActive == 1)
		{
			if ($this->sCssClassActive != '') {$_sHTML .= 'class="'.$this->sCssClassActive.'" ';}
			else {$_sHTML .= 'style="'.$this->sCssStyleActive.'" ';}
		}
		else
		{
			if ($this->sCssClassNormal != '') {$_sHTML .= 'class="'.$this->sCssClassNormal.'" ';}
			else {$_sHTML .= 'style="'.$this->sCssStyleNormal.'" ';}
		}
		$_sHTML .= 'target="'.$this->getUrlTarget().'">1</a>';
		
		// ...
		if ($_iStartPage > 2) {$_sHTML .= $_sSeperator.'...';}

		// Page numbers...
		// for ($_iCurrentPage=$_iStartPage; $_iCurrentPage<$_iStartPage+$this->iPagesToShow; $_iCurrentPage++)
		$_iCurrentPage = max($_iStartPage, 2);
		while (($_iCurrentPage<$_iStartPage+$this->iPagesToShow) && ($_iCurrentPage < $this->iPageCount))
		{
			$_sLink = $this->getUrl().'?'.$this->getID().'Page='.$_iCurrentPage;
			if ($_sUrlParameters != '') {$_sLink .= '&'.$_sUrlParameters;}
			$_sHTML .= $_sSeperator.'<a href="'.$_sLink.'" ';
			if ($this->iPageActive == $_iCurrentPage)
			{
				if ($this->sCssClassActive != '') {$_sHTML .= 'class="'.$this->sCssClassActive.'" ';}
				else {$_sHTML .= 'style="'.$this->sCssStyleActive.'" ';}
			}
			else
			{
				if ($this->sCssClassNormal != '') {$_sHTML .= 'class="'.$this->sCssClassNormal.'" ';}
				else {$_sHTML .= 'style="'.$this->sCssStyleNormal.'" ';}
			}
			$_sHTML .= 'target="'.$this->getUrlTarget().'">'.$_iCurrentPage.'</a>';
			$_iCurrentPage++;
		}
		
		// ...
		if ($_iCurrentPage < $this->iPageCount) {$_sHTML .= $_sSeperator.'...';}
		
		// Max page...
		if ($this->iPageCount > 1)
		{
			$_sLink = $this->getUrl().'?'.$this->getID().'Page='.$this->iPageCount;
			if ($_sUrlParameters != '') {$_sLink .= '&'.$_sUrlParameters;}
			$_sHTML .= $_sSeperator;
			$_sHTML .= '<a href="'.$_sLink.'" ';
			if ($this->iPageActive == $this->iPageCount)
			{
				if ($this->sCssClassActive != '') {$_sHTML .= 'class="'.$this->sCssClassActive.'" ';}
				else {$_sHTML .= 'style="'.$this->sCssStyleActive.'" ';}
			}
			else
			{
				if ($this->sCssClassNormal != '') {$_sHTML .= 'class="'.$this->sCssClassNormal.'" ';}
				else {$_sHTML .= 'style="'.$this->sCssStyleNormal.'" ';}
			}
			$_sHTML .= 'target="'.$this->getUrlTarget().'">'.$this->iPageCount.'</a>';
		}

		// Next page...
		$_sHTML .= ' ';
		if ($this->iPageActive+1 <= $this->iPageCount)
		{
			$_sLink = $this->getUrl().'?'.$this->getID().'Page='.($this->iPageActive+1);
			if ($_sUrlParameters != '') {$_sLink .= '&'.$_sUrlParameters;}
			$_sHTML .= '<a href="'.$_sLink.'" target="'.$this->getUrlTarget().'" ';
			if ($this->sCssClassNormal != '') {$_sHTML .= 'class="'.$this->sCssClassNormal.'" ';}
			else {$_sHTML .= 'style="'.$this->sCssStyleNormal.'" ';}
			$_sHTML .= '>';
		}
		$_sHTML .= $_sNextPageText;
		if ($this->iPageActive+1 <= $this->iPageCount) {$_sHTML .= '</a>';}

		return $_sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the number of pages that are directly selectable in navigation.[/en]
	[de]Setzt die Anzahl an Seiten die bei der Navigation direkt anwählbar sind.[/de]
	
	@param iCount [needed][type]int[/type]
	[en]The number of pages that are directly selectable in navigation.[/en]
	[de]Die Anzahl an Seiten die bei der Navigation direkt anwählbar sind.[/de]
	*/
	public function setPagesToShow($_iCount)
	{
		$_iCount = $this->getRealParameter(array('oParameters' => $_iCount, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$this->iPagesToShow = $_iCount;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the number of pages that should be used.[/en]
	[de]Setzt die Anzahl an Seiten die verwendet werden sollen.[/de]
	
	@param iCount [needed][type]int[/type]
	[en]The number of pages that should be used.[/en]
	[de]Die Anzahl an Seiten die verwendet werden sollen.[/de]
	*/
	public function setPageCount($_iCount)
	{
		$_iCount = $this->getRealParameter(array('oParameters' => $_iCount, 'sName' => 'iCount', 'xParameter' => $_iCount));
		$this->iPageCount = max($_iCount, 1);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the page that is currently selected.[/en]
	[de]Setzt die Seite die gerade ausgewählt ist.[/de]
	
	@param iPage [needed][type]int[/type]
	[en]The page that is currently selected.[/en]
	[de]Die Seite die gerade ausgewählt ist.[/de]
	*/
	public function setPageActive($_iPage)
	{
		$_iPage = $this->getRealParameter(array('oParameters' => $_iPage, 'sName' => 'iPage', 'xParameter' => $_iPage));
		$this->iPageActive = max($_iPage, 1);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS class for the active page.[/en]
	[de]Setzt die CSS Klasse für die aktive Seite.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the active page.[/en]
	[de]Die CSS Klasse für die aktive Seite.[/de]
	*/
	public function setCssClassForActive($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassActive = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS class for the not active pages.[/en]
	[de]Setzt die CSS Klasse für die nicht aktiven Seiten.[/de]
	
	@param sClass [needed][type]string[/type]
	[en]The CSS class for the not active pages.[/en]
	[de]Die CSS Klasse für die nicht aktiven Seiten.[/de]
	*/
	public function setCssClassForNormal($_sClass)
	{
		$_sClass = $this->getRealParameter(array('oParameters' => $_sClass, 'sName' => 'sClass', 'xParameter' => $_sClass));
		$this->sCssClassNormal = $_sClass;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS code for the active page.[/en]
	[de]Setzt die CSS Code für die aktive Seite.[/de]
	
	@param sStyle [needed][type]string[/type]
	[en]The CSS code for the active page.[/en]
	[de]Die CSS Code für die aktive Seite.[/de]
	*/
	public function setCssStyleForActive($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleActive = $_sStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the CSS code for the not active pages.[/en]
	[de]Setzt die CSS Code für die nicht aktiven Seiten.[/de]
	
	@param sStyle [needed][type]string[/type]
	[en]The CSS code for the not active pages.[/en]
	[de]Die CSS Code für die nicht aktiven Seiten.[/de]
	*/
	public function setCssStyleForNormal($_sStyle)
	{
		$_sStyle = $this->getRealParameter(array('oParameters' => $_sStyle, 'sName' => 'sStyle', 'xParameter' => $_sStyle));
		$this->sCssStyleNormal = $_sStyle;
	}
	/* @end method */
}
/* @end class */
$oPGPageControl = new classPG_PageControl();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGPageControl', 'xValue' => $oPGPageControl));}
?>