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
class classPG_Faq extends classPG_ClassBasics
{
	// Declarations...
	private $sCategoryIconOpen = 'faq_category_icon_open.png';
	private $sCategoryIconClose = 'faq_category_icon_close.png';
	private $sQuestionIconOpen = 'faq_question_icon_open.png';
	private $sQuestionIconClose = 'faq_question_icon_close.png';
	private $axFaq = array();
	private $bLoadFromDatabase = false;
	private $bCategoryStatusIcons = true;
	private $bQuestionsStatusIcons = true;
	private $bJavaScriptAutoRegister = true;

	// Construct...
	public function __construct()
	{
		$this->setID('PGFaq');
		$this->initClassBasics();
		$this->initDatabase();
		$this->setText(
			array(
				'QuestionPrefix' => '',
				'AnswerPrefix' => ''
			)
		);
	}
	
	// Methods...
	/*
	@start method
	@param bUse
	*/
	public function useLoadFromDatabase($_bUse) {$this->bLoadFromDatabase = $_bUse;}
	/* @end method */

	/* @start method */
	public function isLoadFromDatabase() {return $this->bLoadFromDatabase;}
	/* @end method */
	
	/*
	@start method
	@param bUse
	*/
	public function useJavaScriptAutoRegister($_bUse) {$this->bJavaScriptAutoRegister = $_bUse;}
	/* @end method */

	/* @start method */
	public function isJavaScriptAutoRegister() {return $this->bJavaScriptAutoRegister;}
	/* @end method */
	
	/*
	@start method
	@param axFaq
	*/
	public function setFaq($_axFaq) {$this->axFaq = $_axFaq;}
	/* @end method */

	/*
	@start method
	@param axFaq
	*/
	public function addFaq($_axFaq) {$this->axFaq = array_merge($this->axFaq, $_axFaq);}
	/* @end method */

	/* @start method */
	public function getFaq() {return $this->axFaq;}
	/* @end method */
	
	/*
	@start method
	@param axCategories
	*/
	public function setCategories($_axCategories) {$this->axFaq = $_axCategories; return count($this->axFaq)-1;}
	/* @end method */

	/*
	@start method
	@param axCategory
	*/
	public function addCategory($_axCategory) {$this->axFaq[] = $_axCategory; return count($this->axFaq)-1;}
	/* @end method */

	/*
	@start method
	@param iCategoryIndex
	@param axQuestions
	*/
	public function setQuestions($_iCategoryIndex, $_axQuestions) {$this->axFaq[$_iCategoryIndex]['axQuestions'] = $_axQuestions; return count($this->axFaq[$_iCategoryIndex]['axQuestions'])-1;}
	/* @end method */

	/*
	@start method
	@param iCtageoryIndex
	@param axQuestions
	*/
	public function addQuestions($_iCategoryIndex, $_axQuestions) {$this->axFaq[$_iCategoryIndex]['axQuestions'] = array_merge($this->axFaq[$_iCategoryIndex]['axQuestions'], $_axQuestions); return count($this->axFaq[$_iCategoryIndex]['axQuestions'])-1;}
	/* @end method */

	/*
	@start method
	@param iCategoryIndex
	@param axQuestion
	*/
	public function addQuestion($_iCategoryIndex, $_axQuestion) {$this->axFaq[$_iCategoryIndex]['axQuestions'][] = $_axQuestion; return count($this->axFaq[$_iCategoryIndex]['axQuestions'])-1;}
	/* @end method */
	
	/* @start method */
	public function loadCategories()
	{
		/*
		$_asColumns = array('CategoryID', 'Name');
		$_sTable = $this->getDatabaseTablePrefix().'faq_categories';
		$_sWhereCondition = 'Active = "1"';
		$_sOrderBy = 'Name';
		$_bOrderReverse = false;
		if ($_oRes = $this->selectDatasets($_sTable, $_asColumns, $_sWhereCondition, $_iStart = NULL, $_iEnd = NULL, $_sOrderBy, $_bOrderReverse))
		{
			while ($this->axCategories[] = $this->fetchDatabaseArray()) {} // while _axFaq
		} // if _oRes
		
		return $this->axCategories;
		*/
	}
	/* @end method */
	
	/*
	@start method
	@param iCategoryID
	*/
	public function loadQuestions($_iCategoryID = NULL)
	{
		/*
		$_asColumns = array('FaqID', 'Question', 'Answer');
		$_sTable = $this->getDatabaseTablePrefix().'faq_questions';
		$_sWhereCondition = 'Active = "1"';
		if ($_iCategoryID != NULL) {$_sWhereCondition .= ' AND CategoryID = "'.$_iCategoryID.'"';}
		$_sOrderBy = 'Question';
		$_bOrderReverse = false;
		if ($_oRes = $this->selectDatasets($_sTable, $_asColumns, $_sWhereCondition, $_iStart = NULL, $_iEnd = NULL, $_sOrderBy, $_bOrderReverse))
		{
			while ($this->axQuestions[$_iCategoryID][] = $this->fetchDatabaseArray()) {} // while _axFaq
		} // if _oRes
		
		return $this->axQuestions;
		*/
	}
	/* @end method */
	
	/*
	@start method
	@param iCategoryIndex
	@param iQuestionIndex
	@param axQuestion
	*/
	public function buildEntry($_iCategoryIndex, $_iQuestionIndex, $_axQuestion)
	{
		$_sHTML = '';
		$_sHTML .= '<h4>';
		$_sHTML .= '<a href="javascript:;" onclick="oPGFaq.switchQuestion(\''.$this->getID().'Category'.$_iCategoryIndex.'Question'.$_iQuestionIndex.'\');" target="_self">';
			if ($this->bQuestionsStatusIcons == true)
			{
				$_sHTML .= '<img id="'.$this->getID().'Category'.$_iCategoryIndex.'Question'.$_iQuestionIndex.'IconOpen" src="'.$this->getGfxPathImages($this->sCategoryIconOpen).'" style="display:inline; border:0;" />';
				$_sHTML .= '<img id="'.$this->getID().'Category'.$_iCategoryIndex.'Question'.$_iQuestionIndex.'IconClose" src="'.$this->getGfxPathImages($this->sCategoryIconClose).'" style="display:none; border:0;" />';
				$_sHTML .= ' ';
			}
			$_sHTML .= $this->getText('QuestionPrefix').$_axQuestion['sQuestion'];
		$_sHTML .= '</a>';
		$_sHTML .= '</h4>';
		$_sHTML .= '<div id="'.$this->getID().'Category'.$_iCategoryIndex.'Question'.$_iQuestionIndex.'" style="margin-left:20px; margin-bottom:10px;">'.$this->getText('AnswerPrefix').$_axQuestion['sAnswer'].'</div>';
		return $_sHTML;
	}
	/* @end method */
	
	/* @start method */
	public function build()
	{
		$_sJavaScript = '<script type="text/javascript">';
		$_sHTML = '';
		
		if ($this->bLoadFromDatabase == true) {$this->loadCategories();}
		for ($_iCategoryIndex = 0; $_iCategoryIndex<count($this->axFaq); $_iCategoryIndex++)
		{
			$_sHTML .= '<h3>';
			$_sHTML .= '<a href="javascript:;" onclick="oPGFaq.switchCategory(\''.$this->getID().'Category'.$_iCategoryIndex.'\');" target="_self">';
				if ($this->bCategoryStatusIcons == true)
				{
					$_sHTML .= '<img id="'.$this->getID().'Category'.$_iCategoryIndex.'IconOpen" src="'.$this->getGfxPathImages($this->sCategoryIconOpen).'" style="display:inline; border:0;" />';
					$_sHTML .= '<img id="'.$this->getID().'Category'.$_iCategoryIndex.'IconClose" src="'.$this->getGfxPathImages($this->sCategoryIconClose).'" style="display:none; border:0;" />';
					$_sHTML .= ' ';
				}
				$_sHTML .= $this->axFaq[$_iCategoryIndex]['sName'];
			$_sHTML .= '</a>';
			$_sHTML .= '</h3>';
			$_sHTML .= '<div id="'.$this->getID().'Category'.$_iCategoryIndex.'" style="margin-left:20px;">';
			if (($this->bLoadFromDatabase == true) && (isset($this->axFaq[$_iCategoryIndex]['iCategoryID'])))
			{
				$this->loadQuestions($_iCategoryID = $this->axFaq[$_iCategoryIndex]['iCategoryID']);
			}
			for ($_iQuestionIndex=0; $_iQuestionIndex<count($this->axFaq[$_iCategoryIndex]['axQuestions']); $_iQuestionIndex++)
			{
				$_sHTML .= $this->buildEntry($_iCategoryIndex, $_iQuestionIndex, $this->axFaq[$_iCategoryIndex]['axQuestions'][$_iQuestionIndex]);
				$_sJavaScript .= 'oPGFaq.registerQuestion(\''.$this->getID().'Category'.$_iCategoryIndex.'Question'.$_iQuestionIndex.'\'); ';
			}
			$_sHTML .= '</div>';
			$_sJavaScript .= 'oPGFaq.registerCategory(\''.$this->getID().'Category'.$_iCategoryIndex.'\'); ';
		}
		$_sJavaScript .= 'oPGFaq.init(); ';
		$_sJavaScript .= '</script>';
		
		if ($this->bJavaScriptAutoRegister == true)
		{
			$_sHTML .= $_sJavaScript;
		}
		
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */

/*
	$oPGFaq->setFaq(
		array(
			array(
				'iCategoryID' => 0, 
				'sName' => 'Kategory 1', 
				'axQuestions' => array(
					array(
						'iQuestionID' => 0,
						'sQuestion' => 'Question 1?',
						'sAnswer' => 'Answer 1!'
					),
					array(
						'iQuestionID' => 1,
						'sQuestion' => 'Question 2?',
						'sAnswer' => 'Answer 2!'
					)
				)
			)
		)
	);
*/

$oPGFaq = new classPG_Faq();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGFaq', 'xValue' => $oPGFaq));}
?>