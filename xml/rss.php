<?php
/*
* ProGade API
* http://api.progade.de/
*
* Copyright 2012, Hans-Peter Wandura
* You can find the Licenses, Terms and Conditions under: http://api.progade.de/api_terms.php
*
* Last changes of this file: Aug 06 2012
*/
/*
Beschreibung der Code-Tags für Allgemeine Rss Infos
[image]				= Bild des Rss Feeds
[title]				= Titel des Rss Feeds
[description]		= Beschreibung des Rss Feeds
[webmaster]			= Webmaster der den Rss Feed bereitgestellt hat
[website]			= Webseite auf die der Rss Feed bereitgestellt wurde
[copyright]			= Kopierrechte des Rss Feeds
[build_date]		= Datum an dem das Rss Feed erstellt wurde
[build_time]		= Uhrzeit an dem das Rss Feed erstellt wurde
[pub_date]			= Datum an dem der Inhalt des Rss Feeds veröffentlicht wurde (z.B. veröffentlichung einer Zeitung vor dem [build_date])
[pub_time]			= Uhrzeit an dem der Inhalt des Rss Feeds veröffentlicht wurde

Beschreibung der Code-Tags für Einträge der Rss
[title]				= Titel des Rss Feed Eintrags
[description]		= Beschreibung des Rss Feed Eintrags
[author]			= Verfasser (Autor) des Rss Feed Eintrags
[comments]			= Link zu einer Seite auf der über den Rss Feed Eintrag Diskutiert werden kann
[pub_date]			= Datum an dem der Rss Feed Eintrag veröffentlicht wurde
[pub_time]			= Uhrzeit an dem der Rss Feed Eintrag veröffentlicht wurde
*/

define('PG_RSS_VERSION_1', '0.91');
define('PG_RSS_VERSION_2', '2.0');
define('PG_RSS_VERSION_ATOM', 'http://www.w3.org/2005/Atom');
define('PG_RSS_GOOGLE_SITEMAP', 'http://www.google.com/schemas/sitemap/0.84');

define('PG_RSS_GENERATOR_URL', 'http://www.progade.de');
define('PG_RSS_GENERATOR_NAME', 'ProGade API');

define('PG_RSS_LANGUAGE_ENGLISH', 'en');
define('PG_RSS_LANGUAGE_US', 'en-us');
define('PG_RSS_LANGUAGE_GERMAN', 'de');
define('PG_RSS_LANGUAGE_FRENCH', 'fr');
define('PG_RSS_LANGUAGE_JAPANESE', 'ja');

/*
@start class

@description
[en]This class has methods to read and write RSS feeds and Google Sitemaps.[/en]
[de]Diese Klasse verfügt über Methoden zum Lesen und schreiben von RSS-Feeds und Google Sitemaps.[/de]

@param extends classPG_ClassBasics
*/
class classPG_Rss extends classPG_ClassBasics
{
	// Declarations...
	private $aiItemID = array();
	private $asItemCategory = array();
	private $asItemTitle = array();
	private $asItemText = array();
	private $asItemLink = array();
	private $asItemComments = array();
	private $asItemAuthor = array();
	private $aiItemTimeStamp = array();
	
	// Construct...
	public function __construct() {}
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Reads an RSS feed and returns it as an array or in a template.[/en]
	[de]Liest einen RSS-Feed aus und gibt ihn als Array oder in einem Template zurück.[/de]
	
	@var ReadFeedReturnArray
	<div class="pg_docu_code">
	<span class="pg_docu_variables">axFeed[ <span class="pg_docu_strings">Title | Description | Webmaster | Website | Copyright | BuildDate | PubDate | Image | Items</span> ]</span>
	<span class="pg_docu_variables">axFeed[ <span class="pg_docu_strings">Items</span> ][iItemIndex][ <span class="pg_docu_strings">Title | Link | Description | Author | Comments | PubDate</span> ]</span>
	</div>

	@return axContent [type]mixed[][/type]
	[en]The method returns a template as a string if sRssTemplate and sItemTemplate are passed, or an array if the parameters were not set: %ReadFeedReturnArray%[/en]
	[de]Wenn sRssTemplate und sItemTemplate übergeben wurden gibt die Methode ein Template als String zurück, oder einen Array wenn die Parameter nicht gesetzt wurden: %ReadFeedReturnArray%[/de]
	
	@param sRssFile [needed][type]string[/type]
	[en]The RSS file to be read. Can also be a complete URL.[/en]
	[de]Die RSS Datei, die gelesen werden soll. Kann auch eine komplette URL sein.[/de]
	
	@param sRssTemplate [type]string[/type]
	[en]A template for the entire RSS.[/en]
	[de]Ein Template für das gesamte RSS.[/de]
	
	@param sItemTemplate [type]string[/type]
	[en]A template for each item of the RSS.[/en]
	[de]Ein Template für jedes Items des RSS.[/de]
	*/
	public function readFeed($_sRssFile, $_sRssTemplate = NULL, $_sItemTemplate = NULL)
	{
		$_sRssTemplate = $this->getRealParameter(array('oParameters' => $_sRssFile, 'sName' => 'sRssTemplate', 'xParameter' => $_sRssTemplate));
		$_sItemTemplate = $this->getRealParameter(array('oParameters' => $_sRssFile, 'sName' => 'sItemTemplate', 'xParameter' => $_sItemTemplate));
		$_sRssFile = $this->getRealParameter(array('oParameters' => $_sRssFile, 'sName' => 'sRssFile', 'xParameter' => $_sRssFile));

		$_oXml = simplexml_load_file($_sRssFile);
		if ($_oXml)
		{
			$_bAtom = false;
			$_axReturn = array();

			// Allgemeine Daten des Rss Feeds...
			if ((string)$oXml->channel->title != '')
			{
				$_axReturn['Title'] = trim(utf8_decode((string)$_oXml->channel->title));
				$_axReturn['Description'] = trim(utf8_decode((string)$_oXml->channel->description));
				$_axReturn['Webmaster'] =  trim(utf8_decode((string)$_oXml->channel->webMaster));
				$_axReturn['Website'] = trim(utf8_decode((string)$_oXml->channel->link));
				$_axReturn['Copyright'] = trim(utf8_decode((string)$_oXml->channel->copyright));
				$_axReturn['BuildDate'] = trim(utf8_decode((string)$_oXml->channel->lastBuildDate));
				$_axReturn['PubDate'] = trim(utf8_decode((string)$_oXml->channel->pubDate));
				$_axReturn['Image'] = trim(utf8_decode((string)$_oXml->channel->image));
			}
			else
			{
				$_bAtom = true;
				$_axReturn['Title'] = trim(utf8_decode((string)$_oXml->title));
				$_axReturn['Description'] = trim(utf8_decode((string)$_oXml->subtitle));
				$_axReturn['Webmaster'] = trim(utf8_decode((string)$_oXml->author->email));
				if ($_axReturn['Webmaster'] != '') {$_axReturn['Webmaster'] .= ' ';}
				$aReturn['Webmaster'] = trim(utf8_decode((string)$_oXml->author->name));
				foreach ($oXml->children() as $a => $b)
				{
					if (trim(utf8_decode((string)$a)) == 'link') {$_axReturn['Website'] = trim(utf8_decode((string)$b['href']));}
				}
				$_axReturn['Copyright'] = trim(utf8_decode((string)$_oXml->rights));
				$_axReturn['BuildDate'] = trim(utf8_decode((string)$_oXml->updated));
				$_axReturn['PubDate'] = trim(utf8_decode((string)$_oXml->updated));
				$_axReturn['Image'] = trim(utf8_decode((string)$_oXml->logo));
			}
			
			// RSS Feed Inhalt...
			$_axReturn['Items'] = array();
			$_axItemWerte = array();
			$_axItems = array();

			if ($_bAtom == false)
			{
				if (count($_oXml->channel->item) > 0) {$_axItems = $_oXml->channel->item;}
				else {$_axItems = $_oXml->item;}
			}
			else {$_axItems = $_oXml->entry;}

			for ($i=0; $i<count($_axItems); $i++)
			{
				if ($_bAtom == false)
				{
					$_axItemWerte[$i]['Title'] = trim(utf8_decode((string)$_axItems[$i]->title));
					$_axItemWerte[$i]['Link'] = trim(utf8_decode((string)$_axItems[$i]->link));
					$_axItemWerte[$i]['Description'] = trim(utf8_decode((string)$_axItems[$i]->description));
					$_axItemWerte[$i]['Author'] = trim(utf8_decode((string)$_axItems[$i]->author));
					$_axItemWerte[$i]['Comments'] = trim(utf8_decode((string)$_axItems[$i]->comments));
					$_axItemWerte[$i]['PubDate'] = trim(utf8_decode((string)$_axItems[$i]->pubDate));
				}
				else
				{
					$_axItemWerte[$i]['Title'] = utf8_decode((string)$_axItems[$i]->title);
					foreach ($aItems[$i]->children() as $a => $b)
					{
						if (trim(utf8_decode((string)$a)) == 'link') {$_axItemWerte[$i]['Link'] = trim(utf8_decode((string)$b['href']));}
					}
					$_axItemWerte[$i]['Description'] = trim(utf8_decode((string)$_axItems[$i]->summary));
					if ($_axItemWerte[$i]['Description'] == '') {$_axItemWerte[$i]['Description'] = trim(utf8_decode((string)$_axItems[$i]->content));}
					$_axItemWerte[$i]['Author'] = trim(utf8_decode((string)$_axItems[$i]->author->email));
					if ($_axItemWerte[$i]['Author'] != '') {$_axItemWerte[$i]['Author'] .= ' ';}
					$_axItemWerte[$i]['Author'] = trim(utf8_decode((string)$_axItems[$i]->author->name));
					$_axItemWerte[$i]['PubDate'] = trim(utf8_decode((string)$_axItems[$i]->updated));
				}

				if ($_axItemWerte[$i]['PubDate'] != '') {$_axReturn['Items'][$i] .= '[ '.date("d.m.Y", strtotime($_axItemWerte[$i]['PubDate'])).' ][ '.date("H:i", strtotime($_axItemWerte[$i]['PubDate'])).' ] ';}
				if ($_axItemWerte[$i]['Link'] != '') {$_axReturn['Items'][$i] .= '<a href="'.$_axItemWerte[$i]['Link'].'" target="_blank">';}
				$_axReturn['Items'][$i] .= $_axItemWerte[$i]['Title'];
				if ($_axItemWerte[$i]['Link'] != '') {$_axReturn['Items'][$i] .= '</a>';}
				$_axReturn['Items'][$i] .= '<br />';
				$_axReturn['Items'][$i] .= $_axItemWerte[$i]['Description'];
				if ($_axItemWerte[$i]['Author'] != '') {$_axReturn['Items'][$i] .= '<br />Autor: '.$_axItemWerte[$i]['Author'];}
			}
		}

		if (((trim($_sRssTemplate) != '') && ($_sRssTemplate != NULL)) || ((trim($_sItemTemplate) != '') && ($_sItemTemplate != NULL)))
		{
			$_sRssTemplate = str_replace("[title]", $_axReturn['Title'], $_sRssTemplate);
			$_sRssTemplate = str_replace("[description]", $_axReturn['Description'], $_sRssTemplate);
			$_sRssTemplate = str_replace("[webmaster]", $_axReturn['Webmaster'], $_sRssTemplate);
			if ($_axReturn['Website'] != '') {$_axReturn['Website'] = '<a href="'.$_axReturn['Website'].'" target="_blank">'.$_axReturn['Website'].'</a>';}
			$_sRssTemplate = str_replace("[website]", $_axReturn['Website'], $_sRssTemplate);
			$_sRssTemplate = str_replace("[copyright]", $_axReturn['Copyright'], $_sRssTemplate);
			$_sRssTemplate = str_replace("[build_date]", date("d.m.Y", strtotime($_axReturn['BuildDate'])), $_sRssTemplate);
			$_sRssTemplate = str_replace("[build_time]", date("H:i", strtotime($_axReturn['BuildDate'])), $_sRssTemplate);
			$_sRssTemplate = str_replace("[pub_date]", date("d.m.Y", strtotime($_axReturn['PubDate'])), $_sRssTemplate);
			$_sRssTemplate = str_replace("[pub_time]", date("H:i", strtotime($_axReturn['PubDate'])), $_sRssTemplate);
			$_sRssTemplate = str_replace("[image]", $_axReturn['Image'], $_sRssTemplate);
			$_sRssTemplate = str_replace("[cells]", 'cells', $_sRssTemplate);
			
			for ($i=0; $i<count($_axItemWerte); $i++)
			{
				if ($_sCurrentCells == 'cells2') {$_sCurrentCells = 'cells';} else {$_sCurrentCells = 'cells2';}

				$_sTitle = '';
				if ($_axItemWerte[$i]['Link'] != '') {$_sTitle .= '<a href="'.$_axItemWerte[$i]['Link'].'" target="_blank">';}
				$_sTitle .= $_axItemWerte[$i]['Title'];
				if ($_axItemWerte[$i]['Link'] != '') {$_sTitle .= '</a>';}
				
				$_sTempItemAufbau = $_sItemTemplate;
				$_sTempItemAufbau = str_replace("[title]", $sTitle, $_sTempItemAufbau);
				$_sTempItemAufbau = str_replace("[description]", $_axItemWerte[$i]['Description'], $_sTempItemAufbau);
				$_sTempItemAufbau = str_replace("[author]", $_axItemWerte[$i]['Author'], $_sTempItemAufbau);
				$_sTempItemAufbau = str_replace("[comments]", $_axItemWerte[$i]['Comments'], $_sTempItemAufbau);
				$_sTempItemAufbau = str_replace("[pub_date]", date("d.m.Y", strtotime($_axItemWerte[$i]['PubDate'])), $_sTempItemAufbau);
				$_sTempItemAufbau = str_replace("[pub_time]", date("H:i", strtotime($_axItemWerte[$i]['PubDate'])), $_sTempItemAufbau);
				$_sTempItemAufbau = str_replace("[cells]", $_sCurrentCells, $_sTempItemAufbau);

				$_sItems .= $_sTempItemAufbau;
			}

			return str_replace("[items]", $_sItems, $_sRssTemplate);
		}
		else {return $_axReturn;}
		// return false;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Builds an RSS feed and returns it as a string.[/en]
	[de]Erstellt einen RSS-Feed und gibt ihn als String zurück.[/de]
	
	@return sContent [type]string[/type]
	[en]Returns the finished RSS feed as a string.[/en]
	[de]Gibt den fertigen RSS-Feed als String zurück.[/de]
	
	@param sRssVersion [type]string[/type]
	[en]
		The RSS feed version to use.
		The following defines can be used:
		PG_RSS_VERSION_1
		PG_RSS_VERSION_2
		PG_RSS_VERSION_ATOM
		PG_RSS_GOOGLE_SITEMAP
	[/en]
	[de]
		Die zu verwendende RSS-Feed Version.
		Folgende Defines können verwendet werden:
		PG_RSS_VERSION_1
		PG_RSS_VERSION_2
		PG_RSS_VERSION_ATOM
		PG_RSS_GOOGLE_SITEMAP
	[/de]
	
	@param sFilePath [type]string[/type]
	[en]If a file path is specified, the method automatically saves the RSS feed from there.[/en]
	[de]Wenn ein Dateipfad angegeben wird, speichert die Methode automatisch den RSS-Feed dort ab.[/de]
	
	@param sTitle [type]string[/type]
	[en]The title of the RSS feed.[/en]
	[de]Der Titel des RSS-Feeds.[/de]
	
	@param sDescription [type]string[/type]
	[en]The general description of the RSS feed.[/en]
	[de]Die allgemeine Beschreibung des RSS-Feeds.[/de]
	
	@param sLanguage [type]string[/type]
	[en]
		The language of the RSS feeds. e.g. 'en-us' or 'de'.
		It can also be used following defines:	
		PG_RSS_LANGUAGE_ENGLISH
		PG_RSS_LANGUAGE_US
		PG_RSS_LANGUAGE_GERMAN
		PG_RSS_LANGUAGE_FRENCH
		PG_RSS_LANGUAGE_JAPANESE
	[/en]
	[de]
		Die Sprache des RSS-Feeds. wie z.B. 'en-us' oder 'de'.
		Es können auch folgende Defines verwendet werden:
		PG_RSS_LANGUAGE_ENGLISH
		PG_RSS_LANGUAGE_US
		PG_RSS_LANGUAGE_GERMAN
		PG_RSS_LANGUAGE_FRENCH
		PG_RSS_LANGUAGE_JAPANESE
	[/de]
	
	@param sSiteLink [type]string[/type]
	[en]A link to the page references from the feed originates.[/en]
	[de]Ein link der auf die Webseite verweist von dem der Feed stammt.[/de]
	
	@param sRssBody [type]string[/type]
	[en]The content (items) of the RSS feed.[/en]
	[de]Der Inhalt (Items) des RSS-Feeds.[/de]
	*/
	public function buildFeed(
		$_sRssVersion = NULL, 
		$_sFilePath = NULL, 
		$_sTitle = NULL, 
		$_sDescription = NULL, 
		$_sLanguage = NULL, 
		$_sSiteLink = NULL, 
		$_sRssBody = NULL
	)
	{
		$_sFilePath = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'FilePath', 'xParameter' => $_sFilePath));
		$_sTitle = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$_sDescription = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sDescription', 'xParameter' => $_sDescription));
		$_sLanguage = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sLanguage', 'xParameter' => $_sLanguage));
		$_sSiteLink = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sSiteLink', 'xParameter' => $_sSiteLink));
		$_sRssBody = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sRssBody', 'xParameter' => $_sRssBody));
		$_sRssVersion = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sRssVersion', 'xParameter' => $_sRssVersion));

		if ($_sRssVersion === NULL) {$_sRssVersion = PG_RSS_VERSION_2;}
		if ($_sFilePath === NULL) {$_sFilePath = '';}
		if ($_sTitle === NULL) {$_sTitle = 'RSS Feed';}
		if ($_sDescription === NULL) {$_sDescription = '';}
		if ($_sLanguage === NULL) {$_sLanguage = PG_RSS_LANGUAGE_ENGLISH;}
		if ($_sSiteLink === NULL) {$_sSiteLink = '';}
		if ($_sRssBody === NULL) {$_sRssBody = '';}
		
		$_iTimeStamp = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

		$_sEndung = '';
		$_sRssHeader = '';
		$_sRssFooter = '';

		$_sRssHeader .= '<?xml version="1.0" encoding="UTF-8"?>';
		if ($_sRssVersion == PG_RSS_VERSION_ATOM)
		{
			$_sEndung = 'atom'; // 'asf';

			$_sRssHeader .= '<feed xmlns="'.$_sRssVersion.'">';
				$_sRssHeader .= '<title>'.htmlspecialchars($_sTitle).'</title>'; // htmlspecialchars(utf8_encode($_sTitle))
				$_sRssHeader .= '<link href="'.htmlspecialchars($_sSiteLink).'" />';
				$_sRssHeader .= '<updated>'.date("c").'</updated>'; // ISO 8601 Datum
				$_sRssHeader .= '<subtitle>'.htmlspecialchars($_sDescription).'</subtitle>';
				$_sRssHeader .= '<id>urn:uuid:'.preg_replace("!(.{8})(.{4})(.{4})(.{4})(.+)!is", "\\1-\\2-\\3-\\4-\\5", htmlspecialchars(md5(PG_RSS_GENERATOR_NAME.'_'.date("HisdmY")))).'</id>';
				$_sRssHeader .= '<generator uri="'.htmlspecialchars(PG_RSS_GENERATOR_URL).'">'.PG_RSS_GENERATOR_NAME.'</generator>';
	
			$_sRssFooter .= '</feed>';
		}
		else if ($_sRssVersion == PG_RSS_GOOGLE_SITEMAP)
		{
			/*
			<?xml version="1.0" encoding="UTF-8"?>
			<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
					<url>
						<loc>http://www.example.com/</loc>
						<lastmod>2005-01-01</lastmod>
						<changefreq>monthly</changefreq>
						<priority>0.8</priority>
					</url>  
			</urlset>
			*/
	
			$_sEndung = 'xsd';
			
			$_sRssHeader .= '<urlset xmlns="'.$_sRssVersion.'" ';
			$_sRssHeader .= 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
			$_sRssHeader .= 'xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 ';
			$_sRssHeader .= 'http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';
			
			$_sRssFooter .= '</urlset>';
		}
		else
		{
			$_sEndung = 'rss';
		
			$_sRssHeader .= '<rss version="'.$_sRssVersion.'">';
				$_sRssHeader .= '<channel>';
					$_sRssHeader .= '<title>'.htmlspecialchars($_sTitle).'</title>';
					$_sRssHeader .= '<link>'.htmlspecialchars($_sSiteLink).'</link>';
					$_sRssHeader .= '<pubDate>'.date("D, j M Y G:i:s T", $_iTimeStamp).'</pubDate>';
					$_sRssHeader .= '<description>'.htmlspecialchars($_sDescription).'</description>';
					$_sRssHeader .= '<language>'.$_sLanguage.'</language>';
					$_sRssHeader .= '<generator>'.PG_RSS_GENERATOR_NAME.'</generator>';
					/*
					$_sRssHeader .= '<image>';
						$_sRssHeader .= '<url>URL einer einzubindenden Grafik</url>';
						$_sRssHeader .= '<title>Bildtitel</title>';
						$_sRssHeader .= '<link>URL, mit der das Bild verknüpft ist</link>';
					$_sRssHeader .= '</image>';
					*/
					
				$_sRssFooter .= '</channel>';
			$_sRssFooter .= '</rss>';
		}
		
		$_sRssContent = '';
		$_sRssContent .= $_sRssHeader;
		if ($_sRssBody != '') {$_sRssContent .= $_sRssBody;}
		else {$_sRssContent .= $this->buildFeedContent(array('sRssVersion' => $_sRssVersion));}
		$_sRssContent .= $_sRssFooter;
		
		// File wird geschrieben...
		if (trim($_sFilePath) != "")
		{
			if ($_fp = fopen($_sFilePath.'.'.$_sEndung, "w"))
			{
				fputs($_fp, $_sRssContent);
				fclose($_fp);
			}
			// File wird umbenannt...
			// rename($sFilePath.".rss", $sFilePath.".xml");
		}

		return $_sRssContent;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Deletes all items of the RSS feeds.[/en]
	[de]Löscht alle Items des RSS-Feeds.[/de]
	*/
	public function clearFeedContent()
	{
		$this->aiItemID = array();
		$this->asCategory = array();
		$this->asTitle = array();
		$this->asText = array();
		$this->asLink = array();
		$this->asComments = array();
		$this->asAuthor = array();
		$this->aiTimeStamp = array();
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Adds a new content item to the RSS Feed.[/en]
	[de]Fügt dem RSS-Feed ein neues Inhalts-Item hinzu.[/de]
	
	@param iItemID [type]int[/type]
	[en]A unique ID for the item.[/en]
	[de]Eine eindeutige ID für das Item.[/de]
	
	@param sCategory [type]string[/type]
	[en]One category of the item to be assigned.[/en]
	[de]Eine Kategorie der das Item zugeordnet sein soll.[/de]
	
	@param sTitle [needed][type]string[/type]
	[en]The title of the item.[/en]
	[de]Der Titel des Items.[/de]
	
	@param sText [type]string[/type]
	[en]The text of the item.[/en]
	[de]Der Text des Items.[/de]
	
	@param sLink [type]string[/type]
	[en]The link of the item that refers to the entire article of the item.[/en]
	[de]Der Link des Items, der auf den gesamten Artikel zu dem Item verweist.[/de]
	
	@param sComments [type]string[/type]
	[en]The link to the comments of the items.[/en]
	[de]Der Link zu den Kommentaren des Items.[/de]
	
	@param sAuthor [type]string[/type]
	[en]The author who wrote the article / item.[/en]
	[de]Der Autor, der den Artikel / das Item geschrieben hat.[/de]
	
	@param iTimeStamp [type]int[/type]
	[en]A Unix timestamp for the date of constitution of the article / item.[/en]
	[de]Ein Unix-Zeitstempel vom Verfassungsdatum des Artikels / Items.[/de]
	*/
	public function addFeedContent(
		$_iItemID, 
		$_sCategory = NULL, 
		$_sTitle = NULL, 
		$_sText = NULL, 
		$_sLink = NULL, 
		$_sComments = NULL, 
		$_sAuthor = NULL, 
		$_iTimeStamp = NULL
	)
	{
		$_sCategory = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'sCategory', 'xParameter' => $_sCategory));
		$_sTitle = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'sTitle', 'xParameter' => $_sTitle));
		$_sText = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'sText', 'xParameter' => $_sText));
		$_sLink = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'sLink', 'xParameter' => $_sLink));
		$_sComments = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'sComments', 'xParameter' => $_sComments));
		$_sAuthor = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'sAuthor', 'xParameter' => $_sAuthor));
		$_iTimeStamp = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'iTimeStamp', 'xParameter' => $_iTimeStamp));
		$_iItemID = $this->getRealParameter(array('oParameters' => $_iItemID, 'sName' => 'iItemID', 'xParameter' => $_iItemID));

		if ($_sText === NULL) {$_sText = $_sTitle;}
		if ($_sCategory === NULL) {$_sCategory = '';}
		if ($_sLink === NULL) {$_sLink = '';}
		if ($_sComments === NULL) {$_sComments = '';}
		if ($_sAuthor === NULL) {$_sAuthor = '';}
		if ($_iTimeStamp === NULL) {$_iTimeStamp = time();}
		
		$this->aiItemID[] = $_iItemID;
		$this->asCategory[] = $_sCategory;
		$this->asTitle[] = $_sTitle;
		$this->asText[] = $_sText;
		$this->asLink[] = $_sLink;
		$this->asComments[] = $_sComments;
		$this->asAuthor[] = $_sAuthor;
		$this->aiTimeStamp[] = $_iTimeStamp;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Builds the RSS feed content and returns it as a string.[/en]
	[de]Erstellt den RSS-Feed Inhalt und gibt ihn als String zurück.[/de]

	@return sRssBody [type]string[/type]
	[en]Returns the RSS feed content as a string.[/en]
	[de]Gibt den RSS-Feed Inhalt als String zurück.[/de]
	
	@param sRssVersion [type]string[/type]
	[en]
		The RSS feed version to use.
		The following defines can be used:
		PG_RSS_VERSION_1
		PG_RSS_VERSION_2
		PG_RSS_VERSION_ATOM
		PG_RSS_GOOGLE_SITEMAP
	[/en]
	[de]
		Die zu verwendende RSS-Feed Version.
		Folgende Defines können verwendet werden:
		PG_RSS_VERSION_1
		PG_RSS_VERSION_2
		PG_RSS_VERSION_ATOM
		PG_RSS_GOOGLE_SITEMAP
	[/de]
	*/
	public function buildFeedContent($_sRssVersion = NULL)
	{
		$_sRssVersion = $this->getRealParameter(array('oParameters' => $_sRssVersion, 'sName' => 'sRssVersion', 'xParameter' => $_sRssVersion));

		if ($_sRssVersion === NULL) {$_sRssVersion = PG_RSS_VERSION_2;}
		
		$_sRssBody = '';
		for ($i=0; $i<count($this->asTitle); $i++)
		{
			if ($_sRssVersion == PG_RSS_VERSION_1)
			{
				$this->asTitle[$i] = substr($this->asTitle[$i], 0, 100);
				$this->asText[$i] = substr($this->asText[$i], 0, 500);
				$this->asLink[$i] = substr($this->asLink[$i], 0, 500);
			}

			$this->asCategory[$i] = htmlspecialchars(trim($this->asCategory[$i])); // htmlspecialchars(utf8_encode(trim($this->asCategory[$i])));
			$this->asTitle[$i] = htmlspecialchars(trim($this->asTitle[$i]));
			$this->asText[$i] = htmlspecialchars(trim($this->asText[$i]));
			$this->asLink[$i] = htmlspecialchars(trim($this->asLink[$i]));
			$this->asComments[$i] = htmlspecialchars(trim($this->asComments[$i]));
			$this->asAuthor[$i] = htmlspecialchars(trim($this->asAuthor[$i]));
			
			if ($_sRssVersion == PG_RSS_VERSION_ATOM)
			{
				$_sRssBody .= '<entry>';
					$_sRssBody .= '<title>'.$this->asTitle[$i].'</title>';
					if ($this->asCategory[$i] != '') {$_sRssBody .= '<category term="'.$this->asCategory[$i].'" />';}
					if ($this->asLink[$i] != '') {$_sRssBody .= '<link href="'.$this->asLink[$i].'" />';}
					$_sRssBody .= '<id>urn:uuid:'.preg_replace("!(.{8})(.{4})(.{4})(.{4})(.+)!is", "\\1-\\2-\\3-\\4-\\5", htmlspecialchars(md5(PG_RSS_GENERATOR_NAME.'_'.$this->aiItemID[$i]))).'</id>';
					$_sRssBody .= '<updated>'.date("c", $this->aiTimeStamp[$i]).'</updated>'; // ISO 8601 Datum
					if ($this->asAuthor[$i] != '') {$_sRssBody .= '<author><name>'.$this->asAuthor[$i].'</name></author>';}
					if ($this->asText[$i] != '') {$_sRssBody .= '<summary type="html">'.$this->asText[$i].'</summary>';}
				$_sRssBody .= '</entry>';
			}
			else if ($_sRssVersion == PG_RSS_GOOGLE_SITEMAP)
			{
				/*
				<?xml version="1.0" encoding="UTF-8"?>
				<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
						<url>
							<loc>http://www.example.com/</loc>
							<lastmod>2005-01-01</lastmod>
							<changefreq>monthly</changefreq>
							<priority>0.8</priority>
						</url>  
				</urlset>
				*/

				$_sRssBody .= '<url>';
					$_sRssBody .= '<loc>'.$this->asLink[$i].'</loc>';
					$_sRssBody .= '<lastmod>'.date("c", $this->aiTimeStamp[$i]).'</lastmod>'; // 2005-01-01
					$_sRssBody .= '<changefreq>monthly</changefreq>';
					$_sRssBody .= '<priority>0.5</priority>';
				$_sRssBody .= '</url>';
			}
			else
			{
				$_sRssBody .= '<item>';
					$_sRssBody .= '<title>'.$this->asTitle[$i].'</title>';
					if ($this->asCategory[$i] != '') {$_sRssBody .= '<category>'.$this->asCategory[$i].'</category>';}
					if ($this->asLink[$i] != '') {$_sRssBody .= '<link>'.$this->asLink[$i].'</link>';}
					if ($sRssVersion == PG_RSS_VERSION_2)
					{
						$_sRssBody .= '<guid isPermaLink="false">'.htmlspecialchars(md5(PG_RSS_GENERATOR_NAME.'_'.$this->aiItemID[$i])).'</guid>';
						$_sRssBody .= '<pubDate>'.date("D, j M Y G:i:s T", $this->aiTimeStamp[$i]).'</pubDate>';
					}
					if ($this->asComments[$i] != '') {$_sRssBody .= '<comments>'.$this->asComments[$i].'</comments>';}
					if ($this->asAuthor[$i] != '') {$_sRssBody .= '<author>'.$this->asAuthor[$i].'</author>';}
					if ($this->asText[$i] != '') {$_sRssBody .= '<description>'.$this->asText[$i].'</description>';}
				$_sRssBody .= '</item>';
			}
		}
		return $_sRssBody;
	}
	/* @end method */
}
/* @end class */
$oPGRss = new classPG_Rss();
if (isset($oPGApi)) {$oPGApi->register(array('sName' => 'oPGRss', 'xValue' => $oPGRss));}
?>