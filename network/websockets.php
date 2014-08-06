<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Feb 10 2012
*/
define('PG_WEBSOCKETS_MESSAGE_INDEX_SENDTO', 0);
define('PG_WEBSOCKETS_MESSAGE_INDEX_ACTION', 1);
define('PG_WEBSOCKETS_MESSAGE_INDEX_CONTENTDATA', 2);

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_WebSockets extends classPG_ClassBasics
{
	// Declarations...
	private $oMaster;
	private $sWebSocketUrl = '127.0.0.1';
	private $iWebSocketPort = 4502;
	private $aoSockets = array();
	private $aoUsers = array();
	private $bDebug = false;
	private $sConsoleLineBreak = "\n";
	private $sProtocolLineBreak = "\r\n";
	private $sMessageDataSeperator = '**';
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function setWebSocketUrl($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sWebSocketUrl = $_sUrl;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return sWebSocketUrl [type]string[/type]
	[en]...[/en]
	*/
	public function getWebSocketUrl() {return $this->sWebSocketUrl;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@param iPort [needed][type]int[/type]
	[en]...[/en]
	*/
	public function setWebSocketPort($_iPort)
	{
		$_iPort = $this->getRealParameter(array('oParameters' => $_iPort, 'sName' => 'iPort', 'xParameter' => $_iPort));
		$this->iWebSocketPort = $_iPort;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@description
	[en]...[/en]
	
	@return iWebSocketPort [type]int[/type]
	[en]...[/en]
	*/
	public function getWebSocketPort() {return $this->iWebSocketPort;}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sUrl [type]string[/type]
	[en]...[/en]
	
	@param iPort [type]int[/type]
	[en]...[/en]
	*/
	public function start($_sUrl = NULL, $_iPort = NULL)
	{
		$_iPort = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'iPort', 'xParameter' => $_iPort));
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));

		set_time_limit(0);
		ob_implicit_flush(true);
		
		if ($_sUrl === NULL) {$_sUrl = $this->sWebSocketUrl;}
		if ($_iPort === NULL) {$_iPort = $this->iWebSocketPort;}
		
		$this->oMaster = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die("socket_create() failed");
		socket_set_option($this->oMaster, SOL_SOCKET, SO_REUSEADDR, 1) or die("socket_option() failed");
		socket_bind($this->oMaster, $_sUrl, $_iPort) or die("socket_bind() failed");
		socket_listen($this->oMaster, 20) or die("socket_listen() failed");
		$this->aoSockets[] = $this->oMaster;
		$this->output(array('sMessage' => "Server Started : ".date('Y-m-d H:i:s')));
		$this->output(array('sMessage' => "Listening on   : ".$_sUrl." port ".$_iPort));
		$this->output(array('sMessage' => "Master socket  : ".$this->oMaster.$this->sConsoleLineBreak));
		
		$_sWaitCursor = "-";
		while (true)
		{
			switch ($_sWaitCursor)
			{
				case "-": $_sWaitCursor = "\\"; break;
				case "\\": $_sWaitCursor = "|"; break;
				case "|": $_sWaitCursor = "/"; break;
				case "/": $_sWaitCursor = "-"; break;
			}
			// echo $_sWaitCursor;
			$_aoReadSockets = $this->aoSockets;
			$_aoWriteSockets = NULL;
			$_aoExceptSockets = NULL;
			$_iReaktionTimeout = 1; // NULL;
			echo $_sWaitCursor." Clients registered: ".count($_aoReadSockets);
			socket_select($_aoReadSockets, $_aoWriteSockets, $_aoExceptSockets, $_iReaktionTimeout);
			$this->clearLine();
			foreach($_aoReadSockets as $_oSocket)
			{
				if ($_oSocket == $this->oMaster)
				{
					$_oClientSocket = socket_accept($this->oMaster);
					if($_oClientSocket == false)
					{
						$this->log("socket_accept() failed");
						continue;
					}
					else {$this->connect(array('oSocket' => $_oClientSocket));}
				}
				else
				{
					$_iBytes = @socket_recv($_oSocket, $_sMessage, 2048, 0);
					if($_iBytes == 0) {$this->disconnect(array('oSocket' => $_oSocket));}
					else
					{
						// First Byte:
						// 71 = Connect
						// 129 = Text Frame
						// 136 = Close Frame
						// 137 = Ping Frame
						// 138 = Pong Frame
						$this->output(array('sMessage' => 'First Byte: '.ord($_sMessage[0])));
						$_oUser = $this->getUserBySocket(array('oSocket' => $_oSocket));
						switch (ord($_sMessage[0]))
						{
							case 71: {if (!$_oUser->bHandshake) {$this->doHandshake(array('oUser' => $_oUser, 'sMessage' => $_sMessage));} break;}
							case 136: {$this->disconnect(array('oSocket' => $_oSocket)); break;}
							case 129:
							{
								if ($_oUser)
								{
									$this->process(array('oUser' => $_oUser, 'sMessage' => $this->decodeMessage(array('sMessage' => $_sMessage))));
								}
								break;
							}
						}
					}
				}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param oUser [needed][type]object[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function process($_oUser, $_sMessage = NULL)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_oUser, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_oUser = $this->getRealParameter(array('oParameters' => $_oUser, 'sName' => 'oUser', 'xParameter' => $_oUser));

		/* Extend and modify this method to suit your needs */
		/* Basic usage is to echo incoming messages back to client */
		// $this->send($_oUser->oSocket, $_sMessage);
		$this->output(array('sMessage' => '['.date('H:i:s').'] < ['.strlen($_sMessage).' Bytes] '.$_sMessage));
		$_asMessage = explode($this->sMessageDataSeperator, $_sMessage);
		$_vBytes = 0;
		
		$_sSendMessage = '';
		$_sSendMessage .= $_asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_SENDTO].$this->sMessageDataSeperator;
		
		switch($_asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_ACTION])
		{
			case 'chat':
				$_sSendMessage .= 'chat'.$this->sMessageDataSeperator;
				$_sSendMessage .= $_oUser->getUserData(array('sProperty' => 'Username')).': ';
				$_sSendMessage .= $_asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_CONTENTDATA];
			break;
		}
		
		switch ($_asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_SENDTO])
		{
			case 'all':
				foreach($this->aoUsers as $_oUser2) {$_vBytes += $this->send(array('oSocket' => $_oUser2->oSocket, 'sMessage' => $_sSendMessage));}
			break;
			
			case 'other':
				foreach($this->aoUsers as $_oUser2)
				{
					if ($_oUser != $_oUser2) {$_vBytes += $this->send(array('oSocket' => $_oUser2->oSocket, 'sMessage' => $_sSendMessage));}
				}
			break;
			
			case 'me':
				$_vBytes += $this->send(array('oSocket' => $_oUser->oSocket, 'sMessage' => $_sSendMessage));
			break;
			
			default:
				$_asUserNames = explode(':', $_asMessage[PG_WEBSOCKETS_MESSAGE_INDEX_SENDTO]);
				// TODO
			break;
		}
		$this->output(array('sMessage' => '['.date('H:i:s').'] > ['.$_vBytes.' Bytes] '.$_sSendMessage));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return iMessageLength [type]int[/type]
	[en]...[/en]
	
	@param oClient [needed][type]object[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function send($_oSocket, $_sMessage = NULL)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_oSocket, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_oSocket = $this->getRealParameter(array('oParameters' => $_oSocket, 'sName' => 'oSocket', 'xParameter' => $_oSocket));

		$_sEncodedMessage = $this->encodeMessage(array('sMessage' => $_sMessage));
		socket_write($_oSocket, $_sEncodedMessage, strlen($_sEncodedMessage));
		return strlen($_sEncodedMessage);
		// $this->output(array('sMessage' => '! '.strlen($_sMessage)));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param oSocket [needed][type]object[/type]
	[en]...[/en]
	*/
	public function connect($_oSocket)
	{
		$_oSocket = $this->getRealParameter(array('oParameters' => $_oSocket, 'sName' => 'oSocket', 'xParameter' => $_oSocket));

		$_oUser = new classPG_WebSocketsUser();
		$_oUser->sID = uniqid();
$_oUser->setUserData(array('sProperty' => 'Username', 'xValue' => 'User '.$_oUser->sID));
		$_oUser->oSocket = $_oSocket;
		
		array_push($this->aoUsers, $_oUser);
		array_push($this->aoSockets, $_oSocket);
		
		$this->log(array('sMessage' => $_oSocket.' CONNECTED!'));
		// $this->log(array('sMessage' => date("d/n/Y").' at '.date("H:i:s T")));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param oSocket [needed][type]object[/type]
	[en]...[/en]
	*/
	public function disconnect($_oSocket)
	{
		$_oSocket = $this->getRealParameter(array('oParameters' => $_oSocket, 'sName' => 'oSocket', 'xParameter' => $_oSocket));

		$_iUserIndex = NULL;
		for($i=0; $i<count($this->aoUsers); $i++)
		{
			if($this->aoUsers[$i]->oSocket == $_oSocket)
			{
				$_iUserIndex = $i;
				break;
			}
		}
		
		if (!is_null($_iUserIndex)) {array_splice($this->aoUsers, $_iUserIndex, 1);}
		
		$_iSocketIndex = array_search($_oSocket, $this->aoSockets);
		socket_close($_oSocket);
		$this->log(array('sMessage' => $_oSocket." DISCONNECTED!"));
		
		if ($_iSocketIndex >= 0) {array_splice($this->aoSockets, $_iSocketIndex, 1);}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return bSuccess [type]bool[/type]
	[en]...[/en]
	
	@param oUser [needed][type]object[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	public function doHandshake($_oUser, $_sMessage = NULL)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_oUser, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		$_oUser = $this->getRealParameter(array('oParameters' => $_oUser, 'sName' => 'oUser', 'xParameter' => $_oUser));

		$this->log(array('sMessage' => "\nRequesting handshake..."));
		$this->log(array('sMessage' => $_sMessage));
		$_axRequest = $this->getHeaders(array('sRequest' => $_sMessage));
		// list($_sResource, $_sHost, $_sOrigin, $_iSecVersion, $_sKey1, $_sKey2, $_sLast8Bytes) = $this->getHeaders(array('sRequest' => $_sMessage));
		$this->log(array('sMessage' => "Handshaking..."));
		//$port = explode(":",$host);
		//$port = $port[1];
		//$this->log($origin."\r\n".$host);
		
		$_sMessage = $this->buildHandshakeAnswer($_axRequest);
		
		socket_write($_oUser->oSocket, $_sMessage, strlen($_sMessage)); // $_sMessage.chr(0), strlen($_sMessage.chr(0)));
		$_oUser->bHandshake = true;
		$this->log(array('sMessage' => $_sMessage));
		$this->log(array('sMessage' => "Done handshaking..."));
		
		return true;
	}
	/* @end method */
	
	public function buildHandshakeAnswer($_axRequest)
	{
		$_axRequest = $this->getRealParameter(array('oParameters' => $_axRequest, 'sName' => 'axRequest', 'xParameter' => $_axRequest, 'bNotNull' => true));
	
		$_sMessage = '';
		if ($_axRequest['iSecVersion'] >= 6)
		{
			$_sGUID = '258EAFA5-E914-47DA-95CA-C5AB0DC85B11';
			$this->log(array('sMessage' => 'Calculate Key-Accept...'));
			$_sKeySec = $_axRequest['sKeySec'].$_sGUID;
			$this->log(array('sMessage' => '1. add: '.$_sKeySec));
			$_sKeySec = sha1($_sKeySec, true);
			// $_sKeySec = pack('H*', sha1($_sKeySec));
			$this->log(array('sMessage' => '2. sha1: '.$_sKeySec));
			$_sKeySec = base64_encode($_sKeySec);
			$this->log(array('sMessage' => '3. base64: '.$_sKeySec));
		
			$_sMessage .= 'HTTP/1.1 101 Switching Protocols'.$this->sProtocolLineBreak;
			$_sMessage .= 'Upgrade: WebSocket'.$this->sProtocolLineBreak;
			$_sMessage .= 'Connection: Upgrade'.$this->sProtocolLineBreak;
			$_sMessage .= 'WebSocket-Origin: '.$_axRequest['sOrigin'].$this->sProtocolLineBreak;
			$_sMessage .= 'WebSocket-Location: ws://'.$_axRequest['sHost'].$_axRequest['sResource'].$this->sProtocolLineBreak;
			$_sMessage .= 'Sec-WebSocket-Accept: '.$_sKeySec.$this->sProtocolLineBreak;
			// $_sMessage .= 'Sec-WebSocket-Protocol: PGApi'.$this->sProtocolLineBreak;
			// Sec-WebSocket-Protocol: chat // forum // ...
			$_sMessage .= $this->sProtocolLineBreak;
		}
		else
		{
			$_sMessage .= 'HTTP/1.1 101 WebSocket Protocol Handshake'.$this->sProtocolLineBreak;
			$_sMessage .= 'Upgrade: WebSocket'.$this->sProtocolLineBreak;
			$_sMessage .= 'Connection: Upgrade'.$this->sProtocolLineBreak;
			// $_sMessage .= 'WebSocket-Origin: '.$origin.$this->sProtocolLineBreak;
			// $_sMessage .= 'WebSocket-Location: ws://';
			$_sMessage .= $_axRequest['sHost'].$_axRequest['sResource'].$this->sProtocolLineBreak;
			$_sMessage .= 'Sec-WebSocket-Origin: '.$_axRequest['sOrigin'].$this->sProtocolLineBreak;
			$_sMessage .= 'Sec-WebSocket-Location: ws://'.$_axRequest['sHost'].$_axRequest['sResource'].$this->sProtocolLineBreak;
			// $_sMessage .= 'Sec-WebSocket-Protocol: icbmgame'.$this->sProtocolLineBreak;	// optional
			$_sMessage .= $this->sProtocolLineBreak;
			$_sMessage .= $this->calcKey(array('sKey1' => $_axRequest['sKey1'], 'sKey2' => $_axRequest['sKey2'], 'sLast8Bytes' => $_axRequest['sLast8Bytes'])).$this->sProtocolLineBreak;
			// $_sMessage .= $this->sProtocolLineBreak;
		}
		return $_sMessage;
	}
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sKey [type]string[/type]
	[en]...[/en]
	
	@param sKey1 [needed][type]string[/type]
	[en]...[/en]
	
	@param sKey2 [needed][type]string[/type]
	[en]...[/en]
	
	@param sLast8Bytes [needed][type]string[/type]
	[en]...[/en]
	*/
	function calcKey($_sKey1, $_sKey2 = NULL, $_sLast8Bytes = NULL)
	{
		$_sKey2 = $this->getRealParameter(array('oParameters' => $_sKey1, 'sName' => 'sKey2', 'xParameter' => $_sKey2));
		$_sLast8Bytes = $this->getRealParameter(array('oParameters' => $_sKey1, 'sName' => 'sLast8Bytes', 'xParameter' => $_sLast8Bytes));
		$_sKey1 = $this->getRealParameter(array('oParameters' => $_sKey1, 'sName' => 'sKey1', 'xParameter' => $_sKey1));

		// Get the numbers
		preg_match_all('/([\d]+)/', $_sKey1, $_asKey1Numbers);
		preg_match_all('/([\d]+)/', $_sKey2, $_asKey2Numbers);
		
		// Number crunching [/bad pun]
		$this->log(array('sMessage' => "Key1: ".($_sKey1Numbers = implode($_asKey1Numbers[0]))));
		$this->log(array('sMessage' => "Key2: ".($_sKey2Numbers = implode($_asKey2Numbers[0]))));
		
		// Count spaces
		preg_match_all('/([ ]+)/', $_sKey1, $_asKey1Spaces);
		preg_match_all('/([ ]+)/', $_sKey2, $_asKey2Spaces);
		
		// How many spaces did it find?
		$this->log(array('sMessage' => "Key1 Spaces: ".($_sKey1Spaces = strlen(implode($_asKey1Spaces[0])))));
		$this->log(array('sMessage' => "Key2 Spaces: ".($_sKey2Spaces = strlen(implode($_asKey2Spaces[0])))));
		if ($_sKey1Spaces == 0 | $_sKey2Spaces == 0) {$this->log(array('sMessage' => "Invalid key")); return;}
		
		// Some math
		$_sKey1Sec = pack("N", $_sKey1Numbers / $_sKey1Spaces);		//Get the 32bit secret key, minus the other thing
		$_sKey2Sec = pack("N", $_sKey2Numbers / $_sKey2Spaces);		//This needs checking, I'm not completely sure it should be a binary string
		return md5($_sKey1Sec.$_sKey2Sec.$_sLast8Bytes,1);			//The result, I think
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return asHeaders [type]string[][/type]
	[en]...[/en]
	
	@param sRequest [needed][type]string[/type]
	[en]...[/en]
	*/
	function getHeaders($_sRequest)
	{
		$_sRequest = $this->getRealParameter(array('oParameters' => $_sRequest, 'sName' => 'sRequest', 'xParameter' => $_sRequest));
		
		$_axRequest = array();

		$_sGet = $_sHost = $_sOrigin = $_sKey1Sec = $_sKey2Sec = $_sLast8Bytes = NULL;
		if (preg_match("/GET (.*) HTTP/", $_sRequest, $_asMatches)) {$_axRequest['sResource'] = $_asMatches[1];}
		if (preg_match("/Host: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$_axRequest['sHost'] = $_asMatches[1];}
		if (preg_match("/Sec-WebSocket-Origin: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$_axRequest['sOrigin'] = $_asMatches[1];}
		else if (preg_match("/Origin: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$_axRequest['sOrigin'] = $_asMatches[1];}
		
		$_iSecVersion = 0;
		if (preg_match("/Sec-WebSocket-Version: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$_axRequest['iSecVersion'] = (int)$_asMatches[1];}
		if (preg_match("/Sec-WebSocket-Key: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$this->log(array('sMessage' => 'Sec Key: '.($_axRequest['sKeySec'] = $_asMatches[1])));}
		else
		{
			if (preg_match("/Sec-WebSocket-Key1: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$this->log(array('sMessage' => 'Sec Key1: '.($_axRequest['sKey1Sec'] = $_asMatches[1])));}
			else {$this->log(array('sMessage' => 'Sec Key1: failed!'));}
			
			if (preg_match("/Sec-WebSocket-Key2: (.*)".$this->sProtocolLineBreak."/", $_sRequest, $_asMatches)) {$this->log(array('sMessage' => 'Sec Key2: '.($_axRequest['sKey2Sec'] = $_asMatches[1])));}
			else {$this->log(array('sMessage' => 'Sec Key2: failed!'));}
		}
		
		if ($_asMatches = substr($_sRequest, -8)) {$this->log(array('sMessage' => "Last 8 bytes: ".($_axRequest['sLast8Bytes'] = $_asMatches)));}
		// return array($_sGet, $_sHost, $_sOrigin, $_iSecVersion, $_sKey1Sec, $_sKey2Sec, $_sLast8Bytes);
		return $_axRequest;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return oUser [type]object[/type]
	[en]...[/en]
	
	@param oSocket [needed][type]object[/type]
	[en]...[/en]
	*/
	function getUserBySocket($_oSocket)
	{
		$_oSocket = $this->getRealParameter(array('oParameters' => $_oSocket, 'sName' => 'oSocket', 'xParameter' => $_oSocket));

		$_oFoundUser = NULL;
		foreach($this->aoUsers as $_oUser)
		{
			if($_oUser->oSocket == $_oSocket) {$_oFoundUser = $_oUser; break;}
		}
		return $_oFoundUser;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	function output($_sMessage = '')
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		echo $this->clearLine().$_sMessage.$this->sConsoleLineBreak;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	function log($_sMessage = "")
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		if($this->bDebug) {echo $_sMessage.$this->sConsoleLineBreak;}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sEncodedMessage [type]string[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	function encodeMessage($_sMessage, $_bMasked = NULL)
	{
		$_bMasked = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'bMasked', 'xParameter' => $_bMasked));
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		
		if ($_sMessage === NULL) {$_sMessage = '';}
		if ($_bMasked === NULL) {$_bMasked = false;}
		
		// First Byte:
		// 129 = Text Frame
		// 136 = Close Frame
		// 137 = Ping Frame
		// 138 = Pong Frame
		$_axHeader = array();
		$_axHeader[0] = 129;
		$_iLength = strlen($_sMessage);
		if ($_iLength > 65535)
		{
			$_asLengthBin = str_split(sprintf('%064b', $_iLength), 8);
			$_axHeader[1] = ($_bMasked == true) ? 255 : 127;
			for ($i=0; $i<8; $i++)
			{
				$_axHeader[$i+2] = bindec($_asLengthBin[$i]);
			}
		}
		else if ($_iLength > 125)
		{
			$_asLengthBin = str_split(sprintf('%016b', $_iLength), 8);
			$_axHeader[1] = ($_bMasked == true) ? 254 : 126;
			$_axHeader[2] = bindec($_asLengthBin[0]);
			$_axHeader[3] = bindec($_asLengthBin[1]);
		}
		else
		{
			$_axHeader[1] = ($_bMasked == true) ? $_iLength+128 : $_iLength;
		}
		
		foreach (array_keys($_axHeader) as $i) {$_axHeader[$i] = chr($_axHeader[$i]);} // convert to string
		
		$_asMask = array();
		if ($_bMasked == true)
		{
			for ($i=0; $i<4; $i++) {$_asMask[$i] = chr(rand(0,255));}
			$_axHeader = array_merge($_axHeader, $_asMask);
		}
		
		$_sEncodedMessage = implode('', $_axHeader);
		
		if ($_bMasked == true) {for ($i=0; $i<$_iLength; $i++) {$_sEncodedMessage .= $_sMessage[$i] ^ $_asMask[$i % 4];}}
		else {$_sEncodedMessage .= $_sMessage;}
		
		return $_sEncodedMessage;
		// return chr(0).$_sMessage.chr(255);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return sDecodedMessage [type]string[/type]
	[en]...[/en]
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	function decodeMessage($_sMessage)
	{
		$_sMessage = $this->getRealParameter(array('oParameters' => $_sMessage, 'sName' => 'sMessage', 'xParameter' => $_sMessage));
		
		if ($_sMessage === NULL) {$_sMessage = '';}

		$_iLength = ord($_sMessage[1]) & 127;
		if ($_iLength == 126)
		{
			$_sMask = substr($_sMessage, 4, 4);
			$_sData = substr($_sMessage, 8);
		}
		else if ($_iLength == 127)
		{
			$_sMask = substr($_sMessage, 10, 4);
			$_sData = substr($_sMessage, 14);
		}
		else
		{
			$_sMask = substr($_sMessage, 2, 4);
			$_sData = substr($_sMessage, 6);
		}
		
		$_sDecodedMessage = '';
		for ($i=0; $i<strlen($_sData); $i++)
		{
			$_sDecodedMessage .= $_sData[$i] ^ $_sMask[$i%4];
		}
		
		return $_sDecodedMessage;
	}
	/* @end method */
	
	/*
	@start method

	@description
	[en]...[/en]
	*/
	function clearLine() {echo "\r                                                    \r";}
	/* @end method */
}
/* @end class */
$oPGWebSockets = new classPG_WebSockets();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGWebSockets', 'xValue' => $oPGWebSockets));}

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_WebSocketsUser extends classPG_ClassBasics
{
	public $sID = '';
	public $oSocket = NULL;
	public $bHandshake = false;
	private $axUserData = array();
	
	/*
	@start method
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	
	@param xValue [needed][type]mixed[/type]
	[en]...[/en]
	*/
	public function setUserData($_sProperty, $_xValue = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_sProperty, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_sProperty = $this->getRealParameter(array('oParameters' => $_sProperty, 'sName' => 'sProperty', 'xParameter' => $_sProperty));
		$this->axUserData[$_sProperty] = $_xValue;
	}
	/* @end method */
	
	/*
	@start method
	
	@return xValue [type]mixed[/type]
	[en]...[/en]
	
	@param sProperty [needed][type]string[/type]
	[en]...[/en]
	*/
	public function getUserData($_sProperty)
	{
		$_sProperty = $this->getRealParameter(array('oParameters' => $_sProperty, 'sName' => 'sProperty', 'xParameter' => $_sProperty));
		return $this->axUserData[$_sProperty];
	}
	/* @end method */
}
/* @end class */
?>