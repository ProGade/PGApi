<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura
* Last changes of this file: Oct 09 2012
*/
define('PG_DEBUG_NONE', 0);
define('PG_DEBUG_LOW', 1);
define('PG_DEBUG_MEDIUM', 2);
define('PG_DEBUG_HIGH', 4);

/**
 * @start class
 *
 * @description
 * <en>
 *      This class is a base class inherit from most other classes.
 *      It contains methods such as Networked communications, database and graphics capabilities, etc.
 * </en>
 * <de>
 *      Diese Klasse ist eine Basisklasse von der die meisten anderen Klassen erben.
 *      Sie enthält Methoden wie z.B. Netwerk-Kommunikation, Datenbank- und Grafikfunktionen usw.
 * </de>
 *
 * @param extends classPG_ClassBasics
 */
class classPG_ClassBasics
{
	// Declarations...
	private $sID = 'PG';
	private $iIDNext = 0;
	private $iMode = 0;
	private $iDebugMode = 0;
	private $sDebugString = '';
	private $sLineBreak = "\n";
	private $bUseLineBreak = false;

	private $sUrl = 'index.php';
	private $sUrlTarget = '_self';
    private $bUrlRewrite = false;

    private $sDatabaseTablePrefix = '';
	
	private $asText = array();
	private $axUrlParameters = array();

	public $oGfx = NULL;
	public $sGfxSubPath = '';
	
	private $oNetwork = NULL;

    private $oTemplate = NULL;
    private $sTemplate = '';

	private $oDatabase = NULL;
	private $bUseDatabase = false;

	// Construct...
	public function __construct() {}
	
	// Methods...
	/**
     * @start method
     *
     * @group Other
     *
     * @description
     * <en>Initializes the GFX package system and network functions.</en>
     * <de>Initialisiert das GFX-Pack-System und die Netzwerkfunktionen.</de>
     */
	public function initClassBasics()
	{
		$this->initGfx();
		$this->initNetwork();
		$this->initUrl();
	}
	/* @end method */

    private $oRealParameters = NULL;

    /**
     * @start method
     *
     * @group Parameters
     *
     * @description
     * <en></en>
     * <de></de>
     *
     * @param oParameters <type><i>[mixed]</i></type>
     * <en><p>...</p></en>
     * <de><p>...</p></de>
     */
    public function setMethodParameters($_oParameters)
    {
        if (is_array($_oParameters))
        {
            if (isset($_oParameters['oParameters'])) {$_oParameters = $_oParameters['oParameters'];}
        }
        $this->oRealParameters = $_oParameters;
    }
    /* @end method */

    /**
     * <p>English: Alias for setMethodParameters()</p>
     * <p>Deutsch: Alias für setMethodParameters()</p>
     *
     * @start method
     *
     * @group Parameters
     *
     * @description
     * <en>Alias for setMethodParameters()</en>
     * <de>Alias für setMethodParameters()</de>
     *
     * @param oParameters <type><i>[mixed]</i></type>
     * <en><p>...</p></en>
     * <de><p>...</p></de>
     */
    public function mps($_oParameters)
    {
        $this->setMethodParameters($_oParameters);
    }
    /* @end method */

	/**
     * @start method
     *
     * @group Parameters
     *
     * @description
     * <en>Find out how parameters are passed to a method and returns the appropriate value of the parameter.</en>
     * <de>Findet heraus auf welche Weise Parameter an eine Methode übergeben wurden und gibt den passenden Wert des Parameters zurück.</de>
     *
     * @return xValue <type>mixed</type>
     * <en>Returns the appropriate value for the desired parameter.</en>
     * <de>Gibt den passenden Wert zum gesuchten Parameter zurück.</de>
     *
     * @param sName <needed><type>string</type>
     * <en>The name of the desired parameter.</en>
     * <de>Der Name des gesuchten Parameters.</de>
     *
     * @param xParameter <needed><type>mixed</type>
     * <en>The parameters should actually be passed.</en>
     * <de>Der Parameter der eigentlich übergeben werden sollte.</de>
     *
     * @param oParameters <needed><type>object</type>
     * <en>The first parameter of a method. It is either an array, which contains all the parameters or it is only the first parameter.</en>
     * <de>Der erste Parameter einer Methode. Er entspricht entweder einem Array, welcher alle Parameter beinhaltet oder ist nur der erste Parameter.</de>
     *
     * @param bNotNull <type>bool</type>
     * <en>If the first parameter was supposed to be an array and is not optional, then must bNotNull be set to true.</en>
     * <de>Falls der erste Parameter ursprünglich ein array sein sollte und nicht optional ist, dann muss bNotNull auf true gesetzt werden.</de>
     */
	public function getMethodParameter($_sName = NULL, $_xParameter = NULL, $_oParameters = NULL, $_bNotNull = NULL)
	{
        try {
            if ($_sName === NULL) {return NULL;}

            if (is_array($_sName))
            {
                if (($_xParameter === NULL) && (isset($_sName['xParameter']))) {$_xParameter = $_sName['xParameter'];}
                if (($_oParameters === NULL) && (isset($_sName['oParameters']))) {$_oParameters = $_sName['oParameters'];}
                if (($_bNotNull === NULL) && (isset($_sName['bNotNull']))) {$_bNotNull = $_sName['bNotNull'];}
                if (isset($_sName['sName'])) {$_sName = $_sName['sName'];} else {$_sName = NULL;}
            }

            if (empty($_oParameters)) {$_oParameters = $this->oRealParameters;}

            if (is_array($_oParameters))
            {
                if ($_oParameters == $_xParameter)
                {
                    if (isset($_oParameters[$_sName])) {return $_oParameters[$_sName];} else if ($_bNotNull != true) {return NULL;}
                }
                else if (($_xParameter === NULL) && (isset($_oParameters[$_sName]))) {return $_oParameters[$_sName];}
            }
        }
        catch (\Exception $_oException) {
            echo $_oException->getTraceAsString();
        }
		return $_xParameter;
	}
	/* @end method */

    /**
     * @start method
     *
     * @group Parameters
     *
     * @description
     * <en>DEPRECATED: Alias for getMethodParameter()</en>
     * <de>DEPRECATED: Alias für getMethodParameter()</de>
     */
    public function getRealParameter($_sName = NULL, $_xParameter = NULL, $_oParameters = NULL, $_bNotNull = NULL)
    {
        return $this->getMethodParameter($_sName, $_xParameter, $_oParameters, $_bNotNull);
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Parameters
     *
     * @description
     * <en>Alias for getMethodParameter()</en>
     * <de>Alias für getMethodParameter()</de>
     */
    public function mp($_sName = NULL, $_xParameter = NULL, $_oParameters = NULL, $_bNotNull = NULL)
    {
        return $this->getMethodParameter($_sName, $_xParameter, $_oParameters, $_bNotNull);
    }
    /* @end method */

    // LineBreaks...
    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Sets whether to use line breaks.</en>
     * <de>Setzt ob Zeilenumbrüche verwendet werden sollen.</de>
     *
     * @param bUse <needed><type>bool</type>
     * <en>The state whether line breaks should be used (true) or not to be used (false).</en>
     * <de>Der Status ob Zeilenumbrüche verwendet werden sollen (true) oder nicht verwendet werden sollen (false).</de>
     */
	public function useLineBreak($_bUse)
	{
        $this->mps(array('oParameters' => $_bUse));
		$_bUse = $this->mp(array('sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseLineBreak = $_bUse;
	}
	/* @end method */
	
	/**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns whether line breaks should be used.</en>
     * <de>Gibt zurück ob Zeilenumbrüche verwendet werden sollen.</de>
     *
     * @return bUseLineBreak <type>bool</type>
     * <en>Returns an boolean that indicates whether a line break should be used (true) or not (false).</en>
     * <de>Gibt einen Boolean zurück, der angibt ob Zeilenumbrüche verwendet werden sollen (true) oder nicht verwendet werden sollen (false).</de>
     */
    public function isLineBreak() {return $this->bUseLineBreak;}
    /* @end method */

    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Sets the character that should cause the line break.</en>
     * <de>Setzt die Zeichen, die den Zeilenumbruch bewirken sollen.</de>
     *
     * @param sString <needed><type>string</type>
     * <en>The string representing the line break.</en>
     * <de>Der String der den Zeilenumbruch darstellt.</de>
     */
    public function setLineBreak($_sString)
    {
        $this->mps(array('oParameters' => $_sString));
		$_sString = $this->mp(array('sName' => 'sString', 'xParameter' => $_sString));
		$this->sLineBreak = $_sString;
	}
    /* @end method */
	
	/**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns the characters that represent the line break.</en>
     * <de>Gibt die Zeichen zurück, die den Zeilenumbruch darstellen.</de>
     *
     * @return sLineBreak <type>string</type>
     * <en>Returns the line break as a string.</en>
     * <de>Gibt den Zeilenumbruch als String zurück.</de>
     */
    public function getLineBreak() {if ($this->bUseLineBreak == true) {return $this->sLineBreak;} return '';}
    /* @end method */
	
	// ID...
	/**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Sets the ID for an object.</en>
     * <de>Setzt die ID für eine Objekt.</de>
     *
     * @param sID <needed><type>string</type>
     * <en>The ID as a string.</en>
     * <de>Die ID als String.</de>
     */
	public function setID($_sID)
	{
        $this->mps(array('oParameters' => $_sID));
		$_sID = $this->mp(array('sName' => 'sID', 'xParameter' => $_sID));
		$this->sID = $_sID;
	}
	/* @end method */
	
	/**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns the ID of an object/a class.</en>
     * <de>Gibt die ID von einem Objekt/einer Klasse zurück.</de>
     *
     * @return sID <type>string</type>
     * <en>Returns the ID of an object/a class as a string.</en>
     * <de>Gibt die ID von einem Objekt/einer Klasse als String zurück.</de>
     */
	public function getID() {return $this->sID;}
	/* @end method */
	
	/**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns the next, generated ID of an object/a class.</en>
     * <de>Gibt die nächste, generierte ID von einem Objekt/einer Klasse zurück.</de>
     *
     * @return sID <type>string</type>
     * <en>Returns the next, generated ID of an object/a class as a string.</en>
     * <de>Gibt die nächste, generierte ID von einem Objekt/einer Klasse als String zurück.</de>
     */
	public function getNextID() {$_sID = $this->sID.$this->iIDNext; $this->iIDNext++; return $_sID;}
	/* @end method */

	/**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns the most recently generated ID of an object/a class.</en>
     * <de>Gibt die zuletzt generierte ID von einem Objekt/einer Klasse zurück.</de>
     *
     * @return sID <type>string</type>
     * <en>Returns the most recently generated ID of an object/a class as a string.</en>
     * <de>Gibt die zuletzt generierte ID von einem Objekt/einer Klasse als String zurück.</de>
     */
	public function getLastID() {return $this->sID.$this->iIDNext;}
    /* @end method */

    // Text...
    /**
     * @start method
     *
     * @group Text
     *
     * @description
     * <en>Sets text for a class. Can be used for multilingual websites.</en>
     * <de>Setzt Text(e) für eine Klasse. Kann für Mehrsprachige Webseiten verwendet werden.</de>
     *
     * @param xType <needed><type>mixed</type>
     * <en>The type of the text as string is equivalent to an ID for a text. An string array of texts can be passed also.</en>
     * <de>Der Typ des Textes als String. Entspricht einer ID für einen Text. Hier kann aber auch ein String-Array von Texten übergeben werden.</de>
     *
     * @param sText <needed><type>string</type>
     * <en>The text to the type. Is not needed, if the type is a string array.</en>
     * <de>Der Text zum Typ. Wird nicht benötigt, wenn der Typ ein String-Array ist.</de>
     */
	public function setText($_xType, $_sText = NULL)
	{
        $this->mps(array('oParameters' => $_xType));
		$_sText = $this->mp(array('sName' => 'sText', 'xParameter' => $_sText));
		$_xType = $this->mp(array('sName' => 'xType', 'xParameter' => $_xType, 'bNotNull' => true));
		if (is_array($_xType)) {$this->asText = $_xType;}
		else if (is_string($_xType)) {$this->asText[$_xType] = $_sText;}
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Text
     *
     * @description
     * <en>Adds text to a class. Can be used for multilingual websites.</en>
     * <de>Fügt einen Text einer Klasse hinzu. Kann für Mehrsprachige Webseiten verwendet werden.</de>
     *
     * @param sType <needed><type>mixed</type>
     * <en>The type of the text as string is equivalent to an ID for a text.</en>
     * <de>Der Typ des Textes als String. Entspricht einer ID für einen Text.</de>
     *
     * @param sText <needed><type>string</type>
     * <en>The text to the type.</en>
     * <de>Der Text zum Typ.</de>
     */
	public function addText($_sType, $_sText = NULL)
	{
        $this->mps(array('oParameters' => $_sType));
		$_sText = $this->mp(array('sName' => 'sText', 'xParameter' => $_sText));
		$_sType = $this->mp(array('sName' => 'sType', 'xParameter' => $_sType));
		$this->setText(array('xType' => $_sType, 'sText' => $_sText));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Text
     *
     * @description
     * <en>Returns the text of a class to the appropriate type</en>
     * <de>Gibt den Text einer Klasse zum entsprechenden Typ zurück.</de>
     *
     * @param sType <needed><type>string</type>
     * <en>Returns the text of a class to the appropriate type as a string</en>
     * <de>Gibt den Text einer Klasse zum entsprechenden Typ als String zurück.</de>
     */
	public function getText($_sType)
	{
        $this->mps(array('oParameters' => $_sType));
		$_sType = $this->mp(array('sName' => 'sType', 'xParameter' => $_sType));
		return $this->asText[$_sType];
	}
    /* @end method */

    // Mode...
    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Sets a mode of class, object, or a variable of type integer.</en>
     * <de>Setzt einen Modus der Klasse, des Objekts oder auf eine Variable vom Typ Integer.</de>
     *
     * @return iMode <type>int</type>
     * <en>Returns the newly set mode.</en>
     * <de>Gibt den neu gesetzten Modus zurück.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode to be set.</en>
     * <de>Der Modus der gesetzt werden soll.</de>
     *
     * @param iCurrentMode <type>int</type>
     * <en>The mode that is currently used. For example, a variable of type integer.</en>
     * <de>Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.</de>
     */
	public function setMode($_iMode, $_iCurrentMode = NULL)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iCurrentMode = $this->mp(array('sName' => 'iCurrentMode', 'xParameter' => $_iCurrentMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		if ($_iCurrentMode !== NULL) {$_iCurrentMode |= ($_iMode); return $_iCurrentMode;}
		$this->iMode |= ($_iMode);
		return $this->iMode;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns the mode of an object.</en>
     * <de>Gibt den Modus eines Objekts zurück.</de>
     *
     * @return iMode <type>int</type>
     * <en>Returns the mode of an object as a integer.</en>
     * <de>Gibt den Modus eines Objekts als Integer zurück.</de>
     */
	public function getMode() {return $this->iMode;}
    /* @end method */

    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Repeals the mode of a class, an object, or a variable.</en>
     * <de>Hebt den Modus einer Klasse, eines Objekts oder einer Variablen auf.</de>
     *
     * @return iMode <type>int</type>
     * <en>Returns the newly set mode.</en>
     * <de>Gibt den neu gesetzten Modus zurück.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode which is to be repealed.</en>
     * <de>Der Modus der aufgehoben werden soll.</de>
     *
     * @param iCurrentMode <type>int</type>
     * <en>The mode that is currently used. For example, a variable of type integer.</en>
     * <de>Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.</de>
     */
	public function unsetMode($_iMode, $_iCurrentMode = NULL)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iCurrentMode = $this->mp(array('sName' => 'iCurrentMode', 'xParameter' => $_iCurrentMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		if ($_iCurrentMode !== NULL) {$_iCurrentMode &= ~($_iMode); return $_iCurrentMode;}
		$this->iMode &= ~($_iMode);
		return $this->iMode;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Switches a mode turns on and off.</en>
     * <de>Schaltet einem Modus abwechselnd an und aus.</de>
     *
     * @return iMode <type>int</type>
     * <en>Returns the newly set mode.</en>
     * <de>Gibt den neu gesetzten Modus zurück.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode which is to be switched.</en>
     * <de>Der Modus der umgeschaltet werden soll.</de>
     *
     * @param iCurrentMode <type>int</type>
     * <en>The mode that is currently used. For example, a variable of type integer.</en>
     * <de>Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.</de>
     */
	public function toggleMode($_iMode, $_iCurrentMode = NULL)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iCurrentMode = $this->mp(array('sName' => 'iCurrentMode', 'xParameter' => $_iCurrentMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		if ($_iCurrentMode !== NULL) {$_iCurrentMode ^= ($_iMode); return $_iCurrentMode;}
		$this->iMode ^= ($_iMode);
		return $this->iMode;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Setup
     *
     * @description
     * <en>Returns whether a mode is switched on.</en>
     * <de>Gibt zurück, ob ein Modus an geschaltet wurde.</de>
     *
     * @return bIsMode <type>bool</type>
     * <en>Returns a boolean whether a mode is switched on (true) or off (false).</en>
     * <de>Gibt einen Boolean zurück, ob ein Modus an (true) oder aus (false) geschaltet wurde.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode to be tested.</en>
     * <de>Der Modus der geprüft werden soll.</de>
     *
     * @param iCurrentMode <type>int</type>
     * <en>The mode that is currently used. For example, a variable of type integer.</en>
     * <de>Der Modus der momentan verwendet wird. Zum Beispiel eine Variable vom Typ Integer.</de>
     */
	public function isMode($_iMode, $_iCurrentMode = NULL)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iCurrentMode = $this->mp(array('sName' => 'iCurrentMode', 'xParameter' => $_iCurrentMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		if ($_iCurrentMode === NULL) {$_iCurrentMode = $this->iMode;}
		return ($_iCurrentMode & ($_iMode));
	}
    /* @end method */

    // Debug...
    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Sets the debug mode of an object.</en>
     * <de>Setzt den Debug-Modus des Objekts.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode to be set.</en>
     * <de>Der Modus der gesetzt werden soll.</de>
     */
	public function setDebugMode($_iMode)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		$this->iDebugMode |= ($_iMode);
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Returns the debug mode of an object.</en>
     * <de>Gibt den Debug-Modus eines Objekts zurück.</de>
     *
     * @return iMode <type>int</type>
     * <en>Returns the debug mode of an object as a integer.</en>
     * <de>Gibt den Debug-Modus eines Objekts als Integer zurück.</de>
     */
	public function getDebugMode() {return $this->iDebugMode;}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Repeals the debug mode of an object.</en>
     * <de>Hebt den Debug-Modus eines Objekts auf.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode which is to be repealed.</en>
     * <de>Der Modus der aufgehoben werden soll.</de>
     */
	public function unsetDebugMode($_iMode = NULL)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		if ($_iMode !== NULL) {$this->iDebugMode &= ~($_iMode);}
		else {$this->iDebugMode = PG_DEBUG_NONE;}
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Switches the debug mode turns on and off.</en>
     * <de>Schaltet den Debug-Modus abwechselnd an und aus.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode which is to be switched.</en>
     * <de>Der Modus der umgeschaltet werden soll.</de>
     */
	public function toggleDebugMode($_iMode)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		$this->iDebugMode ^= ($_iMode);
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Returns whether a debug mode is switched on.</en>
     * <de>Gibt zurück, ob ein Debug-Modus an geschaltet wurde.</de>
     *
     * @return bIsMode <type>bool</type>
     * <en>Returns a boolean whether a debug mode is switched on (true) or off (false).</en>
     * <de>Gibt einen Boolean zurück, ob ein Debug-Modus an (true) oder aus (false) geschaltet wurde.</de>
     *
     * @param iMode <needed><type>int</type>
     * <en>The mode to be tested.</en>
     * <de>Der Modus der geprüft werden soll.</de>
     */
	public function isDebugMode($_iMode)
	{
        $this->mps(array('oParameters' => $_iMode));
		$_iMode = $this->mp(array('sName' => 'iMode', 'xParameter' => $_iMode));
		return ($this->iDebugMode & ($_iMode));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Sets the debug string.</en>
     * <de>Setzt den Debug-String.</de>
     *
     * @param sString <needed><type>string</type>
     * <en>The text that should be set.</en>
     * <de>Der Text, der gesetzt werden soll.</de>
     */
	public function setDebugString($_sString)
	{
        $this->mps(array('oParameters' => $_sString));
		$_sString = $this->mp(array('sName' => 'sString', 'xParameter' => $_sString));
		$this->sDebugString = $_sString;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Adds text to the debug string.</en>
     * <de>Fügt dem Debug-String Text hinzu.</de>
     *
     * @param sString <needed><type>string</type>
     * <en>The text that should be added.</en>
     * <de>Der Text, der hinzugefügt werden soll.</de>
     */
	public function addDebugString($_sString)
	{
        $this->mps(array('oParameters' => $_sString));
		$_sString = $this->mp(array('sName' => 'sString', 'xParameter' => $_sString));
		$this->sDebugString .= $_sString.'<br />';
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Debug
     *
     * @description
     * <en>Returns the debug string.</en>
     * <de>Gibt den Debug String zurück.</de>
     *
     * @return sDebugString <type>string</type>
     * <en>Returns the debug string.</en>
     * <de>Gibt den Debug String zurück.</de>
     */
	public function getDebugString()
	{
		if (($this->iDebugMode > 0) && ($this->sDebugString != ''))
		{
			$_sDebugString = $this->sDebugString;
			$this->sDebugString = '';
			return $_sDebugString;
		}
		return '';
	}
    /* @end method */

    // Gfx...
    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Initializes the GFX package system for the object.</en>
     * <de>Initialisiert das GFX-Pack-System für das Objekt.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns a boolean indicating whether the initialization was successful.</en>
     * <de>Gibt einen Boolean zurück der angibt ob das Initialisieren erfolgreich war.</de>
     *
     * @param oGfx <type>object</type>
     * <en>The GFX package object which is to be used. When this parameter is omitted, the default GFX package object is used.</en>
     * <de>Das GFX-Pack-Objekt, welches verwendet werden soll. Bei weglassen dieses Parameters wird das default GFX-Pack-Objekt verwendet.</de>
     */
	public function initGfx($_oGfx = NULL)
	{
        $this->mps(array('oParameters' => $_oGfx));
		$_oGfx = $this->mp(array('sName' => 'oGfx', 'xParameter' => $_oGfx));
		if ($_oGfx != NULL) {$this->oGfx = $_oGfx; return true;}
		if (class_exists('classPG_Gfx')) {global $oPGGfx; if (isset($oPGGfx)) {$this->oGfx = $oPGGfx; return true;}}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Sets the GFX package for the object.</en>
     * <de>Setzt das GFX-Pack für das Objekt.</de>
     *
     * @param oGfx <needed><type>object</type>
     * <en>The GFX package object which is to be used. When this parameter is omitted, the default GFX package object is used.</en>
     * <de>Das GFX-Pack-Objekt, welches verwendet werden soll. Bei weglassen dieses Parameters wird das default GFX-Pack-Objekt verwendet.</de>
     */
	public function setGfx($_oGfx)
	{
        $this->mps(array('oParameters' => $_oGfx));
		$_oGfx = $this->mp(array('sName' => 'oGfx', 'xParameter' => $_oGfx));
		$this->oGfx = $_oGfx;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Returns the GFX package object.</en>
     * <de>Gibt das GFX-Pack-Objekt zurück.</de>
     *
     * @return oGfx <type>object</type>
     * <en>Returns the GFX package object.</en>
     * <de>Gibt das GFX-Pack-Objekt als object zurück.</de>
     */
	public function getGfx() {return $this->oGfx;}
    /* @end method */

    /**
     * @start method
     *
     * @description
     * <en>...</en>
     *
     * @param sPath <needed><type>string</type>
     * <en>...</en>
     */
	public function setGfxBasePath($_sPath)
	{
        $this->mps(array('oParameters' => $_sPath));
		$_sPath = $this->mp(array('sName' => 'sPath', 'xParameter' => $_sPath));
		$this->oGfx->setGfxBasePath(array('sPath' => $_sPath));
	}
    /* @end method */

    /**
     * @start method
     *
     * @description
     * <en>...</en>
     *
     * @param sPath <needed><type>string</type>
     * <en>...</en>
     */
	public function setGfxPath($_sPath)
	{
        $this->mps(array('oParameters' => $_sPath));
		$_sPath = $this->mp(array('sName' => 'sPath', 'xParameter' => $_sPath));
		$this->oGfx->setGfxPath(array('sPath' => $_sPath));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Sets a subpath, to be used after the GFX path for the current object.</en>
     * <de>Setzt einen Unter-Pfad, der nach dem GFX Pfad für das aktuelle Objekt verwendet werden soll.</de>
     *
     * @param sPath <needed><type>string</type>
     * <en>The subpath as a string to be used.</en>
     * <de>Der Unter-Pfad als String, der verwendet werden soll.</de>
     */
	public function setGfxSubPath($_sPath)
	{
        $this->mps(array('oParameters' => $_sPath));
		$_sPath = $this->mp(array('sName' => 'sPath', 'xParameter' => $_sPath));
		$this->sGfxSubPath = $_sPath;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Returns the subpath.</en>
     * <de>Gibt den Unter-Pfad zurück.</de>
     *
     * @return sSubPath <type>string</type>
     * <en>Returns the subpath as a string.</en>
     * <de>Gibt den Unter-Pfad als String zurück.</de>
     */
	public function getGfxSubPath() {return $this->sGfxSubPath;}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>
     *     Returns the full path of CSS with all subpaths and, where appropriate, the file name.
     *     sFile passing can be also an absolute URL and is checked out automatically.
     * </en>
     * <de>
     *     Gibt den kompletten CSS-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.
     *     Die Übergabe von sFile darf auch eine absolute URL sein und wird automatisch darauf geprüft.
     * </de>
     *
     * @return sPath <type>string</type>
     * <en>Returns the full path of CSS with all subpaths and, where appropriate, the file name.</en>
     * <de>Gibt den kompletten CSS-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.</de>
     *
     * @param sFile <type>string</type>
     * <en>The file name or an absolute URL to the file as a string.</en>
     * <de>Der Dateiname oder eine absolute URL zur Datei als String.</de>
     */
	public function getGfxPathCss($_sFile = NULL)
	{
        $this->mps(array('oParameters' => $_sFile));
		$_sFile = $this->mp(array('sName' => 'sFile', 'xParameter' => $_sFile));

		$_sPath = '';
		if ($this->oGfx)
		{
			if (($_sFile === NULL) || (preg_match("!(http:\/\/|https:\/\/|ftp:\/\/)!is", $_sFile) == 0))
			{
				$_sPath .= $this->oGfx->getGfxPath().$this->oGfx->getGfxSubPathCss().$this->sGfxSubPath;
			}
		}
		$_sPath .= $this->sGfxSubPath;
		if ($_sFile != NULL)
		{
			$_sPath .= $_sFile;
			if (!file_exists($_sPath))
			{
				if ($this->oGfx)
				{
					$_sPath .= $this->getGfxBasePathCss().$_sFile;
				}
			}
		}
		return $_sPath;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Returns the full base path of CSS with all subpaths.</en>
     * <de>Gibt den kompletten Basis-CSS-Pfad mit allen Unter-Pfaden zurück.</de>
     *
     * @return sPath <type>string</type>
     * <en>Returns the full base path of CSS with all subpaths.</en>
     * <de>Gibt den kompletten Basis-CSS-Pfad mit allen Unter-Pfaden zurück.</de>
     */
	public function getGfxBasePathCss()
	{
		if ($this->oGfx) {return $this->oGfx->getGfxBasePath().$this->oGfx->getGfxSubPathCss().$this->sGfxSubPath;}
		return $this->sGfxSubPath;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>
     *     Returns the full path of images with all subpaths and, where appropriate, the file name.
     *     sImage passing can be also an absolute URL and is checked out automatically.
     * </en>
     * <de>
     *     Gibt den kompletten Bilder-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.
     *     Die Übergabe von sImage darf auch eine absolute URL sein und wird automatisch darauf geprüft.
     * </de>
     *
     * @return sPath <type>string</type>
     * <en>Returns the full path of images with all subpaths and, where appropriate, the file name.</en>
     * <de>Gibt den kompletten Bilder-Pfad mit allen Unter-Pfaden und ggf. dem Dateinamen zurück.</de>
     *
     * @param sImage <type>string</type>
     * <en>The file name or an absolute URL to the file as a string.</en>
     * <de>Der Dateiname oder eine absolute URL zur Datei als String.</de>
     */
	public function getGfxPathImages($_sImage = NULL)
	{
        $this->mps(array('oParameters' => $_sImage));
		$_sImage = $this->mp(array('sName' => 'sImage', 'xParameter' => $_sImage));

		$_sPath = '';
		if ($this->oGfx)
		{
			if (($_sImage === NULL) || (preg_match("!(http:\/\/|https:\/\/|ftp:\/\/)!is", $_sImage) == 0))
			{
				$_sPath .= $this->oGfx->getGfxPath().$this->oGfx->getGfxSubPathImages();
			}
		}
		$_sPath .= $this->sGfxSubPath;
		if ($_sImage != NULL)
		{
			$_sPath .= $_sImage;
			if (!file_exists($_sPath))
			{
				if ($this->oGfx)
				{
					$_sPath .= $this->oGfx->getGfxBasePath().$this->oGfx->getGfxSubPathImages().$this->sGfxSubPath.$_sImage;
				}
			}
		}
		return $_sPath;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group GFX
     *
     * @description
     * <en>Builds an image and returns it as a string.</en>
     * <de>Erstellt ein Image und gibt es als String zurück.</de>
     *
     * @return sImageHtml <type>string</type>
     * <en>Returns the image as a string.</en>
     * <de>Gibt das Image als String zurück.</de>
     *
     * @param sImage <needed><type>string</type>
     * <en>The image that should be used.</en>
     * <de>Das Bild, dass verwendet werden soll.</de>
     *
     * @param xSizeX <type>mixed</type>
     * <en>The width to be used.</en>
     * <de>Die Breite die verwendet werden soll.</de>
     *
     * @param xSizeY <type>mixed</type>
     * <en>The height to be used.</en>
     * <de>Die Höhe die verwendet werden soll.</de>
     *
     * @param sTitle <type>string</type>
     * <en>The title of the image tags. Is displayed when the mouse pointer is over the image.</en>
     * <de>Der Title des Image-Tags. Wird angezeigt, wenn der Mauszeiger über dem Bild ist.</de>
     *
     * @param sAddTag <type>string</type>
     * <en>Additional information for the image tag. HTML properties can be passed here for the IMG tag.</en>
     * <de>Zusätzliche angaben im Image-Tag. Hier können HTML-Properties für das IMG-Tag übergeben werden.</de>
     *
     * @param sCssStyle <type>string</type>
     * <en>CSS style for the tag.</en>
     * <de>CSS-Style für das Tag.</de>
     *
     * @param sCssClass <type>string</type>
     * <en>CSS class for the tag.</en>
     * <de>CSS-Clas für das Tag.</de>
     */
	public function img($_sImage, $_xSizeX = NULL, $_xSizeY = NULL, $_sTitle = NULL, $_sAddTag = NULL, $_sCssStyle = NULL, $_sCssClass = NULL)
	{
        $this->mps(array('oParameters' => $_sImage));
		$_xSizeX = $this->mp(array('sName' => 'xSizeX', 'xParameter' => $_xSizeX));
		$_xSizeY = $this->mp(array('sName' => 'xSizeY', 'xParameter' => $_xSizeY));
		$_sTitle = $this->mp(array('sName' => 'sTitle', 'xParameter' => $_sTitle));
		$_sAddTag = $this->mp(array('sName' => 'sAddTag', 'xParameter' => $_sAddTag));
		$_sCssStyle = $this->mp(array('sName' => 'sCssStyle', 'xParameter' => $_sCssStyle));
		$_sCssClass = $this->mp(array('sName' => 'sCssClass', 'xParameter' => $_sCssClass));
		$_sImage = $this->mp(array('sName' => 'sImage', 'xParameter' => $_sImage));

		if ($this->oGfx)
		{
			return $this->oGfx->img(array('sImage' => $this->sGfxSubPath.$_sImage, 'xSizeX' => $_xSizeX, 'xSizeY' => $_xSizeY, 'sTitle' => $_sTitle, 'sAddTag' => $_sAddTag, 'sCssStyle' => $_sCssStyle, 'sCssClass' => $_sCssClass));
		}
		$_sImg = '';
		$_sImg .= '<img src="'.$this->sGfxSubPath.$_sImage.'" ';
		if ($_sTitle !== NULL) {$_sImg .= 'title="'.$_sTitle.'" ';}
		if ($_sAddTag !== NULL) {$_sImg .= $_sAddTag.' ';}
		if ($_sCssClass !== NULL) {$_sImg .= 'class="'.$_sCssClass.'" ';}
		if (($_xSizeX !== NULL) || ($_xSizeY !== NULL) || ($_sCssStyle !== NULL))
		{
			$_sImg .= 'style="';
			if ($_xSizeX !== NULL) {$_sImg .= 'width:'.$_xSizeX.'; ';}
			if ($_xSizeY !== NULL) {$_sImg .= 'width:'.$_xSizeY.'; ';}
			if ($_sCssStyle !== NULL) {$_sImg .= $_sCssStyle;}
			$_sImg .= '" ';
		}
		$_sImg .= ' />';
		return $_sImg;
	}
    /* @end method */

    // Network...
    /**
     * @start method
     *
     * @group Network
     *
     * @description
     * <en>Initializes network functions for the object / the class.</en>
     * <de>Initialisiert Netzwerk Funktionen für das Objekt / die Klasse.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns a boolean whether the initialization was successfully.</en>
     * <de>Gibt einen Boolean, ob das Initialisieren erfolgreich war, zurück.</de>
     *
     * @param oNetwork <type>object</type>
     * <en>The network object that should be used.</en>
     * <de>Das Netzwerk-Objekt, welches verwendet werden soll.</de>
     */
	public function initNetwork($_oNetwork = NULL)
	{
        $this->mps(array('oParameters' => $_oNetwork));
		$_oNetwork = $this->mp(array('sName' => 'oNetwork', 'xParameter' => $_oNetwork));
		
		if (defined('PG_DATABASE_TABLE_PREFIX')) {$this->setDatabaseTablePrefix(array('sPrefix' => PG_DATABASE_TABLE_PREFIX));}
		if (defined('PG_MYSQL_TABLE_PREFIX')) {$this->setDatabaseTablePrefix(array('sPrefix' => PG_MYSQL_TABLE_PREFIX));}
		if (defined('PG_MSSQL_TABLE_PREFIX')) {$this->setDatabaseTablePrefix(array('sPrefix' => PG_MSSQL_TABLE_PREFIX));}
		
		if ($_oNetwork != NULL) {$this->oNetwork = $_oNetwork; return true;}
		if (class_exists('classPG_Network')) {global $oPGNetwork; if (isset($oPGNetwork)) {$this->oNetwork = $oPGNetwork; return true;}}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Network
     *
     * @description
     * <en>Sets the network object, which is to be used.</en>
     * <de>Setzt das Netzwerk-Objekt, welches verwendet werden soll.</de>
     *
     * @param oNetwork <needed><type>object</type>
     * <en>The network object that should be used.</en>
     * <de>Das Netzwerk-Objekt, welches verwendet werden soll.</de>
     */
	public function setNetwork($_oNetwork)
	{
        $this->mps(array('oParameters' => $_oNetwork));
		$_oNetwork = $this->mp(array('sName' => 'oNetwork', 'xParameter' => $_oNetwork));
		$this->oNetwork = $_oNetwork;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Network
     *
     * @description
     * <en>Returns the network object.</en>
     * <de>Gibt das Netzwerk-Objekt zurück.</de>
     *
     * @return oNetwork <type>object</type>
     * <en>Returns the network object.</en>
     * <de>Gibt das Netzwerk-Objekt zurück.</de>
     */
	public function getNetwork() {return $this->oNetwork;}
    /* @end method */

    /**
     * @start method
     *
     * @group Network
     *
     * @description
     * <en>Adds data to send over the network.</en>
     * <de>Fügt Daten zum Senden über das Netzwerk hinzu.</de>
     *
     * @param sName <needed><type>string</type>
     * <en>The naming of the network data. Similar to a variable name.</en>
     * <de>Die Benennung der Netzwerkdaten. Vergleichbar mit einem Variablennamen.</de>
     *
     * @param xValue <needed><type>mixed</type>
     * <en>The data to be transmitted over the network.</en>
     * <de>Die Daten, die über das Netzwerk übertragen werden sollen.</de>
     */
	public function addNetworkData($_sName, $_xValue = NULL)
	{
        $this->mps(array('oParameters' => $_sName));
		$_xValue = $this->mp(array('sName' => 'xValue', 'xParameter' => $_xValue));
		$_sName = $this->mp(array('sName' => 'sName', 'xParameter' => $_sName));
		$this->oNetwork->addData(array('sName' => $_sName, 'xContent' => $_xValue));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Network
     *
     * @description
     * <en>Sends data over the network and returns the Protocol as a string.</en>
     * <de>Sendet Daten über das Netzwerk und gibt das Protokoll als String zurück.</de>
     *
     * @return sNetworkProtocol <type>string</type>
     * <en>Returns the Protocol as a string.</en>
     * <de>Gibt das Protokoll als String zurück.</de>
     *
     * @param sParameters <type>string</type>
     * <en>Parameters to be transmitted over the network. The parameters can be separated by a & character, just like URL parameters.</en>
     * <de>Parameter, die über das Netzwerk übertragen werden sollen. Die Parameter können mit einem & Zeichen getrennt werden, genau wie bei einer URL die Parameter.</de>
     *
     * @param oNetworkUser <type>object</type>
     * <en>The network user that is sending the data. Used with WebSockets.</en>
     * <de>Der Netzwerk-User, der die Daten sendet. Wird bei WebSockets verwendet.</de>
     */
	public function networkSend($_sParameters = NULL, $_oNetworkUser = NULL)
	{
        $this->mps(array('oParameters' => $_sParameters));
		$_oNetworkUser = $this->mp(array('sName' => 'oNetworkUser', 'xParameter' => $_oNetworkUser));
		$_sParameters = $this->mp(array('sName' => 'sParameters', 'xParameter' => $_sParameters));
		return $this->oNetwork->send(array('sParameters' => $_sParameters, 'oNetworkUser' => $_oNetworkUser));
	}
    /* @end method */

    // Template...
    /**
     * @start method
     *
     * @group Templates
     *
     * @description
     * <en>Initializes the template system for the object / the class.</en>
     * <de>Initialisiert das Template-System für das Objekt/die Klasse.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns a boolean whether the initialization was successful.</en>
     * <de>Gibt ein Boolean zurück, ob die Initialisierung erfolgreich war.</de>
     *
     * @param oTemplate <needed><type>object</type>
     * <en>The template object to be used.</en>
     * <de>Das Template-Objekt, das verwendet werden soll.</de>
     */
	public function initTemplate($_oTemplate = NULL)
	{
        $this->mps(array('oParameters' => $_oTemplate));
		$_oTemplate = $this->mp(array('sName' => 'oTemplate', 'xParameter' => $_oTemplate));
		if ($_oTemplate != NULL) {$this->oTemplate = $_oTemplate; return true;}
		if (class_exists('classPG_Template')) {$this->oTemplate = new classPG_Template(); return true;}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @return oTemplate <type>object</type>
     * <en>...</en>
     */
    public function getTemplate()
    {
        return $this->oTemplate;
    }
    /* @end method */

    /**
     * @start method
     *
     * @param xTemplate <needed><type>mixed</type>
     * <en>...</en>
     */
    public function setTemplate($_xTemplate)
    {
        $this->mps(array('oParameters' => $_xTemplate));
		$this->mp(array('sName' => 'xTemplate', 'xParameter' => $_xTemplate));
        if (is_string($_xTemplate)) {$this->sTemplate = $_xTemplate;}
        else {$this->oTemplate = $_xTemplate;}
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Templates
     *
     * @description
     * <en>Sets the variables and values that should be replaced in the template code.</en>
     * <de>Setzt die Variablen und Werte, die im Template-Code ersetzt werden sollen.</de>
     *
     * @param asVars <needed><type>string[]</type>
     * <en>The variable names and values as an associative string array.</en>
     * <de>Die Variablennamen und Werte als Assoziatives-String-Array.</de>
     */
	public function setTemplateReplaceVars($_asVars)
	{
        $this->mps(array('oParameters' => $_asVars));
		$_asVars = $this->mp(array('sName' => 'asVars', 'xParameter' => $_asVars, 'bNotNull' => true));
		$this->oTemplate->setReplaceVars(array('asVars' => $_asVars));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Templates
     *
     * @description
     * <en>Returns the variable names and values as an associative string array.</en>
     * <de>Gibt die Variablennamen und Werte als Assoziatives-String-Array zurück.</de>
     *
     * @return asVars <type>string[]</type>
     * <en>Returns the variable names and values as an associative string array.</en>
     * <de>Gibt die Variablennamen und Werte als Assoziatives-String-Array zurück.</de>
     */
	public function getTemplateReplaceVars() {return $this->oTemplate->getReplaceVars();}
    /* @end method */

    /**
     * @start method
     *
     * @group Templates
     *
     * @description
     * <en>Sets a variable and its value, to be replaced in the template code.</en>
     * <de>Setzt eine Variable und deren Wert, die im Template-Code ersetzt werden soll.</de>
     *
     * @param sVarname <needed><type>string</type>
     * <en>The name of the variable.</en>
     * <de>Der Name der Variablen.</de>
     *
     * @param sReplace <needed><type>string</type>
     * <en>The value of the variable.</en>
     * <de>Der Wert der Variablen.</de>
     */
	public function addTemplateReplaceVar($_sVarname, $_sReplace = NULL)
	{
        $this->mps(array('oParameters' => $_sVarname));
		$_sReplace = $this->mp(array('sName' => 'sReplace', 'xParameter' => $_sReplace));
		$_sVarname = $this->mp(array('sName' => 'sVarname', 'xParameter' => $_sVarname));
		$this->oTemplate->addReplaceVar(array('sVarname' => $_sVarname, 'sReplace' => $_sReplace));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Templates
     *
     * @description
     * <en>Returns the value of a variable.</en>
     * <de>Gibt den Wert einer Variable zurück.</de>
     *
     * @return sValue <type>string</type>
     * <en>Returns the value of a variable as a string.</en>
     * <de>Gibt den Wert einer Variable als String zurück.</de>
     *
     * @param sVarname <needed><type>string</type>
     * <en>The name of the variable.</en>
     * <de>Der Name der Variablen.</de>
     */
	public function getTemplateReplaceVar($_sVarname)
	{
        $this->mps(array('oParameters' => $_sVarname));
		$_sVarname = $this->mp(array('sName' => 'sVarname', 'xParameter' => $_sVarname));
		return $this->oTemplate->getReplaceVar(array('sVarname' => $_sVarname));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Templates
     *
     * @description
     * <en>Builds the template and returns HTML as a string.</en>
     * <de>Erstellt das Template und gibt HTML als String zurück.</de>
     *
     * @return sTemplateHtml <type>string</type>
     * <en>Returns HTML as a string.</en>
     * <de>Gibt HTML als String zurück.</de>
     *
     * @param xTemplate <type>mixed</type>
     * <en>The template as a file path or the code of the template as a string.</en>
     * <de>Das Template als Dateipfad oder der Code des Templates als String.</de>
     *
     * @param bReplaceUrlProtocols <type>bool</type>
     * <en>Specifies whether the protocols of used absolute URLs to be converted, if necessary.</en>
     * <de>Gibt an ob die Protokolle der verwendeten absoluten URLs umgewandelt werden sollen, wenn es nötig ist.</de>
     *
     * @param bReplaceBBCode <type>bool</type>
     * <en>Specifies whether BB code will automatically be converted.</en>
     * <de>Gibt an ob BB-Code automatisch umgewandelt werden soll.</de>
     *
     * @param bReplaceDates <type>bool</type>
     * <en>Specifies whether the date variables to be converted automatically.</en>
     * <de>Gibt an ob Datumsvariablen automatisch umgesetzt werden sollen.</de>
     *
     * @param bEncodeMails <type>bool</type>
     * <en>Specifies whether mail addresses should be encoded.</en>
     * <de>Gibt an ob E-Mail-Adressen kodiert werden sollen.</de>
     */
	public function buildTemplate($_xTemplate = NULL, $_bReplaceUrlProtocols = NULL, $_bReplaceBBCode = NULL, $_bReplaceDates = NULL, $_bEncodeMails = NULL)
	{
        $this->mps(array('oParameters' => $_xTemplate));
		$_bReplaceUrlProtocols = $this->mp(array('sName' => 'bReplaceUrlProtocols', 'xParameter' => $_bReplaceUrlProtocols));
		$_bReplaceBBCode = $this->mp(array('sName' => 'bReplaceBBCode', 'xParameter' => $_bReplaceBBCode));
		$_bReplaceDates = $this->mp(array('sName' => 'bReplaceDates', 'xParameter' => $_bReplaceDates));
		$_bEncodeMails = $this->mp(array('sName' => 'bEncodeMails', 'xParameter' => $_bEncodeMails));
		$_xTemplate = $this->mp(array('sName' => 'xTemplate', 'xParameter' => $_xTemplate));
		return $this->oTemplate->build(array('xTemplate' => $_xTemplate, 'bReplaceUrlProtocols' => $_bReplaceUrlProtocols, 'bReplaceBBCode' => $_bReplaceBBCode, 'bReplaceDates' => $_bReplaceDates, 'bEncodeMails' => $_bEncodeMails));
	}
    /* @end method */

    // Database...
    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Initializes the database functions for the object / the class.</en>
     * <de>Initialisiert die Datenbank Funktionen für das Objekt / die Klasse.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns whether the initialization was successful.</en>
     * <de>Gibt zurück ob die Initialisierung erfolgreich war.</de>
     *
     * @param oDatabase <type>object</type>
     * <en>The database object which is to be used.</en>
     * <de>Das Datenbank-Objekt, welches verwendet werden soll.</de>
     *
     * @param oMySql <type>object</type>
     * <en>The mysql object which is to be used.</en>
     * <de>Das MySql-Objekt, welches verwendet werden soll.</de>
     *
     * @param oMsSql <type>object</type>
     * <en>The mssql object which is to be used.</en>
     * <de>Das MsSql-Objekt, welches verwendet werden soll.</de>
     *
     * @param oMongo <type>object</type>
     * <en>The mongo object which is to be used.</en>
     * <de>Das Mongo-Objekt, welches verwendet werden soll.</de>
     */
	public function initDatabase($_oDatabase = NULL, $_oMySql = NULL, $_oMsSql = NULL, $_oMongo = NULL)
	{
        $this->mps(array('oParameters' => $_oDatabase));
		$_oMySql = $this->mp(array('sName' => 'oMySql', 'xParameter' => $_oMySql));
		$_oMsSql = $this->mp(array('sName' => 'oMsSql', 'xParameter' => $_oMsSql));
		$_oMongo = $this->mp(array('sName' => 'oMongo', 'xParameter' => $_oMongo));
		$_oDatabase = $this->mp(array('sName' => 'oDatabase', 'xParameter' => $_oDatabase));
		
		if ($_oDatabase != NULL) {$this->oDatabase = $_oDatabase;}
		else if (class_exists('classPG_Database'))
		{
			global $oPGDatabase;
			if (isset($oPGDatabase)) {$this->oDatabase = $oPGDatabase;}
		}
		
		if ($_oMySql != NULL) {$this->oDatabase->setMySql(array('oMySql' => $_oMySql));}
		else if (($this->oDatabase->getMySql() == NULL) && (class_exists('classPG_MySql')))
		{
			global $oPGMySql;
			// if (isset($oPGMySql)) {$oPGDatabase->setMySql(array('oMySql' => $oPGMySql));}
            if (isset($oPGMySql)) {$this->oDatabase->setMySql(array('oMySql' => $oPGMySql));}
		}
		
		if ($_oMsSql != NULL) {$this->oDatabase->setMsSql(array('oMsSql' => $_oMsSql));}
		else if (($this->oDatabase->getMsSql() == NULL) && (class_exists('classPG_MsSql')))
		{
			global $oPGMsSql;
			// if (isset($oPGMsSql)) {$oPGDatabase->setMsSql(array('oMsSql' => $oPGMsSql));}
            if (isset($oPGMsSql)) {$this->oDatabase->setMsSql(array('oMsSql' => $oPGMsSql));}
		}
		
		if ($_oMongo != NULL) {$this->oDatabase->setMongo(array('oMongo' => $_oMongo));}
		else if (($this->oDatabase->getMongo() == NULL) && (class_exists('classPG_Mongo')))
		{
			global $oPGMongo;
			// if (isset($oPGMongo)) {$oPGDatabase->setMongo(array('oMongo' => $oPGMongo));}
            if (isset($oPGMongo)) {$this->oDatabase->setMongo(array('oMongo' => $oPGMongo));}
		}
		
		if ($_oDatabase != NULL) {return true;}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Specifies whether the database should be used.</en>
     * <de>Gibt an ob die Datenbank verwendet werden soll.</de>
     *
     * @param bUse <needed><type>bool</type>
     * <en>Specifies whether the database should be used.</en>
     * <de>Gibt an ob die Datenbank verwendet werden soll.</de>
     */
	public function useDatabase($_bUse)
	{
        $this->mps(array('oParameters' => $_bUse));
		$_bUse = $this->mp(array('sName' => 'bUse', 'xParameter' => $_bUse));
		$this->bUseDatabase = $_bUse;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Returns whether the database is used.</en>
     * <de>Gibt zurück, ob die Datenbank verwendet wird.</de>
     */
	public function isDatabase()
	{
		return $this->bUseDatabase;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the database object.</en>
     * <de>Setzt das Datenbank Objekt.</de>
     *
     * @param oDatabase <needed><type>object</type>
     * <en>The database object.</en>
     * <de>Das Datenbank Objekt.</de>
     */
	public function setDatabase($_oDatabase)
	{
        $this->mps(array('oParameters' => $_oDatabase));
		$_oDatabase = $this->mp(array('sName' => 'oDatabase', 'xParameter' => $_oDatabase));
		$this->oDatabase = $_oDatabase;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Returns the database object.</en>
     * <de>Gibt das Datenbank Objekt zurück.</de>
     */
	public function getDatabase()
	{
		return $this->oDatabase;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the database host which is to be used.</en>
     * <de>Setzt den Datenbank-Host, welcher verwendet werden soll.</de>
     *
     * @param sHost <needed><type>string</type>
     * <en>The host to which a connection should be established.</en>
     * <de>Der Host zu dem eine Connection aufgebaut werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function setDatabaseHost($_sHost, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sHost));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sHost = $this->mp(array('sName' => 'sHost', 'xParameter' => $_sHost));
		$this->oDatabase->setHost(array('sHost' => $_sHost, 'sEngine' => $_sEngine));
	}
	/* @end method */

    /** @start method */
    public function getDatabaseHost() {return $this->oDatabase->getDatabaseHost();}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the user name used to establish of the connection</en>
     * <de>Setzt den Usernamen der zum Aufbau der Connection benötigt wird.</de>
     *
     * @param sUser <needed><type>string</type>
     * <en>The user to be used for the connection.</en>
     * <de>Der User der für die Connection verwendet werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function setDatabaseUser($_sUser, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sUser));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sUser = $this->mp(array('sName' => 'sUser', 'xParameter' => $_sUser));
		$this->oDatabase->setUser(array('sUser' => $_sUser, 'sEngine' => $_sEngine));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the password used to establish of the connection</en>
     * <de>Setzt das Passwort, welches zum Aufbau der Connection benötigt wird.</de>
     *
     * @param sPassword <needed><type>string</type>
     * <en>The password to be used for the connection.</en>
     * <de>Das passwort, welches für die Connection verwendet werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function setDatabasePassword($_sPassword, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sPassword));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sPassword = $this->mp(array('sName' => 'sPassword', 'xParameter' => $_sPassword));
		$this->oDatabase->setPassword(array('sPassword' => $_sPassword, 'sEngine' => $_sEngine));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the name of the database to which a connection should be established.</en>
     * <de>Setzt den Namen der Datenbank zu dem eine Connection aufgebaut werden soll.</de>
     *
     * @param sDatabase <needed><type>string</type>
     * <en>The name of the database to be used.</en>
     * <de>Der Name der Datenbank, die verwendet werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function setDatabaseDBName($_sDatabase, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sDatabase));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sDatabase = $this->mp(array('sName' => 'sDatabase', 'xParameter' => $_sDatabase));
		$this->oDatabase->setDatabaseName(array('sDatabase' => $_sDatabase, 'sEngine' => $_sEngine));
	}
    /* @end method */

    /**
     * @start method
     *
     * @return sDatabaseName <type>string</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function getDatabaseDBName($_sEngine = NULL)
    {
        $this->mps(array('oParameters' => $_sEngine));
        $_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
        return $this->oDatabase->getDatabaseName(array('sEngine' => $_sEngine));
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the database engine, which by default should be used</en>
     * <de>Setzt die Datenbank-Engine, welche standardgemäß verwendet werden soll.</de>
     *
     * @param sEngine <needed><type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function setDatabaseEngine($_sEngine)
	{
        $this->mps(array('oParameters' => $_sEngine));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$this->oDatabase->setDatabaseEngine(array('sEngine' => $_sEngine));
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets a prefix, which is to be used before each table name.</en>
     * <de>Setzt ein Prefix, welches vor jedem Tabellennamen gesetzt werden soll.</de>
     *
     * @param sPrefix <needed><type>string</type>
     * <en>The prefix, which is to be used before each table name.</en>
     * <de>Das Prefix, welches vor jedem Tabellennamen gesetzt werden soll.</de>
     */
	public function setDatabaseTablePrefix($_sPrefix)
	{
        $this->mps(array('oParameters' => $_sPrefix));
		$_sPrefix = $this->mp(array('sName' => 'sPrefix', 'xParameter' => $_sPrefix));
		$this->sDatabaseTablePrefix = $_sPrefix;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Returns the prefix that is used by every table name.</en>
     * <de>Gibt den Prefix zurück, der bei jedem Tabellennamen verwendet wird.</de>
     *
     * @return sPrefix <type>string</type>
     * <en>Returns the prefix as a string that is used for each table name.</en>
     * <de>Gibt den Prefix als String zurück, der bei jedem Tabellennamen verwendet wird.</de>
     */
	public function getDatabaseTablePrefix() {return $this->sDatabaseTablePrefix;}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Establishes a connection to the database.</en>
     * <de>Stellt eine Verbindung zur Datenbank her.</de>
     *
     * @return oConnection <type>object</type>
     * <en>Returns the connection as object if it was successful.</en>
     * <de>Gibt die Connection (Verbindung) als Objekt zurück, wenn es erfolgreich war.</de>
     *
     * @param sHost <type>string</type>
     * <en>The host to which the connection should be established.</en>
     * <de>Der Host zu dem die Verbindung aufgebaut werden soll.</de>
     *
     * @param sUser <type>string</type>
     * <en>The name of the user through which the connection should be made.</en>
     * <de>Der Name des Benutzers über den die Verbindung hergestellt werden soll.</de>
     *
     * @param sPassword <type>string</type>
     * <en>The password that is required for a connection.</en>
     * <de>Das Passwort, welches für eine Verbindung benötigt wird.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function connectToDatabase($_sHost = NULL, $_sUser = NULL, $_sPassword = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sHost));
		$_sUser = $this->mp(array('sName' => 'sUser', 'xParameter' => $_sUser));
		$_sPassword = $this->mp(array('sName' => 'sPassword', 'xParameter' => $_sPassword));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sHost = $this->mp(array('sName' => 'sHost', 'xParameter' => $_sHost));
		if ($this->oDatabase != NULL) {return $this->oDatabase->connect(array('sHost' => $_sHost, 'sUser' => $_sUser, 'sPassword' => $_sPassword, 'sEngine' => $_sEngine));}
		return NULL;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Closes the connection to the database.</en>
     * <de>Schließt die Verbindung zur Datenbank.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns a Boolean whether the closing of the connection was successful.</en>
     * <de>Gibt einen Boolean zurück, ob das Schließen der Verbindung erfolgreich war.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function disconnectDatabase($_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sEngine));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		if ($this->oDatabase != NULL) {return $this->oDatabase->disconnect(array('sEngine' => $_sEngine));}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sets the name of the database that is to be used and tries to connect.</en>
     * <de>Setzt den Namen der Datenbank, die verwendet werden soll und versucht zu verbinden.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns a Boolean whether the connection is successfully established.</en>
     * <de>Gibt einen Boolean zurück, ob die Verbindung erfolgreich zustande gekommen ist.</de>
     *
     * @param sDatabase <needed><type>string</type>
     * <en>The name of the database to be used.</en>
     * <de>Der Namen der Datenbank, die verwendet werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function changeToDatabase($_sDatabase = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sDatabase));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sDatabase = $this->mp(array('sName' => 'sDatabase', 'xParameter' => $_sDatabase));
		if ($this->oDatabase != NULL) {return $this->oDatabase->changeDatabase(array('sDatabase' => $_sDatabase, 'sEngine' => $_sEngine));}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Tests whether a connection already exists and if not, then it tries to establish a connection.</en>
     * <de>Testet ob eine Verbindung bereits besteht und wenn nicht, dann versucht es eine Verbindung aufzubauen.</de>
     */
	public function checkDatabaseConnection()
	{
		$this->connectToDatabase();
		$this->changeToDatabase();
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>...</en>
     *
     * @param bUse <needed><type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function useDatabaseForceAllRights($_bUse, $_sEngine = NULL)
    {
        $this->mps(array('oParameters' => $_bUse));
        $_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
        $_bUse = $this->mp(array('oParameters' => $_bUse, 'sName' => 'bUse', 'xParameter' => $_bUse));
        $this->oDatabase->useForceAllRights(array('bUse' => $_bUse, 'sEngine' => $_sEngine));
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Sends an SQL statement to the database and may return a result.</en>
     * <de>Sendet ein SQL-Statement an die Datenbank und gibt ggf. einen Result (Ergebnis einer Anfrage) zurück.</de>
     *
     * @return oResult <type>object</type>
     * <en>May return a result. Otherwise can be queried whether the return is positive and the statement has been successfully executed.</en>
     * <de>Gibt ggf. einen Result zurück. Ansonsten kann abgefragt werden ob die Rückgabe Positiv ist und das Statement erfolgreich umgesetzt wurde.</de>
     *
     * @param xStatement <needed><type>mixed</type>
     * <en>
     *     The SQL statement to be executed.
     *     Can also be an associative string array, which should each database engine execute another SQL statement.
     *     An example of a string associative array:
     *     asStatements['mysql'] = 'SELECT * FROM users LIMIT 0,10';
     *     asStatements['mssql'] = 'SELECT * FROM users LIMIT 10,10';
     * </en>
     * <de>
     *     Das SQL-Statement, welches ausgeführt werden soll.
     *     Kann auch ein Assoziatives-String-Array sein, welches pro Datenbank-Engine einen anderen SQL-Statement ausführen soll.
     *     Ein Beispiel für ein Assoziatives-String-Array:
     *     asStatements['mysql'] = 'SELECT * FROM users LIMIT 0,10';
     *     asStatements['mssql'] = 'SELECT * FROM users LIMIT 10,10';
     * </de>
     *
     * @param bAllowInfoSchema <type>bool</type>
     * <en>Specifies whether info schema statements are allowed.</en>
     * <de>Gibt an ob Info Schema Statements erlaubt sind. (Default: false)</de>
     *
     * @param bAllowUnion <type>bool</type>
     * <en>Specifies whether Union statements are allowed. (Default: false)</en>
     * <de>Gibt an ob Union Statements erlaubt sind. (Default: false)</de>
     *
     * @param bAllowVersion <type>bool</type>
     * <en>Specifies whether version queries are allowed in statements. (Default: false)</en>
     * <de>Gibt an ob Versionsabfragen in Statements erlaubt sind. (Default: false)</de>
     *
     * @param bAllowAnonymInsert <type>bool</type>
     * <en>...</en>
     *
     * @param bAllowAnonymUpdate <type>bool</type>
     * <en>...</en>
     *
     * @param bAllowAnonymDelete <type>bool</type>
     * <en>...</en>
     *
     * @param bAllowAnonymChangeStructure <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function sendQueryToDatabase(
		$_xStatement, 
		$_bAllowInfoSchema = NULL, 
		$_bAllowUnion = NULL, 
		$_bAllowVersion = NULL,
 		$_bAllowAnonymInsert = NULL,
		$_bAllowAnonymUpdate = NULL,
		$_bAllowAnonymDelete = NULL,
        $_bAllowAnonymChangeStructure = NULL,
		$_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_xStatement));
		$_bAllowInfoSchema = $this->mp(array('sName' => 'bAllowInfoSchema', 'xParameter' => $_bAllowInfoSchema));
		$_bAllowUnion = $this->mp(array('sName' => 'bAllowUnion', 'xParameter' => $_bAllowUnion));
		$_bAllowVersion = $this->mp(array('sName' => 'bAllowVersion', 'xParameter' => $_bAllowVersion));
		$_bAllowAnonymInsert = $this->mp(array('sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->mp(array('sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_bAllowAnonymDelete = $this->mp(array('sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_bAllowAnonymChangeStructure = $this->mp(array('sName' => 'bAllowAnonymChangeStructure', 'xParameter' => $_bAllowAnonymChangeStructure));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xStatement = $this->mp(array('sName' => 'xStatement', 'xParameter' => $_xStatement, 'bNotNull' => true));
		
		if ($this->oDatabase != NULL)
		{
			return $this->oDatabase->sendQuery(
				array(
					'xStatement' => $_xStatement, 
					'bAllowInfoSchema' => $_bAllowInfoSchema, 
					'bAllowUnion' => $_bAllowUnion, 
					'bAllowVersion' => $_bAllowVersion,
					'bAllowAnonymInsert' => $_bAllowAnonymInsert,
					'bAllowAnonymUpdate' => $_bAllowAnonymUpdate,
					'bAllowAnonymDelete' => $_bAllowAnonymDelete,
                    'bAllowAnonymChangeStructure' => $_bAllowAnonymChangeStructure,
					'sEngine' => $_sEngine
				)
			);
		}
		
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>
     *     Changes a string, so for example SQL injections (by hackers) can not be performed.
     *     Should always be used when writing the SQL statements by hand completely on your own.
     *     But also long time no guarantee that hackers are blocked when you use it.
     *     You should use it only as additional protection to other security measures.
     * </en>
     * <de>
     *     Verändert einen String, damit z.B. SQL-Injections (von Hackern) nicht ausgeführt werden können.
     *     Sollte unbedingt verwendet werden, wenn man die SQL-Statements komplett selbst schreibt.
     *     Bei Verwendung ist es aber auch noch lange keine Garantie dafür, dass Hacker abgewehrt werden.
     *     Man sollte es nur als zusätzlichen Schutz zu anderen Sicherheitsmaßnahmen verwenden.
     * </de>
     *
     * @return sString <type>string</type>
     * <en>The string that is to be protected from hackers.</en>
     * <de>Der String, der vor Hackern geschützt werden soll.</de>
     *
     * @param xString <needed><type>mixed</type>
     * <en>The string that is to be protected from hackers. But it can also pass an string array.</en>
     * <de>Der String, der vor Hackern geschützt werden soll. Es kann aber auch ein String-Array übergeben werden.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function realEscapeDatabaseString($_xString, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_xString));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xString = $this->mp(array('sName' => 'xString', 'xParameter' => $_xString, 'bNotNull' => true));
		if ($this->oDatabase != NULL) {return $this->oDatabase->realEscapeString(array('xString' => $_xString, 'sEngine' => $_sEngine));}
		return $_xString;
	}
	/* @end method */
	
    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Returns the number of rows (datasets) in a result of a query.</en>
     * <de>Gibt die Anzahl der Zeilen (Datensätze) eines Results (Ergebnis einer Abfrage) zurück.</de>
     *
     * @return iRowCount <type>int</type>
     * <en>Returns the number of rows (datasets) as an integer.</en>
     * <de>Gibt die Anzahl an Zeilen (Datensätze) als Integer zurück.</de>
     *
     * @param xResult <type>mixed</type>
     * <en>The result of which was returned by the database query.</en>
     * <de>Der Result der von der Datenbank-Abfrage zurückgeliefert wurde.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function getDatasetsRowCount($_xResult = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_xResult));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xResult = $this->mp(array('sName' => 'xResult', 'xParameter' => $_xResult));
		if ($this->oDatabase != NULL) {return $this->oDatabase->getRowCount(array('xResult'=> $_xResult, 'sEngine' => $_sEngine));}
		return 0;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Converts a row (dataset) from a database result to an associative array.</en>
     * <de>Wandelt eine Zeile (Datensatz) von einem Datenbank-Result in einen Assoziativen-Array um.</de>
     *
     * @return axData <type>mixed[]</type>
     * <en>Returns an associative array.</en>
     * <de>Gibt einen Assoziativen Array zurück.</de>
     *
     * @param xResult <type>mixed</type>
     * <en>The result object or an associative array of result objects.</en>
     * <de>Das Result-Objekt oder ein assoziatives Array von Result-Objekten.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function fetchDatabaseArray($_xResult = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_xResult));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_xResult = $this->mp(array('sName' => 'xResult', 'xParameter' => $_xResult));
		if ($this->oDatabase != NULL) {return $this->oDatabase->fetchArray(array('xResult'=> $_xResult, 'sEngine' => $_sEngine));}
		return NULL;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Collects data from the database and returns a result object.</en>
     * <de>Sammelt Daten aus der Datenbank und gibt sie in einem Result-Objekt zurück.</de>
     *
     * @return oResult <type>object</type>
     * <en>Returns a result object.</en>
     * <de>Gibt ein Result-Objekt zurück.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table from which the data are to pick up.</en>
     * <de>Die Tabelle aus der die Daten zu holen sind.</de>
     *
     * @param asColumns <type>string[]</type>
     * <en>The columns of the table, their data should be taken.</en>
     * <de>Die Spalten der Tabelle, deren Daten geholt werden sollen.</de>
     *
     * @param xWhere <type>string</type>
     * <en>The condition under which to collect the data.</en>
     * <de>Die Bedingung, unter der die Daten gesammelt werden sollen.</de>
     *
     * @param iStart <type>int</type>
     * <en>The starting position from which dataset collected data should be returned.</en>
     * <de>Die Startposition, ab welchen Datensatz die gesammelten Daten zurückgegeben werden sollen.</de>
     *
     * @param iCount <type>int</type>
     * <en>The number of datasets to be returned from the collected data.</en>
     * <de>Die Anzahl an Datensätze die von den gesammelten Daten zurückgegeben werden sollen.</de>
     *
     * @param sOrderBy <type>string</type>
     * <en>The name of the column to be sort.</en>
     * <de>Der Name der Spalte nach der sortiert werden soll.</de>
     *
     * @param bOrderReverse <type>bool</type>
     * <en>Specifies whether backward (from high to low) to sort.</en>
     * <de>Gibt an ob Rückwärts (von groß nach klein) sortiert werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function selectDatasets($_sTable, $_asColumns = NULL, $_xWhere = NULL, $_iStart = NULL, $_iCount = NULL, $_sOrderBy = NULL, $_bOrderReverse = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_asColumns = $this->mp(array('sName' => 'asColumns', 'xParameter' => $_asColumns));
		$_xWhere = $this->mp(array('sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_iStart = $this->mp(array('sName' => 'iStart', 'xParameter' => $_iStart));
		$_iCount = $this->mp(array('sName' => 'iCount', 'xParameter' => $_iCount));
		$_sOrderBy = $this->mp(array('sName' => 'sOrderBy', 'xParameter' => $_sOrderBy));
		$_bOrderReverse = $this->mp(array('sName' => 'bOrderReverse', 'xParameter' => $_bOrderReverse));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($this->oDatabase != NULL) {return $this->oDatabase->select(array('sTable' => $_sTable, 'asColumns' => $_asColumns, 'xWhere' => $_xWhere, 'iStart' => $_iStart, 'iCount' => $_iCount, 'sOrderBy' => $_sOrderBy, 'bOrderReverse' => $_bOrderReverse, 'sEngine' => $_sEngine));}
		return NULL;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Adds a dataset to a table and returns the new ID.</en>
     * <de>Fügt einen Datensatz einer Tabelle hinzu und gibt die neue ID zurück.</de>
     *
     * @return iInsertID <type>int</type>
     * <en>Returns the new InsertID.</en>
     * <de>Gibt die neue InsertID zurück.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table, which is a new dataset to be added.</en>
     * <de>Die Tabelle, der ein neuer Datensatz hinzugefügt werden soll.</de>
     *
     * @param axColumnsAndValues <type>mixed[]</type>
     * <en>The column names and values as an associative array to add the new dataset.</en>
     * <de>Die Spaltennamen und Werte als assoziatives Array zum hinzufügen des neuen Datensatzes.</de>
     *
     * @param sAutoIDColumn <type>string</type>
     * <en>...</en>
     *
     * @param bStripSlashes <type>bool</type>
     * <en>Specifies whether to remove slashes ("/" character).</en>
     * <de>Gibt an ob Slashes ("/" Zeichen) entfernt werden sollen.</de>
     *
     * @param bAllowAnonymInsert <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function insertDataset($_sTable, $_axColumnsAndValues = NULL, $_sAutoIDColumn = NULL, $_bStripSlashes = NULL, $_bAllowAnonymInsert = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_axColumnsAndValues = $this->mp(array('sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
        $_sAutoIDColumn = $this->mp(array('sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
		$_bStripSlashes = $this->mp(array('sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymInsert = $this->mp(array('sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($this->oDatabase != NULL) {return $this->oDatabase->insert(array('sTable' => $_sTable, 'axColumnsAndValues' => $_axColumnsAndValues, 'sAutoIDColumn' => $_sAutoIDColumn, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'sEngine' => $_sEngine));}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Updates datasets from a table.</en>
     * <de>Aktualisiert Datensätze einer Tabelle.</de>
     *
     * @return xIDValue <type>mixed</type>
     * <en>Returns the ID on success or false on failure.</en>
     * <de>Gibt bei erfolg die ID oder bei einem Fehler false zurück.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table whose datasets should be updated.</en>
     * <de>Die Tabelle, deren Datensätze aktualisiert werden sollen.</de>
     *
     * @param sIDColumn <type>string</type>
     * <en>The name of the column that has been marked as the ID of the table datasets.</en>
     * <de>Der Name der Spalte, die als ID der Datensätze einer Tabelle markiert wurde.</de>
     *
     * @param xIDValue <type>mixed</type>
     * <en>The value of the ID if a certain dataset should be updated.</en>
     * <de>Der Wert der ID, falls ein bestimmter Datensatz aktualisiert werden soll.</de>
     *
     * @param axColumnsAndValues <type>mixed[]</type>
     * <en>The column names and values as an associative array to update the datasets.</en>
     * <de>Die Spaltennamen und Werte als assoziatives Array zum Aktualisieren der Datensätze.</de>
     *
     * @param xWhere <type>string</type>
     * <en>The condition under which to update the data.</en>
     * <de>Die Bedingung, unter der die Daten Aktualisiert werden sollen.</de>
     *
     * @param bStripSlashes <type>bool</type>
     * <en>Specifies whether to remove slashes ("/" character).</en>
     * <de>Gibt an ob Slashes ("/" Zeichen) entfernt werden sollen.</de>
     *
     * @param bAllowAnonymUpdate <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function updateDatasets($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_xWhere = NULL, $_bStripSlashes = NULL, $_bAllowAnonymUpdate = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_sIDColumn = $this->mp(array('sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->mp(array('sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->mp(array('sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_xWhere = $this->mp(array('sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_bStripSlashes = $this->mp(array('sName' => 'bStripSlashes', 'xParameter' => $_bStripSlashes));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymUpdate = $this->mp(array('sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($_bStripSlashes === NULL) {$_bStripSlashes = false;}
		if ($this->oDatabase != NULL) {return $this->oDatabase->update(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'xWhere' => $_xWhere, 'bStripSlashes' => $_bStripSlashes, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate, 'sEngine' => $_sEngine));}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Stores one dataset in a table. This detects whether the dataset already exists, or is to be added.</en>
     * <de>Speichert einen Datensatz in einer Tabelle. Erkennt dabei ob der Datensatz schon vorhanden ist oder neu hinzugefügt werden soll.</de>
     *
     * @return xMixed <type>mixed</type>
     * <en>Returns the ID on success or false on failure.</en>
     * <de>Gibt bei erfolg die ID oder bei einem Fehler false zurück.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table whose datasets should be updated or added.</en>
     * <de>Die Tabelle, deren Datensätze aktualisiert oder hinzugefügt werden sollen.</de>
     *
     * @param sIDColumn <needed><type>string</type>
     * <en>The name of the column that has been marked as the ID (of the table datasets).</en>
     * <de>Der Name der Spalte, die als ID (der Datensätze einer Tabelle) markiert wurde.</de>
     *
     * @param xIDValue <needed><type>mixed</type>
     * <en>The value of the ID if a certain dataset should be updated.</en>
     * <de>Der Wert der ID, falls ein bestimmter Datensatz aktualisiert werden soll.</de>
     *
     * @param axColumnsAndValues <type>mixed[]</type>
     * <en>The column names and values as an associative array to update or add the dataset.</en>
     * <de>Die Spaltennamen und Werte als assoziatives Array zum Aktualisieren oder hinzufügen des Datensatzes.</de>
     *
     * @param axColumnsAndValuesOnInsert <type>mixed[]</type>
     * <en>The column names and values as an associative array to add the dataset. (Is used only when the dataset will be created.)</en>
     * <de>Die Spaltennamen und Werte als assoziatives Array zum hinzufügen des Datensatzes. (Wird nur verwendet, wenn der Datensatz neu angelegt wird.)</de>
     *
     * @param axColumnsAndValuesOnUpdate <type>mixed[]</type>
     * <en>The column names and values as an associative array to update the dataset. (Is used only when an existing dataset is updated.)</en>
     * <de>Die Spaltennamen und Werte als assoziatives Array zum Aktualisieren des Datensatzes. (Wird nur verwendet, wenn ein vorhandener Datensatz aktualisiert wird.)</de>
     *
     * @param sAutoIDColumn <type>string</type>
     * <en>...</en>
     *
     * @param xWhere <type>string</type>
     * <en>The condition under which the data to be updated or under what condition an existing dataset is to look.</en>
     * <de>Die Bedingung, unter der die Daten Aktualisiert werden sollen oder unter welcher Bedingung ein vorhandener Datensatz zu suchen ist.</de>
     *
     * @param bAllowAnonymInsert <type>bool</type>
     * <en>...</en>
     *
     * @param bAllowAnonymUpdate <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function saveDataset($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_axColumnsAndValues = NULL, $_axColumnsAndValuesOnInsert = NULL, $_axColumnsAndValuesOnUpdate = NULL, $_sAutoIDColumn = NULL, $_xWhere = NULL, $_bAllowAnonymInsert = NULL, $_bAllowAnonymUpdate = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_sIDColumn = $this->mp(array('sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->mp(array('sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_axColumnsAndValues = $this->mp(array('sName' => 'axColumnsAndValues', 'xParameter' => $_axColumnsAndValues));
		$_axColumnsAndValuesOnInsert = $this->mp(array('sName' => 'axColumnsAndValuesOnInsert', 'xParameter' => $_axColumnsAndValuesOnInsert));
		$_axColumnsAndValuesOnUpdate = $this->mp(array('sName' => 'axColumnsAndValuesOnUpdate', 'xParameter' => $_axColumnsAndValuesOnUpdate));
        $_sAutoIDColumn = $this->mp(array('sName' => 'sAutoIDColumn', 'xParameter' => $_sAutoIDColumn));
		$_xWhere = $this->mp(array('sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymInsert = $this->mp(array('sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
		$_bAllowAnonymUpdate = $this->mp(array('sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($this->oDatabase != NULL) {return $this->oDatabase->save(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'axColumnsAndValues' => $_axColumnsAndValues, 'axColumnsAndValuesOnInsert' => $_axColumnsAndValuesOnInsert, 'axColumnsAndValuesOnUpdate' => $_axColumnsAndValuesOnUpdate, 'sAutoIDColumn' => $_sAutoIDColumn, 'xWhere' => $_xWhere, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate, 'sEngine' => $_sEngine));}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Deletes datasets from a table.</en>
     * <de>Löscht Datensätze aus einer Tabelle.</de>
     *
     * @return bSuccess <type>bool</type>
     * <en>Returns a boolean whether the deletion was successful.</en>
     * <de>Gibt einen Boolean zurück, ob das Löschen erfolgreich war.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table whose datasets are to be deleted.</en>
     * <de>Die Tabelle, deren Datensätze gelöscht werden sollen.</de>
     *
     * @param sIDColumn <needed><type>string</type>
     * <en>The name of the column that has been marked as the ID of the table datasets.</en>
     * <de>Der Name der Spalte, die als ID der Datensätze einer Tabelle markiert wurde.</de>
     *
     * @param xIDValue <needed><type>mixed</type>
     * <en>The value of the ID if a certain dataset should be deleted.</en>
     * <de>Der Wert der ID, falls ein bestimmter Datensatz gelöscht werden soll.</de>
     *
     * @param xWhere <type>string</type>
     * <en>The condition under which the datasets should be deleted.</en>
     * <de>Die Bedingung, unter der die Datensätze gelöscht werden sollen.</de>
     *
     * @param bAllowAnonymDelete <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function deleteDatasets($_sTable, $_sIDColumn = NULL, $_xIDValue = NULL, $_xWhere = NULL, $_bAllowAnonymDelete = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_sIDColumn = $this->mp(array('sName' => 'sIDColumn', 'xParameter' => $_sIDColumn));
		$_xIDValue = $this->mp(array('sName' => 'xIDValue', 'xParameter' => $_xIDValue));
		$_xWhere = $this->mp(array('sName' => 'xWhere', 'xParameter' => $_xWhere));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_bAllowAnonymDelete = $this->mp(array('sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($this->oDatabase != NULL) {return $this->oDatabase->delete(array('sTable' => $_sTable, 'sIDColumn' => $_sIDColumn, 'xIDValue' => $_xIDValue, 'xWhere' => $_xWhere, 'bAllowAnonymDelete' => $_bAllowAnonymDelete, 'sEngine' => $_sEngine));}
		return false;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Reads column information from a column of a table and returns that information.</en>
     * <de>Liest Spalteninformationen einer Spalte von einer Tabelle aus und gibt diese Informationen zurück.</de>
     *
     * @return axColumnStructure <type>mixed[]</type>
     * <en>Returns the column information as an associative array.</en>
     * <de>Gibt die Spalteninformationen als assoziatives Array zurück.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table from which the column information to be read.</en>
     * <de>Die Tabelle von der die Spalteninformationen gelesen werden sollen.</de>
     *
     * @param sColumn <needed><type>string</type>
     * <en>The column for which information is to be read.</en>
     * <de>Die Spalte, deren Informationen ausgelesen werden sollen.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function getDatabaseTableColumnInfos($_sTable, $_sColumn = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_sColumn = $this->mp(array('sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($this->oDatabase != NULL) {return $this->oDatabase->getColumnInfos(array('sTable' => $_sTable, 'sColumn' => $_sColumn, 'sEngine' => $_sEngine));}
		return NULL;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Removes a column from a table of a database.</en>
     * <de>Entfernt eine Spalte aus einer Tabelle von einer Datenbank.</de>
     *
     * @return xMixed <type>mixed</type>
     * <en>Returns a boolean, or an associative array of boolean whether the column has been successfully deleted.</en>
     * <de>Gibt einen Boolean oder ein assoziatives Boolean-Array zurück, ob die spalte erfolgreich gelöscht wurde.</de>
     *
     * @param sTable <needed><type>string</type>
     * <en>The table from which the column should be removed.</en>
     * <de>Die Tabelle von der die Spalte entfernt werden soll.</de>
     *
     * @param sColumn <needed><type>string</type>
     * <en>The name of the column that is to be removed.</en>
     * <de>Der Name der Spalte, die entfernt werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function removeDatabaseTableColumn($_sTable, $_sColumn = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sTable));
		$_sColumn = $this->mp(array('sName' => 'sColumn', 'xParameter' => $_sColumn));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sTable = $this->mp(array('sName' => 'sTable', 'xParameter' => $_sTable));
		if ($this->oDatabase != NULL) {return $this->oDatabase->removeColumn(array('sTable' => $_sTable, 'sColumn' => $_sColumn, 'sEngine' => $_sEngine));}
		return NULL;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>Changes the name of a column from a table of a database.</en>
     * <de>Ändert den Namen einer Spalte aus einer Tabelle von einer Datenbank.</de>
     *
     * @return xMixed <type>mixed</type>
     * <en>Returns a boolean, or an associative array of boolean whether the column has been successfully changed.</en>
     * <de>Gibt einen Boolean oder ein assoziatives Boolean-Array zurück, ob die spalte erfolgreich geändert wurde.</de>
     *
     * @param sOldName <needed><type>string</type>
     * <en>The old name of the column.</en>
     * <de>Der alte Name der Spalte.</de>
     *
     * @param sNewName <needed><type>string</type>
     * <en>The new name for the column which should be renamed to.</en>
     * <de>Der neue Namen auf den die Spalte umbenannt werden soll.</de>
     *
     * @param sEngine <type>string</type>
     * <en>The database engine to be used. For example, mysql, mssql or all.</en>
     * <de>Die Datenbank-Engine die verwendet werden soll. Zum Beispiel mysql, mssql or all.</de>
     */
	public function changeDatabaseTableName($_sOldName, $_sNewName = NULL, $_sEngine = NULL)
	{
        $this->mps(array('oParameters' => $_sOldName));
		$_sNewName = $this->mp(array('sName' => 'sNewName', 'xParameter' => $_sNewName));
		$_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
		$_sOldName = $this->mp(array('sName' => 'sOldName', 'xParameter' => $_sOldName));
		if ($this->oDatabase != NULL) {return $this->oDatabase->changeTableName(array('sOldName' => $_sOldName, 'sNewName' => $_sNewName, 'sEngine' => $_sEngine));}
		return NULL;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>...</en>
     *
     * @return oResult <type>[object]</type>
     * <en>...</en>
     *
     * @param xFileID <type>mixed</type>
     * <en>...</en>
     *
     * @param asMetadata <type>mixed[]</type>
     * <en>...</en>
     *
     * @param xWhere <type>mixed</type>
     * <en>...</en>
     *
     * @param sOrderBy <type>string</type>
     * <en>...</en>
     *
     * @param bOrderReverse <type>bool</type>
     * <en>...</en>
     *
     * @param iStart <type>int</type>
     * <en>...</en>
     *
     * @param iCount <type>int</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function selectDatabaseFiles($_xFileID = NULL, $_asMetadata = NULL, $_xWhere = NULL, $_sEngine = NULL)
    {
        $this->mps(array('oParameters' => $_xFileID));
        $_xWhere = $this->mp(array('sName' => 'xWhere', 'xParameter' => $_xWhere));
        $_sEngine = $this->mp(array('sName' => 'sEngine', 'xParameter' => $_sEngine));
        $_asMetadata = $this->mp(array('sName' => 'asMetadata', 'xParameter' => $_asMetadata));
        $_xFileID = $this->mp(array('sName' => 'xFileID', 'xParameter' => $_xFileID));
        if ($this->oDatabase != NULL) {return $this->oDatabase->selectFiles(array('xFileID' => $_xFileID, 'asMetadata' => $_asMetadata, 'xWhere' => $_xWhere, 'sEngine' => $_sEngine));}
        return NULL;
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>...</en>
     *
     * @return sBytes <type>string</type>
     * <en>...</en>
     *
     * @param xFile <needed><type>mixed</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function getDatabaseFileBytes($_xFile)
    {
        $this->mps(array('oParameters' => $_xFile));
        $_xFile = $this->mp(array('sName' => 'xFile', 'xParameter' => $_xFile));
        if ($this->oDatabase != NULL) {return $this->oDatabase->getFileBytes(array('xFile' => $_xFile));}
        return NULL;
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>...</en>
     *
     * @return bSuccess <type>bool</type>
     * <en>...</en>
     *
     * @param sFile <needed><type>string</type>
     * <en>...</en>
     *
     * @param axMetadata <type>mixed[]</type>
     * <en>...</en>
     *
     * @param bAllowAnonymInsert <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function insertDatabaseFile($_sFile, $_axMetadata = NULL, $_bAllowAnonymInsert = NULL, $_sEngine = NULL)
    {
        $this->mps(array('oParameters' => $_sFile));
        $_axMetadata = $this->mp(array('sName' => 'axMetadata', 'xParameter' => $_axMetadata));
        $_bAllowAnonymInsert = $this->mp(array('sName' => 'bAllowAnonymInsert', 'xParameter' => $_bAllowAnonymInsert));
        $_sFile = $this->mp(array('sName' => 'sFile', 'xParameter' => $_sFile));
        if ($this->oDatabase != NULL) {return $this->oDatabase->insertFile(array('sFile' => $_sFile, 'axMetadata' => $_axMetadata, 'bAllowAnonymInsert' => $_bAllowAnonymInsert, 'sEngine' => $_sEngine));}
        return NULL;
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>...</en>
     *
     * @return bSuccess <type>bool</type>
     * <en>...</en>
     *
     * @param xFileID <type>mixed</type>
     * <en>...</en>
     *
     * @param axMetadata <type>mixed[]</type>
     * <en>...</en>
     *
     * @param sBytes <type>string</type>
     * <en>...</en>
     *
     * @param bAllowAnonymUpdate <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function updateDatabaseFile($_xFileID, $_axMetadata = NULL, $_bAllowAnonymUpdate = NULL, $_sEngine = NULL)
    {
        $this->mps(array('oParameters' => $_xFileID));
        $_axMetadata = $this->mp(array('sName' => 'axMetadata', 'xParameter' => $_axMetadata));
        $_bAllowAnonymUpdate = $this->mp(array('sName' => 'bAllowAnonymUpdate', 'xParameter' => $_bAllowAnonymUpdate));
        $_xFileID = $this->mp(array('sName' => 'xFileID', 'xParameter' => $_xFileID));
        if ($this->oDatabase != NULL) {return $this->oDatabase->updateFile(array('xFileID' => $_xFileID, 'axMetadata' => $_axMetadata, 'bAllowAnonymUpdate' => $_bAllowAnonymUpdate, 'sEngine' => $_sEngine));}
        return NULL;
    }
    /* @end method */

    /**
     * @start method
     *
     * @group Database
     *
     * @description
     * <en>...</en>
     *
     * @return bSuccess <type>bool</type>
     * <en>...</en>
     *
     * @param xFileID <needed><type>mixed</type>
     * <en>...</en>
     *
     * @param bAllowAnonymDelete <type>bool</type>
     * <en>...</en>
     *
     * @param sEngine <type>string</type>
     * <en>...</en>
     */
    public function deleteDatabaseFile($_xFileID, $_bAllowAnonymDelete = NULL, $_sEngine = NULL)
    {
        $this->mps(array('oParameters' => $_xFileID));
        $_bAllowAnonymDelete = $this->mp(array('sName' => 'bAllowAnonymDelete', 'xParameter' => $_bAllowAnonymDelete));
        $_xFileID = $this->mp(array('sName' => 'xFileID', 'xParameter' => $_xFileID));
        if ($this->oDatabase != NULL) {return $this->oDatabase->deleteFile(array('xFileID' => $_xFileID, 'bAllowAnonymDelete' => $_bAllowAnonymDelete, 'sEngine' => $_sEngine));}
        return NULL;
    }
    /* @end method */

    // Url...
    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Sets a target (window or frame) for a URL of the object / the class.</en>
     * <de>Setzt ein Ziel (Fenster oder Frame) für eine URL des Objekts / der Klasse.</de>
     *
     * @param sTarget <needed><type>string</type>
     * <en>The target in which something is to be loaded.</en>
     * <de>Das Ziel, in dem etwas geladen werden soll.</de>
     */
	public function setUrlTarget($_sTarget)
	{
        $this->mps(array('oParameters' => $_sTarget));
		$_sTarget = $this->mp(array('sName' => 'sTarget', 'xParameter' => $_sTarget));
		$this->sUrlTarget = $_sTarget;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Returns the target (window or frame) of a URL.</en>
     * <de>Gibt das Ziel (Fenster oder Frame) für eine URL zurück.</de>
     *
     * @return sUrlTarget <type>string</type>
     * <en>Returns the target (window or frame) of a URL as a string.</en>
     * <de>Gibt das Ziel (Fenster oder Frame) für eine URL als String zurück.</de>
     */
	public function getUrlTarget() {return $this->sUrlTarget;}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Initializes the URL and try to get the PHP_SELF variable. If that does not work, the file "index.php" is used.</en>
     * <de>Initialisiert die URL und versucht die PHP_SELF Variable abzugreifen. Falls das nicht klappt wird die Datei "index.php" verwendet.</de>
     */
	public function initUrl()
	{
		if (isset($_SERVER['PHP_SELF'])) {$this->sUrl = trim($_SERVER['PHP_SELF']);}
		if (($this->sUrl == '') || ($this->sUrl == NULL)) {$this->sUrl = 'index.php';}
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Sets a URL for an object / the class.</en>
     * <de>Setzt eine URL für ein Objekt / die Klasse.</de>
     *
     * @param sUrl <needed><type>string</type>
     * <en>The URL to be loaded.</en>
     * <de>Die URL die geladen werden soll.</de>
     */
	public function setUrl($_sUrl)
	{
        $this->mps(array('oParameters' => $_sUrl));
		$_sUrl = $this->mp(array('sName' => 'sUrl', 'xParameter' => $_sUrl));
		$this->sUrl = $_sUrl;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Returns the URL to be loaded.</en>
     * <de>Gibt die URL zurück, die geladen werden soll.</de>
     *
     * @return sUrl <type>string</type>
     * <en>Returns the URL to be loaded as a string.</en>
     * <de>Gibt die URL als string zurück, die geladen werden soll.</de>
     */
	public function getUrl() {return $this->sUrl;}
    /* @end method */

    // Parameters...
    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Sets URL parameters to be sent on load.</en>
     * <de>Setzt URL Parameter, die beim laden mit geschickt werden.</de>
     *
     * @param axParameters <needed><type>mixed[]</type>
     * <en>The parameter names and values as an associative array.</en>
     * <de>Die Parameternamen und Werte als assoziatives Array.</de>
     */
	public function setUrlParameters($_axParameters)
	{
        $this->mps(array('oParameters' => $_axParameters));
		$_axParameters = $this->mp(array('sName' => 'axParameters', 'xParameter' => $_axParameters, 'bNotNull' => true));
		$this->axUrlParameters = $_axParameters;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Adds URL parameters to be sent on load.</en>
     * <de>Fügt URL Parameter hinzu, die beim laden mit geschickt werden.</de>
     *
     * @param axParameters <needed><type>mixed[]</type>
     * <en>The parameter names and values as an associative array.</en>
     * <de>Die Parameternamen und Werte als assoziatives Array.</de>
     */
	public function addUrlParameters($_axParameters)
	{
        $this->mps(array('oParameters' => $_axParameters));
		$_axParameters = $this->mp(array('sName' => 'axParameters', 'xParameter' => $_axParameters, 'bNotNull' => true));
		$this->axUrlParameters = array_merge($this->axUrlParameters, $_axParameters);
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Adds an URL parameter to be sent on load.</en>
     * <de>Fügt einen URL Parameter hinzu, der beim laden mit geschickt werden soll.</de>
     *
     * @param sName <needed><type>string</type>
     * <en>The name of the parameter.</en>
     * <de>Der Name des Parameters.</de>
     *
     * @param xValue <needed><type>mixed</type>
     * <en>The value of the parameter.</en>
     * <de>Der Wert des Parameters.</de>
     */
	public function addUrlParameter($_sName, $_xValue = NULL)
	{
        $this->mps(array('oParameters' => $_sName));
		$_xValue = $this->mp(array('sName' => 'xValue', 'xParameter' => $_xValue));
		$_sName = $this->mp(array('sName' => 'sName', 'xParameter' => $_sName));
		$this->axUrlParameters[$_sName] = urlencode($_xValue);
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Returns the URL parameters.</en>
     * <de>Gibt die URL Parameter zurück.</de>
     *
     * @return axParameters <type>mixed[]</type>
     * <en>Returns the URL parameter as an associative array.</en>
     * <de>Gibt die URL Parameter als assoziatives Array zurück.</de>
     */
    public function getUrlParameters() {return $this->axUrlParameters;}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Returns the URL parameters as a string for the transfer on a form.</en>
     * <de>Gibt die URL Parameter f�r die �bergabe in einem Formular als String zur�ck.</de>
     *
     * @return sHtml <type>string</type>
     * <en>Returns the URL parameters as a string for the transfer on a form.</en>
     * <de>Gibt die URL Parameter f�r die �bergabe in einem Formular als String zur�ck.</de>
     *
     * @param bUseLineBreak <type>bool</type>
     * <en>Specifies whether line breaks are used.</en>
     * <de>Gibt an ob Zeilenumbr�che verwendet werden sollen.</de>
     */
	public function getUrlParametersForm($_bUseLineBreak = NULL)
	{
        $this->mps(array('oParameters' => $_bUseLineBreak));
		$_bUseLineBreak = $this->mp(array('sName' => 'bUseLineBreak', 'xParameter' => $_bUseLineBreak));
		
		if ($_bUseLineBreak === NULL) {$_bUseLineBreak = $this->bUseLineBreak;}

		$_sHTML = '';
		foreach($this->axUrlParameters as $_sName => $_xValue)
		{
			$_sHTML .= '<input type="hidden" name="'.$_sName.'" value="'.htmlspecialchars($_xValue).'" />';
			if ($_bUseLineBreak == true) {$_sHTML .= $this->sLineBreak;}
		}
		return $_sHTML;
	}
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @description
     * <en>Returns the URL parameters as a string for the transfer on a link.</en>
     * <de>Gibt die URL Parameter für die übergabe in einem Link als String zurück.</de>
     *
     * @return sString <type>string</type>
     * <en>Returns the URL parameters as a string for the transfer on a link.</en>
     * <de>Gibt die URL Parameter für die übergabe in einem Link als String zurück.</de>
     */
	public function getUrlParametersString()
	{
		$i=0;
		$_sString = '';
		foreach($this->axUrlParameters as $_sName => $_xValue)
		{
			if ($i > 0) {$_sString .= '&';}
			$_sString .= $_sName.'='.$_xValue;
			$i++;
		}
		return $_sString;
	}
	/* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @param bUse <needed><type>bool</type>
     * <en>...</en>
     */
    public function useUrlRewrite($_bUse)
    {
        $this->mps(array('oParameters' => $_bUse));
        $_bUse = $this->mp(array('sName' => 'bUse', 'xParameter' => $_bUse));
        $this->bUrlRewrite = $_bUse;
    }
    /* @end method */

    /**
     * @start method
     *
     * @group URL
     *
     * @return bIsUrlRewrite <type>bool</type>
     * <en>...</en>
     */
    public function isUrlRewrite()
    {
        return $this->bUrlRewrite;
    }
    /* @end method */
}
/* @end class */
?>