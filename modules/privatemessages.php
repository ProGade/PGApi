<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* Dual licensed under the MIT or GPL Version 2 licenses.
* http://api.progade.de/license/
*
* Last changes of this file: Feb 10 2012
*/
define('PG_PRIVATEMESSAGES_NETWORK_REQUESTTYPE', 'PGPrivateMessagesNetworkRequestType');

class classPG_PrivateMessages extends classPG_ClassBasics
{
	// Declarations...
	
	// Construct...
	public function __construct()
	{
		$this->setID('PGPrivateMessages');
		$this->initClassBasics();
		$this->setText(array(
			'OverviewColumnContact' => 'Kontakt',
			'OverviewColumnSubject' => 'Betreff'
		));
	}
	
	// Methods...
	public function savePrivateMessage($_iSenderID, $_sSenderEmail, $_iReceiverID, $_sSubject, $_sMessage)
	{
		global $oPGLogin, $oPGMySql;
		
		if (($oPGLogin->isUserType(PG_LOGIN_USERTYPE_ADMIN | PG_LOGIN_USERTYPE_SUPERADMIN)) || ($oPGLogin->getUserData('UserID') == $_iSenderID))
		{
			$_sSql = 'INSERT INTO pg_market_privatemessages SET ';
			$_sSql .= 'SenderID = "'.$_iSenderID.'", ';
			$_sSql .= 'SenderEmail = "'.$_sSenderEmail.'", ';
			$_sSql .= 'ReceiverID = "'.$_iReceiverID.'", ';
			$_sSql .= 'Subject = "'.addslashes($_sSubject).'", ';
			$_sSql .= 'Message = "'.addslashes($_sMessage).'", ';
			$_sSql .= 'CreateTimeStamp = "'.time().'"';
			if ($oPGMySql->sendSql($_sSql)) {return true;}
		}
		return false;
	}
	
	public function loadPrivateMessage($_iSenderID, $_sSenderEmail, $_iReceiverID, $_iCreateTimeStamp)
	{
		global $oPGLogin, $oPGMySql, $oPGUsers;
		
		if (($oPGLogin->isUserType(PG_LOGIN_USERTYPE_ADMIN | PG_LOGIN_USERTYPE_SUPERADMIN)) || ($oPGLogin->getUserData('UserID') == $_iSenderID))
		{
			$_sSql = 'SELECT Subject, Message, CreateTimeStamp ';
			$_sSql .= 'FROM pg_market_privatemessages ';
			$_sSql .= 'WHERE SenderID = "'.$_iSenderID.'" ';
			$_sSql .= 'AND SenderEmail = "'.$_sSenderEmail.'" ';
			$_sSql .= 'AND ReceiverID = "'.$_iReceiverID.'" ';
			$_sSql .= 'AND CreateTimeStamp = "'.$_iCreateTimeStamp.'" ';
			$_sSql .= 'LIMIT 1';
			if ($_oRes = $oPGMySql->sendSql($_sSql))
			{
				return $oPGMySql->fetchArray($_oRes);
			} // if _oRes
		}
		return NULL;
	}
	
	public function saveSubmitted($_sPrivateMessageID = NULL)
	{
		global $_POST;
		
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $_POST['sPrivateMessageID'];}
		
		if (isset($_POST[$_sPrivateMessageID.'FormSubmit']))
		{
			if ($this->savePrivateMessage($_POST[$_sPrivateMessageID.'SenderID'], 
										  $_POST[$_sPrivateMessageID.'SenderEmail'], 
										  $_POST[$_sPrivateMessageID.'ReceiverID'], 
										  $_POST[$_sPrivateMessageID.'Subject'], 
										  $_POST[$_sPrivateMessageID.'Message']))
			{
				return '<span class="pg_market_success">Nachricht wurde gesendet.</span><br />';
			}
			else {return '<span class="pg_market_failed">Nachricht konnte nicht gesendet werden!</span><br />';}
		}
		return false;
	}
	
	public function isSaveRequest($_sPrivateMessageID = NULL)
	{
		global $_POST;
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $_POST['sPrivateMessageID'];}
		if (isset($_POST[$_sPrivateMessageID.'FormSubmit'])) {return true;}
		return false;
	}
	
	public function setNetworkSaveMessageResponse(&$_oObject, $_sPrivateMessageID = NULL)
	{
		$_sMessage = $this->saveSubmitted($_sPrivateMessageID);
		$_oObject->addNetworkData();
		$_oObject->addNetworkData('PG_Message', $_sMessage);
	}
	
	public function setNetworkRequestedMessageResponse(&$_oObject, $_sPrivateMessageID = NULL, $_sSubject = NULL, $_sMessage = NULL)
	{
		global $oPGForm, $oPGTextArea, $_POST;
		
		if (($_sSubject === NULL) && ($_sMessage === NULL))
		{
			$_axMessage = $this->loadPrivateMessage($_POST['iSenderID'], $_POST['sSenderEmail'], $_POST['iReceiverID'], $_POST['iCreateTimeStamp']);
			$_sSubject = '['.date("d.m.Y", $_axMessage['CreateTimeStamp']).', '.date("H:i", $_axMessage['CreateTimeStamp']).'Uhr] '.$_axMessage['Subject'];
			$_sMessage = str_replace("\n", '<br />', $_axMessage['Message']);
		}
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $_POST['sPrivateMessageID'];}

		$this->addUrlParameter('sPrivateMessageID', $_sPrivateMessageID);
		$this->addUrlParameter($_sPrivateMessageID.'SenderID', $_POST['iReceiverID']);
		$this->addUrlParameter($_sPrivateMessageID.'SenderEmail', '');
		$this->addUrlParameter($_sPrivateMessageID.'ReceiverID', $_POST['iSenderID']);

		$oPGForm->useJavaScriptAutoRegister(false);
		$oPGForm->addUrlParameters($this->getUrlParameters());
		$oPGForm->addTextArea($_sLabelName = NULL,
							  $_sTextAreaID = $_sPrivateMessageID.'Message', 
							  $_iTextAreaMode = PG_TEXTAREA_MODE_NONE, 
							  $_iSizeX = 700, 
							  $_iRows = 10);
		$_sForm = $oPGForm->build($_sFormID = $_sPrivateMessageID.'Form', $_sTargetUrl = NULL, $_sTargetFrame = NULL, $_sFormMethod = NULL);
		
		$_oObject->addNetworkData('PG_Subject', $_sSubject);
		$_oObject->addNetworkData('PG_Message', $_sMessage);
		$_oObject->addNetworkData('PG_Form', $_sForm);
	}
	
	public function setNetworkMainData(&$_oObject)
	{
		global $oPGForm, $oPGTextArea, $_POST;
		
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $_POST['sPrivateMessageID'];}

		$_oObject->addNetworkData('PG_RequestType', PG_PRIVATEMESSAGES_NETWORK_REQUESTTYPE);
		$_oObject->addNetworkData('PG_PrivateMessageID', $_sPrivateMessageID);
	}
	
	public function buildMessageOverview($_sPrivateMessageID = NULL, $_iReceiverUserID = NULL)
	{
		global $oPGLogin, $oPGMySql, $oPGUsers;
		
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $this->getNextID();}
		if ($_iReceiverUserID === NULL) {$_iReceiverUserID = $oPGLogin->getUserData('UserID');}
		
		$_sHTML = '';
		
		$_sHTML .= '<table cellspacing="5" cellpadding="5">';
		$_sHTML .= '<tr>';
			$_sHTML .= '<td><h2>'.$this->getText('OverviewColumnContact').'</h2></td>';
			$_sHTML .= '<td><h2>'.$this->getText('OverviewColumnSubject').'</h2></td>';
		$_sHTML .= '</tr>';

		$_sSql = 'SELECT a.SenderEmail, a.Subject, a.Message, ';
		$_sSql .= 'a.SenderID, a.ReceiverID, a.CreateTimeStamp ';
		$_sSql .= 'FROM pg_market_privatemessages AS a ';
		$_sSql .= 'WHERE (';
			$_sSql .= 'a.SenderID = "'.$_iReceiverUserID.'" ';
			$_sSql .= 'OR a.ReceiverID = "'.$_iReceiverUserID.'"';
		$_sSql .= ') ';
		$_sSql .= 'AND CreateTimeStamp = (';
			$_sSql .= 'SELECT b.CreateTimeStamp ';
			$_sSql .= 'FROM pg_market_privatemessages AS b ';
			$_sSql .= 'WHERE a.SenderID = b.SenderID ';
			$_sSql .= 'AND a.ReceiverID = b.ReceiverID ';
			$_sSql .= 'ORDER BY b.CreateTimeStamp DESC ';
			$_sSql .= 'LIMIT 1';
		$_sSql .= ') ';
		$_sSql .= 'GROUP BY a.SenderID, a.ReceiverID ';
		$_sSql .= 'ORDER BY a.CreateTimeStamp DESC';
		if ($_oRes = $oPGMySql->sendSql($_sSql))
		{
			while ($_axMessage = $oPGMySql->fetchArray($_oRes))
			{
				$_iSenderID = 0;
				$_sUsername = $_axMessage['SenderEmail'];
				
				if ($_axMessage['SenderID'] == $_iReceiverUserID) {$_iSenderID = $_axMessage['ReceiverID'];}
				else {$_iSenderID = $_axMessage['SenderID'];}
				
				if (($_iSenderID > 0) && (isset($oPGUsers)))
				{
					$_axUser = $oPGUsers->loadUser($_iSenderID);
					$_sUsername = $_axUser['Username'];
				}
				
				$_sHTML .= '<tr>';
					$_sHTML .= '<td>'.$_sUsername.'</td>';
					$_sHTML .= '<td>';
						$_sHTML .= '<a href="javascript:;" onclick="oPGPrivateMessages.subjectOnClick(\''.$_sPrivateMessageID.'\', '.$_axMessage['SenderID'].', \''.$_axMessage['SenderEmail'].'\', '.$_axMessage['ReceiverID'].', '.$_axMessage['CreateTimeStamp'].');" target="_self">';
						$_sHTML .= $_axMessage['Subject'];
						$_sHTML .= '</a>';
					$_sHTML .= '</td>';
				$_sHTML .= '</tr>';
			} // while _axMessage
		} // if _oRes

		$_sHTML .= '</table>';
		
		return $_sHTML;
	}
	
	public function buildPopup($_sPrivateMessageID = NULL)
	{
		global $oPGPopup;
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $this->getLastID();}
		return $oPGPopup->build($_sPopupID = $_sPrivateMessageID.'Popup',
								$_sContent = NULL,
								$_iWidth = 750,
								$_iHeight = 450,
								$_iZIndex = 1000,
								$_iOverlayAlpha = 80,
								$_iOverlayAlphaSpeedTimeout = 50,
								$_sCssStyle = NULL,
								$_sCssClass = NULL);
	}
	
	public function build($_sPrivateMessageID = NULL, $_iReceiverUserID = NULL)
	{
		if ($_sPrivateMessageID === NULL) {$_sPrivateMessageID = $this->getNextID();}
		
		$_sHTML = '';
		$_sHTML .= $this->buildMessageOverview($_sPrivateMessageID, $_iReceiverUserID);
		$_sHTML .= $this->buildPopup($_sPrivateMessageID);
		return $_sHTML;
	}
}

$oPGPrivateMessages = new classPG_PrivateMessages();
?>