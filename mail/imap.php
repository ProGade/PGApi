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
if (defined('SORTARRIVAL')) {define('PG_IMAP_ORDER_BY_SEND_DATE', SORTARRIVAL);}
if (defined('SORTFROM')) {define('PG_IMAP_ORDER_BY_FROM_MAIL', SORTFROM);}
if (defined('SORTSUBJECT')) {define('PG_IMAP_ORDER_BY_SUBJECT', SORTSUBJECT);}
if (defined('SORTTO')) {define('PG_IMAP_ORDER_BY_TO_MAIL', SORTTO);}
if (defined('SORTSIZE')) {define('PG_IMAP_ORDER_BY_SIZE', SORTSIZE);}
if (defined('SORTDATE')) {define('PG_IMAP_ORDER_BY_RECEIVE_DATE', SORTDATE);}

define('PG_IMAP_CRYPTION_TEXT', 1);
define('PG_IMAP_CRYPTION_HTML', 2);
define('PG_IMAP_CRYPTION_UTF8_TEXT', 3);
define('PG_IMAP_CRYPTION_UTF8_HTML', 4);

define('PG_IMAP_MIME_TYPE_7BIT', 1);
define('PG_IMAP_MIME_TYPE_8BIT', 2);
define('PG_IMAP_MIME_TYPE_BINARY', 3);
define('PG_IMAP_MIME_TYPE_BASE64', 4);
define('PG_IMAP_MIME_TYPE_QPRINT', 5);
define('PG_IMAP_MIME_TYPE_OTHER', 6);

define('PG_IMAP_ATTACHMENT_INFO_INDEX_ID', 'ID');
define('PG_IMAP_ATTACHMENT_INFO_INDEX_PART_NR', 'PartNr');
define('PG_IMAP_ATTACHMENT_INFO_INDEX_NAME', 'Name');
define('PG_IMAP_ATTACHMENT_INFO_INDEX_SIZE', 'Size');
define('PG_IMAP_ATTACHMENT_INFO_INDEX_MIME_TYPE', 'MimeType');
define('PG_IMAP_ATTACHMENT_INFO_INDEX_MIME_SUBTYPE', 'MimeSubType');
define('PG_IMAP_ATTACHMENT_INFO_INDEX_ENCODING', 'Encoding');

define('PG_IMAP_CID_IMAGE_INDEX_ID', 'ID');
define('PG_IMAP_CID_IMAGE_INDEX_PART_NR', 'PartNr');
define('PG_IMAP_CID_IMAGE_INDEX_NAME', 'Name');
define('PG_IMAP_CID_IMAGE_INDEX_SIZE', 'Size');
define('PG_IMAP_CID_IMAGE_INDEX_MIME_TYPE', 'MimeType');
define('PG_IMAP_CID_IMAGE_INDEX_MIME_SUBTYPE', 'MimeSubType');
define('PG_IMAP_CID_IMAGE_INDEX_ENCODING', 'Encoding');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Imap extends classPG_ClassBasics
{
	// Declarations...
	private $sImapUsername = '';
	private $sImapPassword = '';
	private $sImapHost = '';
	private $sImapFolder = '';
	private $sImapAccountType = '';
	private $sImapPort = '';
	private $sImapMailBoxString = '';
	private $sImapDelimiter = '/';
	private $oImapMailBox = NULL;
	private $bImapUseValidation = false;
	private $bImapUseSSL = false;
	
	private $asMimeTypePart = array('TEXT', 'MULTIPART', 'MESSAGE', 'APPLICATION', 'AUDIO', 'IMAGE', 'VIDEO', 'OTHER');

	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@param sUsername [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapUsername($_sUsername)
	{
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));
		$this->sImapUsername = $_sUsername;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sImapUsername [type]string[/type]
	[en]...[/en]
	*/
	public function getImapUsername() {return $this->sImapUsername;}
	/* @end method */
	
	/*
	@start method
	
	@param sPassword [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapPassword($_sPassword)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sPassword, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$this->sImapPassword = $_sPassword;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sImapPassword [type]string[/type]
	[en]...[/en]
	*/
	public function getImapPassword() {return $this->sImapPassword;}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sUsername [needed][type]string[/type]
	[en]...[/en]
	
	@param sPassword [needed][type]string[/type]
	[en]...[/en]
	
	@param sHost [needed][type]string[/type]
	[en]...[/en]
	
	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	
	@param sAccountType [needed][type]string[/type]
	[en]...[/en]
	
	@param sPort [needed][type]string[/type]
	[en]...[/en]
	
	@param bUseValidation [needed][type]bool[/type]
	[en]...[/en]
	
	@param bUseSSL [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function imapConnect($_sUsername = NULL, $_sPassword = NULL, $_sHost = NULL, $_sFolder = NULL, $_sAccountType = NULL, $_sPort = NULL, $_bUseValidation = NULL, $_bUseSSL = NULL)
	{
		$_sPassword = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sHost = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sHost', 'xParameter' => $_sHost));
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sFolder', 'xParameter' => $_sFolder));
		$_sAccountType = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sAccountType', 'xParameter' => $_sAccountType));
		$_sPort = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sPort', 'xParameter' => $_sPort));
		$_bUseValidation = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'bUseValidation', 'xParameter' => $_bUseValidation));
		$_bUseSSL = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'bUseSSL', 'xParameter' => $_bUseSSL));
		$_sUsername = $this->getRealParameter(array('oParameters' => $_sUsername, 'sName' => 'sUsername', 'xParameter' => $_sUsername));

		$this->imapGenerateMailBoxString(array('sHost' => $_sHost, 'sFolder' => $_sFolder, 'sAccountType' => $_sAccountType, 'sPort' => $_sPort, 'bUseValidation' => $_bUseValidation, 'bUseSSL' => $_bUseSSL));
		if ($_sUsername != NULL) {$this->setImapUsername(array('sUsername' => $_sUsername));}
		if ($_sPassword != NULL) {$this->setImapPassword(array('sPassword' => $_sPassword));}
		if ($this->oImapMailBox = imap_open($this->sImapMailBoxString, $this->sImapUsername, $this->sImapPassword)) {return true;}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	*/
	public function imapDisconnect() {return imap_close($this->oImapMailBox);}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sMailBoxString [needed][type]string[/type
	[en]...[/en]
	*/
	public function imapChangeMailBox($_sMailBoxString)
	{
		$_sMailBoxString = $this->getRealParameter(array('oParameters' => $_sMailBoxString, 'sName' => 'sMailBoxString', 'xParameter' => $_sMailBoxString));
		return imap_reopen($this->oImapMailBox, $_sMailBoxString);
	}
	/* @end method */
	
	/*
	@start method
	
	@param sDelimiter [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapDelimiter($_sDelimiter)
	{
		$_sDelimiter = $this->getRealParameter(array('oParameters' => $_sDelimiter, 'sName' => 'sDelimiter', 'xParameter' => $_sDelimiter));
		$this->sImapDelimiter = $_sDelimiter;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sDelimiter [type]string[/type]
	[en]...[/en]
	*/
	public function getImapDelimiter() {return $this->sImapDelimiter;}
	/* @end method */
	
	/*
	@start method
	
	@param sHost [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapHost($_sHost)
	{
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));
		$this->sImapHost = $_sHost;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHost [type]string[/type]
	[en]...[/en]
	*/
	public function getImapHost() {return $this->sImapHost;}
	/* @end method */
	
	/*
	@start method
	
	@param sFolder [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapFolder($_sFolder)
	{
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sFolder, 'sName' => 'sFolder', 'xParameter' => $_sFolder));
		$this->sImapFolder = $_sFolder;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sFolder [type]string[/type]
	[en]...[/en]
	*/
	public function getImapFolder() {return $this->sImapFolder;}
	/* @end method */
	
	/*
	@start method
	
	@param sAccountType [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapAccountType($_sAccountType)
	{
		$_sAccountType = $this->getRealParameter(array('oParameters' => $_sAccountType, 'sName' => 'sAccountType', 'xParameter' => $_sAccountType));
		$this->sImapAccountType = $_sAccountType;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sAccountType [type]string[/type]
	[en]...[/en]
	*/
	public function getImapAccountType() {return $this->sImapAccountType;}
	/* @end method */
	
	/*
	@start method
	
	@param sPort [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setImapPort($_sPort)
	{
		$_sPort = $this->getRealParameter(array('oParameters' => $_sPort, 'sName' => 'sPort', 'xParameter' => $_sPort));
		$this->sImapPort = $_sPort;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sPort [type]string[/type]
	[en]...[/en]
	*/
	public function getImapPort() {return $this->sImapPort;}

	/*
	@start method
	
	@param bUseValidation [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useImapValidation($_bUseValidation)
	{
		$_bUseValidation = $this->getRealParameter(array('oParameters' => $_bUseValidation, 'sName' => 'bUseValidation', 'xParameter' => $_bUseValidation));
		$this->bImapUseValidation = $_bUseValidation;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUseValidation [type]bool[/type]
	[en]...[/en]
	*/
	public function isImapValidationUsed() {return $this->bImapUseValidation;}
	/* @end method */

	/*
	@start method
	
	@param bUseSSL [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function useImapSSL($_bUseSSL)
	{
		$_bUseSSL = $this->getRealParameter(array('oParameters' => $_bUseSSL, 'sName' => 'bUseSSL', 'xParameter' => $_bUseSSL));
		$this->bImapUseSSL = $_bUseSSL;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bUseSSL [type]bool[/type]
	[en]...[/en]
	*/
	public function isImapSSLUsed() {return $this->bImapUseSSL;}
	/* @end method */
	
	/*
	@start method
	
	@param sHost [type]string[/type]
	[en]...[/en]
	
	@param sFolder [type]string[/type]
	[en]...[/en]
	
	@param sAccountType [type]string[/type]
	[en]...[/en]
	
	@param sPort [type]string[/type]
	[en]...[/en]
	
	@param bUseValidation [type]string[/type]
	[en]...[/en]
	
	@param bUseSSL [type]string[/type]
	[en]...[/en]
	*/
	public function imapGenerateMailBoxString($_sHost = NULL, $_sFolder = NULL, $_sAccountType = NULL, $_sPort = NULL, $_bUseValidation = NULL, $_bUseSSL = NULL)
	{
		$_sFolder = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sFolder', 'xParameter' => $_sFolder));
		$_sAccountType = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sAccountType', 'xParameter' => $_sAccountType));
		$_sPort = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sPort', 'xParameter' => $_sPort));
		$_bUseValidation = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'bUseValidation', 'xParameter' => $_bUseValidation));
		$_bUseSSL = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'bUseSSL', 'xParameter' => $_bUseSSL));
		$_sHost = $this->getRealParameter(array('oParameters' => $_sHost, 'sName' => 'sHost', 'xParameter' => $_sHost));

		if ($_sHost != NULL) {$this->setImapHost($_sHost);}
		if ($_sFolder != NULL) {$this->setImapFolder($_sFolder);}
		if ($_sAccountType != NULL) {$this->setImapAccountType(array('sAccountType' => $_sAccountType));}
		if ($_sPort != NULL) {$this->setImapPort(array('sPort' => $_sPort));}
		if ($_bUseValidation != NULL) {$this->useImapValidation(array('bUseValidation' => $_bUseValidation));}
		if ($_bUseSSL != NULL) {$this->useImapSSL(array('bUseSSL' => $_bUseSSL));}
	
		$this->sImapMailBoxString = '{'.trim($this->sImapHost);
		
		// Port...
		if ($this->sImapPort != '') {$this->sImapMailBoxString .= ':'.$this->sImapPort;}
		else if ($this->sImapAccountType != '')
		{
			if ($this->sImapAccountType == 'IMAP') {$this->sImapMailBoxString .= ':143';}
			else if ($this->sImapAccountType == 'POP3') {$this->sImapMailBoxString .= ':110';}
			else if ($this->sImapAccountType == 'NNTP') {$this->sImapMailBoxString .= ':119';}
		}
		else {$this->sImapMailBoxString .= ':110';}
		
		// Account type...
		if ($this->sImapAccountType != '')
		{
			if ($this->sImapAccountType == 'IMAP') {$this->sImapMailBoxString .= $this->sImapDelimiter.'imap';}
			else if ($this->sImapAccountType == 'POP3') {$this->sImapMailBoxString .= $this->sImapDelimiter.'pop3';}
			else if ($this->sImapAccountType == 'NNTP') {$this->sImapMailBoxString .= $this->sImapDelimiter.'nntp';}
			else {$this->sImapMailBoxString .= $this->sImapDelimiter.strtolower($this->sImapAccountType);}
		}
		else {$this->sImapMailBoxString .= $this->sImapDelimiter.'pop3';}

		if ($this->bImapUseSSL == true) {$this->sImapMailBoxString .= $this->sImapDelimiter.'ssl';}
		if ($this->bImapUseValidation == false) {$this->sImapMailBoxString .= $this->sImapDelimiter.'novalidate-cert';}
		
		$this->sImapMailBoxString .= '}';
		if ($this->sImapFolder != '') {$this->sImapMailBoxString .= $this->sImapFolder;}
	}
	/* @end method */
	
	/*
	@start method
	
	@return sMailBoxString [type]string[/type]
	[en]...[/en]
	
	@param asFolder [type]string[][/type]
	[en]...[/en]
	*/
	public function getImapMailBoxString($_asFolder = NULL)
	{
		$_asFolder = $this->getRealParameter(array('oParameters' => $_asFolder, 'sName' => 'asFolder', 'xParameter' => $_asFolder, 'bNotNull' => true));

		$_sPath = '';
		if ($_asFolder !== NULL)
		{
			for ($i=0; $i<count($_asFolder); $i++)
			{
				$_asFolder[$i] = str_replace($this->sImapDelimiter, '', $_asFolder[$i]);
				if ($i>0) {$_sPath .= $this->sImapDelimiter;}
				$_sPath .= $_asFolder[$i];
			}
			if (($_sPath != '') && ($this->sImapFolder != '')) {$_sPath = $this->sImapDelimiter.$_sPath;}
		}
		return $this->sImapMailBoxString.$_sPath;
	}
	/* @end method */

	// Imap encoding und decoding...
	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [type]string[/type]
	[en]...[/en]
	*/
	public function imapUTF7SpecialChars($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));
		
		$_sString = str_replace("ä", "&AOQ-", $_sString);
		$_sString = str_replace("ö", "&APY-", $_sString);
		$_sString = str_replace("ü", "&APw-", $_sString);
		$_sString = str_replace("Ä", "&AMQ-", $_sString);
		$_sString = str_replace("Ö", "&ANY-", $_sString);
		$_sString = str_replace("Ü", "&ANw-", $_sString);
		$_sString = str_replace("ß", "&AN8-", $_sString);
		
		return $_sString;
	}
	/* @end method */

	/*
	@start method
	
	@return sString [type]string[/type]
	[en]...[/en]
	
	@param sString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function imapDecodeISO($_sString)
	{
		$_sString = $this->getRealParameter(array('oParameters' => $_sString, 'sName' => 'sString', 'xParameter' => $_sString));

		// =?big5?B?
		// if(ereg("=\?.{0,}\?[Bb]\?", $_sString))
		if(preg_match("/=\?.{0,}\?[Bb]\?/is", $_sString))
		{
			$_aString = split("=\?.{0,}\?[Bb]\?", $_sString);
			while(list($_sKey, $_sValue) = each($_aString))
			{
				// if(ereg("\?=", $_sValue))
				if(preg_match("/\?=/is", $_sValue))
				{
					$_aTemp = split("\?=", $_sValue);
					$_aTemp[0] = base64_decode($_aTemp[0]);
					$_aString[$_sKey] = join("", $_aTemp);
				}
			}
			$_sString = join('', $_aString);
		}
		
		// =?iso-8859-1?Q?
		$_aString = imap_mime_header_decode($_sString);
		$_sString = '';
		for ($i=0; $i<count($_aString); $i++)
		{
			$_sString .= $_aString[$i]->text;
		}
		/*if(ereg("=\?.{0,}\?Q\?", $_sString))
		{
			$_sString = quoted_printable_decode($_sString);
			$_sString = ereg_replace("=\?.{0,}\?[Qq]\?", "", $_sString);
			$_sString = ereg_replace("\?=", "", $_sString);
		}*/
	
		return $_sString;
	}
	/* @end method */
		
	// Imap mail methods...
	/*
	@start method
	
	@return iCount [type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailCount() {return imap_num_msg($this->oImapMailBox);}
	/* @end method */

	/*
	@start method
	
	@return iCount [type]int[/type]
	[en]...[/en]
	*/
	public function getImapNewMailCount() {return imap_num_recent($this->oImapMailBox);}
	/* @end method */
	
	/*
	@start method
	
	@return axMails [type]mixed[][/type]
	[en]...[/en]
	
	@param sFrom [type]string[/type]
	[en]...[/en]
	
	@param sTo [type]string[/type]
	[en]...[/en]
	
	@param sSubject [type]string[/type]
	[en]...[/en]
	*/
	public function getImapMailsSearch($_sFrom, $_sTo = NULL, $_sSubject = NULL)
	{
		$_sTo = $this->getRealParameter(array('oParameters' => $_sFrom, 'sName' => 'sTo', 'xParameter' => $_sTo));
		$_sSubject = $this->getRealParameter(array('oParameters' => $_sFrom, 'sName' => 'sSubject', 'xParameter' => $_sSubject));
		$_sFrom = $this->getRealParameter(array('oParameters' => $_sFrom, 'sName' => 'sFrom', 'xParameter' => $_sFrom));

		$_bSpace = false;
		$_sSearchString = 'ALL';
		
		if ($_sFrom != NULL) {$_sSearchString .= ' FROM "'.$_sFrom.'"';}
		if ($_sTo != NULL) {$_sSearchString .= ' TO "'.$_sTo.'"';}
		if ($_sSubject != NULL) {$_sSearchString .= ' SUBJECT "'.$_sSubject.'"';}
		
		$_aiMailNr = imap_search($this->oImapMailBox, $_sSearchString);
		for ($i=count($_aiMailNr)-1; $i>=0; $i--)
		{
			$_axMail[$_iCurrentMailNr] = $this->getImapMailInfo(array('iMailNr' => $_aiMailNr[$i]));
			$_iCurrentMailNr++;
		}
		return $_axMail;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axMails [type]mixed[][/type]
	[en]...[/en]
	
	@param iStartMailNr [needed][type]int[/type]
	[en]...[/en]
	
	@param iMailCount [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getImapMails($_iStartMailNr, $_iMailCount = NULL)
	{
		$_iMailCount = $this->getRealParameter(array('oParameters' => $_iStartMailNr, 'sName' => 'iMailCount', 'xParameter' => $_iMailCount));
		$_iStartMailNr = $this->getRealParameter(array('oParameters' => $_iStartMailNr, 'sName' => 'iStartMailNr', 'xParameter' => $_iStartMailNr));

		$_axMail = array();
		$_iCurrentMailNr = 0;
		for ($i=$_iStartMailNr; $i>$_iStartMailNr-$_iMailCount; $i--)
		{
			$_axMail[$_iCurrentMailNr] = $this->getImapMailInfo(array('iMailNr' => $i));
			$_iCurrentMailNr++;
		}
		return $_axMail;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axMail [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailNr [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailInfo($_iMailNr)
	{
		$_iMailNr = $this->getRealParameter(array('oParameters' => $_iMailNr, 'sName' => 'iMailNr', 'xParameter' => $_iMailNr));

		$_axMail = array();
		$_oMailHeader = imap_header($this->oImapMailBox, $_iMailNr, 255, 255);
		if ($_oMailHeader)
		{
			$_iMailID = imap_uid($this->oImapMailBox, $_iMailNr);
			$_axMail['ID'] = $_iMailID;
			$_axMail['Subject'] = $this->imapDecodeISO(array('sString' => $_oMailHeader->fetchsubject));
			$_axMail['TimeStamp'] = strtotime($_oMailHeader->Date);
			
			// From Mail...
			$_axMail['FromMail'] = $this->imapDecodeISO(array('sString' => $_oMailHeader->from[0]->mailbox)).'@'.$this->imapDecodeISO(array('sString' => $_oMailHeader->from[0]->host));
			
			// Attachments...
			$_axMail['Attachment'] = $this->getImapMailAttachmentInfo(array('iMailID' => $_iMailID));

			// Flags...
			if (trim(strtoupper($_oMailHeader->Answered)) == 'A') {$_axMail['Answered'] = true;} else {$_axMail['Answered'] = false;}
			if (trim(strtoupper($_oMailHeader->Deleted)) == 'D') {$_axMail['Deleted'] = true;} else {$_axMail['Deleted'] = false;}
			if (trim(strtoupper($_oMailHeader->Flagged)) == 'F') {$_axMail['Flagged'] = true;} else {$_axMail['Flagged'] = false;}
			if ((trim(strtoupper($_oMailHeader->Unseen)) == 'U') || (trim(strtoupper($_oMailHeader->Recent)) == 'N')) {$_axMail['Unread'] = true;}
			else {$_axMail['Unread'] = false;}
		}
		return $_axMail;
	}
	/* @end method */
	
	/*
	@start method
	
	@return axMailHeaderInfo [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailHeaderInfo($_iMailID)
	{
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_axMailHeaderInfo = array();
		$_oMailHeader = imap_header($this->oImapMailBox, imap_msgno($this->oImapMailBox, $_iMailID), 255, 255);
		if ($_oMailHeader)
		{
			$_axMailHeaderInfo['Subject'] = $this->imapDecodeISO(array('sString' => $_oMailHeader->fetchsubject));
			$_axMailHeaderInfo['TimeStamp'] = strtotime($_oMailHeader->Date);

			// Attachments...
			$_axMailHeaderInfo['Attachment'] = $this->getImapMailAttachmentInfo(array('iMailID' => $_iMailID));
			
			// from...
			for ($i=0; $i<count($_oMailHeader->from); $i++)
			{
				$_sFromMail = '';
				$_sFromName = '';
				if (trim($_oMailHeader->from[$i]->personal) != '') {$_sFromName .= trim($this->imapDecodeISO(array('sString' => $_oMailHeader->from[$i]->personal)));}
				if ((trim($_oMailHeader->from[$i]->personal) != '') && (trim($_oMailHeader->from[$i]->mailbox) != '')) {$_sFromName .= ' [';}
				if (trim($_oMailHeader->from[$i]->mailbox) != '')
				{
					$_sFromMail = trim($this->imapDecodeISO(array('sString' => $_oMailHeader->from[$i]->mailbox))).'@'.trim($this->imapDecodeISO(array('sString' => $_oMailHeader->from[$i]->host)));
					$_sFromName .= $_sFromMail;
				}
				if ((trim($_oMailHeader->from[$i]->personal) != '') && (trim($_oMailHeader->from[$i]->mailbox) != '')) {$_sFromName .= ']';}
				if ((trim($_oMailHeader->from[$i]->personal) == '') && (trim($_oMailHeader->from[$i]->mailbox) == '')) {$_sFromName = 'unknown';}
				$_axMailHeaderInfo['From'][$i] = $_sFromName;
				$_axMailHeaderInfo['FromMail'][$i] = $_sFromMail;
			}
			
			// reply to...
			for ($i=0; $i<count($_oMailHeader->reply_to); $i++)
			{
				$_sReplyToMail = '';
				$_sReplyToName = '';
				if (trim($_oMailHeader->reply_to[$i]->personal) != '') {$_sReplyToName .= trim($this->imapDecodeISO($_oMailHeader->reply_to[$i]->personal));}
				if ((trim($_oMailHeader->reply_to[$i]->personal) != '') && (trim($_oMailHeader->reply_to[$i]->mailbox) != '')) {$_sReplyToName .= ' [';}
				if (trim($_oMailHeader->reply_to[$i]->mailbox) != '')
				{
					$_sReplyToMail = trim($this->imapDecodeISO(array('sString' => $_oMailHeader->reply_to[$i]->mailbox))).'@'.trim($this->imapDecodeISO(array('sString' => $_oMailHeader->reply_to[$i]->host)));
					$_sReplyToName .= $_sReplyToMail;
				}
				if ((trim($_oMailHeader->reply_to[$i]->personal) != '') && (trim($_oMailHeader->reply_to[$i]->mailbox) != '')) {$_sReplyToName .= ']';}
				if ((trim($_oMailHeader->reply_to[$i]->personal) == '') && (trim($_oMailHeader->reply_to[$i]->mailbox) == '')) {$_sReplyToName .= 'unknown';}
				$_axMailHeaderInfo['ReplyTo'][$i] = $_sFromName;
				$_axMailHeaderInfo['ReplyToMail'][$i] = $_sFromMail;
			}
			
			// to...
			for ($i=0; $i<count($_oMailHeader->to); $i++)
			{
				$_sToMail = '';
				$_sToName = '';
				if (trim($_oMailHeader->to[$i]->personal) != '') {$_sToName .= trim($this->imapDecodeISO(array('sString' => $_oMailHeader->to[$i]->personal)));}
				if ((trim($_oMailHeader->to[$i]->personal) != '') && (trim($_oMailHeader->to[$i]->mailbox) != '')) {$_sToName .= ' [';}
				if (trim($_oMailHeader->to[$i]->mailbox) != '')
				{
					$_sToMail = trim($this->imapDecodeISO(array('sString' => $_oMailHeader->to[$i]->mailbox))).'@'.trim($this->imapDecodeISO(array('sString' => $_oMailHeader->to[$i]->host)));
					$_sToName .= $_sToMail;
				}
				if ((trim($_oMailHeader->to[$i]->personal) != '') && (trim($_oMailHeader->to[$i]->mailbox) != '')) {$_sToName .= ']';}
				if ((trim($_oMailHeader->to[$i]->personal) == '') && (trim($_oMailHeader->to[$i]->mailbox) == '')) {$_sToName .= 'unknown';}
				$_axMailHeaderInfo['To'][$i] = $_sToName;
				$_axMailHeaderInfo['ToMail'][$i] = $_sToMail;
			}
			
			// cc...
			for ($i=0; $i<count($_oMailHeader->cc); $i++)
			{
				$_sCCMail = '';
				$_sCCName = '';
				if (trim($_oMailHeader->cc[$i]->personal) != '') {$_sCCName .= trim($this->imapDecodeISO(array('sString' => $_oMailHeader->cc[$i]->personal)));}
				if ((trim($_oMailHeader->cc[$i]->personal) != '') && (trim($_oMailHeader->cc[$i]->mailbox) != '')) {$_sCCName .= ' [';}
				if (trim($_oMailHeader->cc[$i]->mailbox) != '')
				{
					$_sCCMail = trim($this->imapDecodeISO(array('sString' => $_oMailHeader->cc[$i]->mailbox))).'@'.trim($this->imapDecodeISO(array('sString' => $_oMailHeader->cc[$i]->host)));
					$_sCCName .= $_sCCMail;
				}
				if ((trim($_oMailHeader->cc[$i]->personal) != '') && (trim($_oMailHeader->cc[$i]->mailbox) != '')) {$_sCCName .= ']';}
				if ((trim($_oMailHeader->cc[$i]->personal) == '') && (trim($_oMailHeader->cc[$i]->mailbox) == '')) {$_sCCName .= 'unknown';}
				$_axMailHeaderInfo['CC'][$i] = $_sCCName;
				$_axMailHeaderInfo['CCMail'][$i] = $_sCCMail;
			}

			// flags...
			if (trim(strtoupper($_oMailHeader->Answered)) == 'A') {$_axMailHeaderInfo['Answered'] = true;} else {$_axMailHeaderInfo['Answered'] = false;}
			if (trim(strtoupper($_oMailHeader->Deleted)) == 'D') {$_axMailHeaderInfo['Deleted'] = true;} else {$_axMailHeaderInfo['Deleted'] = false;}
			if (trim(strtoupper($_oMailHeader->Flagged)) == 'F') {$_axMailHeaderInfo['Flagged'] = true;} else {$_axMailHeaderInfo['Flagged'] = false;}
			if ((trim(strtoupper($_oMailHeader->Unseen)) == 'U') || (trim(strtoupper($_oMailHeader->Recent)) == 'N')) {$_axMailHeaderInfo['Unread'] = true;}
			else {$_axMailHeaderInfo['Unread'] = false;}
		}
		return $_axMailHeaderInfo;
	}
	/* @end method */

	/*
	@start method
	
	@return aiSortedMailNumbers [type]int[][/type]
	[en]...[/en]
	
	@param sSortBy [needed][type]string[/type]
	[en]...[/en]
	
	@param bOrderReverse [needed][type]bool[/type]
	[en]...[/en]
	*/
	public function imapMailOrderSort($_sSortBy, $_bOrderReverse = NULL)
	{
		$_bOrderReverse = $this->getRealParameter(array('oParameters' => $_sSortBy, 'sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_sSortBy = $this->getRealParameter(array('oParameters' => $_sSortBy, 'sName' => 'sSortBy', 'xParameter' => $_sSortBy));

		if (($_sSortBy == NULL) || ($_sSortBy == '')) {$_sSortBy = PG_IMAP_ORDER_BY_RECEIVE_DATE;}
		if ($_bOrderReverse == true) {$_iOrderReverse = 1;} else {$_iOrderReverse = 0;}
		return imap_sort($this->oImapMailBox, $_sSortBy, $_iOrderReverse); //, int options);
	}
	/* @end method */

	/*
	@start method
	
	@return sMimeType [type]string[/type]
	[en]...[/en]
	
	@param oStructure [needed][type]object[/type]
	[en]...[/en]
	*/
	public function getImapMimeTypeFromStructure($_oStructure)
	{
		$_oStructure = $this->getRealParameter(array('oParameters' => $_oStructure, 'sName' => 'oStructure', 'xParameter' => $_oStructure));

		if ((isset($_oStructure->type)) && (isset($_oStructure->subtype)))
		{
			$_sMimeType = strtoupper($this->asMimeTypePart[(int)$_oStructure->type].'/'.$_oStructure->subtype);
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMimeTypeFromStructure: Get mime type '.$_sMimeType.' from structure.'));}
			return $_sMimeType;
		}
		/*else if (isset($_oStructure->type))
		{
			$_sMimeType = strtoupper($this->asMimeTypePart[(int)$_oStructure->type]);
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMimeTypeFromStructure: Get mime type '.$_sMimeType.' from structure.'));}
			return $_sMimeType;
		}*/
		if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMimeTypeFromStructure: No mime type found, set to default mime type TEXT/PLAIN.'));}
		return 'TEXT/PLAIN';
		// return false;
	}
	/* @end method */

	/*
	@start method
	
	@return sMailPart [type]string[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sGetPartMimeType [type]string[/type]
	[en]...[/en]
	
	@param iForceMimeType [type]int[/type]
	[en]...[/en]
	
	@param iPartNr [type]int[/type]
	[en]...[/en]
	
	@param oStructure [type]object[/type]
	[en]...[/en]
	*/
	public function getImapMailPart($_iMailID, $_sGetPartMimeType = NULL, $_iForceMimeType = NULL, $_iPartNr = NULL, $_oStructure = NULL)
	{
		$_sGetPartMimeType = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sGetPartMimeType', 'xParameter' => $_sGetPartMimeType));
		$_iForceMimeType = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iForceMimeType', 'xParameter' => $_iForceMimeType));
		$_iPartNr = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iPartNr', 'xParameter' => $_iPartNr));
		$_oStructure = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'oStructure', 'xParameter' => $_oStructure));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		if (!$_oStructure) {$_oStructure = imap_fetchstructure($this->oImapMailBox, $_iMailID, FT_UID);}
		if ($_oStructure)
		{
			if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMailPart: _sGetPartMimeType = '.$_sGetPartMimeType));}
			if ($_sGetPartMimeType == $this->getImapMimeTypeFromStructure(array('oStructure' => $_oStructure)))
			{
				if(!$_iPartNr)
				{
					if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMailPart: _iPartNr is '.$_iPartNr.' changed to 1'));}
					$_iPartNr = 1;
				}
				else {if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMailPart: _iPartNr = '.$_iPartNr));}}
				$_sReturn = imap_fetchbody($this->oImapMailBox, $_iMailID, $_iPartNr, FT_UID);
	
				if ($_iForceMimeType < 1) {$_iForceMimeType = $_oStructure->encoding+1;}
	
				// if ($structure->encoding == 0) {return imap_7bit($text);}
				if ($_iForceMimeType == PG_IMAP_MIME_TYPE_7BIT) {return $_sReturn;}
				elseif ($_iForceMimeType == PG_IMAP_MIME_TYPE_8BIT) {return $_sReturn;}
				elseif ($_iForceMimeType == PG_IMAP_MIME_TYPE_BINARY) {return imap_binary($_sReturn);}
				elseif ($_iForceMimeType == PG_IMAP_MIME_TYPE_BASE64) {return imap_base64($_sReturn);}
				elseif ($_iForceMimeType == PG_IMAP_MIME_TYPE_QPRINT) {return imap_qprint($_sReturn);}
				elseif ($_iForceMimeType == PG_IMAP_MIME_TYPE_OTHER) {return $_sReturn;}
				else {return $_sReturn;}
			}
			if ($_oStructure->type == 1) /* multipart */
			{
				if ($this->isDebugMode(array('iMode' => PG_DEBUG_HIGH))) {$this->addDebugString(array('sString' => 'getImapMailPart: structure type is 1'));}
				while (list($_iIndex, $_oSubStructure) = each($_oStructure->parts))
				{
					if ($_iPartNr) {$_sPrefix = $_iPartNr.'.';}
					$_sReturn = $this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => $_sGetPartMimeType, 'iForceMimeType' => $_iForceMimeType, 'iPartNr' => $_sPrefix.($_iIndex + 1), 'oStructure' => $_oSubStructure));
					if ($_sReturn) {return $_sReturn;}
				}
			}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@return sMailBody [type]string[/type]
	[en]...[/en]
	
	@param bIsHtml [needed][type]bool[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param iForceCryption [type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailBody(&$_bIsHtml, $_iMailID, $_iForceCryption = NULL)
	{
		global $oPGStrings;

		$_iForceCryption = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iForceCryption', 'xParameter' => $_iForceCryption));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_sReturn = '';
		if ($_iForceCryption != NULL)
		{
			if ($_iForceCryption == PG_IMAP_CRYPTION_TEXT) {$_sReturn = str_replace("\r\n", "<br />", $this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => 'TEXT/PLAIN', 'iPartNr' => false, 'oStructure' => false)));}
			if ($_iForceCryption == PG_IMAP_CRYPTION_HTML) {$_sReturn = $this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => 'TEXT/HTML', 'iPartNr' => false, 'oStructure' => false));}
			if ($_iForceCryption == PG_IMAP_CRYPTION_UTF8_TEXT) {$_sReturn = str_replace("\r\n", "<br />", utf8_decode($this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => 'TEXT/PLAIN', 'iPartNr' => false, 'oStructure' => false))));}
			if ($_iForceCryption == PG_IMAP_CRYPTION_UTF8_HTML) {$_sReturn = utf8_decode($this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => 'TEXT/HTML', 'iPartNr' => false, 'oStructure' => false)));}
		}
		else
		{
			$_sReturn = $this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => 'TEXT/HTML', 'iPartNr' => false, 'oStructure' => false));
			if ($_sReturn == '')
			{
				$_bIsHtml = false;
				$_sReturn = $this->getImapMailPart(array('iMailID' => $_iMailID, 'sGetPartMimeType' => 'TEXT/PLAIN', 'iPartNr' => false, 'oStructure' => false));
				$_sReturn = $oPGStrings->bb(str_replace("\r\n", '<br />', $_sReturn));
			}
			else {$_bIsHtml = true;}
		}
		$_sReturn = str_replace("\\\"", "\"", $_sReturn);
		return $_sReturn;
	}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param aiMailID [needed][type]int[][/type]
	[en]...[/en]
	*/
	public function setImapMailsReaded($_aiMailID)
	{
		$_aiMailID = $this->getRealParameter(array('oParameters' => $_aiMailID, 'sName' => 'aiMailID', 'xParameter' => $_aiMailID, 'bNotNull' => true));
		return $this->setImapMailsSeen(array('aiMailID' => $_aiMailID));
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]

	@param aiMailID [needed][type]int[][/type]
	[en]...[/en]
	*/
	public function setImapMailsSeen($_aiMailID)
	{
		$_aiMailID = $this->getRealParameter(array('oParameters' => $_aiMailID, 'sName' => 'aiMailID', 'xParameter' => $_aiMailID, 'bNotNull' => true));
		$_sMailsString = implode(",", $_aiMailID);
		return imap_setflag_full($this->oImapMailBox, $_sMailsString, "\\Seen", ST_UID);	// \\Recent
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]	
	
	@param aiMailID [needed][type]int[][/type]
	[en]...[/en]
	*/
	public function unsetImapMailsReaded($_aiMailID)
	{
		$_aiMailID = $this->getRealParameter(array('oParameters' => $_aiMailID, 'sName' => 'aiMailID', 'xParameter' => $_aiMailID, 'bNotNull' => true));
		return $this->unsetImapMailsSeen(array('aiMailID' => $_aiMailID));
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param aiMailID [needed][type]int[][/type]
	[en]...[/en]
	*/
	public function unsetImapMailsSeen($_aiMailID)
	{
		$_aiMailID = $this->getRealParameter(array('oParameters' => $_aiMailID, 'sName' => 'aiMailID', 'xParameter' => $_aiMailID, 'bNotNull' => true));
		$_sMailsString = implode(",", $_aiMailID);
		return imap_clearflag_full($this->oImapMailBox, $_sMailsString, "\\Seen", ST_UID);	// \\Recent
	}
	/* @end method */

	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param aiMailID [needed][type]int[][/type]
	[en]...[/en]
	*/
	public function markImapMailsToDelete($_aiMailID)
	{
		$_aiMailID = $this->getRealParameter(array('oParameters' => $_aiMailID, 'sName' => 'aiMailID', 'xParameter' => $_aiMailID, 'bNotNull' => true));

		$_bReturn = true;
		for ($i=0; $i<count($_aiMailID); $i++)
		{
			if (imap_delete($this->oImapMailBox, $_aiMailID[$i], FT_UID) == false) {$_bReturn = false;}
		}
		return $_bReturn;
	}
	/* @end method */

	/*
	@start method

	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param aiMailID [needed][type]int[][/type]
	[en]...[/en]
	*/
	public function deleteImapMails($_aiMailID)
	{
		$_aiMailID = $this->getRealParameter(array('oParameters' => $_aiMailID, 'sName' => 'aiMailID', 'xParameter' => $_aiMailID, 'bNotNull' => true));

		if ($_aiMailID != NULL) {$this->markImapMailsToDelete(array('aiMailID' => $_aiMailID));}
		return imap_expunge($this->oImapMailBox);
	}
	/* @end method */

	// Imap Mail cid images (embedded images)...
	/*
	@start method
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCID [needed][type]string[/type]
	[en]...[/en]
	*/
	public function putImapMailEmbeddedImage($_iMailID, $_sCID = NULL)
	{
		$_sCID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCID', 'xParameter' => $_sCID));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));
		$this->putImapMailCIDImage(array('iMailID' => $_iMailID, 'sCID' => $_sCID));
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCID [needed][type]string[/type]
	[en]...[/en]
	*/
	public function putImapMailCIDImage($_iMailID, $_sCID = NULL)
	{
		$_sCID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCID', 'xParameter' => $_sCID));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_aCIDImage = array();
		$_aCIDImage = $this->getImapMailCIDImage(array('iMailID' => $_iMailID, 'sCID' => $_sCID));
		$_sContentType = $_aCIDImage[0]['MimeType'];
		if (trim($_aCIDImage[0]['MimeSubType']) != '') {$_sContentType .= '/'.trim($_aCIDImage[0]['MimeSubType']);}
		header("Content-type: ".strtolower($_sContentType));

		$_sCIDImage = imap_fetchbody($this->oImapMailBox, $_iMailID, $_aCIDImage[0]["PartNr"], FT_UID);
		if ($_aCIDImage[0]['Encoding'] == PG_IMAP_MIME_TYPE_BASE64) {echo imap_base64($_sCIDImage);} 
		else if ($_aCIDImage[0]['Encoding'] == PG_IMAP_MIME_TYPE_QPRINT) {echo imap_qprint($_sCIDImage);}
		else if ($_aCIDImage[0]['Encoding'] == PG_IMAP_MIME_TYPE_BINARY) {echo imap_binary($_sCIDImage);}
		else {echo $_sCIDImage;}
		clearstatcache();
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCIDImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	*/
	public function imapMailEmbeddedImages($_iMailID, $_sCIDImagePhpPath = NULL, $_sHtml = NULL)
	{
		$_sCIDImagePhpPath = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCIDImagePhpPath', 'xParameter' => $_sCIDImagePhpPath));
		$_sHtml = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sHtml', 'xParameter' => $_sHtml));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));
		return $this->addImapMailCIDImages(array('iMailID' => $_iMailID, 'sCIDImagePhpPath' => $_sCIDImagePhpPath, 'sHtml' => $_sHtml));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCIDImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	*/
	public function imapMailCIDImages($_iMailID, $_sCIDImagePhpPath = NULL, $_sHtml = NULL)
	{
		$_sCIDImagePhpPath = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCIDImagePhpPath', 'xParameter' => $_sCIDImagePhpPath));
		$_sHtml = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sHtml', 'xParameter' => $_sHtml));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));
		return $this->addImapMailCIDImages(array('iMailID' => $_iMailID, 'sCIDImagePhpPath' => $_sCIDImagePhpPath, 'sHtml' => $_sHtml));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCIDImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addImapMailEmbeddedImages($_iMailID, $_sCIDImagePhpPath = NULL, $_sHtml = NULL)
	{
		$_sCIDImagePhpPath = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCIDImagePhpPath', 'xParameter' => $_sCIDImagePhpPath));
		$_sHtml = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sHtml', 'xParameter' => $_sHtml));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));
		return $this->addImapMailCIDImages(array('iMailID' => $_iMailID, 'sCIDImagePhpPath' => $_sCIDImagePhpPath, 'sHtml' => $_sHtml));
	}
	/* @end method */
	
	/*
	@start method
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCIDImagePhpPath [needed][type]string[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	*/
	public function addImapMailCIDImages($_iMailID, $_sCIDImagePhpPath = NULL, $_sHtml = NULL)
	{
		$_sCIDImagePhpPath = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCIDImagePhpPath', 'xParameter' => $_sCIDImagePhpPath));
		$_sHtml = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sHtml', 'xParameter' => $_sHtml));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_sReplace = $_sCIDImagePhpPath.'?iMailID='.$_iMailID;
		$_sHtml = preg_replace("!(<img.*src=\")cid:(.*)@.*(\".*>)!is", "\\1".$_sReplace."&sCID=\\2\\3", $_sHtml);
		$_sHtml = preg_replace("!(<img.*src=')cid:(.*)@.*('.*>)!is", "\\1".$_sReplace."&sCID=\\2\\3", $_sHtml);
		return $_sHtml;
	}
	/* @end method */

	/*
	@start method
	
	@return axImagesInfos [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailEmbeddedImages($_iMailID)
	{
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));
		return $this->getImapMailCIDImages($_iMailID);
	}
	/* @end method */
	
	/*
	@start method
	
	@return axImagesInfos [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailCIDImages($_iMailID)
	{
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_oStructure = imap_fetchstructure($this->oImapMailBox, $_iMailID, FT_UID);
		$_axCIDInfo = array();
		$i = 0;
		foreach ($_oStructure->parts as $_iPartNr => $_oPart)
		{
			// if ($part->ifid)
			if ((strtolower(trim($_oPart->id)) != '')
			|| (strtolower(trim($_oPart->description)) != ''))
			{
				$_axCIDInfo[$i]['ID'] = $_oPart->id;
				$_axCIDInfo[$i]['Description'] = $_oPart->description;
				$_axCIDInfo[$i]['PartNr'] = $_iPartNr+1;
				$_axCIDInfo[$i]['Name'] = $_oPart->dparameters[0]->value;
				$_axCIDInfo[$i]['Size'] = $_oPart->bytes;
				$_axCIDInfo[$i]['MimeType'] = $this->asMimeTypePart[$_oPart->type];
				$_axCIDInfo[$i]['MimeSubType'] = $_oPart->subtype;
				$_axCIDInfo[$i]['Encoding'] = $_oPart->encoding+1;
				
				$i++;
			}
		}
		return $_axCIDInfo;
	}
	/* @end method */

	/*
	@start method
	
	@return axImageInfos [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCID [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getImapMailEmbeddedImage($_iMailID, $_sCID = NULL)
	{
		$_sCID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCID', 'xParameter' => $_sCID));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));
		return $this->getImapMailCIDImage(array('iMailID' => $_iMailID, 'sCID' => $_sCID));
	}
	/* @end method */
	
	/*
	@start method
	
	@return axImageInfos [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param sCID [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getImapMailCIDImage($_iMailID, $_sCID = NULL)
	{
		$_sCID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'sCID', 'xParameter' => $_sCID));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_oStructure = imap_fetchstructure($oMailBox, $vMailID, FT_UID);
		$_axCIDInfo = array();
		$i = 0;
		foreach ($_oStructure->parts as $_iPartNr => $_oPart)
		{
			if ((strtolower(trim($_oPart->id)) == strtolower(trim($_sCID)))
			|| (strtolower(trim($_oPart->description)) == strtolower(trim($_sCID))))
			{
				$_axCIDInfo[$i]['ID'] = $_oPart->id;
				$_axCIDInfo[$i]['Description'] = $_oPart->description;
				$_axCIDInfo[$i]['PartNr'] = $_iPartNr+1;
				$_axCIDInfo[$i]['Name'] = $_oPart->dparameters[0]->value;
				$_axCIDInfo[$i]['Size'] = $_oPart->bytes;
				$_axCIDInfo[$i]['MimeType'] = $this->asMimeTypePart[$_oPart->type];
				$_axCIDInfo[$i]['MimeSubType'] = $_oPart->subtype;
				$_axCIDInfo[$i]['Encoding'] = $_oPart->encoding+1;
				
				$i++;
			}
		}
		return $_axCIDInfo;
	}
	/* @end method */

	// Imap Mail attachment methods...
	/*
	@start method
	
	@return axAttachmentInfo [type]mixed[][/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	*/
	public function getImapMailAttachmentInfo($_iMailID)
	{
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_axReturn = array();
		$_oAttachmentInfo = imap_fetchstructure($this->oImapMailBox, $_iMailID, FT_UID);
		if (isset($_oAttachmentInfo->parts))
		{
			$_iPartsCount = count($_oAttachmentInfo->parts);

			// find if multipart message
			$i = 0;
			if ($_iPartsCount >= 1)
			{
				foreach ($_oAttachmentInfo->parts as $_iPartNr => $_oPart)
				{
					if (isset($_oPart->disposition))
					{
						if ((strtolower($_oPart->disposition) == "attachment")
						|| ($this->asMimeTypePart[$_oPart->type] == "AUDIO")
						|| ($this->asMimeTypePart[$_oPart->type] == "IMAGE")
						|| ($this->asMimeTypePart[$_oPart->type] == "VIDEO")
						|| ($this->asMimeTypePart[$_oPart->type] == "OTHER")
						|| ($this->asMimeTypePart[$_oPart->type] == "APPLICATION"))
						{
							$_axReturn[$i]['ID'] = '';
							$_axReturn[$i]['Name'] = '';
							$_axReturn[$i]['Size'] = 0;
							$_axReturn[$i]['MimeType'] = '';
							$_axReturn[$i]['MimeSubType'] = '';
							$_axReturn[$i]['Encoding'] = 0;
						
							if (isset($_oPart->id)) {$_axReturn[$i]['ID'] = $_oPart->id;}
							$_axReturn[$i]['PartNr'] = $_iPartNr+1;
							// $_axReturn[$i]['NamePosNr'] = $i;
							if (isset($_oPart->dparameters))
							{
								for ($t=0; $t<count($_oPart->dparameters); $t++)
								{
									if ($_oPart->dparameters[$t]->attribute == 'filename') {$_axReturn[$i]['Name'] = $this->imapDecodeISO(array('sString' => $_oPart->dparameters[$t]->value));}
								}
							}
							if ($_axReturn[$i]['Name'] == '')
							{
								if (isset($_oPart->parameters))
								{
									for ($t=0; $t<count($_oPart->parameters); $t++)
									{
										if ($_oPart->parameters[$t]->attribute == 'name') {$_axReturn[$i]['Name'] = $this->imapDecodeISO(array('sString' => $_oPart->parameters[$t]->value));}
									}
								}
							}
							if ($_axReturn[$i]['Name'] == '') {$_axReturn[$i]['Name'] = $this->imapDecodeISO(array('sString' => $_oPart->description));}
							if (isset($_oPart->bytes)) {$_axReturn[$i]['Size'] = $_oPart->bytes;}
							if (isset($_oPart->type)) {$_axReturn[$i]['MimeType'] = $this->asMimeTypePart[$_oPart->type];}
							if ((isset($_oPart->subtype)) && (isset($_oPart->ifsubtype))) if ($_oPart->ifsubtype == true) {$_axReturn[$i]['MimeSubType'] = $_oPart->subtype;}
							else {$_axReturn[$i]['MimeSubType'] = '';}
							if (isset($_oPart->encoding)) {$_axReturn[$i]['Encoding'] = $_oPart->encoding+1;}
							
							$i++;
						}
					}
				}
			}
		}
		return $_axReturn;
	}
	/* @end method */
	
	/*
	@start method
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param iAttachmentNr [needed][type]int[/type]
	[en]...[/en]
	*/
	public function putImapMailAttachment($_iMailID, $_iAttachmentNr = NULL)
	{
		$_iAttachmentNr = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iAttachmentNr', 'xParameter' => $_iAttachmentNr));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_axMailAttachment = $this->getImapMailAttachmentInfo(array('iMailID' => $_iMailID));
		header('Content-type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$this->imapDecodeISO(array('sString' => utf8_decode($_axMailAttachment[$_iAttachmentNr]['Name']))));
		$_sAttachment = imap_fetchbody($this->oImapMailBox, $_iMailID, $_axMailAttachment[$_iAttachmentNr]['PartNr'], FT_UID);
		if ($_axMailAttachment[$_iAttachmentNr]['Encoding'] == PG_IMAP_MIME_TYPE_BASE64) {echo imap_base64($_sAttachment);} 
		else if ($_axMailAttachment[$_iAttachmentNr]['Encoding'] == PG_IMAP_MIME_TYPE_QPRINT) {echo imap_qprint($_sAttachment);}
		else if ($_axMailAttachment[$_iAttachmentNr]['Encoding'] == PG_IMAP_MIME_TYPE_BINARY) {echo imap_binary($_sAttachment);}
		else {echo $_sAttachment;}
	}
	/* @end method */
	
	// Imap folder methods...
	/*
	@start method
	
	@return asFolders [type]string[][/type]
	[en]...[/en]
	
	@param sMailBoxString [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getImapFolders($_sMailBoxString)
	{
		$_sMailBoxString = $this->getRealParameter(array('oParameters' => $_sMailBoxString, 'sName' => 'sMailBoxString', 'xParameter' => $_sMailBoxString));

		if ($_sMailBoxString == NULL) {$_sMailBoxString = $this->sImapMailBoxString;}

		$i=0;
		$_sDelimiter = '';
		$_asFolder = array();
		$_axFolder = imap_getmailboxes($this->oImapMailBox, $_sMailBoxString, $_sMailBoxString.'%');
		while (list($_sKey, $_oElem) = each($_axFolder))
		{
			$_asFolder[$i]['Name'] = str_replace($_oElem->delimiter, "", strrchr(imap_utf7_decode($_oElem->name), $_oElem->delimiter));
			$_asFolder[$i]['Name'] = str_replace("}", "", str_replace($_oElem->delimiter, "", strrchr(imap_utf7_decode($_asFolder[$i]['Name']), "}")));
			$_asFolder[$i]['FullName'] = $_oElem->name;
			if ($_oElem->delimiter != '') {$this->sImapDelimiter = $_oElem->delimiter;}
			$i++;
		}
		return $_asFolder;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFolderName [needed][type]string[/type]
	[en]...[/en]
	
	@param sMailBoxString [type]string[/type]
	[en]...[/en]
	*/
	public function createImapFolder($_sFolderName, $_sMailBoxString = NULL)
	{
		$_sMailBoxString = $this->getRealParameter(array('oParameters' => $_sFolderName, 'sName' => 'sMailBoxString', 'xParameter' => $_sMailBoxString));
		$_sFolderName = $this->getRealParameter(array('oParameters' => $_sFolderName, 'sName' => 'sFolderName', 'xParameter' => $_sFolderName));

		if ($_sMailBoxString == NULL) {$_sMailBoxString = $this->sImapMailBoxString;}
		if ($_sMailBoxString == '') {$_sMailBoxString = $this->imapGenerateMailBoxString();}
		
		$_sFolderName = trim(str_replace($this->sImapDelimiter, '', $_sFolderName));
		if (($_sFolderName != '') && ($_sMailBoxString != ''))
		{
			if (imap_createmailbox($this->oImapMailBox, $this->imapUTF7SpecialChars(array('sString' => $_sMailBoxString.$this->sImapDelimiter.$_sFolderName.$this->sImapDelimiter))))
			{
				imap_subscribe($this->oImapMailBox, $this->imapUTF7SpecialChars(array('sString' => $_sMailBoxString.$this->sImapDelimiter.$_sFolderName.$this->sImapDelimiter)));
				return true;
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sFolderName [needed][type]string[/type]
	[en]...[/en]
	
	@param sMailBoxString [type]string[/type]
	[en]...[/en]
	*/
	public function renameImapFolder($_sFolderName, $_sMailBoxString = NULL)
	{
		$_sMailBoxString = $this->getRealParameter(array('oParameters' => $_sFolderName, 'sName' => 'sMailBoxString', 'xParameter' => $_sMailBoxString));
		$_sFolderName = $this->getRealParameter(array('oParameters' => $_sFolderName, 'sName' => 'sFolderName', 'xParameter' => $_sFolderName));

		if ($_sMailBoxString == NULL) {$_sMailBoxString = $this->sImapMailBoxString;}
		if ($_sMailBoxString == '') {$_sMailBoxString = $this->imapGenerateMailBoxString();}
		
		$_sFolderName = trim(str_replace($this->sImapDelimiter, '', $_sFolderName));
		if (($_sFolderName != '') && ($_sMailBoxString != ''))
		{
			if (imap_renamemailbox($this->oImapMailBox, $sRealName, $this->imapUTF7SpecialChars(array('sString' => $_sMailBoxString.$this->sImapDelimiter.$_sFolderName.$this->sImapDelimiter))))
			{
				imap_subscribe($this->oImapMailBox, $this->imapUTF7SpecialChars(array('sString' => $_sMailBoxString.$this->sImapDelimiter.$_sFolderName.$this->sImapDelimiter)));
				return true;
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param sMailBoxString [type]string[/type]
	[en]...[/en]
	*/
	public function deleteImapFolder($_sMailBoxString)
	{
		$_sMailBoxString = $this->getRealParameter(array('oParameters' => $_sMailBoxString, 'sName' => 'sMailBoxString', 'xParameter' => $_sMailBoxString));

		if ($_sMailBoxString == NULL) {$_sMailBoxString = $this->sImapMailBoxString;}
		if ($_sMailBoxString == '') {$_sMailBoxString = $this->imapGenerateMailBoxString();}
		if (imap_deletemailbox($this->oImapMailBox, $this->imapUTF7SpecialChars(array('sString' => $_sMailBoxString.$this->sImapDelimiter))))
		{
			return true;
		}
		return false;
	}
	/* @end method */

	// Imap mail ...
	/*
	@start method
	
	@return sFileContent [type]string[/type]
	[en]...[/en]
	
	@param iMailID [needed][type]int[/type]
	[en]...[/en]
	
	@param axAttachmentInfo [needed][type]mixed[][/type]
	[en]...[/en]
	*/
	public function getImapMailAttachment($_iMailID, $_axAttachmentInfo = NULL)
	{
		$_axAttachmentInfo = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'axAttachmentInfo', 'xParameter' => $_axAttachmentInfo));
		$_iMailID = $this->getRealParameter(array('oParameters' => $_iMailID, 'sName' => 'iMailID', 'xParameter' => $_iMailID));

		$_sAttachment = imap_fetchbody($this->oImapMailBox, $_iMailID, $_axAttachmentInfo['PartNr'], FT_UID);
		if ($_axAttachmentInfo['Encoding'] == PG_IMAP_MIME_TYPE_BASE64) {$_sFileContent = imap_base64($_sAttachment);} 
		else if ($_axAttachmentInfo['Encoding'] == PG_IMAP_MIME_TYPE_QPRINT) {$_sFileContent = imap_qprint($_sAttachment);}
		else if ($_axAttachmentInfo['Encoding'] == PG_IMAP_MIME_TYPE_BINARY) {$_sFileContent = imap_binary($_sAttachment);}
		else {$_sFileContent = $_sAttachment;}
		
		return $_sFileContent;
	}
	/* @end method */
	
	/*
	@start method
	
	@return sMime [type]string[/type]
	[en]...[/en]
	
	@para sPath [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getFileMime($_sPath)
	{
		$_sPath = $this->getRealParameter(array('oParameters' => $_sPath, 'sName' => 'sPath', 'xParameter' => $_sPath));

		$_sReturn = '';
		if(ini_get('mime_magic.debug')) {$_sReturn = @mime_content_type($_sPath);}
		else {$_sReturn = 'application/octet-stream';}
		if ($_sReturn == '') {$_sReturn = 'application/octet-stream';}
		return $_sReturn;
	}
	/* @end method */
}
/* @end class */
$oPGImap = new classPG_Imap();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGImap', 'xValue' => $oPGImap));}
?>