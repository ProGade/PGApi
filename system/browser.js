/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura (ProGade)
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 22 2012
*/
var PG_BROWSER_CHROME = 'Chrome';
var PG_BROWSER_OPERA = 'Opera';
var PG_BROWSER_INTERNET_EXPLORER = 'Internet Explorer';
var PG_BROWSER_FIREFOX = 'Firefox';
var PG_BROWSER_PHOENIX = 'Phoenix';
var PG_BROWSER_MOZILLA = 'Mozilla';
var PG_BROWSER_NETSCAPE = 'Netscape';
var PG_BROWSER_SAFARI = 'Safari';
var PG_BROWSER_ANDROID = 'Android';
var PG_BROWSER_IPHONE = 'iPhone';

var PG_BROWSER_GOOGLEBOT = 'Google Bot';
var PG_BROWSER_YAHOOBOT = 'Yahoo! Bot';
var PG_BROWSER_ICHIROBOT = 'Ichiro Bot';
var PG_BROWSER_YANDEXBOT = 'YandexBot';
var PG_BROWSER_BINGBOT = 'Bing Bot';
var PG_BROWSER_FACEBOOKBOT = 'Facebook Bot';

var PG_BROWSER_PROVIDER_MSNBOT = 'MSN Bot';
var PG_BROWSER_PROVIDER_GOOGLEBOT = 'Google Bot';
var PG_BROWSER_PROVIDER_YAHOOBOT = 'Yahoo! Bot';
var PG_BROWSER_PROVIDER_SUPERGOOBOT = 'SuperGoo Ichiro Bot';
var PG_BROWSER_PROVIDER_YANDEXBOT = 'Yandex Bot';
		
var PG_BROWSER_PROVIDER_AOL = 'AOL';
var PG_BROWSER_PROVIDER_ALICEDSL = 'Alice DSL';
var PG_BROWSER_PROVIDER_ARCOR = 'Arcor';
var PG_BROWSER_PROVIDER_VODAFONE = 'Vodafone';
var PG_BROWSER_PROVIDER_TONLINE = 'T-Online';
var PG_BROWSER_PROVIDER_1UND1 = '1&1 Internet AG';
var PG_BROWSER_PROVIDER_1UND1_SERVER = '1&1 Internet AG Server';
var PG_BROWSER_PROVIDER_SERVER4YOU = 'Server 4 You';
var PG_BROWSER_PROVIDER_KABELDEUTSCHLAND = 'Kabel Deutschland';
		
var PG_BROWSER_PROVIDER_BADGMBH = 'BAD GmbH';
var PG_BROWSER_PROVIDER_FACEBOOK = 'Facebook';
var PG_BROWSER_PROVIDER_MEDIAWAYS = 'mediaWays GmbH Internet Services';
var PG_BROWSER_PROVIDER_BWL = 'Baden-W�rttemberg';

/*
@start class
@param extends classPG_ClassBasics
*/
function classPG_Browser()
{
	// Declarations...
	this.fOnSelectStart = null;
	this.fOnMouseDown = null;
	this.fOnClick = null;
	
	this.oFocusedElement = null;
	
	this.bRunOnceOnLoad = true;
	
	this.iScreenSizeX = 0;
	this.iScreenSizeY = 0;
	
	this.oTitleTimeout = null;
	
	this.iOrientation = (typeof(window.orientation) != 'undefined') ? window.orientation : 0;
	this.fOnOrientationChange = null;
	
	/*
	this.getIframeWindow = function(_sIframeID)
	{
		var _oWindow = null;
		var _oIframe = window.getElementById(_sIframeID);
		if (_oIframe) {_oWindow = (_oIframe.contentWindow || _oIframe.window);}
		return _oWindow;
	}
	
	this.getIframeDocument = function(_sIframeID)
	{
		var _oDocument = null;
		var _oIframe = window.getElementById(_sIframeID);
		if (_oIframe)
		{
			_oDocument = (_oIframe.contentWindow || _oIframe.contentDocument);
			if (_oDocument.document) {_oDocument = _oDocument.document;}
		}
		return _oDocument;
	}
	
	this.overwriteFrame = function(_sWindow, _sFrameToOverwrite, _sTargetFrame)
	{
		if (typeof(window.defineGetter) != 'undefined')
		{
alert(_sWindow+'.defineGetter("'+_sFrameToOverwrite+'", function() {return '+_sTargetFrame+'});');
			eval(_sWindow+'.defineGetter("'+_sFrameToOverwrite+'", function() {return '+_sTargetFrame+'});');
			return;
		}
		
		if (window.HTMLElement)
		{
			if (typeof(window.HTMLElement.prototype.__defineGetter__) != 'undefined')
			{
alert(_sWindow+'.prototype.HTMLElement.__defineGetter__("'+_sFrameToOverwrite+'",function() {return '+_sTargetFrame+';});');
				eval(_sWindow+'.prototype.HTMLElement.__defineGetter__("'+_sFrameToOverwrite+'",function() {return '+_sTargetFrame+';});');
				return;
			}
		}
		
		if (typeof(window.prototype) != 'undefined')
		{
alert(_sWindow+'.prototype.'+_sFrameToOverwrite+' = '+_sTargetFrame+';');
			eval(_sWindow+'.prototype.'+_sFrameToOverwrite+' = '+_sTargetFrame+';');
			return;
		}
		
alert(_sWindow+'.'+_sFrameToOverwrite+' = '+_sTargetFrame+';');
		// eval(_sWindow+'.'+_sFrameToOverwrite+' = window.self;');
		eval('top = self;');
	}
	*/
	
	this.axBrowserVersionParser = new Array(
		{'Search': "/.*\ Googlebot\/([0-9\.\,]+).*/gi",				'Replace': '\\1'},
		{'Search': "/.*\ Yahoo\!\ (.*).*/gi",						'Replace': '\\1'},
		{'Search': "/.*\ ichiro\/(.*).*/gi",						'Replace': '\\1'},
		{'Search': "/.*\ YandexBot\/([0-9\.\,]+).*/gi",				'Replace': '\\1'},
		{'Search': "/.*\ bingbot\/([0-9\.\,]+).*/gi",				'Replace': '\\1'},
		{'Search': "/(^|.*\ )facebook.*(\ |\/)([0-9\.\,]+).*/gi",	'Replace': '\\3'},
		
		{'Search': "/.*(\ |\/)Android(\ |\/)([0-9\.\,]+).*/gi",		'Replace': '\\3'},
		{'Search': "/.*(\ |\/)Chrome(\ |\/)([0-9\.\,]+).*/gi",		'Replace': '\\3'},
		{'Search': "/(.*\ |^)Opera(\ |\/)([0-9\.\,]+).*/gi",		'Replace': '\\3'},
		{'Search': "/.*\ Windows Phone\ ([0-9\.\,]+).*)/gi",		'Replace': '\\1'},
		{'Search': "/.*(\ |\/)MSIE(\ |\/)([0-9\.\,]+).*/gi",		'Replace': '\\3'},
		{'Search': "/.*\ iPhone\ OS\ ([0-9\.\,\_]+).*/gi",			'Replace': '\\1'},
		{'Search': "/.*Version(\ |\/)([0-9\.\,]+)\ Safari\/.*/gi",	'Replace': '\\2'},
		{'Search': "/.*(\ |\/)Navigator(\ |\/)([0-9\.\,]+)/gi",		'Replace': '\\3'},
		{'Search': "!.*(\ |\/)Firefox(\ |\/)([0-9\.\,]+).*!gi",		'Replace': '\\3'},
		{'Search': "/.*(\ |\/)Mozilla(\ |\/)([0-9\.\,]+).*/gi",		'Replace': '\\3'},
		{'Search': "/.*(\ |\/)IE(\ |\/)([0-9\.\,]+).*/gi",			'Replace': '\\3'},
		{'Search': "/.*(\ |\/)Explorer(\ |\/)([0-9\.\,]+).*/gi",	'Replace': '\\3'}
	);
	
	this.axBrowserNameParser = new Array(
		{'Search': "Googlebot", 'Replace': PG_BROWSER_GOOGLEBOT},
		{'Search': "Yahoo!", 'Replace': PG_BROWSER_YAHOOBOT},
		{'Search': "ichiro", 'Replace': PG_BROWSER_ICHIROBOT},
		{'Search': "YandexBot", 'Replace': PG_BROWSER_YANDEXBOT},
		{'Search': "bingbot", 'Replace': PG_BROWSER_BINGBOT},
		{'Search': "facebook", 'Replace': PG_BROWSER_FACEBOOKBOT},

		{'Search': "Android", 'Replace': PG_BROWSER_ANDROID},
		{'Search': "iPhone", 'Replace': PG_BROWSER_IPHONE},

		{'Search': "Chrome", 'Replace': PG_BROWSER_CHROME},
		{'Search': "Opera", 'Replace': PG_BROWSER_OPERA},
		{'Search': "Msie", 'Replace': PG_BROWSER_INTERNET_EXPLORER},
		{'Search': "Safari", 'Replace': PG_BROWSER_SAFARI},
		{'Search': "Navigator", 'Replace': PG_BROWSER_NETSCAPE},
		{'Search': "Netscape", 'Replace': PG_BROWSER_NETSCAPE},
		{'Search': "Firefox", 'Replace': PG_BROWSER_FIREFOX},
		{'Search': "Phoenix", 'Replace': PG_BROWSER_PHOENIX},
		{'Search': "Mozilla", 'Replace': PG_BROWSER_MOZILLA},
		{'Search': "IE", 'Replace': PG_BROWSER_INTERNET_EXPLORER},
		{'Search': "Explorer", 'Replace': PG_BROWSER_INTERNET_EXPLORER}
	);
	
	this.axProviderParser = new Array(
		{'Search': "msnbot", 'Replace': PG_BROWSER_PROVIDER_MSNBOT, 'Website': 'www.msn.de'},
		{'Search': "googlebot", 'Replace': PG_BROWSER_PROVIDER_GOOGLEBOT, 'Website': 'www.google.de'},
		{'Search': "crawl.yahoo", 'Replace': PG_BROWSER_PROVIDER_YAHOOBOT, 'Website': 'www.yahoo.de'},
		{'Search': "super-goo", 'Replace': PG_BROWSER_PROVIDER_SUPERGOOBOT, 'Website': ''},
		{'Search': "yandex", 'Replace': PG_BROWSER_PROVIDER_YANDEXBOT, 'Website': ''},

		{'Search': "aol", 'Replace': PG_BROWSER_PROVIDER_AOL, 'Website': ''},
		{'Search': "alicedsl", 'Replace': PG_BROWSER_PROVIDER_ALICEDSL, 'Website': ''},
		{'Search': "arcor", 'Replace': PG_BROWSER_PROVIDER_ARCOR, 'Website': ''},
		{'Search': "vodafone", 'Replace': PG_BROWSER_PROVIDER_VODAFONE, 'Website': ''},
		{'Search': "t-online", 'Replace': PG_BROWSER_PROVIDER_TONLINE, 'Website': ''},
		{'Search': "server4you.de", 'Replace': PG_BROWSER_PROVIDER_SERVER4YOU, 'Website': ''},
		{'Search': "onlinehome-server.info", 'Replace': PG_BROWSER_PROVIDER_1UND1_SERVER, 'Website': ''},
		
		{'Search': "bad-gmbh", 'Replace': PG_BROWSER_PROVIDER_BADGMBH, 'Website': 'www.bad-gmbh.de'},
		{'Search': "tfbnw.net", 'Replace': PG_BROWSER_PROVIDER_FACEBOOK, 'Website': 'www.facebook.com'},
		{'Search': "mediaWays", 'Replace': PG_BROWSER_PROVIDER_MEDIAWAYS, 'Website': 'www.mediaways.de'},
		{'Search': ".bwl.de", 'Replace': PG_BROWSER_PROVIDER_BWL, 'Website': 'www.bwl.de'},
		{'Search': "superkabel.de", 'Replace': PG_BROWSER_PROVIDER_KABELDEUTSCHLAND, 'Website': 'www.superkabel.de'}, // 188-194-200-212-dynip.superkabel.de

		{'Search': "pD9E0FAFA.dip0.t-ipconnect.de", 'Replace': PG_BROWSER_PROVIDER_1UND1, 'Website': ''},
		{'Search': "p54AE905A.dip0.t-ipconnect.de", 'Replace': PG_BROWSER_PROVIDER_1UND1, 'Website': ''},
		{'Search': "pd95b47de.dip0.t-ipconnect.de", 'Replace': PG_BROWSER_PROVIDER_TONLINE, 'Website': ''},

		{'Search': "p5DE67C1C.dip.t-dialin.net", 'Replace': '?', 'Website': ''},
		{'Search': "p54AED96E.dip.t-dialin.net", 'Replace': '?', 'Website': ''},
		{'Search': "p5DF3E04B.dip.t-dialin.net", 'Replace': '?', 'Website': ''},
		{'Search': "p5DF3B5F8.dip.t-dialin.net", 'Replace': '?', 'Website': ''},
		{'Search': "p54B1C704.dip.t-dialin.net", 'Replace': '?', 'Website': ''}
	);
	
	this.axOperatingSystemVersionParser = new Array(
		{'Search': "/.*\ Windows Phone(\ |\/)([0-9\.\,]+).*/gi", 'Replace': '\\2'},	// Windows Phone 8.0
		{'Search': "/.*\ Windows(\ |\/)(NT\ [0-9\.\,]+).*/gi", 'Replace': '\\2'},	// Windows NT 5.1
		{'Search': "/.*\ Android(\ |\/)([0-9\.\,]+).*/gi", 'Replace': '\\2'},	// Android 2.1
		{'Search': "/.*\ Ubuntu(\ |\/)([0-9\.\,]+).*/gi", 'Replace': '\\2'},	// Ubuntu/10.04
		{'Search': "/.*\ Linux(\ |\/)(i[0-9\.\,]+).*/gi", 'Replace': '\\2'},	// Linux i686
		{'Search': "/.*\ iPhone\ OS(\ |\/)([0-9\.\,\_]+).*/gi", 'Replace': '\\2'},	// iPhone OS 4_2_1
		{'Search': "/.*\ iPod\ OS(\ |\/)([0-9\.\,\_]+).*/gi", 'Replace': '\\2'},	// iPod OS 4_2_1
		{'Search': "/.*\ iPad\ OS(\ |\/)([0-9\.\,\_]+).*/gi", 'Replace': '\\2'},	// iPad OS 4_2_1
		{'Search': "/.*\ Mac\ OS\ X(\ |\/)([0-9\.\,\_]+).*/gi", 'Replace': '\\2'}	// Mac OS X 10_6_6
	);
	
	this.axOperatingSystemParser = new Array(
		{'Search': "Windows Phone", 'Replace': 'Windows Phone'},
		{'Search': "Windows", 'Replace': 'Windows'},
		{'Search': "BlackBerry", 'Replace': 'Black Berry'},
		{'Search': "Android", 'Replace': 'Android'},
		{'Search': "Symbian", 'Replace': 'Symbian'},
		{'Search': "Linux", 'Replace': 'Linux'},
		{'Search': "iPhone", 'Replace': 'iOS'},
		{'Search': "iPad", 'Replace': 'iOS'},
		{'Search': "iPod", 'Replace': 'iOS'},
		{'Search': "Mac OS", 'Replace': 'Mac OS'}
	);
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@group Mobile
	
	@return bMobile [type]bool[/type]
	[en]...[/en]
	*/
	this.isMobile = function()
	{
		switch (this.getOSName())
		{
			case 'Windows Phone':
			case 'Black Berry':
			case 'Android':
			case 'Symbian':
			case 'iOS':
			return true;
		}
		// if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {return true;}
		// if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false) {return true;}
		// if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Detection
	
	@return sInfo [type]string[/type]
	[en]...[/en]
	*/
	this.getBrowserInfo = function() {return navigator.userAgent;}
	/* @end method */
	this.getInfo = this.getBrowserInfo;
	
	/*
	@start method
	
	@group Browser
	
	@return sBrowserVersion [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	this.getBrowserVersion = function(_sBrowserInfo)
	{
		if (typeof(_sBrowserInfo) == 'undefined') {var _sBrowserInfo = null;}
		_sBrowserInfo = this.getRealParameter({'oParameters': _sBrowserInfo, 'sName': 'sBrowserInfo', 'xParameter': _sBrowserInfo});
		
		var _sBrowserVersion = '';
		if (_sBrowserInfo == null) {_sBrowserInfo = this.getBrowserInfo();}
		
		for (var i=0; i<this.axBrowserVersionParser.length; i++)
		{
			if ((_sBrowserVersion == _sBrowserInfo) || (_sBrowserVersion == ''))
			{
				_sBrowserVersion = _sBrowserInfo.replace(this.axBrowserVersionParser[i]['Search'], this.axBrowserVersionParser[i]['Replace']);
			}
		}

		if (_sBrowserVersion == _sBrowserInfo) {_sBrowserVersion = '[unknown version]';}
		
		_sBrowserVersion = _sBrowserVersion.replace(/_/g, '.');
		_sBrowserVersion = _sBrowserVersion.replace(/,/g, '.');
		
		return _sBrowserVersion;
	}
	/* @end method */
	this.getVersion = this.getBrowserVersion;
	
	/*
	@start method
	
	@group Browser
	
	@return sBrowserName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	this.getBrowserName = function(_sBrowserInfo)
	{
		if (typeof(_sBrowserInfo) == 'undefined') {var _sBrowserInfo = null;}
		_sBrowserInfo = this.getRealParameter({'oParameters': _sBrowserInfo, 'sName': 'sBrowserInfo', 'xParameter': _sBrowserInfo});
		if (_sBrowserInfo == null) {_sBrowserInfo = this.getBrowserInfo();}
		
		for (var i=0; i<this.axBrowserNameParser.length; i++)
		{
			if (_sBrowserInfo.indexOf(this.axBrowserNameParser[i]['Search']) != -1) {return this.axBrowserNameParser[i]['Replace'];}
		}

		return '[unknown browser]';
	}
	/* @end method */
	this.getName = this.getBrowserName;
	
	/*
	@start method
	
	@group Browser
	
	@return sLanguage [type]string[/type]
	[en]...[/en]
	*/
	this.getBrowserLanguage = function()
	{
		var _sLanguage = 'en';
		
		if (typeof(navigator.userLanguage) != 'undefined') {_sLanguage = navigator.userLanguage;}
		else if (typeof(navigator.systemLanguage) != 'undefined') {_sLanguage = navigator.systemLanguage;}
		else if (typeof(navigator.browserLanguage) != 'undefined') {_sLanguage = navigator.browserLanguage;}
		else if (typeof(navigator.language) != 'undefined') {_sLanguage = navigator.language;}
		
		_sLanguage = _sLanguage.replace(/([A-Za-z]{2}).*/gi, '$1');
		
		return _sLanguage;
	}
	/* @end method */
	this.getLanguage = this.getBrowserLanguage;
	
	/* TODO...
	public function getProviderInfo() {return gethostbyaddr($_SERVER["REMOTE_ADDR"]);}
	
	public function getProviderName($_sProviderInfo = NULL)
	{
		if ($_sProviderInfo == NULL) {$_sProviderInfo = $this->getProviderInfo();}
		
		for ($i=0; $i<count($this->axProviderParser); $i++)
		{
			if (stristr($_sProviderInfo, $this->axProviderParser[$i]['Search'])) {return $this->axProviderParser[$i]['Replace'];}
		}

		return '[unknown provider]';
	}	
	*/

	/*
	@start method
	
	@group OS
	
	@return sOsName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	this.getOperatingSystemName = function(_sBrowserInfo)
	{
		if (typeof(_sBrowserInfo) == 'undefined') {var _sBrowserInfo = null;}
		_sBrowserInfo = this.getRealParameter({'oParameters': _sBrowserInfo, 'sName': 'sBrowserInfo', 'xParameter': _sBrowserInfo});
		if (_sBrowserInfo == null) {_sBrowserInfo = this.getBrowserInfo();}
		
		for (var i=0; i<this.axOperatingSystemParser.length; i++)
		{
			if (_sBrowserInfo.indexOf(this.axOperatingSystemParser[i]['Search']) != -1) {return this.axOperatingSystemParser[i]['Replace'];}
		}
		
		return '[unknown operating system]';
	}
	/* @end method */
	this.getOperatingSystem = this.getOperatingSystemName;
	this.getOSName = this.getOperatingSystemName;
	this.getOS = this.getOperatingSystemName;

	/*
	@start method
	
	@group OS
	
	@return sOsVersion [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	this.getOperatingSystemVersion = function(_sBrowserInfo)
	{
		if (typeof(_sBrowserInfo) == 'undefined') {var _sBrowserInfo = null;}
		_sBrowserInfo = this.getRealParameter({'oParameters': _sBrowserInfo, 'sName': 'sBrowserInfo', 'xParameter': _sBrowserInfo});
		_sBrowserVersion = '';
		if (_sBrowserInfo == null) {_sBrowserInfo = this.getBrowserInfo();}
		
		for (var i=0; i<this.axOperatingSystemVersionParser.length; i++)
		{
			if ((_sBrowserVersion == _sBrowserInfo) || (_sBrowserVersion == ''))
			{
				_sBrowserVersion = _sBrowserInfo.replace(this.axOperatingSystemVersionParser[i]['Search'], this.axOperatingSystemVersionParser[i]['Replace']);
			}
		}

		if (_sBrowserVersion == _sBrowserInfo) {_sBrowserVersion = '[unknown version]';}
		
		_sBrowserVersion = _sBrowserVersion.replace(/_/g, '.');
		_sBrowserVersion = _sBrowserVersion.replace(/,/g, '.');
		
		return _sBrowserVersion;
	}
	/* @end method */
	this.getOSVersion = this.getOperatingSystemVersion;

	/*
	@start method
	
	@group Setup
	*/
	this.disableOnSelectStart = function(_eEvent) {return false;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	*/
	this.disableOnMouseDown = function(_eEvent) {return false;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	*/
	this.enableOnClick = function(_eEvent) {return true;}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	*/
	this.initSelect = function()
	{
		if (typeof(this.oDocument.onselectstart) != 'undefined') {this.fOnSelectStart = this.oDocument.onselectstart;}
		if (typeof(this.oDocument.onmousedown) != 'undefined') {this.fOnMouseDown = this.oDocument.onmousedown;}
		if (typeof(this.oDocument.onclick) != 'undefined') {this.fOnClick = this.oDocument.onclick;}
		/*
		if (this.oWindow.sidebar)
		{
			// alert(this.oWindow.sidebar);
			this.fOnMouseDown = this.oDocument.onmousedown;
			this.fOnClick = this.oDocument.onclick;
		}
		*/
		// alert(this.fOnSelectStart+" ; "+this.fOnMouseDown+" ; "+this.fOnClick);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	*/
	this.enableSelect = function()
	{
		/*
		if (this.oWindow.sidebar)
		{
			this.oDocument.onmousedown = this.fOnMouseDown;
			this.oDocument.onclick = this.fOnClick;
		}
		*/
		if (typeof(this.oDocument.onselectstart) != 'undefined') {this.oDocument.onselectstart = this.fOnSelectStart;}
		if (typeof(this.oDocument.onmousedown) != 'undefined') {this.oDocument.onmousedown = this.fOnMouseDown;}
		if (typeof(this.oDocument.onclick) != 'undefined') {this.oDocument.onclick = this.fOnClick;}
	
		if (typeof(event) != "undefined")
		{
			if (event.preventDefault)
			{
			}
			else
			{
				event.returnValue = true;
				event.cancelBubble = false;
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	*/
	this.disableSelect = function()
	{
		/*
		if (this.oWindow.sidebar)
		{
			this.oDocument.onmousedown = this.disableOnMouseDown;
			this.oDocument.onclick = this.enableOnClick;
		}
		*/
		if (typeof(this.oDocument.onselectstart) != 'undefined') {this.oDocument.onselectstart = this.disableOnSelectStart;}
		if (typeof(this.oDocument.onmousedown) != 'undefined') {this.oDocument.onmousedown = this.disableOnMouseDown;}
		if (typeof(this.oDocument.onclick) != 'undefined') {this.oDocument.onclick = this.enableOnClick;}
	
		if (typeof(event) != "undefined")
		{
			if (event.preventDefault)
			{
				event.preventDefault();
				event.stopPropagation();
			}
			else
			{
				event.returnValue = false;
				event.cancelBubble = true;
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Desktop
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	*/
	this.getDesktopSizeX = function() {return screen.availWidth;}
	/* @end method */

	/*
	@start method
	
	@group Desktop
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.getDesktopSizeY = function() {return screen.availHeight;}
	/* @end method */
	
	/*
	@start method
	
	@group Screen
	
	@return oSize [type]object[/type]
	[en]...[/en]
	*/
	this.getScreenSize = function()
	{
		if ((this.oWindow) && (this.oDocument))
		{
			var _bIsNetscape = (navigator.appName.indexOf("Netscape") != -1);
			var _oSize = new Object();
			if (typeof(this.oDocument.documentElement) != 'undefined')
			{
				_oSize.x = _bIsNetscape ? this.oWindow.innerWidth : this.oDocument.documentElement.clientWidth;
				_oSize.y = _bIsNetscape ? this.oWindow.innerHeight : this.oDocument.documentElement.clientHeight;
			}
			else
			{
				_oSize.x = _bIsNetscape ? this.oWindow.innerWidth : this.oDocument.body.clientWidth;
				_oSize.y = _bIsNetscape ? this.oWindow.innerHeight : this.oDocument.body.clientHeight;
			}
			return _oSize;
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Screen
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	*/
	this.getScreenSizeX = function()
	{
		var _iSizeX = 0;
		if ((this.oWindow) && (this.oDocument))
		{
			if (typeof(this.oDocument.documentElement) != 'undefined')
			{
				if (typeof(this.oDocument.documentElement.clientWidth) != 'undefined')
				{
					_iSizeX = this.oDocument.documentElement.clientWidth;
				}
			}
			if ((typeof(this.oWindow.innerWidth) != 'undefined') && (_iSizeX == 0)) {_iSizeX = this.oWindow.innerWidth;}
			if ((typeof(this.oDocument.body.clientWidth) != 'undefined') && (_iSizeX == 0)) {_iSizeX = this.oDocument.body.clientWidth;}
			if ((typeof(this.oDocument.body.offsetWidth) != 'undefined') && (_iSizeX == 0)) {_iSizeX = this.oDocument.body.offsetWidth;}
		}
		return _iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Screen
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.getScreenSizeY = function()
	{
		var _iSizeY = 0;
		if ((this.oWindow) && (this.oDocument))
		{
			if (typeof(this.oDocument.documentElement) != 'undefined')
			{
				if (typeof(this.oDocument.documentElement.clientHeight) != 'undefined')
				{
					_iSizeY = this.oDocument.documentElement.clientHeight;
				}
			}
			if ((typeof(this.oWindow.innerHeight) != 'undefined') && (_iSizeY == 0)) {_iSizeY = this.oWindow.innerHeight;}
			if ((typeof(this.oDocument.body.clientHeight) != 'undefined') && (_iSizeY == 0)) {_iSizeY = this.oDocument.body.clientHeight;}
			if ((typeof(this.oDocument.body.offsetHeight) != 'undefined') && (_iSizeY == 0)) {_iSizeY = this.oDocument.body.offsetHeight;}
		}
		return _iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	
	@return bResized [type]bool[/type]
	[en]...[/en]
	*/
	this.onResizeTest = function()
	{
		var _iScreenSizeX = this.getScreenSizeX();
		var _iScreenSizeY = this.getScreenSizeY();
		if ((_iScreenSizeX != this.iScreenSizeX) || (_iScreenSizeY != this.iScreenSizeY))
		{
			this.iScreenSizeX = _iScreenSizeX;
			this.iScreenSizeY = _iScreenSizeY;
			return true;
		}
		return false;
	}
	/* @end method */
	this.isRealResized = this.onResizeTest;
	this.isResized = this.onResizeTest;
	
	/*
	@start method
	
	@group Detection
	
	@return bMinimized [type]bool[/type]
	[en]...[/en]
	*/
	this.isMinimized = function()
	{
		var _iScreenPosX = 0;
		if (typeof(this.oWindow.screenLeft) != 'undefined') {_iScreenPosX = this.oWindow.screenLeft;}
		else if (typeof(this.oWindow.screenX) != 'undefined') {_iScreenPosX = this.oWindow.screenX;}
		if (_iScreenPosX == -32000) {return true;}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Detection
	
	@return bMaximized [type]bool[/type]
	[en]...[/en]
	*/
	this.isMaximized = function()
	{
		if ((this.oWindow.outerWidth >= this.getDesktopSizeX())
		&& (this.oWindow.outerHeight >= this.getDesktopSizeY()))
		{
			return true;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param sMessage [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setStatus = function(_sMessage) {this.oWindow.status = _sMessage;}
	/* @end method */

	/*
	@start method
	
	@group Setup
	
	@param sTitle [needed][type]string[/type]
	[en]...[/en]
	
	@param iTimeout [type]int[/type]
	[en]...[/en]
	
	@param iScrollCharSteps [type]int[/type]
	[en]...[/en]
	
	@param sBlinkTitle [type]string[/type]
	[en]...[/en]
	*/
	this.setTitle = function(_sTitle, _iTimeout, _iScrollCharSteps, _sBlinkTitle)
	{
		if (typeof(_sTitle) == 'undefined') {var _sTitle = null;}
		if (typeof(_iTimeout) == 'undefined') {var _iTimeout = null;}
		if (typeof(_iScrollCharSteps) == 'undefined') {var _iScrollCharSteps = null;}
		if (typeof(_sBlinkTitle) == 'undefined') {var _sBlinkTitle = null;}

		_iTimeout = this.getRealParameter({'oParameters': _sTitle, 'sName': 'iTimeout', 'xParameter': _iTimeout});
		_iScrollCharSteps = this.getRealParameter({'oParameters': _sTitle, 'sName': 'iScrollCharSteps', 'xParameter': _iScrollCharSteps});
		_sBlinkTitle = this.getRealParameter({'oParameters': _sTitle, 'sName': 'sBlinkTitle', 'xParameter': _sBlinkTitle});
		_sTitle = this.getRealParameter({'oParameters': _sTitle, 'sName': 'sTitle', 'xParameter': _sTitle});
		
		if (_iTimeout == null) {_iTimeout = 0;}
		if (_sBlinkTitle == null) {_sBlinkTitle = '';}
		
		if (_sBlinkTitle != '')
		{
			var _sTitle2 = _sTitle;
			_sTitle = _sBlinkTitle;
			_sBlinkTitle = _sTitle2;
		}
		this.oDocument.title = _sTitle;
		
		if ((_iScrollCharSteps != null) && (_iScrollCharSteps != 0))
		{
			if (typeof(oPGStrings))
			{
				_sTitle = oPGStrings.moveChars({'sString': _sTitle, 'iCharSteps': _iScrollCharSteps});
				if (_sBlinkTitle != '') {_sBlinkTitle = oPGStrings.moveChars({'sString': _sBlinkTitle, 'iCharSteps': _iScrollCharSteps});}
			}
		}
		
		if (this.oTitleTimeout != null) {this.oWindow.clearTimeout(this.oTitleTimeout); this.oTitleTimeout = null;}
		if (_iTimeout > 0) {this.oTitleTimeout = this.oWindow.setTimeout("oPGBrowser.setTitle({'sTitle': '"+_sTitle+"', 'iTimeout': "+_iTimeout+", 'iScrollCharSteps': "+_iScrollCharSteps+", 'sBlinkTitle': '"+_sBlinkTitle+"'})", _iTimeout);}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Setup
	
	@param sTitle [needed][type]string[/type]
	[en]...[/en]
	
	@param iTimeout [type]int[/type]
	[en]...[/en]
	
	@param iCurrentUpperChar [type]int[/type]
	[en]...[/en]
	
	@param sDefaultChar [type]string[/type]
	[en]...[/en]
	
	@param iUpperCharsCount [type]int[/type]
	[en]...[/en]
	
	@param bPong [type]bool[/type]
	[en]...[/en]
	
	@param iDirection [type]int[/type]
	[en]...[/en]
	
	@param bChangeUpperAndLower [type]bool[/type]
	[en]...[/en]
	*/
	this.setTitleWave = function(_sTitle, _iTimeout, _iCurrentUpperChar, _sDefaultChar, _iUpperCharsCount, _bPong, _iDirection, _bChangeUpperAndLower)
	{
		if (typeof(_sTitle) == 'undefined') {var _sTitle = null;}
		if (typeof(_iTimeout) == 'undefined') {var _iTimeout = null;}
		if (typeof(_iCurrentUpperChar) == 'undefined') {var _iCurrentUpperChar = null;}
		if (typeof(_bPong) == 'undefined') {var _bPong = null;}
		if (typeof(_sDefaultChar) == 'undefined') {var _sDefaultChar = null;}
		if (typeof(_iUpperCharsCount) == 'undefined') {var _iUpperCharsCount = null;}
		if (typeof(_iDirection) == 'undefined') {var _iDirection = null;}

		_iTimeout = this.getRealParameter({'oParameters': _sTitle, 'sName': 'iTimeout', 'xParameter': _iTimeout});
		_iCurrentUpperChar = this.getRealParameter({'oParameters': _sTitle, 'sName': 'iCurrentUpperChar', 'xParameter': _iCurrentUpperChar});
		_sDefaultChar = this.getRealParameter({'oParameters': _sTitle, 'sName': 'sDefaultChar', 'xParameter': _sDefaultChar});
		_iUpperCharsCount = this.getRealParameter({'oParameters': _sTitle, 'sName': 'iUpperCharsCount', 'xParameter': _iUpperCharsCount});
		_bPong = this.getRealParameter({'oParameters': _sTitle, 'sName': 'bPong', 'xParameter': _bPong});
		_iDirection = this.getRealParameter({'oParameters': _sTitle, 'sName': 'iDirection', 'xParameter': _iDirection});
		_bChangeUpperAndLower = this.getRealParameter({'oParameters': _sTitle, 'sName': 'bChangeUpperAndLower', 'xParameter': _bChangeUpperAndLower});
		_sTitle = this.getRealParameter({'oParameters': _sTitle, 'sName': 'sTitle', 'xParameter': _sTitle});
		
		if (_iTimeout == null) {_iTimeout = 0;}
		if (_iCurrentUpperChar == null) {_iCurrentUpperChar = 0;}
		if (_sDefaultChar == null) {_sDefaultChar = '.';}
		if (_iUpperCharsCount == null) {_iUpperCharsCount = 1;}
		if (_iDirection == null) {_iDirection = 1;}
		
		if (typeof(oPGStrings))
		{
			this.oDocument.title = oPGStrings.toWave({'sString': _sTitle, 'iCurrentUpperChar': _iCurrentUpperChar, 'sDefaultChar': _sDefaultChar, 'iUpperCharsCount': _iUpperCharsCount, 'bChangeUpperAndLower': _bChangeUpperAndLower});
			_iCurrentUpperChar += _iDirection;
			if (_iCurrentUpperChar >= _sTitle.length)
			{
				if (_bPong == true) {_iDirection = -1;}
				else {_iCurrentUpperChar = -_iUpperCharsCount;}
			}
			else if (_iCurrentUpperChar < -_iUpperCharsCount)
			{
				if (_bPong == true)
				{
					_iCurrentUpperChar = -_iUpperCharsCount;
					_iDirection = 1;
				}
				else {_iCurrentUpperChar = _sTitle.length;}
			}
		}

		if (this.oTitleTimeout != null) {this.oWindow.clearTimeout(this.oTitleTimeout); this.oTitleTimeout = null;}
		if (_iTimeout > 0) {this.oTitleTimeout = this.oWindow.setTimeout("oPGBrowser.setTitleWave({'sTitle': '"+_sTitle+"', 'iTimeout': "+_iTimeout+", 'iCurrentUpperChar': "+_iCurrentUpperChar+", 'sDefaultChar': '"+_sDefaultChar+"', 'iUpperCharsCount': "+_iUpperCharsCount+", 'bPong': "+_bPong.toString()+", 'iDirection': "+_iDirection+", 'bChangeUpperAndLower': "+_bChangeUpperAndLower.toString()+"})", _iTimeout);}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	
	@return oScrollPos [type]object[/type]
	[en]...[/en]
	*/
	this.getScrollPos = function()
	{
		if ((this.oWindow) && (this.oDocument))
		{
			var _oScrollPos = new Object();
			/*
			var _bIsNetscape = (navigator.appName.indexOf("Netscape") != -1);
			_oScrollPos.x = _bIsNetscape ? pageXOffset : this.oDocument.body.scrollLeft;
			_oScrollPos.y = _bIsNetscape ? pageYOffset : this.oDocument.body.scrollTop;
			*/

			if (this.oDocument.documentElement && this.oDocument.documentElement.scrollTop)	// Explorer 6 Strict
			{
				_oScrollPos.x = this.oDocument.documentElement.scrollLeft;
				_oScrollPos.y = this.oDocument.documentElement.scrollTop;
			}
			else if (this.oDocument.body) // all other Explorers
			{
				_oScrollPos.x = this.oDocument.body.scrollLeft;
				_oScrollPos.y = this.oDocument.body.scrollTop;
			}
			else if (self.pageXOffset) // all except Explorer
			{
				_oScrollPos.x = self.pageXOffset;
				_oScrollPos.y = self.pageYOffset;
			}

			return _oScrollPos;
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Popup
	
	@return oPopupWindow [type]object[/type]
	[en]...[/en]
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	
	@param iSizeX [needed][type]int[/type]
	[en]...[/en]
	
	@param iSizeY [needed][type]int[/type]
	[en]...[/en]
	
	@param sWinName [type]string[/type]
	[en]...[/en]
	
	@param bScrollbars [type]bool[/type]
	[en]...[/en]
	
	@param bResizable [type]bool[/type]
	[en]...[/en]
	
	@param iPosX [type]int[/type]
	[en]...[/en]
	
	@param iPosY [type]int[/type]
	[en]...[/en]
	*/
	this.popup = function(_sUrl, _iSizeX, _iSizeY, _sWinName, _bScrollbars, _bResizable, _iPosX, _iPosY)
	{
		if (typeof(_iSizeX) == 'undefined') {var _iSizeX = 750;}
		if (typeof(_iSizeY) == 'undefined') {var _iSizeY = 500;}
		if (typeof(_sWinName) == 'undefined') {var _sWinName = '';}
		if (typeof(_bScrollbars) == 'undefined') {var _bScrollbars = true;}
		if (typeof(_bResizable) == 'undefined') {var _bResizable = true;}
		if (typeof(_iPosX) == 'undefined') {var _iPosX = null;}
		if (typeof(_iPosY) == 'undefined') {var _iPosY = null;}

		_iSizeX = this.getRealParameter({'oParameters': _sUrl, 'sName': 'iSizeX', 'xParameter': _iSizeX});
		_iSizeY = this.getRealParameter({'oParameters': _sUrl, 'sName': 'iSizeY', 'xParameter': _iSizeY});
		_sWinName = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sWinName', 'xParameter': _sWinName});
		_bScrollbars = this.getRealParameter({'oParameters': _sUrl, 'sName': 'bScrollbars', 'xParameter': _bScrollbars});
		_bResizable = this.getRealParameter({'oParameters': _sUrl, 'sName': 'bResizable', 'xParameter': _bResizable});
		_iPosX = this.getRealParameter({'oParameters': _sUrl, 'sName': 'iPosX', 'xParameter': _iPosX});
		_iPosY = this.getRealParameter({'oParameters': _sUrl, 'sName': 'iPosY', 'xParameter': _iPosY});
		_sUrl = this.getRealParameter({'oParameters': _sUrl, 'sName': 'sUrl', 'xParameter': _sUrl});

		if (_iSizeX > screen.width) {_iSizeX = screen.width;}
		if (_iSizeY > screen.height) {_iSizeX = screen.height;}
		
		if (_iPosX == null) {_iPosX = Math.floor((screen.width-_iSizeX)/2);}
		if (_iPosY == null) {_iPosY = Math.floor((screen.height-_iSizeY)/2);}

		var _sProperties = "scrollbars=";
		if (_bScrollbars == true) {_sProperties += "yes";} else {_sProperties += "no";}
		_sProperties += ",resizable=";
		if (_bResizable == true) {_sProperties += "yes";} else {_sProperties += "no";}
		_sProperties = "top="+_iPosY+",left="+_iPosX+",width="+_iSizeX+",height="+_iSizeY+",location=no,toolbar=no,menubar=no,status=no,"+_sProperties;
		return this.oWindow.open(_sUrl, _sWinName, _sProperties);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Element
	
	@return oElement [type]object[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getElementObject = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		switch (typeof(_xElement))
		{
			case 'string': return this.oDocument.getElementById(_xElement);
			case 'object': return _xElement;
		}
		return null;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Element
	
	@return iPosX [type]int[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDocumentOffsetX = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oElement = this.getElementObject({'xElement': _xElement});
		var _iPosX = 0;
		if (_oElement)
		{
			while ((typeof(_oElement) == 'object') && (typeof(_oElement.tagName) != 'undefined'))
			{
				_iPosX += parseInt(_oElement.offsetLeft);
				if (_oElement.tagName.toUpperCase() == 'BODY') {_oElement = 0; return _iPosX;}
				else if (_oElement.tagName.toUpperCase() == 'DIV') {_iPosX -= _oElement.scrollLeft;}
				if (typeof(_oElement) == 'object') {if (typeof(_oElement.offsetParent) == 'object') {_oElement = _oElement.offsetParent;}}
				if (_oElement == null) {return _iPosX;}
			}
		}
		return _iPosX;
	}
	/* @end method */

	/*
	@start method
	
	@group Element
	
	@return iPosY [type]int[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getDocumentOffsetY = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oElement = this.getElementObject({'xElement': _xElement});
		var _iPosY = 0;
		if (_oElement)
		{
			while ((typeof(_oElement) == 'object') && (typeof(_oElement.tagName) != 'undefined'))
			{
				_iPosY += parseInt(_oElement.offsetTop);
				if (_oElement.tagName.toUpperCase() == 'BODY') {_oElement = 0; return _iPosY;}
				else if (_oElement.tagName.toUpperCase() == 'DIV') {_iPosY -= _oElement.scrollTop;}
				if (typeof(_oElement) == 'object') {if (typeof(_oElement.offsetParent) == 'object') {_oElement = _oElement.offsetParent;}}
				if (_oElement == null) {return _iPosY;}
			}
		}
		return _iPosY;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Element
	
	@return iSizeX [type]int[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getSizeX = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oElement = this.getElementObject({'xElement': _xElement});
		var _iSizeX = 0;
		if (_oElement)
		{
			_iSizeX = parseInt(_oElement.offsetWidth);
			if (isNaN(_iSizeX))
			{
				_iSizeX = 0;
				if ((_iSizeX < 1) && (typeof(_oElement.style.width) != 'undefined')) {_iSizeX = parseInt(_oElement.style.width);}
				if (isNaN(_iSizeX)) {_iSizeX = 0;}
				if ((_iSizeX < 1) && (typeof(_oElement.width) != 'undefined')) {_iSizeX = parseInt(_oElement.width);}
				if (isNaN(_iSizeX)) {_iSizeX = 0;}

				var _iPaddingLeft = parseInt(oPGCss.getProperty({'xElement': _oElement, 'sName': 'PaddingLeft'}));
				var _iPaddingRight = parseInt(oPGCss.getProperty({'xElement': _oElement, 'sName': 'PaddingRight'}));
			
				if (_iPaddingLeft > 0) {_iSizeX += _iPaddingLeft;}
				if (_iPaddingRight > 0) {_iSizeX += _iPaddingRight;}
			}
		}
		return _iSizeX;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Element
	
	@return iSizeY [type]int[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getSizeY = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		var _oElement = this.getElementObject({'xElement': _xElement});
		var _iSizeY = 0;
		if (_oElement)
		{
			_iSizeY = parseInt(_oElement.offsetHeight);
			if (isNaN(_iSizeY))
			{
				_iSizeY = 0;
				if ((_iSizeY < 1) && (typeof(_oElement.style.height) != 'undefined')) {_iSizeY = parseInt(_oElement.style.height);}
				if (isNaN(_iSizeY)) {_iSizeY = 0;}
				if ((_iSizeY < 1) && (typeof(_oElement.height) != 'undefined')) {_iSizeY = parseInt(_oElement.height);}
				if (isNaN(_iSizeY)) {_iSizeY = 0;}
				
				var _iPaddingTop = parseInt(oPGCss.getProperty({'xElement': _oElement, 'sName': 'PaddingTop'}));
				var _iPaddingBottom = parseInt(oPGCss.getProperty({'xElement': _oElement, 'sName': 'PaddingBottom'}));

				if (_iPaddingTop > 0) {_iSizeY += _iPaddingTop;}
				if (_iPaddingBottom > 0) {_iSizeY += _iPaddingBottom;}
			}
		}
		return _iSizeY;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]...[/en]
	
	@return bContains [type]bool[/type]
	[en]...[/en]
	
	@param iPosX [needed][type]int[/type]
	[en]...[/en]
	
	@param iPosY [needed][type]int[/type]
	[en]...[/en]
	
	@param xElement [type]mixed[/type]
	[en]...[/en]
	
	@param iRectPosX [type]int[/type]
	[en]...[/en]
	
	@param iRectPosY [type]int[/type]
	[en]...[/en]
	
	@param iRectSizeX [type]int[/type]
	[en]...[/en]
	
	@param iRectSizeY [type]int[/type]
	[en]...[/en]
	*/
	this.rectContains = function(_iPosX, _iPosY, _xElement, _iRectPosX, _iRectPosY, _iRectSizeX, _iRectSizeY)
	{
		_iPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosY', 'xParameter': _iPosY});
		_xElement = this.getRealParameter({'oParameters': _iPosX, 'sName': 'xElement', 'xParameter': _xElement});
		_iRectPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iRectPosX', 'xParameter': _iRectPosX});
		_iRectPosY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iRectPosY', 'xParameter': _iRectPosY});
		_iRectSizeX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iRectSizeX', 'xParameter': _iRectSizeX});
		_iRectSizeY = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iRectSizeY', 'xParameter': _iRectSizeY});
		_iPosX = this.getRealParameter({'oParameters': _iPosX, 'sName': 'iPosX', 'xParameter': _iPosX});
		
		if (_xElement != null)
		{
			var _oElement = this.getElementObject({'xElement': _xElement});
			if (_oElement)
			{
				_iRectPosX = this.getDocumentOffsetX({'xElement': _oElement});
				_iRectPosY = this.getDocumentOffsetY({'xElement': _oElement});
				_iRectSizeX = this.getSizeX({'xElement': _oElement});
				_iRectSizeY = this.getSizeY({'xElement': _oElement});
			}
		}
		
		if (
			(_iPosX > _iRectPosX) && (_iPosX <= _iRectPosX+_iRectSizeX)
			&& (_iPosY > _iRectPosY) && (_iPosY <= _iRectPosY+_iRectSizeY)
		)
		{
			return true;
		}
		
		return false;
	}
	/* @end method */
	
	/*
	this.setHTML = function(_sContainerID, _sHTML, _sJsToExecuteOnLoading, _sJsToExecuteOnDone)
	{
		var _oContainer = this.oDocument.getElementById(_sContainerID);
		if ((_oContainer) && (typeof(oPGStrings) != 'undefined'))
		{
			_oContainer.innerHTML = _sHTML;
			alert(oPGStrings.addSlashes(_sHTML));
			this.checkHTMLIsSet(_sContainerID, oPGStrings.stringToUtf8(_sHTML), oPGStrings.stringToUtf8(_sJsToExecuteOnLoading), oPGStrings.stringToUtf8(_sJsToExecuteOnDone));
		}
	}
	
	this.checkHTMLIsSet = function(_sContainerID, _sHTML, _sJsToExecuteOnLoading, _sJsToExecuteOnDone)
	{
		var _oContainer = this.oDocument.getElementById(_sContainerID);
		if (_oContainer)
		{
			alert(_oContainer.innerHTML+" != "+oPGStrings.stripSlashes(oPGStrings.utf8ToString(_sHTML)));
			if (_oContainer.innerHTML != oPGStrings.stripSlashes(oPGStrings.utf8ToString(_sHTML)))
			{
				if ((typeof(oPGStrings) != 'undefined') && (_sJsToExecuteOnLoading != '')) {eval(oPGStrings.utf8ToString(oPGStrings.stripSlashes(_sJsToExecuteOnLoading)));}
				this.oWindow.setTimeout("oPGBrowser.checkHTMLIsSet('"+_sContainerID+"', '"+oPGStrings.addSlashes(_sHTML)+"', '"+oPGStrings.addSlashes(_sJsToExecuteOnLoading)+"', '"+oPGStrings.addSlashes(_sJsToExecuteOnDone)+"')", 100);
			}
			else
			{
				if ((typeof(oPGStrings) != 'undefined') && (_sJsToExecuteOnDone != '')) {eval(oPGStrings.utf8ToString(oPGStrings.stripSlashes(_sJsToExecuteOnDone)));}
			}
		}
	}
	*/
	
	/*
	this.getFocusedElement = function() {return this.oFocusedElement;}
	
	this.onFocus = function(_eEvent)
	{
		if (!_eEvent) {_eEvent = window.event;} // For IE.
		this.oFocusedElement = arguments[0].target || _eEvent.srcElement;
	}
	*/
	
	/*
	@start method
	
	@group Element
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]string[/type]
	[en]...[/en]
	*/
	this.setOuterHtml = function(_xElement, _sHtml)
	{		
		_sHtml = this.getRealParameter({'oParameters': _oElement, 'sName': 'sHtml', 'xParameter': _sHtml});
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = null;
		if (typeof(_xElement) == 'string') {_oElement = this.oDocument.getElementById(_xElement);} else {_oElement = _xElement;}

		var _oRange = _oElement.ownerDocument.createRange();
		_oRange.setStartBefore(_oElement);
		var _oFragment = _oRange.createContextualFragment(_sHtml);
		_oElement.parentNode.replaceChild(_oFragment, _oElement);
	}
	/* @end method */

	/*
	@start method
	
	@group Element
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getOuterHtml = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = null;
		if (typeof(_xElement) == 'string') {_oElement = this.oDocument.getElementById(_xElement);} else {_oElement = _xElement;}

		var _oElement = this.oDocument.createElement("div");
		_oElement.appendChild(_oElement.cloneNode(true));
		return _oElement.innerHTML;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Element
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	
	@param sHtml [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.setInnerHtml = function(_xElement, _sHtml)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});

		var _oElement = null;
		if (typeof(_xElement) == 'string') {_oElement = this.oDocument.getElementById(_xElement);} else {_oElement = _xElement;}
		
		if (_oElement == null) {return null;}
		_oElement.innerHTML = _sHtml;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Element
	
	@return sHtml [type]string[/type]
	[en]...[/en]
	
	@param xElement [needed][type]mixed[/type]
	[en]...[/en]
	*/
	this.getInnerHtml = function(_xElement)
	{
		_xElement = this.getRealParameter({'oParameters': _xElement, 'sName': 'xElement', 'xParameter': _xElement, 'bNotNull': true});
		
		var _oElement = null;
		if (typeof(_xElement) == 'string') {_oElement = this.oDocument.getElementById(_xElement);} else {_oElement = _xElement;}

		if (_oElement == null) {return null;}
		return _oElement.innerHTML;
	}
	/* @end method */
	
	/*
	this.initLandscapeListener = function()
	{
		if (typeof(window.matchMedia) != 'undefined')
		{
			alert('matchMedia is supported!');
			this.oLandscapeOrientation = window.matchMedia("(orientation:landscape)");
			this.oLandscapeOrientation.addListener(oPGBrowser.onLandscapeOrientationChange);
		}
		else {alert('matchMedia is not supported!');}
	}
	
	this.onLandscapeOrientationChange = function(_onLandscapeOrientation)
	{
		if (_onLandscapeOrientation.matches) {oPGBrowser.bIsLandscape = true;}
		else {oPGBrowser.bIsLandscape = false;}
		if (oPGBrowser.fOnLandscapeOrientationChange != null) {oPGBrowser.fOnLandscapeOrientationChange(oPGBrowser.bIsLandscape);}
	}
	
	this.setLandscapeOrientationChangeFunction = function(_fFunction)
	{
		this.fOnLandscapeOrientationChange = _fFunction;
	}
	*/
	
	/*
	@start method
	
	@group Mobile
	
	@param fFunction [needed][type]function[/type]
	[en]...[/en]
	*/
	this.setOnOrientationChangeFunction = function(_fFunction)
	{
		_fFunction = this.getRealParameter({'oParameters': _fFunction, 'sName': 'fFunction', 'xParameter': _fFunction});
		this.fOnOrientationChange = _fFunction;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mobile
	*/
	this.onResize = function()
	{
		if (oPGBrowser.isResized())
		{
			if (oPGBrowser.isOrientationChanged())
			{
				if (oPGBrowser.fOnOrientationChange != null) {oPGBrowser.fOnOrientationChange();}
			}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mobile
	
	@return bIsChanged [type]bool[/type]
	[en]...[/en]
	*/
	this.isOrientationChanged = function()
	{
		if (typeof(window.orientation) != "undefined")
		{
			var _iOrientation = window.orientation;
			if (oPGBrowser.iOrientation != _iOrientation)
			{
				oPGBrowser.iOrientation = _iOrientation;
				return true;
			}
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Mobile
	
	@return iOrientation [type]int[/type]
	[en]...[/en]
	*/
	this.getOrientation = function() {return oPGBrowser.iOrientation;}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	
	@param eEvent [needed][type]object[/type]
	[en]...[/en]
	*/
	this.onLoad = function(_eEvent)
	{
		if (this.bRunOnceOnLoad == true)
		{
			this.initSelect();
			// this.initLandscapeListener();
			this.bRunOnceOnLoad = false;
		}
	}
	/* @end method */
	this.init = this.onLoad;
}
/* @end class */
classPG_Browser.prototype = new classPG_ClassBasics();
var oPGBrowser = new classPG_Browser();
