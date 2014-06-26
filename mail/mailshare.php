<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 14 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_MailShare extends classPG_ClassBasics
{
	// Declarations...
	private $sUrlToShare = '';
	private $sTextToShare = '';
	private $sShareOnUrl = 'mail_share.php';
	private $sButtonImage = 'mail_share.png';
	private $iPopupWindowSizeX = 550;
	private $iPopupWindowSizeY = 370;
	private $bPopupScrollbars = false;
	private $bPopupResizeable = false;
	private $bShareLinkText = false;
	private $bAllowGetUrlToShareFromUrl = false;
	private $bAllowGetTextToShareFromUrl = false;
	
	// Construct...
	public function __construct()
	{
		$this->setID(array('sID' => 'PGMailShare'));
		$this->initClassBasics();
		$this->setText(
			array(
				'xType' => array(
					'ReceiverEmailLabel' => 'Empf&auml;nger E-Mail:',
					'SenderEmailLabel' => 'Absender E-Mail:',
					'EmailSubjectPrefix' => 'Empfehlung von [sender_mail]: ',
					'EmailSubjectLabel' => 'Betreff:',
					'EmailSubjectText' => 'Schau dir das mal an!',
					'EmailMessageLabel' => 'Bemerkung:',
					'EmailMessagePrefix' => '[sender_mail] empfiehlt [url_to_share]<br /><br />',
					'EmailMessageText' => '',
					'EmailMessageSuffix' => '',
					'EmailSendFailedMessage' => 'Beim Senden der E-Mail ist ein Fehler aufgetreten!',
					'EmailSendSuccessMessage' => 'Ihre Empfehlung wurde erfolgreich per E-Mail gesendet.',
					'ShareLinkText' => 'share on mail'
				)
			)
		);
	}
	
	// Methods...
	/*
	@start method
	
	@param sImage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setButtonImage($_sImage)
	{
		$_sImage = $this->getRealParameter(array('oParameters' => $_sImage, 'sName' => 'sImage', 'xParameter' => $_sImage));
		$this->sButtonImage = $_sImage;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sButtonImage [type]string[/type]
	[en]...[/en]
	*/
	public function getButtonImage() {return $this->sButtonImage;}
	/* @end method */
	
	/*
	@start method
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setShareOnUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sShareOnUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sShareOnUrl [type]string[/type]
	[en]...[/en]
	*/
	public function getShareOnUrl() {return $this->sShareOnUrl;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setPopupWindowSizeX($_iSizeX)
	{
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));
		$this->iPopupWindowSizeX = $_iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iPopupWindowSizeX [type]int[/type]
	[en]...[/en]
	*/
	public function getPopupWindowSizeX() {return $this->iPopupWindowSizeX;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setPopupWindowSizeY($_iSizeY)
	{
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_iSizeY, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$this->iPopupWindowSizeY = $_iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@return iPopupWindowSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function getPopupWindowSizeY() {return $this->iPopupWindowSizeY;}
	/* @end method */
	
	/*
	@start method
	
	@param iSizeX [type]int[/type]
	[en]...[/en]
	
	@param iSizeY [type]int[/type]
	[en]...[/en]
	*/
	public function setPopupWindowSize($_iSizeX = NULL, $_iSizeY = NULL)
	{
		$_iSizeY = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeY', 'xParameter' => $_iSizeY));
		$_iSizeX = $this->getRealParameter(array('oParameters' => $_iSizeX, 'sName' => 'iSizeX', 'xParameter' => $_iSizeX));

		if ($_iSizeX != NULL) {$this->iPopupWindowSizeX = $_iSizeX;}
		if ($_iSizeY != NULL) {$this->iPopupWindowSizeY = $_iSizeY;}
	}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function usePopupScrollbars($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bPopupScrollbars = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bPopupScrollbars [type]bool[/type]
	[en]...[/en]
	*/
	public function isPopupScrollbars() {return $this->bPopupScrollbars;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function usePopupResizeable($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bPopupResizeable = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bPopupResizeable [type]bool[/type]
	[en]...[/en]
	*/
	public function isPopupResizeable() {return $this->bPopupResizeable;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useShareLinkText($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bShareLinkText = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bShareLinkText [type]bool[/type]
	[en]...[/en]
	*/
	public function isShareLinkText() {return $this->bShareLinkText;}
	/* @end method */

	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useAllowGetUrlToShareFromUrl($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAllowGetUrlToShareFromUrl = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bIsAllowed [type]bool[/type]
	[en]...[/en]
	*/
	public function isAllowGetUrlToShareFromUrl() {return $this->bAllowGetUrlToShareFromUrl;}
	/* @end method */
	
	/*
	@start method
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useAllowGetTextToShareFromUrl($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bAllowGetTextToShareFromUrl = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bAllowed [type]bool[/type]
	[en]...[/en]
	*/
	public function isAllowGetTextToShareFromUrl() {return $this->bAllowGetTextToShareFromUrl;}
	/* @end method */
	
	/*
	@start method
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setUrlToShare($_sUrl)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->sUrlToShare = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	*/
	public function getUrlToShare() {return $this->sUrlToShare;}
	/* @end method */
	
	/*
	@start method
	
	@param sText [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setTextToShare($_sText)
	{
		$_sText = $this->getRealParameter(array('oParameters' => $_sText, 'sName' => 'sText', 'xParameter' => $_sText));
		$this->sTextToShare = $_sText;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sText [type]string[/type]
	[en]...[/en]
	*/
	public function getTextToShare() {return $this->sTextToShare;}
	/* @end method */

	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sFromMail [needed][type]string[/type]
	[en]...[/en]
	
	@param xToMail [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sSubject [needed][type]string[/type]
	[en]...[/en]
	
	@param sUrlToShare [needed][type]string[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function sendMail($_sFromMail, $_xToMail = NULL, $_sSubject = NULL, $_sUrlToShare = NULL, $_sMessage = NULL)
	{
		global $oPGMail;

		$_xToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'xToMail', 'xParameter' => $_xToMail));
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$_sUrlToShare = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sUrlToShare', 'xParameter' => $_sUrlToShare));
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_sFromMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromMail', 'xParameter' => $_sFromMail));
		
		$_sHTML = '';
		if
		(
			$oPGMail->send(
				array(
				   'sFromMail' => $_sFromMail,
				   'xToMail' => $_xToMail, 
				   'sSubject' => str_replace('[sender_mail]', $_sFromMail, $this->getText('EmailSubjectPrefix')).$_sSubject, 
				   'sMessage' => str_replace('[sender_mail]', $_sFromMail, str_replace('[url_to_share]', $_sUrlToShare, $this->getText('EmailMessagePrefix').$_sMessage.$this->getText('EmailMessageSuffix')))
				)
			)
		)
		{
			$_sHTML .= '<span class="pg_success">'.$this->getText(array('sType' => 'EmailSendSuccessMessage')).'</span><br />';
		}
		else {$_sHTML .= '<span class="pg_failed">'.$this->getText(array('sType' => 'EmailSendFailedMessage')).'</span><br />';}
		return $_sHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	*/
	public function buildMailForm()
	{
		global $oPGLogin, $oPGForm, $_GET;
		
		$_sFormID = $this->getID().'Form';
		$_sHTML = '';
		
		if ($oPGForm->isSubmitted($_sFormID))
		{
			$_axData = $oPGForm->getReceivedData(array('sFormID' => $_sFormID, 'sFormMethod' => 'post', 'bEscapeForDatabases' => false));
			$_sUrlToShare = $_axData[$_sFormID.'UrlToShare'];
			$_sFromMail = $_axData[$_sFormID.'SenderEmailField0'];
			$_xToMail = $_axData[$_sFormID.'ReceiverEmailField0'];
			$_sSubject = $_axData[$_sFormID.'EmailSubjectField0'];
			$_sMessage = $_axData[$_sFormID.'EmailMessage'];
			$_sHTML .= $this->sendMail(array('sFromMail' => $_sFromMail, 'xToMail' => $_xToMail, 'sSubject' => $_sSubject, 'sUrlToShare' => $_sUrlToShare, 'sMessage' => $_sMessage));
		}
		else
		{
			$_sSenderEmail = '';
			if (isset($oPGLogin))
			{
				if (!$oPGLogin->isGuest()) {$_sSenderEmail = $oPGLogin->getUserData(array('sProperty' => 'Email'));}
			}
			
			if ((isset($_GET['u'])) && ($this->bAllowGetUrlToShareFromUrl == true)) {$this->setUrlToShare(array('sUrl' => $_GET['u']));}
			if ($this->sTextToShare == '')
			{
				if ((isset($_GET['t'])) && ($this->bAllowGetTextToShareFromUrl == true)) {$this->sTextToShare = $_GET['t'];}
				else {$this->sTextToShare = $this->getText(array('sType' => 'EmailMessageText'));}
			}
			
			$_iInputsSizeX = 350;
			$oPGForm->addHiddenField(array('sHiddenFieldID' => $_sFormID.'UrlToShare', 'xFieldValue' => $this->getUrlToShare()));
			$oPGForm->addInputField(array('sLabelName' => $this->getText(array('sType' => 'ReceiverEmailLabel')), 'sInputFieldID' => $_sFormID.'ReceiverEmail', 'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE, 'iFieldSizeX' => $_iInputsSizeX, 'xFieldValue' => ''));
			$oPGForm->addInputField(array('sLabelName' => $this->getText(array('sType' => 'SenderEmailLabel')), 'sInputFieldID' => $_sFormID.'SenderEmail', 'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE, 'iFieldSizeX' => $_iInputsSizeX, 'xFieldValue' => $_sSenderEmail));
			$oPGForm->addInputField(array('sLabelName' => $this->getText(array('sType' => 'EmailSubjectLabel')), 'sInputFieldID' => $_sFormID.'EmailSubject', 'iInputFieldMode' => PG_INPUTFIELD_MODE_NONE, 'iFieldSizeX' => $_iInputsSizeX, 'xFieldValue' => $this->getText(array('sType' => 'EmailSubjectText'))));
			$oPGForm->addTextArea(array('sLabelName' => $this->getText(array('sType' => 'EmailMessageLabel')), 'sTextAreaID' => $_sFormID.'EmailMessage', 'iTextAreaMode' => PG_TEXTAREA_MODE_NONE, 'iSizeX' => $_iInputsSizeX, $_iRows = 6, 'sText' => $this->sTextToShare));
			$_sHTML .= $oPGForm->build(array('sFormID' => $_sFormID, 'sTargetUrl' => $this->sShareOnUrl, 'sTargetFrame' => '_self', 'sFormMethod' => 'post'));
		}
		return $_sHTML;
	}
	/* @end method */

	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param sUrlToShare [type]string[/type]
	[en]...[/en]
	
	@param sTextToShare [type]string[/type]
	[en]...[/en]
	*/
	public function build($_sUrlToShare = NULL, $_sTextToShare = NULL)
	{
		$_sTextToShare = $this->getRealParameter(array('oParameters' => $_sUrlToShare, 'sName' => 'sTextToShare', 'xParameter' => $_sTextToShare));
		$_sUrlToShare = $this->getRealParameter(array('oParameters' => $_sUrlToShare, 'sName' => 'sUrlToShare', 'xParameter' => $_sUrlToShare));

		if ($_sUrlToShare == NULL) {$_sUrlToShare = $this->sUrlToShare;}
		if ($_sTextToShare == NULL) {$_sTextToShare = $this->sTextToShare;}
		
		$_sHTML = '';
		$_sHTML .= '<a href="javascript:;" onclick="oPGBrowser.popup(\'';
		$_sHTML .= $this->sShareOnUrl;
		if (strripos($this->sShareOnUrl, '?') !== false) {$_sHTML .= '&';} else {$_sHTML .= '?';}
		$_sHTML .= 'u='.htmlentities(urlencode($_sUrlToShare));
		if (($_sTextToShare !== '') && ($_sTextToShare !== NULL)) {$_sHTML .= '&amp;t='.urlencode(utf8_encode($_sTextToShare));}
		$_sHTML .= '\', '.$this->iPopupWindowSizeX.', '.$this->iPopupWindowSizeY.', \'facebook_share\', ';
		if ($this->bPopupScrollbars == true) {$_sHTML .= 'true';} else {$_sHTML .= 'false';}
		$_sHTML .= ', ';
		if ($this->bPopupResizeable == true) {$_sHTML .= 'true';} else {$_sHTML .= 'false';}
		$_sHTML .= ');" ';
		$_sHTML .= 'target="_self">';
		$_sHTML .= '<img src="'.$this->getGfxPathImages(array('sImage' => $this->sButtonImage)).'" style="border-width:0px;" />';
		if ($this->bShareLinkText == true) {$_sHTML .= ' '.$this->getText(array('sType' => 'ShareLinkText'));}
		$_sHTML .= '</a>';
		return $_sHTML;
	}
	/* @end method */
}
/* @end class */
$oPGMailShare = new classPG_MailShare();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMailShare', 'xValue' => $oPGMailShare));}
?>