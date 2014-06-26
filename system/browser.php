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
define('PG_BROWSER_CHROME', 'Chrome');
define('PG_BROWSER_OPERA', 'Opera');
define('PG_BROWSER_INTERNET_EXPLORER', 'Internet Explorer');
define('PG_BROWSER_FIREFOX', 'Firefox');
define('PG_BROWSER_PHOENIX', 'Phoenix');
define('PG_BROWSER_MOZILLA', 'Mozilla');
define('PG_BROWSER_NETSCAPE', 'Netscape');
define('PG_BROWSER_SAFARI', 'Safari');
define('PG_BROWSER_ANDROID', 'Android');
define('PG_BROWSER_IPHONE', 'iPhone');

define('PG_BROWSER_GOOGLEBOT', 'Google Bot');
define('PG_BROWSER_YAHOOBOT', 'Yahoo! Bot');
define('PG_BROWSER_ICHIROBOT', 'Ichiro Bot');
define('PG_BROWSER_YANDEXBOT', 'YandexBot');
define('PG_BROWSER_BINGBOT', 'Bing Bot');
define('PG_BROWSER_FACEBOOKBOT', 'Facebook Bot');

define('PG_BROWSER_PROVIDER_MSNBOT', 'MSN Bot');
define('PG_BROWSER_PROVIDER_GOOGLEBOT', 'Google Bot');
define('PG_BROWSER_PROVIDER_YAHOOBOT', 'Yahoo! Bot');
define('PG_BROWSER_PROVIDER_SUPERGOOBOT', 'SuperGoo Ichiro Bot');
define('PG_BROWSER_PROVIDER_YANDEXBOT', 'Yandex Bot');
		
define('PG_BROWSER_PROVIDER_AOL', 'AOL');
define('PG_BROWSER_PROVIDER_ALICEDSL', 'Alice DSL');
define('PG_BROWSER_PROVIDER_ARCOR', 'Arcor');
define('PG_BROWSER_PROVIDER_VODAFONE', 'Vodafone');
define('PG_BROWSER_PROVIDER_TONLINE', 'T-Online');
define('PG_BROWSER_PROVIDER_1UND1', '1&1 Internet AG');
define('PG_BROWSER_PROVIDER_1UND1_SERVER', '1&1 Internet AG Server');
define('PG_BROWSER_PROVIDER_SERVER4YOU', 'Server 4 You');
define('PG_BROWSER_PROVIDER_KABELDEUTSCHLAND', 'Kabel Deutschland');
		
define('PG_BROWSER_PROVIDER_BADGMBH', 'BAD GmbH');
define('PG_BROWSER_PROVIDER_FACEBOOK', 'Facebook');
define('PG_BROWSER_PROVIDER_MEDIAWAYS', 'mediaWays GmbH Internet Services');
define('PG_BROWSER_PROVIDER_BWL', 'Baden-Württemberg');

/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Browser extends classPG_ClassBasics
{
	// Declarations...
	private $axBrowserVersionParser = array(
		array('Search' => "/.*\ Googlebot\/([0-9\.\,]+).*/i",				'Replace' => '\\1'),
		array('Search' => "/.*\ Yahoo\!\ (.*).*/i",							'Replace' => '\\1'),
		array('Search' => "/.*\ ichiro\/(.*).*/i",							'Replace' => '\\1'),
		array('Search' => "/.*\ YandexBot\/([0-9\.\,]+).*/i",				'Replace' => '\\1'),
		array('Search' => "/.*\ bingbot\/([0-9\.\,]+).*/i",					'Replace' => '\\1'),
		array('Search' => "/(^|.*\ )facebook.*(\ |\/)([0-9\.\,]+).*/i",		'Replace' => '\\3'),
		
		array('Search' => "/.*(\ |\/)Android(\ |\/)([0-9\.\,]+).*/i",		'Replace' => '\\3'),
		array('Search' => "/.*(\ |\/)Chrome(\ |\/)([0-9\.\,]+).*/i",		'Replace' => '\\3'),
		array('Search' => "/(.*\ |^)Opera(\ |\/)([0-9\.\,]+).*/i",			'Replace' => '\\3'),
		array('Search' => "/.*\ Windows Phone\ ([0-9\.\,]+).*)/i",			'Replace' => '\\1'),
		array('Search' => "/.*(\ |\/)MSIE(\ |\/)([0-9\.\,]+).*/i",			'Replace' => '\\3'),
		array('Search' => "/.*\ iPhone\ OS\ ([0-9\.\,\_]+).*/i",			'Replace' => '\\1'),
		array('Search' => "/.*Version(\ |\/)([0-9\.\,]+)\ Safari\/.*/i",	'Replace' => '\\2'),
		array('Search' => "/.*(\ |\/)Navigator(\ |\/)([0-9\.\,]+)/i",		'Replace' => '\\3'),
		array('Search' => "!.*(\ |\/)Firefox(\ |\/)([0-9\.\,]+).*!im",		'Replace' => '\\3'),
		array('Search' => "/.*(\ |\/)Mozilla(\ |\/)([0-9\.\,]+).*/i",		'Replace' => '\\3'),
		array('Search' => "/.*(\ |\/)IE(\ |\/)([0-9\.\,]+).*/i",			'Replace' => '\\3'),
		array('Search' => "/.*(\ |\/)Explorer(\ |\/)([0-9\.\,]+).*/i",		'Replace' => '\\3')
	);
	
	private $axBrowserNameParser = array(
		array('Search' => "Googlebot", 'Replace' => PG_BROWSER_GOOGLEBOT),
		array('Search' => "Yahoo!", 'Replace' => PG_BROWSER_YAHOOBOT),
		array('Search' => "ichiro", 'Replace' => PG_BROWSER_ICHIROBOT),
		array('Search' => "YandexBot", 'Replace' => PG_BROWSER_YANDEXBOT),
		array('Search' => "bingbot", 'Replace' => PG_BROWSER_BINGBOT),
		array('Search' => "facebook", 'Replace' => PG_BROWSER_FACEBOOKBOT),

		array('Search' => "Android", 'Replace' => PG_BROWSER_ANDROID),
		array('Search' => "iPhone", 'Replace' => PG_BROWSER_IPHONE),

		array('Search' => "Chrome", 'Replace' => PG_BROWSER_CHROME),
		array('Search' => "Opera", 'Replace' => PG_BROWSER_OPERA),
		array('Search' => "Msie", 'Replace' => PG_BROWSER_INTERNET_EXPLORER),
		array('Search' => "Safari", 'Replace' => PG_BROWSER_SAFARI),
		array('Search' => "Navigator", 'Replace' => PG_BROWSER_NETSCAPE),
		array('Search' => "Netscape", 'Replace' => PG_BROWSER_NETSCAPE),
		array('Search' => "Firefox", 'Replace' => PG_BROWSER_FIREFOX),
		array('Search' => "Phoenix", 'Replace' => PG_BROWSER_PHOENIX),
		array('Search' => "Mozilla", 'Replace' => PG_BROWSER_MOZILLA),
		array('Search' => "IE", 'Replace' => PG_BROWSER_INTERNET_EXPLORER),
		array('Search' => "Explorer", 'Replace' => PG_BROWSER_INTERNET_EXPLORER)
	);
	
	private $axProviderParser = array(
		array('Search' => "msnbot", 'Replace' => PG_BROWSER_PROVIDER_MSNBOT, 'Website' => 'www.msn.de'),
		array('Search' => "googlebot", 'Replace' => PG_BROWSER_PROVIDER_GOOGLEBOT, 'Website' => 'www.google.de'),
		array('Search' => "crawl.yahoo", 'Replace' => PG_BROWSER_PROVIDER_YAHOOBOT, 'Website' => 'www.yahoo.de'),
		array('Search' => "super-goo", 'Replace' => PG_BROWSER_PROVIDER_SUPERGOOBOT, 'Website' => ''),
		array('Search' => "yandex", 'Replace' => PG_BROWSER_PROVIDER_YANDEXBOT, 'Website' => ''),

		array('Search' => "aol", 'Replace' => PG_BROWSER_PROVIDER_AOL, 'Website' => ''),
		array('Search' => "alicedsl", 'Replace' => PG_BROWSER_PROVIDER_ALICEDSL, 'Website' => ''),
		array('Search' => "arcor", 'Replace' => PG_BROWSER_PROVIDER_ARCOR, 'Website' => ''),
		array('Search' => "vodafone", 'Replace' => PG_BROWSER_PROVIDER_VODAFONE, 'Website' => ''),
		array('Search' => "t-online", 'Replace' => PG_BROWSER_PROVIDER_TONLINE, 'Website' => ''),
		array('Search' => "server4you.de", 'Replace' => PG_BROWSER_PROVIDER_SERVER4YOU, 'Website' => ''),
		array('Search' => "onlinehome-server.info", 'Replace' => PG_BROWSER_PROVIDER_1UND1_SERVER, 'Website' => ''),
		
		array('Search' => "bad-gmbh", 'Replace' => PG_BROWSER_PROVIDER_BADGMBH, 'Website' => 'www.bad-gmbh.de'),
		array('Search' => "tfbnw.net", 'Replace' => PG_BROWSER_PROVIDER_FACEBOOK, 'Website' => 'www.facebook.com'),
		array('Search' => "mediaWays", 'Replace' => PG_BROWSER_PROVIDER_MEDIAWAYS, 'Website' => 'www.mediaways.de'),
		array('Search' => ".bwl.de", 'Replace' => PG_BROWSER_PROVIDER_BWL, 'Website' => 'www.bwl.de'),
		array('Search' => "superkabel.de", 'Replace' => PG_BROWSER_PROVIDER_KABELDEUTSCHLAND, 'Website' => 'www.superkabel.de'), // 188-194-200-212-dynip.superkabel.de

		array('Search' => "pD9E0FAFA.dip0.t-ipconnect.de", 'Replace' => PG_BROWSER_PROVIDER_1UND1, 'Website' => ''),
		array('Search' => "p54AE905A.dip0.t-ipconnect.de", 'Replace' => PG_BROWSER_PROVIDER_1UND1, 'Website' => ''),
		array('Search' => "pd95b47de.dip0.t-ipconnect.de", 'Replace' => PG_BROWSER_PROVIDER_TONLINE, 'Website' => ''),

		array('Search' => "p5DE67C1C.dip.t-dialin.net", 'Replace' => '?', 'Website' => ''),
		array('Search' => "p54AED96E.dip.t-dialin.net", 'Replace' => '?', 'Website' => ''),
		array('Search' => "p5DF3E04B.dip.t-dialin.net", 'Replace' => '?', 'Website' => ''),
		array('Search' => "p5DF3B5F8.dip.t-dialin.net", 'Replace' => '?', 'Website' => ''),
		array('Search' => "p54B1C704.dip.t-dialin.net", 'Replace' => '?', 'Website' => '')
	);
	
	private $axOperatingSystemVersionParser = array(
		array('Search' => "/.*\ Windows Phone(\ |\/)([0-9\.\,]+).*/i", 'Replace' => '\\2'),	// Windows Phone 8.0
		array('Search' => "/.*\ Windows(\ |\/)(NT\ [0-9\.\,]+).*/i", 'Replace' => '\\2'),	// Windows NT 5.1
		array('Search' => "/.*\ Android(\ |\/)([0-9\.\,]+).*/i", 'Replace' => '\\2'),	// Android 2.1
		array('Search' => "/.*\ Ubuntu(\ |\/)([0-9\.\,]+).*/i", 'Replace' => '\\2'),	// Ubuntu/10.04
		array('Search' => "/.*\ Linux(\ |\/)(i[0-9\.\,]+).*/i", 'Replace' => '\\2'),	// Linux i686
		array('Search' => "/.*\ iPhone\ OS(\ |\/)([0-9\.\,\_]+).*/i", 'Replace' => '\\2'),	// iPhone OS 4_2_1
		array('Search' => "/.*\ iPod\ OS(\ |\/)([0-9\.\,\_]+).*/i", 'Replace' => '\\2'),	// iPod OS 4_2_1
		array('Search' => "/.*\ iPad\ OS(\ |\/)([0-9\.\,\_]+).*/i", 'Replace' => '\\2'),	// iPad OS 4_2_1
		array('Search' => "/.*\ Mac\ OS\ X(\ |\/)([0-9\.\,\_]+).*/i", 'Replace' => '\\2')	// Mac OS X 10_6_6
	);
	
	private $axOperatingSystemParser = array(
		array('Search' => "Windows Phone", 'Replace' => 'Windows Phone'),
		array('Search' => "Windows", 'Replace' => 'Windows'),
		array('Search' => "BlackBerry", 'Replace' => 'Black Berry'),
		array('Search' => "Android", 'Replace' => 'Android'),
		array('Search' => "Symbian", 'Replace' => 'Symbian'),
		array('Search' => "Linux", 'Replace' => 'Linux'),
		array('Search' => "iPhone", 'Replace' => 'iOS'),
		array('Search' => "iPad", 'Replace' => 'iOS'),
		array('Search' => "iPod", 'Replace' => 'iOS'),
		array('Search' => "Mac OS", 'Replace' => 'Mac OS')
	);

	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@group Mobile
	
	@return bMobile [type]bool[/type]
	[en]...[/en]
	*/
	public function isMobile()
	{
		switch ($this->getOSName())
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
	public function getInfo() {return $this->getBrowserInfo();}
	/* @end method */

	/*
	@start method
	
	@group Detection
	
	@return sInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getBrowserInfo() {return $_SERVER['HTTP_USER_AGENT'];}
	/* @end method */

	/*
	@start method
	
	@group Browser
	
	@return sBrowserVersion [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getVersion($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));
		return $this->getBrowserVersion(array('sBrowserInfo' => $_sBrowserInfo));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Browser
	
	@return sBrowserVersion [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getBrowserVersion($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));

		$_sBrowserVersion = '';
		if ($_sBrowserInfo == NULL) {$_sBrowserInfo = $this->getBrowserInfo();}
		
		for ($i=0; $i<count($this->axBrowserVersionParser); $i++)
		{
			if (($_sBrowserVersion == $_sBrowserInfo) || ($_sBrowserVersion == ''))
			{
				$_sBrowserVersion = preg_replace($this->axBrowserVersionParser[$i]['Search'],
												 $this->axBrowserVersionParser[$i]['Replace'],
												 $_sBrowserInfo);
			}
		}

		if ($_sBrowserVersion == $_sBrowserInfo) {$_sBrowserVersion = '[unknown version]';}
		
		$_sBrowserVersion = str_replace('_', '.', $_sBrowserVersion);
		$_sBrowserVersion = str_replace(',', '.', $_sBrowserVersion);
		
		return $_sBrowserVersion;
	}
	/* @end method */

	/*
	@start method
	
	@group Browser
	
	@return sBrowserName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getName($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));
		return $this->getBrowserName(array('sBrowserInfo' => $_sBrowserInfo));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Browser
	
	@return sBrowserName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getBrowserName($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));

		if ($_sBrowserInfo == NULL) {$_sBrowserInfo = $this->getBrowserInfo();}
		
		for ($i=0; $i<count($this->axBrowserNameParser); $i++)
		{
			if (preg_match("/".$this->axBrowserNameParser[$i]['Search']."/si", $_sBrowserInfo)) {return $this->axBrowserNameParser[$i]['Replace'];}
		}

		return '[unknown browser]';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Browser
	
	@return sLanguage [type]string[/type]
	[en]...[/en]
	*/
	public function getBrowserLanguage()
	{
		$_sLanguage = 'en';
		$_sLanguage = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
		$_sLanguage = substr($_sLanguage, 0, 2);
		return $_sLanguage;
	}
	/* @end method */
	// this.getLanguage = this.getBrowserLanguage;
	
	/*
	@start method
	
	@group Provider
	
	@return sProviderInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getProviderInfo() {return gethostbyaddr($_SERVER["REMOTE_ADDR"]);}
	/* @end method */
	
	/*
	@start method
	
	@group Provider
	
	@return sProviderName [type]string[/type]
	[en]...[/en]
	
	@param sProviderInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getProviderName($_sProviderInfo = NULL)
	{
		$_sProviderInfo = $this->getRealParameter(array('oParameters' => $_sProviderInfo, 'sName' => 'sProviderInfo', 'xParameter' => $_sProviderInfo));

		if ($_sProviderInfo == NULL) {$_sProviderInfo = $this->getProviderInfo();}
		
		for ($i=0; $i<count($this->axProviderParser); $i++)
		{
			if (stristr($_sProviderInfo, $this->axProviderParser[$i]['Search'])) {return $this->axProviderParser[$i]['Replace'];}
		}

		return '[unknown provider]';
	}
	/* @end method */
	
	/*
	@start method
	
	@group OS
	
	@return sOsName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getOS($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));
		return $this->getOperatingSystemName(array('sBrowserInfo' => $_sBrowserInfo));
	}
	/* @end method */
	
	/*
	@start method
	
	@group OS
	
	@return sOsName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getOSName($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));
		return $this->getOperatingSystemName(array('sBrowserInfo' => $_sBrowserInfo));
	}
	/* @end method */
	
	/*
	@start method
	
	@group OS
	
	@return sOsName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getOperatingSystem($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));
		return $this->getOperatingSystemName(array('sBrowserInfo' => $_sBrowserInfo));
	}
	/* @end method */
	
	/*
	@start method
	
	@group OS
	
	@return sOsName [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getOperatingSystemName($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));

		if ($_sBrowserInfo == NULL) {$_sBrowserInfo = $this->getBrowserInfo();}
		
		for ($i=0; $i<count($this->axOperatingSystemParser); $i++)
		{
			if (preg_match("/".$this->axOperatingSystemParser[$i]['Search']."/si", $_sBrowserInfo)) {return $this->axOperatingSystemParser[$i]['Replace'];}
		}
		
		return '[unknown operating system]';
	}
	/* @end method */
	
	/*
	@start method
	
	@group OS
	
	@return sOsVersion [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getOSVersion($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));
		return $this->getOperatingSystemVersion(array('sBrowserInfo' => $_sBrowserInfo));
	}
	/* @end method */
	
	/*
	@start method
	
	@group OS
	
	@return sOsVersion [type]string[/type]
	[en]...[/en]
	
	@param sBrowserInfo [type]string[/type]
	[en]...[/en]
	*/
	public function getOperatingSystemVersion($_sBrowserInfo = NULL)
	{
		$_sBrowserInfo = $this->getRealParameter(array('oParameters' => $_sBrowserInfo, 'sName' => 'sBrowserInfo', 'xParameter' => $_sBrowserInfo));

		$_sBrowserVersion = '';
		if ($_sBrowserInfo == NULL) {$_sBrowserInfo = $this->getBrowserInfo();}
		
		for ($i=0; $i<count($this->axOperatingSystemVersionParser); $i++)
		{
			if (($_sBrowserVersion == $_sBrowserInfo) || ($_sBrowserVersion == ''))
			{
				$_sBrowserVersion = preg_replace($this->axOperatingSystemVersionParser[$i]['Search'],
												 $this->axOperatingSystemVersionParser[$i]['Replace'],
												 $_sBrowserInfo);
			}
		}

		if ($_sBrowserVersion == $_sBrowserInfo) {$_sBrowserVersion = '[unknown version]';}
		
		$_sBrowserVersion = str_replace('_', '.', $_sBrowserVersion);
		$_sBrowserVersion = str_replace(',', '.', $_sBrowserVersion);
		
		return $_sBrowserVersion;
	}
	/* @end method */

	/*
	@start method
	
	@group File
	
	@return sFileName [type]string[/type]
	[en]...[/en]
	*/
	public function getCurrentFileName() {return $this->getFileName();}
	/* @end method */

	/*
	@start method
	
	@group File
	
	@return sFileName [type]string[/type]
	[en]...[/en]
	*/
	public function getFileName() {return $_SERVER['PHP_SELF'];}
	/* @end method */
	
	/*
	@start method
	
	@group IP
	
	@return sClientIP [type]string[/type]
	[en]...[/en]
	*/
	public function getClientIP()
	{
		$_sClientIP = '';
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_sClientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];}
			else if (isset($_SERVER['HTTP_CLIENT_IP'])) {$_sClientIP = $_SERVER['HTTP_CLIENT_IP'];}
			else {$_sClientIP = $_SERVER['REMOTE_ADDR'];}
		}
		else
		{
			if (getenv('HTTP_X_FORWARDED_FOR')) {$_sClientIP = getenv('HTTP_X_FORWARDED_FOR');}
			else if (getenv('HTTP_CLIENT_IP')) {$_sClientIP = getenv('HTTP_CLIENT_IP');}
			else {$_sClientIP = getenv('REMOTE_ADDR');}
		}
		if (strstr($_sClientIP, ','))
		{
			$_asClientIP = explode(',', $_sClientIP);
			$_sClientIP = $_asClientIP[0];
		}
		return $_sClientIP;
	}
	/* @end method */
	
	/*
	@start method
	
	@group IP
	
	@return sServerIP [type]string[/type]
	[en]...[/en]
	*/
	public function getServerIP()
	{
		return gethostbyname($this->getDomain());
	}
	/* @end method */
	
	/*
	@start method
	
	@group Domain
	
	@return sDomain [type]string[/type]
	[en]...[/en]
	*/
	public function getDomain()
	{
		if (isset($_SERVER))
		{
			if (isset($_SERVER['HOST_NAME'])) {return $_SERVER['HOST_NAME'];}
			else if (isset($_SERVER['HTTP_HOST'])) {return $_SERVER['HTTP_HOST'];}
			else
			{
				$_sURL = str_replace('http://', '', $_SERVER['SCRIPT_URI']);
				$_sURL = str_replace('https://', '' , $_sURL);
				$_sURL = str_replace('ftp://', '' , $_sURL);
				return stristr($_sURL, '/', true);
			}
		}
		else
		{
			if (getenv('HOST_NAME')) {return getenv('HOST_NAME');}
			else if (getenv('HTTP_HOST')) {return getenv('HTTP_HOST');}
			else
			{
				$_sURL = str_replace('http://', '', getenv('SCRIPT_URI'));
				$_sURL = str_replace('https://', '' , $_sURL);
				$_sURL = str_replace('ftp://', '' , $_sURL);
				return stristr($_sURL, '/', true);
			}
		}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Port
	
	@return sPort [type]string[/type]
	[en]...[/en]
	*/
	public function getCurrentPort() {return $this->getPort();}
	/* @end method */

	/*
	@start method
	
	@group Port
	
	@return sPort [type]string[/type]
	[en]...[/en]
	*/
	public function getPort() {return $_SERVER['REMOTE_PORT'];}
	/* @end method */
	
	/*
	@start method
	
	@group URL
	
	@return sUrlParameters [type]string[/type]
	[en]...[/en]
	*/
	public function getUrlParameters()
	{
		$_sURL = '';
		
		if (isset($_SERVER)) {$_sURL = $_SERVER['QUERY_STRING'];}
		else {$_sURL = getenv('QUERY_STRING');}
		
		if ($_sURL == '')
		{
			if (isset($_SERVER)) {$_sURL = preg_replace("!.?*\?(.*?)!is", "\\1", $_SERVER['SCRIPT_FILENAME']);}
			else {$_sURL = preg_replace("!.?*\?(.*?)!is", "\\1", getenv('SCRIPT_FILENAME'));}
		}

		if ($_sURL == '')
		{
			if (isset($_SERVER)) {$_sURL = preg_replace("!.?*\?(.*?)!is", "\\1", $_SERVER['REQUEST_URI']);}
			else {$_sURL = preg_replace("!.?*\?(.*?)!is", "\\1", getenv('REQUEST_URI'));}
		}

		return $_sURL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Domain
	
	@return sDomain [type]string[/type]
	[en]...[/en]
	*/
	public function getFromDomain() {return $this->parseDomain(array('sUrl' => $_SERVER['HTTP_REFERER']));}
	/* @end method */

	/*
	@start method
	
	@group URL
	
	@return sUrl [type]string[/type]
	[en]...[/en]
	*/
	public function getFromUrl() {return $_SERVER['HTTP_REFERER'];}
	/* @end method */
	
	/*
	@start method
	
	@group Domain
	
	@return sDomain [type]string[/type]
	[en]...[/en]
	
	@param sUrl [needed][type]string[/type]
	[en]...[/en]
	*/
	public function parseDomain($_sUrl)
	{
		$_sUrl = $this->getRealParameter(array('oParameters' => $_sUrl, 'sName' => 'sUrl', 'xParameter' => $_sUrl));
		return preg_replace("!(http:\/\/|https:\/\/|ftp:\/\/)([0-9A-Za-z\-\_\.]+)(\/.*|\#.*|\?.*|$)!mi", "\\2", $_sUrl);
	}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	
	@return sMeta [type]string[/type]
	[en]...[/en]
	*/
	public function deactivateIECompatibilityMode()
	{
		if ($this->getName() == PG_BROWSER_INTERNET_EXPLORER)
		{
			if ($this->getVersion() <= 7)
			{
				return '<meta http-equiv="X-UA-Compatible" content="IE=7" />';
			}
			else if ($this->getVersion() <= 8)
			{
				return '<meta http-equiv="X-UA-Compatible" content="IE=8" />';
			}
			else
			{
				return '<meta http-equiv="X-UA-Compatible" content="IE=9" />';
			}
		}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@group Other
	*/
	public function deactivateCache() {$this->noCache();}
	/* @end method */

	/*
	@start method
	
	@group Other
	*/
	public function noCache()
	{
		// header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		// header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Datum in der Vergangenheit
		session_cache_limiter('nocache');
	}
	/* @end method */
}
/* @end class */
$oPGBrowser = new classPG_Browser();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGBrowser', 'xValue' => $oPGBrowser));}
?>