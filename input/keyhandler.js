/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Oct 11 2012
*/
var PG_KEYCODE_BACKSPACE = 8;
var PG_KEYCODE_TABULATOR = 9;
var PG_KEYCODE_TAB = 9;
var PG_KEYCODE_ENTER = 13;
var PG_KEYCODE_RETURN = 13;
var PG_KEYCODE_SHIFT = 16;
var PG_KEYCODE_CTRL = 17;
var PG_KEYCODE_CONTROL = 17;
var PG_KEYCODE_ALT = 18;
var PG_KEYCODE_ALTERNATE = 18;
var PG_KEYCODE_ALTGR = 18;
var PG_KEYCODE_ALTERNATE_GRAPHICS = 18;
var PG_KEYCODE_OPTION = 18;
var PG_KEYCODE_PAUSE = 19;
var PG_KEYCODE_SHIFT_LOCK = 20;
var PG_KEYCODE_CAPS_LOCK = 20;
var PG_KEYCODE_ESCAPE = 27;
var PG_KEYCODE_ESC = 27;
var PG_KEYCODE_SPACE = 32;
var PG_KEYCODE_PAGE_UP = 33;
var PG_KEYCODE_PAGE_DOWN = 34;
var PG_KEYCODE_END = 35;
var PG_KEYCODE_POS_1 = 36;
var PG_KEYCODE_HOME = 36;
var PG_KEYCODE_CURSOR_LEFT = 37;
var PG_KEYCODE_CURSOR_UP = 38;
var PG_KEYCODE_CURSOR_RIGHT = 39;
var PG_KEYCODE_CURSOR_DOWN = 40;
var PG_KEYCODE_INSERT = 45;
var PG_KEYCODE_DELETE = 46;
var PG_KEYCODE_0 = 48;
var PG_KEYCODE_EQUALS = 48; // =
var PG_KEYCODE_1 = 49;
var PG_KEYCODE_EXCLAMATION = 49; // !
var PG_KEYCODE_EXCLAMATION_MARK = 49; // !
var PG_KEYCODE_2 = 50;
var PG_KEYCODE_QUOTES = 50; // "
var PG_KEYCODE_3 = 51;
var PG_KEYCODE_PARAGRAPH = 51; // �
var PG_KEYCODE_SECTION = 51; // �
var PG_KEYCODE_4 = 52;
var PG_KEYCODE_DOLLAR = 52; // $
var PG_KEYCODE_5 = 53;
var PG_KEYCODE_PERCENT = 53; // %
var PG_KEYCODE_6 = 54;
var PG_KEYCODE_AND = 54; // &
var PG_KEYCODE_7 = 55;
var PG_KEYCODE_SLASH = 55; // /
var PG_KEYCODE_8 = 56;
var PG_KEYCODE_BRACKET = 56; // (
var PG_KEYCODE_9 = 57;
var PG_KEYCODE_PARENTHESIS = 57; // )
var PG_KEYCODE_UE = 59;
var PG_KEYCODE_A = 65;
var PG_KEYCODE_B = 66;
var PG_KEYCODE_C = 67;
var PG_KEYCODE_D = 68;
var PG_KEYCODE_E = 69;
var PG_KEYCODE_F = 70;
var PG_KEYCODE_G = 71;
var PG_KEYCODE_H = 72;
var PG_KEYCODE_I = 73;
var PG_KEYCODE_J = 74;
var PG_KEYCODE_K = 75;
var PG_KEYCODE_L = 76;
var PG_KEYCODE_M = 77;
var PG_KEYCODE_N = 78;
var PG_KEYCODE_O = 79;
var PG_KEYCODE_P = 80;
var PG_KEYCODE_Q = 81;
var PG_KEYCODE_R = 82;
var PG_KEYCODE_S = 83;
var PG_KEYCODE_T = 84;
var PG_KEYCODE_U = 85;
var PG_KEYCODE_V = 86;
var PG_KEYCODE_W = 87;
var PG_KEYCODE_X = 88;
var PG_KEYCODE_Y = 89;
var PG_KEYCODE_Z = 90;
var PG_KEYCODE_WINDOWS = 91;
var PG_KEYCODE_COMMAND = 91;
var PG_KEYCODE_CONTEXT = 93;
var PG_KEYCODE_NUM_0 = 96;
var PG_KEYCODE_NUM_1 = 97;
var PG_KEYCODE_NUM_2 = 98;
var PG_KEYCODE_NUM_3 = 99;
var PG_KEYCODE_NUM_4 = 100;
var PG_KEYCODE_NUM_5 = 101;
var PG_KEYCODE_NUM_6 = 102;
var PG_KEYCODE_NUM_7 = 103;
var PG_KEYCODE_NUM_8 = 104;
var PG_KEYCODE_NUM_9 = 105;
var PG_KEYCODE_NUM_MULTIPLY = 106;
var PG_KEYCODE_NUM_PLUS = 107;
var PG_KEYCODE_PLUS = 107;
var PG_KEYCODE_MULTIPLY = 107;
var PG_KEYCODE_STAR = 107;
var PG_KEYCODE_NUM_MINUS = 109;
var PG_KEYCODE_MINUS = 109;
var PG_KEYCODE_UNDERLINE = 109;
var PG_KEYCODE_NUM_DELETE = 110;
var PG_KEYCODE_NUM_COMMA = 110;
var PG_KEYCODE_NUM_DIVIDE = 111;
var PG_KEYCODE_F1 = 112;
var PG_KEYCODE_F2 = 113;
var PG_KEYCODE_F3 = 114;
var PG_KEYCODE_F4 = 115;
var PG_KEYCODE_F5 = 116;
var PG_KEYCODE_F6 = 117;
var PG_KEYCODE_F7 = 118;
var PG_KEYCODE_F8 = 119;
var PG_KEYCODE_F9 = 120;
var PG_KEYCODE_F10 = 121;
var PG_KEYCODE_F11 = 122;
var PG_KEYCODE_F12 = 123;
var PG_KEYCODE_NUM_LOCK = 144;
var PG_KEYCODE_SCROLL_LOCK = 145;
var PG_KEYCODE_SEMICOLON = 188;
var PG_KEYCODE_COMMA = 188; // ,
var PG_KEYCODE_POINT = 190; // .
var PG_KEYCODE_COLON = 190; // :
var PG_KEYCODE_SHARP = 191; // #
// var PG_KEYCODE_ 191		# and '
var PG_KEYCODE_OE = 192;
var PG_KEYCODE_QUESTION_MARK = 219; // ?
// var PG_KEYCODE_ 219		� and  ?
var PG_KEYCODE_CIRCUMFLEX = 220;	// ^ and �
// var PG_KEYCODE_ 221		� and `
var PG_KEYCODE_AE = 222;
// var PG_KEYCODE_ 226		< and >

/*
Code	Key
191		# and '
219		� and  ?
220		^ and �
221		� and `
226		< and >
*/

/*
@start class

@var KeyHandlerKeyDefines
PG_KEYCODE_BACKSPACE
PG_KEYCODE_TABULATOR, PG_KEYCODE_TAB
PG_KEYCODE_ENTER, PG_KEYCODE_RETURN
PG_KEYCODE_SHIFT
PG_KEYCODE_CTRL, PG_KEYCODE_CONTROL
PG_KEYCODE_ALT, PG_KEYCODE_ALTERNATE, PG_KEYCODE_ALTGR, PG_KEYCODE_ALTERNATE_GRAPHICS, PG_KEYCODE_OPTION
PG_KEYCODE_PAUSE
PG_KEYCODE_SHIFT_LOCK, PG_KEYCODE_CAPS_LOCK
PG_KEYCODE_ESCAPE, PG_KEYCODE_ESC
PG_KEYCODE_SPACE
PG_KEYCODE_PAGE_UP
PG_KEYCODE_PAGE_DOWN
PG_KEYCODE_END 
PG_KEYCODE_POS_1
PG_KEYCODE_HOME
PG_KEYCODE_CURSOR_LEFT
PG_KEYCODE_CURSOR_UP
PG_KEYCODE_CURSOR_RIGHT
PG_KEYCODE_CURSOR_DOWN
PG_KEYCODE_INSERT
PG_KEYCODE_DELETE
PG_KEYCODE_0 ... PG_KEYCODE_9
PG_KEYCODE_EQUALS = "="
PG_KEYCODE_EXCLAMATION, PG_KEYCODE_EXCLAMATION_MARK = !
PG_KEYCODE_QUOTES = "
PG_KEYCODE_PARAGRAPH, PG_KEYCODE_SECTION = §
PG_KEYCODE_DOLLAR = $
PG_KEYCODE_PERCENT = %
PG_KEYCODE_AND = &
PG_KEYCODE_SLASH = /
PG_KEYCODE_BRACKET = (
PG_KEYCODE_PARENTHESIS = )
PG_KEYCODE_UE = Ü
PG_KEYCODE_A ... PG_KEYCODE_Z
PG_KEYCODE_WINDOWS, PG_KEYCODE_COMMAND, PG_KEYCODE_CONTEXT
PG_KEYCODE_NUM_0 ... PG_KEYCODE_NUM_9
PG_KEYCODE_NUM_MULTIPLY
PG_KEYCODE_NUM_PLUS
PG_KEYCODE_PLUS
PG_KEYCODE_MULTIPLY
PG_KEYCODE_STAR
PG_KEYCODE_NUM_MINUS
PG_KEYCODE_MINUS
PG_KEYCODE_UNDERLINE
PG_KEYCODE_NUM_DELETE
PG_KEYCODE_NUM_COMMA
PG_KEYCODE_NUM_DIVIDE
PG_KEYCODE_F1 ... PG_KEYCODE_F12
PG_KEYCODE_NUM_LOCK
PG_KEYCODE_SCROLL_LOCK
PG_KEYCODE_SEMICOLON = ;
PG_KEYCODE_COMMA = ,
PG_KEYCODE_POINT = .
PG_KEYCODE_COLON = :
PG_KEYCODE_SHARP = #
PG_KEYCODE_OE = Ö
PG_KEYCODE_QUESTION_MARK = ?
PG_KEYCODE_CIRCUMFLEX = ^ and �
PG_KEYCODE_AE = Ä

@description
[en]
	This class contains methods to bind keys on the keyboard to functions.
	The following defines can be used as keys:
	%KeyHandlerKeyDefines%
[/en]
[de]
	Diese Klasse enthält Methoden zum Binden von Tasten der Tastatur an Funktionen.
	Folgende Defines können als Tasten verwendet werden:
	%KeyHandlerKeyDefines%
[/de]

@param extends classPG_ClassBasics
*/
function classPG_KeyHandler()
{
	// Declarations...
	this.aiKeyCodeDown = new Array();
	this.aiKeyCode = new Array();
	this.abKeyBindEnabled = new Array();
	this.asKeyFunction = new Array();
	this.bIgnore = false;
	
	// Construct...
	
	// Methods...
	/*
	@start method
	
	@description
	[en]Determines whether keyboard input should be ignored.[/en]
	[de]Legt fest ob Tastatureingaben ignoriert werden sollen.[/de]
	
	@param bIgnore [needed][type]bool[/type]
	[en]Specifies whether to ignore keyboard input.[/en]
	[de]Gibt an ob Tastatureingaben ignoriert werden sollen.[/de]
	*/
	this.ignoreMode = function(_bIgnore)
	{
		_bIgnore = this.getRealParameter({'oParameters': _bIgnore, 'sName': 'bIgnore', 'xParameter': _bIgnore});
		this.bIgnore = _bIgnore;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Overrides the default function of the browser of a key or key combination.[/en]
	[de]Überschreibt die Standardfunktion des Browsers einer Taste oder Tastenkombination.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Event-Objekt des Browsers.[/de]
	*/
	this.overwriteDefault = function(_oEvent)
	{
		_oEvent = (_oEvent)? _oEvent : event;
		if (_oEvent.preventDefault)
		{
			_oEvent.preventDefault();
			_oEvent.stopPropagation();
		}
		else
		{
			_oEvent.returnValue = false;
			_oEvent.cancelBubble = true;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Frees the saved state of the keys already pressed.[/en]
	[de]Gibt den gespeicherten Zustand der bereits gedrückten Tasten wieder frei.[/de]
	*/
	this.releaseAllKeysDown = function()
	{
		this.aiKeyCodeDown = new Array();
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Frees the saved state of a key.[/en]
	[de]Gibt den gespeicherten Zustand einer Taste wieder frei.[/de]
	
	@param xKey [needed][type]mixed[/type]
	[en]The key whose status is to be freed.[/en]
	[de]Die Taste, dessen Zustand wieder freigegeben werden soll.[/de]
	*/
	this.releaseKeyDown = function(_xKey)
	{
		_xKey = this.getRealParameter({'oParameters': _xKey, 'sName': 'xKey', 'xParameter': _xKey});
		var _iKeyCode = this.getKeyCode({'xKey': _xKey});
		for (i=0; i<this.aiKeyCodeDown.length; i++)
		{
			if (this.aiKeyCodeDown[i] == _iKeyCode) {this.aiKeyCodeDown[i] = null;}
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets the pressed state of a key.[/en]
	[de]Setzt den gedrückt Status für eine Taste.[/de]
	
	@param xKey [needed][type]mixed[/type]
	[en]The key whose status is to be stored as a key.[/en]
	[de]Die Taste, dessen Zustand als gedrückt gespeichert werden soll.[/de]
	*/
	this.setKeyCodeDown = function(_xKey)
	{
		_xKey = this.getRealParameter({'oParameters': _xKey, 'sName': 'xKey', 'xParameter': _xKey});
		var _iKeyCode = this.getKeyCode({'xKey': _xKey});
		this.aiKeyCodeDown.push(_iKeyCode);
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns whether the pressed status of a key was saved.[/en]
	[de]Gibt zurück, ob für eine Taste der gedrückt Status gespeichert wurde.[/de]
	
	@return bIsDown [type]bool[/type]
	[en]Returns a boolean if the key is pressed.[/en]
	[de]Gibt ein Boolean zurück, ob die Taste gedrückt ist.[/de]
	
	@param xKey [needed][type]mixed[/type]
	[en]The key whose status is to be tested.[/en]
	[de]Die Taste, dessen Zustand geprüft werden soll.[/de]
	*/
	this.isKeyCodeDown = function(_xKey)
	{
		_xKey = this.getRealParameter({'oParameters': _xKey, 'sName': 'xKey', 'xParameter': _xKey});
		var _iKeyCode = this.getKeyCode({'xKey': _xKey});
		var i=0;
		for (i=0; i<this.aiKeyCodeDown.length; i++)
		{
			if (this.aiKeyCodeDown[i] == _iKeyCode) {return true;}
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Binds a function to a key or a key combination.[/en]
	[de]Bindet eine Funktion an eine Taste oder eine Tastenkombination.[/de]
	
	@return iKeyCodeIndex [type]int[/type]
	[en]Returns the memory index of the binding.[/en]
	[de]Gibt den Speicherindex der Bindung zurück.[/de]
	
	@param xKey1 [needed][type]mixed[/type]
	[en]The first key that is to be bound.[/en]
	[de]Die erste Taste, die gebunden werden soll.[/de]
	
	@param xKey2 [type]mixed[/type]
	[en]The second key that is to be bound.[/en]
	[de]Die zweite Taste, die gebunden werden soll.[/de]
	
	@param xKey3 [type]mixed[/type]
	[en]The third key that is to be bound.[/en]
	[de]Die dritte Taste, die gebunden werden soll.[/de]
	
	@param xFunction [needed][type]mixed[/type]
	[en]The function that will be executed when pressing the key or key combination.[/en]
	[de]Die Funktion, die beim drücken der Taste oder Tastenkombination ausgeführt werden soll.[/de]
	*/
	this.bindKeys = function(_xKey1, _xKey2, _xKey3, _xFunction)
	{
		if (typeof(_xKey1) == 'undefined') {var _xKey1 = null;}
		if (typeof(_xKey2) == 'undefined') {var _xKey2 = null;}
		if (typeof(_xKey3) == 'undefined') {var _xKey3 = null;}
		if (typeof(_xFunction) == 'undefined') {var _xFunction = null;}
		
		_xKey2 = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xKey2', 'xParameter': _xKey2});
		_xKey3 = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xKey3', 'xParameter': _xKey3});
		_xFunction = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xFunction', 'xParameter': _xFunction});
		_xKey1 = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xKey1', 'xParameter': _xKey1});

		var _iKeyCode1 = -1;
		var _iKeyCode2 = -1;
		var _iKeyCode3 = -1;
		
		if (_xKey1 != null) {_iKeyCode1 = this.getKeyCode(_xKey1);}
		if (_xKey2 != null) {_iKeyCode2 = this.getKeyCode(_xKey2);}
		if (_xKey3 != null) {_iKeyCode3 = this.getKeyCode(_xKey3);}
		
		if ((_iKeyCode1 > -1) && (_xFunction != null))
		{
			this.asKeyFunction.push(_xFunction);
			this.abKeyBindEnabled.push(true);
			this.aiKeyCode.push(new Array(_iKeyCode1, _iKeyCode2, _iKeyCode3));
			return this.aiKeyCode.length-1;
		}
		return false;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Suppresses the standard function of a key or key combination of the browser.[/en]
	[de]Unterdrückt die Standardfunktion einer Taste oder Tastenkombination des Browsers.[/de]
	
	@return iKeyCodeIndex [type]int[/type]
	[en]Returns the memory index of the binding.[/en]
	[de]Gibt den Speicherindex der Bindung zurück.[/de]
	
	@param xKey1 [needed][type]mixed[/type]
	[en]The first key that is to be bound.[/en]
	[de]Die erste Taste, die gebunden werden soll.[/de]
	
	@param xKey2 [type]mixed[/type]
	[en]The second key that is to be bound.[/en]
	[de]Die zweite Taste, die gebunden werden soll.[/de]
	
	@param xKey3 [type]mixed[/type]
	[en]The third key that is to be bound.[/en]
	[de]Die dritte Taste, die gebunden werden soll.[/de]
	*/
	this.disableDefault = function(_xKey1, _xKey2, _xKey3)
	{
		if (typeof(_xKey1) == 'undefined') {var _xKey1 = null;}
		if (typeof(_xKey2) == 'undefined') {var _xKey2 = null;}
		if (typeof(_xKey3) == 'undefined') {var _xKey3 = null;}

		_xKey2 = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xKey2', 'xParameter': _xKey2});
		_xKey3 = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xKey3', 'xParameter': _xKey3});
		_xKey1 = this.getRealParameter({'oParameters': _xKey1, 'sName': 'xKey1', 'xParameter': _xKey1});

		var _iKeyCode1 = -1;
		var _iKeyCode2 = -1;
		var _iKeyCode3 = -1;
		
		if (_xKey1 != null) {_iKeyCode1 = this.getKeyCode(_xKey1);}
		if (_xKey2 != null) {_iKeyCode2 = this.getKeyCode(_xKey2);}
		if (_xKey3 != null) {_iKeyCode3 = this.getKeyCode(_xKey3);}
		
		if (_iKeyCode1 > -1)
		{
			this.asKeyFunction.push(null);
			this.abKeyBindEnabled.push(true);
			this.aiKeyCode.push(new Array(_iKeyCode1, _iKeyCode2, _iKeyCode3));
			return this.aiKeyCode.length-1;
		}
		return false;
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Enables a binding.[/en]
	[de]Aktiviert eine Bindung.[/de]
	
	@param iBindIndex [needed][type]int[/type]
	[en]The memory index of the binding.[/en]
	[de]Der Speicherindex der Bindung.[/de]
	*/
	this.enableBinding = function(_iBindIndex)
	{
		_iBindIndex = this.getRealParameter({'oParameters': _iBindIndex, 'sName': 'iBindIndex', 'xParameter': _iBindIndex});
		this.useBinding({'iBindIndex': _iBindIndex, 'bUse': true});
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Disables a binding.[/en]
	[de]Deaktiviert eine Bindung.[/de]
	
	@param iBindIndex [needed][type]int[/type]
	[en]The memory index of the binding.[/en]
	[de]Der Speicherindex der Bindung.[/de]
	*/
	this.disableBinding = function(_iBindIndex)
	{
		_iBindIndex = this.getRealParameter({'oParameters': _iBindIndex, 'sName': 'iBindIndex', 'xParameter': _iBindIndex});
		this.useBinding({'iBindIndex': _iBindIndex, 'bUse': false});
	}
	/* @end method */

	/*
	@start method
	
	@description
	[en]Sets the activation state of a binding.[/en]
	[de]Setzt den Aktivierungszustand einer Bindung.[/de]
	
	@param iBindIndex [needed][type]int[/type]
	[en]The memory index of the binding.[/en]
	[de]Der Speicherindex der Bindung.[/de]
	
	@param bUse [needed][type]bool[/type]
	[en]Specifies whether the binding should be enabled (true) or disabled (false).[/en]
	[de]Gibt an ob die Bindung aktiv (true) gesetzt oder deaktiviert (false) werden soll.[/de]
	*/
	this.useBinding = function(_iBindIndex, _bUse)
	{
		if (typeof(_bUse) == 'undefined') {var _bUse = null;}
		
		_bUse = this.getRealParameter({'oParameters': _iBindIndex, 'sName': 'bUse', 'xParameter': _bUse});
		_iBindIndex = this.getRealParameter({'oParameters': _iBindIndex, 'sName': 'iBindIndex', 'xParameter': _iBindIndex});
		
		if ((_iBindIndex >= 0) && (_iBindIndex < this.abKeyBindEnabled.length))
		{
			this.abKeyBindEnabled[_iBindIndex] = _bUse;
		}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the name of a key.[/en]
	[de]Gibt den Namen einer Taste zurück.[/de]
	
	@return sKeyName [type]string[/type]
	[en]Returns the name of a key as a string.[/en]
	[de]Gibt den Namen einer Taste als String zurück.[/de]
	
	@param xKey [needed][type]mixed[/type]
	[en]The key whose name should be returned.[/en]
	[de]Die Taste, deren Namen zurück gegeben werden soll.[/de]
	*/
	this.getKeyName = function(_xKey)
	{
		_xKey = this.getRealParameter({'oParameters': _xKey, 'sName': 'xKey', 'xParameter': _xKey, 'bNotNull': true});
		switch (typeof(_xKey))
		{
			case 'number':	// _xKey is _iKeyCode
				return String.fromCharCode(_xKey).toLowerCase();
			break;

			case 'string':	// _xKey is _sKeyName
				return _xKey;
			break;
		}
		return '';
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns the key code of a key.[/en]
	[de]Gibt den Tastaturcode einer Taste zurück.[/de]
	
	@return iKeyCode [type]int[/type]
	[en]Returns the key code of a key as a integer.[/en]
	[de]Gibt den Tastaturcode einer Taste als Integer zurück.[/de]
	
	@param xKey [needed][type]mixed[/type]
	[en]The key whose key code should be returned.[/en]
	[de]Die Taste, deren Tastaturcode zurück gegeben werden soll.[/de]
	*/
	this.getKeyCode = function(_xKey)
	{
		_xKey = this.getRealParameter({'oParameters': _xKey, 'sName': 'xKey', 'xParameter': _xKey, 'bNotNull': true});
		switch (typeof(_xKey))
		{
			case 'number':	// _xKey is _iKeyCode
				return _xKey;
			break;

			case 'string':	// _xKey is _sKeyName
//				return _xKey;
			break;
		}
		return -1;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Checks whether keys have been released.[/en]
	[de]Prüft ob Tasten wieder losgelassen wurden.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Even-Objekt des Browsers.[/de]
	*/
	this.onKeyUp = function(_oEvent)
	{
		_oEvent = (_oEvent)? _oEvent : event;
		var _iKeyCode = (_oEvent.wich)? _oEvent.which : _oEvent.keyCode;
		if (_iKeyCode) {this.releaseKeyDown({'xKey': _iKeyCode});}
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Executes the functions of the bindings if the corresponding key or key combination is pressed.[/en]
	[de]Führt die Funktionen der Bindungen aus, wenn die entsprechende Tast oder Tastenkombination gedrückt wird.[/de]
	
	@return bPreventedDefault [type]bool[/type]
	[en]Returns a Boolean whether the browser should prevent the default function of the keys.[/en]
	[de]Gibt ein Boolean zurück ob der Browser die Standardfunktion der Tasten unterbinden soll.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Even-Objekt des Browsers.[/de]
	*/
	this.onKeyDown = function(_oEvent)
	{
		if (this.bIgnore == true) {return true;}
		var _bPreventDefault = false;
		_oEvent = (_oEvent)? _oEvent : event;
		var _iKeyCode = (_oEvent.wich)? _oEvent.which : _oEvent.keyCode;

		if (_iKeyCode)
		{
			var i=0;
			var _bKeyCodeOK1 = false;
			var _bKeyCodeOK2 = false;
			var _bKeyCodeOK3 = false;
			for (i=0; i<this.aiKeyCode.length; i++)
			{
				_bKeyCodeOK1 = false;
				_bKeyCodeOK2 = false;
				_bKeyCodeOK3 = false;
				if (this.abKeyBindEnabled[i] == true)
				{
					if ((this.aiKeyCode[i][0] == _iKeyCode) || (this.aiKeyCode[i][0] == -1) || (this.isKeyCodeDown({'xKey': this.aiKeyCode[i][0]})))
					{
						this.setKeyCodeDown({'xKey': _iKeyCode});
						_bKeyCodeOK1 = true;
					}
					if ((this.aiKeyCode[i][1] == _iKeyCode) || (this.aiKeyCode[i][1] == -1) || (this.isKeyCodeDown({'xKey': this.aiKeyCode[i][1]})))
					{
						this.setKeyCodeDown({'xKey': _iKeyCode});
						_bKeyCodeOK2 = true;
					}
					if ((this.aiKeyCode[i][2] == _iKeyCode) || (this.aiKeyCode[i][2] == -1) || (this.isKeyCodeDown({'xKey': this.aiKeyCode[i][2]})))
					{
						this.setKeyCodeDown({'xKey': _iKeyCode});
						_bKeyCodeOK3 = true;
					}
	
					if ((_bKeyCodeOK1 == true) && (_bKeyCodeOK2 == true) && (_bKeyCodeOK3 == true))
					{
						if (this.asKeyFunction[i] != null)
						{
							_bPreventDefault = true;
							if (typeof(this.asKeyFunction[i]) == 'string')
							{
								if (this.asKeyFunction[i] != '') {eval(this.asKeyFunction[i]);}
							}
							else if (typeof(this.asKeyFunction[i]) == 'function')
							{
								this.asKeyFunction[i]();
							}
						}
					}
				}
			}
		}
		if (_bPreventDefault == true) {this.overwriteDefault(_oEvent); return false;}
		return true;
	}
	/* @end method */
	this.execBinding = this.onKeyDown;
	
	/*
	@start method
	
	@description
	[en]This method emits the keyboard code for testing purposes.[/en]
	[de]Diese Methode gibt zu Testzwecken den Tastaturcode aus.[/de]
	
	@return bFalse [type]bool[/type]
	[en]Returns false to suppress the default function of the key of the browser.[/en]
	[de]Gibt false zurück um die Standardfunktion der Taste vom Browser zu unterdrücken.[/de]
	
	@param oEvent [needed][type]object[/type]
	[en]The event object of the browser.[/en]
	[de]Das Even-Objekt des Browsers.[/de]
	
	@param sContainerID [type]string[/type]
	[en]The ID of a container element in which the key code to be emitted.[/en]
	[de]Die ID eines Container-Elements in dem der Keycode ausgegeben werden soll.[/de]
	*/
	this.testInputKeyCode = function(_oEvent, _sContainerID)
	{
		if (typeof(_sContainerID) == 'undefined') {var _sContainerID = null;}
	
		if (this.bIgnore == true) {return true;}
		_oEvent = (_oEvent)? _oEvent : event;
		var _iKeyCode = (_oEvent.wich)? _oEvent.which : _oEvent.keyCode;
		
		var _oContainer = null;
		if (_sContainerID != null) {_oContainer = this.oDocument.getElementById(_sContainerID);}
		if (_oContainer != null) {_oContainer.innerHTML = _iKeyCode.toString();}
		else {alert("keycode: "+_iKeyCode.toString());}
		
		this.overwriteDefault(_oEvent);
		return false;
	}
	/* @end method */
}
/* @end class */
classPG_KeyHandler.prototype = new classPG_ClassBasics();
var oPGKeyHandler = new classPG_KeyHandler();
if (typeof(oPGEventManager) != 'undefined')
{
	oPGEventManager.addEvent({'oObject': document, 'sEventType': PG_EVENTTYPE_ONKEYDOWN, 'fFunction': function(_oEvent) {oPGKeyHandler.onKeyDown(_oEvent);}, 'bUseCapture': false});
	oPGEventManager.addEvent({'oObject': document, 'sEventType': PG_EVENTTYPE_ONKEYUP, 'fFunction': function(_oEvent) {oPGKeyHandler.onKeyUp(_oEvent);}, 'bUseCapture': false});
}
