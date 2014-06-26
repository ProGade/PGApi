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
class classPG_Mail extends classPG_ClassBasics
{
	// Declarations...
	private $sSendMailDetails = '';
	private $sSendMailCssStyle = "* {font-family:Arial, Verdana, 'Times New Roman';}\nbody {font-size:12px;}\nh1 {font-size:18px;}";
	private $sSendMailHeader = '';
	private $sSendMailMessageHeader = '';
	private $sSendMailMessageFooter = '';
	private $bSendMailDefaultHtml = false;
	private $bSendMailDefaultText = true;
	private $bSendMailAutoDetectHtml = true;
	private $bSendMailGenerateHTML = true;
	private $bSendMailConvertLineBreaks = true;
    private $oMailer = NULL;

	// Construct...
	public function __construct()
    {
        $this->initTemplate();
    }
	
	// Methods...
    /*
    @start method

    @description
    [en]...[/en]

    @param oMailer [needed][type]object[/type]
    [en]...[/en]
    */
    public function setMailer($_oMailer)
    {
        $_oMailer = $this->getRealParameter(array('oParameters' => $_oMailer, 'sName' => 'oMailer', 'xParameter' => $_oMailer));
        $this->oMailer = $_oMailer;
    }
    /* @end method */

	/*
	@start method
	
	@group CSS
	
	@description
	[en]...[/en]
	
	@param sCssStyle [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setSendMailCssStyle($_sCssStyle)
	{
		$_sCssStyle = $this->getRealParameter(array('oParameters' => $_sCssStyle, 'sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$this->sSendMailCssStyle = $_sCssStyle;
	}
	/* @end method */
	
	/*
	@start method
	
	@group CSS
	
	@description
	[en]...[/en]
	
	@return sCssStyle [type]string[/type]
	[en]...[/en]
	*/
	public function getSendMailCssStyle() {return $this->sSendMailCssStyle;}
	/* @end method */
	
	/*
	@start method
	
	@group Message
	
	@description
	[en]...[/en]
	
	@param sHeader [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setSendMailMessageHeader($_sHeader)
	{
		$_sHeader = $this->getRealParameter(array('oParameters' => $_sHeader, 'sName' => 'sHeader', 'xParameter' => $_sHeader));
		$this->sSendMailMessageHeader = $_sHeader;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Message
	
	@description
	[en]...[/en]
	
	@return sMessageHeader [type]string[/type]
	[en]...[/en]
	*/
	public function getSendMailMessageHeader() {return $this->sSendMailMessageHeader;}
	/* @end method */
	
	/*
	@start method
	
	@group Message
	
	@description
	[en]...[/en]
	
	@param sFooter [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setSendMailMessageFooter($_sFooter)
	{
		$_sFooter = $this->getRealParameter(array('oParameters' => $_sFooter, 'sName' => 'sFooter', 'xParameter' => $_sFooter));
		$this->sSendMailMessageFooter = $_sFooter;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Message
	
	@description
	[en]...[/en]
	
	@return sMessageFooter [type]string[/type]
	[en]...[/en]
	*/
	public function getSendMailMessageFooter() {return $this->sSendMailMessageFooter;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSendMailGenerateHtml($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendMailGenerateHTML = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bGenerateHtml [type]bool[/type]
	[en]...[/en]
	*/
	public function isSendMailGenerateHtml() {return $this->bSendMailGenerateHTML;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSendMailConvertLineBreaks($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendMailConvertLineBreaks = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bConvertLineBreaks [type]bool[/type]
	[en]...[/en]
	*/
	public function isSendMailConvertLineBreaks() {return $this->bSendMailConvertLineBreaks;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSendMailDefaultHtml($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendMailDefaultHtml = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bDefaultHtml [type]bool[/type]
	[en]...[/en]
	*/
	public function isSendMailDefaultHtml() {return $this->bSendMailDefaultHtml;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSendMailDefaultText($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendMailDefaultText = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bDefaultText [type]bool[/type]
	[en]...[/en]
	*/
	public function isSendMailDefaultText() {return $this->bSendMailDefaultText;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param bUse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useSendMailAutoDetectHtml($_bUse)
	{
		$_bUse = $this->getRealParameter(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bSendMailAutoDetectHtml = $_bUse;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return bAutoDetect [type]bool[/type]
	[en]...[/en]
	*/
	public function isSendMailAutoDetectHtml() {return $this->bSendMailAutoDetectHtml;}
	/* @end method */
	
	/*
	@start method
	
	@param sHeader [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setSendMailHeader($_sHeader)
	{
		$_sHeader = $this->getRealParameter(array('oParameters' => $_sHeader, 'sName' => 'sHeader', 'xParameter' => $_sHeader));
		$this->sSendMailHeader = (string)$_sHeader;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sMailHeader [type]string[/type]
	[en]...[/en]
	*/
	public function getSendMailHeader() {return $this->sSendMailHeader;}
	/* @end method */
	
	/*
	@start method
	
	@return sMailDetails [type]string[/type]
	[en]...[/en]
	*/
	public function getSendMailDetails() {return $this->sSendMailDetails;}
	/* @end method */
	
	/*
	@start method
	
	@return sHeaders [type]string[/type]
	[en]...[/en]
	
	@param sFromMail [needed][type]string[/type]
	[en]...[/en]
	
	@param sToMail [needed][type]string[/type]
	[en]...[/en]
	
	@param sReplyToMail [type]string[/type]
	[en]...[/en]
	
	@param asCcMail [type]string[][/type]
	[en]...[/en]
	
	@param bHtml [type]bool[/type]
	[en]...[/en]
	
	@param bText [type]bool[/type]
	[en]...[/en]
	
	@param bAttachment [type]bool[/type]
	[en]...[/en]
	
	@param sMimeBoundary [type]string[/type]
	[en]...[/en]
	*/
	public function buildHeaders(
		$_sFromMail,
		$_sToMail = NULL,
		$_sReplyToMail = NULL,
		$_asCcMail = NULL,
		$_bHtml = NULL,
		$_bText = NULL,
		$_bAttachment = NULL,
		$_sMimeBoundary = NULL
	)
	{
		global $_SERVER;
		
		$_sToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sToMail', 'xParameter' => $_sToMail));
		$_sReplyToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sReplyToMail', 'xParameter' => $_sReplyToMail));
		$_asCcMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'asCcMail', 'xParameter' => $_asCcMail));
		$_bHtml = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bHtml', 'xParameter' => $_bHtml));
		$_bText = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bText', 'xParameter' => $_bText));
		$_bAttachment = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bAttachment', 'xParameter' => $_bAttachment));
		$_sFromMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromMail', 'xParameter' => $_sFromMail));

		if ($_sToMail === NULL) {$_sToMail = '';}
		if ($_sReplyToMail === NULL) {$_sReplyToMail = '';}
		if ($_sMimeBoundary === NULL) {$_sMimeBoundary = '------------'.md5(time());}
		
		$_sMomentn = time().".";
		$_sLBR = "\r\n";
		$_sHeaders = '';
		
		if ($this->sSendMailHeader != '') {$_sHeaders = $this->sSendMailHeader;}
		else
		{
			for ($i=0; $i<count($_asCcMail); $i++) {$_asCcMail[$i] = '<'.str_replace('<', '', str_replace('>', '', $_asCcMail[$i])).'>';}
			$_sHeaders = 'From: <'.str_replace('<', '', str_replace('>', '', $_sFromMail)).'>'.$_sLBR;
			if ($_sToMail != '') {$_sHeaders .= 'To: <'.str_replace('<', '', str_replace('>', '', $_sToMail)).'>'.$_sLBR;}
			if ($_sReplyToMail != '') {$_sHeaders .= 'Reply-To: <'.str_replace('<', '', str_replace('>', '', $_sReplyToMail)).'>'.$_sLBR;}
			if ($_sReplyToMail != '') {$_sHeaders .= 'Return-Path: <'.str_replace('<', '', str_replace('>', '', $_sReplyToMail)).'>'.$_sLBR;}
			if ($_asCcMail != NULL) {$_sHeaders .= 'CC: '.implode(',', $_asCcMail).$_sLBR;}
			// $_sHeaders .= 'Message-ID: <'.$_sMomentn.'PG@PHPMAILER>'.$_sLBR;
			$_sHeaders .= 'Message-ID: <'.$_sMomentn.'PG@'.strtolower(str_replace('@', '', strrchr($_sFromMail, '@'))).'>'.$_sLBR;
			$_sHeaders .= 'Sender-IP: '.$_SERVER['REMOTE_ADDR'].$_sLBR;
			$_sHeaders .= 'Date: '.date("r").$_sLBR;
			$_sHeaders .= 'X-Mailer: PHP v'.phpversion().$_sLBR; // These two to help avoid spam-filters 
			$_sHeaders .= 'X-Priority: 3'.$_sLBR;
			$_sHeaders .= 'MIME-Version: 1.0'.$_sLBR;
	
			if (($_bAttachment == true) || (($_bHtml == true) && ($_bText == true)))
			{
				if ($_bAttachment == true)
				{
					// $_sHeaders .= 'Content-Type: multipart/related; charset="ISO-8859-15"; boundary="'.$_sMimeBoundary.'"'.$_sLBR;
					$_sHeaders .= 'Content-Type: multipart/mixed;'.$_sLBR.' boundary="'.$_sMimeBoundary.'"'.$_sLBR;
				}
				else {$_sHeaders .= 'Content-Type: multipart/alternative;'.$_sLBR.' boundary="'.$_sMimeBoundary.'"'.$_sLBR;}
			}
			else if ($_bHtml == true)
			{
				// $_sHeaders .= "Content-Type: text/html; charset=ISO-8859-1".$_sLBR;
				$_sHeaders .= "Content-Type: text/html; charset=ISO-8859-15".$_sLBR;
				$_sHeaders .= "Content-Transfer-Encoding: 8bit".$_sLBR;
			}
			else if ($_bText == true)
			{
				$_sHeaders .= "Content-Type: text/plain; charset=ISO-8859-15; format=flowed".$_sLBR;
				$_sHeaders .= "Content-Transfer-Encoding: 8bit".$_sLBR;
			}
		}
		
		return $_sHeaders;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axResult [type]mixed[][/type]
	[en]...[/en]
	
	@param sFromMail [needed][type]string[/type]
	[en]...[/en]
	
	@param sToMail [needed][type]string[/type]
	[en]...[/en]
	
	@param sReplyToMail [type]string[/type]
	[en]...[/en]
	
	@param asCcMail [type]string[][/type]
	[en]...[/en]
	
	@param sSubject [type]string[/type]
	[en]...[/en]
	
	@param sMailBody [type]string[/type]
	[en]...[/en]
	
	@param sHeaders [type]string[/type]
	[en]...[/en]
	
	@param sServer [type]string[/type]
	[en]...[/en]
	
	@param sPort [type]string[/type]
	[en]...[/en]
	
	@param sUser [type]string[/type]
	[en]...[/en]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	
	@param bHtml [type]bool[/type]
	[en]...[/en]
	
	@param bText [type]bool[/type]
	[en]...[/en]
	
	@param bAttachment [type]bool[/type]
	[en]...[/en]
	*/
	public function sendMail(
		$_sFromMail,
		$_sToMail = NULL,
		$_sReplyToMail = NULL,
		$_asCcMail = NULL,
		$_sSubject = NULL,
		$_sMailBody = NULL,
		$_sHeaders = NULL,
		$_sServer = NULL, 
		$_sPort = NULL, 
		$_sUser = NULL, 
		$_sPassword = NULL,
		$_bHtml = NULL,
		$_bText = NULL,
		$_bAttachment = NULL,
		$_bUseStartTls = NULL
	)
	{
		$_sToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sToMail', 'xParameter' => $_sToMail));
		$_sReplyToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sReplyToMail', 'xParameter' => $_sReplyToMail));
		$_asCcMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'asCcMail', 'xParameter' => $_asCcMail));
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$_sMailBody = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sMailBody', 'xParameter' => $_sMailBody));
		$_sHeaders = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sHeaders', 'xParameter' => $_sHeaders));
		$_sServer = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sServer', 'xParameter' => $_sServer));
		$_sPort = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sPort', 'xParameter' => $_sPort));
		$_sUser = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sUser', 'xParameter' => $_sUser));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_bHtml = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bHtml', 'xParameter' => $_bHtml));
		$_bText = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bText', 'xParameter' => $_bText));
		$_bUseStartTls = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bUseStartTls', 'xParameter' => $_bUseStartTls));
		$_sFromMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromMail', 'xParameter' => $_sFromMail));

		if ($_sSubject === NULL) {$_sSubject = 'Kein Betreff';}
		if ($_sMailBody === NULL) {$_sMailBody = '';}
		if ($_sHeaders === NULL) {$_sHeaders = '';}
		
		if ($_sServer === NULL) {$_sServer = '';}
		if ($_sPort === NULL) {$_sPort = '25';}
		if ($_sUser === NULL) {$_sUser = '';}
		if ($_sPassword === NULL) {$_sPassword = '';}
		if ($_bUseStartTls === NULL) {$_bUseStartTls = true;}
		
		if ($_sHeaders == '')
		{
			$_sHeaders = $this->buildHeaders(
				array(
					'sFromMail' => $_sFromMail, 
					'sToMail' => $_sToMail, 
					'sReplyToMail' => $_sReplyToMail, 
					'asCcMail' => $_asCcMail, 
					'bHtml' => $_bHtml, 
					'bText' => $_bText, 
					'bAttachment' => $_bAttachment
				)
			);
		}
		
		$_axAnswer = array();
		$_axAnswer['bAllOk'] = false;
		$_axAnswer['sTalk'] = '';
		$_axAnswer['sError'] = '';
		$_axAnswer['sUnknown'] = '';

		if (($_sServer != '') && ($_sUser != ''))
		{
			if ($_oSocket = fsockopen($_sServer, $_sPort))
			{
				$_bStartTlsActive = false;
				$_bStartTlsSupported = false;
				$_sAnswer = '000 Start';
				$_sLastAnswer = '';
				$_iAbortCounter = 0;
				$_bDone = false;
				while (($_bDone == false) && (trim($_sAnswer) != ''))
				{
					$_sAnswer = fgets($_oSocket, 1024);
					$_sAnswerCode = trim(substr($_sAnswer, 0, 3));
					$_sAnswerText = trim(substr($_sAnswer, 4, strlen($_sAnswer)-4));

					switch($_sAnswerCode)
					{
						// 1. Server is ready...
						case '220': // Server ready
							$_axAnswer['sTalk'] .= $_sAnswer;
							fputs($_oSocket, 'EHLO '.$_SERVER['REMOTE_ADDR']."\r\n");
						break;

						// 2. Talk and wait for commands...
						case '250': // Requested mail action okay, completed
							$_axAnswer['sTalk'] .= $_sAnswer;
							if (strtoupper($_sAnswerText) == 'STARTTLS') {$_bStartTlsSupported = true;}
							if (strtoupper($_sAnswerText) == 'HELP')
							{
								if (($_bStartTlsSupported == true) && ($_bUseStartTls == true) && ($_bStartTlsActive == false))
								{
									fputs($_oSocket, "STARTTLS\r\n");
									$_axAnswer['sTalk'] .= "STARTTLS\r\n";
									$_sAnswer = fgets($_oSocket, 1024);
									$_sAnswerCode = trim(substr($_sAnswer, 0, 3));
									$_sAnswerText = trim(substr($_sAnswer, 4, strlen($_sAnswer)-4));
									if ($_sAnswerCode == '220')
									{
										$_bStartTlsActive = true;
										stream_socket_enable_crypto($_oSocket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
										$_axAnswer['sTalk'] .= $_sAnswer;
										fputs($_oSocket, 'EHLO '.$_SERVER['REMOTE_ADDR']."\r\n");
									}
									else
									{
										$_axAnswer['sError'] .= $_sAnswer;
										$_bDone = true;
									}
								}
								else {fputs($_oSocket, "AUTH LOGIN\r\n");}
							}
						break;
						
						// 3. Auth requests...
						case '334':
							$_axAnswer['sTalk'] .= $_sAnswer;
							if ($_sAnswerText == 'VXNlcm5hbWU6') {fputs($_oSocket, base64_encode($_sUser)."\r\n");} // username
							if ($_sAnswerText == 'UGFzc3dvcmQ6') {fputs($_oSocket, base64_encode($_sPassword)."\r\n");} // password
						break;
						
						// 4. Mail sender and receiver...
						case '235': // Auth successful
							fputs($_oSocket, "MAIL FROM: <".$_sFromMail.">\r\n");
							$_sAnswer = fgets($_oSocket, 1024);
							$_sAnswerCode = trim(substr($_sAnswer, 0, 3));
							$_sAnswerText = trim(substr($_sAnswer, 4, strlen($_sAnswer)-4));
							$_axReturn['sTalk'] = $_sAnswer;
							
							if (($_sAnswerCode == '250') && (strtoupper($_sAnswerText) == 'OK'))
							{
								fputs($_oSocket, "RCPT TO: <".$_sToMail.">\r\n");
								$_sAnswer = fgets($_oSocket, 1024);
								$_sAnswerCode = trim(substr($_sAnswer, 0, 3));
								$_sAnswerText = trim(substr($_sAnswer, 4, strlen($_sAnswer)-4));
								$_axReturn['sTalk'] .= $_sAnswer;
							}
							else {$_bDone = true;}
							
							if (($_sAnswerCode == '250') && (strtoupper($_sAnswerText) == 'OK'))
							{
								fputs($_oSocket, "DATA\r\n");
							}
							else {$_bDone = true;}
						break;
						
						// 5. Send mail...
						case '354':
							$_axAnswer['sTalk'] .= $_sAnswer;
							fputs($_oSocket, $_sHeaders."Subject:".$_sSubject."\r\n\r\n".$_sMailBody."\r\n.\r\n");
							$_sAnswer = fgets($_oSocket, 1024);
							$_sAnswerCode = trim(substr($_sAnswer, 0, 3));
							$_sAnswerText = trim(substr($_sAnswer, 4, strlen($_sAnswer)-4));
							$_axAnswer['sTalk'] .= $_sAnswer;
							if ($_sAnswerCode == '250') {$_axAnswer['bAllOk'] = true;}
							$_bDone = true;
						break;
						
						case '535': // Auth error
						case '221': // Service closing transmission channel
						case '421': // Service not available
						case '500': // Syntax error, command unrecognized
						case '501': // Syntax error in parameters of arguments
						case '502': // Command not implemented
						case '503': // Bad sequence of commands
						case '504': // Command parameter not implemented
							$_axAnswer['sError'] .= $_sAnswer;
							$_bDone = true;
						break;
						
						default:
							$_axAnswer['sUnknown'] .= $_sAnswer;
							$_bDone = true;
						break;
					}
					
					$_iAbortCounter++;
					if ($_iAbortCounter >= 30) {$_bDone = true;}
				}
				fputs($_oSocket, "QUIT\r\n");
				fclose($_oSocket);
			}
		}
		else
		{
			if (mail($_sToMail, $_sSubject, $_sMailBody, $_sHeaders."\r\n")) {$_axAnswer['bAllOk'] = true;}
		}

		return $_axAnswer;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFromMail [needed][type]string[/type]
	[en]...[/en]
	
	@param xToMail [needed][type]mixed[][/type]
	[en]...[/en]
	
	@param sSubject [needed][type]string[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	
	@param asAttachment [type]string[][/type]
	[en]...[/en]
	
	@param iAttachmentsFromMailID [type]int[/type]
	[en]...[/en]
	
	@param sServer [type]string[/type]
	[en]...[/en]
	
	@param sPort [type]string[/type]
	[en]...[/en]
	
	@param sUser [type]string[/type]
	[en]...[/en]
	
	@param sPassword [type]string[/type]
	[en]...[/en]
	
	@param bHtml [type]bool[/type]
	[en]...[/en]
	�
	@param bText [type]bool[/type]
	[en]...[/en]

	@param bUseStartTls [type]bool[/type]
	[en]...[/en]
	
	@param sReplyToMail [type]string[/type]
	[en]...[/en]
	
	@param asCcMail [type]string[][/type]
	[en]...[/en]
	*/
	public function send(
		$_sFromMail, 
		$_xToMail = NULL, 
		$_sSubject = NULL, 
		$_sMessage = NULL, 
		$_asAttachment = NULL, 
		$_iAttachmentsFromMailID = NULL, 
		$_sServer = NULL, 
		$_sPort = NULL, 
		$_sUser = NULL, 
		$_sPassword = NULL,
		$_bHtml = NULL, 
		$_bText = NULL, 
		$_bUseStartTls = NULL,
		$_sReplyToMail = NULL,
		$_asCcMail = NULL,
        $_xTemplate = NULL
	)
	{
		global $oPGStrings;

		$_xToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'xToMail', 'xParameter' => $_xToMail));
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_asAttachment = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'asAttachment', 'xParameter' => $_asAttachment));
		$_iAttachmentsFromMailID = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'iAttachmentsFromMailID', 'xParameter' => $_iAttachmentsFromMailID));
		$_bHtml = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bHtml', 'xParameter' => $_bHtml));
		$_bText = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bText', 'xParameter' => $_bText));
		$_sReplyToMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sReplyToMail', 'xParameter' => $_sReplyToMail));
		$_asCcMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'asCcMail', 'xParameter' => $_asCcMail));
		$_sServer = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sServer', 'xParameter' => $_sServer));
		$_sPort = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sPort', 'xParameter' => $_sPort));
		$_sUser = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sUser', 'xParameter' => $_sUser));
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_bUseStartTls = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'bUseStartTls', 'xParameter' => $_bUseStartTls));
        $_xTemplate = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		$_sFromMail = $this->getRealParameter(array('oParameters' => $_sFromMail, 'sName' => 'sFromMail', 'xParameter' => $_sFromMail));
		
		if ($_sReplyToMail == NULL) {$_sReplyToMail = $_sFromMail;}

		if ($_bHtml === NULL) {$_bHtml = $this->bSendMailDefaultHtml;}
		if ($_bText === NULL) {$_bText = $this->bSendMailDefaultText;}
		
		if ($this->bSendMailAutoDetectHtml == true)
		{
			if (preg_match("!(\<.*\>)(.*?)(\<\/.*\>)!im", $_sMessage) > 0) {$_bHtml = true;}
		}
		if ($_bHtml == false) {$_bText = true;}

        if ($this->oMailer !== NULL)
        {
            $this->oMailer->initTemplate(array('oTemplate' => $this->getTemplate()));
            return $this->oMailer->send(
                array(
                    'sMailFrom' => $_sFromMail,
                    'xToMail' => $_xToMail,
                    'sSubject' => $_sSubject,
                    'sMessage' => $_sMessage,
                    'bHtml' => $_bHtml,
                    'bText' => $_bText,
                    'xTemplate' => $_xTemplate
                )
            );
        }

		$this->sSendMailDetails = '';
		$_sLBR = "\r\n";
		$_sMimeBoundary = '------------'.md5(time());
		$_iNowTimeStamp = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
		// $_sMomentn = time().".";
		$_sMailBody = '';
		$_sAttachment = '';

		// Attachment from file...
		$_sAttachment = '';
		if ($_asAttachment != NULL)
		{
			for ($i=0; $i<count($_asAttachment); $i++)
			{
				if (is_array($_asAttachment[$i]))
				{
					$_sAttachmentPath = $_asAttachment[$i]['path'];
					$_sAttachmentName = $_asAttachment[$i]['name'];
				}
				else
				{
					$_sAttachmentPath = $_asAttachment[$i];
					$_sAttachmentName = '';
				}
			
				$_sAttachmentPath = str_replace("\\", '/', $_sAttachmentPath);
				if ($_oFp = fopen($_sAttachmentPath, "rb"))
				{
					$_sFileMime = $this->getFileMime($_sAttachmentPath);
					$_sFileContent = fread($_oFp, filesize($_sAttachmentPath));
					$_sFileContent = chunk_split(base64_encode($_sFileContent));   //Encode The Data For Transition using base64_encode(); 
					if ($_sAttachmentName == '') {$_sAttachmentName = strrchr($_sAttachmentPath, '/');}
					// $_sFileType = filetype($_sAttachmentPath);
					fclose($_oFp);
					
					$_sAttachment .= '--'.$_sMimeBoundary.$_sLBR;
					// $_sAttachment .= 'Content-Type: application/pdf; name="'.$_sAttachmentName.'"'.$_sLBR;
					$_sAttachment .= 'Content-Type: '.$_sFileMime.'; name="'.$_sAttachmentName.'"'.$_sLBR;
					$_sAttachment .= 'Content-Disposition: attachment; filename="'.$_sAttachmentName.'"; size='.filesize($_sAttachmentPath).';'.$_sLBR;
					$_sAttachment .= 'Content-Transfer-Encoding: base64'.$_sLBR.$_sLBR;
					$_sAttachment .= $_sFileContent.$_sLBR.$_sLBR;
				}
				else {$this->sSendMailDetails .= '<span class="warning">Fehler beim lesen des Anhangs!</span><br />';}
			}
		}
		
		// Attachments from mails...
		if ($_iAttachmentsFromMailID != NULL)
		{
			$_axAttachmentInfo = $this->getImapMailAttachmentInfo($_iAttachmentsFromMailID);
			for ($i=0; $i<count($_axAttachmentInfo); $i++)
			{
				$_sMailAttachment = $this->getImapMailAttachment($_iAttachmentsFromMailID, $_axAttachmentInfo[$i]);
				$_sMailAttachment = chunk_split(base64_encode($_sMailAttachment));
		
				$_sAttachment .= '--'.$_sMimeBoundary.$_sLBR;
				$_sAttachment .= 'Content-Type: '.$_axAttachmentInfo[$i]["MimeType"].'; name="'.$_axAttachmentInfo[$i]['Name'].'"'.$_sLBR;
				$_sAttachment .= 'Content-Transfer-Encoding: base64'.$_sLBR;
				$_sAttachment .= 'Content-Disposition: attachment; filename="'.$_axAttachmentInfo[$i]['Name'].'"'.$_sLBR.$_sLBR;
				$_sAttachment .= $_sMailAttachment.$_sLBR.$_sLBR;
			}
		}
		
		// Setup for text or html...
		if (($_bHtml == true) && ($_bText == true) && ($_sAttachment != ''))
		{
			$_sMailBody .= '--'.$_sMimeBoundary.$_sLBR;
			$_sMailBody .= 'Content-Type: multipart/alternative;'.$_sLBR.' boundary="'.$_sMimeBoundary.'"'.$_sLBR;
		}

		// text...
		if ($_bText == true)
		{
			if (($_asAttachment != NULL) || ($_iAttachmentsFromMailID != NULL)
			|| (($_bHtml == true) && ($_bText == true)))
			{
				$_sMailBody .= '--'.$_sMimeBoundary.$_sLBR;
				$_sMailBody .= "Content-Type: text/plain; charset=ISO-8859-15; format=flowed".$_sLBR;
				$_sMailBody .= "Content-Transfer-Encoding: 8bit".$_sLBR.$_sLBR;
			}
			
			$_sMailText = '';
			if ($this->sSendMailMessageHeader != '') {$_sMailText .= $this->sSendMailMessageHeader.$_sLBR;}
			$_sMailText .= $_sMessage;
			if ($this->sSendMailMessageFooter != '') {$_sMailText .= $_sLBR.$this->sSendMailMessageFooter;}
			// $_sMailBody .= chunk_split($oPGStrings->removeHTML($oPGStrings->htmlToText($_sMessage)), 76, "\n").$_sLBR.$_sLBR;
			// $_sMailBody .= chunk_split(stripslashes($oPGStrings->removeHTML($oPGStrings->htmlToText($_sMessage))), 76).$_sLBR.$_sLBR;
			$_sMailBody .= stripslashes($oPGStrings->removeHTML($oPGStrings->htmlToText($_sMailText))).$_sLBR.$_sLBR;
			
			// $_sMailBody .= stripslashes($oPGStrings->removeHTML($oPGStrings->htmlToText($_sMessage))).$_sLBR.$_sLBR;
		}
		
		// html...
		if ($_bHtml == true)
		{
			if (($_asAttachment != NULL) || ($_iAttachmentsFromMailID != NULL)
			|| (($_bHtml == true) && ($_bText == true)))
			{
				$_sMailBody .= '--'.$_sMimeBoundary.$_sLBR;
				// $_sMailBody .= "Content-Type: text/html; charset=ISO-8859-1".$_sLBR;
				$_sMailBody .= "Content-Type: text/html; charset=ISO-8859-15".$_sLBR;
				$_sMailBody .= "Content-Transfer-Encoding: 8bit".$_sLBR.$_sLBR;
				// $_sMailBody .= "Content-Transfer-Encoding: base64".$_sLBR.$_sLBR;
				// $_sMailBody .= chunk_split(base64_encode(stripslashes("<html>".$_sMessage."</html>"))).$_sLBR.$_sLBR;
			}
			
			$_sMailHTML2 = $_sMessage;
			if ($this->bSendMailConvertLineBreaks == true) {$_sMailHTML2 = str_replace("\n", '<br />', str_replace($_sLBR, '<br />', $_sMailHTML2));}
			if ($this->bSendMailGenerateHTML == true)
			{
				$_sMailHTML = '';
				$_sMailHTML .= '<html>';
					$_sMailHTML .= '<head>';
						$_sMailHTML .= '<title>'.$_sSubject.'</title>';
						// $_sMailHTML .= '<meta http-equiv="content-type" content="text/html; charset=ISO-8859-15">';
						$_sMailHTML .= '<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">';
						if ($this->sSendMailCssStyle != '') {$_sMailHTML .= '<style type="text/css">'.$this->sSendMailCssStyle.'</style>';}
					$_sMailHTML .= '</head>';
					$_sMailHTML .= '<body>';
						if ($this->sSendMailMessageHeader != '') {$_sMailHTML .= $this->sSendMailMessageHeader;}
						$_sMailHTML .= $_sMailHTML2;
						if ($this->sSendMailMessageFooter != '') {$_sMailHTML .= $this->sSendMailMessageFooter;}
					$_sMailHTML .= '</body>';
				$_sMailHTML .= '</html>';
			}
			else {$_sMailHTML = '<html>'.$_sMailHTML2.'</html>';}
			
			// $_sMailBody .= chunk_split(base64_encode(stripslashes("<html>".str_replace('>', '>'.$_sLBR, $_sMessage)."</html>")), 76).$_sLBR.$_sLBR;
			//$_sMailBody .= chunk_split(imap_binary(stripslashes("<html>".str_replace('>', '>'.$_sLBR, $_sMessage)."</html>")), 76).$_sLBR.$_sLBR;
			$_sMailBody .= stripslashes(str_replace('>', '>'.$_sLBR, $_sMailHTML)).$_sLBR.$_sLBR;
		}

		$_sMailBody .= $_sAttachment;
		
		if (($_asAttachment != NULL) || ($_iAttachmentsFromMailID != NULL)
		|| (($_bHtml == true) && ($_bText == true)))
		{
			$_sMailBody .= '--'.$_sMimeBoundary."--".$_sLBR.$_sLBR;
		}
		
		// Headers...
		$_sToMail = NULL;
		$_bAttachment = false;
		if ($_sAttachment != '') {$_bAttachment = true;}
		$_sHeaders = NULL;
		
		if ($this->isDebugMode(PG_DEBUG_HIGH))
		{
			$this->addDebugString('Mail-Debug');
			$this->addDebugString('Mail-Headers');
			$this->addDebugString($_sHeaders);
			$this->addDebugString('Mail-Subject: '.$_sSubject);
			$this->addDebugString('Mail-Body');
			$this->addDebugString($_sMailBody);
		}
		
		$_asToMail = array();
		if (is_array($_xToMail)) {$_asToMail = $_xToMail;}
		else if (is_string($_xToMail))
		{
			$_xToMail = str_replace(',', ';', $_xToMail);
			$_asToMail = explode(';', $_xToMail);
		}
		
		ini_set('sendmail_from', $_sFromMail);
		$_bAllSendOk = true;
		for ($i=0; $i<count($_asToMail); $i++)
		{
			$_axResult = $this->sendMail(
				array(
					'sFromMail' => $_sFromMail,
					'sToMail' => trim($_asToMail[$i]),
					'sReplyToMail' => $_sReplyToMail,
					'asCcMail' => $_asCcMail,
					'sSubject' => $_sSubject,
					'sMailBody' => $_sMailBody,
					'sHeaders' => $_sHeaders,
					'sServer' => $_sServer, 
					'sPort' => $_sPort, 
					'sUser' => $_sUser, 
					'sPassword' => $_sPassword,
					'bHtml' => $_bHtml,
					'bText' => $_bText,
					'bAttachment' => $_bAttachment,
					'bUseStartTls' => $_bUseStartTls
				)
			);
			if ($_axResult['bAllOk'] == false) {$_bAllSendOk = false;}
		}

		return $_bAllSendOk;
	}
	/* @end method */
}
/* @end class */
$oPGMail = new classPG_Mail();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGMail', 'xValue' => $oPGMail));}
?>