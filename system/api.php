<?php
/*
* ProGade API
* Copyright 2012, Hans-Peter Wandura (ProGade)
* Last changes of this file: Aug 13 2012
*/
/*
@start class
@param extends classPG_ClassBasics
*/
class classPG_Api extends classPG_ClassBasics
{
	private $axContext = NULL;
	private $axRegister = array();
	
	/*
	@start method
	
	@description
	[en]Sets, or registers an API variable.[/en]
	[de]Setzt bzw. registriert eine API-Variable.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the variable.[/en]
	[de]Der Name der Variablen.[/de]
	
	@param xValue [needed][type]mixed[/type]
	[en]The Value of the variable.[/en]
	[de]Der Wert der Variablen.[/de]
	*/
	public function set($_sName, $_xValue = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->register(array('sName' => $_sName, 'xValue' => $_xValue));
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Sets, or registers an API variable.[/en]
	[de]Setzt bzw. registriert eine API-Variable.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the variable.[/en]
	[de]Der Name der Variablen.[/de]
	
	@param xValue [needed][type]mixed[/type]
	[en]The Value of the variable.[/en]
	[de]Der Wert der Variablen.[/de]
	*/
	public function register($_sName, $_xValue = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		$this->axRegister[$_sName] = $_xValue;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@description
	[en]Performs a query that selects objects, elements, or  variables and stores the result in a internally context for further processing.[/en]
	[de]Führt eine Abfrage aus, selektiert Objekte, Elemente oder Variablen und speichert das Ergebnis in einem intern Kontext zur Weiterverarbeitung.[/de]
	
	@return xMixed [type]mixed[/type]
	[en]Returns the API object or the desired query result.[/en]
	[de]Gibt das API-Objekt oder das erwünschte Anfrage-Ergebnis zur�ck.[/de]
	
	@param xStatement [needed][type]mixed[/type]
	[en]The statement, to be executed as a query.[/en]
	[de]Das Statement, das als Abfrage ausgeführt werden soll.[/de]
	*/
	public function select($_xStatement)
	{
		$_xStatement = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'xStatement', 'xParameter' => $_xStatement, 'bNotNull' => true));
		return $this->query(array('xStatement' => $_xStatement));
	}
	/* @end method */

	/*
	@start method
	
	@group Context
	
	@description
	[en]Performs a query that selects objects, elements, or  variables and stores the result in a internally context for further processing.[/en]
	[de]Führt eine Abfrage aus, selektiert Objekte, Elemente oder Variablen und speichert das Ergebnis in einem intern Kontext zur Weiterverarbeitung.[/de]
	
	@return xMixed [type]mixed[/type]
	[en]Returns the API object or the desired query result.[/en]
	[de]Gibt das API-Objekt oder das erwünschte Anfrage-Ergebnis zurück.[/de]
	
	@param xStatement [needed][type]mixed[/type]
	[en]The statement, to be executed as a query.[/en]
	[de]Das Statement, das als Abfrage ausgeführt werden soll.[/de]
	*/
	public function query($_xStatement)
	{
		$_xStatement = $this->getRealParameter(array('oParameters' => $_xStatement, 'sName' => 'xStatement', 'xParameter' => $_xStatement, 'bNotNull' => true));

		$this->axContext = NULL;
		if (!$_xStatement) {return $this;}
		
		if (is_object($_xStatement)) {$this->axContext = array($_xStatement);}
		else if (is_array($_xStatement)) {$this->axContext = array($_xStatement);}
		// else if (function_exists($_xStatement)) {$this->axContext = array($_xStatement);}
		else if (is_string($_xStatement))
		{
			if (isset($this->axRegister[$_xStatement])) {$this->axContext = array($this->axRegister[$_xStatement]);}
			// else if (($_xStatement[0] === '<') && ($_xSelector[strlen($_xStatement)-1] === '>') && (strlen($_xStatement) >= 3))
			// {
				// $this->axContext = array($this.oDocument.createElement(_xSelector.replace(/^</, '').replace(/>$/, '')));
			// }
			// else if ($_xStatement[0] === '$') {$this.axContext = this.oDocument.getElementsByName($_xStatement.replace(/^\$/, ''));}
			// else if ($_xStatement[0] === '#') {$this.axContext = new Array(this.oDocument.getElementById($_xStatement.replace(/^#/, '')));}
			// else {$this.axContext = this.oDocument.getElementsByTagName($_xStatement);}
		}
		return $this;
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Returns a previously registered / set variable.[/en]
	[de]Gibt eine zuvor registrierte / gesetzte Variable zurück.[/de]
	
	@return xValue [type]mixed[/type]
	[en]Returns the value of a variable or an associative array with all the variables.[/en]
	[de]Gibt den Wert einer Variablen oder einen assoziativen Array mit allen Variablen zurück.[/de]
	
	@param sName [needed][type]string[/type]
	[en]The name of the variable.[/en]
	[de]Der Name der Variablen.[/de]
	*/
	public function getRegistered($_sName = NULL)
	{
		$_sName = $this->getRealParameter(array('oParameters' => $_sName, 'sName' => 'sName', 'xParameter' => $_sName));
		if ($_sName === NULL) {return $this->axRegister;}
		else if (isset($this->axRegister[$_sName])) {return $this->axRegister[$_sName];}
		return NULL;
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@description
	[en]Returns a previously registered / set variable or something from the previously saved context.[/en]
	[de]Gibt eine zuvor registrierte / gesetzte Variable oder etwas aus dem zuvor gespeicherten Context zurück.[/de]
	
	@return xContext [type]mixed[/type]
	[en]Returns the desired item from the internal context or a registered variable.[/en]
	[de]Gibt das gewünschte Element aus dem internen Kontext oder eine registrierte Variable zurück.[/de]
	
	@param xGet [needed][type]string[/type]
	[en]The index as an integer or string name of the desired element.[/en]
	[de]Der Index als Integer bzw. Name als String vom gewünschten Element.[/de]
	*/
	public function get($_xGet = NULL)
	{
		$_xGet = $this->getRealParameter(array('oParameters' => $_xGet, 'sName' => 'xGet', 'xParameter' => $_xGet, 'bNotNull' => true));
		return $this->getContext(array('xGet' => $_xGet));
	}
	/* @end method */
	
	/*
	@start method
	
	@group Context
	
	@description
	[en]Returns a previously registered / set variable or something from the previously saved context.[/en]
	[de]Gibt eine zuvor registrierte / gesetzte Variable oder etwas aus dem zuvor gespeicherten Context zurück.[/de]
	
	@return xContext [type]mixed[/type]
	[en]Returns the desired item from the internal context or a registered variable.[/en]
	[de]Gibt das gewünschte Element aus dem internen Kontext oder eine registrierte Variable zurück.[/de]
	
	@param xGet [needed][type]mixed[/type]
	[en]The index as an integer or string name of the desired element.[/en]
	[de]Der Index als Integer bzw. Name als String vom gewünschten Element.[/de]
	*/
	public function getContext($_xGet = NULL)
	{
		$_xGet = $this->getRealParameter(array('oParameters' => $_xGet, 'sName' => 'xGet', 'xParameter' => $_xGet));
		
		if ($_xGet === NULL) {$_xGet = 0;}
		
		if (is_string($_xGet))
		{
			if (isset($this->axRegister[$_xGet])) {return $this->axRegister[$_xGet];}
			return NULL;
		}
		return $this->axContext[$_xGet];
	}
	/* @end method */
	
	/*
	@start method
	
	@description
	[en]Calls a value or a method of a context item and may return something.[/en]
	[de]Ruft einen Wert ab oder eine Methode eines Kontext Elements auf und gibt ggf. etwas zurück.[/de]
	
	@return xMixed [type]mixed[/type]
	[en]May return a value or the return of a method.[/en]
	[de]Gibt ggf. einen Wert oder die Rückgabe einer Methode zurück.[/de]
	
	@param sCall [needed][type]string[/type]
	[en]The variable or method name to be invoked.[/en]
	[de]Der Variablen- oder Methodenname der aufgerufen werden soll.[/de]
	
	@param iContextIndex [type]int[/type]
	[en]The index of contexts by the element on which the action should be executed.[/en]
	[de]Der Index des Contexts von dem Element, über das die Aktion ausgeführt werden soll.[/de]
	*/
	public function call($_sCall, $_xValue = NULL, $_iContextIndex = NULL)
	{
		$_xValue = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'xValue', 'xParameter' => $_xValue));
		$_iContextIndex = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'iContextIndex', 'xParameter' => $_iContextIndex));
		$_sCall = $this->getRealParameter(array('oParameters' => $_sCall, 'sName' => 'sCall', 'xParameter' => $_sCall));
		if ($_iContextIndex == NULL)
		{

		}
		// if ($_iContextIndex === NULL) {$_iContextIndex = 0;}
		if (function_exists($this->axContext[$_iContextIndex]->$_sCall)) {return $this->axContext[$_iContextIndex]->$_sCall($_xValue);}
		if (property_exists($this->axContext[$_iContextIndex], $_sCall))
		{
			if ($_xValue !== NULL) {return $this->axContext[$_iContextIndex]->$_sCall = $_xValue;}
			return $this->axContext[$_iContextIndex]->$_sCall;
		}
	}
	/* @end method */
}
/* @end class */
$oPGApi = new classPG_Api();
?>